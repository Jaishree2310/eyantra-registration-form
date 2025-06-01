// vue.config.js
module.exports = {
    // Output directory for production build
    outputDir: 'dist',
    
    // Serve assets from relative paths
    publicPath: process.env.NODE_ENV === 'production' 
      ? '/' 
      : '/',
    
    // Development server configuration
    devServer: {
      port: 8080,
      // Proxy API requests to backend server during development
      proxy: {
        devServer: {
        proxy: 'http://localhost:8000/',
    },
        '/api': {
          target: process.env.VUE_APP_API_URL || 'http://localhost:3000',
          changeOrigin: true,
          pathRewrite: {
            '^/api': ''
          }
        }
      }
    },
    
    // Configure postcss plugins
    css: {
      loaderOptions: {
        postcss: {
          postcssOptions: {
            plugins: [
              require('tailwindcss'),
              require('autoprefixer')
            ]
          }
        }
      }
    }
  };