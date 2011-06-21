<?php

/**
 * WebSite class is a singleton. Therefore the common description
 * doesn't require a hostid.
 */
class AttachFileToCommonDescription extends FCEUploadFileAction {
  /**
   * @overriden
   * @param CUploadedFile $ofile an object of a file to be stored
   * @param mixed $hostid the foreign key of a host object. This class ignores it.
   * @param String $urlcaption it can be used to override text of a tag a 
   * @return String url to uploaded file
   * @exception Exception
   */
  protected function processFile(CUploadedFile $ofile, $hostid, &$urlcaption) {
    $f = new File();
    $f->fromUploadedFile( $ofile );
    if ($f->save()) {
      $df = new DescriptionFile();
      $df->photo_id = $f->id;
      if (!$df->save()) {
        $f->releaseReference();
        throw new Exception("cannot save description file '" . $f->hashName
                            . "' cause: " . implode("\n", $df->getErrors()));
      }
      return Yii::app()->filestorage->createUrl($f->hashName);
    } else {
      throw new Exception(implode("\n",$f->getErrors()));
    }
  }
}

?>