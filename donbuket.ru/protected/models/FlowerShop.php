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
 * @property string $map_center_x
 * @property string $map_center_y
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
  public $pretty_start_work_at;
  public $pretty_end_work_at;
  public $place;
  public $map_center;
  public function unpackCoords() {
    $map = explode(',', $this->map_center);
    $this->map_center_x = substr($map[0],0,9);
    $this->map_center_y = substr($map[1],0,9);
    $place = explode(',', $this->place);      
    $this->place_x = substr($place[0],0,9);
    $this->place_y = substr($place[1],0,9);
  }
  /**
   * @return boolean
   */  
  protected function beforeSave() {
    $addSeconds = function ($time) { return $time . ':00'; };    
    $this->start_work_at = $addSeconds($this->pretty_start_work_at);
    $this->end_work_at   = $addSeconds($this->pretty_end_work_at);
    if ('map' === $this->scenario) 
      $this->unpackCoords();
    return true;
  }
  protected  function afterFind(){
    $dropSeconds = function ($time) { return preg_replace('/^([0-9]{2}:[0-9]{2}):[0-9]+$/', '\1', $time); };
    $this->pretty_start_work_at = $dropSeconds($this->start_work_at);
    $this->pretty_end_work_at   = $dropSeconds($this->end_work_at);
    $this->place = $this->place_x . ',' . $this->place_y;
    $this->map_center = $this->map_center_x . ',' . $this->map_center_y;
    parent::afterFind();
  }
  public function canUpdate ( WebUser $user ){
    return $user->isRoot;
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

  protected function beforeDelete() {
    // delete description files and route files
    foreach( $this->routeFile as $rfile)
      $rfile->delete();
    // todo: delete gallary
    return parent::beforeDelete();
  }
  public function deleteTrashFiles() {
    $trasher = new TrashFiles( $this->routeFile,
                               $this->outline_route );
    $trasher->run();
  }
  /**
   * @return array validation rules for model attributes.
   */
  public function rules()
  {
    return array(
      array('name', 'required'),
      array('map_center, place, map_scale', 'required', 'on' => 'map'),
      array('enabled', 'default', 'setOnEmpty' => false, 'value' => 0, 'on' => 'insert' ),
      array('phone, name, email_address, pretty_start_work_at, pretty_end_work_at',
            'filter', 'filter' => 'trim'),      
      array('phone, name', 'length', 'max'=>255),
      array('name', 'unique'),      
      array('phone', 'PhoneValidator'),
      array('email_address', 'length', 'max'=>100),
      array('email_address', 'email' ),
      array('mail_address', 'length', 'max' => 400 ),
      array('map_center,place', 'match',
            'pattern' => '/^[0-9]{2}[.][0-9]{4,},[0-9]{2}[.][0-9]{4,}$/',
            'message' => 'Поле имеет недопустимый формат. Попробуйте выполнить операцию из подсказки (выше), чтобы задать правильное значение',
            'on' => 'map'
      ),      
      array('map_scale, views', 'length', 'max'=>20),
      array('map_scale', 'numerical', 'max' => 17, 'min' => 3, 'integerOnly' => true),
      array('start_work_at, end_work_at', 'safe'),
      array('pretty_start_work_at, pretty_end_work_at',
            'TimeValidator', 'withoutSeconds' => true,
            'message' => 'Формат времени часы и минуты' ),
      array('outline_route', 'length', 'max'=>5000),
      array('outline_route', 'deleteTrashFiles', 'on' => 'update'),
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
      'routeFile' => array( self::HAS_MANY, 'RouteFile', 'shop_id'),
    );
  }

  /**
   * @return array customized attribute labels (name=>label)
   */
  public function attributeLabels()
  {
    return array(
      'id' => 'ID',
      'phone' => 'Телефон',
      'start_work_at' => 'Время открытия',
      'end_work_at' => 'Закрытие в',
      'pretty_start_work_at' => 'Время открытия',
      'pretty_end_work_at' => 'Закрытие в',
      'name' => 'Название магазина',
      'email_address' => 'Адрес электронной почты',
      'mail_address' => 'Почтовый адрес',
      'outline_route' => 'Как добраться до магазина',
      'map_center_x' => 'Х координата цетра карты',
      'map_center_y' => 'Y координата цетра карты',
      'map_center' => 'Координаты цетра карты',
      'place' => 'Координаты магазина',      
      'place_x' => 'X координата магазина на карте',
      'place_y' => 'Y координата магазина на карте',
      'map_scale' => 'Масштаб карты',
      'views' => 'Views',
    );
  }
}