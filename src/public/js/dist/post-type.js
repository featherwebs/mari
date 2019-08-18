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
/******/ 	return __webpack_require__(__webpack_require__.s = 29);
/******/ })
/************************************************************************/
/******/ ({

/***/ 29:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(30);


/***/ }),

/***/ 30:
/***/ (function(module, exports) {

var _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the post. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

var app = new Vue({
  el: '#post-type-app',
  data: {
    post_type: typeof post_type === 'undefined' ? {
      title: '',
      custom: [],
      alias: []
    } : post_type,
    post_types: typeof post_types === 'undefined' ? [] : post_types,
    custom_types: [{
      'title': 'Multiple Images',
      'slug': 'multiple-images'
    }, {
      'title': 'Image',
      'slug': 'image'
    }, {
      'title': 'Formatted Text',
      'slug': 'formatted-text'
    }, {
      'title': 'Raw Text',
      'slug': 'raw-text'
    }, {
      'title': 'Number',
      'slug': 'number'
    }, {
      'title': 'Date',
      'slug': 'date'
    }, {
      'title': 'Time',
      'slug': 'time'
    }, {
      'title': 'Select',
      'slug': 'select'
    }, {
      'title': 'Single Post Type',
      'slug': 'post-type'
    }, {
      'title': 'Multiple Post Type',
      'slug': 'post-type-multiple'
    }, {
      'title': 'File',
      'slug': 'file'
    }, {
      'title': 'Map',
      'slug': 'map'
    }],
    aliases: [{
      'slug': 'title',
      'title': 'Title',
      'alias': 'Title',
      'required': true,
      'visible': true,
      'default': ''
    }, {
      'slug': 'slug',
      'title': 'Slug',
      'alias': 'Slug',
      'required': false,
      'visible': true,
      'default': ''
    }, {
      'slug': 'sub_title',
      'title': 'Sub Title',
      'alias': 'Sub Title',
      'required': false,
      'visible': true,
      'default': ''
    }, {
      'slug': 'content',
      'title': 'Content',
      'alias': 'Content',
      'required': false,
      'visible': true,
      'default': ''
    }, {
      'slug': 'is_published',
      'title': 'Is Published',
      'alias': 'Is Published',
      'required': false,
      'visible': true,
      'default': ''
    }, {
      'slug': 'is_featured',
      'title': 'Is Featured',
      'alias': 'Is Featured',
      'required': false,
      'visible': true,
      'default': ''
    }, {
      'slug': 'view',
      'title': 'Template',
      'alias': 'Template',
      'required': false,
      'visible': true,
      'default': '',
      'values': templates
    }, {
      'slug': 'meta',
      'title': 'Meta',
      'alias': 'Meta',
      'required': false,
      'visible': true
    }],
    new_custom: {
      slug: '',
      type: '',
      title: '',
      options: '',
      default: ''
    }
  },
  mounted: function mounted() {
    var _this = this;

    var aliases = this.aliases.map(function (def_alias) {
      var alias = _this.post_type.alias.find(function (a) {
        return a.slug == def_alias.slug;
      });
      return _extends({}, def_alias, alias);
    });

    this.post_type.alias = aliases;
  },

  watch: {},
  methods: {
    addCustomField: function addCustomField() {
      this.post_type.custom.push(Object.assign({}, this.new_custom));
    },
    removeCustomField: function removeCustomField(k) {
      this.post_type.custom.splice(k, 1);
    },
    getCustom: function getCustom(slug, prop) {
      var def = null;
      if (!this.post_type.custom) return def;
      var custom = this.post_type.custom.filter(function (a) {
        return a.slug == slug;
      });

      if (custom.length && custom[prop]) return custom[prop];

      return def;
    }
  }
});

/***/ })

/******/ });