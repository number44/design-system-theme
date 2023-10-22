import { defineConfig } from "vite";
import react from "@vitejs/plugin-react";
import { resolve } from "path";
/** @type {import('vite').UserConfig} */

const root = __dirname;
const outDir = resolve(__dirname, "dist");
// https://vitejs.dev/config/
export default defineConfig({
  root: root,
  build: {
    manifest: true,
    outDir: outDir,
  },
  plugins: [react()],
});
