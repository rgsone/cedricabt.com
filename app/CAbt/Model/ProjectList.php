<?php

/*#########################################################
===========================================================

	cedricabt.com

	@author	rudy marc
	@email	rgs@rgsone.com
	@web	http://rgsone.com

===========================================================
#########################################################*/

namespace CAbt\Model;

use Silex\Application;
use Symfony\Component\Finder\Finder;

/**
 * Class ProjectList
 * @package CAbt\Model
 */
class ProjectList implements \IteratorAggregate, \Countable
{
	########################################################################
	//// CONST /////////////////////////////////////////////////////////////
	########################################################################

	const SORT_ASC = 'ASC';
	const SORT_DESC = 'DESC';

	########################################################################
	//// PRIVATE VAR ///////////////////////////////////////////////////////
	########################################################################

	/** @var \Silex\Application; */
	protected $_app;
	/** @var \Symfony\Component\Finder\Finder */
	protected $_directories;
	/** @var array */
	protected $_projects = array();
	/** @var int */
	protected $_count = 0;
	/** @var string */
	protected $_dataFileName = 'data.tx';

	########################################################################
	//// CONSTRUCTOR ///////////////////////////////////////////////////////
	########################################################################

	/**
	 * @param Finder $directories
	 */
	public function __construct( Finder $directories, Application $app )
	{
		$this->_app = $app;
		$this->_directories = $directories;
		$this->parse();
	}

	########################################################################
	//// PRIVATE METHOD ////////////////////////////////////////////////////
	########################################################################

	protected function parse()
	{
		foreach( $this->_directories as $project )
		{
			// for each dir, check if data.tx file exists
			// if data.txt not exists skip current dir
			// else create new ProjectItem object
			if ( $this->_app['filesystem']->exists( $project->getPathname() . '/' . $this->_dataFileName ) )
			{
				$this->_projects[] = $project;
			}
		}

		$this->_count = count( $this->_projects );
	}

	########################################################################
	//// PUBLIC METHOD /////////////////////////////////////////////////////
	########################################################################

	/**
	 * @return array All projects list
	 */
	public function getProjects()
	{
		return $this->_projects;
	}

	/**
	 * @param string $sort
	 */
	public function sortByDate( $sort = 'DESC' )
	{
		/*
		usort( $this->_projects, function( $a, $b ) {
			// check if getTimestamp method exist
			if ( $a->getTimestamp() == $b->getTimestamp() ) return 0;
			return ( $a->getTimestamp() < $b->getTimestamp() ) ? 1 : -1;
		});
		*/
	}

	/**
	 * Retrieve an external iterator
	 * @return \Traversable An instance of an object implementing <b>Iterator</b> or
	 */
	public function getIterator()
	{
		return new \ArrayIterator( $this->_projects );
	}

	/**
	 * @return int The custom count as an integer.
	 */
	public function count()
	{
		return $this->_count;
	}
} 