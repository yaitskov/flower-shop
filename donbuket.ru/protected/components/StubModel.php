<?php

/**
 * The class of a model object with one field. A value of the field is
 * got from a real model object. It has been done to exclude
 * capability mix existing validate errors of a real model object with
 * thoese which were just now detected.  There is another method
 * without temporary model object - save errors of a real model object
 * to temporary array and then restore them from there.
 * But I like more first method because it is more constructive and therefore
 * less destructive.
 */
class StubModel extends CModel {
  public $theField;
  public function __construct($fieldValue) {
    //parent::__construct();
    $this->theField = $fieldValue;
  }
  public function attributeNames() {
    return array('theField');
  }
}
?>