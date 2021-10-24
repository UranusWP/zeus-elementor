(function(){function r(e,n,t){function o(i,f){if(!n[i]){if(!e[i]){var c="function"==typeof require&&require;if(!f&&c)return c(i,!0);if(u)return u(i,!0);var a=new Error("Cannot find module '"+i+"'");throw a.code="MODULE_NOT_FOUND",a}var p=n[i]={exports:{}};e[i][0].call(p.exports,function(r){var n=e[i][1][r];return o(n||r)},p,p.exports,r,e,n,t)}return n[i].exports}for(var u="function"==typeof require&&require,i=0;i<t.length;i++)o(t[i]);return o}return r})()({1:[function(require,module,exports){
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.registerWidget = void 0;

var registerWidget = function registerWidget(className, widgetName) {
  var skin = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 'default';

  if (!(className || widgetName)) {
    return;
  }
  /**
   * Because Elementor plugin uses jQuery custom event,
   * We also have to use jQuery to use this event
   */


  jQuery(window).on('elementor/frontend/init', function () {
    var addHandler = function addHandler($element) {
      elementorFrontend.elementsHandler.addHandler(className, {
        $element: $element
      });
    };

    elementorFrontend.hooks.addAction("frontend/element_ready/".concat(widgetName, ".").concat(skin), addHandler);
  });
};

exports.registerWidget = registerWidget;

},{}],2:[function(require,module,exports){
"use strict";

function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.slideDown = exports.slideUp = exports.fadeOut = exports.fadeIn = void 0;

var _utils = require("../lib/utils");

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function"); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, writable: true, configurable: true } }); if (superClass) _setPrototypeOf(subClass, superClass); }

function _setPrototypeOf(o, p) { _setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) { o.__proto__ = p; return o; }; return _setPrototypeOf(o, p); }

function _createSuper(Derived) { var hasNativeReflectConstruct = _isNativeReflectConstruct(); return function _createSuperInternal() { var Super = _getPrototypeOf(Derived), result; if (hasNativeReflectConstruct) { var NewTarget = _getPrototypeOf(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return _possibleConstructorReturn(this, result); }; }

function _possibleConstructorReturn(self, call) { if (call && (_typeof(call) === "object" || typeof call === "function")) { return call; } return _assertThisInitialized(self); }

function _assertThisInitialized(self) { if (self === void 0) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return self; }

function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); return true; } catch (e) { return false; } }

function _getPrototypeOf(o) { _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf : function _getPrototypeOf(o) { return o.__proto__ || Object.getPrototypeOf(o); }; return _getPrototypeOf(o); }

var fadeIn = function fadeIn(element) {
  var speed = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : "normal";
  var display = arguments.length > 2 ? arguments[2] : undefined;
  var callback = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : null;
  element.style.opacity = 0;
  element.style.display = display || "block";

  var fade = function fade() {
    var opacity = parseFloat(element.style.opacity);

    if ((opacity += speed === "fast" ? 0.2 : 0.1) <= 1) {
      element.style.opacity = opacity;

      if (opacity === 1 && callback) {
        callback();
      }

      window.requestAnimationFrame(fade);
    }
  };

  window.requestAnimationFrame(fade);
};

exports.fadeIn = fadeIn;

var fadeOut = function fadeOut(element) {
  var speed = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : "normal";
  var display = arguments.length > 2 ? arguments[2] : undefined;
  var callback = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : null;
  element.style.opacity = 1;
  element.style.display = display || "block";

  var fade = function fade() {
    var opacity = parseFloat(element.style.opacity);

    if ((opacity -= speed === "fast" ? 0.2 : 0.1) < 0) {
      element.style.display = "none";
    } else {
      element.style.opacity = opacity;

      if (opacity === 0 && callback) {
        callback();
      }

      window.requestAnimationFrame(fade);
    }
  };

  window.requestAnimationFrame(fade);
};

exports.fadeOut = fadeOut;

var slideUp = function slideUp(element) {
  var duration = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 300;
  element.style.boxSizing = "border-box";
  element.style.transitionProperty = "height, margin, padding";
  element.style.transitionDuration = "".concat(duration, "ms");
  element.style.height = "".concat(element.offsetHeight, "px");
  element.style.paddingTop = 0;
  element.style.paddingBottom = 0;
  element.style.marginTop = 0;
  element.style.marginBottom = 0;
  element.style.overflow = "hidden";
  setTimeout(function () {
    element.style.height = 0;
  }, 10);
  window.setTimeout(function () {
    element.style.display = "none";
    element.style.removeProperty("height");
    element.style.removeProperty("padding-top");
    element.style.removeProperty("padding-bottom");
    element.style.removeProperty("margin-top");
    element.style.removeProperty("margin-bottom");
    element.style.removeProperty("overflow");
    element.style.removeProperty("transition-duration");
    element.style.removeProperty("transition-property");
  }, duration);
};

exports.slideUp = slideUp;

var slideDown = function slideDown(element) {
  var duration = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 300;
  element.style.removeProperty("display");
  var display = window.getComputedStyle(element).display;

  if (display === "none") {
    display = "block";
  }

  element.style.display = display;
  var height = element.offsetHeight;
  var paddingTop = window.getComputedStyle(element).paddingTop;
  var paddingBottom = window.getComputedStyle(element).paddingBottom;
  var marginTop = window.getComputedStyle(element).marginTop;
  var marginBottom = window.getComputedStyle(element).marginBottom;
  element.style.height = 0;
  element.style.paddingTop = 0;
  element.style.paddingBottom = 0;
  element.style.marginTop = 0;
  element.style.marginBottom = 0;
  element.style.overflow = "hidden";
  element.style.boxSizing = "border-box";
  element.style.transitionProperty = "height";
  element.style.transitionDuration = "".concat(duration, "ms");
  setTimeout(function () {
    element.style.height = "".concat(height, "px");

    if (paddingTop !== "0px" || paddingBottom !== "0px") {
      element.style.transitionProperty = "padding";
      element.style.transitionDuration = "".concat(duration / 1.2, "ms");
      element.style.paddingTop = paddingTop;
      element.style.paddingBottom = paddingBottom;
      element.style.marginTop = marginTop;
      element.style.marginBottom = marginBottom;
    }
  }, 10);
  window.setTimeout(function () {
    element.style.removeProperty("height");
    element.style.removeProperty("overflow");
    element.style.removeProperty("transition-duration");
    element.style.removeProperty("transition-property");
    element.style.removeProperty("padding-top");
    element.style.removeProperty("padding-bottom");
    element.style.removeProperty("margin-top");
    element.style.removeProperty("margin-bottom");
  }, duration);
};

exports.slideDown = slideDown;

var Zeus_Search = /*#__PURE__*/function (_elementorModules$fro) {
  _inherits(Zeus_Search, _elementorModules$fro);

  var _super = _createSuper(Zeus_Search);

  function Zeus_Search() {
    _classCallCheck(this, Zeus_Search);

    return _super.apply(this, arguments);
  }

  _createClass(Zeus_Search, [{
    key: "getDefaultSettings",
    value: function getDefaultSettings() {
      return {
        selectors: {
          search: ".zeus-search-wrap",
          searchForm: "form.zeus-searchform",
          searchInput: ".zeus-searchform input.field",
          searchResults: ".zeus-search-results",
          searchLoadingSpinner: ".zeus-search-wrap .zeus-ajax-loading"
        },
        ajaxSearchTimeoutID: null
      };
    }
  }, {
    key: "getDefaultElements",
    value: function getDefaultElements() {
      var element = this.$element.get(0);
      var selectors = this.getSettings("selectors");
      return {
        search: element.querySelector(selectors.search),
        searchForm: element.querySelector(selectors.searchForm),
        searchInput: element.querySelector(selectors.searchInput),
        searchResults: element.querySelector(selectors.searchResults),
        searchLoadingSpinner: element.querySelector(selectors.searchLoadingSpinner)
      };
    }
  }, {
    key: "bindEvents",
    value: function bindEvents() {
      var _this$elements$search, _this$elements$search2, _this$elements$search3;

      (_this$elements$search = this.elements.searchInput) === null || _this$elements$search === void 0 ? void 0 : _this$elements$search.addEventListener("keyup", this.onAjaxSearch.bind(this));
      (_this$elements$search2 = this.elements.searchForm) === null || _this$elements$search2 === void 0 ? void 0 : _this$elements$search2.addEventListener("submit", this.onSearchFormSubmit.bind(this));
      (_this$elements$search3 = this.elements.searchForm) === null || _this$elements$search3 === void 0 ? void 0 : _this$elements$search3.addEventListener("click", this.onSearchFormClick.bind(this));
      document.addEventListener("click", this.onDocumentClick.bind(this));
    }
  }, {
    key: "onAjaxSearch",
    value: function onAjaxSearch(event) {
      var sInput = this.elements.searchInput,
          sValue = this.elements.searchInput.value,
          sResult = this.elements.searchResults,
          sSpinner = this.elements.searchLoadingSpinner;
      clearTimeout(this.getSettings("ajaxSearchTimeoutID"));

      if (sValue.length > 2) {
        var ajaxSearchTimeoutID = setTimeout(function () {
          var httpRequest = new XMLHttpRequest();
          var formData = new FormData();
          formData.append("action", "zeus_ajax_search");
          formData.append("nonce", searchData.nonce);
          formData.append("search", sValue);
          formData.append("type", sInput.getAttribute('data-type'));

          httpRequest.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
              sResult.innerHTML = this.responseText;
              fadeIn(sSpinner, "fast");
              setTimeout(function () {
                slideDown(sResult, 400);
                sResult.classList.add("filled");
                fadeOut(sSpinner, "fast");
              }, 200);
            }
          };

          httpRequest.open("POST", searchData.ajax_url, true);
          httpRequest.send(formData);
        }, 400);
        this.setSettings({
          ajaxSearchTimeoutID: ajaxSearchTimeoutID
        });
      }
    }
  }, {
    key: "onSearchFormSubmit",
    value: function onSearchFormSubmit(event) {
      event.preventDefault();
    }
  }, {
    key: "onSearchFormClick",
    value: function onSearchFormClick(event) {
      var searchResults = this.elements.search.querySelector("".concat(this.getSettings("selectors.searchResults"), ".filled"));

      if (searchResults) {
        slideDown(searchResults, 400);
      }
    }
  }, {
    key: "onDocumentClick",
    value: function onDocumentClick(event) {
      // Close search results
      var searchArea = event.target.closest(this.getSettings("selectors.searchForm"));
      var searchResultsArea = event.target.closest(this.getSettings("selectors.searchResults"));

      if (!(searchArea || searchResultsArea)) {
        slideUp(this.elements.searchResults, 200);
      }
    }
  }]);

  return Zeus_Search;
}(elementorModules.frontend.handlers.Base);

(0, _utils.registerWidget)(Zeus_Search, "zeus-search");

},{"../lib/utils":1}]},{},[2])
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm5vZGVfbW9kdWxlcy9icm93c2VyLXBhY2svX3ByZWx1ZGUuanMiLCJzcmMvbGliL3V0aWxzLmpzIiwic3JjL3dpZGdldHMvc2VhcmNoLmpzIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUFBOzs7Ozs7OztBQ0FPLElBQU0sY0FBYyxHQUFHLFNBQWpCLGNBQWlCLENBQUMsU0FBRCxFQUFZLFVBQVosRUFBNkM7QUFBQSxNQUFyQixJQUFxQix1RUFBZCxTQUFjOztBQUN2RSxNQUFJLEVBQUUsU0FBUyxJQUFJLFVBQWYsQ0FBSixFQUFnQztBQUM1QjtBQUNIO0FBRUQ7QUFDSjtBQUNBO0FBQ0E7OztBQUNJLEVBQUEsTUFBTSxDQUFDLE1BQUQsQ0FBTixDQUFlLEVBQWYsQ0FBa0IseUJBQWxCLEVBQTZDLFlBQU07QUFDL0MsUUFBTSxVQUFVLEdBQUcsU0FBYixVQUFhLENBQUMsUUFBRCxFQUFjO0FBQzdCLE1BQUEsaUJBQWlCLENBQUMsZUFBbEIsQ0FBa0MsVUFBbEMsQ0FBNkMsU0FBN0MsRUFBd0Q7QUFDcEQsUUFBQSxRQUFRLEVBQVI7QUFEb0QsT0FBeEQ7QUFHSCxLQUpEOztBQU1BLElBQUEsaUJBQWlCLENBQUMsS0FBbEIsQ0FBd0IsU0FBeEIsa0NBQTRELFVBQTVELGNBQTBFLElBQTFFLEdBQWtGLFVBQWxGO0FBQ0gsR0FSRDtBQVNILENBbEJNOzs7Ozs7Ozs7Ozs7OztBQ0FQOzs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7O0FBRU8sSUFBTSxNQUFNLEdBQUcsU0FBVCxNQUFTLENBQUMsT0FBRCxFQUF5RDtBQUFBLE1BQS9DLEtBQStDLHVFQUF2QyxRQUF1QztBQUFBLE1BQTdCLE9BQTZCO0FBQUEsTUFBcEIsUUFBb0IsdUVBQVQsSUFBUztBQUMzRSxFQUFBLE9BQU8sQ0FBQyxLQUFSLENBQWMsT0FBZCxHQUF3QixDQUF4QjtBQUNBLEVBQUEsT0FBTyxDQUFDLEtBQVIsQ0FBYyxPQUFkLEdBQXdCLE9BQU8sSUFBSSxPQUFuQzs7QUFFQSxNQUFNLElBQUksR0FBRyxTQUFQLElBQU8sR0FBTTtBQUNmLFFBQUksT0FBTyxHQUFHLFVBQVUsQ0FBQyxPQUFPLENBQUMsS0FBUixDQUFjLE9BQWYsQ0FBeEI7O0FBRUEsUUFBSSxDQUFDLE9BQU8sSUFBSSxLQUFLLEtBQUssTUFBVixHQUFtQixHQUFuQixHQUF5QixHQUFyQyxLQUE2QyxDQUFqRCxFQUFvRDtBQUNoRCxNQUFBLE9BQU8sQ0FBQyxLQUFSLENBQWMsT0FBZCxHQUF3QixPQUF4Qjs7QUFFQSxVQUFJLE9BQU8sS0FBSyxDQUFaLElBQWlCLFFBQXJCLEVBQStCO0FBQzNCLFFBQUEsUUFBUTtBQUNYOztBQUVELE1BQUEsTUFBTSxDQUFDLHFCQUFQLENBQTZCLElBQTdCO0FBQ0g7QUFDSixHQVpEOztBQWNBLEVBQUEsTUFBTSxDQUFDLHFCQUFQLENBQTZCLElBQTdCO0FBQ0gsQ0FuQk07Ozs7QUFxQkEsSUFBTSxPQUFPLEdBQUcsU0FBVixPQUFVLENBQUMsT0FBRCxFQUF5RDtBQUFBLE1BQS9DLEtBQStDLHVFQUF2QyxRQUF1QztBQUFBLE1BQTdCLE9BQTZCO0FBQUEsTUFBcEIsUUFBb0IsdUVBQVQsSUFBUztBQUM1RSxFQUFBLE9BQU8sQ0FBQyxLQUFSLENBQWMsT0FBZCxHQUF3QixDQUF4QjtBQUNBLEVBQUEsT0FBTyxDQUFDLEtBQVIsQ0FBYyxPQUFkLEdBQXdCLE9BQU8sSUFBSSxPQUFuQzs7QUFFQSxNQUFNLElBQUksR0FBRyxTQUFQLElBQU8sR0FBTTtBQUNmLFFBQUksT0FBTyxHQUFHLFVBQVUsQ0FBQyxPQUFPLENBQUMsS0FBUixDQUFjLE9BQWYsQ0FBeEI7O0FBRUEsUUFBSSxDQUFDLE9BQU8sSUFBSSxLQUFLLEtBQUssTUFBVixHQUFtQixHQUFuQixHQUF5QixHQUFyQyxJQUE0QyxDQUFoRCxFQUFtRDtBQUMvQyxNQUFBLE9BQU8sQ0FBQyxLQUFSLENBQWMsT0FBZCxHQUF3QixNQUF4QjtBQUNILEtBRkQsTUFFTztBQUNILE1BQUEsT0FBTyxDQUFDLEtBQVIsQ0FBYyxPQUFkLEdBQXdCLE9BQXhCOztBQUVBLFVBQUksT0FBTyxLQUFLLENBQVosSUFBaUIsUUFBckIsRUFBK0I7QUFDM0IsUUFBQSxRQUFRO0FBQ1g7O0FBRUQsTUFBQSxNQUFNLENBQUMscUJBQVAsQ0FBNkIsSUFBN0I7QUFDSDtBQUNKLEdBZEQ7O0FBZ0JBLEVBQUEsTUFBTSxDQUFDLHFCQUFQLENBQTZCLElBQTdCO0FBQ0gsQ0FyQk07Ozs7QUF1QkEsSUFBTSxPQUFPLEdBQUcsU0FBVixPQUFVLENBQUMsT0FBRCxFQUE2QjtBQUFBLE1BQW5CLFFBQW1CLHVFQUFSLEdBQVE7QUFDaEQsRUFBQSxPQUFPLENBQUMsS0FBUixDQUFjLFNBQWQsR0FBMEIsWUFBMUI7QUFDQSxFQUFBLE9BQU8sQ0FBQyxLQUFSLENBQWMsa0JBQWQsR0FBbUMseUJBQW5DO0FBQ0EsRUFBQSxPQUFPLENBQUMsS0FBUixDQUFjLGtCQUFkLGFBQXNDLFFBQXRDO0FBQ0EsRUFBQSxPQUFPLENBQUMsS0FBUixDQUFjLE1BQWQsYUFBMEIsT0FBTyxDQUFDLFlBQWxDO0FBQ0EsRUFBQSxPQUFPLENBQUMsS0FBUixDQUFjLFVBQWQsR0FBMkIsQ0FBM0I7QUFDQSxFQUFBLE9BQU8sQ0FBQyxLQUFSLENBQWMsYUFBZCxHQUE4QixDQUE5QjtBQUNBLEVBQUEsT0FBTyxDQUFDLEtBQVIsQ0FBYyxTQUFkLEdBQTBCLENBQTFCO0FBQ0EsRUFBQSxPQUFPLENBQUMsS0FBUixDQUFjLFlBQWQsR0FBNkIsQ0FBN0I7QUFDQSxFQUFBLE9BQU8sQ0FBQyxLQUFSLENBQWMsUUFBZCxHQUF5QixRQUF6QjtBQUVBLEVBQUEsVUFBVSxDQUFDLFlBQU07QUFDYixJQUFBLE9BQU8sQ0FBQyxLQUFSLENBQWMsTUFBZCxHQUF1QixDQUF2QjtBQUNILEdBRlMsRUFFUCxFQUZPLENBQVY7QUFJQSxFQUFBLE1BQU0sQ0FBQyxVQUFQLENBQWtCLFlBQU07QUFDcEIsSUFBQSxPQUFPLENBQUMsS0FBUixDQUFjLE9BQWQsR0FBd0IsTUFBeEI7QUFDQSxJQUFBLE9BQU8sQ0FBQyxLQUFSLENBQWMsY0FBZCxDQUE2QixRQUE3QjtBQUNBLElBQUEsT0FBTyxDQUFDLEtBQVIsQ0FBYyxjQUFkLENBQTZCLGFBQTdCO0FBQ0EsSUFBQSxPQUFPLENBQUMsS0FBUixDQUFjLGNBQWQsQ0FBNkIsZ0JBQTdCO0FBQ0EsSUFBQSxPQUFPLENBQUMsS0FBUixDQUFjLGNBQWQsQ0FBNkIsWUFBN0I7QUFDQSxJQUFBLE9BQU8sQ0FBQyxLQUFSLENBQWMsY0FBZCxDQUE2QixlQUE3QjtBQUNBLElBQUEsT0FBTyxDQUFDLEtBQVIsQ0FBYyxjQUFkLENBQTZCLFVBQTdCO0FBQ0EsSUFBQSxPQUFPLENBQUMsS0FBUixDQUFjLGNBQWQsQ0FBNkIscUJBQTdCO0FBQ0EsSUFBQSxPQUFPLENBQUMsS0FBUixDQUFjLGNBQWQsQ0FBNkIscUJBQTdCO0FBQ0gsR0FWRCxFQVVHLFFBVkg7QUFXSCxDQTFCTTs7OztBQTRCQSxJQUFNLFNBQVMsR0FBRyxTQUFaLFNBQVksQ0FBQyxPQUFELEVBQTZCO0FBQUEsTUFBbkIsUUFBbUIsdUVBQVIsR0FBUTtBQUNsRCxFQUFBLE9BQU8sQ0FBQyxLQUFSLENBQWMsY0FBZCxDQUE2QixTQUE3QjtBQUVBLE1BQUksT0FBTyxHQUFHLE1BQU0sQ0FBQyxnQkFBUCxDQUF3QixPQUF4QixFQUFpQyxPQUEvQzs7QUFFQSxNQUFJLE9BQU8sS0FBSyxNQUFoQixFQUF3QjtBQUNwQixJQUFBLE9BQU8sR0FBRyxPQUFWO0FBQ0g7O0FBRUQsRUFBQSxPQUFPLENBQUMsS0FBUixDQUFjLE9BQWQsR0FBd0IsT0FBeEI7QUFFQSxNQUFJLE1BQU0sR0FBRyxPQUFPLENBQUMsWUFBckI7QUFDQSxNQUFJLFVBQVUsR0FBRyxNQUFNLENBQUMsZ0JBQVAsQ0FBd0IsT0FBeEIsRUFBaUMsVUFBbEQ7QUFDQSxNQUFJLGFBQWEsR0FBRyxNQUFNLENBQUMsZ0JBQVAsQ0FBd0IsT0FBeEIsRUFBaUMsYUFBckQ7QUFDQSxNQUFJLFNBQVMsR0FBRyxNQUFNLENBQUMsZ0JBQVAsQ0FBd0IsT0FBeEIsRUFBaUMsU0FBakQ7QUFDQSxNQUFJLFlBQVksR0FBRyxNQUFNLENBQUMsZ0JBQVAsQ0FBd0IsT0FBeEIsRUFBaUMsWUFBcEQ7QUFFQSxFQUFBLE9BQU8sQ0FBQyxLQUFSLENBQWMsTUFBZCxHQUF1QixDQUF2QjtBQUNBLEVBQUEsT0FBTyxDQUFDLEtBQVIsQ0FBYyxVQUFkLEdBQTJCLENBQTNCO0FBQ0EsRUFBQSxPQUFPLENBQUMsS0FBUixDQUFjLGFBQWQsR0FBOEIsQ0FBOUI7QUFDQSxFQUFBLE9BQU8sQ0FBQyxLQUFSLENBQWMsU0FBZCxHQUEwQixDQUExQjtBQUNBLEVBQUEsT0FBTyxDQUFDLEtBQVIsQ0FBYyxZQUFkLEdBQTZCLENBQTdCO0FBQ0EsRUFBQSxPQUFPLENBQUMsS0FBUixDQUFjLFFBQWQsR0FBeUIsUUFBekI7QUFFQSxFQUFBLE9BQU8sQ0FBQyxLQUFSLENBQWMsU0FBZCxHQUEwQixZQUExQjtBQUNBLEVBQUEsT0FBTyxDQUFDLEtBQVIsQ0FBYyxrQkFBZCxHQUFtQyxRQUFuQztBQUNBLEVBQUEsT0FBTyxDQUFDLEtBQVIsQ0FBYyxrQkFBZCxhQUFzQyxRQUF0QztBQUVBLEVBQUEsVUFBVSxDQUFDLFlBQU07QUFDYixJQUFBLE9BQU8sQ0FBQyxLQUFSLENBQWMsTUFBZCxhQUEwQixNQUExQjs7QUFDQSxRQUFJLFVBQVUsS0FBSyxLQUFmLElBQXdCLGFBQWEsS0FBSyxLQUE5QyxFQUFxRDtBQUNqRCxNQUFBLE9BQU8sQ0FBQyxLQUFSLENBQWMsa0JBQWQsR0FBbUMsU0FBbkM7QUFDQSxNQUFBLE9BQU8sQ0FBQyxLQUFSLENBQWMsa0JBQWQsYUFBc0MsUUFBUSxHQUFHLEdBQWpEO0FBQ0EsTUFBQSxPQUFPLENBQUMsS0FBUixDQUFjLFVBQWQsR0FBMkIsVUFBM0I7QUFDQSxNQUFBLE9BQU8sQ0FBQyxLQUFSLENBQWMsYUFBZCxHQUE4QixhQUE5QjtBQUNBLE1BQUEsT0FBTyxDQUFDLEtBQVIsQ0FBYyxTQUFkLEdBQTBCLFNBQTFCO0FBQ0EsTUFBQSxPQUFPLENBQUMsS0FBUixDQUFjLFlBQWQsR0FBNkIsWUFBN0I7QUFDSDtBQUNKLEdBVlMsRUFVUCxFQVZPLENBQVY7QUFZQSxFQUFBLE1BQU0sQ0FBQyxVQUFQLENBQWtCLFlBQU07QUFDcEIsSUFBQSxPQUFPLENBQUMsS0FBUixDQUFjLGNBQWQsQ0FBNkIsUUFBN0I7QUFDQSxJQUFBLE9BQU8sQ0FBQyxLQUFSLENBQWMsY0FBZCxDQUE2QixVQUE3QjtBQUNBLElBQUEsT0FBTyxDQUFDLEtBQVIsQ0FBYyxjQUFkLENBQTZCLHFCQUE3QjtBQUNBLElBQUEsT0FBTyxDQUFDLEtBQVIsQ0FBYyxjQUFkLENBQTZCLHFCQUE3QjtBQUNBLElBQUEsT0FBTyxDQUFDLEtBQVIsQ0FBYyxjQUFkLENBQTZCLGFBQTdCO0FBQ0EsSUFBQSxPQUFPLENBQUMsS0FBUixDQUFjLGNBQWQsQ0FBNkIsZ0JBQTdCO0FBQ0EsSUFBQSxPQUFPLENBQUMsS0FBUixDQUFjLGNBQWQsQ0FBNkIsWUFBN0I7QUFDQSxJQUFBLE9BQU8sQ0FBQyxLQUFSLENBQWMsY0FBZCxDQUE2QixlQUE3QjtBQUNILEdBVEQsRUFTRyxRQVRIO0FBVUgsQ0FsRE07Ozs7SUFvREQsVzs7Ozs7Ozs7Ozs7OztXQUNGLDhCQUFxQjtBQUNqQixhQUFPO0FBQ0gsUUFBQSxTQUFTLEVBQUU7QUFDUCxVQUFBLE1BQU0sRUFBRSxtQkFERDtBQUVQLFVBQUEsVUFBVSxFQUFFLHNCQUZMO0FBR1AsVUFBQSxXQUFXLEVBQUUsOEJBSE47QUFJUCxVQUFBLGFBQWEsRUFBRSxzQkFKUjtBQUtQLFVBQUEsb0JBQW9CLEVBQUU7QUFMZixTQURSO0FBUUgsUUFBQSxtQkFBbUIsRUFBRTtBQVJsQixPQUFQO0FBVUg7OztXQUVELDhCQUFxQjtBQUNqQixVQUFNLE9BQU8sR0FBRyxLQUFLLFFBQUwsQ0FBYyxHQUFkLENBQWtCLENBQWxCLENBQWhCO0FBQ0EsVUFBTSxTQUFTLEdBQUcsS0FBSyxXQUFMLENBQWlCLFdBQWpCLENBQWxCO0FBRUEsYUFBTztBQUNILFFBQUEsTUFBTSxFQUFFLE9BQU8sQ0FBQyxhQUFSLENBQXNCLFNBQVMsQ0FBQyxNQUFoQyxDQURMO0FBRUgsUUFBQSxVQUFVLEVBQUUsT0FBTyxDQUFDLGFBQVIsQ0FBc0IsU0FBUyxDQUFDLFVBQWhDLENBRlQ7QUFHSCxRQUFBLFdBQVcsRUFBRSxPQUFPLENBQUMsYUFBUixDQUFzQixTQUFTLENBQUMsV0FBaEMsQ0FIVjtBQUlILFFBQUEsYUFBYSxFQUFFLE9BQU8sQ0FBQyxhQUFSLENBQXNCLFNBQVMsQ0FBQyxhQUFoQyxDQUpaO0FBS0gsUUFBQSxvQkFBb0IsRUFBRSxPQUFPLENBQUMsYUFBUixDQUFzQixTQUFTLENBQUMsb0JBQWhDO0FBTG5CLE9BQVA7QUFPSDs7O1dBRUQsc0JBQWE7QUFBQTs7QUFDVCxvQ0FBSyxRQUFMLENBQWMsV0FBZCxnRkFBMkIsZ0JBQTNCLENBQTRDLE9BQTVDLEVBQXFELEtBQUssWUFBTCxDQUFrQixJQUFsQixDQUF1QixJQUF2QixDQUFyRDtBQUNBLHFDQUFLLFFBQUwsQ0FBYyxVQUFkLGtGQUEwQixnQkFBMUIsQ0FBMkMsUUFBM0MsRUFBcUQsS0FBSyxrQkFBTCxDQUF3QixJQUF4QixDQUE2QixJQUE3QixDQUFyRDtBQUNBLHFDQUFLLFFBQUwsQ0FBYyxVQUFkLGtGQUEwQixnQkFBMUIsQ0FBMkMsT0FBM0MsRUFBb0QsS0FBSyxpQkFBTCxDQUF1QixJQUF2QixDQUE0QixJQUE1QixDQUFwRDtBQUNBLE1BQUEsUUFBUSxDQUFDLGdCQUFULENBQTBCLE9BQTFCLEVBQW1DLEtBQUssZUFBTCxDQUFxQixJQUFyQixDQUEwQixJQUExQixDQUFuQztBQUNIOzs7V0FFRCxzQkFBYSxLQUFiLEVBQW9CO0FBQ2hCLFVBQUksTUFBTSxHQUFRLEtBQUssUUFBTCxDQUFjLFdBQWhDO0FBQUEsVUFDSSxNQUFNLEdBQVEsS0FBSyxRQUFMLENBQWMsV0FBZCxDQUEwQixLQUQ1QztBQUFBLFVBRUksT0FBTyxHQUFPLEtBQUssUUFBTCxDQUFjLGFBRmhDO0FBQUEsVUFHSSxRQUFRLEdBQU0sS0FBSyxRQUFMLENBQWMsb0JBSGhDO0FBS0EsTUFBQSxZQUFZLENBQUMsS0FBSyxXQUFMLENBQWlCLHFCQUFqQixDQUFELENBQVo7O0FBRUEsVUFBSSxNQUFNLENBQUMsTUFBUCxHQUFnQixDQUFwQixFQUF1QjtBQUNuQixZQUFNLG1CQUFtQixHQUFHLFVBQVUsQ0FBQyxZQUFNO0FBQ3pDLGNBQU0sV0FBVyxHQUFLLElBQUksY0FBSixFQUF0QjtBQUNBLGNBQU0sUUFBUSxHQUFRLElBQUksUUFBSixFQUF0QjtBQUNBLFVBQUEsUUFBUSxDQUFDLE1BQVQsQ0FBZ0IsUUFBaEIsRUFBMEIsa0JBQTFCO0FBQ0EsVUFBQSxRQUFRLENBQUMsTUFBVCxDQUFnQixPQUFoQixFQUF5QixVQUFVLENBQUMsS0FBcEM7QUFDQSxVQUFBLFFBQVEsQ0FBQyxNQUFULENBQWdCLFFBQWhCLEVBQTBCLE1BQTFCO0FBQ0EsVUFBQSxRQUFRLENBQUMsTUFBVCxDQUFnQixNQUFoQixFQUF3QixNQUFNLENBQUMsWUFBUCxDQUFvQixXQUFwQixDQUF4Qjs7QUFFQSxVQUFBLFdBQVcsQ0FBQyxrQkFBWixHQUFpQyxZQUFXO0FBQ3hDLGdCQUFJLEtBQUssVUFBTCxLQUFvQixDQUFwQixJQUF5QixLQUFLLE1BQUwsS0FBZ0IsR0FBN0MsRUFBa0Q7QUFDOUMsY0FBQSxPQUFPLENBQUMsU0FBUixHQUFvQixLQUFLLFlBQXpCO0FBQ0EsY0FBQSxNQUFNLENBQUMsUUFBRCxFQUFXLE1BQVgsQ0FBTjtBQUVBLGNBQUEsVUFBVSxDQUFDLFlBQU07QUFDYixnQkFBQSxTQUFTLENBQUMsT0FBRCxFQUFVLEdBQVYsQ0FBVDtBQUNBLGdCQUFBLE9BQU8sQ0FBQyxTQUFSLENBQWtCLEdBQWxCLENBQXNCLFFBQXRCO0FBQ0EsZ0JBQUEsT0FBTyxDQUFDLFFBQUQsRUFBVyxNQUFYLENBQVA7QUFDSCxlQUpTLEVBSVAsR0FKTyxDQUFWO0FBS0g7QUFDSixXQVhEOztBQWFBLFVBQUEsV0FBVyxDQUFDLElBQVosQ0FBaUIsTUFBakIsRUFBeUIsVUFBVSxDQUFDLFFBQXBDLEVBQThDLElBQTlDO0FBQ0EsVUFBQSxXQUFXLENBQUMsSUFBWixDQUFpQixRQUFqQjtBQUNILFNBdkJxQyxFQXVCbkMsR0F2Qm1DLENBQXRDO0FBeUJBLGFBQUssV0FBTCxDQUFpQjtBQUNiLFVBQUEsbUJBQW1CLEVBQUU7QUFEUixTQUFqQjtBQUlIO0FBQ0o7OztXQUVELDRCQUFtQixLQUFuQixFQUEwQjtBQUN0QixNQUFBLEtBQUssQ0FBQyxjQUFOO0FBQ0g7OztXQUVELDJCQUFrQixLQUFsQixFQUF5QjtBQUNyQixVQUFNLGFBQWEsR0FBRyxLQUFLLFFBQUwsQ0FBYyxNQUFkLENBQXFCLGFBQXJCLFdBQXNDLEtBQUssV0FBTCxDQUFpQix5QkFBakIsQ0FBdEMsYUFBdEI7O0FBRUEsVUFBSSxhQUFKLEVBQW1CO0FBQ2YsUUFBQSxTQUFTLENBQUMsYUFBRCxFQUFnQixHQUFoQixDQUFUO0FBQ0g7QUFDSjs7O1dBRUQseUJBQWdCLEtBQWhCLEVBQXVCO0FBQ25CO0FBQ0EsVUFBTSxVQUFVLEdBQUcsS0FBSyxDQUFDLE1BQU4sQ0FBYSxPQUFiLENBQXFCLEtBQUssV0FBTCxDQUFpQixzQkFBakIsQ0FBckIsQ0FBbkI7QUFDQSxVQUFNLGlCQUFpQixHQUFHLEtBQUssQ0FBQyxNQUFOLENBQWEsT0FBYixDQUFxQixLQUFLLFdBQUwsQ0FBaUIseUJBQWpCLENBQXJCLENBQTFCOztBQUVBLFVBQUksRUFBRSxVQUFVLElBQUksaUJBQWhCLENBQUosRUFBd0M7QUFDcEMsUUFBQSxPQUFPLENBQUMsS0FBSyxRQUFMLENBQWMsYUFBZixFQUE4QixHQUE5QixDQUFQO0FBQ0g7QUFDSjs7OztFQS9GcUIsZ0JBQWdCLENBQUMsUUFBakIsQ0FBMEIsUUFBMUIsQ0FBbUMsSTs7QUFrRzdELDJCQUFlLFdBQWYsRUFBNEIsYUFBNUIiLCJmaWxlIjoiZ2VuZXJhdGVkLmpzIiwic291cmNlUm9vdCI6IiIsInNvdXJjZXNDb250ZW50IjpbIihmdW5jdGlvbigpe2Z1bmN0aW9uIHIoZSxuLHQpe2Z1bmN0aW9uIG8oaSxmKXtpZighbltpXSl7aWYoIWVbaV0pe3ZhciBjPVwiZnVuY3Rpb25cIj09dHlwZW9mIHJlcXVpcmUmJnJlcXVpcmU7aWYoIWYmJmMpcmV0dXJuIGMoaSwhMCk7aWYodSlyZXR1cm4gdShpLCEwKTt2YXIgYT1uZXcgRXJyb3IoXCJDYW5ub3QgZmluZCBtb2R1bGUgJ1wiK2krXCInXCIpO3Rocm93IGEuY29kZT1cIk1PRFVMRV9OT1RfRk9VTkRcIixhfXZhciBwPW5baV09e2V4cG9ydHM6e319O2VbaV1bMF0uY2FsbChwLmV4cG9ydHMsZnVuY3Rpb24ocil7dmFyIG49ZVtpXVsxXVtyXTtyZXR1cm4gbyhufHxyKX0scCxwLmV4cG9ydHMscixlLG4sdCl9cmV0dXJuIG5baV0uZXhwb3J0c31mb3IodmFyIHU9XCJmdW5jdGlvblwiPT10eXBlb2YgcmVxdWlyZSYmcmVxdWlyZSxpPTA7aTx0Lmxlbmd0aDtpKyspbyh0W2ldKTtyZXR1cm4gb31yZXR1cm4gcn0pKCkiLCJleHBvcnQgY29uc3QgcmVnaXN0ZXJXaWRnZXQgPSAoY2xhc3NOYW1lLCB3aWRnZXROYW1lLCBza2luID0gJ2RlZmF1bHQnKSA9PiB7XG4gICAgaWYgKCEoY2xhc3NOYW1lIHx8IHdpZGdldE5hbWUpKSB7XG4gICAgICAgIHJldHVybjtcbiAgICB9XG5cbiAgICAvKipcbiAgICAgKiBCZWNhdXNlIEVsZW1lbnRvciBwbHVnaW4gdXNlcyBqUXVlcnkgY3VzdG9tIGV2ZW50LFxuICAgICAqIFdlIGFsc28gaGF2ZSB0byB1c2UgalF1ZXJ5IHRvIHVzZSB0aGlzIGV2ZW50XG4gICAgICovXG4gICAgalF1ZXJ5KHdpbmRvdykub24oJ2VsZW1lbnRvci9mcm9udGVuZC9pbml0JywgKCkgPT4ge1xuICAgICAgICBjb25zdCBhZGRIYW5kbGVyID0gKCRlbGVtZW50KSA9PiB7XG4gICAgICAgICAgICBlbGVtZW50b3JGcm9udGVuZC5lbGVtZW50c0hhbmRsZXIuYWRkSGFuZGxlcihjbGFzc05hbWUsIHtcbiAgICAgICAgICAgICAgICAkZWxlbWVudCxcbiAgICAgICAgICAgIH0pO1xuICAgICAgICB9O1xuXG4gICAgICAgIGVsZW1lbnRvckZyb250ZW5kLmhvb2tzLmFkZEFjdGlvbihgZnJvbnRlbmQvZWxlbWVudF9yZWFkeS8ke3dpZGdldE5hbWV9LiR7c2tpbn1gLCBhZGRIYW5kbGVyKTtcbiAgICB9KTtcbn07XG4iLCJpbXBvcnQgeyByZWdpc3RlcldpZGdldCB9IGZyb20gXCIuLi9saWIvdXRpbHNcIjtcblxuZXhwb3J0IGNvbnN0IGZhZGVJbiA9IChlbGVtZW50LCBzcGVlZCA9IFwibm9ybWFsXCIsIGRpc3BsYXksIGNhbGxiYWNrID0gbnVsbCkgPT4ge1xuICAgIGVsZW1lbnQuc3R5bGUub3BhY2l0eSA9IDA7XG4gICAgZWxlbWVudC5zdHlsZS5kaXNwbGF5ID0gZGlzcGxheSB8fCBcImJsb2NrXCI7XG5cbiAgICBjb25zdCBmYWRlID0gKCkgPT4ge1xuICAgICAgICBsZXQgb3BhY2l0eSA9IHBhcnNlRmxvYXQoZWxlbWVudC5zdHlsZS5vcGFjaXR5KTtcblxuICAgICAgICBpZiAoKG9wYWNpdHkgKz0gc3BlZWQgPT09IFwiZmFzdFwiID8gMC4yIDogMC4xKSA8PSAxKSB7XG4gICAgICAgICAgICBlbGVtZW50LnN0eWxlLm9wYWNpdHkgPSBvcGFjaXR5O1xuXG4gICAgICAgICAgICBpZiAob3BhY2l0eSA9PT0gMSAmJiBjYWxsYmFjaykge1xuICAgICAgICAgICAgICAgIGNhbGxiYWNrKCk7XG4gICAgICAgICAgICB9XG5cbiAgICAgICAgICAgIHdpbmRvdy5yZXF1ZXN0QW5pbWF0aW9uRnJhbWUoZmFkZSk7XG4gICAgICAgIH1cbiAgICB9O1xuXG4gICAgd2luZG93LnJlcXVlc3RBbmltYXRpb25GcmFtZShmYWRlKTtcbn07XG5cbmV4cG9ydCBjb25zdCBmYWRlT3V0ID0gKGVsZW1lbnQsIHNwZWVkID0gXCJub3JtYWxcIiwgZGlzcGxheSwgY2FsbGJhY2sgPSBudWxsKSA9PiB7XG4gICAgZWxlbWVudC5zdHlsZS5vcGFjaXR5ID0gMTtcbiAgICBlbGVtZW50LnN0eWxlLmRpc3BsYXkgPSBkaXNwbGF5IHx8IFwiYmxvY2tcIjtcblxuICAgIGNvbnN0IGZhZGUgPSAoKSA9PiB7XG4gICAgICAgIGxldCBvcGFjaXR5ID0gcGFyc2VGbG9hdChlbGVtZW50LnN0eWxlLm9wYWNpdHkpO1xuXG4gICAgICAgIGlmICgob3BhY2l0eSAtPSBzcGVlZCA9PT0gXCJmYXN0XCIgPyAwLjIgOiAwLjEpIDwgMCkge1xuICAgICAgICAgICAgZWxlbWVudC5zdHlsZS5kaXNwbGF5ID0gXCJub25lXCI7XG4gICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICBlbGVtZW50LnN0eWxlLm9wYWNpdHkgPSBvcGFjaXR5O1xuXG4gICAgICAgICAgICBpZiAob3BhY2l0eSA9PT0gMCAmJiBjYWxsYmFjaykge1xuICAgICAgICAgICAgICAgIGNhbGxiYWNrKCk7XG4gICAgICAgICAgICB9XG5cbiAgICAgICAgICAgIHdpbmRvdy5yZXF1ZXN0QW5pbWF0aW9uRnJhbWUoZmFkZSk7XG4gICAgICAgIH1cbiAgICB9O1xuXG4gICAgd2luZG93LnJlcXVlc3RBbmltYXRpb25GcmFtZShmYWRlKTtcbn07XG5cbmV4cG9ydCBjb25zdCBzbGlkZVVwID0gKGVsZW1lbnQsIGR1cmF0aW9uID0gMzAwKSA9PiB7XG4gICAgZWxlbWVudC5zdHlsZS5ib3hTaXppbmcgPSBcImJvcmRlci1ib3hcIjtcbiAgICBlbGVtZW50LnN0eWxlLnRyYW5zaXRpb25Qcm9wZXJ0eSA9IFwiaGVpZ2h0LCBtYXJnaW4sIHBhZGRpbmdcIjtcbiAgICBlbGVtZW50LnN0eWxlLnRyYW5zaXRpb25EdXJhdGlvbiA9IGAke2R1cmF0aW9ufW1zYDtcbiAgICBlbGVtZW50LnN0eWxlLmhlaWdodCA9IGAke2VsZW1lbnQub2Zmc2V0SGVpZ2h0fXB4YDtcbiAgICBlbGVtZW50LnN0eWxlLnBhZGRpbmdUb3AgPSAwO1xuICAgIGVsZW1lbnQuc3R5bGUucGFkZGluZ0JvdHRvbSA9IDA7XG4gICAgZWxlbWVudC5zdHlsZS5tYXJnaW5Ub3AgPSAwO1xuICAgIGVsZW1lbnQuc3R5bGUubWFyZ2luQm90dG9tID0gMDtcbiAgICBlbGVtZW50LnN0eWxlLm92ZXJmbG93ID0gXCJoaWRkZW5cIjtcblxuICAgIHNldFRpbWVvdXQoKCkgPT4ge1xuICAgICAgICBlbGVtZW50LnN0eWxlLmhlaWdodCA9IDA7XG4gICAgfSwgMTApO1xuXG4gICAgd2luZG93LnNldFRpbWVvdXQoKCkgPT4ge1xuICAgICAgICBlbGVtZW50LnN0eWxlLmRpc3BsYXkgPSBcIm5vbmVcIjtcbiAgICAgICAgZWxlbWVudC5zdHlsZS5yZW1vdmVQcm9wZXJ0eShcImhlaWdodFwiKTtcbiAgICAgICAgZWxlbWVudC5zdHlsZS5yZW1vdmVQcm9wZXJ0eShcInBhZGRpbmctdG9wXCIpO1xuICAgICAgICBlbGVtZW50LnN0eWxlLnJlbW92ZVByb3BlcnR5KFwicGFkZGluZy1ib3R0b21cIik7XG4gICAgICAgIGVsZW1lbnQuc3R5bGUucmVtb3ZlUHJvcGVydHkoXCJtYXJnaW4tdG9wXCIpO1xuICAgICAgICBlbGVtZW50LnN0eWxlLnJlbW92ZVByb3BlcnR5KFwibWFyZ2luLWJvdHRvbVwiKTtcbiAgICAgICAgZWxlbWVudC5zdHlsZS5yZW1vdmVQcm9wZXJ0eShcIm92ZXJmbG93XCIpO1xuICAgICAgICBlbGVtZW50LnN0eWxlLnJlbW92ZVByb3BlcnR5KFwidHJhbnNpdGlvbi1kdXJhdGlvblwiKTtcbiAgICAgICAgZWxlbWVudC5zdHlsZS5yZW1vdmVQcm9wZXJ0eShcInRyYW5zaXRpb24tcHJvcGVydHlcIik7XG4gICAgfSwgZHVyYXRpb24pO1xufTtcblxuZXhwb3J0IGNvbnN0IHNsaWRlRG93biA9IChlbGVtZW50LCBkdXJhdGlvbiA9IDMwMCkgPT4ge1xuICAgIGVsZW1lbnQuc3R5bGUucmVtb3ZlUHJvcGVydHkoXCJkaXNwbGF5XCIpO1xuXG4gICAgbGV0IGRpc3BsYXkgPSB3aW5kb3cuZ2V0Q29tcHV0ZWRTdHlsZShlbGVtZW50KS5kaXNwbGF5O1xuXG4gICAgaWYgKGRpc3BsYXkgPT09IFwibm9uZVwiKSB7XG4gICAgICAgIGRpc3BsYXkgPSBcImJsb2NrXCI7XG4gICAgfVxuXG4gICAgZWxlbWVudC5zdHlsZS5kaXNwbGF5ID0gZGlzcGxheTtcblxuICAgIGxldCBoZWlnaHQgPSBlbGVtZW50Lm9mZnNldEhlaWdodDtcbiAgICBsZXQgcGFkZGluZ1RvcCA9IHdpbmRvdy5nZXRDb21wdXRlZFN0eWxlKGVsZW1lbnQpLnBhZGRpbmdUb3A7XG4gICAgbGV0IHBhZGRpbmdCb3R0b20gPSB3aW5kb3cuZ2V0Q29tcHV0ZWRTdHlsZShlbGVtZW50KS5wYWRkaW5nQm90dG9tO1xuICAgIGxldCBtYXJnaW5Ub3AgPSB3aW5kb3cuZ2V0Q29tcHV0ZWRTdHlsZShlbGVtZW50KS5tYXJnaW5Ub3A7XG4gICAgbGV0IG1hcmdpbkJvdHRvbSA9IHdpbmRvdy5nZXRDb21wdXRlZFN0eWxlKGVsZW1lbnQpLm1hcmdpbkJvdHRvbTtcblxuICAgIGVsZW1lbnQuc3R5bGUuaGVpZ2h0ID0gMDtcbiAgICBlbGVtZW50LnN0eWxlLnBhZGRpbmdUb3AgPSAwO1xuICAgIGVsZW1lbnQuc3R5bGUucGFkZGluZ0JvdHRvbSA9IDA7XG4gICAgZWxlbWVudC5zdHlsZS5tYXJnaW5Ub3AgPSAwO1xuICAgIGVsZW1lbnQuc3R5bGUubWFyZ2luQm90dG9tID0gMDtcbiAgICBlbGVtZW50LnN0eWxlLm92ZXJmbG93ID0gXCJoaWRkZW5cIjtcblxuICAgIGVsZW1lbnQuc3R5bGUuYm94U2l6aW5nID0gXCJib3JkZXItYm94XCI7XG4gICAgZWxlbWVudC5zdHlsZS50cmFuc2l0aW9uUHJvcGVydHkgPSBcImhlaWdodFwiO1xuICAgIGVsZW1lbnQuc3R5bGUudHJhbnNpdGlvbkR1cmF0aW9uID0gYCR7ZHVyYXRpb259bXNgO1xuXG4gICAgc2V0VGltZW91dCgoKSA9PiB7XG4gICAgICAgIGVsZW1lbnQuc3R5bGUuaGVpZ2h0ID0gYCR7aGVpZ2h0fXB4YDtcbiAgICAgICAgaWYgKHBhZGRpbmdUb3AgIT09IFwiMHB4XCIgfHwgcGFkZGluZ0JvdHRvbSAhPT0gXCIwcHhcIikge1xuICAgICAgICAgICAgZWxlbWVudC5zdHlsZS50cmFuc2l0aW9uUHJvcGVydHkgPSBcInBhZGRpbmdcIjtcbiAgICAgICAgICAgIGVsZW1lbnQuc3R5bGUudHJhbnNpdGlvbkR1cmF0aW9uID0gYCR7ZHVyYXRpb24gLyAxLjJ9bXNgO1xuICAgICAgICAgICAgZWxlbWVudC5zdHlsZS5wYWRkaW5nVG9wID0gcGFkZGluZ1RvcDtcbiAgICAgICAgICAgIGVsZW1lbnQuc3R5bGUucGFkZGluZ0JvdHRvbSA9IHBhZGRpbmdCb3R0b207XG4gICAgICAgICAgICBlbGVtZW50LnN0eWxlLm1hcmdpblRvcCA9IG1hcmdpblRvcDtcbiAgICAgICAgICAgIGVsZW1lbnQuc3R5bGUubWFyZ2luQm90dG9tID0gbWFyZ2luQm90dG9tO1xuICAgICAgICB9XG4gICAgfSwgMTApO1xuXG4gICAgd2luZG93LnNldFRpbWVvdXQoKCkgPT4ge1xuICAgICAgICBlbGVtZW50LnN0eWxlLnJlbW92ZVByb3BlcnR5KFwiaGVpZ2h0XCIpO1xuICAgICAgICBlbGVtZW50LnN0eWxlLnJlbW92ZVByb3BlcnR5KFwib3ZlcmZsb3dcIik7XG4gICAgICAgIGVsZW1lbnQuc3R5bGUucmVtb3ZlUHJvcGVydHkoXCJ0cmFuc2l0aW9uLWR1cmF0aW9uXCIpO1xuICAgICAgICBlbGVtZW50LnN0eWxlLnJlbW92ZVByb3BlcnR5KFwidHJhbnNpdGlvbi1wcm9wZXJ0eVwiKTtcbiAgICAgICAgZWxlbWVudC5zdHlsZS5yZW1vdmVQcm9wZXJ0eShcInBhZGRpbmctdG9wXCIpO1xuICAgICAgICBlbGVtZW50LnN0eWxlLnJlbW92ZVByb3BlcnR5KFwicGFkZGluZy1ib3R0b21cIik7XG4gICAgICAgIGVsZW1lbnQuc3R5bGUucmVtb3ZlUHJvcGVydHkoXCJtYXJnaW4tdG9wXCIpO1xuICAgICAgICBlbGVtZW50LnN0eWxlLnJlbW92ZVByb3BlcnR5KFwibWFyZ2luLWJvdHRvbVwiKTtcbiAgICB9LCBkdXJhdGlvbik7XG59O1xuXG5jbGFzcyBaZXVzX1NlYXJjaCBleHRlbmRzIGVsZW1lbnRvck1vZHVsZXMuZnJvbnRlbmQuaGFuZGxlcnMuQmFzZSB7XG4gICAgZ2V0RGVmYXVsdFNldHRpbmdzKCkge1xuICAgICAgICByZXR1cm4ge1xuICAgICAgICAgICAgc2VsZWN0b3JzOiB7XG4gICAgICAgICAgICAgICAgc2VhcmNoOiBcIi56ZXVzLXNlYXJjaC13cmFwXCIsXG4gICAgICAgICAgICAgICAgc2VhcmNoRm9ybTogXCJmb3JtLnpldXMtc2VhcmNoZm9ybVwiLFxuICAgICAgICAgICAgICAgIHNlYXJjaElucHV0OiBcIi56ZXVzLXNlYXJjaGZvcm0gaW5wdXQuZmllbGRcIixcbiAgICAgICAgICAgICAgICBzZWFyY2hSZXN1bHRzOiBcIi56ZXVzLXNlYXJjaC1yZXN1bHRzXCIsXG4gICAgICAgICAgICAgICAgc2VhcmNoTG9hZGluZ1NwaW5uZXI6IFwiLnpldXMtc2VhcmNoLXdyYXAgLnpldXMtYWpheC1sb2FkaW5nXCIsXG4gICAgICAgICAgICB9LFxuICAgICAgICAgICAgYWpheFNlYXJjaFRpbWVvdXRJRDogbnVsbCxcbiAgICAgICAgfTtcbiAgICB9XG5cbiAgICBnZXREZWZhdWx0RWxlbWVudHMoKSB7XG4gICAgICAgIGNvbnN0IGVsZW1lbnQgPSB0aGlzLiRlbGVtZW50LmdldCgwKTtcbiAgICAgICAgY29uc3Qgc2VsZWN0b3JzID0gdGhpcy5nZXRTZXR0aW5ncyhcInNlbGVjdG9yc1wiKTtcblxuICAgICAgICByZXR1cm4ge1xuICAgICAgICAgICAgc2VhcmNoOiBlbGVtZW50LnF1ZXJ5U2VsZWN0b3Ioc2VsZWN0b3JzLnNlYXJjaCksXG4gICAgICAgICAgICBzZWFyY2hGb3JtOiBlbGVtZW50LnF1ZXJ5U2VsZWN0b3Ioc2VsZWN0b3JzLnNlYXJjaEZvcm0pLFxuICAgICAgICAgICAgc2VhcmNoSW5wdXQ6IGVsZW1lbnQucXVlcnlTZWxlY3RvcihzZWxlY3RvcnMuc2VhcmNoSW5wdXQpLFxuICAgICAgICAgICAgc2VhcmNoUmVzdWx0czogZWxlbWVudC5xdWVyeVNlbGVjdG9yKHNlbGVjdG9ycy5zZWFyY2hSZXN1bHRzKSxcbiAgICAgICAgICAgIHNlYXJjaExvYWRpbmdTcGlubmVyOiBlbGVtZW50LnF1ZXJ5U2VsZWN0b3Ioc2VsZWN0b3JzLnNlYXJjaExvYWRpbmdTcGlubmVyKSxcbiAgICAgICAgfTtcbiAgICB9XG5cbiAgICBiaW5kRXZlbnRzKCkge1xuICAgICAgICB0aGlzLmVsZW1lbnRzLnNlYXJjaElucHV0Py5hZGRFdmVudExpc3RlbmVyKFwia2V5dXBcIiwgdGhpcy5vbkFqYXhTZWFyY2guYmluZCh0aGlzKSk7XG4gICAgICAgIHRoaXMuZWxlbWVudHMuc2VhcmNoRm9ybT8uYWRkRXZlbnRMaXN0ZW5lcihcInN1Ym1pdFwiLCB0aGlzLm9uU2VhcmNoRm9ybVN1Ym1pdC5iaW5kKHRoaXMpKTtcbiAgICAgICAgdGhpcy5lbGVtZW50cy5zZWFyY2hGb3JtPy5hZGRFdmVudExpc3RlbmVyKFwiY2xpY2tcIiwgdGhpcy5vblNlYXJjaEZvcm1DbGljay5iaW5kKHRoaXMpKTtcbiAgICAgICAgZG9jdW1lbnQuYWRkRXZlbnRMaXN0ZW5lcihcImNsaWNrXCIsIHRoaXMub25Eb2N1bWVudENsaWNrLmJpbmQodGhpcykpO1xuICAgIH1cblxuICAgIG9uQWpheFNlYXJjaChldmVudCkge1xuICAgICAgICB2YXIgc0lucHV0ICAgICAgPSB0aGlzLmVsZW1lbnRzLnNlYXJjaElucHV0LFxuICAgICAgICAgICAgc1ZhbHVlICAgICAgPSB0aGlzLmVsZW1lbnRzLnNlYXJjaElucHV0LnZhbHVlLFxuICAgICAgICAgICAgc1Jlc3VsdCAgICAgPSB0aGlzLmVsZW1lbnRzLnNlYXJjaFJlc3VsdHMsXG4gICAgICAgICAgICBzU3Bpbm5lciAgICA9IHRoaXMuZWxlbWVudHMuc2VhcmNoTG9hZGluZ1NwaW5uZXI7XG5cbiAgICAgICAgY2xlYXJUaW1lb3V0KHRoaXMuZ2V0U2V0dGluZ3MoXCJhamF4U2VhcmNoVGltZW91dElEXCIpKTtcblxuICAgICAgICBpZiAoc1ZhbHVlLmxlbmd0aCA+IDIpIHtcbiAgICAgICAgICAgIGNvbnN0IGFqYXhTZWFyY2hUaW1lb3V0SUQgPSBzZXRUaW1lb3V0KCgpID0+IHtcbiAgICAgICAgICAgICAgICBjb25zdCBodHRwUmVxdWVzdCAgID0gbmV3IFhNTEh0dHBSZXF1ZXN0KCk7XG4gICAgICAgICAgICAgICAgY29uc3QgZm9ybURhdGEgICAgICA9IG5ldyBGb3JtRGF0YSgpO1xuICAgICAgICAgICAgICAgIGZvcm1EYXRhLmFwcGVuZChcImFjdGlvblwiLCBcInpldXNfYWpheF9zZWFyY2hcIik7XG4gICAgICAgICAgICAgICAgZm9ybURhdGEuYXBwZW5kKFwibm9uY2VcIiwgc2VhcmNoRGF0YS5ub25jZSk7XG4gICAgICAgICAgICAgICAgZm9ybURhdGEuYXBwZW5kKFwic2VhcmNoXCIsIHNWYWx1ZSk7XG4gICAgICAgICAgICAgICAgZm9ybURhdGEuYXBwZW5kKFwidHlwZVwiLCBzSW5wdXQuZ2V0QXR0cmlidXRlKCdkYXRhLXR5cGUnKSk7XG5cbiAgICAgICAgICAgICAgICBodHRwUmVxdWVzdC5vbnJlYWR5c3RhdGVjaGFuZ2UgPSBmdW5jdGlvbigpIHtcbiAgICAgICAgICAgICAgICAgICAgaWYgKHRoaXMucmVhZHlTdGF0ZSA9PT0gNCAmJiB0aGlzLnN0YXR1cyA9PT0gMjAwKSB7XG4gICAgICAgICAgICAgICAgICAgICAgICBzUmVzdWx0LmlubmVySFRNTCA9IHRoaXMucmVzcG9uc2VUZXh0O1xuICAgICAgICAgICAgICAgICAgICAgICAgZmFkZUluKHNTcGlubmVyLCBcImZhc3RcIik7XG5cbiAgICAgICAgICAgICAgICAgICAgICAgIHNldFRpbWVvdXQoKCkgPT4ge1xuICAgICAgICAgICAgICAgICAgICAgICAgICAgIHNsaWRlRG93bihzUmVzdWx0LCA0MDApO1xuICAgICAgICAgICAgICAgICAgICAgICAgICAgIHNSZXN1bHQuY2xhc3NMaXN0LmFkZChcImZpbGxlZFwiKTtcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBmYWRlT3V0KHNTcGlubmVyLCBcImZhc3RcIik7XG4gICAgICAgICAgICAgICAgICAgICAgICB9LCAyMDApO1xuICAgICAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgfTtcblxuICAgICAgICAgICAgICAgIGh0dHBSZXF1ZXN0Lm9wZW4oXCJQT1NUXCIsIHNlYXJjaERhdGEuYWpheF91cmwsIHRydWUpO1xuICAgICAgICAgICAgICAgIGh0dHBSZXF1ZXN0LnNlbmQoZm9ybURhdGEpO1xuICAgICAgICAgICAgfSwgNDAwKTtcblxuICAgICAgICAgICAgdGhpcy5zZXRTZXR0aW5ncyh7XG4gICAgICAgICAgICAgICAgYWpheFNlYXJjaFRpbWVvdXRJRDogYWpheFNlYXJjaFRpbWVvdXRJRCxcbiAgICAgICAgICAgIH0pO1xuXG4gICAgICAgIH1cbiAgICB9XG5cbiAgICBvblNlYXJjaEZvcm1TdWJtaXQoZXZlbnQpIHtcbiAgICAgICAgZXZlbnQucHJldmVudERlZmF1bHQoKTtcbiAgICB9XG5cbiAgICBvblNlYXJjaEZvcm1DbGljayhldmVudCkge1xuICAgICAgICBjb25zdCBzZWFyY2hSZXN1bHRzID0gdGhpcy5lbGVtZW50cy5zZWFyY2gucXVlcnlTZWxlY3RvcihgJHt0aGlzLmdldFNldHRpbmdzKFwic2VsZWN0b3JzLnNlYXJjaFJlc3VsdHNcIil9LmZpbGxlZGApO1xuXG4gICAgICAgIGlmIChzZWFyY2hSZXN1bHRzKSB7XG4gICAgICAgICAgICBzbGlkZURvd24oc2VhcmNoUmVzdWx0cywgNDAwKTtcbiAgICAgICAgfVxuICAgIH1cblxuICAgIG9uRG9jdW1lbnRDbGljayhldmVudCkge1xuICAgICAgICAvLyBDbG9zZSBzZWFyY2ggcmVzdWx0c1xuICAgICAgICBjb25zdCBzZWFyY2hBcmVhID0gZXZlbnQudGFyZ2V0LmNsb3Nlc3QodGhpcy5nZXRTZXR0aW5ncyhcInNlbGVjdG9ycy5zZWFyY2hGb3JtXCIpKTtcbiAgICAgICAgY29uc3Qgc2VhcmNoUmVzdWx0c0FyZWEgPSBldmVudC50YXJnZXQuY2xvc2VzdCh0aGlzLmdldFNldHRpbmdzKFwic2VsZWN0b3JzLnNlYXJjaFJlc3VsdHNcIikpO1xuXG4gICAgICAgIGlmICghKHNlYXJjaEFyZWEgfHwgc2VhcmNoUmVzdWx0c0FyZWEpKSB7XG4gICAgICAgICAgICBzbGlkZVVwKHRoaXMuZWxlbWVudHMuc2VhcmNoUmVzdWx0cywgMjAwKTtcbiAgICAgICAgfVxuICAgIH1cbn1cblxucmVnaXN0ZXJXaWRnZXQoWmV1c19TZWFyY2gsIFwiemV1cy1zZWFyY2hcIik7XG4iXX0=
