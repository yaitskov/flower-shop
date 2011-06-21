<?php

class AreaFieldForm extends FieldType {
  public function drawField($model, $name) {
    return $this->form->textArea($model, $name);
  }
}

?>