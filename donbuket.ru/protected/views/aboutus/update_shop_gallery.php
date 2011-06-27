<style type='text/css'>
   img.shop_photo {
 max-width: 100%;
 padding: 0px;
 margin: 0px;
 }
   div.page-section-body {
     margin-top: 30px;
   padding: 0px !important;
   }
</style>
<?php

$this->breadcrumbs = array ( 'Управление галереей магазина \'' . $shop->name . '\'');
Yii::app()->clientScript->registerCssFile ( '/css/form.css' );
$this->widget('zii.widgets.CListView',
              array( 'dataProvider'=>$photoes,
                     'itemView'=>'_photo_view' ) );
?>