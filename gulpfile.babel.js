// Gulp packages
import {gulp, src, dest, watch, parallel, series} from 'gulp';

// CSS related packages
import cleanCSS from 'gulp-clean-css';
import sass from 'gulp-sass';
import sourcemaps from 'gulp-sourcemaps';

// Image packages
import imagemin from 'gulp-imagemin';

// JS related packages
import webpack from 'webpack-stream';

// Utilities packages
import del from "del";
import gulpif from 'gulp-if';
import named from "vinyl-named";
import yargs from 'yargs';
import lineec from 'gulp-line-ending-corrector';

// Browsersync
import browserSync from "browser-sync";

const server = browserSync.create();
const PRODUCTION = yargs.argv.prod;

// Load paths
const config = require('./gulp.config.js');

export const serve = (done) => {
  server.init({
    proxy: config.projectURL
  });
  done();
};

export const reload = (done) => {
  server.reload();
  done();
};

export const clean = () => del(["dist"]);

export const styles = () => {
  return src(config.styleSRC, {allowEmpty: true})
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
    .pipe(dest(config.styleDEST))
    .pipe(server.stream());
};

export const scripts = () => {
  return src(config.scriptSRC, {allowEmpty: true})
    .pipe(named())
    .pipe(webpack({
      module: {
        rules: [
          {
            test: /\.js$/,
            use: {
              loader: "babel-loader",
              options: {presets: ["@babel/preset-env"]}
            }
          }
        ]
      },
      output: {filename: "[name].js"},
      externals: {jquery: "jQuery"},
      devtool: !PRODUCTION ? "inline-source-map" : false,
      mode: PRODUCTION ? 'production' : 'development'
    }))
    .pipe(gulpif(PRODUCTION, lineec()))
    .pipe(dest(config.scriptDEST));
};

export const images = () => {
  return src(config.imagesSRC)
    .pipe(gulpif(PRODUCTION, imagemin([
      imagemin.gifsicle({ interlaced: true }),
      imagemin.mozjpeg({ quality: 90, progressive: true}),
      imagemin.optipng({ optimizationLevel: 3 }),
      imagemin.svgo({
        plugins: [{removeViewBox: true}, {cleanupIDs: false}]
      })
    ])))
    .pipe(dest(config.imagesDEST));
};

export const watchSource = () => {
  watch('src/assets/scss/**/*.scss', styles);
  watch(config.scriptSRC, series(scripts, reload));
  watch("**/*.php", reload)
  watch(config.imagesSRC, series(images, reload));
  watch(config.copySRC, series(copyFiles, reload));
};

export const copyFiles = () => {
  return src(config.copySRC)
    .pipe(dest(config.copyDEST));
};

export const dev = series(
  clean,
  parallel(styles, scripts, images, copyFiles),
  serve,
  watchSource
);

export const build = series(
  clean,
  parallel(styles, scripts, images, copyFiles)
);

export default dev;