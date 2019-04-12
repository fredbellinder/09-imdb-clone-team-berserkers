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
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/bmd.js":
/*!*****************************!*\
  !*** ./resources/js/bmd.js ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports) {

var commentToDelete = $('.delete-comment');

function deleteComment(event) {
  var _this = this;

  event.preventDefault();
  $.ajax({
    url: "/comments/".concat(event.target[2].value),
    method: 'DELETE',
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  }).done(function () {
    $(_this).closest('.container-comment').remove();
  });
}

commentToDelete.on('submit', deleteComment);
var reviewToDelete = $('.delete-review');

function deleteReview(event) {
  var _this2 = this;

  event.preventDefault();
  console.log(event.target[2].value);
  $.ajax({
    url: "/reviews/".concat(event.target[2].value),
    method: 'DELETE',
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  }).done(function () {
    $(_this2).closest('.container-review').remove();
  });
}

reviewToDelete.on('submit', deleteReview);
var editReviewForm = $('.edit-review');

function editReview(event) {
  event.preventDefault();
  var review_id = event.target[1].value;
  var reviewInfo = $(this).closest('.container-review');
  var editReview = $(".edit-review-container-".concat(review_id));
  editReview.show();
  reviewInfo.hide();
  $(".edit-submit-".concat(review_id)).on('submit', function (event, reviewInfo) {
    event.preventDefault();
    $(".edit-review-container-".concat(review_id)).hide();
    editReview.hide();
    reviewInfo.show();
  });
  $(".edit-review-cancel").on('click', function (event) {
    event.preventDefault();
    $(".edit-review-container-".concat(review_id)).hide();
    reviewInfo.show();
  });
}

editReviewForm.on("submit", editReview);

/***/ }),

/***/ 1:
/*!***********************************!*\
  !*** multi ./resources/js/bmd.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/danielsalin/Develop/09-imdb-clone-team-berserkers/resources/js/bmd.js */"./resources/js/bmd.js");


/***/ })

/******/ });