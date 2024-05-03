import { defineConfig } from "vite";
import laravel, { refreshPaths } from "laravel-vite-plugin";

const jsFiles = ['resources/js/app.js'];
const cssFiles = ["resources/css/app.css" , 'resources/css/filament/admin/theme.css'];
const templateFiles = ["vendor/zeus/frontend.css"];
// const all =

const al_input = [...jsFiles, ...cssFiles];

export default defineConfig({
    plugins: [
        laravel({
            input: al_input,
            refresh: [...refreshPaths, "app/Livewire/**"],
        }),
    ],
});
 