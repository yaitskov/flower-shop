<?php
echo CHtml::tag('div',
                array('class' => 'page-section-body', 'style' => 'text-align: center;'),
                CHtml::image(Yii::app()->filestorage->createUrl($data->photo->hashName),
                             $data->photo->origName,
                             array('class' => 'shop_photo rounded-corners')));

$this->widget(
  'HorizontalMenu',
  array(
    'items'=>array(
      array( 'label'  => 'Удалить',
             'url'    => array( 'aboutus/delete_photo',
                                'id' => $data->id )
      ),
      array( 'label'  => 'Добавить',
             'url'    => array( 'aboutus/add_photo',
                                'id' => $data->album_id )
      ),
      array( 'label'  => 'К магазину',
             'url'    => array( 'site/aboutus',
                                '#' => 'shop' . FlowerShop::model()->findByAlbum($data->album)->id)
      ),            
    )
  )
);

?>