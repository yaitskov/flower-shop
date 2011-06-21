<?php

/**
 * it makes rough chech of telephone number because. There are many phone formats.
 * And length of phone number is vary.
 */
class PhoneValidator extends CValidator {
  /**
   * var integer minimal length of valid phone number. default is 5.
   */
  public $min = 5;
  protected function validateAttribute($model, $attribute) {
    if (!preg_match('/^[+]?([0-9]{1,}[-]?){1,10}[0-9]$/',
                    $model->$attribute)
        or strlen($model->$attribute) < $this->min )
      $model->addError($attribute,
                       'Проверте номер телефона, он содержит ошибку. Цифры номера допускается разделять символами тире.');
  }
}

?>