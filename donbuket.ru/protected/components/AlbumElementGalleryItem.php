<?php

/**
 * for a flower shop gallery
 */
class AlbumElementGalleryItem implements GalleryItemIf {
  private $ae;
  /**
   * @param AlbumElement is model object
   */
  public function __construct($ae) {
    $this->ae = $ae;
  }
  public function getDescription() {
    return "описание фотки здесь";
  }
  /** original image */
  public function getOriginal() {
    //   return Yii::app()->filestorage->createUrl($this->ae->photo->hashName);
    // the file extention is required for galleria js library.
    // link without extention is treated as a reqular file rather image. and
    // high resolution image is not loaded. instead its thumbnail is used. 
    return Yii::app()->createUrl('site/getFile',
                                 array('hash' => base64_encode($this->ae->photo->hashName). '.jpg'));
  }
  /** small image */
  public function getThumbnail() {
    // better set big cash time
    return SmoothGalleryWidget::getThumbnailUrl($this->ae->photo, 122, null);        
  } 
  /** @return String file name */
  public function getTitle() {
    return $this->ae->photo->origName;
  }
}
?>