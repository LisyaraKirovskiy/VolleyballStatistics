const mix = require('laravel-mix');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .webpackConfig({
       plugins: [
           new BrowserSyncPlugin({
               proxy: '127.0.0.1:8000', // или ваш домен (например, laravel.test)
               files: [
                   'app/**/*.php',
                   'resources/views/**/*.php',
                   'public/js/**/*.js',
                   'public/css/**/*.css'
               ],
               browser: 'chrome', // или 'firefox', или можно опустить для браузера по умолчанию
               notify: false,
               open: false // не открывать автоматически новый окно
           })
       ]
   });