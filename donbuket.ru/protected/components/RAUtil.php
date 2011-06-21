<?php

/**
 * the class contains a group of useful methods 
 * which must be a part of CActiveRecord class
 */
class RAUtil {
  /**
   * make that $dst will "point" on the same object $src does.
   * object in db will not be duplicated
   * @param CActiveRecord $dst
   * @param CActiveRecord $src     
   */
  public function copyInMemory($dst, $src) {
    $dst->attributes = $src->attributes;
    $dst->id = $src->id;
    $dst->isNewRecord = $src->isNewRecord;
    return $dst;
  }
  public static function get() { return new RAUtil(); }
}
?>