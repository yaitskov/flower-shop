<?php

/**
 * This is the model class for table "person_age".
 *
 * The followings are the available columns in table 'person_age':
 * @property string $id
 * @property string $name
 * @property integer $start_age
 * @property integer $end_age
 *
 * The followings are the available model relations:
 * @property PosySearchHistory[] $posySearchHistories
 */
class PersonAge extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return PersonAge the static model class
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
		return 'person_age';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, start_age, end_age', 'required'),
			array('start_age, end_age', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>40),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, start_age, end_age', 'safe', 'on'=>'search'),
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
			'posySearchHistories' => array(self::HAS_MANY, 'PosySearchHistory', 'person_age'),
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
			'start_age' => 'Start Age',
			'end_age' => 'End Age',
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
		$criteria->compare('start_age',$this->start_age);
		$criteria->compare('end_age',$this->end_age);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}