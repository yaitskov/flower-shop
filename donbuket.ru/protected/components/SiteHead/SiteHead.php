<?php

  /**
   *  Главное меню сайта где основные разделы букеты, форум, выход и тд
   */
class SiteHead extends CWidget {
  public $enterExitCaption, $regIsVisible, $enterExitHref ;
  // путь к файлу с кнопкой вход/выход
  public $enterExitImage;
  // путь к файлу с кнопкой регистрация
  public $regImage;
  //
  public $titleImage;
  // путь к изображению главного меню с выделенным текущим пунктом 
  public $curItemImage;
  private $am;
  protected function imagePath ( $img ) {
    return dirname ( __FILE__ ) . DIRECTORY_SEPARATOR
      . 'img' . DIRECTORY_SEPARATOR . $img;
  }
  protected function publishImage ( $img ){
    return $this->am->publish ( $this->imagePath( $img ) );
  }
  protected function imageExists ( $img ) {
    return file_exists ( $this->imagePath( $img ) );    
  }
  public function getUserName (){
    return CHtml::encode( Yii::app()->user->name );
  }
  public function init(){    
    $this->regIsVisible = Yii::app()->user->isGuest;
    $style = dirname ( __FILE__ ) . DIRECTORY_SEPARATOR
      . 'css' . DIRECTORY_SEPARATOR . 'style.css';
    $this->am = Yii::app()->assetManager;
    $style = $this->am->publish( $style );    
    $cs = Yii::app()->clientScript;
    $cs->registerCssFile ( $style );

    $this->titleImage = $this->publishImage( 'title.png' );
    if ( Yii::app()->user->isGuest ){
      $this->enterExitCaption = 'Вход';
      $this->enterExitHref = '/site/login';            
      $this->enterExitImage = $this->publishImage('enter.png');
    }else{
      $this->enterExitCaption = 'Выход';
      $this->enterExitHref = '/site/logout';
      $this->enterExitImage = $this->publishImage('exit.png');      
    }
    // reg кнопка имеет 3 состояния
    if ( $this->regIsVisible ){
      if ( Yii::app()->controller->action->getId() == 'reg' )
        $this->regImage = $this->publishImage( 'curregistration.png' );
      else
        $this->regImage = $this->publishImage( 'registration.png' );
    }else {
      $this->regImage = $this->publishImage( 'noregistration.png' );
    }
    // current menu item is depended from current action
    $a = Yii::app()->controller->action->getId();
    if ( $a === 'index' ) $a = "main" ;
    $img = $a . '.png' ;
    if ( $this->imageExists ( $img ) )
      $this->curItemImage = $this->publishImage( $img );
    else
      $this->curItemImage = $this->publishImage( 'mainmenu.png' );
  }
  public function run(){    
    $this->render('shview');
  }
  }
?>
