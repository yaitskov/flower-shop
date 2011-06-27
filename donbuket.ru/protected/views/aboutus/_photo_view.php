<?php
echo CHtml::link('', '', array( 'name' => 'photo' . $data->id)); 
echo CHtml::tag('div',
                array('class' => 'page-section-body', 'style' => 'text-align: center;'),
                CHtml::image(Yii::app()->filestorage->createUrl($data->photo->hashName),
                             $data->photo->origName,
                             array('class' => 'shop_photo rounded-corners')));
if (!empty($data->caption))
  echo CHtml::tag('div',
                  array('class' => 'page-section-body',
                        'style' => 'padding: 5px !important; font-size: 19pt; font-weight: bold; text-align: center; margin-top: 5px;'),
                  $data->caption
  );
if (!empty($data->description))
  echo CHtml::tag('div',
                  array('class' => 'page-section-body',
                        'style' => 'text-indent: 2cm; padding: 5px !important; text-align: justify; margin-top: 5px;'),
                  $data->description
  );

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
      array( 'label'  => 'Править подпись',
             'url'    => array( 'aboutus/update_photo_caption',
                                'aeid' => $data->id )
      ),
      array( 'label'  => $data->is_visible ? 'Скрыть' : 'Показать',
             'url'    => array( 'aboutus/freeze_unfreeze_photo',
                                'aeid' => $data->id )
      ),
      array( 'label'  => 'Выше',
             'url'    => array( 'aboutus/up_photo',
                                'aeid' => $data->id )
      ),            
      array( 'label'  => 'Ниже',
             'url'    => array( 'aboutus/down_photo',
                                'aeid' => $data->id )
      ),                  
    )
  )
);

?>