const { mix } = require('laravel-mix');

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

var versioning = [
    'public/js/app.js',
    'public/js/UT.js',
    'public/css/app.css'
];


// if (mix.inProduction()) {
//     mix.version();
// } else {
//
// }



mix.js('resources/assets/js/app.js', 'public/js')
    .js('resources/assets/js/pages/states/UT.js', 'public/js');


mix.sass('resources/assets/sass/app.scss', 'public/css');



if (mix.config.inProduction) {
    mix.version();
} else {
    mix.sourceMaps()
}



