<?php

/**
 * cut off seconds, only if time is valid.
 */
class TimeDecorator extends FieldDecorator {
  /**
   * @overriden
   * @return string
   */
  protected function getValidatorClass() {
    return get_class(new TimeValidator()); //'TimeValidator';
  }
  /**
   * @overriden
   */
  protected function process($value, $name) {
    if (preg_match('/^([0-9]{2}):([0-9]{2})(:([0-9]{2}))?$/', $value, $matches)) {
      return "$matches[1]:$matches[2]";
    } else {
      return $value;
    }
  }
}

?>