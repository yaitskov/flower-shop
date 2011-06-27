<?php

/**
 * This is the model class for table "photo".
 *
 * The followings are the available columns in table 'photo':
 * @property string $id
 * @property string $numlinks
 * @property string $path
 * @property string $extention
 * @property string $width
 * @property string $height
 *
 * The followings are the available model relations:
 * @property AlbumElement[] $albumElements
 * @property Flower[] $flowers
 * @property PaymentType[] $paymentTypes
 * @property Posy[] $posys
 * @property PosyView[] $posyViews
 * @property Product[] $products
 * @property ProductCategory[] $productCategories
 * @property SiteUser[] $siteUsers
 */
class Photo extends File {
  /**
   * Returns the static model of the specified AR class.
   * @return Photo the static model class
   */
  public static function model($className=__CLASS__)
  {
    return parent::model($className);
  }

  /**
   * @return array validation rules for model attributes.
   */

  public function relations()
  {
    return array_merge(
      parent::relations(),
      array(
        'albumElements' => array(self::HAS_MANY, 'AlbumElement', 'photo_id'),
        'flowers' => array(self::HAS_MANY, 'Flower', 'icon_id'),
        'paymentTypes' => array(self::HAS_MANY, 'PaymentType', 'icon_id'),
        'posys' => array(self::HAS_MANY, 'Posy', 'icon_id'),
        'posyViews' => array(self::HAS_MANY, 'PosyView', 'icon_id'),
        'products' => array(self::HAS_MANY, 'Product', 'icon_id'),
        'productCategories' => array(self::HAS_MANY, 'ProductCategory', 'icon_id'),
        'siteUsers' => array(self::HAS_MANY, 'SiteUser', 'face_id'),
      )
    );
  }

  public function attributeLabels(){
    return array_merge( parent::attributeLabels(),
                        array( 'width' => 'Ширина в писелях',
                               'height' => 'Высота в писелях' ) );
  }
}