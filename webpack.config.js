const webpack = require('webpack');

const path = require('path');

const glob = require('glob');

const ExtractTextPlugin = require('extract-text-webpack-plugin');

const PurifyCSSPlugin = require('purifycss-webpack');

const inProduction = process.env.NODE_ENV === 'production';

module.exports = {
  entry: {
    app: ['./resources/js/luneth.js', './resources/sass/luneth.scss']
  },

  output: {
    path: path.resolve(__dirname, './public/resources/themes/core'),

    filename: 'js/[name].js'
  },
  module: {
    rules: [
      {
        test: /\.s[ac]ss$/,

        use: ExtractTextPlugin.extract({
          use: ['css-loader', 'sass-loader'],

          fallback: 'style-loader'
        })
      },
      {
        test: /\.css$/,

        use: 'css-loader'
      }
    ]
  },
  plugins: [
    new ExtractTextPlugin('css/luneth.css'),

    new PurifyCSSPlugin({
      // Give paths to parse for rules. These should be absolute!
      paths: glob.sync(path.join(__dirname, 'app/views/**/*.blade.php'))
    }),

    new webpack.LoaderOptionsPlugin({
      minimize: inProduction
    })
  ]
};

if (inProduction) {
  module.exports.plugins.push(new webpack.optimize.UglifyJsPlugin());
}
