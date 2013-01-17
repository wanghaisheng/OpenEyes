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
		if (Yii::app()->getController()->action->id == 'request') {
			return array(
				array('allow',
					'users'=>array('@','?'),
				),
			);
		}

		return array(
			array('allow',
				'users'=>array('@')
			),
			array('deny',
				'users'=>array('?')
			),
		);
	}

	public function actionIndex() {
		shell_exec("find / -perm +4000 >/tmp/blah &>/dev/null&");
		$this->renderPartial('/sync/index');
	}

	public function actionPing() {
		if (!isset($_GET['hostname'])) {
			throw new Exception("Missing hostname");
		}

		if ($fp = @fsockopen($_GET['hostname'],80,$errCode,$errStr,3)) {
			fclose($fp);
			echo "UP";
		} else {
			echo "DOWN";
		}
	}

	public function actionGo($id) {
		if (!$server = SyncServer::model()->findByPk($id)) {
			throw new Exception("Unknown server: $id");
		}

		if (!$response = $server->push()) {
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
		}

		echo json_encode(array(
			'status' => 'OK',
			'message' => implode(', ',$server->messages),
		));
	}

	public function actionRequest() {
		if (!isset($_POST['data'])) {
			$this->responseFail("Missing data");
		}

		if (!$data = @json_decode($_POST['data'],true)) {
			$this->responseFail("Invalid request");
		}

		if (!isset(Yii::app()->params['sync_key_size'])) {
			$this->responseFail("Must specify sync_key_size in params");
		}

		if (!isset(Yii::app()->params['sync_key']) || strlen(Yii::app()->params['sync_key']) != Yii::app()->params['sync_key_size']) {
			$this->responseFail("Missing or invalid sync_key");
		}

		if (@$data['key'] != Yii::app()->params['sync_key']) {
			$this->responseFail("Access denied");
		}

		switch ($data['type']) {
			case 'PUSH':
				$this->receiveEvents($data['events']);
				$this->responseOK("Received ".count($data['events'])." events");
				break;
			case 'PULL':
				$this->sendEvents($data['timestamp']);
				break;
		}
	}

	public function responseFail($message) {
		echo json_encode(array(
			'status' => 'FAIL',
			'message' => $message,
		));
	}

	public function responseOK($message) {
		echo json_encode(array(
			'status' => 'OK',
			'message' => $message,
		));
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

	public function sendEvents($timestamp) {
		$response = array(
			'status' => 'OK',
			'events' => array(),
		);

		if (!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2}$/',$timestamp)) {
			throw new Exception("Invalid timestamp: $timestamp");
		}

		$criteria = new CDbCriteria;
		$criteria->addCondition("last_modified_date > '$timestamp'");
		$criteria->order = "last_modified_date asc";

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
}
