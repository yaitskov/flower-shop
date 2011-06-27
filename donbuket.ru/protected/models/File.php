<?php


/**
 * base class of classes such as Photo, Movie, Sound.
 * It supplies the save method.
 */
class File extends CActiveRecord {  
  /**
   * Constant list of file types. The list is a domain of file_type attribute.
   */
  const USUAL = 0;
  const PHOTO = 1;
  const MOVIE = 2;
  const SOUND = 3;
  const ARCHIVE = 4;
  const MAX_FILE_TYPE = 4;

  private $stack = 0;
  const MAX_CALL_STACK=3;
  public function tableName() {
    return 'photo';
  }
  
  public static function model($className=__CLASS__)
  {
    return parent::model($className);
  }
  
  public function findByHash($hash) {
    return $this->findByAttributes(array("hashName" => $hash));
  }
  /**
   * @param CUploadedFile $file
   * @exception Exception file body cannot be save cause some error happend.
   * @return void
   */
  public function fromUploadedFile (CUploadedFile $file) {
    try {
      $this->hashName = Yii::app()->filestorage->saveFile($file);
    } catch (FileExistsEx $e) {
      // if file exists then increase its link counter
      $f = $this->findByHash($e->fileBodyHash);
      if ($f === null) {
        Yii::log(
          "an integrity of db and file storage is broken."
          . "hash '" . $e->fileBodyHash . "' is in file storage"
          . " but it isn't in db. A relational record of the file "
          . "will be inserted into db.", "error");
        $this->fromNewUploadedFile($file);
        $this->hashName = $e->fileBodyHash;
        return;
      }
      RAUtil::get()->copyInMemory($this, $f);
      // if such file has been loaded before
      $this->numlinks ++;
      if (!$this->saveAttributes(array('numlinks'))) {
        Yii::log("It seems file was deleted in parallel request."
                 . " I'll try to recall fromUploadedFile", "error");
        if (self::MAX_CALL_STACK < $this->stack)
          throw new Exception ("recursion" . $this->numlinks . "  ; " . $this->id  . "   ; " . $f->id );
        $this->stack++;
        $this->fromUploadedFile($file);
        $this->stack--;
      }
      return;
    }
    $this->fromNewUploadedFile($file);    
  }
  /**
   * init all fields basing on CUploadedFile excepting hashName field 
   */
  protected function fromNewUploadedFile(CUploadedFile $file) {
    $this->origName = $file->name;
    $this->mime = $file->type;
    $this->file_length = $file->size;
    $this->file_type = $this->detectType($file->type);
    $this->extension = $file->extensionName;
    $this->numlinks = 1;        
  }
  /**
   * detect file type by its mime
   * @return integer 
   */
  public function detectType ($mime) {
    $typeSigns = array (
      '/^image/i' => self::PHOTO,
      '/^video/i' => self::MOVIE,
      '/^audio/i' => self::SOUND,
      '/(compressed|zip|rar|gzip)/i' => self::ARCHIVE,      
    );
    foreach($typeSigns as $regex => $type)
      if (preg_match($regex, $mime))
        return $type;
    return self::USUAL;
  }
  public function rules()
  {
    return array(
      array('numlinks', 'default', 'value' => 0 ),
      array('file_length, hashName, file_type, mime, numlinks, origName, extension', 'required'),
      array('file_length, file_type, numlinks', 'numerical', 'integerOnly'=>true),
      array('file_length', 'length', 'max'=>20),
      array('mime', 'length', 'max'=>64),      
      array('numlinks, file_type', 'length', 'max'=>5),      
      array('hashName, origName', 'length', 'max'=>255),
      array('extension', 'length', 'max'=>10),
      array('file_type', 'compare', 'allowEmpty' => false,
            'operator' => '<=', 'strict' => true,
            'compareValue' => self::MAX_FILE_TYPE ),
    );
  }
  
  /**
   * @return array customized attribute labels (name=>label)
   */
  public function attributeLabels()
  {
    return array(
      'id' => 'ID',
      'numlinks' => 'Кол-во ссылок на файл',
      'hashName' => 'Идентификатор файла в хранилище',
      'origName' => 'Исходное имя файла',
      'extension' => 'Расширение',
      'file_type' => 'Тип файла',
      'file_length' => 'Размер файла (б)',
    );
  }
  public function relations()
  {
    return array(
      'description' => array(self::HAS_ONE, 'DescriptionFile', 'photo_id'),
    );
  }
  /**
   * it decrement link counter of file object. 
   * If it get less or equal 0 then the object delete itself.
   * This method have been to call from host object's "destructor"
   *
   * @exception Exception 
   */
  public function releaseReference() {
    $this->numlinks --;
    if ($this->numlinks <= 0) {
      if (!$this->delete())
        throw new Exception('cannot delete file ' . $this->hashName);
    } else {
      if (!$this->saveAttributes(array('numlinks')))
        throw new Exception('cannot decrement numlinks ' . $this->hashName);
    }
  }
  /**
   *  
   */
  public function allocateReference() {
    $this->numlinks ++;
    if (!$this->saveAttributes(array('numlinks')))
      throw new Exception('cannot increment numlinks ' . $this->hashName);
  }
  /**
   * delete a file related with the record from the disk
   * @exception Exception file cannot be deleted or it is not found
   */
  protected function afterDelete() {
    Yii::app()->filestorage->deleteFile($this->hashName);
  }
}
?>