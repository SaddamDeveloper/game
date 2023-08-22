const mix = require('laravel-mix');

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

mix.js(['resources/js/app.js',
      'public/js/bootstrap.min.js',
      'public/js/instamojo.min.js'
   ], 
   'public/js');

   mix.styles([
      'public/css/custom.css',
      'public/css/responsive.css',
      'public/css/bootstrap.min.css'
  ], 'public/css/app.css')
