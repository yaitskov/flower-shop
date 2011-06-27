<?php
/*  this is a view template
 */
Yii::app()->clientScript->registerCssFile('/css/form.css');
?>
<div class="form" style="text-align: center; margin-top: 40px;">
  <?php
   $model = $modelForm;
//   $ref = new ReflectionClass ( $modelForm );
   $form=$this->beginWidget(
     'CActiveForm',
     array(
       'htmlOptions' => array ( 'enctype' => 'multipart/form-data', ),
       'enableAjaxValidation'=>false )
   );
?>
  
  <?=  $form->errorSummary($model); ?>
<?php $uploadingScenario = ($model instanceof CFormModel); ?>

  <table class='form' align='center'>
     <?php //upload new image -> CFormModel
     // CActiveRecord -> change the caption of existing entity
     if ($uploadingScenario): ?>
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
      <?php else:          ?>
      <tr>
      <td colspan='2'>
      <?php echo CHtml::image(Yii::app()->filestorage->createUrl($model->photo->hashName),
      empty($model->caption) ? $model->photo->origName : $model->caption); ?>
      <td>
      </tr>
      <?php endif; ?>
   <tr>
   <td  style='padding-bottom: 10px;'>
   <?= $form->labelEx($model,'caption'); ?>
   </td>
   <td  style='padding-bottom: 10px;'>   
    <?= $form->textField($model,'caption'); ?>
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
      <?=  CHtml::submitButton($uploadingScenario ? 'Загрузить' : 'Сохранить'); ?>
     <?php if ($uploadingScenario)
     $url =  $this->action->cancelPath;
     else
       $url = $this->urlOfPhoto($model);
           echo MyHtml::getButton('Отмена', $url  ); ?>
     
  </div>
 
  <?php $this->endWidget(); ?>

</div><!-- form -->
