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

var Zeus_AnimatedHeading = /*#__PURE__*/function (_elementorModules$fro) {
  _inherits(Zeus_AnimatedHeading, _elementorModules$fro);

  var _super = _createSuper(Zeus_AnimatedHeading);

  function Zeus_AnimatedHeading() {
    _classCallCheck(this, Zeus_AnimatedHeading);

    return _super.apply(this, arguments);
  }

  _createClass(Zeus_AnimatedHeading, [{
    key: "getDefaultSettings",
    value: function getDefaultSettings() {
      return {
        selectors: {
          animatedHeading: '.zeus-heading-' + this.getID()
        }
      };
    }
  }, {
    key: "getDefaultElements",
    value: function getDefaultElements() {
      var element = this.$element.get(0);
      var selectors = this.getSettings('selectors');
      return {
        animatedHeading: element.querySelector(selectors.animatedHeading),
        $animatedHeading: this.$element.find(selectors.animatedHeading)
      };
    }
  }, {
    key: "onInit",
    value: function onInit() {
      var _get2;

      for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
        args[_key] = arguments[_key];
      }

      (_get2 = _get(_getPrototypeOf(Zeus_AnimatedHeading.prototype), "onInit", this)).call.apply(_get2, [this].concat(args));

      this.setUserSettings();

      if (this.hasAnimatedHeading) {
        this.initAnimation();
      }
    }
  }, {
    key: "initAnimation",
    value: function initAnimation() {
      var settings = this.getSettings();

      if ('animated' === settings.heading_layout) {
        this.initMorphext();
      } else if ('typed' === settings.heading_layout) {
        this.initTyped();
      }
    }
  }, {
    key: "initMorphext",
    value: function initMorphext() {
      var settings = this.getSettings();
      this.elements.$animatedHeading.Morphext({
        animation: settings.heading_animation,
        speed: settings.heading_animation_delay
      });
    }
  }, {
    key: "initTyped",
    value: function initTyped() {
      var settings = this.getSettings();
      new Typed(settings.selectors.animatedHeading, {
        strings: settings.animated_heading.split(','),
        typeSpeed: settings.type_speed,
        startDelay: settings.start_delay,
        backSpeed: settings.back_speed,
        backDelay: settings.back_delay,
        loop: 'yes' === settings.loop ? true : false,
        loopCount: settings.loop_count ? settings.loop_count : 0
      });
    }
  }, {
    key: "setUserSettings",
    value: function setUserSettings() {
      var elementSettings = this.getElementSettings();
      this.setSettings(elementSettings);
    }
  }, {
    key: "hasAnimatedHeading",
    value: function hasAnimatedHeading() {
      return this.getSettings('animated_heading').trim() !== '';
    }
  }]);

  return Zeus_AnimatedHeading;
}(elementorModules.frontend.handlers.Base);

(0, _utils.registerWidget)(Zeus_AnimatedHeading, 'zeus-animated-heading');

},{"../lib/utils":1}]},{},[2])
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm5vZGVfbW9kdWxlcy9icm93c2VyLXBhY2svX3ByZWx1ZGUuanMiLCJzcmMvbGliL3V0aWxzLmpzIiwic3JjL3dpZGdldHMvYW5pbWF0ZWQtaGVhZGluZy5qcyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFBQTs7Ozs7Ozs7QUNBTyxJQUFNLGNBQWMsR0FBRyxTQUFqQixjQUFpQixDQUFDLFNBQUQsRUFBWSxVQUFaLEVBQTZDO0FBQUEsTUFBckIsSUFBcUIsdUVBQWQsU0FBYzs7QUFDdkUsTUFBSSxFQUFFLFNBQVMsSUFBSSxVQUFmLENBQUosRUFBZ0M7QUFDNUI7QUFDSDtBQUVEO0FBQ0o7QUFDQTtBQUNBOzs7QUFDSSxFQUFBLE1BQU0sQ0FBQyxNQUFELENBQU4sQ0FBZSxFQUFmLENBQWtCLHlCQUFsQixFQUE2QyxZQUFNO0FBQy9DLFFBQU0sVUFBVSxHQUFHLFNBQWIsVUFBYSxDQUFDLFFBQUQsRUFBYztBQUM3QixNQUFBLGlCQUFpQixDQUFDLGVBQWxCLENBQWtDLFVBQWxDLENBQTZDLFNBQTdDLEVBQXdEO0FBQ3BELFFBQUEsUUFBUSxFQUFSO0FBRG9ELE9BQXhEO0FBR0gsS0FKRDs7QUFNQSxJQUFBLGlCQUFpQixDQUFDLEtBQWxCLENBQXdCLFNBQXhCLGtDQUE0RCxVQUE1RCxjQUEwRSxJQUExRSxHQUFrRixVQUFsRjtBQUNILEdBUkQ7QUFTSCxDQWxCTTs7Ozs7Ozs7O0FDQVA7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7O0lBRU0sb0I7Ozs7Ozs7Ozs7Ozs7V0FDRiw4QkFBcUI7QUFDakIsYUFBTztBQUNILFFBQUEsU0FBUyxFQUFFO0FBQ1AsVUFBQSxlQUFlLEVBQUUsbUJBQW1CLEtBQUssS0FBTDtBQUQ3QjtBQURSLE9BQVA7QUFLSDs7O1dBRUQsOEJBQXFCO0FBQ2pCLFVBQU0sT0FBTyxHQUFHLEtBQUssUUFBTCxDQUFjLEdBQWQsQ0FBa0IsQ0FBbEIsQ0FBaEI7QUFDQSxVQUFNLFNBQVMsR0FBRyxLQUFLLFdBQUwsQ0FBaUIsV0FBakIsQ0FBbEI7QUFFQSxhQUFPO0FBQ0gsUUFBQSxlQUFlLEVBQUUsT0FBTyxDQUFDLGFBQVIsQ0FBc0IsU0FBUyxDQUFDLGVBQWhDLENBRGQ7QUFFSCxRQUFBLGdCQUFnQixFQUFFLEtBQUssUUFBTCxDQUFjLElBQWQsQ0FBbUIsU0FBUyxDQUFDLGVBQTdCO0FBRmYsT0FBUDtBQUlIOzs7V0FFRCxrQkFBZ0I7QUFBQTs7QUFBQSx3Q0FBTixJQUFNO0FBQU4sUUFBQSxJQUFNO0FBQUE7O0FBQ1osc0hBQWdCLElBQWhCOztBQUVBLFdBQUssZUFBTDs7QUFFQSxVQUFJLEtBQUssa0JBQVQsRUFBNkI7QUFDekIsYUFBSyxhQUFMO0FBQ0g7QUFDSjs7O1dBRUQseUJBQWdCO0FBQ1osVUFBTSxRQUFRLEdBQUcsS0FBSyxXQUFMLEVBQWpCOztBQUVBLFVBQUksZUFBZSxRQUFRLENBQUMsY0FBNUIsRUFBNEM7QUFDeEMsYUFBSyxZQUFMO0FBQ0gsT0FGRCxNQUVPLElBQUksWUFBWSxRQUFRLENBQUMsY0FBekIsRUFBeUM7QUFDNUMsYUFBSyxTQUFMO0FBQ0g7QUFDSjs7O1dBRUQsd0JBQWU7QUFDWCxVQUFNLFFBQVEsR0FBRyxLQUFLLFdBQUwsRUFBakI7QUFFQSxXQUFLLFFBQUwsQ0FBYyxnQkFBZCxDQUErQixRQUEvQixDQUF3QztBQUNwQyxRQUFBLFNBQVMsRUFBRSxRQUFRLENBQUMsaUJBRGdCO0FBRXBDLFFBQUEsS0FBSyxFQUFFLFFBQVEsQ0FBQztBQUZvQixPQUF4QztBQUlIOzs7V0FFRCxxQkFBWTtBQUNSLFVBQU0sUUFBUSxHQUFHLEtBQUssV0FBTCxFQUFqQjtBQUVBLFVBQUksS0FBSixDQUFVLFFBQVEsQ0FBQyxTQUFULENBQW1CLGVBQTdCLEVBQThDO0FBQzFDLFFBQUEsT0FBTyxFQUFFLFFBQVEsQ0FBQyxnQkFBVCxDQUEwQixLQUExQixDQUFnQyxHQUFoQyxDQURpQztBQUUxQyxRQUFBLFNBQVMsRUFBRSxRQUFRLENBQUMsVUFGc0I7QUFHMUMsUUFBQSxVQUFVLEVBQUUsUUFBUSxDQUFDLFdBSHFCO0FBSTFDLFFBQUEsU0FBUyxFQUFFLFFBQVEsQ0FBQyxVQUpzQjtBQUsxQyxRQUFBLFNBQVMsRUFBRSxRQUFRLENBQUMsVUFMc0I7QUFNMUMsUUFBQSxJQUFJLEVBQUUsVUFBVSxRQUFRLENBQUMsSUFBbkIsR0FBMEIsSUFBMUIsR0FBaUMsS0FORztBQU8xQyxRQUFBLFNBQVMsRUFBRSxRQUFRLENBQUMsVUFBVCxHQUFzQixRQUFRLENBQUMsVUFBL0IsR0FBNEM7QUFQYixPQUE5QztBQVNIOzs7V0FFRCwyQkFBa0I7QUFDZCxVQUFNLGVBQWUsR0FBRyxLQUFLLGtCQUFMLEVBQXhCO0FBRUEsV0FBSyxXQUFMLENBQWlCLGVBQWpCO0FBQ0g7OztXQUVELDhCQUFxQjtBQUNqQixhQUFPLEtBQUssV0FBTCxDQUFpQixrQkFBakIsRUFBcUMsSUFBckMsT0FBZ0QsRUFBdkQ7QUFDSDs7OztFQXRFOEIsZ0JBQWdCLENBQUMsUUFBakIsQ0FBMEIsUUFBMUIsQ0FBbUMsSTs7QUF5RXRFLDJCQUFlLG9CQUFmLEVBQXFDLHVCQUFyQyIsImZpbGUiOiJnZW5lcmF0ZWQuanMiLCJzb3VyY2VSb290IjoiIiwic291cmNlc0NvbnRlbnQiOlsiKGZ1bmN0aW9uKCl7ZnVuY3Rpb24gcihlLG4sdCl7ZnVuY3Rpb24gbyhpLGYpe2lmKCFuW2ldKXtpZighZVtpXSl7dmFyIGM9XCJmdW5jdGlvblwiPT10eXBlb2YgcmVxdWlyZSYmcmVxdWlyZTtpZighZiYmYylyZXR1cm4gYyhpLCEwKTtpZih1KXJldHVybiB1KGksITApO3ZhciBhPW5ldyBFcnJvcihcIkNhbm5vdCBmaW5kIG1vZHVsZSAnXCIraStcIidcIik7dGhyb3cgYS5jb2RlPVwiTU9EVUxFX05PVF9GT1VORFwiLGF9dmFyIHA9bltpXT17ZXhwb3J0czp7fX07ZVtpXVswXS5jYWxsKHAuZXhwb3J0cyxmdW5jdGlvbihyKXt2YXIgbj1lW2ldWzFdW3JdO3JldHVybiBvKG58fHIpfSxwLHAuZXhwb3J0cyxyLGUsbix0KX1yZXR1cm4gbltpXS5leHBvcnRzfWZvcih2YXIgdT1cImZ1bmN0aW9uXCI9PXR5cGVvZiByZXF1aXJlJiZyZXF1aXJlLGk9MDtpPHQubGVuZ3RoO2krKylvKHRbaV0pO3JldHVybiBvfXJldHVybiByfSkoKSIsImV4cG9ydCBjb25zdCByZWdpc3RlcldpZGdldCA9IChjbGFzc05hbWUsIHdpZGdldE5hbWUsIHNraW4gPSAnZGVmYXVsdCcpID0+IHtcbiAgICBpZiAoIShjbGFzc05hbWUgfHwgd2lkZ2V0TmFtZSkpIHtcbiAgICAgICAgcmV0dXJuO1xuICAgIH1cblxuICAgIC8qKlxuICAgICAqIEJlY2F1c2UgRWxlbWVudG9yIHBsdWdpbiB1c2VzIGpRdWVyeSBjdXN0b20gZXZlbnQsXG4gICAgICogV2UgYWxzbyBoYXZlIHRvIHVzZSBqUXVlcnkgdG8gdXNlIHRoaXMgZXZlbnRcbiAgICAgKi9cbiAgICBqUXVlcnkod2luZG93KS5vbignZWxlbWVudG9yL2Zyb250ZW5kL2luaXQnLCAoKSA9PiB7XG4gICAgICAgIGNvbnN0IGFkZEhhbmRsZXIgPSAoJGVsZW1lbnQpID0+IHtcbiAgICAgICAgICAgIGVsZW1lbnRvckZyb250ZW5kLmVsZW1lbnRzSGFuZGxlci5hZGRIYW5kbGVyKGNsYXNzTmFtZSwge1xuICAgICAgICAgICAgICAgICRlbGVtZW50LFxuICAgICAgICAgICAgfSk7XG4gICAgICAgIH07XG5cbiAgICAgICAgZWxlbWVudG9yRnJvbnRlbmQuaG9va3MuYWRkQWN0aW9uKGBmcm9udGVuZC9lbGVtZW50X3JlYWR5LyR7d2lkZ2V0TmFtZX0uJHtza2lufWAsIGFkZEhhbmRsZXIpO1xuICAgIH0pO1xufTtcbiIsImltcG9ydCB7IHJlZ2lzdGVyV2lkZ2V0IH0gZnJvbSAnLi4vbGliL3V0aWxzJztcblxuY2xhc3MgWmV1c19BbmltYXRlZEhlYWRpbmcgZXh0ZW5kcyBlbGVtZW50b3JNb2R1bGVzLmZyb250ZW5kLmhhbmRsZXJzLkJhc2Uge1xuICAgIGdldERlZmF1bHRTZXR0aW5ncygpIHtcbiAgICAgICAgcmV0dXJuIHtcbiAgICAgICAgICAgIHNlbGVjdG9yczoge1xuICAgICAgICAgICAgICAgIGFuaW1hdGVkSGVhZGluZzogJy56ZXVzLWhlYWRpbmctJyArIHRoaXMuZ2V0SUQoKSxcbiAgICAgICAgICAgIH0sXG4gICAgICAgIH07XG4gICAgfVxuXG4gICAgZ2V0RGVmYXVsdEVsZW1lbnRzKCkge1xuICAgICAgICBjb25zdCBlbGVtZW50ID0gdGhpcy4kZWxlbWVudC5nZXQoMCk7XG4gICAgICAgIGNvbnN0IHNlbGVjdG9ycyA9IHRoaXMuZ2V0U2V0dGluZ3MoJ3NlbGVjdG9ycycpO1xuXG4gICAgICAgIHJldHVybiB7XG4gICAgICAgICAgICBhbmltYXRlZEhlYWRpbmc6IGVsZW1lbnQucXVlcnlTZWxlY3RvcihzZWxlY3RvcnMuYW5pbWF0ZWRIZWFkaW5nKSxcbiAgICAgICAgICAgICRhbmltYXRlZEhlYWRpbmc6IHRoaXMuJGVsZW1lbnQuZmluZChzZWxlY3RvcnMuYW5pbWF0ZWRIZWFkaW5nKSxcbiAgICAgICAgfTtcbiAgICB9XG5cbiAgICBvbkluaXQoLi4uYXJncykge1xuICAgICAgICBzdXBlci5vbkluaXQoLi4uYXJncyk7XG5cbiAgICAgICAgdGhpcy5zZXRVc2VyU2V0dGluZ3MoKTtcblxuICAgICAgICBpZiAodGhpcy5oYXNBbmltYXRlZEhlYWRpbmcpIHtcbiAgICAgICAgICAgIHRoaXMuaW5pdEFuaW1hdGlvbigpO1xuICAgICAgICB9XG4gICAgfVxuXG4gICAgaW5pdEFuaW1hdGlvbigpIHtcbiAgICAgICAgY29uc3Qgc2V0dGluZ3MgPSB0aGlzLmdldFNldHRpbmdzKCk7XG5cbiAgICAgICAgaWYgKCdhbmltYXRlZCcgPT09IHNldHRpbmdzLmhlYWRpbmdfbGF5b3V0KSB7XG4gICAgICAgICAgICB0aGlzLmluaXRNb3JwaGV4dCgpO1xuICAgICAgICB9IGVsc2UgaWYgKCd0eXBlZCcgPT09IHNldHRpbmdzLmhlYWRpbmdfbGF5b3V0KSB7XG4gICAgICAgICAgICB0aGlzLmluaXRUeXBlZCgpO1xuICAgICAgICB9XG4gICAgfVxuXG4gICAgaW5pdE1vcnBoZXh0KCkge1xuICAgICAgICBjb25zdCBzZXR0aW5ncyA9IHRoaXMuZ2V0U2V0dGluZ3MoKTtcblxuICAgICAgICB0aGlzLmVsZW1lbnRzLiRhbmltYXRlZEhlYWRpbmcuTW9ycGhleHQoe1xuICAgICAgICAgICAgYW5pbWF0aW9uOiBzZXR0aW5ncy5oZWFkaW5nX2FuaW1hdGlvbixcbiAgICAgICAgICAgIHNwZWVkOiBzZXR0aW5ncy5oZWFkaW5nX2FuaW1hdGlvbl9kZWxheSxcbiAgICAgICAgfSk7XG4gICAgfVxuXG4gICAgaW5pdFR5cGVkKCkge1xuICAgICAgICBjb25zdCBzZXR0aW5ncyA9IHRoaXMuZ2V0U2V0dGluZ3MoKTtcblxuICAgICAgICBuZXcgVHlwZWQoc2V0dGluZ3Muc2VsZWN0b3JzLmFuaW1hdGVkSGVhZGluZywge1xuICAgICAgICAgICAgc3RyaW5nczogc2V0dGluZ3MuYW5pbWF0ZWRfaGVhZGluZy5zcGxpdCgnLCcpLFxuICAgICAgICAgICAgdHlwZVNwZWVkOiBzZXR0aW5ncy50eXBlX3NwZWVkLFxuICAgICAgICAgICAgc3RhcnREZWxheTogc2V0dGluZ3Muc3RhcnRfZGVsYXksXG4gICAgICAgICAgICBiYWNrU3BlZWQ6IHNldHRpbmdzLmJhY2tfc3BlZWQsXG4gICAgICAgICAgICBiYWNrRGVsYXk6IHNldHRpbmdzLmJhY2tfZGVsYXksXG4gICAgICAgICAgICBsb29wOiAneWVzJyA9PT0gc2V0dGluZ3MubG9vcCA/IHRydWUgOiBmYWxzZSxcbiAgICAgICAgICAgIGxvb3BDb3VudDogc2V0dGluZ3MubG9vcF9jb3VudCA/IHNldHRpbmdzLmxvb3BfY291bnQgOiAwLFxuICAgICAgICB9KTtcbiAgICB9XG5cbiAgICBzZXRVc2VyU2V0dGluZ3MoKSB7XG4gICAgICAgIGNvbnN0IGVsZW1lbnRTZXR0aW5ncyA9IHRoaXMuZ2V0RWxlbWVudFNldHRpbmdzKCk7XG5cbiAgICAgICAgdGhpcy5zZXRTZXR0aW5ncyhlbGVtZW50U2V0dGluZ3MpO1xuICAgIH1cblxuICAgIGhhc0FuaW1hdGVkSGVhZGluZygpIHtcbiAgICAgICAgcmV0dXJuIHRoaXMuZ2V0U2V0dGluZ3MoJ2FuaW1hdGVkX2hlYWRpbmcnKS50cmltKCkgIT09ICcnO1xuICAgIH1cbn1cblxucmVnaXN0ZXJXaWRnZXQoWmV1c19BbmltYXRlZEhlYWRpbmcsICd6ZXVzLWFuaW1hdGVkLWhlYWRpbmcnKTtcbiJdfQ==
