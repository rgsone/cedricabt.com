<?php

/*#########################################################
===========================================================

	cedricabt.com

	@author	rudy marc
	@email	rgs@rgsone.com
	@web	http://rgsone.com

===========================================================
#########################################################*/

namespace CAbt\Controller;

use CAbt\App;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class BaseController
 * @package CAbt\Controller
 */
class BaseController
{
	########################################################################
	//// PRIVATE VAR ///////////////////////////////////////////////////////
	########################################################################

	/** @var App */
	protected $app;
	/** @var Request */
	protected $request;

	########################################################################
	//// CONSTRUCTOR ///////////////////////////////////////////////////////
	########################################################################

	/**
	 * @param App $app
	 */
	public function __construct( App $app )
	{
		$this->app = $app;
		$this->request = $app['request'];
	}

	########################################################################
	//// PRIVATE METHOD ////////////////////////////////////////////////////
	########################################################################

	/**
	 * @param $view
	 * @param array $params
	 * @param Response $response
	 * @return Response
	 */
	protected function render( $view, array $params = array(), Response $response = null )
	{
		return $this->app->render( $view, $params, $response );
	}
} 
