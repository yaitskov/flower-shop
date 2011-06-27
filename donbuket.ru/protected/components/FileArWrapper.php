<?php

/**
 * UploadAction requires method frompUploadedFile of file object
 * will take CFormModel object.
 * But file base file object takes CUploadedFile object
 */
class FileArWrapper extends HookWrap {
  /**
   * @param CFormModel
   */
  protected function hookm_fromUploadedFile($uploadForm) {
    $updfile = CUploadedFile::getInstance( $uploadForm, 'tmpfile' );
    return $this->callBaseMethod($updfile);
  } 
}
?>