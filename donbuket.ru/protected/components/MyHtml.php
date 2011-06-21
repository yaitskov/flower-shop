<?php


/**
 * class extends functional of CHtml class
 */
class MyHtml extends CHtml {
  /**
   * @return string goto button
   */
  public static function getButton($label, $url) {
    return CHtml::button($label, array( 'onclick' => "location.href=\"$url\";") );
  }
}

?>