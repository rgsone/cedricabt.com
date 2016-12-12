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

use CAbt\Helper\Config\EnvResolver;
use CAbt\Silex\ControllerResolver;
use CAbt\Silex\Provider\FilesystemServiceProvider;
use CAbt\Silex\Provider\FinderServiceProvider;
use CAbt\Silex\Provider\TextileServiceProvider;
use CAbt\Silex\Provider\VarsServiceProvider;
use M1\Vars\Vars;
use Silex\Application;
use Silex\Provider\MonologServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Symfony\Component\Routing\Exception\InvalidParameterException;

/**
 * Class App
 * @package CAbt
 */
class App extends Application
{
	use Application\TwigTrait;
	use Application\UrlGeneratorTrait;
	use Application\MonologTrait;

	protected $isDevEnv = false;

	/**
	 * @param array $values
	 */
	public function __construct( array $values = array() )
	{
		parent::__construct( $values );

		$this->isDevEnv = EnvResolver::dotDevExists( PATH_CONFIG );
		$this['debug'] = $this->isDevEnv;

		# Resolver (use our own resolver for controller contructor app injection)
		$this['resolver'] = function( $app ) {
			return new ControllerResolver( $app, $app['logger'] );
		};

		$this->registerProviders();

		$this['config']['debug'] = $this->isDevEnv;
		$this['config']['env'] = ( $this->isDevEnv ) ? 'dev' : 'prod';
		$this['monolog.level'] = $this['config']['monolog.level'];
	}

	protected function registerProviders()
	{
		$configFiles = [ PATH_CONFIG . '/base.yml' ];
		// get correct config for current env (dev or prod)
		$configFiles[] = ( $this->isDevEnv ) ? PATH_CONFIG . '/dev.yml' : PATH_CONFIG . '/prod.yml';

		# Vars > config
		$this->register( new VarsServiceProvider( $configFiles ), [ 'vars.options' => [
			'cache' => !$this->isDevEnv,
			'cache_path' => PATH_CACHE,
			'cache_expire' => 600,
			'loaders' => [ 'yaml' ]
		]]);

		# Filesystem
		$this->register( new FilesystemServiceProvider() );

		# Finder (return a new Finder each time was call)
		$this->register( new FinderServiceProvider() );

		# Monolog
		$this->register( new MonologServiceProvider(), [
			'monolog.name' => 'app.log',
			'monolog.logfile' => PATH_LOG . '/app.log'
		]);

		# Textile
		$this->register( new TextileServiceProvider(), [
			'textile.doctype' => 'html5'
		]);

		# Twig
		$this->register( new TwigServiceProvider(), [
			'twig.path' => PATH_VIEW,
			'twig.options' => [
				'cache' => PATH_CACHE . '/twig',
				'autoescape' => true
			]
		]);
	}

	/**
	 * Generate path for asset
	 *
	 * @param $path
	 * @return string
	 */
	public function asset( $path )
	{
		return $this['request_stack']->getCurrentRequest()->getBasePath() . $path;
	}
} 
