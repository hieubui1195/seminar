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
   .js('resources/assets/js/script.js', 'public/js/script.js')
   .js('resources/assets/js/seminar.js', 'public/js/seminar.js')
   .js('resources/assets/js/user.js', 'public/js/user.js')
   .js('resources/assets/js/sidebarmenu.js', 'public/js/sidebarmenu.js')
   .js('resources/assets/js/custom.min.js', 'public/js/custom.min.js')
   .js('resources/assets/js/editor.js', 'public/js/editor.js')
   .js('resources/assets/js/saveEditor.js', 'public/js/saveEditor.js')
   .sass('resources/assets/sass/app.scss', 'public/css')
   .styles('resources/assets/css/style.css', 'public/css/style.css')
   .styles('resources/assets/css/main.css', 'public/css/main.css')
   .styles('resources/assets/css/default.css', 'public/css/default.css')
   .copyDirectory('resources/assets/bower', 'public/bower');
