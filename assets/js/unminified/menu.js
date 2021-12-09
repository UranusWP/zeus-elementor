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
      }); // If dropdown

      var dropdownMenu = this.elements.dropdownMenu;

      if (dropdownMenu) {
        // Dropdown toggle
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
        });
      } // Open search form


      var searchLink = this.elements.dropdownSearchLink;

      if (searchLink) {
        searchLink.addEventListener('click', this.toggleDropdownSearch.bind(this));
      }

      if (dropdownMenu) {
        // Full width dropdown
        window.addEventListener('resize', this.fullWidthDropdown.bind(this));
        window.addEventListener('orientationchange', this.fullWidthDropdown.bind(this));
      } // Close elements when clicking elsewhere


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
      var dropdownMenu = this.elements.dropdownMenu;

      if (dropdownMenu) {
        this.stretchElement = new elementorModules.frontend.tools.StretchElement({
          element: dropdownMenu
        });

        if (this.getElementSettings('dropdown_full_width')) {
          this.stretchElement.stretch();
        } else {
          this.stretchElement.reset();
        }
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

      var menuToggle = this.elements.menuToggle;

      if (menuToggle && !event.target.closest(this.getSettings('selectors.menuToggle'))) {
        menuToggle.classList.remove('zeus-active');
      }
    }
  }]);

  return Zeus_Menu;
}(elementorModules.frontend.handlers.Base);

(0, _utils.registerWidget)(Zeus_Menu, 'zeus-menu');

},{"../lib/utils":1}]},{},[2])
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm5vZGVfbW9kdWxlcy9icm93c2VyLXBhY2svX3ByZWx1ZGUuanMiLCJzcmMvbGliL3V0aWxzLmpzIiwic3JjL3dpZGdldHMvbWVudS5qcyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFBQTs7Ozs7Ozs7QUNBTyxJQUFNLGNBQWMsR0FBRyxTQUFqQixjQUFpQixDQUFDLFNBQUQsRUFBWSxVQUFaLEVBQTZDO0FBQUEsTUFBckIsSUFBcUIsdUVBQWQsU0FBYzs7QUFDdkUsTUFBSSxFQUFFLFNBQVMsSUFBSSxVQUFmLENBQUosRUFBZ0M7QUFDNUI7QUFDSDtBQUVEO0FBQ0o7QUFDQTtBQUNBOzs7QUFDSSxFQUFBLE1BQU0sQ0FBQyxNQUFELENBQU4sQ0FBZSxFQUFmLENBQWtCLHlCQUFsQixFQUE2QyxZQUFNO0FBQy9DLFFBQU0sVUFBVSxHQUFHLFNBQWIsVUFBYSxDQUFDLFFBQUQsRUFBYztBQUM3QixNQUFBLGlCQUFpQixDQUFDLGVBQWxCLENBQWtDLFVBQWxDLENBQTZDLFNBQTdDLEVBQXdEO0FBQ3BELFFBQUEsUUFBUSxFQUFSO0FBRG9ELE9BQXhEO0FBR0gsS0FKRDs7QUFNQSxJQUFBLGlCQUFpQixDQUFDLEtBQWxCLENBQXdCLFNBQXhCLGtDQUE0RCxVQUE1RCxjQUEwRSxJQUExRSxHQUFrRixVQUFsRjtBQUNILEdBUkQ7QUFTSCxDQWxCTTs7Ozs7Ozs7Ozs7Ozs7QUNBUDs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7QUFFTyxJQUFNLFNBQVMsR0FBRyxTQUFaLFNBQVksQ0FBQyxPQUFELEVBQTRCO0FBQUEsTUFBbEIsUUFBa0IsdUVBQVAsRUFBTzs7QUFDakQsTUFBTSxPQUFPLEdBQUc7QUFDWixJQUFBLFFBQVEsRUFBRSxHQURFO0FBRVosSUFBQSxPQUFPLEVBQUUsSUFGRztBQUdaLElBQUEsT0FBTyxFQUFFLENBSEc7QUFJWixJQUFBLFFBQVEsRUFBRTtBQUpFLEdBQWhCO0FBT0EsRUFBQSxNQUFNLENBQUMsTUFBUCxDQUFjLE9BQWQsRUFBdUIs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QUFYLENBQWlCLE9BQWpCLEdBQTJCLE1BQTNCO0FBQ0gsV0FGRCxNQUVPO0FBQ0gsWUFBQSxVQUFVLENBQUMsS0FBWCxDQUFpQixPQUFqQixHQUEyQixPQUEzQjtBQUVBLFlBQUEsTUFBTSxDQUFDLHFCQUFQLENBQTZCLElBQTdCO0FBQ0g7QUFDSixTQVZEOztBQVlBLFFBQUEsTUFBTSxDQUFDLHFCQUFQLENBQTZCLElBQTdCO0FBQ0g7O0FBRUQsVUFBSSxVQUFVLEdBQUcsS0FBSyxRQUFMLENBQWMsVUFBL0I7O0FBQ0EsVUFBSSxVQUFVLElBQUksQ0FBQyxLQUFLLENBQUMsTUFBTixDQUFhLE9BQWIsQ0FBcUIsS0FBSyxXQUFMLENBQWlCLHNCQUFqQixDQUFyQixDQUFuQixFQUFtRjtBQUMvRSxRQUFBLFVBQVUsQ0FBQyxTQUFYLENBQXFCLE1BQXJCLENBQTRCLGFBQTVCO0FBQ0g7QUFDSjs7OztFQS9TbUIsZ0JBQWdCLENBQUMsUUFBakIsQ0FBMEIsUUFBMUIsQ0FBbUMsSTs7QUFrVDNELDJCQUFlLFNBQWYsRUFBMEIsV0FBMUIiLCJmaWxlIjoiZ2VuZXJhdGVkLmpzIiwic291cmNlUm9vdCI6IiIsInNvdXJjZXNDb250ZW50IjpbIihmdW5jdGlvbigpe2Z1bmN0aW9uIHIoZSxuLHQpe2Z1bmN0aW9uIG8oaSxmKXtpZighbltpXSl7aWYoIWVbaV0pe3ZhciBjPVwiZnVuY3Rpb25cIj09dHlwZW9mIHJlcXVpcmUmJnJlcXVpcmU7aWYoIWYmJmMpcmV0dXJuIGMoaSwhMCk7aWYodSlyZXR1cm4gdShpLCEwKTt2YXIgYT1uZXcgRXJyb3IoXCJDYW5ub3QgZmluZCBtb2R1bGUgJ1wiK2krXCInXCIpO3Rocm93IGEuY29kZT1cIk1PRFVMRV9OT1RfRk9VTkRcIixhfXZhciBwPW5baV09e2V4cG9ydHM6e319O2VbaV1bMF0uY2FsbChwLmV4cG9ydHMsZnVuY3Rpb24ocil7dmFyIG49ZVtpXVsxXVtyXTtyZXR1cm4gbyhufHxyKX0scCxwLmV4cG9ydHMscixlLG4sdCl9cmV0dXJuIG5baV0uZXhwb3J0c31mb3IodmFyIHU9XCJmdW5jdGlvblwiPT10eXBlb2YgcmVxdWlyZSYmcmVxdWlyZSxpPTA7aTx0Lmxlbmd0aDtpKyspbyh0W2ldKTtyZXR1cm4gb31yZXR1cm4gcn0pKCkiLCJleHBvcnQgY29uc3QgcmVnaXN0ZXJXaWRnZXQgPSAoY2xhc3NOYW1lLCB3aWRnZXROYW1lLCBza2luID0gJ2RlZmF1bHQnKSA9PiB7XG4gICAgaWYgKCEoY2xhc3NOYW1lIHx8IHdpZGdldE5hbWUpKSB7XG4gICAgICAgIHJldHVybjtcbiAgICB9XG5cbiAgICAvKipcbiAgICAgKiBCZWNhdXNlIEVsZW1lbnRvciBwbHVnaW4gdXNlcyBqUXVlcnkgY3VzdG9tIGV2ZW50LFxuICAgICAqIFdlIGFsc28gaGF2ZSB0byB1c2UgalF1ZXJ5IHRvIHVzZSB0aGlzIGV2ZW50XG4gICAgICovXG4gICAgalF1ZXJ5KHdpbmRvdykub24oJ2VsZW1lbnRvci9mcm9udGVuZC9pbml0JywgKCkgPT4ge1xuICAgICAgICBjb25zdCBhZGRIYW5kbGVyID0gKCRlbGVtZW50KSA9PiB7XG4gICAgICAgICAgICBlbGVtZW50b3JGcm9udGVuZC5lbGVtZW50c0hhbmRsZXIuYWRkSGFuZGxlcihjbGFzc05hbWUsIHtcbiAgICAgICAgICAgICAgICAkZWxlbWVudCxcbiAgICAgICAgICAgIH0pO1xuICAgICAgICB9O1xuXG4gICAgICAgIGVsZW1lbnRvckZyb250ZW5kLmhvb2tzLmFkZEFjdGlvbihgZnJvbnRlbmQvZWxlbWVudF9yZWFkeS8ke3dpZGdldE5hbWV9LiR7c2tpbn1gLCBhZGRIYW5kbGVyKTtcbiAgICB9KTtcbn07XG4iLCJpbXBvcnQgeyByZWdpc3RlcldpZGdldCB9IGZyb20gJy4uL2xpYi91dGlscyc7XG5cbmV4cG9ydCBjb25zdCBuYXZGYWRlSW4gPSAoZWxlbWVudCwgX29wdGlvbnMgPSB7fSkgPT4ge1xuICAgIGNvbnN0IG9wdGlvbnMgPSB7XG4gICAgICAgIGR1cmF0aW9uOiAzMDAsXG4gICAgICAgIGRpc3BsYXk6IG51bGwsXG4gICAgICAgIG9wYWNpdHk6IDEsXG4gICAgICAgIGNhbGxiYWNrOiBudWxsLFxuICAgIH07XG5cbiAgICBPYmplY3QuYXNzaWduKG9wdGlvbnMsIF9vcHRpb25zKTtcblxuICAgIGVsZW1lbnQuc3R5bGUub3BhY2l0eSA9IDA7XG4gICAgZWxlbWVudC5zdHlsZS5kaXNwbGF5ID0gb3B0aW9ucy5kaXNwbGF5IHx8IFwiYmxvY2tcIjtcblxuICAgIHNldFRpbWVvdXQoKCkgPT4ge1xuICAgICAgICBlbGVtZW50LnN0eWxlLnRyYW5zaXRpb24gPSBgJHtvcHRpb25zLmR1cmF0aW9ufW1zIG9wYWNpdHkgZWFzZWA7XG4gICAgICAgIGVsZW1lbnQuc3R5bGUub3BhY2l0eSA9IG9wdGlvbnMub3BhY2l0eTtcbiAgICB9LCA1KTtcblxuICAgIHNldFRpbWVvdXQoKCkgPT4ge1xuICAgICAgICBlbGVtZW50LnN0eWxlLnJlbW92ZVByb3BlcnR5KFwidHJhbnNpdGlvblwiKTtcbiAgICAgICAgISFvcHRpb25zLmNhbGxiYWNrICYmIG9wdGlvbnMuY2FsbGJhY2soKTtcbiAgICB9LCBvcHRpb25zLmR1cmF0aW9uICsgNTApO1xufTtcblxuZXhwb3J0IGNvbnN0IG5hdkZhZGVPdXQgPSAoZWxlbWVudCwgX29wdGlvbnMgPSB7fSkgPT4ge1xuICAgIGNvbnN0IG9wdGlvbnMgPSB7XG4gICAgICAgIGR1cmF0aW9uOiAzMDAsXG4gICAgICAgIGRpc3BsYXk6IG51bGwsXG4gICAgICAgIG9wYWNpdHk6IDAsXG4gICAgICAgIGNhbGxiYWNrOiBudWxsLFxuICAgIH07XG5cbiAgICBPYmplY3QuYXNzaWduKG9wdGlvbnMsIF9vcHRpb25zKTtcblxuICAgIGVsZW1lbnQuc3R5bGUub3BhY2l0eSA9IDE7XG4gICAgZWxlbWVudC5zdHlsZS5kaXNwbGF5ID0gb3B0aW9ucy5kaXNwbGF5IHx8IFwiYmxvY2tcIjtcblxuICAgIHNldFRpbWVvdXQoKCkgPT4ge1xuICAgICAgICBlbGVtZW50LnN0eWxlLnRyYW5zaXRpb24gPSBgJHtvcHRpb25zLmR1cmF0aW9ufW1zIG9wYWNpdHkgZWFzZWA7XG4gICAgICAgIGVsZW1lbnQuc3R5bGUub3BhY2l0eSA9IG9wdGlvbnMub3BhY2l0eTtcbiAgICB9LCA1KTtcblxuICAgIHNldFRpbWVvdXQoKCkgPT4ge1xuICAgICAgICBlbGVtZW50LnN0eWxlLmRpc3BsYXkgPSBcIm5vbmVcIjtcbiAgICAgICAgZWxlbWVudC5zdHlsZS5yZW1vdmVQcm9wZXJ0eShcInRyYW5zaXRpb25cIik7XG4gICAgICAgICEhb3B0aW9ucy5jYWxsYmFjayAmJiBvcHRpb25zLmNhbGxiYWNrKCk7XG4gICAgfSwgb3B0aW9ucy5kdXJhdGlvbiArIDUwKTtcbn07XG5cbmV4cG9ydCBjb25zdCBmYWRlSW4gPSAoZWxlbWVudCwgc3BlZWQgPSBcIm5vcm1hbFwiLCBkaXNwbGF5LCBjYWxsYmFjayA9IG51bGwpID0+IHtcbiAgICBlbGVtZW50LnN0eWxlLm9wYWNpdHkgPSAwO1xuICAgIGVsZW1lbnQuc3R5bGUuZGlzcGxheSA9IGRpc3BsYXkgfHwgXCJibG9ja1wiO1xuXG4gICAgY29uc3QgZmFkZSA9ICgpID0+IHtcbiAgICAgICAgbGV0IG9wYWNpdHkgPSBwYXJzZUZsb2F0KGVsZW1lbnQuc3R5bGUub3BhY2l0eSk7XG5cbiAgICAgICAgaWYgKChvcGFjaXR5ICs9IHNwZWVkID09PSBcImZhc3RcIiA/IDAuMiA6IDAuMSkgPD0gMSkge1xuICAgICAgICAgICAgZWxlbWVudC5zdHlsZS5vcGFjaXR5ID0gb3BhY2l0eTtcblxuICAgICAgICAgICAgaWYgKG9wYWNpdHkgPT09IDEgJiYgY2FsbGJhY2spIHtcbiAgICAgICAgICAgICAgICBjYWxsYmFjaygpO1xuICAgICAgICAgICAgfVxuXG4gICAgICAgICAgICB3aW5kb3cucmVxdWVzdEFuaW1hdGlvbkZyYW1lKGZhZGUpO1xuICAgICAgICB9XG4gICAgfTtcblxuICAgIHdpbmRvdy5yZXF1ZXN0QW5pbWF0aW9uRnJhbWUoZmFkZSk7XG59O1xuXG5leHBvcnQgY29uc3QgZmFkZU91dCA9IChlbGVtZW50LCBzcGVlZCA9IFwibm9ybWFsXCIsIGRpc3BsYXksIGNhbGxiYWNrID0gbnVsbCkgPT4ge1xuICAgIGVsZW1lbnQuc3R5bGUub3BhY2l0eSA9IDE7XG4gICAgZWxlbWVudC5zdHlsZS5kaXNwbGF5ID0gZGlzcGxheSB8fCBcImJsb2NrXCI7XG5cbiAgICBjb25zdCBmYWRlID0gKCkgPT4ge1xuICAgICAgICBsZXQgb3BhY2l0eSA9IHBhcnNlRmxvYXQoZWxlbWVudC5zdHlsZS5vcGFjaXR5KTtcblxuICAgICAgICBpZiAoKG9wYWNpdHkgLT0gc3BlZWQgPT09IFwiZmFzdFwiID8gMC4yIDogMC4xKSA8IDApIHtcbiAgICAgICAgICAgIGVsZW1lbnQuc3R5bGUuZGlzcGxheSA9IFwibm9uZVwiO1xuICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgZWxlbWVudC5zdHlsZS5vcGFjaXR5ID0gb3BhY2l0eTtcblxuICAgICAgICAgICAgaWYgKG9wYWNpdHkgPT09IDAgJiYgY2FsbGJhY2spIHtcbiAgICAgICAgICAgICAgICBjYWxsYmFjaygpO1xuICAgICAgICAgICAgfVxuXG4gICAgICAgICAgICB3aW5kb3cucmVxdWVzdEFuaW1hdGlvbkZyYW1lKGZhZGUpO1xuICAgICAgICB9XG4gICAgfTtcblxuICAgIHdpbmRvdy5yZXF1ZXN0QW5pbWF0aW9uRnJhbWUoZmFkZSk7XG59O1xuXG5leHBvcnQgY29uc3QgZmFkZVRvZ2dsZSA9IChlbGVtZW50LCBzcGVlZCA9IFwibm9ybWFsXCIsIGRpc3BsYXksIGNhbGxiYWNrID0gbnVsbCkgPT5cbiAgICB3aW5kb3cuZ2V0Q29tcHV0ZWRTdHlsZShlbGVtZW50KS5kaXNwbGF5ID09PSBcIm5vbmVcIlxuICAgICAgICA/IGZhZGVJbihlbGVtZW50LCBzcGVlZCwgZGlzcGxheSwgY2FsbGJhY2spXG4gICAgICAgIDogZmFkZU91dChlbGVtZW50LCBzcGVlZCwgZGlzcGxheSwgY2FsbGJhY2spO1xuXG5jbGFzcyBaZXVzX01lbnUgZXh0ZW5kcyBlbGVtZW50b3JNb2R1bGVzLmZyb250ZW5kLmhhbmRsZXJzLkJhc2Uge1xuICAgIGdldERlZmF1bHRTZXR0aW5ncygpIHtcbiAgICAgICAgcmV0dXJuIHtcbiAgICAgICAgICAgIHNlbGVjdG9yczoge1xuICAgICAgICAgICAgICAgIG1lbnVXcmFwcGVyOiAnLnpldXMtbWVudS13cmFwcGVyJyxcbiAgICAgICAgICAgICAgICBoTWVudTogJy56ZXVzLW1lbnUtbGF5b3V0LWhvcml6b250YWwgLnpldXMtbWVudScsXG4gICAgICAgICAgICAgICAgbWVudVRvZ2dsZTogJy56ZXVzLW1lbnUtdG9nZ2xlJyxcbiAgICAgICAgICAgICAgICBtZW51VG9nZ2xlSWNvbjogJy56ZXVzLW1lbnUtdG9nZ2xlLWljb24nLFxuICAgICAgICAgICAgICAgIGRyb3Bkb3duTWVudTogJy56ZXVzLW1lbnUtdG9nZ2xlLWRyb3Bkb3duJyxcbiAgICAgICAgICAgICAgICBzdWJEcm9wZG93bjogJy56ZXVzLW1lbnUtbGF5b3V0LXZlcnRpY2FsIC56ZXVzLXN1Yi1pY29uLCAuemV1cy1kcm9wZG93bi1tZW51IC56ZXVzLXN1Yi1pY29uJyxcbiAgICAgICAgICAgICAgICBkcm9wZG93blNlYXJjaDogJy56ZXVzLXNlYXJjaGZvcm0tbWVudScsXG4gICAgICAgICAgICAgICAgZHJvcGRvd25TZWFyY2hMaW5rOiAnLnpldXMtc2VhcmNoLW1lbnUtaXRlbScsXG4gICAgICAgICAgICAgICAgZHJvcGRvd25TZWFyY2hJbnB1dDogJy56ZXVzLXNlYXJjaGZvcm0tbWVudSBpbnB1dC5maWVsZCcsXG4gICAgICAgICAgICB9LFxuICAgICAgICB9O1xuICAgIH1cblxuICAgIGdldERlZmF1bHRFbGVtZW50cygpIHtcbiAgICAgICAgY29uc3QgZWxlbWVudCA9IHRoaXMuJGVsZW1lbnQuZ2V0KDApO1xuICAgICAgICBjb25zdCBzZWxlY3RvcnMgPSB0aGlzLmdldFNldHRpbmdzKCdzZWxlY3RvcnMnKTtcblxuICAgICAgICByZXR1cm4ge1xuICAgICAgICAgICAgbWVudVdyYXBwZXI6IGVsZW1lbnQucXVlcnlTZWxlY3RvcihzZWxlY3RvcnMubWVudVdyYXBwZXIpLFxuICAgICAgICAgICAgaE1lbnU6IGVsZW1lbnQucXVlcnlTZWxlY3RvckFsbChzZWxlY3RvcnMuaE1lbnUpLFxuICAgICAgICAgICAgbWVudVRvZ2dsZTogZWxlbWVudC5xdWVyeVNlbGVjdG9yKHNlbGVjdG9ycy5tZW51VG9nZ2xlKSxcbiAgICAgICAgICAgIG1lbnVUb2dnbGVJY29uOiBlbGVtZW50LnF1ZXJ5U2VsZWN0b3Ioc2VsZWN0b3JzLm1lbnVUb2dnbGVJY29uKSxcbiAgICAgICAgICAgIGRyb3Bkb3duTWVudTogZWxlbWVudC5xdWVyeVNlbGVjdG9yKHNlbGVjdG9ycy5kcm9wZG93bk1lbnUpLFxuICAgICAgICAgICAgc3ViRHJvcGRvd246IGVsZW1lbnQucXVlcnlTZWxlY3RvckFsbChzZWxlY3RvcnMuc3ViRHJvcGRvd24pLFxuICAgICAgICAgICAgZHJvcGRvd25TZWFyY2g6IGVsZW1lbnQucXVlcnlTZWxlY3RvcihzZWxlY3RvcnMuZHJvcGRvd25TZWFyY2gpLFxuICAgICAgICAgICAgZHJvcGRvd25TZWFyY2hMaW5rOiBlbGVtZW50LnF1ZXJ5U2VsZWN0b3Ioc2VsZWN0b3JzLmRyb3Bkb3duU2VhcmNoTGluayksXG4gICAgICAgICAgICBkcm9wZG93blNlYXJjaElucHV0OiBlbGVtZW50LnF1ZXJ5U2VsZWN0b3Ioc2VsZWN0b3JzLmRyb3Bkb3duU2VhcmNoSW5wdXQpLFxuICAgICAgICB9O1xuICAgIH1cblxuICAgIG9uSW5pdCguLi5hcmdzKSB7XG4gICAgICAgIHN1cGVyLm9uSW5pdCguLi5hcmdzKTtcblxuICAgICAgICB0aGlzLnNldHVwRXZlbnRMaXN0ZW5lcnMoKTtcbiAgICAgICAgdGhpcy5mdWxsV2lkdGhEcm9wZG93bigpO1xuICAgIH1cblxuICAgIHNldHVwRXZlbnRMaXN0ZW5lcnMoKSB7XG4gICAgICAgIC8vIE9wZW4gZHJvcGRvd24gb2YgcGFyZW50IG1lbnUgb24gaG92ZXIgb25seSBmb3IgdGhlIGhvcml6b250YWwgbGF5b3V0XG4gICAgICAgIHRoaXMuZWxlbWVudHMuaE1lbnUuZm9yRWFjaCgobWVudSkgPT4ge1xuICAgICAgICAgICAgdmFyIHBhcmVudE1lbnVJdGVtcyA9IG1lbnUucXVlcnlTZWxlY3RvckFsbCgnLm1lbnUtaXRlbS1oYXMtY2hpbGRyZW4nKTtcbiAgICAgICAgICAgIHBhcmVudE1lbnVJdGVtcy5mb3JFYWNoKChwYXJlbnRNZW51SXRlbSkgPT4ge1xuICAgICAgICAgICAgICAgIHBhcmVudE1lbnVJdGVtLmFkZEV2ZW50TGlzdGVuZXIoJ21vdXNlZW50ZXInLCB0aGlzLm9uUGFyZW50TWVudUl0ZW1Nb3VzZWVudGVyLmJpbmQodGhpcykpO1xuICAgICAgICAgICAgICAgIHBhcmVudE1lbnVJdGVtLmFkZEV2ZW50TGlzdGVuZXIoJ21vdXNlbGVhdmUnLCB0aGlzLm9uUGFyZW50TWVudUl0ZW1Nb3VzZWxlYXZlLmJpbmQodGhpcykpO1xuICAgICAgICAgICAgfSk7XG4gICAgICAgIH0pO1xuXG4gICAgICAgIC8vIElmIGRyb3Bkb3duXG4gICAgICAgIHZhciBkcm9wZG93bk1lbnUgPSB0aGlzLmVsZW1lbnRzLmRyb3Bkb3duTWVudTtcbiAgICAgICAgaWYgKCBkcm9wZG93bk1lbnUgKSB7XG4gICAgICAgICAgICAvLyBEcm9wZG93biB0b2dnbGVcbiAgICAgICAgICAgIHRoaXMuZWxlbWVudHMubWVudVRvZ2dsZUljb24uYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCB0aGlzLm9uVG9nZ2xlQ2xpY2suYmluZCh0aGlzKSk7XG5cbiAgICAgICAgICAgIC8vIE9wZW4gc3VibWVudSBvbiBkcm9wZG93biB0b2dnbGVcbiAgICAgICAgICAgIHRoaXMuZWxlbWVudHMuc3ViRHJvcGRvd24uZm9yRWFjaCgodG9nZ2xlKSA9PiB7XG4gICAgICAgICAgICAgICAgdG9nZ2xlLnNldEF0dHJpYnV0ZSgnYXJpYS1leHBhbmRlZCcsICdmYWxzZScpO1xuXG4gICAgICAgICAgICAgICAgdG9nZ2xlLm9uY2xpY2sgPSBmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICAgICAgICAgIGlmICh0b2dnbGUuZ2V0QXR0cmlidXRlKCdhcmlhLWV4cGFuZGVkJykgPT09ICd0cnVlJykge1xuICAgICAgICAgICAgICAgICAgICAgICAgdG9nZ2xlLnNldEF0dHJpYnV0ZSgnYXJpYS1leHBhbmRlZCcsICdmYWxzZScpO1xuICAgICAgICAgICAgICAgICAgICAgICAgdG9nZ2xlLnBhcmVudE5vZGUuY2xhc3NMaXN0LnJlbW92ZSgnemV1cy1kcm9wZG93bi1vcGVuJyk7XG4gICAgICAgICAgICAgICAgICAgICAgICByZXR1cm47XG4gICAgICAgICAgICAgICAgICAgIH1cblxuICAgICAgICAgICAgICAgICAgICB0b2dnbGUuc2V0QXR0cmlidXRlKCdhcmlhLWV4cGFuZGVkJywgJ3RydWUnKTtcbiAgICAgICAgICAgICAgICAgICAgdG9nZ2xlLnBhcmVudE5vZGUuY2xhc3NMaXN0LmFkZCgnemV1cy1kcm9wZG93bi1vcGVuJyk7XG4gICAgICAgICAgICAgICAgICAgIHJldHVybjtcbiAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICB9KTtcbiAgICAgICAgfVxuXG4gICAgICAgIC8vIE9wZW4gc2VhcmNoIGZvcm1cbiAgICAgICAgdmFyIHNlYXJjaExpbmsgPSB0aGlzLmVsZW1lbnRzLmRyb3Bkb3duU2VhcmNoTGluaztcbiAgICAgICAgaWYgKCBzZWFyY2hMaW5rICkge1xuICAgICAgICAgICAgc2VhcmNoTGluay5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsIHRoaXMudG9nZ2xlRHJvcGRvd25TZWFyY2guYmluZCh0aGlzKSk7XG4gICAgICAgIH1cblxuXG4gICAgICAgIGlmICggZHJvcGRvd25NZW51ICkge1xuICAgICAgICAgICAgLy8gRnVsbCB3aWR0aCBkcm9wZG93blxuICAgICAgICAgICAgd2luZG93LmFkZEV2ZW50TGlzdGVuZXIoJ3Jlc2l6ZScsIHRoaXMuZnVsbFdpZHRoRHJvcGRvd24uYmluZCh0aGlzKSk7XG4gICAgICAgICAgICB3aW5kb3cuYWRkRXZlbnRMaXN0ZW5lcignb3JpZW50YXRpb25jaGFuZ2UnLCB0aGlzLmZ1bGxXaWR0aERyb3Bkb3duLmJpbmQodGhpcykpO1xuICAgICAgICB9XG5cbiAgICAgICAgLy8gQ2xvc2UgZWxlbWVudHMgd2hlbiBjbGlja2luZyBlbHNld2hlcmVcbiAgICAgICAgZG9jdW1lbnQuYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCB0aGlzLm9uRG9jdW1lbnRDbGljay5iaW5kKHRoaXMpKTtcblxuICAgICAgICAvLyBPbiBzdGlja3lcbiAgICAgICAgaWYgKCFkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCdib2R5JykuY2xhc3NMaXN0LmNvbnRhaW5zKCdlbGVtZW50b3ItZWRpdG9yLWFjdGl2ZScpXG4gICAgICAgICAgICAmJiAneWVzJyA9PT0gdGhpcy5nZXRFbGVtZW50U2V0dGluZ3MoJ2lzX3N0aWNreScpKSB7XG4gICAgICAgICAgICB0aGlzLm9uU3RpY2t5KCk7XG4gICAgICAgIH1cblxuICAgIH1cblxuICAgIG9uUGFyZW50TWVudUl0ZW1Nb3VzZWVudGVyKGV2ZW50KSB7XG4gICAgICAgIHZhciBwYXJlbnRNZW51SXRlbSA9IGV2ZW50LmN1cnJlbnRUYXJnZXQ7XG4gICAgICAgIHZhciBzdWJNZW51ID0gcGFyZW50TWVudUl0ZW0ucXVlcnlTZWxlY3RvcigndWwuc3ViLW1lbnUnKTtcblxuICAgICAgICBwYXJlbnRNZW51SXRlbS5jbGFzc0xpc3QuYWRkKCdzdWItaG92ZXInKTtcblxuICAgICAgICBuYXZGYWRlSW4oc3ViTWVudSk7XG4gICAgfVxuXG4gICAgb25QYXJlbnRNZW51SXRlbU1vdXNlbGVhdmUoZXZlbnQpIHtcbiAgICAgICAgdmFyIHBhcmVudE1lbnVJdGVtID0gZXZlbnQuY3VycmVudFRhcmdldDtcbiAgICAgICAgdmFyIHN1Yk1lbnUgPSBwYXJlbnRNZW51SXRlbS5xdWVyeVNlbGVjdG9yKCd1bC5zdWItbWVudScpO1xuXG4gICAgICAgIHBhcmVudE1lbnVJdGVtLmNsYXNzTGlzdC5yZW1vdmUoJ3N1Yi1ob3ZlcicpO1xuICAgICAgICBzdWJNZW51LnN0eWxlLnBvaW50ZXJFdmVudHMgPSAnbm9uZSc7XG5cbiAgICAgICAgbmF2RmFkZU91dChzdWJNZW51LCB7XG4gICAgICAgICAgICBjYWxsYmFjazogKCkgPT4ge1xuICAgICAgICAgICAgICAgIHN1Yk1lbnUuc3R5bGUucG9pbnRlckV2ZW50cyA9IG51bGw7XG4gICAgICAgICAgICB9LFxuICAgICAgICB9KTtcbiAgICB9XG5cbiAgICBvblRvZ2dsZUNsaWNrKGV2ZW50KSB7XG4gICAgICAgIGV2ZW50LnN0b3BQcm9wYWdhdGlvbigpO1xuICAgICAgICB0aGlzLmVsZW1lbnRzLm1lbnVUb2dnbGUuY2xhc3NMaXN0LnRvZ2dsZSgnemV1cy1hY3RpdmUnKTtcbiAgICB9XG5cbiAgICB0b2dnbGVEcm9wZG93blNlYXJjaChldmVudCkge1xuICAgICAgICBldmVudC5wcmV2ZW50RGVmYXVsdCgpO1xuICAgICAgICBldmVudC5zdG9wUHJvcGFnYXRpb24oKTtcblxuICAgICAgICBmYWRlVG9nZ2xlKHRoaXMuZWxlbWVudHMuZHJvcGRvd25TZWFyY2gsICdmYXN0Jyk7XG4gICAgICAgIHRoaXMuZWxlbWVudHMuZHJvcGRvd25TZWFyY2hJbnB1dC5mb2N1cygpO1xuICAgIH1cblxuICAgIGZ1bGxXaWR0aERyb3Bkb3duKGV2ZW50KSB7XG4gICAgICAgIHZhciBkcm9wZG93bk1lbnUgPSB0aGlzLmVsZW1lbnRzLmRyb3Bkb3duTWVudTtcbiAgICAgICAgaWYgKCBkcm9wZG93bk1lbnUgKSB7XG4gICAgICAgICAgICB0aGlzLnN0cmV0Y2hFbGVtZW50ID0gbmV3IGVsZW1lbnRvck1vZHVsZXMuZnJvbnRlbmQudG9vbHMuU3RyZXRjaEVsZW1lbnQoe1xuICAgICAgICAgICAgICBlbGVtZW50OiBkcm9wZG93bk1lbnVcbiAgICAgICAgICAgIH0pO1xuXG4gICAgICAgICAgICBpZiAodGhpcy5nZXRFbGVtZW50U2V0dGluZ3MoJ2Ryb3Bkb3duX2Z1bGxfd2lkdGgnKSkge1xuICAgICAgICAgICAgICAgIHRoaXMuc3RyZXRjaEVsZW1lbnQuc3RyZXRjaCgpO1xuICAgICAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgICAgICB0aGlzLnN0cmV0Y2hFbGVtZW50LnJlc2V0KCk7XG4gICAgICAgICAgICB9XG4gICAgICAgIH1cbiAgICB9XG5cbiAgICBvblN0aWNreSgpIHtcbiAgICAgICAgY29uc3QgbWVudVdyYXBwZXIgPSB0aGlzLmVsZW1lbnRzLm1lbnVXcmFwcGVyO1xuXG4gICAgICAgIGlmIChtZW51V3JhcHBlci5oYXNBdHRyaWJ1dGUoJ2RhdGEtZGVzdHJveS1zdGlja3knKSkge1xuICAgICAgICAgICAgY29uc3QgZGVzdHJveVdpZHRoID0gbWVudVdyYXBwZXIuZ2V0QXR0cmlidXRlKCdkYXRhLWRlc3Ryb3ktc3RpY2t5Jyk7XG5cbiAgICAgICAgICAgIGlmICh3aW5kb3cuaW5uZXJXaWR0aCA8IGRlc3Ryb3lXaWR0aCkge1xuICAgICAgICAgICAgICAgIHJldHVybjtcbiAgICAgICAgICAgIH1cbiAgICAgICAgfVxuXG4gICAgICAgIHZhciBzZWxlY3RvciA9IG1lbnVXcmFwcGVyLmNsb3Nlc3QoJy5lbGVtZW50b3ItdG9wLXNlY3Rpb24nKSxcbiAgICAgICAgICAgIHRvcCA9IHNlbGVjdG9yLm9mZnNldFRvcDtcblxuICAgICAgICAvLyBBZGQgc3RpY2t5IGNsYXNzXG4gICAgICAgIHNlbGVjdG9yLmNsYXNzTGlzdC5hZGQoJ3pldXMtaGFzLXN0aWNreScpO1xuXG4gICAgICAgIC8vIEFkZCB3cmFwcGVyXG4gICAgICAgIHNlbGVjdG9yLmluc2VydEFkamFjZW50SFRNTCgnYmVmb3JlYmVnaW4nLCAnPHNwYW4gY2xhc3M9XCJ6ZXVzLXN0aWNreS13cmFwcGVyXCI+PC9zcGFuPicpO1xuICAgICAgICBzZWxlY3Rvci5wcmV2aW91c1NpYmxpbmcuYXBwZW5kQ2hpbGQoc2VsZWN0b3IpO1xuXG4gICAgICAgIGZ1bmN0aW9uIG9uU2Nyb2xsKCkge1xuXG4gICAgICAgICAgICAvLyBBZG1pbiBiYXIgb2Zmc2V0XG4gICAgICAgICAgICB2YXIgYmFyT2Zmc2V0ID0gMDtcbiAgICAgICAgICAgIGlmIChkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCdib2R5JykuY2xhc3NMaXN0LmNvbnRhaW5zKCdhZG1pbi1iYXInKSAmJiB3aW5kb3cuaW5uZXJXaWR0aCA+IDYwMCkge1xuICAgICAgICAgICAgICAgIGJhck9mZnNldCA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCd3cGFkbWluYmFyJykub2Zmc2V0SGVpZ2h0O1xuICAgICAgICAgICAgfVxuXG4gICAgICAgICAgICBpZiAoIHdpbmRvdy5wYWdlWU9mZnNldCA+IHRvcCApIHtcbiAgICAgICAgICAgICAgICBzZWxlY3Rvci5zdHlsZS5wb3NpdGlvbiA9ICdmaXhlZCc7XG4gICAgICAgICAgICAgICAgc2VsZWN0b3Iuc3R5bGUud2lkdGggPSAnMTAwJSc7XG4gICAgICAgICAgICAgICAgc2VsZWN0b3Iuc3R5bGUudG9wID0gYmFyT2Zmc2V0ICsgJ3B4JztcbiAgICAgICAgICAgICAgICBzZWxlY3Rvci5zdHlsZS5iYWNrZ3JvdW5kQ29sb3IgPSBtZW51V3JhcHBlci5nZXRBdHRyaWJ1dGUoJ2RhdGEtYmFja2dyb3VuZCcpO1xuICAgICAgICAgICAgICAgIHNlbGVjdG9yLnN0eWxlLnpJbmRleCA9ICc5OTk5JztcblxuICAgICAgICAgICAgICAgIG1lbnVXcmFwcGVyLmNsYXNzTGlzdC5hZGQoJ3pldXMtaXMtc3RpY2t5Jyk7XG5cbiAgICAgICAgICAgICAgICBpZiAoIG1lbnVXcmFwcGVyLmNsYXNzTGlzdC5jb250YWlucygnemV1cy1oYXMtc2hhZG93JykgKSB7XG4gICAgICAgICAgICAgICAgICAgIHNlbGVjdG9yLmNsYXNzTGlzdC5hZGQoJ3pldXMtc3RpY2t5LXNoYWRvdycpO1xuICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICAgICAgc2VsZWN0b3Iuc3R5bGUucG9zaXRpb24gPSAnJztcbiAgICAgICAgICAgICAgICBzZWxlY3Rvci5zdHlsZS53aWR0aCA9ICcnO1xuICAgICAgICAgICAgICAgIHNlbGVjdG9yLnN0eWxlLnRvcCA9ICcnO1xuICAgICAgICAgICAgICAgIHNlbGVjdG9yLnN0eWxlLmJhY2tncm91bmRDb2xvciA9ICcnO1xuICAgICAgICAgICAgICAgIHNlbGVjdG9yLnN0eWxlLnpJbmRleCA9ICcnO1xuXG4gICAgICAgICAgICAgICAgbWVudVdyYXBwZXIuY2xhc3NMaXN0LnJlbW92ZSgnemV1cy1pcy1zdGlja3knKTtcblxuICAgICAgICAgICAgICAgIGlmICggbWVudVdyYXBwZXIuY2xhc3NMaXN0LmNvbnRhaW5zKCd6ZXVzLWhhcy1zaGFkb3cnKSApIHtcbiAgICAgICAgICAgICAgICAgICAgc2VsZWN0b3IuY2xhc3NMaXN0LnJlbW92ZSgnemV1cy1zdGlja3ktc2hhZG93Jyk7XG4gICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgfVxuXG4gICAgICAgIH1cblxuICAgICAgICB3aW5kb3cuYWRkRXZlbnRMaXN0ZW5lcignc2Nyb2xsJywgb25TY3JvbGwpO1xuICAgICAgICB3aW5kb3cuYWRkRXZlbnRMaXN0ZW5lcigncmVzaXplJywgb25TY3JvbGwpO1xuICAgICAgICB3aW5kb3cuYWRkRXZlbnRMaXN0ZW5lcignb3JpZW50YXRpb25jaGFuZ2UnLCBvblNjcm9sbCk7XG5cbiAgICAgICAgZnVuY3Rpb24gd3JhcHBlclN0eWxlKCkge1xuICAgICAgICAgICAgc2VsZWN0b3IucGFyZW50Tm9kZS5zdHlsZS5kaXNwbGF5ID0gJ2Jsb2NrJztcbiAgICAgICAgICAgIHNlbGVjdG9yLnBhcmVudE5vZGUuc3R5bGUud2lkdGggPSB3aW5kb3cuaW5uZXJXaWR0aCArICdweCc7XG4gICAgICAgICAgICBzZWxlY3Rvci5wYXJlbnROb2RlLnN0eWxlLmhlaWdodCA9IHNlbGVjdG9yLm9mZnNldEhlaWdodCArICdweCc7XG4gICAgICAgIH1cblxuICAgICAgICB3aW5kb3cuYWRkRXZlbnRMaXN0ZW5lcignbG9hZCcsIHdyYXBwZXJTdHlsZSk7XG4gICAgICAgIHdpbmRvdy5hZGRFdmVudExpc3RlbmVyKCdyZXNpemUnLCB3cmFwcGVyU3R5bGUpO1xuICAgICAgICB3aW5kb3cuYWRkRXZlbnRMaXN0ZW5lcignb3JpZW50YXRpb25jaGFuZ2UnLCB3cmFwcGVyU3R5bGUpO1xuXG4gICAgICAgIC8vIEFuY2hvciBsaW5rc1xuICAgICAgICBkb2N1bWVudC5xdWVyeVNlbGVjdG9yQWxsKCcuemV1cy1tZW51LXdyYXBwZXIgYVtocmVmKj1cIiNcIl06bm90KFtocmVmPVwiI1wiXSknKS5mb3JFYWNoKChsaW5rKSA9PiB7XG4gICAgICAgICAgICBsaW5rLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgZnVuY3Rpb24oZSkge1xuICAgICAgICAgICAgICAgIFxuICAgICAgICAgICAgICAgIGNvbnN0IGhyZWYgPSBsaW5rLmdldEF0dHJpYnV0ZSgnaHJlZicpO1xuICAgICAgICAgICAgICAgIGNvbnN0IGlkID0gaHJlZi5zdWJzdHJpbmcoaHJlZi5pbmRleE9mKCcjJykpLnNsaWNlKDEpO1xuXG4gICAgICAgICAgICAgICAgLy8gQ2hlY2sgc2VsZWN0b3JcbiAgICAgICAgICAgICAgICBjb25zdCB2YWxpZFNlbGVjdG9yID0gKChkdW1teUVsZW1lbnQpID0+IChzZWxlY3RvcikgPT4ge1xuICAgICAgICAgICAgICAgICAgICB0cnkge1xuICAgICAgICAgICAgICAgICAgICAgICAgZHVtbXlFbGVtZW50LnF1ZXJ5U2VsZWN0b3Ioc2VsZWN0b3IpO1xuICAgICAgICAgICAgICAgICAgICB9IGNhdGNoIHtcbiAgICAgICAgICAgICAgICAgICAgICAgIHJldHVybiBmYWxzZTtcbiAgICAgICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICAgICAgICByZXR1cm4gdHJ1ZTtcbiAgICAgICAgICAgICAgICB9KTtcblxuICAgICAgICAgICAgICAgIGlmICh2YWxpZFNlbGVjdG9yKCcjJyArIGlkKSkge1xuICAgICAgICAgICAgICAgICAgIHZhciB0YXJnZXRFbGVtID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcignIycgKyBpZCk7XG4gICAgICAgICAgICAgICAgfVxuXG4gICAgICAgICAgICAgICAgaWYgKCAnJyAhPT0gaWQgJiYgISEgdGFyZ2V0RWxlbSApIHtcbiAgICAgICAgICAgICAgICAgICAgZS5wcmV2ZW50RGVmYXVsdCgpO1xuICAgICAgICAgICAgICAgICAgICBlLnN0b3BQcm9wYWdhdGlvbigpO1xuXG4gICAgICAgICAgICAgICAgICAgIGxldCBzY3JvbGxQb3NpdGlvbiA9IHRhcmdldEVsZW0ub2Zmc2V0VG9wIC0gc2VsZWN0b3Iub2Zmc2V0SGVpZ2h0O1xuXG4gICAgICAgICAgICAgICAgICAgIGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJ2h0bWwnKS5zY3JvbGxUbyh7XG4gICAgICAgICAgICAgICAgICAgICAgICB0b3A6IHNjcm9sbFBvc2l0aW9uLFxuICAgICAgICAgICAgICAgICAgICAgICAgYmVoYXZpb3I6ICdzbW9vdGgnLFxuICAgICAgICAgICAgICAgICAgICB9KTtcbiAgICAgICAgICAgICAgICB9XG5cbiAgICAgICAgICAgIH0pO1xuICAgICAgICB9KTtcblxuICAgICAgICAvLyBHbyB0b3AgbGlua1xuICAgICAgICB2YXIgZ29Ub3BMaW5rID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcignLnpldXMtbWVudS13cmFwcGVyIGFbaHJlZj1cIiNnby10b3BcIl0nKSxcbiAgICAgICAgICAgIGdvVG9wTGlua1NsYXNoID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcignLnpldXMtbWVudS13cmFwcGVyIGFbaHJlZj1cIi8jZ28tdG9wXCJdJyk7XG5cbiAgICAgICAgaWYgKCBnb1RvcExpbmsgKSB7XG4gICAgICAgICAgICBnb1RvcExpbmsuYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCBnb1RvcCk7XG4gICAgICAgIH1cblxuICAgICAgICBpZiAoIGdvVG9wTGlua1NsYXNoICkge1xuICAgICAgICAgICAgZ29Ub3BMaW5rU2xhc2guYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCBnb1RvcCk7XG4gICAgICAgIH1cblxuICAgICAgICBmdW5jdGlvbiBnb1RvcChlKSB7XG4gICAgICAgICAgICBlLnByZXZlbnREZWZhdWx0KCk7XG4gICAgICAgICAgICAgICAgXG4gICAgICAgICAgICBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCdodG1sJykuc2Nyb2xsVG8oe1xuICAgICAgICAgICAgICAgIHRvcDogMCxcbiAgICAgICAgICAgICAgICBiZWhhdmlvcjogJ3Ntb290aCcsXG4gICAgICAgICAgICB9KTtcbiAgICAgICAgfVxuICAgIH1cblxuICAgIG9uRG9jdW1lbnRDbGljayhldmVudCkge1xuICAgICAgICB2YXIgc2VhcmNoTGluayA9IHRoaXMuZWxlbWVudHMuZHJvcGRvd25TZWFyY2hMaW5rO1xuICAgICAgICBpZiAoIHNlYXJjaExpbmsgJiYgIWV2ZW50LnRhcmdldC5jbG9zZXN0KHRoaXMuZ2V0U2V0dGluZ3MoJ3NlbGVjdG9ycy5kcm9wZG93blNlYXJjaCcpKSApIHtcbiAgICAgICAgICAgIHZhciBzZWFyY2hGb3JtID0gdGhpcy5lbGVtZW50cy5kcm9wZG93blNlYXJjaDtcblxuICAgICAgICAgICAgY29uc3QgZmFkZSA9ICgpID0+IHtcbiAgICAgICAgICAgICAgICBsZXQgb3BhY2l0eSA9IHBhcnNlRmxvYXQoc2VhcmNoRm9ybS5zdHlsZS5vcGFjaXR5KTtcblxuICAgICAgICAgICAgICAgIGlmICgob3BhY2l0eSAtPSAwLjEpIDwgMCkge1xuICAgICAgICAgICAgICAgICAgICBzZWFyY2hGb3JtLnN0eWxlLmRpc3BsYXkgPSAnbm9uZSc7XG4gICAgICAgICAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgICAgICAgICAgc2VhcmNoRm9ybS5zdHlsZS5vcGFjaXR5ID0gb3BhY2l0eTtcblxuICAgICAgICAgICAgICAgICAgICB3aW5kb3cucmVxdWVzdEFuaW1hdGlvbkZyYW1lKGZhZGUpO1xuICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgIH07XG5cbiAgICAgICAgICAgIHdpbmRvdy5yZXF1ZXN0QW5pbWF0aW9uRnJhbWUoZmFkZSk7XG4gICAgICAgIH1cblxuICAgICAgICB2YXIgbWVudVRvZ2dsZSA9IHRoaXMuZWxlbWVudHMubWVudVRvZ2dsZTtcbiAgICAgICAgaWYgKG1lbnVUb2dnbGUgJiYgIWV2ZW50LnRhcmdldC5jbG9zZXN0KHRoaXMuZ2V0U2V0dGluZ3MoJ3NlbGVjdG9ycy5tZW51VG9nZ2xlJykpKSB7XG4gICAgICAgICAgICBtZW51VG9nZ2xlLmNsYXNzTGlzdC5yZW1vdmUoJ3pldXMtYWN0aXZlJyk7XG4gICAgICAgIH1cbiAgICB9XG59XG5cbnJlZ2lzdGVyV2lkZ2V0KFpldXNfTWVudSwgJ3pldXMtbWVudScpOyJdfQ==
