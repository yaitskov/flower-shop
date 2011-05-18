<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('visitors_a_hour')); ?>:</b>
	<?php echo CHtml::encode($data->visitors_a_hour); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('visitors_a_day')); ?>:</b>
	<?php echo CHtml::encode($data->visitors_a_day); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('support_email')); ?>:</b>
	<?php echo CHtml::encode($data->support_email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('birth_year')); ?>:</b>
	<?php echo CHtml::encode($data->birth_year); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('meta_keywords')); ?>:</b>
	<?php echo CHtml::encode($data->meta_keywords); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('meta_description')); ?>:</b>
	<?php echo CHtml::encode($data->meta_description); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('meta_author')); ?>:</b>
	<?php echo CHtml::encode($data->meta_author); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('about')); ?>:</b>
	<?php echo CHtml::encode($data->about); ?>
	<br />

	*/ ?>

</div>