<?php

/*#########################################################
===========================================================

	cedricabt.com

	@author	rudy marc
	@email	rgs@rgsone.com
	@web	http://rgsone.com

===========================================================
#########################################################*/

use CAbt\Silex\ControllerResolver;
use CAbt\Silex\Provider\FilesystemServiceProvider;
use CAbt\Silex\Provider\FinderServiceProvider;
use CAbt\Silex\Provider\TextileServiceProvider;
use Silex\Provider\MonologServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;

#### SETUP SERVICE ####

# Resolver (use our own resolver for controller contructor app injection)
$app['resolver'] = $app->share( function() use ( $app ) {
	return new ControllerResolver( $app, $app['logger'] );
});

# Filesystem
$app->register( new FilesystemServiceProvider() );

# Finder (return a new Finder each time was call)
$app->register( new FinderServiceProvider() );

# Monolog
$app->register( new MonologServiceProvider(), array(
	  'monolog.name' => 'app.log',
	  'monolog.logfile' => PATH_LOG . '/app.log'
));

# Textile
$app->register( new TextileServiceProvider(), array(
	  'textile.doctype' => 'html5'
));

# Twig
$app->register( new TwigServiceProvider(), array(
	'twig.path' => PATH_VIEW,
	'twig.options' => array(
		'cache' => PATH_CACHE,
		'autoescape' => true
	)
));

# URL Generator
$app->register( new UrlGeneratorServiceProvider() );
