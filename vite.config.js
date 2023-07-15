import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/bootstrap.min.css',
                'resources/js/bootstrap.bundle.min.js'
            ],
            refresh: true,
        }),
    ],
});
