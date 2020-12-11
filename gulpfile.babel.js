// Gulp packages
import {gulp, src, dest, watch, parallel, series} from 'gulp';

// CSS related packages
import cleanCSS from 'gulp-clean-css';
import sass from 'gulp-sass';
import sourcemaps from 'gulp-sourcemaps';

// Image packages
import imagemin from 'gulp-imagemin';

// Utilities packages
import del from "del";
import gulpif from 'gulp-if';
import yargs from 'yargs';

const PRODUCTION = yargs.argv.prod;

// Load paths
const config = require('./gulp.config.js');

export const clean = () => del(["dist"]);

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
    .pipe(dest(config.imagesDEST));
};

export const watchSource = () => {
  watch('src/assets/scss/**/*.scss', styles);
  watch(config.imagesSRC, series(images))
  watch(config.copySRC, series(copyFiles))
};

export const copyFiles = () => {
  return src(config.copySRC)
    .pipe(dest(config.copyDEST));
};

export const dev = series(
  clean,
  parallel(styles, images, copyFiles),
  watchSource
);

export const build = series(
  clean,
  parallel(styles, images, copyFiles)
)

export default dev;