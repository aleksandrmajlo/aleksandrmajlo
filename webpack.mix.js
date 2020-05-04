const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/dist/js')
    .sass('resources/sass/app.scss', 'public/dist/css');

mix.webpackConfig({
    plugins: [],
    resolve: {
        extensions: ['.js', '.json', '.vue'],
        alias: {
            '~': path.join(__dirname, './resources/js')
        }
    },
    output: {
        chunkFilename: 'dist/js/[id].js',
        // path: mix.config.hmr ? '/' : path.resolve(__dirname, './public/build')
    }
});
