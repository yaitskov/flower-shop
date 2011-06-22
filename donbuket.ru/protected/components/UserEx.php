<?php

/**
 * this exception passes its message to the user 
 */
class UserEx extends CHttpException {
  public function __construct($message) {
    parent::__construct(0, $message);
  }
}

?>