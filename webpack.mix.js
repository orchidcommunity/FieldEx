//let mix = require('laravel-mix');
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

mix.setPublicPath('public'); 

const vendor = [
    'stimulus', 'turbolinks', 'stimulus/webpack-helpers',
    'jquery', 'popper.js', 'bootstrap',
];
 
mix
	.js('resources/js/fieldex.js', 'js')
    //.extract(vendor)
    .sass('resources/sass/fieldex.scss', 'css');
    //.browserSync('shira-tur.ru');
    //.copyDirectory('./node_modules/monaco-editor/min', 'public/js/min');
   
