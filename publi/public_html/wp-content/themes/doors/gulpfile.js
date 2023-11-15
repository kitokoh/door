var gulp = require('gulp'),
    //sass = require('gulp-sass'),
    sass = require('gulp-sass')(require('sass')),
    autoprefixer = require('gulp-autoprefixer'),
    sourcemap = require('gulp-sourcemaps'),
    lec = require('gulp-line-ending-corrector'),
    uglify = require('gulp-uglify'),
    concat = require('gulp-concat'),
    zip = require('gulp-zip'),
    livereload = require('gulp-livereload');

function scripts() {
    return (
        gulp
        .src([
            //foundation
            './js/plugins/what-input.min.js',
            './js/foundation.min.js',
            // plugins
            './js/plugins/appear.js',
            './js/plugins/classie.js',
            './js/plugins/counterup.js',
            './js/plugins/easing.js',
            './js/plugins/easypiechart.js',
            './js/plugins/idangero.js',
            './js/plugins/ismobile.js',
            './js/plugins/isotope.js',
            './js/plugins/localscroll.js',
            './js/plugins/modernizr.js',
            './js/plugins/owl.carousel.js',
            './js/plugins/owl.carousel2.js',
            './js/plugins/packery.js',
            './js/plugins/parallax.js',
            './js/plugins/smith.js',
            './js/plugins/waypoints.js',
            './js/plugins/zeptojs.js',
            // shortcode
            './js/shortcode/script-shortcodes.js',
            // shortcode
            './js/vendor/custom.modernizr.js',
            // main scripts
            './js/wd_owlcarousel.js',
            './js/scripts.js'
        ]).pipe(lec({verbose: true, eolc: 'LF', encoding: 'utf8'}))
          .pipe(concat('wd-script.min.js'))
          //.pipe(uglify())
          .pipe(gulp.dest('js'))
          .pipe(livereload())
    );
  }
function scripts_build() {
    return (
        gulp
        .src([
            //foundation
            './js/plugins/what-input.min.js',
            './js/foundation.min.js',
            // plugins
            './js/plugins/appear.js',
            './js/plugins/classie.js',
            './js/plugins/counterup.js',
            './js/plugins/easing.js',
            './js/plugins/easypiechart.js',
            './js/plugins/idangero.js',
            './js/plugins/ismobile.js',
            './js/plugins/isotope.js',
            './js/plugins/localscroll.js',
            './js/plugins/modernizr.js',
            './js/plugins/owl.carousel.js',
            './js/plugins/owl.carousel2.js',
            './js/plugins/packery.js',
            './js/plugins/parallax.js',
            './js/plugins/smith.js',
            './js/plugins/waypoints.js',
            './js/plugins/zeptojs.js',
            // shortcode
            './js/shortcode/script-shortcodes.js',
            // shortcode
            './js/vendor/custom.modernizr.js',
            // main scripts
            './js/wd_owlcarousel.js',
            './js/scripts.js'
        ]).pipe(lec({verbose: true, eolc: 'LF', encoding: 'utf8'}))
          .pipe(concat('wd-script.min.js'))
          .pipe(uglify())
          .pipe(gulp.dest('js'))
          .pipe(livereload())
    );
  }

function styles() {
  return (
      gulp.src('./scss/**/*.scss')
          .pipe(sourcemap.init())
          .pipe(sass({
            outputStyle: 'compressed'
          }).on('error', sass.logError))
          .pipe(sourcemap.write({includeContent: false}))
          .pipe(sourcemap.init({loadMaps: true}))
          .pipe(autoprefixer({browsers: ['last 2 versions']}))
          .pipe(sourcemap.write('.'))
          .pipe(lec({verbose: true, eolc: 'LF', encoding: 'utf8'}))
          .pipe(gulp.dest('css'))
          .pipe(livereload())
  );
}
function styles_build() {
  return (
      gulp.src('./scss/**/*.scss')
          .pipe(sass({
            outputStyle: 'compressed'
          }).on('error', sass.logError))
          .pipe(autoprefixer({browsers: ['last 2 versions']}))
          .pipe(lec({verbose: true, eolc: 'LF', encoding: 'utf8'}))
          .pipe(gulp.dest('css'))
          .pipe(livereload())
  );
}
  
function watch() {
  livereload.listen();

  gulp.watch('scss/**/*.scss', styles);
  gulp.watch(['js/**/*.js', '!js/wd-script.min.js'], scripts)
}

gulp.task( 'compress-theme', done => {
	gulp.src( [
			`**/*`,
			`!**/node_modules/**`,
			`!**/package-lock.json`
		], { base: '..' }
	).pipe(zip('doors.zip'))
	 .pipe(gulp.dest( '../'))
	 done()
});

gulp.task( 'compress-plugin', done => {
	gulp.src( [
			`wd-main-plugin/**/*`,
		], { cwdbase: true, cwd: '../../plugins' }
	).pipe(zip('wd-main-plugin.zip'))
	 .pipe(gulp.dest( '../'))
	 done()
});

//Task calling 'styles' function
gulp.task('styles', styles);
gulp.task('styles_build', styles_build);
//Task calling 'scripts' function
gulp.task('scripts', scripts);
gulp.task('scripts_build', scripts_build);

//Task for changes tracking
gulp.task('watch', watch);

gulp.task('build', gulp.series( gulp.parallel(styles_build,scripts)) );

//Default task
gulp.task('default', gulp.series('styles', 'scripts', 'watch'));