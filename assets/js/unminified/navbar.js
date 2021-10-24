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
exports.slideToggle = void 0;

var _utils = require("../lib/utils");

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

function _get(target, property, receiver) { if (typeof Reflect !== "undefined" && Reflect.get) { _get = Reflect.get; } else { _get = function _get(target, property, receiver) { var base = _superPropBase(target, property); if (!base) return; var desc = Object.getOwnPropertyDescriptor(base, property); if (desc.get) { return desc.get.call(receiver); } return desc.value; }; } return _get(target, property, receiver || target); }

function _superPropBase(object, property) { while (!Object.prototype.hasOwnProperty.call(object, property)) { object = _getPrototypeOf(object); if (object === null) break; } return object; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function"); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, writable: true, configurable: true } }); if (superClass) _setPrototypeOf(subClass, superClass); }

function _setPrototypeOf(o, p) { _setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) { o.__proto__ = p; return o; }; return _setPrototypeOf(o, p); }

function _createSuper(Derived) { var hasNativeReflectConstruct = _isNativeReflectConstruct(); return function _createSuperInternal() { var Super = _getPrototypeOf(Derived), result; if (hasNativeReflectConstruct) { var NewTarget = _getPrototypeOf(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return _possibleConstructorReturn(this, result); }; }

function _possibleConstructorReturn(self, call) { if (call && (_typeof(call) === "object" || typeof call === "function")) { return call; } return _assertThisInitialized(self); }

function _assertThisInitialized(self) { if (self === void 0) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return self; }

function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); return true; } catch (e) { return false; } }

function _getPrototypeOf(o) { _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf : function _getPrototypeOf(o) { return o.__proto__ || Object.getPrototypeOf(o); }; return _getPrototypeOf(o); }

var slideToggle = function slideToggle(element, duration) {
  return window.getComputedStyle(element).display === "none" ? slideDown(element, duration) : slideUp(element, duration);
};

exports.slideToggle = slideToggle;

var Zeus_Navbar = /*#__PURE__*/function (_elementorModules$fro) {
  _inherits(Zeus_Navbar, _elementorModules$fro);

  var _super = _createSuper(Zeus_Navbar);

  function Zeus_Navbar() {
    _classCallCheck(this, Zeus_Navbar);

    return _super.apply(this, arguments);
  }

  _createClass(Zeus_Navbar, [{
    key: "getDefaultSettings",
    value: function getDefaultSettings() {
      return {
        selectors: {
          navbar: ".zeus-navbar-wrap",
          offCanvas: ".zeus-off-canvas-wrap",
          offCanvasOpenBtn: ".zeus-off-canvas-button",
          offCanvasCloseElems: ".zeus-off-canvas-close, .zeus-off-canvas-overlay",
          responsiveNavbar: ".zeus-navbar-wrap.zeus-is-responsive ul.zeus-navbar",
          responsiveNavbarOpenBtn: ".zeus-mobile-button"
        }
      };
    }
  }, {
    key: "getDefaultElements",
    value: function getDefaultElements() {
      var element = this.$element.get(0);
      var selectors = this.getSettings("selectors");
      return {
        navbar: element.querySelector(selectors.navbar),
        offCanvas: element.querySelector(selectors.offCanvas),
        offCanvasOpenBtn: element.querySelector(selectors.offCanvasOpenBtn),
        offCanvasCloseElems: element.querySelectorAll(selectors.offCanvasCloseElems),
        responsiveNavbar: element.querySelector(selectors.responsiveNavbar),
        responsiveNavbarOpenBtn: element.querySelector(selectors.responsiveNavbarOpenBtn)
      };
    }
  }, {
    key: "onInit",
    value: function onInit() {
      var _get2;

      for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
        args[_key] = arguments[_key];
      }

      (_get2 = _get(_getPrototypeOf(Zeus_Navbar.prototype), "onInit", this)).call.apply(_get2, [this].concat(args));

      if (this.isOffCanvasActive()) {
        this.moveModalToEndOfBody();
      }

      this.setupEventListeners();
    }
  }, {
    key: "moveModalToEndOfBody",
    value: function moveModalToEndOfBody() {
      var _this = this;

      document.querySelectorAll("#zeus-off-canvas-".concat(this.getID())).forEach(function (offCanvas) {
        if (_this.elements.offCanvas !== offCanvas) {
          offCanvas.remove();
        }
      });
      document.body.insertAdjacentElement("beforeend", this.elements.offCanvas);
    }
  }, {
    key: "setupEventListeners",
    value: function setupEventListeners() {
      var _this2 = this;

      if (this.isOffCanvasActive()) {
        this.elements.offCanvasOpenBtn.addEventListener("click", this.openOffCanvas.bind(this));
        this.elements.offCanvasCloseElems.forEach(function (offCanvasCloseElem) {
          offCanvasCloseElem.addEventListener("click", _this2.closeOffCanvas.bind(_this2));
        });
      }

      if (this.isResponsiveNavbarActive()) {
        this.elements.responsiveNavbarOpenBtn.addEventListener("click", this.openResponsiveNavbar.bind(this));
      }
    }
  }, {
    key: "openOffCanvas",
    value: function openOffCanvas(event) {
      event.preventDefault();
      var targetID = this.elements.offCanvasOpenBtn.getAttribute("href");
      document.querySelector(targetID).classList.toggle("show");
    }
  }, {
    key: "closeOffCanvas",
    value: function closeOffCanvas(event) {
      var offCanvasCloseElem = event.currentTarget;
      offCanvasCloseElem.closest(".zeus-off-canvas-wrap").classList.remove("show");
    }
  }, {
    key: "openResponsiveNavbar",
    value: function openResponsiveNavbar(event) {
      event.preventDefault();
      slideToggle(this.elements.responsiveNavbar, 500);
      this.elements.responsiveNavbarOpenBtn.classList.toggle("opened");
    }
  }, {
    key: "isOffCanvasActive",
    value: function isOffCanvasActive() {
      return this.elements.navbar.classList.contains("zeus-has-off-canvas");
    }
  }, {
    key: "isResponsiveNavbarActive",
    value: function isResponsiveNavbarActive() {
      return this.elements.navbar.classList.contains("zeus-is-responsive");
    }
  }]);

  return Zeus_Navbar;
}(elementorModules.frontend.handlers.Base);

(0, _utils.registerWidget)(Zeus_Navbar, "zeus-navbar");

},{"../lib/utils":1}]},{},[2])
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm5vZGVfbW9kdWxlcy9icm93c2VyLXBhY2svX3ByZWx1ZGUuanMiLCJzcmMvbGliL3V0aWxzLmpzIiwic3JjL3dpZGdldHMvbmF2YmFyLmpzIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUFBOzs7Ozs7OztBQ0FPLElBQU0sY0FBYyxHQUFHLFNBQWpCLGNBQWlCLENBQUMsU0FBRCxFQUFZLFVBQVosRUFBNkM7QUFBQSxNQUFyQixJQUFxQix1RUFBZCxTQUFjOztBQUN2RSxNQUFJLEVBQUUsU0FBUyxJQUFJLFVBQWYsQ0FBSixFQUFnQztBQUM1QjtBQUNIO0FBRUQ7QUFDSjtBQUNBO0FBQ0E7OztBQUNJLEVBQUEsTUFBTSxDQUFDLE1BQUQsQ0FBTixDQUFlLEVBQWYsQ0FBa0IseUJBQWxCLEVBQTZDLFlBQU07QUFDL0MsUUFBTSxVQUFVLEdBQUcsU0FBYixVQUFhLENBQUMsUUFBRCxFQUFjO0FBQzdCLE1BQUEsaUJBQWlCLENBQUMsZUFBbEIsQ0FBa0MsVUFBbEMsQ0FBNkMsU0FBN0MsRUFBd0Q7QUFDcEQsUUFBQSxRQUFRLEVBQVI7QUFEb0QsT0FBeEQ7QUFHSCxLQUpEOztBQU1BLElBQUEsaUJBQWlCLENBQUMsS0FBbEIsQ0FBd0IsU0FBeEIsa0NBQTRELFVBQTVELGNBQTBFLElBQTFFLEdBQWtGLFVBQWxGO0FBQ0gsR0FSRDtBQVNILENBbEJNOzs7Ozs7Ozs7Ozs7OztBQ0FQOzs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7OztBQUVPLElBQU0sV0FBVyxHQUFHLFNBQWQsV0FBYyxDQUFDLE9BQUQsRUFBVSxRQUFWO0FBQUEsU0FDdkIsTUFBTSxDQUFDLGdCQUFQLENBQXdCLE9BQXhCLEVBQWlDLE9BQWpDLEtBQTZDLE1BQTdDLEdBQXNELFNBQVMsQ0FBQyxPQUFELEVBQVUsUUFBVixDQUEvRCxHQUFxRixPQUFPLENBQUMsT0FBRCxFQUFVLFFBQVYsQ0FEckU7QUFBQSxDQUFwQjs7OztJQUdELFc7Ozs7Ozs7Ozs7Ozs7V0FDRiw4QkFBcUI7QUFDakIsYUFB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M0MsQ0FBa0QsTUFBbEQ7QUFDSDs7O1dBRUQsd0JBQWUsS0FBZixFQUFzQjtBQUNsQixVQUFNLGtCQUFrQixHQUFHLEtBQUssQ0FBQyxhQUFqQztBQUVBLE1BQUEsa0JBQWtCLENBQUMsT0FBbkIsQ0FBMkIsdUJBQTNCLEVBQW9ELFNBQXBELENBQThELE1BQTlELENBQXFFLE1BQXJFO0FBQ0g7OztXQUVELDhCQUFxQixLQUFyQixFQUE0QjtBQUN4QixNQUFBLEtBQUssQ0FBQyxjQUFOO0FBRUEsTUFBQSxXQUFXLENBQUMsS0FBSyxRQUFMLENBQWMsZ0JBQWYsRUFBaUMsR0FBakMsQ0FBWDtBQUNBLFdBQUssUUFBTCxDQUFjLHVCQUFkLENBQXNDLFNBQXRDLENBQWdELE1BQWhELENBQXVELFFBQXZEO0FBQ0g7OztXQUVELDZCQUFvQjtBQUNoQixhQUFPLEtBQUssUUFBTCxDQUFjLE1BQWQsQ0FBcUIsU0FBckIsQ0FBK0IsUUFBL0IsQ0FBd0MscUJBQXhDLENBQVA7QUFDSDs7O1dBRUQsb0NBQTJCO0FBQ3ZCLGFBQU8sS0FBSyxRQUFMLENBQWMsTUFBZCxDQUFxQixTQUFyQixDQUErQixRQUEvQixDQUF3QyxvQkFBeEMsQ0FBUDtBQUNIOzs7O0VBeEZxQixnQkFBZ0IsQ0FBQyxRQUFqQixDQUEwQixRQUExQixDQUFtQyxJOztBQTJGN0QsMkJBQWUsV0FBZixFQUE0QixhQUE1QiIsImZpbGUiOiJnZW5lcmF0ZWQuanMiLCJzb3VyY2VSb290IjoiIiwic291cmNlc0NvbnRlbnQiOlsiKGZ1bmN0aW9uKCl7ZnVuY3Rpb24gcihlLG4sdCl7ZnVuY3Rpb24gbyhpLGYpe2lmKCFuW2ldKXtpZighZVtpXSl7dmFyIGM9XCJmdW5jdGlvblwiPT10eXBlb2YgcmVxdWlyZSYmcmVxdWlyZTtpZighZiYmYylyZXR1cm4gYyhpLCEwKTtpZih1KXJldHVybiB1KGksITApO3ZhciBhPW5ldyBFcnJvcihcIkNhbm5vdCBmaW5kIG1vZHVsZSAnXCIraStcIidcIik7dGhyb3cgYS5jb2RlPVwiTU9EVUxFX05PVF9GT1VORFwiLGF9dmFyIHA9bltpXT17ZXhwb3J0czp7fX07ZVtpXVswXS5jYWxsKHAuZXhwb3J0cyxmdW5jdGlvbihyKXt2YXIgbj1lW2ldWzFdW3JdO3JldHVybiBvKG58fHIpfSxwLHAuZXhwb3J0cyxyLGUsbix0KX1yZXR1cm4gbltpXS5leHBvcnRzfWZvcih2YXIgdT1cImZ1bmN0aW9uXCI9PXR5cGVvZiByZXF1aXJlJiZyZXF1aXJlLGk9MDtpPHQubGVuZ3RoO2krKylvKHRbaV0pO3JldHVybiBvfXJldHVybiByfSkoKSIsImV4cG9ydCBjb25zdCByZWdpc3RlcldpZGdldCA9IChjbGFzc05hbWUsIHdpZGdldE5hbWUsIHNraW4gPSAnZGVmYXVsdCcpID0+IHtcbiAgICBpZiAoIShjbGFzc05hbWUgfHwgd2lkZ2V0TmFtZSkpIHtcbiAgICAgICAgcmV0dXJuO1xuICAgIH1cblxuICAgIC8qKlxuICAgICAqIEJlY2F1c2UgRWxlbWVudG9yIHBsdWdpbiB1c2VzIGpRdWVyeSBjdXN0b20gZXZlbnQsXG4gICAgICogV2UgYWxzbyBoYXZlIHRvIHVzZSBqUXVlcnkgdG8gdXNlIHRoaXMgZXZlbnRcbiAgICAgKi9cbiAgICBqUXVlcnkod2luZG93KS5vbignZWxlbWVudG9yL2Zyb250ZW5kL2luaXQnLCAoKSA9PiB7XG4gICAgICAgIGNvbnN0IGFkZEhhbmRsZXIgPSAoJGVsZW1lbnQpID0+IHtcbiAgICAgICAgICAgIGVsZW1lbnRvckZyb250ZW5kLmVsZW1lbnRzSGFuZGxlci5hZGRIYW5kbGVyKGNsYXNzTmFtZSwge1xuICAgICAgICAgICAgICAgICRlbGVtZW50LFxuICAgICAgICAgICAgfSk7XG4gICAgICAgIH07XG5cbiAgICAgICAgZWxlbWVudG9yRnJvbnRlbmQuaG9va3MuYWRkQWN0aW9uKGBmcm9udGVuZC9lbGVtZW50X3JlYWR5LyR7d2lkZ2V0TmFtZX0uJHtza2lufWAsIGFkZEhhbmRsZXIpO1xuICAgIH0pO1xufTtcbiIsImltcG9ydCB7IHJlZ2lzdGVyV2lkZ2V0IH0gZnJvbSBcIi4uL2xpYi91dGlsc1wiO1xuXG5leHBvcnQgY29uc3Qgc2xpZGVUb2dnbGUgPSAoZWxlbWVudCwgZHVyYXRpb24pID0+XG4gICAgd2luZG93LmdldENvbXB1dGVkU3R5bGUoZWxlbWVudCkuZGlzcGxheSA9PT0gXCJub25lXCIgPyBzbGlkZURvd24oZWxlbWVudCwgZHVyYXRpb24pIDogc2xpZGVVcChlbGVtZW50LCBkdXJhdGlvbik7XG5cbmNsYXNzIFpldXNfTmF2YmFyIGV4dGVuZHMgZWxlbWVudG9yTW9kdWxlcy5mcm9udGVuZC5oYW5kbGVycy5CYXNlIHtcbiAgICBnZXREZWZhdWx0U2V0dGluZ3MoKSB7XG4gICAgICAgIHJldHVybiB7XG4gICAgICAgICAgICBzZWxlY3RvcnM6IHtcbiAgICAgICAgICAgICAgICBuYXZiYXI6IFwiLnpldXMtbmF2YmFyLXdyYXBcIixcbiAgICAgICAgICAgICAgICBvZmZDYW52YXM6IFwiLnpldXMtb2ZmLWNhbnZhcy13cmFwXCIsXG4gICAgICAgICAgICAgICAgb2ZmQ2FudmFzT3BlbkJ0bjogXCIuemV1cy1vZmYtY2FudmFzLWJ1dHRvblwiLFxuICAgICAgICAgICAgICAgIG9mZkNhbnZhc0Nsb3NlRWxlbXM6IFwiLnpldXMtb2ZmLWNhbnZhcy1jbG9zZSwgLnpldXMtb2ZmLWNhbnZhcy1vdmVybGF5XCIsXG4gICAgICAgICAgICAgICAgcmVzcG9uc2l2ZU5hdmJhcjogXCIuemV1cy1uYXZiYXItd3JhcC56ZXVzLWlzLXJlc3BvbnNpdmUgdWwuemV1cy1uYXZiYXJcIixcbiAgICAgICAgICAgICAgICByZXNwb25zaXZlTmF2YmFyT3BlbkJ0bjogXCIuemV1cy1tb2JpbGUtYnV0dG9uXCIsXG4gICAgICAgICAgICB9LFxuICAgICAgICB9O1xuICAgIH1cblxuICAgIGdldERlZmF1bHRFbGVtZW50cygpIHtcbiAgICAgICAgY29uc3QgZWxlbWVudCA9IHRoaXMuJGVsZW1lbnQuZ2V0KDApO1xuICAgICAgICBjb25zdCBzZWxlY3RvcnMgPSB0aGlzLmdldFNldHRpbmdzKFwic2VsZWN0b3JzXCIpO1xuXG4gICAgICAgIHJldHVybiB7XG4gICAgICAgICAgICBuYXZiYXI6IGVsZW1lbnQucXVlcnlTZWxlY3RvcihzZWxlY3RvcnMubmF2YmFyKSxcbiAgICAgICAgICAgIG9mZkNhbnZhczogZWxlbWVudC5xdWVyeVNlbGVjdG9yKHNlbGVjdG9ycy5vZmZDYW52YXMpLFxuICAgICAgICAgICAgb2ZmQ2FudmFzT3BlbkJ0bjogZWxlbWVudC5xdWVyeVNlbGVjdG9yKHNlbGVjdG9ycy5vZmZDYW52YXNPcGVuQnRuKSxcbiAgICAgICAgICAgIG9mZkNhbnZhc0Nsb3NlRWxlbXM6IGVsZW1lbnQucXVlcnlTZWxlY3RvckFsbChzZWxlY3RvcnMub2ZmQ2FudmFzQ2xvc2VFbGVtcyksXG4gICAgICAgICAgICByZXNwb25zaXZlTmF2YmFyOiBlbGVtZW50LnF1ZXJ5U2VsZWN0b3Ioc2VsZWN0b3JzLnJlc3BvbnNpdmVOYXZiYXIpLFxuICAgICAgICAgICAgcmVzcG9uc2l2ZU5hdmJhck9wZW5CdG46IGVsZW1lbnQucXVlcnlTZWxlY3RvcihzZWxlY3RvcnMucmVzcG9uc2l2ZU5hdmJhck9wZW5CdG4pLFxuICAgICAgICB9O1xuICAgIH1cblxuICAgIG9uSW5pdCguLi5hcmdzKSB7XG4gICAgICAgIHN1cGVyLm9uSW5pdCguLi5hcmdzKTtcblxuICAgICAgICBpZiAodGhpcy5pc09mZkNhbnZhc0FjdGl2ZSgpKSB7XG4gICAgICAgICAgICB0aGlzLm1vdmVNb2RhbFRvRW5kT2ZCb2R5KCk7XG4gICAgICAgIH1cblxuICAgICAgICB0aGlzLnNldHVwRXZlbnRMaXN0ZW5lcnMoKTtcbiAgICB9XG5cbiAgICBtb3ZlTW9kYWxUb0VuZE9mQm9keSgpIHtcbiAgICAgICAgZG9jdW1lbnQucXVlcnlTZWxlY3RvckFsbChgI3pldXMtb2ZmLWNhbnZhcy0ke3RoaXMuZ2V0SUQoKX1gKS5mb3JFYWNoKChvZmZDYW52YXMpID0+IHtcbiAgICAgICAgICAgIGlmICh0aGlzLmVsZW1lbnRzLm9mZkNhbnZhcyAhPT0gb2ZmQ2FudmFzKSB7XG4gICAgICAgICAgICAgICAgb2ZmQ2FudmFzLnJlbW92ZSgpO1xuICAgICAgICAgICAgfVxuICAgICAgICB9KTtcblxuICAgICAgICBkb2N1bWVudC5ib2R5Lmluc2VydEFkamFjZW50RWxlbWVudChcImJlZm9yZWVuZFwiLCB0aGlzLmVsZW1lbnRzLm9mZkNhbnZhcyk7XG4gICAgfVxuXG4gICAgc2V0dXBFdmVudExpc3RlbmVycygpIHtcbiAgICAgICAgaWYgKHRoaXMuaXNPZmZDYW52YXNBY3RpdmUoKSkge1xuICAgICAgICAgICAgdGhpcy5lbGVtZW50cy5vZmZDYW52YXNPcGVuQnRuLmFkZEV2ZW50TGlzdGVuZXIoXCJjbGlja1wiLCB0aGlzLm9wZW5PZmZDYW52YXMuYmluZCh0aGlzKSk7XG4gICAgICAgICAgICB0aGlzLmVsZW1lbnRzLm9mZkNhbnZhc0Nsb3NlRWxlbXMuZm9yRWFjaCgob2ZmQ2FudmFzQ2xvc2VFbGVtKSA9PiB7XG4gICAgICAgICAgICAgICAgb2ZmQ2FudmFzQ2xvc2VFbGVtLmFkZEV2ZW50TGlzdGVuZXIoXCJjbGlja1wiLCB0aGlzLmNsb3NlT2ZmQ2FudmFzLmJpbmQodGhpcykpO1xuICAgICAgICAgICAgfSk7XG4gICAgICAgIH1cblxuICAgICAgICBpZiAodGhpcy5pc1Jlc3BvbnNpdmVOYXZiYXJBY3RpdmUoKSkge1xuICAgICAgICAgICAgdGhpcy5lbGVtZW50cy5yZXNwb25zaXZlTmF2YmFyT3BlbkJ0bi5hZGRFdmVudExpc3RlbmVyKFwiY2xpY2tcIiwgdGhpcy5vcGVuUmVzcG9uc2l2ZU5hdmJhci5iaW5kKHRoaXMpKTtcbiAgICAgICAgfVxuICAgIH1cblxuICAgIG9wZW5PZmZDYW52YXMoZXZlbnQpIHtcbiAgICAgICAgZXZlbnQucHJldmVudERlZmF1bHQoKTtcblxuICAgICAgICBjb25zdCB0YXJnZXRJRCA9IHRoaXMuZWxlbWVudHMub2ZmQ2FudmFzT3BlbkJ0bi5nZXRBdHRyaWJ1dGUoXCJocmVmXCIpO1xuXG4gICAgICAgIGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IodGFyZ2V0SUQpLmNsYXNzTGlzdC50b2dnbGUoXCJzaG93XCIpO1xuICAgIH1cblxuICAgIGNsb3NlT2ZmQ2FudmFzKGV2ZW50KSB7XG4gICAgICAgIGNvbnN0IG9mZkNhbnZhc0Nsb3NlRWxlbSA9IGV2ZW50LmN1cnJlbnRUYXJnZXQ7XG5cbiAgICAgICAgb2ZmQ2FudmFzQ2xvc2VFbGVtLmNsb3Nlc3QoXCIuemV1cy1vZmYtY2FudmFzLXdyYXBcIikuY2xhc3NMaXN0LnJlbW92ZShcInNob3dcIik7XG4gICAgfVxuXG4gICAgb3BlblJlc3BvbnNpdmVOYXZiYXIoZXZlbnQpIHtcbiAgICAgICAgZXZlbnQucHJldmVudERlZmF1bHQoKTtcblxuICAgICAgICBzbGlkZVRvZ2dsZSh0aGlzLmVsZW1lbnRzLnJlc3BvbnNpdmVOYXZiYXIsIDUwMCk7XG4gICAgICAgIHRoaXMuZWxlbWVudHMucmVzcG9uc2l2ZU5hdmJhck9wZW5CdG4uY2xhc3NMaXN0LnRvZ2dsZShcIm9wZW5lZFwiKTtcbiAgICB9XG5cbiAgICBpc09mZkNhbnZhc0FjdGl2ZSgpIHtcbiAgICAgICAgcmV0dXJuIHRoaXMuZWxlbWVudHMubmF2YmFyLmNsYXNzTGlzdC5jb250YWlucyhcInpldXMtaGFzLW9mZi1jYW52YXNcIik7XG4gICAgfVxuXG4gICAgaXNSZXNwb25zaXZlTmF2YmFyQWN0aXZlKCkge1xuICAgICAgICByZXR1cm4gdGhpcy5lbGVtZW50cy5uYXZiYXIuY2xhc3NMaXN0LmNvbnRhaW5zKFwiemV1cy1pcy1yZXNwb25zaXZlXCIpO1xuICAgIH1cbn1cblxucmVnaXN0ZXJXaWRnZXQoWmV1c19OYXZiYXIsIFwiemV1cy1uYXZiYXJcIik7XG4iXX0=
