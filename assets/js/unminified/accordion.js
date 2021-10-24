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
exports.slideToggle = exports.slideDown = exports.slideUp = void 0;

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

var slideUp = function slideUp(element) {
  var duration = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 300;
  element.style.boxSizing = 'border-box';
  element.style.transitionProperty = 'height, margin, padding';
  element.style.transitionDuration = "".concat(duration, "ms");
  element.style.height = "".concat(element.offsetHeight, "px");
  element.style.paddingTop = 0;
  element.style.paddingBottom = 0;
  element.style.marginTop = 0;
  element.style.marginBottom = 0;
  element.style.overflow = 'hidden';
  setTimeout(function () {
    element.style.height = 0;
  }, 10);
  window.setTimeout(function () {
    element.style.display = 'none';
    element.style.removeProperty('height');
    element.style.removeProperty('padding-top');
    element.style.removeProperty('padding-bottom');
    element.style.removeProperty('margin-top');
    element.style.removeProperty('margin-bottom');
    element.style.removeProperty('overflow');
    element.style.removeProperty('transition-duration');
    element.style.removeProperty('transition-property');
  }, duration);
};

exports.slideUp = slideUp;

var slideDown = function slideDown(element) {
  var duration = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 300;
  element.style.removeProperty('display');
  var display = window.getComputedStyle(element).display;

  if (display === 'none') {
    display = 'block';
  }

  element.style.display = display;
  var height = element.offsetHeight;
  var paddingTop = window.getComputedStyle(element).paddingTop;
  var paddingBottom = window.getComputedStyle(element).paddingBottom;
  var marginTop = window.getComputedStyle(element).marginTop;
  var marginBottom = window.getComputedStyle(element).marginBottom;
  element.style.height = 0;
  element.style.paddingTop = 0;
  element.style.paddingBottom = 0;
  element.style.marginTop = 0;
  element.style.marginBottom = 0;
  element.style.overflow = 'hidden';
  element.style.boxSizing = 'border-box';
  element.style.transitionProperty = 'height';
  element.style.transitionDuration = "".concat(duration, "ms");
  setTimeout(function () {
    element.style.height = "".concat(height, "px");

    if (paddingTop !== '0px' || paddingBottom !== '0px') {
      element.style.transitionProperty = 'padding';
      element.style.transitionDuration = "".concat(duration / 1.2, "ms");
      element.style.paddingTop = paddingTop;
      element.style.paddingBottom = paddingBottom;
      element.style.marginTop = marginTop;
      element.style.marginBottom = marginBottom;
    }
  }, 10);
  window.setTimeout(function () {
    element.style.removeProperty('height');
    element.style.removeProperty('overflow');
    element.style.removeProperty('transition-duration');
    element.style.removeProperty('transition-property');
    element.style.removeProperty('padding-top');
    element.style.removeProperty('padding-bottom');
    element.style.removeProperty('margin-top');
    element.style.removeProperty('margin-bottom');
  }, duration);
};

exports.slideDown = slideDown;

var slideToggle = function slideToggle(element, duration) {
  return window.getComputedStyle(element).display === 'none' ? slideDown(element, duration) : slideUp(element, duration);
};

exports.slideToggle = slideToggle;

var Zeus_Accordion = /*#__PURE__*/function (_elementorModules$fro) {
  _inherits(Zeus_Accordion, _elementorModules$fro);

  var _super = _createSuper(Zeus_Accordion);

  function Zeus_Accordion() {
    _classCallCheck(this, Zeus_Accordion);

    return _super.apply(this, arguments);
  }

  _createClass(Zeus_Accordion, [{
    key: "getDefaultSettings",
    value: function getDefaultSettings() {
      return {
        selectors: {
          accordion: '.zeus-accordion',
          accordionItem: '.zeus-accordion-item',
          accordionTitle: '.zeus-accordion-title',
          accordionContent: '.zeus-accordion-content'
        },
        classes: {
          active: 'zeus-active'
        },
        activeItemIndex: null,
        multiExpand: false
      };
    }
  }, {
    key: "getDefaultElements",
    value: function getDefaultElements() {
      var element = this.$element.get(0);
      var selectors = this.getSettings('selectors');
      return {
        accordion: element.querySelector(selectors.accordion),
        accordionItems: element.querySelectorAll(selectors.accordionItem),
        accordionTitles: element.querySelectorAll(selectors.accordionTitle),
        accordionContents: element.querySelectorAll(selectors.accordionContent)
      };
    }
  }, {
    key: "onInit",
    value: function onInit() {
      var _get2;

      for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
        args[_key] = arguments[_key];
      }

      (_get2 = _get(_getPrototypeOf(Zeus_Accordion.prototype), "onInit", this)).call.apply(_get2, [this].concat(args));

      this.setUserSettings();
      this.activateDefaultItem();
    }
  }, {
    key: "setUserSettings",
    value: function setUserSettings() {
      var settings = this.getSettings();
      var userSettings = JSON.parse(this.elements.accordion.getAttribute('data-settings'));
      this.setSettings({
        activeItemIndex: !!userSettings.active_item ? userSettings.active_item : settings.activeItemIndex,
        multiExpand: !!userSettings.multiple ? JSON.parse(userSettings.multiple) : settings.multiExpand
      });
    }
  }, {
    key: "activateDefaultItem",
    value: function activateDefaultItem() {
      var settings = this.getSettings();
      var selectors = settings.selectors;
      var activeItemIndex = settings.activeItemIndex;
      var activeClass = settings.classes.active;

      if (!activeItemIndex) {
        return;
      }

      var activeAccordionItem = this.elements.accordion.querySelector("".concat(selectors.accordionItem, ":nth-child(").concat(activeItemIndex, ")"));
      activeAccordionItem.classList.remove(activeClass);
      this.changeActiveItem(activeAccordionItem);
    }
  }, {
    key: "bindEvents",
    value: function bindEvents() {
      var _this = this;

      this.elements.accordionTitles.forEach(function (accordionTitle) {
        accordionTitle.addEventListener('click', _this.onTitleClick.bind(_this));
      });
    }
  }, {
    key: "onTitleClick",
    value: function onTitleClick(event) {
      var enableMultiExpand = this.getSettings('multiExpand');
      var accordionTitle = event.currentTarget;
      var accordionItem = accordionTitle.parentNode;

      if (!!enableMultiExpand) {
        this.toggleMultiExpandItem(accordionItem);
      } else {
        this.changeActiveItem(accordionItem);
      }
    }
  }, {
    key: "toggleMultiExpandItem",
    value: function toggleMultiExpandItem(accordionItem) {
      var activeClass = this.getSettings('classes.active');
      var accordionContent = this.getAccordionContent(accordionItem);
      accordionItem.classList.toggle(activeClass);
      slideToggle(accordionContent, 300);
    }
  }, {
    key: "changeActiveItem",
    value: function changeActiveItem(accordionItem) {
      var _this2 = this;

      if (this.isActiveItem(accordionItem)) {
        this.deactiveItem(accordionItem);
      } else {
        this.elements.accordionItems.forEach(function (_accordionItem) {
          if (_accordionItem !== accordionItem) {
            _this2.deactiveItem(_accordionItem);
          }
        });
        this.activateItem(accordionItem);
      }
    }
  }, {
    key: "activateItem",
    value: function activateItem(accordionItem) {
      var activeClass = this.getSettings('classes.active');
      var accordionContent = this.getAccordionContent(accordionItem);
      accordionItem.classList.add(activeClass);
      slideDown(accordionContent, 300);
    }
  }, {
    key: "deactiveItem",
    value: function deactiveItem(accordionItem) {
      var activeClass = this.getSettings('classes.active');
      var accordionContent = this.getAccordionContent(accordionItem);
      accordionItem.classList.remove(activeClass);
      slideUp(accordionContent, 300);
    }
  }, {
    key: "isActiveItem",
    value: function isActiveItem(accordionItem) {
      return accordionItem.classList.contains(this.getSettings('classes.active'));
    }
  }, {
    key: "getAccordionContent",
    value: function getAccordionContent(accordionItem) {
      return accordionItem.querySelector(this.getSettings('selectors.accordionContent'));
    }
  }]);

  return Zeus_Accordion;
}(elementorModules.frontend.handlers.Base);

(0, _utils.registerWidget)(Zeus_Accordion, 'zeus-accordion');

},{"../lib/utils":1}]},{},[2])
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm5vZGVfbW9kdWxlcy9icm93c2VyLXBhY2svX3ByZWx1ZGUuanMiLCJzcmMvbGliL3V0aWxzLmpzIiwic3JjL3dpZGdldHMvYWNjb3JkaW9uLmpzIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUFBOzs7Ozs7OztBQ0FPLElBQU0sY0FBYyxHQUFHLFNBQWpCLGNBQWlCLENBQUMsU0FBRCxFQUFZLFVBQVosRUFBNkM7QUFBQSxNQUFyQixJQUFxQix1RUFBZCxTQUFjOztBQUN2RSxNQUFJLEVBQUUsU0FBUyxJQUFJLFVBQWYsQ0FBSixFQUFnQztBQUM1QjtBQUNIO0FBRUQ7QUFDSjtBQUNBO0FBQ0E7OztBQUNJLEVBQUEsTUFBTSxDQUFDLE1BQUQsQ0FBTixDQUFlLEVBQWYsQ0FBa0IseUJBQWxCLEVBQTZDLFlBQU07QUFDL0MsUUFBTSxVQUFVLEdBQUcsU0FBYixVQUFhLENBQUMsUUFBRCxFQUFjO0FBQzdCLE1BQUEsaUJBQWlCLENBQUMsZUFBbEIsQ0FBa0MsVUFBbEMsQ0FBNkMsU0FBN0MsRUFBd0Q7QUFDcEQsUUFBQSxRQUFRLEVBQVI7QUFEb0QsT0FBeEQ7QUFHSCxLQUpEOztBQU1BLElBQUEsaUJBQWlCLENBQUMsS0FBbEIsQ0FBd0IsU0FBeEIsa0NBQTRELFVBQTVELGNBQTBFLElBQTFFLEdBQWtGLFVBQWxGO0FBQ0gsR0FSRDtBQVNILENBbEJNOzs7Ozs7Ozs7Ozs7OztBQ0FQOzs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7OztBQUVPLElBQU0sT0FBTyxHQUFHLFNBQVYsT0FBVSxDQUFDLE9BQUQsRUFBNkI7QUFBQSxNQUFuQixRQUFtQix1RUFBUixHQUFRO0FBQ2hELEVBQUEsT0FBTyxDQUFDLEtBQVIsQ0FBYyxTQUFkLEdBQTBCLFlBQTFCO0FBQ0EsRUFBQSxPQUFPLENBQUMsS0FBUixDQUFjLGtCQUFkLEdBQW1DLHlCQUFuQztBQUNBLEVBQUEsT0FBTyxDQUFDLEtBQVIsQ0FBYyxrQkFBZCxhQUFzQyxRQUF0QztBQUNBLEVBQUEsT0FBTyxDQUFD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RUFBc0M7QUFDbEMsWUFBQSxNQUFJLENBQUMsWUFBTCxDQUFrQixjQUFsQjtBQUNIO0FBQ0osU0FKRDtBQU1BLGFBQUssWUFBTCxDQUFrQixhQUFsQjtBQUNIO0FBQ0o7OztXQUVELHNCQUFhLGFBQWIsRUFBNEI7QUFDeEIsVUFBTSxXQUFXLEdBQUcsS0FBSyxXQUFMLENBQWlCLGdCQUFqQixDQUFwQjtBQUNBLFVBQU0sZ0JBQWdCLEdBQUcsS0FBSyxtQkFBTCxDQUF5QixhQUF6QixDQUF6QjtBQUVBLE1BQUEsYUFBYSxDQUFDLFNBQWQsQ0FBd0IsR0FBeEIsQ0FBNEIsV0FBNUI7QUFDQSxNQUFBLFNBQVMsQ0FBQyxnQkFBRCxFQUFtQixHQUFuQixDQUFUO0FBQ0g7OztXQUVELHNCQUFhLGFBQWIsRUFBNEI7QUFDeEIsVUFBTSxXQUFXLEdBQUcsS0FBSyxXQUFMLENBQWlCLGdCQUFqQixDQUFwQjtBQUNBLFVBQU0sZ0JBQWdCLEdBQUcsS0FBSyxtQkFBTCxDQUF5QixhQUF6QixDQUF6QjtBQUVBLE1BQUEsYUFBYSxDQUFDLFNBQWQsQ0FBd0IsTUFBeEIsQ0FBK0IsV0FBL0I7QUFDQSxNQUFBLE9BQU8sQ0FBQyxnQkFBRCxFQUFtQixHQUFuQixDQUFQO0FBQ0g7OztXQUVELHNCQUFhLGFBQWIsRUFBNEI7QUFDeEIsYUFBTyxhQUFhLENBQUMsU0FBZCxDQUF3QixRQUF4QixDQUFpQyxLQUFLLFdBQUwsQ0FBaUIsZ0JBQWpCLENBQWpDLENBQVA7QUFDSDs7O1dBRUQsNkJBQW9CLGFBQXBCLEVBQW1DO0FBQy9CLGFBQU8sYUFBYSxDQUFDLGFBQWQsQ0FBNEIsS0FBSyxXQUFMLENBQWlCLDRCQUFqQixDQUE1QixDQUFQO0FBQ0g7Ozs7RUEvSHdCLGdCQUFnQixDQUFDLFFBQWpCLENBQTBCLFFBQTFCLENBQW1DLEk7O0FBa0loRSwyQkFBZSxjQUFmLEVBQStCLGdCQUEvQiIsImZpbGUiOiJnZW5lcmF0ZWQuanMiLCJzb3VyY2VSb290IjoiIiwic291cmNlc0NvbnRlbnQiOlsiKGZ1bmN0aW9uKCl7ZnVuY3Rpb24gcihlLG4sdCl7ZnVuY3Rpb24gbyhpLGYpe2lmKCFuW2ldKXtpZighZVtpXSl7dmFyIGM9XCJmdW5jdGlvblwiPT10eXBlb2YgcmVxdWlyZSYmcmVxdWlyZTtpZighZiYmYylyZXR1cm4gYyhpLCEwKTtpZih1KXJldHVybiB1KGksITApO3ZhciBhPW5ldyBFcnJvcihcIkNhbm5vdCBmaW5kIG1vZHVsZSAnXCIraStcIidcIik7dGhyb3cgYS5jb2RlPVwiTU9EVUxFX05PVF9GT1VORFwiLGF9dmFyIHA9bltpXT17ZXhwb3J0czp7fX07ZVtpXVswXS5jYWxsKHAuZXhwb3J0cyxmdW5jdGlvbihyKXt2YXIgbj1lW2ldWzFdW3JdO3JldHVybiBvKG58fHIpfSxwLHAuZXhwb3J0cyxyLGUsbix0KX1yZXR1cm4gbltpXS5leHBvcnRzfWZvcih2YXIgdT1cImZ1bmN0aW9uXCI9PXR5cGVvZiByZXF1aXJlJiZyZXF1aXJlLGk9MDtpPHQubGVuZ3RoO2krKylvKHRbaV0pO3JldHVybiBvfXJldHVybiByfSkoKSIsImV4cG9ydCBjb25zdCByZWdpc3RlcldpZGdldCA9IChjbGFzc05hbWUsIHdpZGdldE5hbWUsIHNraW4gPSAnZGVmYXVsdCcpID0+IHtcbiAgICBpZiAoIShjbGFzc05hbWUgfHwgd2lkZ2V0TmFtZSkpIHtcbiAgICAgICAgcmV0dXJuO1xuICAgIH1cblxuICAgIC8qKlxuICAgICAqIEJlY2F1c2UgRWxlbWVudG9yIHBsdWdpbiB1c2VzIGpRdWVyeSBjdXN0b20gZXZlbnQsXG4gICAgICogV2UgYWxzbyBoYXZlIHRvIHVzZSBqUXVlcnkgdG8gdXNlIHRoaXMgZXZlbnRcbiAgICAgKi9cbiAgICBqUXVlcnkod2luZG93KS5vbignZWxlbWVudG9yL2Zyb250ZW5kL2luaXQnLCAoKSA9PiB7XG4gICAgICAgIGNvbnN0IGFkZEhhbmRsZXIgPSAoJGVsZW1lbnQpID0+IHtcbiAgICAgICAgICAgIGVsZW1lbnRvckZyb250ZW5kLmVsZW1lbnRzSGFuZGxlci5hZGRIYW5kbGVyKGNsYXNzTmFtZSwge1xuICAgICAgICAgICAgICAgICRlbGVtZW50LFxuICAgICAgICAgICAgfSk7XG4gICAgICAgIH07XG5cbiAgICAgICAgZWxlbWVudG9yRnJvbnRlbmQuaG9va3MuYWRkQWN0aW9uKGBmcm9udGVuZC9lbGVtZW50X3JlYWR5LyR7d2lkZ2V0TmFtZX0uJHtza2lufWAsIGFkZEhhbmRsZXIpO1xuICAgIH0pO1xufTtcbiIsImltcG9ydCB7IHJlZ2lzdGVyV2lkZ2V0IH0gZnJvbSAnLi4vbGliL3V0aWxzJztcblxuZXhwb3J0IGNvbnN0IHNsaWRlVXAgPSAoZWxlbWVudCwgZHVyYXRpb24gPSAzMDApID0+IHtcbiAgICBlbGVtZW50LnN0eWxlLmJveFNpemluZyA9ICdib3JkZXItYm94JztcbiAgICBlbGVtZW50LnN0eWxlLnRyYW5zaXRpb25Qcm9wZXJ0eSA9ICdoZWlnaHQsIG1hcmdpbiwgcGFkZGluZyc7XG4gICAgZWxlbWVudC5zdHlsZS50cmFuc2l0aW9uRHVyYXRpb24gPSBgJHtkdXJhdGlvbn1tc2A7XG4gICAgZWxlbWVudC5zdHlsZS5oZWlnaHQgPSBgJHtlbGVtZW50Lm9mZnNldEhlaWdodH1weGA7XG4gICAgZWxlbWVudC5zdHlsZS5wYWRkaW5nVG9wID0gMDtcbiAgICBlbGVtZW50LnN0eWxlLnBhZGRpbmdCb3R0b20gPSAwO1xuICAgIGVsZW1lbnQuc3R5bGUubWFyZ2luVG9wID0gMDtcbiAgICBlbGVtZW50LnN0eWxlLm1hcmdpbkJvdHRvbSA9IDA7XG4gICAgZWxlbWVudC5zdHlsZS5vdmVyZmxvdyA9ICdoaWRkZW4nO1xuXG4gICAgc2V0VGltZW91dCgoKSA9PiB7XG4gICAgICAgIGVsZW1lbnQuc3R5bGUuaGVpZ2h0ID0gMDtcbiAgICB9LCAxMCk7XG5cbiAgICB3aW5kb3cuc2V0VGltZW91dCgoKSA9PiB7XG4gICAgICAgIGVsZW1lbnQuc3R5bGUuZGlzcGxheSA9ICdub25lJztcbiAgICAgICAgZWxlbWVudC5zdHlsZS5yZW1vdmVQcm9wZXJ0eSgnaGVpZ2h0Jyk7XG4gICAgICAgIGVsZW1lbnQuc3R5bGUucmVtb3ZlUHJvcGVydHkoJ3BhZGRpbmctdG9wJyk7XG4gICAgICAgIGVsZW1lbnQuc3R5bGUucmVtb3ZlUHJvcGVydHkoJ3BhZGRpbmctYm90dG9tJyk7XG4gICAgICAgIGVsZW1lbnQuc3R5bGUucmVtb3ZlUHJvcGVydHkoJ21hcmdpbi10b3AnKTtcbiAgICAgICAgZWxlbWVudC5zdHlsZS5yZW1vdmVQcm9wZXJ0eSgnbWFyZ2luLWJvdHRvbScpO1xuICAgICAgICBlbGVtZW50LnN0eWxlLnJlbW92ZVByb3BlcnR5KCdvdmVyZmxvdycpO1xuICAgICAgICBlbGVtZW50LnN0eWxlLnJlbW92ZVByb3BlcnR5KCd0cmFuc2l0aW9uLWR1cmF0aW9uJyk7XG4gICAgICAgIGVsZW1lbnQuc3R5bGUucmVtb3ZlUHJvcGVydHkoJ3RyYW5zaXRpb24tcHJvcGVydHknKTtcbiAgICB9LCBkdXJhdGlvbik7XG59O1xuXG5leHBvcnQgY29uc3Qgc2xpZGVEb3duID0gKGVsZW1lbnQsIGR1cmF0aW9uID0gMzAwKSA9PiB7XG4gICAgZWxlbWVudC5zdHlsZS5yZW1vdmVQcm9wZXJ0eSgnZGlzcGxheScpO1xuXG4gICAgbGV0IGRpc3BsYXkgPSB3aW5kb3cuZ2V0Q29tcHV0ZWRTdHlsZShlbGVtZW50KS5kaXNwbGF5O1xuXG4gICAgaWYgKGRpc3BsYXkgPT09ICdub25lJykge1xuICAgICAgICBkaXNwbGF5ID0gJ2Jsb2NrJztcbiAgICB9XG5cbiAgICBlbGVtZW50LnN0eWxlLmRpc3BsYXkgPSBkaXNwbGF5O1xuXG4gICAgbGV0IGhlaWdodCA9IGVsZW1lbnQub2Zmc2V0SGVpZ2h0O1xuICAgIGxldCBwYWRkaW5nVG9wID0gd2luZG93LmdldENvbXB1dGVkU3R5bGUoZWxlbWVudCkucGFkZGluZ1RvcDtcbiAgICBsZXQgcGFkZGluZ0JvdHRvbSA9IHdpbmRvdy5nZXRDb21wdXRlZFN0eWxlKGVsZW1lbnQpLnBhZGRpbmdCb3R0b207XG4gICAgbGV0IG1hcmdpblRvcCA9IHdpbmRvdy5nZXRDb21wdXRlZFN0eWxlKGVsZW1lbnQpLm1hcmdpblRvcDtcbiAgICBsZXQgbWFyZ2luQm90dG9tID0gd2luZG93LmdldENvbXB1dGVkU3R5bGUoZWxlbWVudCkubWFyZ2luQm90dG9tO1xuXG4gICAgZWxlbWVudC5zdHlsZS5oZWlnaHQgPSAwO1xuICAgIGVsZW1lbnQuc3R5bGUucGFkZGluZ1RvcCA9IDA7XG4gICAgZWxlbWVudC5zdHlsZS5wYWRkaW5nQm90dG9tID0gMDtcbiAgICBlbGVtZW50LnN0eWxlLm1hcmdpblRvcCA9IDA7XG4gICAgZWxlbWVudC5zdHlsZS5tYXJnaW5Cb3R0b20gPSAwO1xuICAgIGVsZW1lbnQuc3R5bGUub3ZlcmZsb3cgPSAnaGlkZGVuJztcblxuICAgIGVsZW1lbnQuc3R5bGUuYm94U2l6aW5nID0gJ2JvcmRlci1ib3gnO1xuICAgIGVsZW1lbnQuc3R5bGUudHJhbnNpdGlvblByb3BlcnR5ID0gJ2hlaWdodCc7XG4gICAgZWxlbWVudC5zdHlsZS50cmFuc2l0aW9uRHVyYXRpb24gPSBgJHtkdXJhdGlvbn1tc2A7XG5cbiAgICBzZXRUaW1lb3V0KCgpID0+IHtcbiAgICAgICAgZWxlbWVudC5zdHlsZS5oZWlnaHQgPSBgJHtoZWlnaHR9cHhgO1xuICAgICAgICBpZiAocGFkZGluZ1RvcCAhPT0gJzBweCcgfHwgcGFkZGluZ0JvdHRvbSAhPT0gJzBweCcpIHtcbiAgICAgICAgICAgIGVsZW1lbnQuc3R5bGUudHJhbnNpdGlvblByb3BlcnR5ID0gJ3BhZGRpbmcnO1xuICAgICAgICAgICAgZWxlbWVudC5zdHlsZS50cmFuc2l0aW9uRHVyYXRpb24gPSBgJHtkdXJhdGlvbiAvIDEuMn1tc2A7XG4gICAgICAgICAgICBlbGVtZW50LnN0eWxlLnBhZGRpbmdUb3AgPSBwYWRkaW5nVG9wO1xuICAgICAgICAgICAgZWxlbWVudC5zdHlsZS5wYWRkaW5nQm90dG9tID0gcGFkZGluZ0JvdHRvbTtcbiAgICAgICAgICAgIGVsZW1lbnQuc3R5bGUubWFyZ2luVG9wID0gbWFyZ2luVG9wO1xuICAgICAgICAgICAgZWxlbWVudC5zdHlsZS5tYXJnaW5Cb3R0b20gPSBtYXJnaW5Cb3R0b207XG4gICAgICAgIH1cbiAgICB9LCAxMCk7XG5cbiAgICB3aW5kb3cuc2V0VGltZW91dCgoKSA9PiB7XG4gICAgICAgIGVsZW1lbnQuc3R5bGUucmVtb3ZlUHJvcGVydHkoJ2hlaWdodCcpO1xuICAgICAgICBlbGVtZW50LnN0eWxlLnJlbW92ZVByb3BlcnR5KCdvdmVyZmxvdycpO1xuICAgICAgICBlbGVtZW50LnN0eWxlLnJlbW92ZVByb3BlcnR5KCd0cmFuc2l0aW9uLWR1cmF0aW9uJyk7XG4gICAgICAgIGVsZW1lbnQuc3R5bGUucmVtb3ZlUHJvcGVydHkoJ3RyYW5zaXRpb24tcHJvcGVydHknKTtcbiAgICAgICAgZWxlbWVudC5zdHlsZS5yZW1vdmVQcm9wZXJ0eSgncGFkZGluZy10b3AnKTtcbiAgICAgICAgZWxlbWVudC5zdHlsZS5yZW1vdmVQcm9wZXJ0eSgncGFkZGluZy1ib3R0b20nKTtcbiAgICAgICAgZWxlbWVudC5zdHlsZS5yZW1vdmVQcm9wZXJ0eSgnbWFyZ2luLXRvcCcpO1xuICAgICAgICBlbGVtZW50LnN0eWxlLnJlbW92ZVByb3BlcnR5KCdtYXJnaW4tYm90dG9tJyk7XG4gICAgfSwgZHVyYXRpb24pO1xufTtcblxuZXhwb3J0IGNvbnN0IHNsaWRlVG9nZ2xlID0gKGVsZW1lbnQsIGR1cmF0aW9uKSA9PlxuICAgIHdpbmRvdy5nZXRDb21wdXRlZFN0eWxlKGVsZW1lbnQpLmRpc3BsYXkgPT09ICdub25lJyA/IHNsaWRlRG93bihlbGVtZW50LCBkdXJhdGlvbikgOiBzbGlkZVVwKGVsZW1lbnQsIGR1cmF0aW9uKTtcblxuY2xhc3MgWmV1c19BY2NvcmRpb24gZXh0ZW5kcyBlbGVtZW50b3JNb2R1bGVzLmZyb250ZW5kLmhhbmRsZXJzLkJhc2Uge1xuICAgIGdldERlZmF1bHRTZXR0aW5ncygpIHtcbiAgICAgICAgcmV0dXJuIHtcbiAgICAgICAgICAgIHNlbGVjdG9yczoge1xuICAgICAgICAgICAgICAgIGFjY29yZGlvbjogJy56ZXVzLWFjY29yZGlvbicsXG4gICAgICAgICAgICAgICAgYWNjb3JkaW9uSXRlbTogJy56ZXVzLWFjY29yZGlvbi1pdGVtJyxcbiAgICAgICAgICAgICAgICBhY2NvcmRpb25UaXRsZTogJy56ZXVzLWFjY29yZGlvbi10aXRsZScsXG4gICAgICAgICAgICAgICAgYWNjb3JkaW9uQ29udGVudDogJy56ZXVzLWFjY29yZGlvbi1jb250ZW50JyxcbiAgICAgICAgICAgIH0sXG4gICAgICAgICAgICBjbGFzc2VzOiB7XG4gICAgICAgICAgICAgICAgYWN0aXZlOiAnemV1cy1hY3RpdmUnLFxuICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIGFjdGl2ZUl0ZW1JbmRleDogbnVsbCxcbiAgICAgICAgICAgIG11bHRpRXhwYW5kOiBmYWxzZSxcbiAgICAgICAgfTtcbiAgICB9XG5cbiAgICBnZXREZWZhdWx0RWxlbWVudHMoKSB7XG4gICAgICAgIGNvbnN0IGVsZW1lbnQgPSB0aGlzLiRlbGVtZW50LmdldCgwKTtcbiAgICAgICAgY29uc3Qgc2VsZWN0b3JzID0gdGhpcy5nZXRTZXR0aW5ncygnc2VsZWN0b3JzJyk7XG5cbiAgICAgICAgcmV0dXJuIHtcbiAgICAgICAgICAgIGFjY29yZGlvbjogZWxlbWVudC5xdWVyeVNlbGVjdG9yKHNlbGVjdG9ycy5hY2NvcmRpb24pLFxuICAgICAgICAgICAgYWNjb3JkaW9uSXRlbXM6IGVsZW1lbnQucXVlcnlTZWxlY3RvckFsbChzZWxlY3RvcnMuYWNjb3JkaW9uSXRlbSksXG4gICAgICAgICAgICBhY2NvcmRpb25UaXRsZXM6IGVsZW1lbnQucXVlcnlTZWxlY3RvckFsbChzZWxlY3RvcnMuYWNjb3JkaW9uVGl0bGUpLFxuICAgICAgICAgICAgYWNjb3JkaW9uQ29udGVudHM6IGVsZW1lbnQucXVlcnlTZWxlY3RvckFsbChzZWxlY3RvcnMuYWNjb3JkaW9uQ29udGVudCksXG4gICAgICAgIH07XG4gICAgfVxuXG4gICAgb25Jbml0KC4uLmFyZ3MpIHtcbiAgICAgICAgc3VwZXIub25Jbml0KC4uLmFyZ3MpO1xuXG4gICAgICAgIHRoaXMuc2V0VXNlclNldHRpbmdzKCk7XG4gICAgICAgIHRoaXMuYWN0aXZhdGVEZWZhdWx0SXRlbSgpO1xuICAgIH1cblxuICAgIHNldFVzZXJTZXR0aW5ncygpIHtcbiAgICAgICAgY29uc3Qgc2V0dGluZ3MgPSB0aGlzLmdldFNldHRpbmdzKCk7XG4gICAgICAgIGNvbnN0IHVzZXJTZXR0aW5ncyA9IEpTT04ucGFyc2UodGhpcy5lbGVtZW50cy5hY2NvcmRpb24uZ2V0QXR0cmlidXRlKCdkYXRhLXNldHRpbmdzJykpO1xuXG4gICAgICAgIHRoaXMuc2V0U2V0dGluZ3Moe1xuICAgICAgICAgICAgYWN0aXZlSXRlbUluZGV4OiAhIXVzZXJTZXR0aW5ncy5hY3RpdmVfaXRlbSA/IHVzZXJTZXR0aW5ncy5hY3RpdmVfaXRlbSA6IHNldHRpbmdzLmFjdGl2ZUl0ZW1JbmRleCxcbiAgICAgICAgICAgIG11bHRpRXhwYW5kOiAhIXVzZXJTZXR0aW5ncy5tdWx0aXBsZSA/IEpTT04ucGFyc2UodXNlclNldHRpbmdzLm11bHRpcGxlKSA6IHNldHRpbmdzLm11bHRpRXhwYW5kLFxuICAgICAgICB9KTtcbiAgICB9XG5cbiAgICBhY3RpdmF0ZURlZmF1bHRJdGVtKCkge1xuICAgICAgICBjb25zdCBzZXR0aW5ncyA9IHRoaXMuZ2V0U2V0dGluZ3MoKTtcbiAgICAgICAgY29uc3Qgc2VsZWN0b3JzID0gc2V0dGluZ3Muc2VsZWN0b3JzO1xuICAgICAgICBjb25zdCBhY3RpdmVJdGVtSW5kZXggPSBzZXR0aW5ncy5hY3RpdmVJdGVtSW5kZXg7XG4gICAgICAgIGNvbnN0IGFjdGl2ZUNsYXNzID0gc2V0dGluZ3MuY2xhc3Nlcy5hY3RpdmU7XG5cbiAgICAgICAgaWYgKCFhY3RpdmVJdGVtSW5kZXgpIHtcbiAgICAgICAgICAgIHJldHVybjtcbiAgICAgICAgfVxuXG4gICAgICAgIGNvbnN0IGFjdGl2ZUFjY29yZGlvbkl0ZW0gPSB0aGlzLmVsZW1lbnRzLmFjY29yZGlvbi5xdWVyeVNlbGVjdG9yKFxuICAgICAgICAgICAgYCR7c2VsZWN0b3JzLmFjY29yZGlvbkl0ZW19Om50aC1jaGlsZCgke2FjdGl2ZUl0ZW1JbmRleH0pYFxuICAgICAgICApO1xuXG4gICAgICAgIGFjdGl2ZUFjY29yZGlvbkl0ZW0uY2xhc3NMaXN0LnJlbW92ZShhY3RpdmVDbGFzcyk7XG5cbiAgICAgICAgdGhpcy5jaGFuZ2VBY3RpdmVJdGVtKGFjdGl2ZUFjY29yZGlvbkl0ZW0pO1xuICAgIH1cblxuICAgIGJpbmRFdmVudHMoKSB7XG4gICAgICAgIHRoaXMuZWxlbWVudHMuYWNjb3JkaW9uVGl0bGVzLmZvckVhY2goKGFjY29yZGlvblRpdGxlKSA9PiB7XG4gICAgICAgICAgICBhY2NvcmRpb25UaXRsZS5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsIHRoaXMub25UaXRsZUNsaWNrLmJpbmQodGhpcykpO1xuICAgICAgICB9KTtcbiAgICB9XG5cbiAgICBvblRpdGxlQ2xpY2soZXZlbnQpIHtcbiAgICAgICAgY29uc3QgZW5hYmxlTXVsdGlFeHBhbmQgPSB0aGlzLmdldFNldHRpbmdzKCdtdWx0aUV4cGFuZCcpO1xuICAgICAgICBjb25zdCBhY2NvcmRpb25UaXRsZSA9IGV2ZW50LmN1cnJlbnRUYXJnZXQ7XG4gICAgICAgIGNvbnN0IGFjY29yZGlvbkl0ZW0gPSBhY2NvcmRpb25UaXRsZS5wYXJlbnROb2RlO1xuXG4gICAgICAgIGlmICghIWVuYWJsZU11bHRpRXhwYW5kKSB7XG4gICAgICAgICAgICB0aGlzLnRvZ2dsZU11bHRpRXhwYW5kSXRlbShhY2NvcmRpb25JdGVtKTtcbiAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgIHRoaXMuY2hhbmdlQWN0aXZlSXRlbShhY2NvcmRpb25JdGVtKTtcbiAgICAgICAgfVxuICAgIH1cblxuICAgIHRvZ2dsZU11bHRpRXhwYW5kSXRlbShhY2NvcmRpb25JdGVtKSB7XG4gICAgICAgIGNvbnN0IGFjdGl2ZUNsYXNzID0gdGhpcy5nZXRTZXR0aW5ncygnY2xhc3Nlcy5hY3RpdmUnKTtcbiAgICAgICAgY29uc3QgYWNjb3JkaW9uQ29udGVudCA9IHRoaXMuZ2V0QWNjb3JkaW9uQ29udGVudChhY2NvcmRpb25JdGVtKTtcblxuICAgICAgICBhY2NvcmRpb25JdGVtLmNsYXNzTGlzdC50b2dnbGUoYWN0aXZlQ2xhc3MpO1xuICAgICAgICBzbGlkZVRvZ2dsZShhY2NvcmRpb25Db250ZW50LCAzMDApO1xuICAgIH1cblxuICAgIGNoYW5nZUFjdGl2ZUl0ZW0oYWNjb3JkaW9uSXRlbSkge1xuICAgICAgICBpZiAodGhpcy5pc0FjdGl2ZUl0ZW0oYWNjb3JkaW9uSXRlbSkpIHtcbiAgICAgICAgICAgIHRoaXMuZGVhY3RpdmVJdGVtKGFjY29yZGlvbkl0ZW0pO1xuICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgdGhpcy5lbGVtZW50cy5hY2NvcmRpb25JdGVtcy5mb3JFYWNoKChfYWNjb3JkaW9uSXRlbSkgPT4ge1xuICAgICAgICAgICAgICAgIGlmIChfYWNjb3JkaW9uSXRlbSAhPT0gYWNjb3JkaW9uSXRlbSkge1xuICAgICAgICAgICAgICAgICAgICB0aGlzLmRlYWN0aXZlSXRlbShfYWNjb3JkaW9uSXRlbSk7XG4gICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgfSk7XG5cbiAgICAgICAgICAgIHRoaXMuYWN0aXZhdGVJdGVtKGFjY29yZGlvbkl0ZW0pO1xuICAgICAgICB9XG4gICAgfVxuXG4gICAgYWN0aXZhdGVJdGVtKGFjY29yZGlvbkl0ZW0pIHtcbiAgICAgICAgY29uc3QgYWN0aXZlQ2xhc3MgPSB0aGlzLmdldFNldHRpbmdzKCdjbGFzc2VzLmFjdGl2ZScpO1xuICAgICAgICBjb25zdCBhY2NvcmRpb25Db250ZW50ID0gdGhpcy5nZXRBY2NvcmRpb25Db250ZW50KGFjY29yZGlvbkl0ZW0pO1xuXG4gICAgICAgIGFjY29yZGlvbkl0ZW0uY2xhc3NMaXN0LmFkZChhY3RpdmVDbGFzcyk7XG4gICAgICAgIHNsaWRlRG93bihhY2NvcmRpb25Db250ZW50LCAzMDApO1xuICAgIH1cblxuICAgIGRlYWN0aXZlSXRlbShhY2NvcmRpb25JdGVtKSB7XG4gICAgICAgIGNvbnN0IGFjdGl2ZUNsYXNzID0gdGhpcy5nZXRTZXR0aW5ncygnY2xhc3Nlcy5hY3RpdmUnKTtcbiAgICAgICAgY29uc3QgYWNjb3JkaW9uQ29udGVudCA9IHRoaXMuZ2V0QWNjb3JkaW9uQ29udGVudChhY2NvcmRpb25JdGVtKTtcblxuICAgICAgICBhY2NvcmRpb25JdGVtLmNsYXNzTGlzdC5yZW1vdmUoYWN0aXZlQ2xhc3MpO1xuICAgICAgICBzbGlkZVVwKGFjY29yZGlvbkNvbnRlbnQsIDMwMCk7XG4gICAgfVxuXG4gICAgaXNBY3RpdmVJdGVtKGFjY29yZGlvbkl0ZW0pIHtcbiAgICAgICAgcmV0dXJuIGFjY29yZGlvbkl0ZW0uY2xhc3NMaXN0LmNvbnRhaW5zKHRoaXMuZ2V0U2V0dGluZ3MoJ2NsYXNzZXMuYWN0aXZlJykpO1xuICAgIH1cblxuICAgIGdldEFjY29yZGlvbkNvbnRlbnQoYWNjb3JkaW9uSXRlbSkge1xuICAgICAgICByZXR1cm4gYWNjb3JkaW9uSXRlbS5xdWVyeVNlbGVjdG9yKHRoaXMuZ2V0U2V0dGluZ3MoJ3NlbGVjdG9ycy5hY2NvcmRpb25Db250ZW50JykpO1xuICAgIH1cbn1cblxucmVnaXN0ZXJXaWRnZXQoWmV1c19BY2NvcmRpb24sICd6ZXVzLWFjY29yZGlvbicpO1xuIl19
