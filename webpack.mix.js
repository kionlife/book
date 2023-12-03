const mix = require('laravel-mix');
const {resolve} = require("path");

mix.js('resources/js/app.js', 'public/js')
    .vue()
    .postCss('resources/css/app.css', 'public/css', [])
    .webpackConfig({
        resolve: {
            alias: {
                '@': resolve('resources/js'),
            },
        },
    }).autoload({
    'pusher-js': ['Pusher']});
