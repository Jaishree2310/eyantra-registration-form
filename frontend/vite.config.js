export default defineConfig({
    server: {
      proxy: {
        '/api': {
          target: 'https://eyantra-be.chotu.link/api',
          changeOrigin: true,
          rewrite: (path) => path.replace(/^\/api/, '')
        }
      }
    }
  })