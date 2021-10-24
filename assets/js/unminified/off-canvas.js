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

var Zeus_OffCanvas = /*#__PURE__*/function (_elementorModules$fro) {
  _inherits(Zeus_OffCanvas, _elementorModules$fro);

  var _super = _createSuper(Zeus_OffCanvas);

  function Zeus_OffCanvas() {
    _classCallCheck(this, Zeus_OffCanvas);

    return _super.apply(this, arguments);
  }

  _createClass(Zeus_OffCanvas, [{
    key: "getDefaultSettings",
    value: function getDefaultSettings() {
      return {
        selectors: {
          offCanvas: ".zeus-off-canvas-wrap",
          offCanvasOpenBtn: ".zeus-off-canvas-button a",
          offCanvasCloseElems: ".zeus-off-canvas-close, .zeus-off-canvas-overlay"
        }
      };
    }
  }, {
    key: "getDefaultElements",
    value: function getDefaultElements() {
      var element = this.$element.get(0);
      var selectors = this.getSettings("selectors");
      return {
        offCanvas: element.querySelector(selectors.offCanvas),
        offCanvasOpenBtn: element.querySelector(selectors.offCanvasOpenBtn),
        offCanvasCloseElems: element.querySelectorAll(selectors.offCanvasCloseElems)
      };
    }
  }, {
    key: "onInit",
    value: function onInit() {
      var _get2;

      for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
        args[_key] = arguments[_key];
      }

      (_get2 = _get(_getPrototypeOf(Zeus_OffCanvas.prototype), "onInit", this)).call.apply(_get2, [this].concat(args));

      this.moveModalToEndOfBody();
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
      var _this$elements$offCan,
          _this$elements$offCan2,
          _this2 = this;

      (_this$elements$offCan = this.elements.offCanvasOpenBtn) === null || _this$elements$offCan === void 0 ? void 0 : _this$elements$offCan.addEventListener("click", this.openCanvas.bind(this));
      (_this$elements$offCan2 = this.elements.offCanvasCloseElems) === null || _this$elements$offCan2 === void 0 ? void 0 : _this$elements$offCan2.forEach(function (offCanvasCloseElem) {
        offCanvasCloseElem.addEventListener("click", _this2.closeCanvas.bind(_this2));
      });
    }
  }, {
    key: "openCanvas",
    value: function openCanvas(event) {
      event.preventDefault();
      var targetID = this.elements.offCanvasOpenBtn.getAttribute("href");
      var offCanvas = document.querySelector(targetID);
      offCanvas.classList.toggle("show");
    }
  }, {
    key: "closeCanvas",
    value: function closeCanvas(event) {
      var offCanvasCloseElem = event.currentTarget;
      offCanvasCloseElem.closest(".zeus-off-canvas-wrap").classList.remove("show");
    }
  }]);

  return Zeus_OffCanvas;
}(elementorModules.frontend.handlers.Base);

(0, _utils.registerWidget)(Zeus_OffCanvas, "zeus-off-canvas");

},{"../lib/utils":1}]},{},[2])
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm5vZGVfbW9kdWxlcy9icm93c2VyLXBhY2svX3ByZWx1ZGUuanMiLCJzcmMvbGliL3V0aWxzLmpzIiwic3JjL3dpZGdldHMvb2ZmLWNhbnZhcy5qcyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFBQTs7Ozs7Ozs7QUNBTyxJQUFNLGNBQWMsR0FBRyxTQUFqQixjQUFpQixDQUFDLFNBQUQsRUFBWSxVQUFaLEVBQTZDO0FBQUEsTUFBckIsSUFBcUIsdUVBQWQsU0FBYzs7QUFDdkUsTUFBSSxFQUFFLFNBQVMsSUFBSSxVQUFmLENBQUosRUFBZ0M7QUFDNUI7QUFDSDtBQUVEO0FBQ0o7QUFDQTtBQUNBOzs7QUFDSSxFQUFBLE1BQU0sQ0FBQyxNQUFELENBQU4sQ0FBZSxFQUFmLENBQWtCLHlCQUFsQixFQUE2QyxZQUFNO0FBQy9DLFFBQU0sVUFBVSxHQUFHLFNBQWIsVUFBYSxDQUFDLFFBQUQsRUFBYztBQUM3QixNQUFBLGlCQUFpQixDQUFDLGVBQWxCLENBQWtDLFVBQWxDLENBQTZDLFNBQTdDLEVBQXdEO0FBQ3BELFFBQUEsUUFBUSxFQUFSO0FBRG9ELE9BQXhEO0FBR0gsS0FKRDs7QUFNQSxJQUFBLGlCQUFpQixDQUFDLEtBQWxCLENBQXdCLFNBQXhCLGtDQUE0RCxVQUE1RCxjQUEwRSxJQUExRSxHQUFrRixVQUFsRjtBQUNILEdBUkQ7QUFTSCxDQWxCTTs7Ozs7Ozs7O0FDQVA7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7O0lBRU0sYzs7Ozs7Ozs7Ozs7OztXQUNGLDhCQUFxQjtBQUNqQixhQUFPO0FBQ0gsUUFBQSxTQUFTLEVBQUU7QUFDUCxVQUFBLFNBQVMsRUFBRSx1QkFESjtBQUVQLFVBQUEsZ0JBQWdCLEVBQUUsMkJBRlg7QUFHUCxVQUFBLG1CQUFtQixFQUFFO0FBSGQ7QUFEUixPQUFQO0FBT0g7OztXQUVELDhCQUFxQjtBQUNqQixVQUFNLE9BQU8sR0FBRyxLQUFLLFFBQUwsQ0FBYyxHQUFkLENBQWtCLENBQWxCLENBQWhCO0FBQ0EsVUFBTSxTQUFTLEdBQUcsS0FBSyxXQUFMLENBQWlCLFdBQWpCLENBQWxCO0FBRUEsYUFBTztBQUNILFFBQUEsU0FBUyxFQUFFLE9BQU8sQ0FBQyxhQUFSLENBQXNCLFNBQVMsQ0FBQyxTQUFoQyxDQURSO0FBRUgsUUFBQSxnQkFBZ0IsRUFBRSxPQUFPLENBQUMsYUFBUixDQUFzQixTQUFTLENBQUMsZ0JBQWhDLENBRmY7QUFHSCxRQUFBLG1CQUFtQixFQUFFLE9BQU8sQ0FBQyxnQkFBUixDQUF5QixTQUFTLENBQUMsbUJBQW5DO0FBSGxCLE9BQVA7QUFLSDs7O1dBRUQsa0JBQWdCO0FBQUE7O0FBQUEsd0NBQU4sSUFBTTtBQUFOLFFBQUEsSUFBTTtBQUFBOztBQUNaLGdIQUFnQixJQUFoQjs7QUFFQSxXQUFLLG9CQUFMO0FBQ0EsV0FBSyxtQkFBTDtBQUNIOzs7V0FFRCxnQ0FBdUI7QUFBQTs7QUFDbkIsTUFBQSxRQUFRLENBQUMsZ0JBQVQsNEJBQThDLEtBQUssS0FBTCxFQUE5QyxHQUE4RCxPQUE5RCxDQUFzRSxVQUFDLFNBQUQsRUFBZTtBQUNqRixZQUFJLEtBQUksQ0FBQyxRQUFMLENBQWMsU0FBZCxLQUE0QixTQUFoQyxFQUEyQztBQUN2QyxVQUFBLFNBQVMsQ0FBQyxNQUFWO0FBQ0g7QUFDSixPQUpEO0FBTUEsTUFBQSxRQUFRLENBQUMsSUFBVCxDQUFjLHFCQUFkLENBQW9DLFdBQXBDLEVBQWlELEtBQUssUUFBTCxDQUFjLFNBQS9EO0FBQ0g7OztXQUVELCtCQUFzQjtBQUFBO0FBQUE7QUFBQTs7QUFDbEIsb0NBQUssUUFBTCxDQUFjLGdCQUFkLGdGQUFnQyxnQkFBaEMsQ0FBaUQsT0FBakQsRUFBMEQsS0FBSyxVQUFMLENBQWdCLElBQWhCLENBQXFCLElBQXJCLENBQTFEO0FBRUEscUNBQUssUUFBTCxDQUFjLG1CQUFkLGtGQUFtQyxPQUFuQyxDQUEyQyxVQUFDLGtCQUFELEVBQXdCO0FBQy9ELFFBQUEsa0JBQWtCLENBQUMsZ0JBQW5CLENBQW9DLE9BQXBDLEVBQTZDLE1BQUksQ0FBQyxXQUFMLENBQWlCLElBQWpCLENBQXNCLE1BQXRCLENBQTdDO0FBQ0gsT0FGRDtBQUdIOzs7V0FFRCxvQkFBVyxLQUFYLEVBQWtCO0FBQ2QsTUFBQSxLQUFLLENBQUMsY0FBTjtBQUVBLFVBQU0sUUFBUSxHQUFHLEtBQUssUUFBTCxDQUFjLGdCQUFkLENBQStCLFlBQS9CLENBQTRDLE1BQTVDLENBQWpCO0FBQ0EsVUFBTSxTQUFTLEdBQUcsUUFBUSxDQUFDLGFBQVQsQ0FBdUIsUUFBdkIsQ0FBbEI7QUFFQSxNQUFBLFNBQVMsQ0FBQyxTQUFWLENBQW9CLE1BQXBCLENBQTJCLE1BQTNCO0FBQ0g7OztXQUVELHFCQUFZLEtBQVosRUFBbUI7QUFDZixVQUFNLGtCQUFrQixHQUFHLEtBQUssQ0FBQyxhQUFqQztBQUVBLE1BQUEsa0JBQWtCLENBQUMsT0FBbkIsQ0FBMkIsdUJBQTNCLEVBQW9ELFNBQXBELENBQThELE1BQTlELENBQXFFLE1BQXJFO0FBQ0g7Ozs7RUE1RHdCLGdCQUFnQixDQUFDLFFBQWpCLENBQTBCLFFBQTFCLENBQW1DLEk7O0FBK0RoRSwyQkFBZSxjQUFmLEVBQStCLGlCQUEvQiIsImZpbGUiOiJnZW5lcmF0ZWQuanMiLCJzb3VyY2VSb290IjoiIiwic291cmNlc0NvbnRlbnQiOlsiKGZ1bmN0aW9uKCl7ZnVuY3Rpb24gcihlLG4sdCl7ZnVuY3Rpb24gbyhpLGYpe2lmKCFuW2ldKXtpZighZVtpXSl7dmFyIGM9XCJmdW5jdGlvblwiPT10eXBlb2YgcmVxdWlyZSYmcmVxdWlyZTtpZighZiYmYylyZXR1cm4gYyhpLCEwKTtpZih1KXJldHVybiB1KGksITApO3ZhciBhPW5ldyBFcnJvcihcIkNhbm5vdCBmaW5kIG1vZHVsZSAnXCIraStcIidcIik7dGhyb3cgYS5jb2RlPVwiTU9EVUxFX05PVF9GT1VORFwiLGF9dmFyIHA9bltpXT17ZXhwb3J0czp7fX07ZVtpXVswXS5jYWxsKHAuZXhwb3J0cyxmdW5jdGlvbihyKXt2YXIgbj1lW2ldWzFdW3JdO3JldHVybiBvKG58fHIpfSxwLHAuZXhwb3J0cyxyLGUsbix0KX1yZXR1cm4gbltpXS5leHBvcnRzfWZvcih2YXIgdT1cImZ1bmN0aW9uXCI9PXR5cGVvZiByZXF1aXJlJiZyZXF1aXJlLGk9MDtpPHQubGVuZ3RoO2krKylvKHRbaV0pO3JldHVybiBvfXJldHVybiByfSkoKSIsImV4cG9ydCBjb25zdCByZWdpc3RlcldpZGdldCA9IChjbGFzc05hbWUsIHdpZGdldE5hbWUsIHNraW4gPSAnZGVmYXVsdCcpID0+IHtcbiAgICBpZiAoIShjbGFzc05hbWUgfHwgd2lkZ2V0TmFtZSkpIHtcbiAgICAgICAgcmV0dXJuO1xuICAgIH1cblxuICAgIC8qKlxuICAgICAqIEJlY2F1c2UgRWxlbWVudG9yIHBsdWdpbiB1c2VzIGpRdWVyeSBjdXN0b20gZXZlbnQsXG4gICAgICogV2UgYWxzbyBoYXZlIHRvIHVzZSBqUXVlcnkgdG8gdXNlIHRoaXMgZXZlbnRcbiAgICAgKi9cbiAgICBqUXVlcnkod2luZG93KS5vbignZWxlbWVudG9yL2Zyb250ZW5kL2luaXQnLCAoKSA9PiB7XG4gICAgICAgIGNvbnN0IGFkZEhhbmRsZXIgPSAoJGVsZW1lbnQpID0+IHtcbiAgICAgICAgICAgIGVsZW1lbnRvckZyb250ZW5kLmVsZW1lbnRzSGFuZGxlci5hZGRIYW5kbGVyKGNsYXNzTmFtZSwge1xuICAgICAgICAgICAgICAgICRlbGVtZW50LFxuICAgICAgICAgICAgfSk7XG4gICAgICAgIH07XG5cbiAgICAgICAgZWxlbWVudG9yRnJvbnRlbmQuaG9va3MuYWRkQWN0aW9uKGBmcm9udGVuZC9lbGVtZW50X3JlYWR5LyR7d2lkZ2V0TmFtZX0uJHtza2lufWAsIGFkZEhhbmRsZXIpO1xuICAgIH0pO1xufTtcbiIsImltcG9ydCB7IHJlZ2lzdGVyV2lkZ2V0IH0gZnJvbSBcIi4uL2xpYi91dGlsc1wiO1xuXG5jbGFzcyBaZXVzX09mZkNhbnZhcyBleHRlbmRzIGVsZW1lbnRvck1vZHVsZXMuZnJvbnRlbmQuaGFuZGxlcnMuQmFzZSB7XG4gICAgZ2V0RGVmYXVsdFNldHRpbmdzKCkge1xuICAgICAgICByZXR1cm4ge1xuICAgICAgICAgICAgc2VsZWN0b3JzOiB7XG4gICAgICAgICAgICAgICAgb2ZmQ2FudmFzOiBcIi56ZXVzLW9mZi1jYW52YXMtd3JhcFwiLFxuICAgICAgICAgICAgICAgIG9mZkNhbnZhc09wZW5CdG46IFwiLnpldXMtb2ZmLWNhbnZhcy1idXR0b24gYVwiLFxuICAgICAgICAgICAgICAgIG9mZkNhbnZhc0Nsb3NlRWxlbXM6IFwiLnpldXMtb2ZmLWNhbnZhcy1jbG9zZSwgLnpldXMtb2ZmLWNhbnZhcy1vdmVybGF5XCIsXG4gICAgICAgICAgICB9LFxuICAgICAgICB9O1xuICAgIH1cblxuICAgIGdldERlZmF1bHRFbGVtZW50cygpIHtcbiAgICAgICAgY29uc3QgZWxlbWVudCA9IHRoaXMuJGVsZW1lbnQuZ2V0KDApO1xuICAgICAgICBjb25zdCBzZWxlY3RvcnMgPSB0aGlzLmdldFNldHRpbmdzKFwic2VsZWN0b3JzXCIpO1xuXG4gICAgICAgIHJldHVybiB7XG4gICAgICAgICAgICBvZmZDYW52YXM6IGVsZW1lbnQucXVlcnlTZWxlY3RvcihzZWxlY3RvcnMub2ZmQ2FudmFzKSxcbiAgICAgICAgICAgIG9mZkNhbnZhc09wZW5CdG46IGVsZW1lbnQucXVlcnlTZWxlY3RvcihzZWxlY3RvcnMub2ZmQ2FudmFzT3BlbkJ0biksXG4gICAgICAgICAgICBvZmZDYW52YXNDbG9zZUVsZW1zOiBlbGVtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoc2VsZWN0b3JzLm9mZkNhbnZhc0Nsb3NlRWxlbXMpLFxuICAgICAgICB9O1xuICAgIH1cblxuICAgIG9uSW5pdCguLi5hcmdzKSB7XG4gICAgICAgIHN1cGVyLm9uSW5pdCguLi5hcmdzKTtcblxuICAgICAgICB0aGlzLm1vdmVNb2RhbFRvRW5kT2ZCb2R5KCk7XG4gICAgICAgIHRoaXMuc2V0dXBFdmVudExpc3RlbmVycygpO1xuICAgIH1cblxuICAgIG1vdmVNb2RhbFRvRW5kT2ZCb2R5KCkge1xuICAgICAgICBkb2N1bWVudC5xdWVyeVNlbGVjdG9yQWxsKGAjemV1cy1vZmYtY2FudmFzLSR7dGhpcy5nZXRJRCgpfWApLmZvckVhY2goKG9mZkNhbnZhcykgPT4ge1xuICAgICAgICAgICAgaWYgKHRoaXMuZWxlbWVudHMub2ZmQ2FudmFzICE9PSBvZmZDYW52YXMpIHtcbiAgICAgICAgICAgICAgICBvZmZDYW52YXMucmVtb3ZlKCk7XG4gICAgICAgICAgICB9XG4gICAgICAgIH0pO1xuXG4gICAgICAgIGRvY3VtZW50LmJvZHkuaW5zZXJ0QWRqYWNlbnRFbGVtZW50KFwiYmVmb3JlZW5kXCIsIHRoaXMuZWxlbWVudHMub2ZmQ2FudmFzKTtcbiAgICB9XG5cbiAgICBzZXR1cEV2ZW50TGlzdGVuZXJzKCkge1xuICAgICAgICB0aGlzLmVsZW1lbnRzLm9mZkNhbnZhc09wZW5CdG4/LmFkZEV2ZW50TGlzdGVuZXIoXCJjbGlja1wiLCB0aGlzLm9wZW5DYW52YXMuYmluZCh0aGlzKSk7XG5cbiAgICAgICAgdGhpcy5lbGVtZW50cy5vZmZDYW52YXNDbG9zZUVsZW1zPy5mb3JFYWNoKChvZmZDYW52YXNDbG9zZUVsZW0pID0+IHtcbiAgICAgICAgICAgIG9mZkNhbnZhc0Nsb3NlRWxlbS5hZGRFdmVudExpc3RlbmVyKFwiY2xpY2tcIiwgdGhpcy5jbG9zZUNhbnZhcy5iaW5kKHRoaXMpKTtcbiAgICAgICAgfSk7XG4gICAgfVxuXG4gICAgb3BlbkNhbnZhcyhldmVudCkge1xuICAgICAgICBldmVudC5wcmV2ZW50RGVmYXVsdCgpO1xuXG4gICAgICAgIGNvbnN0IHRhcmdldElEID0gdGhpcy5lbGVtZW50cy5vZmZDYW52YXNPcGVuQnRuLmdldEF0dHJpYnV0ZShcImhyZWZcIik7XG4gICAgICAgIGNvbnN0IG9mZkNhbnZhcyA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IodGFyZ2V0SUQpO1xuXG4gICAgICAgIG9mZkNhbnZhcy5jbGFzc0xpc3QudG9nZ2xlKFwic2hvd1wiKTtcbiAgICB9XG5cbiAgICBjbG9zZUNhbnZhcyhldmVudCkge1xuICAgICAgICBjb25zdCBvZmZDYW52YXNDbG9zZUVsZW0gPSBldmVudC5jdXJyZW50VGFyZ2V0O1xuXG4gICAgICAgIG9mZkNhbnZhc0Nsb3NlRWxlbS5jbG9zZXN0KFwiLnpldXMtb2ZmLWNhbnZhcy13cmFwXCIpLmNsYXNzTGlzdC5yZW1vdmUoXCJzaG93XCIpO1xuICAgIH1cbn1cblxucmVnaXN0ZXJXaWRnZXQoWmV1c19PZmZDYW52YXMsIFwiemV1cy1vZmYtY2FudmFzXCIpO1xuIl19
