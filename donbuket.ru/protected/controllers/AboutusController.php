<?php

  /**
   * Editing the list of shops and common site description.
   */
class AboutusController extends Controller
{
  
  /**
   * @var string page's menu 
   */
  public $layout='//layouts/column2';
  /**
   * a user can change or format the content of common desctiption of the site
   */
  public function actionUpdate_common_description(){
    // website entity always exists then it shouldn't precreated
    if (isset($_POST['WebSite'])) {
      $this->website->attributes=$_POST['WebSite'];
      if ($this->website->save( true, array('about'))) 
        // let be fixed route 'cause one page has only link to this action
        $this->redirect( '/site/aboutus' );
    }
    $this->render('update_common_description', array('model'=>$this->website));    
  }

  /**
   * action is for modificate work time, address and phone
   */
  public function actionUpdate_shop_info($id /*shopid*/) {
    $model=FlowerShop::model()->findByPk((int)$id);
    if($model===null)
      throw new CHttpException(404,"Магазин номер $shopid не найден.");
    if (isset($_POST['FlowerShop'])) {
      $model->attributes=$_POST['FlowerShop'];
      if ($model->save()) 
        $this->redirect( '/site/aboutus' );
    }
    $this->render('update_flower_shop', array('model'=>$model));        
  }
  /**
   *
   */
  public function actions(){
    return array (
      // either attached files or embedded images is automatically removed
      // when their references is removed from text
      'insert_into_common_description' => array (
        'class' => 'AttachFileToCommonDescription',
      ),
      'insert_into_route_description' => array (
        'class' => 'AttachFileToRouteDescription',
      )
    );
  }
  /**
   * Specifies the access control rules.
   * This method is used by the 'accessControl' filter.
   * @return array access control rules
   */
  public function accessRules()
  {
    return array(
      array('allow',  // allow all users to perform 'index' and 'view' actions
            'actions'=>array('update_common_description',
                             // an action of attachment some file
                             'insert_into_common_description',
                             'insert_into_route_description',
                             'add_new_shop',
                             'delete_shop',
                             'update_shop_info'
            ),
            'expression' => 'Yii::app()->controller->website->canUpdate ( $user )',
      ),
      array('deny',  // deny all users
            'users'=>array('*'),
      ),
    );
  }
  public function actionAdd_new_shop() {
    $model = new FlowerShop();
    if (isset($_POST['FlowerShop'])) {
      $model->attributes = $_POST['FlowerShop'];
      if ($model->save())
        $this->redirect('/site/aboutus');
    }
    $this->render('update_flower_shop', array('model' => $model));
  }
  public function actionDelete_shop($id) {
    $fs = FlowerShop::model()->findByPk($id);
    if ($fs === null) throw new CHttpException(404, "Магазин номер $id не найден");
    if ($fs->delete()) throw new CHttpException(404, "Магазин номер $id удалить не удалось");
    // I think a state when all shops don't fit on one page never happen
    $this->redirect('/site/aboutus');     
  }
}
