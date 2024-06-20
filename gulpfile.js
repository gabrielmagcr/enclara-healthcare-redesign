
//required plugins
var gulp = require('gulp'),
		sass = require('gulp-sass'),
		sourcemaps = require('gulp-sourcemaps'),
		concat = require('gulp-concat'),
		uglify = require('gulp-uglify'),
		plumber = require('gulp-plumber'),
		beep = require('beepbeep'),
		include = require('gulp-include'),
		browserSync = require('browser-sync').create();


var config = require('./_config.js');

//project settings
var settings = {
	server: config.host,
	siteFiles: '**/*.php',
	sassDir: '_sass/**/*.scss',
	cssDest:  'assets/css',
	jsPluginsDir: [
		'_js/vendor/velocity.js',
		'_js/vendor/velocity-ui.js',
		'node_modules/gsap/src/minified/TweenMax.min.js',
		'_js/vendor/flickity.js'
		],
	jsIncludes: ['_js/about.js', '_js/contact.js', '_js/careers.js', '_js/news.js'],
	jsDir: ['_js/utils.js', '_js/global.js'],
	jsDest: 'assets/js'
};

//plumber error handling
var onError = function(err) {
	beep();
	console.log(err);
	this.emit('end');
};

// serve/init browsersync
gulp.task('serve', ['sass'], function() {
	browserSync.init({
		proxy: settings.server
	});
	gulp.watch(settings.sassDir, ['sass']);
	gulp.watch(settings.jsDir, ['js']).on('change',browserSync.reload);
	gulp.watch(settings.jsIncludes, ['js']).on('change',browserSync.reload);
	gulp.watch(settings.siteFiles).on('change',browserSync.reload);
});


//compile sass
gulp.task('sass', function() {
	gulp.src(settings.sassDir)
		.pipe(plumber(onError))
		.pipe(sourcemaps.init())
		.pipe(sass())
		.pipe(sourcemaps.write())
		.pipe(gulp.dest(settings.cssDest))
		.pipe(browserSync.stream());
});


//creates js plugin file, from files in /vendor folder
gulp.task('jsplugins', function() {
	gulp.src(settings.jsPluginsDir)
		.pipe(concat('plugins.js'))
		.pipe(uglify())
		.pipe(gulp.dest(settings.jsDest));
});

//authored theme javascript
gulp.task('js', function() {
	gulp.src(settings.jsDir)
		.pipe(plumber(onError))
		.pipe(include())
		.pipe(concat('global.js'))
		.pipe(uglify())
		.pipe(gulp.dest(settings.jsDest));
});

//defaults task
gulp.task('default', ['sass','jsplugins','js','serve']);



