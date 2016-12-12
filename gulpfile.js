const gulp = require( 'gulp' );
const del = require( 'del' );
const fs = require( 'fs' );

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
	return fs.writeFileSync( 'app/config/.dev', 'env: dev' );
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
