const mix = require("laravel-mix");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js("resources/js/vue/main.js", "public/js/vue.js")
    .vue()
    .sass("resources/scss/style.scss", "public/css/customs.css")
    .postCss("resources/css/app.css", "public/css", [])
    .version();
