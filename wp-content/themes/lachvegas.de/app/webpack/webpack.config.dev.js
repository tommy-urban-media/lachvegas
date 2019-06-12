/* === dont forget to import style to main.js file === */
/* ===> import './main.styl'; <=== */


var path = require("path");

const ExtractCssChunks = require("extract-css-chunks-webpack-plugin")

module.exports = {
    mode: "development",
    watch: true,
    entry: [
        "./app/src/js/app.js",
        "./app/src/stylus/main.styl"
    ],
    output: {
        path: path.resolve(__dirname, "dist"),
        filename: "app.js",
        publicPath: "/dist"
    },
    resolve: {
        alias: {
            '@': path.resolve(__dirname, "app/src"),
        }
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
                        loader:ExtractCssChunks.loader,
                        options: {
                            hot: true, // if you want HMR - we try to automatically inject hot reloading but if it's not working, add it to the config
                            reloadAll: true, // when desperation kicks in - this is a brute force HMR flag
                        }
                    },
                    "css-loader",
                    "stylus-loader"
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