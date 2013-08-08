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
 * This is the model class for table "sync_server".
 */
class SyncServer extends BaseActiveRecord
{
	public $processed_events = array();
	public $processed_assets = array();
	public $messages = array();

	/**
	 * Returns the static model of the specified AR class.
	 * @return Firm the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sync_server';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
		);
	}

	public function getLastSyncText() {
		if ($this->last_sync == '1900-01-01 00:00:00') {
			return 'Never';
		}
		return date('j M Y H:i',strtotime($this->last_sync));
	}

	public function sync() {
		$request = array(
			//'key' => $this->key,
			'type' => 'PUSH',
			'tables' => array(),
			'events' => array(),
			'protected_files' => array(),
		);

		OELog::log("Preparing to sync ...");

		foreach ($this->getCoreTableListInSyncOrder() as $table) {
			if (!in_array($table,array('event','episode','protected_file'))) {
				$changed = Yii::app()->db->createCommand()->select("*")->from($table)->where("last_modified_date > ?",array($this->last_sync))->order("last_modified_date asc")->queryAll();

				if (!empty($changed)) {
					OELog::log("[$table] pushing ...");
					$count = $this->push($table, $changed);
					OELog::log("[$table] pushed $count rows");
				}
			}
		}

		$criteria = new CDbCriteria;
		$criteria->addCondition("last_modified_date > '$this->last_sync'");
		$criteria->order = "last_modified_date asc";

		/*foreach (Asset::model()->findAll($criteria) as $asset) {
			$request['assets'][] = $asset->wrap();
			$this->processed_assets[] = $asset->hash;
		}
		*/

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

	public function push($table) {
		$data = Yii::app()->db->createCommand()->select("*")->from($table)->where("last_modified_date > ?",array($this->last_sync))->order("last_modified_date asc")->queryAll();

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

	public function pushEvents() {
		$events = Yii::app()->db->createCommand()->select("*")->from("event")->where("last_modified_date > ?",array($this->last_sync))->order("last_modified_date asc")->queryAll();

		if (empty($events)) {
			return array('received'=>0,'inserted'=>0,'updated'=>0,'not-modified'=>0);
		}

		foreach ($events as $i => $event) {
			$events[$i]['_elements'] = $this->wrapElements($event);
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

	public function wrapElements($event) {
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

	public function wrapElement($table, $element) {
		return array(
			'table' => $table,
			'data' => $element,
			'related' => $this->getRelatedItems($table, $element),
		);
	}

	public function getRelatedItems($table, $element) {
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
							'item' => $relatedItem,
							'related' => $this->getRelatedItems($key[0], $relatedItem),
						);
					}
				}
			}
		}

		return $related;
	}

	public function pull($table) {
		$resp = $this->request(array(
			'type' => 'PULL',
			'table' => $table,
		));

		if ($resp['status'] != 'ok') {
			die("Failed: {$resp['message']}\n");
		}

		$s = new SyncController(null);
		$resp = $s->receiveItems($table, $resp['message']['data']);

		return $resp;
	}

	public function pull2() {
		$response = $this->request(json_encode(array(
			'key' => $this->key,
			'timestamp' => $this->last_sync,
			'type' => 'PULL',
		)));

		if (!$resp = @json_decode($response,true)) {
			if (preg_match('/Authorization Required/i',$response)) {
				$this->messages[] = "http authorisation required";
			} else {
				$this->messages[] = "unable to parse server response";
			}
			return false;
		}

		if (@$resp['status'] == 'OK') {
			foreach ($resp['assets'] as $i => $asset) {
				if (in_array($asset['hash'],$this->processed_assets)) {
					unset($resp['assets'][$i]);
				}
			}

			foreach ($resp['events'] as $i => $event) {
				if (in_array($event['hash'],$this->processed_events)) {
					unset($resp['events'][$i]);
				}
			}

			Yii::app()->getController()->receiveAssets($resp['assets']);
			Yii::app()->getController()->receiveEvents($resp['events']);

			$this->last_sync = date('Y-m-d H:i:s');
			$this->in_sync = true;
			if (!$this->save()) {
				throw new Exception("Unable to save server state: ".print_r($this->getErrors(),true));
			}
			$this->messages[] = "received ".count($resp['assets'])." asset".(count($resp['assets'])==1 ? '' : 's');
			$this->messages[] = "received ".count($resp['events'])." event".(count($resp['events'])==1 ? '' : 's');
			return true;
		}
		$this->messages[] = $resp['message'];
		return false;
	}

	public function inSync() {
		$response = $this->request(json_encode(array(
			'key' => $this->key,
			'timestamp' => $this->last_sync,
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

	public function request($request) {
		$request['key'] = $this->key;
		$request['last_sync'] = $this->last_sync;

		$c = curl_init();
		curl_setopt($c,CURLOPT_URL,"http://$this->hostname/sync/csrf");
		curl_setopt($c,CURLOPT_RETURNTRANSFER,true);
		$csrf = trim(curl_exec($c));

		curl_setopt($c,CURLOPT_URL,"http://$this->hostname/sync/request");
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

	public function getCoreTableListInSyncOrder() {
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

	public function getDependencies($table, $ignore) {
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

	public function getTableObject($table) {
		return Yii::app()->db->getSchema()->getTable($table);
	}
}
