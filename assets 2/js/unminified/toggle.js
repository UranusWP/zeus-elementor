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

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function"); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, writable: true, configurable: true } }); if (superClass) _setPrototypeOf(subClass, superClass); }

function _setPrototypeOf(o, p) { _setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) { o.__proto__ = p; return o; }; return _setPrototypeOf(o, p); }

function _createSuper(Derived) { var hasNativeReflectConstruct = _isNativeReflectConstruct(); return function _createSuperInternal() { var Super = _getPrototypeOf(Derived), result; if (hasNativeReflectConstruct) { var NewTarget = _getPrototypeOf(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return _possibleConstructorReturn(this, result); }; }

function _possibleConstructorReturn(self, call) { if (call && (_typeof(call) === "object" || typeof call === "function")) { return call; } return _assertThisInitialized(self); }

function _assertThisInitialized(self) { if (self === void 0) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return self; }

function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); return true; } catch (e) { return false; } }

function _getPrototypeOf(o) { _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf : function _getPrototypeOf(o) { return o.__proto__ || Object.getPrototypeOf(o); }; return _getPrototypeOf(o); }

var Zeus_Toggle = /*#__PURE__*/function (_elementorModules$fro) {
  _inherits(Zeus_Toggle, _elementorModules$fro);

  var _super = _createSuper(Zeus_Toggle);

  function Zeus_Toggle() {
    _classCallCheck(this, Zeus_Toggle);

    return _super.apply(this, arguments);
  }

  _createClass(Zeus_Toggle, [{
    key: "getDefaultSettings",
    value: function getDefaultSettings() {
      return {
        selectors: {
          toggle: ".zeus-toggle-container",
          toggleSwitcher: ".zeus-toggle-wrap",
          toggleSwitcherLabel: ".zeus-toggle-label",
          togglePrimaryContent: ".zeus-toggle-primary-wrap",
          toggleSecondaryContent: ".zeus-toggle-secondary-wrap"
        }
      };
    }
  }, {
    key: "getDefaultElements",
    value: function getDefaultElements() {
      var element = this.$element.get(0);
      var selectors = this.getSettings("selectors");
      return {
        toggle: element.querySelector(selectors.toggle),
        toggleSwitcher: element.querySelector(selectors.toggleSwitcher),
        toggleSwitcherLabel: element.querySelector(selectors.toggleSwitcherLabel),
        togglePrimaryContent: element.querySelector(selectors.togglePrimaryContent),
        toggleSecondaryContent: element.querySelector(selectors.toggleSecondaryContent)
      };
    }
  }, {
    key: "bindEvents",
    value: function bindEvents() {
      this.elements.toggleSwitcherLabel.addEventListener("click", this.toggleSwitcher.bind(this));
    }
  }, {
    key: "toggleSwitcher",
    value: function toggleSwitcher(event) {
      var _this = this;

      event.preventDefault();
      this.elements.toggleSwitcher.classList.toggle("zeus-toggle-on");
      ["hide", "show"].forEach(function (className) {
        _this.elements.togglePrimaryContent.classList.toggle(className);

        _this.elements.toggleSecondaryContent.classList.toggle(className);
      });
      this.productCarousel();
    }
  }, {
    key: "productCarousel",
    value: function productCarousel() {
      var element = this.$element.get(0);

      if (!document.body.classList.contains("no-carousel") && !!element.querySelector(".woo-entry-image.product-entry-slider")) {
        var _zeus$theme$owSlider$;

        (_zeus$theme$owSlider$ = zeus.theme.owSlider.flickity) === null || _zeus$theme$owSlider$ === void 0 ? void 0 : _zeus$theme$owSlider$.forEach(function (flickity) {
          flickity.destroy();
        });
        zeus.theme.owSlider.start();
      }
    }
  }]);

  return Zeus_Toggle;
}(elementorModules.frontend.handlers.Base);

(0, _utils.registerWidget)(Zeus_Toggle, "zeus-toggle");

},{"../lib/utils":1}]},{},[2])
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm5vZGVfbW9kdWxlcy9icm93c2VyLXBhY2svX3ByZWx1ZGUuanMiLCJzcmMvbGliL3V0aWxzLmpzIiwic3JjL3dpZGdldHMvdG9nZ2xlLmpzIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUFBOzs7Ozs7OztBQ0FPLElBQU0sY0FBYyxHQUFHLFNBQWpCLGNBQWlCLENBQUMsU0FBRCxFQUFZLFVBQVosRUFBNkM7QUFBQSxNQUFyQixJQUFxQix1RUFBZCxTQUFjOztBQUN2RSxNQUFJLEVBQUUsU0FBUyxJQUFJLFVBQWYsQ0FBSixFQUFnQztBQUM1QjtBQUNIO0FBRUQ7QUFDSjtBQUNBO0FBQ0E7OztBQUNJLEVBQUEsTUFBTSxDQUFDLE1BQUQsQ0FBTixDQUFlLEVBQWYsQ0FBa0IseUJBQWxCLEVBQTZDLFlBQU07QUFDL0MsUUFBTSxVQUFVLEdBQUcsU0FBYixVQUFhLENBQUMsUUFBRCxFQUFjO0FBQzdCLE1BQUEsaUJBQWlCLENBQUMsZUFBbEIsQ0FBa0MsVUFBbEMsQ0FBNkMsU0FBN0MsRUFBd0Q7QUFDcEQsUUFBQSxRQUFRLEVBQVI7QUFEb0QsT0FBeEQ7QUFHSCxLQUpEOztBQU1BLElBQUEsaUJBQWlCLENBQUMsS0FBbEIsQ0FBd0IsU0FBeEIsa0NBQTRELFVBQTVELGNBQTBFLElBQTFFLEdBQWtGLFVBQWxGO0FBQ0gsR0FSRDtBQVNILENBbEJNOzs7Ozs7Ozs7QUNBUDs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7OztJQUVNLFc7Ozs7Ozs7Ozs7Ozs7V0FDRiw4QkFBcUI7QUFDakIsYUFBTztBQUNILFFBQUEsU0FBUyxFQUFFO0FBQ1AsVUFBQSxNQUFNLEVBQUUsd0JBREQ7QUFFUCxVQUFBLGNBQWMsRUFBRSxtQkFGVDtBQUdQLFVBQUEsbUJBQW1CLEVBQUUsb0JBSGQ7QUFJUCxVQUFBLG9CQUFvQixFQUFFLDJCQUpmO0FBS1AsVUFBQSxzQkFBc0IsRUFBRTtBQUxqQjtBQURSLE9BQVA7QUFTSDs7O1dBRUQsOEJBQXFCO0FBQ2pCLFVBQU0sT0FBTyxHQUFHLEtBQUssUUFBTCxDQUFjLEdBQWQsQ0FBa0IsQ0FBbEIsQ0FBaEI7QUFDQSxVQUFNLFNBQVMsR0FBRyxLQUFLLFdBQUwsQ0FBaUIsV0FBakIsQ0FBbEI7QUFFQSxhQUFPO0FBQ0gsUUFBQSxNQUFNLEVBQUUsT0FBTyxDQUFDLGFBQVIsQ0FBc0IsU0FBUyxDQUFDLE1BQWhDLENBREw7QUFFSCxRQUFBLGNBQWMsRUFBRSxPQUFPLENBQUMsYUFBUixDQUFzQixTQUFTLENBQUMsY0FBaEMsQ0FGYjtBQUdILFFBQUEsbUJBQW1CLEVBQUUsT0FBTyxDQUFDLGFBQVIsQ0FBc0IsU0FBUyxDQUFDLG1CQUFoQyxDQUhsQjtBQUlILFFBQUEsb0JBQW9CLEVBQUUsT0FBTyxDQUFDLGFBQVIsQ0FBc0IsU0FBUyxDQUFDLG9CQUFoQyxDQUpuQjtBQUtILFFBQUEsc0JBQXNCLEVBQUUsT0FBTyxDQUFDLGFBQVIsQ0FBc0IsU0FBUyxDQUFDLHNCQUFoQztBQUxyQixPQUFQO0FBT0g7OztXQUVELHNCQUFhO0FBQ1QsV0FBSyxRQUFMLENBQWMsbUJBQWQsQ0FBa0MsZ0JBQWxDLENBQW1ELE9BQW5ELEVBQTRELEtBQUssY0FBTCxDQUFvQixJQUFwQixDQUF5QixJQUF6QixDQUE1RDtBQUNIOzs7V0FFRCx3QkFBZSxLQUFmLEVBQXNCO0FBQUE7O0FBQ2xCLE1BQUEsS0FBSyxDQUFDLGNBQU47QUFFQSxXQUFLLFFBQUwsQ0FBYyxjQUFkLENBQTZCLFNBQTdCLENBQXVDLE1BQXZDLENBQThDLGdCQUE5QztBQUVBLE9BQUMsTUFBRCxFQUFTLE1BQVQsRUFBaUIsT0FBakIsQ0FBeUIsVUFBQyxTQUFELEVBQWU7QUFDcEMsUUFBQSxLQUFJLENBQUMsUUFBTCxDQUFjLG9CQUFkLENBQW1DLFNBQW5DLENBQTZDLE1BQTdDLENBQW9ELFNBQXBEOztBQUNBLFFBQUEsS0FBSSxDQUFDLFFBQUwsQ0FBYyxzQkFBZCxDQUFxQyxTQUFyQyxDQUErQyxNQUEvQyxDQUFzRCxTQUF0RDtBQUNILE9BSEQ7QUFLQSxXQUFLLGVBQUw7QUFDSDs7O1dBRUQsMkJBQWtCO0FBQ2QsVUFBTSxPQUFPLEdBQUcsS0FBSyxRQUFMLENBQWMsR0FBZCxDQUFrQixDQUFsQixDQUFoQjs7QUFFQSxVQUNJLENBQUMsUUFBUSxDQUFDLElBQVQsQ0FBYyxTQUFkLENBQXdCLFFBQXhCLENBQWlDLGFBQWpDLENBQUQsSUFDQSxDQUFDLENBQUMsT0FBTyxDQUFDLGFBQVIsQ0FBc0IsdUNBQXRCLENBRk4sRUFHRTtBQUFBOztBQUNFLGlDQUFBLElBQUksQ0FBQyxLQUFMLENBQVcsUUFBWCxDQUFvQixRQUFwQixnRkFBOEIsT0FBOUIsQ0FBc0MsVUFBQyxRQUFELEVBQWM7QUFDaEQsVUFBQSxRQUFRLENBQUMsT0FBVDtBQUNILFNBRkQ7QUFJQSxRQUFBLElBQUksQ0FBQyxLQUFMLENBQVcsUUFBWCxDQUFvQixLQUFwQjtBQUNIO0FBQ0o7Ozs7RUF4RHFCLGdCQUFnQixDQUFDLFFBQWpCLENBQTBCLFFBQTFCLENBQW1DLEk7O0FBMkQ3RCwyQkFBZSxXQUFmLEVBQTRCLGFBQTVCIiwiZmlsZSI6ImdlbmVyYXRlZC5qcyIsInNvdXJjZVJvb3QiOiIiLCJzb3VyY2VzQ29udGVudCI6WyIoZnVuY3Rpb24oKXtmdW5jdGlvbiByKGUsbix0KXtmdW5jdGlvbiBvKGksZil7aWYoIW5baV0pe2lmKCFlW2ldKXt2YXIgYz1cImZ1bmN0aW9uXCI9PXR5cGVvZiByZXF1aXJlJiZyZXF1aXJlO2lmKCFmJiZjKXJldHVybiBjKGksITApO2lmKHUpcmV0dXJuIHUoaSwhMCk7dmFyIGE9bmV3IEVycm9yKFwiQ2Fubm90IGZpbmQgbW9kdWxlICdcIitpK1wiJ1wiKTt0aHJvdyBhLmNvZGU9XCJNT0RVTEVfTk9UX0ZPVU5EXCIsYX12YXIgcD1uW2ldPXtleHBvcnRzOnt9fTtlW2ldWzBdLmNhbGwocC5leHBvcnRzLGZ1bmN0aW9uKHIpe3ZhciBuPWVbaV1bMV1bcl07cmV0dXJuIG8obnx8cil9LHAscC5leHBvcnRzLHIsZSxuLHQpfXJldHVybiBuW2ldLmV4cG9ydHN9Zm9yKHZhciB1PVwiZnVuY3Rpb25cIj09dHlwZW9mIHJlcXVpcmUmJnJlcXVpcmUsaT0wO2k8dC5sZW5ndGg7aSsrKW8odFtpXSk7cmV0dXJuIG99cmV0dXJuIHJ9KSgpIiwiZXhwb3J0IGNvbnN0IHJlZ2lzdGVyV2lkZ2V0ID0gKGNsYXNzTmFtZSwgd2lkZ2V0TmFtZSwgc2tpbiA9ICdkZWZhdWx0JykgPT4ge1xuICAgIGlmICghKGNsYXNzTmFtZSB8fCB3aWRnZXROYW1lKSkge1xuICAgICAgICByZXR1cm47XG4gICAgfVxuXG4gICAgLyoqXG4gICAgICogQmVjYXVzZSBFbGVtZW50b3IgcGx1Z2luIHVzZXMgalF1ZXJ5IGN1c3RvbSBldmVudCxcbiAgICAgKiBXZSBhbHNvIGhhdmUgdG8gdXNlIGpRdWVyeSB0byB1c2UgdGhpcyBldmVudFxuICAgICAqL1xuICAgIGpRdWVyeSh3aW5kb3cpLm9uKCdlbGVtZW50b3IvZnJvbnRlbmQvaW5pdCcsICgpID0+IHtcbiAgICAgICAgY29uc3QgYWRkSGFuZGxlciA9ICgkZWxlbWVudCkgPT4ge1xuICAgICAgICAgICAgZWxlbWVudG9yRnJvbnRlbmQuZWxlbWVudHNIYW5kbGVyLmFkZEhhbmRsZXIoY2xhc3NOYW1lLCB7XG4gICAgICAgICAgICAgICAgJGVsZW1lbnQsXG4gICAgICAgICAgICB9KTtcbiAgICAgICAgfTtcblxuICAgICAgICBlbGVtZW50b3JGcm9udGVuZC5ob29rcy5hZGRBY3Rpb24oYGZyb250ZW5kL2VsZW1lbnRfcmVhZHkvJHt3aWRnZXROYW1lfS4ke3NraW59YCwgYWRkSGFuZGxlcik7XG4gICAgfSk7XG59O1xuIiwiaW1wb3J0IHsgcmVnaXN0ZXJXaWRnZXQgfSBmcm9tIFwiLi4vbGliL3V0aWxzXCI7XG5cbmNsYXNzIFpldXNfVG9nZ2xlIGV4dGVuZHMgZWxlbWVudG9yTW9kdWxlcy5mcm9udGVuZC5oYW5kbGVycy5CYXNlIHtcbiAgICBnZXREZWZhdWx0U2V0dGluZ3MoKSB7XG4gICAgICAgIHJldHVybiB7XG4gICAgICAgICAgICBzZWxlY3RvcnM6IHtcbiAgICAgICAgICAgICAgICB0b2dnbGU6IFwiLnpldXMtdG9nZ2xlLWNvbnRhaW5lclwiLFxuICAgICAgICAgICAgICAgIHRvZ2dsZVN3aXRjaGVyOiBcIi56ZXVzLXRvZ2dsZS13cmFwXCIsXG4gICAgICAgICAgICAgICAgdG9nZ2xlU3dpdGNoZXJMYWJlbDogXCIuemV1cy10b2dnbGUtbGFiZWxcIixcbiAgICAgICAgICAgICAgICB0b2dnbGVQcmltYXJ5Q29udGVudDogXCIuemV1cy10b2dnbGUtcHJpbWFyeS13cmFwXCIsXG4gICAgICAgICAgICAgICAgdG9nZ2xlU2Vjb25kYXJ5Q29udGVudDogXCIuemV1cy10b2dnbGUtc2Vjb25kYXJ5LXdyYXBcIixcbiAgICAgICAgICAgIH0sXG4gICAgICAgIH07XG4gICAgfVxuXG4gICAgZ2V0RGVmYXVsdEVsZW1lbnRzKCkge1xuICAgICAgICBjb25zdCBlbGVtZW50ID0gdGhpcy4kZWxlbWVudC5nZXQoMCk7XG4gICAgICAgIGNvbnN0IHNlbGVjdG9ycyA9IHRoaXMuZ2V0U2V0dGluZ3MoXCJzZWxlY3RvcnNcIik7XG5cbiAgICAgICAgcmV0dXJuIHtcbiAgICAgICAgICAgIHRvZ2dsZTogZWxlbWVudC5xdWVyeVNlbGVjdG9yKHNlbGVjdG9ycy50b2dnbGUpLFxuICAgICAgICAgICAgdG9nZ2xlU3dpdGNoZXI6IGVsZW1lbnQucXVlcnlTZWxlY3RvcihzZWxlY3RvcnMudG9nZ2xlU3dpdGNoZXIpLFxuICAgICAgICAgICAgdG9nZ2xlU3dpdGNoZXJMYWJlbDogZWxlbWVudC5xdWVyeVNlbGVjdG9yKHNlbGVjdG9ycy50b2dnbGVTd2l0Y2hlckxhYmVsKSxcbiAgICAgICAgICAgIHRvZ2dsZVByaW1hcnlDb250ZW50OiBlbGVtZW50LnF1ZXJ5U2VsZWN0b3Ioc2VsZWN0b3JzLnRvZ2dsZVByaW1hcnlDb250ZW50KSxcbiAgICAgICAgICAgIHRvZ2dsZVNlY29uZGFyeUNvbnRlbnQ6IGVsZW1lbnQucXVlcnlTZWxlY3RvcihzZWxlY3RvcnMudG9nZ2xlU2Vjb25kYXJ5Q29udGVudCksXG4gICAgICAgIH07XG4gICAgfVxuXG4gICAgYmluZEV2ZW50cygpIHtcbiAgICAgICAgdGhpcy5lbGVtZW50cy50b2dnbGVTd2l0Y2hlckxhYmVsLmFkZEV2ZW50TGlzdGVuZXIoXCJjbGlja1wiLCB0aGlzLnRvZ2dsZVN3aXRjaGVyLmJpbmQodGhpcykpO1xuICAgIH1cblxuICAgIHRvZ2dsZVN3aXRjaGVyKGV2ZW50KSB7XG4gICAgICAgIGV2ZW50LnByZXZlbnREZWZhdWx0KCk7XG5cbiAgICAgICAgdGhpcy5lbGVtZW50cy50b2dnbGVTd2l0Y2hlci5jbGFzc0xpc3QudG9nZ2xlKFwiemV1cy10b2dnbGUtb25cIik7XG5cbiAgICAgICAgW1wiaGlkZVwiLCBcInNob3dcIl0uZm9yRWFjaCgoY2xhc3NOYW1lKSA9PiB7XG4gICAgICAgICAgICB0aGlzLmVsZW1lbnRzLnRvZ2dsZVByaW1hcnlDb250ZW50LmNsYXNzTGlzdC50b2dnbGUoY2xhc3NOYW1lKTtcbiAgICAgICAgICAgIHRoaXMuZWxlbWVudHMudG9nZ2xlU2Vjb25kYXJ5Q29udGVudC5jbGFzc0xpc3QudG9nZ2xlKGNsYXNzTmFtZSk7XG4gICAgICAgIH0pO1xuXG4gICAgICAgIHRoaXMucHJvZHVjdENhcm91c2VsKCk7XG4gICAgfVxuXG4gICAgcHJvZHVjdENhcm91c2VsKCkge1xuICAgICAgICBjb25zdCBlbGVtZW50ID0gdGhpcy4kZWxlbWVudC5nZXQoMCk7XG5cbiAgICAgICAgaWYgKFxuICAgICAgICAgICAgIWRvY3VtZW50LmJvZHkuY2xhc3NMaXN0LmNvbnRhaW5zKFwibm8tY2Fyb3VzZWxcIikgJiZcbiAgICAgICAgICAgICEhZWxlbWVudC5xdWVyeVNlbGVjdG9yKFwiLndvby1lbnRyeS1pbWFnZS5wcm9kdWN0LWVudHJ5LXNsaWRlclwiKVxuICAgICAgICApIHtcbiAgICAgICAgICAgIHpldXMudGhlbWUub3dTbGlkZXIuZmxpY2tpdHk/LmZvckVhY2goKGZsaWNraXR5KSA9PiB7XG4gICAgICAgICAgICAgICAgZmxpY2tpdHkuZGVzdHJveSgpO1xuICAgICAgICAgICAgfSk7XG5cbiAgICAgICAgICAgIHpldXMudGhlbWUub3dTbGlkZXIuc3RhcnQoKTtcbiAgICAgICAgfVxuICAgIH1cbn1cblxucmVnaXN0ZXJXaWRnZXQoWmV1c19Ub2dnbGUsIFwiemV1cy10b2dnbGVcIik7XG4iXX0=
