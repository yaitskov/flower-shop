<?php
class HorizontalMenu extends CWidget {
  public $items;
  public function init () {
  }
  public function run() {
    $css = Yii::app()->assetManager->publish ( dirname( __FILE__)
                                               . DS . 'hmenu.css' );
    Yii::app()->clientScript->registerCssFile ( $css );
    echo '<div class="horizontal-menu">';
    $this->widget('zii.widgets.CMenu', array ( 'items' => $this->items ) );
    echo '<div class="stop-float"></div>';
    echo '</div>';
  }
}

?>