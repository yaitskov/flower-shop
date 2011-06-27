<?php

/**
 * standard action for scaling orig image
 * http params: required width 'width' or 'required height 'height' and imgid
 */
class ThumbnailAction extends CAction {
  /**
   * @var FileStorage
   */
  public $storage;
  private function isInt($param) {
    return null === $param or (preg_match('/^[0-9]{1,3}$/', $param) and $param > 10);
  }
  /**
   * set http headers for caching
   * @param Integer number seconds 
   * @return void
   */
  public function setCache($expires) {
    header("Pragma: public");
    header("Cache-Control: maxage=".$expires);
    header('Expires: ' . gmdate('D, d M Y H:i:s', time()+$expires) . ' GMT');    
  }
  /**
   * class doesn't deal with DB.
   */ 
  public function run() {
    $req = Yii::app()->request;    
    $imgid = $req->getParam('imgid', null);
    if ($imgid === null)
      throw new Exception("imgid param is required");
    $imgid = @base64_decode($imgid);
    if($imgid === false)
      throw new Exception("imgid param has invalid param");      
    $imgid = preg_replace('/[.]/', '', $imgid);
    $width = $req->getParam('width', null);
    $height = $req->getParam('height', null);
    if (null === $width and null === $height)
      throw new Exception("pass either required 'width' or 'height'");
    if (!$this->isInt($width))
      throw new Exception("'width' is invalid");
    if (!$this->isInt($height))
      throw new Exception("'height' is invalid");
    $app = Yii::app();
    $master = is_null($width) ? Image::HEIGHT : Image::WIDTH;
    $this->setCache(60*60*24); // one day and one night
    $path = $this->storage->pathToFile($imgid);
    if (!file_exists($path)) {
      $path = Yii::app()->basePath . DIRECTORY_SEPARATOR . '..'
        . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'thumbnail-nofile.png';
      $app->image->load($path)->render();
    } else
      $app->image->load($path)
        ->resize($width,$height, $master)->render();
  }
}
?>