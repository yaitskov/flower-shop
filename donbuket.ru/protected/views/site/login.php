<?php
  Yii::app()->clientScript->registerCssFile ( '/css/form.css' );

  $this->detPageTitle ( "Вход на сайт" );
  $this->breadcrumbs = array( 'Вход на сайт' );
?>

<div align="center" class="form login-form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableAjaxValidation'=>true,
)); ?>
<table>
   <tr>
       <td><?php echo $form->labelEx($model,'username'); ?></td>
       <td><?php echo $form->textField($model,'username'); ?></td>
    </tr>
       <tr><td></td><td><?php echo $form->error($model,'username'); ?></td>
      </td>
   </tr>
   <tr>
      <td><?php echo $form->labelEx($model,'password'); ?></td>
      <td><?php echo $form->passwordField($model,'password'); ?></td></tr>
   <tr><td></td><td><?php echo $form->error($model,'password'); ?></td></tr>
   <tr>
      <td></td><td align="right"><?php echo CHtml::submitButton('войти'); ?></td>
   </tr>
</table>
<?php $this->endWidget(); ?>
</div><!-- form -->
