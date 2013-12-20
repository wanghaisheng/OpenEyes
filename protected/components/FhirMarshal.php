<?php

/**
 * Marshals and unmarshals OpenEyes objects to and from FHIR format.
 * 
 * Both XML and JSON are catered for.
 */
class FhirMarshal {

	/** Name for OpenEyes internal ID mapping for identifier elements. */
	public static $OEID = 'OEID';

	/** Name for mapping for NHS numbers. */
	public static $NHS = 'NHS';

	/** Name for OpenEyes internal ID mapping for identifier elements. */
	public static $CRN = 'PI';

	/** XML marshalling utilities. */
	private $fhirXml;

	/** JSON marshalling utilities. */
	private $fhirJson;

	/**
	 * 
	 */
	public function __construct() {
		$this->fhirXml = new FhirXmlUtil();
		$this->fhirJson = new FhirJsonUtil();
	}

	/**
	 * Attempts to marshal the given OpenEyes object into a FHIR object.
	 * 
	 * @param type $object the object to transform.
	 * 
	 * @param type $type one of 'xml' or 'json'.
	 * 
	 * @return string an appropriate string of the object's representation in
	 * FHIR format.
	 */
	public function marshal($object, $format = 'json') {
		$data = null;
		if ($object instanceof Patient) {
			if ($format == 'json') {
				$data = $this->fhirJson->oe_to_json($object);
			} else {
				$xml = $this->fhirXml->oe_to_xml($object);
				if ($xml !== null) {
					$data = $xml->asXML();
				}
			}
		}
		return $data;
	}

	/**
	 * Unmarshal the string data from FHIR format to an OpenEyes object
	 * instance.
	 * 
	 * @param mixed $data the non-null data to convert; if an array, assumed to
	 * be JSON data; else considered to be XML (callers should be sure to
	 * call json_decode($data, true) to ensure that data is unmarshalled from
	 * an associative JSON array).
	 * 
	 * @return an array of OE object instances transformed from the source data.
	 * The empty array is returned if there were no objects.
	 */
	public function unmarshal($data) {
		$ret = array();
		if ($data instanceof Exception) {
			$ret = $data;
		}
		if ($data != null && is_array($data)) {
			// it's JSON
			$ret = $this->fhirJson->json_to_oe($data, true);
		} else if ($data) {
			// it's XML
			$ret = $this->fhirXml->xml_to_oe($data);
		}
		return $ret;
	}

}

?>
