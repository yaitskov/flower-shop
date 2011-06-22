<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="ru" />
    <!-- blueprint CSS framework -->
    <link rel="stylesheet" type="text/css"
          href="<?php echo Yii::app()->request->baseUrl; ?>/css/site.css"
          media="screen, projection" />
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
  </head>
  <body class="nospaces">
 <div class="wwww">   
   <?php Yii::app()->controller->widget('SiteHead'); ?>
   <?php $this->widget( 'zii.widgets.CBreadcrumbs', array( 'links'=>$this->breadcrumbs )); ?>
   <?= $content; ?>
      <div style="height:100px;"></div>
  </div>

    <div align="center" class="footer-of-site-page rounded-corners">

      <div align="center">
        &copy; 
        <?= Yii::app()->controller->website->birth_year?>
        &mdash;
        <?= date('Y')?>
        «<?= CHtml::link( Yii::app()->controller->website->name,
                          Yii::app()->createAbsoluteUrl( 'main/index' ) )?>»
      </div>
      <div align="center">
        <?php echo Yii::powered(); ?>
      </div>
    </div>
  </body>
</html>
