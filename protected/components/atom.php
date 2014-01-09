<?php

class atom_feedType {
  /** array() of atom_personType */
  public $authorArray;
  /** string */
  public $base;
  /** array() of atom_categoryType */
  public $categoryArray;
  /** array() of atom_personType */
  public $contributorArray;
  /** array() of atom_entryType */
  public $entryArray;
  /** array() of atom_generatorType */
  public $generatorArray;
  /** array() of atom_iconType */
  public $iconArray;
  /** array() of atom_idType */
  public $idArray;
  /** string */
  public $lang;
  /** array() of atom_linkType */
  public $linkArray;
  /** array() of atom_logoType */
  public $logoArray;
  /** array() of atom_textType */
  public $rightsArray;
  /** array() of atom_textType */
  public $subtitleArray;
  /** array() of atom_textType */
  public $titleArray;
  /** array() of atom_dateTimeType */
  public $updatedArray;
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

class atom_personType {
  /** string */
  public $base;
  /** array() of string */
  public $emailArray;
  /** string */
  public $lang;
  /** array() of string */
  public $nameArray;
  /** array() of atom_uriType */
  public $uriArray;
}

class atom_uriType {
  /** string */
  public $base;
  /** string */
  public $lang;
}

class javaUriHolderEx {
}

class javaUriHolder {
}

class stringEnumAbstractBase {
}

class gDate {
}

class gDuration {
}

class atom_categoryType {
  /** string */
  public $base;
  /** array() of string */
  public $label;
  /** string */
  public $lang;
  /** string */
  public $scheme;
  /** string */
  public $term;
}

class atom_entryType {
  /** array() of atom_personType */
  public $authorArray;
  /** string */
  public $base;
  /** array() of atom_categoryType */
  public $categoryArray;
  /** array() of atom_contentType */
  public $contentArray;
  /** array() of atom_personType */
  public $contributorArray;
  /** array() of atom_idType */
  public $idArray;
  /** string */
  public $lang;
  /** array() of atom_linkType */
  public $linkArray;
  /** array() of atom_dateTimeType */
  public $publishedArray;
  /** array() of atom_textType */
  public $rightsArray;
  /** array() of atom_textType */
  public $sourceArray;
  /** array() of atom_textType */
  public $summaryArray;
  /** array() of atom_textType */
  public $titleArray;
  /** array() of atom_dateTimeType */
  public $updatedArray;
}

class atom_contentType {
  /** string */
  public $base;
  /** string */
  public $lang;
  /** string */
  public $src;
  /** string */
  public $type;
}

class atom_idType {
  /** string */
  public $base;
  /** string */
  public $lang;
}

class atom_linkType {
  /** string */
  public $base;
  /** string */
  public $href;
  /** string */
  public $hreflang;
  /** string */
  public $lang;
  /** integer */
  public $length;
  /** string */
  public $rel;
  /** array() of string */
  public $title;
  /** string */
  public $type;
}

class atom_dateTimeType {
  /** string */
  public $base;
  /** string */
  public $lang;
}

class javaGDateHolderEx {
}

class atom_textType {
  /** string */
  public $base;
  /** string */
  public $lang;
  /** TextTypeEnum_0 */
  public $type;
}

class atom_generatorType {
  /** string */
  public $base;
  /** string */
  public $lang;
  /** string */
  public $uri;
  /** string */
  public $version;
}

class javaStringHolderEx {
}

class javaStringHolder {
}

class atom_iconType {
  /** string */
  public $base;
  /** string */
  public $lang;
}

class atom_logoType {
  /** string */
  public $base;
  /** string */
  public $lang;
}

class feedTypeResponse {
}

class TextTypeEnum_0 {
}

?>
