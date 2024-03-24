import { defineConfig } from 'vite';
import { dirname, resolve } from 'path';
import symfonyPlugin from 'vite-plugin-symfony';
import vuePlugin from '@vitejs/plugin-vue';
import { fileURLToPath } from 'url';

const workdir = dirname(fileURLToPath(import.meta.url));

export default defineConfig({
  plugins: [vuePlugin(), symfonyPlugin()],
  build: {
    manifest: true,
    rollupOptions: {
      input: {
        app: './assets/app.js',
        page: './assets/page/main.js',
      },
      output: {
        manualChunks: {
          vue: ['vue'],
        },
      },
    },
  },
  resolve: {
    alias: {
      '~': resolve(workdir, 'assets'),
    },
  },
});
