<?php

/**
 * This is the model class for table "posy_search_history".
 *
 * The followings are the available columns in table 'posy_search_history':
 * @property string $id
 * @property string $created_at
 * @property string $pattern_name
 * @property string $posy_group
 * @property string $person_t
 * @property string $person_age
 * @property integer $max_flowers
 * @property integer $min_flowers
 * @property integer $max_colors
 * @property integer $min_colors
 * @property integer $max_type_flowers
 * @property integer $min_type_flowers
 * @property integer $max_price
 * @property integer $min_price
 * @property string $user_id
 *
 * The followings are the available model relations:
 * @property PosySearchColor[] $posySearchColors
 * @property PosySearchFlower[] $posySearchFlowers
 * @property PersonAge $personAge0
 * @property PosyView $posyGroup0
 * @property PersonType $personT0
 * @property SiteUser $user
 */
class PosySearchHistory extends CActiveRecord
{
  /**
   * @var Integer minimal average uptime of posy in seconds
   */
  public $minimalAverageUptime;
  /**
   * Returns the static model of the specified AR class.
   * @return PosySearchHistory the static model class
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
    return 'posy_search_history';
  }

  /**
   * @return array validation rules for model attributes.
   */
  public function rules()
  {
    return array(
      array('created_at', 'required'),
      array('max_flowers, min_flowers, max_colors, min_colors,' .
            'max_type_flowers, min_type_flowers, max_price, min_price',
            'numerical', 'integerOnly'=>true),
      array('pattern_name', 'length', 'max'=>40),
      array('user_id',    'exist', 'className' => 'User',       'attributeName' => 'id'),
      array('person_t',   'exist', 'className' => 'PersonType', 'attributeName' => 'id'),
      array('person_age', 'exist', 'className' => 'PersonAge',  'attributeName' => 'id'),
      array('posy_group, person_t, person_age, user_id', 'length', 'max'=>20),
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
      'posySearchColors' => array(self::HAS_MANY, 'PosySearchColor', 'reqid'),
      'posySearchFlowers' => array(self::HAS_MANY, 'PosySearchFlower', 'reqid'),
      'personAge0' => array(self::BELONGS_TO, 'PersonAge', 'person_age'),
      'posyGroup0' => array(self::BELONGS_TO, 'PosyView', 'posy_group'),
      'personT0' => array(self::BELONGS_TO, 'PersonType', 'person_t'),
      'user' => array(self::BELONGS_TO, 'SiteUser', 'user_id'),
    );
  }

  /**
   * @return array customized attribute labels (name=>label)
   */
  public function attributeLabels()
  {
    return array(
      'id' => 'ID',
      'created_at' => 'Дата запроса',
      'pattern_name' => 'Имя букета',
      'posy_group' => 'Тип букета',
      'person_t' => 'Для кого',
      'person_age' => 'Возрастная категория',
      'max_flowers' => 'Максимум бутонов',
      'min_flowers' => 'Минимум бутонов',
      'max_colors' => 'Максимум цветов',
      'min_colors' => 'Минимум цветов',
      'max_type_flowers' => 'Максимум различных типов бутонов',
      'min_type_flowers' => 'Минимум различных типов бутонов',
      'max_price' => 'Максимальная цена',
      'min_price' => 'Минимальная цена',
      'user_id' => 'Автор запроса',
    );
  }
}