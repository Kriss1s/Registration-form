const path = require('path');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

module.exports = {
    entry: path.resolve(__dirname, './src/index.js'),
    module: {
      rules: [
        
        {
          test: /\.(scss|css)$/,
          include: path.resolve(__dirname, 'src'),
          use: [MiniCssExtractPlugin.loader, 'css-loader', 'postcss-loader'],
        },
      ],
    },
    plugins: [
      new MiniCssExtractPlugin({
        filename: "./main.css",
      }),
    ],
    output: {
        path: path.resolve(__dirname, './dist'),
        filename: 'main.js',
    },
    devServer: {
        static: path.resolve(__dirname, './dist'),
    },
    
};