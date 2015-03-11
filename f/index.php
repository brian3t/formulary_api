<?php
defined('DS') or define('DS',DIRECTORY_SEPARATOR);
defined('CURRENT_ACTIVE_DOMAIN') or define('localhost',CURRENT_ACTIVE_DOMAIN);
defined('LOCAL_DOMAIN') or define('localhost',LOCAL_DOMAIN);
// change the following paths if necessary
$yii=dirname(__FILE__).'/../yii/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';
$shortcuts=dirname(__FILE__).DS.'protected'.DS .'helpers'.DS .'shortcuts.php';
$utils=dirname(__FILE__).DS.'protected'.DS .'helpers'.DS .'utils.php';
defined('APP_DEPLOYED') or define('APP_DEPLOYED',!(CURRENT_ACTIVE_DOMAIN == LOCAL_DOMAIN));

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require($shortcuts);
require($utils);
require_once($yii);
Yii::createWebApplication($config)->run();
