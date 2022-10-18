const path = require('path');
module.exports = {
    entry: './src/index.js',
    output: {
       filename: 'bundle.js',
       path: path.resolve('./dist')
    },
    module: {
        rules: [
            {
                test:/\.css$/,
                use: [
                    { loader: "style-loader" },
                    { loader: "css-loader" }
                ]
            },
            {
                test:/\.less$/,
                use: [
                    { loader: "style-loader" },
                    { loader: "css-loader" },
                    { loader: "less-loader" }
                ]
            }
        ]
    },
    mode: 'development'
};