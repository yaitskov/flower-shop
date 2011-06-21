<?php

  /**
   * This is the model class for table "web_site".
   *
   * The followings are the available columns in table 'web_site':
   * @property string $id
   * @property string $visitors_a_hour
   * @property string $visitors_a_day
   * @property string $support_email
   * @property string $birth_year
   * @property string $meta_keywords
   * @property string $meta_description
   * @property string $meta_author
   * @property string $name
   * @property string $about
   * @property integer $map_width
   * @property integer $map_height      
   */
class WebSite extends CActiveRecord
{
  /**
   * Returns the static model of the specified AR class.
   * @return WebSite the static model class
   */
  public static function model($className=__CLASS__)
  {
    return parent::model($className);
  }

  public function canUpdate (WebUser $user) {
    return  $user->isRoot;
  }
  /**
   * @return string the associated database table name
   */
  public function tableName() {
    return 'web_site';
  }
  public function deleteTrashFiles($attribute,$params) {
    $trasher = new TrashFiles( DescriptionFile::model()->with('file')->findAll(),
                               $this->about );
    $trasher->run();
  }

  /**
   * @return array validation rules for model attributes.
   */
  public function rules()
  {
    return array(
      array('support_email, name, birth_year, about, meta_keywords,'
            . 'meta_description, meta_author', 'required'),
      array('visitors_a_hour, visitors_a_day, birth_year', 'length', 'max'=>20),
      array('visitors_a_hour, visitors_a_day, ', 'numerical',
            'integerOnly' => true, 'allowEmpty' => false, 'max' => 1000000,
            'min' => 0),
      array('birth_year', 'numerical', 'integerOnly' => true,
            'allowEmpty' => false, 'min' => 1990, 'max' => 2100),
      array('support_email', 'length', 'max'=>100),
      array('name, yandex_map_key', 'length', 'max'=>255),
      array('meta_keywords, meta_description, meta_author',
            'length', 'max' => 4000),
      array('about', 'length', 'max' => 20000),      
      array('about', 'deleteTrashFiles', 'on' => 'update'),
    );
  }

  /**
   * @return array relational rules.
   */
  public function relations()
  {
    return array(
    );
  }

  /**
   * @return array customized attribute labels (name=>label)
   */
  public function attributeLabels()
  {
    return array(
      'id' => 'ID',
      'visitors_a_hour' => 'Кол-во посещений сайта за час',
      'visitors_a_day' => 'Кол-во посещений сайта за сутки',
      'support_email' => 'Адрес электронной почты технической поддержки',
      'birth_year' => 'Дата основания',
      'meta_keywords' => 'Ключевые слова характеризующие содержимое сайта',
      'meta_description' => 'Краткое описание сайта, отображаемое поисковыми машинами',
      'meta_author' => 'Владелец сайта, также отображается в результатах поисковых машин',
      'name' => 'Название сайта',
      'about' => 'О нас',
    );
  }
}