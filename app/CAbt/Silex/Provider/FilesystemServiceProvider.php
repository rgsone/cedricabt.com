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

use Illuminate\Filesystem\Filesystem;
use Silex\Application;
use Silex\ServiceProviderInterface;

/**
 * Class FilesystemServiceProvider
 * @package CAbt\Silex\Provider
 */
class FilesystemServiceProvider implements ServiceProviderInterface
{
	public function register( Application $app )
	{
		$app['filesystem'] = $app->share( function() use ( $app ) {
			return new Filesystem();
		});
	}

	public function boot( Application $app ) { }
}
