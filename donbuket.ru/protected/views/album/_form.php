<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'album-form',
	'enableAjaxValidation'=>false,
        'htmlOptions'=>array('enctype'=>'multipart/form-data')        
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

   <?php echo $form->errorSummary($model,"<div style='padding-bottom: 10px;'>Форма заполнена неправильно:</div>" ); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'upload'); ?>
		<?php echo $form->fileField($model,'upload'); ?>
		<?php echo $form->error($model,'upload'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->