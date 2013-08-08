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

	public function actionIndex()
	{
		$this->renderPartial('/sync/index',array('server' => SyncServer::model()->find()));
	}

	public function actionPing($id)
	{
		if (!$server = SyncServer::model()->findByPk($id)) {
			throw new Exception("Unknown server: $id");
		}

		if ($server->up()) {
			echo "UP";
		} else {
			echo "DOWN";
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
}
