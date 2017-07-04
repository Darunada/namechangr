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

// I hate this stuff but I want to use it to be cool :(
mix.js('resources/assets/js/app.js', 'public/js');

mix.js('resources/assets/js/pages/states/UT.js', 'public/js');

// mix.scripts([
//     'node_modules/jquery/dist/jquery.js',
//     'node_modules/underscore/underscore.js',
//     'node_modules/bootstrap-sass/assets/javascripts/bootstrap.js',
//     'node_modules/bootbox/bootbox.js',
//     'node_modules/jquery-steps/build/jquery.steps.js'
// ]);

mix.sass('resources/assets/sass/app.scss', 'public/css');


if (mix.inProduction()) {
    mix.version();
} else {
    mix.sourceMaps();
}

