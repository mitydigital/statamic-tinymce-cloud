import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import statamic from '@statamic/cms/vite-plugin';

export default defineConfig({
    plugins: [
        statamic(),
        laravel({
            refresh: true,
            input: [
                'resources/js/tinymce-cloud.js',
            ],
            publicDirectory: 'resources/dist',
        }),
    ],
});