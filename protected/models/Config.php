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
 * This is the model class for table "config".
 *
 * The followings are the available columns in table 'config':
 * @property integer $id
 * @property integer $config_key_id
 * @property integer $event_type_id
 * @property string $value
 *
 * The followings are the available model relations:
 * @property ConfigKey $configKey
 * @property EventType $eventType
 */
class Config extends BaseActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Config the static model class
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
		return 'config';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('config_key_id, value', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, config_key_id, event_type_id, value', 'safe', 'on'=>'search'),
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
			'configKey' => array(self::BELONGS_TO, 'ConfigKey', 'config_key_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
		);
	}

	static public function has($key) {
		$criteria = new CDbCriteria;
		$criteria->addCondition('configKey.name = :key');
		$criteria->params[':key'] = $key;
		return (boolean)Config::model()->with('configKey')->find($criteria);
	}

	static public function get($key, $missing_ok=false) {
		$fp = fopen("/tmp/log","a+");
		fwrite($fp,"looking up $key ... \n");
		fclose($fp);

		// Yii::app()->getController()->module	< null or class_name

		if (!$_key = ConfigKey::model()->with('configType')->find('t.name=?',array($key))) {
			throw new Exception("requested config_key not defined: $key");
		}

		if (in_array($_key->configType->name,array('StringList','MultiSelectFromTable','Menu'))) {
			// key types that are stored as arrays and should be merged from all entries

			if ($config = Config::model()->find('config_key_id=? and module_name is null',array($_key->id))) {
				$result = $config->returnValue;
			}

			foreach (Config::model()->findAll('config_key_id=? and module_name is not null',array($_key->id)) as $config) {
				if (!isset($result)) {
					$result = array();
				}
				$result = array_merge($result,$config->returnValue);
			}

			if (isset($result)) {
				return $result;
			}
		} else {
			// key types that should only have a single entry
			if ($config = Config::model()->find('config_key_id=?',array($_key->id))) {
				return $config->returnValue;
			}
		}

		if ($_key->default_value || strlen($_key->default_value) >0) {
			return Config::formatValue($_key->configType->name,$_key->default_value);
		}

		if (!$missing_ok) {
			throw new Exception("config not set: $key");
		}
	}

	static public function formatValue($type,$value) {
		switch ($type) {
			case 'Boolean': return (boolean)$value;
			case 'SelectFromTable':
			case 'Integer':
				return (integer)$value;
			case 'String':
			case 'Email':
			case 'Select':
				return (string)$value;
			case 'StringList':
			case 'MultiSelectFromTable':
			case 'Menu':
				return unserialize($value);
			default:
				throw new Exception("Unhandled config key type: $type");
		}
	}

	public function getReturnValue() {
		return Config::formatValue($this->configKey->configType->name,$this->value);
	}
}
