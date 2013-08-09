<?php
/**
 * OpenEyes
 *
 * (C) Moorfields Eye Hospital NHS Foundation Trust, 2008-2011
 * (C) OpenEyes Foundation, 2011-2012
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package OpenEyes
 * @link http://www.openeyes.org.uk
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright (c) 2008-2011, Moorfields Eye Hospital NHS Foundation Trust
 * @copyright Copyright (c) 2011-2012, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html The GNU General Public License V3.0
 */

/**
 * This is the service class for syncing
 */
class SyncService
{
	public $server = null;

	public function __construct($server=null)
	{
		$this->server = $server;
	}

	public function sync()
	{
		$request = array(
			'type' => 'PUSH',
			'tables' => array(),
			'events' => array(),
			'protected_files' => array(),
		);

		OELog::log("Preparing to sync ...");

		foreach ($this->getCoreTableListInSyncOrder() as $table) {
			if (!in_array($table,array('event','episode','protected_file'))) {
				$changed = Yii::app()->db->createCommand()->select("*")->from($table)->where("last_modified_date > ?",array($this->server->last_sync))->order("last_modified_date asc")->queryAll();

				if (!empty($changed)) {
					OELog::log("[$table] pushing ...");
					$count = $this->push($table, $changed);
					OELog::log("[$table] pushed $count rows");
				}
			}
		}

		$criteria = new CDbCriteria;
		$criteria->addCondition("last_modified_date > '{$this->server->last_sync}'");
		$criteria->order = "last_modified_date asc";

		foreach (Event::model()->findAll($criteria) as $event) {
			$request['events'][] = $event->wrap();
			$this->processed_events[] = $event->hash;
		}

		if (empty($request['events'])) {
			$this->messages[] = "pushed 0 events";
		}

		if (empty($request['assets'])) {
			$this->messages[] = "pushed 0 assets";
		}

		if (empty($request['events']) && empty($request['assets'])) {
			return true;
		}

		$json = json_encode($request);

		$response = $this->request($json);

		if (!$resp = @json_decode($response,true)) {
			if (preg_match('/Authorization Required/i',$response)) {
				$this->messages[] = "http authorisation required";
			} else {
				$this->messages[] = "unable to parse server response";
			}
			die($response);
			return false;
		}

		if (@$resp['status'] == 'OK') {
			$this->messages[] = "pushed ".count($request['assets'])." asset".(count($request['assets'])==1 ? '' : 's');
			$this->messages[] = "pushed ".count($request['events'])." event".(count($request['events'])==1 ? '' : 's');
			return true;
		}
		$this->messages[] = $resp['message'];
		return false;
	}

	public function push($table)
	{
		$data = Yii::app()->db->createCommand()
			->select("*")
			->from($table)
			->where("last_modified_date > ?",array($this->server->last_sync))
			->order("last_modified_date asc")
			->queryAll();

		if (empty($data)) {
			return array('received'=>0,'inserted'=>0,'updated'=>0,'not-modified'=>0);
		}

		$resp = $this->request(array(
			'type' => 'PUSH',
			'table' => $table,
			'data' => $data,
		));

		if ($resp['status'] != 'ok') {
			die("Failed: {$resp['message']}\n");
		}

		return $resp['message'];
	}

	public function pushEvents()
	{
		$events = Yii::app()->db->createCommand()->select("*")->from("event")->where("last_modified_date > ?",array($this->server->last_sync))->order("last_modified_date asc")->queryAll();

		if (empty($events)) {
			return array('received'=>0,'inserted'=>0,'updated'=>0,'not-modified'=>0);
		}

		foreach ($events as $i => $event) {
			$events[$i]['_elements'] = $this->wrapElements($event);
			$events[$i]['_deletes'] = $this->wrapDeletes($event, $this->server->last_sync);
		}

		$resp = $this->request(array(
			'type' => 'PUSH',
			'table' => 'event',
			'data' => $events,
		));

		if ($resp['status'] != 'ok') {
			die("Failed: {$resp['message']}\n");
		}

		return $resp['message'];
	}

	public function wrapElements($event)
	{
		$elements = array();

		$criteria = new CDbCriteria;
		$criteria->addCondition('event_type_id=:event_type_id');
		$criteria->params[':event_type_id'] = $event['event_type_id'];
		$criteria->order = 'display_order asc';

		foreach (ElementType::model()->findAll($criteria) as $element_type) {
			$class = $element_type->class_name;
			$table = $class::model()->tableName();

			if ($element = Yii::app()->db->createCommand()->select("*")->from($table)->where("event_id = :event_id",array(":event_id"=>$event['id']))->queryRow()) {
				$elements[] = $this->wrapElement($table, $element);
			}
		}

		return $elements;
	}

	public function wrapElement($table, $element)
	{
		return array(
			'table' => $table,
			'data' => $element,
			'related' => $this->getRelatedItems($table, $element),
		);
	}

	public function getRelatedItems($table, $element)
	{
		$related = array();

		if (preg_match('/^et_/',$table)) {
			foreach (Yii::app()->db->getSchema()->getTables() as $_table) {
				foreach ($_table->foreignKeys as $field => $key) {
					if ($key[0] == $table) {
						$data = Yii::app()->db->createCommand()->select("*")->from($_table->name)->where("$field = :$field",array(":$field"=>$element['id']))->queryAll();

						if (!empty($data)) {
							foreach ($data as $item) {
								$related[] = array(
									'type' => 'reverse',
									'table' => $_table->name,
									'data' => $item,
									'related' => $this->getRelatedItems($_table->name, $item),
								);
							}
						}
					}
				}
			}
		}

		foreach (Yii::app()->db->getSchema()->getTable($table)->foreignKeys as $field => $key) {
			if (preg_match('/^oph/',$key[0])) {
				if ($element[$field] !== null) {
					if ($relatedItem = Yii::app()->db->createCommand()->select("*")->from($key[0])->where("id=?",array($element[$field]))->queryRow()) {
						$related[] = array(
							'type' => 'foreign',
							'table' => $key[0],
							'data' => $relatedItem,
							'related' => $this->getRelatedItems($key[0], $relatedItem),
						);
					}
				}
			}
		}

		return $related;
	}

	public function wrapDeletes($event, $last_sync)
	{
		$deletes = array();

		$event_type = EventType::model()->findByPk($event['event_type_id']);

		foreach (Yii::app()->db->createCommand()->select("*")->from("delete_log")->where("event_id = ? and created_date > ?",array($event['id'],$last_sync))->order("created_date asc")->queryAll() as $dl) {
			if (preg_match('/^et_'.strtolower($event_type->class_name).'_/',$dl['item_table']) || preg_match('/^'.strtolower($event_type->class_name).'_/',$dl['item_table'])) {
				$deletes[] = array(
					'table' => $dl['item_table'],
					'id' => $dl['item_id'],
					'datetime' => $dl['created_date'],
				);
			}
		}

		return $deletes;
	}

	public function pull($table)
	{
		$resp = $this->request(array(
			'type' => 'PULL',
			'table' => $table,
		));

		if ($resp['status'] != 'ok') {
			die("Failed: {$resp['message']}\n");
		}

		$resp = $this->receiveItems($table, $resp['message']['data']);

		return $resp;
	}

	public function pullEvents()
	{
		$resp = $this->request(array(
			'type' => 'PULL',
			'table' => 'event',
		));

		if ($resp['status'] != 'ok') {
			die("Failed: {$resp['message']}\n");
		}

		$resp = $this->receiveItems('event', $resp['message']['data']);

		return $resp;
	}

	public function inSync()
	{
		$response = $this->request(json_encode(array(
			'key' => $this->server->key,
			'timestamp' => $this->server->last_sync,
			'type' => 'STATUS',
		)));

		if (!$resp = @json_decode($response,true)) {
			$this->messages[] = "unable to parse server response";
			return false;
		}

		if (!$resp['sync_status']) {
			$server->sync_status = 0;
			if (!$server->save()) {
				throw new Exception("Unable to mark server out of sync: ".print_r($server->getErrors(),true));
			}
		}

		return $resp['sync_status'];
	}

	public function request($request)
	{
		$request['key'] = $this->server->key;
		$request['last_sync'] = $this->server->last_sync;

		$c = curl_init();
		curl_setopt($c,CURLOPT_URL,"http://{$this->server->hostname}/sync/csrf");
		curl_setopt($c,CURLOPT_RETURNTRANSFER,true);
		$csrf = trim(curl_exec($c));

		curl_setopt($c,CURLOPT_URL,"http://{$this->server->hostname}/sync/request");
		curl_setopt($c,CURLOPT_POST,true);
		curl_setopt($c,CURLOPT_POSTFIELDS,"data=".rawurlencode(json_encode($request))."&YII_CSRF_TOKEN=".$csrf);

		if (isset(Yii::app()->params['sync_http_username']) && isset(Yii::app()->params['sync_http_password'])) {
			curl_setopt($c,CURLOPT_USERPWD,Yii::app()->params['sync_http_username'].":".Yii::app()->params['sync_http_password']);
		}

		$data = curl_exec($c);

		if (!$resp = @json_decode($data,true)) {
			if (preg_match('/Authorization Required/i',$data)) {
				die("http authorisation required");
			} else {
				die($data);
				die("unable to parse server response");
			}
		}

		return $resp;
	}

	public function getCoreTableListInSyncOrder()
	{
		$tables = array('user');
		$exclude = array('authitem','authitemchild','authassignment','event','episode','protected_file','user_session','tbl_migration');

		foreach (Yii::app()->db->getSchema()->getTables() as $table) {
			if (!preg_match('/^et_oph/',$table->name) && !preg_match('/^oph/',$table->name)) {
				if (!in_array($table->name,$tables)) {
					foreach ($this->getDependencies($table,$tables) as $deptable) {
						if (!in_array($deptable,$tables) && !in_array($deptable,$exclude)) {
							$tables[] = $deptable;
						}
					}
					if (!in_array($table->name,$tables) && !in_array($table->name,$exclude)) {
						$tables[] = $table->name;
					}
				}
			}
		}

		return $tables;
	}

	public function getDependencies($table, $ignore)
	{
		$deps = array();

		foreach ($table->foreignKeys as $key) {
			if (!in_array($key[0],$deps) && !in_array($key[0],$ignore)) {
				$deps[] = $key[0];

				if ($table->name != $key[0]) {
					foreach ($this->getDependencies($this->getTableObject($key[0]),$ignore) as $deptable) {
						if (!in_array($deptable,$deps)) {
							$deps[] = $deptable;
						}
					}
				}
			}
		}

		return $deps;
	}

	public function getTableObject($table)
	{
		return Yii::app()->db->getSchema()->getTable($table);
	}

	public function receiveItems($table,$data)
	{
		$resp = array(
			'received' => count($data),
			'inserted' => 0,
			'updated' => 0,
			'not-modified' => 0,
		);

		switch ($table) {
			case 'proc_opcs_assignment':
				return $this->receiveItems_proc_opcs_assignment($resp, $data);
			case 'delete_log':
				return $this->receiveItems_delete_log($resp, $data);
			case 'event':
				return $this->receiveItems_event($resp, $data);
		}

		foreach ($data as $item) {
			$id = @$item['id'];

			if ($id && $local = Yii::app()->db->createCommand()->select("*")->from($table)->where("id = :id",array('id'=>$id))->queryRow()) {
				if (strtotime($item['last_modified_date']) > strtotime($item['last_modified_date'])) {
					unset($item['id']);

					Yii::app()->db->createCommand()->update($table, $item, "id = :id", array(":id" => $id));
					$resp['updated']++;
				} else {
					$resp['not-modified']++;
				}
			} else if (!$this->wasMoreRecentlyDeleted($table, $item)) {
				Yii::app()->db->createCommand()->insert($table, $item);
				$resp['inserted']++;
			}
		}

		return $resp;
	}

	public function wasMoreRecentlyDeleted($table, $item)
	{
		if ($dl = DeleteLog::model()->find('item_table=? and item_id=?',array($table,$item['id']))) {
			if (strtotime($dl->created_date) > strtotime($item->last_modified_date)) {
				return true;
			}
		}

		return false;
	}

	public function receiveItems_proc_opcs_assignment($resp, $data)
	{
		foreach ($data as $item) {
			if (!$local = Yii::app()->db->createCommand()->select("*")->from('proc_opcs_assignment')->where("proc_id=:proc_id and opcs_code_id=:opcs_code_id",array(':proc_id'=>$item['proc_id'],':opcs_code_id'=>$item['opcs_code_id']))->queryRow()) {
				Yii::app()->db->createCommand()->insert($table, $item);
				$resp['inserted']++;
			}
		}

		return $resp;
	}

	public function receiveItems_delete_log($resp, $data)
	{
		foreach ($data as $item) {
			if ($item['event_id'] === null) {
				if ($local = Yii::app()->db->createCommand()->select("*")->from($item['item_table'])->where("id=:id",array(":id"=>$item['item_id']))->queryRow()) {
					if (strtotime($local['last_modified_date']) <= strtotime($item['created_date'])) {
						Yii::app()->db->createCommand()->delete($item['item_table'],"id=:id",array(":id"=>$item['item_id']));
					}
				}

				if (!$local = Yii::app()->db->createCommand()->select("*")->from('delete_log')->where('id=:id',array(':id'=>$item['id']))->queryRow()) {
					Yii::app()->createCommand()->insert('delete_log',$item);
					$resp['inserted']++;
				} else {
					$resp['not-modified']++;
				}
			}
		}

		return $resp;
	}

	public function receiveItems_event($resp, $data)
	{
		foreach ($data as $event) {
			OELog::log(print_r($event,true));

			$_data = $event;
			foreach ($_data as $key => $value) {
				if ($key[0] == '_') {
					unset($_data[$key]);
				}
			}

			if ($local = Yii::app()->db->createCommand()->select("*")->from("event")->where("id=:id",array(":id"=>$event['id']))->queryRow()) {
				if (strtotime($_data['last_modified_date']) > strtotime($local['last_modified_date'])) {
					Yii::app()->db->createCommand()->update("event",$_data,"id=:id",array(":id"=>$event['id']));
					$resp['updated']++;
					OELog::log("Updating event {$event['id']}");
				} else {
					$resp['not-modified']++;
					OELog::log("Not updating event {$event['id']}");
				}
			} else {
				Yii::app()->db->createCommand()->insert("event",$_data);
				$resp['inserted']++;
				OELog::log("Creating event {$_data['id']}");
			}

			$this->processRelatedData($event['_elements']);
			$this->processDeletes($event['_deletes']);
		}

		return $resp;
	}

	public function processRelatedData($related, $type=null)
	{
		foreach ($related as $item) {
			!empty($item['related']) && $this->processRelatedData($item['related'], ($type===null ? 'foreign' : $type));

			if (@$item['type'] == $type) {
				if ($local = Yii::app()->db->createCommand()->select("*")->from($item['table'])->where("id=:id",array(":id"=>$item['data']['id']))->queryRow()) {
					if (strtotime($item['data']['last_modified_date']) > strtotime($local['last_modified_date'])) {
						Yii::app()->db->createCommand()->update($item['table'],$item['data'],"id=:id",array(":id"=>$item['data']['id']));
						OELog::log("Updating {$item['table']} {$item['data']['id']}: ".print_r($item['data'],true));
					}
				} else {
					Yii::app()->db->createCommand()->insert($item['table'],$item['data']);
					OELog::log("Inserting {$item['table']}: ".print_r($item['data'],true));
				}
			} else {
				OELog::log("Related data type {$item['type']} != $type");
			}

			!empty($item['related']) && $this->processRelatedData($item['related'], ($type===null ? 'reverse' : $type));
		}
	}

	public function processDeletes($deletes)
	{
		foreach ($deletes as $delete) {
			if ($local = Yii::app()->db->createCommand()->select("*")->from($delete['table'])->where("id=:id",array(":id"=>$delete['id']))->queryRow()) {
				if (strtotime($delete['datetime']) > strtotime($local['last_modified_date'])) {
					$this->nuke($delete['table'],$delete['id']);
				}
			}
		}
	}

	// Delete row and anything that points to it recursively
	public function nuke($table, $id)
	{
		foreach (Yii::app()->db->getSchema()->getTables() as $_table) {
			if ($_table->name != $table) {
				foreach ($_table->foreignKeys as $field => $key) {
					if ($key[0] == $table) {
						foreach (Yii::app()->db->createCommand()->select("*")->from($_table->name)->where("$field = :$field",array(":$field" => $id))->queryAll() as $row) {
							$this->nuke($_table->name,$row['id']);
						}
					}
				}
			}
		}

		Yii::app()->db->createCommand()->delete($table,"id=:id",array(":id"=>$id));
	}

	public function getItems($table, $last_sync)
	{
		$events = Yii::app()->db->createCommand()->select("*")->from($table)->where("last_modified_date > ?",array($last_sync))->order("last_modified_date asc")->queryAll();

		if ($table == 'event') {
			foreach ($events as $i => $event) {
				$events[$i]['_elements'] = $this->wrapElements($event);
				$events[$i]['_deletes'] = $this->wrapDeletes($event, $last_sync);
			}
		}

		return $events;
	}
}
