<?php

/**
 * Marshals and unmarshals OpenEyes objects to and from FHIR XML format.
 */
class FhirXmlUtil {

	/**
	 * Transforms an OE object instance in to a representation in FHIR XML.
	 * 
	 * @param type $object a non-null instance of an OE object.
	 * 
	 * @return \SimpleXMLElement
	 */
	public function oe_to_xml($object) {
		$xml = null;
		if ($object instanceof Patient) {
			$xml = $this->patient_to_xml($object);
		}
		return $xml;
	}

	/**
	 * Takes an XML fragment and attempts to parse it in to an OpenEyes object
	 * instance.
	 * 
	 * TODO this needs attention; before knowwing about ATOM format, patients
	 * were returned from the PAS as a FHIR 'contained' list. This will soon
	 * change.
	 * 
	 * @param string $xml XML in FHIR format to parse.
	 * 
	 * @return array an array of OE objects; if there were no objects, the empty
	 * array is returned; if there were any errors with loading the XML,
	 * false is returned.
	 */
	public function xml_to_oe($xml) {
		$patients = array();
		$xmlList = simplexml_load_string($xml);
		if ($xmlList !== false) {
			foreach ($xmlList->children("fhir", $is_prefix = true) as $entity) {
				$item = $entity->getName();
				if ($item == 'contained') {
					// TODO for some reason, if there are more than one element in the returned
					// list, the sources add 'xml-fragment' element, adding one to the node
					// depth. Check here and correct:
					$item = $entity->children("fhir", $is_prefix = true)->getName();
					$entity = $entity->children("fhir", $is_prefix = true);
				}
				if ($item === 'Patient') {
					$p = $this->xml_to_patient($entity);
					array_push($patients, $p);
				}
			}
		}
		return $xmlList === false ? false : $patients;
	}

	/**
	 * Transform an XML FHIR patient in to an OpenEyes Patient instance.
	 * 
	 * @param \SimpleXml $xmlPatient the patient to parse.
	 * 
	 * @return \Patient an OE patient instance; if the XML contained no meaningful
	 * data, null is returned.
	 */
	public function xml_to_patient($xmlPatient) {

		$p = new Patient();
		$isset = false;
		foreach ($xmlPatient->children("fhir", $is_prefix = true)->identifier as $id) {
			if ($id->label->attributes()->value == FhirMarshal::$CRN) {
				$p->hos_num = (string) $id->value->attributes()->value;
				$isset = true;
			} else if ($id->label->attributes()->value == FhirMarshal::$NHS) {
				$p->nhs_num = (string) $id->value->attributes()->value;
				$isset = true;
			} else if ($id->label->attributes()->value == FhirMarshal::$OEID) {
				$p->id = (string) $id->value->attributes()->value;
				$isset = true;
			}
		}
		if (isset($xmlPatient->children("fhir", $is_prefix = true)->birthDate->attributes()->value)) {
			$dob = (string) $xmlPatient->children("fhir", $is_prefix = true)->birthDate->attributes()->value;
			$p->dob = $dob;
			$isset = true;
		}
		$gender = $this->getValue($xmlPatient, 'gender', 'text');
		if ($gender) {
			$p->gender = $gender;
			$isset = true;
		}

		if ($xmlPatient->children("fhir", $is_prefix = true)->name) {
			$c = new Contact();
			$p->contact = $c;
			$familyName = $this->getValue($xmlPatient, 'name', 'family');
			if ($familyName) {
				$c->last_name = $familyName;
				$isset = true;
			}
			$givenName = $this->getValue($xmlPatient, 'name', 'given');
			if (isset($givenName)) {
				$c->first_name = $givenName;
				$isset = true;
			}
			$telephone = $this->getValue($xmlPatient, 'telecom', 'value');
			if (isset($telephone)) {
				$c->primary_phone = $telephone;
				$isset = true;
			}
			$title = $this->getValue($xmlPatient, 'name', 'prefix');
			if (isset($title)) {
				$c->title = $title;
				$isset = true;
			}
		}

		if ($xmlPatient->children("fhir", $is_prefix = true)->address) {
			$a = new Address();
			$city = $this->getValue($xmlPatient, 'address', 'city');
			if (isset($city)) {
				$a->city = $city;
			}
			$county = $this->getValue($xmlPatient, 'address', 'state');
			if (isset($county)) {
				$a->county = $county;
				$isset = true;
			}
			$postcode = $this->getValue($xmlPatient, 'address', 'zip');
			if (isset($postcode)) {
				$a->postcode = $postcode;
				$isset = true;
			}
			if (isset($xmlPatient->children("fhir", $is_prefix = true)->address)) {
				if (isset($xmlPatient->children("fhir", $is_prefix = true)->address->line[0])) {
					$address1 = (string) $xmlPatient->children("fhir", $is_prefix = true)->address->line[0]->attributes()->value;
					$a->address1 = $address1;
					$isset = true;
				}
				if (isset($xmlPatient->children("fhir", $is_prefix = true)->address->line[1])) {
					$address2 = (string) $xmlPatient->children("fhir", $is_prefix = true)->address->line[1]->attributes()->value;
					$a->address2 = $address2;
					$isset = true;
				}
			}
			if ($c && $a) {
				$a->parent_class = 'Contact';
				$a->contact = $c;
			}
			$a->country_id = 1;
		}
		if (!$isset) {
			$p = null;
		}
		return $p;
	}

	/**
	 * Take the given XML instance and transform it to a formatted
	 * 
	 * @param \SimpleXml $simpleXml
	 * 
	 * @param bool $format true to format the output; false otherwise.
	 * 
	 * @return string the stringified version of the given XML.
	 */
	public function toString($simpleXml, $format = true) {

		$dom = dom_import_simplexml($simpleXml)->ownerDocument;
		$dom->formatOutput = $format;
		return $dom->saveXML();
	}

	/**
	 * Transform a patient to FHIR XML.
	 * 
	 * The patient's internal OpenEyes ID is mapped to the identifier with the
	 * label 'OEID'.
	 * 
	 * @param \Patient $patient the non-null patient to transform to XML.
	 * 
	 * @return \SimpleXMLElement giving the patient's data.
	 */
	private function patient_to_xml($patient) {
		$xml = new SimpleXMLElement("<Patient></Patient>");
		$xml->addAttribute("xmlns", "http://hl7.org/fhir");
		// TODO this is PAS-specific (UHW) code for the identifiers;
		// TODO make configurable
		$this->addIdentifiers(array(FhirMarshal::$NHS => $patient->nhs_num,
				FhirMarshal::$CRN => $patient->hos_num, FhirMarshal::$OEID => $patient->id), $xml);
		if (isset($patient->contact)) {
			$this->addName($patient, $xml);
			$this->addTelecoms(array('phone' => $patient->contact->primary_phone), $xml);
		}
		if (isset($patient->address)) {
			$this->addAddress($patient->address, $xml);
		}
		$this->addGender($patient->gender, $patient->getGenderString(), $xml);
		$this->addChild($xml, 'birthDate', 'value', $patient->dob);
		return $xml;
	}

	/**
	 * Get the 'value' node from an XML fragment.
	 * 
	 * @param \SimpleXml $xmlPatient an XML patient instance.
	 * 
	 * @param string $parent the first element from the main patient instance
	 * to interrogate.
	 * 
	 * @param string $child the child element to get the 'value' from.
	 * 
	 * @return string the test of the child element named 'value'; if this could
	 * not be obtained, null is returned.
	 */
	private function getValue($xmlPatient, $parent, $child) {
		$p = null;
		try {
			if (isset($xmlPatient->children("fhir", $is_prefix = true)->$parent)) {
				if (isset($xmlPatient->children("fhir", $is_prefix = true)->$parent->$child)) {
					$p = (string) $xmlPatient->children("fhir", $is_prefix = true)->$parent->$child->attributes()->value;
				}
			}
		} catch (Exception $e) {
			// nothing to do
		}
		return $p;
	}

	/**
	 * Add an OE patient name to the specified XML node. The patient's first
	 * name, last name and title are added to the nodes 'given', 'family'
	 * and 'prefix', respectively.
	 * 
	 * @param \Patient $patient the non-null patient to add the name from.
	 * 
	 * @param \SimpleXml $node the node to add FHIR-format naming rules.
	 */
	private function addName($patient, $node) {
		if ($patient->contact) {
			$name = $node->addChild('name');
			$this->addChild($name, 'use', 'value', 'official');
			if ($fullName = $patient->getFullName()) {
				$this->addChild($name, 'text', 'value', $fullName);
			}
			if ($patient->last_name) {
				$this->addChild($name, 'family', 'value', $patient->last_name);
			}
			if ($patient->first_name) {
				$this->addChild($name, 'given', 'value', $patient->first_name);
			}
			if ($patient->title) {
				$this->addChild($name, 'prefix', 'value', $patient->title);
			}
		}
	}

	/**
	 * Adds an OE patient address to a FHIR-format address. The address
	 * is marked as a 'home' address via the 'use' element.
	 * 
	 * @param \Address $address the non-null address to transform.
	 * 
	 * @param \SimpleXml $node the node to add the address element to.
	 */
	private function addAddress($address, $node) {
		$name = $node->addChild('address');
		$this->addChild($name, 'use', 'value', 'home');
		if ($address->getLetterLine()) {
			$this->addChild($name, 'text', 'value', $address->getLetterLine());
		}
		if ($address->address1) {
			$this->addChild($name, 'line', 'value', $address->address1);
		}
		if ($address->address2) {
			$this->addChild($name, 'line', 'value', $address->address2);
		}
		if ($address->city) {
			$this->addChild($name, 'city', 'value', $address->city);
		}
		if ($address->county) {
			$this->addChild($name, 'state', 'value', $address->county);
		}
		if ($address->postcode) {
			$this->addChild($name, 'zipcode', 'value', $address->postcode);
		}
		if ($address->country) {
			$this->addChild($name, 'country', 'value', $address->country->name);
		}
	}

	/**
	 * Add the specified FHIR-format identifiers to the specified node.
	 * 
	 * @param array $numbers an associative array of IDs types, in the format
	 * 'type' => 'number', for example 'crn' => '123456'
	 * 
	 * @param \SimpleXml $node the node to add the identifiers to.
	 */
	private function addIdentifiers($numbers, $node) {
		foreach ($numbers as $type => $id) {
			if (isset($id)) {
				$ids = $node->addChild('identifier');
				$this->addChild($ids, 'label', 'value', $type);
				$this->addChild($ids, 'use', 'value', 'official');
				$this->addChild($ids, 'value', 'value', $id);
			}
		}
	}

	/**
	 * Add phone information to the specified node, in FHIR-format.
	 * 
	 * @param array $numbers an associative array of phone types, in the format
	 * 'type' => 'number', for example 'home' => '123456'
	 * 
	 * @param \SimpleXml $node the node to add the number to.
	 */
	private function addTelecoms($numbers, $node) {
		foreach ($numbers as $type => $phone) {
			if (isset($phone)) {
				$telecoms = $node->addChild('telecom');
				$this->addChild($telecoms, 'system', 'value', 'phone');
				$this->addChild($telecoms, 'use', 'value', $type);
				$this->addChild($telecoms, 'value', 'value', $phone);
			}
		}
	}

	/**
	 * Adds the gender in FHIR-format.
	 * 
	 * @param string $gender_char the gender as a character: one of 'm' or 'f'.
	 * 
	 * @param string $gender_string text version of the gender, e.g. 'female'.
	 * 
	 * @param \SimpleXml $node the node to add the gender to.
	 */
	private function addGender($gender_char, $gender_string, $node) {
		if (isset($gender_char)) {
			$gender = $node->addChild('gender');
			$coding = $gender->addChild('coding');
			$this->addChild($coding, 'system', 'value', 'http://hl7.org/fhir/v3/AdministrativeGender');
			$this->addChild($coding, 'code', 'value', $gender_char);
			$this->addChild($coding, 'value', 'display', $gender_string);
		}
	}

	/**
	 * Adds a child node to the specified node.
	 * 
	 * @param type $node the node to add the child to.
	 * 
	 * @param type $nodeName the name of the new node.
	 * 
	 * @param type $attr the name of the attribute of the node.
	 * 
	 * @param type $value the actual value of the attribute.
	 */
	private function addChild($node, $nodeName, $attr, $value) {
		if (isset($value)) {
			$child = $node->addChild($nodeName);
			$child->addAttribute($attr, $value);
		}
	}

}

?>
