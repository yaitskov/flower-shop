<?php

class UploadAlbumPhoto extends UploadAction {
  public $cancelPath = null;
  /**
   * @param CModel 
   */ 
  protected function saveOkay($file) {
    // create album element which will refere to photo entity
    $al = new AlbumElement();
    $al->album_id = Yii::app()->request->getParam('id');
    if (null === $al->album_id)
      throw new UserEx("Албом не задан");
    $al->photo_id = $file->id;
    $al->caption = $this->modelForm->caption;
    $al->description = $this->modelForm->description;
    if ($al->save()) {
      parent::saveOkay($file);
    } else {
      $this->modelForm->addError(
        'tmpfile',
        $this->controller->arrayTreeToList($al->errors)
      );
    }
  }
  /**
   * @param CModel 
   */ 
  //  protected function saveFail($file) {
  //  }
}

?>