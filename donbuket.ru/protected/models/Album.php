<?php

/**
 * This is the model class for table "photo_album".
 *
 * The followings are the available columns in table 'album':
 * @property string $id
 * @property datetime $updated_at
 * @property datetime $created_at
 */
class Album extends CActiveRecord
{
  public function getPhotoUrl(){
    return Yii::app()->urlManager->createUrl('album/photo',
                                             array ( 'id' => $this->id  ) ) ;
  }
  /* public $upload; */
  /* public function beforeSave( ){ */
  /*   if ( $file = CUploadedFile::getInstance( $this, "upload" ) ){ */
  /*     $this->filename = $file->name; */
  /*     $this->file_size = $file->size; */
  /*     $this->file_type = $file->type; */
  /*     $this->photo = file_get_contents( $file->tempName ) ; */
  /*     return parent::beforeSave(); */
  /*   } */
  /*   throw new Exception ("cannot save" ); */

  //  }
  /**
   * Returns the static model of the specified AR class.
   * @return Album the static model class
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
    return 'photo_album';
  }

  /**
   * @return array validation rules for model attributes.
   */
  public function rules()
  {
    // NOTE: you should only define rules for those attributes that
    // will receive user inputs.
    /* if ( Yii::app()->controller->getAction()->getId () == 'create' ) */
    /*   return array( array ('upload', 'file', */
    /*                        'types'=>'jpg,png,gif', */
    /*                        'message' => 'Выберете достойную фотографию на своем компьютере') ); */
    return array(
      array('created_at', 'default', 'setOnEmpty' => true,
            'value' => MyDateTime::dbDateTime() ),
      array('updated_at', 'default', 'setOnEmpty' => false,
            'value' => MyDateTime::dbDateTime() ),
      /* array('photo, filename', 'required'), */
      /* array('filename', 'length', 'max'=>255), */
      /* array ('photo', 'file', 'types'=>'jpg,png,gif'), */
      /* // The following rule is used by search(). */
      /* // Please remove those attributes that should not be searched. */
      /* array('id, filename', 'safe', 'on'=>'search'), */
    );
          
  }


  public function getElementsProvider() {
    return new CActiveDataProvider( 'AlbumElement',
                                      array('criteria' =>
                                            array('condition' => 'album_id = :ai',
                                                  'params' => array( ':ai' => $this->id ),
                                                  'order' => 'itmorder ASC',
                                                  'with' => array('photo')
                                            )
                                      )
    );
  }
  protected function beforeDelete() {
    $r = true;
    foreach ($this->elements as $element) 
      $r = $r and !$element->delete();
    return $r;
  }
  /**
   * @return array relational rules.
   */
  public function relations()
  {
    // NOTE: you may need to adjust the relation name and the related
    // class name for the relations automatically generated below.
    return array(
      'elements' => array ( self::HAS_MANY, 'AlbumElement', 'album_id',
                            'order' => 'itmorder, id asc'  ),
      'visible' => array (  self::HAS_MANY, 'AlbumElement', 'album_id',
                            'order' => 'itmorder, id asc',
                            'condition' => 'is_visible = 1' ),
    );
  }

  /**
   * @return array customized attribute labels (name=>label)
   */
  public function attributeLabels()
  {
    return array(
      'id' => 'ID',
      'photo' => 'Фотография',
      'filename' => 'Название файла',
    );
  }

  /**
   * @return array < GalleryItemIf >
   */
  public function galleryImages($fConstructor) {
    $res = array () ;
    // 'visible' is set of visible photoes in the album
    // AlbumElement $vi
    foreach ($this->visible as $vi)
      $res[] = call_user_func($fConstructor, $vi);
    return $res ; 
  }  
}