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
