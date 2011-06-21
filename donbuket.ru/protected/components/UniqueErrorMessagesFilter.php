<?php

/**
 * drop from array returned by getErrors duplicated messages
 */
class UniqueErrorMessagesFilter extends HookWrap {  
  protected $foundMessages = null;
  protected function clear(&$e) {
    foreach ($e as $k => &$m) {
      if (is_string($m)) {
        if (isset($this->foundMessages[$m]))
          unset($e[$k]);
        else
          $this->foundMessages[$m] = 21;
      } elseif (is_array($m)) {
        $this->clear($m);
        if (!count($m))
          unset($e[$k]);
      }
    }
  }
  protected function hookm_getErrors($attribute=NULL) {
    $e = $this->getHost()->getErrors($attribute);
    $this->foundMessages = array();
    $this->clear($e);
    return $e;
  }
  protected function hookg_errors() {
    return $this->hookm_getErrors();
  }  
}

?>