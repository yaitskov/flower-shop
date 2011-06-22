<?php
$this->pageTitle=Yii::app()->name . ' - Ошибка';
$this->breadcrumbs=array(
	'Ошибка',
);
?>

<div class="error">
<?php echo CHtml::encode($message); ?>
</div>