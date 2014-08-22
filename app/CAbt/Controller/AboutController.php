<?php

namespace CAbt\Controller;

use CAbt\Controller\BaseController;

/**
 * Class AboutController
 * @package CAbt\Controller
 */
class AboutController extends BaseController
{
	public function show()
	{
		return $this->render( 'about.twig' );
	}
} 
