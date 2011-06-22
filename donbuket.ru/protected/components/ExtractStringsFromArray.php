<?php

class ExtractStringsFromArray {
  /**
   * @param array $arr can be array of strings or other arrays
   * @return string 
   */
  public static function doit($arr, $delimiter='<br/>') {
    $res = array();
    self::treeToLineArray($res,$arr);
    return implode($delimiter, $res);
  }
  protected static function treeToLineArray(&$res, $tree) {
    foreach ($tree as $node) {
      if (is_string($node))
        $res[] = $node;
      elseif (is_array($node))
        self::treeToLineArray($res,$node);
      else
        throw new Exception("Tree array has element which niether an array nor a string");
    }
  }
}
?>