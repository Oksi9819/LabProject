/*
 * ATTENTION: The "eval" devtool has been used (maybe by default in mode: "development").
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./node_modules/css-loader/dist/cjs.js!./node_modules/less-loader/dist/cjs.js!./src/styles.less":
/*!******************************************************************************************************!*\
  !*** ./node_modules/css-loader/dist/cjs.js!./node_modules/less-loader/dist/cjs.js!./src/styles.less ***!
  \******************************************************************************************************/
/***/ ((module, __webpack_exports__, __webpack_require__) => {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export */ __webpack_require__.d(__webpack_exports__, {\n/* harmony export */   \"default\": () => (__WEBPACK_DEFAULT_EXPORT__)\n/* harmony export */ });\n/* harmony import */ var _node_modules_css_loader_dist_runtime_noSourceMaps_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../node_modules/css-loader/dist/runtime/noSourceMaps.js */ \"./node_modules/css-loader/dist/runtime/noSourceMaps.js\");\n/* harmony import */ var _node_modules_css_loader_dist_runtime_noSourceMaps_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_css_loader_dist_runtime_noSourceMaps_js__WEBPACK_IMPORTED_MODULE_0__);\n/* harmony import */ var _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../node_modules/css-loader/dist/runtime/api.js */ \"./node_modules/css-loader/dist/runtime/api.js\");\n/* harmony import */ var _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_1__);\n/* harmony import */ var _node_modules_css_loader_dist_runtime_getUrl_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../node_modules/css-loader/dist/runtime/getUrl.js */ \"./node_modules/css-loader/dist/runtime/getUrl.js\");\n/* harmony import */ var _node_modules_css_loader_dist_runtime_getUrl_js__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_node_modules_css_loader_dist_runtime_getUrl_js__WEBPACK_IMPORTED_MODULE_2__);\n// Imports\n\n\n\nvar ___CSS_LOADER_URL_IMPORT_0___ = new URL(/* asset import */ __webpack_require__(/*! ../../src/pics/background.png */ \"../src/pics/background.png\"), __webpack_require__.b);\nvar ___CSS_LOADER_EXPORT___ = _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_1___default()((_node_modules_css_loader_dist_runtime_noSourceMaps_js__WEBPACK_IMPORTED_MODULE_0___default()));\nvar ___CSS_LOADER_URL_REPLACEMENT_0___ = _node_modules_css_loader_dist_runtime_getUrl_js__WEBPACK_IMPORTED_MODULE_2___default()(___CSS_LOADER_URL_IMPORT_0___);\n// Module\n___CSS_LOADER_EXPORT___.push([module.id, \"@font-face {\\n  font-family: 'Comfortaa';\\n  font-style: normal;\\n  font-weight: 400;\\n  font-display: swap;\\n  src: url(https://fonts.gstatic.com/s/comfortaa/v40/1Pt_g8LJRfWJmhDAuUsSQamb1W0lwk4S4WjMPrQ.ttf) format('truetype');\\n}\\n.bold {\\n  font-weight: bold;\\n}\\na {\\n  text-decoration: none;\\n  color: inherit;\\n  padding: 0;\\n  margin: 0;\\n}\\nbody {\\n  font-family: 'Comfortaa', cursive;\\n  display: flex;\\n  flex-direction: column;\\n  padding: 0;\\n  margin: 0%;\\n  min-height: 100vh;\\n  color: #000000;\\n  background: url(\" + ___CSS_LOADER_URL_REPLACEMENT_0___ + \") no-repeat;\\n  background-size: 100% 100%;\\n}\\nheader {\\n  min-height: 15vh;\\n}\\nheader .logo {\\n  display: flex;\\n  align-items: center;\\n}\\nheader .logo a {\\n  display: flex;\\n  align-items: center;\\n}\\nheader .logo a img {\\n  height: 10vh;\\n}\\nheader .logo a img:hover {\\n  opacity: 0.9;\\n}\\nheader .logo a h2 {\\n  font-weight: bold;\\n  font-style: normal;\\n  color: #07575bea;\\n  margin-left: 20px;\\n}\\nnav.menu.header-menu {\\n  font-size: larger;\\n  background: #07575bea;\\n  margin: 0;\\n  padding: 0;\\n  color: #F5F5F5;\\n}\\nnav.menu ul.menu a {\\n  transition: 0.5s linear;\\n  vertical-align: middle;\\n}\\nnav.menu ul.menu.header-menu {\\n  height: 100%;\\n  font-weight: bold;\\n  list-style: none;\\n  margin: 0;\\n  padding: 0;\\n}\\nnav.menu ul.menu.header-menu li {\\n  display: inline-block;\\n  margin: 1em 20px 0 0;\\n  position: relative;\\n  min-width: 10vh;\\n}\\nnav.menu ul.menu.header-menu li:last-child {\\n  margin-right: 20px;\\n}\\nnav.menu ul.menu.header-menu li:first-child {\\n  margin-left: 20px;\\n}\\nnav.menu ul.menu.header-menu li:hover {\\n  text-shadow: 5px 5px 15px #95D8E1;\\n}\\nnav.menu ul.menu.header-menu li:hover .submenu {\\n  visibility: visible;\\n}\\nnav.menu ul.menu.header-menu li.penult {\\n  margin-left: 53vh;\\n}\\nnav.menu ul.menu.header-menu li.penult.one {\\n  margin-right: 2vh;\\n}\\nnav.menu ul.menu.header-menu li img.cart {\\n  height: 5vh;\\n}\\nnav.menu ul.menu.header-menu li .submenu.header-submenu {\\n  position: absolute;\\n  top: 100%;\\n  left: 0;\\n  z-index: 10;\\n  transition: 0.5s ease-in-out;\\n  visibility: hidden;\\n}\\nnav.menu ul.menu.header-menu li .submenu.header-submenu li {\\n  width: 20em;\\n  padding: 1em 1em 0 1em;\\n  position: relative;\\n  background: #66a5ad;\\n  border-bottom: 1px solid #07575b56;\\n  margin: 0;\\n}\\nnav.menu ul.menu.header-menu li .submenu.header-submenu li:last-child {\\n  padding-bottom: 1em;\\n}\\nnav.menu ul.menu.header-menu li .submenu.header-submenu li:first-child {\\n  margin-left: 0;\\n}\\nnav.menu ul.menu.header-menu li .submenu.header-submenu li:hover {\\n  text-shadow: 5px 5px 15px #07575bea;\\n}\\nmain {\\n  margin: 0;\\n  padding: 0;\\n  min-height: 60vh;\\n  flex-grow: 1;\\n}\\narticle {\\n  width: 90%;\\n  height: 100%;\\n  min-height: 65vh;\\n  background: #c4dfe6;\\n  margin: 0 auto;\\n  color: #000000;\\n  font-size: large;\\n  border-right: 3px solid #07575bea;\\n  border-left: 3px solid #07575bea;\\n}\\narticle p {\\n  margin: 1em 5vh 0 5vh;\\n}\\ninput:invalid {\\n  background: #ffe3e7;\\n}\\nform {\\n  padding: 0px 0px;\\n  background: #66a5ad;\\n  border-radius: 0px;\\n}\\ninput,\\nselect {\\n  color: #565555;\\n  font-family: 'Comfortaa', cursive;\\n  font-size: smaller;\\n  border: 1px solid #66a5ad;\\n  border-radius: 5px;\\n}\\ninput:hover,\\nselect:hover {\\n  background: #07575bea;\\n  color: #FFFFFF;\\n  box-shadow: 0 1px 2px #F5F5F5;\\n}\\n.set-changes p {\\n  margin: 1.5em 0 0.5em 5vh;\\n  font-weight: bold;\\n}\\n.set-changes form {\\n  padding-left: 25px;\\n  margin-bottom: 0;\\n}\\n.set-changes form input,\\n.set-changes form select {\\n  margin: 15px 0 0 0;\\n}\\n.set-changes form input:last-child,\\n.set-changes form select:last-child {\\n  margin-bottom: 15px;\\n}\\n.set-changes form input[type=submit] {\\n  margin-left: 0;\\n}\\n.set-changes.sort input,\\n.set-changes.sort select {\\n  margin: 0.5em 0 0 0;\\n}\\n.set-changes.sort input:last-child,\\n.set-changes.sort select:last-child {\\n  margin-bottom: 0.5em;\\n}\\n.set-changes.orders {\\n  background: none;\\n}\\n.info {\\n  padding: 1em 5vh 5vh 5vh;\\n}\\n.info p {\\n  margin-bottom: 0.5em;\\n  margin-left: 0;\\n}\\n.info img {\\n  border: 3px solid #F5F5F5;\\n  width: 20em;\\n  height: 20em;\\n  border-radius: 5px;\\n  box-shadow: 0 1px 2px #66a5ad;\\n}\\n.catalog {\\n  margin: 0 auto;\\n  padding: 0;\\n  padding-top: 20px;\\n  text-align: center;\\n  flex-direction: row;\\n  flex-wrap: wrap;\\n  display: flex;\\n  justify-content: space-between;\\n}\\n.catalog.product-card {\\n  min-height: 27em;\\n  flex: 0 0 calc(18% - 2px);\\n  border: 1px solid #07575bea;\\n  border-radius: 5px;\\n  padding: 0;\\n  display: flex;\\n  flex-direction: column;\\n  margin-bottom: 20px;\\n  justify-content: flex-start;\\n}\\n.catalog.product-card .inner {\\n  height: fit-content;\\n  border: none;\\n  margin-bottom: 20px;\\n}\\n.catalog.product-card a {\\n  text-decoration: none;\\n  color: #000000;\\n  border: none;\\n}\\n.catalog.product-card a.product-card.text {\\n  font-weight: bold;\\n  width: 95%;\\n}\\n.catalog.product-card img {\\n  width: calc(100% - 2vh);\\n  border-radius: 5px;\\n}\\n.catalog.product-card img:hover {\\n  transform: scale(1.2);\\n}\\n.description {\\n  display: inline-block;\\n  vertical-align: top;\\n  margin-left: 5vh;\\n  margin-right: 5vh;\\n  padding-left: 1em;\\n  width: 40%;\\n  height: 20em;\\n  border: 3px solid #F5F5F5;\\n  border-radius: 5px;\\n}\\nbutton {\\n  width: auto;\\n  display: inline;\\n  padding: 0.5vh 0.5vh 0.5vh 0.5vh;\\n  margin: auto;\\n  border: 1px solid #F5F5F5;\\n  border-radius: 5px;\\n  height: auto;\\n  font-family: inherit;\\n  font-weight: normal;\\n}\\nbutton:hover {\\n  background: #07575bea;\\n  color: #FFFFFF;\\n}\\n.add-to-cart {\\n  display: inline-block;\\n  vertical-align: top;\\n  margin-right: 5vh;\\n  min-width: 20%;\\n  height: 20em;\\n  border: 3px solid #F5F5F5;\\n  border-radius: 5px;\\n  background: inherit;\\n  text-align: center;\\n}\\n.add-to-cart input,\\n.add-to-cart button {\\n  margin-top: 15px;\\n}\\n.add-to-cart input[type=number] {\\n  width: 3em;\\n}\\n.add-to-cart button {\\n  color: #FFFFFF;\\n  font-family: inherit;\\n  font-weight: bolder;\\n  padding: 1em 1em 1em 1em;\\n  background: #66a5ad;\\n  width: 17em;\\n  border: 1px solid #F5F5F5;\\n  border-radius: 5px;\\n}\\n.add-to-cart button:hover {\\n  background: #07575bea;\\n  color: #FFFFFF;\\n}\\n.add-to-cart.catalog {\\n  margin: auto;\\n  border: none;\\n  height: auto;\\n  display: block;\\n  padding-left: 0;\\n}\\n.add-to-cart button.add-product {\\n  width: auto;\\n  display: inline;\\n  padding: 0.5vh 0.5vh 0.5vh 0.5vh;\\n  margin: auto;\\n  border: 1px solid #F5F5F5;\\n  border-radius: 5px;\\n  height: auto;\\n  font-family: inherit;\\n  font-weight: normal;\\n}\\n.add-to-cart button.add-product:hover {\\n  background: #07575bea;\\n  color: #FFFFFF;\\n}\\ntable.reviews,\\ntable.orders,\\ntable.users {\\n  width: 100%;\\n  margin: 0 auto;\\n  padding: 0;\\n  border-collapse: collapse;\\n  text-align: center;\\n}\\ntable.reviews thead,\\ntable.orders thead,\\ntable.users thead {\\n  font-weight: bold;\\n  border-top: 2px solid #07575bea;\\n  border-bottom: 1px solid #07575bea;\\n}\\ntable.reviews tr,\\ntable.orders tr,\\ntable.users tr {\\n  border-bottom: 1px solid #07575bea;\\n}\\ntable.reviews tbody tr:hover,\\ntable.orders tbody tr:hover,\\ntable.users tbody tr:hover {\\n  background: #07575bea;\\n  color: #FFFFFF;\\n}\\ntable.reviews td,\\ntable.orders td,\\ntable.users td {\\n  padding: 0.5vh 0.5vh 0.5vh 0.5vh;\\n}\\ntable.reviews.details,\\ntable.orders.details,\\ntable.users.details {\\n  border-radius: 5px;\\n  background: #FFFFFF;\\n  border-collapse: collapse;\\n  font-size: small;\\n}\\ntable.reviews.details tr,\\ntable.orders.details tr,\\ntable.users.details tr {\\n  border: none;\\n}\\ntable.orders {\\n  font-size: smaller;\\n}\\n.info-title {\\n  font-weight: bold;\\n}\\n.contact {\\n  background: #66a5ad;\\n  padding: 10px 0px 10px 0px;\\n  margin-top: 5vh;\\n}\\n.contact form {\\n  width: 65vh;\\n  margin: 0 auto;\\n  padding: 0px 0px;\\n  background: #66a5ad;\\n  border-radius: 0px;\\n}\\n.contact p {\\n  width: fit-content;\\n  margin: 0 auto 10px auto;\\n  font-weight: bold;\\n}\\n.contact-input,\\n.contact-btn {\\n  font-size: inherit;\\n}\\n.contact-input.contact-name,\\n.contact-btn.contact-name,\\n.contact-input.contact-mail,\\n.contact-btn.contact-mail {\\n  margin: 0 auto;\\n  margin-bottom: 15px;\\n  width: calc(50% - 15px);\\n}\\n.contact-input.contact-name:hover,\\n.contact-btn.contact-name:hover,\\n.contact-input.contact-mail:hover,\\n.contact-btn.contact-mail:hover {\\n  box-shadow: 0 1px 2px #F5F5F5;\\n  border-color: #07575bea;\\n}\\n.contact-input.contact-name:focus,\\n.contact-btn.contact-name:focus,\\n.contact-input.contact-mail:focus,\\n.contact-btn.contact-mail:focus {\\n  background: #F5F5F5;\\n}\\n.contact-input.contact-name,\\n.contact-btn.contact-name {\\n  margin-right: 12px;\\n}\\n.contact-input.contact-msg,\\n.contact-btn.contact-msg {\\n  width: calc(100% - 6px);\\n  margin-bottom: 15px;\\n}\\n.contact-input.contact-msg:hover,\\n.contact-btn.contact-msg:hover {\\n  box-shadow: 0 1px 2px #F5F5F5;\\n  border-color: #07575bea;\\n}\\n.contact-input.contact-msg:focus,\\n.contact-btn.contact-msg:focus {\\n  background: #F5F5F5;\\n}\\n.contact-btn {\\n  width: calc(100%);\\n  margin: 0 auto;\\n}\\np.error_message {\\n  font-weight: bold;\\n}\\nfooter {\\n  width: 100%;\\n  min-height: 20vh;\\n  background: #66a5ada2;\\n  border-top: 3px solid #07575bea;\\n  padding: 1em 0 0 0;\\n  color: #565555;\\n  font-weight: lighter;\\n}\\nfooter p {\\n  margin: 1em 5vh 0 5vh;\\n}\\n\", \"\"]);\n// Exports\n/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (___CSS_LOADER_EXPORT___);\n\n\n//# sourceURL=webpack://labproject/./src/styles.less?./node_modules/css-loader/dist/cjs.js!./node_modules/less-loader/dist/cjs.js");

/***/ }),

/***/ "./node_modules/css-loader/dist/runtime/api.js":
/*!*****************************************************!*\
  !*** ./node_modules/css-loader/dist/runtime/api.js ***!
  \*****************************************************/
/***/ ((module) => {

"use strict";
eval("\n\n/*\n  MIT License http://www.opensource.org/licenses/mit-license.php\n  Author Tobias Koppers @sokra\n*/\nmodule.exports = function (cssWithMappingToString) {\n  var list = []; // return the list of modules as css string\n\n  list.toString = function toString() {\n    return this.map(function (item) {\n      var content = \"\";\n      var needLayer = typeof item[5] !== \"undefined\";\n\n      if (item[4]) {\n        content += \"@supports (\".concat(item[4], \") {\");\n      }\n\n      if (item[2]) {\n        content += \"@media \".concat(item[2], \" {\");\n      }\n\n      if (needLayer) {\n        content += \"@layer\".concat(item[5].length > 0 ? \" \".concat(item[5]) : \"\", \" {\");\n      }\n\n      content += cssWithMappingToString(item);\n\n      if (needLayer) {\n        content += \"}\";\n      }\n\n      if (item[2]) {\n        content += \"}\";\n      }\n\n      if (item[4]) {\n        content += \"}\";\n      }\n\n      return content;\n    }).join(\"\");\n  }; // import a list of modules into the list\n\n\n  list.i = function i(modules, media, dedupe, supports, layer) {\n    if (typeof modules === \"string\") {\n      modules = [[null, modules, undefined]];\n    }\n\n    var alreadyImportedModules = {};\n\n    if (dedupe) {\n      for (var k = 0; k < this.length; k++) {\n        var id = this[k][0];\n\n        if (id != null) {\n          alreadyImportedModules[id] = true;\n        }\n      }\n    }\n\n    for (var _k = 0; _k < modules.length; _k++) {\n      var item = [].concat(modules[_k]);\n\n      if (dedupe && alreadyImportedModules[item[0]]) {\n        continue;\n      }\n\n      if (typeof layer !== \"undefined\") {\n        if (typeof item[5] === \"undefined\") {\n          item[5] = layer;\n        } else {\n          item[1] = \"@layer\".concat(item[5].length > 0 ? \" \".concat(item[5]) : \"\", \" {\").concat(item[1], \"}\");\n          item[5] = layer;\n        }\n      }\n\n      if (media) {\n        if (!item[2]) {\n          item[2] = media;\n        } else {\n          item[1] = \"@media \".concat(item[2], \" {\").concat(item[1], \"}\");\n          item[2] = media;\n        }\n      }\n\n      if (supports) {\n        if (!item[4]) {\n          item[4] = \"\".concat(supports);\n        } else {\n          item[1] = \"@supports (\".concat(item[4], \") {\").concat(item[1], \"}\");\n          item[4] = supports;\n        }\n      }\n\n      list.push(item);\n    }\n  };\n\n  return list;\n};\n\n//# sourceURL=webpack://labproject/./node_modules/css-loader/dist/runtime/api.js?");

/***/ }),

/***/ "./node_modules/css-loader/dist/runtime/getUrl.js":
/*!********************************************************!*\
  !*** ./node_modules/css-loader/dist/runtime/getUrl.js ***!
  \********************************************************/
/***/ ((module) => {

"use strict";
eval("\n\nmodule.exports = function (url, options) {\n  if (!options) {\n    options = {};\n  }\n\n  if (!url) {\n    return url;\n  }\n\n  url = String(url.__esModule ? url.default : url); // If url is already wrapped in quotes, remove them\n\n  if (/^['\"].*['\"]$/.test(url)) {\n    url = url.slice(1, -1);\n  }\n\n  if (options.hash) {\n    url += options.hash;\n  } // Should url be wrapped?\n  // See https://drafts.csswg.org/css-values-3/#urls\n\n\n  if (/[\"'() \\t\\n]|(%20)/.test(url) || options.needQuotes) {\n    return \"\\\"\".concat(url.replace(/\"/g, '\\\\\"').replace(/\\n/g, \"\\\\n\"), \"\\\"\");\n  }\n\n  return url;\n};\n\n//# sourceURL=webpack://labproject/./node_modules/css-loader/dist/runtime/getUrl.js?");

/***/ }),

/***/ "./node_modules/css-loader/dist/runtime/noSourceMaps.js":
/*!**************************************************************!*\
  !*** ./node_modules/css-loader/dist/runtime/noSourceMaps.js ***!
  \**************************************************************/
/***/ ((module) => {

"use strict";
eval("\n\nmodule.exports = function (i) {\n  return i[1];\n};\n\n//# sourceURL=webpack://labproject/./node_modules/css-loader/dist/runtime/noSourceMaps.js?");

/***/ }),

/***/ "./src/styles.less":
/*!*************************!*\
  !*** ./src/styles.less ***!
  \*************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export */ __webpack_require__.d(__webpack_exports__, {\n/* harmony export */   \"default\": () => (__WEBPACK_DEFAULT_EXPORT__)\n/* harmony export */ });\n/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! !../node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js */ \"./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js\");\n/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__);\n/* harmony import */ var _node_modules_style_loader_dist_runtime_styleDomAPI_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! !../node_modules/style-loader/dist/runtime/styleDomAPI.js */ \"./node_modules/style-loader/dist/runtime/styleDomAPI.js\");\n/* harmony import */ var _node_modules_style_loader_dist_runtime_styleDomAPI_js__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_dist_runtime_styleDomAPI_js__WEBPACK_IMPORTED_MODULE_1__);\n/* harmony import */ var _node_modules_style_loader_dist_runtime_insertBySelector_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../node_modules/style-loader/dist/runtime/insertBySelector.js */ \"./node_modules/style-loader/dist/runtime/insertBySelector.js\");\n/* harmony import */ var _node_modules_style_loader_dist_runtime_insertBySelector_js__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_dist_runtime_insertBySelector_js__WEBPACK_IMPORTED_MODULE_2__);\n/* harmony import */ var _node_modules_style_loader_dist_runtime_setAttributesWithoutAttributes_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! !../node_modules/style-loader/dist/runtime/setAttributesWithoutAttributes.js */ \"./node_modules/style-loader/dist/runtime/setAttributesWithoutAttributes.js\");\n/* harmony import */ var _node_modules_style_loader_dist_runtime_setAttributesWithoutAttributes_js__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_dist_runtime_setAttributesWithoutAttributes_js__WEBPACK_IMPORTED_MODULE_3__);\n/* harmony import */ var _node_modules_style_loader_dist_runtime_insertStyleElement_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! !../node_modules/style-loader/dist/runtime/insertStyleElement.js */ \"./node_modules/style-loader/dist/runtime/insertStyleElement.js\");\n/* harmony import */ var _node_modules_style_loader_dist_runtime_insertStyleElement_js__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_dist_runtime_insertStyleElement_js__WEBPACK_IMPORTED_MODULE_4__);\n/* harmony import */ var _node_modules_style_loader_dist_runtime_styleTagTransform_js__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! !../node_modules/style-loader/dist/runtime/styleTagTransform.js */ \"./node_modules/style-loader/dist/runtime/styleTagTransform.js\");\n/* harmony import */ var _node_modules_style_loader_dist_runtime_styleTagTransform_js__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_dist_runtime_styleTagTransform_js__WEBPACK_IMPORTED_MODULE_5__);\n/* harmony import */ var _node_modules_css_loader_dist_cjs_js_node_modules_less_loader_dist_cjs_js_styles_less__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! !!../node_modules/css-loader/dist/cjs.js!../node_modules/less-loader/dist/cjs.js!./styles.less */ \"./node_modules/css-loader/dist/cjs.js!./node_modules/less-loader/dist/cjs.js!./src/styles.less\");\n\n      \n      \n      \n      \n      \n      \n      \n      \n      \n\nvar options = {};\n\noptions.styleTagTransform = (_node_modules_style_loader_dist_runtime_styleTagTransform_js__WEBPACK_IMPORTED_MODULE_5___default());\noptions.setAttributes = (_node_modules_style_loader_dist_runtime_setAttributesWithoutAttributes_js__WEBPACK_IMPORTED_MODULE_3___default());\n\n      options.insert = _node_modules_style_loader_dist_runtime_insertBySelector_js__WEBPACK_IMPORTED_MODULE_2___default().bind(null, \"head\");\n    \noptions.domAPI = (_node_modules_style_loader_dist_runtime_styleDomAPI_js__WEBPACK_IMPORTED_MODULE_1___default());\noptions.insertStyleElement = (_node_modules_style_loader_dist_runtime_insertStyleElement_js__WEBPACK_IMPORTED_MODULE_4___default());\n\nvar update = _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default()(_node_modules_css_loader_dist_cjs_js_node_modules_less_loader_dist_cjs_js_styles_less__WEBPACK_IMPORTED_MODULE_6__[\"default\"], options);\n\n\n\n\n       /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_css_loader_dist_cjs_js_node_modules_less_loader_dist_cjs_js_styles_less__WEBPACK_IMPORTED_MODULE_6__[\"default\"] && _node_modules_css_loader_dist_cjs_js_node_modules_less_loader_dist_cjs_js_styles_less__WEBPACK_IMPORTED_MODULE_6__[\"default\"].locals ? _node_modules_css_loader_dist_cjs_js_node_modules_less_loader_dist_cjs_js_styles_less__WEBPACK_IMPORTED_MODULE_6__[\"default\"].locals : undefined);\n\n\n//# sourceURL=webpack://labproject/./src/styles.less?");

/***/ }),

/***/ "./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js":
/*!****************************************************************************!*\
  !*** ./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js ***!
  \****************************************************************************/
/***/ ((module) => {

"use strict";
eval("\n\nvar stylesInDOM = [];\n\nfunction getIndexByIdentifier(identifier) {\n  var result = -1;\n\n  for (var i = 0; i < stylesInDOM.length; i++) {\n    if (stylesInDOM[i].identifier === identifier) {\n      result = i;\n      break;\n    }\n  }\n\n  return result;\n}\n\nfunction modulesToDom(list, options) {\n  var idCountMap = {};\n  var identifiers = [];\n\n  for (var i = 0; i < list.length; i++) {\n    var item = list[i];\n    var id = options.base ? item[0] + options.base : item[0];\n    var count = idCountMap[id] || 0;\n    var identifier = \"\".concat(id, \" \").concat(count);\n    idCountMap[id] = count + 1;\n    var indexByIdentifier = getIndexByIdentifier(identifier);\n    var obj = {\n      css: item[1],\n      media: item[2],\n      sourceMap: item[3],\n      supports: item[4],\n      layer: item[5]\n    };\n\n    if (indexByIdentifier !== -1) {\n      stylesInDOM[indexByIdentifier].references++;\n      stylesInDOM[indexByIdentifier].updater(obj);\n    } else {\n      var updater = addElementStyle(obj, options);\n      options.byIndex = i;\n      stylesInDOM.splice(i, 0, {\n        identifier: identifier,\n        updater: updater,\n        references: 1\n      });\n    }\n\n    identifiers.push(identifier);\n  }\n\n  return identifiers;\n}\n\nfunction addElementStyle(obj, options) {\n  var api = options.domAPI(options);\n  api.update(obj);\n\n  var updater = function updater(newObj) {\n    if (newObj) {\n      if (newObj.css === obj.css && newObj.media === obj.media && newObj.sourceMap === obj.sourceMap && newObj.supports === obj.supports && newObj.layer === obj.layer) {\n        return;\n      }\n\n      api.update(obj = newObj);\n    } else {\n      api.remove();\n    }\n  };\n\n  return updater;\n}\n\nmodule.exports = function (list, options) {\n  options = options || {};\n  list = list || [];\n  var lastIdentifiers = modulesToDom(list, options);\n  return function update(newList) {\n    newList = newList || [];\n\n    for (var i = 0; i < lastIdentifiers.length; i++) {\n      var identifier = lastIdentifiers[i];\n      var index = getIndexByIdentifier(identifier);\n      stylesInDOM[index].references--;\n    }\n\n    var newLastIdentifiers = modulesToDom(newList, options);\n\n    for (var _i = 0; _i < lastIdentifiers.length; _i++) {\n      var _identifier = lastIdentifiers[_i];\n\n      var _index = getIndexByIdentifier(_identifier);\n\n      if (stylesInDOM[_index].references === 0) {\n        stylesInDOM[_index].updater();\n\n        stylesInDOM.splice(_index, 1);\n      }\n    }\n\n    lastIdentifiers = newLastIdentifiers;\n  };\n};\n\n//# sourceURL=webpack://labproject/./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js?");

/***/ }),

/***/ "./node_modules/style-loader/dist/runtime/insertBySelector.js":
/*!********************************************************************!*\
  !*** ./node_modules/style-loader/dist/runtime/insertBySelector.js ***!
  \********************************************************************/
/***/ ((module) => {

"use strict";
eval("\n\nvar memo = {};\n/* istanbul ignore next  */\n\nfunction getTarget(target) {\n  if (typeof memo[target] === \"undefined\") {\n    var styleTarget = document.querySelector(target); // Special case to return head of iframe instead of iframe itself\n\n    if (window.HTMLIFrameElement && styleTarget instanceof window.HTMLIFrameElement) {\n      try {\n        // This will throw an exception if access to iframe is blocked\n        // due to cross-origin restrictions\n        styleTarget = styleTarget.contentDocument.head;\n      } catch (e) {\n        // istanbul ignore next\n        styleTarget = null;\n      }\n    }\n\n    memo[target] = styleTarget;\n  }\n\n  return memo[target];\n}\n/* istanbul ignore next  */\n\n\nfunction insertBySelector(insert, style) {\n  var target = getTarget(insert);\n\n  if (!target) {\n    throw new Error(\"Couldn't find a style target. This probably means that the value for the 'insert' parameter is invalid.\");\n  }\n\n  target.appendChild(style);\n}\n\nmodule.exports = insertBySelector;\n\n//# sourceURL=webpack://labproject/./node_modules/style-loader/dist/runtime/insertBySelector.js?");

/***/ }),

/***/ "./node_modules/style-loader/dist/runtime/insertStyleElement.js":
/*!**********************************************************************!*\
  !*** ./node_modules/style-loader/dist/runtime/insertStyleElement.js ***!
  \**********************************************************************/
/***/ ((module) => {

"use strict";
eval("\n\n/* istanbul ignore next  */\nfunction insertStyleElement(options) {\n  var element = document.createElement(\"style\");\n  options.setAttributes(element, options.attributes);\n  options.insert(element, options.options);\n  return element;\n}\n\nmodule.exports = insertStyleElement;\n\n//# sourceURL=webpack://labproject/./node_modules/style-loader/dist/runtime/insertStyleElement.js?");

/***/ }),

/***/ "./node_modules/style-loader/dist/runtime/setAttributesWithoutAttributes.js":
/*!**********************************************************************************!*\
  !*** ./node_modules/style-loader/dist/runtime/setAttributesWithoutAttributes.js ***!
  \**********************************************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

"use strict";
eval("\n\n/* istanbul ignore next  */\nfunction setAttributesWithoutAttributes(styleElement) {\n  var nonce =  true ? __webpack_require__.nc : 0;\n\n  if (nonce) {\n    styleElement.setAttribute(\"nonce\", nonce);\n  }\n}\n\nmodule.exports = setAttributesWithoutAttributes;\n\n//# sourceURL=webpack://labproject/./node_modules/style-loader/dist/runtime/setAttributesWithoutAttributes.js?");

/***/ }),

/***/ "./node_modules/style-loader/dist/runtime/styleDomAPI.js":
/*!***************************************************************!*\
  !*** ./node_modules/style-loader/dist/runtime/styleDomAPI.js ***!
  \***************************************************************/
/***/ ((module) => {

"use strict";
eval("\n\n/* istanbul ignore next  */\nfunction apply(styleElement, options, obj) {\n  var css = \"\";\n\n  if (obj.supports) {\n    css += \"@supports (\".concat(obj.supports, \") {\");\n  }\n\n  if (obj.media) {\n    css += \"@media \".concat(obj.media, \" {\");\n  }\n\n  var needLayer = typeof obj.layer !== \"undefined\";\n\n  if (needLayer) {\n    css += \"@layer\".concat(obj.layer.length > 0 ? \" \".concat(obj.layer) : \"\", \" {\");\n  }\n\n  css += obj.css;\n\n  if (needLayer) {\n    css += \"}\";\n  }\n\n  if (obj.media) {\n    css += \"}\";\n  }\n\n  if (obj.supports) {\n    css += \"}\";\n  }\n\n  var sourceMap = obj.sourceMap;\n\n  if (sourceMap && typeof btoa !== \"undefined\") {\n    css += \"\\n/*# sourceMappingURL=data:application/json;base64,\".concat(btoa(unescape(encodeURIComponent(JSON.stringify(sourceMap)))), \" */\");\n  } // For old IE\n\n  /* istanbul ignore if  */\n\n\n  options.styleTagTransform(css, styleElement, options.options);\n}\n\nfunction removeStyleElement(styleElement) {\n  // istanbul ignore if\n  if (styleElement.parentNode === null) {\n    return false;\n  }\n\n  styleElement.parentNode.removeChild(styleElement);\n}\n/* istanbul ignore next  */\n\n\nfunction domAPI(options) {\n  var styleElement = options.insertStyleElement(options);\n  return {\n    update: function update(obj) {\n      apply(styleElement, options, obj);\n    },\n    remove: function remove() {\n      removeStyleElement(styleElement);\n    }\n  };\n}\n\nmodule.exports = domAPI;\n\n//# sourceURL=webpack://labproject/./node_modules/style-loader/dist/runtime/styleDomAPI.js?");

/***/ }),

/***/ "./node_modules/style-loader/dist/runtime/styleTagTransform.js":
/*!*********************************************************************!*\
  !*** ./node_modules/style-loader/dist/runtime/styleTagTransform.js ***!
  \*********************************************************************/
/***/ ((module) => {

"use strict";
eval("\n\n/* istanbul ignore next  */\nfunction styleTagTransform(css, styleElement) {\n  if (styleElement.styleSheet) {\n    styleElement.styleSheet.cssText = css;\n  } else {\n    while (styleElement.firstChild) {\n      styleElement.removeChild(styleElement.firstChild);\n    }\n\n    styleElement.appendChild(document.createTextNode(css));\n  }\n}\n\nmodule.exports = styleTagTransform;\n\n//# sourceURL=webpack://labproject/./node_modules/style-loader/dist/runtime/styleTagTransform.js?");

/***/ }),

/***/ "./src/index.js":
/*!**********************!*\
  !*** ./src/index.js ***!
  \**********************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _src_styles_less__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../../../src/styles.less */ \"./src/styles.less\");\n/* harmony import */ var _src_script_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../../../src/script.js */ \"./src/script.js\");\n/* harmony import */ var _src_script_js__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_src_script_js__WEBPACK_IMPORTED_MODULE_1__);\n\r\n\n\n//# sourceURL=webpack://labproject/./src/index.js?");

/***/ }),

/***/ "./src/script.js":
/*!***********************!*\
  !*** ./src/script.js ***!
  \***********************/
/***/ (() => {

eval("productCart = document.querySelectorAll('.catalog product-card'),\r\ncartContent = document.getElementById('cart_content');\r\n\r\n//Function cross-browser installation of the event handler\r\nfunction addEvent(elem, type, handler){\r\n  if(elem.addEventListener){\r\n    elem.addEventListener(type, handler, false);\r\n  } else {\r\n    elem.attachEvent('on'+type, function(){ handler.call( elem ); });\r\n  }\r\n  return false;\r\n}\r\n\r\n//Function of Writting data to LocalStorage\r\nfunction setCartData(o){\r\n    localStorage.setItem('cart', JSON.stringify(o));\r\n    return false;\r\n  }\r\n\r\n//Function of Getting data from LocalStorage\r\nfunction getCartData(){\r\n  return JSON.parse(localStorage.getItem('cart'));\r\n}\r\n\r\n//Function of Addition a product to the cart\r\nfunction addToCart(e){\r\n  this.disabled = true;\r\n  var cartData = getCartData() || {},\r\n      parentBox = ((this.parentNode).parentNode).parentNode,\r\n      itemId = this.getAttribute('data-id'),\r\n      itemAmount = this.parentNode.querySelector('.catalog product-card amount').innerHTML,\r\n      itemTitle = parentBox.querySelector('a.catalog product-card text').innerHTML,\r\n      itemPrice = parentBox.querySelector('.catalog product-card price').innerHTML;\r\n  if(cartData.hasOwnProperty(itemId)){\r\n    cartData[itemId][2] += itemAmount;\r\n  } else {\r\n    cartData[itemId] = [itemTitle, itemPrice, itemAmount];\r\n  }\r\n  if(!setCartData(cartData)){\r\n    this.disabled = false;\r\n  }\r\n return false;\r\n}\r\n\r\n//Set an event handler for each Add-Product button\r\nfor(var i = 0; i < productCart.length; i++){\r\n  addEvent(productCart[i].querySelector('.add-product'), 'click', addToCart);\r\n}\r\n\r\n//Function of Openning the cart with a list of added products\r\nfunction openCart(e){\r\n  var cartData = getCartData(),\r\n      totalItems = '';\r\n  if(cartData !== null){\r\n    totalItems = '<table class=\"shopping_list\"><tr><th>Наименование</th><th>Цена</th><th>Кол-во</th></tr>';\r\n    for(var items in cartData){\r\n      totalItems += '<tr>';\r\n      for(var i = 0; i < cartData[items].length; i++){\r\n        totalItems += '<td>' + cartData[items][i] + '</td>';\r\n      }\r\n      totalItems += '</tr>';\r\n    }\r\n    totalItems += '</table>';\r\n    cartContent.innerHTML = totalItems;\r\n  } else {\r\n    cartContent.innerHTML = 'В корзине пусто!';\r\n  }\r\n  return false;\r\n}\r\n\r\n//Open cart\r\naddEvent(document.getElementById('open_cart'), 'click', openCart);\r\n\r\n//Clear cart\r\naddEvent(document.getElementById('clear_cart'), 'click', function(e){\r\n  localStorage.removeItem('cart');\r\n  cartContent.innerHTML = 'Корзина очищена.';\r\n});\n\n//# sourceURL=webpack://labproject/./src/script.js?");

/***/ }),

/***/ "../src/pics/background.png":
/*!**********************************!*\
  !*** ../src/pics/background.png ***!
  \**********************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

"use strict";
eval("module.exports = __webpack_require__.p + \"cd0c0bfb4be74490d486.png\";\n\n//# sourceURL=webpack://labproject/../src/pics/background.png?");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			id: moduleId,
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/global */
/******/ 	(() => {
/******/ 		__webpack_require__.g = (function() {
/******/ 			if (typeof globalThis === 'object') return globalThis;
/******/ 			try {
/******/ 				return this || new Function('return this')();
/******/ 			} catch (e) {
/******/ 				if (typeof window === 'object') return window;
/******/ 			}
/******/ 		})();
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/publicPath */
/******/ 	(() => {
/******/ 		var scriptUrl;
/******/ 		if (__webpack_require__.g.importScripts) scriptUrl = __webpack_require__.g.location + "";
/******/ 		var document = __webpack_require__.g.document;
/******/ 		if (!scriptUrl && document) {
/******/ 			if (document.currentScript)
/******/ 				scriptUrl = document.currentScript.src
/******/ 			if (!scriptUrl) {
/******/ 				var scripts = document.getElementsByTagName("script");
/******/ 				if(scripts.length) scriptUrl = scripts[scripts.length - 1].src
/******/ 			}
/******/ 		}
/******/ 		// When supporting browsers where an automatic publicPath is not supported you must specify an output.publicPath manually via configuration
/******/ 		// or pass an empty string ("") and set the __webpack_public_path__ variable from your code to use your own logic.
/******/ 		if (!scriptUrl) throw new Error("Automatic publicPath is not supported in this browser");
/******/ 		scriptUrl = scriptUrl.replace(/#.*$/, "").replace(/\?.*$/, "").replace(/\/[^\/]+$/, "/");
/******/ 		__webpack_require__.p = scriptUrl;
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		__webpack_require__.b = document.baseURI || self.location.href;
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"main": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		// no on chunks loaded
/******/ 		
/******/ 		// no jsonp function
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/nonce */
/******/ 	(() => {
/******/ 		__webpack_require__.nc = undefined;
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval devtool is used.
/******/ 	var __webpack_exports__ = __webpack_require__("./src/index.js");
/******/ 	
/******/ })()
;