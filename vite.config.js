import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { bunny } from 'laravel-vite-plugin/fonts';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
            fonts: [
                bunny('Instrument Sans', {
                    weights: [400, 500, 600],
                }),
            ],
        }),
        tailwindcss(),
    ],
    server: {
        // Bind explicitly to IPv4. Node resolves "localhost" to ::1 first,
        // which makes the dev server listen on [::1] only and writes that
        // into public/hot (e.g. http://[::1]:5173).
        host: '127.0.0.1',
        watch: {
            ignored: [
                '**/storage/framework/views/**',
                // The local `guggach/laravel-reports` path repository is
                // symlinked into vendor/, and its own vendor/ contains a
                // self-referencing symlink (testbench's laravel/vendor).
                // Watching vendor/ makes chokidar follow that loop forever
                // until Node runs out of memory.
                '**/vendor/**',
            ],
        },
    },
});
