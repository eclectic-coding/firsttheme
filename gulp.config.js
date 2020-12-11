module.exports = {
  styleSRC: [
    "src/assets/scss/bundle.scss",
    "src/assets/scss/admin.scss",
    "src/assets/scss/editor.scss"
  ],
  styleDEST: 'dist/assets/css',
  imagesSRC: "src/assets/images/**/*.{jpg,jpeg,png,svg,gif}",
  imagesDEST: "dist/assets/images",
  copySRC: [
    "src/assets/**/*",
    "!src/assets/{images,js,scss}",
    "!src/assets/{images,js,scss}/**/*"
  ],
  copyDEST: "dist/assets"
}