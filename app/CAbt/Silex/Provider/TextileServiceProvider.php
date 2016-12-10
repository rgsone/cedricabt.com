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
use Silex\Application;
use Silex\ServiceProviderInterface;

/**
 * Class TextileServiceProvider
 * @package CAbt\Silex\Provider
 */
class TextileServiceProvider implements ServiceProviderInterface
{
	public function register( Application $app )
	{
		$app['textile.doctype'] = ( isset( $app['textile.doctype'] ) ) ? $app['textile.doctype'] : 'xhtml';

		$app['textile'] = $app->share( function() use ( $app ) {
			return new Parser( $app['textile.doctype'] );
		});
	}

	public function boot( Application $app ) { }
}
