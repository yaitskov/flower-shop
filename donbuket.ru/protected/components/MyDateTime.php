<?php

/**
 * class groups a raft of format methods 
 */
class MyDateTime {
  private static $mdt = null;
  public static function get() {
    if (self::$mdt === null)
      self::$mdt = new MyDateTime();
    return self::$mdt;
  }
  /**
   * @param Integer if $now === null -> current time
   * @return String of date and time in mysql format 'yyyy-mm-dd hh:mm:ss'
   */
  public function dbDateTime($now = null) {    
    return date('Y-m-d H:i:s', is_numeric($now) ? $now : time());
  }
}

?>