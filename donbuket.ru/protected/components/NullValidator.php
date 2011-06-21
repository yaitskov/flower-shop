<?php
/**
 * this is a stub validator. it doesn't test values of model fields in any way
 * and always says "it's okay".
 */

class NullValidator extends CValidator {
  /**
   * @return void
   */
  protected function validateAttribute(CModel $object, $attribute) {
    // return true;
  }
}
?>