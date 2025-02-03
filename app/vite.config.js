// import { defineConfig } from "vite";
// import path from "path";

// export default defineConfig({
//     build: {
//         lib: {
//             entry: path.resolve(__dirname, "./src/assets/js/main.js"),
//             name: "Template PHP Vite Sass"
//         }
//     },
// });

import { defineConfig } from 'vite';
import path from 'path';

export default defineConfig({
    root: './src/assets',
    build: {
        outDir: '../../public',
        emptyOutDir: false,
        manifest: true,
        rollupOptions: {
            input: {
                main: (path.resolve(__dirname, './src/assets/scss/main.scss')),
                app: (path.resolve(__dirname, './src/assets/js/main.js')),
            },
            output: {
                assetFileNames: (assetInfo) => {
                    if (/\.css$/i.test(assetInfo.name)) {
                        return 'css/[name][extname]'; // Déplace les fichiers CSS compilés dans public/css/
                    }
                    return 'assets/[name][extname]'; // Par défaut pour les autres assets
                },
                chunkFileNames: 'js/[name].js', // JS dans public/js/
                entryFileNames: 'js/[name].js', // JS dans public/js/
            },
        },
    },
    resolve: {
        alias: {
            '@': path.resolve(__dirname, './src/assets'),
        },
    },
});
