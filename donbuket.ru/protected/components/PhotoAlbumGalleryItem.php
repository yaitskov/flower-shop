<?php


class PhotoAlbumGalleryItem implements GalleryItemIf {
  private $album_element ;
  public function __construct( AlbumElement $album_element ){
    $this->album_element = $album_element;
  }
  public function getTitle(){
    return "Название рисунка";
  }
  public function getDescription(){
    return "Комментарий к рисунку";    
  }
  public function getOriginal(){
    return Yii::app()->filestorage->createUrl ( $this->album_element->photo->path );
  }
  public function getThumbnail(){
    return Yii::app()->controller->createUrl ( 'site/thumbnail',
                                               array ( 'id' => $this->album_element->photo_id ) );
  }
}