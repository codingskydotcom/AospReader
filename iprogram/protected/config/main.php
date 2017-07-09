<?php

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'CodingSky',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'defaultController'=>'androidos/index',

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		'db'=>array(
            'connectionString' => 'mysql:host=127.0.0.1;port=3306;dbname=aosp',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '123456',
            'charset' => 'utf8',
		),
		'errorHandler'=>array(
			'errorAction'=>'site/error',
		),
		'urlManager'=>array(
			'urlFormat'=>'path',
			'urlSuffix' => '.html', 
			'showScriptName' => false,
			'rules'=>array(
				'api/<os:\d+>' => array('androidos/browser','urlSuffix'=>'.html'),
				'download' => array('androidos/download','urlSuffix'=>'.html'),
				'browser'=>array('androidos/browser','urlSuffix'=>'.html'),
                'code'=>array('androidos/code','urlSuffix'=>'.html'),
                'diff'=>array('androidos/diff','urlSuffix'=>'.html'),
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
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
	'params'=>require(dirname(__FILE__).'/params.php'),
);
