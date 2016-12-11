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

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Symfony\Component\Finder\Finder;

/**
 * Class FinderServiceProvider
 * @package CAbt\Silex\Provider
 */
class FinderServiceProvider implements ServiceProviderInterface
{
	public function register( Container $app )
	{
		$app['finder'] = $app->factory( function() {
			return new Finder();
		});
	}
}
