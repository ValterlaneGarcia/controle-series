const mix = require('laravel-mix');

mix.js('public/js/app.js', 'public/js')
   .sass('resources/css/app.scss', 'public/css');


