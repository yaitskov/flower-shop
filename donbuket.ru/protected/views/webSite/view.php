<?php
$this->breadcrumbs=array(
	'Web Sites'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List WebSite', 'url'=>array('index')),
	array('label'=>'Create WebSite', 'url'=>array('create')),
	array('label'=>'Update WebSite', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete WebSite', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage WebSite', 'url'=>array('admin')),
);
?>

<h1>View WebSite #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'visitors_a_hour',
		'visitors_a_day',
		'support_email',
		'birth_year',
		'meta_keywords',
		'meta_description',
		'meta_author',
		'name',
		'about',
	),
)); ?>
