<?php


class RouteFile extends DescriptionFile {
  public function tableName() {
    return 'route_file';
  }
  public function rules() {
    return array_merge(
      parent::rules(),
      array(
        array( 'shop_id', 'required'),
        array( 'shop_id', 'exist', 'className' => "FlowerShop", 'attributeName' => 'id' ),
      ));
  }
  public function relations() {
    return array_merge(parent::relations(),
                       array('shop' => array(self::BELONGS_TO,
                                             'FlowerShop', 'shop_id')));
  }
}

?>