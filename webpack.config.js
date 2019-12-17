const path = require('path');
const webpack = require('webpack');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

class RemoveJSAssetsInCSSFolder {
    apply(compiler) {
        let pattern = /css\/.*\.js$/; // pattern of JS inside of css/ asset folder.
        compiler.hooks.emit.tapAsync('MiniCssExtractPluginCleanup', (compilation, callback) => {
            Object.keys(compilation.assets)
                .filter(asset => {
                    return pattern.test(asset);
            }).forEach(asset => {
                    delete compilation.assets[asset];
                });

            callback();
        });
    }
}

module.exports = env => {
    const config = {
        entry: {
            '/js/admin/core': './src/js/admin/core.js',
            '/js/public/core': './src/js/public/core.js',
            '/css/admin/styles': './src/scss/admin/styles.scss',
            '/css/public/styles': './src/scss/public/styles.scss',
        },
        output: {
            filename: '[name].js',
            path: path.resolve(__dirname),
        },
        module: {
            rules: [
                {
                    test: /\.js$/,
                    exclude: /node_modules/,
                    use: {
                        loader: 'babel-loader',
                        options: {
                            presets: ['@babel/preset-env'],
                        },
                    },
                },
                {
                    test: /\.(sc|sa|c)ss$/,
                    exclude: /node_modules/,
                    use: [
                        MiniCssExtractPlugin.loader,
                        'css-loader',
                        'sass-loader',
                    ],
                },
            ],
        },
        plugins: [
            new MiniCssExtractPlugin({
                filename: '[name].css',
            }),
            new RemoveJSAssetsInCSSFolder(),
        ],
    };

    if (process.env.NODE_ENV === 'production') {
        config.plugins.push(new webpack.DefinePlugin({
            'process.env': {
                NODE_ENV: JSON.stringify('production'),
            }
        }));
    }

    return config;
};
