const mix = require('laravel-mix');

mix.sass('resources/sass/alerts.scss', 'public/css')
   .js('resources/js/app.js', 'public/js');

mix.copy('node_modules/@fortawesome/fontawesome-free/css/all.min.css', 'public/css/fontawesome.min.css');
mix.copy('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/webfonts');
   