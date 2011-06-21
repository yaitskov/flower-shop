<?php

class TextFieldForm extends FieldType {
  public function drawField($model, $name) {
    return $this->form->textField($model, $name);
  }
}

?>