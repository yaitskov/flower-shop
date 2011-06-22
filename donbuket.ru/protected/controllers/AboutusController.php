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
      // actions for uploading files and including them into their documents
      'insert_into_common_description' => array (
        'class' => 'AttachFileToCommonDescription',
      ),
      'insert_into_route_description' => array (
        'class' => 'AttachFileToRouteDescription',
      )
    );
  }
  /**
   * invert shop's attribute 'enabled'
   */
  public function actionFreeze_unfreeze_shop($id) {
    $fs = $this->loadFlowerShop($id);
    $fs->enabled ^= 1;
    if (!$fs->save(true, array('enabled'))) {
      $form = $this->beginWidget('FormRow', array());
      echo $form->errorSummary($fs);
      $this->endWidget();
    } else {
      $this->redirect($this->createUrl('site/aboutus', array('#' => 'shop' . $id)));
    }
  }
  /**
   * the action makes a copy of a set flower shop with new template name, let say
   * <old name> + "copy " + <unique id>, and disables the copy. 
   */
  public function actionDuplicate_shop($id) {
    $fs = $this->loadFlowerShop($id);
    
  }
  protected function loadFlowerShop($id) {
    $fs = FlowerShop::model()->findByPk($id);
    if ($fs === null)
      throw new CHttpException(404, "Магазин номер $id не найден");
    return $fs;
  }
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
                             'duplicate_shop',
                             'freeze_unfreeze_shop',
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
