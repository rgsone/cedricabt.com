<?php

/*#########################################################
===========================================================

	cedricabt.com

	@author	rudy marc
	@email	rgs@rgsone.com
	@web	http://rgsone.com

===========================================================
#########################################################*/

namespace CAbt\Helper\Config;

use Symfony\Component\Filesystem\Filesystem;

/**
 * Class EnvResolver
 * @package CAbt\Helper\Config
 */
class EnvResolver
{
	private static $dotDevFilename = '.dev';

	public static function dotDevExists( $path )
	{
		$path = rtrim( $path, ' /\\' );
		$fs = new Filesystem();
		return $fs->exists( $path . DIRECTORY_SEPARATOR . self::$dotDevFilename );
	}
}
