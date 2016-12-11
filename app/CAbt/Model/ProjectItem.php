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

use Netcarver\Textile\Parser;
use Symfony\Component\Finder\Finder;

/**
 * Class ProjectItem
 * @package CAbt\Model
 */
class ProjectItem
{
	########################################################################
	//// PRIVATE VAR ///////////////////////////////////////////////////////
	########################################################################

	/** @var string Project filesystem full path */
	protected $_path = '';
	/** @var string Project directory name */
	protected $_dirname = '';
	/** @var string Project URL */
	protected $_urlSlug = '';
	/** @var string Project title */
	protected $_title = '';
	/** @var string Project infos */
	protected $_infos = '';
	/** @var \DateTime Project date */
	protected $_date;

	/** @var string Project image thumbnail name */
	protected $_thumbName = '';
	/** @var array Project images name list */
	protected $_images = array();
	/** @var int Project images count */
	protected $_imagesCount = 0;

	/** @var \SplFileObject Data file object */
	protected $_fileObject;
	/** @var int */
	protected $_contentStartLine = 0;

	/** @var array Regex pattern for info parsing */
	protected $_projectInfoPatterns = array(
		'title' => '/^title: (?P<title>.*)/',
		'infos' => '/^infos: (?P<infos>.*)/',
		'date' => '/^date: (?P<day>0[1-9]|[1-2][0-9]|3[01])\/(?P<month>0[1-9]|1[0-2])\/(?P<year>[0-9]{4})/'
	);
	/** @var string */
	protected $_thumbPattern = 'thumb.*';
	/** @var string */
	protected $_imagesPattern = '/\.(jpg|jpeg|gif|png)$/';
	/** @var string */
	protected $_dataFileName = 'data.tx';
	/** @var \Netcarver\Textile\Parser */
	protected $_textileParser;

	########################################################################
	//// CONSTRUCTOR ///////////////////////////////////////////////////////
	########################################################################

	/**
	 * @param \SplFileInfo $fileInfo
	 */
	public function __construct( \SplFileInfo $fileInfo )
	{
		$this->_date = new \DateTime();
		$this->_path = $fileInfo->getRealPath();
		$this->_dirname = $fileInfo->getBasename();
		$this->_urlSlug = $fileInfo->getBasename();

		$this->parse();
	}

	########################################################################
	//// PRIVATE METHOD ////////////////////////////////////////////////////
	########################################################################

	protected function parse()
	{
		/*
		iteration ligne par ligne et test le pattern à chaque ligne
		des que l'on croise une ligne vide on termine l'iteration
		*/

		$this->parseDataFile();
		$this->checkIfThumbExist();
		$this->parseImages();
	}

	protected function parseDataFile()
	{
		try {
			$this->_fileObject = new \SplFileObject( $this->_path . '/' . $this->_dataFileName );
		}
		catch ( \RuntimeException $e ) {
			throw new \Exception(
				'File \'' . $this->_dataFileName . '\' for \'' . $this->_dirname . '\' cannot be read.'
			);
		}

		// parse data file

		while( !$this->_fileObject->eof() )
		{
			$currentContent = trim( $this->_fileObject->current() );

			// check if current line is empty
			// if true means start of project description
			if ( empty( $currentContent ))
			{
				$this->_contentStartLine = ( $this->_fileObject->key() + 1 );
				break;
			}
			else
			{
				$this->parseMetadata( $currentContent );
			}

			$this->_fileObject->next();
		}
	}

	protected function parseMetadata( $lineContent )
	{
		foreach ( $this->_projectInfoPatterns as $key => $pattern )
		{
			if ( 1 === preg_match( $pattern, $lineContent, $match ))
			{
				$this->setMetadata( $key, $match );
			}
		}
	}

	protected function setMetadata( $name, $match )
	{
		switch ( $name )
		{
			case 'title':
				$this->_title = $match['title'];
				break;

			case 'infos':
				$this->_infos = $match['infos'];
				break;

			case 'date':
				$this->_date = \DateTime::createFromFormat(
					'Y-m-d',
					$match['year'] . '-' . $match['month'] . '-' . $match['day']
				);
				break;
		}
	}

	protected function checkIfThumbExist()
	{
		$thumb = Finder::create()
			->in( $this->_path )
			->files()
			->depth( 0 )
			->name( $this->_thumbPattern );

		// if thumb not exists return
		if ( $thumb->count() <= 0 ) return;

		foreach ( $thumb as $th )
		{
			$this->_thumbName = $th->getBasename();
			// get the first thumb only
			break;
		}
	}

	protected function parseImages()
	{
		$images = Finder::create()
			->in( $this->_path )
			->files()
			->depth( 0 )
			// only jpg, jpeg, gif and png file
			->name( $this->_imagesPattern )
			// not thumb
			->notName( $this->_thumbPattern )
			->sortByName();

		if ( $images->count() <= 0 ) return;

		foreach ( $images as $img )
		{
			$this->_images[] = $img->getBasename();
		}

		$this->_imagesCount = count( $this->_images );
	}

	########################################################################
	//// PUBLIC METHOD /////////////////////////////////////////////////////
	########################################################################

	/**
	 * @return string Raw desc content
	 */
	public function getDescContent()
	{
		$content = '';

		$this->_fileObject->rewind();
		$this->_fileObject->seek( $this->_contentStartLine );

		while( !$this->_fileObject->eof() )
		{
			$content .= $this->_fileObject->current();
			$this->_fileObject->next();
		}

		return $content;
	}

	/**
	 * @return string Parsed desc content with textile
	 */
	public function getParsedDescContent()
	{
		if ( null == $this->_textileParser ) return '';
		return $this->_textileParser->textileThis( $this->getDescContent() );
	}

	/**
	 * @param Parser $parser
	 */
	public function setTextileParser( Parser $parser )
	{
		$this->_textileParser = $parser;
	}

	########################################################################
	//// GETTER/SETTER /////////////////////////////////////////////////////
	########################################################################

	/**
	 * @return string
	 */
	public function getPath()
	{
		return $this->_path;
	}

	/**
	 * @return string
	 */
	public function getUrlSlug()
	{
		return $this->_urlSlug;
	}

	/**
	 * @return string
	 */
	public function getAssetPath()
	{
		// move in const
		return '/data/projects/' . $this->_dirname;
	}

	/**
	 * @return array
	 */
	public function getImages()
	{
		return $this->_images;
	}

	/**
	 * @return string
	 */
	public function getThumbName()
	{
		return $this->_thumbName;
	}

	/**
	 * @return int
	 */
	public function getTimestamp()
	{
		return $this->_date->getTimestamp();
	}

	/**
	 * @return \DateTime
	 */
	public function getDate()
	{
		return clone $this->_date;
	}

	/**
	 * @return string
	 */
	public function getTitle()
	{
		return $this->_title;
	}

	/**
	 * @return string
	 */
	public function getInfos()
	{
		return $this->_infos;
	}
} 
