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
  public function getShopUrl($shop) {
    $params = $shop->isNewRecord ? array() : array('#' => 'shop' . $shop->id);    
    return $this->createUrl('site/aboutus', $params);
  }
  protected function gotoShop($shop) {
    $this->redirect($this->getShopUrl($shop));    
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
        $this->gotoShop($model);
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
    } else
      $this->gotoShop($fs);
  }
  /**
   * here user can delete map of the shop or set the center of the map
   * and the shop position.
   */
  public function actionUpdate_map($id) {
    $fs = $this->loadFlowerShop($id);
    $fs->scenario = 'map';    
    if ($fs->place_x === null) {
      // no map set default values
      $fs->place ='39.786857,47.267104';
      $fs->map_center  = '39.76857,47.267104';
      $fs->unpackCoords();
    }

    if (isset($_POST['FlowerShop'])) {
      $fs->attributes = $_POST['FlowerShop'];
      if ($fs->save())
        $this->gotoShop($fs);
    }
    $this->render('update_map', array('model' => $fs));
  }
  /**
   * upload, rearrange and delete photos of the shop.
   */
  public function actionUpdate_shop_gallery($id) {
  }
  /**
   * the action makes a copy of a set flower shop with new template name, let say
   * <old name> + "copy " + <unique id>, and disables the copy. 
   */
  public function actionDuplicate_shop($id) {
    $fs = $this->loadFlowerShop($id);
    $nfs = new FlowerShop();
    $nfs->attributes = $fs->attributes;
    $nfs->pretty_start_work_at = $fs->pretty_start_work_at;
    $nfs->pretty_end_work_at = $fs->pretty_end_work_at;    
    $nfs->enabled = 0;
    $basename = preg_replace('/( *копия *[0-9]+)* *$/', '', $nfs->name);
    $i = 1;
    while ($i < 100) {
      $nfs->name = $basename . ' копия ' . $i;
      if ($nfs->save()) break;
      $i++;
    }    
    if ($nfs->isNewRecord) {
      $o = new UniqueErrorMessagesFilter($nfs);
      throw new UserEx ("Не удалось копировать магазин:\n"
                        . ExtractStringsFromArray::doit( $o->errors," "));
    }
    $this->gotoShop($nfs);
  }
  protected function loadFlowerShop($id) {    
    $fs = FlowerShop::model()->findByPk($id);
    if ($fs === null)
      throw new UserEx("Магазин номер $id не найден");
    return $fs;
  }
  public function actionDelete_map($id) {
    $fs = $this->loadFlowerShop($id);
    $fs->place_x = null;
    $fs->map_center_x = null;
    if (!$fs->save())
      throw new UserEx("Не удалось удалить карту у магазина '" . $fs->name . "'");
    $this->gotoShop($fs);
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
                             'update_map',
                             'delete_map',
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
        $this->gotoShop($model);
    }
    $this->render('update_flower_shop', array('model' => $model));
  }
  public function actionDelete_shop($id) {
    $fs = FlowerShop::model()->findByPk($id);
    if ($fs === null)
      throw new UserEx("Магазин номер $id не найден");
    if (!$fs->delete())
      throw new UserEx("Магазин номер $id удалить не удалось. "
                       . ExtractStringsFromArray(UniqueErrorMessagesFilter::create($fs)->errors));
    // I think a state when all shops don't fit on one page never happen
    $this->redirect('/site/aboutus');     
  }
}
