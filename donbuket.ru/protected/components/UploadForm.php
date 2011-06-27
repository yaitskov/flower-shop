<?php

/**
 * UploadForm class.
 */
class UploadForm extends CFormModel
{
  public $tmpfile;
  public $fieldName = 'Uploading file';
  public $allowEmpty = false;
  public $maxSize;
  public $fileTypes = 'jpg, jpeg, png, gif';
  public function init (){
    $this->maxSize = 16*1024*1024;
    parent::init();    
  }
  public function rules()
  {
    return array(
      array('tmpfile', 'file',
            'maxFiles'=>1,
            'maxSize' => $this->maxSize,
            'types' => $this->fileTypes,
            'allowEmpty' => $this->allowEmpty  )      
    );
  }
  public function attributeLabels() {
    return array('tmpfile' => $this->fieldName);
  }
}
?>