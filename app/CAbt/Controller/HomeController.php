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
