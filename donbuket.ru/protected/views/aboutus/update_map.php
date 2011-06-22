<script type="text/javascript">
  function  change_obj_pos(pos)  {
    $("#FlowerShop_place").val(pos);
  }
  function change_scale(scale) {
    $('#FlowerShop_map_scale').val(scale);
  }
  function change_map_center(pos) {
    $("#FlowerShop_map_center").val(pos);        
  }
</script>

<?php

  if ($model->place_x and $model->map_center_x) $this->widget(
             'YandexMap',
             array( 'constructor' => true,
                    'hookChangeScale' => 'change_scale',
                    'hookChangeMapCenter' => 'change_map_center', 
                    'hookChangeObjectPosition' => 'change_obj_pos',
                   'places' =>
                    array ( array ( 'x' => $model->place_x,
                                    'y' => $model->place_y,
                                    'text' => $model->name
                                    )
                            ),
                    'width' => $this->website->map_width,
                    'height' => $this->website->map_height,
                    'center' => array ( $model->map_center_x,
                                        $model->map_center_y )
                    )
           ); 

$model->scenario = 'map';
?>
<div class="form">
<?php
   $this->breadcrumbs = array ( 'Управление картой магазина' );
   Yii::app()->clientScript->registerCssFile ( '/css/form.css' );
   $form=$this->beginWidget('FormRow', array(
	'id'=>'flower-shop-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Поля обязательные к заполнению <span class="required">*</span>.</p>

     <?= $form->errorSummary( new UniqueErrorMessagesFilter($model)); ?>
     <style type="text/css">
         .map-form input[type=text],
         .map-form div.hint,
         .map-form div.errorMessage     
         { width: 81% !important; }
     </style>
     <table class='form map-form'>
     <?= $form->genFormRow($model, 'place', null,
     "Координаты магазина можно задать щелчком левой кнопкой мыши на карте.")
     . $form->genFormRow($model, 'map_center', null,
     "Координаты центра изменяются перетаскиванием (зажмите левую кнопку мыши и перемещайте курсор в нужном направлении)")
     . $form->genFormRow($model, 'map_scale', null,
                         "Масштаб запоминается автоматически"
     )
     ?>
     </table>
     <div class="row buttons">
       <?= CHtml::submitButton( 'Сохранить'); ?>
     <?= MyHtml::getButton('Отмена', $this->getShopUrl($model)); ?>
     <?= MyHtml::getButton('Удалить карту',
                            $this->createUrl( 'aboutus/delete_map',
                                              array( 'id' => $model->id ) ) ); ?>    
     </div>
<?php $this->endWidget(); ?>

</div><!-- form -->