import jigsaw from "@tighten/jigsaw-vite-plugin";
import { defineConfig } from "vite";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig(({ mode }) => {
  const isProduction = mode === "production";

  return {
    plugins: [
      jigsaw({
        input: ["source/_assets/js/main.js", "source/_assets/css/main.css"],
        refresh: true,
      }),
      tailwindcss(),
    ],
    base: isProduction ? "/build_production/" : "/",
    build: {
      outDir: isProduction ? "build_production" : "build_local",
      manifest: true,
      emptyOutDir: true,
      rollupOptions: {
        input: ["source/_assets/js/main.js", "source/_assets/css/main.css"],
      },
    },
  };
});
