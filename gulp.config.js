module.exports = {
  projectURL: "http://localhost:10003",
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
  copyDEST: "dist/assets",
  scriptSRC: [
    "src/assets/js/bundle.js",
    "src/assets/js/admin.js",
    "src/assets/js/customize-preview.js",
  ],
  scriptDEST: "dist/assets/js"
}