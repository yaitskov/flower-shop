<?php
$this->breadcrumbs=array(
	'Web Sites',
);

$this->menu=array(
	array('label'=>'Create WebSite', 'url'=>array('create')),
	array('label'=>'Manage WebSite', 'url'=>array('admin')),
);
?>

<h1>Web Sites</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
