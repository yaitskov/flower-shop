<?php

/**
 * This is the model class for table "flower_shop".
 *
 * The followings are the available columns in table 'flower_shop':
 * @property string $id
 * @property string $phone
 * @property string $start_work_at
 * @property string $end_work_at
 * @property string $name
 * @property string $email_address
 * @property string $mail_address
 * @property string $outline_route
 * @property string $map_x
 * @property string $map_y
 * @property string $place_x
 * @property string $place_y
 * @property string $map_scale

 * @property string $views
 *
 * The followings are the available model relations:
 * @property PhotoAlbum $views0
 */
class FlowerShop extends CActiveRecord
{
  protected  function afterFind(){
    //    $this->name = trim( $this->name );
    parent::afterFind();
  }
  public function canUpdate ( WebUser $user ){
  }
  /**
   * Returns the static model of the specified AR class.
   * @return FlowerShop the static model class
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
    return 'flower_shop';
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
      array('phone, name', 'length', 'max'=>255),
      array('email_address', 'length', 'max'=>100),
      array('map_x, map_y, place_x, place_y', 'length', 'max'=>6),
      array('map_scale, views', 'length', 'max'=>20),
      array('start_work_at, end_work_at, mail_address, outline_route', 'safe'),
      // The following rule is used by search().
      // Please remove those attributes that should not be searched.
      array('id, phone, start_work_at, end_work_at, name, email_address, mail_address, outline_route, map_x, map_y, place_x, place_y, map_scale, views', 'safe', 'on'=>'search'),
    );
  }

  /**
   * @return array relational rules.
   */
  public function relations()
  {
    // belongs_to relation always returns just one entity no array
    return array(
      'gallery' => array( self::BELONGS_TO, 'Album', 'views'),
    );
  }

  /**
   * @return array customized attribute labels (name=>label)
   */
  public function attributeLabels()
  {
    return array(
      'id' => 'ID',
      'phone' => 'Phone',
      'start_work_at' => 'Start Work At',
      'end_work_at' => 'End Work At',
      'name' => 'Name',
      'email_address' => 'Email Address',
      'mail_address' => 'Mail Address',
      'outline_route' => 'Outline Route',
      'map_x' => 'Map X',
      'map_y' => 'Map Y',
      'place_x' => 'Place X',
      'place_y' => 'Place Y',
      'map_scale' => 'Map Scale',
      'views' => 'Views',
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
    $criteria->compare('phone',$this->phone,true);
    $criteria->compare('start_work_at',$this->start_work_at,true);
    $criteria->compare('end_work_at',$this->end_work_at,true);
    $criteria->compare('name',$this->name,true);
    $criteria->compare('email_address',$this->email_address,true);
    $criteria->compare('mail_address',$this->mail_address,true);
    $criteria->compare('outline_route',$this->outline_route,true);
    $criteria->compare('map_x',$this->map_x,true);
    $criteria->compare('map_y',$this->map_y,true);
    $criteria->compare('place_x',$this->place_x,true);
    $criteria->compare('place_y',$this->place_y,true);
    $criteria->compare('map_scale',$this->map_scale,true);
     $criteria->compare('views',$this->views,true);

    return new CActiveDataProvider(get_class($this), array(
      'criteria'=>$criteria,
    ));
  }
}