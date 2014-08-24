<?php

/*#########################################################
===========================================================

	cedricabt.com

	@author	rudy marc
	@email	rgs@rgsone.com
	@web	http://rgsone.com

===========================================================
#########################################################*/


#### ENV ####

// 'dev' or 'prod'
define( 'ENV_NAME', 'dev' );

#### PATH ####

define( 'PATH_ROOT', __DIR__ . '/..' );

define( 'PATH_WEB', __DIR__ );
define( 'PATH_DATA', PATH_WEB . '/data' );
define( 'PATH_DATA_PROJECTS', PATH_DATA . '/projects' );

define( 'PATH_LIBS', PATH_ROOT . '/libs' );

define( 'PATH_APP', PATH_ROOT . '/app' );
define( 'PATH_CACHE', PATH_APP . '/cache' );
define( 'PATH_CONFIG', PATH_APP . '/config' );
define( 'PATH_LOG', PATH_APP . '/log' );
define( 'PATH_VIEW', PATH_APP . '/view' );

#### AUTOLOADER ####

require_once PATH_LIBS . '/autoload.php';

#### OK LET'S GO ! ####

$app = new \CAbt\App();

require_once PATH_APP . '/app.php';
require_once PATH_CONFIG . '/' . ENV_NAME . '.php';
require_once PATH_CONFIG . '/route-name.php';
require_once PATH_APP . '/routes.php';

$app->run();
