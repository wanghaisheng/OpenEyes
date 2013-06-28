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
 * This is the model class for table "event_type".
 *
 * The followings are the available columns in table 'event_type':
 * @property string $id
 * @property string $name
 *
 * The followings are the available model relations:
 * @property Event[] $events
 * @property EventTypeElementTypeAssignment[] $eventTypeElementTypeAssignments
 */
class EventType extends BaseActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return EventType the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'event_type';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('name', 'length', 'max'=>40),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'events' => array(self::HAS_MANY, 'Event', 'event_type_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
		);
	}

	public function getEventTypeModules() {
		$legacy_events = EventGroup::model()->find('code=?',array('Le'));

		$criteria = new CDbCriteria;
		$criteria->condition = "class_name in ('".implode("','",array_keys(Yii::app()->getModules()))."') and event_group_id != $legacy_events->id";
		$criteria->order = "name asc";
		return EventType::model()->findAll($criteria);
	}
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}

	public function getSpecialty() {
		preg_match('/^([A-Z][a-z]+)([A-Z][a-z]+)([A-Z][a-z]+)$/',$this->class_name,$m);
		return Specialty::model()->find('code=?',array(strtoupper($m[1])));
	}

	public function getEvent_group() {
		preg_match('/^([A-Z][a-z]+)([A-Z][a-z]+)([A-Z][a-z]+)$/',$this->class_name,$m);
		return EventGroup::model()->find('code=?',array($m[2]));
	}

	public function getActiveList() {
		$criteria = new CDbCriteria;
		$criteria->distinct = true;
		$criteria->select = 'event_type_id';

		$event_type_ids = array();
		foreach (Event::model()->findAll($criteria) as $event) {
			$event_type_ids[] = $event->event_type_id;
		}

		$criteria = new CDbCriteria;
		$criteria->addInCondition('id',$event_type_ids);
		$criteria->order = 'name asc';

		return CHtml::listData(EventType::model()->findAll($criteria), 'id', 'name');
	}

	public function getDisabled() {
		if (Config::has('modules_disabled')) {
			foreach (Config::get('modules_disabled') as $module => $params) {
				if (is_array($params)) {
					if ($module == $this->class_name) {
						return true;
					}
				} else {
					if ($params == $this->class_name) {
						return true;
					}
				}
			}
		}

		return false;
	}

	public function getDisabled_title() {
		if (Config::has('modules_disabled')) {
			$disabled = Config::get('modules_disabled');
			if (isset($disabled[$this->class_name]['title'])) {
				return $disabled[$this->class_name]['title'];
			}
		}
		return "This module is disabled";
	}

	public function getDisabled_detail() {
		if (Config::has('modules_disabled')) {
			$disabled = Config::get('modules_disabled');
			if (isset($disabled[$this->class_name]['detail'])) {
				return $disabled[$this->class_name]['detail'];
			}
		}
		return "The ".$this->name." module will be available in an upcoming release.";
	}

	public function getApi() {
		return Yii::app()->moduleAPI->get($this->class_name);
	}

	public function registerShortCode($code,$method,$description=false) {
		if (!preg_match('/^[a-zA-Z]{3}$/',$code)) {
			throw new Exception("Invalid shortcode: $code");
		}

		$default_code = $code;

		if (PatientShortcode::model()->find('code=?',array(strtolower($code)))) {
			$n = '00';
			while (PatientShortcode::model()->find('z'.$n)) {
				$n = str_pad($n+1,2,'0',STR_PAD_LEFT);
			}
			$code = "z$n";

			echo "Warning: attempt to register duplicate shortcode '$default_code', replaced with 'z$n'\n";
		}

		$ps = new PatientShortcode;
		$ps->event_type_id = $this->id;
		$ps->code = $code;
		$ps->default_code = $default_code;
		$ps->method = $method;
		$ps->description = $description;

		if (!$ps->save()) {
			throw new Exception("Unable to save PatientShortcode: ".print_r($ps->getErrors(),true));
		}
	}

	public function getConfig($key) {
		if ($config = Config::model()->with('configKey')->find('t.module_name=? and configKey.name=?',array($this->class_name,$key))) {
			return $config->returnValue;
		}
		return null;
	}

	public function setConfig($key, $value) {
		if (!$_key = ConfigKey::model()->find('t.module_name=? and name=?',array($this->class_name,$key))) {
			if (!$_key = ConfigKey::model()->find('name=?',array($key))) {
				throw new Exception("config key not found: $key");
			}
		}

		if (!$config = Config::model()->find('config_key_id=? and module_name=?',array($_key->id,$this->class_name))) {
			$config = new Config;
			$config->config_key_id = $_key->id;
			$config->module_name = $this->class_name;
		}

		if (is_array($value)) {
			$config->value = serialize($value);
		} else {
			$config->value = $value;
		}

		if (!$config->save()) {
			throw new Exception("Unable to save config item: ".print_r($config->getErrors(),true));
		}

		return $_key->setConfig($value);
	}
}
