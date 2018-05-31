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
   .js('resources/assets/js/seminar-index.js', 'public/js/seminar-index.js')
   .js('resources/assets/js/nivo-lightbox.js', 'public/js/nivo-lightbox.js')
   .js('resources/assets/js/bootstrap.min.js', 'public/js/bootstrap.min.js')
   .js('resources/assets/js/main.js', 'public/js/main.js')
   .js('resources/assets/js/contact_me.js', 'public/js/contact_me.js')
   .js('resources/assets/js/jqBootstrapValidation.js', 'public/js/jqBootstrapValidation.js')
   .js('resources/assets/js/listen-call-noty.js', 'public/js/listen-call-noty.js')
   .js('resources/assets/js/call.js', 'public/js/call.js')
   .js('resources/assets/js/search.js', 'public/js/search.js')
   .js('resources/assets/js/notification.js', 'public/js/notification.js')
   .sass('resources/assets/sass/app.scss', 'public/css')
   .styles('resources/assets/css/style.css', 'public/css/style.css')
   .styles('resources/assets/css/main.css', 'public/css/main.css')
   .styles('resources/assets/css/default.css', 'public/css/default.css')
   .styles('resources/assets/css/welcome.css', 'public/css/welcome.css')
   .styles('resources/assets/css/nivo-lightbox.css', 'public/css/nivo-lightbox.css')
   .styles('resources/assets/css/bootstrap.css', 'public/css/bootstrap.css')
   .styles('resources/assets/css/video.css', 'public/css/video.css')
   .styles('resources/assets/css/search.css', 'public/css/search.css')
   .styles('resources/assets/css/form.css', 'public/css/form.css')
   .copyDirectory('resources/assets/bower', 'public/bower')
   .copyDirectory('resources/assets/images', 'public/images');
