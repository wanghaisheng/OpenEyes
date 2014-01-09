<?php

class fhir_patient {
  /** fhir_boolean */
  public $active;
  /** array() of fhir_address */
  public $address;
  /** fhir_patientAnimal */
  public $animal;
  /** fhir_dateTime */
  public $birthDate;
  /** array() of fhir_resourceReference */
  public $careProvider;
  /** array() of fhir_codeableConcept */
  public $communication;
  /** array() of fhir_patientContact */
  public $contact;
  /** fhir_boolean */
  public $deceasedBoolean;
  /** fhir_dateTime */
  public $deceasedDateTime;
  /** fhir_codeableConcept */
  public $gender;
  /** array() of fhir_identifier */
  public $identifier;
  /** array() of fhir_patientLink */
  public $link;
  /** fhir_resourceReference */
  public $managingOrganization;
  /** fhir_codeableConcept */
  public $maritalStatus;
  /** fhir_boolean */
  public $multipleBirthBoolean;
  /** fhir_integer */
  public $multipleBirthInteger;
  /** array() of fhir_humanName */
  public $name;
  /** array() of fhir_attachment */
  public $photo;
  /** array() of fhir_contact */
  public $telecom;
}

class fhir_resource {
  /** array() of fhir_resourceInline */
  public $contained;
  /** fhir_code */
  public $language;
  /** fhir_narrative */
  public $text;
}

class fhir_backboneElement {
  /** array() of fhir_extension */
  public $modifierExtension;
}

class fhir_element {
  /** array() of fhir_extension */
  public $extension;
  /** string */
  public $id;
}

class xmlComplexContentImpl {
}

class xmlObjectBase {
  /** decimal */
  public $bigDecimalValue;
  /** integer */
  public $bigIntegerValue;
  /** boolean */
  public $booleanValue;
  /** base64Binary */
  public $byteArrayValue;
  /** byte */
  public $byteValue;
  /** dateTime */
  public $calendarValue;
  /** dateTime */
  public $dateValue;
  /** double */
  public $doubleValue;
  /** stringEnumAbstractBase */
  public $enumValue;
  /** float */
  public $floatValue;
  /** gDate */
  public $GDateValue;
  /** gDuration */
  public $GDurationValue;
  /** int */
  public $intValue;
  /** anyType */
  public $listValue;
  /** long */
  public $longValue;
  /** anyType */
  public $objectValue;
  /** QName */
  public $QNameValue;
  /** short */
  public $shortValue;
  /** string */
  public $stringValue;
}

class fhir_boolean {
  /** array() of boolean */
  public $value;
}

class fhir_extension {
  /** string */
  public $url;
  /** fhir_address */
  public $valueAddress;
  /** fhir_attachment */
  public $valueAttachment;
  /** fhir_base64Binary */
  public $valueBase64Binary;
  /** fhir_boolean */
  public $valueBoolean;
  /** fhir_code */
  public $valueCode;
  /** fhir_codeableConcept */
  public $valueCodeableConcept;
  /** fhir_coding */
  public $valueCoding;
  /** fhir_contact */
  public $valueContact;
  /** fhir_date */
  public $valueDate;
  /** fhir_dateTime */
  public $valueDateTime;
  /** fhir_decimal */
  public $valueDecimal;
  /** fhir_humanName */
  public $valueHumanName;
  /** fhir_identifier */
  public $valueIdentifier;
  /** fhir_instant */
  public $valueInstant;
  /** fhir_integer */
  public $valueInteger;
  /** fhir_period */
  public $valuePeriod;
  /** fhir_quantity */
  public $valueQuantity;
  /** fhir_range */
  public $valueRange;
  /** fhir_ratio */
  public $valueRatio;
  /** fhir_resourceReference */
  public $valueResource;
  /** fhir_sampledData */
  public $valueSampledData;
  /** fhir_schedule */
  public $valueSchedule;
  /** fhir_string */
  public $valueString;
  /** fhir_uri */
  public $valueUri;
}

class fhir_address {
  /** fhir_string */
  public $city;
  /** fhir_string */
  public $country;
  /** array() of fhir_string */
  public $line;
  /** fhir_period */
  public $period;
  /** array() of fhir_string */
  public $state;
  /** fhir_string */
  public $text;
  /** fhir_addressUse */
  public $use;
  /** fhir_string */
  public $zip;
}

class fhir_string {
  /** array() of string */
  public $value;
}

class fhir_period {
  /** fhir_dateTime */
  public $end;
  /** array() of fhir_dateTime */
  public $start;
}

class fhir_dateTime {
  /** array() of dateTime */
  public $value;
}

class fhir_addressUse {
  /** array() of AddressUseListEnum_0 */
  public $value;
}

class stringEnumAbstractBase {
}

class fhir_attachment {
  /** fhir_code */
  public $contentType;
  /** fhir_base64Binary */
  public $data;
  /** fhir_base64Binary */
  public $hash;
  /** fhir_code */
  public $language;
  /** fhir_integer */
  public $size;
  /** array() of fhir_string */
  public $title;
  /** fhir_uri */
  public $url;
}

class fhir_code {
  /** array() of string */
  public $value;
}

class fhir_base64Binary {
  /** array() of base64Binary */
  public $value;
}

class fhir_integer {
  /** array() of int */
  public $value;
}

class fhir_uri {
  /** array() of string */
  public $value;
}

class fhir_codeableConcept {
  /** array() of fhir_coding */
  public $coding;
  /** fhir_string */
  public $text;
}

class fhir_coding {
  /** fhir_code */
  public $code;
  /** fhir_string */
  public $display;
  /** fhir_boolean */
  public $primary;
  /** fhir_uri */
  public $system;
  /** fhir_resourceReference */
  public $valueSet;
  /** fhir_string */
  public $version;
}

class fhir_resourceReference {
  /** fhir_string */
  public $display;
  /** fhir_string */
  public $reference;
}

class fhir_contact {
  /** fhir_period */
  public $period;
  /** fhir_contactSystem */
  public $system;
  /** fhir_contactUse */
  public $use;
  /** array() of fhir_string */
  public $value;
}

class fhir_contactSystem {
  /** array() of ContactSystemListEnum_0 */
  public $value;
}

class fhir_contactUse {
  /** array() of ContactUseListEnum_0 */
  public $value;
}

class fhir_date {
  /** array() of dateTime */
  public $value;
}

class fhir_decimal {
  /** array() of decimal */
  public $value;
}

class fhir_humanName {
  /** array() of fhir_string */
  public $family;
  /** array() of fhir_string */
  public $given;
  /** fhir_period */
  public $period;
  /** array() of fhir_string */
  public $prefix;
  /** array() of fhir_string */
  public $suffix;
  /** fhir_string */
  public $text;
  /** fhir_nameUse */
  public $use;
}

class fhir_nameUse {
  /** array() of NameUseListEnum_0 */
  public $value;
}

class fhir_identifier {
  /** fhir_resourceReference */
  public $assigner;
  /** array() of fhir_string */
  public $label;
  /** fhir_period */
  public $period;
  /** fhir_uri */
  public $system;
  /** fhir_identifierUse */
  public $use;
  /** array() of fhir_string */
  public $value;
}

class fhir_identifierUse {
  /** array() of IdentifierUseListEnum_0 */
  public $value;
}

class fhir_instant {
  /** array() of dateTime */
  public $value;
}

class fhir_quantity {
  /** fhir_code */
  public $code;
  /** fhir_quantityCompararator */
  public $comparator;
  /** fhir_uri */
  public $system;
  /** array() of fhir_string */
  public $units;
  /** array() of fhir_decimal */
  public $value;
}

class fhir_quantityCompararator {
  /** array() of QuantityCompararatorListEnum_0 */
  public $value;
}

class fhir_range {
  /** fhir_quantity */
  public $high;
  /** fhir_quantity */
  public $low;
}

class fhir_ratio {
  /** fhir_quantity */
  public $denominator;
  /** fhir_quantity */
  public $numerator;
}

class fhir_sampledData {
  /** fhir_sampledDataDataType */
  public $data;
  /** fhir_integer */
  public $dimensions;
  /** fhir_decimal */
  public $factor;
  /** fhir_decimal */
  public $lowerLimit;
  /** fhir_quantity */
  public $origin;
  /** fhir_decimal */
  public $period;
  /** fhir_decimal */
  public $upperLimit;
}

class fhir_sampledDataDataType {
  /** array() of string */
  public $value;
}

class fhir_schedule {
  /** array() of fhir_period */
  public $event;
  /** fhir_scheduleRepeat */
  public $repeat;
}

class fhir_scheduleRepeat {
  /** array() of fhir_integer */
  public $count;
  /** fhir_decimal */
  public $duration;
  /** fhir_dateTime */
  public $end;
  /** fhir_integer */
  public $frequency;
  /** array() of fhir_unitsOfTime */
  public $units;
  /** fhir_eventTiming */
  public $when;
}

class fhir_unitsOfTime {
  /** array() of UnitsOfTimeListEnum_0 */
  public $value;
}

class fhir_eventTiming {
  /** array() of EventTimingListEnum_0 */
  public $value;
}

class gDate {
}

class gDuration {
}

class fhir_patientAnimal {
  /** array() of fhir_codeableConcept */
  public $breed;
  /** fhir_codeableConcept */
  public $genderStatus;
  /** fhir_codeableConcept */
  public $species;
}

class fhir_patientContact {
  /** fhir_address */
  public $address;
  /** fhir_codeableConcept */
  public $gender;
  /** fhir_humanName */
  public $name;
  /** fhir_resourceReference */
  public $organization;
  /** array() of fhir_codeableConcept */
  public $relationship;
  /** array() of fhir_contact */
  public $telecom;
}

class fhir_patientLink {
  /** array() of fhir_resourceReference */
  public $other;
  /** fhir_linkType */
  public $type;
}

class fhir_linkType {
  /** array() of LinkTypeListEnum_0 */
  public $value;
}

class fhir_resourceInline {
  /** fhir_adverseReaction */
  public $adverseReaction;
  /** array() of fhir_alert */
  public $alert;
  /** fhir_allergyIntolerance */
  public $allergyIntolerance;
  /** fhir_binary */
  public $binary;
  /** fhir_carePlan */
  public $carePlan;
  /** fhir_composition */
  public $composition;
  /** fhir_conceptMap */
  public $conceptMap;
  /** fhir_condition */
  public $condition;
  /** fhir_conformance */
  public $conformance;
  /** fhir_device */
  public $device;
  /** fhir_deviceObservationReport */
  public $deviceObservationReport;
  /** fhir_diagnosticOrder */
  public $diagnosticOrder;
  /** fhir_diagnosticReport */
  public $diagnosticReport;
  /** fhir_documentManifest */
  public $documentManifest;
  /** fhir_documentReference */
  public $documentReference;
  /** fhir_encounter */
  public $encounter;
  /** fhir_familyHistory */
  public $familyHistory;
  /** array() of fhir_group */
  public $group;
  /** fhir_imagingStudy */
  public $imagingStudy;
  /** fhir_immunization */
  public $immunization;
  /** fhir_immunizationRecommendation */
  public $immunizationRecommendation;
  /** fhir_list */
  public $list;
  /** fhir_location */
  public $location;
  /** array() of fhir_media */
  public $media;
  /** fhir_medication */
  public $medication;
  /** fhir_medicationAdministration */
  public $medicationAdministration;
  /** fhir_medicationDispense */
  public $medicationDispense;
  /** fhir_medicationPrescription */
  public $medicationPrescription;
  /** fhir_medicationStatement */
  public $medicationStatement;
  /** fhir_messageHeader */
  public $messageHeader;
  /** fhir_observation */
  public $observation;
  /** fhir_operationOutcome */
  public $operationOutcome;
  /** array() of fhir_order */
  public $order;
  /** fhir_orderResponse */
  public $orderResponse;
  /** fhir_organization */
  public $organization;
  /** array() of fhir_other */
  public $other;
  /** fhir_patient */
  public $patient;
  /** fhir_practitioner */
  public $practitioner;
  /** fhir_procedure */
  public $procedure;
  /** fhir_profile */
  public $profile;
  /** fhir_provenance */
  public $provenance;
  /** array() of fhir_query */
  public $query;
  /** fhir_questionnaire */
  public $questionnaire;
  /** fhir_relatedPerson */
  public $relatedPerson;
  /** fhir_securityEvent */
  public $securityEvent;
  /** fhir_specimen */
  public $specimen;
  /** fhir_substance */
  public $substance;
  /** fhir_supply */
  public $supply;
  /** fhir_valueSet */
  public $valueSet;
}

class fhir_adverseReaction {
  /** fhir_dateTime */
  public $date;
  /** fhir_boolean */
  public $didNotOccurFlag;
  /** array() of fhir_adverseReactionExposure */
  public $exposure;
  /** array() of fhir_identifier */
  public $identifier;
  /** fhir_resourceReference */
  public $recorder;
  /** fhir_resourceReference */
  public $subject;
  /** array() of fhir_adverseReactionSymptom */
  public $symptom;
}

class fhir_adverseReactionExposure {
  /** fhir_causalityExpectation */
  public $causalityExpectation;
  /** fhir_dateTime */
  public $date;
  /** fhir_resourceReference */
  public $substance;
  /** fhir_exposureType */
  public $type;
}

class fhir_causalityExpectation {
  /** array() of CausalityExpectationListEnum_0 */
  public $value;
}

class fhir_exposureType {
  /** array() of ExposureTypeListEnum_0 */
  public $value;
}

class fhir_adverseReactionSymptom {
  /** fhir_codeableConcept */
  public $code;
  /** fhir_reactionSeverity */
  public $severity;
}

class fhir_reactionSeverity {
  /** array() of ReactionSeverityListEnum_0 */
  public $value;
}

class fhir_alert {
  /** fhir_resourceReference */
  public $author;
  /** fhir_codeableConcept */
  public $category;
  /** array() of fhir_identifier */
  public $identifier;
  /** fhir_string */
  public $note;
  /** fhir_alertStatus */
  public $status;
  /** fhir_resourceReference */
  public $subject;
}

class fhir_alertStatus {
  /** array() of AlertStatusListEnum_0 */
  public $value;
}

class fhir_allergyIntolerance {
  /** fhir_criticality */
  public $criticality;
  /** array() of fhir_identifier */
  public $identifier;
  /** array() of fhir_resourceReference */
  public $reaction;
  /** fhir_dateTime */
  public $recordedDate;
  /** fhir_resourceReference */
  public $recorder;
  /** array() of fhir_resourceReference */
  public $sensitivityTest;
  /** fhir_sensitivityType */
  public $sensitivityType;
  /** fhir_sensitivityStatus */
  public $status;
  /** fhir_resourceReference */
  public $subject;
  /** fhir_resourceReference */
  public $substance;
}

class fhir_criticality {
  /** array() of CriticalityListEnum_0 */
  public $value;
}

class fhir_sensitivityType {
  /** array() of SensitivityTypeListEnum_0 */
  public $value;
}

class fhir_sensitivityStatus {
  /** array() of SensitivityStatusListEnum_0 */
  public $value;
}

class fhir_binary {
  /** string */
  public $contentType;
  /** string */
  public $id;
}

class javaBase64HolderEx {
}

class javaBase64Holder {
}

class fhir_carePlan {
  /** array() of fhir_carePlanActivity */
  public $activity;
  /** array() of fhir_resourceReference */
  public $concern;
  /** array() of fhir_carePlanGoal */
  public $goal;
  /** array() of fhir_identifier */
  public $identifier;
  /** fhir_dateTime */
  public $modified;
  /** array() of fhir_string */
  public $notes;
  /** array() of fhir_carePlanParticipant */
  public $participant;
  /** fhir_resourceReference */
  public $patient;
  /** fhir_period */
  public $period;
  /** fhir_carePlanStatus */
  public $status;
}

class fhir_carePlanActivity {
  /** array() of fhir_resourceReference */
  public $actionResulting;
  /** fhir_resourceReference */
  public $detail;
  /** array() of string */
  public $goal;
  /** array() of fhir_string */
  public $notes;
  /** fhir_boolean */
  public $prohibited;
  /** fhir_carePlanSimple */
  public $simple;
  /** fhir_carePlanActivityStatus */
  public $status;
}

class fhir_carePlanSimple {
  /** fhir_carePlanActivityCategory */
  public $category;
  /** fhir_codeableConcept */
  public $code;
  /** fhir_quantity */
  public $dailyAmount;
  /** fhir_string */
  public $details;
  /** fhir_resourceReference */
  public $location;
  /** array() of fhir_resourceReference */
  public $performer;
  /** fhir_resourceReference */
  public $product;
  /** fhir_quantity */
  public $quantity;
  /** fhir_period */
  public $timingPeriod;
  /** fhir_schedule */
  public $timingSchedule;
  /** fhir_string */
  public $timingString;
}

class fhir_carePlanActivityCategory {
  /** array() of CarePlanActivityCategoryListEnum_0 */
  public $value;
}

class fhir_carePlanActivityStatus {
  /** array() of CarePlanActivityStatusListEnum_0 */
  public $value;
}

class fhir_carePlanGoal {
  /** array() of fhir_resourceReference */
  public $concern;
  /** fhir_string */
  public $description;
  /** array() of fhir_string */
  public $notes;
  /** fhir_carePlanGoalStatus */
  public $status;
}

class fhir_carePlanGoalStatus {
  /** array() of CarePlanGoalStatusListEnum_0 */
  public $value;
}

class fhir_carePlanParticipant {
  /** fhir_resourceReference */
  public $member;
  /** fhir_codeableConcept */
  public $role;
}

class fhir_carePlanStatus {
  /** array() of CarePlanStatusListEnum_0 */
  public $value;
}

class fhir_composition {
  /** array() of fhir_compositionAttester */
  public $attester;
  /** array() of fhir_resourceReference */
  public $author;
  /** fhir_codeableConcept */
  public $class1;
  /** fhir_coding */
  public $confidentiality;
  /** fhir_resourceReference */
  public $custodian;
  /** fhir_resourceReference */
  public $encounter;
  /** array() of fhir_compositionEvent */
  public $event;
  /** fhir_identifier */
  public $identifier;
  /** fhir_instant */
  public $instant;
  /** array() of fhir_compositionSection */
  public $section;
  /** fhir_compositionStatus */
  public $status;
  /** fhir_resourceReference */
  public $subject;
  /** array() of fhir_string */
  public $title;
  /** fhir_codeableConcept */
  public $type;
}

class fhir_compositionAttester {
  /** array() of fhir_compositionAttestationMode */
  public $mode;
  /** array() of fhir_resourceReference */
  public $party;
  /** fhir_dateTime */
  public $time;
}

class fhir_compositionAttestationMode {
  /** array() of CompositionAttestationModeListEnum_0 */
  public $value;
}

class fhir_compositionEvent {
  /** array() of fhir_codeableConcept */
  public $code;
  /** array() of fhir_resourceReference */
  public $detail;
  /** fhir_period */
  public $period;
}

class fhir_compositionSection {
  /** fhir_codeableConcept */
  public $code;
  /** fhir_resourceReference */
  public $content;
  /** array() of fhir_compositionSection */
  public $section;
  /** fhir_resourceReference */
  public $subject;
}

class fhir_compositionStatus {
  /** array() of CompositionStatusListEnum_0 */
  public $value;
}

class fhir_conceptMap {
  /** array() of fhir_conceptMapConcept */
  public $concept;
  /** fhir_string */
  public $copyright;
  /** fhir_dateTime */
  public $date;
  /** fhir_string */
  public $description;
  /** fhir_boolean */
  public $experimental;
  /** fhir_string */
  public $identifier;
  /** fhir_string */
  public $name;
  /** fhir_string */
  public $publisher;
  /** fhir_resourceReference */
  public $source;
  /** fhir_valueSetStatus */
  public $status;
  /** fhir_resourceReference */
  public $target;
  /** array() of fhir_contact */
  public $telecom;
  /** fhir_string */
  public $version;
}

class fhir_conceptMapConcept {
  /** fhir_code */
  public $code;
  /** array() of fhir_conceptMapDependsOn */
  public $dependsOn;
  /** array() of fhir_conceptMapMap */
  public $map;
  /** fhir_uri */
  public $system;
}

class fhir_conceptMapDependsOn {
  /** fhir_code */
  public $code;
  /** fhir_uri */
  public $concept;
  /** fhir_uri */
  public $system;
}

class fhir_conceptMapMap {
  /** fhir_code */
  public $code;
  /** fhir_string */
  public $comments;
  /** fhir_conceptMapEquivalence */
  public $equivalence;
  /** array() of fhir_conceptMapDependsOn */
  public $product;
  /** fhir_uri */
  public $system;
}

class fhir_conceptMapEquivalence {
  /** array() of ConceptMapEquivalenceListEnum_0 */
  public $value;
}

class fhir_valueSetStatus {
  /** array() of ValueSetStatusListEnum_0 */
  public $value;
}

class fhir_condition {
  /** fhir_age */
  public $abatementAge;
  /** fhir_boolean */
  public $abatementBoolean;
  /** fhir_date */
  public $abatementDate;
  /** fhir_resourceReference */
  public $asserter;
  /** fhir_codeableConcept */
  public $category;
  /** fhir_codeableConcept */
  public $certainty;
  /** fhir_codeableConcept */
  public $code;
  /** fhir_date */
  public $dateAsserted;
  /** fhir_resourceReference */
  public $encounter;
  /** array() of fhir_conditionEvidence */
  public $evidence;
  /** array() of fhir_identifier */
  public $identifier;
  /** array() of fhir_conditionLocation */
  public $location;
  /** array() of fhir_string */
  public $notes;
  /** fhir_age */
  public $onsetAge;
  /** fhir_date */
  public $onsetDate;
  /** array() of fhir_conditionRelatedItem */
  public $relatedItem;
  /** fhir_codeableConcept */
  public $severity;
  /** array() of fhir_conditionStage */
  public $stage;
  /** fhir_conditionStatus */
  public $status;
  /** fhir_resourceReference */
  public $subject;
}

class fhir_age {
}

class fhir_conditionEvidence {
  /** fhir_codeableConcept */
  public $code;
  /** array() of fhir_resourceReference */
  public $detail;
}

class fhir_conditionLocation {
  /** fhir_codeableConcept */
  public $code;
  /** fhir_string */
  public $detail;
}

class fhir_conditionRelatedItem {
  /** fhir_codeableConcept */
  public $code;
  /** fhir_resourceReference */
  public $target;
  /** fhir_conditionRelationshipType */
  public $type;
}

class fhir_conditionRelationshipType {
  /** array() of ConditionRelationshipTypeListEnum_0 */
  public $value;
}

class fhir_conditionStage {
  /** array() of fhir_resourceReference */
  public $assessment;
  /** fhir_codeableConcept */
  public $summary;
}

class fhir_conditionStatus {
  /** array() of ConditionStatusListEnum_0 */
  public $value;
}

class fhir_conformance {
  /** fhir_boolean */
  public $acceptUnknown;
  /** fhir_dateTime */
  public $date;
  /** fhir_string */
  public $description;
  /** array() of fhir_conformanceDocument1 */
  public $document;
  /** fhir_boolean */
  public $experimental;
  /** fhir_id */
  public $fhirVersion;
  /** array() of fhir_code */
  public $format;
  /** fhir_string */
  public $identifier;
  /** fhir_conformanceImplementation */
  public $implementation;
  /** array() of fhir_conformanceMessaging */
  public $messaging;
  /** fhir_string */
  public $name;
  /** array() of fhir_resourceReference */
  public $profile;
  /** fhir_string */
  public $publisher;
  /** array() of fhir_conformanceRest */
  public $rest;
  /** fhir_conformanceSoftware */
  public $software;
  /** fhir_conformanceStatementStatus */
  public $status;
  /** array() of fhir_contact */
  public $telecom;
  /** fhir_string */
  public $version;
}

class fhir_conformanceDocument1 {
  /** fhir_string */
  public $documentation;
  /** fhir_documentMode */
  public $mode;
  /** fhir_resourceReference */
  public $profile;
}

class fhir_documentMode {
  /** array() of DocumentModeListEnum_0 */
  public $value;
}

class fhir_id {
  /** array() of string */
  public $value;
}

class fhir_conformanceImplementation {
  /** fhir_string */
  public $description;
  /** fhir_uri */
  public $url;
}

class fhir_conformanceMessaging {
  /** fhir_string */
  public $documentation;
  /** fhir_uri */
  public $endpoint;
  /** array() of fhir_conformanceEvent */
  public $event;
  /** fhir_integer */
  public $reliableCache;
}

class fhir_conformanceEvent {
  /** fhir_messageSignificanceCategory */
  public $category;
  /** fhir_coding */
  public $code;
  /** fhir_string */
  public $documentation;
  /** array() of fhir_code */
  public $focus;
  /** fhir_conformanceEventMode */
  public $mode;
  /** array() of fhir_coding */
  public $protocol;
  /** fhir_resourceReference */
  public $request;
  /** fhir_resourceReference */
  public $response;
}

class fhir_messageSignificanceCategory {
  /** array() of MessageSignificanceCategoryListEnum_0 */
  public $value;
}

class fhir_conformanceEventMode {
  /** array() of ConformanceEventModeListEnum_0 */
  public $value;
}

class fhir_conformanceRest {
  /** array() of fhir_uri */
  public $documentMailbox;
  /** fhir_string */
  public $documentation;
  /** fhir_restfulConformanceMode */
  public $mode;
  /** array() of fhir_conformanceOperation1 */
  public $operation;
  /** array() of fhir_conformanceQuery */
  public $query;
  /** array() of fhir_conformanceResource */
  public $resource;
  /** fhir_conformanceSecurity */
  public $security;
}

class fhir_restfulConformanceMode {
  /** array() of RestfulConformanceModeListEnum_0 */
  public $value;
}

class fhir_conformanceOperation1 {
  /** fhir_restfulOperationSystem */
  public $code;
  /** fhir_string */
  public $documentation;
}

class fhir_restfulOperationSystem {
  /** array() of RestfulOperationSystemListEnum_0 */
  public $value;
}

class fhir_conformanceQuery {
  /** fhir_string */
  public $documentation;
  /** fhir_string */
  public $name;
  /** array() of fhir_conformanceSearchParam */
  public $parameter;
}

class fhir_conformanceSearchParam {
  /** array() of fhir_string */
  public $chain;
  /** fhir_string */
  public $documentation;
  /** fhir_string */
  public $name;
  /** fhir_uri */
  public $source;
  /** array() of fhir_code */
  public $target;
  /** fhir_searchParamType */
  public $type;
  /** array() of fhir_string */
  public $xpath;
}

class fhir_searchParamType {
  /** array() of SearchParamTypeListEnum_0 */
  public $value;
}

class fhir_conformanceResource {
  /** array() of fhir_conformanceOperation */
  public $operation;
  /** fhir_resourceReference */
  public $profile;
  /** fhir_boolean */
  public $readHistory;
  /** array() of fhir_string */
  public $searchInclude;
  /** array() of fhir_conformanceSearchParam */
  public $searchParam;
  /** fhir_code */
  public $type;
  /** fhir_boolean */
  public $updateCreate;
}

class fhir_conformanceOperation {
  /** fhir_restfulOperationType */
  public $code;
  /** fhir_string */
  public $documentation;
}

class fhir_restfulOperationType {
  /** array() of RestfulOperationTypeListEnum_0 */
  public $value;
}

class fhir_conformanceSecurity {
  /** array() of fhir_conformanceCertificate */
  public $certificate;
  /** fhir_boolean */
  public $cors;
  /** fhir_string */
  public $description;
  /** array() of fhir_codeableConcept */
  public $service;
}

class fhir_conformanceCertificate {
  /** fhir_base64Binary */
  public $blob;
  /** fhir_code */
  public $type;
}

class fhir_conformanceSoftware {
  /** fhir_string */
  public $name;
  /** fhir_dateTime */
  public $releaseDate;
  /** fhir_string */
  public $version;
}

class fhir_conformanceStatementStatus {
  /** array() of ConformanceStatementStatusListEnum_0 */
  public $value;
}

class fhir_device {
  /** array() of fhir_contact */
  public $contact;
  /** fhir_date */
  public $expiry;
  /** array() of fhir_identifier */
  public $identifier;
  /** fhir_resourceReference */
  public $location;
  /** fhir_string */
  public $lotNumber;
  /** fhir_string */
  public $manufacturer;
  /** array() of fhir_string */
  public $model;
  /** array() of fhir_resourceReference */
  public $owner;
  /** fhir_resourceReference */
  public $patient;
  /** fhir_codeableConcept */
  public $type;
  /** fhir_string */
  public $udi;
  /** fhir_uri */
  public $url;
  /** fhir_string */
  public $version;
}

class fhir_deviceObservationReport {
  /** fhir_identifier */
  public $identifier;
  /** fhir_instant */
  public $instant;
  /** fhir_resourceReference */
  public $source;
  /** fhir_resourceReference */
  public $subject;
  /** array() of fhir_deviceObservationReportVirtualDevice */
  public $virtualDevice;
}

class fhir_deviceObservationReportVirtualDevice {
  /** array() of fhir_deviceObservationReportChannel */
  public $channel;
  /** fhir_codeableConcept */
  public $code;
}

class fhir_deviceObservationReportChannel {
  /** fhir_codeableConcept */
  public $code;
  /** array() of fhir_deviceObservationReportMetric */
  public $metric;
}

class fhir_deviceObservationReportMetric {
  /** fhir_resourceReference */
  public $observation;
}

class fhir_diagnosticOrder {
  /** fhir_string */
  public $clinicalNotes;
  /** fhir_resourceReference */
  public $encounter;
  /** array() of fhir_diagnosticOrderEvent */
  public $event;
  /** array() of fhir_identifier */
  public $identifier;
  /** array() of fhir_diagnosticOrderItem */
  public $item;
  /** fhir_resourceReference */
  public $orderer;
  /** fhir_diagnosticOrderPriority */
  public $priority;
  /** array() of fhir_resourceReference */
  public $specimen;
  /** fhir_diagnosticOrderStatus */
  public $status;
  /** fhir_resourceReference */
  public $subject;
}

class fhir_diagnosticOrderEvent {
  /** array() of fhir_resourceReference */
  public $actor;
  /** fhir_dateTime */
  public $dateTime;
  /** fhir_codeableConcept */
  public $description;
  /** fhir_diagnosticOrderStatus */
  public $status;
}

class fhir_diagnosticOrderStatus {
  /** array() of DiagnosticOrderStatusListEnum_0 */
  public $value;
}

class fhir_diagnosticOrderItem {
  /** fhir_codeableConcept */
  public $bodySite;
  /** fhir_codeableConcept */
  public $code;
  /** array() of fhir_diagnosticOrderEvent */
  public $event;
  /** array() of fhir_resourceReference */
  public $specimen;
  /** fhir_diagnosticOrderStatus */
  public $status;
}

class fhir_diagnosticOrderPriority {
  /** array() of DiagnosticOrderPriorityListEnum_0 */
  public $value;
}

class fhir_diagnosticReport {
  /** array() of fhir_codeableConcept */
  public $codedDiagnosis;
  /** fhir_string */
  public $conclusion;
  /** fhir_dateTime */
  public $diagnosticDateTime;
  /** fhir_period */
  public $diagnosticPeriod;
  /** fhir_identifier */
  public $identifier;
  /** array() of fhir_diagnosticReportImage */
  public $image;
  /** array() of fhir_resourceReference */
  public $imagingStudy;
  /** fhir_dateTime */
  public $issued;
  /** fhir_resourceReference */
  public $performer;
  /** array() of fhir_attachment */
  public $presentedForm;
  /** array() of fhir_resourceReference */
  public $requestDetail;
  /** fhir_diagnosticReportResults */
  public $results;
  /** fhir_codeableConcept */
  public $serviceCategory;
  /** fhir_diagnosticReportStatus */
  public $status;
  /** fhir_resourceReference */
  public $subject;
}

class fhir_diagnosticReportImage {
  /** fhir_string */
  public $comment;
  /** fhir_resourceReference */
  public $link;
}

class fhir_diagnosticReportResults {
  /** array() of fhir_diagnosticReportResults */
  public $group;
  /** fhir_codeableConcept */
  public $name;
  /** array() of fhir_resourceReference */
  public $result;
  /** fhir_resourceReference */
  public $specimen;
}

class fhir_diagnosticReportStatus {
  /** array() of DiagnosticReportStatusListEnum_0 */
  public $value;
}

class fhir_documentManifest {
  /** array() of fhir_resourceReference */
  public $author;
  /** fhir_codeableConcept */
  public $confidentiality;
  /** array() of fhir_resourceReference */
  public $content;
  /** fhir_dateTime */
  public $created;
  /** fhir_string */
  public $description;
  /** array() of fhir_identifier */
  public $identifier;
  /** fhir_identifier */
  public $masterIdentifier;
  /** array() of fhir_resourceReference */
  public $recipient;
  /** fhir_uri */
  public $source;
  /** fhir_documentReferenceStatus */
  public $status;
  /** array() of fhir_resourceReference */
  public $subject;
  /** fhir_resourceReference */
  public $supercedes;
  /** fhir_codeableConcept */
  public $type;
}

class fhir_documentReferenceStatus {
  /** array() of DocumentReferenceStatusListEnum_0 */
  public $value;
}

class fhir_documentReference {
  /** fhir_resourceReference */
  public $authenticator;
  /** array() of fhir_resourceReference */
  public $author;
  /** fhir_codeableConcept */
  public $class1;
  /** array() of fhir_codeableConcept */
  public $confidentiality;
  /** fhir_documentReferenceContext */
  public $context;
  /** fhir_dateTime */
  public $created;
  /** fhir_resourceReference */
  public $custodian;
  /** fhir_string */
  public $description;
  /** fhir_codeableConcept */
  public $docStatus;
  /** array() of fhir_uri */
  public $format;
  /** fhir_string */
  public $hash;
  /** array() of fhir_identifier */
  public $identifier;
  /** fhir_instant */
  public $indexed;
  /** fhir_uri */
  public $location;
  /** fhir_identifier */
  public $masterIdentifier;
  /** fhir_code */
  public $mimeType;
  /** fhir_uri */
  public $policyManager;
  /** fhir_code */
  public $primaryLanguage;
  /** array() of fhir_documentReferenceRelatesTo */
  public $relatesTo;
  /** fhir_documentReferenceService */
  public $service;
  /** fhir_integer */
  public $size;
  /** fhir_documentReferenceStatus */
  public $status;
  /** fhir_resourceReference */
  public $subject;
  /** fhir_codeableConcept */
  public $type;
}

class fhir_documentReferenceContext {
  /** array() of fhir_codeableConcept */
  public $event;
  /** fhir_codeableConcept */
  public $facilityType;
  /** fhir_period */
  public $period;
}

class fhir_documentReferenceRelatesTo {
  /** fhir_documentRelationshipType */
  public $code;
  /** fhir_resourceReference */
  public $target;
}

class fhir_documentRelationshipType {
  /** array() of DocumentRelationshipTypeListEnum_0 */
  public $value;
}

class fhir_documentReferenceService {
  /** fhir_string */
  public $address;
  /** array() of fhir_documentReferenceParameter */
  public $parameter;
  /** fhir_codeableConcept */
  public $type;
}

class fhir_documentReferenceParameter {
  /** fhir_string */
  public $name;
  /** array() of fhir_string */
  public $value;
}

class fhir_encounter {
  /** fhir_encounterClass */
  public $class1;
  /** fhir_encounterHospitalization */
  public $hospitalization;
  /** array() of fhir_identifier */
  public $identifier;
  /** fhir_resourceReference */
  public $indication;
  /** fhir_duration */
  public $length;
  /** array() of fhir_encounterLocation */
  public $location;
  /** fhir_resourceReference */
  public $partOf;
  /** array() of fhir_encounterParticipant */
  public $participant;
  /** fhir_period */
  public $period;
  /** fhir_codeableConcept */
  public $priority;
  /** fhir_codeableConcept */
  public $reason;
  /** fhir_resourceReference */
  public $serviceProvider;
  /** fhir_encounterState */
  public $status;
  /** fhir_resourceReference */
  public $subject;
  /** array() of fhir_codeableConcept */
  public $type;
}

class fhir_encounterClass {
  /** array() of EncounterClassListEnum_0 */
  public $value;
}

class fhir_encounterHospitalization {
  /** array() of fhir_encounterAccomodation */
  public $accomodation;
  /** fhir_codeableConcept */
  public $admitSource;
  /** fhir_resourceReference */
  public $destination;
  /** fhir_codeableConcept */
  public $diet;
  /** fhir_resourceReference */
  public $dischargeDiagnosis;
  /** fhir_codeableConcept */
  public $dischargeDisposition;
  /** fhir_resourceReference */
  public $origin;
  /** fhir_period */
  public $period;
  /** fhir_identifier */
  public $preAdmissionIdentifier;
  /** fhir_boolean */
  public $reAdmission;
  /** array() of fhir_codeableConcept */
  public $specialArrangement;
  /** array() of fhir_codeableConcept */
  public $specialCourtesy;
}

class fhir_encounterAccomodation {
  /** fhir_resourceReference */
  public $bed;
  /** fhir_period */
  public $period;
}

class fhir_duration {
}

class fhir_encounterLocation {
  /** fhir_resourceReference */
  public $location;
  /** fhir_period */
  public $period;
}

class fhir_encounterParticipant {
  /** fhir_resourceReference */
  public $individual;
  /** array() of fhir_codeableConcept */
  public $type;
}

class fhir_encounterState {
  /** array() of EncounterStateListEnum_0 */
  public $value;
}

class fhir_familyHistory {
  /** array() of fhir_identifier */
  public $identifier;
  /** fhir_string */
  public $note;
  /** array() of fhir_familyHistoryRelation */
  public $relation;
  /** fhir_resourceReference */
  public $subject;
}

class fhir_familyHistoryRelation {
  /** fhir_date */
  public $bornDate;
  /** fhir_period */
  public $bornPeriod;
  /** fhir_string */
  public $bornString;
  /** array() of fhir_familyHistoryCondition */
  public $condition;
  /** fhir_age */
  public $deceasedAge;
  /** fhir_boolean */
  public $deceasedBoolean;
  /** fhir_date */
  public $deceasedDate;
  /** fhir_range */
  public $deceasedRange;
  /** fhir_string */
  public $deceasedString;
  /** fhir_string */
  public $name;
  /** fhir_string */
  public $note;
  /** fhir_codeableConcept */
  public $relationship;
}

class fhir_familyHistoryCondition {
  /** fhir_string */
  public $note;
  /** fhir_age */
  public $onsetAge;
  /** fhir_range */
  public $onsetRange;
  /** fhir_string */
  public $onsetString;
  /** fhir_codeableConcept */
  public $outcome;
  /** fhir_codeableConcept */
  public $type;
}

class fhir_group {
  /** fhir_boolean */
  public $actual;
  /** array() of fhir_groupCharacteristic */
  public $characteristic;
  /** fhir_codeableConcept */
  public $code;
  /** fhir_identifier */
  public $identifier;
  /** array() of fhir_resourceReference */
  public $member;
  /** fhir_string */
  public $name;
  /** fhir_integer */
  public $quantity;
  /** fhir_groupType */
  public $type;
}

class fhir_groupCharacteristic {
  /** fhir_codeableConcept */
  public $code;
  /** fhir_boolean */
  public $exclude;
  /** fhir_boolean */
  public $valueBoolean;
  /** fhir_codeableConcept */
  public $valueCodeableConcept;
  /** fhir_quantity */
  public $valueQuantity;
  /** fhir_range */
  public $valueRange;
}

class fhir_groupType {
  /** array() of GroupTypeListEnum_0 */
  public $value;
}

class fhir_imagingStudy {
  /** fhir_identifier */
  public $accessionNo;
  /** fhir_instanceAvailability */
  public $availability;
  /** fhir_string */
  public $clinicalInformation;
  /** fhir_dateTime */
  public $dateTime;
  /** fhir_string */
  public $description;
  /** array() of fhir_identifier */
  public $identifier;
  /** fhir_resourceReference */
  public $interpreter;
  /** array() of fhir_imagingModality */
  public $modality;
  /** fhir_integer */
  public $numberOfInstances;
  /** fhir_integer */
  public $numberOfSeries;
  /** array() of fhir_resourceReference */
  public $order;
  /** array() of fhir_coding */
  public $procedure;
  /** fhir_resourceReference */
  public $referrer;
  /** array() of fhir_imagingStudySeries */
  public $series;
  /** fhir_resourceReference */
  public $subject;
  /** fhir_oid */
  public $uid;
  /** fhir_uri */
  public $url;
}

class fhir_instanceAvailability {
  /** array() of InstanceAvailabilityListEnum_0 */
  public $value;
}

class fhir_imagingModality {
  /** array() of ImagingModalityListEnum_0 */
  public $value;
}

class fhir_imagingStudySeries {
  /** fhir_instanceAvailability */
  public $availability;
  /** fhir_coding */
  public $bodySite;
  /** fhir_dateTime */
  public $dateTime;
  /** fhir_string */
  public $description;
  /** array() of fhir_imagingStudyInstance */
  public $instance;
  /** fhir_modality */
  public $modality;
  /** fhir_integer */
  public $number;
  /** fhir_integer */
  public $numberOfInstances;
  /** fhir_oid */
  public $uid;
  /** fhir_uri */
  public $url;
}

class fhir_imagingStudyInstance {
  /** fhir_resourceReference */
  public $attachment;
  /** fhir_integer */
  public $number;
  /** fhir_oid */
  public $sopclass;
  /** array() of fhir_string */
  public $title;
  /** fhir_string */
  public $type;
  /** fhir_oid */
  public $uid;
  /** fhir_uri */
  public $url;
}

class fhir_oid {
  /** array() of string */
  public $value;
}

class fhir_modality {
  /** array() of ModalityListEnum_0 */
  public $value;
}

class fhir_immunization {
  /** fhir_dateTime */
  public $date;
  /** fhir_quantity */
  public $doseQuantity;
  /** fhir_date */
  public $expirationDate;
  /** fhir_immunizationExplanation */
  public $explanation;
  /** array() of fhir_identifier */
  public $identifier;
  /** fhir_resourceReference */
  public $location;
  /** fhir_string */
  public $lotNumber;
  /** fhir_resourceReference */
  public $manufacturer;
  /** fhir_resourceReference */
  public $performer;
  /** array() of fhir_immunizationReaction */
  public $reaction;
  /** fhir_boolean */
  public $refusedIndicator;
  /** fhir_boolean */
  public $reported;
  /** fhir_resourceReference */
  public $requester;
  /** array() of fhir_codeableConcept */
  public $route;
  /** fhir_codeableConcept */
  public $site;
  /** fhir_resourceReference */
  public $subject;
  /** array() of fhir_immunizationVaccinationProtocol */
  public $vaccinationProtocol;
  /** fhir_codeableConcept */
  public $vaccineType;
}

class fhir_immunizationExplanation {
  /** array() of fhir_codeableConcept */
  public $reason;
  /** array() of fhir_codeableConcept */
  public $refusalReason;
}

class fhir_immunizationReaction {
  /** fhir_dateTime */
  public $date;
  /** fhir_resourceReference */
  public $detail;
  /** fhir_boolean */
  public $reported;
}

class fhir_immunizationVaccinationProtocol {
  /** fhir_resourceReference */
  public $authority;
  /** fhir_string */
  public $description;
  /** fhir_integer */
  public $doseSequence;
  /** fhir_codeableConcept */
  public $doseStatus;
  /** fhir_codeableConcept */
  public $doseStatusReason;
  /** fhir_codeableConcept */
  public $doseTarget;
  /** fhir_string */
  public $series;
  /** fhir_integer */
  public $seriesDoses;
}

class fhir_immunizationRecommendation {
  /** array() of fhir_identifier */
  public $identifier;
  /** array() of fhir_immunizationRecommendationRecommendation */
  public $recommendation;
  /** fhir_resourceReference */
  public $subject;
}

class fhir_immunizationRecommendationRecommendation {
  /** fhir_dateTime */
  public $date;
  /** array() of fhir_immunizationRecommendationDateCriterion */
  public $dateCriterion;
  /** fhir_integer */
  public $doseNumber;
  /** fhir_codeableConcept */
  public $forecastStatus;
  /** fhir_immunizationRecommendationProtocol */
  public $protocol;
  /** array() of fhir_resourceReference */
  public $supportingImmunization;
  /** array() of fhir_resourceReference */
  public $supportingPatientInformation;
  /** fhir_codeableConcept */
  public $vaccineType;
}

class fhir_immunizationRecommendationDateCriterion {
  /** fhir_codeableConcept */
  public $code;
  /** array() of fhir_dateTime */
  public $value;
}

class fhir_immunizationRecommendationProtocol {
  /** fhir_resourceReference */
  public $authority;
  /** fhir_string */
  public $description;
  /** fhir_integer */
  public $doseSequence;
  /** fhir_string */
  public $series;
}

class fhir_list {
  /** fhir_codeableConcept */
  public $code;
  /** fhir_dateTime */
  public $date;
  /** fhir_codeableConcept */
  public $emptyReason;
  /** array() of fhir_listEntry */
  public $entry;
  /** array() of fhir_identifier */
  public $identifier;
  /** fhir_listMode */
  public $mode;
  /** fhir_boolean */
  public $ordered;
  /** fhir_resourceReference */
  public $source;
  /** fhir_resourceReference */
  public $subject;
}

class fhir_listEntry {
  /** fhir_dateTime */
  public $date;
  /** fhir_boolean */
  public $deleted;
  /** array() of fhir_codeableConcept */
  public $flag;
  /** fhir_resourceReference */
  public $item;
}

class fhir_listMode {
  /** array() of ListModeListEnum_0 */
  public $value;
}

class fhir_location {
  /** fhir_address */
  public $address;
  /** fhir_string */
  public $description;
  /** fhir_identifier */
  public $identifier;
  /** fhir_resourceReference */
  public $managingOrganization;
  /** fhir_locationMode */
  public $mode;
  /** fhir_string */
  public $name;
  /** fhir_resourceReference */
  public $partOf;
  /** fhir_codeableConcept */
  public $physicalType;
  /** fhir_locationPosition */
  public $position;
  /** fhir_locationStatus */
  public $status;
  /** fhir_contact */
  public $telecom;
  /** fhir_codeableConcept */
  public $type;
}

class fhir_locationMode {
  /** array() of LocationModeListEnum_0 */
  public $value;
}

class fhir_locationPosition {
  /** fhir_decimal */
  public $altitude;
  /** fhir_decimal */
  public $latitude;
  /** fhir_decimal */
  public $longitude;
}

class fhir_locationStatus {
  /** array() of LocationStatusListEnum_0 */
  public $value;
}

class fhir_media {
  /** fhir_attachment */
  public $content;
  /** fhir_dateTime */
  public $dateTime;
  /** fhir_string */
  public $deviceName;
  /** fhir_integer */
  public $frames;
  /** fhir_integer */
  public $height;
  /** array() of fhir_identifier */
  public $identifier;
  /** fhir_integer */
  public $length;
  /** fhir_resourceReference */
  public $operator;
  /** fhir_resourceReference */
  public $subject;
  /** fhir_codeableConcept */
  public $subtype;
  /** fhir_mediaType */
  public $type;
  /** fhir_codeableConcept */
  public $view;
  /** array() of fhir_integer */
  public $width;
}

class fhir_mediaType {
  /** array() of MediaTypeListEnum_0 */
  public $value;
}

class fhir_medication {
  /** fhir_codeableConcept */
  public $code;
  /** fhir_boolean */
  public $isBrand;
  /** fhir_medicationKind */
  public $kind;
  /** fhir_resourceReference */
  public $manufacturer;
  /** fhir_string */
  public $name;
  /** fhir_medicationPackage */
  public $package;
  /** fhir_medicationProduct */
  public $product;
}

class fhir_medicationKind {
  /** array() of MedicationKindListEnum_0 */
  public $value;
}

class fhir_medicationPackage {
  /** fhir_codeableConcept */
  public $container;
  /** array() of fhir_medicationContent */
  public $content;
}

class fhir_medicationContent {
  /** fhir_quantity */
  public $amount;
  /** fhir_resourceReference */
  public $item;
}

class fhir_medicationProduct {
  /** fhir_codeableConcept */
  public $form;
  /** array() of fhir_medicationIngredient */
  public $ingredient;
}

class fhir_medicationIngredient {
  /** fhir_ratio */
  public $amount;
  /** fhir_resourceReference */
  public $item;
}

class fhir_medicationAdministration {
  /** array() of fhir_resourceReference */
  public $device;
  /** array() of fhir_medicationAdministrationDosage */
  public $dosage;
  /** fhir_resourceReference */
  public $encounter;
  /** array() of fhir_identifier */
  public $identifier;
  /** fhir_resourceReference */
  public $medication;
  /** fhir_resourceReference */
  public $patient;
  /** fhir_resourceReference */
  public $practitioner;
  /** fhir_resourceReference */
  public $prescription;
  /** array() of fhir_codeableConcept */
  public $reasonNotGiven;
  /** fhir_medicationAdministrationStatus */
  public $status;
  /** fhir_boolean */
  public $wasNotGiven;
  /** fhir_period */
  public $whenGiven;
}

class fhir_medicationAdministrationDosage {
  /** fhir_boolean */
  public $asNeededBoolean;
  /** fhir_codeableConcept */
  public $asNeededCodeableConcept;
  /** fhir_ratio */
  public $maxDosePerPeriod;
  /** fhir_codeableConcept */
  public $method;
  /** fhir_quantity */
  public $quantity;
  /** fhir_ratio */
  public $rate;
  /** array() of fhir_codeableConcept */
  public $route;
  /** fhir_codeableConcept */
  public $site;
  /** fhir_schedule */
  public $timing;
}

class fhir_medicationAdministrationStatus {
  /** array() of MedicationAdministrationStatusListEnum_0 */
  public $value;
}

class fhir_medicationDispense {
  /** array() of fhir_resourceReference */
  public $authorizingPrescription;
  /** array() of fhir_medicationDispenseDispense */
  public $dispense;
  /** fhir_resourceReference */
  public $dispenser;
  /** fhir_identifier */
  public $identifier;
  /** fhir_resourceReference */
  public $patient;
  /** fhir_medicationDispenseStatus */
  public $status;
  /** fhir_medicationDispenseSubstitution */
  public $substitution;
}

class fhir_medicationDispenseDispense {
  /** fhir_resourceReference */
  public $destination;
  /** array() of fhir_medicationDispenseDosage */
  public $dosage;
  /** fhir_identifier */
  public $identifier;
  /** fhir_resourceReference */
  public $medication;
  /** fhir_quantity */
  public $quantity;
  /** array() of fhir_resourceReference */
  public $receiver;
  /** fhir_medicationDispenseStatus */
  public $status;
  /** fhir_codeableConcept */
  public $type;
  /** fhir_period */
  public $whenHandedOver;
  /** fhir_period */
  public $whenPrepared;
}

class fhir_medicationDispenseDosage {
  /** fhir_codeableConcept */
  public $additionalInstructions;
  /** fhir_boolean */
  public $asNeededBoolean;
  /** fhir_codeableConcept */
  public $asNeededCodeableConcept;
  /** fhir_ratio */
  public $maxDosePerPeriod;
  /** fhir_codeableConcept */
  public $method;
  /** fhir_quantity */
  public $quantity;
  /** fhir_ratio */
  public $rate;
  /** array() of fhir_codeableConcept */
  public $route;
  /** fhir_codeableConcept */
  public $site;
  /** fhir_dateTime */
  public $timingDateTime;
  /** fhir_period */
  public $timingPeriod;
  /** fhir_schedule */
  public $timingSchedule;
}

class fhir_medicationDispenseStatus {
  /** array() of MedicationDispenseStatusListEnum_0 */
  public $value;
}

class fhir_medicationDispenseSubstitution {
  /** array() of fhir_codeableConcept */
  public $reason;
  /** array() of fhir_resourceReference */
  public $responsibleParty;
  /** fhir_codeableConcept */
  public $type;
}

class fhir_medicationPrescription {
  /** fhir_dateTime */
  public $dateWritten;
  /** fhir_medicationPrescriptionDispense */
  public $dispense;
  /** array() of fhir_medicationPrescriptionDosageInstruction */
  public $dosageInstruction;
  /** fhir_resourceReference */
  public $encounter;
  /** array() of fhir_identifier */
  public $identifier;
  /** fhir_resourceReference */
  public $medication;
  /** fhir_resourceReference */
  public $patient;
  /** fhir_resourceReference */
  public $prescriber;
  /** fhir_codeableConcept */
  public $reasonCodeableConcept;
  /** fhir_resourceReference */
  public $reasonResource;
  /** fhir_medicationPrescriptionStatus */
  public $status;
  /** fhir_medicationPrescriptionSubstitution */
  public $substitution;
}

class fhir_medicationPrescriptionDispense {
  /** fhir_duration */
  public $expectedSupplyDuration;
  /** fhir_resourceReference */
  public $medication;
  /** fhir_integer */
  public $numberOfRepeatsAllowed;
  /** fhir_quantity */
  public $quantity;
  /** fhir_period */
  public $validityPeriod;
}

class fhir_medicationPrescriptionDosageInstruction {
  /** fhir_codeableConcept */
  public $additionalInstructions;
  /** fhir_boolean */
  public $asNeededBoolean;
  /** fhir_codeableConcept */
  public $asNeededCodeableConcept;
  /** fhir_quantity */
  public $doseQuantity;
  /** fhir_ratio */
  public $maxDosePerPeriod;
  /** fhir_codeableConcept */
  public $method;
  /** fhir_ratio */
  public $rate;
  /** array() of fhir_codeableConcept */
  public $route;
  /** fhir_codeableConcept */
  public $site;
  /** fhir_string */
  public $text;
  /** fhir_dateTime */
  public $timingDateTime;
  /** fhir_period */
  public $timingPeriod;
  /** fhir_schedule */
  public $timingSchedule;
}

class fhir_medicationPrescriptionStatus {
  /** array() of MedicationPrescriptionStatusListEnum_0 */
  public $value;
}

class fhir_medicationPrescriptionSubstitution {
  /** fhir_codeableConcept */
  public $reason;
  /** fhir_codeableConcept */
  public $type;
}

class fhir_medicationStatement {
  /** array() of fhir_resourceReference */
  public $device;
  /** array() of fhir_medicationStatementDosage */
  public $dosage;
  /** array() of fhir_identifier */
  public $identifier;
  /** fhir_resourceReference */
  public $medication;
  /** fhir_resourceReference */
  public $patient;
  /** array() of fhir_codeableConcept */
  public $reasonNotGiven;
  /** fhir_boolean */
  public $wasNotGiven;
  /** fhir_period */
  public $whenGiven;
}

class fhir_medicationStatementDosage {
  /** fhir_boolean */
  public $asNeededBoolean;
  /** fhir_codeableConcept */
  public $asNeededCodeableConcept;
  /** fhir_ratio */
  public $maxDosePerPeriod;
  /** fhir_codeableConcept */
  public $method;
  /** fhir_quantity */
  public $quantity;
  /** fhir_ratio */
  public $rate;
  /** array() of fhir_codeableConcept */
  public $route;
  /** fhir_codeableConcept */
  public $site;
  /** fhir_schedule */
  public $timing;
}

class fhir_messageHeader {
  /** fhir_resourceReference */
  public $author;
  /** array() of fhir_resourceReference */
  public $data;
  /** array() of fhir_messageHeaderDestination */
  public $destination;
  /** fhir_resourceReference */
  public $enterer;
  /** array() of fhir_coding */
  public $event;
  /** fhir_id */
  public $identifier;
  /** fhir_codeableConcept */
  public $reason;
  /** fhir_resourceReference */
  public $receiver;
  /** fhir_messageHeaderResponse */
  public $response;
  /** fhir_resourceReference */
  public $responsible;
  /** fhir_messageHeaderSource */
  public $source;
  /** fhir_instant */
  public $timestamp;
}

class fhir_messageHeaderDestination {
  /** fhir_uri */
  public $endpoint;
  /** fhir_string */
  public $name;
  /** fhir_resourceReference */
  public $target;
}

class fhir_messageHeaderResponse {
  /** fhir_responseType */
  public $code;
  /** fhir_resourceReference */
  public $details;
  /** fhir_id */
  public $identifier;
}

class fhir_responseType {
  /** array() of ResponseTypeListEnum_0 */
  public $value;
}

class fhir_messageHeaderSource {
  /** fhir_contact */
  public $contact;
  /** fhir_uri */
  public $endpoint;
  /** fhir_string */
  public $name;
  /** fhir_string */
  public $software;
  /** fhir_string */
  public $version;
}

class fhir_observation {
  /** fhir_dateTime */
  public $appliesDateTime;
  /** fhir_period */
  public $appliesPeriod;
  /** fhir_codeableConcept */
  public $bodySite;
  /** fhir_string */
  public $comments;
  /** fhir_identifier */
  public $identifier;
  /** fhir_codeableConcept */
  public $interpretation;
  /** fhir_instant */
  public $issued;
  /** fhir_codeableConcept */
  public $method;
  /** fhir_codeableConcept */
  public $name;
  /** array() of fhir_resourceReference */
  public $performer;
  /** array() of fhir_observationReferenceRange */
  public $referenceRange;
  /** fhir_observationReliability */
  public $reliability;
  /** fhir_resourceReference */
  public $specimen;
  /** fhir_observationStatus */
  public $status;
  /** fhir_resourceReference */
  public $subject;
  /** fhir_attachment */
  public $valueAttachment;
  /** fhir_codeableConcept */
  public $valueCodeableConcept;
  /** fhir_period */
  public $valuePeriod;
  /** fhir_quantity */
  public $valueQuantity;
  /** fhir_ratio */
  public $valueRatio;
  /** fhir_sampledData */
  public $valueSampledData;
  /** fhir_string */
  public $valueString;
}

class fhir_observationReferenceRange {
  /** fhir_period */
  public $age;
  /** fhir_quantity */
  public $high;
  /** fhir_quantity */
  public $low;
  /** fhir_codeableConcept */
  public $meaning;
}

class fhir_observationReliability {
  /** array() of ObservationReliabilityListEnum_0 */
  public $value;
}

class fhir_observationStatus {
  /** array() of ObservationStatusListEnum_0 */
  public $value;
}

class fhir_operationOutcome {
  /** array() of fhir_operationOutcomeIssue */
  public $issue;
}

class fhir_operationOutcomeIssue {
  /** fhir_string */
  public $details;
  /** array() of fhir_string */
  public $location;
  /** fhir_issueSeverity */
  public $severity;
  /** fhir_coding */
  public $type;
}

class fhir_issueSeverity {
  /** array() of IssueSeverityListEnum_0 */
  public $value;
}

class fhir_order {
  /** fhir_resourceReference */
  public $authority;
  /** fhir_dateTime */
  public $date;
  /** array() of fhir_resourceReference */
  public $detail;
  /** array() of fhir_identifier */
  public $identifier;
  /** fhir_codeableConcept */
  public $reasonCodeableConcept;
  /** fhir_resourceReference */
  public $reasonResource;
  /** fhir_resourceReference */
  public $source;
  /** fhir_resourceReference */
  public $subject;
  /** fhir_resourceReference */
  public $target;
  /** fhir_orderWhen */
  public $when;
}

class fhir_orderWhen {
  /** fhir_codeableConcept */
  public $code;
  /** fhir_schedule */
  public $schedule;
}

class fhir_orderResponse {
  /** fhir_codeableConcept */
  public $authorityCodeableConcept;
  /** fhir_resourceReference */
  public $authorityResource;
  /** fhir_orderOutcomeStatus */
  public $code;
  /** fhir_dateTime */
  public $date;
  /** fhir_string */
  public $description;
  /** array() of fhir_resourceReference */
  public $fulfillment;
  /** array() of fhir_identifier */
  public $identifier;
  /** fhir_resourceReference */
  public $request;
  /** fhir_resourceReference */
  public $who;
}

class fhir_orderOutcomeStatus {
  /** array() of OrderOutcomeStatusListEnum_0 */
  public $value;
}

class fhir_organization {
  /** fhir_boolean */
  public $active;
  /** array() of fhir_address */
  public $address;
  /** array() of fhir_organizationContact */
  public $contact;
  /** array() of fhir_identifier */
  public $identifier;
  /** array() of fhir_resourceReference */
  public $location;
  /** fhir_string */
  public $name;
  /** fhir_resourceReference */
  public $partOf;
  /** array() of fhir_contact */
  public $telecom;
  /** fhir_codeableConcept */
  public $type;
}

class fhir_organizationContact {
  /** fhir_address */
  public $address;
  /** fhir_codeableConcept */
  public $gender;
  /** fhir_humanName */
  public $name;
  /** fhir_codeableConcept */
  public $purpose;
  /** array() of fhir_contact */
  public $telecom;
}

class fhir_other {
  /** fhir_resourceReference */
  public $author;
  /** fhir_codeableConcept */
  public $code;
  /** fhir_date */
  public $created;
  /** array() of fhir_identifier */
  public $identifier;
  /** fhir_resourceReference */
  public $subject;
}

class fhir_practitioner {
  /** fhir_address */
  public $address;
  /** fhir_dateTime */
  public $birthDate;
  /** array() of fhir_codeableConcept */
  public $communication;
  /** fhir_codeableConcept */
  public $gender;
  /** array() of fhir_identifier */
  public $identifier;
  /** array() of fhir_resourceReference */
  public $location;
  /** fhir_humanName */
  public $name;
  /** fhir_resourceReference */
  public $organization;
  /** fhir_period */
  public $period;
  /** array() of fhir_attachment */
  public $photo;
  /** array() of fhir_practitionerQualification */
  public $qualification;
  /** array() of fhir_codeableConcept */
  public $role;
  /** array() of fhir_codeableConcept */
  public $specialty;
  /** array() of fhir_contact */
  public $telecom;
}

class fhir_practitionerQualification {
  /** fhir_codeableConcept */
  public $code;
  /** fhir_resourceReference */
  public $issuer;
  /** fhir_period */
  public $period;
}

class fhir_procedure {
  /** array() of fhir_codeableConcept */
  public $bodySite;
  /** array() of fhir_codeableConcept */
  public $complication;
  /** fhir_period */
  public $date;
  /** fhir_resourceReference */
  public $encounter;
  /** fhir_string */
  public $followUp;
  /** array() of fhir_identifier */
  public $identifier;
  /** array() of fhir_codeableConcept */
  public $indication;
  /** array() of fhir_string */
  public $notes;
  /** fhir_string */
  public $outcome;
  /** array() of fhir_procedurePerformer */
  public $performer;
  /** array() of fhir_procedureRelatedItem */
  public $relatedItem;
  /** array() of fhir_resourceReference */
  public $report;
  /** fhir_resourceReference */
  public $subject;
  /** fhir_codeableConcept */
  public $type;
}

class fhir_procedurePerformer {
  /** fhir_resourceReference */
  public $person;
  /** fhir_codeableConcept */
  public $role;
}

class fhir_procedureRelatedItem {
  /** fhir_resourceReference */
  public $target;
  /** fhir_procedureRelationshipType */
  public $type;
}

class fhir_procedureRelationshipType {
  /** array() of ProcedureRelationshipTypeListEnum_0 */
  public $value;
}

class fhir_profile {
  /** array() of fhir_coding */
  public $code;
  /** fhir_dateTime */
  public $date;
  /** fhir_string */
  public $description;
  /** fhir_boolean */
  public $experimental;
  /** array() of fhir_profileExtensionDefn */
  public $extensionDefn;
  /** fhir_id */
  public $fhirVersion;
  /** fhir_string */
  public $identifier;
  /** array() of fhir_profileMapping */
  public $mapping;
  /** fhir_string */
  public $name;
  /** fhir_string */
  public $publisher;
  /** fhir_string */
  public $requirements;
  /** fhir_resourceProfileStatus */
  public $status;
  /** array() of fhir_profileStructure */
  public $structure;
  /** array() of fhir_contact */
  public $telecom;
  /** fhir_string */
  public $version;
}

class fhir_profileExtensionDefn {
  /** fhir_code */
  public $code;
  /** array() of fhir_string */
  public $context;
  /** fhir_extensionContext */
  public $contextType;
  /** fhir_profileDefinition */
  public $definition;
  /** fhir_string */
  public $display;
}

class fhir_extensionContext {
  /** array() of ExtensionContextListEnum_0 */
  public $value;
}

class fhir_profileDefinition {
  /** fhir_profileBinding */
  public $binding;
  /** fhir_string */
  public $comments;
  /** array() of fhir_id */
  public $condition;
  /** array() of fhir_profileConstraint */
  public $constraint;
  /** fhir_address */
  public $exampleAddress;
  /** fhir_attachment */
  public $exampleAttachment;
  /** fhir_base64Binary */
  public $exampleBase64Binary;
  /** fhir_boolean */
  public $exampleBoolean;
  /** fhir_code */
  public $exampleCode;
  /** fhir_codeableConcept */
  public $exampleCodeableConcept;
  /** fhir_coding */
  public $exampleCoding;
  /** fhir_contact */
  public $exampleContact;
  /** fhir_date */
  public $exampleDate;
  /** fhir_dateTime */
  public $exampleDateTime;
  /** fhir_decimal */
  public $exampleDecimal;
  /** fhir_humanName */
  public $exampleHumanName;
  /** fhir_id */
  public $exampleId;
  /** fhir_identifier */
  public $exampleIdentifier;
  /** fhir_instant */
  public $exampleInstant;
  /** fhir_integer */
  public $exampleInteger;
  /** fhir_oid */
  public $exampleOid;
  /** fhir_period */
  public $examplePeriod;
  /** fhir_quantity */
  public $exampleQuantity;
  /** fhir_range */
  public $exampleRange;
  /** fhir_ratio */
  public $exampleRatio;
  /** fhir_resourceReference */
  public $exampleResource;
  /** fhir_sampledData */
  public $exampleSampledData;
  /** fhir_schedule */
  public $exampleSchedule;
  /** fhir_string */
  public $exampleString;
  /** fhir_uri */
  public $exampleUri;
  /** fhir_uuid */
  public $exampleUuid;
  /** fhir_string */
  public $formal;
  /** fhir_boolean */
  public $isModifier;
  /** array() of fhir_profileMapping1 */
  public $mapping;
  /** fhir_string */
  public $max;
  /** fhir_integer */
  public $maxLength;
  /** fhir_integer */
  public $min;
  /** fhir_boolean */
  public $mustSupport;
  /** fhir_string */
  public $nameReference;
  /** fhir_string */
  public $requirements;
  /** array() of fhir_string */
  public $short;
  /** array() of fhir_string */
  public $synonym;
  /** array() of fhir_profileType */
  public $type;
  /** fhir_address */
  public $valueAddress;
  /** fhir_attachment */
  public $valueAttachment;
  /** fhir_base64Binary */
  public $valueBase64Binary;
  /** fhir_boolean */
  public $valueBoolean;
  /** fhir_code */
  public $valueCode;
  /** fhir_codeableConcept */
  public $valueCodeableConcept;
  /** fhir_coding */
  public $valueCoding;
  /** fhir_contact */
  public $valueContact;
  /** fhir_date */
  public $valueDate;
  /** fhir_dateTime */
  public $valueDateTime;
  /** fhir_decimal */
  public $valueDecimal;
  /** fhir_humanName */
  public $valueHumanName;
  /** fhir_id */
  public $valueId;
  /** fhir_identifier */
  public $valueIdentifier;
  /** fhir_instant */
  public $valueInstant;
  /** fhir_integer */
  public $valueInteger;
  /** fhir_oid */
  public $valueOid;
  /** fhir_period */
  public $valuePeriod;
  /** fhir_quantity */
  public $valueQuantity;
  /** fhir_range */
  public $valueRange;
  /** fhir_ratio */
  public $valueRatio;
  /** fhir_resourceReference */
  public $valueResource;
  /** fhir_sampledData */
  public $valueSampledData;
  /** fhir_schedule */
  public $valueSchedule;
  /** fhir_string */
  public $valueString;
  /** fhir_uri */
  public $valueUri;
  /** fhir_uuid */
  public $valueUuid;
}

class fhir_profileBinding {
  /** fhir_bindingConformance */
  public $conformance;
  /** fhir_string */
  public $description;
  /** fhir_boolean */
  public $isExtensible;
  /** fhir_string */
  public $name;
  /** fhir_resourceReference */
  public $referenceResource;
  /** fhir_uri */
  public $referenceUri;
}

class fhir_bindingConformance {
  /** array() of BindingConformanceListEnum_0 */
  public $value;
}

class fhir_profileConstraint {
  /** array() of fhir_string */
  public $human;
  /** fhir_id */
  public $key;
  /** fhir_string */
  public $name;
  /** fhir_constraintSeverity */
  public $severity;
  /** array() of fhir_string */
  public $xpath;
}

class fhir_constraintSeverity {
  /** array() of ConstraintSeverityListEnum_0 */
  public $value;
}

class fhir_uuid {
  /** array() of string */
  public $value;
}

class fhir_profileMapping1 {
  /** fhir_id */
  public $identity;
  /** fhir_string */
  public $map;
}

class fhir_profileType {
  /** array() of fhir_aggregationMode */
  public $aggregation;
  /** fhir_code */
  public $code;
  /** fhir_uri */
  public $profile;
}

class fhir_aggregationMode {
  /** array() of AggregationModeListEnum_0 */
  public $value;
}

class fhir_profileMapping {
  /** fhir_string */
  public $comments;
  /** fhir_id */
  public $identity;
  /** fhir_string */
  public $name;
  /** fhir_uri */
  public $uri;
}

class fhir_resourceProfileStatus {
  /** array() of ResourceProfileStatusListEnum_0 */
  public $value;
}

class fhir_profileStructure {
  /** array() of fhir_profileElement */
  public $element;
  /** fhir_string */
  public $name;
  /** fhir_boolean */
  public $publish;
  /** fhir_string */
  public $purpose;
  /** fhir_code */
  public $type;
}

class fhir_profileElement {
  /** fhir_profileDefinition */
  public $definition;
  /** fhir_string */
  public $name;
  /** fhir_string */
  public $path;
  /** array() of fhir_propertyRepresentation */
  public $representation;
  /** fhir_profileSlicing */
  public $slicing;
}

class fhir_propertyRepresentation {
  /** array() of PropertyRepresentationListEnum_0 */
  public $value;
}

class fhir_profileSlicing {
  /** fhir_id */
  public $discriminator;
  /** fhir_boolean */
  public $ordered;
  /** array() of fhir_slicingRules */
  public $rules;
}

class fhir_slicingRules {
  /** array() of SlicingRulesListEnum_0 */
  public $value;
}

class fhir_provenance {
  /** array() of fhir_provenanceAgent */
  public $agent;
  /** array() of fhir_provenanceEntity */
  public $entity;
  /** fhir_string */
  public $integritySignature;
  /** fhir_resourceReference */
  public $location;
  /** fhir_period */
  public $period;
  /** array() of fhir_uri */
  public $policy;
  /** fhir_codeableConcept */
  public $reason;
  /** fhir_instant */
  public $recorded;
  /** array() of fhir_resourceReference */
  public $target;
}

class fhir_provenanceAgent {
  /** fhir_string */
  public $display;
  /** fhir_uri */
  public $reference;
  /** fhir_coding */
  public $role;
  /** fhir_coding */
  public $type;
}

class fhir_provenanceEntity {
  /** array() of fhir_provenanceAgent */
  public $agent;
  /** fhir_string */
  public $display;
  /** fhir_uri */
  public $reference;
  /** fhir_provenanceEntityRole */
  public $role;
  /** fhir_coding */
  public $type;
}

class fhir_provenanceEntityRole {
  /** array() of ProvenanceEntityRoleListEnum_0 */
  public $value;
}

class fhir_query {
  /** fhir_uri */
  public $identifier;
  /** array() of fhir_extension */
  public $parameter;
  /** fhir_queryResponse */
  public $response;
}

class fhir_queryResponse {
  /** array() of fhir_extension */
  public $first;
  /** fhir_uri */
  public $identifier;
  /** array() of fhir_extension */
  public $last;
  /** array() of fhir_extension */
  public $next;
  /** fhir_queryOutcome */
  public $outcome;
  /** array() of fhir_extension */
  public $parameter;
  /** array() of fhir_extension */
  public $previous;
  /** array() of fhir_resourceReference */
  public $reference;
  /** array() of fhir_integer */
  public $total;
}

class fhir_queryOutcome {
  /** array() of QueryOutcomeListEnum_0 */
  public $value;
}

class fhir_questionnaire {
  /** fhir_resourceReference */
  public $author;
  /** fhir_dateTime */
  public $authored;
  /** fhir_resourceReference */
  public $encounter;
  /** array() of fhir_questionnaireGroup */
  public $group;
  /** array() of fhir_identifier */
  public $identifier;
  /** fhir_codeableConcept */
  public $name;
  /** fhir_resourceReference */
  public $source;
  /** fhir_questionnaireStatus */
  public $status;
  /** fhir_resourceReference */
  public $subject;
}

class fhir_questionnaireGroup {
  /** array() of fhir_questionnaireGroup */
  public $group;
  /** fhir_string */
  public $header;
  /** fhir_codeableConcept */
  public $name;
  /** fhir_boolean */
  public $ordered;
  /** array() of fhir_questionnaireQuestion */
  public $question;
  /** fhir_resourceReference */
  public $subject;
  /** fhir_string */
  public $text;
}

class fhir_questionnaireQuestion {
  /** fhir_boolean */
  public $answerBoolean;
  /** fhir_date */
  public $answerDate;
  /** fhir_dateTime */
  public $answerDateTime;
  /** fhir_decimal */
  public $answerDecimal;
  /** fhir_instant */
  public $answerInstant;
  /** fhir_integer */
  public $answerInteger;
  /** fhir_string */
  public $answerString;
  /** array() of fhir_coding */
  public $choice;
  /** fhir_address */
  public $dataAddress;
  /** fhir_attachment */
  public $dataAttachment;
  /** fhir_base64Binary */
  public $dataBase64Binary;
  /** fhir_boolean */
  public $dataBoolean;
  /** fhir_code */
  public $dataCode;
  /** fhir_codeableConcept */
  public $dataCodeableConcept;
  /** fhir_coding */
  public $dataCoding;
  /** fhir_contact */
  public $dataContact;
  /** fhir_date */
  public $dataDate;
  /** fhir_dateTime */
  public $dataDateTime;
  /** fhir_decimal */
  public $dataDecimal;
  /** fhir_humanName */
  public $dataHumanName;
  /** fhir_id */
  public $dataId;
  /** fhir_identifier */
  public $dataIdentifier;
  /** fhir_instant */
  public $dataInstant;
  /** fhir_integer */
  public $dataInteger;
  /** fhir_oid */
  public $dataOid;
  /** fhir_period */
  public $dataPeriod;
  /** fhir_quantity */
  public $dataQuantity;
  /** fhir_range */
  public $dataRange;
  /** fhir_ratio */
  public $dataRatio;
  /** fhir_resourceReference */
  public $dataResource;
  /** fhir_sampledData */
  public $dataSampledData;
  /** fhir_schedule */
  public $dataSchedule;
  /** fhir_string */
  public $dataString;
  /** fhir_uri */
  public $dataUri;
  /** fhir_uuid */
  public $dataUuid;
  /** array() of fhir_questionnaireGroup */
  public $group;
  /** fhir_codeableConcept */
  public $name;
  /** fhir_resourceReference */
  public $options;
  /** fhir_string */
  public $remarks;
  /** fhir_string */
  public $text;
}

class fhir_questionnaireStatus {
  /** array() of QuestionnaireStatusListEnum_0 */
  public $value;
}

class fhir_relatedPerson {
  /** fhir_address */
  public $address;
  /** fhir_codeableConcept */
  public $gender;
  /** array() of fhir_identifier */
  public $identifier;
  /** fhir_humanName */
  public $name;
  /** fhir_resourceReference */
  public $patient;
  /** array() of fhir_attachment */
  public $photo;
  /** fhir_codeableConcept */
  public $relationship;
  /** array() of fhir_contact */
  public $telecom;
}

class fhir_securityEvent {
  /** array() of fhir_securityEventEvent */
  public $event;
  /** array() of fhir_securityEventObject */
  public $object;
  /** array() of fhir_securityEventParticipant */
  public $participant;
  /** fhir_securityEventSource */
  public $source;
}

class fhir_securityEventEvent {
  /** fhir_securityEventAction */
  public $action;
  /** fhir_instant */
  public $dateTime;
  /** fhir_securityEventOutcome */
  public $outcome;
  /** fhir_string */
  public $outcomeDesc;
  /** array() of fhir_codeableConcept */
  public $subtype;
  /** fhir_codeableConcept */
  public $type;
}

class fhir_securityEventAction {
  /** array() of SecurityEventActionListEnum_0 */
  public $value;
}

class fhir_securityEventOutcome {
  /** array() of SecurityEventOutcomeListEnum_0 */
  public $value;
}

class fhir_securityEventObject {
  /** fhir_string */
  public $description;
  /** array() of fhir_securityEventDetail */
  public $detail;
  /** fhir_identifier */
  public $identifier;
  /** fhir_securityEventObjectLifecycle */
  public $lifecycle;
  /** fhir_string */
  public $name;
  /** array() of fhir_base64Binary */
  public $query;
  /** fhir_resourceReference */
  public $reference;
  /** fhir_securityEventObjectRole */
  public $role;
  /** fhir_codeableConcept */
  public $sensitivity;
  /** fhir_securityEventObjectType */
  public $type;
}

class fhir_securityEventDetail {
  /** fhir_string */
  public $type;
  /** array() of fhir_base64Binary */
  public $value;
}

class fhir_securityEventObjectLifecycle {
  /** array() of SecurityEventObjectLifecycleListEnum_0 */
  public $value;
}

class fhir_securityEventObjectRole {
  /** array() of SecurityEventObjectRoleListEnum_0 */
  public $value;
}

class fhir_securityEventObjectType {
  /** array() of SecurityEventObjectTypeListEnum_0 */
  public $value;
}

class fhir_securityEventParticipant {
  /** array() of fhir_string */
  public $altId;
  /** array() of fhir_coding */
  public $media;
  /** fhir_string */
  public $name;
  /** fhir_securityEventNetwork */
  public $network;
  /** fhir_resourceReference */
  public $reference;
  /** fhir_boolean */
  public $requestor;
  /** array() of fhir_codeableConcept */
  public $role;
  /** fhir_string */
  public $userId;
}

class fhir_securityEventNetwork {
  /** fhir_string */
  public $identifier;
  /** fhir_securityEventParticipantNetworkType */
  public $type;
}

class fhir_securityEventParticipantNetworkType {
  /** array() of SecurityEventParticipantNetworkTypeListEnum_0 */
  public $value;
}

class fhir_securityEventSource {
  /** fhir_string */
  public $identifier;
  /** fhir_string */
  public $site;
  /** array() of fhir_coding */
  public $type;
}

class fhir_specimen {
  /** fhir_identifier */
  public $accessionIdentifier;
  /** fhir_specimenCollection */
  public $collection;
  /** array() of fhir_specimenContainer */
  public $container;
  /** array() of fhir_identifier */
  public $identifier;
  /** fhir_dateTime */
  public $receivedTime;
  /** array() of fhir_specimenSource */
  public $source;
  /** fhir_resourceReference */
  public $subject;
  /** array() of fhir_specimenTreatment */
  public $treatment;
  /** fhir_codeableConcept */
  public $type;
}

class fhir_specimenCollection {
  /** fhir_dateTime */
  public $collectedDateTime;
  /** fhir_period */
  public $collectedPeriod;
  /** fhir_resourceReference */
  public $collector;
  /** array() of fhir_string */
  public $comment;
  /** fhir_codeableConcept */
  public $method;
  /** fhir_quantity */
  public $quantity;
  /** fhir_codeableConcept */
  public $sourceSite;
}

class fhir_specimenContainer {
  /** fhir_resourceReference */
  public $additive;
  /** fhir_quantity */
  public $capacity;
  /** fhir_string */
  public $description;
  /** array() of fhir_identifier */
  public $identifier;
  /** fhir_quantity */
  public $specimenQuantity;
  /** fhir_codeableConcept */
  public $type;
}

class fhir_specimenSource {
  /** fhir_hierarchicalRelationshipType */
  public $relationship;
  /** array() of fhir_resourceReference */
  public $target;
}

class fhir_hierarchicalRelationshipType {
  /** array() of HierarchicalRelationshipTypeListEnum_0 */
  public $value;
}

class fhir_specimenTreatment {
  /** array() of fhir_resourceReference */
  public $additive;
  /** fhir_string */
  public $description;
  /** fhir_codeableConcept */
  public $procedure;
}

class fhir_substance {
  /** fhir_string */
  public $description;
  /** array() of fhir_substanceIngredient */
  public $ingredient;
  /** fhir_substanceInstance */
  public $instance;
  /** fhir_codeableConcept */
  public $type;
}

class fhir_substanceIngredient {
  /** fhir_ratio */
  public $quantity;
  /** fhir_resourceReference */
  public $substance;
}

class fhir_substanceInstance {
  /** fhir_dateTime */
  public $expiry;
  /** fhir_identifier */
  public $identifier;
  /** fhir_quantity */
  public $quantity;
}

class fhir_supply {
  /** array() of fhir_supplyDispense */
  public $dispense;
  /** fhir_identifier */
  public $identifier;
  /** fhir_codeableConcept */
  public $kind;
  /** fhir_resourceReference */
  public $orderedItem;
  /** fhir_resourceReference */
  public $patient;
  /** fhir_supplyStatus */
  public $status;
}

class fhir_supplyDispense {
  /** fhir_resourceReference */
  public $destination;
  /** fhir_identifier */
  public $identifier;
  /** fhir_quantity */
  public $quantity;
  /** array() of fhir_resourceReference */
  public $receiver;
  /** fhir_supplyDispenseStatus */
  public $status;
  /** fhir_resourceReference */
  public $suppliedItem;
  /** fhir_resourceReference */
  public $supplier;
  /** fhir_codeableConcept */
  public $type;
  /** fhir_period */
  public $whenHandedOver;
  /** fhir_period */
  public $whenPrepared;
}

class fhir_supplyDispenseStatus {
  /** array() of SupplyDispenseStatusListEnum_0 */
  public $value;
}

class fhir_supplyStatus {
  /** array() of SupplyStatusListEnum_0 */
  public $value;
}

class fhir_valueSet {
  /** fhir_valueSetCompose */
  public $compose;
  /** fhir_string */
  public $copyright;
  /** fhir_dateTime */
  public $date;
  /** fhir_valueSetDefine */
  public $define;
  /** fhir_string */
  public $description;
  /** fhir_valueSetExpansion */
  public $expansion;
  /** fhir_boolean */
  public $experimental;
  /** fhir_boolean */
  public $extensible;
  /** fhir_string */
  public $identifier;
  /** fhir_string */
  public $name;
  /** fhir_string */
  public $publisher;
  /** fhir_valueSetStatus */
  public $status;
  /** array() of fhir_contact */
  public $telecom;
  /** fhir_string */
  public $version;
}

class fhir_valueSetCompose {
  /** array() of fhir_valueSetInclude */
  public $exclude;
  /** array() of fhir_uri */
  public $import;
  /** array() of fhir_valueSetInclude */
  public $include;
}

class fhir_valueSetInclude {
  /** array() of fhir_code */
  public $code;
  /** array() of fhir_valueSetFilter */
  public $filter;
  /** fhir_uri */
  public $system;
  /** fhir_string */
  public $version;
}

class fhir_valueSetFilter {
  /** fhir_filterOperator */
  public $op;
  /** fhir_code */
  public $property;
  /** array() of fhir_code */
  public $value;
}

class fhir_filterOperator {
  /** array() of FilterOperatorListEnum_0 */
  public $value;
}

class fhir_valueSetDefine {
  /** fhir_boolean */
  public $caseSensitive;
  /** array() of fhir_valueSetConcept */
  public $concept;
  /** fhir_uri */
  public $system;
  /** fhir_string */
  public $version;
}

class fhir_valueSetConcept {
  /** fhir_boolean */
  public $abstract;
  /** fhir_code */
  public $code;
  /** array() of fhir_valueSetConcept */
  public $concept;
  /** fhir_string */
  public $definition;
  /** fhir_string */
  public $display;
}

class fhir_valueSetExpansion {
  /** array() of fhir_valueSetContains */
  public $contains;
  /** fhir_identifier */
  public $identifier;
  /** fhir_instant */
  public $timestamp;
}

class fhir_valueSetContains {
  /** fhir_code */
  public $code;
  /** array() of fhir_valueSetContains */
  public $contains;
  /** fhir_string */
  public $display;
  /** fhir_uri */
  public $system;
}

class fhir_narrative {
  /** divImpl */
  public $div;
  /** fhir_narrativeStatus */
  public $status;
}

class divImpl {
  /** anyType */
  public $class1;
  /** DivDocumentEnum_0 */
  public $dir;
  /** string */
  public $id;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** array() of string */
  public $style;
  /** array() of string */
  public $title;
}

class fhir_flow {
  /** array() of aImpl */
  public $A;
  /** array() of abbrImpl */
  public $abbr;
  /** array() of acronymImpl */
  public $acronym;
  /** array() of addressImpl */
  public $address;
  /** array() of bImpl */
  public $B;
  /** array() of bdoImpl */
  public $bdo;
  /** array() of bigImpl */
  public $big;
  /** array() of blockquoteImpl */
  public $blockquote;
  /** array() of brImpl */
  public $br;
  /** array() of buttonImpl */
  public $button;
  /** array() of citeImpl */
  public $cite;
  /** array() of codeImpl */
  public $code;
  /** array() of delImpl */
  public $del;
  /** array() of dfnImpl */
  public $dfn;
  /** array() of divImpl */
  public $div;
  /** array() of dlImpl */
  public $dl;
  /** array() of emImpl */
  public $em;
  /** array() of fieldsetImpl */
  public $fieldset;
  /** array() of formImpl */
  public $form;
  /** array() of h1Impl */
  public $h1;
  /** array() of h2Impl */
  public $h2;
  /** array() of h3Impl */
  public $h3;
  /** array() of h4Impl */
  public $h4;
  /** array() of h5Impl */
  public $h5;
  /** array() of h6Impl */
  public $h6;
  /** array() of hrImpl */
  public $hr;
  /** array() of iImpl */
  public $I;
  /** array() of imgImpl */
  public $img;
  /** array() of inputImpl */
  public $input;
  /** array() of insImpl */
  public $ins;
  /** array() of kbdImpl */
  public $kbd;
  /** array() of labelImpl */
  public $label;
  /** array() of mapImpl */
  public $map;
  /** array() of noscriptImpl */
  public $noscript;
  /** array() of objectImpl */
  public $object;
  /** array() of olImpl */
  public $ol;
  /** array() of pImpl */
  public $P;
  /** array() of preImpl */
  public $pre;
  /** array() of qImpl */
  public $Q;
  /** array() of sampImpl */
  public $samp;
  /** array() of scriptImpl */
  public $script;
  /** array() of selectImpl */
  public $select;
  /** array() of smallImpl */
  public $small;
  /** array() of spanImpl */
  public $span;
  /** array() of strongImpl */
  public $strong;
  /** array() of subImpl */
  public $sub;
  /** array() of supImpl */
  public $sup;
  /** array() of tableImpl */
  public $table;
  /** array() of textareaImpl */
  public $textarea;
  /** array() of ttImpl */
  public $tt;
  /** array() of ulImpl */
  public $ul;
  /** array() of varImpl */
  public $var;
}

class aImpl {
  /** string */
  public $accesskey;
  /** string */
  public $charset;
  /** anyType */
  public $class1;
  /** string */
  public $coords;
  /** ADocumentEnum_0 */
  public $dir;
  /** string */
  public $href;
  /** string */
  public $hreflang;
  /** string */
  public $id;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** string */
  public $name;
  /** string */
  public $onblur;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onfocus;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** anyType */
  public $rel;
  /** anyType */
  public $rev;
  /** array() of ShapeEnum_0 */
  public $shape;
  /** array() of string */
  public $style;
  /** int */
  public $tabindex;
  /** array() of string */
  public $title;
  /** string */
  public $type;
}

class fhir_aContent {
  /** array() of abbrImpl */
  public $abbr;
  /** array() of acronymImpl */
  public $acronym;
  /** array() of bImpl */
  public $B;
  /** array() of bdoImpl */
  public $bdo;
  /** array() of bigImpl */
  public $big;
  /** array() of brImpl */
  public $br;
  /** array() of buttonImpl */
  public $button;
  /** array() of citeImpl */
  public $cite;
  /** array() of codeImpl */
  public $code;
  /** array() of delImpl */
  public $del;
  /** array() of dfnImpl */
  public $dfn;
  /** array() of emImpl */
  public $em;
  /** array() of iImpl */
  public $I;
  /** array() of imgImpl */
  public $img;
  /** array() of inputImpl */
  public $input;
  /** array() of insImpl */
  public $ins;
  /** array() of kbdImpl */
  public $kbd;
  /** array() of labelImpl */
  public $label;
  /** array() of mapImpl */
  public $map;
  /** array() of objectImpl */
  public $object;
  /** array() of qImpl */
  public $Q;
  /** array() of sampImpl */
  public $samp;
  /** array() of scriptImpl */
  public $script;
  /** array() of selectImpl */
  public $select;
  /** array() of smallImpl */
  public $small;
  /** array() of spanImpl */
  public $span;
  /** array() of strongImpl */
  public $strong;
  /** array() of subImpl */
  public $sub;
  /** array() of supImpl */
  public $sup;
  /** array() of textareaImpl */
  public $textarea;
  /** array() of ttImpl */
  public $tt;
  /** array() of varImpl */
  public $var;
}

class abbrImpl {
  /** anyType */
  public $class1;
  /** AbbrDocumentEnum_0 */
  public $dir;
  /** string */
  public $id;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** array() of string */
  public $style;
  /** array() of string */
  public $title;
}

class fhir_inline {
  /** array() of aImpl */
  public $A;
  /** array() of abbrImpl */
  public $abbr;
  /** array() of acronymImpl */
  public $acronym;
  /** array() of bImpl */
  public $B;
  /** array() of bdoImpl */
  public $bdo;
  /** array() of bigImpl */
  public $big;
  /** array() of brImpl */
  public $br;
  /** array() of buttonImpl */
  public $button;
  /** array() of citeImpl */
  public $cite;
  /** array() of codeImpl */
  public $code;
  /** array() of delImpl */
  public $del;
  /** array() of dfnImpl */
  public $dfn;
  /** array() of emImpl */
  public $em;
  /** array() of iImpl */
  public $I;
  /** array() of imgImpl */
  public $img;
  /** array() of inputImpl */
  public $input;
  /** array() of insImpl */
  public $ins;
  /** array() of kbdImpl */
  public $kbd;
  /** array() of labelImpl */
  public $label;
  /** array() of mapImpl */
  public $map;
  /** array() of objectImpl */
  public $object;
  /** array() of qImpl */
  public $Q;
  /** array() of sampImpl */
  public $samp;
  /** array() of scriptImpl */
  public $script;
  /** array() of selectImpl */
  public $select;
  /** array() of smallImpl */
  public $small;
  /** array() of spanImpl */
  public $span;
  /** array() of strongImpl */
  public $strong;
  /** array() of subImpl */
  public $sub;
  /** array() of supImpl */
  public $sup;
  /** array() of textareaImpl */
  public $textarea;
  /** array() of ttImpl */
  public $tt;
  /** array() of varImpl */
  public $var;
}

class acronymImpl {
  /** anyType */
  public $class1;
  /** AcronymDocumentEnum_0 */
  public $dir;
  /** string */
  public $id;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** array() of string */
  public $style;
  /** array() of string */
  public $title;
}

class bImpl {
  /** anyType */
  public $class1;
  /** BDocumentEnum_0 */
  public $dir;
  /** string */
  public $id;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** array() of string */
  public $style;
  /** array() of string */
  public $title;
}

class bdoImpl {
  /** anyType */
  public $class1;
  /** BdoDocumentEnum_0 */
  public $dir;
  /** string */
  public $id;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** array() of string */
  public $style;
  /** array() of string */
  public $title;
}

class bigImpl {
  /** anyType */
  public $class1;
  /** BigDocumentEnum_0 */
  public $dir;
  /** string */
  public $id;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** array() of string */
  public $style;
  /** array() of string */
  public $title;
}

class brImpl {
  /** anyType */
  public $class1;
  /** string */
  public $id;
  /** array() of string */
  public $style;
  /** array() of string */
  public $title;
}

class buttonImpl {
  /** string */
  public $accesskey;
  /** anyType */
  public $class1;
  /** ButtonDocumentEnum_2 */
  public $dir;
  /** ButtonDocumentEnum_0 */
  public $disabled;
  /** string */
  public $id;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** string */
  public $onblur;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onfocus;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** array() of string */
  public $style;
  /** int */
  public $tabindex;
  /** array() of string */
  public $title;
  /** ButtonDocumentEnum_1 */
  public $type;
}

class fhir_buttonContent {
  /** array() of abbrImpl */
  public $abbr;
  /** array() of acronymImpl */
  public $acronym;
  /** array() of addressImpl */
  public $address;
  /** array() of bImpl */
  public $B;
  /** array() of bdoImpl */
  public $bdo;
  /** array() of bigImpl */
  public $big;
  /** array() of blockquoteImpl */
  public $blockquote;
  /** array() of brImpl */
  public $br;
  /** array() of citeImpl */
  public $cite;
  /** array() of codeImpl */
  public $code;
  /** array() of delImpl */
  public $del;
  /** array() of dfnImpl */
  public $dfn;
  /** array() of divImpl */
  public $div;
  /** array() of dlImpl */
  public $dl;
  /** array() of emImpl */
  public $em;
  /** array() of h1Impl */
  public $h1;
  /** array() of h2Impl */
  public $h2;
  /** array() of h3Impl */
  public $h3;
  /** array() of h4Impl */
  public $h4;
  /** array() of h5Impl */
  public $h5;
  /** array() of h6Impl */
  public $h6;
  /** array() of hrImpl */
  public $hr;
  /** array() of iImpl */
  public $I;
  /** array() of imgImpl */
  public $img;
  /** array() of insImpl */
  public $ins;
  /** array() of kbdImpl */
  public $kbd;
  /** array() of mapImpl */
  public $map;
  /** array() of noscriptImpl */
  public $noscript;
  /** array() of objectImpl */
  public $object;
  /** array() of olImpl */
  public $ol;
  /** array() of pImpl */
  public $P;
  /** array() of preImpl */
  public $pre;
  /** array() of qImpl */
  public $Q;
  /** array() of sampImpl */
  public $samp;
  /** array() of scriptImpl */
  public $script;
  /** array() of smallImpl */
  public $small;
  /** array() of spanImpl */
  public $span;
  /** array() of strongImpl */
  public $strong;
  /** array() of subImpl */
  public $sub;
  /** array() of supImpl */
  public $sup;
  /** array() of tableImpl */
  public $table;
  /** array() of ttImpl */
  public $tt;
  /** array() of ulImpl */
  public $ul;
  /** array() of varImpl */
  public $var;
}

class addressImpl {
  /** anyType */
  public $class1;
  /** AddressDocumentEnum_0 */
  public $dir;
  /** string */
  public $id;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** array() of string */
  public $style;
  /** array() of string */
  public $title;
}

class blockquoteImpl {
  /** string */
  public $cite;
  /** anyType */
  public $class1;
  /** BlockquoteDocumentEnum_0 */
  public $dir;
  /** string */
  public $id;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** array() of string */
  public $style;
  /** array() of string */
  public $title;
}

class fhir_block {
  /** array() of addressImpl */
  public $address;
  /** array() of blockquoteImpl */
  public $blockquote;
  /** array() of delImpl */
  public $del;
  /** array() of divImpl */
  public $div;
  /** array() of dlImpl */
  public $dl;
  /** array() of fieldsetImpl */
  public $fieldset;
  /** array() of formImpl */
  public $form;
  /** array() of h1Impl */
  public $h1;
  /** array() of h2Impl */
  public $h2;
  /** array() of h3Impl */
  public $h3;
  /** array() of h4Impl */
  public $h4;
  /** array() of h5Impl */
  public $h5;
  /** array() of h6Impl */
  public $h6;
  /** array() of hrImpl */
  public $hr;
  /** array() of insImpl */
  public $ins;
  /** array() of noscriptImpl */
  public $noscript;
  /** array() of olImpl */
  public $ol;
  /** array() of pImpl */
  public $P;
  /** array() of preImpl */
  public $pre;
  /** array() of scriptImpl */
  public $script;
  /** array() of tableImpl */
  public $table;
  /** array() of ulImpl */
  public $ul;
}

class delImpl {
  /** array() of string */
  public $cite2;
  /** anyType */
  public $class1;
  /** dateTime */
  public $datetime;
  /** DelDocumentEnum_0 */
  public $dir;
  /** string */
  public $id;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** array() of string */
  public $style;
  /** array() of string */
  public $title;
}

class dlImpl {
  /** anyType */
  public $class1;
  /** array() of ddImpl */
  public $dd;
  /** DlDocumentEnum_0 */
  public $dir;
  /** array() of dtImpl */
  public $dt;
  /** string */
  public $id;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** array() of string */
  public $style;
  /** array() of string */
  public $title;
}

class ddImpl {
  /** anyType */
  public $class1;
  /** DdDocumentEnum_0 */
  public $dir;
  /** string */
  public $id;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** array() of string */
  public $style;
  /** array() of string */
  public $title;
}

class dtImpl {
  /** anyType */
  public $class1;
  /** DtDocumentEnum_0 */
  public $dir;
  /** string */
  public $id;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** array() of string */
  public $style;
  /** array() of string */
  public $title;
}

class fieldsetImpl {
  /** array() of aImpl */
  public $A;
  /** array() of abbrImpl */
  public $abbr;
  /** array() of acronymImpl */
  public $acronym;
  /** array() of addressImpl */
  public $address;
  /** array() of bImpl */
  public $B;
  /** array() of bdoImpl */
  public $bdo;
  /** array() of bigImpl */
  public $big;
  /** array() of blockquoteImpl */
  public $blockquote;
  /** array() of brImpl */
  public $br;
  /** array() of buttonImpl */
  public $button;
  /** array() of citeImpl */
  public $cite;
  /** anyType */
  public $class1;
  /** array() of codeImpl */
  public $code;
  /** array() of delImpl */
  public $del;
  /** array() of dfnImpl */
  public $dfn;
  /** FieldsetDocumentEnum_0 */
  public $dir;
  /** array() of divImpl */
  public $div;
  /** array() of dlImpl */
  public $dl;
  /** array() of emImpl */
  public $em;
  /** array() of fieldsetImpl */
  public $fieldset;
  /** array() of formImpl */
  public $form;
  /** array() of h1Impl */
  public $h1;
  /** array() of h2Impl */
  public $h2;
  /** array() of h3Impl */
  public $h3;
  /** array() of h4Impl */
  public $h4;
  /** array() of h5Impl */
  public $h5;
  /** array() of h6Impl */
  public $h6;
  /** array() of hrImpl */
  public $hr;
  /** array() of iImpl */
  public $I;
  /** string */
  public $id;
  /** array() of imgImpl */
  public $img;
  /** array() of inputImpl */
  public $input;
  /** array() of insImpl */
  public $ins;
  /** array() of kbdImpl */
  public $kbd;
  /** array() of labelImpl */
  public $label;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** legendImpl */
  public $legend;
  /** array() of mapImpl */
  public $map;
  /** array() of noscriptImpl */
  public $noscript;
  /** array() of objectImpl */
  public $object;
  /** array() of olImpl */
  public $ol;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** array() of pImpl */
  public $P;
  /** array() of preImpl */
  public $pre;
  /** array() of qImpl */
  public $Q;
  /** array() of sampImpl */
  public $samp;
  /** array() of scriptImpl */
  public $script;
  /** array() of selectImpl */
  public $select;
  /** array() of smallImpl */
  public $small;
  /** array() of spanImpl */
  public $span;
  /** array() of strongImpl */
  public $strong;
  /** array() of string */
  public $style;
  /** array() of subImpl */
  public $sub;
  /** array() of supImpl */
  public $sup;
  /** array() of tableImpl */
  public $table;
  /** array() of textareaImpl */
  public $textarea;
  /** array() of string */
  public $title;
  /** array() of ttImpl */
  public $tt;
  /** array() of ulImpl */
  public $ul;
  /** array() of varImpl */
  public $var;
}

class citeImpl {
  /** anyType */
  public $class1;
  /** CiteDocumentEnum_0 */
  public $dir;
  /** string */
  public $id;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** array() of string */
  public $style;
  /** array() of string */
  public $title;
}

class codeImpl {
  /** anyType */
  public $class1;
  /** CodeDocumentEnum_0 */
  public $dir;
  /** string */
  public $id;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** array() of string */
  public $style;
  /** array() of string */
  public $title;
}

class dfnImpl {
  /** anyType */
  public $class1;
  /** DfnDocumentEnum_0 */
  public $dir;
  /** string */
  public $id;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** array() of string */
  public $style;
  /** array() of string */
  public $title;
}

class emImpl {
  /** anyType */
  public $class1;
  /** EmDocumentEnum_0 */
  public $dir;
  /** string */
  public $id;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** array() of string */
  public $style;
  /** array() of string */
  public $title;
}

class formImpl {
  /** string */
  public $accept;
  /** string */
  public $acceptCharset;
  /** string */
  public $action;
  /** anyType */
  public $class1;
  /** FormDocumentEnum_1 */
  public $dir;
  /** string */
  public $enctype;
  /** string */
  public $id;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** FormDocumentEnum_0 */
  public $method;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** string */
  public $onreset;
  /** string */
  public $onsubmit;
  /** array() of string */
  public $style;
  /** array() of string */
  public $title;
}

class fhir_formContent {
  /** array() of addressImpl */
  public $address;
  /** array() of blockquoteImpl */
  public $blockquote;
  /** array() of delImpl */
  public $del;
  /** array() of divImpl */
  public $div;
  /** array() of dlImpl */
  public $dl;
  /** array() of fieldsetImpl */
  public $fieldset;
  /** array() of h1Impl */
  public $h1;
  /** array() of h2Impl */
  public $h2;
  /** array() of h3Impl */
  public $h3;
  /** array() of h4Impl */
  public $h4;
  /** array() of h5Impl */
  public $h5;
  /** array() of h6Impl */
  public $h6;
  /** array() of hrImpl */
  public $hr;
  /** array() of insImpl */
  public $ins;
  /** array() of noscriptImpl */
  public $noscript;
  /** array() of olImpl */
  public $ol;
  /** array() of pImpl */
  public $P;
  /** array() of preImpl */
  public $pre;
  /** array() of scriptImpl */
  public $script;
  /** array() of tableImpl */
  public $table;
  /** array() of ulImpl */
  public $ul;
}

class h1Impl {
  /** anyType */
  public $class1;
  /** H1DocumentEnum_0 */
  public $dir;
  /** string */
  public $id;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** array() of string */
  public $style;
  /** array() of string */
  public $title;
}

class h2Impl {
  /** anyType */
  public $class1;
  /** H2DocumentEnum_0 */
  public $dir;
  /** string */
  public $id;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** array() of string */
  public $style;
  /** array() of string */
  public $title;
}

class h3Impl {
  /** anyType */
  public $class1;
  /** H3DocumentEnum_0 */
  public $dir;
  /** string */
  public $id;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** array() of string */
  public $style;
  /** array() of string */
  public $title;
}

class h4Impl {
  /** anyType */
  public $class1;
  /** H4DocumentEnum_0 */
  public $dir;
  /** string */
  public $id;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** array() of string */
  public $style;
  /** array() of string */
  public $title;
}

class h5Impl {
  /** anyType */
  public $class1;
  /** H5DocumentEnum_0 */
  public $dir;
  /** string */
  public $id;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** array() of string */
  public $style;
  /** array() of string */
  public $title;
}

class h6Impl {
  /** anyType */
  public $class1;
  /** H6DocumentEnum_0 */
  public $dir;
  /** string */
  public $id;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** array() of string */
  public $style;
  /** array() of string */
  public $title;
}

class hrImpl {
  /** anyType */
  public $class1;
  /** HrDocumentEnum_0 */
  public $dir;
  /** string */
  public $id;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** array() of string */
  public $style;
  /** array() of string */
  public $title;
}

class insImpl {
  /** array() of string */
  public $cite2;
  /** anyType */
  public $class1;
  /** dateTime */
  public $datetime;
  /** InsDocumentEnum_0 */
  public $dir;
  /** string */
  public $id;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** array() of string */
  public $style;
  /** array() of string */
  public $title;
}

class noscriptImpl {
  /** anyType */
  public $class1;
  /** NoscriptDocumentEnum_0 */
  public $dir;
  /** string */
  public $id;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** array() of string */
  public $style;
  /** array() of string */
  public $title;
}

class olImpl {
  /** anyType */
  public $class1;
  /** OlDocumentEnum_0 */
  public $dir;
  /** string */
  public $id;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** array() of liImpl */
  public $li;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** array() of string */
  public $style;
  /** array() of string */
  public $title;
}

class liImpl {
  /** anyType */
  public $class1;
  /** LiDocumentEnum_0 */
  public $dir;
  /** string */
  public $id;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** array() of string */
  public $style;
  /** array() of string */
  public $title;
}

class pImpl {
  /** anyType */
  public $class1;
  /** PDocumentEnum_0 */
  public $dir;
  /** string */
  public $id;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** array() of string */
  public $style;
  /** array() of string */
  public $title;
}

class preImpl {
  /** anyType */
  public $class1;
  /** PreDocumentEnum_0 */
  public $dir;
  /** string */
  public $id;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** array() of enum */
  public $space;
  /** array() of string */
  public $style;
  /** array() of string */
  public $title;
}

class fhir_preContent {
  /** array() of aImpl */
  public $A;
  /** array() of abbrImpl */
  public $abbr;
  /** array() of acronymImpl */
  public $acronym;
  /** array() of bImpl */
  public $B;
  /** array() of bdoImpl */
  public $bdo;
  /** array() of bigImpl */
  public $big;
  /** array() of brImpl */
  public $br;
  /** array() of buttonImpl */
  public $button;
  /** array() of citeImpl */
  public $cite;
  /** array() of codeImpl */
  public $code;
  /** array() of delImpl */
  public $del;
  /** array() of dfnImpl */
  public $dfn;
  /** array() of emImpl */
  public $em;
  /** array() of iImpl */
  public $I;
  /** array() of inputImpl */
  public $input;
  /** array() of insImpl */
  public $ins;
  /** array() of kbdImpl */
  public $kbd;
  /** array() of labelImpl */
  public $label;
  /** array() of mapImpl */
  public $map;
  /** array() of qImpl */
  public $Q;
  /** array() of sampImpl */
  public $samp;
  /** array() of scriptImpl */
  public $script;
  /** array() of selectImpl */
  public $select;
  /** array() of smallImpl */
  public $small;
  /** array() of spanImpl */
  public $span;
  /** array() of strongImpl */
  public $strong;
  /** array() of subImpl */
  public $sub;
  /** array() of supImpl */
  public $sup;
  /** array() of textareaImpl */
  public $textarea;
  /** array() of ttImpl */
  public $tt;
  /** array() of varImpl */
  public $var;
}

class enum {
}

class iImpl {
  /** anyType */
  public $class1;
  /** IDocumentEnum_0 */
  public $dir;
  /** string */
  public $id;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** array() of string */
  public $style;
  /** array() of string */
  public $title;
}

class inputImpl {
  /** string */
  public $accept;
  /** string */
  public $accesskey;
  /** InputDocumentEnum_2 */
  public $checked;
  /** anyType */
  public $class1;
  /** InputDocumentEnum_3 */
  public $dir;
  /** InputDocumentEnum_1 */
  public $disabled;
  /** string */
  public $id;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** integer */
  public $maxlength;
  /** string */
  public $onblur;
  /** string */
  public $onchange;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onfocus;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** string */
  public $onselect;
  /** InputDocumentEnum_0 */
  public $readonly;
  /** string */
  public $src;
  /** array() of string */
  public $style;
  /** int */
  public $tabindex;
  /** array() of string */
  public $title;
  /** InputTypeEnum_0 */
  public $type;
  /** string */
  public $usemap;
}

class kbdImpl {
  /** anyType */
  public $class1;
  /** KbdDocumentEnum_0 */
  public $dir;
  /** string */
  public $id;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** array() of string */
  public $style;
  /** array() of string */
  public $title;
}

class labelImpl {
  /** string */
  public $accesskey;
  /** anyType */
  public $class1;
  /** LabelDocumentEnum_0 */
  public $dir;
  /** string */
  public $for;
  /** string */
  public $id;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** string */
  public $onblur;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onfocus;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** array() of string */
  public $style;
  /** array() of string */
  public $title;
}

class mapImpl {
  /** array() of addressImpl */
  public $address;
  /** array() of areaImpl */
  public $area;
  /** array() of blockquoteImpl */
  public $blockquote;
  /** array() of delImpl */
  public $del;
  /** MapDocumentEnum_0 */
  public $dir;
  /** array() of divImpl */
  public $div;
  /** array() of dlImpl */
  public $dl;
  /** array() of fieldsetImpl */
  public $fieldset;
  /** array() of formImpl */
  public $form;
  /** array() of h1Impl */
  public $h1;
  /** array() of h2Impl */
  public $h2;
  /** array() of h3Impl */
  public $h3;
  /** array() of h4Impl */
  public $h4;
  /** array() of h5Impl */
  public $h5;
  /** array() of h6Impl */
  public $h6;
  /** array() of hrImpl */
  public $hr;
  /** string */
  public $id;
  /** array() of insImpl */
  public $ins;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** string */
  public $name;
  /** array() of noscriptImpl */
  public $noscript;
  /** array() of olImpl */
  public $ol;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** array() of pImpl */
  public $P;
  /** array() of preImpl */
  public $pre;
  /** array() of scriptImpl */
  public $script;
  /** array() of string */
  public $style;
  /** array() of tableImpl */
  public $table;
  /** array() of string */
  public $title;
  /** array() of ulImpl */
  public $ul;
}

class areaImpl {
  /** string */
  public $accesskey;
  /** string */
  public $alt;
  /** anyType */
  public $class1;
  /** string */
  public $coords;
  /** AreaDocumentEnum_1 */
  public $dir;
  /** string */
  public $href;
  /** string */
  public $id;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** AreaDocumentEnum_0 */
  public $nohref;
  /** string */
  public $onblur;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onfocus;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** array() of ShapeEnum_0 */
  public $shape;
  /** array() of string */
  public $style;
  /** int */
  public $tabindex;
  /** array() of string */
  public $title;
}

class scriptImpl {
  /** string */
  public $charset;
  /** array() of ScriptDocumentEnum_0 */
  public $defer;
  /** string */
  public $id;
  /** array() of enum */
  public $space;
  /** string */
  public $src;
  /** string */
  public $type;
}

class tableImpl {
  /** integer */
  public $border;
  /** captionImpl */
  public $caption;
  /** string */
  public $cellpadding;
  /** string */
  public $cellspacing;
  /** anyType */
  public $class1;
  /** array() of colImpl */
  public $col;
  /** array() of colgroupImpl */
  public $colgroup;
  /** TableDocumentEnum_0 */
  public $dir;
  /** array() of TFrameEnum_0 */
  public $frame;
  /** string */
  public $id;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** array() of TRulesEnum_0 */
  public $rules;
  /** array() of string */
  public $style;
  /** string */
  public $summary;
  /** array() of tbodyImpl */
  public $tbody;
  /** array() of tfootImpl */
  public $tfoot;
  /** array() of theadImpl */
  public $thead;
  /** array() of string */
  public $title;
  /** array() of trImpl */
  public $tr;
  /** array() of string */
  public $width;
}

class captionImpl {
  /** anyType */
  public $class1;
  /** CaptionDocumentEnum_0 */
  public $dir;
  /** string */
  public $id;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** array() of string */
  public $style;
  /** array() of string */
  public $title;
}

class colImpl {
  /** array() of ColDocumentEnum_1 */
  public $align;
  /** string */
  public $char;
  /** string */
  public $charoff;
  /** anyType */
  public $class1;
  /** ColDocumentEnum_2 */
  public $dir;
  /** string */
  public $id;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** integer */
  public $span;
  /** array() of string */
  public $style;
  /** array() of string */
  public $title;
  /** ColDocumentEnum_0 */
  public $valign;
  /** array() of string */
  public $width;
}

class colgroupImpl {
  /** array() of ColgroupDocumentEnum_1 */
  public $align;
  /** string */
  public $char;
  /** string */
  public $charoff;
  /** anyType */
  public $class1;
  /** array() of colImpl */
  public $col;
  /** ColgroupDocumentEnum_2 */
  public $dir;
  /** string */
  public $id;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** integer */
  public $span;
  /** array() of string */
  public $style;
  /** array() of string */
  public $title;
  /** ColgroupDocumentEnum_0 */
  public $valign;
  /** array() of string */
  public $width;
}

class tbodyImpl {
  /** array() of TbodyDocumentEnum_1 */
  public $align;
  /** string */
  public $char;
  /** string */
  public $charoff;
  /** anyType */
  public $class1;
  /** TbodyDocumentEnum_2 */
  public $dir;
  /** string */
  public $id;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** array() of string */
  public $style;
  /** array() of string */
  public $title;
  /** array() of trImpl */
  public $tr;
  /** TbodyDocumentEnum_0 */
  public $valign;
}

class trImpl {
  /** array() of TrDocumentEnum_1 */
  public $align;
  /** string */
  public $char;
  /** string */
  public $charoff;
  /** anyType */
  public $class1;
  /** TrDocumentEnum_2 */
  public $dir;
  /** string */
  public $id;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** array() of string */
  public $style;
  /** array() of tdImpl */
  public $td;
  /** array() of thImpl */
  public $th;
  /** array() of string */
  public $title;
  /** TrDocumentEnum_0 */
  public $valign;
}

class tdImpl {
  /** array() of string */
  public $abbr2;
  /** array() of TdDocumentEnum_1 */
  public $align;
  /** string */
  public $char;
  /** string */
  public $charoff;
  /** anyType */
  public $class1;
  /** integer */
  public $colspan;
  /** TdDocumentEnum_2 */
  public $dir;
  /** anyType */
  public $headers;
  /** string */
  public $id;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** integer */
  public $rowspan;
  /** array() of ScopeEnum_0 */
  public $scope;
  /** array() of string */
  public $style;
  /** array() of string */
  public $title;
  /** TdDocumentEnum_0 */
  public $valign;
}

class thImpl {
  /** array() of string */
  public $abbr2;
  /** array() of ThDocumentEnum_1 */
  public $align;
  /** string */
  public $char;
  /** string */
  public $charoff;
  /** anyType */
  public $class1;
  /** integer */
  public $colspan;
  /** ThDocumentEnum_2 */
  public $dir;
  /** anyType */
  public $headers;
  /** string */
  public $id;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** integer */
  public $rowspan;
  /** array() of ScopeEnum_0 */
  public $scope;
  /** array() of string */
  public $style;
  /** array() of string */
  public $title;
  /** ThDocumentEnum_0 */
  public $valign;
}

class tfootImpl {
  /** array() of TfootDocumentEnum_1 */
  public $align;
  /** string */
  public $char;
  /** string */
  public $charoff;
  /** anyType */
  public $class1;
  /** TfootDocumentEnum_2 */
  public $dir;
  /** string */
  public $id;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** array() of string */
  public $style;
  /** array() of string */
  public $title;
  /** array() of trImpl */
  public $tr;
  /** TfootDocumentEnum_0 */
  public $valign;
}

class theadImpl {
  /** array() of TheadDocumentEnum_1 */
  public $align;
  /** string */
  public $char;
  /** string */
  public $charoff;
  /** anyType */
  public $class1;
  /** TheadDocumentEnum_2 */
  public $dir;
  /** string */
  public $id;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** array() of string */
  public $style;
  /** array() of string */
  public $title;
  /** array() of trImpl */
  public $tr;
  /** TheadDocumentEnum_0 */
  public $valign;
}

class ulImpl {
  /** anyType */
  public $class1;
  /** UlDocumentEnum_0 */
  public $dir;
  /** string */
  public $id;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** array() of liImpl */
  public $li;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** array() of string */
  public $style;
  /** array() of string */
  public $title;
}

class qImpl {
  /** array() of string */
  public $cite2;
  /** anyType */
  public $class1;
  /** QDocumentEnum_0 */
  public $dir;
  /** string */
  public $id;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** array() of string */
  public $style;
  /** array() of string */
  public $title;
}

class sampImpl {
  /** anyType */
  public $class1;
  /** SampDocumentEnum_0 */
  public $dir;
  /** string */
  public $id;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** array() of string */
  public $style;
  /** array() of string */
  public $title;
}

class selectImpl {
  /** anyType */
  public $class1;
  /** SelectDocumentEnum_2 */
  public $dir;
  /** SelectDocumentEnum_0 */
  public $disabled;
  /** string */
  public $id;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** SelectDocumentEnum_1 */
  public $multiple;
  /** string */
  public $onblur;
  /** string */
  public $onchange;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onfocus;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** array() of optgroupImpl */
  public $optgroup;
  /** array() of optionImpl */
  public $option;
  /** integer */
  public $size;
  /** array() of string */
  public $style;
  /** int */
  public $tabindex;
  /** array() of string */
  public $title;
}

class optgroupImpl {
  /** anyType */
  public $class1;
  /** OptgroupDocumentEnum_1 */
  public $dir;
  /** OptgroupDocumentEnum_0 */
  public $disabled;
  /** string */
  public $id;
  /** array() of string */
  public $label;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** array() of optionImpl */
  public $option;
  /** array() of string */
  public $style;
  /** array() of string */
  public $title;
}

class optionImpl {
  /** anyType */
  public $class1;
  /** OptionDocumentEnum_2 */
  public $dir;
  /** OptionDocumentEnum_0 */
  public $disabled;
  /** string */
  public $id;
  /** array() of string */
  public $label;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** OptionDocumentEnum_1 */
  public $selected;
  /** array() of string */
  public $style;
  /** array() of string */
  public $title;
}

class smallImpl {
  /** anyType */
  public $class1;
  /** SmallDocumentEnum_0 */
  public $dir;
  /** string */
  public $id;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** array() of string */
  public $style;
  /** array() of string */
  public $title;
}

class spanImpl {
  /** anyType */
  public $class1;
  /** SpanDocumentEnum_0 */
  public $dir;
  /** string */
  public $id;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** array() of string */
  public $style;
  /** array() of string */
  public $title;
}

class strongImpl {
  /** anyType */
  public $class1;
  /** StrongDocumentEnum_0 */
  public $dir;
  /** string */
  public $id;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** array() of string */
  public $style;
  /** array() of string */
  public $title;
}

class subImpl {
  /** anyType */
  public $class1;
  /** SubDocumentEnum_0 */
  public $dir;
  /** string */
  public $id;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** array() of string */
  public $style;
  /** array() of string */
  public $title;
}

class supImpl {
  /** anyType */
  public $class1;
  /** SupDocumentEnum_0 */
  public $dir;
  /** string */
  public $id;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** array() of string */
  public $style;
  /** array() of string */
  public $title;
}

class textareaImpl {
  /** string */
  public $accesskey;
  /** anyType */
  public $class1;
  /** integer */
  public $cols;
  /** TextareaDocumentEnum_2 */
  public $dir;
  /** TextareaDocumentEnum_1 */
  public $disabled;
  /** string */
  public $id;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** string */
  public $onblur;
  /** string */
  public $onchange;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onfocus;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** string */
  public $onselect;
  /** TextareaDocumentEnum_0 */
  public $readonly;
  /** integer */
  public $rows;
  /** array() of string */
  public $style;
  /** int */
  public $tabindex;
  /** array() of string */
  public $title;
}

class ttImpl {
  /** anyType */
  public $class1;
  /** TtDocumentEnum_0 */
  public $dir;
  /** string */
  public $id;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** array() of string */
  public $style;
  /** array() of string */
  public $title;
}

class varImpl {
  /** anyType */
  public $class1;
  /** VarDocumentEnum_0 */
  public $dir;
  /** string */
  public $id;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** array() of string */
  public $style;
  /** array() of string */
  public $title;
}

class imgImpl {
  /** string */
  public $alt;
  /** anyType */
  public $class1;
  /** ImgDocumentEnum_1 */
  public $dir;
  /** string */
  public $height;
  /** string */
  public $id;
  /** array() of ImgDocumentEnum_0 */
  public $ismap;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** string */
  public $longdesc;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** string */
  public $src;
  /** array() of string */
  public $style;
  /** array() of string */
  public $title;
  /** string */
  public $usemap;
  /** array() of string */
  public $width;
}

class legendImpl {
  /** string */
  public $accesskey;
  /** anyType */
  public $class1;
  /** LegendDocumentEnum_0 */
  public $dir;
  /** string */
  public $id;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** array() of string */
  public $style;
  /** array() of string */
  public $title;
}

class objectImpl {
  /** array() of aImpl */
  public $A;
  /** array() of abbrImpl */
  public $abbr;
  /** array() of acronymImpl */
  public $acronym;
  /** array() of addressImpl */
  public $address;
  /** string */
  public $archive;
  /** array() of bImpl */
  public $B;
  /** array() of bdoImpl */
  public $bdo;
  /** array() of bigImpl */
  public $big;
  /** array() of blockquoteImpl */
  public $blockquote;
  /** array() of brImpl */
  public $br;
  /** array() of buttonImpl */
  public $button;
  /** array() of citeImpl */
  public $cite;
  /** anyType */
  public $class1;
  /** string */
  public $classid;
  /** array() of codeImpl */
  public $code;
  /** string */
  public $codebase;
  /** string */
  public $codetype;
  /** string */
  public $data;
  /** ObjectDocumentEnum_0 */
  public $declare;
  /** array() of delImpl */
  public $del;
  /** array() of dfnImpl */
  public $dfn;
  /** ObjectDocumentEnum_1 */
  public $dir;
  /** array() of divImpl */
  public $div;
  /** array() of dlImpl */
  public $dl;
  /** array() of emImpl */
  public $em;
  /** array() of fieldsetImpl */
  public $fieldset;
  /** array() of formImpl */
  public $form;
  /** array() of h1Impl */
  public $h1;
  /** array() of h2Impl */
  public $h2;
  /** array() of h3Impl */
  public $h3;
  /** array() of h4Impl */
  public $h4;
  /** array() of h5Impl */
  public $h5;
  /** array() of h6Impl */
  public $h6;
  /** string */
  public $height;
  /** array() of hrImpl */
  public $hr;
  /** array() of iImpl */
  public $I;
  /** string */
  public $id;
  /** array() of imgImpl */
  public $img;
  /** array() of inputImpl */
  public $input;
  /** array() of insImpl */
  public $ins;
  /** array() of kbdImpl */
  public $kbd;
  /** array() of labelImpl */
  public $label;
  /** string */
  public $lang;
  /** array() of string */
  public $lang2;
  /** array() of mapImpl */
  public $map;
  /** string */
  public $name;
  /** array() of noscriptImpl */
  public $noscript;
  /** array() of objectImpl */
  public $object;
  /** array() of olImpl */
  public $ol;
  /** string */
  public $onclick;
  /** string */
  public $ondblclick;
  /** string */
  public $onkeydown;
  /** string */
  public $onkeypress;
  /** string */
  public $onkeyup;
  /** string */
  public $onmousedown;
  /** string */
  public $onmousemove;
  /** string */
  public $onmouseout;
  /** string */
  public $onmouseover;
  /** string */
  public $onmouseup;
  /** array() of pImpl */
  public $P;
  /** array() of paramImpl */
  public $param;
  /** array() of preImpl */
  public $pre;
  /** array() of qImpl */
  public $Q;
  /** array() of sampImpl */
  public $samp;
  /** array() of scriptImpl */
  public $script;
  /** array() of selectImpl */
  public $select;
  /** array() of smallImpl */
  public $small;
  /** array() of spanImpl */
  public $span;
  /** string */
  public $standby;
  /** array() of strongImpl */
  public $strong;
  /** array() of string */
  public $style;
  /** array() of subImpl */
  public $sub;
  /** array() of supImpl */
  public $sup;
  /** int */
  public $tabindex;
  /** array() of tableImpl */
  public $table;
  /** array() of textareaImpl */
  public $textarea;
  /** array() of string */
  public $title;
  /** array() of ttImpl */
  public $tt;
  /** string */
  public $type;
  /** array() of ulImpl */
  public $ul;
  /** string */
  public $usemap;
  /** array() of varImpl */
  public $var;
  /** array() of string */
  public $width;
}

class paramImpl {
  /** string */
  public $id;
  /** string */
  public $type;
  /** ParamDocumentEnum_0 */
  public $valuetype;
}

class fhir_narrativeStatus {
  /** array() of NarrativeStatusListEnum_0 */
  public $value;
}

class fhirResponse {
}

class AddressUseListEnum_0 {
}

class ContactSystemListEnum_0 {
}

class ContactUseListEnum_0 {
}

class NameUseListEnum_0 {
}

class IdentifierUseListEnum_0 {
}

class QuantityCompararatorListEnum_0 {
}

class UnitsOfTimeListEnum_0 {
}

class EventTimingListEnum_0 {
}

class LinkTypeListEnum_0 {
}

class CausalityExpectationListEnum_0 {
}

class ExposureTypeListEnum_0 {
}

class ReactionSeverityListEnum_0 {
}

class AlertStatusListEnum_0 {
}

class CriticalityListEnum_0 {
}

class SensitivityTypeListEnum_0 {
}

class SensitivityStatusListEnum_0 {
}

class CarePlanActivityCategoryListEnum_0 {
}

class CarePlanActivityStatusListEnum_0 {
}

class CarePlanGoalStatusListEnum_0 {
}

class CarePlanStatusListEnum_0 {
}

class CompositionAttestationModeListEnum_0 {
}

class CompositionStatusListEnum_0 {
}

class ConceptMapEquivalenceListEnum_0 {
}

class ValueSetStatusListEnum_0 {
}

class ConditionRelationshipTypeListEnum_0 {
}

class ConditionStatusListEnum_0 {
}

class DocumentModeListEnum_0 {
}

class MessageSignificanceCategoryListEnum_0 {
}

class ConformanceEventModeListEnum_0 {
}

class RestfulConformanceModeListEnum_0 {
}

class RestfulOperationSystemListEnum_0 {
}

class SearchParamTypeListEnum_0 {
}

class RestfulOperationTypeListEnum_0 {
}

class ConformanceStatementStatusListEnum_0 {
}

class DiagnosticOrderStatusListEnum_0 {
}

class DiagnosticOrderPriorityListEnum_0 {
}

class DiagnosticReportStatusListEnum_0 {
}

class DocumentReferenceStatusListEnum_0 {
}

class DocumentRelationshipTypeListEnum_0 {
}

class EncounterClassListEnum_0 {
}

class EncounterStateListEnum_0 {
}

class GroupTypeListEnum_0 {
}

class InstanceAvailabilityListEnum_0 {
}

class ImagingModalityListEnum_0 {
}

class ModalityListEnum_0 {
}

class ListModeListEnum_0 {
}

class LocationModeListEnum_0 {
}

class LocationStatusListEnum_0 {
}

class MediaTypeListEnum_0 {
}

class MedicationKindListEnum_0 {
}

class MedicationAdministrationStatusListEnum_0 {
}

class MedicationDispenseStatusListEnum_0 {
}

class MedicationPrescriptionStatusListEnum_0 {
}

class ResponseTypeListEnum_0 {
}

class ObservationReliabilityListEnum_0 {
}

class ObservationStatusListEnum_0 {
}

class IssueSeverityListEnum_0 {
}

class OrderOutcomeStatusListEnum_0 {
}

class ProcedureRelationshipTypeListEnum_0 {
}

class ExtensionContextListEnum_0 {
}

class BindingConformanceListEnum_0 {
}

class ConstraintSeverityListEnum_0 {
}

class AggregationModeListEnum_0 {
}

class ResourceProfileStatusListEnum_0 {
}

class PropertyRepresentationListEnum_0 {
}

class SlicingRulesListEnum_0 {
}

class ProvenanceEntityRoleListEnum_0 {
}

class QueryOutcomeListEnum_0 {
}

class QuestionnaireStatusListEnum_0 {
}

class SecurityEventActionListEnum_0 {
}

class SecurityEventOutcomeListEnum_0 {
}

class SecurityEventObjectLifecycleListEnum_0 {
}

class SecurityEventObjectRoleListEnum_0 {
}

class SecurityEventObjectTypeListEnum_0 {
}

class SecurityEventParticipantNetworkTypeListEnum_0 {
}

class HierarchicalRelationshipTypeListEnum_0 {
}

class SupplyDispenseStatusListEnum_0 {
}

class SupplyStatusListEnum_0 {
}

class FilterOperatorListEnum_0 {
}

class DivDocumentEnum_0 {
}

class ADocumentEnum_0 {
}

class ShapeEnum_0 {
}

class AbbrDocumentEnum_0 {
}

class AcronymDocumentEnum_0 {
}

class BDocumentEnum_0 {
}

class BdoDocumentEnum_0 {
}

class BigDocumentEnum_0 {
}

class ButtonDocumentEnum_2 {
}

class ButtonDocumentEnum_0 {
}

class ButtonDocumentEnum_1 {
}

class AddressDocumentEnum_0 {
}

class BlockquoteDocumentEnum_0 {
}

class DelDocumentEnum_0 {
}

class DdDocumentEnum_0 {
}

class DlDocumentEnum_0 {
}

class DtDocumentEnum_0 {
}

class CiteDocumentEnum_0 {
}

class CodeDocumentEnum_0 {
}

class DfnDocumentEnum_0 {
}

class FieldsetDocumentEnum_0 {
}

class EmDocumentEnum_0 {
}

class FormDocumentEnum_1 {
}

class FormDocumentEnum_0 {
}

class H1DocumentEnum_0 {
}

class H2DocumentEnum_0 {
}

class H3DocumentEnum_0 {
}

class H4DocumentEnum_0 {
}

class H5DocumentEnum_0 {
}

class H6DocumentEnum_0 {
}

class HrDocumentEnum_0 {
}

class InsDocumentEnum_0 {
}

class NoscriptDocumentEnum_0 {
}

class OlDocumentEnum_0 {
}

class LiDocumentEnum_0 {
}

class PDocumentEnum_0 {
}

class PreDocumentEnum_0 {
}

class IDocumentEnum_0 {
}

class InputDocumentEnum_2 {
}

class InputDocumentEnum_3 {
}

class InputDocumentEnum_1 {
}

class InputDocumentEnum_0 {
}

class InputTypeEnum_0 {
}

class KbdDocumentEnum_0 {
}

class LabelDocumentEnum_0 {
}

class AreaDocumentEnum_1 {
}

class AreaDocumentEnum_0 {
}

class MapDocumentEnum_0 {
}

class ScriptDocumentEnum_0 {
}

class CaptionDocumentEnum_0 {
}

class ColDocumentEnum_1 {
}

class ColDocumentEnum_2 {
}

class ColDocumentEnum_0 {
}

class ColgroupDocumentEnum_1 {
}

class ColgroupDocumentEnum_2 {
}

class ColgroupDocumentEnum_0 {
}

class TableDocumentEnum_0 {
}

class TFrameEnum_0 {
}

class TRulesEnum_0 {
}

class TbodyDocumentEnum_1 {
}

class TbodyDocumentEnum_2 {
}

class TrDocumentEnum_1 {
}

class TrDocumentEnum_2 {
}

class TdDocumentEnum_1 {
}

class TdDocumentEnum_2 {
}

class ScopeEnum_0 {
}

class TdDocumentEnum_0 {
}

class ThDocumentEnum_1 {
}

class ThDocumentEnum_2 {
}

class ThDocumentEnum_0 {
}

class TrDocumentEnum_0 {
}

class TbodyDocumentEnum_0 {
}

class TfootDocumentEnum_1 {
}

class TfootDocumentEnum_2 {
}

class TfootDocumentEnum_0 {
}

class TheadDocumentEnum_1 {
}

class TheadDocumentEnum_2 {
}

class TheadDocumentEnum_0 {
}

class UlDocumentEnum_0 {
}

class QDocumentEnum_0 {
}

class SampDocumentEnum_0 {
}

class SelectDocumentEnum_2 {
}

class SelectDocumentEnum_0 {
}

class SelectDocumentEnum_1 {
}

class OptgroupDocumentEnum_1 {
}

class OptgroupDocumentEnum_0 {
}

class OptionDocumentEnum_2 {
}

class OptionDocumentEnum_0 {
}

class OptionDocumentEnum_1 {
}

class SmallDocumentEnum_0 {
}

class SpanDocumentEnum_0 {
}

class StrongDocumentEnum_0 {
}

class SubDocumentEnum_0 {
}

class SupDocumentEnum_0 {
}

class TextareaDocumentEnum_2 {
}

class TextareaDocumentEnum_1 {
}

class TextareaDocumentEnum_0 {
}

class TtDocumentEnum_0 {
}

class VarDocumentEnum_0 {
}

class ImgDocumentEnum_1 {
}

class ImgDocumentEnum_0 {
}

class LegendDocumentEnum_0 {
}

class ObjectDocumentEnum_0 {
}

class ObjectDocumentEnum_1 {
}

class ParamDocumentEnum_0 {
}

class NarrativeStatusListEnum_0 {
}

$patient = new fhir_patient();
$patient->birthDate = "10/10/1940";
$name = new fhir_humanName();
$patient->name = array($name);
$given_name = new fhir_string();
$given_name->value = "John";
$family_name = new fhir_string();
$family_name->value = "Smith";
$name->family = array($family_name);
$name->given = array($given_name);
$id_pas = new fhir_identifier();
$id_pas->use = new fhir_identifierUse;
$id_pas->use->value = "PAS";
$id_pas->value = "1000001";
$id_nhs = new fhir_identifier();
$id_nhs->use = new fhir_identifierUse;
$id_nhs->use->value = "NHS";
$id_nhs->value = "X0000001";
$patient->identifierArray = array($id_pas, $id_nhs);

echo preg_replace('/,\s*"[^"]+":null|"[^"]+":null,?/', '', json_encode($patient, true)) . PHP_EOL;

?>
