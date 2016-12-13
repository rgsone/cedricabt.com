const globalConfig = require( './global.config' );

const path = require( 'path' );
const autoprefixer = require( 'autoprefixer' );
const webpack = require( 'webpack' );

for ( let name in globalConfig.entry )
{
	globalConfig.entry[ name ].push( './assets/build/client.js' );
}

module.exports = {

	entry: globalConfig.entry,

	output: {
		path: '/',
		publicPath: 'http://' + globalConfig.host + ':' + globalConfig.port + globalConfig.assetsPublicPath,
		filename: 'js/[name].js'
	},

	module: {
		rules: [

			{
				test: /\.js$/,
				exclude: /node_modules/,
				loader: 'babel-loader'
			},

			{
				test: /\.scss$/,
				loader: [

					'style-loader',

					{
						loader: 'css-loader',
						query: { minimize: false, sourceMap: false, import: true }
					},

					'postcss-loader',

					{
						loader: 'sass-loader',
						query: { outputStyle: 'compact', sourceMap: false }
					}

				]
			},

			{
				test: /\.(png|jpe?g|gif|svg)(\?.*)?$/,
				exclude: /font/,
				loader: 'url-loader',
				query: {
					limit: 500,
					name: 'img/[name]-[hash:6].[ext]'
				}
			},

			{
				test: /\.(svg|woff2?|eot|ttf|otf)(\?.*)?$/,
				exclude: /img/,
				loader: 'url-loader',
				query: {
					limit: 500,
					name: 'font/[name]-[hash:6].[ext]'
				}
			}

		]
	},

	plugins: [
		new webpack.DefinePlugin({
			'process.env.NODE_ENV': JSON.stringify( 'development' )
		}),
		new webpack.HotModuleReplacementPlugin(),
		new webpack.NoErrorsPlugin(),
		new webpack.LoaderOptionsPlugin({
			options: {
				postcss: [
					autoprefixer({ browsers: globalConfig.browsers })
				]
			}
		})
	],
	devtool: false
};
