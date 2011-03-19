<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="ru" />
    <meta name="description" content="Заказ цветов и букетов онлайн и по телефону +7-928-159-00-04 без выходных. Розы и тюльпаны, цветы, подарки, открытки, интернет-магазин цветов." />
    <meta name="keywords" content="букет, заказ цветов, цветы, упаковка подарков, Ростов-на-Дону, Сельмаш, розы, тюльпаны, лилии, открытки, удобрения, горшки, грунт, Глазырина Тамара Николаевна" />
    <meta name="author" content="Цветочный магазин donbuket.ru - заказ цветов в Ростове-на-Дону" />

    <!-- blueprint CSS framework -->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
    <!--[if lt IE 8]>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
    <![endif]-->

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/index.css" />   

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
  </head>
  <body>
    <map name="main_menu_map">
      <area shape="poly" coords="53,41,67,41,86,39,113,37,134,39,144,45,145,51,138,58,117,64,92,64,71,62,53,57,55,49,53,41" href="main" TITLE="Главная страница"/>
      <area shape="poly" coords="53,57,69,61,91,64,110,64,135,77,140,84,139,90,130,95,111,93,86,85,63,73,51,64,53,58" href="posy" TITLE="Букеты"/>
      <area shape="poly" coords="50,63,65,74,85,84,106,92,120,108,121,112,123,118,119,122,107,122,88,113,69,98,49,76,46,68,48,67" href="product" TITLE="Товары"/>
      <area shape="poly" coords="46,68,49,76,72,100,88,113,97,132,96,136,96,142,91,146,79,141,63,124,45,91,41,79,38,69" href="forum" TITLE="Форум"/>
      <area shape="poly" coords="51,37,65,33,81,24,105,14,124,10,133,10,140,15,140,19,137,26,119,37,96,38,67,41,53,41" href="aboutus" TITLE="О нас"/>
    </map>
    <map name="enter_exit_map">
      <area shape="poly" coords="82,28,87,22,96,17,130,15,155,20,174,20,171,26,173,30,175,33,174,36,157,41,126,44,106,43,89,38,83,32" href="enter_exit" title="Вход"/>      
    </map>
    <map name="registration_map">
      <area shape="poly" coords="3,29,13,21,45,17,75,21,95,23,94,28,95,33,97,36,80,43,50,45,32,45,12,40,4,35" href="registration" title="Регистрация"/>      
    </map>

    
    <div class="container" id="header">
      <div class="menu">
          <img usemap="#main_menu_map" border="0" src="/images/aboutus.png"/>
      </div>
      <div class="title">
          <img src="/images/title.png"/>
      </div>
      <div class="right-menu">
        <div class="enter-exit">
          <img src="/images/<?= Yii::app()->user->isGuest ? 'enter' : 'exit' ?>.png"
               usemap="#enter_exit_map" border="0"/>
        </div>
        <div class="registration">
          <img src="/images/<?= Yii::app()->user->isGuest ? '' : 'no' ?>registration.png" usemap="#registration_map"
               border="0"/>          
        </div>
      </div>
    </div><!-- header -->

      <?php $this->widget('zii.widgets.CBreadcrumbs', array(
		'links'=>$this->breadcrumbs,
	)); ?><!-- breadcrumbs -->

      <?php echo $content; ?>

      <div id="footer">
	<?php echo Yii::powered(); ?>
      </div><!-- footer -->

    </div><!-- page -->

  </body>
</html>
