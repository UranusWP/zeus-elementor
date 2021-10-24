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
exports.fadeToggle = exports.fadeOut = exports.fadeIn = exports.navFadeOut = exports.navFadeIn = void 0;

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

var navFadeIn = function navFadeIn(element) {
  var _options = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};

  var options = {
    duration: 300,
    display: null,
    opacity: 1,
    callback: null
  };
  Object.assign(options, _options);
  element.style.opacity = 0;
  element.style.display = options.display || "block";
  setTimeout(function () {
    element.style.transition = "".concat(options.duration, "ms opacity ease");
    element.style.opacity = options.opacity;
  }, 5);
  setTimeout(function () {
    element.style.removeProperty("transition");
    !!options.callback && options.callback();
  }, options.duration + 50);
};

exports.navFadeIn = navFadeIn;

var navFadeOut = function navFadeOut(element) {
  var _options = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};

  var options = {
    duration: 300,
    display: null,
    opacity: 0,
    callback: null
  };
  Object.assign(options, _options);
  element.style.opacity = 1;
  element.style.display = options.display || "block";
  setTimeout(function () {
    element.style.transition = "".concat(options.duration, "ms opacity ease");
    element.style.opacity = options.opacity;
  }, 5);
  setTimeout(function () {
    element.style.display = "none";
    element.style.removeProperty("transition");
    !!options.callback && options.callback();
  }, options.duration + 50);
};

exports.navFadeOut = navFadeOut;

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

var fadeToggle = function fadeToggle(element) {
  var speed = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : "normal";
  var display = arguments.length > 2 ? arguments[2] : undefined;
  var callback = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : null;
  return window.getComputedStyle(element).display === "none" ? fadeIn(element, speed, display, callback) : fadeOut(element, speed, display, callback);
};

exports.fadeToggle = fadeToggle;

var Zeus_Menu = /*#__PURE__*/function (_elementorModules$fro) {
  _inherits(Zeus_Menu, _elementorModules$fro);

  var _super = _createSuper(Zeus_Menu);

  function Zeus_Menu() {
    _classCallCheck(this, Zeus_Menu);

    return _super.apply(this, arguments);
  }

  _createClass(Zeus_Menu, [{
    key: "getDefaultSettings",
    value: function getDefaultSettings() {
      return {
        selectors: {
          menuWrapper: '.zeus-menu-wrapper',
          hMenu: '.zeus-menu-layout-horizontal .zeus-menu',
          menuToggle: '.zeus-menu-toggle',
          menuToggleIcon: '.zeus-menu-toggle-icon',
          dropdownMenu: '.zeus-menu-toggle-dropdown',
          subDropdown: '.zeus-menu-layout-vertical .zeus-sub-icon, .zeus-dropdown-menu .zeus-sub-icon',
          dropdownSearch: '.zeus-searchform-menu',
          dropdownSearchLink: '.zeus-search-menu-item',
          dropdownSearchInput: '.zeus-searchform-menu input.field'
        }
      };
    }
  }, {
    key: "getDefaultElements",
    value: function getDefaultElements() {
      var element = this.$element.get(0);
      var selectors = this.getSettings('selectors');
      return {
        menuWrapper: element.querySelector(selectors.menuWrapper),
        hMenu: element.querySelectorAll(selectors.hMenu),
        menuToggle: element.querySelector(selectors.menuToggle),
        menuToggleIcon: element.querySelector(selectors.menuToggleIcon),
        dropdownMenu: element.querySelector(selectors.dropdownMenu),
        subDropdown: element.querySelectorAll(selectors.subDropdown),
        dropdownSearch: element.querySelector(selectors.dropdownSearch),
        dropdownSearchLink: element.querySelector(selectors.dropdownSearchLink),
        dropdownSearchInput: element.querySelector(selectors.dropdownSearchInput)
      };
    }
  }, {
    key: "onInit",
    value: function onInit() {
      var _get2;

      for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
        args[_key] = arguments[_key];
      }

      (_get2 = _get(_getPrototypeOf(Zeus_Menu.prototype), "onInit", this)).call.apply(_get2, [this].concat(args));

      this.setupEventListeners();
      this.fullWidthDropdown();
    }
  }, {
    key: "setupEventListeners",
    value: function setupEventListeners() {
      var _this = this;

      // Open dropdown of parent menu on hover only for the horizontal layout
      this.elements.hMenu.forEach(function (menu) {
        var parentMenuItems = menu.querySelectorAll('.menu-item-has-children');
        parentMenuItems.forEach(function (parentMenuItem) {
          parentMenuItem.addEventListener('mouseenter', _this.onParentMenuItemMouseenter.bind(_this));
          parentMenuItem.addEventListener('mouseleave', _this.onParentMenuItemMouseleave.bind(_this));
        });
      }); // Dropdown toggle

      this.elements.menuToggleIcon.addEventListener('click', this.onToggleClick.bind(this)); // Open submenu on dropdown toggle

      this.elements.subDropdown.forEach(function (toggle) {
        toggle.setAttribute('aria-expanded', 'false');

        toggle.onclick = function () {
          if (toggle.getAttribute('aria-expanded') === 'true') {
            toggle.setAttribute('aria-expanded', 'false');
            toggle.parentNode.classList.remove('zeus-dropdown-open');
            return;
          }

          toggle.setAttribute('aria-expanded', 'true');
          toggle.parentNode.classList.add('zeus-dropdown-open');
          return;
        };
      }); // Open search form

      this.elements.dropdownSearchLink.addEventListener('click', this.toggleDropdownSearch.bind(this)); // Full width dropdown

      window.addEventListener('resize', this.fullWidthDropdown.bind(this));
      window.addEventListener('orientationchange', this.fullWidthDropdown.bind(this)); // Close elements when clicking elsewhere

      document.addEventListener('click', this.onDocumentClick.bind(this)); // On sticky

      if (!document.querySelector('body').classList.contains('elementor-editor-active') && 'yes' === this.getElementSettings('is_sticky')) {
        this.onSticky();
      }
    }
  }, {
    key: "onParentMenuItemMouseenter",
    value: function onParentMenuItemMouseenter(event) {
      var parentMenuItem = event.currentTarget;
      var subMenu = parentMenuItem.querySelector('ul.sub-menu');
      parentMenuItem.classList.add('sub-hover');
      navFadeIn(subMenu);
    }
  }, {
    key: "onParentMenuItemMouseleave",
    value: function onParentMenuItemMouseleave(event) {
      var parentMenuItem = event.currentTarget;
      var subMenu = parentMenuItem.querySelector('ul.sub-menu');
      parentMenuItem.classList.remove('sub-hover');
      subMenu.style.pointerEvents = 'none';
      navFadeOut(subMenu, {
        callback: function callback() {
          subMenu.style.pointerEvents = null;
        }
      });
    }
  }, {
    key: "onToggleClick",
    value: function onToggleClick(event) {
      event.stopPropagation();
      this.elements.menuToggle.classList.toggle('zeus-active');
    }
  }, {
    key: "toggleDropdownSearch",
    value: function toggleDropdownSearch(event) {
      event.preventDefault();
      event.stopPropagation();
      fadeToggle(this.elements.dropdownSearch, 'fast');
      this.elements.dropdownSearchInput.focus();
    }
  }, {
    key: "fullWidthDropdown",
    value: function fullWidthDropdown(event) {
      this.stretchElement = new elementorModules.frontend.tools.StretchElement({
        element: this.elements.dropdownMenu
      });

      if (this.getElementSettings('dropdown_full_width')) {
        this.stretchElement.stretch();
      } else {
        this.stretchElement.reset();
      }
    }
  }, {
    key: "onSticky",
    value: function onSticky() {
      var menuWrapper = this.elements.menuWrapper;

      if (menuWrapper.hasAttribute('data-destroy-sticky')) {
        var destroyWidth = menuWrapper.getAttribute('data-destroy-sticky');

        if (window.innerWidth < destroyWidth) {
          return;
        }
      }

      var selector = menuWrapper.closest('.elementor-top-section');
      var top = selector.offsetTop; // Add sticky class

      selector.classList.add('zeus-has-sticky'); // Add wrapper

      selector.insertAdjacentHTML('beforebegin', '<span class="zeus-sticky-wrapper"></span>');
      selector.previousSibling.appendChild(selector);

      function onScroll() {
        // Admin bar offset
        var barOffset = 0;

        if (document.querySelector('body').classList.contains('admin-bar') && window.innerWidth > 600) {
          barOffset = document.getElementById('wpadminbar').offsetHeight;
        }

        if (window.scrollY >= top) {
          selector.style.position = 'fixed';
          selector.style.width = window.innerWidth + 'px';
          selector.style.top = barOffset + 'px';
          selector.style.backgroundColor = menuWrapper.getAttribute('data-background');
          selector.style.zIndex = '9999';
          menuWrapper.classList.add('zeus-is-sticky');
        } else {
          selector.style.position = '';
          selector.style.width = '';
          selector.style.top = '';
          selector.style.backgroundColor = '';
          selector.style.zIndex = '';
          menuWrapper.classList.remove('zeus-is-sticky');
        }
      }

      window.addEventListener('scroll', onScroll);
      window.addEventListener('resize', onScroll);
      window.addEventListener('orientationchange', onScroll);

      function wrapperStyle() {
        selector.parentNode.style.display = 'block';
        selector.parentNode.style.width = window.innerWidth + 'px';
        selector.parentNode.style.height = selector.offsetHeight + 'px';
      }

      window.addEventListener('load', wrapperStyle);
      window.addEventListener('resize', wrapperStyle);
      window.addEventListener('orientationchange', wrapperStyle); // Anchor links

      document.querySelectorAll('.zeus-menu-wrapper a[href*="#"]:not([href="#"])').forEach(function (link) {
        link.addEventListener('click', function (e) {
          var href = link.getAttribute('href');
          var id = href.substring(href.indexOf('#')).slice(1); // Check selector

          var validSelector = function validSelector(dummyElement) {
            return function (selector) {
              try {
                dummyElement.querySelector(selector);
              } catch (_unused) {
                return false;
              }

              return true;
            };
          };

          if (validSelector('#' + id)) {
            var targetElem = document.querySelector('#' + id);
          }

          if (id != '' && !!targetElem) {
            e.preventDefault();
            e.stopPropagation();
            var scrollPosition = targetElem.offsetTop - selector.offsetHeight;
            document.querySelector('html').scrollTo({
              top: scrollPosition,
              behavior: 'smooth'
            });
          }
        });
      });
    }
  }, {
    key: "onDocumentClick",
    value: function onDocumentClick(event) {
      if (!event.target.closest(this.getSettings('selectors.dropdownSearch'))) {
        var searchForm = this.elements.dropdownSearch;

        var fade = function fade() {
          var opacity = parseFloat(searchForm.style.opacity);

          if ((opacity -= 0.1) < 0) {
            searchForm.style.display = 'none';
          } else {
            searchForm.style.opacity = opacity;
            window.requestAnimationFrame(fade);
          }
        };

        window.requestAnimationFrame(fade);
      }

      if (!event.target.closest(this.getSettings('selectors.menuToggle'))) {
        this.elements.menuToggle.classList.remove('zeus-active');
      }
    }
  }]);

  return Zeus_Menu;
}(elementorModules.frontend.handlers.Base);

(0, _utils.registerWidget)(Zeus_Menu, 'zeus-menu');

},{"../lib/utils":1}]},{},[2])
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm5vZGVfbW9kdWxlcy9icm93c2VyLXBhY2svX3ByZWx1ZGUuanMiLCJzcmMvbGliL3V0aWxzLmpzIiwic3JjL3dpZGdldHMvbWVudS5qcyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFBQTs7Ozs7Ozs7QUNBTyxJQUFNLGNBQWMsR0FBRyxTQUFqQixjQUFpQixDQUFDLFNBQUQsRUFBWSxVQUFaLEVBQTZDO0FBQUEsTUFBckIsSUFBcUIsdUVBQWQsU0FBYzs7QUFDdkUsTUFBSSxFQUFFLFNBQVMsSUFBSSxVQUFmLENBQUosRUFBZ0M7QUFDNUI7QUFDSDtBQUVEO0FBQ0o7QUFDQTtBQUNBOzs7QUFDSSxFQUFBLE1BQU0sQ0FBQyxNQUFELENBQU4sQ0FBZSxFQUFmLENBQWtCLHlCQUFsQixFQUE2QyxZQUFNO0FBQy9DLFFBQU0sVUFBVSxHQUFHLFNBQWIsVUFBYSxDQUFDLFFBQUQsRUFBYztBQUM3QixNQUFBLGlCQUFpQixDQUFDLGVBQWxCLENBQWtDLFVBQWxDLENBQTZDLFNBQTdDLEVBQXdEO0FBQ3BELFFBQUEsUUFBUSxFQUFSO0FBRG9ELE9BQXhEO0FBR0gsS0FKRDs7QUFNQSxJQUFBLGlCQUFpQixDQUFDLEtBQWxCLENBQXdCLFNBQXhCLGtDQUE0RCxVQUE1RCxjQUEwRSxJQUExRSxHQUFrRixVQUFsRjtBQUNILEdBUkQ7QUFTSCxDQWxCTTs7Ozs7Ozs7Ozs7Ozs7QUNBUDs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7QUFFTyxJQUFNLFNBQVMsR0FBRyxTQUFaLFNBQVksQ0FBQyxPQUFELEVBQTRCO0FBQUEsTUFBbEIsUUFBa0IsdUVBQVAsRUFBTzs7QUFDakQsTUFBTSxPQUFPLEdBQUc7QUFDWixJQUFBLFFBQVEsRUFBRSxHQURFO0FBRVosSUFBQSxPQUFPLEVBQUUsSUFGRztBQUdaLElBQUEsT0FBTyxFQUFFLENBSEc7QUFJWixJQUFBLFFBQVEsRUFBRTtBQUpFLEdBQWhCO0FBT0EsRUFBQSxNQUFNLENBQUMsTUFBUCxDQUFjLE9BQWQsRUFBdUIs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LE1BQTNCO0FBQ0gsV0FGRCxNQUVPO0FBQ0gsWUFBQSxVQUFVLENBQUMsS0FBWCxDQUFpQixPQUFqQixHQUEyQixPQUEzQjtBQUVBLFlBQUEsTUFBTSxDQUFDLHFCQUFQLENBQTZCLElBQTdCO0FBQ0g7QUFDSixTQVZEOztBQVlBLFFBQUEsTUFBTSxDQUFDLHFCQUFQLENBQTZCLElBQTdCO0FBQ0g7O0FBRUQsVUFBSSxDQUFDLEtBQUssQ0FBQyxNQUFOLENBQWEsT0FBYixDQUFxQixLQUFLLFdBQUwsQ0FBaUIsc0JBQWpCLENBQXJCLENBQUwsRUFBcUU7QUFDakUsYUFBSyxRQUFMLENBQWMsVUFBZCxDQUF5QixTQUF6QixDQUFtQyxNQUFuQyxDQUEwQyxhQUExQztBQUNIO0FBQ0o7Ozs7RUFuUW1CLGdCQUFnQixDQUFDLFFBQWpCLENBQTBCLFFBQTFCLENBQW1DLEk7O0FBc1EzRCwyQkFBZSxTQUFmLEVBQTBCLFdBQTFCIiwiZmlsZSI6ImdlbmVyYXRlZC5qcyIsInNvdXJjZVJvb3QiOiIiLCJzb3VyY2VzQ29udGVudCI6WyIoZnVuY3Rpb24oKXtmdW5jdGlvbiByKGUsbix0KXtmdW5jdGlvbiBvKGksZil7aWYoIW5baV0pe2lmKCFlW2ldKXt2YXIgYz1cImZ1bmN0aW9uXCI9PXR5cGVvZiByZXF1aXJlJiZyZXF1aXJlO2lmKCFmJiZjKXJldHVybiBjKGksITApO2lmKHUpcmV0dXJuIHUoaSwhMCk7dmFyIGE9bmV3IEVycm9yKFwiQ2Fubm90IGZpbmQgbW9kdWxlICdcIitpK1wiJ1wiKTt0aHJvdyBhLmNvZGU9XCJNT0RVTEVfTk9UX0ZPVU5EXCIsYX12YXIgcD1uW2ldPXtleHBvcnRzOnt9fTtlW2ldWzBdLmNhbGwocC5leHBvcnRzLGZ1bmN0aW9uKHIpe3ZhciBuPWVbaV1bMV1bcl07cmV0dXJuIG8obnx8cil9LHAscC5leHBvcnRzLHIsZSxuLHQpfXJldHVybiBuW2ldLmV4cG9ydHN9Zm9yKHZhciB1PVwiZnVuY3Rpb25cIj09dHlwZW9mIHJlcXVpcmUmJnJlcXVpcmUsaT0wO2k8dC5sZW5ndGg7aSsrKW8odFtpXSk7cmV0dXJuIG99cmV0dXJuIHJ9KSgpIiwiZXhwb3J0IGNvbnN0IHJlZ2lzdGVyV2lkZ2V0ID0gKGNsYXNzTmFtZSwgd2lkZ2V0TmFtZSwgc2tpbiA9ICdkZWZhdWx0JykgPT4ge1xuICAgIGlmICghKGNsYXNzTmFtZSB8fCB3aWRnZXROYW1lKSkge1xuICAgICAgICByZXR1cm47XG4gICAgfVxuXG4gICAgLyoqXG4gICAgICogQmVjYXVzZSBFbGVtZW50b3IgcGx1Z2luIHVzZXMgalF1ZXJ5IGN1c3RvbSBldmVudCxcbiAgICAgKiBXZSBhbHNvIGhhdmUgdG8gdXNlIGpRdWVyeSB0byB1c2UgdGhpcyBldmVudFxuICAgICAqL1xuICAgIGpRdWVyeSh3aW5kb3cpLm9uKCdlbGVtZW50b3IvZnJvbnRlbmQvaW5pdCcsICgpID0+IHtcbiAgICAgICAgY29uc3QgYWRkSGFuZGxlciA9ICgkZWxlbWVudCkgPT4ge1xuICAgICAgICAgICAgZWxlbWVudG9yRnJvbnRlbmQuZWxlbWVudHNIYW5kbGVyLmFkZEhhbmRsZXIoY2xhc3NOYW1lLCB7XG4gICAgICAgICAgICAgICAgJGVsZW1lbnQsXG4gICAgICAgICAgICB9KTtcbiAgICAgICAgfTtcblxuICAgICAgICBlbGVtZW50b3JGcm9udGVuZC5ob29rcy5hZGRBY3Rpb24oYGZyb250ZW5kL2VsZW1lbnRfcmVhZHkvJHt3aWRnZXROYW1lfS4ke3NraW59YCwgYWRkSGFuZGxlcik7XG4gICAgfSk7XG59O1xuIiwiaW1wb3J0IHsgcmVnaXN0ZXJXaWRnZXQgfSBmcm9tICcuLi9saWIvdXRpbHMnO1xuXG5leHBvcnQgY29uc3QgbmF2RmFkZUluID0gKGVsZW1lbnQsIF9vcHRpb25zID0ge30pID0+IHtcbiAgICBjb25zdCBvcHRpb25zID0ge1xuICAgICAgICBkdXJhdGlvbjogMzAwLFxuICAgICAgICBkaXNwbGF5OiBudWxsLFxuICAgICAgICBvcGFjaXR5OiAxLFxuICAgICAgICBjYWxsYmFjazogbnVsbCxcbiAgICB9O1xuXG4gICAgT2JqZWN0LmFzc2lnbihvcHRpb25zLCBfb3B0aW9ucyk7XG5cbiAgICBlbGVtZW50LnN0eWxlLm9wYWNpdHkgPSAwO1xuICAgIGVsZW1lbnQuc3R5bGUuZGlzcGxheSA9IG9wdGlvbnMuZGlzcGxheSB8fCBcImJsb2NrXCI7XG5cbiAgICBzZXRUaW1lb3V0KCgpID0+IHtcbiAgICAgICAgZWxlbWVudC5zdHlsZS50cmFuc2l0aW9uID0gYCR7b3B0aW9ucy5kdXJhdGlvbn1tcyBvcGFjaXR5IGVhc2VgO1xuICAgICAgICBlbGVtZW50LnN0eWxlLm9wYWNpdHkgPSBvcHRpb25zLm9wYWNpdHk7XG4gICAgfSwgNSk7XG5cbiAgICBzZXRUaW1lb3V0KCgpID0+IHtcbiAgICAgICAgZWxlbWVudC5zdHlsZS5yZW1vdmVQcm9wZXJ0eShcInRyYW5zaXRpb25cIik7XG4gICAgICAgICEhb3B0aW9ucy5jYWxsYmFjayAmJiBvcHRpb25zLmNhbGxiYWNrKCk7XG4gICAgfSwgb3B0aW9ucy5kdXJhdGlvbiArIDUwKTtcbn07XG5cbmV4cG9ydCBjb25zdCBuYXZGYWRlT3V0ID0gKGVsZW1lbnQsIF9vcHRpb25zID0ge30pID0+IHtcbiAgICBjb25zdCBvcHRpb25zID0ge1xuICAgICAgICBkdXJhdGlvbjogMzAwLFxuICAgICAgICBkaXNwbGF5OiBudWxsLFxuICAgICAgICBvcGFjaXR5OiAwLFxuICAgICAgICBjYWxsYmFjazogbnVsbCxcbiAgICB9O1xuXG4gICAgT2JqZWN0LmFzc2lnbihvcHRpb25zLCBfb3B0aW9ucyk7XG5cbiAgICBlbGVtZW50LnN0eWxlLm9wYWNpdHkgPSAxO1xuICAgIGVsZW1lbnQuc3R5bGUuZGlzcGxheSA9IG9wdGlvbnMuZGlzcGxheSB8fCBcImJsb2NrXCI7XG5cbiAgICBzZXRUaW1lb3V0KCgpID0+IHtcbiAgICAgICAgZWxlbWVudC5zdHlsZS50cmFuc2l0aW9uID0gYCR7b3B0aW9ucy5kdXJhdGlvbn1tcyBvcGFjaXR5IGVhc2VgO1xuICAgICAgICBlbGVtZW50LnN0eWxlLm9wYWNpdHkgPSBvcHRpb25zLm9wYWNpdHk7XG4gICAgfSwgNSk7XG5cbiAgICBzZXRUaW1lb3V0KCgpID0+IHtcbiAgICAgICAgZWxlbWVudC5zdHlsZS5kaXNwbGF5ID0gXCJub25lXCI7XG4gICAgICAgIGVsZW1lbnQuc3R5bGUucmVtb3ZlUHJvcGVydHkoXCJ0cmFuc2l0aW9uXCIpO1xuICAgICAgICAhIW9wdGlvbnMuY2FsbGJhY2sgJiYgb3B0aW9ucy5jYWxsYmFjaygpO1xuICAgIH0sIG9wdGlvbnMuZHVyYXRpb24gKyA1MCk7XG59O1xuXG5leHBvcnQgY29uc3QgZmFkZUluID0gKGVsZW1lbnQsIHNwZWVkID0gXCJub3JtYWxcIiwgZGlzcGxheSwgY2FsbGJhY2sgPSBudWxsKSA9PiB7XG4gICAgZWxlbWVudC5zdHlsZS5vcGFjaXR5ID0gMDtcbiAgICBlbGVtZW50LnN0eWxlLmRpc3BsYXkgPSBkaXNwbGF5IHx8IFwiYmxvY2tcIjtcblxuICAgIGNvbnN0IGZhZGUgPSAoKSA9PiB7XG4gICAgICAgIGxldCBvcGFjaXR5ID0gcGFyc2VGbG9hdChlbGVtZW50LnN0eWxlLm9wYWNpdHkpO1xuXG4gICAgICAgIGlmICgob3BhY2l0eSArPSBzcGVlZCA9PT0gXCJmYXN0XCIgPyAwLjIgOiAwLjEpIDw9IDEpIHtcbiAgICAgICAgICAgIGVsZW1lbnQuc3R5bGUub3BhY2l0eSA9IG9wYWNpdHk7XG5cbiAgICAgICAgICAgIGlmIChvcGFjaXR5ID09PSAxICYmIGNhbGxiYWNrKSB7XG4gICAgICAgICAgICAgICAgY2FsbGJhY2soKTtcbiAgICAgICAgICAgIH1cblxuICAgICAgICAgICAgd2luZG93LnJlcXVlc3RBbmltYXRpb25GcmFtZShmYWRlKTtcbiAgICAgICAgfVxuICAgIH07XG5cbiAgICB3aW5kb3cucmVxdWVzdEFuaW1hdGlvbkZyYW1lKGZhZGUpO1xufTtcblxuZXhwb3J0IGNvbnN0IGZhZGVPdXQgPSAoZWxlbWVudCwgc3BlZWQgPSBcIm5vcm1hbFwiLCBkaXNwbGF5LCBjYWxsYmFjayA9IG51bGwpID0+IHtcbiAgICBlbGVtZW50LnN0eWxlLm9wYWNpdHkgPSAxO1xuICAgIGVsZW1lbnQuc3R5bGUuZGlzcGxheSA9IGRpc3BsYXkgfHwgXCJibG9ja1wiO1xuXG4gICAgY29uc3QgZmFkZSA9ICgpID0+IHtcbiAgICAgICAgbGV0IG9wYWNpdHkgPSBwYXJzZUZsb2F0KGVsZW1lbnQuc3R5bGUub3BhY2l0eSk7XG5cbiAgICAgICAgaWYgKChvcGFjaXR5IC09IHNwZWVkID09PSBcImZhc3RcIiA/IDAuMiA6IDAuMSkgPCAwKSB7XG4gICAgICAgICAgICBlbGVtZW50LnN0eWxlLmRpc3BsYXkgPSBcIm5vbmVcIjtcbiAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgIGVsZW1lbnQuc3R5bGUub3BhY2l0eSA9IG9wYWNpdHk7XG5cbiAgICAgICAgICAgIGlmIChvcGFjaXR5ID09PSAwICYmIGNhbGxiYWNrKSB7XG4gICAgICAgICAgICAgICAgY2FsbGJhY2soKTtcbiAgICAgICAgICAgIH1cblxuICAgICAgICAgICAgd2luZG93LnJlcXVlc3RBbmltYXRpb25GcmFtZShmYWRlKTtcbiAgICAgICAgfVxuICAgIH07XG5cbiAgICB3aW5kb3cucmVxdWVzdEFuaW1hdGlvbkZyYW1lKGZhZGUpO1xufTtcblxuZXhwb3J0IGNvbnN0IGZhZGVUb2dnbGUgPSAoZWxlbWVudCwgc3BlZWQgPSBcIm5vcm1hbFwiLCBkaXNwbGF5LCBjYWxsYmFjayA9IG51bGwpID0+XG4gICAgd2luZG93LmdldENvbXB1dGVkU3R5bGUoZWxlbWVudCkuZGlzcGxheSA9PT0gXCJub25lXCJcbiAgICAgICAgPyBmYWRlSW4oZWxlbWVudCwgc3BlZWQsIGRpc3BsYXksIGNhbGxiYWNrKVxuICAgICAgICA6IGZhZGVPdXQoZWxlbWVudCwgc3BlZWQsIGRpc3BsYXksIGNhbGxiYWNrKTtcblxuY2xhc3MgWmV1c19NZW51IGV4dGVuZHMgZWxlbWVudG9yTW9kdWxlcy5mcm9udGVuZC5oYW5kbGVycy5CYXNlIHtcbiAgICBnZXREZWZhdWx0U2V0dGluZ3MoKSB7XG4gICAgICAgIHJldHVybiB7XG4gICAgICAgICAgICBzZWxlY3RvcnM6IHtcbiAgICAgICAgICAgICAgICBtZW51V3JhcHBlcjogJy56ZXVzLW1lbnUtd3JhcHBlcicsXG4gICAgICAgICAgICAgICAgaE1lbnU6ICcuemV1cy1tZW51LWxheW91dC1ob3Jpem9udGFsIC56ZXVzLW1lbnUnLFxuICAgICAgICAgICAgICAgIG1lbnVUb2dnbGU6ICcuemV1cy1tZW51LXRvZ2dsZScsXG4gICAgICAgICAgICAgICAgbWVudVRvZ2dsZUljb246ICcuemV1cy1tZW51LXRvZ2dsZS1pY29uJyxcbiAgICAgICAgICAgICAgICBkcm9wZG93bk1lbnU6ICcuemV1cy1tZW51LXRvZ2dsZS1kcm9wZG93bicsXG4gICAgICAgICAgICAgICAgc3ViRHJvcGRvd246ICcuemV1cy1tZW51LWxheW91dC12ZXJ0aWNhbCAuemV1cy1zdWItaWNvbiwgLnpldXMtZHJvcGRvd24tbWVudSAuemV1cy1zdWItaWNvbicsXG4gICAgICAgICAgICAgICAgZHJvcGRvd25TZWFyY2g6ICcuemV1cy1zZWFyY2hmb3JtLW1lbnUnLFxuICAgICAgICAgICAgICAgIGRyb3Bkb3duU2VhcmNoTGluazogJy56ZXVzLXNlYXJjaC1tZW51LWl0ZW0nLFxuICAgICAgICAgICAgICAgIGRyb3Bkb3duU2VhcmNoSW5wdXQ6ICcuemV1cy1zZWFyY2hmb3JtLW1lbnUgaW5wdXQuZmllbGQnLFxuICAgICAgICAgICAgfSxcbiAgICAgICAgfTtcbiAgICB9XG5cbiAgICBnZXREZWZhdWx0RWxlbWVudHMoKSB7XG4gICAgICAgIGNvbnN0IGVsZW1lbnQgPSB0aGlzLiRlbGVtZW50LmdldCgwKTtcbiAgICAgICAgY29uc3Qgc2VsZWN0b3JzID0gdGhpcy5nZXRTZXR0aW5ncygnc2VsZWN0b3JzJyk7XG5cbiAgICAgICAgcmV0dXJuIHtcbiAgICAgICAgICAgIG1lbnVXcmFwcGVyOiBlbGVtZW50LnF1ZXJ5U2VsZWN0b3Ioc2VsZWN0b3JzLm1lbnVXcmFwcGVyKSxcbiAgICAgICAgICAgIGhNZW51OiBlbGVtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoc2VsZWN0b3JzLmhNZW51KSxcbiAgICAgICAgICAgIG1lbnVUb2dnbGU6IGVsZW1lbnQucXVlcnlTZWxlY3RvcihzZWxlY3RvcnMubWVudVRvZ2dsZSksXG4gICAgICAgICAgICBtZW51VG9nZ2xlSWNvbjogZWxlbWVudC5xdWVyeVNlbGVjdG9yKHNlbGVjdG9ycy5tZW51VG9nZ2xlSWNvbiksXG4gICAgICAgICAgICBkcm9wZG93bk1lbnU6IGVsZW1lbnQucXVlcnlTZWxlY3RvcihzZWxlY3RvcnMuZHJvcGRvd25NZW51KSxcbiAgICAgICAgICAgIHN1YkRyb3Bkb3duOiBlbGVtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoc2VsZWN0b3JzLnN1YkRyb3Bkb3duKSxcbiAgICAgICAgICAgIGRyb3Bkb3duU2VhcmNoOiBlbGVtZW50LnF1ZXJ5U2VsZWN0b3Ioc2VsZWN0b3JzLmRyb3Bkb3duU2VhcmNoKSxcbiAgICAgICAgICAgIGRyb3Bkb3duU2VhcmNoTGluazogZWxlbWVudC5xdWVyeVNlbGVjdG9yKHNlbGVjdG9ycy5kcm9wZG93blNlYXJjaExpbmspLFxuICAgICAgICAgICAgZHJvcGRvd25TZWFyY2hJbnB1dDogZWxlbWVudC5xdWVyeVNlbGVjdG9yKHNlbGVjdG9ycy5kcm9wZG93blNlYXJjaElucHV0KSxcbiAgICAgICAgfTtcbiAgICB9XG5cbiAgICBvbkluaXQoLi4uYXJncykge1xuICAgICAgICBzdXBlci5vbkluaXQoLi4uYXJncyk7XG5cbiAgICAgICAgdGhpcy5zZXR1cEV2ZW50TGlzdGVuZXJzKCk7XG4gICAgICAgIHRoaXMuZnVsbFdpZHRoRHJvcGRvd24oKTtcbiAgICB9XG5cbiAgICBzZXR1cEV2ZW50TGlzdGVuZXJzKCkge1xuICAgICAgICAvLyBPcGVuIGRyb3Bkb3duIG9mIHBhcmVudCBtZW51IG9uIGhvdmVyIG9ubHkgZm9yIHRoZSBob3Jpem9udGFsIGxheW91dFxuICAgICAgICB0aGlzLmVsZW1lbnRzLmhNZW51LmZvckVhY2goKG1lbnUpID0+IHtcbiAgICAgICAgICAgIHZhciBwYXJlbnRNZW51SXRlbXMgPSBtZW51LnF1ZXJ5U2VsZWN0b3JBbGwoJy5tZW51LWl0ZW0taGFzLWNoaWxkcmVuJyk7XG4gICAgICAgICAgICBwYXJlbnRNZW51SXRlbXMuZm9yRWFjaCgocGFyZW50TWVudUl0ZW0pID0+IHtcbiAgICAgICAgICAgICAgICBwYXJlbnRNZW51SXRlbS5hZGRFdmVudExpc3RlbmVyKCdtb3VzZWVudGVyJywgdGhpcy5vblBhcmVudE1lbnVJdGVtTW91c2VlbnRlci5iaW5kKHRoaXMpKTtcbiAgICAgICAgICAgICAgICBwYXJlbnRNZW51SXRlbS5hZGRFdmVudExpc3RlbmVyKCdtb3VzZWxlYXZlJywgdGhpcy5vblBhcmVudE1lbnVJdGVtTW91c2VsZWF2ZS5iaW5kKHRoaXMpKTtcbiAgICAgICAgICAgIH0pO1xuICAgICAgICB9KTtcblxuICAgICAgICAvLyBEcm9wZG93biB0b2dnbGVcbiAgICAgICAgdGhpcy5lbGVtZW50cy5tZW51VG9nZ2xlSWNvbi5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsIHRoaXMub25Ub2dnbGVDbGljay5iaW5kKHRoaXMpKTtcblxuICAgICAgICAvLyBPcGVuIHN1Ym1lbnUgb24gZHJvcGRvd24gdG9nZ2xlXG4gICAgICAgIHRoaXMuZWxlbWVudHMuc3ViRHJvcGRvd24uZm9yRWFjaCgodG9nZ2xlKSA9PiB7XG4gICAgICAgICAgICB0b2dnbGUuc2V0QXR0cmlidXRlKCdhcmlhLWV4cGFuZGVkJywgJ2ZhbHNlJyk7XG5cbiAgICAgICAgICAgIHRvZ2dsZS5vbmNsaWNrID0gZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgICAgIGlmICh0b2dnbGUuZ2V0QXR0cmlidXRlKCdhcmlhLWV4cGFuZGVkJykgPT09ICd0cnVlJykge1xuICAgICAgICAgICAgICAgICAgICB0b2dnbGUuc2V0QXR0cmlidXRlKCdhcmlhLWV4cGFuZGVkJywgJ2ZhbHNlJyk7XG4gICAgICAgICAgICAgICAgICAgIHRvZ2dsZS5wYXJlbnROb2RlLmNsYXNzTGlzdC5yZW1vdmUoJ3pldXMtZHJvcGRvd24tb3BlbicpO1xuICAgICAgICAgICAgICAgICAgICByZXR1cm47XG4gICAgICAgICAgICAgICAgfVxuXG4gICAgICAgICAgICAgICAgdG9nZ2xlLnNldEF0dHJpYnV0ZSgnYXJpYS1leHBhbmRlZCcsICd0cnVlJyk7XG4gICAgICAgICAgICAgICAgdG9nZ2xlLnBhcmVudE5vZGUuY2xhc3NMaXN0LmFkZCgnemV1cy1kcm9wZG93bi1vcGVuJyk7XG4gICAgICAgICAgICAgICAgcmV0dXJuO1xuICAgICAgICAgICAgfVxuICAgICAgICB9KTtcblxuICAgICAgICAvLyBPcGVuIHNlYXJjaCBmb3JtXG4gICAgICAgIHRoaXMuZWxlbWVudHMuZHJvcGRvd25TZWFyY2hMaW5rLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgdGhpcy50b2dnbGVEcm9wZG93blNlYXJjaC5iaW5kKHRoaXMpKTtcblxuICAgICAgICAvLyBGdWxsIHdpZHRoIGRyb3Bkb3duXG4gICAgICAgIHdpbmRvdy5hZGRFdmVudExpc3RlbmVyKCdyZXNpemUnLCB0aGlzLmZ1bGxXaWR0aERyb3Bkb3duLmJpbmQodGhpcykpO1xuICAgICAgICB3aW5kb3cuYWRkRXZlbnRMaXN0ZW5lcignb3JpZW50YXRpb25jaGFuZ2UnLCB0aGlzLmZ1bGxXaWR0aERyb3Bkb3duLmJpbmQodGhpcykpO1xuXG4gICAgICAgIC8vIENsb3NlIGVsZW1lbnRzIHdoZW4gY2xpY2tpbmcgZWxzZXdoZXJlXG4gICAgICAgIGRvY3VtZW50LmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgdGhpcy5vbkRvY3VtZW50Q2xpY2suYmluZCh0aGlzKSk7XG5cbiAgICAgICAgLy8gT24gc3RpY2t5XG4gICAgICAgIGlmICghZG9jdW1lbnQucXVlcnlTZWxlY3RvcignYm9keScpLmNsYXNzTGlzdC5jb250YWlucygnZWxlbWVudG9yLWVkaXRvci1hY3RpdmUnKVxuICAgICAgICAgICAgJiYgJ3llcycgPT09IHRoaXMuZ2V0RWxlbWVudFNldHRpbmdzKCdpc19zdGlja3knKSkge1xuICAgICAgICAgICAgdGhpcy5vblN0aWNreSgpO1xuICAgICAgICB9XG5cbiAgICB9XG5cbiAgICBvblBhcmVudE1lbnVJdGVtTW91c2VlbnRlcihldmVudCkge1xuICAgICAgICB2YXIgcGFyZW50TWVudUl0ZW0gPSBldmVudC5jdXJyZW50VGFyZ2V0O1xuICAgICAgICB2YXIgc3ViTWVudSA9IHBhcmVudE1lbnVJdGVtLnF1ZXJ5U2VsZWN0b3IoJ3VsLnN1Yi1tZW51Jyk7XG5cbiAgICAgICAgcGFyZW50TWVudUl0ZW0uY2xhc3NMaXN0LmFkZCgnc3ViLWhvdmVyJyk7XG5cbiAgICAgICAgbmF2RmFkZUluKHN1Yk1lbnUpO1xuICAgIH1cblxuICAgIG9uUGFyZW50TWVudUl0ZW1Nb3VzZWxlYXZlKGV2ZW50KSB7XG4gICAgICAgIHZhciBwYXJlbnRNZW51SXRlbSA9IGV2ZW50LmN1cnJlbnRUYXJnZXQ7XG4gICAgICAgIHZhciBzdWJNZW51ID0gcGFyZW50TWVudUl0ZW0ucXVlcnlTZWxlY3RvcigndWwuc3ViLW1lbnUnKTtcblxuICAgICAgICBwYXJlbnRNZW51SXRlbS5jbGFzc0xpc3QucmVtb3ZlKCdzdWItaG92ZXInKTtcbiAgICAgICAgc3ViTWVudS5zdHlsZS5wb2ludGVyRXZlbnRzID0gJ25vbmUnO1xuXG4gICAgICAgIG5hdkZhZGVPdXQoc3ViTWVudSwge1xuICAgICAgICAgICAgY2FsbGJhY2s6ICgpID0+IHtcbiAgICAgICAgICAgICAgICBzdWJNZW51LnN0eWxlLnBvaW50ZXJFdmVudHMgPSBudWxsO1xuICAgICAgICAgICAgfSxcbiAgICAgICAgfSk7XG4gICAgfVxuXG4gICAgb25Ub2dnbGVDbGljayhldmVudCkge1xuICAgICAgICBldmVudC5zdG9wUHJvcGFnYXRpb24oKTtcbiAgICAgICAgdGhpcy5lbGVtZW50cy5tZW51VG9nZ2xlLmNsYXNzTGlzdC50b2dnbGUoJ3pldXMtYWN0aXZlJyk7XG4gICAgfVxuXG4gICAgdG9nZ2xlRHJvcGRvd25TZWFyY2goZXZlbnQpIHtcbiAgICAgICAgZXZlbnQucHJldmVudERlZmF1bHQoKTtcbiAgICAgICAgZXZlbnQuc3RvcFByb3BhZ2F0aW9uKCk7XG5cbiAgICAgICAgZmFkZVRvZ2dsZSh0aGlzLmVsZW1lbnRzLmRyb3Bkb3duU2VhcmNoLCAnZmFzdCcpO1xuICAgICAgICB0aGlzLmVsZW1lbnRzLmRyb3Bkb3duU2VhcmNoSW5wdXQuZm9jdXMoKTtcbiAgICB9XG5cbiAgICBmdWxsV2lkdGhEcm9wZG93bihldmVudCkge1xuICAgICAgICB0aGlzLnN0cmV0Y2hFbGVtZW50ID0gbmV3IGVsZW1lbnRvck1vZHVsZXMuZnJvbnRlbmQudG9vbHMuU3RyZXRjaEVsZW1lbnQoe1xuICAgICAgICAgIGVsZW1lbnQ6IHRoaXMuZWxlbWVudHMuZHJvcGRvd25NZW51XG4gICAgICAgIH0pO1xuXG4gICAgICAgIGlmICh0aGlzLmdldEVsZW1lbnRTZXR0aW5ncygnZHJvcGRvd25fZnVsbF93aWR0aCcpKSB7XG4gICAgICAgICAgICB0aGlzLnN0cmV0Y2hFbGVtZW50LnN0cmV0Y2goKTtcbiAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgIHRoaXMuc3RyZXRjaEVsZW1lbnQucmVzZXQoKTtcbiAgICAgICAgfVxuICAgIH1cblxuICAgIG9uU3RpY2t5KCkge1xuICAgICAgICBjb25zdCBtZW51V3JhcHBlciA9IHRoaXMuZWxlbWVudHMubWVudVdyYXBwZXI7XG5cbiAgICAgICAgaWYgKG1lbnVXcmFwcGVyLmhhc0F0dHJpYnV0ZSgnZGF0YS1kZXN0cm95LXN0aWNreScpKSB7XG4gICAgICAgICAgICBjb25zdCBkZXN0cm95V2lkdGggPSBtZW51V3JhcHBlci5nZXRBdHRyaWJ1dGUoJ2RhdGEtZGVzdHJveS1zdGlja3knKTtcblxuICAgICAgICAgICAgaWYgKHdpbmRvdy5pbm5lcldpZHRoIDwgZGVzdHJveVdpZHRoKSB7XG4gICAgICAgICAgICAgICAgcmV0dXJuO1xuICAgICAgICAgICAgfVxuICAgICAgICB9XG5cbiAgICAgICAgY29uc3Qgc2VsZWN0b3IgPSBtZW51V3JhcHBlci5jbG9zZXN0KCcuZWxlbWVudG9yLXRvcC1zZWN0aW9uJyk7XG4gICAgICAgIGxldCB0b3AgPSBzZWxlY3Rvci5vZmZzZXRUb3A7XG5cbiAgICAgICAgLy8gQWRkIHN0aWNreSBjbGFzc1xuICAgICAgICBzZWxlY3Rvci5jbGFzc0xpc3QuYWRkKCd6ZXVzLWhhcy1zdGlja3knKTtcblxuICAgICAgICAvLyBBZGQgd3JhcHBlclxuICAgICAgICBzZWxlY3Rvci5pbnNlcnRBZGphY2VudEhUTUwoJ2JlZm9yZWJlZ2luJywgJzxzcGFuIGNsYXNzPVwiemV1cy1zdGlja3ktd3JhcHBlclwiPjwvc3Bhbj4nKTtcbiAgICAgICAgc2VsZWN0b3IucHJldmlvdXNTaWJsaW5nLmFwcGVuZENoaWxkKHNlbGVjdG9yKTtcblxuICAgICAgICBmdW5jdGlvbiBvblNjcm9sbCgpIHtcblxuICAgICAgICAgICAgLy8gQWRtaW4gYmFyIG9mZnNldFxuICAgICAgICAgICAgdmFyIGJhck9mZnNldCA9IDA7XG4gICAgICAgICAgICBpZiAoZG9jdW1lbnQucXVlcnlTZWxlY3RvcignYm9keScpLmNsYXNzTGlzdC5jb250YWlucygnYWRtaW4tYmFyJykgJiYgd2luZG93LmlubmVyV2lkdGggPiA2MDApIHtcbiAgICAgICAgICAgICAgICBiYXJPZmZzZXQgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnd3BhZG1pbmJhcicpLm9mZnNldEhlaWdodDtcbiAgICAgICAgICAgIH1cblxuICAgICAgICAgICAgaWYgKCB3aW5kb3cuc2Nyb2xsWSA+PSB0b3AgKSB7XG4gICAgICAgICAgICAgICAgc2VsZWN0b3Iuc3R5bGUucG9zaXRpb24gPSAnZml4ZWQnO1xuICAgICAgICAgICAgICAgIHNlbGVjdG9yLnN0eWxlLndpZHRoID0gd2luZG93LmlubmVyV2lkdGggKyAncHgnO1xuICAgICAgICAgICAgICAgIHNlbGVjdG9yLnN0eWxlLnRvcCA9IGJhck9mZnNldCArICdweCc7XG4gICAgICAgICAgICAgICAgc2VsZWN0b3Iuc3R5bGUuYmFja2dyb3VuZENvbG9yID0gbWVudVdyYXBwZXIuZ2V0QXR0cmlidXRlKCdkYXRhLWJhY2tncm91bmQnKTtcbiAgICAgICAgICAgICAgICBzZWxlY3Rvci5zdHlsZS56SW5kZXggPSAnOTk5OSc7XG5cbiAgICAgICAgICAgICAgICBtZW51V3JhcHBlci5jbGFzc0xpc3QuYWRkKCd6ZXVzLWlzLXN0aWNreScpO1xuICAgICAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgICAgICBzZWxlY3Rvci5zdHlsZS5wb3NpdGlvbiA9ICcnO1xuICAgICAgICAgICAgICAgIHNlbGVjdG9yLnN0eWxlLndpZHRoID0gJyc7XG4gICAgICAgICAgICAgICAgc2VsZWN0b3Iuc3R5bGUudG9wID0gJyc7XG4gICAgICAgICAgICAgICAgc2VsZWN0b3Iuc3R5bGUuYmFja2dyb3VuZENvbG9yID0gJyc7XG4gICAgICAgICAgICAgICAgc2VsZWN0b3Iuc3R5bGUuekluZGV4ID0gJyc7XG5cbiAgICAgICAgICAgICAgICBtZW51V3JhcHBlci5jbGFzc0xpc3QucmVtb3ZlKCd6ZXVzLWlzLXN0aWNreScpO1xuICAgICAgICAgICAgfVxuXG4gICAgICAgIH1cblxuICAgICAgICB3aW5kb3cuYWRkRXZlbnRMaXN0ZW5lcignc2Nyb2xsJywgb25TY3JvbGwpO1xuICAgICAgICB3aW5kb3cuYWRkRXZlbnRMaXN0ZW5lcigncmVzaXplJywgb25TY3JvbGwpO1xuICAgICAgICB3aW5kb3cuYWRkRXZlbnRMaXN0ZW5lcignb3JpZW50YXRpb25jaGFuZ2UnLCBvblNjcm9sbCk7XG5cbiAgICAgICAgZnVuY3Rpb24gd3JhcHBlclN0eWxlKCkge1xuICAgICAgICAgICAgc2VsZWN0b3IucGFyZW50Tm9kZS5zdHlsZS5kaXNwbGF5ID0gJ2Jsb2NrJztcbiAgICAgICAgICAgIHNlbGVjdG9yLnBhcmVudE5vZGUuc3R5bGUud2lkdGggPSB3aW5kb3cuaW5uZXJXaWR0aCArICdweCc7XG4gICAgICAgICAgICBzZWxlY3Rvci5wYXJlbnROb2RlLnN0eWxlLmhlaWdodCA9IHNlbGVjdG9yLm9mZnNldEhlaWdodCArICdweCc7XG4gICAgICAgIH1cblxuICAgICAgICB3aW5kb3cuYWRkRXZlbnRMaXN0ZW5lcignbG9hZCcsIHdyYXBwZXJTdHlsZSk7XG4gICAgICAgIHdpbmRvdy5hZGRFdmVudExpc3RlbmVyKCdyZXNpemUnLCB3cmFwcGVyU3R5bGUpO1xuICAgICAgICB3aW5kb3cuYWRkRXZlbnRMaXN0ZW5lcignb3JpZW50YXRpb25jaGFuZ2UnLCB3cmFwcGVyU3R5bGUpO1xuXG4gICAgICAgIC8vIEFuY2hvciBsaW5rc1xuICAgICAgICBkb2N1bWVudC5xdWVyeVNlbGVjdG9yQWxsKCcuemV1cy1tZW51LXdyYXBwZXIgYVtocmVmKj1cIiNcIl06bm90KFtocmVmPVwiI1wiXSknKS5mb3JFYWNoKChsaW5rKSA9PiB7XG4gICAgICAgICAgICBsaW5rLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgZnVuY3Rpb24oZSkge1xuICAgICAgICAgICAgICAgIFxuICAgICAgICAgICAgICAgIGNvbnN0IGhyZWYgPSBsaW5rLmdldEF0dHJpYnV0ZSgnaHJlZicpO1xuICAgICAgICAgICAgICAgIGNvbnN0IGlkID0gaHJlZi5zdWJzdHJpbmcoaHJlZi5pbmRleE9mKCcjJykpLnNsaWNlKDEpO1xuXG4gICAgICAgICAgICAgICAgLy8gQ2hlY2sgc2VsZWN0b3JcbiAgICAgICAgICAgICAgICBjb25zdCB2YWxpZFNlbGVjdG9yID0gKChkdW1teUVsZW1lbnQpID0+IChzZWxlY3RvcikgPT4ge1xuICAgICAgICAgICAgICAgICAgICB0cnkge1xuICAgICAgICAgICAgICAgICAgICAgICAgZHVtbXlFbGVtZW50LnF1ZXJ5U2VsZWN0b3Ioc2VsZWN0b3IpO1xuICAgICAgICAgICAgICAgICAgICB9IGNhdGNoIHtcbiAgICAgICAgICAgICAgICAgICAgICAgIHJldHVybiBmYWxzZTtcbiAgICAgICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICAgICAgICByZXR1cm4gdHJ1ZTtcbiAgICAgICAgICAgICAgICB9KTtcblxuICAgICAgICAgICAgICAgIGlmICh2YWxpZFNlbGVjdG9yKCcjJyArIGlkKSkge1xuICAgICAgICAgICAgICAgICAgIHZhciB0YXJnZXRFbGVtID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcignIycgKyBpZCk7XG4gICAgICAgICAgICAgICAgfVxuXG4gICAgICAgICAgICAgICAgaWYgKGlkICE9ICcnICYmICEhIHRhcmdldEVsZW0pIHtcbiAgICAgICAgICAgICAgICAgICAgZS5wcmV2ZW50RGVmYXVsdCgpO1xuICAgICAgICAgICAgICAgICAgICBlLnN0b3BQcm9wYWdhdGlvbigpO1xuXG4gICAgICAgICAgICAgICAgICAgIGxldCBzY3JvbGxQb3NpdGlvbiA9IHRhcmdldEVsZW0ub2Zmc2V0VG9wIC0gc2VsZWN0b3Iub2Zmc2V0SGVpZ2h0O1xuXG4gICAgICAgICAgICAgICAgICAgIGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJ2h0bWwnKS5zY3JvbGxUbyh7XG4gICAgICAgICAgICAgICAgICAgICAgICB0b3A6IHNjcm9sbFBvc2l0aW9uLFxuICAgICAgICAgICAgICAgICAgICAgICAgYmVoYXZpb3I6ICdzbW9vdGgnLFxuICAgICAgICAgICAgICAgICAgICB9KTtcbiAgICAgICAgICAgICAgICB9XG5cbiAgICAgICAgICAgIH0pO1xuICAgICAgICB9KTtcbiAgICB9XG5cbiAgICBvbkRvY3VtZW50Q2xpY2soZXZlbnQpIHtcbiAgICAgICAgaWYgKCFldmVudC50YXJnZXQuY2xvc2VzdCh0aGlzLmdldFNldHRpbmdzKCdzZWxlY3RvcnMuZHJvcGRvd25TZWFyY2gnKSkpIHtcbiAgICAgICAgICAgIHZhciBzZWFyY2hGb3JtID0gdGhpcy5lbGVtZW50cy5kcm9wZG93blNlYXJjaDtcblxuICAgICAgICAgICAgY29uc3QgZmFkZSA9ICgpID0+IHtcbiAgICAgICAgICAgICAgICBsZXQgb3BhY2l0eSA9IHBhcnNlRmxvYXQoc2VhcmNoRm9ybS5zdHlsZS5vcGFjaXR5KTtcblxuICAgICAgICAgICAgICAgIGlmICgob3BhY2l0eSAtPSAwLjEpIDwgMCkge1xuICAgICAgICAgICAgICAgICAgICBzZWFyY2hGb3JtLnN0eWxlLmRpc3BsYXkgPSAnbm9uZSc7XG4gICAgICAgICAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgICAgICAgICAgc2VhcmNoRm9ybS5zdHlsZS5vcGFjaXR5ID0gb3BhY2l0eTtcblxuICAgICAgICAgICAgICAgICAgICB3aW5kb3cucmVxdWVzdEFuaW1hdGlvbkZyYW1lKGZhZGUpO1xuICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgIH07XG5cbiAgICAgICAgICAgIHdpbmRvdy5yZXF1ZXN0QW5pbWF0aW9uRnJhbWUoZmFkZSk7XG4gICAgICAgIH1cblxuICAgICAgICBpZiAoIWV2ZW50LnRhcmdldC5jbG9zZXN0KHRoaXMuZ2V0U2V0dGluZ3MoJ3NlbGVjdG9ycy5tZW51VG9nZ2xlJykpKSB7XG4gICAgICAgICAgICB0aGlzLmVsZW1lbnRzLm1lbnVUb2dnbGUuY2xhc3NMaXN0LnJlbW92ZSgnemV1cy1hY3RpdmUnKTtcbiAgICAgICAgfVxuICAgIH1cbn1cblxucmVnaXN0ZXJXaWRnZXQoWmV1c19NZW51LCAnemV1cy1tZW51Jyk7Il19
