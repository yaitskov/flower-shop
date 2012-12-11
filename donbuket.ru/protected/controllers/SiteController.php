<?php

class SiteController extends Controller
{
  /**
   * there is "fifth wheel" because a browser cannot detect mime time
   * of file itself.
   */
  public function actionGetFile($hash) {
    $path = base64_decode(preg_replace('/[.](png|jpg|jpeg|gif)$/', '', $hash));
    $path = preg_replace('/[.]/', '', $path);
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $path = Yii::app()->filestorage->pathToFile($path);
    if (!file_exists($path))
      $path = Yii::app()->basePath . DIRECTORY_SEPARATOR . '..'
        . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'nofile.png';
    $mime = finfo_file($finfo, $path);
    finfo_close($finfo);
    header('Content-Type: ' . $mime);
    echo file_get_contents($path);    
  }
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
      'thumbnail' => array ( 'class' => 'ThumbnailAction',
                             'storage' => Yii::app()->filestorage )
    );
  }

  /**
   * @param callback creator
   * @return GalleryItemIf
   */
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
    /*
     * page will contain news, visitor statistics,
     * sell statistics, new bukets, new products
     */
       

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
  /**
   * it is used by posy-search and posy-groups actions
   * @return void
   */
  protected function prepareMenu() {
    $this->layout = '//layouts/column2';    
    $this->menu = array(
      /* user can create a new posy on this page from accessible site's
         stuff.  Later user can order it. Administrator can mark it as
         complete solution and put it in site's catalogue.
      */      
      array('label' => 'Конструктор',
            'url' => array('posy/constructor'),
            'visible' => !Yii::app()->user->isGuest),  
      array('label' => 'Новая группа',
            'url' => array('posy/new_group'),
            'visible' => Yii::app()->user->isRoot),
    );      
  }
  public function actionProduct() {
  }
  /**
   * 
   */
  public function actionPosySearch() {
    /*
     * posies are grouped by categories.
     * one posy can belong to several catergories.
     */
    $history = new PosySearchHistory();
    if (isset($_POST['PosySearchHistory'])) {
      $history->attributes = $_POST['PosySearchHistory'];
    }
    $this->prepareMenu();
    $this->render('posy-search');      
  }
  /**
   *  output list of posy groups
   */
  public function actionPosyByGroup() {
    $this->prepareMenu();
    $this->render('posy-groups');
  }
}