import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/dashboard.css',
                'resources/css/main.css',
                'resources/js/dashboard.js',
                'resources/js/main.js',
            ],
            refresh: true,
        }),
    ],
});
