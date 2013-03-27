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

/**
 * A class that all OpenEyes active record classes should extend.
 *
 * Currently its only purpose is to remove all html tags to
 * prevent XSS.
 */
class BaseActiveRecord extends CActiveRecord
{
	public $spoof = array();

	/**
	 * Audit log
	 */
	public function behaviors() {
		if(Yii::app()->params['audit_trail']) {
			return array(
				'LoggableBehavior' => array(
					'class' => 'application.behaviors.LoggableBehavior',
				),
			);
		} else {
			return array();
		}
	}
	
	/**
	 * Strips all html tags out of attributes to be saved.
	 * @return boolean
	 */
	protected function beforeSave() {
		// Detect nullable foreign keys and replace "" with null (to fix html dropdowns breaking contraints)
		foreach ($this->tableSchema->foreignKeys as $field => $stuff) {
			if ($this->tableSchema->columns[$field]->allowNull && !$this->{$field}) {
				$this->{$field} = null;
			}
		}

		return parent::beforeSave();
	}

	/**
	 * @param boolean $runValidation
	 * @param array $attributes
	 * @param boolean $allow_overriding - if true allows created/modified user/date to be set and saved via the model (otherwise gets overriden)
	 * @return boolean
	 */
	public function save($runValidation=true, $attributes=null, $allow_overriding=false)
	{
		$user_id = null;

		try {
			if (isset(Yii::app()->user)) {
				$user_id = Yii::app()->user->id;
			}
		} catch (Exception $e) {
		}

		if ($this->getIsNewRecord() || !isset($this->id)) {
			if (!$allow_overriding || $this->created_user_id == 1) {
				// Set creation properties
				if ($user_id === NULL) {
					// Revert to the admin user
					$this->created_user_id = 1;
				} else {
					$this->created_user_id = $user_id;
				}
			}
			if (!$allow_overriding || $this->created_date == "1900-01-01 00:00:00") {
				$this->created_date = date('Y-m-d H:i:s');
			}
		}

		try {
			if (!$allow_overriding || $this->last_modified_user_id == 1) {
				// Set the last_modified_user_id and last_modified_date fields
				if ($user_id === NULL) {
					// Revert to the admin user
					// need this try/catch block here to make older migrations pass with this hook in place
					$this->last_modified_user_id = 1;
				} else {
					$this->last_modified_user_id = $user_id;
				}
			}
			if (!$allow_overriding || $this->last_modified_date == "1900-01-01 00:00:00") {
				$this->last_modified_date = date('Y-m-d H:i:s');
			}
		} catch (Exception $e) {
		}

		return parent::save($runValidation, $attributes);
	}

	/**
	 * Returns a date field in NHS format
	 * @param string $attribute
	 * @return string
	 */
	public function NHSDate($attribute, $empty_string = '-') {
		if($value = $this->getAttribute($attribute)) {
			return Helper::convertMySQL2NHS($value, $empty_string);
		}
	}

	public function NHSDateAsHTML($attribute, $empty_string = '-') {
		if($value = $this->getAttribute($attribute)) {
			return Helper::convertMySQL2HTML($value, $empty_string);
		}
	}

	public function getAuditAttributes() {
		$attributes = array();

		foreach ($this->getAttributes() as $key => $value) {
			$attributes[$key] = $this->{$key};
		}

		return serialize($attributes);
	}

	public function audit($target, $action, $data=null, $log=false, $properties=array()) {
		foreach (array('patient_id','episode_id','event_id','user_id','site_id','firm_id') as $field) {
			if (isset($this->{$field}) && !isset($properties[$field])) {
				$properties[$field] = $this->{$field};
			}
		}

		if ($data === null) {
			$data = $this->getAuditAttributes();
		}

		Audit::add($target, $action, $data, $log, $properties);
	}

	function getFormOptions($table) {
		$options = array();

		$table_exists = false;

		foreach (Yii::app()->db->createCommand("show tables;")->query() as $_table) {
			foreach ($_table as $key => $value) {
				if ("element_type_$table" == $value) {
					$table_exists = true;
					break;
				}
			}
		}

		if ($table_exists) {
			foreach (Yii::app()->db->createCommand()
					->select("$table.*")
					->from($table)
					->join("element_type_$table","element_type_$table.{$table}_id = $table.id")
					->where("element_type_id = ".$this->getElementType()->id)
					->order("display_order asc")
					->queryAll() as $option) {

				$options[$option['id']] = $option['name'];
			}
		} else {
			foreach (Yii::app()->db->createCommand()
					->select("$table.*")
					->from($table)
					->queryAll() as $option) {

				$options[$option['id']] = $option['name'];
			}
		}

		return $options;
	}

	public function validate($attributes=null, $clearErrors=true, $include_models=false) {
		$result = parent::validate($attributes, $clearErrors);

		if ($include_models) {
			foreach ($include_models as $model) {
				$obj = new $model;
				$obj->loadFrom($_POST[get_class($this)]);

				if (!$obj->validate()) {
					foreach ($obj->getErrors() as $key => $value) {
						$this->addError(get_class($this),$value[0]);
					}
					$result = false;
				}
			}
		}

		return $result;
	}

	public function loadFrom($data) {
		foreach ($data as $key => $value) {
			if (in_array($key,$this->attributeNames())) {
				$this->$key = $value;
			} else {
				$this->spoof[$key] = $value;
			}
		}
	}
}
