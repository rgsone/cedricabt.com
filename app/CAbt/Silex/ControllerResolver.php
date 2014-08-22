<?php

namespace CAbt\Silex;

use Silex\ControllerResolver as BaseControllerResolver;

/**
 * Class ControllerResolver
 * @package CAbt\Silex
 */
class ControllerResolver extends BaseControllerResolver
{
	protected function createController( $controller )
	{
		if ( false === strpos( $controller, '::' ) )
		{
			throw new \InvalidArgumentException( sprintf( 'Unable to find controller "%s".', $controller ) );
		}

		list( $class, $method ) = explode( '::', $controller, 2 );

		if ( !class_exists( $class ) )
		{
			throw new \InvalidArgumentException( sprintf( 'Class "%s" does not exist.', $class ) );
		}

		return array( new $class( $this->app ), $method );
	}
} 
