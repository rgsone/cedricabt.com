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

use M1\Vars\Vars;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class VarsServiceProvider implements ServiceProviderInterface
{
	/** @var null */
	private $configEntity;

	/** @var array */
	private $optionKeys = [
		'base_path',
		'cache',
		'cache_path',
		'cache_expire',
		'variables',
		'loaders'
	];

	public function __construct( $configEntity = null )
	{
		$this->configEntity = $configEntity;
	}

	public function register( Container $app )
	{
		$app[ 'config' ] = function ( $app ) {
			return new Vars( $this->configEntity, $this->createOptions( $app ));
		};
	}

	private function createOptions( $app )
	{
		$options = [];

		if ( isset( $app[ 'vars.options' ] ) )
			$options = $this->createKeyedOptions( $options, $app[ 'vars.options' ] );

		return $options;
	}

	private function createKeyedOptions( $options, $varsOptions )
	{
		foreach ( $this->optionKeys as $option )
			$options[ $option ] = ( isset( $varsOptions[ $option ] ) ) ? $varsOptions[ $option ] : null;

		return $options;
	}
}
