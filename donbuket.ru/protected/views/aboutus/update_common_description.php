<?php

$this->breadcrumbs = array ( 'О нас, общее описание' );

?>
<div class="form">
<?php Yii::app()->clientScript->registerCssFile('/css/form.css' ); ?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'website-form',
	'enableAjaxValidation'=>false,
)); ?>
	<div class="row">
		<?php echo $form->textArea($model,'about');
                     $this->widget('IEditor',
                                   // the site has only one entity of website object
                                   // host id isn't required here
                                   array('name'=>'WebSite_about',
                                         'route'  => 'aboutus/insert_into_common_description'
                                   ));
                ?>
		<?php echo $form->error($model,'about'); ?>
	</div>

                     <div class="row buttons">
  <?php echo CHtml::submitButton('Сохранить'); ?>
  <?php echo MyHtml::getButton('Отмена', '/site/aboutus'); ?>  

	</div>
<?php $this->endWidget(); ?>  
</div><!-- form -->