<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="ru" />
    <!-- blueprint CSS framework -->
    <link rel="stylesheet" type="text/css"
          href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css"
          media="screen, projection" />
    <link rel="stylesheet" type="text/css"
          href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css"
          media="print" />
    <!--[if lt IE 8]>
    <link rel="stylesheet" type="text/css"
          href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
    <![endif]-->

    <link rel="stylesheet"
          type="text/css"
          href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
    <link rel="stylesheet"
          type="text/css"
          href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
  </head>
  <body>
    <?php Yii::app()->controller->widget('SiteHead'); ?>
    <?php $this->widget( 'zii.widgets.CBreadcrumbs',
                         array( 'links'=>$this->breadcrumbs )); 

          echo $content; ?>

    <div id="footer">
      <div>
        &copy; 
        <?= Yii::app()->controller->website->birth_year?>
        &mdash;
        <?= date('Y')?>
        «<?= CHtml::link( Yii::app()->controller->website->name,
                          Yii::app()->createAbsoluteUrl( 'main/index' ) )?>»
      </div>
      <div>
        <?php echo Yii::powered(); ?>
      </div>
    </div>
  </body>
</html>
