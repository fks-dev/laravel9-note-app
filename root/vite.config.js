import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        vue(),
    ],

    // ここがDocker対策のポイント！！
    server: {
        host: true, // 外部アクセスを許可
        hmr: {
            host: 'localhost', // ブラウザからのアクセス元
        },
        watch: {
            usePolling: true, // ファイル変更を検知できるようにする
        },
    },
});