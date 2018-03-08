const webpack = require('webpack')
const path = require('path')

// Plugins
const ExtractCSSPlugin = require('extract-text-webpack-plugin')
const CleanWebpackPlugin = require('clean-webpack-plugin')
const globImporter = require('node-sass-glob-importer');

module.exports = {
  context: path.resolve(__dirname, 'src'),
  entry: {
    app: './index.js',
  },
  module: {
    rules: [
      {
        test: /\.(css|scss)$/,
        use: ExtractCSSPlugin.extract({
          use: [{
            loader: "css-loader"
          }, {
            loader: "postcss-loader"
          }, {
            loader: "sass-loader",
            options: {
              importer: globImporter(),
              includePaths: [
                "lib/uh_styleguide/sass",
                "node_modules/breakpoint-sass/stylesheets",
                "node_modules/normalize.css"
              ]
            }
          }]
        })
      },
      {
        test: /\.(gif|png|jpe?g)$/i,
        use: [
          'file-loader?name=[path][name].[ext]',
          'image-webpack-loader'
        ]
      },
      {
        test: /\.(svg|woff|woff2|eot|ttf)$/i,
        use: [
          'file-loader?name=[path][name].[ext]'
        ]
      }
    ]
  },
  output: {
    filename: '[name].js',
    path: path.resolve(__dirname, 'dist')
  },
  plugins: [
    // Clean dist folder before building
    new CleanWebpackPlugin(['dist']),

    // Extract CSS to its own file
    new ExtractCSSPlugin({
      filename: '[name].css'
    })
  ]
}
