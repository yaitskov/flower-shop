<?php

defined('DS') or define('DS', DIRECTORY_SEPARATOR );

return array(
  'basePath'=> dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
  'name'=>'Донской букет',
  // preloading 'log' component
  'preload'=>array('log'),
  'language' => 'ru',
  //  'defaultController' => 'site',
  // autoloading model and component classes
  'import'=> array(
    'application.models.*',
    'application.controllers.*',        
    'application.components.*',
    'application.components.SiteHead.*',
    'application.components.HorizontalMenu.*',
    'application.extensions.ieditor.*',
    'application.extensions.YandexMap.*',
    'application.extensions.menu.*',
    'application.extensions.mbmenu.*',
    'application.extensions.SmoothGallery.*',
    'application.extensions.fileStorage.*',
    'application.helpers.*'),
  'modules'=> array(
    'gii'=> array(
      'class'=>'system.gii.GiiModule',
      'password'=>'1',
      // If removed, Gii defaults to localhost only. Edit carefully to taste.
      'ipFilters'=>array('127.0.0.1','::1'),
    ),
  ),
  // application components
  'components'=> array(
    'filestorage' => array (
      'class' => 'application.extensions.fileStorage.FileStorage',
      'pathToStorage' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..'
      . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'file-storage',
    ),
    
    'image' => array (
      'class' => 'application.extensions.image.CImageComponent',
      'driver' => "ImageMagick", // ImageMagick
      'params' =>  array ( 'directory' => '/usr/bin' ) 
    ),
    'cfrm' => array ( 'class' => 'application.components.CommonFormatter' ),
    'authManager' => array ( 'class' => 'CDbAuthManager',
                             'connectionID' => 'db' ),
    'user'=> array(
      'class'=> 'application.components.WebUser'
    ),
    'urlManager' => array (
      'urlFormat' => 'path',
      'showScriptName'=>false,
      //      'baseUrl' => 'donbuket.ru',
    ),
    'db'=> array(
      'connectionString' =>
      'mysql:host=localhost;dbname=user162_donbuket',
      'emulatePrepare' => true,
      'username' => 'user162_root',
      'password' => '1',
      'charset' => 'utf8'
    ),
    // use 'site/error' action to display errors        
    'errorHandler' => array( 'errorAction'=>'site/error' ),
    'log'=> array( 'class'=>'CLogRouter',
                   'routes'=> array(
                     array(
                       'class'=>'CFileLogRoute',
                       'levels'=>'error, warning',
                     ),
                   ),
    ),
  ),
  // application-level parameters that can be accessed
  // using Yii::app()->params['paramName']
  'params'=>
  array( // this is used in contact page
    'adminEmail'=>'webmaster@example.com',
    'yandex-map-api-key' =>
    'AKEBek0BAAAAoqNgFwIAEb1E-5QhBnFhJ2upm4kaXNcnanMAAAAAAAAAAACNxjxQHs2y4Ke4wS9S5iFbNHwh5g=='
  ),
);    


