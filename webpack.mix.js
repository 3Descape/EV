const mix = require('laravel-mix');
require('laravel-mix-purgecss');
const path = require('path');

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

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/admin.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/admin.scss', 'public/css')
    .purgeCss({
        enabled: true,
        safelist: {
            standard: ['blockquote', 'text-start', 'text-center', 'text-end', 'img-fluid'],
            deep: [/form-control/, /cropper.*$/],
            greedy: [/file-selector-button/]
        },
    })
   .alias({
      'ziggy': path.join(__dirname, 'vendor/tightenco/ziggy/dist/vue')
    })
    .vue()
    .version()
    .sourceMaps();