<?php

/*#########################################################
===========================================================

	cedricabt.com

	@author	rudy marc
	@email	rgs@rgsone.com
	@web	http://rgsone.com

===========================================================
#########################################################*/

use Symfony\Component\HttpFoundation\Response;

## HOME
$app->get( '/', '\\CAbt\\Controller\\HomeController::show' )
	->bind( ROUTE_HOME );

## ABOUT
$app->get( '/a-propos/', '\\CAbt\\Controller\\AboutController::show' )
	->bind( ROUTE_ABOUT );

## CONTACT
$app->get( '/contact/', '\\CAbt\\Controller\\ContactController::show' )
	->bind( ROUTE_CONTACT );

## PROJECT
$app->get( '/projet/{name}/', '\\CAbt\\Controller\\ProjectController::show' )
	->assert( 'name', '[0-9a-z_-]{1,255}' )
	->bind( ROUTE_PROJECT );

## ERROR
$app->error( function( \Exception $e, $code ) use ( $app ) {

	switch ( $code )
	{
		case 404 :
			return $app->render( '404.twig' );
			break;

		default :
			$message = 'We are sorry, but something went terribly wrong.';
	}

	if ( $app['debug'] ) $message .= '<br>Error Message: ' . $e->getMessage();

	return new Response( $message, $code );

});
