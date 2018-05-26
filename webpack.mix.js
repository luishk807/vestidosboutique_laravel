let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */


mix.js('resources/assets/js/app.js', 'public/js')
// var directories = {
//     'resources/assets/images': 'public/images/',
//     'resources/assets/js/fullpage': 'public/js/fullpage',
//     'resources/assets/fonts': 'public/fonts',
// }
// for (directory in directories) {
//     mix.copy(directory, directories[directory],false)
// }
.sass('resources/assets/sass/app.scss', 'public/css')
.copy('resources/assets/images/', 'public/images/', false) // Don't flatten!
.copy('resources/assets/js/fullpage', 'public/js/fullpage'); // Don't flatten!
//.copy('resources/assets/fonts/', 'public/fonts/'); // Don't flatten!