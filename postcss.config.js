const tailwindcss = require('tailwindcss');
const autoprefixer = require('autoprefixer');
const cssnano = require('cssnano');
module.exports = {
    plugins: {
      tailwindcss,
      autoprefixer,
      'postcss-preset-env':{
        browsers: 'last 2 versions, not dead',
      },
      cssnano: {
        preset: 'default'
      }
    }
  }