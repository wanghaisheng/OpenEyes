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
	public function filters()
	{
		return array('accessControl');
	}

	public function accessRules()
	{
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

		$request = array(
			'key' => $server->key,
			'type' => 'PUSH',
			'events' => array(),
		);

		$criteria = new CDbCriteria;
		$criteria->addCondition("datetime > '$server->last_sync'");
		$criteria->order = "datetime asc";

		foreach (Event::model()->findAll($criteria) as $event) {
			$request['events'][] = $event->wrap();
		}

		$json = json_encode($request);

		$response = $server->request($json);

		echo "[$response]";
	}
}
