<?php

/**
 * autoformat specified attributes of an AR object. base class.
 * Decorator can only work when a field value is valid.
 * If the value is wrong then the decorator does nothing.
 */
abstract class FieldDecorator extends CModel {
  protected $model, $fields;
  /**
   * @param CModel 
   * @param mixed it can array<string> fields to be decorated or a
   *                string if just one field is required to be decorated
   */
  public function __construct(CModel $model, $fields) {
    $this->model = $model;
    $this->fields = is_string($fields) ? explode(' ', $fields) : $fields;
  }
  /**
   * this class is a wrapper around some real model object therefore
   * its field set equals to the set of the real model object
   * @return array<string>
   */
  public function attributeNames() {
    return $this->model->attributeNames();
  }
  public function __get($name) {    
    $model = $this->model;    
    $value = $model->attributes[$name];
    if (in_array($name, $this->fields)) {
      $sm = new StubModel($value);
      $v = CValidator::createValidator($this->getValidatorClass(),
                                       $sm,
                                       $sm->attributeNames());
      $v->validate($sm);
      if (!count($sm->errors))
        return $this->process($value, $name);
      //      else
      //        throw new Exception( implode("\n", $sm->errors));
    }
    return $value;
  }
  /**
   * to be overriden in subclasses
   *
   * @return its argument. i.e. do nothing by default
   */
  abstract protected function process($value, $name);
  /**
   * to be ovrriden in subclasses
   *
   * @return string class name of a validator 
   */
  abstract protected function getValidatorClass();
}

?>