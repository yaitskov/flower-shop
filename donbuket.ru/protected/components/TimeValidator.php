<?php

/**
 * the time validator of a model object isn't in yii 1.1.6
 */
class TimeValidator extends CValidator {
  /**
   * if it's true then valid time value can't have seconds 
   */
  public $withoutSeconds = false;
  /**
   * @param CModel $model
   * @param String $attributes time in format hh:mm[:ss]
   * @return void
   */   
  protected function validateAttribute($model, $attribute) {
    if (!strlen($model->$attribute)) return;
    if ($this->withoutSeconds)
      $pattern = '/^([0-9]{2}):([0-9]{2})$/';
    else
      $pattern = '/^([0-9]{2}):([0-9]{2})(:([0-9]{2}))?$/';
    
    if (!preg_match($pattern,
                   $model->$attribute,
                   $matches)
        or $matches[1] < 0 or $matches[1] > 23
        or $matches[2] < 0 or $matches[2] > 59
        or (isset($matches[4]) and ($matches[4] < 0 or $matches[4] > 59)))
      $model->addError($attribute, 'Неверный формат времени. Требуется ЧЧ:ММ.');
  }
}

?>