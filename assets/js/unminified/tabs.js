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

var Zeus_Tabs = /*#__PURE__*/function (_elementorModules$fro) {
  _inherits(Zeus_Tabs, _elementorModules$fro);

  var _super = _createSuper(Zeus_Tabs);

  function Zeus_Tabs() {
    _classCallCheck(this, Zeus_Tabs);

    return _super.apply(this, arguments);
  }

  _createClass(Zeus_Tabs, [{
    key: "getDefaultSettings",
    value: function getDefaultSettings() {
      return {
        selectors: {
          tabs: ".zeus-tabs",
          tabTitle: ".zeus-tab-title",
          tabContent: ".zeus-tab-content"
        }
      };
    }
  }, {
    key: "getDefaultElements",
    value: function getDefaultElements() {
      var element = this.$element.get(0);
      var selectors = this.getSettings("selectors");
      return {
        tabs: element.querySelector(selectors.tabs),
        tabTitles: element.querySelectorAll(selectors.tabTitle),
        tabContents: element.querySelectorAll(selectors.tabContent)
      };
    }
  }, {
    key: "onInit",
    value: function onInit() {
      var _get2;

      for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
        args[_key] = arguments[_key];
      }

      (_get2 = _get(_getPrototypeOf(Zeus_Tabs.prototype), "onInit", this)).call.apply(_get2, [this].concat(args));

      this.setUserSettings();
      this.initTabs();
      this.setupEventListeners();
    }
  }, {
    key: "initTabs",
    value: function initTabs() {
      var settings = this.getSettings();
      var activeTab = !!settings.active_item ? settings.active_item : 1;
      this.elements.tabs.querySelector(".zeus-tab-title[data-tab=\"".concat(activeTab, "\"]")).classList.add("zeus-active");
      this.elements.tabs.querySelector("#zeus-tab-content-".concat(activeTab)).classList.add("zeus-active");
    }
  }, {
    key: "setupEventListeners",
    value: function setupEventListeners() {
      var _this = this;

      this.elements.tabTitles.forEach(function (tabTitle) {
        tabTitle.addEventListener("click", _this.openTab.bind(_this));
      });
    }
  }, {
    key: "openTab",
    value: function openTab(event) {
      event.preventDefault();
      var activeTab = event.currentTarget.dataset.tab;
      this.elements.tabTitles.forEach(function (tabTitle) {
        tabTitle.classList.remove("zeus-active");
      });
      this.elements.tabContents.forEach(function (tabContent) {
        tabContent.classList.remove("zeus-active");
      });
      this.elements.tabs.querySelector(".zeus-tab-title[data-tab=\"".concat(activeTab, "\"]")).classList.add("zeus-active");
      this.elements.tabs.querySelector("#zeus-tab-content-".concat(activeTab)).classList.add("zeus-active");
    }
  }, {
    key: "setUserSettings",
    value: function setUserSettings() {
      var elementSettings = this.getElementSettings();
      this.setSettings(elementSettings);
    }
  }]);

  return Zeus_Tabs;
}(elementorModules.frontend.handlers.Base);

(0, _utils.registerWidget)(Zeus_Tabs, "zeus-tabs");

},{"../lib/utils":1}]},{},[2])
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm5vZGVfbW9kdWxlcy9icm93c2VyLXBhY2svX3ByZWx1ZGUuanMiLCJzcmMvbGliL3V0aWxzLmpzIiwic3JjL3dpZGdldHMvdGFicy5qcyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFBQTs7Ozs7Ozs7QUNBTyxJQUFNLGNBQWMsR0FBRyxTQUFqQixjQUFpQixDQUFDLFNBQUQsRUFBWSxVQUFaLEVBQTZDO0FBQUEsTUFBckIsSUFBcUIsdUVBQWQsU0FBYzs7QUFDdkUsTUFBSSxFQUFFLFNBQVMsSUFBSSxVQUFmLENBQUosRUFBZ0M7QUFDNUI7QUFDSDtBQUVEO0FBQ0o7QUFDQTtBQUNBOzs7QUFDSSxFQUFBLE1BQU0sQ0FBQyxNQUFELENBQU4sQ0FBZSxFQUFmLENBQWtCLHlCQUFsQixFQUE2QyxZQUFNO0FBQy9DLFFBQU0sVUFBVSxHQUFHLFNBQWIsVUFBYSxDQUFDLFFBQUQsRUFBYztBQUM3QixNQUFBLGlCQUFpQixDQUFDLGVBQWxCLENBQWtDLFVBQWxDLENBQTZDLFNBQTdDLEVBQXdEO0FBQ3BELFFBQUEsUUFBUSxFQUFSO0FBRG9ELE9BQXhEO0FBR0gsS0FKRDs7QUFNQSxJQUFBLGlCQUFpQixDQUFDLEtBQWxCLENBQXdCLFNBQXhCLGtDQUE0RCxVQUE1RCxjQUEwRSxJQUExRSxHQUFrRixVQUFsRjtBQUNILEdBUkQ7QUFTSCxDQWxCTTs7Ozs7Ozs7O0FDQVA7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7O0lBRU0sUzs7Ozs7Ozs7Ozs7OztXQUNGLDhCQUFxQjtBQUNqQixhQUFPO0FBQ0gsUUFBQSxTQUFTLEVBQUU7QUFDUCxVQUFBLElBQUksRUFBRSxZQURDO0FBRVAsVUFBQSxRQUFRLEVBQUUsaUJBRkg7QUFHUCxVQUFBLFVBQVUsRUFBRTtBQUhMO0FBRFIsT0FBUDtBQU9IOzs7V0FFRCw4QkFBcUI7QUFDakIsVUFBTSxPQUFPLEdBQUcsS0FBSyxRQUFMLENBQWMsR0FBZCxDQUFrQixDQUFsQixDQUFoQjtBQUNBLFVBQU0sU0FBUyxHQUFHLEtBQUssV0FBTCxDQUFpQixXQUFqQixDQUFsQjtBQUVBLGFBQU87QUFDSCxRQUFBLElBQUksRUFBRSxPQUFPLENBQUMsYUFBUixDQUFzQixTQUFTLENBQUMsSUFBaEMsQ0FESDtBQUVILFFBQUEsU0FBUyxFQUFFLE9BQU8sQ0FBQyxnQkFBUixDQUF5QixTQUFTLENBQUMsUUFBbkMsQ0FGUjtBQUdILFFBQUEsV0FBVyxFQUFFLE9BQU8sQ0FBQyxnQkFBUixDQUF5QixTQUFTLENBQUMsVUFBbkM7QUFIVixPQUFQO0FBS0g7OztXQUVELGtCQUFnQjtBQUFBOztBQUFBLHdDQUFOLElBQU07QUFBTixRQUFBLElBQU07QUFBQTs7QUFDWiwyR0FBZ0IsSUFBaEI7O0FBRUEsV0FBSyxlQUFMO0FBQ0EsV0FBSyxRQUFMO0FBQ0EsV0FBSyxtQkFBTDtBQUNIOzs7V0FFRCxvQkFBVztBQUNQLFVBQU0sUUFBUSxHQUFHLEtBQUssV0FBTCxFQUFqQjtBQUNBLFVBQU0sU0FBUyxHQUFHLENBQUMsQ0FBQyxRQUFRLENBQUMsV0FBWCxHQUF5QixRQUFRLENBQUMsV0FBbEMsR0FBZ0QsQ0FBbEU7QUFFQSxXQUFLLFFBQUwsQ0FBYyxJQUFkLENBQW1CLGFBQW5CLHNDQUE4RCxTQUE5RCxVQUE2RSxTQUE3RSxDQUF1RixHQUF2RixDQUEyRixhQUEzRjtBQUNBLFdBQUssUUFBTCxDQUFjLElBQWQsQ0FBbUIsYUFBbkIsNkJBQXNELFNBQXRELEdBQW1FLFNBQW5FLENBQTZFLEdBQTdFLENBQWlGLGFBQWpGO0FBQ0g7OztXQUVELCtCQUFzQjtBQUFBOztBQUNsQixXQUFLLFFBQUwsQ0FBYyxTQUFkLENBQXdCLE9BQXhCLENBQWdDLFVBQUMsUUFBRCxFQUFjO0FBQzFDLFFBQUEsUUFBUSxDQUFDLGdCQUFULENBQTBCLE9BQTFCLEVBQW1DLEtBQUksQ0FBQyxPQUFMLENBQWEsSUFBYixDQUFrQixLQUFsQixDQUFuQztBQUNILE9BRkQ7QUFHSDs7O1dBRUQsaUJBQVEsS0FBUixFQUFlO0FBQ1gsTUFBQSxLQUFLLENBQUMsY0FBTjtBQUVBLFVBQU0sU0FBUyxHQUFHLEtBQUssQ0FBQyxhQUFOLENBQW9CLE9BQXBCLENBQTRCLEdBQTlDO0FBRUEsV0FBSyxRQUFMLENBQWMsU0FBZCxDQUF3QixPQUF4QixDQUFnQyxVQUFDLFFBQUQsRUFBYztBQUMxQyxRQUFBLFFBQVEsQ0FBQyxTQUFULENBQW1CLE1BQW5CLENBQTBCLGFBQTFCO0FBQ0gsT0FGRDtBQUlBLFdBQUssUUFBTCxDQUFjLFdBQWQsQ0FBMEIsT0FBMUIsQ0FBa0MsVUFBQyxVQUFELEVBQWdCO0FBQzlDLFFBQUEsVUFBVSxDQUFDLFNBQVgsQ0FBcUIsTUFBckIsQ0FBNEIsYUFBNUI7QUFDSCxPQUZEO0FBSUEsV0FBSyxRQUFMLENBQWMsSUFBZCxDQUFtQixhQUFuQixzQ0FBOEQsU0FBOUQsVUFBNkUsU0FBN0UsQ0FBdUYsR0FBdkYsQ0FBMkYsYUFBM0Y7QUFDQSxXQUFLLFFBQUwsQ0FBYyxJQUFkLENBQW1CLGFBQW5CLDZCQUFzRCxTQUF0RCxHQUFtRSxTQUFuRSxDQUE2RSxHQUE3RSxDQUFpRixhQUFqRjtBQUNIOzs7V0FFRCwyQkFBa0I7QUFDZCxVQUFNLGVBQWUsR0FBRyxLQUFLLGtCQUFMLEVBQXhCO0FBRUEsV0FBSyxXQUFMLENBQWlCLGVBQWpCO0FBQ0g7Ozs7RUFqRW1CLGdCQUFnQixDQUFDLFFBQWpCLENBQTBCLFFBQTFCLENBQW1DLEk7O0FBb0UzRCwyQkFBZSxTQUFmLEVBQTBCLFdBQTFCIiwiZmlsZSI6ImdlbmVyYXRlZC5qcyIsInNvdXJjZVJvb3QiOiIiLCJzb3VyY2VzQ29udGVudCI6WyIoZnVuY3Rpb24oKXtmdW5jdGlvbiByKGUsbix0KXtmdW5jdGlvbiBvKGksZil7aWYoIW5baV0pe2lmKCFlW2ldKXt2YXIgYz1cImZ1bmN0aW9uXCI9PXR5cGVvZiByZXF1aXJlJiZyZXF1aXJlO2lmKCFmJiZjKXJldHVybiBjKGksITApO2lmKHUpcmV0dXJuIHUoaSwhMCk7dmFyIGE9bmV3IEVycm9yKFwiQ2Fubm90IGZpbmQgbW9kdWxlICdcIitpK1wiJ1wiKTt0aHJvdyBhLmNvZGU9XCJNT0RVTEVfTk9UX0ZPVU5EXCIsYX12YXIgcD1uW2ldPXtleHBvcnRzOnt9fTtlW2ldWzBdLmNhbGwocC5leHBvcnRzLGZ1bmN0aW9uKHIpe3ZhciBuPWVbaV1bMV1bcl07cmV0dXJuIG8obnx8cil9LHAscC5leHBvcnRzLHIsZSxuLHQpfXJldHVybiBuW2ldLmV4cG9ydHN9Zm9yKHZhciB1PVwiZnVuY3Rpb25cIj09dHlwZW9mIHJlcXVpcmUmJnJlcXVpcmUsaT0wO2k8dC5sZW5ndGg7aSsrKW8odFtpXSk7cmV0dXJuIG99cmV0dXJuIHJ9KSgpIiwiZXhwb3J0IGNvbnN0IHJlZ2lzdGVyV2lkZ2V0ID0gKGNsYXNzTmFtZSwgd2lkZ2V0TmFtZSwgc2tpbiA9ICdkZWZhdWx0JykgPT4ge1xuICAgIGlmICghKGNsYXNzTmFtZSB8fCB3aWRnZXROYW1lKSkge1xuICAgICAgICByZXR1cm47XG4gICAgfVxuXG4gICAgLyoqXG4gICAgICogQmVjYXVzZSBFbGVtZW50b3IgcGx1Z2luIHVzZXMgalF1ZXJ5IGN1c3RvbSBldmVudCxcbiAgICAgKiBXZSBhbHNvIGhhdmUgdG8gdXNlIGpRdWVyeSB0byB1c2UgdGhpcyBldmVudFxuICAgICAqL1xuICAgIGpRdWVyeSh3aW5kb3cpLm9uKCdlbGVtZW50b3IvZnJvbnRlbmQvaW5pdCcsICgpID0+IHtcbiAgICAgICAgY29uc3QgYWRkSGFuZGxlciA9ICgkZWxlbWVudCkgPT4ge1xuICAgICAgICAgICAgZWxlbWVudG9yRnJvbnRlbmQuZWxlbWVudHNIYW5kbGVyLmFkZEhhbmRsZXIoY2xhc3NOYW1lLCB7XG4gICAgICAgICAgICAgICAgJGVsZW1lbnQsXG4gICAgICAgICAgICB9KTtcbiAgICAgICAgfTtcblxuICAgICAgICBlbGVtZW50b3JGcm9udGVuZC5ob29rcy5hZGRBY3Rpb24oYGZyb250ZW5kL2VsZW1lbnRfcmVhZHkvJHt3aWRnZXROYW1lfS4ke3NraW59YCwgYWRkSGFuZGxlcik7XG4gICAgfSk7XG59O1xuIiwiaW1wb3J0IHsgcmVnaXN0ZXJXaWRnZXQgfSBmcm9tIFwiLi4vbGliL3V0aWxzXCI7XG5cbmNsYXNzIFpldXNfVGFicyBleHRlbmRzIGVsZW1lbnRvck1vZHVsZXMuZnJvbnRlbmQuaGFuZGxlcnMuQmFzZSB7XG4gICAgZ2V0RGVmYXVsdFNldHRpbmdzKCkge1xuICAgICAgICByZXR1cm4ge1xuICAgICAgICAgICAgc2VsZWN0b3JzOiB7XG4gICAgICAgICAgICAgICAgdGFiczogXCIuemV1cy10YWJzXCIsXG4gICAgICAgICAgICAgICAgdGFiVGl0bGU6IFwiLnpldXMtdGFiLXRpdGxlXCIsXG4gICAgICAgICAgICAgICAgdGFiQ29udGVudDogXCIuemV1cy10YWItY29udGVudFwiLFxuICAgICAgICAgICAgfSxcbiAgICAgICAgfTtcbiAgICB9XG5cbiAgICBnZXREZWZhdWx0RWxlbWVudHMoKSB7XG4gICAgICAgIGNvbnN0IGVsZW1lbnQgPSB0aGlzLiRlbGVtZW50LmdldCgwKTtcbiAgICAgICAgY29uc3Qgc2VsZWN0b3JzID0gdGhpcy5nZXRTZXR0aW5ncyhcInNlbGVjdG9yc1wiKTtcblxuICAgICAgICByZXR1cm4ge1xuICAgICAgICAgICAgdGFiczogZWxlbWVudC5xdWVyeVNlbGVjdG9yKHNlbGVjdG9ycy50YWJzKSxcbiAgICAgICAgICAgIHRhYlRpdGxlczogZWxlbWVudC5xdWVyeVNlbGVjdG9yQWxsKHNlbGVjdG9ycy50YWJUaXRsZSksXG4gICAgICAgICAgICB0YWJDb250ZW50czogZWxlbWVudC5xdWVyeVNlbGVjdG9yQWxsKHNlbGVjdG9ycy50YWJDb250ZW50KSxcbiAgICAgICAgfTtcbiAgICB9XG5cbiAgICBvbkluaXQoLi4uYXJncykge1xuICAgICAgICBzdXBlci5vbkluaXQoLi4uYXJncyk7XG5cbiAgICAgICAgdGhpcy5zZXRVc2VyU2V0dGluZ3MoKTtcbiAgICAgICAgdGhpcy5pbml0VGFicygpO1xuICAgICAgICB0aGlzLnNldHVwRXZlbnRMaXN0ZW5lcnMoKTtcbiAgICB9XG5cbiAgICBpbml0VGFicygpIHtcbiAgICAgICAgY29uc3Qgc2V0dGluZ3MgPSB0aGlzLmdldFNldHRpbmdzKCk7XG4gICAgICAgIGNvbnN0IGFjdGl2ZVRhYiA9ICEhc2V0dGluZ3MuYWN0aXZlX2l0ZW0gPyBzZXR0aW5ncy5hY3RpdmVfaXRlbSA6IDE7XG5cbiAgICAgICAgdGhpcy5lbGVtZW50cy50YWJzLnF1ZXJ5U2VsZWN0b3IoYC56ZXVzLXRhYi10aXRsZVtkYXRhLXRhYj1cIiR7YWN0aXZlVGFifVwiXWApLmNsYXNzTGlzdC5hZGQoXCJ6ZXVzLWFjdGl2ZVwiKTtcbiAgICAgICAgdGhpcy5lbGVtZW50cy50YWJzLnF1ZXJ5U2VsZWN0b3IoYCN6ZXVzLXRhYi1jb250ZW50LSR7YWN0aXZlVGFifWApLmNsYXNzTGlzdC5hZGQoXCJ6ZXVzLWFjdGl2ZVwiKTtcbiAgICB9XG5cbiAgICBzZXR1cEV2ZW50TGlzdGVuZXJzKCkge1xuICAgICAgICB0aGlzLmVsZW1lbnRzLnRhYlRpdGxlcy5mb3JFYWNoKCh0YWJUaXRsZSkgPT4ge1xuICAgICAgICAgICAgdGFiVGl0bGUuYWRkRXZlbnRMaXN0ZW5lcihcImNsaWNrXCIsIHRoaXMub3BlblRhYi5iaW5kKHRoaXMpKTtcbiAgICAgICAgfSk7XG4gICAgfVxuXG4gICAgb3BlblRhYihldmVudCkge1xuICAgICAgICBldmVudC5wcmV2ZW50RGVmYXVsdCgpO1xuXG4gICAgICAgIGNvbnN0IGFjdGl2ZVRhYiA9IGV2ZW50LmN1cnJlbnRUYXJnZXQuZGF0YXNldC50YWI7XG5cbiAgICAgICAgdGhpcy5lbGVtZW50cy50YWJUaXRsZXMuZm9yRWFjaCgodGFiVGl0bGUpID0+IHtcbiAgICAgICAgICAgIHRhYlRpdGxlLmNsYXNzTGlzdC5yZW1vdmUoXCJ6ZXVzLWFjdGl2ZVwiKTtcbiAgICAgICAgfSk7XG5cbiAgICAgICAgdGhpcy5lbGVtZW50cy50YWJDb250ZW50cy5mb3JFYWNoKCh0YWJDb250ZW50KSA9PiB7XG4gICAgICAgICAgICB0YWJDb250ZW50LmNsYXNzTGlzdC5yZW1vdmUoXCJ6ZXVzLWFjdGl2ZVwiKTtcbiAgICAgICAgfSk7XG5cbiAgICAgICAgdGhpcy5lbGVtZW50cy50YWJzLnF1ZXJ5U2VsZWN0b3IoYC56ZXVzLXRhYi10aXRsZVtkYXRhLXRhYj1cIiR7YWN0aXZlVGFifVwiXWApLmNsYXNzTGlzdC5hZGQoXCJ6ZXVzLWFjdGl2ZVwiKTtcbiAgICAgICAgdGhpcy5lbGVtZW50cy50YWJzLnF1ZXJ5U2VsZWN0b3IoYCN6ZXVzLXRhYi1jb250ZW50LSR7YWN0aXZlVGFifWApLmNsYXNzTGlzdC5hZGQoXCJ6ZXVzLWFjdGl2ZVwiKTtcbiAgICB9XG5cbiAgICBzZXRVc2VyU2V0dGluZ3MoKSB7XG4gICAgICAgIGNvbnN0IGVsZW1lbnRTZXR0aW5ncyA9IHRoaXMuZ2V0RWxlbWVudFNldHRpbmdzKCk7XG5cbiAgICAgICAgdGhpcy5zZXRTZXR0aW5ncyhlbGVtZW50U2V0dGluZ3MpO1xuICAgIH1cbn1cblxucmVnaXN0ZXJXaWRnZXQoWmV1c19UYWJzLCBcInpldXMtdGFic1wiKTtcbiJdfQ==
