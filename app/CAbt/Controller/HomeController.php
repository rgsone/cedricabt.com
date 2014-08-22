<?php

namespace CAbt\Controller;

use CAbt\Controller\BaseController;

/**
 * Class HomeController
 * @package CAbt\Controller
 */
class HomeController extends BaseController
{
	public function show()
	{
		return $this->render( 'home.twig' );
	}
} 
