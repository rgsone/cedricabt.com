<?php

/*#########################################################
===========================================================

	cedricabt.com

	@author	rudy marc
	@email	rgs@rgsone.com
	@web	http://rgsone.com

===========================================================
#########################################################*/

namespace CAbt;

use Monolog\Logger;
use Silex\Application;

/**
 * Class App
 * @package CAbt
 */
class App extends Application
{
	use Application\TwigTrait;
	use Application\UrlGeneratorTrait;
	use Application\MonologTrait;

	/**
	 * @param array $values
	 */
	public function __construct( array $values = array() )
	{
		parent::__construct( $values );
	}

	/**
	 * Generate path for asset
	 *
	 * @param $path
	 * @return string
	 */
	public function asset( $path )
	{
		return $this['request']->getBasePath() . $path;
	}
} 
