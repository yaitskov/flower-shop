<?php

/**
 * Загрузка файла. Действие отображает форму загрузки.
 * При post создает экземпляр модели ( класс производный от CActiveRecord )
 * Сохраняет. Если класс CActiveRecord выдает ошибки валидации они
 * они выводятся так же как и ошибки валидации формы
 * при успешном сохранении возможен редирект ( returnUrl или жестко заданный парамет )
 */
class UploadAction extends CAction {
  public $modelForm; 
  public $redirectIfOk = true;
  public $useReturnUrl = true;
  public $fixedRedirect = '/';
  public $viewname = null;
  public $caption = 'File Uploading';
  public $uploadForm = array (
    'class' => 'UploadForm',
  );
  public $fileAR = array ( 'class' => 'File' );
  public function init(){
    if ( is_null ( $this->viewname ) )
      $this->viewname = $this->id ;    
  }
  public function run(){
    $this->modelForm = $this->createForm();
    $className = $this->extractClassName( $this->uploadForm  );
    //    throw new Exception ( $className );
    if ( isset ( $_POST[$className] ) ){
      $this->modelForm->attributes = $_POST[$className];
      $this->modelForm->setAttributes( $this->getMetaAttributes($this->uploadForm), false );
      //$this->modelForm->resetValidators();
      $this->processPost ();
    }
    $this->render();
  }
  protected function processPost () {
    if ( $this->modelForm->validate() ){
      $file = $this->createFile();
      $file->scenario = 'upload';
      $file->setAttributes ( $this->getMetaAttributes( $this->fileAR ) , false );
      $file->fromUploadedFile ( $this->modelForm );
      if ( $file->save() )
        $this->saveOkay( $file );
      else
        $this->saveFail ( $file );
    }    
  }
  /**
   * @param CModel
   */
  protected function saveOkay($file) {
    if ($this->redirectIfOk) {
      $this->controller->redirect( 
        $this->useReturnUrl ? Yii::app()->user->returnUrl : $this->fixedRedirect
      );
    }
  }
  /**
   * @param CModel
   */  
  protected function saveFail($file) {
    $this->modelForm->addError(
      'tmpfile',
      $this->controller->arrayTreeToList($file->errors)
    );
  }
  protected function render() {
    $this->controller->render(
      $this->viewname,
      array ( 'modelForm' => $this->modelForm )
    );    
  }  
  protected function createForm(){
    return $this->createX ( $this->uploadForm ) ;
  }
  protected function createFile(){
    return $this->createX ( $this->fileAR );
  }
  protected function extractClassName ( $meta ){
    if ( is_string( $meta ) )
      return $meta;
    if ( is_array ( $meta )
         and isset ( $meta['class'] )
         and is_string( $meta['class'] ) )
      return $meta['class'];
    throw new Exception ( 'meta is invalid' );    
  }
  protected function createX ( $meta ) {
    $tmp = $this->extractClassName( $meta );
    $tmp = new $tmp;
    if (is_array($meta)) {
      foreach ($meta as $key => $val) {
        if ('class' === $key or is_numeric($key)) continue;
        $tmp->$key = $val;
      }
    }
    return  $tmp;
  }
  protected function getMetaAttributes ( $meta ) {
    if ( is_array ( $meta ) ){
      unset ( $meta['class'] ) ;
      return $meta;
    }
    return array ();
  }
}
?>