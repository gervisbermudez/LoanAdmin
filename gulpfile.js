'use strict';
var gulp = require("gulp");
var autoprefixer = require('gulp-autoprefixer');
var csso = require('gulp-csso');
var del = require('del');
var gulp = require('gulp');
var htmlmin = require('gulp-htmlmin');
var runSequence = require('run-sequence');
var sass = require('gulp-sass');
var uglify = require('gulp-uglify');
var rename = require("gulp-rename");

// Set the browser that you want to support
const AUTOPREFIXER_BROWSERS = [
	'ie >= 10',
	'ie_mob >= 10',
	'ff >= 30',
	'chrome >= 34',
	'safari >= 7',
	'opera >= 23',
	'ios >= 7',
	'android >= 4.4',
	'bb >= 10'
  ];

// Gulp task to minify CSS files
gulp.task('styles', function () {
	return gulp.src('./resources/scss/**.scss')
	  // Compile SASS files
	  .pipe(sass({
		outputStyle: 'nested',
		precision: 10,
		includePaths: ['.'],
		onError: console.error.bind(console, 'Sass error:')
	  }))
	  // Auto-prefix css styles for cross browser compatibility
	  .pipe(autoprefixer({browsers: AUTOPREFIXER_BROWSERS}))
	  // Minify the file
	  .pipe(csso())
	  .pipe(rename({ suffix: '.min' }))
	  // Output
	  .pipe(gulp.dest('./public/css'))
  });
