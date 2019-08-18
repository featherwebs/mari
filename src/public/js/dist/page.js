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
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
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
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 12);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports) {

/* globals __VUE_SSR_CONTEXT__ */

// IMPORTANT: Do NOT use ES2015 features in this file.
// This module is a runtime utility for cleaner component module output and will
// be included in the final webpack user bundle.

module.exports = function normalizeComponent (
  rawScriptExports,
  compiledTemplate,
  functionalTemplate,
  injectStyles,
  scopeId,
  moduleIdentifier /* server only */
) {
  var esModule
  var scriptExports = rawScriptExports = rawScriptExports || {}

  // ES6 modules interop
  var type = typeof rawScriptExports.default
  if (type === 'object' || type === 'function') {
    esModule = rawScriptExports
    scriptExports = rawScriptExports.default
  }

  // Vue.extend constructor export interop
  var options = typeof scriptExports === 'function'
    ? scriptExports.options
    : scriptExports

  // render functions
  if (compiledTemplate) {
    options.render = compiledTemplate.render
    options.staticRenderFns = compiledTemplate.staticRenderFns
    options._compiled = true
  }

  // functional template
  if (functionalTemplate) {
    options.functional = true
  }

  // scopedId
  if (scopeId) {
    options._scopeId = scopeId
  }

  var hook
  if (moduleIdentifier) { // server build
    hook = function (context) {
      // 2.3 injection
      context =
        context || // cached call
        (this.$vnode && this.$vnode.ssrContext) || // stateful
        (this.parent && this.parent.$vnode && this.parent.$vnode.ssrContext) // functional
      // 2.2 with runInNewContext: true
      if (!context && typeof __VUE_SSR_CONTEXT__ !== 'undefined') {
        context = __VUE_SSR_CONTEXT__
      }
      // inject component styles
      if (injectStyles) {
        injectStyles.call(this, context)
      }
      // register component module identifier for async chunk inferrence
      if (context && context._registeredComponents) {
        context._registeredComponents.add(moduleIdentifier)
      }
    }
    // used by ssr in case component is cached and beforeCreate
    // never gets called
    options._ssrRegister = hook
  } else if (injectStyles) {
    hook = injectStyles
  }

  if (hook) {
    var functional = options.functional
    var existing = functional
      ? options.render
      : options.beforeCreate

    if (!functional) {
      // inject component registration as beforeCreate hook
      options.beforeCreate = existing
        ? [].concat(existing, hook)
        : [hook]
    } else {
      // for template-only hot-reload because in that case the render fn doesn't
      // go through the normalizer
      options._injectStyles = hook
      // register for functioal component in vue file
      options.render = function renderWithStyleInjection (h, context) {
        hook.call(context)
        return existing(h, context)
      }
    }
  }

  return {
    esModule: esModule,
    exports: scriptExports,
    options: options
  }
}


/***/ }),
/* 1 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(2)
/* template */
var __vue_template__ = __webpack_require__(3)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/assets/js/components/ImageSelector.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-d7841e9a", Component.options)
  } else {
    hotAPI.reload("data-v-d7841e9a", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 2 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
var _typeof = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function (obj) { return typeof obj; } : function (obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; };

//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  props: ['name', 'value', 'type', 'hidevalue'],
  data: function data() {
    return {
      id: Math.random().toString(36).substring(8),
      def: 'http://via.placeholder.com/250x250?text=x'
    };
  },
  mounted: function mounted() {
    if (typeof this.value == 'string') {
      this.img = this.value;
    } else if (this.value && _typeof(this.value) == 'object' && this.value.path) {
      this.img = this.value.url;
    } else if (this.type != 'file') {
      this.img = this.def;
    }
    $('#btn-' + this.id).filemanager('image');
    $('#btn-file-' + this.id).filemanager('file');
    $('#holder-wrapper-' + this.id).filemanager('image');
    $('#holder-file-wrapper-' + this.id).filemanager('file');
  },

  methods: {},
  watch: {
    value: function value(_value) {
      this.$emit('input', _value);
    }
  }
});

/***/ }),
/* 3 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    _vm.type != "file"
      ? _c(
          "div",
          {
            staticClass: "thumbnail",
            attrs: {
              id: "holder-wrapper-" + _vm.id,
              "data-input": "thumbnail-" + _vm.id,
              "data-preview": "holder-" + _vm.id
            }
          },
          [_c("img", { attrs: { id: "holder-" + _vm.id, src: _vm.value } })]
        )
      : _vm._e(),
    _vm._v(" "),
    _c("div", { staticClass: "input-group" }, [
      _c("div", { staticClass: "input-group-btn" }, [
        _vm.type == "file"
          ? _c(
              "a",
              {
                staticClass: "btn btn-primary",
                attrs: {
                  id: "btn-file-" + _vm.id,
                  "data-input": "thumbnail-" + _vm.id,
                  "data-preview": "holder-" + _vm.id
                }
              },
              [
                _c("i", { staticClass: "fa fa-file-o" }),
                _vm._v(" Choose\n\t\t\t")
              ]
            )
          : _c(
              "a",
              {
                staticClass: "btn btn-primary",
                attrs: {
                  id: "btn-" + _vm.id,
                  "data-input": "thumbnail-" + _vm.id,
                  "data-preview": "holder-" + _vm.id
                }
              },
              [
                _c("i", { staticClass: "fa fa-picture-o" }),
                _vm._v(" Choose\n\t\t\t")
              ]
            )
      ]),
      _vm._v(" "),
      (_vm.hidevalue === false ? "text" : "hidden") === "checkbox"
        ? _c("input", {
            directives: [
              {
                name: "model",
                rawName: "v-model",
                value: _vm.value,
                expression: "value"
              }
            ],
            staticClass: "form-control",
            attrs: {
              id: "thumbnail-" + _vm.id,
              name: _vm.name,
              type: "checkbox"
            },
            domProps: {
              checked: Array.isArray(_vm.value)
                ? _vm._i(_vm.value, null) > -1
                : _vm.value
            },
            on: {
              change: function($event) {
                var $$a = _vm.value,
                  $$el = $event.target,
                  $$c = $$el.checked ? true : false
                if (Array.isArray($$a)) {
                  var $$v = null,
                    $$i = _vm._i($$a, $$v)
                  if ($$el.checked) {
                    $$i < 0 && (_vm.value = $$a.concat([$$v]))
                  } else {
                    $$i > -1 &&
                      (_vm.value = $$a.slice(0, $$i).concat($$a.slice($$i + 1)))
                  }
                } else {
                  _vm.value = $$c
                }
              }
            }
          })
        : (_vm.hidevalue === false ? "text" : "hidden") === "radio"
          ? _c("input", {
              directives: [
                {
                  name: "model",
                  rawName: "v-model",
                  value: _vm.value,
                  expression: "value"
                }
              ],
              staticClass: "form-control",
              attrs: {
                id: "thumbnail-" + _vm.id,
                name: _vm.name,
                type: "radio"
              },
              domProps: { checked: _vm._q(_vm.value, null) },
              on: {
                change: function($event) {
                  _vm.value = null
                }
              }
            })
          : _c("input", {
              directives: [
                {
                  name: "model",
                  rawName: "v-model",
                  value: _vm.value,
                  expression: "value"
                }
              ],
              staticClass: "form-control",
              attrs: {
                id: "thumbnail-" + _vm.id,
                name: _vm.name,
                type: _vm.hidevalue === false ? "text" : "hidden"
              },
              domProps: { value: _vm.value },
              on: {
                input: function($event) {
                  if ($event.target.composing) {
                    return
                  }
                  _vm.value = $event.target.value
                }
              }
            })
    ])
  ])
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-d7841e9a", module.exports)
  }
}

/***/ }),
/* 4 */
/***/ (function(module, exports) {

/*
	MIT License http://www.opensource.org/licenses/mit-license.php
	Author Tobias Koppers @sokra
*/
// css base code, injected by the css-loader
module.exports = function(useSourceMap) {
	var list = [];

	// return the list of modules as css string
	list.toString = function toString() {
		return this.map(function (item) {
			var content = cssWithMappingToString(item, useSourceMap);
			if(item[2]) {
				return "@media " + item[2] + "{" + content + "}";
			} else {
				return content;
			}
		}).join("");
	};

	// import a list of modules into the list
	list.i = function(modules, mediaQuery) {
		if(typeof modules === "string")
			modules = [[null, modules, ""]];
		var alreadyImportedModules = {};
		for(var i = 0; i < this.length; i++) {
			var id = this[i][0];
			if(typeof id === "number")
				alreadyImportedModules[id] = true;
		}
		for(i = 0; i < modules.length; i++) {
			var item = modules[i];
			// skip already imported module
			// this implementation is not 100% perfect for weird media query combinations
			//  when a module is imported multiple times with different media queries.
			//  I hope this will never occur (Hey this way we have smaller bundles)
			if(typeof item[0] !== "number" || !alreadyImportedModules[item[0]]) {
				if(mediaQuery && !item[2]) {
					item[2] = mediaQuery;
				} else if(mediaQuery) {
					item[2] = "(" + item[2] + ") and (" + mediaQuery + ")";
				}
				list.push(item);
			}
		}
	};
	return list;
};

function cssWithMappingToString(item, useSourceMap) {
	var content = item[1] || '';
	var cssMapping = item[3];
	if (!cssMapping) {
		return content;
	}

	if (useSourceMap && typeof btoa === 'function') {
		var sourceMapping = toComment(cssMapping);
		var sourceURLs = cssMapping.sources.map(function (source) {
			return '/*# sourceURL=' + cssMapping.sourceRoot + source + ' */'
		});

		return [content].concat(sourceURLs).concat([sourceMapping]).join('\n');
	}

	return [content].join('\n');
}

// Adapted from convert-source-map (MIT)
function toComment(sourceMap) {
	// eslint-disable-next-line no-undef
	var base64 = btoa(unescape(encodeURIComponent(JSON.stringify(sourceMap))));
	var data = 'sourceMappingURL=data:application/json;charset=utf-8;base64,' + base64;

	return '/*# ' + data + ' */';
}


/***/ }),
/* 5 */
/***/ (function(module, exports, __webpack_require__) {

/*
  MIT License http://www.opensource.org/licenses/mit-license.php
  Author Tobias Koppers @sokra
  Modified by Evan You @yyx990803
*/

var hasDocument = typeof document !== 'undefined'

if (typeof DEBUG !== 'undefined' && DEBUG) {
  if (!hasDocument) {
    throw new Error(
    'vue-style-loader cannot be used in a non-browser environment. ' +
    "Use { target: 'node' } in your Webpack config to indicate a server-rendering environment."
  ) }
}

var listToStyles = __webpack_require__(9)

/*
type StyleObject = {
  id: number;
  parts: Array<StyleObjectPart>
}

type StyleObjectPart = {
  css: string;
  media: string;
  sourceMap: ?string
}
*/

var stylesInDom = {/*
  [id: number]: {
    id: number,
    refs: number,
    parts: Array<(obj?: StyleObjectPart) => void>
  }
*/}

var head = hasDocument && (document.head || document.getElementsByTagName('head')[0])
var singletonElement = null
var singletonCounter = 0
var isProduction = false
var noop = function () {}

// Force single-tag solution on IE6-9, which has a hard limit on the # of <style>
// tags it will allow on a page
var isOldIE = typeof navigator !== 'undefined' && /msie [6-9]\b/.test(navigator.userAgent.toLowerCase())

module.exports = function (parentId, list, _isProduction) {
  isProduction = _isProduction

  var styles = listToStyles(parentId, list)
  addStylesToDom(styles)

  return function update (newList) {
    var mayRemove = []
    for (var i = 0; i < styles.length; i++) {
      var item = styles[i]
      var domStyle = stylesInDom[item.id]
      domStyle.refs--
      mayRemove.push(domStyle)
    }
    if (newList) {
      styles = listToStyles(parentId, newList)
      addStylesToDom(styles)
    } else {
      styles = []
    }
    for (var i = 0; i < mayRemove.length; i++) {
      var domStyle = mayRemove[i]
      if (domStyle.refs === 0) {
        for (var j = 0; j < domStyle.parts.length; j++) {
          domStyle.parts[j]()
        }
        delete stylesInDom[domStyle.id]
      }
    }
  }
}

function addStylesToDom (styles /* Array<StyleObject> */) {
  for (var i = 0; i < styles.length; i++) {
    var item = styles[i]
    var domStyle = stylesInDom[item.id]
    if (domStyle) {
      domStyle.refs++
      for (var j = 0; j < domStyle.parts.length; j++) {
        domStyle.parts[j](item.parts[j])
      }
      for (; j < item.parts.length; j++) {
        domStyle.parts.push(addStyle(item.parts[j]))
      }
      if (domStyle.parts.length > item.parts.length) {
        domStyle.parts.length = item.parts.length
      }
    } else {
      var parts = []
      for (var j = 0; j < item.parts.length; j++) {
        parts.push(addStyle(item.parts[j]))
      }
      stylesInDom[item.id] = { id: item.id, refs: 1, parts: parts }
    }
  }
}

function createStyleElement () {
  var styleElement = document.createElement('style')
  styleElement.type = 'text/css'
  head.appendChild(styleElement)
  return styleElement
}

function addStyle (obj /* StyleObjectPart */) {
  var update, remove
  var styleElement = document.querySelector('style[data-vue-ssr-id~="' + obj.id + '"]')

  if (styleElement) {
    if (isProduction) {
      // has SSR styles and in production mode.
      // simply do nothing.
      return noop
    } else {
      // has SSR styles but in dev mode.
      // for some reason Chrome can't handle source map in server-rendered
      // style tags - source maps in <style> only works if the style tag is
      // created and inserted dynamically. So we remove the server rendered
      // styles and inject new ones.
      styleElement.parentNode.removeChild(styleElement)
    }
  }

  if (isOldIE) {
    // use singleton mode for IE9.
    var styleIndex = singletonCounter++
    styleElement = singletonElement || (singletonElement = createStyleElement())
    update = applyToSingletonTag.bind(null, styleElement, styleIndex, false)
    remove = applyToSingletonTag.bind(null, styleElement, styleIndex, true)
  } else {
    // use multi-style-tag mode in all other cases
    styleElement = createStyleElement()
    update = applyToTag.bind(null, styleElement)
    remove = function () {
      styleElement.parentNode.removeChild(styleElement)
    }
  }

  update(obj)

  return function updateStyle (newObj /* StyleObjectPart */) {
    if (newObj) {
      if (newObj.css === obj.css &&
          newObj.media === obj.media &&
          newObj.sourceMap === obj.sourceMap) {
        return
      }
      update(obj = newObj)
    } else {
      remove()
    }
  }
}

var replaceText = (function () {
  var textStore = []

  return function (index, replacement) {
    textStore[index] = replacement
    return textStore.filter(Boolean).join('\n')
  }
})()

function applyToSingletonTag (styleElement, index, remove, obj) {
  var css = remove ? '' : obj.css

  if (styleElement.styleSheet) {
    styleElement.styleSheet.cssText = replaceText(index, css)
  } else {
    var cssNode = document.createTextNode(css)
    var childNodes = styleElement.childNodes
    if (childNodes[index]) styleElement.removeChild(childNodes[index])
    if (childNodes.length) {
      styleElement.insertBefore(cssNode, childNodes[index])
    } else {
      styleElement.appendChild(cssNode)
    }
  }
}

function applyToTag (styleElement, obj) {
  var css = obj.css
  var media = obj.media
  var sourceMap = obj.sourceMap

  if (media) {
    styleElement.setAttribute('media', media)
  }

  if (sourceMap) {
    // https://developer.chrome.com/devtools/docs/javascript-debugging
    // this makes source maps inside style tags work properly in Chrome
    css += '\n/*# sourceURL=' + sourceMap.sources[0] + ' */'
    // http://stackoverflow.com/a/26603875
    css += '\n/*# sourceMappingURL=data:application/json;base64,' + btoa(unescape(encodeURIComponent(JSON.stringify(sourceMap)))) + ' */'
  }

  if (styleElement.styleSheet) {
    styleElement.styleSheet.cssText = css
  } else {
    while (styleElement.firstChild) {
      styleElement.removeChild(styleElement.firstChild)
    }
    styleElement.appendChild(document.createTextNode(css))
  }
}


/***/ }),
/* 6 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(7)
}
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(10)
/* template */
var __vue_template__ = __webpack_require__(11)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/assets/js/components/Ckeditor.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-7bec72e8", Component.options)
  } else {
    hotAPI.reload("data-v-7bec72e8", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 7 */
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(8);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(5)("ccef1998", content, false);
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../node_modules/css-loader/index.js!../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-7bec72e8\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Ckeditor.vue", function() {
     var newContent = require("!!../../../../node_modules/css-loader/index.js!../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-7bec72e8\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Ckeditor.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),
/* 8 */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(4)(false);
// imports


// module
exports.push([module.i, "\n.ckeditor::after {\n\tcontent: \"\";\n\tdisplay: table;\n\tclear: both;\n}\n", ""]);

// exports


/***/ }),
/* 9 */
/***/ (function(module, exports) {

/**
 * Translates the list format produced by css-loader into something
 * easier to manipulate.
 */
module.exports = function listToStyles (parentId, list) {
  var styles = []
  var newStyles = {}
  for (var i = 0; i < list.length; i++) {
    var item = list[i]
    var id = item[0]
    var css = item[1]
    var media = item[2]
    var sourceMap = item[3]
    var part = {
      id: parentId + ':' + i,
      css: css,
      media: media,
      sourceMap: sourceMap
    }
    if (!newStyles[id]) {
      styles.push(newStyles[id] = { id: id, parts: [part] })
    } else {
      newStyles[id].parts.push(part)
    }
  }
  return styles
}


/***/ }),
/* 10 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//

var inc = new Date().getTime();

/* harmony default export */ __webpack_exports__["default"] = ({
    name: 'vue-ckeditor',
    props: {
        name: {
            type: String,
            default: function _default() {
                return 'editor-' + ++inc;
            }
        },
        value: {
            type: String
        },
        id: {
            type: String,
            default: function _default() {
                return 'editor-' + inc;
            }
        },
        types: {
            type: String,
            default: function _default() {
                return 'classic';
            }
        },
        config: {
            type: Object,
            default: function _default() {}
        }
    },
    data: function data() {
        return { destroyed: false };
    },

    computed: {
        instance: function instance() {
            return CKEDITOR.instances[this.id];
        }
    },
    watch: {
        value: function value(val) {
            if (this.instance) {
                this.update(val);
            }
        }
    },
    mounted: function mounted() {
        this.create();
    },
    beforeDestroy: function beforeDestroy() {
        this.destroy();
    },

    methods: {
        create: function create() {
            if (typeof CKEDITOR === 'undefined') {
                console.log('CKEDITOR is missing (http://ckeditor.com/)');
            } else {
                if (this.types === 'inline') {
                    CKEDITOR.inline(this.id, this.config);
                } else {
                    CKEDITOR.replace(this.id, this.config);
                }

                this.instance.setData(this.value);
                this.instance.on('change', this.onChange);
                this.instance.on('blur', this.onBlur);
                this.instance.on('focus', this.onFocus);
            }
        },
        update: function update(val) {
            var html = this.instance.getData();
            if (html !== val) {
                this.instance.setData(val);
            }
        },
        destroy: function destroy() {
            if (!this.destroyed) {
                this.instance.focusManager.blur(true);
                this.instance.removeAllListeners();
                this.instance.destroy();
                this.destroyed = true;
            }
        },
        onChange: function onChange() {
            var html = this.instance.getData();
            if (html !== this.value) {
                this.$emit('input', html);
            }
        },
        onBlur: function onBlur() {
            this.$emit('blur', this.instance);
        },
        onFocus: function onFocus() {
            this.$emit('focus', this.instance);
        }
    }
});

/***/ }),
/* 11 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "ckeditor" }, [
    _c("textarea", {
      attrs: {
        name: _vm.name,
        id: _vm.id,
        types: _vm.types,
        config: _vm.config
      },
      domProps: { value: _vm.value }
    })
  ])
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-7bec72e8", module.exports)
  }
}

/***/ }),
/* 12 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(13);


/***/ }),
/* 13 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__components_Ckeditor_vue__ = __webpack_require__(6);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__components_Ckeditor_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0__components_Ckeditor_vue__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__components_ImageSelector_vue__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__components_ImageSelector_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1__components_ImageSelector_vue__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__components_MapLocationSelector__ = __webpack_require__(16);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__components_MapLocationSelector___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_2__components_MapLocationSelector__);
var _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

function _toConsumableArray(arr) { if (Array.isArray(arr)) { for (var i = 0, arr2 = Array(arr.length); i < arr.length; i++) { arr2[i] = arr[i]; } return arr2; } else { return Array.from(arr); } }

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */




/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
var newPage = {
  title: '',
  sub_title: '',
  slug: '',
  content: '',
  meta_title: '',
  meta_description: '',
  meta_keywords: '',
  page_id: '',
  is_published: false,
  view: '',
  images: [],
  formatted: false,
  page_type: null,
  custom: [],
  posts: []
};
var createMode = typeof page === 'undefined';
var defaultPageType = {
  'id': null,
  'title': 'Default',
  'slug': 'default',
  'custom': [{
    "pivot": {
      "slug": "photo"
    },
    "slug": "photo",
    "type": "image",
    "title": "Image",
    "default": null
  }],
  'alias': [{
    "visible": "true",
    "alias": "Title",
    "slug": "title",
    "title": "Title",
    "required": "true",
    "default": null
  }, {
    "visible": "false",
    "alias": "Slug",
    "slug": "slug",
    "title": "Slug",
    "required": "false",
    "default": null
  }, {
    "visible": "true",
    "alias": "Sub Title",
    "slug": "sub_title",
    "title": "Sub Title",
    "required": "false",
    "default": null
  }, {
    "visible": "true",
    "alias": "Content",
    "slug": "content",
    "title": "Content",
    "required": "false",
    "default": null
  }, {
    "visible": "true",
    "alias": "Is Published",
    "slug": "is_published",
    "title": "Is Published",
    "required": "false",
    "default": "true"
  }, {
    "visible": "false",
    "alias": "Is Featured",
    "slug": "is_featured",
    "title": "Is Featured",
    "required": "false",
    "default": null
  }, {
    "visible": "true",
    "alias": "Meta",
    "slug": "meta",
    "title": "Meta",
    "required": "false",
    "default": null
  }]
};

window.pageapp = new Vue({
  el: '#page-app',
  data: {
    page: createMode ? newPage : Object.assign({}, newPage, page),
    page_types: [_extends({}, defaultPageType)].concat(_toConsumableArray(page_types)),
    posts: posts,
    new_image: {
      pivot: {
        slug: ''
      },
      title: '',
      thumbnail: ''
    },
    new_custom: {
      slug: '',
      value: ''
    },
    deleted_image_ids: [],

    editor: {
      allowedContent: true,
      height: 500
    }
  },
  mounted: function mounted() {
    // set the default post type
    if (!this.page.page_type && this.page_types.length) this.page.page_type = this.page_types[0];

    // fill the page custom data
    this.fillCustomFields();
  },

  watch: {
    'page.title': function pageTitle(value) {
      if (createMode) this.page.slug = this.slugify(value);
    },
    'page.slug': function pageSlug(value) {
      this.page.slug = this.slugify(value);
    },
    'page.view': function pageView(value) {
      this.page.page_type = this.page_types.find(function (t) {
        return t.id == value;
      });
    },
    'page.page_type': function pagePage_type(value) {
      this.page.view = value.id;
      this.fillCustomFields();
      this.updateSelect2();
    }
  },
  computed: {
    'page_type_images': function page_type_images() {
      if (this.page.page_type) return this.page.page_type.custom.filter(function (pt) {
        return pt.type == 'image' || pt.type == 'multiple-images';
      });
      return [];
    },
    'page_type_non_images': function page_type_non_images() {
      if (this.page.page_type) return this.page.page_type.custom.filter(function (pt) {
        return pt.type != 'image' && pt.type != 'multiple-images';
      });
      return [];
    }
  },
  methods: {
    addCustomField: function addCustomField() {
      this.page.custom.push(Object.assign({}, this.new_custom));
    },
    removeCustomField: function removeCustomField(k) {
      this.page.custom.splice(k, 1);
    },
    slugify: function slugify(text) {
      return text.toString().toLowerCase().replace(/\s+/g, '-') // Replace spaces with -
      .replace(/&/g, '') // Replace & with empty
      .replace(/[^\w\-]+/g, '') // Remove all non-word chars
      .replace(/\-\-+/g, '-') // Replace multiple - with single -
      .replace(/^-+/, '') // Trim - from start of text
      .replace(/-+$/, '') // Trim - from end of text
      .replace(/-$/, ''); // Remove last -
    },
    alias: function alias(slug) {
      var a = null;
      if (this.page.page_type && this.page.page_type.alias) a = this.page.page_type.alias.find(function (a) {
        return a.slug == slug;
      });

      if (a) return a.alias;

      return '';
    },
    alias_visible: function alias_visible(slug) {
      var a = null;
      if (this.page.page_type && this.page.page_type.alias) a = this.page.page_type.alias.find(function (a) {
        return a.slug == slug;
      });

      if (a) return a.visible === 'true' || a.visible === true;

      return false;
    },
    addImageField: function addImageField(slug) {
      this.page.images.push(Object.assign({}, this.new_image, {
        pivot: { slug: slug },
        slug: slug,
        type: 'multiple-images',
        id: Math.random().toString(36).substring(6)
      }));
    },
    removeImageField: function removeImageField(obj) {
      this.page.images = this.post.images.filter(function (i) {
        return i.id !== obj.id;
      });
    },
    fillCustomFields: function fillCustomFields() {
      var _this = this;

      var customData = [];

      this.page_type_non_images.map(function (field) {
        if (_this.page.custom.length) {
          var pageCustom = _this.page.custom.find(function (c) {
            return field.slug == c.slug;
          });
          customData.push(_extends({}, field, pageCustom, { id: field.id, title: field.title })); // id to preserve custom_field id in case of page_type type
        } else {
          if (field.slug == 'map') customData.push(_extends({}, field, { value: ',' }));else customData.push(_extends({}, field, { value: '' }));
        }
      });

      this.page.custom = customData;

      this.page_type_images.map(function (field) {
        if (!_this.page.images.filter(function (c) {
          return c.slug == field.slug || c.pivot && c.pivot.slug == field.slug;
        }).length) {
          field.thumbnail = null;
          field.url = PLACEHOLDER;
          _this.page.images.push(Object.assign({}, field));
        }
      });
    },
    locationupdated: function locationupdated(latlng, field) {
      field.value = latlng.lng + ',' + latlng.lat;
    },
    addPostsRelation: function addPostsRelation(slug, id, multiple) {
      var relatedPost = this.posts.find(function (p) {
        return p.id == id;
      });
      if (multiple) this.page.posts = [].concat(_toConsumableArray(this.page.posts), [_extends({}, relatedPost, { pivot: { slug: slug } })]);else this.page.posts = [].concat(_toConsumableArray(this.page.posts.filter(function (p) {
        return p.pivot.slug != slug;
      })), [_extends({}, relatedPost, { pivot: { slug: slug } })]);
    },
    removePostsRelation: function removePostsRelation(slug, id) {
      this.page.posts = this.page.posts.filter(function (p) {
        return p.pivot.slug == slug && p.id != id;
      });
    },
    updateSelect2: function updateSelect2() {
      var app = this;
      setTimeout(function () {
        $('.select2').each(function () {
          var that = this;
          var multiple = $(that).attr('multiple') !== undefined;
          $(that).select2().on('select2:select', function (e) {
            app.addPostsRelation($(that).data('slug'), e.params.data.id, multiple);
          }).on('select2:unselect', function (e) {
            app.removePostsRelation($(that).data('slug'), e.params.data.id);
          });
        });
      }, 500);
    }
  },
  components: {
    Ckeditor: __WEBPACK_IMPORTED_MODULE_0__components_Ckeditor_vue___default.a,
    ImageSelector: __WEBPACK_IMPORTED_MODULE_1__components_ImageSelector_vue___default.a,
    MapLocationSelector: __WEBPACK_IMPORTED_MODULE_2__components_MapLocationSelector___default.a
  }
});

/***/ }),
/* 14 */,
/* 15 */,
/* 16 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(17)
}
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(19)
/* template */
var __vue_template__ = __webpack_require__(20)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/assets/js/components/MapLocationSelector.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-a707226e", Component.options)
  } else {
    hotAPI.reload("data-v-a707226e", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 17 */
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(18);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(5)("a9057860", content, false);
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../node_modules/css-loader/index.js!../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-a707226e\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./MapLocationSelector.vue", function() {
     var newContent = require("!!../../../../node_modules/css-loader/index.js!../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-a707226e\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./MapLocationSelector.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),
/* 18 */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(4)(false);
// imports


// module
exports.push([module.i, "\n.controls {\n\tmargin-top: 13px;\n\tmax-width: 400px;\n}\n", ""]);

// exports


/***/ }),
/* 19 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  props: {
    latitude: {
      type: Number,
      default: 27.686884587085057
    },
    longitude: {
      type: Number,
      default: 85.34427752591353
    }
  },
  data: function data() {
    return {
      lat: this.latitude,
      lng: this.longitude
    };
  },
  mounted: function mounted() {
    // Set coordinates
    var myLatlng = new google.maps.LatLng(this.lat, this.lng);
    // Options
    var mapOptions = {
      zoom: 16,
      center: myLatlng
    };
    // Apply options
    var map = new google.maps.Map(this.$el, mapOptions);
    // Add marker
    var marker = new google.maps.Marker({
      position: myLatlng,
      map: map
    });
    marker.setMap(map);
    var self = this;
    google.maps.event.addListener(map, "center_changed", function () {
      var lat = map.getCenter().lat();
      var lon = map.getCenter().lng();
      var newLatLng = { lat: lat, lng: lon };
      marker.setPosition(newLatLng);
      self.$emit('locationupdated', newLatLng);
    });

    // Create the search box and link it to the UI element.
    var input = this.$refs.searchbox;
    var searchBox = new google.maps.places.SearchBox(input);
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

    // Bias the SearchBox results towards current map's viewport.
    map.addListener('bounds_changed', function () {
      searchBox.setBounds(map.getBounds());
    });

    var markers = [];
    // Listen for the event fired when the user selects a prediction and retrieve
    // more details for that place.
    searchBox.addListener('places_changed', function () {
      var places = searchBox.getPlaces();

      if (places.length == 0) {
        return;
      }

      // Clear out the old markers.
      markers.forEach(function (marker) {
        marker.setMap(null);
      });
      markers = [];

      // For each place, get the icon, name and location.
      var bounds = new google.maps.LatLngBounds();
      places.forEach(function (place) {
        if (!place.geometry) {
          console.log("Returned place contains no geometry");
          return;
        }
        var icon = {
          url: place.icon,
          size: new google.maps.Size(71, 71),
          origin: new google.maps.Point(0, 0),
          anchor: new google.maps.Point(17, 34),
          scaledSize: new google.maps.Size(25, 25)
        };

        // Create a marker for each place.
        markers.push(new google.maps.Marker({
          map: map,
          icon: icon,
          title: place.name,
          position: place.geometry.location
        }));

        if (place.geometry.viewport) {
          // Only geocodes have viewport.
          bounds.union(place.geometry.viewport);
        } else {
          bounds.extend(place.geometry.location);
        }
      });
      map.fitBounds(bounds);
    });
  }
});

/***/ }),
/* 20 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticStyle: { height: "350px" } }, [
    _c("input", {
      ref: "searchbox",
      staticClass: "controls form-control",
      attrs: { id: "pac-input", type: "text", placeholder: "Search Box" }
    }),
    _vm._v(" "),
    _c("div", { staticClass: "map-container" })
  ])
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-a707226e", module.exports)
  }
}

/***/ })
/******/ ]);