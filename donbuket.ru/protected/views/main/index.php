<?php
$this->breadcrumbs=array(
	'Main',
);

echo CHtml::textArea( 'text_area1',
                      "HELLO <b>WORLD</b>",
                      array ( 'rows' => 25, 'cols' => 80 ) );

$this->widget( 'application.extensions.editor.editor',
               array ( 'name' => 'text_area1' ) );

?>
