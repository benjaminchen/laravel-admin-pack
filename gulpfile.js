var gulp = require('gulp'),
    uglify = require('gulp-uglify'),
    rename = require('gulp-rename'),
    concat = require('gulp-concat'),
    header = require('gulp-header'),
    pkg = require('./package.json'),
    cleanCSS = require('gulp-clean-css'),
    watch = require('gulp-watch'),
    exec = require('child_process').exec;

gulp.task('scripts', function() {
    gulp.src([
            'bower_components/jquery/dist/jquery.js', // if you need jquery, use "npm i -g bower" and "bower install jquery"
            'bower_components/bootstrap-fileinput/js/fileinput.js',
            'bower_components/bootstrap/dist/js/bootstrap.js', // if you need bootstrap, use "npm i -g bower" and "bower install bootstrap"
            'bower_components/bootstrap-fileinput/themes/fa/theme.js',
            'bower_components/summernote/dist/summernote.js',
            'resources/js/*.js',
        ])
        .pipe(concat('admin-pack.js')) // cancatenation to file myproject.js
        .pipe(uglify()) // uglifying this file
        .pipe(rename({ suffix: '.min' })) // renaming file to myproject.min.js
        .pipe(header('/*! <%= pkg.name %> <%= pkg.version %> */\n', { pkg: pkg })) // banner with version and name of package
        .pipe(gulp.dest('./public/js/')) // save file to destination directory
        .on('end', function() {
            exec('cp public/js/admin-pack.min.js ../../../public/vendor/adminPack/js/', (error, stdout, stderr) => {
                if (error) {
                    console.error(`exec error: ${error}`);
                    return;
                } else {
                    console.log('cp js success');
                }
            })
        }) // replace laravel public js file
});

gulp.task('styles', function() {
    gulp.src([
            'bower_components/bootstrap/dist/css/bootstrap.css', // example with installed bootstrap package
            'bower_components/bootstrap/dist/css/bootstrap-theme.css', // example with installed bootstrap package
            'bower_components/bootstrap-fileinput/css/fileinput.css',
            'bower_components/summernote/dist/summernote.css',
            'resources/css/*.css',
        ])
        .pipe(concat('admin-pack.css')) // concatenation to file myproject.css
        .pipe(cleanCSS()) // minifying file
        .pipe(rename({ suffix: '.min' })) // renaming file to myproject.min.css
        .pipe(header('/*! <%= pkg.name %> <%= pkg.version %> */\n', { pkg: pkg })) // making banner with version and name of package
        .pipe(gulp.dest('./public/css/')) // saving file myproject.min.css to this directory
        .on('end', function() {
            exec('cp public/css/admin-pack.min.css ../../../public/vendor/adminPack/css/', (error, stdout, stderr) => {
                if (error) {
                    console.error(`exec error: ${error}`);
                    return;
                } else {
                    console.log('cp css success');
                }
            })
        }) // replace laravel public css file
});

gulp.task('watcher', function() {
    watch('resources/js/*.js', function() {
        gulp.start('scripts');
        console.log('compile js start ...');
    });
    watch('resources/css/*.css', function() {
        gulp.start('styles');
        console.log('compile css start ...');
    });
});

gulp.task('default', ['scripts', 'styles']); // start default tasks "gulp"
gulp.task('watch', ['watcher']); // start watcher task "gulp watch"