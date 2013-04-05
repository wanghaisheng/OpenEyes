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
 * This is the model class for table "theatre".
 *
 * The followings are the available columns in table 'theatre':
 * @property string $id
 * @property string $name
 * @property string $site_id
 *
 * The followings are the available model relations:
 * @property Sequence[] $sequences
 * @property Session[] $sessions
 * @property Site $site
 */
class Theatre extends BaseActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Theatre the static model class
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
		return 'theatre';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('site_id', 'required'),
			array('name', 'length', 'max'=>255),
			array('site_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, site_id', 'safe', 'on'=>'search'),
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
			'sessions' => array(self::HAS_MANY, 'Session', 'theatre_id'),
			'sequences' => array(self::HAS_MANY, 'Sequence', 'theatre_id'),
			'site' => array(self::BELONGS_TO, 'Site', 'site_id'),
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
			'site_id' => 'Site',
		);
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
		$criteria->compare('site_id',$this->site_id,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}

	public static function getDateFilterOptions()
	{
		return array(
			'today' => 'Today',
			'week' => 'This week',
			'month' => 'This month',
			'custom' => 'or from'
		);
	}

	public function getListWithSites() {
		$theatres = Yii::app()->db->createCommand()
			->select('t.id, t.name, s.short_name AS site')
			->from('theatre t')
			->join('site s', 't.site_id = s.id')
			->order('s.short_name, t.name')
			->queryAll();
		$data = array();
		foreach ($theatres as $theatre) {
			$data[$theatre['id']] = $theatre['name'] . ' (' . $theatre['site'] . ')';
		}
		return $data;
	}
	
	public function getNameWithSite() {
		return $this->name . ' (' . $this->site->name . ')';
	}
}