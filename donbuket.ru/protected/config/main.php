<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array( 'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
              'name'=>'Донской букет',

              // preloading 'log' component
              'preload'=>array('log'),
              'language' => 'ru',
              'defaultController' => 'message',
              // autoloading model and component classes
              'import'=>array( 'application.models.*',
                               'application.components.*' ),

              'modules'=>array(
                               // uncomment the following to enable the Gii tool
                               'gii'=>array(
                                            'class'=>'system.gii.GiiModule',
                                            'password'=>'1',
                                            // If removed, Gii defaults to localhost only. Edit carefully to taste.
                                            'ipFilters'=>array('127.0.0.1','::1'),
                                            ),
                               ),

              // application components
              'components'=>array(
                                  'user'=>array(
                                                // enable cookie-based authentication
                                                'allowAutoLogin'=>true,
                                                ),
                                  'urlManager' => array (
                                                         'urlFormat' => 'path',
                                                         'showScriptName'=>false,
                                                         ),
                                  // uncomment the following to enable URLs in path-format
                                  'db'=>array('connectionString' => 'mysql:host=localhost;dbname=user162_donbuket',
                                              'emulatePrepare' => true,
                                              'username' => 'user162_root',
                                              'password' => '1',
                                              'charset' => 'utf8' ),

                                  // use 'site/error' action to display errors        
                                  'errorHandler'=>array( 'errorAction'=>'site/error' ),
                                  'log'=>array(
                                               'class'=>'CLogRouter',
                                               'routes'=>array(
                                                               array(
                                                                     'class'=>'CFileLogRoute',
                                                                     'levels'=>'error, warning',
                                                                     ),
                                                               ),
                                               ),
                                  ),
              // application-level parameters that can be accessed
              // using Yii::app()->params['paramName']
              'params'=>array(
                              // this is used in contact page
                              'adminEmail'=>'webmaster@example.com',
                              // путь к каналогу где хранятся фотки
                              'photoesPath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..'
                              .DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'photoes',
                              ),
              );