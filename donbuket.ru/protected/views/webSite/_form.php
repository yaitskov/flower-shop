<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'web-site-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'visitors_a_hour'); ?>
		<?php echo $form->textField($model,'visitors_a_hour',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'visitors_a_hour'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'visitors_a_day'); ?>
		<?php echo $form->textField($model,'visitors_a_day',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'visitors_a_day'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'support_email'); ?>
		<?php echo $form->textField($model,'support_email',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'support_email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'birth_year'); ?>
		<?php echo $form->textField($model,'birth_year',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'birth_year'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'meta_keywords'); ?>
		<?php echo $form->textArea($model,'meta_keywords',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'meta_keywords'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'meta_description'); ?>
		<?php echo $form->textArea($model,'meta_description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'meta_description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'meta_author'); ?>
		<?php echo $form->textArea($model,'meta_author',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'meta_author'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'about'); ?>
		<?php echo $form->textArea($model,'about',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'about'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->