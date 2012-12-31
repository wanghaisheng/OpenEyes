<?php
/**
 * OpenEyes
 *
 * (C) Moorfields Eye Hospital NHS Foundation Trust, 2008-2011
 * (C) OpenEyes Foundation, 2011-2012
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package OpenEyes
 * @link http://www.openeyes.org.uk
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright (c) 2008-2011, Moorfields Eye Hospital NHS Foundation Trust
 * @copyright Copyright (c) 2011-2012, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html The GNU General Public License V3.0
 */

/**
 * This is the model class for table "stats_event".
 *
 * The followings are the available columns in table 'stats_event':
 * @property string $id
 * @property integer $event_type_id
 * @property string $key
 * @property string $value_raw
 */
class StatsEvent extends BaseActiveRecord {
	/**
	 * Returns the static model of the specified AR class.
	 * @return Session the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'stats_event';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		return array(
			array('event_type_id, key, value_raw', 'safe'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		return array(
			'eventType' => array(self::BELONGS_TO, 'EventType', 'event_type_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search() {
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		$criteria->compare('id',$this->id,false);
		$criteria->compare('event_type_id',$this->event_type_id,false);
		$criteria->compare('key',$this->key,false);
		$criteria->compare('value_raw',$this->value_raw,false);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}

	static public function add($params) {
		if (!isset($params['event_type_id'])) throw new Exception('Must specify event_type_id');
		if (!isset($params['key'])) throw new Exception("Must specify key");
		if (!isset($params['value_raw'])) throw new Exception("Must specify value_raw");
		
		if (!$stat = StatsEvent::model()->find('`key`=? and event_type_id=?',array($params['key'],$params['event_type_id']))) {
			$stat = new StatsEvent;
		} 
		
		foreach ($params as $key => $value) {
			$stat->{$key} = $value;
		}
		
		if (!$stat->save()) {
			throw new Exception('Unable to save stats item: '.print_r($stat,true));
		}
		
		return $stat;
	}
}
