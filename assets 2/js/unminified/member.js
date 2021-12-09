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

var Zeus_Member = /*#__PURE__*/function (_elementorModules$fro) {
  _inherits(Zeus_Member, _elementorModules$fro);

  var _super = _createSuper(Zeus_Member);

  function Zeus_Member() {
    _classCallCheck(this, Zeus_Member);

    return _super.apply(this, arguments);
  }

  _createClass(Zeus_Member, [{
    key: "getDefaultSettings",
    value: function getDefaultSettings() {
      return {
        selectors: {
          member: ".zeus-member-wrap",
          memberSocialIcon: ".zeus-member-icon"
        },
        tooltipPosition: "top"
      };
    }
  }, {
    key: "getDefaultElements",
    value: function getDefaultElements() {
      var element = this.$element.get(0);
      var selectors = this.getSettings("selectors");
      return {
        member: element.querySelector(selectors.member),
        memberSocialIcons: element.querySelectorAll(selectors.memberSocialIcon)
      };
    }
  }, {
    key: "onInit",
    value: function onInit() {
      var _get2;

      for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
        args[_key] = arguments[_key];
      }

      (_get2 = _get(_getPrototypeOf(Zeus_Member.prototype), "onInit", this)).call.apply(_get2, [this].concat(args));

      this.setUserSettings();

      if (this.isEnableTooltip()) {
        this.initTippyTooltip();
      }
    }
  }, {
    key: "initTippyTooltip",
    value: function initTippyTooltip() {
      var placement = this.getSettings("tooltipPosition");
      tippy(this.elements.memberSocialIcons, {
        allowHTML: true,
        duration: [300, 200],
        content: function content(reference) {
          return reference.getAttribute("title");
        },
        placement: placement
      });
    }
  }, {
    key: "setUserSettings",
    value: function setUserSettings() {
      var _this$elements$member;

      var settings = this.getSettings();
      var tooltipPosition = (_this$elements$member = this.elements.memberSocialIcons[0].dataset) === null || _this$elements$member === void 0 ? void 0 : _this$elements$member.tooltipPosition;
      this.setSettings({
        tooltipPosition: !!tooltipPosition ? tooltipPosition : settings.tooltipPosition
      });
    }
  }, {
    key: "isEnableTooltip",
    value: function isEnableTooltip() {
      return Array.from(this.elements.memberSocialIcons).some(function (_ref) {
        var classList = _ref.classList;
        return classList.contains("zeus-member-tooltip");
      });
    }
  }]);

  return Zeus_Member;
}(elementorModules.frontend.handlers.Base);

(0, _utils.registerWidget)(Zeus_Member, "zeus-member");

},{"../lib/utils":1}]},{},[2])
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm5vZGVfbW9kdWxlcy9icm93c2VyLXBhY2svX3ByZWx1ZGUuanMiLCJzcmMvbGliL3V0aWxzLmpzIiwic3JjL3dpZGdldHMvbWVtYmVyLmpzIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUFBOzs7Ozs7OztBQ0FPLElBQU0sY0FBYyxHQUFHLFNBQWpCLGNBQWlCLENBQUMsU0FBRCxFQUFZLFVBQVosRUFBNkM7QUFBQSxNQUFyQixJQUFxQix1RUFBZCxTQUFjOztBQUN2RSxNQUFJLEVBQUUsU0FBUyxJQUFJLFVBQWYsQ0FBSixFQUFnQztBQUM1QjtBQUNIO0FBRUQ7QUFDSjtBQUNBO0FBQ0E7OztBQUNJLEVBQUEsTUFBTSxDQUFDLE1BQUQsQ0FBTixDQUFlLEVBQWYsQ0FBa0IseUJBQWxCLEVBQTZDLFlBQU07QUFDL0MsUUFBTSxVQUFVLEdBQUcsU0FBYixVQUFhLENBQUMsUUFBRCxFQUFjO0FBQzdCLE1BQUEsaUJBQWlCLENBQUMsZUFBbEIsQ0FBa0MsVUFBbEMsQ0FBNkMsU0FBN0MsRUFBd0Q7QUFDcEQsUUFBQSxRQUFRLEVBQVI7QUFEb0QsT0FBeEQ7QUFHSCxLQUpEOztBQU1BLElBQUEsaUJBQWlCLENBQUMsS0FBbEIsQ0FBd0IsU0FBeEIsa0NBQTRELFVBQTVELGNBQTBFLElBQTFFLEdBQWtGLFVBQWxGO0FBQ0gsR0FSRDtBQVNILENBbEJNOzs7Ozs7Ozs7QUNBUDs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7SUFFTSxXOzs7Ozs7Ozs7Ozs7O1dBQ0YsOEJBQXFCO0FBQ2pCLGFBQU87QUFDSCxRQUFBLFNBQVMsRUFBRTtBQUNQLFVBQUEsTUFBTSxFQUFFLG1CQUREO0FBRVAsVUFBQSxnQkFBZ0IsRUFBRTtBQUZYLFNBRFI7QUFLSCxRQUFBLGVBQWUsRUFBRTtBQUxkLE9BQVA7QUFPSDs7O1dBRUQsOEJBQXFCO0FBQ2pCLFVBQU0sT0FBTyxHQUFHLEtBQUssUUFBTCxDQUFjLEdBQWQsQ0FBa0IsQ0FBbEIsQ0FBaEI7QUFDQSxVQUFNLFNBQVMsR0FBRyxLQUFLLFdBQUwsQ0FBaUIsV0FBakIsQ0FBbEI7QUFFQSxhQUFPO0FBQ0gsUUFBQSxNQUFNLEVBQUUsT0FBTyxDQUFDLGFBQVIsQ0FBc0IsU0FBUyxDQUFDLE1BQWhDLENBREw7QUFFSCxRQUFBLGlCQUFpQixFQUFFLE9BQU8sQ0FBQyxnQkFBUixDQUF5QixTQUFTLENBQUMsZ0JBQW5DO0FBRmhCLE9BQVA7QUFJSDs7O1dBRUQsa0JBQWdCO0FBQUE7O0FBQUEsd0NBQU4sSUFBTTtBQUFOLFFBQUEsSUFBTTtBQUFBOztBQUNaLDZHQUFnQixJQUFoQjs7QUFFQSxXQUFLLGVBQUw7O0FBRUEsVUFBSSxLQUFLLGVBQUwsRUFBSixFQUE0QjtBQUN4QixhQUFLLGdCQUFMO0FBQ0g7QUFDSjs7O1dBRUQsNEJBQW1CO0FBQ2YsVUFBTSxTQUFTLEdBQUcsS0FBSyxXQUFMLENBQWlCLGlCQUFqQixDQUFsQjtBQUVBLE1BQUEsS0FBSyxDQUFDLEtBQUssUUFBTCxDQUFjLGlCQUFmLEVBQWtDO0FBQ25DLFFBQUEsU0FBUyxFQUFFLElBRHdCO0FBRW5DLFFBQUEsUUFBUSxFQUFFLENBQUMsR0FBRCxFQUFNLEdBQU4sQ0FGeUI7QUFHbkMsUUFBQSxPQUFPLEVBQUUsaUJBQUMsU0FBRDtBQUFBLGlCQUFlLFNBQVMsQ0FBQyxZQUFWLENBQXVCLE9BQXZCLENBQWY7QUFBQSxTQUgwQjtBQUluQyxRQUFBLFNBQVMsRUFBRTtBQUp3QixPQUFsQyxDQUFMO0FBTUg7OztXQUVELDJCQUFrQjtBQUFBOztBQUNkLFVBQU0sUUFBUSxHQUFHLEtBQUssV0FBTCxFQUFqQjtBQUNBLFVBQU0sZUFBZSw0QkFBRyxLQUFLLFFBQUwsQ0FBYyxpQkFBZCxDQUFnQyxDQUFoQyxFQUFtQyxPQUF0QywwREFBRyxzQkFBNEMsZUFBcEU7QUFFQSxXQUFLLFdBQUwsQ0FBaUI7QUFDYixRQUFBLGVBQWUsRUFBRSxDQUFDLENBQUMsZUFBRixHQUFvQixlQUFwQixHQUFzQyxRQUFRLENBQUM7QUFEbkQsT0FBakI7QUFHSDs7O1dBRUQsMkJBQWtCO0FBQ2QsYUFBTyxLQUFLLENBQUMsSUFBTixDQUFXLEtBQUssUUFBTCxDQUFjLGlCQUF6QixFQUE0QyxJQUE1QyxDQUFpRDtBQUFBLFlBQUcsU0FBSCxRQUFHLFNBQUg7QUFBQSxlQUFtQixTQUFTLENBQUMsUUFBVixDQUFtQixxQkFBbkIsQ0FBbkI7QUFBQSxPQUFqRCxDQUFQO0FBQ0g7Ozs7RUFyRHFCLGdCQUFnQixDQUFDLFFBQWpCLENBQTBCLFFBQTFCLENBQW1DLEk7O0FBd0Q3RCwyQkFBZSxXQUFmLEVBQTRCLGFBQTVCIiwiZmlsZSI6ImdlbmVyYXRlZC5qcyIsInNvdXJjZVJvb3QiOiIiLCJzb3VyY2VzQ29udGVudCI6WyIoZnVuY3Rpb24oKXtmdW5jdGlvbiByKGUsbix0KXtmdW5jdGlvbiBvKGksZil7aWYoIW5baV0pe2lmKCFlW2ldKXt2YXIgYz1cImZ1bmN0aW9uXCI9PXR5cGVvZiByZXF1aXJlJiZyZXF1aXJlO2lmKCFmJiZjKXJldHVybiBjKGksITApO2lmKHUpcmV0dXJuIHUoaSwhMCk7dmFyIGE9bmV3IEVycm9yKFwiQ2Fubm90IGZpbmQgbW9kdWxlICdcIitpK1wiJ1wiKTt0aHJvdyBhLmNvZGU9XCJNT0RVTEVfTk9UX0ZPVU5EXCIsYX12YXIgcD1uW2ldPXtleHBvcnRzOnt9fTtlW2ldWzBdLmNhbGwocC5leHBvcnRzLGZ1bmN0aW9uKHIpe3ZhciBuPWVbaV1bMV1bcl07cmV0dXJuIG8obnx8cil9LHAscC5leHBvcnRzLHIsZSxuLHQpfXJldHVybiBuW2ldLmV4cG9ydHN9Zm9yKHZhciB1PVwiZnVuY3Rpb25cIj09dHlwZW9mIHJlcXVpcmUmJnJlcXVpcmUsaT0wO2k8dC5sZW5ndGg7aSsrKW8odFtpXSk7cmV0dXJuIG99cmV0dXJuIHJ9KSgpIiwiZXhwb3J0IGNvbnN0IHJlZ2lzdGVyV2lkZ2V0ID0gKGNsYXNzTmFtZSwgd2lkZ2V0TmFtZSwgc2tpbiA9ICdkZWZhdWx0JykgPT4ge1xuICAgIGlmICghKGNsYXNzTmFtZSB8fCB3aWRnZXROYW1lKSkge1xuICAgICAgICByZXR1cm47XG4gICAgfVxuXG4gICAgLyoqXG4gICAgICogQmVjYXVzZSBFbGVtZW50b3IgcGx1Z2luIHVzZXMgalF1ZXJ5IGN1c3RvbSBldmVudCxcbiAgICAgKiBXZSBhbHNvIGhhdmUgdG8gdXNlIGpRdWVyeSB0byB1c2UgdGhpcyBldmVudFxuICAgICAqL1xuICAgIGpRdWVyeSh3aW5kb3cpLm9uKCdlbGVtZW50b3IvZnJvbnRlbmQvaW5pdCcsICgpID0+IHtcbiAgICAgICAgY29uc3QgYWRkSGFuZGxlciA9ICgkZWxlbWVudCkgPT4ge1xuICAgICAgICAgICAgZWxlbWVudG9yRnJvbnRlbmQuZWxlbWVudHNIYW5kbGVyLmFkZEhhbmRsZXIoY2xhc3NOYW1lLCB7XG4gICAgICAgICAgICAgICAgJGVsZW1lbnQsXG4gICAgICAgICAgICB9KTtcbiAgICAgICAgfTtcblxuICAgICAgICBlbGVtZW50b3JGcm9udGVuZC5ob29rcy5hZGRBY3Rpb24oYGZyb250ZW5kL2VsZW1lbnRfcmVhZHkvJHt3aWRnZXROYW1lfS4ke3NraW59YCwgYWRkSGFuZGxlcik7XG4gICAgfSk7XG59O1xuIiwiaW1wb3J0IHsgcmVnaXN0ZXJXaWRnZXQgfSBmcm9tIFwiLi4vbGliL3V0aWxzXCI7XG5cbmNsYXNzIFpldXNfTWVtYmVyIGV4dGVuZHMgZWxlbWVudG9yTW9kdWxlcy5mcm9udGVuZC5oYW5kbGVycy5CYXNlIHtcbiAgICBnZXREZWZhdWx0U2V0dGluZ3MoKSB7XG4gICAgICAgIHJldHVybiB7XG4gICAgICAgICAgICBzZWxlY3RvcnM6IHtcbiAgICAgICAgICAgICAgICBtZW1iZXI6IFwiLnpldXMtbWVtYmVyLXdyYXBcIixcbiAgICAgICAgICAgICAgICBtZW1iZXJTb2NpYWxJY29uOiBcIi56ZXVzLW1lbWJlci1pY29uXCIsXG4gICAgICAgICAgICB9LFxuICAgICAgICAgICAgdG9vbHRpcFBvc2l0aW9uOiBcInRvcFwiLFxuICAgICAgICB9O1xuICAgIH1cblxuICAgIGdldERlZmF1bHRFbGVtZW50cygpIHtcbiAgICAgICAgY29uc3QgZWxlbWVudCA9IHRoaXMuJGVsZW1lbnQuZ2V0KDApO1xuICAgICAgICBjb25zdCBzZWxlY3RvcnMgPSB0aGlzLmdldFNldHRpbmdzKFwic2VsZWN0b3JzXCIpO1xuXG4gICAgICAgIHJldHVybiB7XG4gICAgICAgICAgICBtZW1iZXI6IGVsZW1lbnQucXVlcnlTZWxlY3RvcihzZWxlY3RvcnMubWVtYmVyKSxcbiAgICAgICAgICAgIG1lbWJlclNvY2lhbEljb25zOiBlbGVtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoc2VsZWN0b3JzLm1lbWJlclNvY2lhbEljb24pLFxuICAgICAgICB9O1xuICAgIH1cblxuICAgIG9uSW5pdCguLi5hcmdzKSB7XG4gICAgICAgIHN1cGVyLm9uSW5pdCguLi5hcmdzKTtcblxuICAgICAgICB0aGlzLnNldFVzZXJTZXR0aW5ncygpO1xuXG4gICAgICAgIGlmICh0aGlzLmlzRW5hYmxlVG9vbHRpcCgpKSB7XG4gICAgICAgICAgICB0aGlzLmluaXRUaXBweVRvb2x0aXAoKTtcbiAgICAgICAgfVxuICAgIH1cblxuICAgIGluaXRUaXBweVRvb2x0aXAoKSB7XG4gICAgICAgIGNvbnN0IHBsYWNlbWVudCA9IHRoaXMuZ2V0U2V0dGluZ3MoXCJ0b29sdGlwUG9zaXRpb25cIik7XG5cbiAgICAgICAgdGlwcHkodGhpcy5lbGVtZW50cy5tZW1iZXJTb2NpYWxJY29ucywge1xuICAgICAgICAgICAgYWxsb3dIVE1MOiB0cnVlLFxuICAgICAgICAgICAgZHVyYXRpb246IFszMDAsIDIwMF0sXG4gICAgICAgICAgICBjb250ZW50OiAocmVmZXJlbmNlKSA9PiByZWZlcmVuY2UuZ2V0QXR0cmlidXRlKFwidGl0bGVcIiksXG4gICAgICAgICAgICBwbGFjZW1lbnQ6IHBsYWNlbWVudCxcbiAgICAgICAgfSk7XG4gICAgfVxuXG4gICAgc2V0VXNlclNldHRpbmdzKCkge1xuICAgICAgICBjb25zdCBzZXR0aW5ncyA9IHRoaXMuZ2V0U2V0dGluZ3MoKTtcbiAgICAgICAgY29uc3QgdG9vbHRpcFBvc2l0aW9uID0gdGhpcy5lbGVtZW50cy5tZW1iZXJTb2NpYWxJY29uc1swXS5kYXRhc2V0Py50b29sdGlwUG9zaXRpb247XG5cbiAgICAgICAgdGhpcy5zZXRTZXR0aW5ncyh7XG4gICAgICAgICAgICB0b29sdGlwUG9zaXRpb246ICEhdG9vbHRpcFBvc2l0aW9uID8gdG9vbHRpcFBvc2l0aW9uIDogc2V0dGluZ3MudG9vbHRpcFBvc2l0aW9uLFxuICAgICAgICB9KTtcbiAgICB9XG5cbiAgICBpc0VuYWJsZVRvb2x0aXAoKSB7XG4gICAgICAgIHJldHVybiBBcnJheS5mcm9tKHRoaXMuZWxlbWVudHMubWVtYmVyU29jaWFsSWNvbnMpLnNvbWUoKHsgY2xhc3NMaXN0IH0pID0+IGNsYXNzTGlzdC5jb250YWlucyhcInpldXMtbWVtYmVyLXRvb2x0aXBcIikpO1xuICAgIH1cbn1cblxucmVnaXN0ZXJXaWRnZXQoWmV1c19NZW1iZXIsIFwiemV1cy1tZW1iZXJcIik7XG4iXX0=
