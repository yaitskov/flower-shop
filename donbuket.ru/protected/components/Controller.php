<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should
 * extend from this base class.
 */
class Controller extends CController
{
  /**
   * @var string the default layout for the controller view.
   * Defaults to '//layouts/column1',
   * meaning using a single column layout.
   * See 'protected/views/layouts/column1.php'.
   */
  public $layout='//layouts/column1';
  /**
   * @var array context menu items.
   * This property will be assigned to {@link CMenu::items}.
   */
  public $menu=array();
  /**
   * @var array the breadcrumbs of the current page.
   * The value of this property will
   * be assigned to {@link CBreadcrumbs::links}.
   * Please refer to {@link CBreadcrumbs::links}
   * for more details on how to specify this property.
   */
  public $breadcrumbs=array();
  /**
   * WebSite entity
   */
  protected $__website;
  public function getWebsite () {
    return $this->__website ;
  }
  /**
   * @return array action filters
   */
  public function filters()
  {
    return array(
      'accessControl', // perform access control for CRUD operations
    );
  }
  
  /**
   * insert meta tags
   */
  public function beforeRender (){
    $s = $this->__website = WebSite::model()->find();
    $cs = Yii::app()->clientScript;
    $tags = array ( 'description' => $s->meta_description,
                    'keywords' => $s->meta_keywords,
                    'author' => $s->meta_author
                    );
    foreach( $tags as $tag => $val )
      $cs->registerMetaTag ( $val, $tag );    
    return true;
  }
}