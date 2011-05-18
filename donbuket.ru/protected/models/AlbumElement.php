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

  /**
   * @return string the associated database table name
   */
  public function tableName()
  {
    return 'album_element';
  }

  /**
   * @return array validation rules for model attributes.
   */
  public function rules()
  {
    // NOTE: you should only define rules for those attributes that
    // will receive user inputs.
    return array(
      array('photo_id, album_id, itmorder', 'required'),
      array('is_visible', 'numerical', 'integerOnly'=>true),
      array('photo_id, album_id, itmorder', 'length', 'max'=>20),
      // The following rule is used by search().
      // Please remove those attributes that should not be searched.
      array('id, photo_id, album_id, itmorder, is_visible', 'safe', 'on'=>'search'),
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
      'photo_id' => 'Photo',
      'album_id' => 'Album',
      'itmorder' => 'Itmorder',
      'is_visible' => 'Is Visible',
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
    $criteria->compare('photo_id',$this->photo_id,true);
    $criteria->compare('album_id',$this->album_id,true);
    $criteria->compare('itmorder',$this->itmorder,true);
    $criteria->compare('is_visible',$this->is_visible);

    return new CActiveDataProvider(get_class($this), array(
      'criteria'=>$criteria,
    ));
  }
}