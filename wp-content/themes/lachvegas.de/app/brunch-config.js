module.exports = {
  files: {
    javascripts: {
      joinTo: {
        'js/vendor.js': /^(?!src\/)/,
        'js/app.js': /^src/
      }
    },
    stylesheets: {
      joinTo: {
        'css/app.css': /^src\/stylus\/app.styl/,
        'css/box.css': /^src\/stylus\/box.styl/
      }
    }
  },

  paths: {
    watched: ['src']
  },

  plugins: {
    babel: {
      presets: ['env']
    },
    stylus: {
      includeCss: true
    },
    cleancss: {
      keepSpecialComments: 0,
      removeEmpty: true
    },
    postcss: {
      processors: [
        require('autoprefixer')(['> 1%']),
        require('csswring')()
      ]
    }
  }

};
