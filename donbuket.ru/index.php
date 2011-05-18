<?php
  //if ( $_SERVER['REMOTE_ADDR'] === '127.0.0.1' ){
error_reporting( E_ALL );
ini_set('display_errors', 'On');
ini_set('display_startup_errors', 'On');
defined('YII_DEBUG') or define('YII_DEBUG',true);
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);  
//}
// change the following paths if necessary
$yii=dirname(__FILE__).'/lib/yii/yii.php';
$config=dirname(__FILE__).'/protected/config/cnf.php';
require_once($yii);
Yii::createWebApplication($config)->run();
