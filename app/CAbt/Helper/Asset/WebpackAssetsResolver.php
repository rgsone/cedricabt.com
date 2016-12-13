<?php

/*#########################################################
===========================================================

	cedricabt.com

	@author	rudy marc
	@email	rgs@rgsone.com
	@web	http://rgsone.com

===========================================================
#########################################################*/

namespace CAbt\Helper\Asset;

/**
 * Class WebpackAssetsResolver
 * @package CAbt\Helper\Asset
 */
class WebpackAssetsResolver
{
	/** @var \SplFileInfo Path to assets.json */
	protected $_manifestFile;
	/** @var null|array Assets paths */
	protected $_assets = null;

	/**
	 * WebpackAssetsResolver constructor.
	 * @param string $manifestPath Path to assets.json
	 * @throws \Exception
	 */
	public function __construct( $manifestPath )
	{
		$this->_manifestFile = new \SplFileInfo( $manifestPath );

		if ( !$this->_manifestFile->getRealPath() ||
			 !file_exists( $this->_manifestFile->getRealPath() ) )
		{
			throw new \Exception( 'File [' . $this->_manifestFile->getPathname() . '] does not exists !' );
		}
	}

	public function getAssetsPaths()
	{
		if ( null === $this->_assets )
		{
			$this->parseManifest();
		}

		return $this->_assets;
	}

	protected function parseManifest()
	{
		try {
			$this->_assets = json_decode( file_get_contents( $this->_manifestFile->getRealPath()), true );
		} catch ( \Exception $e ) {
			throw new \Exception(
				'Parsing JSON fails for [' . $this->_manifestFile->getRealPath() . ']', 0, $e
			);
		}
	}
}
