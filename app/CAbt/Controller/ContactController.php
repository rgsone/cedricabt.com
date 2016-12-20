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
	########################################################################
	//// PRIVATE METHOD ////////////////////////////////////////////////////
	########################################################################

	/**
	 * @param $filePath
	 * @return string
	 * @throws \Exception
	 */
	protected function parseFile( $filePath )
	{
		try {
			$file = new \SplFileObject( $filePath );
		} catch ( \RuntimeException $e ) {
			throw new \Exception( 'File \'' . $file . '\' cannot be read.' );
		}

		$content = '';

		while( !$file->eof() )
		{
			$content .= $file->current();
			$file->next();
		}

		return $content;
	}

	########################################################################
	//// PUBLIC METHOD /////////////////////////////////////////////////////
	########################################################################

	/**
	 * @route 'route.home' > '/contact/'
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function show()
	{
		$dataFilePath = PATH_DATA . DIRECTORY_SEPARATOR .
			$this->app['config']['data.filenames.contact'] .
			$this->app['config']['data.file_ext'];
		$content = '';

		if ( $this->app['filesystem']->exists( $dataFilePath ) )
		{
			$textileParser = $this->app['textile'];
			$content = $textileParser->parse( $this->parseFile( $dataFilePath ) );
		}

		return $this->render( 'contact.twig', array(
			'content' => $content
		));
	}
} 
