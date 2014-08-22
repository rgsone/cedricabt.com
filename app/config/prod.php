<?php

use Monolog\Logger;

#### PROD CONFIG ####

# debug
$app['debug'] = false;

# monolog
$app['monolog.level'] = Logger::WARNING;

# twig
$app['twig.options'] = array_replace(
	array(
		'strict_variables' => $app['debug']
	),
	$app['twig.options']
);
