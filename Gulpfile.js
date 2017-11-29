var gulp = require('gulp');
var phpspec = require('gulp-phpspec');
var run = require('gulp-run');
var notify = require('gulp-notify');

gulp.task('test', function () {
    gulp.src('spec/**/*.php')
        .pipe(run('clear').exec())
        .pipe(phpspec('', {notify: true, verbose: 'vv'}))
        .on('error', notify.onError({
            title: 'Damn',
            message: 'Your tests failed!',
            icon: __dirname + '/fail.png'

        }))
        .pipe(notify({
            title: 'Success',
            message: 'You\'ve been awarded a star!',
            icon: __dirname + '/success.png'
        }));
});

gulp.task('watch', function () {
    gulp.watch(['spec/**/*.php', 'src/**/*.php'], ['test']);
});

gulp.task('default', ['test', 'watch']);