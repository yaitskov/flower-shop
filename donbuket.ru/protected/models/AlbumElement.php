<?php

/**
 * This is the model class for table "album_element".
 *
 * The followings are the available columns in table 'album_element':
 * @property string $id
 * @property string $photo_id
 * @property string $album_id
 * @property string $itmorder
 * @property integer $is_visible
 *
 * The followings are the available model relations:
 * @property PhotoAlbum $album
 * @property Photo $photo
 */
class AlbumElement extends CActiveRecord 
{
  /**
   * Returns the static model of the specified AR class.
   * @return AlbumElement the static model class
   */
  public static function model($className=__CLASS__)
  {
    return parent::model($className);
  }

  protected function afterDelete() {
    if (!$this->isNewRecord and $this->photo) {
      $this->photo->releaseReference();
    }
    if ($this->album) $this->album->save();    
    return parent::afterDelete();
  }
  public function save($validate = true, $attrs = null) {
    if (!($r = parent::save($validate, $attrs))
        and $this->isNewRecord
        and $this->photo) {
      $this->photo->releaseReference();      
    }
    if ($this->album) $this->album->save();
    return $r;
  }
    
  /**
   * @return string the associated database table name
   */
  public function tableName()
  {
    return 'album_element';
  }

  public function numberPhotoes(Album $al) {
    return $this->countByAttributes(array('album_id' => $al->id));
  }
  /**
   * @return array validation rules for model attributes.
   */
  public function rules()
  {
    return array(
      array('itmorder', 'default', 'setOnEmpty' => true, 'value' => 1 ),
      array('itmorder', 'filter', 'filter' => array( $this, 'autoinc'), 'on' => 'insert'),
      array('photo_id, album_id, itmorder', 'required'),
      array('album_id', 'exist', 'className' => 'Album', 'attributeName' => 'id'),
      array('photo_id', 'exist', 'className' => 'Photo', 'attributeName' => 'id'),      
      array('is_visible', 'numerical', 'integerOnly'=>true),
      array('photo_id, album_id, itmorder', 'length', 'max'=>20),
    );
  }

  public function autoinc($f) {
    return $this->countByAttributes(array('album_id' => $this->album_id)) + 1;
  }
  /**
   * @return array relational rules.
   */
  public function relations()
  {
    return array(
      'album' => array(self::BELONGS_TO, 'Album', 'album_id'),
      'photo' => array(self::BELONGS_TO, 'Photo', 'photo_id'),
    );
  }

  /**
   * @return array customized attribute labels (name=>label)
   */
  public function attributeLabels()
  {
    return array(
      'id' => 'ID',
      'photo_id' => 'Фотография',
      'album_id' => 'Альбом',
      'itmorder' => 'Вес для упорядочивания',
      'is_visible' => 'Доступно посетителям',
    );
  }
}