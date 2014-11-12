<?php

// change the following paths if necessary
$yii=dirname(__FILE__).'/../yii/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
Yii::createWebApplication($config)->run();


/**
 * Created by PhpStorm.
 * User: tri
 * Date: 5/27/14
 * Time: 5:04 PM
 */

$auth = Yii::app()->authManager();

$auth->createOperation('readAccount', 'read an account');
$auth->createOperation('createAccount', 'create an account');
$auth->createOperation('updateAccount', 'update an account');
$auth->createOperation('deleteAccount', 'delete an account');

$auth->createOperation('createUser', 'create an User');
$auth->createOperation('readUser', 'read an User');
$auth->createOperation('updateUser', 'update an User');
$auth->createOperation('deleteUser', 'delete an User');

$auth->createOperation('createWebsite', 'create an Website');
$auth->createOperation('readWebsite', 'read an Website');
$auth->createOperation('updateWebsite', 'update an Website');
$auth->createOperation('deleteWebsite', 'delete an website');

$auth->createOperation('createPlacement', 'create an placement');
$auth->createOperation('readPlacement', 'read an placement');
$auth->createOperation('updatePlacement', 'update an placement');
$auth->createOperation('deletePlacement', 'delete an placement');

$auth->createOperation('createCampaign', 'create an campaign');
$auth->createOperation('readCampaign', 'read an campaign');
$auth->createOperation('updateCampaign', 'update an campaign');
$auth->createOperation('deleteCampaign', 'delete an campaign');

$auth->createOperation('createAdGroup', 'create an adgroup');
$auth->createOperation('readAdGroup', 'read an adgroup');
$auth->createOperation('updateAdGroup', 'update an adgroup');
$auth->createOperation('deleteAdGroup', 'delete an adgroup');

$auth->createOperation('createAd', 'create an ad');
$auth->createOperation('readAd', 'read an ad');
$auth->createOperation('updateAd', 'update an ad');
$auth->createOperation('deleteAd', 'delete an ad');

$auth->createOperation('createImpressionsserved', 'create an impressionsserved');
$auth->createOperation('readImpressionsserved', 'read an impressionsserved');
$auth->createOperation('updateImpressionsserved', 'update an impressionsserved');
$auth->createOperation('deleteImpressionsserved', 'delete an impressionsserved');

$bizRule = 'return Yii::app()->user->id==$params["post"]->authID;';
//$task = $auth->createTask('updateOwnPost', 'update a post by author himself', $bizRule);
//$task->addChild('updatePost');

$role = $auth->createRole('advertiser');//Account, User, Website, Campaign, Ad Group, Ad
$role->addChild('createAccount');
$role->addChild('readAccount');
$role->addChild('updateAccount');
$role->addChild('deleteAccount');

$role->addChild('createUser');
$role->addChild('readUser');
$role->addChild('updateUser');
$role->addChild('deleteUser');

$role->addChild('createWebsite');
$role->addChild('readWebsite');
$role->addChild('updateWebsite');
$role->addChild('deleteWebsite');

$role->addChild('createCampaign');
$role->addChild('readCampaign');
$role->addChild('updateCampaign');
$role->addChild('deleteCampaign');

$role->addChild('createAdGroup');
$role->addChild('readAdGroup');
$role->addChild('updateAdGroup');
$role->addChild('deleteAdGroup');

$role->addChild('createAd');
$role->addChild('readAd');
$role->addChild('updateAd');
$role->addChild('deleteAd');

$role = $auth->createRole('publisher');
$role->addChild('createAccount');
$role->addChild('readAccount');
$role->addChild('updateAccount');
$role->addChild('deleteAccount');

$role->addChild('createUser');
$role->addChild('readUser');
$role->addChild('updateUser');
$role->addChild('deleteUser');

$role->addChild('createWebsite');
$role->addChild('readWebsite');
$role->addChild('updateWebsite');
$role->addChild('deleteWebsite');

$role->addChild('createPlacement');
$role->addChild('readPlacement');
$role->addChild('updatePlacement');
$role->addChild('deletePlacement');


$role = $auth->createRole('administrator');
$role->addChild('publisher');
$role->addChild('administrator');

$auth->assign('publisher', '3');
$auth->assign('advertiser', '4');
$auth->assign('administrator', '1');

?>