/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/admin/ck-editor.js":
/*!*****************************************!*\
  !*** ./resources/js/admin/ck-editor.js ***!
  \*****************************************/
/*! no exports provided */
/***/ (function(module, exports) {

throw new Error("Module build failed (from ./node_modules/babel-loader/lib/index.js):\nSyntaxError: C:\\OSPanel\\domains\\admin-HB\\resources\\js\\admin\\ck-editor.js: Unterminated string constant (1:43)\n\n\u001b[0m\u001b[31m\u001b[1m>\u001b[22m\u001b[39m\u001b[90m 1 | \u001b[39m\u001b[33mCKEDITOR\u001b[39m\u001b[33m.\u001b[39mconfig\u001b[33m.\u001b[39muploadUrl \u001b[33m=\u001b[39m window\u001b[33m.\u001b[39m\u001b[33mBaseUrl\u001b[39m\u001b[33m+\u001b[39m\u001b[32m'/admin/ck-editor/upload-image;\u001b[39m\u001b[0m\n\u001b[0m \u001b[90m   | \u001b[39m                                           \u001b[31m\u001b[1m^\u001b[22m\u001b[39m\u001b[0m\n\u001b[0m \u001b[90m 2 | \u001b[39m\u001b[0m\n    at Parser.raise (C:\\OSPanel\\domains\\admin-HB\\node_modules\\@babel\\parser\\lib\\index.js:6400:17)\n    at Parser.readString (C:\\OSPanel\\domains\\admin-HB\\node_modules\\@babel\\parser\\lib\\index.js:7365:14)\n    at Parser.getTokenFromCode (C:\\OSPanel\\domains\\admin-HB\\node_modules\\@babel\\parser\\lib\\index.js:7027:14)\n    at Parser.nextToken (C:\\OSPanel\\domains\\admin-HB\\node_modules\\@babel\\parser\\lib\\index.js:6600:12)\n    at Parser.next (C:\\OSPanel\\domains\\admin-HB\\node_modules\\@babel\\parser\\lib\\index.js:6540:10)\n    at Parser.parseExprOp (C:\\OSPanel\\domains\\admin-HB\\node_modules\\@babel\\parser\\lib\\index.js:8395:14)\n    at Parser.parseExprOps (C:\\OSPanel\\domains\\admin-HB\\node_modules\\@babel\\parser\\lib\\index.js:8363:17)\n    at Parser.parseMaybeConditional (C:\\OSPanel\\domains\\admin-HB\\node_modules\\@babel\\parser\\lib\\index.js:8326:23)\n    at Parser.parseMaybeAssign (C:\\OSPanel\\domains\\admin-HB\\node_modules\\@babel\\parser\\lib\\index.js:8273:21)\n    at Parser.parseMaybeAssign (C:\\OSPanel\\domains\\admin-HB\\node_modules\\@babel\\parser\\lib\\index.js:8312:25)\n    at Parser.parseExpression (C:\\OSPanel\\domains\\admin-HB\\node_modules\\@babel\\parser\\lib\\index.js:8221:23)\n    at Parser.parseStatementContent (C:\\OSPanel\\domains\\admin-HB\\node_modules\\@babel\\parser\\lib\\index.js:10061:23)\n    at Parser.parseStatement (C:\\OSPanel\\domains\\admin-HB\\node_modules\\@babel\\parser\\lib\\index.js:9932:17)\n    at Parser.parseBlockOrModuleBlockBody (C:\\OSPanel\\domains\\admin-HB\\node_modules\\@babel\\parser\\lib\\index.js:10508:25)\n    at Parser.parseBlockBody (C:\\OSPanel\\domains\\admin-HB\\node_modules\\@babel\\parser\\lib\\index.js:10495:10)\n    at Parser.parseTopLevel (C:\\OSPanel\\domains\\admin-HB\\node_modules\\@babel\\parser\\lib\\index.js:9861:10)\n    at Parser.parse (C:\\OSPanel\\domains\\admin-HB\\node_modules\\@babel\\parser\\lib\\index.js:11373:17)\n    at parse (C:\\OSPanel\\domains\\admin-HB\\node_modules\\@babel\\parser\\lib\\index.js:11409:38)\n    at parser (C:\\OSPanel\\domains\\admin-HB\\node_modules\\@babel\\core\\lib\\transformation\\normalize-file.js:168:34)\n    at normalizeFile (C:\\OSPanel\\domains\\admin-HB\\node_modules\\@babel\\core\\lib\\transformation\\normalize-file.js:102:11)\n    at runSync (C:\\OSPanel\\domains\\admin-HB\\node_modules\\@babel\\core\\lib\\transformation\\index.js:44:43)\n    at runAsync (C:\\OSPanel\\domains\\admin-HB\\node_modules\\@babel\\core\\lib\\transformation\\index.js:35:14)\n    at process.nextTick (C:\\OSPanel\\domains\\admin-HB\\node_modules\\@babel\\core\\lib\\transform.js:34:34)\n    at process._tickCallback (internal/process/next_tick.js:61:11)");

/***/ }),

/***/ 2:
/*!***********************************************!*\
  !*** multi ./resources/js/admin/ck-editor.js ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\OSPanel\domains\admin-HB\resources\js\admin\ck-editor.js */"./resources/js/admin/ck-editor.js");


/***/ })

/******/ });