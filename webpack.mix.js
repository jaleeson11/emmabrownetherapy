let mix = require('laravel-mix');

mix.js('js/app.js', '/').setPublicPath('/');
mix.sass('sass/style.scss', '/').setPublicPath('/');