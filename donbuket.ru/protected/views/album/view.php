<?php
$this->breadcrumbs=array(
	'Albums'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Album', 'url'=>array('index')),
	array('label'=>'Create Album', 'url'=>array('create')),
	array('label'=>'Update Album', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Album', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Album', 'url'=>array('admin')),
);
?>

<h1>View Album #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
                array ( 'type' => 'raw',
                        'label' => "multiline",
                        'value' => "<pre>" . CHtml::encode ( "HELLO WORLD\nGOOD BYE!\n" ) . "</pre>"
                        ),
		array ( 'type' => 'raw',
                        'value' => CHtml::image( $model->getPhotoUrl() )
                        ),
		'filename',
	),
)); 

?>
