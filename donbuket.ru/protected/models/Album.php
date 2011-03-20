<?php

/**
 * This is the model class for table "album".
 *
 * The followings are the available columns in table 'album':
 * @property string $id
 * @property string $photo
 * @property string $filename
 */
class Album extends CActiveRecord
{
  public function getPhotoUrl(){
    return Yii::app()->urlManager->createUrl('album/photo',
                                             array ( 'id' => $this->id  ) ) ;
  }
  public $upload;
  public function beforeSave( ){
    if ( $file = CUploadedFile::getInstance( $this, "upload" ) ){
      $this->filename = $file->name;
      $this->file_size = $file->size;
      $this->file_type = $file->type;
      $this->photo = file_get_contents( $file->tempName ) ;
      return parent::beforeSave();
    }
    throw new Exception ("cannot save" );

  }
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
		return 'album';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
          if ( Yii::app()->controller->getAction()->getId () == 'create' )
            return array( array ('upload', 'file',
                                 'types'=>'jpg,png,gif',
                              'message' => 'Выберете достойную фотографию на своем компьютере') );
          return array(
                       array('photo, filename', 'required'),
                         array('filename', 'length', 'max'=>255),
                         array ('photo', 'file', 'types'=>'jpg,png,gif'),
                         // The following rule is used by search().
                         // Please remove those attributes that should not be searched.
                         array('id, filename', 'safe', 'on'=>'search'),
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
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('filename',$this->filename,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}