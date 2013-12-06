<?php
/**
 * OpenEyes
 *
 * (C) Moorfields Eye Hospital NHS Foundation Trust, 2008-2011
 * (C) OpenEyes Foundation, 2011-2013
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package OpenEyes
 * @link http://www.openeyes.org.uk
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright (c) 2008-2011, Moorfields Eye Hospital NHS Foundation Trust
 * @copyright Copyright (c) 2011-2013, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html The GNU General Public License V3.0
 */

class ApiController extends CController
{
	/**
	 * @var string the default layout for the views.
	 */
	public $layout = '//layouts/api';

	public $services = array(
		'patient' => 'PatientService',
	);

	protected $status_codes = array(
		100 => 'Continue',
		101 => 'Switching Protocols',
		200 => 'OK',
		201 => 'Created',
		202 => 'Accepted',
		203 => 'Non-Authoritative Information',
		204 => 'No Content',
		205 => 'Reset Content',
		206 => 'Partial Content',
		300 => 'Multiple Choices',
		301 => 'Moved Permanently',
		302 => 'Found',
		303 => 'See Other',
		304 => 'Not Modified',
		305 => 'Use Proxy',
		306 => '(Unused)',
		307 => 'Temporary Redirect',
		400 => 'Bad Request',
		401 => 'Unauthorized',
		402 => 'Payment Required',
		403 => 'Forbidden',
		404 => 'Not Found',
		405 => 'Method Not Allowed',
		406 => 'Not Acceptable',
		407 => 'Proxy Authentication Required',
		408 => 'Request Timeout',
		409 => 'Conflict',
		410 => 'Gone',
		411 => 'Length Required',
		412 => 'Precondition Failed',
		413 => 'Request Entity Too Large',
		414 => 'Request-URI Too Long',
		415 => 'Unsupported Media Type',
		416 => 'Requested Range Not Satisfiable',
		417 => 'Expectation Failed',
		500 => 'Internal Server Error',
		501 => 'Not Implemented',
		502 => 'Bad Gateway',
		503 => 'Service Unavailable',
		504 => 'Gateway Timeout',
		505 => 'HTTP Version Not Supported',
	);

	/**
	 * API root
	 */
	public function actionIndex()
	{
		$this->render('index');
	}

	/**
	 * Read (view) resource
	 * @param $resource
	 * @param $id
	 */
	public function actionRead($resource, $id)
	{
		if (!$service = $this->getService($resource)) {
			return $this->sendResponse(400);
		}
		if ($resource_object = $service->findById($id)) {
			return $this->sendResponse(200, (string) $resource_object);
		} else {
			return $this->sendResponse(404);
		}
	}

	/**
	 * Read (view) previous version of resource
	 * @param $resource
	 * @param $id
	 * @param $vid
	 */
	public function actionVread($resource, $id, $vid)
	{
		// Not implemented yet
		return $this->sendResponse(501);
	}

	/**
	 * Update resource
	 * @param $resource
	 * @param $id
	 */
	public function actionUpdate($resource, $id)
	{
		$this->render('update');
	}

	/**
	 * Delete resource
	 * @param $resource
	 * @param $id
	 */
	public function actionDelete($resource, $id)
	{
		$this->render('delete');
	}

	/**
	 * Create resource
	 * @param $resource
	 */
	public function actionCreate($resource)
	{
		$this->render('create');
	}

	/**
	 * Search for resource(s)
	 * @param $resource
	 */
	public function actionSearch($resource)
	{
		if (!$service = $this->getService($resource)) {
			return $this->sendResponse(404);
		}
		$body = '';
		if ($resource_objects = $service->getList()) {
			foreach ($resource_objects as $resource_object) {
				if ($body) {
					$body .= ', ';
				}
				$body .= $resource_object;
			}
		}
		$this->sendResponse(200, ' [ ' . $body . ' ] ');
	}

	public function actionBadRequest()
	{
		$this->sendResponse(400);
	}

	/**
	 * Get service for resource
	 * @param $resource
	 * @return OEService
	 */
	protected function getService($resource)
	{
		if (isset($this->services[$resource])) {
			return new $this->services[$resource];
		}
	}

	/**
	 * Send response
	 * @param $status
	 * @param string $body
	 * @param string $content_type
	 */
	protected function sendResponse($status, $body = '', $content_type = 'application/json')
	{
		header('HTTP/1.1 ' . $status . ' ' . $this->getStatusCodeMessage($status));
		header('Content-type: ' . $content_type);
		echo $body;
		Yii::app()->end();
	}

	/**
	 * Get message for status code
	 * @param $code
	 * @return string
	 */
	protected function getStatusCodeMessage($code)
	{
		if (isset($this->status_codes[$code])) {
			return $this->status_codes[$code];
		}
	}

}
