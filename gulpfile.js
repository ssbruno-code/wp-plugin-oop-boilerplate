// Load Gulp...of course
var gulp = require( 'gulp' );

// CSS related plugins
var sass = require('gulp-sass')(require('sass'));
var autoprefixer = require( 'gulp-autoprefixer' );
var minifycss    = require( 'gulp-uglifycss' );

// JS related plugins
var concat       = require( 'gulp-concat' );
var uglify       = require( 'gulp-uglify' );
var babelify     = require( 'babelify' );
var browserify   = require( 'browserify' );
var source       = require( 'vinyl-source-stream' );
var buffer       = require( 'vinyl-buffer' );
var stripDebug   = require( 'gulp-strip-debug' );

// Utility plugins
var rename       = require( 'gulp-rename' );
var sourcemaps   = require( 'gulp-sourcemaps' );
var notify       = require( 'gulp-notify' );
var plumber      = require( 'gulp-plumber' );
var options      = require( 'gulp-options' );
var gulpif       = require( 'gulp-if' );
const gulpStripDebug = require('gulp-strip-debug');

// Browers related plugins
var browserSync  = require( 'browser-sync' ).create();
var reload       = browserSync.reload;

// Project related variables
var projectURL   = 'https://test.dev';

var styleSRC     = 'src/scss/public-styles.scss';
var styleURL     = 'assets/css/';
var mapURL       = './';

var adminSrc     = 'src/scss/admin-styles.scss';
var adminDist 	 = 'assets/css/';

var jsSRC        = 'src/js/public-scripts.js';
var jsURL        = 'assets/js/';

var jsAdminSrc 	 = 'src/js/admin-scripts.js';
var jsAdminDist  = 'assets/js/'


var styleWatch   = 'src/scss/**/*.scss';
var jsWatch      = 'src/js/*.js';
var phpWatch     = '**/*.php';

// Tasks
gulp.task( 'browser-sync', async function() {
	browserSync.init({
		proxy: projectURL,
		// https: {
		// 	key: '/Users/alecaddd/.valet/Certificates/test.dev.key',
		// 	cert: '/Users/alecaddd/.valet/Certificates/test.dev.crt'
		// },
		injectChanges: false,
		open: false
	});

});

gulp.task( 'styles', async function() {
	gulp.src( styleSRC )
		.pipe( sourcemaps.init() )
		.pipe( sass({
			errLogToConsole: true,
			outputStyle: 'compressed'
		}) )
		.on( 'error', console.error.bind( console ) )
		.pipe( autoprefixer({ browsers: [ 'last 2 versions', '> 5%', 'Firefox ESR' ] }) )
		.pipe( sourcemaps.write( mapURL ) )
		.pipe( gulp.dest( styleURL ) )
		.pipe( browserSync.stream() );


});

gulp.task('admin-styles', async function(){
	gulp.src( adminSrc )
		.pipe( sourcemaps.init() )
		.pipe( sass( {
			errorLogToConsole:true,
			outputStyle: 'compressed'
		} ) )
		.on( 'error', console.error.bind( console ))
		.pipe( autoprefixer( { 
			browsers: ['last 2 versions'], cascade: false
		} ) )
		.pipe( rename( { suffix: '.min' } ))
		.pipe( sourcemaps.write( './' ) )
		.pipe( gulp.dest( adminDist ) );

});

gulp.task( 'admin-js', async function() {
	// gulp.src( jsAdminSrc )
	// 	.pipe( gulp.dest(  jsAdminDist ) )
	return browserify({
		entries: [ jsAdminSrc ]
	})
	.transform( babelify, { presets: ['env'] } )
	.bundle()
	.pipe( source( 'admin-scripts.js' ) )
	.pipe( rename( { extname: '.min.js' } ) )
	.pipe(  buffer() )
	.pipe( sourcemaps.init( { loadMaps: true } ) )
	.pipe( uglify() )
	.pipe( sourcemaps.write( './' ) )
	.pipe( gulp.dest( jsAdminDist ) );



 });

gulp.task( 'js', async function() {
	return browserify({
		entries: [jsSRC]
	})
	.transform( babelify, { presets: [ 'env' ] } )
	.bundle()
	.pipe( source( 'public-scripts.js' ) )
	.pipe( buffer() )
	.pipe( gulpif( options.has( 'production' ), stripDebug() ) )
	.pipe( sourcemaps.init({ loadMaps: true }) )
	.pipe( uglify() )
	.pipe( sourcemaps.write( '.' ) )
	.pipe( gulp.dest( jsURL ) )
	.pipe( browserSync.stream() );

 });

function triggerPlumber( src, url ) {
	return gulp.src( src )
	.pipe( plumber() )
	.pipe( gulp.dest( url ) );
}

 gulp.task( 'default', gulp.series( ['styles', 'js', 'admin-js', 'admin-styles'], async function() {
	gulp.src( jsURL + 'public-scripts.min.js' )
		.pipe( notify({ message: 'Assets Compiled!' }) );

 }));

 gulp.task( 'watch', gulp.series( ['default'], async function() {
	gulp.watch( phpWatch, gulp.series( reload ));
	gulp.watch( styleWatch, gulp.series([ 'styles', 'admin-styles'] ));
	gulp.watch( jsWatch, gulp.series([ 'js', 'admin-js', reload ] ));
	gulp.src( jsURL + 'public-scripts.min.js' )
		.pipe( notify({ message: 'Gulp is Watching, Happy Coding!' }) );

 }));
//  gulp.task( 'watch', ['default', 'browser-sync'], function() {
// 	gulp.watch( phpWatch, reload );
// 	gulp.watch( styleWatch, [ 'styles', 'admin-styles' ] );
// 	gulp.watch( jsWatch, [ 'js', 'admin-js', reload ] );
// 	gulp.src( jsURL + 'public-scripts.min.js' )
// 		.pipe( notify({ message: 'Gulp is Watching, Happy Coding!' }) );
//  });
