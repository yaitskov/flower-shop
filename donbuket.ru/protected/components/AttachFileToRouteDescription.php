<?php

class AttachFileToRouteDescription extends FCEUploadFileAction {
  protected function processFile(CUploadedFile $ofile, $hostid, &$urlcaption) {
    $f = new File();
    $f->fromUploadedFile( $ofile );
    if ($f->save()) {
      $df = new RouteFile();
      $df->photo_id = $f->id;
      $df->shop_id = $hostid;
      if (!$df->save()) {
        $f->releaseReference();
        throw new Exception("cannot save route file '" . $f->hashName
                            . "' cause: " . CVarDumper::dumpAsString( $df->getErrors()));
      }
      return Yii::app()->filestorage->createUrl($f->hashName);
    } else {
      throw new Exception(implode("\n",$f->getErrors()));
    }
  }
}

?>