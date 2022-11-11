const path = require('path');
const ESLintPlugin = require('eslint-webpack-plugin');

const myEslintOptions = {
    extensions: [`js`, `jsx`, `ts`],
    exclude: [`node_modules`],
};

module.exports = {
    entry: './src/index.js',
    output: {
       filename: 'bundle.js',
       path: path.resolve('./dist')
    },
    plugins: [
        new ESLintPlugin(myEslintOptions),
    ],
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
            },
        ]
    },
    mode: 'development'
};