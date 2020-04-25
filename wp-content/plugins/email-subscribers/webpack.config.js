const path                 = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const CopyWebpackPlugin    = require('copy-webpack-plugin');
const ImageminPlugin       = require('imagemin-webpack-plugin').default;
const BrowserSyncPlugin    = require('browser-sync-webpack-plugin');
const PurgeCSS             = require('@fullhuman/postcss-purgecss');
const UglifyJsPlugin       = require("uglifyjs-webpack-plugin");
const isProduction         = 'production' === process.env.NODE_ENV;

// Set the build prefix.
let prefix = isProduction ? '' : '';

// Set the PostCSS Plugins.
const post_css_plugins = [
	require('postcss-import'),
	require('tailwindcss'),
	require('@tailwindcss/ui'),
	require('autoprefixer'),
	require('postcss-nested'),
	require('postcss-custom-properties')
];

// Add PurgeCSS for production builds.
if ( isProduction ) {

	post_css_plugins.push(
		PurgeCSS({
			content: [
				'**/*.php'
			],
			css: [
				'./lite/admin/css/style.css'
			],
			extractors: [
				{
					extractor: class TailwindExtractor {
						static extract(content) {
							return content.match(/[\w-/.:]+(?<!:)/g) || [];
						}
					},
					extensions: ['php', 'js', 'svg', 'css',]
				}
			],
			whitelistPatterns: getCSSWhitelistPatterns()
		})
	);
	post_css_plugins.push(require('cssnano'));

}

const config = {
	entry: './lite/admin/js/main.js',
	optimization: {
		minimizer: [
			new UglifyJsPlugin({
				cache: true,
				parallel: true,
				sourceMap: true
			})
		]
	},
	output: {
		filename: `[name]${prefix}.js`,
		path: path.resolve(__dirname, 'lite/admin/dist')
	},
	mode: process.env.NODE_ENV,
	module: {
		rules: [
			{
				test: /\.js$/,
				loader: 'babel-loader',
				options: {
					presets: [
						[
							"@babel/preset-env"
						]
					]
				}
			},
			{
				test: /\.css$/,
				use: [
					MiniCssExtractPlugin.loader,
					{
						loader: 'css-loader',
						options: {
							importLoaders: 1,
							context: 'postcss',
							sourceMap: ! isProduction
						}
					},
					{
						loader: 'postcss-loader',
						options: {
							ident: 'postcss',
							plugins: post_css_plugins,
						},
					}
				],
			}
		]
	},
	resolve: {
		alias: {
			'@'      : path.resolve('assets'),
			'@images': path.resolve('../images')
		}
	},
	plugins: [
		new MiniCssExtractPlugin({
			filename: `[name]${prefix}.css`,
		}),
		new CopyWebpackPlugin([{
			from: './assets/images/',
			to: 'images',
			ignore: [
				'.DS_Store'
			]
		}]),
		new ImageminPlugin({ test: /\.(jpe?g|png|gif|svg)$/i })
	]
}

// Fire up a local server if requested
if (process.env.SERVER) {
	config.plugins.push(
		new BrowserSyncPlugin(
			{
				proxy: 'http://wpes.stg',
				files: [
					'**/*.php',
					'**/*.scss'
				],
				port: 3000,
				notify: false,
			}
		)
	)
}

/**
 * List of RegExp patterns for PurgeCSS
 * @returns {RegExp[]}
 */
function getCSSWhitelistPatterns() {
	return [
		/^home(-.*)?$/,
		/^blog(-.*)?$/,
		/^archive(-.*)?$/,
		/^date(-.*)?$/,
		/^error404(-.*)?$/,
		/^admin-bar(-.*)?$/,
		/^search(-.*)?$/,
		/^nav(-.*)?$/,
		/^wp(-.*)?$/,
		/^screen(-.*)?$/,
		/^navigation(-.*)?$/,
		/^(.*)-template(-.*)?$/,
		/^(.*)?-?single(-.*)?$/,
		/^postid-(.*)?$/,
		/^post-(.*)?$/,
		/^attachmentid-(.*)?$/,
		/^attachment(-.*)?$/,
		/^page(-.*)?$/,
		/^(post-type-)?archive(-.*)?$/,
		/^author(-.*)?$/,
		/^category(-.*)?$/,
		/^tag(-.*)?$/,
		/^menu(-.*)?$/,
		/^tags(-.*)?$/,
		/^tax-(.*)?$/,
		/^term-(.*)?$/,
		/^date-(.*)?$/,
		/^(.*)?-?paged(-.*)?$/,
		/^depth(-.*)?$/,
		/^children(-.*)?$/,
	];
}

module.exports = config
