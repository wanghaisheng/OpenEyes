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

class PatientService extends OEService {

	/**
	 * Find the specified patient by OpenEyes ID.
	 * 
	 * @param int $id the OpenEyes ID of the patient to be found.
	 * 
	 * @return \Patient the patient, if it was found; null otherwise.
	 */
	public function findById($id) {
		Yii::import('application.resources.*');
		if ($patient = Patient::model()->findByPk($id)) {
			return $patient;
		}
	}
	
	/**
	 * Create the patient with the specified contents.
	 * 
	 * @param int $contents JSON encoded (associative array) data.
	 * 
	 * @return \Patient the patient, if it could be created.
	 */
	public function create($contents) {
		$fhirMarshal = new FhirMarshal();
		$p = $fhirMarshal->unmarshal($contents);
		$p->save();
		return $p;
	}

	/**
	 * Update the patient with the specified ID and JSON-encoded data (associative
	 * array).
	 * 
	 * @param int $id
	 * 
	 * @param array $contents a JSON encoded associative array.
	 * 
	 * @return \Patient the patient, if it could be updated (and was found);
	 * null otherwise.
	 */
	public function update($id, $contents) {
		$patient = Patient::model()->findByPk($id);
		if ($patient) {
			$fhirMarshal = new FhirMarshal();
			$p = $fhirMarshal->unmarshal($contents);
			if ($p && count($p) == 1) {
				$newPatient = $p[0];
				// TODO need a convincing clone() call or copy method.
				if ($newPatient->nhs_num) {
					$patient->nhs_num = $newPatient->nhs_num;
				}
				if ($newPatient->hos_num) {
					$patient->hos_num = $newPatient->hos_num;
				}
				if ($newPatient->dob) {
					$patient->dob = $newPatient->dob;
				}
				if ($newPatient->gender) {
					$patient->gender = $newPatient->gender;
				}
				if ($newPatient->contact) {
					if (!$patient->contact) {
						$patient->contact = new Contact();
					}
					if ($newPatient->contact->first_name) {
						$patient->contact->first_name = $newPatient->contact->first_name;
					}
					if ($newPatient->contact->last_name) {
						$patient->contact->last_name = $newPatient->contact->last_name;
					}
					if ($newPatient->contact->title) {
						$patient->contact->title = $newPatient->contact->title;
					}
					$patient->contact->save();
				}

				if (isset($newPatient->contact) && isset($newPatient->contact->address)) {
					if (!isset($patient->contact->address)) {
						$patient->contact->address = new Address();
					}
					if ($newPatient->contact->address->address1) {
						$patient->contact->address->address1 = $newPatient->contact->address->address1;
					}
					if ($newPatient->contact->address->address2) {
						$patient->contact->address->address2 = $newPatient->contact->address->address2;
					}
					if ($newPatient->contact->address->city) {
						$patient->contact->address->city = $newPatient->contact->address->city;
					}
					if ($newPatient->contact->address->county) {
						$patient->contact->address->county = $newPatient->contact->address->county;
					}
					if ($newPatient->contact->address->postcode) {
						$patient->contact->address->postcode = $newPatient->contact->address->postcode;
					}
					if ($patient->contact) {
						$patient->contact->address->parent_class = 'Contact';
						$patient->contact->address->parent_id = $patient->contact->id;
						$patient->contact->address->country_id = 1;
						$patient->contact->address->save();
					}
				}
				// TODO other attributes?
				$patient->save();
			}
			return $patient;
		}
	}
	
	/**
	 * Search for the specified patient. Note that since this method works on key
	 * - value pairs, searches cannot yet be performed on contact or address.
	 * 
	 * @param array $params an array of key => value pairs.
	 * 
	 * @return array an array of patients, if they could be found.
	 */
	public function search($params) {
		$criteria = new CDbCriteria();
		foreach($params as $key => $value) {
			$criteria->addCondition($key . '=:' . $key);
			$criteria->params[':' . $key] = $value;
		}
		return Patient::model()->findAll($criteria);
	}

}