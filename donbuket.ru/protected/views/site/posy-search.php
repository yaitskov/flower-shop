<?php
// breadcrumbs is not need here 'cos site head say about this page's route

//$isAdmin = Yii::app()->user->isRoot;
$this->menu = array_merge($this->menu,
                          array(
                            array('label' => 'Каталог букетов',
                                  'url' => array('site/posyByGroup')
                            )
                          )
);

/*  form parameters of posy search:
 *  sort order ( by price, by alphabet, by popularity, by date - to get new posies)
 *  number items per page
 *  search by:
 *     pattern name
 *     by category - select from list
 *     presence or absence set flowers, colors
 *     type person which get a posy : female (lover), female(friend), dead, ....
 *     age orientation
 *     range of number flowers in a posy
 *     maximal or/and minimal number of different type flowers or/and colors
 *     average uptime
 */
?>
<div class="Form">
<?php $form=$this->beginWidget('CActiveForm'); ?>
	<?php echo $form->errorSummary($model); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'subject'); ?>
		<?php echo $form->textField($model,'subject',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'body'); ?>
		<?php echo $form->textArea($model,'body',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<?php if(CCaptcha::checkRequirements()): ?>
	<div class="row">
		<?php echo $form->labelEx($model,'verifyCode'); ?>
		<div>
		<?php $this->widget('CCaptcha'); ?>
		<?php echo $form->textField($model,'verifyCode'); ?>
		</div>
		<div class="hint">Please enter the letters as they are shown in the image above.
		<br/>Letters are not case-sensitive.</div>
	</div>
	<?php endif; ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->


