<?= CHtml::link('', '', array( 'name' => 'shop' . $data->id)); ?>   
<div class='page-section-body'>
  <div align='center'>   
  <div style='width: <?= $this->website->map_width; ?>' class='float-left shop-card'>
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
       <?= $data->outline_route ?>
    </div>
   <div class="stop-float">
   </div>
  </div>

   <?php if (false) $this->widget(
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
 <?php if ( $data->gallery  ): ?>
 <?php $this->widget (
             'SmoothGalleryWidget',
             array ( 'listOfImages' =>
                        $data->gallery->galleryImages (
                             array ( $this, 'createAlbumElementGalleryItem')
                        )
                    )
           ); ?>
 <?php endif; ?>
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
                                   'id' => $data->id ),
                'visible'=> $canUpdate
         ),
         array( 'label'  => 'Править фотоки',
                'url'    => array( 'aboutus/update_shop_gallery',
                                   'id' => $data->id ),
                'visible'=> $canUpdate
         ),
         array( 'label'  => 'Править остальное',
                'url'    => array( 'aboutus/update_shop_info',
                                   'id' => $data->id ),
                'visible'=> $canUpdate
         ),
         array( 'label'  => 'Удалить',
                'url'    => array( 'aboutus/delete_shop',
                                   'id' => $data->id ),
                'visible'=> $canUpdate),         
         array( 'label'  => 'Дублировать',
                'url'    => array( 'aboutus/duplicate_shop',
                                   'id' => $data->id ),
                'visible'=> $canUpdate),         
         array( 'label'  => $data->enabled ? 'Скрыть' : 'Показать',
                'url'    => array( 'aboutus/freeze_unfreeze_shop',
                                   'id' => $data->id ),
                'visible'=> $canUpdate),         
         array( 'label'  => 'Добавить магазин',
                'url'    => array( 'aboutus/add_new_shop' ),
                'visible'=> $canUpdate
         ),         
       ),
     )
   );   ?>

    
