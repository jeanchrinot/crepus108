const mix = require('laravel-mix');

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

const postCSSPlugins = [
 require('postcss-import'),
 require('postcss-mixins'),
 require('postcss-simple-vars'),
 require('postcss-nested'),
 require('postcss-hexrgba'),
 require('autoprefixer')
]

let cssConfig = {
				test:/\.css$/i,
				use:[
					{
						loader:'postcss-loader',
						options:{
							plugins:postCSSPlugins
						}
					}
				]
			}

mix.js('resources/js/app.js', 'public/js')
	.js('resources/panel/js/app.js', 'public/panel-assets/js')
    .postCss('resources/panel/css/app.css', 'public/panel-assets/css', [
        //
    ])
    .webpackConfig({
        module: {
            rules: [
                cssConfig
            ]
        }
    });
