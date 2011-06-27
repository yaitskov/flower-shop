<?php

/**
 * 
 */
class UploadAlbumPhotoForm extends UploadForm
{
  public $caption, $description;
  public function rules()
  {
    return array_merge(
      parent::rules(),
      array(
        array('caption', 'length', 'max' => 40),
        array('description', 'length', 'max' => 2000)
      )
    );
  }
  public function attributeLabels() {
    return array_merge(
      parent::attributeLabels(),
      array('caption' => 'Название',
            'description' => 'Описание'
      )
    );
  }
}
?>