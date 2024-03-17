import { defineConfig } from "vite";
import laravel, { refreshPaths } from "laravel-vite-plugin";

const jsFiles = [];
const cssFiles = ["resources/css/app.css"];
const templateFiles = ["vendor/zeus/frontend.css"];
// const all =

const al_input = [...jsFiles, ...cssFiles, ...templateFiles];

export default defineConfig({
    plugins: [
        laravel({
            input: al_input,
            refresh: [...refreshPaths, "app/Livewire/**"],
        }),
    ],
});
