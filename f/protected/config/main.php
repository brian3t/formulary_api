<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
$conf = array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Formulary - The most advanced healthcare API',

	// preloading 'log' component
	'preload'=>array('log',
		'bootstrap', // preload the bootstrap component,comment this out if you don't use bootstrap2 theme.
        //(Yiistrap and YiiWheels work with bootstrap 2).
),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.commands.*',
		'application.extensions.bootstrap.components.*',
		'application.extensions.bootstrap.helpers.TbHtml',
		//DEBUGGING STUFF
		'application.vendors.FirePHPCore.FirePHP',
		'application.vendors.FirePHPCore.FB',
	),
	'aliases' => array(
		//yiistrap
		'bootstrap' => realpath(__DIR__ . DS.'..'.DS.'extensions'.DS.'bootstrap'),
		// yiiwheels configuration
		'yiiwheels' => 'webroot.protected.extensions.yiiwheels'
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'fTrapok)1',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
//			'ipFilters'=>array('127.0.0.1','10.211.100.143'.'::1'),
		),
	),

	// application components
	'components'=>array(
		'user'=>array(
            'class' => 'WebUser',
            // enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		//email
		'mailer' => array(
			'class' => 'application.extensions.mailer.EMailer',
		),

		// uncomment the following to enable URLs in path-format
		'urlManager' => array(
			'urlFormat' => 'path',
			'showScriptName' => false,
			'baseUrl' => '',
			'rules' => array(
				'site/page/<view:\w+>' => 'site/page/',
				'<controller:\w+>/<id:\d+>' => '<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
				'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
			),
		),
//		'db'=>array(
//			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
//		),
		// uncomment the following to use a MySQL database


		'db'=>array(
//			'connectionString' => 'mysql:host=localhost;dbname=formulary',
			'connectionString' => 'mysql:host=192.168.1.9;dbname=formulary',//mtime
			'emulatePrepare' => true,
			'username' => 'formulary',
			'password' => 'fTrapok)1',
			'charset' => 'utf8',
		),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning, info',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
		// yiistrap configuration
		'bootstrap' => array(
//			'class' => 'bootstrap.components.KTbApi',
			'class' => 'webroot.protected.components.Booster'
		),
		// yiiwheels configuration
		'yiiwheels' => array(
			'class' => 'yiiwheels.YiiWheels',
		),
//        'authManager'=>array(
//            'class' => 'CPhpAuthManager',
//        )
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'ceo@usvsolutions.com',
//		'recaptcha_private_key' => '6Le_pPsSAAAAAET7g5GPtDYZxM3HSlXaxWLHNYSd', // captcha will not work without these keys!
//		'recaptcha_public_key' => '6Le_pPsSAAAAAOzdoxVXkxfG09K3ILNdFj6UobSS', //http://www.google.com/recaptcha
//		'contactRequireCaptcha' => true,
		'fromEmail' => 'ceo@usvsolutions.com',
		'replyEmail' => 'ceo@usvsolutions.com',
		'myEmail' => 'ceo@usvsolutions.com',
		'gmail_password' => 'cTrapok)1',
		'render_switch_form' => false

	),
);

$override_conf = require_once('override.php');

return $conf;
