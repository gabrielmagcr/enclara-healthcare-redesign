//required plugins
var gulp = require('gulp'),
    sass = require('gulp-sass')(require('sass')),
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
    cssDest: 'assets/css',
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

// compile sass
function sassTask() {
    return gulp.src(settings.sassDir)
        .pipe(plumber(onError))
        .pipe(sourcemaps.init())
        .pipe(sass())
        .pipe(sourcemaps.write())
        .pipe(gulp.dest(settings.cssDest))
        .pipe(browserSync.stream());
}

// creates js plugin file, from files in /vendor folder
function jsPluginsTask() {
    return gulp.src(settings.jsPluginsDir)
        .pipe(concat('plugins.js'))
        .pipe(uglify())
        .pipe(gulp.dest(settings.jsDest));
}

// authored theme javascript
function jsTask() {
    return gulp.src(settings.jsDir)
        .pipe(plumber(onError))
        .pipe(include())
        .pipe(concat('global.js'))
        .pipe(uglify())
        .pipe(gulp.dest(settings.jsDest));
}

// serve/init browsersync
function serveTask() {
    browserSync.init({
        proxy: settings.server
    });
    gulp.watch(settings.sassDir, sassTask);
    gulp.watch(settings.jsDir, jsTask).on('change', browserSync.reload);
    gulp.watch(settings.jsIncludes, jsTask).on('change', browserSync.reload);
    gulp.watch(settings.siteFiles).on('change', browserSync.reload);
}

// default task
gulp.task('default', gulp.series(gulp.parallel(sassTask, jsPluginsTask, jsTask), serveTask));

// specific tasks
gulp.task('sass', sassTask);
gulp.task('jsplugins', jsPluginsTask);
gulp.task('js', jsTask);
gulp.task('serve', gulp.series('sass', serveTask));
