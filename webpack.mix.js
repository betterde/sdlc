const path = require('path');
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

// mix.webpackConfig({
// 	output: {
// 		publicPath: "/",
// 		// chunkFilename: 'js/chunks/[name].[chunkhash].js',
// 		chunkFilename: 'js/chunks/[name].js'
// 	},
// 	resolve: {
// 		alias: {
// 			'components': 'assets/js/components',
// 			'config': 'assets/js/config',
// 			'lang': 'assets/js/lang',
// 			'plugins': 'assets/js/plugins',
// 			'vendor': 'assets/js/vendor',
// 			'views': 'assets/js/views',
// 			'dashboard': 'assets/js/views/dashboard',
// 		},
// 		modules: [
// 			'node_modules',
// 			path.resolve(__dirname, "resources")
// 		]
// 	},
// });

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');

mix.disableNotifications();
