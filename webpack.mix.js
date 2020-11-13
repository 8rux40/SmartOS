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

mix.scripts([
        'node_modules/jquery/dist/jquery.js',
        'node_modules/jquery-mask-plugin/dist/jquery.mask.js',
        'node_modules/bootstrap/dist/js/bootstrap.bundle.js',
        // 'node_modules/sweetalert2/dist/sweetalert2.all.js',
        'node_modules/moment/min/moment-with-locales.min.js',
        // 'node_modules/pdfmake/build/pdfmake.js',
        // 'node_modules/datatables.net/js/jquery.dataTables.js',
        // 'node_modules/datatables.net-bs4/js/dataTables.bootstrap4.js',
        // 'node_modules/datatables.net-buttons/js/dataTables.buttons.js',
        // 'node_modules/datatables.net-buttons-bs4/js/buttons.bootstrap4.js',
        // 'node_modules/datatables.net-colreorder/js/dataTables.colReorder.js',
        // 'node_modules/datatables.net-colreorder-bs4/js/colReorder.bootstrap4.js',
        // 'node_modules/datatables.net-select/js/dataTables.select.js',
        // 'node_modules/datatables.net-select-bs4/js/select.bootstrap4.js',
    ], 'public/js/app.js')
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps();