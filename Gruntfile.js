module.exports = function( grunt )
{
	grunt.initConfig({

		pkg: grunt.file.readJSON( 'package.json' ),

		watch: {
			css: {
				files: [
					'public/css/*.css',
					'!public/css/*.min.css',
					'!public/css/*.tmp.css',
					'app/view/*.twig'
				],
				tasks: [ 'buildCss' ],
				options: {
					interrupt: true,
					livereload: true
				}
			}
		},

		copy: {
			distbuild: {
				src: [
					'app/**',
					'libs/**',
					'public/**',
					'.htaccess'
				],
				dest: 'dist/',
				dot: true
			},
			cssbuild: {
				files: {
					'public/css/style.tmp.css': [ 'public/css/style.css' ]
				}
			},
			jsbuild: {
				files: {
					'public/js/html5shiv.min.js': [ 'public/bower-components/html5shiv/dist/html5shiv.min.js' ]
				}
			}
		},

		clean: {
			fulldist: {
				src: [
					'dist/*'
				],
				dot: true
			},
			dist: {
				src: [
					'dist/**/.gitkeep',
					'dist/app/cache/*',
					'dist/app/log/*',
					'dist/libs/fzaninotto/faker/**/*',
					'!dist/libs/fzaninotto/faker/src/**',
					'dist/libs/monolog/monolog/**/*',
					'!dist/libs/monolog/monolog/src/**',
					'dist/libs/netcarver/textile/**/*',
					'!dist/libs/netcarver/textile/src/**',
					'dist/libs/pimple/pimple/**/*',
					'!dist/libs/pimple/pimple/lib/**',
					'dist/libs/psr/log/**/*',
					'!dist/libs/psr/log/Psr/**',
					'dist/libs/silex/silex/**/*',
					'!dist/libs/silex/silex/src/**',
					'dist/libs/twig/twig/**/*',
					'!dist/libs/twig/twig/lib/**',
					'dist/libs/symfony/debug/Symfony/Component/Debug/Tests/',
					'dist/libs/symfony/event-dispatcher/Symfony/Component/EventDispatcher/Tests/',
					'dist/libs/symfony/http-foundation/Symfony/Component/HttpFoundation/Tests/',
					'dist/libs/symfony/http-kernel/Symfony/Component/HttpKernel/Tests/',
					'dist/libs/symfony/routing/Symfony/Component/Routing/Tests/',
					'dist/libs/symfony/finder/Symfony/Component/Finder/Tests/',
					'dist/libs/**/*.git',
					'dist/public/bower-components/',
					'dist/public/css/*.css',
					'!dist/public/css/*.min.css',
					'dist/public/js/**/*.js',
					'!dist/public/js/**/*.min.js',
					'dist/maintenance/'
				],
				dot: true
			},
			appcache: [
				'app/cache/*'
			],
			applog: [
				'app/log/*'
			],
			cssbuild: [
				'public/css/*.tmp.css'
			]
		},

		concat: {
			css: {
				src: [
					'public/bower-components/normalize.css/normalize.min.css',
					'public/css/style.min.css'
				],
				dest: 'public/css/style.min.css'
			}
		},

		cssmin: {
			process: {
				options: {
					report: 'gzip',
					keepBreaks: false,
					removeEmpty: true
				},
				files: {
					'public/css/style.min.css': ['public/css/style.tmp.css'],
					'public/bower-components/normalize.css/normalize.min.css': ['public/bower-components/normalize.css/normalize.css']
				}
			}
		},

		autoprefixer: {
			prefix: {
				src: 'public/css/*.tmp.css'
			}
		},

		csscomb: {
			sort: {
				options: {
					config: 'csscomb.json'
				},
				files: {
					'public/css/style.css': [ 'public/css/style.css' ]
				}
			}
		},

		replace: {
			dist: {
				options: {
					patterns: [
						{
							match: /, 'dev'/g,
							replacement: ', \'prod\''
						}
					]
				},
				files: {
					'dist/public/index.php': [ 'dist/public/index.php' ]
				}
			}
		}
	});

	////// LOADTASK //////

	grunt.loadNpmTasks( 'grunt-autoprefixer' );
	grunt.loadNpmTasks( 'grunt-contrib-copy' );
	grunt.loadNpmTasks( 'grunt-contrib-clean' );
	grunt.loadNpmTasks( 'grunt-contrib-watch' );
	grunt.loadNpmTasks( 'grunt-contrib-cssmin' );
	grunt.loadNpmTasks( 'grunt-contrib-concat' );
	grunt.loadNpmTasks( 'grunt-csscomb' );
	grunt.loadNpmTasks( 'grunt-replace' );

	////// REGISTER TASK //////

	grunt.registerTask( 'default', 'Log some stuff.', function() {
		grunt.log.write( '--' );
	});

	grunt.registerTask( 'cssSort', [ 'csscomb' ] );
	grunt.registerTask( 'buildCss',  [ 'copy:cssbuild', 'autoprefixer:prefix', 'cssmin', 'concat:css', 'clean:cssbuild' ] );
	grunt.registerTask( 'buildDist',  [ 'clean:fulldist', 'copy:distbuild', 'clean:dist', 'replace:dist' ] );
	grunt.registerTask( 'cleanCache',  [ 'clean:appcache' ] );
	grunt.registerTask( 'cleanLog',  [ 'clean:applog' ] );
	grunt.registerTask( 'cleanLogAndCache',  [ 'clean:applog', 'clean:appcache' ] );
};
