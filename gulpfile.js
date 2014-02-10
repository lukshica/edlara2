var gulp = require('gulp');
var gutil = require('gulp-util');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var header = require('gulp-header');
var ngmin = require('gulp-ngmin');
var less = require('gulp-less');
var cssmin = require('gulp-cssmin');
var sass = require('gulp-sass');
var imagemin = require('gulp-imagemin');
var flatten = require('gulp-flatten');
var watch =require('gulp-watch');
var plumber = require('gulp-plumber');

var pkg = require('./package.json');
var banner = ['/**',
  ' * <%= pkg.name %> - <%= pkg.description %>',
  ' * @version v<%= pkg.version %>',
  ' * @link <%= pkg.homepage %>',
  ' * @license <%= pkg.license %>',
  ' */',
  ''].join('\n');

var paths = {
    scripts:{
        backend:[
           './app/assets/js/dependencies/jquery-2.0.3.js',
           './vendor/twbs/bootstrap/js/tooltip.js',
           './vendor/twbs/bootstrap/js/*.js',
           './app/assets/js/backend/**/*.js',
           '!./app/assets/js/backend/ng/**/*.js',
           ],
        frontend:[
           './app/assets/js/dependencies/jquery-2.0.3.js',
           './vendor/twbs/bootstrap/js/tooltip.js',
           './vendor/twbs/bootstrap/js/*.js',
           './app/assets/js/frontend/**/*.js',
           '!./app/assets/js/frontend/ng/**/*.js',
           ],
        ng_backend:[
           './app/assets/js/backend/ng/**/*.js',
           './app/assets/js/backend/ng/**/*.js',
           ],
        ng_frontend:[
           './app/assets/js/frontend/ng/**/*.js',
           ]
    },
    styles:{
        frontend:[
             './app/assets/scss/frontend/main.scss',
             './app/assets/less/frontend/main.less',
             './app/assets/css/frontend/**/*.css',
             ],
        backend:[
             './app/assets/scss/backend/main.scss',
             './app/assets/less/backend/main.less',
             './app/assets/css/backend/**/*.css',
             ]
    },
    fonts:[
         './vendor/twbs/bootstrap/dist/fonts/*.{ttf,woff,eot,svg}'
        ]
};


gulp.task('scripts', function() {
    gulp.src(paths.scripts.backend)
        .pipe(concat("script.min.js"))
        .pipe(uglify())
        .pipe(header(banner, { pkg : pkg } ))
        .pipe(gulp.dest('./public/builds/backend/'))
    gulp.src(paths.scripts.frontend)
        .pipe(concat("script.min.js"))
        .pipe(uglify())
        .pipe(header(banner, { pkg : pkg } ))
        .pipe(gulp.dest('./public/builds/frontend/'))
    gulp.src(paths.scripts.ng_backend)
        .pipe(ngmin())
        .pipe(header(banner, { pkg : pkg } ))
        .pipe(gulp.dest('./public/builds/backend/'))
    gulp.src(paths.scripts.ng_frontend)
        .pipe(ngmin())
        .pipe(header(banner, { pkg : pkg } ))
        .pipe(gulp.dest('./public/builds/frontend/'))
});
gulp.task('styles',function(){
    gulp.src(paths.styles.frontend)
       .pipe(less())
       .pipe(sass())
       .pipe(concat("style.min.css"))
       .pipe(cssmin({keepSpecialComments:0  }))
       .pipe(header(banner, { pkg : pkg } ))
       .pipe(gulp.dest('./public/builds/frontend'));

    gulp.src(paths.styles.backend)
       .pipe(less())
       .pipe(sass())
       .pipe(concat("style.min.css"))
       .pipe(cssmin({keepSpecialComments:0  }))
       .pipe(header(banner, { pkg : pkg } ))
       .pipe(gulp.dest('./public/builds/backend'));

    gulp.src(paths.fonts)
        .pipe(flatten())
        .pipe(gulp.dest('./public/builds/fonts'));
});

gulp.task('watch',function(){
    gulp.watch([paths.scripts.backend,
               paths.scripts.frontend,
               paths.scripts.ng_frontend,
               paths.scripts.ng_backend],['scripts']);
    gulp.watch([paths.styles.backend,
               paths.styles.frontend],['styles']);

});
gulp.task('default',['styles','scripts','watch']);

// gulp.watch()