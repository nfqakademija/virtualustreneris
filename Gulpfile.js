'use strict';

var gulp    = require('gulp');
var sass    = require('gulp-sass');
var concat  = require('gulp-concat');
var uglify  = require('gulp-uglify');
var cssmin  = require('gulp-cssmin');

var dir = {
    assets: './src/AppBundle/Resources/',
    dist: './web/',
    npm: './node_modules/',
};

gulp.task('sass', function() {
    gulp.src(dir.assets + 'style/main.scss')
        .pipe(sass({ outputStyle: 'compressed' }).on('error', sass.logError))
        .pipe(concat('style.css'))
        .pipe(gulp.dest(dir.dist + 'css'));
});

gulp.task('scripts', function() {
    gulp.src([
            //Third party assets
            dir.npm + 'jquery/dist/jquery.min.js',
            dir.npm + 'bootstrap-sass/assets/javascripts/bootstrap.min.js',

            // Main JS file
            dir.assets + 'scripts/main.js'
        ])
        .pipe(concat('script.js'))
        .pipe(uglify())
        .pipe(gulp.dest(dir.dist + 'js'));
});

gulp.task('jsminFullPage', function() {
    gulp.src(dir.assets + 'scripts/jquery.fullPage.js')
        .pipe(uglify())
        .pipe(concat('jquery.fullPage.min.js'))
        .pipe(gulp.dest(dir.dist + 'js'));

    gulp.src(dir.assets + 'scripts/fullPage.js')
        .pipe(uglify())
        .pipe(concat('fullPage.min.js'))
        .pipe(gulp.dest(dir.dist + 'js'));

    gulp.src(dir.assets + 'scripts/jquery-3.2.0.js')
        .pipe(uglify())
        .pipe(concat('jquery-3.2.0.min.js'))
        .pipe(gulp.dest(dir.dist + 'js'));
});

gulp.task('images', function() {
    gulp.src([
            dir.assets + 'images/**'
        ])
        .pipe(gulp.dest(dir.dist + 'images'));
});

gulp.task('fonts', function() {
    gulp.src([
        dir.npm + 'bootstrap-sass/assets/fonts/**',
        dir.assets + 'fonts/**'
        ])
        .pipe(gulp.dest(dir.dist + 'fonts'));
});

gulp.task('cssminFullPage', function() {
    gulp.src(dir.assets + 'style/jquery.fullPage.css')
        .pipe(cssmin())
        .pipe(concat('jquery.fullPage.min.css'))
        .pipe(gulp.dest(dir.dist + 'css'));

    gulp.src(dir.assets + 'style/fullPage.css')
        .pipe(cssmin())
        .pipe(concat('fullPage.min.css'))
        .pipe(gulp.dest(dir.dist + 'css'));
});

gulp.task('default', ['sass', 'scripts', 'jsminFullPage', 'cssminFullPage', 'fonts', 'images']);
