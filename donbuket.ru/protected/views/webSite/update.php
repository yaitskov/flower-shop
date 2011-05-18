<?php
$this->breadcrumbs=array(
	'Web Sites'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List WebSite', 'url'=>array('index')),
	array('label'=>'Create WebSite', 'url'=>array('create')),
	array('label'=>'View WebSite', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage WebSite', 'url'=>array('admin')),
);
?>

<h1>Update WebSite <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>