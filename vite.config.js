import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
 		'resources/sass/login.scss',
		'resources/js/auth.js',
		'resources/sass/dashboard.scss',
            ],
            refresh: true,
        }),
    ],
});
