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

var Zeus_Hotspots = /*#__PURE__*/function (_elementorModules$fro) {
  _inherits(Zeus_Hotspots, _elementorModules$fro);

  var _super = _createSuper(Zeus_Hotspots);

  function Zeus_Hotspots() {
    _classCallCheck(this, Zeus_Hotspots);

    return _super.apply(this, arguments);
  }

  _createClass(Zeus_Hotspots, [{
    key: "getDefaultSettings",
    value: function getDefaultSettings() {
      return {
        selectors: {
          hotspots: ".zeus-hotspot-inner"
        },
        toolTip: {
          fadeInDuration: 200,
          fadeOutDuration: 100
        }
      };
    }
  }, {
    key: "getDefaultElements",
    value: function getDefaultElements() {
      var element = this.$element.get(0);
      var selectors = this.getSettings("selectors");
      return {
        hotspots: element.querySelectorAll(selectors.hotspots)
      };
    }
  }, {
    key: "onInit",
    value: function onInit() {
      var _get2;

      for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
        args[_key] = arguments[_key];
      }

      (_get2 = _get(_getPrototypeOf(Zeus_Hotspots.prototype), "onInit", this)).call.apply(_get2, [this].concat(args));

      if (Array.from(this.elements.hotspots).some(function (_ref) {
        var classList = _ref.classList;
        return classList.contains("zeus-hotspot-tooltip");
      })) {
        this.setUserSettings();
        this.initTippyTooltip();
      }
    }
  }, {
    key: "initTippyTooltip",
    value: function initTippyTooltip() {
      var settings = this.getSettings();
      var self = this;
      this.elements.hotspots.forEach(function (hotspot) {
        if (!hotspot.classList.contains("zeus-hotspot-tooltip")) {
          return;
        }

        tippy(hotspot, {
          allowHTML: true,
          duration: [settings.tooltip.fadeInDuration, settings.tooltip.fadeOutDuration],
          content: function content(reference) {
            return reference.getAttribute("title");
          },
          placement: self.getTippyTooltipPlacement(hotspot.classList),
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

        default:
          return "top";
          break;
      }
    }
  }, {
    key: "setUserSettings",
    value: function setUserSettings() {
      var settings = this.getSettings();
      var elementSettings = this.getElementSettings();
      this.setSettings({
        tooltip: {
          fadeInDuration: !!elementSettings.fade_in_time.size ? elementSettings.fade_in_time.size : settings.tooltip.fadeInDuration,
          fadeOutDuration: !!elementSettings.fade_out_time.size ? elementSettings.fade_out_time.size : settings.tooltip.fadeOutDuration
        }
      });
    }
  }]);

  return Zeus_Hotspots;
}(elementorModules.frontend.handlers.Base);

(0, _utils.registerWidget)(Zeus_Hotspots, "zeus-hotspots");

},{"../lib/utils":1}]},{},[2])
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm5vZGVfbW9kdWxlcy9icm93c2VyLXBhY2svX3ByZWx1ZGUuanMiLCJzcmMvbGliL3V0aWxzLmpzIiwic3JjL3dpZGdldHMvaG90c3BvdHMuanMiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBQUE7Ozs7Ozs7O0FDQU8sSUFBTSxjQUFjLEdBQUcsU0FBakIsY0FBaUIsQ0FBQyxTQUFELEVBQVksVUFBWixFQUE2QztBQUFBLE1BQXJCLElBQXFCLHVFQUFkLFNBQWM7O0FBQ3ZFLE1BQUksRUFBRSxTQUFTLElBQUksVUFBZixDQUFKLEVBQWdDO0FBQzVCO0FBQ0g7QUFFRDtBQUNKO0FBQ0E7QUFDQTs7O0FBQ0ksRUFBQSxNQUFNLENBQUMsTUFBRCxDQUFOLENBQWUsRUFBZixDQUFrQix5QkFBbEIsRUFBNkMsWUFBTTtBQUMvQyxRQUFNLFVBQVUsR0FBRyxTQUFiLFVBQWEsQ0FBQyxRQUFELEVBQWM7QUFDN0IsTUFBQSxpQkFBaUIsQ0FBQyxlQUFsQixDQUFrQyxVQUFsQyxDQUE2QyxTQUE3QyxFQUF3RDtBQUNwRCxRQUFBLFFBQVEsRUFBUjtBQURvRCxPQUF4RDtBQUdILEtBSkQ7O0FBTUEsSUFBQSxpQkFBaUIsQ0FBQyxLQUFsQixDQUF3QixTQUF4QixrQ0FBNEQsVUFBNUQsY0FBMEUsSUFBMUUsR0FBa0YsVUFBbEY7QUFDSCxHQVJEO0FBU0gsQ0FsQk07Ozs7Ozs7OztBQ0FQOzs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7OztJQUVNLGE7Ozs7Ozs7Ozs7Ozs7V0FDRiw4QkFBcUI7QUFDakIsYUFBTztBQUNILFFBQUEsU0FBUyxFQUFFO0FBQ1AsVUFBQSxRQUFRLEVBQUU7QUFESCxTQURSO0FBSUgsUUFBQSxPQUFPLEVBQUU7QUFDTCxVQUFBLGNBQWMsRUFBRSxHQURYO0FBRUwsVUFBQSxlQUFlLEVBQUU7QUFGWjtBQUpOLE9BQVA7QUFTSDs7O1dBRUQsOEJBQXFCO0FBQ2pCLFVBQU0sT0FBTyxHQUFHLEtBQUssUUFBTCxDQUFjLEdBQWQsQ0FBa0IsQ0FBbEIs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QUFMO0FBQ0ksaUJBQU8sWUFBUDtBQUNBOztBQUNKLGFBQUssU0FBUyxDQUFDLFFBQVYsQ0FBbUIsaUJBQW5CLENBQUw7QUFDSSxpQkFBTyxVQUFQO0FBQ0E7O0FBRUo7QUFDSSxpQkFBTyxLQUFQO0FBQ0E7QUF4Q1I7QUEwQ0g7OztXQUVELDJCQUFrQjtBQUNkLFVBQU0sUUFBUSxHQUFHLEtBQUssV0FBTCxFQUFqQjtBQUNBLFVBQU0sZUFBZSxHQUFHLEtBQUssa0JBQUwsRUFBeEI7QUFFQSxXQUFLLFdBQUwsQ0FBaUI7QUFDYixRQUFBLE9BQU8sRUFBRTtBQUNMLFVBQUEsY0FBYyxFQUFFLENBQUMsQ0FBQyxlQUFlLENBQUMsWUFBaEIsQ0FBNkIsSUFBL0IsR0FDVixlQUFlLENBQUMsWUFBaEIsQ0FBNkIsSUFEbkIsR0FFVixRQUFRLENBQUMsT0FBVCxDQUFpQixjQUhsQjtBQUtMLFVBQUEsZUFBZSxFQUFFLENBQUMsQ0FBQyxlQUFlLENBQUMsYUFBaEIsQ0FBOEIsSUFBaEMsR0FDWCxlQUFlLENBQUMsYUFBaEIsQ0FBOEIsSUFEbkIsR0FFWCxRQUFRLENBQUMsT0FBVCxDQUFpQjtBQVBsQjtBQURJLE9BQWpCO0FBV0g7Ozs7RUFoSHVCLGdCQUFnQixDQUFDLFFBQWpCLENBQTBCLFFBQTFCLENBQW1DLEk7O0FBbUgvRCwyQkFBZSxhQUFmLEVBQThCLGVBQTlCIiwiZmlsZSI6ImdlbmVyYXRlZC5qcyIsInNvdXJjZVJvb3QiOiIiLCJzb3VyY2VzQ29udGVudCI6WyIoZnVuY3Rpb24oKXtmdW5jdGlvbiByKGUsbix0KXtmdW5jdGlvbiBvKGksZil7aWYoIW5baV0pe2lmKCFlW2ldKXt2YXIgYz1cImZ1bmN0aW9uXCI9PXR5cGVvZiByZXF1aXJlJiZyZXF1aXJlO2lmKCFmJiZjKXJldHVybiBjKGksITApO2lmKHUpcmV0dXJuIHUoaSwhMCk7dmFyIGE9bmV3IEVycm9yKFwiQ2Fubm90IGZpbmQgbW9kdWxlICdcIitpK1wiJ1wiKTt0aHJvdyBhLmNvZGU9XCJNT0RVTEVfTk9UX0ZPVU5EXCIsYX12YXIgcD1uW2ldPXtleHBvcnRzOnt9fTtlW2ldWzBdLmNhbGwocC5leHBvcnRzLGZ1bmN0aW9uKHIpe3ZhciBuPWVbaV1bMV1bcl07cmV0dXJuIG8obnx8cil9LHAscC5leHBvcnRzLHIsZSxuLHQpfXJldHVybiBuW2ldLmV4cG9ydHN9Zm9yKHZhciB1PVwiZnVuY3Rpb25cIj09dHlwZW9mIHJlcXVpcmUmJnJlcXVpcmUsaT0wO2k8dC5sZW5ndGg7aSsrKW8odFtpXSk7cmV0dXJuIG99cmV0dXJuIHJ9KSgpIiwiZXhwb3J0IGNvbnN0IHJlZ2lzdGVyV2lkZ2V0ID0gKGNsYXNzTmFtZSwgd2lkZ2V0TmFtZSwgc2tpbiA9ICdkZWZhdWx0JykgPT4ge1xuICAgIGlmICghKGNsYXNzTmFtZSB8fCB3aWRnZXROYW1lKSkge1xuICAgICAgICByZXR1cm47XG4gICAgfVxuXG4gICAgLyoqXG4gICAgICogQmVjYXVzZSBFbGVtZW50b3IgcGx1Z2luIHVzZXMgalF1ZXJ5IGN1c3RvbSBldmVudCxcbiAgICAgKiBXZSBhbHNvIGhhdmUgdG8gdXNlIGpRdWVyeSB0byB1c2UgdGhpcyBldmVudFxuICAgICAqL1xuICAgIGpRdWVyeSh3aW5kb3cpLm9uKCdlbGVtZW50b3IvZnJvbnRlbmQvaW5pdCcsICgpID0+IHtcbiAgICAgICAgY29uc3QgYWRkSGFuZGxlciA9ICgkZWxlbWVudCkgPT4ge1xuICAgICAgICAgICAgZWxlbWVudG9yRnJvbnRlbmQuZWxlbWVudHNIYW5kbGVyLmFkZEhhbmRsZXIoY2xhc3NOYW1lLCB7XG4gICAgICAgICAgICAgICAgJGVsZW1lbnQsXG4gICAgICAgICAgICB9KTtcbiAgICAgICAgfTtcblxuICAgICAgICBlbGVtZW50b3JGcm9udGVuZC5ob29rcy5hZGRBY3Rpb24oYGZyb250ZW5kL2VsZW1lbnRfcmVhZHkvJHt3aWRnZXROYW1lfS4ke3NraW59YCwgYWRkSGFuZGxlcik7XG4gICAgfSk7XG59O1xuIiwiaW1wb3J0IHsgcmVnaXN0ZXJXaWRnZXQgfSBmcm9tIFwiLi4vbGliL3V0aWxzXCI7XG5cbmNsYXNzIFpldXNfSG90c3BvdHMgZXh0ZW5kcyBlbGVtZW50b3JNb2R1bGVzLmZyb250ZW5kLmhhbmRsZXJzLkJhc2Uge1xuICAgIGdldERlZmF1bHRTZXR0aW5ncygpIHtcbiAgICAgICAgcmV0dXJuIHtcbiAgICAgICAgICAgIHNlbGVjdG9yczoge1xuICAgICAgICAgICAgICAgIGhvdHNwb3RzOiBcIi56ZXVzLWhvdHNwb3QtaW5uZXJcIixcbiAgICAgICAgICAgIH0sXG4gICAgICAgICAgICB0b29sVGlwOiB7XG4gICAgICAgICAgICAgICAgZmFkZUluRHVyYXRpb246IDIwMCxcbiAgICAgICAgICAgICAgICBmYWRlT3V0RHVyYXRpb246IDEwMCxcbiAgICAgICAgICAgIH0sXG4gICAgICAgIH07XG4gICAgfVxuXG4gICAgZ2V0RGVmYXVsdEVsZW1lbnRzKCkge1xuICAgICAgICBjb25zdCBlbGVtZW50ID0gdGhpcy4kZWxlbWVudC5nZXQoMCk7XG4gICAgICAgIGNvbnN0IHNlbGVjdG9ycyA9IHRoaXMuZ2V0U2V0dGluZ3MoXCJzZWxlY3RvcnNcIik7XG5cbiAgICAgICAgcmV0dXJuIHtcbiAgICAgICAgICAgIGhvdHNwb3RzOiBlbGVtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoc2VsZWN0b3JzLmhvdHNwb3RzKSxcbiAgICAgICAgfTtcbiAgICB9XG5cbiAgICBvbkluaXQoLi4uYXJncykge1xuICAgICAgICBzdXBlci5vbkluaXQoLi4uYXJncyk7XG5cbiAgICAgICAgaWYgKEFycmF5LmZyb20odGhpcy5lbGVtZW50cy5ob3RzcG90cykuc29tZSgoeyBjbGFzc0xpc3QgfSkgPT4gY2xhc3NMaXN0LmNvbnRhaW5zKFwiemV1cy1ob3RzcG90LXRvb2x0aXBcIikpKSB7XG4gICAgICAgICAgICB0aGlzLnNldFVzZXJTZXR0aW5ncygpO1xuICAgICAgICAgICAgdGhpcy5pbml0VGlwcHlUb29sdGlwKCk7XG4gICAgICAgIH1cbiAgICB9XG5cbiAgICBpbml0VGlwcHlUb29sdGlwKCkge1xuICAgICAgICBjb25zdCBzZXR0aW5ncyA9IHRoaXMuZ2V0U2V0dGluZ3MoKTtcbiAgICAgICAgY29uc3Qgc2VsZiA9IHRoaXM7XG5cbiAgICAgICAgdGhpcy5lbGVtZW50cy5ob3RzcG90cy5mb3JFYWNoKChob3RzcG90KSA9PiB7XG4gICAgICAgICAgICBpZiAoIWhvdHNwb3QuY2xhc3NMaXN0LmNvbnRhaW5zKFwiemV1cy1ob3RzcG90LXRvb2x0aXBcIikpIHtcbiAgICAgICAgICAgICAgICByZXR1cm47XG4gICAgICAgICAgICB9XG5cbiAgICAgICAgICAgIHRpcHB5KGhvdHNwb3QsIHtcbiAgICAgICAgICAgICAgICBhbGxvd0hUTUw6IHRydWUsXG4gICAgICAgICAgICAgICAgZHVyYXRpb246IFtzZXR0aW5ncy50b29sdGlwLmZhZGVJbkR1cmF0aW9uLCBzZXR0aW5ncy50b29sdGlwLmZhZGVPdXREdXJhdGlvbl0sXG4gICAgICAgICAgICAgICAgY29udGVudDogKHJlZmVyZW5jZSkgPT4gcmVmZXJlbmNlLmdldEF0dHJpYnV0ZShcInRpdGxlXCIpLFxuICAgICAgICAgICAgICAgIHBsYWNlbWVudDogc2VsZi5nZXRUaXBweVRvb2x0aXBQbGFjZW1lbnQoaG90c3BvdC5jbGFzc0xpc3QpLFxuICAgICAgICAgICAgICAgIG9uTW91bnQ6IChpbnN0YW5jZSkgPT4ge1xuICAgICAgICAgICAgICAgICAgICBpbnN0YW5jZS5wb3BwZXIuY2xhc3NMaXN0LmFkZChgemV1cy1ob3RzcG90LXBvd2VydGlwLSR7c2VsZi5nZXRJRCgpfWApO1xuICAgICAgICAgICAgICAgIH0sXG4gICAgICAgICAgICB9KTtcbiAgICAgICAgfSk7XG4gICAgfVxuXG4gICAgZ2V0VGlwcHlUb29sdGlwUGxhY2VtZW50KGNsYXNzTGlzdCkge1xuICAgICAgICBzd2l0Y2ggKHRydWUpIHtcbiAgICAgICAgICAgIGNhc2UgY2xhc3NMaXN0LmNvbnRhaW5zKFwiemV1cy10b29sdGlwLW5cIik6XG4gICAgICAgICAgICAgICAgcmV0dXJuIFwidG9wXCI7XG4gICAgICAgICAgICAgICAgYnJlYWs7XG4gICAgICAgICAgICBjYXNlIGNsYXNzTGlzdC5jb250YWlucyhcInpldXMtdG9vbHRpcC1uZS1hbHRcIik6XG4gICAgICAgICAgICAgICAgcmV0dXJuIFwidG9wLXN0YXJ0XCI7XG4gICAgICAgICAgICAgICAgYnJlYWs7XG4gICAgICAgICAgICBjYXNlIGNsYXNzTGlzdC5jb250YWlucyhcInpldXMtdG9vbHRpcC1uZVwiKTpcbiAgICAgICAgICAgICAgICByZXR1cm4gXCJ0b3AtZW5kXCI7XG4gICAgICAgICAgICAgICAgYnJlYWs7XG4gICAgICAgICAgICBjYXNlIGNsYXNzTGlzdC5jb250YWlucyhcInpldXMtdG9vbHRpcC1lXCIpOlxuICAgICAgICAgICAgICAgIHJldHVybiBcInJpZ2h0XCI7XG4gICAgICAgICAgICAgICAgYnJlYWs7XG4gICAgICAgICAgICBjYXNlIGNsYXNzTGlzdC5jb250YWlucyhcInpldXMtdG9vbHRpcC1zZS1hbHRcIik6XG4gICAgICAgICAgICAgICAgcmV0dXJuIFwicmlnaHQtc3RhcnRcIjtcbiAgICAgICAgICAgICAgICBicmVhaztcbiAgICAgICAgICAgIGNhc2UgY2xhc3NMaXN0LmNvbnRhaW5zKFwiemV1cy10b29sdGlwLXNlXCIpOlxuICAgICAgICAgICAgICAgIHJldHVybiBcInJpZ2h0LWVuZFwiO1xuICAgICAgICAgICAgICAgIGJyZWFrO1xuICAgICAgICAgICAgY2FzZSBjbGFzc0xpc3QuY29udGFpbnMoXCJ6ZXVzLXRvb2x0aXAtc1wiKTpcbiAgICAgICAgICAgICAgICByZXR1cm4gXCJib3R0b21cIjtcbiAgICAgICAgICAgICAgICBicmVhaztcbiAgICAgICAgICAgIGNhc2UgY2xhc3NMaXN0LmNvbnRhaW5zKFwiemV1cy10b29sdGlwLXN3LWFsdFwiKTpcbiAgICAgICAgICAgICAgICByZXR1cm4gXCJib3R0b20tc3RhcnRcIjtcbiAgICAgICAgICAgICAgICBicmVhaztcbiAgICAgICAgICAgIGNhc2UgY2xhc3NMaXN0LmNvbnRhaW5zKFwiemV1cy10b29sdGlwLXN3XCIpOlxuICAgICAgICAgICAgICAgIHJldHVybiBcImJvdHRvbS1lbmRcIjtcbiAgICAgICAgICAgICAgICBicmVhaztcbiAgICAgICAgICAgIGNhc2UgY2xhc3NMaXN0LmNvbnRhaW5zKFwiemV1cy10b29sdGlwLXdcIik6XG4gICAgICAgICAgICAgICAgcmV0dXJuIFwibGVmdFwiO1xuICAgICAgICAgICAgICAgIGJyZWFrO1xuICAgICAgICAgICAgY2FzZSBjbGFzc0xpc3QuY29udGFpbnMoXCJ6ZXVzLXRvb2x0aXAtbnctYWx0XCIpOlxuICAgICAgICAgICAgICAgIHJldHVybiBcImxlZnQtc3RhcnRcIjtcbiAgICAgICAgICAgICAgICBicmVhaztcbiAgICAgICAgICAgIGNhc2UgY2xhc3NMaXN0LmNvbnRhaW5zKFwiemV1cy10b29sdGlwLW53XCIpOlxuICAgICAgICAgICAgICAgIHJldHVybiBcImxlZnQtZW5kXCI7XG4gICAgICAgICAgICAgICAgYnJlYWs7XG5cbiAgICAgICAgICAgIGRlZmF1bHQ6XG4gICAgICAgICAgICAgICAgcmV0dXJuIFwidG9wXCI7XG4gICAgICAgICAgICAgICAgYnJlYWs7XG4gICAgICAgIH1cbiAgICB9XG5cbiAgICBzZXRVc2VyU2V0dGluZ3MoKSB7XG4gICAgICAgIGNvbnN0IHNldHRpbmdzID0gdGhpcy5nZXRTZXR0aW5ncygpO1xuICAgICAgICBjb25zdCBlbGVtZW50U2V0dGluZ3MgPSB0aGlzLmdldEVsZW1lbnRTZXR0aW5ncygpO1xuXG4gICAgICAgIHRoaXMuc2V0U2V0dGluZ3Moe1xuICAgICAgICAgICAgdG9vbHRpcDoge1xuICAgICAgICAgICAgICAgIGZhZGVJbkR1cmF0aW9uOiAhIWVsZW1lbnRTZXR0aW5ncy5mYWRlX2luX3RpbWUuc2l6ZVxuICAgICAgICAgICAgICAgICAgICA/IGVsZW1lbnRTZXR0aW5ncy5mYWRlX2luX3RpbWUuc2l6ZVxuICAgICAgICAgICAgICAgICAgICA6IHNldHRpbmdzLnRvb2x0aXAuZmFkZUluRHVyYXRpb24sXG5cbiAgICAgICAgICAgICAgICBmYWRlT3V0RHVyYXRpb246ICEhZWxlbWVudFNldHRpbmdzLmZhZGVfb3V0X3RpbWUuc2l6ZVxuICAgICAgICAgICAgICAgICAgICA/IGVsZW1lbnRTZXR0aW5ncy5mYWRlX291dF90aW1lLnNpemVcbiAgICAgICAgICAgICAgICAgICAgOiBzZXR0aW5ncy50b29sdGlwLmZhZGVPdXREdXJhdGlvbixcbiAgICAgICAgICAgIH0sXG4gICAgICAgIH0pO1xuICAgIH1cbn1cblxucmVnaXN0ZXJXaWRnZXQoWmV1c19Ib3RzcG90cywgXCJ6ZXVzLWhvdHNwb3RzXCIpO1xuIl19
