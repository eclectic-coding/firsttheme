// Gulp packages
import {gulp, src, dest, watch, parallel, series} from 'gulp';

// CSS related packages
import cleanCSS from 'gulp-clean-css';
import sass from 'gulp-sass';
import sourcemaps from 'gulp-sourcemaps';

// Image packages
import imagemin from 'gulp-imagemin';

// Utilities
import gulpif from 'gulp-if';
import yargs from 'yargs';

const PRODUCTION = yargs.argv.prod;

// Load paths
const config = require('./gulp.config.js')

export const styles = () => {
  return src(config.styleSRC)
    .pipe(gulpif(!PRODUCTION, sourcemaps.init()))
    .pipe(sass({
        errLogToConsole: true,
        outputStyle: "expanded",
        sourceComments: true
      })
    )
    .on("error", sass.logError)
    .pipe(gulpif(PRODUCTION, cleanCSS()))
    .pipe(gulpif(!PRODUCTION, sourcemaps.write()))
    .pipe(dest(config.styleDEST));
};

export const images = () => {
  return src(config.imagesSRC)
    .pipe(gulpif(PRODUCTION, imagemin()))
    .pipe(dest(config.imagesDEST))
};

export const watching = () => {
  watch('src/assets/scss/**/*.scss', styles);
};

export const copyFiles = () => {
  return src(config.otherSRC)
    .pipe(dest(config.otherDEST));
}

export const dev = series(
  parallel(styles, images),
  watching
);

export default dev;