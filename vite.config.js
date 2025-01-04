import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';
import fs from 'fs';

function getFiles(dir, ext = '') {
    return fs
        .readdirSync(dir)
        .filter((file) => file.endsWith(ext))
        .map((file) => `${dir}/${file}`);
}


export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                ...getFiles('resources/js/pages-exclusive', '.js'),
                ...getFiles('resources/sass/pages-exclusive', '.scss'),
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '@': path.resolve(__dirname, 'resources'),
        },
    },
    build: {
        rollupOptions: {
            external: ['jquery'],
            output: {
                globals: {
                    jquery: 'jQuery',
                },
            },
        },
    },
    css: {
        preprocessorOptions: {
          scss: {
            api: 'modern-compiler' // or "modern"
          }
        }
      }
});
