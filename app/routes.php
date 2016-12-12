<?php

/*#########################################################
===========================================================

	cedricabt.com

	@author	rudy marc
	@email	rgs@rgsone.com
	@web	http://rgsone.com

===========================================================
#########################################################*/

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

## HOME
$app->get( '/', '\\CAbt\\Controller\\HomeController::show' )
	->bind( $app['config']['route.names.home'] );

## ABOUT
$app->get( '/a-propos/', '\\CAbt\\Controller\\AboutController::show' )
	->bind( $app['config']['route.names.about'] );

## CONTACT
$app->get( '/contact/', '\\CAbt\\Controller\\ContactController::show' )
	->bind( $app['config']['route.names.contact'] );

## PROJECT
$app->get( '/projet/{name}/', '\\CAbt\\Controller\\ProjectController::show' )
	->assert( 'name', '[0-9a-z_-]{1,255}' )
	->bind( $app['config']['route.names.project'] );

## ERROR
$app->error( function( \Exception $e, Request $request, $code ) use ( $app ) {

	switch ( $code )
	{
		case 404 :
			return $app->render( '404.twig' );
			break;

		default :
			$message = 'Ah !!!!! Une erreur s\'est produite...';
	}

	if ( $app['debug'] ) $message .= '<br>Error Message: ' . $e->getMessage();

	return new Response( $message, $code );

});
