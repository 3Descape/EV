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
 .js('resources/assets/js/admin.js', 'public/js')
 .sass('resources/assets/sass/app.scss', 'public/css')
 .sass('resources/assets/sass/admin.scss', 'public/css')
 .sass('resources/assets/sass/login.scss', 'public/css')

 .copy('node_modules/moment/locale/de.js', 'public/js')
 .copy('node_modules/moment/min/moment.min.js', 'public/js')

 .copy('node_modules/tempusdominus-bootstrap-4/build/js/tempusdominus-bootstrap-4.min.js', 'public/js')
 .copy('node_modules/tempusdominus-bootstrap-4/build/css/tempusdominus-bootstrap-4.min.css', 'public/css')

 .copy('node_modules/dropzone/dist/dropzone.js', 'public/js/dropzone.js')
 .copy('node_modules/dropzone/dist/min/dropzone.min.css', 'public/css/dropzone.min.css')
 // .options({
 //     purifyCss: {
 //            purifyOptions: {
 //                purifyCss: false,
 //                whitelist: ['collapsing', 'callapse', 'show', 'collapsed', 'fa', '*fa*', 'blockquote']
 //        },
 //    }
 // });
