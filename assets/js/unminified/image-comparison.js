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

var Zeus_ImageComparison = /*#__PURE__*/function (_elementorModules$fro) {
  _inherits(Zeus_ImageComparison, _elementorModules$fro);

  var _super = _createSuper(Zeus_ImageComparison);

  function Zeus_ImageComparison() {
    _classCallCheck(this, Zeus_ImageComparison);

    return _super.apply(this, arguments);
  }

  _createClass(Zeus_ImageComparison, [{
    key: "getDefaultSettings",
    value: function getDefaultSettings() {
      return {
        selectors: {
          imageComparison: ".zeus-image-comparison"
        },
        visibleRatio: 0.5,
        orientation: "horizontal",
        beforeLabel: "Before",
        afterLabel: "After",
        noOverlay: false,
        sliderOnHover: false,
        sliderWithHandle: true,
        sliderWithClick: false
      };
    }
  }, {
    key: "getDefaultElements",
    value: function getDefaultElements() {
      var element = this.$element.get(0);
      var selectors = this.getSettings("selectors");
      return {
        imageComparison: element.querySelector(selectors.imageComparison),
        $imageComparison: this.$element.find(selectors.imageComparison)
      };
    }
  }, {
    key: "onInit",
    value: function onInit() {
      var _get2;

      for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
        args[_key] = arguments[_key];
      }

      (_get2 = _get(_getPrototypeOf(Zeus_ImageComparison.prototype), "onInit", this)).call.apply(_get2, [this].concat(args));

      this.setUserSettings();
      this.initTwentyTwenty();
    }
  }, {
    key: "initTwentyTwenty",
    value: function initTwentyTwenty() {
      var _this = this;

      var settings = this.getSettings();
      var imgLoad = imagesLoaded(this.elements.imageComparison);
      imgLoad.on("done", function (instance) {
        _this.elements.$imageComparison.twentytwenty({
          default_offset_pct: settings.visibleRatio,
          orientation: settings.orientation,
          before_label: settings.beforeLabel,
          after_label: settings.afterLabel,
          no_overlay: settings.noOverlay,
          move_slider_on_hover: settings.sliderOnHover,
          move_with_handle_only: settings.sliderWithHandle,
          click_to_move: settings.sliderWithClick
        });
      });
    }
  }, {
    key: "setUserSettings",
    value: function setUserSettings() {
      var settings = this.getSettings();
      var datasetSettings = JSON.parse(this.elements.imageComparison.dataset.settings);
      this.setSettings({
        visibleRatio: !!datasetSettings.visible_ratio ? datasetSettings.visible_ratio : settings.visibleRatio,
        orientation: !!datasetSettings.orientation ? datasetSettings.orientation : settings.orientation,
        beforeLabel: !!datasetSettings.before_label ? datasetSettings.before_label : settings.beforeLabel,
        afterLabel: !!datasetSettings.after_label ? datasetSettings.after_label : settings.afterLabel,
        noOverlay: !!datasetSettings.no_overlay ? datasetSettings.no_overlay : settings.noOverlay,
        sliderOnHover: !!datasetSettings.slider_on_hover ? datasetSettings.slider_on_hover : settings.sliderOnHover,
        sliderWithHandle: !!datasetSettings.slider_with_handle ? datasetSettings.slider_with_handle : settings.sliderWithHandle,
        sliderWithClick: !!datasetSettings.slider_with_click ? datasetSettings.slider_with_click : settings.sliderWithClick
      });
    }
  }]);

  return Zeus_ImageComparison;
}(elementorModules.frontend.handlers.Base);

(0, _utils.registerWidget)(Zeus_ImageComparison, "zeus-image-comparison");

},{"../lib/utils":1}]},{},[2])
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm5vZGVfbW9kdWxlcy9icm93c2VyLXBhY2svX3ByZWx1ZGUuanMiLCJzcmMvbGliL3V0aWxzLmpzIiwic3JjL3dpZGdldHMvaW1hZ2UtY29tcGFyaXNvbi5qcyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFBQTs7Ozs7Ozs7QUNBTyxJQUFNLGNBQWMsR0FBRyxTQUFqQixjQUFpQixDQUFDLFNBQUQsRUFBWSxVQUFaLEVBQTZDO0FBQUEsTUFBckIsSUFBcUIsdUVBQWQsU0FBYzs7QUFDdkUsTUFBSSxFQUFFLFNBQVMsSUFBSSxVQUFmLENBQUosRUFBZ0M7QUFDNUI7QUFDSDtBQUVEO0FBQ0o7QUFDQTtBQUNBOzs7QUFDSSxFQUFBLE1BQU0sQ0FBQyxNQUFELENBQU4sQ0FBZSxFQUFmLENBQWtCLHlCQUFsQixFQUE2QyxZQUFNO0FBQy9DLFFBQU0sVUFBVSxHQUFHLFNBQWIsVUFBYSxDQUFDLFFBQUQsRUFBYztBQUM3QixNQUFBLGlCQUFpQixDQUFDLGVBQWxCLENBQWtDLFVBQWxDLENBQTZDLFNBQTdDLEVBQXdEO0FBQ3BELFFBQUEsUUFBUSxFQUFSO0FBRG9ELE9BQXhEO0FBR0gsS0FKRDs7QUFNQSxJQUFBLGlCQUFpQixDQUFDLEtBQWxCLENBQXdCLFNBQXhCLGtDQUE0RCxVQUE1RCxjQUEwRSxJQUExRSxHQUFrRixVQUFsRjtBQUNILEdBUkQ7QUFTSCxDQWxCTTs7Ozs7Ozs7O0FDQVA7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7O0lBRU0sb0I7Ozs7Ozs7Ozs7Ozs7V0FDRiw4QkFBcUI7QUFDakIsYUFBTztBQUNILFFBQUEsU0FBUyxFQUFFO0FBQ1AsVUFBQSxlQUFlLEVBQUU7QUFEVixTQURSO0FBSUgsUUFBQSxZQUFZLEVBQUUsR0FKWDtBQUtILFFBQUEsV0FBVyxFQUFFLFlBTFY7QUFNSCxRQUFBLFdBQVcsRUFBRSxRQU5WO0FBT0gsUUFBQSxVQUFVLEVBQUUsT0FQVDtBQVFILFFBQUEsU0FBUyxFQUFFLEtBUlI7QUFTSCxRQUFBLGFBQWEsRUFB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QUFlLEVBQUUsQ0FBQyxDQUFDLGVBQWUsQ0FBQyxpQkFBbEIsR0FDWCxlQUFlLENBQUMsaUJBREwsR0FFWCxRQUFRLENBQUM7QUFaRixPQUFqQjtBQWNIOzs7O0VBdEU4QixnQkFBZ0IsQ0FBQyxRQUFqQixDQUEwQixRQUExQixDQUFtQyxJOztBQXlFdEUsMkJBQWUsb0JBQWYsRUFBcUMsdUJBQXJDIiwiZmlsZSI6ImdlbmVyYXRlZC5qcyIsInNvdXJjZVJvb3QiOiIiLCJzb3VyY2VzQ29udGVudCI6WyIoZnVuY3Rpb24oKXtmdW5jdGlvbiByKGUsbix0KXtmdW5jdGlvbiBvKGksZil7aWYoIW5baV0pe2lmKCFlW2ldKXt2YXIgYz1cImZ1bmN0aW9uXCI9PXR5cGVvZiByZXF1aXJlJiZyZXF1aXJlO2lmKCFmJiZjKXJldHVybiBjKGksITApO2lmKHUpcmV0dXJuIHUoaSwhMCk7dmFyIGE9bmV3IEVycm9yKFwiQ2Fubm90IGZpbmQgbW9kdWxlICdcIitpK1wiJ1wiKTt0aHJvdyBhLmNvZGU9XCJNT0RVTEVfTk9UX0ZPVU5EXCIsYX12YXIgcD1uW2ldPXtleHBvcnRzOnt9fTtlW2ldWzBdLmNhbGwocC5leHBvcnRzLGZ1bmN0aW9uKHIpe3ZhciBuPWVbaV1bMV1bcl07cmV0dXJuIG8obnx8cil9LHAscC5leHBvcnRzLHIsZSxuLHQpfXJldHVybiBuW2ldLmV4cG9ydHN9Zm9yKHZhciB1PVwiZnVuY3Rpb25cIj09dHlwZW9mIHJlcXVpcmUmJnJlcXVpcmUsaT0wO2k8dC5sZW5ndGg7aSsrKW8odFtpXSk7cmV0dXJuIG99cmV0dXJuIHJ9KSgpIiwiZXhwb3J0IGNvbnN0IHJlZ2lzdGVyV2lkZ2V0ID0gKGNsYXNzTmFtZSwgd2lkZ2V0TmFtZSwgc2tpbiA9ICdkZWZhdWx0JykgPT4ge1xuICAgIGlmICghKGNsYXNzTmFtZSB8fCB3aWRnZXROYW1lKSkge1xuICAgICAgICByZXR1cm47XG4gICAgfVxuXG4gICAgLyoqXG4gICAgICogQmVjYXVzZSBFbGVtZW50b3IgcGx1Z2luIHVzZXMgalF1ZXJ5IGN1c3RvbSBldmVudCxcbiAgICAgKiBXZSBhbHNvIGhhdmUgdG8gdXNlIGpRdWVyeSB0byB1c2UgdGhpcyBldmVudFxuICAgICAqL1xuICAgIGpRdWVyeSh3aW5kb3cpLm9uKCdlbGVtZW50b3IvZnJvbnRlbmQvaW5pdCcsICgpID0+IHtcbiAgICAgICAgY29uc3QgYWRkSGFuZGxlciA9ICgkZWxlbWVudCkgPT4ge1xuICAgICAgICAgICAgZWxlbWVudG9yRnJvbnRlbmQuZWxlbWVudHNIYW5kbGVyLmFkZEhhbmRsZXIoY2xhc3NOYW1lLCB7XG4gICAgICAgICAgICAgICAgJGVsZW1lbnQsXG4gICAgICAgICAgICB9KTtcbiAgICAgICAgfTtcblxuICAgICAgICBlbGVtZW50b3JGcm9udGVuZC5ob29rcy5hZGRBY3Rpb24oYGZyb250ZW5kL2VsZW1lbnRfcmVhZHkvJHt3aWRnZXROYW1lfS4ke3NraW59YCwgYWRkSGFuZGxlcik7XG4gICAgfSk7XG59O1xuIiwiaW1wb3J0IHsgcmVnaXN0ZXJXaWRnZXQgfSBmcm9tIFwiLi4vbGliL3V0aWxzXCI7XG5cbmNsYXNzIFpldXNfSW1hZ2VDb21wYXJpc29uIGV4dGVuZHMgZWxlbWVudG9yTW9kdWxlcy5mcm9udGVuZC5oYW5kbGVycy5CYXNlIHtcbiAgICBnZXREZWZhdWx0U2V0dGluZ3MoKSB7XG4gICAgICAgIHJldHVybiB7XG4gICAgICAgICAgICBzZWxlY3RvcnM6IHtcbiAgICAgICAgICAgICAgICBpbWFnZUNvbXBhcmlzb246IFwiLnpldXMtaW1hZ2UtY29tcGFyaXNvblwiLFxuICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIHZpc2libGVSYXRpbzogMC41LFxuICAgICAgICAgICAgb3JpZW50YXRpb246IFwiaG9yaXpvbnRhbFwiLFxuICAgICAgICAgICAgYmVmb3JlTGFiZWw6IFwiQmVmb3JlXCIsXG4gICAgICAgICAgICBhZnRlckxhYmVsOiBcIkFmdGVyXCIsXG4gICAgICAgICAgICBub092ZXJsYXk6IGZhbHNlLFxuICAgICAgICAgICAgc2xpZGVyT25Ib3ZlcjogZmFsc2UsXG4gICAgICAgICAgICBzbGlkZXJXaXRoSGFuZGxlOiB0cnVlLFxuICAgICAgICAgICAgc2xpZGVyV2l0aENsaWNrOiBmYWxzZSxcbiAgICAgICAgfTtcbiAgICB9XG5cbiAgICBnZXREZWZhdWx0RWxlbWVudHMoKSB7XG4gICAgICAgIGNvbnN0IGVsZW1lbnQgPSB0aGlzLiRlbGVtZW50LmdldCgwKTtcbiAgICAgICAgY29uc3Qgc2VsZWN0b3JzID0gdGhpcy5nZXRTZXR0aW5ncyhcInNlbGVjdG9yc1wiKTtcblxuICAgICAgICByZXR1cm4ge1xuICAgICAgICAgICAgaW1hZ2VDb21wYXJpc29uOiBlbGVtZW50LnF1ZXJ5U2VsZWN0b3Ioc2VsZWN0b3JzLmltYWdlQ29tcGFyaXNvbiksXG4gICAgICAgICAgICAkaW1hZ2VDb21wYXJpc29uOiB0aGlzLiRlbGVtZW50LmZpbmQoc2VsZWN0b3JzLmltYWdlQ29tcGFyaXNvbiksXG4gICAgICAgIH07XG4gICAgfVxuXG4gICAgb25Jbml0KC4uLmFyZ3MpIHtcbiAgICAgICAgc3VwZXIub25Jbml0KC4uLmFyZ3MpO1xuXG4gICAgICAgIHRoaXMuc2V0VXNlclNldHRpbmdzKCk7XG4gICAgICAgIHRoaXMuaW5pdFR3ZW50eVR3ZW50eSgpO1xuICAgIH1cblxuICAgIGluaXRUd2VudHlUd2VudHkoKSB7XG4gICAgICAgIGNvbnN0IHNldHRpbmdzID0gdGhpcy5nZXRTZXR0aW5ncygpO1xuICAgICAgICB2YXIgaW1nTG9hZCA9IGltYWdlc0xvYWRlZCh0aGlzLmVsZW1lbnRzLmltYWdlQ29tcGFyaXNvbik7XG5cbiAgICAgICAgaW1nTG9hZC5vbihcImRvbmVcIiwgKGluc3RhbmNlKSA9PiB7XG4gICAgICAgICAgICB0aGlzLmVsZW1lbnRzLiRpbWFnZUNvbXBhcmlzb24udHdlbnR5dHdlbnR5KHtcbiAgICAgICAgICAgICAgICBkZWZhdWx0X29mZnNldF9wY3Q6IHNldHRpbmdzLnZpc2libGVSYXRpbyxcbiAgICAgICAgICAgICAgICBvcmllbnRhdGlvbjogc2V0dGluZ3Mub3JpZW50YXRpb24sXG4gICAgICAgICAgICAgICAgYmVmb3JlX2xhYmVsOiBzZXR0aW5ncy5iZWZvcmVMYWJlbCxcbiAgICAgICAgICAgICAgICBhZnRlcl9sYWJlbDogc2V0dGluZ3MuYWZ0ZXJMYWJlbCxcbiAgICAgICAgICAgICAgICBub19vdmVybGF5OiBzZXR0aW5ncy5ub092ZXJsYXksXG4gICAgICAgICAgICAgICAgbW92ZV9zbGlkZXJfb25faG92ZXI6IHNldHRpbmdzLnNsaWRlck9uSG92ZXIsXG4gICAgICAgICAgICAgICAgbW92ZV93aXRoX2hhbmRsZV9vbmx5OiBzZXR0aW5ncy5zbGlkZXJXaXRoSGFuZGxlLFxuICAgICAgICAgICAgICAgIGNsaWNrX3RvX21vdmU6IHNldHRpbmdzLnNsaWRlcldpdGhDbGljayxcbiAgICAgICAgICAgIH0pO1xuICAgICAgICB9KTtcbiAgICB9XG5cbiAgICBzZXRVc2VyU2V0dGluZ3MoKSB7XG4gICAgICAgIGNvbnN0IHNldHRpbmdzID0gdGhpcy5nZXRTZXR0aW5ncygpO1xuICAgICAgICBjb25zdCBkYXRhc2V0U2V0dGluZ3MgPSBKU09OLnBhcnNlKHRoaXMuZWxlbWVudHMuaW1hZ2VDb21wYXJpc29uLmRhdGFzZXQuc2V0dGluZ3MpO1xuXG4gICAgICAgIHRoaXMuc2V0U2V0dGluZ3Moe1xuICAgICAgICAgICAgdmlzaWJsZVJhdGlvOiAhIWRhdGFzZXRTZXR0aW5ncy52aXNpYmxlX3JhdGlvID8gZGF0YXNldFNldHRpbmdzLnZpc2libGVfcmF0aW8gOiBzZXR0aW5ncy52aXNpYmxlUmF0aW8sXG4gICAgICAgICAgICBvcmllbnRhdGlvbjogISFkYXRhc2V0U2V0dGluZ3Mub3JpZW50YXRpb24gPyBkYXRhc2V0U2V0dGluZ3Mub3JpZW50YXRpb24gOiBzZXR0aW5ncy5vcmllbnRhdGlvbixcbiAgICAgICAgICAgIGJlZm9yZUxhYmVsOiAhIWRhdGFzZXRTZXR0aW5ncy5iZWZvcmVfbGFiZWwgPyBkYXRhc2V0U2V0dGluZ3MuYmVmb3JlX2xhYmVsIDogc2V0dGluZ3MuYmVmb3JlTGFiZWwsXG4gICAgICAgICAgICBhZnRlckxhYmVsOiAhIWRhdGFzZXRTZXR0aW5ncy5hZnRlcl9sYWJlbCA/IGRhdGFzZXRTZXR0aW5ncy5hZnRlcl9sYWJlbCA6IHNldHRpbmdzLmFmdGVyTGFiZWwsXG4gICAgICAgICAgICBub092ZXJsYXk6ICEhZGF0YXNldFNldHRpbmdzLm5vX292ZXJsYXkgPyBkYXRhc2V0U2V0dGluZ3Mubm9fb3ZlcmxheSA6IHNldHRpbmdzLm5vT3ZlcmxheSxcbiAgICAgICAgICAgIHNsaWRlck9uSG92ZXI6ICEhZGF0YXNldFNldHRpbmdzLnNsaWRlcl9vbl9ob3ZlciA/IGRhdGFzZXRTZXR0aW5ncy5zbGlkZXJfb25faG92ZXIgOiBzZXR0aW5ncy5zbGlkZXJPbkhvdmVyLFxuICAgICAgICAgICAgc2xpZGVyV2l0aEhhbmRsZTogISFkYXRhc2V0U2V0dGluZ3Muc2xpZGVyX3dpdGhfaGFuZGxlXG4gICAgICAgICAgICAgICAgPyBkYXRhc2V0U2V0dGluZ3Muc2xpZGVyX3dpdGhfaGFuZGxlXG4gICAgICAgICAgICAgICAgOiBzZXR0aW5ncy5zbGlkZXJXaXRoSGFuZGxlLFxuICAgICAgICAgICAgc2xpZGVyV2l0aENsaWNrOiAhIWRhdGFzZXRTZXR0aW5ncy5zbGlkZXJfd2l0aF9jbGlja1xuICAgICAgICAgICAgICAgID8gZGF0YXNldFNldHRpbmdzLnNsaWRlcl93aXRoX2NsaWNrXG4gICAgICAgICAgICAgICAgOiBzZXR0aW5ncy5zbGlkZXJXaXRoQ2xpY2ssXG4gICAgICAgIH0pO1xuICAgIH1cbn1cblxucmVnaXN0ZXJXaWRnZXQoWmV1c19JbWFnZUNvbXBhcmlzb24sIFwiemV1cy1pbWFnZS1jb21wYXJpc29uXCIpO1xuIl19
