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

var Zeus_PricingTable = /*#__PURE__*/function (_elementorModules$fro) {
  _inherits(Zeus_PricingTable, _elementorModules$fro);

  var _super = _createSuper(Zeus_PricingTable);

  function Zeus_PricingTable() {
    _classCallCheck(this, Zeus_PricingTable);

    return _super.apply(this, arguments);
  }

  _createClass(Zeus_PricingTable, [{
    key: "getDefaultSettings",
    value: function getDefaultSettings() {
      return {
        selectors: {
          pricingTableTooltip: ".zeus-pricing-table-tooltip"
        }
      };
    }
  }, {
    key: "getDefaultElements",
    value: function getDefaultElements() {
      var element = this.$element.get(0);
      var selectors = this.getSettings("selectors");
      return {
        pricingTableTooltips: element.querySelectorAll(selectors.pricingTableTooltip)
      };
    }
  }, {
    key: "onInit",
    value: function onInit() {
      var _get2;

      for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
        args[_key] = arguments[_key];
      }

      (_get2 = _get(_getPrototypeOf(Zeus_PricingTable.prototype), "onInit", this)).call.apply(_get2, [this].concat(args));

      if (this.hasTooltip()) {
        this.initTippyTooltip();
      }
    }
  }, {
    key: "initTippyTooltip",
    value: function initTippyTooltip() {
      var self = this;
      this.elements.pricingTableTooltips.forEach(function (pricingTableTooltip) {
        tippy(pricingTableTooltip, {
          allowHTML: true,
          duration: [300, 200],
          content: function content(reference) {
            return reference.getAttribute("title");
          },
          placement: self.getTippyTooltipPlacement(pricingTableTooltip.classList),
          onMount: function onMount(instance) {
            instance.popper.classList.add("zeus-hotspot-powertip-".concat(self.getID()));
          }
        });
      });
    }
  }, {
    key: "getTippyTooltipPlacement",
    value: function getTippyTooltipPlacement(classList) {
      switch (true) {
        case classList.contains("zeus-tooltip-n"):
          return "top";
          break;

        case classList.contains("zeus-tooltip-ne-alt"):
          return "top-start";
          break;

        case classList.contains("zeus-tooltip-ne"):
          return "top-end";
          break;

        case classList.contains("zeus-tooltip-e"):
          return "right";
          break;

        case classList.contains("zeus-tooltip-se-alt"):
          return "right-start";
          break;

        case classList.contains("zeus-tooltip-se"):
          return "right-end";
          break;

        case classList.contains("zeus-tooltip-s"):
          return "bottom";
          break;

        case classList.contains("zeus-tooltip-sw-alt"):
          return "bottom-start";
          break;

        case classList.contains("zeus-tooltip-sw"):
          return "bottom-end";
          break;

        case classList.contains("zeus-tooltip-w"):
          return "left";
          break;

        case classList.contains("zeus-tooltip-nw-alt"):
          return "left-start";
          break;

        case classList.contains("zeus-tooltip-nw"):
          return "left-end";
          break;
      }
    }
  }, {
    key: "hasTooltip",
    value: function hasTooltip() {
      return !!this.elements.pricingTableTooltips;
    }
  }]);

  return Zeus_PricingTable;
}(elementorModules.frontend.handlers.Base);

(0, _utils.registerWidget)(Zeus_PricingTable, "zeus-pricing-table");

},{"../lib/utils":1}]},{},[2])
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm5vZGVfbW9kdWxlcy9icm93c2VyLXBhY2svX3ByZWx1ZGUuanMiLCJzcmMvbGliL3V0aWxzLmpzIiwic3JjL3dpZGdldHMvcHJpY2luZy10YWJsZS5qcyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFBQTs7Ozs7Ozs7QUNBTyxJQUFNLGNBQWMsR0FBRyxTQUFqQixjQUFpQixDQUFDLFNBQUQsRUFBWSxVQUFaLEVBQTZDO0FBQUEsTUFBckIsSUFBcUIsdUVBQWQsU0FBYzs7QUFDdkUsTUFBSSxFQUFFLFNBQVMsSUFBSSxVQUFmLENBQUosRUFBZ0M7QUFDNUI7QUFDSDtBQUVEO0FBQ0o7QUFDQTtBQUNBOzs7QUFDSSxFQUFBLE1BQU0sQ0FBQyxNQUFELENBQU4sQ0FBZSxFQUFmLENBQWtCLHlCQUFsQixFQUE2QyxZQUFNO0FBQy9DLFFBQU0sVUFBVSxHQUFHLFNBQWIsVUFBYSxDQUFDLFFBQUQsRUFBYztBQUM3QixNQUFBLGlCQUFpQixDQUFDLGVBQWxCLENBQWtDLFVBQWxDLENBQTZDLFNBQTdDLEVBQXdEO0FBQ3BELFFBQUEsUUFBUSxFQUFSO0FBRG9ELE9BQXhEO0FBR0gsS0FKRDs7QUFNQSxJQUFBLGlCQUFpQixDQUFDLEtBQWxCLENBQXdCLFNBQXhCLGtDQUE0RCxVQUE1RCxjQUEwRSxJQUExRSxHQUFrRixVQUFsRjtBQUNILEdBUkQ7QUFTSCxDQWxCTTs7Ozs7Ozs7O0FDQVA7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7O0lBRU0saUI7Ozs7Ozs7Ozs7Ozs7V0FDRiw4QkFBcUI7QUFDakIsYUFBTztBQUNILFFBQUEsU0FBUyxFQUFFO0FBQ1AsVUFBQSxtQkFBbUIsRUFBRTtBQURkO0FBRFIsT0FBUDtBQUtIOzs7V0FFRCw4QkFBcUI7QUFDakIsVUFBTSxPQUFPLEdBQUcsS0FBSyxRQUFMLENBQWMsR0FBZCxDQUFrQixDQUFsQixDQUFoQjtBQUNBLFVBQU0sU0FBUyxHQUFHLEtBQUssV0FBTCxDQUFpQixXQUFqQixDQUFsQjtBQUVBLGFBQU87QUFDSCxRQUFBLG9CQUFvQixFQUFFLE9BQU8sQ0FBQyxnQkFBUixDQUF5QixTQUFTLENBQUMsbUJBQW5DO0FBRG5CLE9BQVA7QUFHSDs7O1dBRUQsa0JBQWdCO0FBQUE7O0FBQUEsd0NBQU4sSUFBTTtBQUFOLFFBQUEsSUFBTTtBQUFBOztBQUNaLG1IQUFnQixJQUFoQjs7QUFFQSxVQUFJLEtBQUssVUFBTCxFQUFKLEVBQXVCO0FBQ25CLGFBQUssZ0JBQUw7QUFDSDtBQUNKOzs7V0FFRCw0QkFBbUI7QUFDZixVQUFNLElBQUksR0FBRyxJQUFiO0FBRUEsV0FBSyxRQUFMLENBQWMsb0JBQWQsQ0FBbUMsT0FBbkMsQ0FBMkMsVUFBQyxtQkFBRCxFQUF5QjtBQUNoRSxRQUFBLEtBQUssQ0FBQyxtQkFBRCxFQUFzQjtBQUN2QixVQUFBLFNBQVMsRUFBRSxJQURZO0FBRXZCLFVBQUEsUUFBUSxFQUFFLENBQUMsR0FBRCxFQUFNLEdBQU4sQ0FGYTtBQUd2QixVQUFBLE9BQU8sRUFBRSxpQkFBQyxTQUFEO0FBQUEsbUJBQWUsU0FBUyxDQUFDLFlBQVYsQ0FBdUIsT0FBdkIsQ0FBZjtBQUFBLFdBSGM7QUFJdkIsVUFBQSxTQUFTLEVBQUUsSUFBSSxDQUFDLHdCQUFMLENBQThCLG1CQUFtQixDQUFDLFNBQWxELENBSlk7QUFLdkIsVUFBQSxPQUFPLEVBQUUsaUJBQUMsUUFBRCxFQUFjO0FBQ25CLFlBQUEsUUFBUSxDQUFDLE1BQVQsQ0FBZ0IsU0FBaEIsQ0FBMEIsR0FBMUIsaUNBQXVELElBQUksQ0FBQyxLQUFMLEVBQXZEO0FBQ0g7QUFQc0IsU0FBdEIsQ0FBTDtBQVNILE9BVkQ7QUFXSDs7O1dBRUQsa0NBQXlCLFNBQXpCLEVBQW9DO0FBQ2hDLGNBQVEsSUFBUjtBQUNJLGFBQUssU0FBUyxDQUFDLFFBQVYsQ0FBbUIsZ0JBQW5CLENBQUw7QUFDSSxpQkFBTyxLQUFQO0FBQ0E7O0FBQ0osYUFBSyxTQUFTLENBQUMsUUFBVixDQUFtQixxQkFBbkIsQ0FBTDtBQUNJLGlCQUFPLFdBQVA7QUFDQTs7QUFDSixhQUFLLFNBQVMsQ0FBQyxRQUFWLENBQW1CLGlCQUFuQixDQUFMO0FBQ0ksaUJBQU8sU0FBUDtBQUNBOztBQUNKLGFBQUssU0FBUyxDQUFDLFFBQVYsQ0FBbUIsZ0JBQW5CLENBQUw7QUFDSSxpQkFBTyxPQUFQO0FBQ0E7O0FBQ0osYUFBSyxTQUFTLENBQUMsUUFBVixDQUFtQixxQkFBbkIsQ0FBTDtBQUNJLGlCQUFPLGFBQVA7QUFDQTs7QUFDSixhQUFLLFNBQVMsQ0FBQyxRQUFWLENBQW1CLGlCQUFuQixDQUFMO0FBQ0ksaUJBQU8sV0FBUDtBQUNBOztBQUNKLGFBQUssU0FBUyxDQUFDLFFBQVYsQ0FBbUIsZ0JBQW5CLENBQUw7QUFDSSxpQkFBTyxRQUFQO0FBQ0E7O0FBQ0osYUFBSyxTQUFTLENBQUMsUUFBVixDQUFtQixxQkFBbkIsQ0FBTDtBQUNJLGlCQUFPLGNBQVA7QUFDQTs7QUFDSixhQUFLLFNBQVMsQ0FBQyxRQUFWLENBQW1CLGlCQUFuQixDQUFMO0FBQ0ksaUJBQU8sWUFBUDtBQUNBOztBQUNKLGFBQUssU0FBUyxDQUFDLFFBQVYsQ0FBbUIsZ0JBQW5CLENBQUw7QUFDSSxpQkFBTyxNQUFQO0FBQ0E7O0FBQ0osYUFBSyxTQUFTLENBQUMsUUFBVixDQUFtQixxQkFBbkIsQ0FBTDtBQUNJLGlCQUFPLFlBQVA7QUFDQTs7QUFDSixhQUFLLFNBQVMsQ0FBQyxRQUFWLENBQW1CLGlCQUFuQixDQUFMO0FBQ0ksaUJBQU8sVUFBUDtBQUNBO0FBcENSO0FBc0NIOzs7V0FFRCxzQkFBYTtBQUNULGFBQU8sQ0FBQyxDQUFDLEtBQUssUUFBTCxDQUFjLG9CQUF2QjtBQUNIOzs7O0VBckYyQixnQkFBZ0IsQ0FBQyxRQUFqQixDQUEwQixRQUExQixDQUFtQyxJOztBQXdGbkUsMkJBQWUsaUJBQWYsRUFBa0Msb0JBQWxDIiwiZmlsZSI6ImdlbmVyYXRlZC5qcyIsInNvdXJjZVJvb3QiOiIiLCJzb3VyY2VzQ29udGVudCI6WyIoZnVuY3Rpb24oKXtmdW5jdGlvbiByKGUsbix0KXtmdW5jdGlvbiBvKGksZil7aWYoIW5baV0pe2lmKCFlW2ldKXt2YXIgYz1cImZ1bmN0aW9uXCI9PXR5cGVvZiByZXF1aXJlJiZyZXF1aXJlO2lmKCFmJiZjKXJldHVybiBjKGksITApO2lmKHUpcmV0dXJuIHUoaSwhMCk7dmFyIGE9bmV3IEVycm9yKFwiQ2Fubm90IGZpbmQgbW9kdWxlICdcIitpK1wiJ1wiKTt0aHJvdyBhLmNvZGU9XCJNT0RVTEVfTk9UX0ZPVU5EXCIsYX12YXIgcD1uW2ldPXtleHBvcnRzOnt9fTtlW2ldWzBdLmNhbGwocC5leHBvcnRzLGZ1bmN0aW9uKHIpe3ZhciBuPWVbaV1bMV1bcl07cmV0dXJuIG8obnx8cil9LHAscC5leHBvcnRzLHIsZSxuLHQpfXJldHVybiBuW2ldLmV4cG9ydHN9Zm9yKHZhciB1PVwiZnVuY3Rpb25cIj09dHlwZW9mIHJlcXVpcmUmJnJlcXVpcmUsaT0wO2k8dC5sZW5ndGg7aSsrKW8odFtpXSk7cmV0dXJuIG99cmV0dXJuIHJ9KSgpIiwiZXhwb3J0IGNvbnN0IHJlZ2lzdGVyV2lkZ2V0ID0gKGNsYXNzTmFtZSwgd2lkZ2V0TmFtZSwgc2tpbiA9ICdkZWZhdWx0JykgPT4ge1xuICAgIGlmICghKGNsYXNzTmFtZSB8fCB3aWRnZXROYW1lKSkge1xuICAgICAgICByZXR1cm47XG4gICAgfVxuXG4gICAgLyoqXG4gICAgICogQmVjYXVzZSBFbGVtZW50b3IgcGx1Z2luIHVzZXMgalF1ZXJ5IGN1c3RvbSBldmVudCxcbiAgICAgKiBXZSBhbHNvIGhhdmUgdG8gdXNlIGpRdWVyeSB0byB1c2UgdGhpcyBldmVudFxuICAgICAqL1xuICAgIGpRdWVyeSh3aW5kb3cpLm9uKCdlbGVtZW50b3IvZnJvbnRlbmQvaW5pdCcsICgpID0+IHtcbiAgICAgICAgY29uc3QgYWRkSGFuZGxlciA9ICgkZWxlbWVudCkgPT4ge1xuICAgICAgICAgICAgZWxlbWVudG9yRnJvbnRlbmQuZWxlbWVudHNIYW5kbGVyLmFkZEhhbmRsZXIoY2xhc3NOYW1lLCB7XG4gICAgICAgICAgICAgICAgJGVsZW1lbnQsXG4gICAgICAgICAgICB9KTtcbiAgICAgICAgfTtcblxuICAgICAgICBlbGVtZW50b3JGcm9udGVuZC5ob29rcy5hZGRBY3Rpb24oYGZyb250ZW5kL2VsZW1lbnRfcmVhZHkvJHt3aWRnZXROYW1lfS4ke3NraW59YCwgYWRkSGFuZGxlcik7XG4gICAgfSk7XG59O1xuIiwiaW1wb3J0IHsgcmVnaXN0ZXJXaWRnZXQgfSBmcm9tIFwiLi4vbGliL3V0aWxzXCI7XG5cbmNsYXNzIFpldXNfUHJpY2luZ1RhYmxlIGV4dGVuZHMgZWxlbWVudG9yTW9kdWxlcy5mcm9udGVuZC5oYW5kbGVycy5CYXNlIHtcbiAgICBnZXREZWZhdWx0U2V0dGluZ3MoKSB7XG4gICAgICAgIHJldHVybiB7XG4gICAgICAgICAgICBzZWxlY3RvcnM6IHtcbiAgICAgICAgICAgICAgICBwcmljaW5nVGFibGVUb29sdGlwOiBcIi56ZXVzLXByaWNpbmctdGFibGUtdG9vbHRpcFwiLFxuICAgICAgICAgICAgfSxcbiAgICAgICAgfTtcbiAgICB9XG5cbiAgICBnZXREZWZhdWx0RWxlbWVudHMoKSB7XG4gICAgICAgIGNvbnN0IGVsZW1lbnQgPSB0aGlzLiRlbGVtZW50LmdldCgwKTtcbiAgICAgICAgY29uc3Qgc2VsZWN0b3JzID0gdGhpcy5nZXRTZXR0aW5ncyhcInNlbGVjdG9yc1wiKTtcblxuICAgICAgICByZXR1cm4ge1xuICAgICAgICAgICAgcHJpY2luZ1RhYmxlVG9vbHRpcHM6IGVsZW1lbnQucXVlcnlTZWxlY3RvckFsbChzZWxlY3RvcnMucHJpY2luZ1RhYmxlVG9vbHRpcCksXG4gICAgICAgIH07XG4gICAgfVxuXG4gICAgb25Jbml0KC4uLmFyZ3MpIHtcbiAgICAgICAgc3VwZXIub25Jbml0KC4uLmFyZ3MpO1xuXG4gICAgICAgIGlmICh0aGlzLmhhc1Rvb2x0aXAoKSkge1xuICAgICAgICAgICAgdGhpcy5pbml0VGlwcHlUb29sdGlwKCk7XG4gICAgICAgIH1cbiAgICB9XG5cbiAgICBpbml0VGlwcHlUb29sdGlwKCkge1xuICAgICAgICBjb25zdCBzZWxmID0gdGhpcztcblxuICAgICAgICB0aGlzLmVsZW1lbnRzLnByaWNpbmdUYWJsZVRvb2x0aXBzLmZvckVhY2goKHByaWNpbmdUYWJsZVRvb2x0aXApID0+IHtcbiAgICAgICAgICAgIHRpcHB5KHByaWNpbmdUYWJsZVRvb2x0aXAsIHtcbiAgICAgICAgICAgICAgICBhbGxvd0hUTUw6IHRydWUsXG4gICAgICAgICAgICAgICAgZHVyYXRpb246IFszMDAsIDIwMF0sXG4gICAgICAgICAgICAgICAgY29udGVudDogKHJlZmVyZW5jZSkgPT4gcmVmZXJlbmNlLmdldEF0dHJpYnV0ZShcInRpdGxlXCIpLFxuICAgICAgICAgICAgICAgIHBsYWNlbWVudDogc2VsZi5nZXRUaXBweVRvb2x0aXBQbGFjZW1lbnQocHJpY2luZ1RhYmxlVG9vbHRpcC5jbGFzc0xpc3QpLFxuICAgICAgICAgICAgICAgIG9uTW91bnQ6IChpbnN0YW5jZSkgPT4ge1xuICAgICAgICAgICAgICAgICAgICBpbnN0YW5jZS5wb3BwZXIuY2xhc3NMaXN0LmFkZChgemV1cy1ob3RzcG90LXBvd2VydGlwLSR7c2VsZi5nZXRJRCgpfWApO1xuICAgICAgICAgICAgICAgIH0sXG4gICAgICAgICAgICB9KTtcbiAgICAgICAgfSk7XG4gICAgfVxuXG4gICAgZ2V0VGlwcHlUb29sdGlwUGxhY2VtZW50KGNsYXNzTGlzdCkge1xuICAgICAgICBzd2l0Y2ggKHRydWUpIHtcbiAgICAgICAgICAgIGNhc2UgY2xhc3NMaXN0LmNvbnRhaW5zKFwiemV1cy10b29sdGlwLW5cIik6XG4gICAgICAgICAgICAgICAgcmV0dXJuIFwidG9wXCI7XG4gICAgICAgICAgICAgICAgYnJlYWs7XG4gICAgICAgICAgICBjYXNlIGNsYXNzTGlzdC5jb250YWlucyhcInpldXMtdG9vbHRpcC1uZS1hbHRcIik6XG4gICAgICAgICAgICAgICAgcmV0dXJuIFwidG9wLXN0YXJ0XCI7XG4gICAgICAgICAgICAgICAgYnJlYWs7XG4gICAgICAgICAgICBjYXNlIGNsYXNzTGlzdC5jb250YWlucyhcInpldXMtdG9vbHRpcC1uZVwiKTpcbiAgICAgICAgICAgICAgICByZXR1cm4gXCJ0b3AtZW5kXCI7XG4gICAgICAgICAgICAgICAgYnJlYWs7XG4gICAgICAgICAgICBjYXNlIGNsYXNzTGlzdC5jb250YWlucyhcInpldXMtdG9vbHRpcC1lXCIpOlxuICAgICAgICAgICAgICAgIHJldHVybiBcInJpZ2h0XCI7XG4gICAgICAgICAgICAgICAgYnJlYWs7XG4gICAgICAgICAgICBjYXNlIGNsYXNzTGlzdC5jb250YWlucyhcInpldXMtdG9vbHRpcC1zZS1hbHRcIik6XG4gICAgICAgICAgICAgICAgcmV0dXJuIFwicmlnaHQtc3RhcnRcIjtcbiAgICAgICAgICAgICAgICBicmVhaztcbiAgICAgICAgICAgIGNhc2UgY2xhc3NMaXN0LmNvbnRhaW5zKFwiemV1cy10b29sdGlwLXNlXCIpOlxuICAgICAgICAgICAgICAgIHJldHVybiBcInJpZ2h0LWVuZFwiO1xuICAgICAgICAgICAgICAgIGJyZWFrO1xuICAgICAgICAgICAgY2FzZSBjbGFzc0xpc3QuY29udGFpbnMoXCJ6ZXVzLXRvb2x0aXAtc1wiKTpcbiAgICAgICAgICAgICAgICByZXR1cm4gXCJib3R0b21cIjtcbiAgICAgICAgICAgICAgICBicmVhaztcbiAgICAgICAgICAgIGNhc2UgY2xhc3NMaXN0LmNvbnRhaW5zKFwiemV1cy10b29sdGlwLXN3LWFsdFwiKTpcbiAgICAgICAgICAgICAgICByZXR1cm4gXCJib3R0b20tc3RhcnRcIjtcbiAgICAgICAgICAgICAgICBicmVhaztcbiAgICAgICAgICAgIGNhc2UgY2xhc3NMaXN0LmNvbnRhaW5zKFwiemV1cy10b29sdGlwLXN3XCIpOlxuICAgICAgICAgICAgICAgIHJldHVybiBcImJvdHRvbS1lbmRcIjtcbiAgICAgICAgICAgICAgICBicmVhaztcbiAgICAgICAgICAgIGNhc2UgY2xhc3NMaXN0LmNvbnRhaW5zKFwiemV1cy10b29sdGlwLXdcIik6XG4gICAgICAgICAgICAgICAgcmV0dXJuIFwibGVmdFwiO1xuICAgICAgICAgICAgICAgIGJyZWFrO1xuICAgICAgICAgICAgY2FzZSBjbGFzc0xpc3QuY29udGFpbnMoXCJ6ZXVzLXRvb2x0aXAtbnctYWx0XCIpOlxuICAgICAgICAgICAgICAgIHJldHVybiBcImxlZnQtc3RhcnRcIjtcbiAgICAgICAgICAgICAgICBicmVhaztcbiAgICAgICAgICAgIGNhc2UgY2xhc3NMaXN0LmNvbnRhaW5zKFwiemV1cy10b29sdGlwLW53XCIpOlxuICAgICAgICAgICAgICAgIHJldHVybiBcImxlZnQtZW5kXCI7XG4gICAgICAgICAgICAgICAgYnJlYWs7XG4gICAgICAgIH1cbiAgICB9XG5cbiAgICBoYXNUb29sdGlwKCkge1xuICAgICAgICByZXR1cm4gISF0aGlzLmVsZW1lbnRzLnByaWNpbmdUYWJsZVRvb2x0aXBzO1xuICAgIH1cbn1cblxucmVnaXN0ZXJXaWRnZXQoWmV1c19QcmljaW5nVGFibGUsIFwiemV1cy1wcmljaW5nLXRhYmxlXCIpO1xuIl19
