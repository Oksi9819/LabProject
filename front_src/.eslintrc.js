module.exports = {
  "settings": {
    "import/resolver": "webpack"
  },
  env: {
    browser: true,
    es2021: true,
  },
  extends: 'airbnb-base',
  overrides: [
  ],
  parserOptions: {
    ecmaVersion: 'latest',
    sourceType: 'module',
  },
  rules: {
    "no-plusplus": ["error", { "allowForLoopAfterthoughts": true }],
  },
  plugins: ["eslint-plugin-import"]
};