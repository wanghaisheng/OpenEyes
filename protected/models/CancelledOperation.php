<?php

/**
 * This is the model class for table "cancelled_operation".
 *
 * The followings are the available columns in table 'cancelled_operation':
 * @property string $element_operation_id
 * @property string $cancelled_date
 * @property string $user_id
 * @property string $cancelled_reason_id
 *
 * The followings are the available model relations:
 * @property ElementOperation $elementOperation
 * @property CancellationReason $cancelledReason
 */
class CancelledOperation extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return CancelledOperation the static model class
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
		return 'cancelled_operation';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('element_operation_id, user_id, cancelled_reason_id', 'required'),
			array('element_operation_id, user_id, cancelled_reason_id', 'length', 'max'=>10),
			array('cancelled_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('element_operation_id, cancelled_date, user_id, cancelled_reason_id', 'safe', 'on'=>'search'),
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
			'elementOperation' => array(self::BELONGS_TO, 'ElementOperation', 'element_operation_id'),
			'cancelledReason' => array(self::BELONGS_TO, 'CancellationReason', 'cancelled_reason_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'element_operation_id' => 'Element Operation',
			'cancelled_date' => 'Cancelled Date',
			'user_id' => 'User',
			'cancelled_reason_id' => 'Cancelled Reason',
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

		$criteria->compare('element_operation_id',$this->element_operation_id,true);
		$criteria->compare('cancelled_date',$this->cancelled_date,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('cancelled_reason_id',$this->cancelled_reason_id,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}