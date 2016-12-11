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

use Netcarver\Textile\Parser;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class TextileServiceProvider
 * @package CAbt\Silex\Provider
 */
class TextileServiceProvider implements ServiceProviderInterface
{
	public function register( Container $app )
	{
		$app['textile.doctype'] = ( isset( $app['textile.doctype'] ) ) ? $app['textile.doctype'] : 'xhtml';
		$app['textile'] = function() use ( $app ) {
			return new Parser( $app['textile.doctype'] );
		};
	}
}
