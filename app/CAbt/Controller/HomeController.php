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
use CAbt\Model\ProjectList;

/**
 * Class HomeController
 * @package CAbt\Controller
 */
class HomeController extends BaseController
{
	########################################################################
	//// PRIVATE VAR ///////////////////////////////////////////////////////
	########################################################################

	protected $projectsDirAllowPattern = '/^[0-9a-z_-]{1,255}$/';

	########################################################################
	//// PRIVATE METHOD ////////////////////////////////////////////////////
	########################################################################

	/**
	 * @route 'route.home' > '/'
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function show()
	{
		$directories = $this->app['finder']
			->in( PATH_DATA_PROJECTS )
			->directories()
			->name( $this->projectsDirAllowPattern )
			->depth( '0' );

		$projects = new ProjectList( $directories, $this->app );
		$projects->sortByDate( ProjectList::SORT_DESC );

		return $this->render( 'home.twig', array(
			'projects' => $projects
		));
	}
} 
