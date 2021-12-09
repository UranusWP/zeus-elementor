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

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

var Zeus_CountDown = /*#__PURE__*/function (_elementorModules$fro) {
  _inherits(Zeus_CountDown, _elementorModules$fro);

  var _super = _createSuper(Zeus_CountDown);

  function Zeus_CountDown() {
    var _this;

    _classCallCheck(this, Zeus_CountDown);

    for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
      args[_key] = arguments[_key];
    }

    _this = _super.call.apply(_super, [this].concat(args));

    _defineProperty(_assertThisInitialized(_this), "days", void 0);

    _defineProperty(_assertThisInitialized(_this), "hours", void 0);

    _defineProperty(_assertThisInitialized(_this), "minutes", void 0);

    _defineProperty(_assertThisInitialized(_this), "seconds", void 0);

    _defineProperty(_assertThisInitialized(_this), "timeRemaining", void 0);

    _defineProperty(_assertThisInitialized(_this), "countDownIntervalID", void 0);

    return _this;
  }

  _createClass(Zeus_CountDown, [{
    key: "getDefaultSettings",
    value: function getDefaultSettings() {
      return {
        selectors: {
          countDown: ".zeus-countdown-wrap",
          countDownDays: ".zeus-countdown-days",
          countDownHours: ".zeus-countdown-hours",
          countDownMinutes: ".zeus-countdown-minutes",
          countDownSeconds: ".zeus-countdown-seconds"
        },
        date: null
      };
    }
  }, {
    key: "getDefaultElements",
    value: function getDefaultElements() {
      var element = this.$element.get(0);
      var selectors = this.getSettings("selectors");
      return {
        countDown: element.querySelector(selectors.countDown),
        countDownDays: element.querySelector(selectors.countDownDays),
        countDownHours: element.querySelector(selectors.countDownHours),
        countDownMinutes: element.querySelector(selectors.countDownMinutes),
        countDownSeconds: element.querySelector(selectors.countDownSeconds)
      };
    }
  }, {
    key: "onInit",
    value: function onInit() {
      var _get2;

      for (var _len2 = arguments.length, args = new Array(_len2), _key2 = 0; _key2 < _len2; _key2++) {
        args[_key2] = arguments[_key2];
      }

      (_get2 = _get(_getPrototypeOf(Zeus_CountDown.prototype), "onInit", this)).call.apply(_get2, [this].concat(args));

      this.setUserSettings();

      if (this.getSettings("date")) {
        this.initCountdown();
      }
    }
  }, {
    key: "setUserSettings",
    value: function setUserSettings() {
      var dateNumber = Number(this.elements.countDown.getAttribute("data-date"));

      if (dateNumber !== 0) {
        this.setSettings({
          date: new Date(dateNumber * 1000)
        });
      }
    }
  }, {
    key: "initCountdown",
    value: function initCountdown() {
      this.updateDOM();
      var intervalID = setInterval(this.updateDOM.bind(this), 1000);
      this.countDownIntervalID = intervalID;
    }
  }, {
    key: "updateDOM",
    value: function updateDOM() {
      this.getTime();

      if (!!this.elements.countDownDays) {
        this.elements.countDownDays.innerHTML = String(this.days).padStart(2, "0");
      }

      if (!!this.elements.countDownHours) {
        this.elements.countDownHours.innerHTML = String(this.hours).padStart(2, "0");
      }

      if (!!this.elements.countDownMinutes) {
        this.elements.countDownMinutes.innerHTML = String(this.minutes).padStart(2, "0");
      }

      if (!!this.elements.countDownSeconds) {
        this.elements.countDownSeconds.innerHTML = String(this.seconds).padStart(2, "0");
      }

      if (this.timeRemaining <= 0 && this.countDownIntervalID) {
        clearInterval(this.countDownIntervalID);
      }
    }
  }, {
    key: "getTime",
    value: function getTime() {
      this.setTimeRemaining();
      this.setDays();
      this.setHours();
      this.setMinutes();
      this.setSeconds();
    }
  }, {
    key: "setTimeRemaining",
    value: function setTimeRemaining() {
      var now = new Date();
      this.timeRemaining = this.getSettings("date") - now;
    }
  }, {
    key: "setDays",
    value: function setDays() {
      this.days = Number(this.timeRemaining) > 0 ? Math.floor(this.timeRemaining / (1000 * 60 * 60 * 24)) : 0;
    }
  }, {
    key: "setHours",
    value: function setHours() {
      this.hours = Number(this.timeRemaining) > 0 ? Math.floor(this.timeRemaining / (1000 * 60 * 60) % 24) : 0;
    }
  }, {
    key: "setMinutes",
    value: function setMinutes() {
      this.minutes = Number(this.timeRemaining) > 0 ? Math.floor(this.timeRemaining / 1000 / 60 % 60) : 0;
    }
  }, {
    key: "setSeconds",
    value: function setSeconds() {
      this.seconds = Number(this.timeRemaining) > 0 ? Math.floor(this.timeRemaining / 1000 % 60) : 0;
    }
  }]);

  return Zeus_CountDown;
}(elementorModules.frontend.handlers.Base);

(0, _utils.registerWidget)(Zeus_CountDown, "zeus-countdown");

},{"../lib/utils":1}]},{},[2])
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm5vZGVfbW9kdWxlcy9icm93c2VyLXBhY2svX3ByZWx1ZGUuanMiLCJzcmMvbGliL3V0aWxzLmpzIiwic3JjL3dpZGdldHMvY291bnRkb3duLmpzIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUFBOzs7Ozs7OztBQ0FPLElBQU0sY0FBYyxHQUFHLFNBQWpCLGNBQWlCLENBQUMsU0FBRCxFQUFZLFVBQVosRUFBNkM7QUFBQSxNQUFyQixJQUFxQix1RUFBZCxTQUFjOztBQUN2RSxNQUFJLEVBQUUsU0FBUyxJQUFJLFVBQWYsQ0FBSixFQUFnQztBQUM1QjtBQUNIO0FBRUQ7QUFDSjtBQUNBO0FBQ0E7OztBQUNJLEVBQUEsTUFBTSxDQUFDLE1BQUQsQ0FBTixDQUFlLEVBQWYsQ0FBa0IseUJBQWxCLEVBQTZDLFlBQU07QUFDL0MsUUFBTSxVQUFVLEdBQUcsU0FBYixVQUFhLENBQUMsUUFBRCxFQUFjO0FBQzdCLE1BQUEsaUJBQWlCLENBQUMsZUFBbEIsQ0FBa0MsVUFBbEMsQ0FBNkMsU0FBN0MsRUFBd0Q7QUFDcEQsUUFBQSxRQUFRLEVBQVI7QUFEb0QsT0FBeEQ7QUFHSCxLQUpEOztBQU1BLElBQUEsaUJBQWlCLENBQUMsS0FBbEIsQ0FBd0IsU0FBeEIsa0NBQTRELFVBQTVELGNBQTBFLElBQTFFLEdBQWtGLFVBQWxGO0FBQ0gsR0FSRDtBQVNILENBbEJNOzs7Ozs7Ozs7QUNBUDs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7OztJQUVNLGM7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7OztXQVFGLDhCQUFxQjtBQUNqQixhQUFPO0FBQ0gsUUFBQSxTQUFTLEVBQUU7QUFDUCxVQUFBLFNBQVMsRUFBRSxzQkFESjtBQUVQLFVBQUEsYUFBYSxFQUFFLHNCQUZSO0FBR1AsVUFBQSxjQUFjLEVBQUUsdUJBSFQ7QUFJUCxVQUFBLGdCQUFnQixFQUFFLHlCQUpYO0FBS1AsVUFBQSxnQkFBZ0IsRUFBRTtBQUxYLFNBRFI7QUFRSCxRQUFBLElBQUksRUFBRTtB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MUIsQ0FBbUMsSTs7QUFxSGhFLDJCQUFlLGNBQWYsRUFBK0IsZ0JBQS9CIiwiZmlsZSI6ImdlbmVyYXRlZC5qcyIsInNvdXJjZVJvb3QiOiIiLCJzb3VyY2VzQ29udGVudCI6WyIoZnVuY3Rpb24oKXtmdW5jdGlvbiByKGUsbix0KXtmdW5jdGlvbiBvKGksZil7aWYoIW5baV0pe2lmKCFlW2ldKXt2YXIgYz1cImZ1bmN0aW9uXCI9PXR5cGVvZiByZXF1aXJlJiZyZXF1aXJlO2lmKCFmJiZjKXJldHVybiBjKGksITApO2lmKHUpcmV0dXJuIHUoaSwhMCk7dmFyIGE9bmV3IEVycm9yKFwiQ2Fubm90IGZpbmQgbW9kdWxlICdcIitpK1wiJ1wiKTt0aHJvdyBhLmNvZGU9XCJNT0RVTEVfTk9UX0ZPVU5EXCIsYX12YXIgcD1uW2ldPXtleHBvcnRzOnt9fTtlW2ldWzBdLmNhbGwocC5leHBvcnRzLGZ1bmN0aW9uKHIpe3ZhciBuPWVbaV1bMV1bcl07cmV0dXJuIG8obnx8cil9LHAscC5leHBvcnRzLHIsZSxuLHQpfXJldHVybiBuW2ldLmV4cG9ydHN9Zm9yKHZhciB1PVwiZnVuY3Rpb25cIj09dHlwZW9mIHJlcXVpcmUmJnJlcXVpcmUsaT0wO2k8dC5sZW5ndGg7aSsrKW8odFtpXSk7cmV0dXJuIG99cmV0dXJuIHJ9KSgpIiwiZXhwb3J0IGNvbnN0IHJlZ2lzdGVyV2lkZ2V0ID0gKGNsYXNzTmFtZSwgd2lkZ2V0TmFtZSwgc2tpbiA9ICdkZWZhdWx0JykgPT4ge1xuICAgIGlmICghKGNsYXNzTmFtZSB8fCB3aWRnZXROYW1lKSkge1xuICAgICAgICByZXR1cm47XG4gICAgfVxuXG4gICAgLyoqXG4gICAgICogQmVjYXVzZSBFbGVtZW50b3IgcGx1Z2luIHVzZXMgalF1ZXJ5IGN1c3RvbSBldmVudCxcbiAgICAgKiBXZSBhbHNvIGhhdmUgdG8gdXNlIGpRdWVyeSB0byB1c2UgdGhpcyBldmVudFxuICAgICAqL1xuICAgIGpRdWVyeSh3aW5kb3cpLm9uKCdlbGVtZW50b3IvZnJvbnRlbmQvaW5pdCcsICgpID0+IHtcbiAgICAgICAgY29uc3QgYWRkSGFuZGxlciA9ICgkZWxlbWVudCkgPT4ge1xuICAgICAgICAgICAgZWxlbWVudG9yRnJvbnRlbmQuZWxlbWVudHNIYW5kbGVyLmFkZEhhbmRsZXIoY2xhc3NOYW1lLCB7XG4gICAgICAgICAgICAgICAgJGVsZW1lbnQsXG4gICAgICAgICAgICB9KTtcbiAgICAgICAgfTtcblxuICAgICAgICBlbGVtZW50b3JGcm9udGVuZC5ob29rcy5hZGRBY3Rpb24oYGZyb250ZW5kL2VsZW1lbnRfcmVhZHkvJHt3aWRnZXROYW1lfS4ke3NraW59YCwgYWRkSGFuZGxlcik7XG4gICAgfSk7XG59O1xuIiwiaW1wb3J0IHsgcmVnaXN0ZXJXaWRnZXQgfSBmcm9tIFwiLi4vbGliL3V0aWxzXCI7XG5cbmNsYXNzIFpldXNfQ291bnREb3duIGV4dGVuZHMgZWxlbWVudG9yTW9kdWxlcy5mcm9udGVuZC5oYW5kbGVycy5CYXNlIHtcbiAgICBkYXlzO1xuICAgIGhvdXJzO1xuICAgIG1pbnV0ZXM7XG4gICAgc2Vjb25kcztcbiAgICB0aW1lUmVtYWluaW5nO1xuICAgIGNvdW50RG93bkludGVydmFsSUQ7XG5cbiAgICBnZXREZWZhdWx0U2V0dGluZ3MoKSB7XG4gICAgICAgIHJldHVybiB7XG4gICAgICAgICAgICBzZWxlY3RvcnM6IHtcbiAgICAgICAgICAgICAgICBjb3VudERvd246IFwiLnpldXMtY291bnRkb3duLXdyYXBcIixcbiAgICAgICAgICAgICAgICBjb3VudERvd25EYXlzOiBcIi56ZXVzLWNvdW50ZG93bi1kYXlzXCIsXG4gICAgICAgICAgICAgICAgY291bnREb3duSG91cnM6IFwiLnpldXMtY291bnRkb3duLWhvdXJzXCIsXG4gICAgICAgICAgICAgICAgY291bnREb3duTWludXRlczogXCIuemV1cy1jb3VudGRvd24tbWludXRlc1wiLFxuICAgICAgICAgICAgICAgIGNvdW50RG93blNlY29uZHM6IFwiLnpldXMtY291bnRkb3duLXNlY29uZHNcIixcbiAgICAgICAgICAgIH0sXG4gICAgICAgICAgICBkYXRlOiBudWxsLFxuICAgICAgICB9O1xuICAgIH1cblxuICAgIGdldERlZmF1bHRFbGVtZW50cygpIHtcbiAgICAgICAgY29uc3QgZWxlbWVudCA9IHRoaXMuJGVsZW1lbnQuZ2V0KDApO1xuICAgICAgICBjb25zdCBzZWxlY3RvcnMgPSB0aGlzLmdldFNldHRpbmdzKFwic2VsZWN0b3JzXCIpO1xuXG4gICAgICAgIHJldHVybiB7XG4gICAgICAgICAgICBjb3VudERvd246IGVsZW1lbnQucXVlcnlTZWxlY3RvcihzZWxlY3RvcnMuY291bnREb3duKSxcbiAgICAgICAgICAgIGNvdW50RG93bkRheXM6IGVsZW1lbnQucXVlcnlTZWxlY3RvcihzZWxlY3RvcnMuY291bnREb3duRGF5cyksXG4gICAgICAgICAgICBjb3VudERvd25Ib3VyczogZWxlbWVudC5xdWVyeVNlbGVjdG9yKHNlbGVjdG9ycy5jb3VudERvd25Ib3VycyksXG4gICAgICAgICAgICBjb3VudERvd25NaW51dGVzOiBlbGVtZW50LnF1ZXJ5U2VsZWN0b3Ioc2VsZWN0b3JzLmNvdW50RG93bk1pbnV0ZXMpLFxuICAgICAgICAgICAgY291bnREb3duU2Vjb25kczogZWxlbWVudC5xdWVyeVNlbGVjdG9yKHNlbGVjdG9ycy5jb3VudERvd25TZWNvbmRzKSxcbiAgICAgICAgfTtcbiAgICB9XG5cbiAgICBvbkluaXQoLi4uYXJncykge1xuICAgICAgICBzdXBlci5vbkluaXQoLi4uYXJncyk7XG5cbiAgICAgICAgdGhpcy5zZXRVc2VyU2V0dGluZ3MoKTtcblxuICAgICAgICBpZiAodGhpcy5nZXRTZXR0aW5ncyhcImRhdGVcIikpIHtcbiAgICAgICAgICAgIHRoaXMuaW5pdENvdW50ZG93bigpO1xuICAgICAgICB9XG4gICAgfVxuXG4gICAgc2V0VXNlclNldHRpbmdzKCkge1xuICAgICAgICBjb25zdCBkYXRlTnVtYmVyID0gTnVtYmVyKHRoaXMuZWxlbWVudHMuY291bnREb3duLmdldEF0dHJpYnV0ZShcImRhdGEtZGF0ZVwiKSk7XG5cbiAgICAgICAgaWYgKGRhdGVOdW1iZXIgIT09IDApIHtcbiAgICAgICAgICAgIHRoaXMuc2V0U2V0dGluZ3Moe1xuICAgICAgICAgICAgICAgIGRhdGU6IG5ldyBEYXRlKGRhdGVOdW1iZXIgKiAxMDAwKSxcbiAgICAgICAgICAgIH0pO1xuICAgICAgICB9XG4gICAgfVxuXG4gICAgaW5pdENvdW50ZG93bigpIHtcbiAgICAgICAgdGhpcy51cGRhdGVET00oKTtcblxuICAgICAgICBjb25zdCBpbnRlcnZhbElEID0gc2V0SW50ZXJ2YWwodGhpcy51cGRhdGVET00uYmluZCh0aGlzKSwgMTAwMCk7XG5cbiAgICAgICAgdGhpcy5jb3VudERvd25JbnRlcnZhbElEID0gaW50ZXJ2YWxJRDtcbiAgICB9XG5cbiAgICB1cGRhdGVET00oKSB7XG4gICAgICAgIHRoaXMuZ2V0VGltZSgpO1xuXG4gICAgICAgIGlmICghIXRoaXMuZWxlbWVudHMuY291bnREb3duRGF5cykge1xuICAgICAgICAgICAgdGhpcy5lbGVtZW50cy5jb3VudERvd25EYXlzLmlubmVySFRNTCA9IFN0cmluZyh0aGlzLmRheXMpLnBhZFN0YXJ0KDIsIFwiMFwiKTtcbiAgICAgICAgfVxuXG4gICAgICAgIGlmICghIXRoaXMuZWxlbWVudHMuY291bnREb3duSG91cnMpIHtcbiAgICAgICAgICAgIHRoaXMuZWxlbWVudHMuY291bnREb3duSG91cnMuaW5uZXJIVE1MID0gU3RyaW5nKHRoaXMuaG91cnMpLnBhZFN0YXJ0KDIsIFwiMFwiKTtcbiAgICAgICAgfVxuXG4gICAgICAgIGlmICghIXRoaXMuZWxlbWVudHMuY291bnREb3duTWludXRlcykge1xuICAgICAgICAgICAgdGhpcy5lbGVtZW50cy5jb3VudERvd25NaW51dGVzLmlubmVySFRNTCA9IFN0cmluZyh0aGlzLm1pbnV0ZXMpLnBhZFN0YXJ0KDIsIFwiMFwiKTtcbiAgICAgICAgfVxuXG4gICAgICAgIGlmICghIXRoaXMuZWxlbWVudHMuY291bnREb3duU2Vjb25kcykge1xuICAgICAgICAgICAgdGhpcy5lbGVtZW50cy5jb3VudERvd25TZWNvbmRzLmlubmVySFRNTCA9IFN0cmluZyh0aGlzLnNlY29uZHMpLnBhZFN0YXJ0KDIsIFwiMFwiKTtcbiAgICAgICAgfVxuXG4gICAgICAgIGlmICh0aGlzLnRpbWVSZW1haW5pbmcgPD0gMCAmJiB0aGlzLmNvdW50RG93bkludGVydmFsSUQpIHtcbiAgICAgICAgICAgIGNsZWFySW50ZXJ2YWwodGhpcy5jb3VudERvd25JbnRlcnZhbElEKTtcbiAgICAgICAgfVxuICAgIH1cblxuICAgIGdldFRpbWUoKSB7XG4gICAgICAgIHRoaXMuc2V0VGltZVJlbWFpbmluZygpO1xuICAgICAgICB0aGlzLnNldERheXMoKTtcbiAgICAgICAgdGhpcy5zZXRIb3VycygpO1xuICAgICAgICB0aGlzLnNldE1pbnV0ZXMoKTtcbiAgICAgICAgdGhpcy5zZXRTZWNvbmRzKCk7XG4gICAgfVxuXG4gICAgc2V0VGltZVJlbWFpbmluZygpIHtcbiAgICAgICAgY29uc3Qgbm93ID0gbmV3IERhdGUoKTtcblxuICAgICAgICB0aGlzLnRpbWVSZW1haW5pbmcgPSB0aGlzLmdldFNldHRpbmdzKFwiZGF0ZVwiKSAtIG5vdztcbiAgICB9XG5cbiAgICBzZXREYXlzKCkge1xuICAgICAgICB0aGlzLmRheXMgPSBOdW1iZXIodGhpcy50aW1lUmVtYWluaW5nKSA+IDAgPyBNYXRoLmZsb29yKHRoaXMudGltZVJlbWFpbmluZyAvICgxMDAwICogNjAgKiA2MCAqIDI0KSkgOiAwO1xuICAgIH1cblxuICAgIHNldEhvdXJzKCkge1xuICAgICAgICB0aGlzLmhvdXJzID0gTnVtYmVyKHRoaXMudGltZVJlbWFpbmluZykgPiAwID8gTWF0aC5mbG9vcigodGhpcy50aW1lUmVtYWluaW5nIC8gKDEwMDAgKiA2MCAqIDYwKSkgJSAyNCkgOiAwO1xuICAgIH1cblxuICAgIHNldE1pbnV0ZXMoKSB7XG4gICAgICAgIHRoaXMubWludXRlcyA9IE51bWJlcih0aGlzLnRpbWVSZW1haW5pbmcpID4gMCA/IE1hdGguZmxvb3IoKHRoaXMudGltZVJlbWFpbmluZyAvIDEwMDAgLyA2MCkgJSA2MCkgOiAwO1xuICAgIH1cblxuICAgIHNldFNlY29uZHMoKSB7XG4gICAgICAgIHRoaXMuc2Vjb25kcyA9IE51bWJlcih0aGlzLnRpbWVSZW1haW5pbmcpID4gMCA/IE1hdGguZmxvb3IoKHRoaXMudGltZVJlbWFpbmluZyAvIDEwMDApICUgNjApIDogMDtcbiAgICB9XG59XG5cbnJlZ2lzdGVyV2lkZ2V0KFpldXNfQ291bnREb3duLCBcInpldXMtY291bnRkb3duXCIpO1xuIl19
