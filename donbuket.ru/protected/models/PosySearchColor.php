<?php

/**
 * This is the model class for table "posy_search_color".
 *
 * The followings are the available columns in table 'posy_search_color':
 * @property string $id
 * @property string $reqid
 * @property integer $attitude
 * @property string $color_id
 *
 * The followings are the available model relations:
 * @property PosySearchHistory $req
 * @property Color $color
 */
class PosySearchColor extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return PosySearchColor the static model class
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
		return 'posy_search_color';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('reqid, attitude, color_id', 'required'),
			array('attitude', 'numerical', 'integerOnly'=>true),
			array('reqid, color_id', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, reqid, attitude, color_id', 'safe', 'on'=>'search'),
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
			'req' => array(self::BELONGS_TO, 'PosySearchHistory', 'reqid'),
			'color' => array(self::BELONGS_TO, 'Color', 'color_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'reqid' => 'Reqid',
			'attitude' => 'Attitude',
			'color_id' => 'Color',
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
		$criteria->compare('reqid',$this->reqid,true);
		$criteria->compare('attitude',$this->attitude);
		$criteria->compare('color_id',$this->color_id,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}