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
use CAbt\Model\ProjectItem;

/**
 * Class ProjectController
 * @package CAbt\Controller
 */
class ProjectController extends BaseController
{
	########################################################################
	//// PRIVATE VAR ///////////////////////////////////////////////////////
	########################################################################

	protected $dataFileName = 'data.tx';

	########################################################################
	//// PRIVATE METHOD ////////////////////////////////////////////////////
	########################################################################

	/**
	 * @route 'route.project' > '/projet/{name}/'
	 * @param $name
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function show( $name )
	{
		$projectPath = PATH_DATA_PROJECTS . DIRECTORY_SEPARATOR . $name;

		// check if project exists
		if ( !$this->app['filesystem']->exists( $projectPath ) )
		{
			$this->app->abort( 404 );
		}

		// check if data.tx file exists
		if ( !$this->app['filesystem']->exists( $projectPath . DIRECTORY_SEPARATOR . $this->dataFileName ) )
		{
			$this->app->abort( 404 );
		}

		$project = new ProjectItem( new \SplFileInfo( $projectPath ) );
		$project->setTextileParser( $this->app['textile'] );

		return $this->render( 'project.twig', array(
			'project' => $project
		));
	}
} 
