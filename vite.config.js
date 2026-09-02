import { defineConfig } from "vite";
import path from "path";

const themeName = "szpnew-wp-theme";

export default defineConfig({
  root: "src",
  base: `/wp-content/themes/${themeName}/dist/`, // poprawna ścieżka do builda w WP
  build: {
    outDir: "../dist",
    emptyOutDir: true,
    manifest: "manifest.json",
    rollupOptions: {
      input: {
        main: path.resolve(__dirname, "src/js/index.js"),
      },
      output: {
        entryFileNames: "assets/[name]-[hash].js",
        chunkFileNames: "assets/[name]-[hash].js",
        assetFileNames: "assets/[name]-[hash][extname]",
      },
    },
  },
  css: {
    devSourcemap: false,
    preprocessorOptions: {
      scss: {
        includePaths: [path.resolve(__dirname, "node_modules")],
        additionalData: `@use "sass:math";`,
      },
    },
  },
  server: {
    origin: "http://localhost:5173",
    watch: {
      usePolling: true,
    },
  },
});
