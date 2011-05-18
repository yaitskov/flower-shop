<?php

/**
 * This is the model class for table "photo".
 *
 * The followings are the available columns in table 'photo':
 * @property string $id
 * @property string $numlinks
 * @property string $path
 * @property string $extention
 * @property string $width
 * @property string $height
 *
 * The followings are the available model relations:
 * @property AlbumElement[] $albumElements
 * @property Flower[] $flowers
 * @property PaymentType[] $paymentTypes
 * @property Posy[] $posys
 * @property PosyView[] $posyViews
 * @property Product[] $products
 * @property ProductCategory[] $productCategories
 * @property SiteUser[] $siteUsers
 */
class Photo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Photo the static model class
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
		return 'photo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('path, extention', 'required'),
			array('numlinks, width, height', 'length', 'max'=>20),
			array('path', 'length', 'max'=>255),
			array('extention', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, numlinks, path, extention, width, height', 'safe', 'on'=>'search'),
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
			'albumElements' => array(self::HAS_MANY, 'AlbumElement', 'photo_id'),
			'flowers' => array(self::HAS_MANY, 'Flower', 'icon_id'),
			'paymentTypes' => array(self::HAS_MANY, 'PaymentType', 'icon_id'),
			'posys' => array(self::HAS_MANY, 'Posy', 'icon_id'),
			'posyViews' => array(self::HAS_MANY, 'PosyView', 'icon_id'),
			'products' => array(self::HAS_MANY, 'Product', 'icon_id'),
			'productCategories' => array(self::HAS_MANY, 'ProductCategory', 'icon_id'),
			'siteUsers' => array(self::HAS_MANY, 'SiteUser', 'face_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'numlinks' => 'Numlinks',
			'path' => 'Path',
			'extention' => 'Extention',
			'width' => 'Width',
			'height' => 'Height',
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
		$criteria->compare('numlinks',$this->numlinks,true);
		$criteria->compare('path',$this->path,true);
		$criteria->compare('extention',$this->extention,true);
		$criteria->compare('width',$this->width,true);
		$criteria->compare('height',$this->height,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}