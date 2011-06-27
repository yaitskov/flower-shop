<?php
/*  this is a view template
 */
Yii::app()->clientScript->registerCssFile('/css/form.css');
?>
<div class="form" style="text-align: center; margin-top: 40px;">
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
  
  <?=  $form->errorSummary($model); ?>


  <table align='center'>
   <tr>
   <td  style='padding-bottom: 10px;'>
   <?= $form->labelEx($model,'tmpfile'); ?>
   </td>
   <td  style='padding-bottom: 10px;'>   
    <?= $form->fileField($model,'tmpfile'); ?>
   </td>
   </tr>
   <tr>
   <td></td>
   <td>
    <?= $form->error($model,'tmpfile'); ?>
   </td>
   </tr>

   <tr>
   <td  style='padding-bottom: 10px;'>
   <?= $form->labelEx($model,'caption'); ?>
   </td>
   <td  style='padding-bottom: 10px;'>   
    <?= $form->fileField($model,'caption'); ?>
   </td>
   </tr>
   <tr>
   <td></td>
   <td>
    <?= $form->error($model,'caption'); ?>
   </td>
   </tr>
     
   <tr>
   <td  style='padding-bottom: 10px;'>
   <?= $form->labelEx($model,'description'); ?>
   </td>
   <td  style='padding-bottom: 10px;'>   
     <?= $form->textArea($model,'description'); ?>
   </td>
   </tr>
   <tr>
   <td></td>
   <td>
    <?= $form->error($model,'description'); ?>
   </td>
   </tr>
   </table>
  <div class="row buttons">
    <?=  CHtml::submitButton('Загрузить'); ?>
     <?php if(isset($this->action->cancelPath)): ?>
     <?= MyHtml::getButton('Отмена', $this->action->cancelPath); ?>
     <?php endif; ?>
  </div>

  <?php $this->endWidget(); ?>
  
</div><!-- form -->
