<?php $this->breadcrumbs=array( "О нас" );

echo CHtml::tag(
  'div',
  array( 'class' => 'page-section-body' ),
  $this->website->about
);

$this->widget(
  'HorizontalMenu',
  array(
    'items'=>array(
      array( 'label'  => 'Править',
             'url'    => array('aboutus/update_common_description'),
             'visible'=> $this->website->canUpdate ( Yii::app()->user )
      ),
    ),
  )
);

echo CHtml::tag( 'h1',
                 array ( 'class' => 'page-section-header' ),
                 'Наши магазины' );
Yii::app()->clientScript->registerCssFile ( '/css/aboutus.css' ) ;

$this->widget('zii.widgets.CListView',
              array( 'dataProvider'=>$dataProvider,
                     'itemView'=>'_shop_view' ) );
?>
