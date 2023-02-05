const gulp = require('gulp');
const sass = require('gulp-sass');
const browserSync = require('browser-sync').create();
const autoprefixer = require('gulp-autoprefixer');

// SCSS task
function scss(){
  return gulp.src('scss/**/*.scss')
    .pipe(sass())
    .pipe(autoprefixer({
      overridebrowserslist: [
        "defaults",
        "not IE 11",
        "not IE_Mob 11",
        "maintained node versions",
      ],
      cascade: false
    }))
    .pipe(gulp.dest('css'))
    .pipe(browserSync.stream());
}

function watch(){
    browserSync.init({
        proxy: "newlocal"
    });
    gulp.watch('scss/**/*.scss',gulp.parallel('scss'));
}

gulp.task('scss',scss);
gulp.task('watch',watch);
