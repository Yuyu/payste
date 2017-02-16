const webpack = require('webpack');
const path = require('path');

module.exports = env => {
    return {
        context: __dirname + '/public/js',
        entry: {
            index: './index.js',
            view: './view.js',
            vendor: [
                './flat-ui.js',
                './jquery-3.1.1.js',
                './encryption.js',
                './chance.js',
                './crypto-js/crypto-js.js'
            ]
        },
        output: {
            library: '[name]',
            filename: '[name].js',
            path: path.resolve(__dirname, 'public/js/dist')
        },
        resolve: {
            alias: {
                jquery: './jquery-3.1.1.js',
            }
        },
        plugins: [
            new webpack.optimize.CommonsChunkPlugin({
                name: 'vendor',
                filename: '[name].js'
            }),
            new webpack.ProvidePlugin({
                $: 'jquery',
                jQuery: 'jquery',
                'window.$': 'jquery',
                'window.jQuery': 'jquery'
            }),
            new webpack.optimize.UglifyJsPlugin({
                compress: {
                    dead_code: true,
                    unused: true
                },
                comments: false,
                sourceMap: false
            })
        ]
    };
}
