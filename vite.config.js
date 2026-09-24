import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    publicDirect: "dist",
    plugins: [
        laravel({
            publicDirectory:'dist',
            buildDirectory: 'assets',
            input: ['resources/css/chatbot.css'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    
    build: {
        target: 'es2015',
        rollupOptions: {
            output: {
                chunkFileNames: "static/js/[name]-[hash].js",
                entryFileNames: "static/js/[name]-[hash].js",
                assetFileNames: "[ext]/[name].[ext]",
            },
        },


    }

});
