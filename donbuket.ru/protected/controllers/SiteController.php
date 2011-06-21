<?php

class SiteController extends Controller
{
  public function actionTest() {
    $t = Yii::app()->filestorage;
    echo realpath ( $t->pathToStorage ), "<br>";
    echo realpath ( Yii::app()->basePath ), "<br>";
    echo getenv("DOCUMENT_ROOT" ), "<br>";            
    echo  preg_replace (
      '/^\\//',
      '',
      substr ( realpath( $t->pathToStorage ),
               strlen( realpath( getenv("DOCUMENT_ROOT" ) )
               )
      )
    );
  }
  /**
   * Declares class-based actions.
   */
  public function actions()
  {
    return array(
      // captcha action renders the CAPTCHA image displayed on the contact page
      'captcha'=>array(
        'class'=>'CCaptchaAction',
        'backColor'=>0xFFFFFF,
      ),
      // page action renders "static" pages stored under 'protected/views/site/pages'
      // They can be accessed via: index.php?r=site/page&view=FileName
      'page'=>array(
        'class'=>'CViewAction',
      ),
    );
  }

  public function createAlbumElementGalleryItem ( $album_element ){
    return new AlbumElementGalleryItem ( $album_element );
  }
  public function actionAboutus(){
    $dp = new CActiveDataProvider('FlowerShop');
    $this->render('aboutus', array( 'dataProvider' => $dp ) );    
  }
  /**
   * This is the default 'index' action that is invoked
   * when an action is not explicitly requested by users.
   */
  public function actionIndex()
  {
    $ucname = 'user';
    $Ucname = ucfirst( $ucname ) . 'Controller';
    $c = new $Ucname( $ucname );
    $a = new CInlineAction( $c, 'index' );

    // renders the view file 'protected/views/site/index.php'
    // using the default layout 'protected/views/layouts/main.php'
    $this->render('index');
  }

  /**
   * This is the action to handle external exceptions.
   */
  public function actionError()
  {
    if($error=Yii::app()->errorHandler->error)
      {
        if(Yii::app()->request->isAjaxRequest)
          echo $error['message'];
        else
          $this->render('error', $error);
      }
  }

  /**
   * Displays the contact page
   */
  public function actionContact()
  {
    $model=new ContactForm;
    if(isset($_POST['ContactForm']))
      {
        $model->attributes=$_POST['ContactForm'];
        if($model->validate())
          {
            $headers="From: {$model->email}\r\nReply-To: {$model->email}";
            mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
            Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
            $this->refresh();
          }
      }
    $this->render('contact',array('model'=>$model));
  }

  /**
   * Displays the login page
   */
  public function actionLogin()
  {
    $model=new LoginForm;

    // if it is ajax validation request
    if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
      {
        echo CActiveForm::validate($model);
        Yii::app()->end();
      }

    // collect user input data
    if(isset($_POST['LoginForm']))
      {
        $model->attributes=$_POST['LoginForm'];
        // validate user input and redirect to the previous page if valid
        if($model->validate() && $model->login())
          $this->redirect(Yii::app()->user->returnUrl);
      }
    // display the login form
    $this->render('login',array('model'=>$model));
  }

  /**
   * Logs out the current user and redirect to homepage.
   */
  public function actionLogout()
  {
    Yii::app()->user->logout();
    $this->redirect(Yii::app()->homeUrl);
  }
}