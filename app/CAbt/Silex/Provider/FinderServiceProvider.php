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

use Silex\Application;
use Silex\ServiceProviderInterface;
use Symfony\Component\Finder\Finder;

/**
 * Class FinderServiceProvider
 * @package CAbt\Silex\Provider
 */
class FinderServiceProvider implements ServiceProviderInterface
{
	public function register( Application $app )
	{
		$app['finder'] = function() { return new Finder(); };
	}

	public function boot( Application $app ) { }
}
