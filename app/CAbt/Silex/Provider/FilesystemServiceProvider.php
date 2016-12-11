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
use Symfony\Component\Filesystem\Filesystem;

/**
 * Class FilesystemServiceProvider
 * @package CAbt\Silex\Provider
 */
class FilesystemServiceProvider implements ServiceProviderInterface
{
	public function register( Container $app )
	{
		$app['filesystem'] = function() {
			return new Filesystem();
		};
	}
}
