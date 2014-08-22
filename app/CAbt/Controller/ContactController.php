<?php

namespace CAbt\Controller;

use CAbt\Controller\BaseController;

/**
 * Class ContactController
 * @package CAbt\Controller
 */
class ContactController extends BaseController
{
	public function show()
	{
		return $this->render( 'contact.twig' );
	}
} 
