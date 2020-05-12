const mix = require('laravel-mix');

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


mix
    /* CSS */
    .sass('resources/assets/sass/main.scss', 'public/css/codebase.css')
    .sass('resources/assets/sass/codebase/themes/corporate.scss', 'public/css/themes/')
    .sass('resources/assets/sass/codebase/themes/earth.scss', 'public/css/themes/')
    .sass('resources/assets/sass/codebase/themes/elegance.scss', 'public/css/themes/')
    .sass('resources/assets/sass/codebase/themes/flat.scss', 'public/css/themes/')
    .sass('resources/assets/sass/codebase/themes/pulse.scss', 'public/css/themes/')
    .sass('resources/assets/sass/calendar.all.scss', 'public/css/')

    /* JS */
    .js('resources/assets/js/laravel/app.js', 'public/js/laravel.app.js')
    .js('resources/assets/js/codebase/app.js', 'public/js/codebase.app.js')
    .js('resources/assets/js/codebase/scripts', 'public/js/')

    //pages
    .js('resources/assets/js/laravel/admin/pages/events/index.js', 'public/js/admin/pages/event.app.js')
    .js('resources/assets/js/laravel/admin/pages/alumni/index.js', 'public/js/admin/pages/alumni.app.js')
    .js('resources/assets/js/laravel/admin/pages/forum/index.js', 'public/js/admin/pages/forum.app.js')
    .js('resources/assets/js/laravel/admin/pages/general/index.js', 'public/js/admin/pages/general.app.js')
    .js('resources/assets/js/laravel/admin/pages/offer/index.js', 'public/js/admin/pages/offer.app.js')
    .js('resources/assets/js/laravel/admin/pages/media/index.js', 'public/js/admin/pages/media.app.js')
    .js('resources/assets/js/laravel/calendar/index.js', 'public/js/calendar.app.js')

    /* Tools */
    .disableNotifications()

    /* Options */
    .options({
        processCssUrls: false
    });
