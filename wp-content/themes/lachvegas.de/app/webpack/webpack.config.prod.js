/* === dont forget to import style to main.js file === */
/* ===> import './main.styl'; <=== */


var path = require("path");

module.exports = {
    mode: "production",
    entry: "./app/src/js/app.js",
    output: {
        path: path.resolve(__dirname, "dist"),
        filename: "bundle.js",
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