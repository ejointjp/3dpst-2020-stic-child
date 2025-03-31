const CompressionPlugin = require('compression-webpack-plugin');
const DependencyExtractionWebpackPlugin = require('@wordpress/dependency-extraction-webpack-plugin');
const FixStyleOnlyEntriesPlugin = require('webpack-fix-style-only-entries');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const OptimizeCSSAssetsWebpackPlugin = require('optimize-css-assets-webpack-plugin');
const TerserWebpackPlugin = require('terser-webpack-plugin');
const path = require('path');
const zopfli = require('node-zopfli');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');

// // For PostCSS
// const sortCssMediaQueries = require( 'sort-css-media-queries' );

// For img-loader
const imageminGifsicle = require('imagemin-gifsicle');
const imageminMozjpeg = require('imagemin-mozjpeg');
const imageminPngquant = require('imagemin-pngquant');
const imageminSvgo = require('imagemin-svgo');

// For Vue
const VueLoaderPlugin = require('vue-loader/lib/plugin');

module.exports = (env, argv) => {
	// モードによって development か production を返す
	function isDevelopment() {
		return argv.mode === 'development';
	}

	// productのときだけ適用するプラグイン
	const productPlugins = [
		// gZip圧縮 不要なら削除でOK
		new CompressionPlugin({
			test: /\.(css|js)$/,
			algorithm: (content, options, cb) => {
				zopfli.gzip(content, options, cb);
			},
		}),
	];

	const config = {
		resolve: {
			// aliasを追加 Vueの完全版
			alias: {
				vue$: 'vue/dist/vue.esm.js',
			},
			extensions: ['*', '.js', '.vue', '.json'],
		},

		entry: {
			'editor-script': path.resolve(__dirname, 'src', 'js', 'editor-script.js'),
			script: path.resolve(__dirname, 'src', 'js', 'script.js'),
			'material-library': path.resolve(__dirname, 'src', 'js', 'material-library.js'),
			'material-single': path.resolve(__dirname, 'src', 'js', 'material-single.js'),
			'editor-style': path.resolve(__dirname, 'src', 'stylus', 'editor-style.styl'),
			style: path.resolve(__dirname, 'src', 'stylus', 'style.styl'),
		},

		output: {
			filename: '[name].js',
			path: path.resolve(__dirname, 'public', 'assets'),
		},

		optimization: {
			minimizer: [
				// JavaScriptを圧縮する
				new TerserWebpackPlugin({
					// sourceMapをmodeによって削除する
					sourceMap: isDevelopment(),
				}),
				// CSSを圧縮する
				new OptimizeCSSAssetsWebpackPlugin({
					cssProcessorOptions: {
						map: {
							inline: false,
							annotation: true,
						},
					},
				}),
			],
		},

		plugins: [
			// ビルドの度にビルドフォルダーを削除する
			new CleanWebpackPlugin({
				dry: false,
				cleanAfterEveryBuildPatterns: ['*', '!images', '!images/**/*'],
			}),

			// assets.phpファイルを出力する
			new DependencyExtractionWebpackPlugin(),

			// CSSをentryに指定したとき同名の不要なjsが出力されないようにする
			new FixStyleOnlyEntriesPlugin({
				extensions: ['styl', 'css'],
			}),

			// CSSファイルを別ファイルで出力する
			new MiniCssExtractPlugin({
				filename: '[name].css',
			}),

			new VueLoaderPlugin(),
		],

		devtool: 'source-map',

		module: {
			rules: [
				{
					test: /\.js$/,
					exclude: /node_modules/,
					use: {
						loader: 'babel-loader',
						options: {
							presets: [
								'@babel/preset-env',
								[
									'@babel/preset-react',
									{
										// 通常は'React.createElement.xxxx'を記述しますが、WordPressのブロックエディターはWordPress用のReactを使用するため、以下のように記述します
										pragma: 'wp.element.createElement',
										pragmaFrag: 'wp.element.Fragment',
										development: isDevelopment(),
									},
								],
							],
						},
					},
				},
				{
					test: /\.(styl|css)$/,
					use: [
						{
							loader: MiniCssExtractPlugin.loader,
						},
						{
							loader: 'css-loader',
						},
						{
							loader: 'postcss-loader',
						},
						{
							loader: 'resolve-url-loader',
						},
						{
							loader: 'stylus-loader',
							options: {
								'include css': true,
							},
						},
					],
				},
				{
					// test: /\.(jpe?g|png|gif|svg)$/,
					test: /\.(jpe?g|png|gif|svg|ico)(\?.+)?$/,
					use: [
						{
							loader: 'url-loader',
							options: {
								limit: 8192,
								name: path.join('images', '[name].[ext]'),
							},
						},
						{
							loader: 'img-loader',
							options: {
								plugins: [
									imageminGifsicle({
										interlaced: false,
									}),
									imageminMozjpeg({
										quality: 80,
										progressive: true,
									}),
									imageminPngquant({
										dithering: 0.5,
										speed: 2,
									}),
									imageminSvgo({
										plugins: [{ removeTitle: true }, { convertPathData: false }],
									}),
								],
							},
						},
					],
				},
				{
					// test: /\.(ttf|otf|eot|woff(2)?)(\?[a-z0-9]+)?$/,
					test: /\.(eot|otf|ttf|woff2?|svg)(\?.+)?$/,
					use: [
						{
							loader: 'file-loader',
							options: {
								name: path.join('[name].[ext]'),
								outputPath: 'images',
							},
						},
					],
				},
				{
					test: /\.vue$/,
					use: [
						{
							loader: 'vue-loader',
						},
					],
				},
			],
		},
	};

	// productのときだけ適用するプラグイン
	if (!isDevelopment()) {
		config.plugins = config.plugins.concat(productPlugins);
	}

	return config;
};
