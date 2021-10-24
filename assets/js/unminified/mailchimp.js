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
exports.fadeOut = exports.fadeIn = void 0;

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

var fadeIn = function fadeIn(element) {
  var speed = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : "normal";
  var display = arguments.length > 2 ? arguments[2] : undefined;
  var callback = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : null;
  element.style.opacity = 0;
  element.style.display = display || "block";

  var fade = function fade() {
    var opacity = parseFloat(element.style.opacity);

    if ((opacity += speed === "fast" ? 0.2 : 0.1) <= 1) {
      element.style.opacity = opacity;

      if (opacity === 1 && callback) {
        callback();
      }

      window.requestAnimationFrame(fade);
    }
  };

  window.requestAnimationFrame(fade);
};

exports.fadeIn = fadeIn;

var fadeOut = function fadeOut(element) {
  var speed = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : "normal";
  var display = arguments.length > 2 ? arguments[2] : undefined;
  var callback = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : null;
  element.style.opacity = 1;
  element.style.display = display || "block";

  var fade = function fade() {
    var opacity = parseFloat(element.style.opacity);

    if ((opacity -= speed === "fast" ? 0.2 : 0.1) < 0) {
      element.style.display = "none";
    } else {
      element.style.opacity = opacity;

      if (opacity === 0 && callback) {
        callback();
      }

      window.requestAnimationFrame(fade);
    }
  };

  window.requestAnimationFrame(fade);
};

exports.fadeOut = fadeOut;

var Zeus_Mailchimp = /*#__PURE__*/function (_elementorModules$fro) {
  _inherits(Zeus_Mailchimp, _elementorModules$fro);

  var _super = _createSuper(Zeus_Mailchimp);

  function Zeus_Mailchimp() {
    _classCallCheck(this, Zeus_Mailchimp);

    return _super.apply(this, arguments);
  }

  _createClass(Zeus_Mailchimp, [{
    key: "getDefaultSettings",
    value: function getDefaultSettings() {
      return {
        selectors: {
          mcForm: '.zeus-mc-form'
        }
      };
    }
  }, {
    key: "getDefaultElements",
    value: function getDefaultElements() {
      var element = this.$element.get(0);
      var selectors = this.getSettings("selectors");
      return {
        mcForm: element.querySelectorAll(selectors.mcForm)
      };
    }
  }, {
    key: "onInit",
    value: function onInit() {
      var _get2;

      for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
        args[_key] = arguments[_key];
      }

      (_get2 = _get(_getPrototypeOf(Zeus_Mailchimp.prototype), "onInit", this)).call.apply(_get2, [this].concat(args));

      this.setupEventListeners();
    }
  }, {
    key: "setupEventListeners",
    value: function setupEventListeners() {
      var mcForms = this.elements.mcForm;
      mcForms.forEach(function (form) {
        var apiKey = form.parentNode.getAttribute('data-api-key'),
            listID = form.parentNode.getAttribute('data-list-id'),
            buttonText = form.parentNode.getAttribute('data-button-text'),
            successText = form.parentNode.getAttribute('data-success-text'),
            loadingText = form.parentNode.getAttribute('data-loading-text');
        form.addEventListener('submit', function (event) {
          event.preventDefault();
          var btn = form.querySelector('.zeus-mc-subscribe'),
              btnText = form.querySelector('.zeus-mc-subscribe span'),
              firstName = form.querySelector('.zeus-mc-input-fn').value.trim(),
              lastName = form.querySelector('.zeus-mc-input-ln').value.trim(),
              emailAdress = form.querySelector('.zeus-mc-input-email').value.trim(),
              msg = form.querySelector('.zeus-mc-message');
          btn.classList.add('mc-btn-loading');
          btnText.innerHTML = loadingText;
          var formData = new FormData();
          formData.append("action", "zeus_mc_form");
          formData.append("nonce", localize.nonce);
          formData.append("apiKey", apiKey);
          formData.append("listId", listID);
          formData.append("firstname", firstName);
          formData.append("lastname", lastName);
          formData.append("email", emailAdress);
          var params = new URLSearchParams(formData);
          fetch(localize.ajax_url, {
            method: 'POST',
            credentials: 'same-origin',
            headers: {
              'Content-Type': 'application/x-www-form-urlencoded',
              'Cache-Control': 'no-cache'
            },
            body: params
          }).then(function (response) {
            return response.json();
          }).then(function (response) {
            if (response.status == 'subscribed') {
              event.target.reset();
              msg.classList.add('zeus-mc-success-text');
              msg.style.display = 'block';
              msg.innerHTML = '<p>' + successText + '</p>';
            } else {
              msg.classList.add('zeus-mc-error-text');
              msg.style.display = 'block';
              msg.innerHTML = '<p>' + response.status + '</p>';
            }

            btn.classList.remove('mc-btn-loading');
            btnText.innerHTML = buttonText;
          }).catch(function (err) {
            msg.classList.add('zeus-mc-error-text');
            msg.style.display = 'block';
            msg.innerHTML = '<p>' + err.status + '</p>';
            btn.classList.remove('mc-btn-loading');
            btnText.innerHTML = buttonText;
          });
        });
      });
    }
  }]);

  return Zeus_Mailchimp;
}(elementorModules.frontend.handlers.Base);

(0, _utils.registerWidget)(Zeus_Mailchimp, "zeus-mailchimp");

},{"../lib/utils":1}]},{},[2])
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm5vZGVfbW9kdWxlcy9icm93c2VyLXBhY2svX3ByZWx1ZGUuanMiLCJzcmMvbGliL3V0aWxzLmpzIiwic3JjL3dpZGdldHMvbWFpbGNoaW1wLmpzIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUFBOzs7Ozs7OztBQ0FPLElBQU0sY0FBYyxHQUFHLFNBQWpCLGNBQWlCLENBQUMsU0FBRCxFQUFZLFVBQVosRUFBNkM7QUFBQSxNQUFyQixJQUFxQix1RUFBZCxTQUFjOztBQUN2RSxNQUFJLEVBQUUsU0FBUyxJQUFJLFVBQWYsQ0FBSixFQUFnQztBQUM1QjtBQUNIO0FBRUQ7QUFDSjtBQUNBO0FBQ0E7OztBQUNJLEVBQUEsTUFBTSxDQUFDLE1BQUQsQ0FBTixDQUFlLEVBQWYsQ0FBa0IseUJBQWxCLEVBQTZDLFlBQU07QUFDL0MsUUFBTSxVQUFVLEdBQUcsU0FBYixVQUFhLENBQUMsUUFBRCxFQUFjO0FBQzdCLE1BQUEsaUJBQWlCLENBQUMsZUFBbEIsQ0FBa0MsVUFBbEMsQ0FBNkMsU0FBN0MsRUFBd0Q7QUFDcEQsUUFBQSxRQUFRLEVBQVI7QUFEb0QsT0FBeEQ7QUFHSCxLQUpEOztBQU1BLElBQUEsaUJBQWlCLENBQUMsS0FBbEIsQ0FBd0IsU0FBeEIsa0NBQTRELFVBQTVELGNBQTBFLElBQTFFLEdBQWtGLFVBQWxGO0FBQ0gsR0FSRDtBQVNILENBbEJNOzs7Ozs7Ozs7Ozs7OztBQ0FQOzs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7OztBQUVPLElBQU0sTUFBTSxHQUFHLFNBQVQsTUFBUyxDQUFDLE9BQUQsRUFBeUQ7QUFBQSxNQUEvQyxLQUErQyx1RUFBdkMsUUFBdUM7QUFBQSxNQUE3QixPQUE2QjtBQUFBLE1BQXBCLFFBQW9CLHVFQUFULElBQVM7QUFDM0UsRUFBQSxPQUFPLENBQUMsS0FBUixDQUFjLE9BQWQsR0FBd0IsQ0FBeEI7QUFDQSxFQUFBLE9BQU8sQ0FBQyxLQUFSLENBQWMsT0FBZCxHQUF3QixPQUFPLElBQUksT0FBbkM7O0FBRUEsTUFBTSxJ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LEdBQTBCLE1BQTFDO0FBQ0g7O0FBRUQsWUFBQSxHQUFHLENBQUMsU0FBSixDQUFjLE1BQWQsQ0FBcUIsZ0JBQXJCO0FBQ0EsWUFBQSxPQUFPLENBQUMsU0FBUixHQUFvQixVQUFwQjtBQUNILFdBekJELEVBeUJHLEtBekJILENBeUJVLFVBQUEsR0FBRyxFQUFJO0FBQ2IsWUFBQSxHQUFHLENBQUMsU0FBSixDQUFjLEdBQWQsQ0FBa0Isb0JBQWxCO0FBQ0EsWUFBQSxHQUFHLENBQUMsS0FBSixDQUFVLE9BQVYsR0FBb0IsT0FBcEI7QUFDQSxZQUFBLEdBQUcsQ0FBQyxTQUFKLEdBQWdCLFFBQVEsR0FBRyxDQUFDLE1BQVosR0FBcUIsTUFBckM7QUFFQSxZQUFBLEdBQUcsQ0FBQyxTQUFKLENBQWMsTUFBZCxDQUFxQixnQkFBckI7QUFDQSxZQUFBLE9BQU8sQ0FBQyxTQUFSLEdBQW9CLFVBQXBCO0FBQ0gsV0FoQ0Q7QUFpQ0gsU0F4REQ7QUF5REgsT0FoRUQ7QUFpRUg7Ozs7RUE1RndCLGdCQUFnQixDQUFDLFFBQWpCLENBQTBCLFFBQTFCLENBQW1DLEk7O0FBK0ZoRSwyQkFBZSxjQUFmLEVBQStCLGdCQUEvQiIsImZpbGUiOiJnZW5lcmF0ZWQuanMiLCJzb3VyY2VSb290IjoiIiwic291cmNlc0NvbnRlbnQiOlsiKGZ1bmN0aW9uKCl7ZnVuY3Rpb24gcihlLG4sdCl7ZnVuY3Rpb24gbyhpLGYpe2lmKCFuW2ldKXtpZighZVtpXSl7dmFyIGM9XCJmdW5jdGlvblwiPT10eXBlb2YgcmVxdWlyZSYmcmVxdWlyZTtpZighZiYmYylyZXR1cm4gYyhpLCEwKTtpZih1KXJldHVybiB1KGksITApO3ZhciBhPW5ldyBFcnJvcihcIkNhbm5vdCBmaW5kIG1vZHVsZSAnXCIraStcIidcIik7dGhyb3cgYS5jb2RlPVwiTU9EVUxFX05PVF9GT1VORFwiLGF9dmFyIHA9bltpXT17ZXhwb3J0czp7fX07ZVtpXVswXS5jYWxsKHAuZXhwb3J0cyxmdW5jdGlvbihyKXt2YXIgbj1lW2ldWzFdW3JdO3JldHVybiBvKG58fHIpfSxwLHAuZXhwb3J0cyxyLGUsbix0KX1yZXR1cm4gbltpXS5leHBvcnRzfWZvcih2YXIgdT1cImZ1bmN0aW9uXCI9PXR5cGVvZiByZXF1aXJlJiZyZXF1aXJlLGk9MDtpPHQubGVuZ3RoO2krKylvKHRbaV0pO3JldHVybiBvfXJldHVybiByfSkoKSIsImV4cG9ydCBjb25zdCByZWdpc3RlcldpZGdldCA9IChjbGFzc05hbWUsIHdpZGdldE5hbWUsIHNraW4gPSAnZGVmYXVsdCcpID0+IHtcbiAgICBpZiAoIShjbGFzc05hbWUgfHwgd2lkZ2V0TmFtZSkpIHtcbiAgICAgICAgcmV0dXJuO1xuICAgIH1cblxuICAgIC8qKlxuICAgICAqIEJlY2F1c2UgRWxlbWVudG9yIHBsdWdpbiB1c2VzIGpRdWVyeSBjdXN0b20gZXZlbnQsXG4gICAgICogV2UgYWxzbyBoYXZlIHRvIHVzZSBqUXVlcnkgdG8gdXNlIHRoaXMgZXZlbnRcbiAgICAgKi9cbiAgICBqUXVlcnkod2luZG93KS5vbignZWxlbWVudG9yL2Zyb250ZW5kL2luaXQnLCAoKSA9PiB7XG4gICAgICAgIGNvbnN0IGFkZEhhbmRsZXIgPSAoJGVsZW1lbnQpID0+IHtcbiAgICAgICAgICAgIGVsZW1lbnRvckZyb250ZW5kLmVsZW1lbnRzSGFuZGxlci5hZGRIYW5kbGVyKGNsYXNzTmFtZSwge1xuICAgICAgICAgICAgICAgICRlbGVtZW50LFxuICAgICAgICAgICAgfSk7XG4gICAgICAgIH07XG5cbiAgICAgICAgZWxlbWVudG9yRnJvbnRlbmQuaG9va3MuYWRkQWN0aW9uKGBmcm9udGVuZC9lbGVtZW50X3JlYWR5LyR7d2lkZ2V0TmFtZX0uJHtza2lufWAsIGFkZEhhbmRsZXIpO1xuICAgIH0pO1xufTtcbiIsImltcG9ydCB7IHJlZ2lzdGVyV2lkZ2V0IH0gZnJvbSBcIi4uL2xpYi91dGlsc1wiO1xuXG5leHBvcnQgY29uc3QgZmFkZUluID0gKGVsZW1lbnQsIHNwZWVkID0gXCJub3JtYWxcIiwgZGlzcGxheSwgY2FsbGJhY2sgPSBudWxsKSA9PiB7XG4gICAgZWxlbWVudC5zdHlsZS5vcGFjaXR5ID0gMDtcbiAgICBlbGVtZW50LnN0eWxlLmRpc3BsYXkgPSBkaXNwbGF5IHx8IFwiYmxvY2tcIjtcblxuICAgIGNvbnN0IGZhZGUgPSAoKSA9PiB7XG4gICAgICAgIGxldCBvcGFjaXR5ID0gcGFyc2VGbG9hdChlbGVtZW50LnN0eWxlLm9wYWNpdHkpO1xuXG4gICAgICAgIGlmICgob3BhY2l0eSArPSBzcGVlZCA9PT0gXCJmYXN0XCIgPyAwLjIgOiAwLjEpIDw9IDEpIHtcbiAgICAgICAgICAgIGVsZW1lbnQuc3R5bGUub3BhY2l0eSA9IG9wYWNpdHk7XG5cbiAgICAgICAgICAgIGlmIChvcGFjaXR5ID09PSAxICYmIGNhbGxiYWNrKSB7XG4gICAgICAgICAgICAgICAgY2FsbGJhY2soKTtcbiAgICAgICAgICAgIH1cblxuICAgICAgICAgICAgd2luZG93LnJlcXVlc3RBbmltYXRpb25GcmFtZShmYWRlKTtcbiAgICAgICAgfVxuICAgIH07XG5cbiAgICB3aW5kb3cucmVxdWVzdEFuaW1hdGlvbkZyYW1lKGZhZGUpO1xufTtcblxuZXhwb3J0IGNvbnN0IGZhZGVPdXQgPSAoZWxlbWVudCwgc3BlZWQgPSBcIm5vcm1hbFwiLCBkaXNwbGF5LCBjYWxsYmFjayA9IG51bGwpID0+IHtcbiAgICBlbGVtZW50LnN0eWxlLm9wYWNpdHkgPSAxO1xuICAgIGVsZW1lbnQuc3R5bGUuZGlzcGxheSA9IGRpc3BsYXkgfHwgXCJibG9ja1wiO1xuXG4gICAgY29uc3QgZmFkZSA9ICgpID0+IHtcbiAgICAgICAgbGV0IG9wYWNpdHkgPSBwYXJzZUZsb2F0KGVsZW1lbnQuc3R5bGUub3BhY2l0eSk7XG5cbiAgICAgICAgaWYgKChvcGFjaXR5IC09IHNwZWVkID09PSBcImZhc3RcIiA/IDAuMiA6IDAuMSkgPCAwKSB7XG4gICAgICAgICAgICBlbGVtZW50LnN0eWxlLmRpc3BsYXkgPSBcIm5vbmVcIjtcbiAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgIGVsZW1lbnQuc3R5bGUub3BhY2l0eSA9IG9wYWNpdHk7XG5cbiAgICAgICAgICAgIGlmIChvcGFjaXR5ID09PSAwICYmIGNhbGxiYWNrKSB7XG4gICAgICAgICAgICAgICAgY2FsbGJhY2soKTtcbiAgICAgICAgICAgIH1cblxuICAgICAgICAgICAgd2luZG93LnJlcXVlc3RBbmltYXRpb25GcmFtZShmYWRlKTtcbiAgICAgICAgfVxuICAgIH07XG5cbiAgICB3aW5kb3cucmVxdWVzdEFuaW1hdGlvbkZyYW1lKGZhZGUpO1xufTtcblxuY2xhc3MgWmV1c19NYWlsY2hpbXAgZXh0ZW5kcyBlbGVtZW50b3JNb2R1bGVzLmZyb250ZW5kLmhhbmRsZXJzLkJhc2Uge1xuICAgIGdldERlZmF1bHRTZXR0aW5ncygpIHtcbiAgICAgICAgcmV0dXJuIHtcbiAgICAgICAgICAgIHNlbGVjdG9yczoge1xuICAgICAgICAgICAgICAgIG1jRm9ybTogJy56ZXVzLW1jLWZvcm0nLFxuICAgICAgICAgICAgfSxcbiAgICAgICAgfTtcbiAgICB9XG5cbiAgICBnZXREZWZhdWx0RWxlbWVudHMoKSB7XG4gICAgICAgIGNvbnN0IGVsZW1lbnQgPSB0aGlzLiRlbGVtZW50LmdldCgwKTtcbiAgICAgICAgY29uc3Qgc2VsZWN0b3JzID0gdGhpcy5nZXRTZXR0aW5ncyhcInNlbGVjdG9yc1wiKTtcblxuICAgICAgICByZXR1cm4ge1xuICAgICAgICAgICAgbWNGb3JtOiBlbGVtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoc2VsZWN0b3JzLm1jRm9ybSksXG4gICAgICAgIH07XG4gICAgfVxuXG4gICAgb25Jbml0KC4uLmFyZ3MpIHtcbiAgICAgICAgc3VwZXIub25Jbml0KC4uLmFyZ3MpO1xuXG4gICAgICAgIHRoaXMuc2V0dXBFdmVudExpc3RlbmVycygpO1xuICAgIH1cblxuICAgIHNldHVwRXZlbnRMaXN0ZW5lcnMoKSB7XG4gICAgICAgIHZhciBtY0Zvcm1zID0gdGhpcy5lbGVtZW50cy5tY0Zvcm07XG5cbiAgICAgICAgbWNGb3Jtcy5mb3JFYWNoKChmb3JtKSA9PiB7XG4gICAgICAgICAgICB2YXIgYXBpS2V5ICAgICAgICAgID0gZm9ybS5wYXJlbnROb2RlLmdldEF0dHJpYnV0ZSgnZGF0YS1hcGkta2V5JyksXG4gICAgICAgICAgICAgICAgbGlzdElEICAgICAgICAgID0gZm9ybS5wYXJlbnROb2RlLmdldEF0dHJpYnV0ZSgnZGF0YS1saXN0LWlkJyksXG4gICAgICAgICAgICAgICAgYnV0dG9uVGV4dCAgICAgID0gZm9ybS5wYXJlbnROb2RlLmdldEF0dHJpYnV0ZSgnZGF0YS1idXR0b24tdGV4dCcpLFxuICAgICAgICAgICAgICAgIHN1Y2Nlc3NUZXh0ICAgICA9IGZvcm0ucGFyZW50Tm9kZS5nZXRBdHRyaWJ1dGUoJ2RhdGEtc3VjY2Vzcy10ZXh0JyksXG4gICAgICAgICAgICAgICAgbG9hZGluZ1RleHQgICAgID0gZm9ybS5wYXJlbnROb2RlLmdldEF0dHJpYnV0ZSgnZGF0YS1sb2FkaW5nLXRleHQnKTtcblxuICAgICAgICAgICAgZm9ybS5hZGRFdmVudExpc3RlbmVyKCdzdWJtaXQnLCBmdW5jdGlvbihldmVudCkge1xuICAgICAgICAgICAgICAgIGV2ZW50LnByZXZlbnREZWZhdWx0KCk7XG5cbiAgICAgICAgICAgICAgICB2YXIgYnRuICAgICAgICAgPSBmb3JtLnF1ZXJ5U2VsZWN0b3IoJy56ZXVzLW1jLXN1YnNjcmliZScpLFxuICAgICAgICAgICAgICAgICAgICBidG5UZXh0ICAgICA9IGZvcm0ucXVlcnlTZWxlY3RvcignLnpldXMtbWMtc3Vic2NyaWJlIHNwYW4nKSxcbiAgICAgICAgICAgICAgICAgICAgZmlyc3ROYW1lICAgPSBmb3JtLnF1ZXJ5U2VsZWN0b3IoJy56ZXVzLW1jLWlucHV0LWZuJykudmFsdWUudHJpbSgpLFxuICAgICAgICAgICAgICAgICAgICBsYXN0TmFtZSAgICA9IGZvcm0ucXVlcnlTZWxlY3RvcignLnpldXMtbWMtaW5wdXQtbG4nKS52YWx1ZS50cmltKCksXG4gICAgICAgICAgICAgICAgICAgIGVtYWlsQWRyZXNzID0gZm9ybS5xdWVyeVNlbGVjdG9yKCcuemV1cy1tYy1pbnB1dC1lbWFpbCcpLnZhbHVlLnRyaW0oKSxcbiAgICAgICAgICAgICAgICAgICAgbXNnICAgICAgICAgPSBmb3JtLnF1ZXJ5U2VsZWN0b3IoJy56ZXVzLW1jLW1lc3NhZ2UnKTtcblxuICAgICAgICAgICAgICAgIGJ0bi5jbGFzc0xpc3QuYWRkKCdtYy1idG4tbG9hZGluZycpO1xuICAgICAgICAgICAgICAgIGJ0blRleHQuaW5uZXJIVE1MID0gbG9hZGluZ1RleHQ7XG5cbiAgICAgICAgICAgICAgICBjb25zdCBmb3JtRGF0YSA9IG5ldyBGb3JtRGF0YSgpO1xuICAgICAgICAgICAgICAgIGZvcm1EYXRhLmFwcGVuZChcImFjdGlvblwiLCBcInpldXNfbWNfZm9ybVwiKTtcbiAgICAgICAgICAgICAgICBmb3JtRGF0YS5hcHBlbmQoXCJub25jZVwiLCBsb2NhbGl6ZS5ub25jZSk7XG4gICAgICAgICAgICAgICAgZm9ybURhdGEuYXBwZW5kKFwiYXBpS2V5XCIsIGFwaUtleSk7XG4gICAgICAgICAgICAgICAgZm9ybURhdGEuYXBwZW5kKFwibGlzdElkXCIsIGxpc3RJRCk7XG4gICAgICAgICAgICAgICAgZm9ybURhdGEuYXBwZW5kKFwiZmlyc3RuYW1lXCIsIGZpcnN0TmFtZSk7XG4gICAgICAgICAgICAgICAgZm9ybURhdGEuYXBwZW5kKFwibGFzdG5hbWVcIiwgbGFzdE5hbWUpO1xuICAgICAgICAgICAgICAgIGZvcm1EYXRhLmFwcGVuZChcImVtYWlsXCIsIGVtYWlsQWRyZXNzKTtcbiAgICAgICAgICAgICAgICBjb25zdCBwYXJhbXMgPSBuZXcgVVJMU2VhcmNoUGFyYW1zKGZvcm1EYXRhKTtcblxuICAgICAgICAgICAgICAgIGZldGNoKCBsb2NhbGl6ZS5hamF4X3VybCwge1xuICAgICAgICAgICAgICAgICAgICBtZXRob2Q6ICdQT1NUJyxcbiAgICAgICAgICAgICAgICAgICAgY3JlZGVudGlhbHM6ICdzYW1lLW9yaWdpbicsXG4gICAgICAgICAgICAgICAgICAgIGhlYWRlcnM6IHtcbiAgICAgICAgICAgICAgICAgICAgICAgICdDb250ZW50LVR5cGUnOiAnYXBwbGljYXRpb24veC13d3ctZm9ybS11cmxlbmNvZGVkJyxcbiAgICAgICAgICAgICAgICAgICAgICAgICdDYWNoZS1Db250cm9sJzogJ25vLWNhY2hlJyxcbiAgICAgICAgICAgICAgICAgICAgfSxcbiAgICAgICAgICAgICAgICAgICAgYm9keTogcGFyYW1zXG4gICAgICAgICAgICAgICAgfSkudGhlbiggcmVzcG9uc2UgPT4ge1xuICAgICAgICAgICAgICAgICAgICByZXR1cm4gcmVzcG9uc2UuanNvbigpO1xuICAgICAgICAgICAgICAgIH0pLnRoZW4oIHJlc3BvbnNlID0+IHtcbiAgICAgICAgICAgICAgICAgICAgaWYgKCByZXNwb25zZS5zdGF0dXMgPT0gJ3N1YnNjcmliZWQnICkge1xuICAgICAgICAgICAgICAgICAgICAgICAgZXZlbnQudGFyZ2V0LnJlc2V0KCk7XG5cbiAgICAgICAgICAgICAgICAgICAgICAgIG1zZy5jbGFzc0xpc3QuYWRkKCd6ZXVzLW1jLXN1Y2Nlc3MtdGV4dCcpO1xuICAgICAgICAgICAgICAgICAgICAgICAgbXNnLnN0eWxlLmRpc3BsYXkgPSAnYmxvY2snO1xuICAgICAgICAgICAgICAgICAgICAgICAgbXNnLmlubmVySFRNTCA9ICc8cD4nICsgc3VjY2Vzc1RleHQgKyAnPC9wPic7XG4gICAgICAgICAgICAgICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICAgICAgICAgICAgICBtc2cuY2xhc3NMaXN0LmFkZCgnemV1cy1tYy1lcnJvci10ZXh0Jyk7XG4gICAgICAgICAgICAgICAgICAgICAgICBtc2cuc3R5bGUuZGlzcGxheSA9ICdibG9jayc7XG4gICAgICAgICAgICAgICAgICAgICAgICBtc2cuaW5uZXJIVE1MID0gJzxwPicgKyByZXNwb25zZS5zdGF0dXMgKyAnPC9wPic7XG4gICAgICAgICAgICAgICAgICAgIH1cblxuICAgICAgICAgICAgICAgICAgICBidG4uY2xhc3NMaXN0LnJlbW92ZSgnbWMtYnRuLWxvYWRpbmcnKTtcbiAgICAgICAgICAgICAgICAgICAgYnRuVGV4dC5pbm5lckhUTUwgPSBidXR0b25UZXh0O1xuICAgICAgICAgICAgICAgIH0pLmNhdGNoKCBlcnIgPT4geyBcbiAgICAgICAgICAgICAgICAgICAgbXNnLmNsYXNzTGlzdC5hZGQoJ3pldXMtbWMtZXJyb3ItdGV4dCcpO1xuICAgICAgICAgICAgICAgICAgICBtc2cuc3R5bGUuZGlzcGxheSA9ICdibG9jayc7XG4gICAgICAgICAgICAgICAgICAgIG1zZy5pbm5lckhUTUwgPSAnPHA+JyArIGVyci5zdGF0dXMgKyAnPC9wPic7XG5cbiAgICAgICAgICAgICAgICAgICAgYnRuLmNsYXNzTGlzdC5yZW1vdmUoJ21jLWJ0bi1sb2FkaW5nJyk7XG4gICAgICAgICAgICAgICAgICAgIGJ0blRleHQuaW5uZXJIVE1MID0gYnV0dG9uVGV4dDtcbiAgICAgICAgICAgICAgICB9KTtcbiAgICAgICAgICAgIH0pO1xuICAgICAgICB9KTtcbiAgICB9XG59XG5cbnJlZ2lzdGVyV2lkZ2V0KFpldXNfTWFpbGNoaW1wLCBcInpldXMtbWFpbGNoaW1wXCIpO1xuIl19
