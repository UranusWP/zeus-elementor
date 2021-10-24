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

var Zeus_CircleProccess = /*#__PURE__*/function (_elementorModules$fro) {
  _inherits(Zeus_CircleProccess, _elementorModules$fro);

  var _super = _createSuper(Zeus_CircleProccess);

  function Zeus_CircleProccess() {
    var _this;

    _classCallCheck(this, Zeus_CircleProccess);

    for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
      args[_key] = arguments[_key];
    }

    _this = _super.call.apply(_super, [this].concat(args));

    _defineProperty(_assertThisInitialized(_this), "pieProgress", void 0);

    return _this;
  }

  _createClass(Zeus_CircleProccess, [{
    key: "getDefaultSettings",
    value: function getDefaultSettings() {
      return {
        selectors: {
          circleProgress: ".zeus-circle-progress"
        }
      };
    }
  }, {
    key: "getDefaultElements",
    value: function getDefaultElements() {
      var element = this.$element.get(0);
      var selectors = this.getSettings("selectors");
      return {
        circleProgress: element.querySelector(selectors.circleProgress),
        $circleProgress: this.$element.find(selectors.circleProgress)
      };
    }
  }, {
    key: "onInit",
    value: function onInit() {
      var _get2;

      for (var _len2 = arguments.length, args = new Array(_len2), _key2 = 0; _key2 < _len2; _key2++) {
        args[_key2] = arguments[_key2];
      }

      (_get2 = _get(_getPrototypeOf(Zeus_CircleProccess.prototype), "onInit", this)).call.apply(_get2, [this].concat(args));

      this.registerPieProgress();
      this.observer();
    }
  }, {
    key: "registerPieProgress",
    value: function registerPieProgress() {
      this.elements.$circleProgress.asPieProgress({
        namespace: "pieProgress",
        classes: {
          svg: "zeus-circle-progress-svg",
          number: "zeus-circle-progress-number",
          content: "zeus-circle-progress-content"
        }
      });
    }
  }, {
    key: "initPieProgress",
    value: function initPieProgress() {
      this.elements.$circleProgress.asPieProgress("start");
    }
  }, {
    key: "observer",
    value: function observer() {
      var observer = new IntersectionObserver(this.observerCallback.bind(this), {
        threshold: 0.65
      });
      observer.observe(this.elements.circleProgress);
    }
  }, {
    key: "observerCallback",
    value: function observerCallback(entries, observer) {
      var entry = entries[0];

      if (!entry.isIntersecting) {
        return;
      }

      this.initPieProgress();
      observer.unobserve(entry.target);
    }
  }]);

  return Zeus_CircleProccess;
}(elementorModules.frontend.handlers.Base);

(0, _utils.registerWidget)(Zeus_CircleProccess, "zeus-circle-progress");

},{"../lib/utils":1}]},{},[2])
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm5vZGVfbW9kdWxlcy9icm93c2VyLXBhY2svX3ByZWx1ZGUuanMiLCJzcmMvbGliL3V0aWxzLmpzIiwic3JjL3dpZGdldHMvY2lyY2xlLXByb2dyZXNzLmpzIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUFBOzs7Ozs7OztBQ0FPLElBQU0sY0FBYyxHQUFHLFNBQWpCLGNBQWlCLENBQUMsU0FBRCxFQUFZLFVBQVosRUFBNkM7QUFBQSxNQUFyQixJQUFxQix1RUFBZCxTQUFjOztBQUN2RSxNQUFJLEVBQUUsU0FBUyxJQUFJLFVBQWYsQ0FBSixFQUFnQztBQUM1QjtBQUNIO0FBRUQ7QUFDSjtBQUNBO0FBQ0E7OztBQUNJLEVBQUEsTUFBTSxDQUFDLE1BQUQsQ0FBTixDQUFlLEVBQWYsQ0FBa0IseUJBQWxCLEVBQTZDLFlBQU07QUFDL0MsUUFBTSxVQUFVLEdBQUcsU0FBYixVQUFhLENBQUMsUUFBRCxFQUFjO0FBQzdCLE1BQUEsaUJBQWlCLENBQUMsZUFBbEIsQ0FBa0MsVUFBbEMsQ0FBNkMsU0FBN0MsRUFBd0Q7QUFDcEQsUUFBQSxRQUFRLEVBQVI7QUFEb0QsT0FBeEQ7QUFHSCxLQUpEOztBQU1BLElBQUEsaUJBQWlCLENBQUMsS0FBbEIsQ0FBd0IsU0FBeEIsa0NBQTRELFVBQTVELGNBQTBFLElBQTFFLEdBQWtGLFVBQWxGO0FBQ0gsR0FSRDtBQVNILENBbEJNOzs7Ozs7Ozs7QUNBUDs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7OztJQUVNLG1COzs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7OztXQUdGLDhCQUFxQjtBQUNqQixhQUFPO0FBQ0gsUUFBQSxTQUFTLEVBQUU7QUFDUCxVQUFBLGNBQWMsRUFBRTtBQURUO0FBRFIsT0FBUDtBQUtIOzs7V0FFRCw4QkFBcUI7QUFDakIsVUFBTSxPQUFPLEdBQUcsS0FBSyxRQUFMLENBQWMsR0FBZCxDQUFrQixDQUFsQixDQUFoQjtBQUNBLFVBQU0sU0FBUyxHQUFHLEtBQUssV0FBTCxDQUFpQixXQUFqQixDQUFsQjtBQUVBLGFBQU87QUFDSCxRQUFBLGNBQWMsRUFBRSxPQUFPLENBQUMsYUFBUixDQUFzQixTQUFTLENBQUMsY0FBaEMsQ0FEYjtBQUVILFFBQUEsZUFBZSxFQUFFLEtBQUssUUFBTCxDQUFjLElBQWQsQ0FBbUIsU0FBUyxDQUFDLGNBQTdCO0FBRmQsT0FBUDtBQUlIOzs7V0FFRCxrQkFBZ0I7QUFBQTs7QUFBQSx5Q0FBTixJQUFNO0FBQU4sUUFBQSxJQUFNO0FBQUE7O0FBQ1oscUhBQWdCLElBQWhCOztBQUVBLFdBQUssbUJBQUw7QUFDQSxXQUFLLFFBQUw7QUFDSDs7O1dBRUQsK0JBQXNCO0FBQ2xCLFdBQUssUUFBTCxDQUFjLGVBQWQsQ0FBOEIsYUFBOUIsQ0FBNEM7QUFDeEMsUUFBQSxTQUFTLEVBQUUsYUFENkI7QUFFeEMsUUFBQSxPQUFPLEVBQUU7QUFDTCxVQUFBLEdBQUcsRUFBRSwwQkFEQTtBQUVMLFVBQUEsTUFBTSxFQUFFLDZCQUZIO0FBR0wsVUFBQSxPQUFPLEVBQUU7QUFISjtBQUYrQixPQUE1QztBQVFIOzs7V0FFRCwyQkFBa0I7QUFDZCxXQUFLLFFBQUwsQ0FBYyxlQUFkLENBQThCLGFBQTlCLENBQTRDLE9BQTVDO0FBQ0g7OztXQUVELG9CQUFXO0FBQ1AsVUFBTSxRQUFRLEdBQUcsSUFBSSxvQkFBSixDQUF5QixLQUFLLGdCQUFMLENBQXNCLElBQXRCLENBQTJCLElBQTNCLENBQXpCLEVBQTJEO0FBQ3hFLFFBQUEsU0FBUyxFQUFFO0FBRDZELE9BQTNELENBQWpCO0FBSUEsTUFBQSxRQUFRLENBQUMsT0FBVCxDQUFpQixLQUFLLFFBQUwsQ0FBYyxjQUEvQjtBQUNIOzs7V0FFRCwwQkFBaUIsT0FBakIsRUFBMEIsUUFBMUIsRUFBb0M7QUFDaEMsVUFBTSxLQUFLLEdBQUcsT0FBTyxDQUFDLENBQUQsQ0FBckI7O0FBRUEsVUFBSSxDQUFDLEtBQUssQ0FBQyxjQUFYLEVBQTJCO0FBQ3ZCO0FBQ0g7O0FBRUQsV0FBSyxlQUFMO0FBRUEsTUFBQSxRQUFRLENBQUMsU0FBVCxDQUFtQixLQUFLLENBQUMsTUFBekI7QUFDSDs7OztFQTdENkIsZ0JBQWdCLENBQUMsUUFBakIsQ0FBMEIsUUFBMUIsQ0FBbUMsSTs7QUFnRXJFLDJCQUFlLG1CQUFmLEVBQW9DLHNCQUFwQyIsImZpbGUiOiJnZW5lcmF0ZWQuanMiLCJzb3VyY2VSb290IjoiIiwic291cmNlc0NvbnRlbnQiOlsiKGZ1bmN0aW9uKCl7ZnVuY3Rpb24gcihlLG4sdCl7ZnVuY3Rpb24gbyhpLGYpe2lmKCFuW2ldKXtpZighZVtpXSl7dmFyIGM9XCJmdW5jdGlvblwiPT10eXBlb2YgcmVxdWlyZSYmcmVxdWlyZTtpZighZiYmYylyZXR1cm4gYyhpLCEwKTtpZih1KXJldHVybiB1KGksITApO3ZhciBhPW5ldyBFcnJvcihcIkNhbm5vdCBmaW5kIG1vZHVsZSAnXCIraStcIidcIik7dGhyb3cgYS5jb2RlPVwiTU9EVUxFX05PVF9GT1VORFwiLGF9dmFyIHA9bltpXT17ZXhwb3J0czp7fX07ZVtpXVswXS5jYWxsKHAuZXhwb3J0cyxmdW5jdGlvbihyKXt2YXIgbj1lW2ldWzFdW3JdO3JldHVybiBvKG58fHIpfSxwLHAuZXhwb3J0cyxyLGUsbix0KX1yZXR1cm4gbltpXS5leHBvcnRzfWZvcih2YXIgdT1cImZ1bmN0aW9uXCI9PXR5cGVvZiByZXF1aXJlJiZyZXF1aXJlLGk9MDtpPHQubGVuZ3RoO2krKylvKHRbaV0pO3JldHVybiBvfXJldHVybiByfSkoKSIsImV4cG9ydCBjb25zdCByZWdpc3RlcldpZGdldCA9IChjbGFzc05hbWUsIHdpZGdldE5hbWUsIHNraW4gPSAnZGVmYXVsdCcpID0+IHtcbiAgICBpZiAoIShjbGFzc05hbWUgfHwgd2lkZ2V0TmFtZSkpIHtcbiAgICAgICAgcmV0dXJuO1xuICAgIH1cblxuICAgIC8qKlxuICAgICAqIEJlY2F1c2UgRWxlbWVudG9yIHBsdWdpbiB1c2VzIGpRdWVyeSBjdXN0b20gZXZlbnQsXG4gICAgICogV2UgYWxzbyBoYXZlIHRvIHVzZSBqUXVlcnkgdG8gdXNlIHRoaXMgZXZlbnRcbiAgICAgKi9cbiAgICBqUXVlcnkod2luZG93KS5vbignZWxlbWVudG9yL2Zyb250ZW5kL2luaXQnLCAoKSA9PiB7XG4gICAgICAgIGNvbnN0IGFkZEhhbmRsZXIgPSAoJGVsZW1lbnQpID0+IHtcbiAgICAgICAgICAgIGVsZW1lbnRvckZyb250ZW5kLmVsZW1lbnRzSGFuZGxlci5hZGRIYW5kbGVyKGNsYXNzTmFtZSwge1xuICAgICAgICAgICAgICAgICRlbGVtZW50LFxuICAgICAgICAgICAgfSk7XG4gICAgICAgIH07XG5cbiAgICAgICAgZWxlbWVudG9yRnJvbnRlbmQuaG9va3MuYWRkQWN0aW9uKGBmcm9udGVuZC9lbGVtZW50X3JlYWR5LyR7d2lkZ2V0TmFtZX0uJHtza2lufWAsIGFkZEhhbmRsZXIpO1xuICAgIH0pO1xufTtcbiIsImltcG9ydCB7IHJlZ2lzdGVyV2lkZ2V0IH0gZnJvbSBcIi4uL2xpYi91dGlsc1wiO1xuXG5jbGFzcyBaZXVzX0NpcmNsZVByb2NjZXNzIGV4dGVuZHMgZWxlbWVudG9yTW9kdWxlcy5mcm9udGVuZC5oYW5kbGVycy5CYXNlIHtcbiAgICBwaWVQcm9ncmVzcztcblxuICAgIGdldERlZmF1bHRTZXR0aW5ncygpIHtcbiAgICAgICAgcmV0dXJuIHtcbiAgICAgICAgICAgIHNlbGVjdG9yczoge1xuICAgICAgICAgICAgICAgIGNpcmNsZVByb2dyZXNzOiBcIi56ZXVzLWNpcmNsZS1wcm9ncmVzc1wiLFxuICAgICAgICAgICAgfSxcbiAgICAgICAgfTtcbiAgICB9XG5cbiAgICBnZXREZWZhdWx0RWxlbWVudHMoKSB7XG4gICAgICAgIGNvbnN0IGVsZW1lbnQgPSB0aGlzLiRlbGVtZW50LmdldCgwKTtcbiAgICAgICAgY29uc3Qgc2VsZWN0b3JzID0gdGhpcy5nZXRTZXR0aW5ncyhcInNlbGVjdG9yc1wiKTtcblxuICAgICAgICByZXR1cm4ge1xuICAgICAgICAgICAgY2lyY2xlUHJvZ3Jlc3M6IGVsZW1lbnQucXVlcnlTZWxlY3RvcihzZWxlY3RvcnMuY2lyY2xlUHJvZ3Jlc3MpLFxuICAgICAgICAgICAgJGNpcmNsZVByb2dyZXNzOiB0aGlzLiRlbGVtZW50LmZpbmQoc2VsZWN0b3JzLmNpcmNsZVByb2dyZXNzKSxcbiAgICAgICAgfTtcbiAgICB9XG5cbiAgICBvbkluaXQoLi4uYXJncykge1xuICAgICAgICBzdXBlci5vbkluaXQoLi4uYXJncyk7XG5cbiAgICAgICAgdGhpcy5yZWdpc3RlclBpZVByb2dyZXNzKCk7XG4gICAgICAgIHRoaXMub2JzZXJ2ZXIoKTtcbiAgICB9XG5cbiAgICByZWdpc3RlclBpZVByb2dyZXNzKCkge1xuICAgICAgICB0aGlzLmVsZW1lbnRzLiRjaXJjbGVQcm9ncmVzcy5hc1BpZVByb2dyZXNzKHtcbiAgICAgICAgICAgIG5hbWVzcGFjZTogXCJwaWVQcm9ncmVzc1wiLFxuICAgICAgICAgICAgY2xhc3Nlczoge1xuICAgICAgICAgICAgICAgIHN2ZzogXCJ6ZXVzLWNpcmNsZS1wcm9ncmVzcy1zdmdcIixcbiAgICAgICAgICAgICAgICBudW1iZXI6IFwiemV1cy1jaXJjbGUtcHJvZ3Jlc3MtbnVtYmVyXCIsXG4gICAgICAgICAgICAgICAgY29udGVudDogXCJ6ZXVzLWNpcmNsZS1wcm9ncmVzcy1jb250ZW50XCIsXG4gICAgICAgICAgICB9LFxuICAgICAgICB9KTtcbiAgICB9XG5cbiAgICBpbml0UGllUHJvZ3Jlc3MoKSB7XG4gICAgICAgIHRoaXMuZWxlbWVudHMuJGNpcmNsZVByb2dyZXNzLmFzUGllUHJvZ3Jlc3MoXCJzdGFydFwiKTtcbiAgICB9XG5cbiAgICBvYnNlcnZlcigpIHtcbiAgICAgICAgY29uc3Qgb2JzZXJ2ZXIgPSBuZXcgSW50ZXJzZWN0aW9uT2JzZXJ2ZXIodGhpcy5vYnNlcnZlckNhbGxiYWNrLmJpbmQodGhpcyksIHtcbiAgICAgICAgICAgIHRocmVzaG9sZDogMC42NSxcbiAgICAgICAgfSk7XG5cbiAgICAgICAgb2JzZXJ2ZXIub2JzZXJ2ZSh0aGlzLmVsZW1lbnRzLmNpcmNsZVByb2dyZXNzKTtcbiAgICB9XG5cbiAgICBvYnNlcnZlckNhbGxiYWNrKGVudHJpZXMsIG9ic2VydmVyKSB7XG4gICAgICAgIGNvbnN0IGVudHJ5ID0gZW50cmllc1swXTtcblxuICAgICAgICBpZiAoIWVudHJ5LmlzSW50ZXJzZWN0aW5nKSB7XG4gICAgICAgICAgICByZXR1cm47XG4gICAgICAgIH1cblxuICAgICAgICB0aGlzLmluaXRQaWVQcm9ncmVzcygpO1xuXG4gICAgICAgIG9ic2VydmVyLnVub2JzZXJ2ZShlbnRyeS50YXJnZXQpO1xuICAgIH1cbn1cblxucmVnaXN0ZXJXaWRnZXQoWmV1c19DaXJjbGVQcm9jY2VzcywgXCJ6ZXVzLWNpcmNsZS1wcm9ncmVzc1wiKTtcbiJdfQ==
