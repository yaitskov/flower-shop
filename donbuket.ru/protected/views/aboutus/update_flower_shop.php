<div class="form">
<?php
   $this->breadcrumbs = array ( 'Описание магазина' );
   Yii::app()->clientScript->registerCssFile ( '/css/form.css' );
   $form=$this->beginWidget('FormRow', array(
	'id'=>'flower-shop-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Поля обязательные к заполнению <span class="required">*</span>.</p>

     <?php echo $form->errorSummary( new UniqueErrorMessagesFilter($model)); ?>
     <table class='form'>
     <?php
     echo $form->genFormRow($model, 'name') 
     . $form->genFormRow($model, 'phone') 
     . $form->genFormRow($model, 'pretty_start_work_at')
     . $form->genFormRow($model, 'pretty_end_work_at')
     . $form->genFormCell($model, 'outline_route', $form->createAreaType());
     $form->widget('IEditor', array( 'name' => 'FlowerShop_outline_route',
                                     'route' => 'aboutus/insert_into_route_description',
                                     'hostid' => $model->id ));
     ?>
     </table>
     <div class="row buttons">
       <?php echo CHtml::submitButton( $model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
       <?php echo MyHtml::getButton('Отмена', '/site/aboutus'); ?>  
     </div>
<?php $this->endWidget(); ?>

</div><!-- form -->