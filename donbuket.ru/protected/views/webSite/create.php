<?php
$this->breadcrumbs=array(
	'Web Sites'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List WebSite', 'url'=>array('index')),
	array('label'=>'Manage WebSite', 'url'=>array('admin')),
);
?>

<h1>Create WebSite</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>