<?php

/*#########################################################
===========================================================

	cedricabt.com

	@author	rudy marc
	@email	rgs@rgsone.com
	@web	http://rgsone.com

===========================================================
#########################################################*/

use Monolog\Logger;

#### DEV CONFIG ####

# debug
$app['debug'] = true;

# monolog
$app['monolog.level'] = Logger::DEBUG;

# twig
$app['twig.options'] = array_replace(
	array( 'strict_variables' => $app['debug'] ),
	$app['twig.options']
);
