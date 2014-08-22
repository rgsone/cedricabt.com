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
 * Class ProjectController
 * @package CAbt\Controller
 */
class ProjectController extends BaseController
{
	public function show( $name )
	{
		return $this->render( 'project.twig', array( 'projectName' => $name ));
	}
} 
