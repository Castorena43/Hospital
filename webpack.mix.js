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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');

mix.styles(['node_modules/adminbsb-materialdesign/plugins/bootstrap/css/bootstrap.css',
            'node_modules/adminbsb-materialdesign/plugins/node-waves/waves.css',
            'node_modules/adminbsb-materialdesign/plugins/animate-css/animate.css',
            'node_modules/adminbsb-materialdesign/plugins/morrisjs/morris.css',
            'node_modules/adminbsb-materialdesign/css/style.css',
            'node_modules/adminbsb-materialdesign/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css',
            'node_modules/adminbsb-materialdesign/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css',
            'node_modules/adminbsb-materialdesign/plugins/waitme/waitMe.css',
            'node_modules/adminbsb-materialdesign/plugins/bootstrap-select/css/bootstrap-select.css',
            'node_modules/adminbsb-materialdesign/css/themes/all-themes.css'
],'public/css/all.css');

mix.scripts([
    'node_modules/adminbsb-materialdesign/plugins/jquery/jquery.min.js',
    'node_modules/adminbsb-materialdesign/plugins/bootstrap/js/bootstrap.js',
    'node_modules/adminbsb-materialdesign/plugins/bootstrap-select/js/bootstrap-select.js',
    'node_modules/adminbsb-materialdesign/plugins/jquery-slimscroll/jquery.slimscroll.js',
    'node_modules/adminbsb-materialdesign/plugins/node-waves/waves.js',
    'node_modules/adminbsb-materialdesign/plugins/jquery-countto/jquery.countTo.js',
    'node_modules/adminbsb-materialdesign/plugins/raphael/raphael.min.js',
    'node_modules/adminbsb-materialdesign/plugins/morrisjs/morris.js',
    'node_modules/adminbsb-materialdesign/plugins/chartjs/Chart.bundle.js',
    'node_modules/adminbsb-materialdesign/plugins/flot-charts/jquery.flot.js',
    'node_modules/adminbsb-materialdesign/plugins/flot-charts/jquery.flot.resize.js',
    'node_modules/adminbsb-materialdesign/plugins/flot-charts/jquery.flot.pie.js',
    'node_modules/adminbsb-materialdesign/plugins/flot-charts/jquery.flot.categories.js',
    'node_modules/adminbsb-materialdesign/plugins/flot-charts/jquery.flot.time.js',
    'node_modules/adminbsb-materialdesign/plugins/jquery-sparkline/jquery.sparkline.js',
    'node_modules/adminbsb-materialdesign/js/admin.js',
    'node_modules/adminbsb-materialdesign/js/pages/index.js',
    'node_modules/adminbsb-materialdesign/js/pages/forms/basic-form-elements.js',
    'node_modules/adminbsb-materialdesign/plugins/autosize/autosize.js',
    'node_modules/adminbsb-materialdesign/plugins/momentjs/moment.js',
    'node_modules/adminbsb-materialdesign/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js',
    'node_modules/adminbsb-materialdesign/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js',
    'node_modules/adminbsb-materialdesign/js/demo.js'
], 'public/js/all.js');
mix.copyDirectory('node_modules/adminbsb-materialdesign/images/', 'public/images/');
