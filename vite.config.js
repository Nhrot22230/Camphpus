import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/js/main.tsx', 'resources/css/app.css'], // Incluye el CSS de Tailwind
            refresh: true,
        }),
        react(),
    ],
});
