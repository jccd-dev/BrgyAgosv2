import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path'

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/scss/app.scss',
                'resources/js/app.js',
                'resources/js/pages/profilepage.js'
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
            '~date-picker': path.resolve(__dirname, 'node_modules/bootstrap-datepicker'),
            '~datatable' : path.resolve(__dirname, 'node_modules/datatables.net-bs5')
        }
    }
});
