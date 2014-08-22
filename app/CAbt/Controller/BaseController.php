<?php

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
	/** @var App */
	protected $app;
	/** @var Request */
	protected $request;

	/**
	 * @param App $app
	 */
	public function __construct( App $app )
	{
		$this->app = $app;
		$this->request = $app['request'];
	}

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
