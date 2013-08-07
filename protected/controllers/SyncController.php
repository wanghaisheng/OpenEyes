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

class SyncController extends Controller
{
	public $substitution = array();

	public function filters()
	{
		return array('accessControl');
	}

	public function accessRules()
	{
		if (in_array(Yii::app()->getController()->action->id,array('request','csrf'))) {
			return array(
				array('allow', 'users'=>array('@','?')),
			);
		}

		return array(
			array('allow', 'users'=>array('@')),
			array('deny', 'users'=>array('?')),
		);
	}

	public function actionIndex() {
		$this->renderPartial('/sync/index',array('server' => SyncServer::model()->find()));
	}

	public function actionPing($id) {
		if (!$server = SyncServer::model()->findByPk($id)) {
			throw new Exception("Unknown server: $id");
		}

		if (!($ping = trim(`which ping`))) {
			throw new Exception("Unable to find path to the ping binary");
		}

		if (preg_match('/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/',$server->hostname)) {
			$ip = $server->hostname;
		} else {
			if (file_exists("/etc/hosts")) {
				foreach (@file("/etc/hosts") as $line) {
					$line = substr($line,0,strlen($line)-1);
					if (preg_match('/^([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3})[\s\t]+([a-z][a-zA-Z0-9\.\-_]+)$/',$line,$m)) {
						if (strtolower($m[2]) == strtolower($server->hostname)) {
							$ip = $m[1];
							break;
						}
					}
				}
			}

			if (!isset($ip)) {
				$res = trim(`host -W1 {$server->hostname} |grep 'has address' |head -n1`);
				if (!$res) {
					echo "DOWN";
					return;
				}
				$e = explode(' ',$res);
				$ip = $e[3];
			}
		}

		$platform = trim(`uname`);

		if ($platform == 'Darwin') {
			if (`$ping -t3 -c1 -W3 $ip 2>/dev/null |grep '1 packets received'`) {
				echo "UP";
			} else {
				echo "DOWN";
			}
		} else if ($platform == 'Linux') {
			if (`$ping -c1 -w3 $ip 2>/dev/null |grep '1 received'`) {
				echo "UP";
			} else {
				echo "DOWN";
			}
		} else {
			throw new Exception("Unsupported platform: $platform");
		}
	}

	public function actionStatus($id) {
		if (!$server = SyncServer::model()->findByPk($id)) {
			throw new Exception("Unknown server: $id");
		}

		if ($server->InSync()) {
			echo "INSYNC";
		} else {
			echo "OUTOFSYNC";
		}
	}

	public function actionGo($id) {
		if (!$server = SyncServer::model()->findByPk($id)) {
			throw new Exception("Unknown server: $id");
		}

		if (!$response = $server->sync()) {
			echo json_encode(array(
				'status' => 'FAIL',
				'message' => implode(', ',$server->message),
			));
		}

		/*if (!$response = $server->push()) {
			echo json_encode(array(
				'status' => 'FAIL',
				'message' => implode(', ',$server->messages),
			));
			return;
		}

		if (!$response = $server->pull()) {
			echo json_encode(array(
				'status' => 'FAIL',
				'message' => implode(', ',$server->messages),
			));
			return;
		}*/

		echo json_encode(array(
			'status' => 'OK',
			'message' => implode(', ',$server->messages),
		));
	}

	public function actionCsrf() {
		echo Yii::app()->request->csrfToken;
	}

	public function actionRequest() {
		if (!isset($_POST['data'])) {
			return $this->response("fail","Missing data");
		}

		if (!$data = @json_decode($_POST['data'],true)) {
			return $this->response("fail","Invalid request");
		}

		if (!isset(Yii::app()->params['sync_key_size'])) {
			return $this->response("fail","Must specify sync_key_size in params");
		}

		if (!isset(Yii::app()->params['sync_key']) || strlen(Yii::app()->params['sync_key']) != Yii::app()->params['sync_key_size']) {
			return $this->response("fail","Missing or invalid sync_key");
		}

		if (@$data['key'] != Yii::app()->params['sync_key']) {
			return $this->response("fail","Access denied");
		}

		switch ($data['type']) {
			case 'PUSH':
				return $this->response('ok',$this->receiveItems($data['table'],$data['data']));
			case 'PULL':
				switch ($data['table']) {
					case 'event':
						$items = $this->sendItems_event($data['last_sync']);
						break;
					default:
						$items = $this->sendItems($data['table'], $data['last_sync']);
						break;
				}

				return $this->response('ok',array(
					'data' => $items,
				));

				break;
			case 'STATUS':
				if (Event::model()->find('last_modified_date > ?',array($data['timestamp'])) || Asset::model()->find('last_modified_date > ? ',array($data['timestamp']))) {
					$this->response("ok","Out of sync",array(
						'sync_status' => false,
					));
				} else {
					$this->response("ok","In sync",array(
						'sync_status' => true,
					));
				}
				break;
		}
	}

	public function response($status, $data) {
		echo json_encode(array(
			'status' => $status,
			'message' => $data,
		));
	}

	public function receiveAssets($assets) {
		foreach ($assets as $asset) {
			$_asset = $this->findOrCreateRow('Asset',$asset);
			if (!@file_put_contents($_asset->path,base64_decode($asset['_data']))) {
				throw new Exception("Failed to write asset to disk: $_asset->path");
			}
			if (!@file_put_contents($_asset->preview,base64_decode($asset['_preview']))) {
				throw new Exception("Failed to write asset preview to disk: $_asset->preview");
			}
			if (!@file_put_contents($_asset->thumbnail,base64_decode($asset['_thumbnail']))) {
				throw new Exception("Failed to write asset thumbnail to disk: $_asset->thumbnail");
			}
		}
	}

	public function receiveEvents($events) {
		foreach ($events as $event) {
			$_episode = $this->findOrCreateRow('Episode',$event['_episode']);
			$this->substitution['episode_id'] = $_episode->id;

			$_event = $this->findOrCreateRow('Event',$event);
			$this->substitution['event_id'] = $_event->id;

			foreach ($event['_issues'] as $issue) {
				$this->findOrCreateRow('EventIssue',$issue);
			}

			foreach ($event['_elements'] as $element_class => $element) {
				$_element = $this->findOrCreateRow($element_class, $element);

				if (isset($element['_relations'])) {
					foreach ($element['_relations'] as $relation_class => $relations) {
						if (!empty($relations)) {
							$relation_table = $relation_class::model()->tableName();
							$element_key = $this->get_element_key($relations);

							if ($relation_table == 'ophdrprescription_item') {
								foreach (Yii::app()->db->createCommand("select id from $relation_table where $element_key = $_element->id")->queryAll() as $row) {
									Yii::app()->db->createCommand("delete from ophdrprescription_item_taper where item_id = {$row['id']}")->query();
								}
							}
							Yii::app()->db->createCommand("delete from $relation_table where $element_key = $_element->id")->query();

							foreach ($relations as $relation) {
								$relation[$element_key] = $_element->id;
								$_item = $this->findOrCreateRow($relation_class, $relation, true);

								if (isset($relation['_relations'])) {
									foreach ($relation['_relations'] as $relation_class2 => $relations2) {
										if (!empty($relations2)) {
											$relation_table2 = $relation_class2::model()->tableName();
											$parent_key = $this->get_element_key($relations2);
											Yii::app()->db->createCommand("delete from $relation_table2 where $parent_key = $_item->id")->query();

											foreach ($relations2 as $relation2) {
												$relation2[$parent_key] = $_item->id;
												$this->findOrCreateRow($relation_class2, $relation2, true);
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}

	public function sendAssetsAndEvents($timestamp) {
		$response = array(
			'status' => 'OK',
			'assets' => array(),
			'events' => array(),
		);

		if (!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2}$/',$timestamp)) {
			throw new Exception("Invalid timestamp: $timestamp");
		}

		$criteria = new CDbCriteria;
		$criteria->addCondition("last_modified_date > '$timestamp'");
		$criteria->order = "last_modified_date asc";

		foreach (Asset::model()->findAll($criteria) as $asset) {
			$response['assets'][] = $asset->wrap();
		}

		foreach (Event::model()->findAll($criteria) as $event) {
			$response['events'][] = $event->wrap();
		}

		echo json_encode($response);
	}

	public function get_element_key($relations) {
		foreach ($relations as $relation) {
			foreach ($relation as $key => $value) {
				if (preg_match('/^\{.*\}$/',$value)) {
					return $key;
				}
			}
		}
		throw new Exception("Unable to find related key for relation: ".print_r($relations,true));
	}

	public function findOrCreateRow($model,$data,$just_create=false) {
		$table = $model::model()->tableName();

		$data = $this->stripDescendants($data);

		foreach ($data as $key => $value) {
			foreach ($this->substitution as $s_key => $s_value) {
				if ($value == '{'.$s_key.'}') {
					$data[$key] = $s_value;
				}
			}

			if (preg_match('/^\{([a-zA-Z]+):([a-f0-9\-]+)\}$/',$value,$m)) {
				$_model = $m[1];
				if (!$object = $_model::model()->find('hash=?',array($m[2]))) {
					throw new Exception("Unable to find {$_model}: {$m[2]}");
				}
				$data[$key] = $object->id;
			}
		}

		if (!$just_create) {
			$find_key = isset($data['hash']) ? 'hash' : 'event_id';

			if ($object = $model::model()->find("$find_key=?",array($data[$find_key]))) {
				$this->updateFromArray($table,$object->id,$data);
				return $object;
			}

			if ($model == 'Episode') {
				// Only one episode per patient per subspecialty
				$firm = Firm::model()->findByPk($data['firm_id']);

				$firm_ids = array();
				foreach (Yii::app()->db->createCommand()
					->select("f.id")
					->from("firm f")
					->join("service_subspecialty_assignment ssa","f.service_subspecialty_assignment_id = ssa.id")
					->where("ssa.subspecialty_id = ".$firm->serviceSubspecialtyAssignment->subspecialty_id)
					->queryAll() as $row) {
					$firm_ids[] = $row['id'];
				}

				if ($object = $model::model()->find('firm_id in ('.implode(',',$firm_ids).') and patient_id=?',array($data['patient_id']))) {
					$this->updateFromArray($table,$object->id,$data);
					return $object;
				}
			}
		}

		Yii::app()->db->createCommand("insert into $table (".implode(',',array_keys($data)).") values (".$this->implodeValues($data).")")->query();

		if ($model == 'OperationProcedureAssignment' || $model == 'ProcedureListProcedureAssignment') return null;

		$criteria = new CDbCriteria;
		$criteria->order = 'id desc';
		$criteria->limit = 1;

		return $model::model()->find($criteria);
	}

	public function stripDescendants($object) {
		foreach ($object as $key => $value) {
			if (preg_match('/^_/',$key)) {
				unset($object[$key]);
			}
		}
		return $object;
	}

	public function updateFromArray($table, $id, $data) {
		$sql = "update $table set ";
		$first = true;
		foreach ($data as $key => $value) {
			if (!preg_match('/^_/',$key)) {
				if (!$first) $sql .= ", ";
				$first = false;
				if (!$value && (preg_match('/_id$/',$key) || preg_match('/_date$/',$key))) {
					$sql .= "$key = null";
				} else {
					$sql .= "$key = '".mysql_escape_string($value)."'";
				}
			}
		}
		Yii::app()->db->createCommand($sql." where id = $id")->query();
	}

	public function implodeValues($data) {
		$first=true;
		$return='';
		foreach ($data as $key => $value) {
			if (!$first) $return .= ",";
			$first=false;
			if (!$value) {
				if (preg_match('/_id$/',$key) || preg_match('/_date$/',$key)) {
					$return .= "null";
				} else {
					$return .= "''";
				}
			} else {
				$return .= "'".mysql_escape_string($value)."'";
			}
		}
		return $return;
	}

	public function receiveItems($table,$data) {
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

	public function wasMoreRecentlyDeleted($table, $item) {
		if ($dl = DeleteLog::model()->find('item_table=? and item_id=?',array($table,$item['id']))) {
			if (strtotime($dl->created_date) > strtotime($item->last_modified_date)) {
				return true;
			}
		}

		return false;
	}

	public function receiveItems_proc_opcs_assignment($resp, $data) {
		foreach ($data as $item) {
			if (!$local = Yii::app()->db->createCommand()->select("*")->from('proc_opcs_assignment')->where("proc_id=:proc_id and opcs_code_id=:opcs_code_id",array(':proc_id'=>$item['proc_id'],':opcs_code_id'=>$item['opcs_code_id']))->queryRow()) {
				Yii::app()->db->createCommand()->insert($table, $item);
				$resp['inserted']++;
			}
		}

		return $resp;
	}

	public function receiveItems_delete_log($resp, $data) {
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

	public function receiveItems_event($resp, $data) {
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

	public function processRelatedData($related, $type=null) {
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

	public function processDeletes($deletes) {
		foreach ($deletes as $delete) {
			if ($local = Yii::app()->db->createCommand()->select("*")->from($delete['table'])->where("id=:id",array(":id"=>$delete['id']))->queryRow()) {
				if (strtotime($delete['datetime']) > strtotime($local['last_modified_date'])) {
					$this->nuke($delete['table'],$delete['id']);
				}
			}
		}
	}

	// Delete row and anything that points to it recursively
	public function nuke($table, $id) {
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

	public function sendItems($table, $last_sync) {
		return Yii::app()->db->createCommand()->select("*")->from($table)->where("last_modified_date > ?",array($last_sync))->order("last_modified_date asc")->queryAll();
	}

	public function sendItems_event($last_sync) {
	}
}
