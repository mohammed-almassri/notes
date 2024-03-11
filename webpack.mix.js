let mix = require('laravel-mix');
const path = require('path');

mix.js('resources/js/app.js', 'public/js')
    .webpackConfig({
        output: {
            chunkFilename: 'js/chunks/[name].js',
        },
        resolve: {
            alias: {
                '@': path.resolve(__dirname, 'resources/js/src'),
                '@fonts': path.resolve(__dirname, 'resources/fonts'),
            },
        }
    })
    .vue()
    .sass('resources/sass/style.scss', 'public/css')
    .disableNotifications();