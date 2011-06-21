<?php

/**
 * base class
 */
abstract class FieldType {
  public $form;
  public function __construct($form) {
    $this->form = $form;
  }
  abstract function drawField($model, $name);    
}

?>