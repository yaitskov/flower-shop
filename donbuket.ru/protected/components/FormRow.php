<?php

class FormRow extends CActiveForm {
  protected $defFieldType = null;
  /**
   * @return String html table row ( triple of field caption, field value  and errrors )
   */
  public function genFormRow($model, $name, $type = null) {
    if ($type === null) $type = $this->defaultFieldType();
    return (CHtml::tag( 'tr', array(),
                        CHtml::tag('td', array(), $this->labelEx($model, $name))
                        .  CHtml::tag('td', array(), $type->drawField($model, $name)))
            . CHtml::tag('tr', array(),
                   CHtml::tag('td')
                         . CHtml::tag('td', array(), $this->error($model, $name))));
                
  }
  public function genFormCell($model, $name, $type = null) {
    if ($type === null) $type = $this->defaultFieldType();
    return (CHtml::tag( 'tr', array(),
                        CHtml::tag('td', array(), $this->labelEx($model, $name)))
            . CHtml::tag('tr', array(),
                         CHtml::tag('td', array('colspan' => 2), $type->drawField($model, $name)))
            . CHtml::tag('tr', array(),
                   CHtml::tag('td')
                         . CHtml::tag('td', array(), $this->error($model, $name))));    
  }
  public function setDefaultFieldType(FieldType $dft) {
    $this->defFieldType = $dft;
  }
  public function defaultFieldType() {
    if (null === $this->defFieldType)
      $this->defFieldType = $this->createTextType();
    return $this->defFieldType;
  }
  public function createTextType() {
    return new TextFieldForm($this);
  }
  public function createAreaType() {
    return new AreaFieldForm($this);
  }
}
?>