const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss'); /* Add this line at the top */

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

 mix.js('src/js/app.js', 'docs/assets/js')
    .sass('src/sass/app.scss', 'docs/assets/css')
    .options({
        postCss: [ tailwindcss('./tailwind.config.js') ],
    });

if (mix.inProduction()) {
    mix.version();
}
