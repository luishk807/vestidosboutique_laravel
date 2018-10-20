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


mix
.scripts([
    'resources/assets/js/vestidos.js'
], 'public/js/vestidos.js')
.sass('resources/assets/sass/app.scss', 'public/css')
.sass('resources/assets/sass/app_admin.scss', 'public/css')
.copy('resources/assets/images/', 'public/images/', false) // Don't flatten!
.copy('resources/assets/js/vendor/fullpage', 'public/js/vendor/fullpage') // Don't flatten!
.copy('resources/assets/js/vendor/rater', 'public/js/vendor/rater')
.copy('resources/assets/js/vestidos_admin.js', 'public/js/vestidos_admin.js')
.copy('resources/assets/js/vendor/jquery/jquery-3.2.1.min.js', 'public/js/vendor/jquery/jquery-3.2.1.min.js')
.copy('resources/assets/js/vendor/jquery/popper.min.js', 'public/js/vendor/jquery/popper.min.js')
.copy('resources/assets/js/vendor/slick', 'public/js/vendor/slick')
.copy('resources/assets/js/bootstrap.min.js', 'public/js/bootstrap.min.js');
//.copy('resources/assets/fonts/', 'public/fonts/'); // Don't flatten!