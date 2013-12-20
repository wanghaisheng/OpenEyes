<?php
/**
 * Marshals and unmarshals OpenEyes objects to and from FHIR JSON format.
 */
class FhirJsonUtil {
	
	/**
	 * Take an OE instance and turn it to FHIR JSON, if supported.
	 * 
	 * @param type $object the object to turn into a FHIR JSON representation.
	 * 
	 * @return JSON if the object could be converted; null otherwise.
	 */
	public function oe_to_json($object) {
		$json_data = null;
		if ($object instanceof Patient) {
			$patient = $object;
			$json_data = rtrim($this->patient_to_json($patient), ",");
			$json_data .= "}";
		}
		if ($json_data) {
			$json_data = rtrim($json_data, ",");
			$json_data .= "}";
		}
		return $json_data;
	}

	/**
	 * Convert an OE patient in to a (FHIR) JSON patient.
	 * 
	 * The patient's internal OpenEyes ID is mapped to the identifier with the
	 * label 'OEID'.
	 * 
	 * @param \Patient $patient the non-null patient to transform.
	 * 
	 * @return string a patient in FHIR JSON format.
	 */
	public function patient_to_json($patient) {

		$json_data = "{\"Patient\":{";
		if ($patient->contact && $patient->contact->address) {
			$json_data .= "\"address\": [{";
			$address = $patient->contact->address;
			if ($address->address1 || $address->address2) {
				// the address element is an array for FHIR:
				$json_data .= "\"line\":[";
				if ($address->address1) {
					$json_data .=  "\"" . $address->address1 . "\",";
				}
				if ($address->address1) {
					$json_data .= "\"" . $address->address2 . "\",";
				}
				$json_data = rtrim($json_data, ",");
				$json_data .= "],";
			}
			if ($address->city) {
				$json_data .= "\"city\": \"" . $address->city . "\",";
			}
			if ($address->county) {
				$json_data .= "\"state\": \"" . $address->county . "\",";
			}
			if ($address->postcode) {
				$json_data .= "\"zip\": \"" . $address->postcode . "\",";
			}
			$json_data = rtrim($json_data, ",");
			$json_data .= "}],";
		}
		if ($patient->contact) {
			$json_data .= "\"name\":[{";
			if ($patient->contact->first_name) {
				$json_data .= "\"given\": \"" . $patient->contact->first_name . "\",";
			}
			if ($patient->contact->last_name) {
				$json_data .= "\"family\": \"" . $patient->contact->last_name . "\",";
			}
			if ($patient->contact->title) {
				$json_data .= "\"prefix\": \"" . $patient->contact->title . "\",";
			}
			$json_data = rtrim($json_data, ",");
			$json_data .= "}],";
			// \"telecom\": [ {\"system\": \"phone\",\"value\": \"5555 6473\",\"use\": \"home\"}]
			if ($patient->contact->primary_phone) {
				$json_data .= "\"telecom\": [ {\"system\": \"phone\",\"value\": \""
				. $patient->contact->primary_phone . "\",\"use\": \"home\"}]";
			}
		}
		if ($patient->dob) {
			$json_data .= "\"birthDate\": \"" . $patient->dob . "\"";
			$json_data = rtrim($json_data, ",");
			$json_data .= ",";
		}
		if ($patient->gender) {
			$json_data .= "\"gender\": {\"coding\": [{"
							. "\"code\": " . "\"" . $patient->gender . "\"}]}";
			$json_data = rtrim($json_data, ",");
			$json_data .= ",";
		}
		$json_data .= "\"identifier\":[";
		if ($patient->nhs_num) {
			$json_data .= "{\"use\": official\",";
			$json_data .= "\"label\": " . FhirMarshal::$NHS . "\",";
			$json_data .= "\"value\": \"" . $patient->nhs_num . "\"},";
		}
		if ($patient->hos_num) {
			$json_data .= "{\"use\": official\",";
			$json_data .= "\"label\": " . FhirMarshal::$CRN . "\",";
			$json_data .= "\"value\": \"" . $patient->hos_num . "\"},";
		}
		$json_data .= "{\"use\": official\",";
		$json_data .= "\"label\": " . FhirMarshal::$OEID . "\",";
		$json_data .= "\"value\": \"" . $patient->id . "\"},";
		$json_data = rtrim($json_data, ",");
		$json_data .= "]"; // end identifier
		$json_data .= "}";
		return $json_data;
	}

	/**
	 * 
	 * Convert JSON data to OE object instances, if possible. Currently only
	 * supports patient conversion from JSON data.
	 * 
	 * TODO issues with the server returning a collection of 1 or more than 1
	 * objects; not sure why but the transformed JSON is different for each.
	 * This will be rectified soon when bundles are implemented.
	 * 
	 * @param array $json_data a JSON-decoded associative array.
	 * 
	 * @return array an array of OE instance objects; if there were no objects
	 * in the JSON, the empty array is returned.
	 */
	public function json_to_oe($json_data) {
		$entities = array();
		// TODO - returning list of 1 vs 2 patients does something weird to the
		// XML and therefore the resulting JSON. Needs investigating
		if (isset($json_data['xml-fragment'])) {
			$json_entities = $json_data["xml-fragment"]["contained"];
		} else if (isset($json_data['contained'])) {
			$json_entities = $json_data["contained"];
		} else {
			$json_entities = array();
			array_push($json_entities, $json_data);
		}
		foreach ($json_entities as $entity) {
			// TODO - same issue, returning list of 1 vs 2 patients does 
			// something weird to the XML and therefore the resulting JSON. Needs
			// investigating
			if (isset($entity['Patient'])) {
				array_push($entities, $this->json_to_patient($entity));
			}
		}
		return $entities;
	}

	/**
	 * Create an OE patient from the specified JSON.
	 * 
	 * @param \Patient $patient string data representing a FHIR patient object.
	 * 
	 * @return \Patient a patient if it could be constructed; null otherwise.
	 */
	public function json_to_patient($patient) {
		$patient = $patient['Patient'];
		$isset = false;
		$p = new Patient();
		if (isset($patient['telecom'])) {
			$c = new Contact();
			foreach($patient['telecom'] as $phone) {
				if ($phone['use'] === 'home' && isset($phone['value'])) {
					$c->primary_phone = $phone['value'];
					$isset = true;
				}
			}
		}
		if (isset($patient['name'])) {
			if (!isset($c)) {
				$c = new Contact();
			}
			$names = $patient['name'];
			foreach($names as $name) {
				if (isset($name['given'])) {
					$c->first_name = $name['given'];
					$isset = true;
				}
				if (isset($name['family'])) {
					$c->last_name = $name['family'];
					$isset = true;
				}
				if (isset($name['prefix'])) {
					$c->title = $name['prefix'];
					$isset = true;
				}
			}
		}
		if (isset($c)) {
			$p->contact = $c;
		}
		if (isset($patient['address'])) {
			$a = new Address();
			$addresses = $patient['address'];
			foreach($addresses as $address) {
				if (isset($address['zip'])) {
					$a->postcode = $address['zip'];
					$isset = true;
				}
				if (isset($address['state'])) {
					$a->county = $address['state'];
					$isset = true;
				}
				if (isset($address['line'])) {
					$line = $address['line'];
					if (count($line) > 0) {
						$a->address1 = $line[0];
						$isset = true;
					}
					if (count($line) > 1) {
						$a->address2 = $line[1];
						$isset = true;
					}
				}
				if (isset($address['city'])) {
					$a->city = $address['city'];
					$isset = true;
				}
			}
			if (isset($c)) {
				$a->parent_class = 'Contact';
//				$a->parent_id = $c->id;
				$p->contact->address = $a;
			}
			$a->country_id = 1;
		}
		if (isset($patient['gender'])) {
			$p->gender = $patient['gender']['coding'][0]['code'];
			$isset = true;
		}
		if (isset($patient['birthDate'])) {
			$p->dob = $patient['birthDate'];
			$isset = true;
		}
		if (isset($patient['identifier'])) {
			$identifiers = $patient['identifier'];
			foreach ($identifiers as $identifier) {
				if ($identifier['label'] == FhirMarshal::$NHS) {
					$p->nhs_num = $identifier['value'];
					$isset = true;
				} else if ($identifier['label'] == FhirMarshal::$CRN) {
					$p->hos_num = $identifier['value'];
					$isset = true;
				} else if ($identifier['label'] == FhirMarshal::$OEID) {
					// this is the actual patient's (internal to OE) ID:
					$p->id = $identifier['value'];
					$isset = true;
				}
			}
		}
		if (!$isset) {
			$p = null;
		}
		return $p;
	}

}

?>
