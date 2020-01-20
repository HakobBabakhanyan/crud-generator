const mix = require('laravel-mix');
require('mix-tailwindcss');
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
mix.sass('resources/sass/site/app.scss', 'public/css').tailwind('./tailwindcss-config.js');
mix.js('resources/js/site/app.js', 'public/js');
//
// admin
// mix.sass('resources/sass/admin/app.scss', 'hb/css');
// mix.js('resources/js/admin/app.js', 'hb/js');

// mix.copyDirectory('resources/sass/admin/fontawesome-free/webfonts', 'public/fonts/font-awesome');
// mix.copyDirectory('resources/sass/site/font/fonts', 'public/fonts');
