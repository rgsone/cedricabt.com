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
