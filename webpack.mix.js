let mix = require("laravel-mix");
let path = require("path");
require("./nova.mix");

mix
  .setPublicPath("dist")
  .js("resources/js/field.js", "js")
  .postCss("resources/sass/field.css", "dist/css", [
    require("tailwindcss"),
  ])
  .vue({ version: 3 })
  .nova("hnassr/nova-key-value");
  

mix.alias({
  "laravel-nova": path.join(
    __dirname,
    "vendor/laravel/nova/resources/js/mixins/packages.js"
  ),
});
