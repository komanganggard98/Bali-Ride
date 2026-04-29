import { defineConfig } from "vite"

export default defineConfig({
  build: {
    outDir: "dist",
    rollupOptions: {
      input: {
        main: "assets/js/main.js",
        style: "assets/scss/main.scss"
      },
      output: {
        entryFileNames: "main.js",
        assetFileNames: "style.css"
      }
    }
  }
})