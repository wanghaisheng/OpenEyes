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
class ApiController extends CController {

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
	public function actionIndex() {
		$this->render('index');
	}
	
	/**
	 * Read the specified resource, if it exists.
	 * 
	 * @return int 200 if the resources exists; otherwise, 404 for a non-existant
	 * resource, or 400 for an unsupported resource.
	 */
	public function actionRead() {
		$resource = $_GET['resource'];
		$id = $_GET['id'];
		if (!$service = $this->getService($resource)) {
			return $this->sendResponse(400);
		}
		if ($resource_object = $service->findById($id)) {
			$fhirMarshal = new FhirMarshal();
			$data = $fhirMarshal->marshal($resource_object, 'json');
			return $this->sendResponse(200, (string) $data);
		} else {
			// TODO - deleted resources should return 410:
			return $this->sendResponse(404);
		}
	}

	/**
	 * Read (view) previous version of resource
	 * @param $resource
	 * @param $id
	 * @param $vid
	 */
	public function actionVread() {
		// Not implemented yet
		return $this->sendResponse(501, $this->status_codes[501]);
	}

	/**
	 * Update resource; note that if the resource does not exist, it is NOT
	 * created.
	 * 
	 * FHIR specification states the following return codes are used:
	 * - 400 Bad Request - resource could not be parsed or failed basic FHIR
	 *	 validation rules;
	 * - 404 Not Found - resource type not supported, or not a FHIR end point
	 * - 405 Method Not allowed - the resource did not exist prior to the update,
	 *   and the serer does not allow client defined ids;
	 * - 409/412 - version conflict management - see above
	 * - 422 Unprocessable Entity - the proposed resource violated applicable
	 *   FHIR profiles or server business rules. This should be accompanied by
	 *   an OperationOutcome resource providing additional detail
	 * 
	 */
	public function actionUpdate() {
		$resource = $_GET['resource'];
		$id = $_GET['id'];
		if (!$service = $this->getService($resource)) {
			// resource not supported:
			return $this->sendResponse(404, $this->status_codes[404]);
		}
		$contents = file_get_contents("php://input");
		$json = json_decode($contents, true);
		if (!is_array($json)) {
			// error parsing json - 400 error:
			return $this->sendResponse(400, $this->status_codes[400]);
		}
		// get some headers ready (same for update/create):
		$location = $_SERVER['SERVER_NAME']
						. "/" . $resource . "/" . $id;
		$headers = array('Location' => $location, 'Content-Location' => $location);
		// if the patient does exist, it's an update:
		if ($resource_object = $service->findById($id)) {
			$resource_object = $service->update($id, $json);
			// http://www.hl7.org/implement/standards/fhir/http.html#update specifies
			// the headers we need to update:
			$headers['Last-Modified'] = $resource_object->last_modified_date;
			return $this->sendResponse(200, $this->status_codes[200], $headers);
		} else {
			// it's a create - 404, no end point:
			return $this->sendResponse(404, $this->status_codes[404]);
		}
	}

	/**
	 * Delete resource.
	 * 
	 * TODO currently not supported.
	 */
	public function actionDelete() {
		return $this->sendResponse(405, $this->status_codes[405]);
	}

	/**
	 * Create the resource.
	 * 
	 * @return int one of the following status codes:
	 * - 400 Bad Request - resource could not be parsed or failed basic FHIR validation rules
	 * - 404 Not Found - resource type not supported, or not a FHIR end point
	 * - 422 Unprocessable Entity - the proposed resource violated applicable FHIR profiles or server business rules. This should be accompanied by an OperationOutcome resource providing additional detail
	 */
	public function actionCreate() {
		$resource = $_GET['resource'];
		if (!$service = $this->getService($resource)) {
			return $this->sendResponse(404, $this->status_codes[404]);
		}
		$contents = file_get_contents("php://input");
		$json = json_decode($contents, true);
		if (!is_array($json)) {
			// error parsing json - 400 error:
			return $this->sendResponse(400, $this->status_codes[400]);
		}
		if ($resource_object = $service->create($json)) {
			$location = $_SERVER['SERVER_NAME']
							. "/" . $resource . "/" . $resource_object->id;
			$headers = array('Location' => $location);
			return $this->sendResponse(200, $this->status_codes[200], $headers);
		} else {
			return $this->sendResponse(404, $this->status_codes[404]);
		}
	}

	/**
	 * Search for resource(s).
	 * 
	 * TODO THIS IS NOT CORRECT - the API specifies that a bundle is returned
	 * for a valid search; ALSO, the suggested OperationOutcomes have not been
	 * catered for.
	 * See http://www.hl7.org/implement/standards/fhir/http.html#search for
	 * more information
	 */
	public function actionSearch() {
		$resource = $_GET['resource'];
		if (!$service = $this->getService($resource)) {
			return $this->sendResponse(404);
		}
		$body = '';
		$search_params = $_GET;
		$fhirMarshal = new FhirMarshal();
		unset($search_params['resource']);
		if ($resource_objects = $service->search($search_params)) {
			foreach ($resource_objects as $resource_object) {
				if ($body) {
					$body .= ', ';
				}
				$body .= $fhirMarshal->marshal($resource_object);
			}
		}
		$this->sendResponse(200, ' [ ' . $body . ' ] ');
	}

	public function actionBadRequest() {
		$this->sendResponse(400);
	}

	/**
	 * Get service for resource
	 * @param $resource
	 * @return OEService
	 */
	protected function getService($resource) {
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
	protected function sendResponse($status, $body = '', $headers = array(), $content_type = 'application/json') {
		header('HTTP/1.1 ' . $status . ' ' . $this->getStatusCodeMessage($status));
		header('Content-type: ' . $content_type);
		foreach ($headers as $header => $content) {
			header($header . ': ' . $content);
		}
		echo $body;
		Yii::app()->end();
	}

	/**
	 * Get message for status code
	 * @param $code
	 * @return string
	 */
	protected function getStatusCodeMessage($code) {
		if (isset($this->status_codes[$code])) {
			return $this->status_codes[$code];
		}
	}

}
