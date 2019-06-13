/* === dont forget to import style to main.js file === */
/* ===> import './main.styl'; <=== */


var path = require("path");

const ExtractCssChunks = require("extract-css-chunks-webpack-plugin");
const UglifyJsPlugin = require('uglifyjs-webpack-plugin');

module.exports = {
    mode: "production",
    entry: {
        app: ["./app/src/js/app.js", "./app/src/stylus/bundles/app.styl"],
        main: ["./app/src/stylus/main.styl"]
    },
    output: {
        filename: '[name].js',
        path: path.resolve(__dirname, "dist"),
        publicPath: "/dist"
    },
    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: [
                            ['@babel/preset-env', {
                                corejs: 3,
                                useBuiltIns: "usage",
                                targets: {
                                    browsers: [
                                        "iOS >= 10.3",
                                        "ChromeAndroid >= 61",
                                        "FirefoxAndroid >= 60"
                                    ]
                                }
                            }]
                        ]
                    }
                }
            },
            {
                test: /\.styl(us)?$/,
                use: [
                    {
                        loader:ExtractCssChunks.loader
                    },
                    {
                        loader: "css-loader",
                        options: { importLoaders: 1 }
                    },
                    {
                        loader: "postcss-loader",
                        options: {
                            ident: 'postcss',
                            plugins: (loader) => [
                                require('postcss-import')({ root: loader.resourcePath }),
                                require('postcss-preset-env')(),
                                require('cssnano')()
                            ]
                        }
                    },
                    {
                        loader: "stylus-loader",
                    }
                ]
            },
            {
                test: /\.(png|jpg|gif|svg)$/,
                use: [{
                    loader: 'url-loader',
                    options: {
                        limit: 8192
                    }
                }]
            }
        ]
    },
    optimization: {
        minimizer: [
            new UglifyJsPlugin({
                uglifyOptions: {
                    output: {
                        comments: false,
                        ascii_only: true
                    },
                    compress: {
                        comparisons: false
                    }
                }
            })
        ],
    },
    plugins: [
        new ExtractCssChunks(
            {
                // Options similar to the same options in webpackOptions.output
                // both options are optional
                filename: "[name].css",
                chunkFilename: "[id].css",
                orderWarning: true, // Disable to remove warnings about conflicting order between imports
            }
        ),
    ]
};