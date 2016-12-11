<?php

/*#########################################################
===========================================================

	cedricabt.com

	@author	rudy marc
	@email	rgs@rgsone.com
	@web	http://rgsone.com

===========================================================
#########################################################*/

namespace CAbt\Silex;

use Silex\ControllerResolver as BaseControllerResolver;

/**
 * Class ControllerResolver
 * @package CAbt\Silex
 */
class ControllerResolver extends BaseControllerResolver
{
	protected function instantiateController( $class )
	{
		return new $class( $this->app );
	}
} 
