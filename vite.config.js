import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path'

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/scss/app.scss',
                'resources/js/app.js',
                'resources/js/pages/profilepage.js',
                'resources/js/login.js',
                'resources/js/pages/family.js',
                'resources/js/pages/household.js',
                'resources/js/dashboard/updateAdmin.js',
                'resources/js/dashboard/updatefamily.js',
                'resources/js/dashboard/householdUpdate.js',
                'resources/js/dashboard/updateprofile.js'
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
            '~date-picker': path.resolve(__dirname, 'node_modules/bootstrap-datepicker'),
            '~datatable' : path.resolve(__dirname, 'node_modules/datatables.net-bs5'),
        }
    }
});
