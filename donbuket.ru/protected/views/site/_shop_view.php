<div class='page-section-body'>
  <div class='flower-shop'>
    <div>
      <div>
        <?= CHtml::encode( $data->mail_address ) ?>
      </div>
      <div>
        <span><?= CHtml::encode( $data->phone ) ?></span>
      </div>
      <div style='display: inline;'>
        Ежедневно с <span><?=Yii::app()->cfrm->ftime($data->start_work_at)?></span>
        до <span><?=Yii::app()->cfrm->ftime($data->end_work_at)?></span>
      </div>
    </div>
    <div>
       <p><?= CHtml::encode ( $data->outline_route ) ?></p>
    </div>
  </div>
  <div align='center'>
     <?php $this->widget(
             'YandexMap',
             array( 'places' =>
                    array ( array ( 'x' => $data->place_x,
                                    'y' => $data->place_y,
                                    'text' => $data->name
                                    )
                            ),
                    'width' => $this->website->map_width,
                    'height' => $this->website->map_height,
                    'center' => array ( $data->map_center_x,
                                        $data->map_center_y )
                    )
           ); ?>
  </div>
  <div>
     <?php $this->widget (
             'SmoothGalleryWidget',
             array ( 'listOfImages' =>
                        $data->gallery->galleryImages (
                             array ( $this, 'createAlbumElementGalleryItem')
                        )
                    )
           ); ?>
  </div>
</div>
<?php
   $canUpdate = $data->canUpdate ( Yii::app()->user );
   $this->widget(
     'HorizontalMenu',
     array(
       'items'=>array(
         array( 'label'  => 'Править карту',
                'url'    => array( 'aboutus/update_map',
                                   'id' => $data->id                          
                                 ),
                'visible'=> $canUpdate
         ),
         array( 'label'  => 'Править фотоки',
                'url'    => array( 'aboutus/update_shop_gallery',
                                   'id' => $data->id 
                                 ),
                'visible'=> $canUpdate
         ),
         array( 'label'  => 'Править остальное',
                'url'    => array( 'aboutus/update_shop_info',
                                   'id' => $data->id 
                                 ),
                'visible'=> $canUpdate
         ),
       ),
     )
   );   ?>

    
