<?php

  /**
   * Методы форматированного вывода даты и времени 
   */
class CommonFormatter extends CComponent {
  public function init(){
  }
  public function purify( $text ) {
    $p = new CHtmlPurifier();
    $p->options = array('URI.AllowedSchemes'=>
                        array( 'http' => true,'https' => true ));
    return $p->purify( $text );    
  }
  public function ftime( $time = null ){
    if ( $time === null ) $time = time();
    return Yii::app()->dateFormatter->format( 'H:mm', $time );
  }
  public function fdate( $date = null ){
    if ( $date === null ) $date = time();
    return Yii::app()->dateFormatter->format(  'd.m.Y', $date );
  }
  public function fdttm ( $datetime = null ) {
    if ( $date === null ) $date = time();
    return Yii::app()->dateFormatter->format(  'd.m.Y H:mm', $date );    
  }
}

?>