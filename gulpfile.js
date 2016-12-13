const gulp = require( 'gulp' );
const del = require( 'del' );
const fs = require( 'fs' );
const runSequence = require( 'run-sequence' );

/* #############################################
   ==== TASKS ==================================
   ############################################# */


/* #### SETENV TASKS ########################### */

// set env to prod (e.g. remove '.dev' file from config/)
gulp.task( 'setenv:prod', () => {
	return del([ 'app/config/.dev' ]);
});

// set env to dev (e.g. add '.dev' file to config/)
gulp.task( 'setenv:dev', () => {
	fs.writeFileSync( 'app/config/.dev', 'env: dev' );
});


/* #### CLEAN TASKS ############################ */

// clean cache folder
gulp.task( 'clean:cache', () => {
	return del([ 'app/cache/**/*', '!app/cache/.gitkeep' ]);
});

// clean log folder
gulp.task( 'clean:log', () => {
	return del([ 'app/log/**/*', '!app/log/.gitkeep' ]);
});

// clean all log and cache dir
gulp.task( 'clean', [ 'clean:cache', 'clean:log' ], () => {
	console.log( '-> app/cache/ and app/log/ clear !' );
});


/* #### BUILD TASKS ############################ */

// delete dist/ dir
gulp.task( 'delete:fullDist', () => {
	return del([ 'dist/' ]);
});

// copy all files to dist/ dir
gulp.task( 'copy:toDist', () => {
	return gulp.src([
			'app/**',
			'libs/**',
			'public/**',
			'.htaccess'
		],
		{
			base: '.',
			dot: true
		})
		.pipe(
			gulp.dest( 'dist/' )
		);
});

// clean unecessaries files in dist/ dir
gulp.task( 'clean:dist', () => {
	return del([
		'dist/**/.gitkeep',
		'dist/**/.gitignore',
		'dist/**/.git',
		'dist/app/config/.dev',
		'dist/app/log/**/*',
		'dist/app/cache/**/*',
		//// +humff
		'dist/libs/m1/vars/**/*',
		'!dist/libs/m1/vars/src/**',
		'dist/libs/monolog/monolog/**/*',
		'!dist/libs/monolog/monolog/src/**',
		'dist/libs/netcarver/textile/**/*',
		'!dist/libs/netcarver/textile/src/**',
		'dist/libs/pimple/pimple/**/*',
		'!dist/libs/pimple/pimple/src/**',
		'dist/libs/silex/silex/**/*',
		'!dist/libs/silex/silex/src/**',
		'dist/libs/twig/twig/**/*',
		'!dist/libs/twig/twig/lib/**',
		'dist/libs/symfony/debug/Tests/**',
		'dist/libs/symfony/debug/Resources/**',
		'dist/libs/symfony/yaml/Tests/**',
		'dist/libs/symfony/routing/Tests/**',
		'dist/libs/symfony/finder/Tests/**',
		'dist/libs/symfony/filesystem/Tests/**'
		//// -humff
	],{
		dot: true
	});
});

// prepare and build dist files for upload
gulp.task( 'build:dist', ( done ) => {
	runSequence( 'delete:fullDist', 'copy:toDist', 'clean:dist', done );
});
