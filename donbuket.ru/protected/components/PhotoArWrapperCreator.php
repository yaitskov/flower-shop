<?php

/**
 * UploadAction can instantiate file object which have constructor without arguments.
 * But wrapper FileArWrapper requires host object as only constructor argument.
 * Let FileArWrapper requires argument so we can inherit from it.
 */
class PhotoArWrapperCreator extends FileArWrapper{
  public function __construct() {
    parent::__construct(new Photo());
  }
}
?>