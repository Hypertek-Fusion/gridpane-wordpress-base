import { resolve } from 'path';
import { defineConfig } from 'vite';

export default defineConfig({
  build: {
    outDir: 'dist',
    emptyOutDir: true,
    rollupOptions: {
      input: {
        forms: resolve(__dirname, 'admin/js/forms.js'),
        admin: resolve(__dirname, 'admin/js/admin-scripts.js'),
        mainPage: resolve(__dirname, 'admin/js/main-page.js'),
        setupPage: resolve(__dirname, 'admin/js/setup-page.js'),
      },
      output: {
        entryFileNames: '[name].js',
      }
    },
    minify: 'esbuild' 
  }
});
