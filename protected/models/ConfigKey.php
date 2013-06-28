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
 * This is the model class for table "config_key".
 *
 * The followings are the available columns in table 'config_key':
 * @property integer $id
 * @property integer $config_group_id
 * @property integer $event_type_id
 * @property string $name
 * @property string $label
 * @property integer $config_type_id
 * @property string $default_value
 * @property string $values
 * @property integer $display_order
 * @property integer $relates_to_id
 * @property string $relates_to_condition
 * @property boolean $sortable
 * @property string $metadata1
 * @property string $metadata2
 *
 * The followings are the available model relations:
 * @property ConfigGroup $configGroup
 * @property EventType $event_type_id
 * @property ConfigType $configType
 * @property ConfigKey $relatesTo
 */
class ConfigKey extends BaseActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ConfigKey the static model class
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
		return 'config_key';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, display_order', 'safe', 'on'=>'search'),
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
			'configGroup' => array(self::BELONGS_TO, 'ConfigGroup', 'config_group_id'),
			'configType' => array(self::BELONGS_TO, 'ConfigType', 'config_type_id'),
			'relatesTo' => array(self::BELONGS_TO, 'ConfigKey', 'relates_to_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'config_group_id' => 'Config group',
			'event_type_id' => 'Event type',
			'name' => 'Name',
			'label' => 'Label',
			'config_type_id' => 'Config type',
			'default_value' => 'Default value',
			'values' => 'Values',
			'display_order' => 'Display order',
			'relates_to_id' => 'Relates to',
			'relates_to_condition' => 'Relates to condition',
			'sortable' => 'Sortable',
			'metadata1' => 'Metadata 1',
			'metadata2' => 'Metadata 2',
		);
	}

	public function getFormValue() {
		if (isset($_POST[$this->name])) {
			$value = $_POST[$this->name];
		} elseif (Config::has($this->name)) {
			$value = Config::get($this->name);
		} else {
			$value = $this->default_value;
		}

		return $value;
	}

	public function moduleList() {
		$criteria = new CDbCriteria;
		$criteria->select = 'module_name';
		$criteria->distinct = true;
		$criteria->order = 'module_name asc';
		$criteria->addCondition('module_name is not null');

		$modules = array();

		foreach (ConfigKey::model()->findAll($criteria) as $config_key) {
			$module_name = $config_key->module_name;
			if ($event_type = EventType::model()->find('class_name=?',array($module_name))) {
				$module_name = $event_type->name;
			}
			$modules[$config_key->module_name] = $module_name;
		}

		arsort($modules);

		return $modules;
	}
}
