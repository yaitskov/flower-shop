<?php

/**
 * This is the model class for table "description_file".
 *
 * The followings are the available columns in table 'description_file':
 * @property string $id
 * @property string $photo_id
 *
 * The followings are the available model relations:
 * @property Photo $photo
 */
class DescriptionFile extends CActiveRecord
{
  /**
   * Returns the static model of the specified AR class.
   * @return DescriptionFile the static model class
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
    return 'description_file';
  }

  /**
   * @return array validation rules for model attributes.
   */
  public function rules()
  {
    // NOTE: you should only define rules for those attributes that
    // will receive user inputs.
    return array(
      array('photo_id', 'required'),
      array('photo_id', 'length', 'max'=>20),
      array('photo_id', 'numerical', 'integerOnly' => true),
      array('photo_id', 'exist', 'className' => 'File', 'attributeName' => 'id'),
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
      'file' => array(self::BELONGS_TO, 'File', 'photo_id'),
    );
  }
  protected function afterDelete() {
    $this->file->releaseReference();
    parent::afterDelete();
  }
  /**
   * @return array customized attribute labels (name=>label)
   */
  public function attributeLabels()
  {
    return array(
      'id' => 'ID',
      'photo_id' => 'Photo',
    );
  }
}