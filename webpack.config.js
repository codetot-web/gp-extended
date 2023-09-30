const path = require('path')
const MiniCssExtractPlugin = require('mini-css-extract-plugin')
const StyleLintPlugin = require('stylelint-webpack-plugin')
const postcssPresetEnv = require('postcss-preset-env')
const CssMinimizerPlugin = require("css-minimizer-webpack-plugin")
const devMode = process.env.NODE_ENV !== 'production'

module.exports = {
	entry: {
		frontend: path.resolve(process.cwd(), "./src/frontend.js"),
	},
	output: {
		path: path.resolve(__dirname, "assets"),
		filename: !devMode ? "./js/[name].min.js" : "./js/[name].js",
		clean: true,
	},
	watch: devMode,
	devtool: "eval-cheap-source-map",
	resolve: {
		alias: {
			lib: path.resolve(process.cwd(), "./src/js/lib/"),
		},
		extensions: [".js"],
	},
	module: {
		rules: [
			{
				test: /\.(?:js|mjs|cjs)$/,
				exclude: /node_modules/,
				use: {
					loader: "babel-loader",
					options: {
						presets: [["@babel/preset-env", { targets: "defaults" }]]
					},
				},
			},
			{
				test: /\.(p|c)ss$/,
				use: [
					devMode ? "style-loader" : MiniCssExtractPlugin.loader,
					devMode
						? {
								loader: "css-loader",
								options: {
									sourceMap: true,
								},
						  }
						: "css-loader",
					{
						loader: "postcss-loader",
						options: {
							postcssOptions: {
								plugins: [
									require("autoprefixer"),
									require("postcss-import"),
									postcssPresetEnv({
										importFrom: path.join(
											__dirname,
											"src/postcss/variables.css"
										),
										exportTo: "variables.css",
										stage: 1,
										features: {
											"custom-media-queries": true,
											"nesting-rules": true,
										},
									})
								],
							},
						},
					}
				],
			},
		],
	},
	plugins: [
		new MiniCssExtractPlugin({
			filename: devMode ? "./css/[name].css" : "./css/[name].min.css",
		}),
		// Lint CSS.
		new StyleLintPlugin({
			context: path.resolve(process.cwd(), "./src/postcss/"),
			files: "**/*.css",
		}),
	],
	externals: {
		jQuery: "jQuery",
	},
	optimization: {
		minimizer: [
		  new CssMinimizerPlugin(),
		],
	}
};
