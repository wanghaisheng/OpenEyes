<?php
/*
_____________________________________________________________________________
(C) Moorfields Eye Hospital NHS Foundation Trust, 2008-2011
(C) OpenEyes Foundation, 2011
This file is part of OpenEyes.
OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
You should have received a copy of the GNU General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
_____________________________________________________________________________
http://www.openeyes.org.uk   info@openeyes.org.uk
--
*/

/**
 * This is the model class for table "SILVER.PATIENTS".
 *
 * The followings are the available columns in table 'SILVER.PATIENTS':
 * @property integer $RM_PATIENT_NO
 * @property string $FICT_CLIENT
 * @property string $DISC_CLIENT
 * @property string $SEX
 * @property string $BIOLOGICAL_SEX
 * @property string $MARITAL_STAT
 * @property string $RELIGION
 * @property string $DATE_OF_BIRTH
 * @property string $TIME_OF_BIRTH
 * @property string $PLACE_OF_BIRTH
 * @property string $BIRTH_NOTIFICATION
 * @property string $DATE_OF_DEATH
 * @property string $TIME_OF_DEATH
 * @property string $PLACE_OF_DEATH
 * @property string $DEATH_NOTIFICATION
 * @property string $DATE_DOD_NOTIFIED
 * @property string $DATE_POST_MORTEM
 * @property string $OUTCOME_PM
 * @property string $DEATH_CAUSE
 * @property string $BLOOD_GRP
 * @property string $RHESUS
 * @property string $ETHNIC_GRP
 * @property string $LANGUAGE
 * @property string $OLANG
 * @property string $INTERPRETER_REQD
 * @property string $IMM_STAT
 * @property string $ENG_SPK
 * @property string $STAFF_MEMBER
 * @property string $EMP_CATEGORY
 * @property string $OCCUPATION_CODE
 * @property string $OCCUPATION_DESC
 * @property string $DAY_PHONE_NO
 * @property string $DATE_REGISTERED
 * @property string $DATE_REG_SICK_DISABLED
 * @property string $HDDR_GROUP
 * @property string $NHS_STAT
 * @property string $WTEL
 * @property string $MTEL
 * @property string $MTEL_CS
 * @property string $EMAIL
 * @property string $EMAIL_CS
 * @property string $PDS_FLAG
 * @property integer $PDS_SCN
 * @property string $PDS_SYNC
 * @property string $PDS_DCPL
 * @property string $CTS_FLAG
 * @property string $CTS_TEXT
 * @property string $SMOKER
 * @property string $NOTES
 */
class PAS_Patient extends MultiActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return PAS_Patient the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated db connection name
	 */
	public function connectionId()
	{
		return 'db_pas';
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'SILVER.PATIENTS';
	}

	/**
	 * @return string primary key for the table
	 */
	public function primaryKey()
	{
		return 'RM_PATIENT_NO';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('RM_PATIENT_NO, PDS_SCN', 'numerical', 'integerOnly'=>true),
			array('FICT_CLIENT, DISC_CLIENT, MTEL_CS, EMAIL_CS, PDS_FLAG, PDS_DCPL, CTS_FLAG', 'length', 'max'=>1),
			array('SEX, BIOLOGICAL_SEX, MARITAL_STAT, RELIGION, BIRTH_NOTIFICATION, PLACE_OF_DEATH, DEATH_NOTIFICATION, OUTCOME_PM, BLOOD_GRP, RHESUS, ETHNIC_GRP, LANGUAGE, OLANG, INTERPRETER_REQD, IMM_STAT, ENG_SPK, STAFF_MEMBER, EMP_CATEGORY, SMOKER', 'length', 'max'=>4),
			array('TIME_OF_BIRTH, TIME_OF_DEATH, OCCUPATION_CODE', 'length', 'max'=>5),
			array('PLACE_OF_BIRTH', 'length', 'max'=>30),
			array('DEATH_CAUSE, OCCUPATION_DESC, DAY_PHONE_NO, WTEL, MTEL', 'length', 'max'=>35),
			array('HDDR_GROUP', 'length', 'max'=>48),
			array('NHS_STAT', 'length', 'max'=>2),
			array('EMAIL', 'length', 'max'=>50),
			array('CTS_TEXT', 'length', 'max'=>500),
			array('NOTES', 'length', 'max'=>2000),
			array('DATE_OF_BIRTH, DATE_OF_DEATH, DATE_DOD_NOTIFIED, DATE_POST_MORTEM, DATE_REGISTERED, DATE_REG_SICK_DISABLED, PDS_SYNC', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('RM_PATIENT_NO, DATE_OF_BIRTH', 'safe', 'on'=>'search'),
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
			'names'=>array(self::HAS_MANY, 'PAS_PatientSurname', 'RM_PATIENT_NO'),
			'numbers'=>array(self::HAS_MANY, 'PAS_PatientNumber', 'RM_PATIENT_NO'),
			'addresses'=>array(self::HAS_MANY, 'PAS_PatientAddress', 'RM_PATIENT_NO'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'RM_PATIENT_NO' => Yii::t('strings','Patient ID'),
			'FICT_CLIENT' => Yii::t('strings','Fict Client'),
			'DISC_CLIENT' => Yii::t('strings','Disc Client'),
			'SEX' => Yii::t('strings','Gender'),
			'BIOLOGICAL_SEX' => Yii::t('strings','Biological Gender'),
			'MARITAL_STAT' => Yii::t('strings','Marital Status'),
			'RELIGION' => Yii::t('strings','Religion'),
			'DATE_OF_BIRTH' => Yii::t('strings','Date Of Birth'),
			'TIME_OF_BIRTH' => Yii::t('strings','Time Of Birth'),
			'PLACE_OF_BIRTH' => Yii::t('strings','Place Of Birth'),
			'BIRTH_NOTIFICATION' => Yii::t('strings','Birth Notification'),
			'DATE_OF_DEATH' => Yii::t('strings','Date Of Death'),
			'TIME_OF_DEATH' => Yii::t('strings','Time Of Death'),
			'PLACE_OF_DEATH' => Yii::t('strings','Place Of Death'),
			'DEATH_NOTIFICATION' => Yii::t('strings','Death Notification'),
			'DATE_DOD_NOTIFIED' => Yii::t('strings','Date Dod Notified'),
			'DATE_POST_MORTEM' => Yii::t('strings','Date Post Mortem'),
			'OUTCOME_PM' => Yii::t('strings','Outcome PM'),
			'DEATH_CAUSE' => Yii::t('strings','Death Cause'),
			'BLOOD_GRP' => Yii::t('strings','Blood Group'),
			'RHESUS' => Yii::t('strings','Rhesus'),
			'ETHNIC_GRP' => Yii::t('strings','Ethnic Group'),
			'LANGUAGE' => Yii::t('strings','Language'),
			'OLANG' => Yii::t('strings','Other Language'),
			'INTERPRETER_REQD' => 'Interpreter Required?',
			'IMM_STAT' => Yii::t('strings','Immigration Status'),
			'ENG_SPK' => Yii::t('strings','Eng Speaker').'?',
			'STAFF_MEMBER' => Yii::t('strings','Staff Member'),
			'EMP_CATEGORY' => Yii::t('strings','Emp Category'),
			'OCCUPATION_CODE' => Yii::t('strings','Occupation Code'),
			'OCCUPATION_DESC' => Yii::t('strings','Occupation Description'),
			'DAY_PHONE_NO' => Yii::t('strings','Daytime Telephone'),
			'DATE_REGISTERED' => Yii::t('strings','Date Registered'),
			'DATE_REG_SICK_DISABLED' => 'Date Registered Sick/Disabled',
			'HDDR_GROUP' => Yii::t('strings','Hddr Group'),
			'NHS_STAT' => Yii::t('strings','NHS Stat'),
			'WTEL' => Yii::t('strings','Work Telephone'),
			'MTEL' => Yii::t('strings','Mobile Telephone'),
			'MTEL_CS' => Yii::t('strings','Mtel Cs'),
			'EMAIL' => Yii::t('strings','Email'),
			'EMAIL_CS' => Yii::t('strings','Email Cs'),
			'PDS_FLAG' => Yii::t('strings','Pds Flag'),
			'PDS_SCN' => Yii::t('strings','Pds Scn'),
			'PDS_SYNC' => Yii::t('strings','Pds Sync'),
			'PDS_DCPL' => Yii::t('strings','Pds Dcpl'),
			'CTS_FLAG' => Yii::t('strings','Cts Flag'),
			'CTS_TEXT' => Yii::t('strings','Cts Text'),
			'SMOKER' => Yii::t('strings','Smoker').'?',
			'NOTES' => Yii::t('strings','Notes'),
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

		// $criteria->compare('RM_PATIENT_NO',$this->RM_PATIENT_NO);
		// $criteria->compare('DATE_OF_BIRTH',$this->DATE_OF_BIRTH,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}
