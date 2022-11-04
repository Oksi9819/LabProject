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
  },
  extends: [
    "plugin:import/errors",
    "plugin:import/warnings",
    "plugin:import/typescript",
  ],
  extends: ["plugin:import/recommended"],
  plugins: ["eslint-plugin-import"]
};