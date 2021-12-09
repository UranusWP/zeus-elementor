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

      var searchLink = this.elements.dropdownSearchLink;

      if (searchLink) {
        searchLink.addEventListener('click', this.toggleDropdownSearch.bind(this));
      } // Full width dropdown


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

      var selector = menuWrapper.closest('.elementor-top-section'),
          top = selector.offsetTop; // Add sticky class

      selector.classList.add('zeus-has-sticky'); // Add wrapper

      selector.insertAdjacentHTML('beforebegin', '<span class="zeus-sticky-wrapper"></span>');
      selector.previousSibling.appendChild(selector);

      function onScroll() {
        // Admin bar offset
        var barOffset = 0;

        if (document.querySelector('body').classList.contains('admin-bar') && window.innerWidth > 600) {
          barOffset = document.getElementById('wpadminbar').offsetHeight;
        }

        if (window.pageYOffset > top) {
          selector.style.position = 'fixed';
          selector.style.width = '100%';
          selector.style.top = barOffset + 'px';
          selector.style.backgroundColor = menuWrapper.getAttribute('data-background');
          selector.style.zIndex = '9999';
          menuWrapper.classList.add('zeus-is-sticky');

          if (menuWrapper.classList.contains('zeus-has-shadow')) {
            selector.classList.add('zeus-sticky-shadow');
          }
        } else {
          selector.style.position = '';
          selector.style.width = '';
          selector.style.top = '';
          selector.style.backgroundColor = '';
          selector.style.zIndex = '';
          menuWrapper.classList.remove('zeus-is-sticky');

          if (menuWrapper.classList.contains('zeus-has-shadow')) {
            selector.classList.remove('zeus-sticky-shadow');
          }
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

          if ('' !== id && !!targetElem) {
            e.preventDefault();
            e.stopPropagation();
            var scrollPosition = targetElem.offsetTop - selector.offsetHeight;
            document.querySelector('html').scrollTo({
              top: scrollPosition,
              behavior: 'smooth'
            });
          }
        });
      }); // Go top link

      var goTopLink = document.querySelector('.zeus-menu-wrapper a[href="#go-top"]'),
          goTopLinkSlash = document.querySelector('.zeus-menu-wrapper a[href="/#go-top"]');

      if (goTopLink) {
        goTopLink.addEventListener('click', goTop);
      }

      if (goTopLinkSlash) {
        goTopLinkSlash.addEventListener('click', goTop);
      }

      function goTop(e) {
        e.preventDefault();
        document.querySelector('html').scrollTo({
          top: 0,
          behavior: 'smooth'
        });
      }
    }
  }, {
    key: "onDocumentClick",
    value: function onDocumentClick(event) {
      var searchLink = this.elements.dropdownSearchLink;

      if (searchLink && !event.target.closest(this.getSettings('selectors.dropdownSearch'))) {
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
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm5vZGVfbW9kdWxlcy9icm93c2VyLXBhY2svX3ByZWx1ZGUuanMiLCJzcmMvbGliL3V0aWxzLmpzIiwic3JjL3dpZGdldHMvbWVudS5qcyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFBQTs7Ozs7Ozs7QUNBTyxJQUFNLGNBQWMsR0FBRyxTQUFqQixjQUFpQixDQUFDLFNBQUQsRUFBWSxVQUFaLEVBQTZDO0FBQUEsTUFBckIsSUFBcUIsdUVBQWQsU0FBYzs7QUFDdkUsTUFBSSxFQUFFLFNBQVMsSUFBSSxVQUFmLENBQUosRUFBZ0M7QUFDNUI7QUFDSDtBQUVEO0FBQ0o7QUFDQTtBQUNBOzs7QUFDSSxFQUFBLE1BQU0sQ0FBQyxNQUFELENBQU4sQ0FBZSxFQUFmLENBQWtCLHlCQUFsQixFQUE2QyxZQUFNO0FBQy9DLFFBQU0sVUFBVSxHQUFHLFNBQWIsVUFBYSxDQUFDLFFBQUQsRUFBYztBQUM3QixNQUFBLGlCQUFpQixDQUFDLGVBQWxCLENBQWtDLFVBQWxDLENBQTZDLFNBQTdDLEVBQXdEO0FBQ3BELFFBQUEsUUFBUSxFQUFSO0FBRG9ELE9BQXhEO0FBR0gsS0FKRDs7QUFNQSxJQUFBLGlCQUFpQixDQUFDLEtBQWxCLENBQXdCLFNBQXhCLGtDQUE0RCxVQUE1RCxjQUEwRSxJQUExRSxHQUFrRixVQUFsRjtBQUNILEdBUkQ7QUFTSCxDQWxCTTs7Ozs7Ozs7Ozs7Ozs7QUNBUDs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7QUFFTyxJQUFNLFNBQVMsR0FBRyxTQUFaLFNBQVksQ0FBQyxPQUFELEVBQTRCO0FBQUEsTUFBbEIsUUFBa0IsdUVBQVAsRUFBTzs7QUFDakQsTUFBTSxPQUFPLEdBQUc7QUFDWixJQUFBLFFBQVEsRUFBRSxHQURFO0FBRVosSUFBQSxPQUFPLEVBQUUsSUFGRztBQUdaLElBQUEsT0FBTyxFQUFFLENBSEc7QUFJWixJQUFBLFFBQVEsRUFBRTtBQUpFLEdBQWhCO0FBT0EsRUFBQSxNQUFNLENBQUMsTUFBUCxDQUFjLE9BQWQsRUFBdUIs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QSxRQUFBLE1BQU0sQ0FBQyxxQkFBUCxDQUE2QixJQUE3QjtBQUNIOztBQUVELFVBQUksQ0FBQyxLQUFLLENBQUMsTUFBTixDQUFhLE9BQWIsQ0FBcUIsS0FBSyxXQUFMLENBQWlCLHNCQUFqQixDQUFyQixDQUFMLEVBQXFFO0FBQ2pFLGFBQUssUUFBTCxDQUFjLFVBQWQsQ0FBeUIsU0FBekIsQ0FBbUMsTUFBbkMsQ0FBMEMsYUFBMUM7QUFDSDtBQUNKOzs7O0VBcFNtQixnQkFBZ0IsQ0FBQyxRQUFqQixDQUEwQixRQUExQixDQUFtQyxJOztBQXVTM0QsMkJBQWUsU0FBZixFQUEwQixXQUExQiIsImZpbGUiOiJnZW5lcmF0ZWQuanMiLCJzb3VyY2VSb290IjoiIiwic291cmNlc0NvbnRlbnQiOlsiKGZ1bmN0aW9uKCl7ZnVuY3Rpb24gcihlLG4sdCl7ZnVuY3Rpb24gbyhpLGYpe2lmKCFuW2ldKXtpZighZVtpXSl7dmFyIGM9XCJmdW5jdGlvblwiPT10eXBlb2YgcmVxdWlyZSYmcmVxdWlyZTtpZighZiYmYylyZXR1cm4gYyhpLCEwKTtpZih1KXJldHVybiB1KGksITApO3ZhciBhPW5ldyBFcnJvcihcIkNhbm5vdCBmaW5kIG1vZHVsZSAnXCIraStcIidcIik7dGhyb3cgYS5jb2RlPVwiTU9EVUxFX05PVF9GT1VORFwiLGF9dmFyIHA9bltpXT17ZXhwb3J0czp7fX07ZVtpXVswXS5jYWxsKHAuZXhwb3J0cyxmdW5jdGlvbihyKXt2YXIgbj1lW2ldWzFdW3JdO3JldHVybiBvKG58fHIpfSxwLHAuZXhwb3J0cyxyLGUsbix0KX1yZXR1cm4gbltpXS5leHBvcnRzfWZvcih2YXIgdT1cImZ1bmN0aW9uXCI9PXR5cGVvZiByZXF1aXJlJiZyZXF1aXJlLGk9MDtpPHQubGVuZ3RoO2krKylvKHRbaV0pO3JldHVybiBvfXJldHVybiByfSkoKSIsImV4cG9ydCBjb25zdCByZWdpc3RlcldpZGdldCA9IChjbGFzc05hbWUsIHdpZGdldE5hbWUsIHNraW4gPSAnZGVmYXVsdCcpID0+IHtcbiAgICBpZiAoIShjbGFzc05hbWUgfHwgd2lkZ2V0TmFtZSkpIHtcbiAgICAgICAgcmV0dXJuO1xuICAgIH1cblxuICAgIC8qKlxuICAgICAqIEJlY2F1c2UgRWxlbWVudG9yIHBsdWdpbiB1c2VzIGpRdWVyeSBjdXN0b20gZXZlbnQsXG4gICAgICogV2UgYWxzbyBoYXZlIHRvIHVzZSBqUXVlcnkgdG8gdXNlIHRoaXMgZXZlbnRcbiAgICAgKi9cbiAgICBqUXVlcnkod2luZG93KS5vbignZWxlbWVudG9yL2Zyb250ZW5kL2luaXQnLCAoKSA9PiB7XG4gICAgICAgIGNvbnN0IGFkZEhhbmRsZXIgPSAoJGVsZW1lbnQpID0+IHtcbiAgICAgICAgICAgIGVsZW1lbnRvckZyb250ZW5kLmVsZW1lbnRzSGFuZGxlci5hZGRIYW5kbGVyKGNsYXNzTmFtZSwge1xuICAgICAgICAgICAgICAgICRlbGVtZW50LFxuICAgICAgICAgICAgfSk7XG4gICAgICAgIH07XG5cbiAgICAgICAgZWxlbWVudG9yRnJvbnRlbmQuaG9va3MuYWRkQWN0aW9uKGBmcm9udGVuZC9lbGVtZW50X3JlYWR5LyR7d2lkZ2V0TmFtZX0uJHtza2lufWAsIGFkZEhhbmRsZXIpO1xuICAgIH0pO1xufTtcbiIsImltcG9ydCB7IHJlZ2lzdGVyV2lkZ2V0IH0gZnJvbSAnLi4vbGliL3V0aWxzJztcblxuZXhwb3J0IGNvbnN0IG5hdkZhZGVJbiA9IChlbGVtZW50LCBfb3B0aW9ucyA9IHt9KSA9PiB7XG4gICAgY29uc3Qgb3B0aW9ucyA9IHtcbiAgICAgICAgZHVyYXRpb246IDMwMCxcbiAgICAgICAgZGlzcGxheTogbnVsbCxcbiAgICAgICAgb3BhY2l0eTogMSxcbiAgICAgICAgY2FsbGJhY2s6IG51bGwsXG4gICAgfTtcblxuICAgIE9iamVjdC5hc3NpZ24ob3B0aW9ucywgX29wdGlvbnMpO1xuXG4gICAgZWxlbWVudC5zdHlsZS5vcGFjaXR5ID0gMDtcbiAgICBlbGVtZW50LnN0eWxlLmRpc3BsYXkgPSBvcHRpb25zLmRpc3BsYXkgfHwgXCJibG9ja1wiO1xuXG4gICAgc2V0VGltZW91dCgoKSA9PiB7XG4gICAgICAgIGVsZW1lbnQuc3R5bGUudHJhbnNpdGlvbiA9IGAke29wdGlvbnMuZHVyYXRpb259bXMgb3BhY2l0eSBlYXNlYDtcbiAgICAgICAgZWxlbWVudC5zdHlsZS5vcGFjaXR5ID0gb3B0aW9ucy5vcGFjaXR5O1xuICAgIH0sIDUpO1xuXG4gICAgc2V0VGltZW91dCgoKSA9PiB7XG4gICAgICAgIGVsZW1lbnQuc3R5bGUucmVtb3ZlUHJvcGVydHkoXCJ0cmFuc2l0aW9uXCIpO1xuICAgICAgICAhIW9wdGlvbnMuY2FsbGJhY2sgJiYgb3B0aW9ucy5jYWxsYmFjaygpO1xuICAgIH0sIG9wdGlvbnMuZHVyYXRpb24gKyA1MCk7XG59O1xuXG5leHBvcnQgY29uc3QgbmF2RmFkZU91dCA9IChlbGVtZW50LCBfb3B0aW9ucyA9IHt9KSA9PiB7XG4gICAgY29uc3Qgb3B0aW9ucyA9IHtcbiAgICAgICAgZHVyYXRpb246IDMwMCxcbiAgICAgICAgZGlzcGxheTogbnVsbCxcbiAgICAgICAgb3BhY2l0eTogMCxcbiAgICAgICAgY2FsbGJhY2s6IG51bGwsXG4gICAgfTtcblxuICAgIE9iamVjdC5hc3NpZ24ob3B0aW9ucywgX29wdGlvbnMpO1xuXG4gICAgZWxlbWVudC5zdHlsZS5vcGFjaXR5ID0gMTtcbiAgICBlbGVtZW50LnN0eWxlLmRpc3BsYXkgPSBvcHRpb25zLmRpc3BsYXkgfHwgXCJibG9ja1wiO1xuXG4gICAgc2V0VGltZW91dCgoKSA9PiB7XG4gICAgICAgIGVsZW1lbnQuc3R5bGUudHJhbnNpdGlvbiA9IGAke29wdGlvbnMuZHVyYXRpb259bXMgb3BhY2l0eSBlYXNlYDtcbiAgICAgICAgZWxlbWVudC5zdHlsZS5vcGFjaXR5ID0gb3B0aW9ucy5vcGFjaXR5O1xuICAgIH0sIDUpO1xuXG4gICAgc2V0VGltZW91dCgoKSA9PiB7XG4gICAgICAgIGVsZW1lbnQuc3R5bGUuZGlzcGxheSA9IFwibm9uZVwiO1xuICAgICAgICBlbGVtZW50LnN0eWxlLnJlbW92ZVByb3BlcnR5KFwidHJhbnNpdGlvblwiKTtcbiAgICAgICAgISFvcHRpb25zLmNhbGxiYWNrICYmIG9wdGlvbnMuY2FsbGJhY2soKTtcbiAgICB9LCBvcHRpb25zLmR1cmF0aW9uICsgNTApO1xufTtcblxuZXhwb3J0IGNvbnN0IGZhZGVJbiA9IChlbGVtZW50LCBzcGVlZCA9IFwibm9ybWFsXCIsIGRpc3BsYXksIGNhbGxiYWNrID0gbnVsbCkgPT4ge1xuICAgIGVsZW1lbnQuc3R5bGUub3BhY2l0eSA9IDA7XG4gICAgZWxlbWVudC5zdHlsZS5kaXNwbGF5ID0gZGlzcGxheSB8fCBcImJsb2NrXCI7XG5cbiAgICBjb25zdCBmYWRlID0gKCkgPT4ge1xuICAgICAgICBsZXQgb3BhY2l0eSA9IHBhcnNlRmxvYXQoZWxlbWVudC5zdHlsZS5vcGFjaXR5KTtcblxuICAgICAgICBpZiAoKG9wYWNpdHkgKz0gc3BlZWQgPT09IFwiZmFzdFwiID8gMC4yIDogMC4xKSA8PSAxKSB7XG4gICAgICAgICAgICBlbGVtZW50LnN0eWxlLm9wYWNpdHkgPSBvcGFjaXR5O1xuXG4gICAgICAgICAgICBpZiAob3BhY2l0eSA9PT0gMSAmJiBjYWxsYmFjaykge1xuICAgICAgICAgICAgICAgIGNhbGxiYWNrKCk7XG4gICAgICAgICAgICB9XG5cbiAgICAgICAgICAgIHdpbmRvdy5yZXF1ZXN0QW5pbWF0aW9uRnJhbWUoZmFkZSk7XG4gICAgICAgIH1cbiAgICB9O1xuXG4gICAgd2luZG93LnJlcXVlc3RBbmltYXRpb25GcmFtZShmYWRlKTtcbn07XG5cbmV4cG9ydCBjb25zdCBmYWRlT3V0ID0gKGVsZW1lbnQsIHNwZWVkID0gXCJub3JtYWxcIiwgZGlzcGxheSwgY2FsbGJhY2sgPSBudWxsKSA9PiB7XG4gICAgZWxlbWVudC5zdHlsZS5vcGFjaXR5ID0gMTtcbiAgICBlbGVtZW50LnN0eWxlLmRpc3BsYXkgPSBkaXNwbGF5IHx8IFwiYmxvY2tcIjtcblxuICAgIGNvbnN0IGZhZGUgPSAoKSA9PiB7XG4gICAgICAgIGxldCBvcGFjaXR5ID0gcGFyc2VGbG9hdChlbGVtZW50LnN0eWxlLm9wYWNpdHkpO1xuXG4gICAgICAgIGlmICgob3BhY2l0eSAtPSBzcGVlZCA9PT0gXCJmYXN0XCIgPyAwLjIgOiAwLjEpIDwgMCkge1xuICAgICAgICAgICAgZWxlbWVudC5zdHlsZS5kaXNwbGF5ID0gXCJub25lXCI7XG4gICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICBlbGVtZW50LnN0eWxlLm9wYWNpdHkgPSBvcGFjaXR5O1xuXG4gICAgICAgICAgICBpZiAob3BhY2l0eSA9PT0gMCAmJiBjYWxsYmFjaykge1xuICAgICAgICAgICAgICAgIGNhbGxiYWNrKCk7XG4gICAgICAgICAgICB9XG5cbiAgICAgICAgICAgIHdpbmRvdy5yZXF1ZXN0QW5pbWF0aW9uRnJhbWUoZmFkZSk7XG4gICAgICAgIH1cbiAgICB9O1xuXG4gICAgd2luZG93LnJlcXVlc3RBbmltYXRpb25GcmFtZShmYWRlKTtcbn07XG5cbmV4cG9ydCBjb25zdCBmYWRlVG9nZ2xlID0gKGVsZW1lbnQsIHNwZWVkID0gXCJub3JtYWxcIiwgZGlzcGxheSwgY2FsbGJhY2sgPSBudWxsKSA9PlxuICAgIHdpbmRvdy5nZXRDb21wdXRlZFN0eWxlKGVsZW1lbnQpLmRpc3BsYXkgPT09IFwibm9uZVwiXG4gICAgICAgID8gZmFkZUluKGVsZW1lbnQsIHNwZWVkLCBkaXNwbGF5LCBjYWxsYmFjaylcbiAgICAgICAgOiBmYWRlT3V0KGVsZW1lbnQsIHNwZWVkLCBkaXNwbGF5LCBjYWxsYmFjayk7XG5cbmNsYXNzIFpldXNfTWVudSBleHRlbmRzIGVsZW1lbnRvck1vZHVsZXMuZnJvbnRlbmQuaGFuZGxlcnMuQmFzZSB7XG4gICAgZ2V0RGVmYXVsdFNldHRpbmdzKCkge1xuICAgICAgICByZXR1cm4ge1xuICAgICAgICAgICAgc2VsZWN0b3JzOiB7XG4gICAgICAgICAgICAgICAgbWVudVdyYXBwZXI6ICcuemV1cy1tZW51LXdyYXBwZXInLFxuICAgICAgICAgICAgICAgIGhNZW51OiAnLnpldXMtbWVudS1sYXlvdXQtaG9yaXpvbnRhbCAuemV1cy1tZW51JyxcbiAgICAgICAgICAgICAgICBtZW51VG9nZ2xlOiAnLnpldXMtbWVudS10b2dnbGUnLFxuICAgICAgICAgICAgICAgIG1lbnVUb2dnbGVJY29uOiAnLnpldXMtbWVudS10b2dnbGUtaWNvbicsXG4gICAgICAgICAgICAgICAgZHJvcGRvd25NZW51OiAnLnpldXMtbWVudS10b2dnbGUtZHJvcGRvd24nLFxuICAgICAgICAgICAgICAgIHN1YkRyb3Bkb3duOiAnLnpldXMtbWVudS1sYXlvdXQtdmVydGljYWwgLnpldXMtc3ViLWljb24sIC56ZXVzLWRyb3Bkb3duLW1lbnUgLnpldXMtc3ViLWljb24nLFxuICAgICAgICAgICAgICAgIGRyb3Bkb3duU2VhcmNoOiAnLnpldXMtc2VhcmNoZm9ybS1tZW51JyxcbiAgICAgICAgICAgICAgICBkcm9wZG93blNlYXJjaExpbms6ICcuemV1cy1zZWFyY2gtbWVudS1pdGVtJyxcbiAgICAgICAgICAgICAgICBkcm9wZG93blNlYXJjaElucHV0OiAnLnpldXMtc2VhcmNoZm9ybS1tZW51IGlucHV0LmZpZWxkJyxcbiAgICAgICAgICAgIH0sXG4gICAgICAgIH07XG4gICAgfVxuXG4gICAgZ2V0RGVmYXVsdEVsZW1lbnRzKCkge1xuICAgICAgICBjb25zdCBlbGVtZW50ID0gdGhpcy4kZWxlbWVudC5nZXQoMCk7XG4gICAgICAgIGNvbnN0IHNlbGVjdG9ycyA9IHRoaXMuZ2V0U2V0dGluZ3MoJ3NlbGVjdG9ycycpO1xuXG4gICAgICAgIHJldHVybiB7XG4gICAgICAgICAgICBtZW51V3JhcHBlcjogZWxlbWVudC5xdWVyeVNlbGVjdG9yKHNlbGVjdG9ycy5tZW51V3JhcHBlciksXG4gICAgICAgICAgICBoTWVudTogZWxlbWVudC5xdWVyeVNlbGVjdG9yQWxsKHNlbGVjdG9ycy5oTWVudSksXG4gICAgICAgICAgICBtZW51VG9nZ2xlOiBlbGVtZW50LnF1ZXJ5U2VsZWN0b3Ioc2VsZWN0b3JzLm1lbnVUb2dnbGUpLFxuICAgICAgICAgICAgbWVudVRvZ2dsZUljb246IGVsZW1lbnQucXVlcnlTZWxlY3RvcihzZWxlY3RvcnMubWVudVRvZ2dsZUljb24pLFxuICAgICAgICAgICAgZHJvcGRvd25NZW51OiBlbGVtZW50LnF1ZXJ5U2VsZWN0b3Ioc2VsZWN0b3JzLmRyb3Bkb3duTWVudSksXG4gICAgICAgICAgICBzdWJEcm9wZG93bjogZWxlbWVudC5xdWVyeVNlbGVjdG9yQWxsKHNlbGVjdG9ycy5zdWJEcm9wZG93biksXG4gICAgICAgICAgICBkcm9wZG93blNlYXJjaDogZWxlbWVudC5xdWVyeVNlbGVjdG9yKHNlbGVjdG9ycy5kcm9wZG93blNlYXJjaCksXG4gICAgICAgICAgICBkcm9wZG93blNlYXJjaExpbms6IGVsZW1lbnQucXVlcnlTZWxlY3RvcihzZWxlY3RvcnMuZHJvcGRvd25TZWFyY2hMaW5rKSxcbiAgICAgICAgICAgIGRyb3Bkb3duU2VhcmNoSW5wdXQ6IGVsZW1lbnQucXVlcnlTZWxlY3RvcihzZWxlY3RvcnMuZHJvcGRvd25TZWFyY2hJbnB1dCksXG4gICAgICAgIH07XG4gICAgfVxuXG4gICAgb25Jbml0KC4uLmFyZ3MpIHtcbiAgICAgICAgc3VwZXIub25Jbml0KC4uLmFyZ3MpO1xuXG4gICAgICAgIHRoaXMuc2V0dXBFdmVudExpc3RlbmVycygpO1xuICAgICAgICB0aGlzLmZ1bGxXaWR0aERyb3Bkb3duKCk7XG4gICAgfVxuXG4gICAgc2V0dXBFdmVudExpc3RlbmVycygpIHtcbiAgICAgICAgLy8gT3BlbiBkcm9wZG93biBvZiBwYXJlbnQgbWVudSBvbiBob3ZlciBvbmx5IGZvciB0aGUgaG9yaXpvbnRhbCBsYXlvdXRcbiAgICAgICAgdGhpcy5lbGVtZW50cy5oTWVudS5mb3JFYWNoKChtZW51KSA9PiB7XG4gICAgICAgICAgICB2YXIgcGFyZW50TWVudUl0ZW1zID0gbWVudS5xdWVyeVNlbGVjdG9yQWxsKCcubWVudS1pdGVtLWhhcy1jaGlsZHJlbicpO1xuICAgICAgICAgICAgcGFyZW50TWVudUl0ZW1zLmZvckVhY2goKHBhcmVudE1lbnVJdGVtKSA9PiB7XG4gICAgICAgICAgICAgICAgcGFyZW50TWVudUl0ZW0uYWRkRXZlbnRMaXN0ZW5lcignbW91c2VlbnRlcicsIHRoaXMub25QYXJlbnRNZW51SXRlbU1vdXNlZW50ZXIuYmluZCh0aGlzKSk7XG4gICAgICAgICAgICAgICAgcGFyZW50TWVudUl0ZW0uYWRkRXZlbnRMaXN0ZW5lcignbW91c2VsZWF2ZScsIHRoaXMub25QYXJlbnRNZW51SXRlbU1vdXNlbGVhdmUuYmluZCh0aGlzKSk7XG4gICAgICAgICAgICB9KTtcbiAgICAgICAgfSk7XG5cbiAgICAgICAgLy8gRHJvcGRvd24gdG9nZ2xlXG4gICAgICAgIHRoaXMuZWxlbWVudHMubWVudVRvZ2dsZUljb24uYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCB0aGlzLm9uVG9nZ2xlQ2xpY2suYmluZCh0aGlzKSk7XG5cbiAgICAgICAgLy8gT3BlbiBzdWJtZW51IG9uIGRyb3Bkb3duIHRvZ2dsZVxuICAgICAgICB0aGlzLmVsZW1lbnRzLnN1YkRyb3Bkb3duLmZvckVhY2goKHRvZ2dsZSkgPT4ge1xuICAgICAgICAgICAgdG9nZ2xlLnNldEF0dHJpYnV0ZSgnYXJpYS1leHBhbmRlZCcsICdmYWxzZScpO1xuXG4gICAgICAgICAgICB0b2dnbGUub25jbGljayA9IGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgICAgICBpZiAodG9nZ2xlLmdldEF0dHJpYnV0ZSgnYXJpYS1leHBhbmRlZCcpID09PSAndHJ1ZScpIHtcbiAgICAgICAgICAgICAgICAgICAgdG9nZ2xlLnNldEF0dHJpYnV0ZSgnYXJpYS1leHBhbmRlZCcsICdmYWxzZScpO1xuICAgICAgICAgICAgICAgICAgICB0b2dnbGUucGFyZW50Tm9kZS5jbGFzc0xpc3QucmVtb3ZlKCd6ZXVzLWRyb3Bkb3duLW9wZW4nKTtcbiAgICAgICAgICAgICAgICAgICAgcmV0dXJuO1xuICAgICAgICAgICAgICAgIH1cblxuICAgICAgICAgICAgICAgIHRvZ2dsZS5zZXRBdHRyaWJ1dGUoJ2FyaWEtZXhwYW5kZWQnLCAndHJ1ZScpO1xuICAgICAgICAgICAgICAgIHRvZ2dsZS5wYXJlbnROb2RlLmNsYXNzTGlzdC5hZGQoJ3pldXMtZHJvcGRvd24tb3BlbicpO1xuICAgICAgICAgICAgICAgIHJldHVybjtcbiAgICAgICAgICAgIH1cbiAgICAgICAgfSk7XG5cbiAgICAgICAgLy8gT3BlbiBzZWFyY2ggZm9ybVxuICAgICAgICB2YXIgc2VhcmNoTGluayA9IHRoaXMuZWxlbWVudHMuZHJvcGRvd25TZWFyY2hMaW5rO1xuICAgICAgICBpZiAoIHNlYXJjaExpbmsgKSB7XG4gICAgICAgICAgICBzZWFyY2hMaW5rLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgdGhpcy50b2dnbGVEcm9wZG93blNlYXJjaC5iaW5kKHRoaXMpKTtcbiAgICAgICAgfVxuXG4gICAgICAgIC8vIEZ1bGwgd2lkdGggZHJvcGRvd25cbiAgICAgICAgd2luZG93LmFkZEV2ZW50TGlzdGVuZXIoJ3Jlc2l6ZScsIHRoaXMuZnVsbFdpZHRoRHJvcGRvd24uYmluZCh0aGlzKSk7XG4gICAgICAgIHdpbmRvdy5hZGRFdmVudExpc3RlbmVyKCdvcmllbnRhdGlvbmNoYW5nZScsIHRoaXMuZnVsbFdpZHRoRHJvcGRvd24uYmluZCh0aGlzKSk7XG5cbiAgICAgICAgLy8gQ2xvc2UgZWxlbWVudHMgd2hlbiBjbGlja2luZyBlbHNld2hlcmVcbiAgICAgICAgZG9jdW1lbnQuYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCB0aGlzLm9uRG9jdW1lbnRDbGljay5iaW5kKHRoaXMpKTtcblxuICAgICAgICAvLyBPbiBzdGlja3lcbiAgICAgICAgaWYgKCFkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCdib2R5JykuY2xhc3NMaXN0LmNvbnRhaW5zKCdlbGVtZW50b3ItZWRpdG9yLWFjdGl2ZScpXG4gICAgICAgICAgICAmJiAneWVzJyA9PT0gdGhpcy5nZXRFbGVtZW50U2V0dGluZ3MoJ2lzX3N0aWNreScpKSB7XG4gICAgICAgICAgICB0aGlzLm9uU3RpY2t5KCk7XG4gICAgICAgIH1cblxuICAgIH1cblxuICAgIG9uUGFyZW50TWVudUl0ZW1Nb3VzZWVudGVyKGV2ZW50KSB7XG4gICAgICAgIHZhciBwYXJlbnRNZW51SXRlbSA9IGV2ZW50LmN1cnJlbnRUYXJnZXQ7XG4gICAgICAgIHZhciBzdWJNZW51ID0gcGFyZW50TWVudUl0ZW0ucXVlcnlTZWxlY3RvcigndWwuc3ViLW1lbnUnKTtcblxuICAgICAgICBwYXJlbnRNZW51SXRlbS5jbGFzc0xpc3QuYWRkKCdzdWItaG92ZXInKTtcblxuICAgICAgICBuYXZGYWRlSW4oc3ViTWVudSk7XG4gICAgfVxuXG4gICAgb25QYXJlbnRNZW51SXRlbU1vdXNlbGVhdmUoZXZlbnQpIHtcbiAgICAgICAgdmFyIHBhcmVudE1lbnVJdGVtID0gZXZlbnQuY3VycmVudFRhcmdldDtcbiAgICAgICAgdmFyIHN1Yk1lbnUgPSBwYXJlbnRNZW51SXRlbS5xdWVyeVNlbGVjdG9yKCd1bC5zdWItbWVudScpO1xuXG4gICAgICAgIHBhcmVudE1lbnVJdGVtLmNsYXNzTGlzdC5yZW1vdmUoJ3N1Yi1ob3ZlcicpO1xuICAgICAgICBzdWJNZW51LnN0eWxlLnBvaW50ZXJFdmVudHMgPSAnbm9uZSc7XG5cbiAgICAgICAgbmF2RmFkZU91dChzdWJNZW51LCB7XG4gICAgICAgICAgICBjYWxsYmFjazogKCkgPT4ge1xuICAgICAgICAgICAgICAgIHN1Yk1lbnUuc3R5bGUucG9pbnRlckV2ZW50cyA9IG51bGw7XG4gICAgICAgICAgICB9LFxuICAgICAgICB9KTtcbiAgICB9XG5cbiAgICBvblRvZ2dsZUNsaWNrKGV2ZW50KSB7XG4gICAgICAgIGV2ZW50LnN0b3BQcm9wYWdhdGlvbigpO1xuICAgICAgICB0aGlzLmVsZW1lbnRzLm1lbnVUb2dnbGUuY2xhc3NMaXN0LnRvZ2dsZSgnemV1cy1hY3RpdmUnKTtcbiAgICB9XG5cbiAgICB0b2dnbGVEcm9wZG93blNlYXJjaChldmVudCkge1xuICAgICAgICBldmVudC5wcmV2ZW50RGVmYXVsdCgpO1xuICAgICAgICBldmVudC5zdG9wUHJvcGFnYXRpb24oKTtcblxuICAgICAgICBmYWRlVG9nZ2xlKHRoaXMuZWxlbWVudHMuZHJvcGRvd25TZWFyY2gsICdmYXN0Jyk7XG4gICAgICAgIHRoaXMuZWxlbWVudHMuZHJvcGRvd25TZWFyY2hJbnB1dC5mb2N1cygpO1xuICAgIH1cblxuICAgIGZ1bGxXaWR0aERyb3Bkb3duKGV2ZW50KSB7XG4gICAgICAgIHRoaXMuc3RyZXRjaEVsZW1lbnQgPSBuZXcgZWxlbWVudG9yTW9kdWxlcy5mcm9udGVuZC50b29scy5TdHJldGNoRWxlbWVudCh7XG4gICAgICAgICAgZWxlbWVudDogdGhpcy5lbGVtZW50cy5kcm9wZG93bk1lbnVcbiAgICAgICAgfSk7XG5cbiAgICAgICAgaWYgKHRoaXMuZ2V0RWxlbWVudFNldHRpbmdzKCdkcm9wZG93bl9mdWxsX3dpZHRoJykpIHtcbiAgICAgICAgICAgIHRoaXMuc3RyZXRjaEVsZW1lbnQuc3RyZXRjaCgpO1xuICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgdGhpcy5zdHJldGNoRWxlbWVudC5yZXNldCgpO1xuICAgICAgICB9XG4gICAgfVxuXG4gICAgb25TdGlja3koKSB7XG4gICAgICAgIGNvbnN0IG1lbnVXcmFwcGVyID0gdGhpcy5lbGVtZW50cy5tZW51V3JhcHBlcjtcblxuICAgICAgICBpZiAobWVudVdyYXBwZXIuaGFzQXR0cmlidXRlKCdkYXRhLWRlc3Ryb3ktc3RpY2t5JykpIHtcbiAgICAgICAgICAgIGNvbnN0IGRlc3Ryb3lXaWR0aCA9IG1lbnVXcmFwcGVyLmdldEF0dHJpYnV0ZSgnZGF0YS1kZXN0cm95LXN0aWNreScpO1xuXG4gICAgICAgICAgICBpZiAod2luZG93LmlubmVyV2lkdGggPCBkZXN0cm95V2lkdGgpIHtcbiAgICAgICAgICAgICAgICByZXR1cm47XG4gICAgICAgICAgICB9XG4gICAgICAgIH1cblxuICAgICAgICB2YXIgc2VsZWN0b3IgPSBtZW51V3JhcHBlci5jbG9zZXN0KCcuZWxlbWVudG9yLXRvcC1zZWN0aW9uJyksXG4gICAgICAgICAgICB0b3AgPSBzZWxlY3Rvci5vZmZzZXRUb3A7XG5cbiAgICAgICAgLy8gQWRkIHN0aWNreSBjbGFzc1xuICAgICAgICBzZWxlY3Rvci5jbGFzc0xpc3QuYWRkKCd6ZXVzLWhhcy1zdGlja3knKTtcblxuICAgICAgICAvLyBBZGQgd3JhcHBlclxuICAgICAgICBzZWxlY3Rvci5pbnNlcnRBZGphY2VudEhUTUwoJ2JlZm9yZWJlZ2luJywgJzxzcGFuIGNsYXNzPVwiemV1cy1zdGlja3ktd3JhcHBlclwiPjwvc3Bhbj4nKTtcbiAgICAgICAgc2VsZWN0b3IucHJldmlvdXNTaWJsaW5nLmFwcGVuZENoaWxkKHNlbGVjdG9yKTtcblxuICAgICAgICBmdW5jdGlvbiBvblNjcm9sbCgpIHtcblxuICAgICAgICAgICAgLy8gQWRtaW4gYmFyIG9mZnNldFxuICAgICAgICAgICAgdmFyIGJhck9mZnNldCA9IDA7XG4gICAgICAgICAgICBpZiAoZG9jdW1lbnQucXVlcnlTZWxlY3RvcignYm9keScpLmNsYXNzTGlzdC5jb250YWlucygnYWRtaW4tYmFyJykgJiYgd2luZG93LmlubmVyV2lkdGggPiA2MDApIHtcbiAgICAgICAgICAgICAgICBiYXJPZmZzZXQgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnd3BhZG1pbmJhcicpLm9mZnNldEhlaWdodDtcbiAgICAgICAgICAgIH1cblxuICAgICAgICAgICAgaWYgKCB3aW5kb3cucGFnZVlPZmZzZXQgPiB0b3AgKSB7XG4gICAgICAgICAgICAgICAgc2VsZWN0b3Iuc3R5bGUucG9zaXRpb24gPSAnZml4ZWQnO1xuICAgICAgICAgICAgICAgIHNlbGVjdG9yLnN0eWxlLndpZHRoID0gJzEwMCUnO1xuICAgICAgICAgICAgICAgIHNlbGVjdG9yLnN0eWxlLnRvcCA9IGJhck9mZnNldCArICdweCc7XG4gICAgICAgICAgICAgICAgc2VsZWN0b3Iuc3R5bGUuYmFja2dyb3VuZENvbG9yID0gbWVudVdyYXBwZXIuZ2V0QXR0cmlidXRlKCdkYXRhLWJhY2tncm91bmQnKTtcbiAgICAgICAgICAgICAgICBzZWxlY3Rvci5zdHlsZS56SW5kZXggPSAnOTk5OSc7XG5cbiAgICAgICAgICAgICAgICBtZW51V3JhcHBlci5jbGFzc0xpc3QuYWRkKCd6ZXVzLWlzLXN0aWNreScpO1xuXG4gICAgICAgICAgICAgICAgaWYgKCBtZW51V3JhcHBlci5jbGFzc0xpc3QuY29udGFpbnMoJ3pldXMtaGFzLXNoYWRvdycpICkge1xuICAgICAgICAgICAgICAgICAgICBzZWxlY3Rvci5jbGFzc0xpc3QuYWRkKCd6ZXVzLXN0aWNreS1zaGFkb3cnKTtcbiAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgICAgIHNlbGVjdG9yLnN0eWxlLnBvc2l0aW9uID0gJyc7XG4gICAgICAgICAgICAgICAgc2VsZWN0b3Iuc3R5bGUud2lkdGggPSAnJztcbiAgICAgICAgICAgICAgICBzZWxlY3Rvci5zdHlsZS50b3AgPSAnJztcbiAgICAgICAgICAgICAgICBzZWxlY3Rvci5zdHlsZS5iYWNrZ3JvdW5kQ29sb3IgPSAnJztcbiAgICAgICAgICAgICAgICBzZWxlY3Rvci5zdHlsZS56SW5kZXggPSAnJztcblxuICAgICAgICAgICAgICAgIG1lbnVXcmFwcGVyLmNsYXNzTGlzdC5yZW1vdmUoJ3pldXMtaXMtc3RpY2t5Jyk7XG5cbiAgICAgICAgICAgICAgICBpZiAoIG1lbnVXcmFwcGVyLmNsYXNzTGlzdC5jb250YWlucygnemV1cy1oYXMtc2hhZG93JykgKSB7XG4gICAgICAgICAgICAgICAgICAgIHNlbGVjdG9yLmNsYXNzTGlzdC5yZW1vdmUoJ3pldXMtc3RpY2t5LXNoYWRvdycpO1xuICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgIH1cblxuICAgICAgICB9XG5cbiAgICAgICAgd2luZG93LmFkZEV2ZW50TGlzdGVuZXIoJ3Njcm9sbCcsIG9uU2Nyb2xsKTtcbiAgICAgICAgd2luZG93LmFkZEV2ZW50TGlzdGVuZXIoJ3Jlc2l6ZScsIG9uU2Nyb2xsKTtcbiAgICAgICAgd2luZG93LmFkZEV2ZW50TGlzdGVuZXIoJ29yaWVudGF0aW9uY2hhbmdlJywgb25TY3JvbGwpO1xuXG4gICAgICAgIGZ1bmN0aW9uIHdyYXBwZXJTdHlsZSgpIHtcbiAgICAgICAgICAgIHNlbGVjdG9yLnBhcmVudE5vZGUuc3R5bGUuZGlzcGxheSA9ICdibG9jayc7XG4gICAgICAgICAgICBzZWxlY3Rvci5wYXJlbnROb2RlLnN0eWxlLndpZHRoID0gd2luZG93LmlubmVyV2lkdGggKyAncHgnO1xuICAgICAgICAgICAgc2VsZWN0b3IucGFyZW50Tm9kZS5zdHlsZS5oZWlnaHQgPSBzZWxlY3Rvci5vZmZzZXRIZWlnaHQgKyAncHgnO1xuICAgICAgICB9XG5cbiAgICAgICAgd2luZG93LmFkZEV2ZW50TGlzdGVuZXIoJ2xvYWQnLCB3cmFwcGVyU3R5bGUpO1xuICAgICAgICB3aW5kb3cuYWRkRXZlbnRMaXN0ZW5lcigncmVzaXplJywgd3JhcHBlclN0eWxlKTtcbiAgICAgICAgd2luZG93LmFkZEV2ZW50TGlzdGVuZXIoJ29yaWVudGF0aW9uY2hhbmdlJywgd3JhcHBlclN0eWxlKTtcblxuICAgICAgICAvLyBBbmNob3IgbGlua3NcbiAgICAgICAgZG9jdW1lbnQucXVlcnlTZWxlY3RvckFsbCgnLnpldXMtbWVudS13cmFwcGVyIGFbaHJlZio9XCIjXCJdOm5vdChbaHJlZj1cIiNcIl0pJykuZm9yRWFjaCgobGluaykgPT4ge1xuICAgICAgICAgICAgbGluay5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsIGZ1bmN0aW9uKGUpIHtcbiAgICAgICAgICAgICAgICBcbiAgICAgICAgICAgICAgICBjb25zdCBocmVmID0gbGluay5nZXRBdHRyaWJ1dGUoJ2hyZWYnKTtcbiAgICAgICAgICAgICAgICBjb25zdCBpZCA9IGhyZWYuc3Vic3RyaW5nKGhyZWYuaW5kZXhPZignIycpKS5zbGljZSgxKTtcblxuICAgICAgICAgICAgICAgIC8vIENoZWNrIHNlbGVjdG9yXG4gICAgICAgICAgICAgICAgY29uc3QgdmFsaWRTZWxlY3RvciA9ICgoZHVtbXlFbGVtZW50KSA9PiAoc2VsZWN0b3IpID0+IHtcbiAgICAgICAgICAgICAgICAgICAgdHJ5IHtcbiAgICAgICAgICAgICAgICAgICAgICAgIGR1bW15RWxlbWVudC5xdWVyeVNlbGVjdG9yKHNlbGVjdG9yKTtcbiAgICAgICAgICAgICAgICAgICAgfSBjYXRjaCB7XG4gICAgICAgICAgICAgICAgICAgICAgICByZXR1cm4gZmFsc2U7XG4gICAgICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgICAgICAgcmV0dXJuIHRydWU7XG4gICAgICAgICAgICAgICAgfSk7XG5cbiAgICAgICAgICAgICAgICBpZiAodmFsaWRTZWxlY3RvcignIycgKyBpZCkpIHtcbiAgICAgICAgICAgICAgICAgICB2YXIgdGFyZ2V0RWxlbSA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJyMnICsgaWQpO1xuICAgICAgICAgICAgICAgIH1cblxuICAgICAgICAgICAgICAgIGlmICggJycgIT09IGlkICYmICEhIHRhcmdldEVsZW0gKSB7XG4gICAgICAgICAgICAgICAgICAgIGUucHJldmVudERlZmF1bHQoKTtcbiAgICAgICAgICAgICAgICAgICAgZS5zdG9wUHJvcGFnYXRpb24oKTtcblxuICAgICAgICAgICAgICAgICAgICBsZXQgc2Nyb2xsUG9zaXRpb24gPSB0YXJnZXRFbGVtLm9mZnNldFRvcCAtIHNlbGVjdG9yLm9mZnNldEhlaWdodDtcblxuICAgICAgICAgICAgICAgICAgICBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCdodG1sJykuc2Nyb2xsVG8oe1xuICAgICAgICAgICAgICAgICAgICAgICAgdG9wOiBzY3JvbGxQb3NpdGlvbixcbiAgICAgICAgICAgICAgICAgICAgICAgIGJlaGF2aW9yOiAnc21vb3RoJyxcbiAgICAgICAgICAgICAgICAgICAgfSk7XG4gICAgICAgICAgICAgICAgfVxuXG4gICAgICAgICAgICB9KTtcbiAgICAgICAgfSk7XG5cbiAgICAgICAgLy8gR28gdG9wIGxpbmtcbiAgICAgICAgdmFyIGdvVG9wTGluayA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJy56ZXVzLW1lbnUtd3JhcHBlciBhW2hyZWY9XCIjZ28tdG9wXCJdJyksXG4gICAgICAgICAgICBnb1RvcExpbmtTbGFzaCA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJy56ZXVzLW1lbnUtd3JhcHBlciBhW2hyZWY9XCIvI2dvLXRvcFwiXScpO1xuXG4gICAgICAgIGlmICggZ29Ub3BMaW5rICkge1xuICAgICAgICAgICAgZ29Ub3BMaW5rLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgZ29Ub3ApO1xuICAgICAgICB9XG5cbiAgICAgICAgaWYgKCBnb1RvcExpbmtTbGFzaCApIHtcbiAgICAgICAgICAgIGdvVG9wTGlua1NsYXNoLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgZ29Ub3ApO1xuICAgICAgICB9XG5cbiAgICAgICAgZnVuY3Rpb24gZ29Ub3AoZSkge1xuICAgICAgICAgICAgZS5wcmV2ZW50RGVmYXVsdCgpO1xuICAgICAgICAgICAgICAgIFxuICAgICAgICAgICAgZG9jdW1lbnQucXVlcnlTZWxlY3RvcignaHRtbCcpLnNjcm9sbFRvKHtcbiAgICAgICAgICAgICAgICB0b3A6IDAsXG4gICAgICAgICAgICAgICAgYmVoYXZpb3I6ICdzbW9vdGgnLFxuICAgICAgICAgICAgfSk7XG4gICAgICAgIH1cbiAgICB9XG5cbiAgICBvbkRvY3VtZW50Q2xpY2soZXZlbnQpIHtcbiAgICAgICAgdmFyIHNlYXJjaExpbmsgPSB0aGlzLmVsZW1lbnRzLmRyb3Bkb3duU2VhcmNoTGluaztcbiAgICAgICAgaWYgKCBzZWFyY2hMaW5rICYmICFldmVudC50YXJnZXQuY2xvc2VzdCh0aGlzLmdldFNldHRpbmdzKCdzZWxlY3RvcnMuZHJvcGRvd25TZWFyY2gnKSkgKSB7XG4gICAgICAgICAgICB2YXIgc2VhcmNoRm9ybSA9IHRoaXMuZWxlbWVudHMuZHJvcGRvd25TZWFyY2g7XG5cbiAgICAgICAgICAgIGNvbnN0IGZhZGUgPSAoKSA9PiB7XG4gICAgICAgICAgICAgICAgbGV0IG9wYWNpdHkgPSBwYXJzZUZsb2F0KHNlYXJjaEZvcm0uc3R5bGUub3BhY2l0eSk7XG5cbiAgICAgICAgICAgICAgICBpZiAoKG9wYWNpdHkgLT0gMC4xKSA8IDApIHtcbiAgICAgICAgICAgICAgICAgICAgc2VhcmNoRm9ybS5zdHlsZS5kaXNwbGF5ID0gJ25vbmUnO1xuICAgICAgICAgICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICAgICAgICAgIHNlYXJjaEZvcm0uc3R5bGUub3BhY2l0eSA9IG9wYWNpdHk7XG5cbiAgICAgICAgICAgICAgICAgICAgd2luZG93LnJlcXVlc3RBbmltYXRpb25GcmFtZShmYWRlKTtcbiAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICB9O1xuXG4gICAgICAgICAgICB3aW5kb3cucmVxdWVzdEFuaW1hdGlvbkZyYW1lKGZhZGUpO1xuICAgICAgICB9XG5cbiAgICAgICAgaWYgKCFldmVudC50YXJnZXQuY2xvc2VzdCh0aGlzLmdldFNldHRpbmdzKCdzZWxlY3RvcnMubWVudVRvZ2dsZScpKSkge1xuICAgICAgICAgICAgdGhpcy5lbGVtZW50cy5tZW51VG9nZ2xlLmNsYXNzTGlzdC5yZW1vdmUoJ3pldXMtYWN0aXZlJyk7XG4gICAgICAgIH1cbiAgICB9XG59XG5cbnJlZ2lzdGVyV2lkZ2V0KFpldXNfTWVudSwgJ3pldXMtbWVudScpOyJdfQ==
