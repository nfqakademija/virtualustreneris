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

gulp.task('jsmin', function() {
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

    gulp.src(dir.assets + 'scripts/Admin/script.js')
        .pipe(uglify())
        .pipe(concat('script.min.js'))
        .pipe(gulp.dest(dir.dist + 'js/Admin'));

    gulp.src(dir.assets + 'scripts/Admin/jquery-2.2.3.min.js')
        .pipe(concat('jquery-2.2.3.min.js'))
        .pipe(gulp.dest(dir.dist + 'js/Admin'));
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

gulp.task('cssmin', function() {
    gulp.src(dir.assets + 'style/jquery.fullPage.css')
        .pipe(cssmin())
        .pipe(concat('jquery.fullPage.min.css'))
        .pipe(gulp.dest(dir.dist + 'css'));

    gulp.src(dir.assets + 'style/fullPage.css')
        .pipe(cssmin())
        .pipe(concat('fullPage.min.css'))
        .pipe(gulp.dest(dir.dist + 'css'));

    gulp.src(dir.assets + 'style/Admin/AdminLTE.css')
        .pipe(cssmin())
        .pipe(concat('AdminLTE.min.css'))
        .pipe(gulp.dest(dir.dist + 'css/Admin'));

    gulp.src(dir.assets + 'style/Admin/skins/skin-blue.css')
        .pipe(cssmin())
        .pipe(concat('skin-blue.min.css'))
        .pipe(gulp.dest(dir.dist + 'css/Admin/skins'));
});

gulp.task('default', ['sass', 'scripts', 'jsmin', 'cssmin', 'fonts', 'images']);
