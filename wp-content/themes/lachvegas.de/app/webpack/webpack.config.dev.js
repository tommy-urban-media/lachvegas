/* === dont forget to import style to main.js file === */
/* ===> import './main.styl'; <=== */


var path = require("path");

const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const devMode = process.env.NODE_ENV !== 'production';

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
                        loader: 'file-loader',
                        options: {
                            name: '[name].css',
                            outputPath: 'assets/css/'
                        }
                    },
                    {
                        loader: 'extract-loader'
                    },
                    "style-loader",
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
    }
};