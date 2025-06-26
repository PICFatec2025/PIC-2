import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';


const inputs = [
    'resources/css/cadastrar_prato.css',
    'resources/css/cadastro_pedidos.css',
    'resources/css/consultar_pedidos.css',
    'resources/css/consultar_vendas.css',
    'resources/css/logo.css',
    'resources/css/style.css',
    'resources/css/style-vendas.css',
    'resources/css/app.css',
    'resources/js/app.js',
    'resources/js/filtroPratos.js'
];

export default defineConfig({
    plugins: [
        laravel({
            input: inputs,
            refresh: true,
        }),
    ],
    build: {
        manifest: true,
        outDir: 'public/build',
        rollupOptions: {
            input: inputs,
        },
    },
});

