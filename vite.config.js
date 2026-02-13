import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/pages/register.js',
                'resources/js/pages/member/payment.js',
                'resources/js/pages/member/submission.js',
                'resources/js/pages/member/edit-submission.js',
                'resources/js/pages/member/profile.js',
                'resources/js/pages/admin/view-submission.js',
                'resources/js/pages/admin/user.js',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
