const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .css('resources/css/admin-dashboard.css', 'public/css')
    .copyDirectory('resources/js/admin-dashboard.js', 'public/js')
    .version();
