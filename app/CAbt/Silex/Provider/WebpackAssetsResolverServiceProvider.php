<?php

/*#########################################################
===========================================================

	cedricabt.com

	@author	rudy marc
	@email	rgs@rgsone.com
	@web	http://rgsone.com

===========================================================
#########################################################*/

namespace CAbt\Silex\Provider;

use CAbt\Helper\Asset\WebpackAssetsResolver;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class WebpackAssetsResolverServiceProvider implements ServiceProviderInterface
{
	/** @var string */
	private $_manifestPath;

	public function __construct( $manifestPath )
	{
		$this->_manifestPath = $manifestPath;
	}

	public function register( Container $app )
	{
		$app[ 'webpack_assets_resolver' ] = function () {
			return new WebpackAssetsResolver( $this->_manifestPath );
		};
	}
}
