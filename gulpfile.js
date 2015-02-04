var gulp         = require('gulp');
var stylus       = require('gulp-stylus');
var autoprefixer = require('autoprefixer-stylus');
var axis         = require('axis');

gulp.task('stylus', function ()
{
  var src = './styl/main.styl';
  var dest = './public/assets/css';
  var stylusSettings = {
    use: [axis(),autoprefixer()]
  };

  return gulp.src(src)
    .pipe(stylus(stylusSettings))
    .pipe(gulp.dest(dest));
});
