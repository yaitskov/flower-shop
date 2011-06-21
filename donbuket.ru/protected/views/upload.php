<?php
/*  this is a view template
 */
?>
<div class="form">
  <?php
   $model = $modelForm;
   $ref = new ReflectionClass ( $modelForm );
   $form=$this->beginWidget(
     'CActiveForm',
     array(
       'htmlOptions' => array ( 'enctype' => 'multipart/form-data', ),
       'enableAjaxValidation'=>false )
   );
?>

  <p class="note">Fields with <span class="required">*</span> are required.</p>
  
  <?=  $form->errorSummary($model); ?>
  
  <div class="row">
    <?= $form->labelEx($model,'tmpfile'); ?>
    <?= $form->fileField($model,'tmpfile'); ?>
    <?= $form->error($model,'tmpfile'); ?>
  </div>
  <div class="row buttons">
    <?=  CHtml::submitButton('Upload'); ?>
  </div>

  <?php $this->endWidget(); ?>
  
</div><!-- form -->
