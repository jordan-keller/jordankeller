import jigsaw from "@tighten/jigsaw-vite-plugin";
import { defineConfig } from "vite";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
  root: "source/_assets",
  build: {
    outDir: "../assets/build",
    emptyOutDir: true,
    manifest: true,
    rollupOptions: {
      input: "/css/main.css",
    },
  },
});
