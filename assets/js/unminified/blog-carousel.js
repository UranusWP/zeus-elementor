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
exports.default = void 0;

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

var Zeus_Carousel = /*#__PURE__*/function (_elementorModules$fro) {
  _inherits(Zeus_Carousel, _elementorModules$fro);

  var _super = _createSuper(Zeus_Carousel);

  function Zeus_Carousel() {
    _classCallCheck(this, Zeus_Carousel);

    return _super.apply(this, arguments);
  }

  _createClass(Zeus_Carousel, [{
    key: "getDefaultSettings",
    value: function getDefaultSettings() {
      return {
        selectors: {
          carousel: '.zeus-carousel-container',
          carouselNextBtn: '.swiper-button-next-' + this.getID(),
          carouselPrevBtn: '.swiper-button-prev-' + this.getID(),
          carouselPagination: '.swiper-pagination-' + this.getID()
        },
        effect: 'slide',
        loop: false,
        autoplay: 0,
        speed: 400,
        navigation: false,
        pagination: false,
        centeredSlides: false,
        pauseOnHover: false,
        slidesPerView: {
          desktop: 3,
          tablet: 2,
          mobile: 1
        },
        slidesPerGroup: {
          desktop: 3,
          tablet: 2,
          mobile: 1
        },
        spaceBetween: {
          desktop: 10,
          tablet: 10,
          mobile: 10
        },
        swiperInstance: null
      };
    }
  }, {
    key: "getDefaultElements",
    value: function getDefaultElements() {
      var element = this.$element.get(0);
      var selectors = this.getSettings('selectors');
      return {
        carousel: element.querySelector(selectors.carousel),
        carouselNextBtn: element.querySelectorAll(selectors.carouselNextBtn),
        carouselPrevBtn: element.querySelectorAll(selectors.carouselPrevBtn),
        carouselPagination: element.querySelectorAll(selectors.carouselPagination)
      };
    }
  }, {
    key: "onInit",
    value: function onInit() {
      var _get2;

      for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
        args[_key] = arguments[_key];
      }

      (_get2 = _get(_getPrototypeOf(Zeus_Carousel.prototype), "onInit", this)).call.apply(_get2, [this].concat(args));

      this.setUserSettings();
      this.initSwiper();
      this.setupEventListeners();
    }
  }, {
    key: "setUserSettings",
    value: function setUserSettings() {
      var settings = this.getSettings();
      var userSettings = JSON.parse(this.elements.carousel.getAttribute('data-settings'));
      var currentSettings = {
        effect: !!userSettings.effect ? userSettings.effect : settings.effect,
        loop: !!userSettings.loop ? Boolean(Number(userSettings.loop)) : settings.loop,
        autoplay: !!userSettings.autoplay ? Number(userSettings.autoplay) : settings.autoplay,
        speed: !!userSettings.speed ? Number(userSettings.speed) : settings.speed,
        navigation: !!userSettings.arrows ? Boolean(Number(userSettings.arrows)) : settings.navigation,
        pagination: !!userSettings.dots ? Boolean(Number(userSettings.dots)) : settings.pagination,
        pauseOnHover: !!userSettings['pause-on-hover'] ? JSON.parse(userSettings['pause-on-hover']) : settings.pauseOnHover,
        slidesPerView: {
          desktop: !!userSettings.items ? Number(userSettings.items) : settings.slidesPerView.desktop,
          tablet: !!userSettings['items-tablet'] ? Number(userSettings['items-tablet']) : settings.slidesPerView.tablet,
          mobile: !!userSettings['items-mobile'] ? Number(userSettings['items-mobile']) : settings.slidesPerView.mobile
        },
        slidesPerGroup: {
          desktop: !!userSettings.slides ? Number(userSettings.slides) : settings.slidesPerGroup.desktop,
          tablet: !!userSettings['slides-tablet'] ? Number(userSettings['slides-tablet']) : settings.slidesPerGroup.tablet,
          mobile: !!userSettings['slides-mobile'] ? Number(userSettings['slides-mobile']) : settings.slidesPerGroup.mobile
        },
        spaceBetween: {
          desktop: !!userSettings.margin ? Number(userSettings.margin) : settings.spaceBetween.desktop,
          tablet: !!userSettings['margin-tablet'] ? Number(userSettings['margin-tablet']) : settings.spaceBetween.tablet,
          mobile: !!userSettings['margin-mobile'] ? Number(userSettings['margin-mobile']) : settings.spaceBetween.mobile
        }
      };
      currentSettings.centeredSlides = 'coverflow' === currentSettings.effect ? true : settings.centeredSlides;
      this.setSettings(currentSettings);
    }
  }, {
    key: "initSwiper",
    value: function initSwiper() {
      var swiperSlider;

      if ('undefined' === typeof Swiper) {
        // Improved Asset Loading enabled
        var asyncSwiper = elementorFrontend.utils.swiper;
        new asyncSwiper(this.elements.carousel, this.swiperOptions()).then(function (newSwiperSliderInstance) {
          swiperSlider = newSwiperSliderInstance;
        });
      } else {
        // Improved Asset Loading disabled
        swiperSlider = new Swiper(this.elements.carousel, this.swiperOptions());
      }

      this.setSettings({
        swiperInstance: swiperSlider
      });
    }
  }, {
    key: "swiperOptions",
    value: function swiperOptions() {
      var settings = this.getSettings();
      var swiperOptions = {
        direction: 'horizontal',
        effect: settings.effect,
        loop: settings.loop,
        speed: settings.speed,
        centeredSlides: settings.centeredSlides,
        autoHeight: true,
        autoplay: !settings.autoplay ? false : {
          delay: settings.autoplay
        },
        navigation: !settings.navigation ? false : {
          nextEl: settings.selectors.carouselNextBtn,
          prevEl: settings.selectors.carouselPrevBtn
        },
        pagination: !settings.pagination ? false : {
          el: settings.selectors.carouselPagination,
          clickable: true
        }
      };

      if (settings.effect === 'fade') {
        swiperOptions.items = 1;
      } else {
        swiperOptions.breakpoints = {
          1024: {
            slidesPerView: settings.slidesPerView.desktop,
            slidesPerGroup: settings.slidesPerGroup.desktop,
            spaceBetween: settings.spaceBetween.desktop
          },
          768: {
            slidesPerView: settings.slidesPerView.tablet,
            slidesPerGroup: settings.slidesPerGroup.tablet,
            spaceBetween: settings.spaceBetween.tablet
          },
          320: {
            slidesPerView: settings.slidesPerView.mobile,
            slidesPerGroup: settings.slidesPerGroup.mobile,
            spaceBetween: settings.spaceBetween.mobile
          }
        };
      }

      return swiperOptions;
    }
  }, {
    key: "setupEventListeners",
    value: function setupEventListeners() {
      if (this.getSettings('pauseOnHover')) {
        this.elements.carousel.addEventListener('mouseenter', this.pauseSwiper.bind(this));
        this.elements.carousel.addEventListener('mouseleave', this.resumeSwiper.bind(this));
      }
    }
  }, {
    key: "pauseSwiper",
    value: function pauseSwiper(event) {
      this.getSettings('swiperInstance').autoplay.stop();
    }
  }, {
    key: "resumeSwiper",
    value: function resumeSwiper(event) {
      this.getSettings('swiperInstance').autoplay.start();
    }
  }]);

  return Zeus_Carousel;
}(elementorModules.frontend.handlers.Base);

var _default = Zeus_Carousel;
exports.default = _default;

},{}],3:[function(require,module,exports){
"use strict";

function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

var _utils = require("../lib/utils");

var _carousel = _interopRequireDefault(require("./base/carousel"));

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function"); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, writable: true, configurable: true } }); if (superClass) _setPrototypeOf(subClass, superClass); }

function _setPrototypeOf(o, p) { _setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) { o.__proto__ = p; return o; }; return _setPrototypeOf(o, p); }

function _createSuper(Derived) { var hasNativeReflectConstruct = _isNativeReflectConstruct(); return function _createSuperInternal() { var Super = _getPrototypeOf(Derived), result; if (hasNativeReflectConstruct) { var NewTarget = _getPrototypeOf(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return _possibleConstructorReturn(this, result); }; }

function _possibleConstructorReturn(self, call) { if (call && (_typeof(call) === "object" || typeof call === "function")) { return call; } return _assertThisInitialized(self); }

function _assertThisInitialized(self) { if (self === void 0) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return self; }

function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); return true; } catch (e) { return false; } }

function _getPrototypeOf(o) { _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf : function _getPrototypeOf(o) { return o.__proto__ || Object.getPrototypeOf(o); }; return _getPrototypeOf(o); }

var Zeus_BlogCarousel = /*#__PURE__*/function (_Zeus_Carousel) {
  _inherits(Zeus_BlogCarousel, _Zeus_Carousel);

  var _super = _createSuper(Zeus_BlogCarousel);

  function Zeus_BlogCarousel() {
    _classCallCheck(this, Zeus_BlogCarousel);

    return _super.apply(this, arguments);
  }

  return Zeus_BlogCarousel;
}(_carousel.default);

(0, _utils.registerWidget)(Zeus_BlogCarousel, "zeus-blog-carousel");

},{"../lib/utils":1,"./base/carousel":2}]},{},[3])
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm5vZGVfbW9kdWxlcy9icm93c2VyLXBhY2svX3ByZWx1ZGUuanMiLCJzcmMvbGliL3V0aWxzLmpzIiwic3JjL3dpZGdldHMvYmFzZS9jYXJvdXNlbC5qcyIsInNyYy93aWRnZXRzL2Jsb2ctY2Fyb3VzZWwuanMiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBQUE7Ozs7Ozs7O0FDQU8sSUFBTSxjQUFjLEdBQUcsU0FBakIsY0FBaUIsQ0FBQyxTQUFELEVBQVksVUFBWixFQUE2QztBQUFBLE1BQXJCLElBQXFCLHVFQUFkLFNBQWM7O0FBQ3ZFLE1BQUksRUFBRSxTQUFTLElBQUksVUFBZixDQUFKLEVBQWdDO0FBQzVCO0FBQ0g7QUFFRDtBQUNKO0FBQ0E7QUFDQTs7O0FBQ0ksRUFBQSxNQUFNLENBQUMsTUFBRCxDQUFOLENBQWUsRUFBZixDQUFrQix5QkFBbEIsRUFBNkMsWUFBTTtBQUMvQyxRQUFNLFVBQVUsR0FBRyxTQUFiLFVBQWEsQ0FBQyxRQUFELEVBQWM7QUFDN0IsTUFBQSxpQkFBaUIsQ0FBQyxlQUFsQixDQUFrQyxVQUFsQyxDQUE2QyxTQUE3QyxFQUF3RDtBQUNwRCxRQUFBLFFBQVEsRUFBUjtBQURvRCxPQUF4RDtBQUdILEtBSkQ7O0FBTUEsSUFBQSxpQkFBaUIsQ0FBQyxLQUFsQixDQUF3QixTQUF4QixrQ0FBNEQsVUFBNUQsY0FBMEUsSUFBMUUsR0FBa0YsVUFBbEY7QUFDSCxHQVJEO0FBU0gsQ0FsQk07Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7O0lDQUQsYTs7Ozs7Ozs7Ozs7OztXQUNGLDhCQUFxQjtBQUNqQixhQUFPO0FBQ0gsUUFBQSxTQUFTLEVBQUU7QUFDUCxVQUFBLFFBQVEsRUFBRSwwQkFESDtBQUVQLFVBQUEsZUFBZSxFQUFFLHlCQUF5QixLQUFLLEtBQUwsRUFGbkM7QUFHUCxVQUFBLGVBQWUsRUFBRSx5QkFBeUIsS0FBSyxLQUFMLEVBSG5DO0FBSVAsVUFBQSxrQkFBa0IsRUFBRSx3QkFBd0IsS0FBSyxL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QUFDaEIsV0FBSyxXQUFMLENBQWlCLGdCQUFqQixFQUFtQyxRQUFuQyxDQUE0QyxLQUE1QztBQUNIOzs7O0VBOUx1QixnQkFBZ0IsQ0FBQyxRQUFqQixDQUEwQixRQUExQixDQUFtQyxJOztlQWlNaEQsYTs7Ozs7Ozs7QUNqTWY7O0FBQ0E7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7O0lBRU0saUI7Ozs7Ozs7Ozs7OztFQUEwQixpQjs7QUFFaEMsMkJBQWUsaUJBQWYsRUFBa0Msb0JBQWxDIiwiZmlsZSI6ImdlbmVyYXRlZC5qcyIsInNvdXJjZVJvb3QiOiIiLCJzb3VyY2VzQ29udGVudCI6WyIoZnVuY3Rpb24oKXtmdW5jdGlvbiByKGUsbix0KXtmdW5jdGlvbiBvKGksZil7aWYoIW5baV0pe2lmKCFlW2ldKXt2YXIgYz1cImZ1bmN0aW9uXCI9PXR5cGVvZiByZXF1aXJlJiZyZXF1aXJlO2lmKCFmJiZjKXJldHVybiBjKGksITApO2lmKHUpcmV0dXJuIHUoaSwhMCk7dmFyIGE9bmV3IEVycm9yKFwiQ2Fubm90IGZpbmQgbW9kdWxlICdcIitpK1wiJ1wiKTt0aHJvdyBhLmNvZGU9XCJNT0RVTEVfTk9UX0ZPVU5EXCIsYX12YXIgcD1uW2ldPXtleHBvcnRzOnt9fTtlW2ldWzBdLmNhbGwocC5leHBvcnRzLGZ1bmN0aW9uKHIpe3ZhciBuPWVbaV1bMV1bcl07cmV0dXJuIG8obnx8cil9LHAscC5leHBvcnRzLHIsZSxuLHQpfXJldHVybiBuW2ldLmV4cG9ydHN9Zm9yKHZhciB1PVwiZnVuY3Rpb25cIj09dHlwZW9mIHJlcXVpcmUmJnJlcXVpcmUsaT0wO2k8dC5sZW5ndGg7aSsrKW8odFtpXSk7cmV0dXJuIG99cmV0dXJuIHJ9KSgpIiwiZXhwb3J0IGNvbnN0IHJlZ2lzdGVyV2lkZ2V0ID0gKGNsYXNzTmFtZSwgd2lkZ2V0TmFtZSwgc2tpbiA9ICdkZWZhdWx0JykgPT4ge1xuICAgIGlmICghKGNsYXNzTmFtZSB8fCB3aWRnZXROYW1lKSkge1xuICAgICAgICByZXR1cm47XG4gICAgfVxuXG4gICAgLyoqXG4gICAgICogQmVjYXVzZSBFbGVtZW50b3IgcGx1Z2luIHVzZXMgalF1ZXJ5IGN1c3RvbSBldmVudCxcbiAgICAgKiBXZSBhbHNvIGhhdmUgdG8gdXNlIGpRdWVyeSB0byB1c2UgdGhpcyBldmVudFxuICAgICAqL1xuICAgIGpRdWVyeSh3aW5kb3cpLm9uKCdlbGVtZW50b3IvZnJvbnRlbmQvaW5pdCcsICgpID0+IHtcbiAgICAgICAgY29uc3QgYWRkSGFuZGxlciA9ICgkZWxlbWVudCkgPT4ge1xuICAgICAgICAgICAgZWxlbWVudG9yRnJvbnRlbmQuZWxlbWVudHNIYW5kbGVyLmFkZEhhbmRsZXIoY2xhc3NOYW1lLCB7XG4gICAgICAgICAgICAgICAgJGVsZW1lbnQsXG4gICAgICAgICAgICB9KTtcbiAgICAgICAgfTtcblxuICAgICAgICBlbGVtZW50b3JGcm9udGVuZC5ob29rcy5hZGRBY3Rpb24oYGZyb250ZW5kL2VsZW1lbnRfcmVhZHkvJHt3aWRnZXROYW1lfS4ke3NraW59YCwgYWRkSGFuZGxlcik7XG4gICAgfSk7XG59O1xuIiwiY2xhc3MgWmV1c19DYXJvdXNlbCBleHRlbmRzIGVsZW1lbnRvck1vZHVsZXMuZnJvbnRlbmQuaGFuZGxlcnMuQmFzZSB7XG4gICAgZ2V0RGVmYXVsdFNldHRpbmdzKCkge1xuICAgICAgICByZXR1cm4ge1xuICAgICAgICAgICAgc2VsZWN0b3JzOiB7XG4gICAgICAgICAgICAgICAgY2Fyb3VzZWw6ICcuemV1cy1jYXJvdXNlbC1jb250YWluZXInLFxuICAgICAgICAgICAgICAgIGNhcm91c2VsTmV4dEJ0bjogJy5zd2lwZXItYnV0dG9uLW5leHQtJyArIHRoaXMuZ2V0SUQoKSxcbiAgICAgICAgICAgICAgICBjYXJvdXNlbFByZXZCdG46ICcuc3dpcGVyLWJ1dHRvbi1wcmV2LScgKyB0aGlzLmdldElEKCksXG4gICAgICAgICAgICAgICAgY2Fyb3VzZWxQYWdpbmF0aW9uOiAnLnN3aXBlci1wYWdpbmF0aW9uLScgKyB0aGlzLmdldElEKCksXG4gICAgICAgICAgICB9LFxuICAgICAgICAgICAgZWZmZWN0OiAnc2xpZGUnLFxuICAgICAgICAgICAgbG9vcDogZmFsc2UsXG4gICAgICAgICAgICBhdXRvcGxheTogMCxcbiAgICAgICAgICAgIHNwZWVkOiA0MDAsXG4gICAgICAgICAgICBuYXZpZ2F0aW9uOiBmYWxzZSxcbiAgICAgICAgICAgIHBhZ2luYXRpb246IGZhbHNlLFxuICAgICAgICAgICAgY2VudGVyZWRTbGlkZXM6IGZhbHNlLFxuICAgICAgICAgICAgcGF1c2VPbkhvdmVyOiBmYWxzZSxcbiAgICAgICAgICAgIHNsaWRlc1BlclZpZXc6IHtcbiAgICAgICAgICAgICAgICBkZXNrdG9wOiAzLFxuICAgICAgICAgICAgICAgIHRhYmxldDogMixcbiAgICAgICAgICAgICAgICBtb2JpbGU6IDEsXG4gICAgICAgICAgICB9LFxuICAgICAgICAgICAgc2xpZGVzUGVyR3JvdXA6IHtcbiAgICAgICAgICAgICAgICBkZXNrdG9wOiAzLFxuICAgICAgICAgICAgICAgIHRhYmxldDogMixcbiAgICAgICAgICAgICAgICBtb2JpbGU6IDEsXG4gICAgICAgICAgICB9LFxuICAgICAgICAgICAgc3BhY2VCZXR3ZWVuOiB7XG4gICAgICAgICAgICAgICAgZGVza3RvcDogMTAsXG4gICAgICAgICAgICAgICAgdGFibGV0OiAxMCxcbiAgICAgICAgICAgICAgICBtb2JpbGU6IDEwLFxuICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIHN3aXBlckluc3RhbmNlOiBudWxsLFxuICAgICAgICB9O1xuICAgIH1cblxuICAgIGdldERlZmF1bHRFbGVtZW50cygpIHtcbiAgICAgICAgY29uc3QgZWxlbWVudCA9IHRoaXMuJGVsZW1lbnQuZ2V0KDApO1xuICAgICAgICBjb25zdCBzZWxlY3RvcnMgPSB0aGlzLmdldFNldHRpbmdzKCdzZWxlY3RvcnMnKTtcblxuICAgICAgICByZXR1cm4ge1xuICAgICAgICAgICAgY2Fyb3VzZWw6IGVsZW1lbnQucXVlcnlTZWxlY3RvcihzZWxlY3RvcnMuY2Fyb3VzZWwpLFxuICAgICAgICAgICAgY2Fyb3VzZWxOZXh0QnRuOiBlbGVtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoc2VsZWN0b3JzLmNhcm91c2VsTmV4dEJ0biksXG4gICAgICAgICAgICBjYXJvdXNlbFByZXZCdG46IGVsZW1lbnQucXVlcnlTZWxlY3RvckFsbChzZWxlY3RvcnMuY2Fyb3VzZWxQcmV2QnRuKSxcbiAgICAgICAgICAgIGNhcm91c2VsUGFnaW5hdGlvbjogZWxlbWVudC5xdWVyeVNlbGVjdG9yQWxsKHNlbGVjdG9ycy5jYXJvdXNlbFBhZ2luYXRpb24pLFxuICAgICAgICB9O1xuICAgIH1cblxuICAgIG9uSW5pdCguLi5hcmdzKSB7XG4gICAgICAgIHN1cGVyLm9uSW5pdCguLi5hcmdzKTtcblxuICAgICAgICB0aGlzLnNldFVzZXJTZXR0aW5ncygpO1xuICAgICAgICB0aGlzLmluaXRTd2lwZXIoKTtcbiAgICAgICAgdGhpcy5zZXR1cEV2ZW50TGlzdGVuZXJzKCk7XG4gICAgfVxuXG4gICAgc2V0VXNlclNldHRpbmdzKCkge1xuICAgICAgICBjb25zdCBzZXR0aW5ncyA9IHRoaXMuZ2V0U2V0dGluZ3MoKTtcbiAgICAgICAgY29uc3QgdXNlclNldHRpbmdzID0gSlNPTi5wYXJzZSh0aGlzLmVsZW1lbnRzLmNhcm91c2VsLmdldEF0dHJpYnV0ZSgnZGF0YS1zZXR0aW5ncycpKTtcblxuICAgICAgICBjb25zdCBjdXJyZW50U2V0dGluZ3MgPSB7XG4gICAgICAgICAgICBlZmZlY3Q6ICEhdXNlclNldHRpbmdzLmVmZmVjdCA/IHVzZXJTZXR0aW5ncy5lZmZlY3QgOiBzZXR0aW5ncy5lZmZlY3QsXG4gICAgICAgICAgICBsb29wOiAhIXVzZXJTZXR0aW5ncy5sb29wID8gQm9vbGVhbihOdW1iZXIodXNlclNldHRpbmdzLmxvb3ApKSA6IHNldHRpbmdzLmxvb3AsXG4gICAgICAgICAgICBhdXRvcGxheTogISF1c2VyU2V0dGluZ3MuYXV0b3BsYXkgPyBOdW1iZXIodXNlclNldHRpbmdzLmF1dG9wbGF5KSA6IHNldHRpbmdzLmF1dG9wbGF5LFxuICAgICAgICAgICAgc3BlZWQ6ICEhdXNlclNldHRpbmdzLnNwZWVkID8gTnVtYmVyKHVzZXJTZXR0aW5ncy5zcGVlZCkgOiBzZXR0aW5ncy5zcGVlZCxcbiAgICAgICAgICAgIG5hdmlnYXRpb246ICEhdXNlclNldHRpbmdzLmFycm93cyA/IEJvb2xlYW4oTnVtYmVyKHVzZXJTZXR0aW5ncy5hcnJvd3MpKSA6IHNldHRpbmdzLm5hdmlnYXRpb24sXG4gICAgICAgICAgICBwYWdpbmF0aW9uOiAhIXVzZXJTZXR0aW5ncy5kb3RzID8gQm9vbGVhbihOdW1iZXIodXNlclNldHRpbmdzLmRvdHMpKSA6IHNldHRpbmdzLnBhZ2luYXRpb24sXG4gICAgICAgICAgICBwYXVzZU9uSG92ZXI6ICEhdXNlclNldHRpbmdzWydwYXVzZS1vbi1ob3ZlciddXG4gICAgICAgICAgICAgICAgPyBKU09OLnBhcnNlKHVzZXJTZXR0aW5nc1sncGF1c2Utb24taG92ZXInXSlcbiAgICAgICAgICAgICAgICA6IHNldHRpbmdzLnBhdXNlT25Ib3ZlcixcbiAgICAgICAgICAgIHNsaWRlc1BlclZpZXc6IHtcbiAgICAgICAgICAgICAgICBkZXNrdG9wOiAhIXVzZXJTZXR0aW5ncy5pdGVtcyA/IE51bWJlcih1c2VyU2V0dGluZ3MuaXRlbXMpIDogc2V0dGluZ3Muc2xpZGVzUGVyVmlldy5kZXNrdG9wLFxuICAgICAgICAgICAgICAgIHRhYmxldDogISF1c2VyU2V0dGluZ3NbJ2l0ZW1zLXRhYmxldCddXG4gICAgICAgICAgICAgICAgICAgID8gTnVtYmVyKHVzZXJTZXR0aW5nc1snaXRlbXMtdGFibGV0J10pXG4gICAgICAgICAgICAgICAgICAgIDogc2V0dGluZ3Muc2xpZGVzUGVyVmlldy50YWJsZXQsXG4gICAgICAgICAgICAgICAgbW9iaWxlOiAhIXVzZXJTZXR0aW5nc1snaXRlbXMtbW9iaWxlJ11cbiAgICAgICAgICAgICAgICAgICAgPyBOdW1iZXIodXNlclNldHRpbmdzWydpdGVtcy1tb2JpbGUnXSlcbiAgICAgICAgICAgICAgICAgICAgOiBzZXR0aW5ncy5zbGlkZXNQZXJWaWV3Lm1vYmlsZSxcbiAgICAgICAgICAgIH0sXG4gICAgICAgICAgICBzbGlkZXNQZXJHcm91cDoge1xuICAgICAgICAgICAgICAgIGRlc2t0b3A6ICEhdXNlclNldHRpbmdzLnNsaWRlcyA/IE51bWJlcih1c2VyU2V0dGluZ3Muc2xpZGVzKSA6IHNldHRpbmdzLnNsaWRlc1Blckdyb3VwLmRlc2t0b3AsXG4gICAgICAgICAgICAgICAgdGFibGV0OiAhIXVzZXJTZXR0aW5nc1snc2xpZGVzLXRhYmxldCddXG4gICAgICAgICAgICAgICAgICAgID8gTnVtYmVyKHVzZXJTZXR0aW5nc1snc2xpZGVzLXRhYmxldCddKVxuICAgICAgICAgICAgICAgICAgICA6IHNldHRpbmdzLnNsaWRlc1Blckdyb3VwLnRhYmxldCxcbiAgICAgICAgICAgICAgICBtb2JpbGU6ICEhdXNlclNldHRpbmdzWydzbGlkZXMtbW9iaWxlJ11cbiAgICAgICAgICAgICAgICAgICAgPyBOdW1iZXIodXNlclNldHRpbmdzWydzbGlkZXMtbW9iaWxlJ10pXG4gICAgICAgICAgICAgICAgICAgIDogc2V0dGluZ3Muc2xpZGVzUGVyR3JvdXAubW9iaWxlLFxuICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIHNwYWNlQmV0d2Vlbjoge1xuICAgICAgICAgICAgICAgIGRlc2t0b3A6ICEhdXNlclNldHRpbmdzLm1hcmdpbiA/IE51bWJlcih1c2VyU2V0dGluZ3MubWFyZ2luKSA6IHNldHRpbmdzLnNwYWNlQmV0d2Vlbi5kZXNrdG9wLFxuICAgICAgICAgICAgICAgIHRhYmxldDogISF1c2VyU2V0dGluZ3NbJ21hcmdpbi10YWJsZXQnXVxuICAgICAgICAgICAgICAgICAgICA/IE51bWJlcih1c2VyU2V0dGluZ3NbJ21hcmdpbi10YWJsZXQnXSlcbiAgICAgICAgICAgICAgICAgICAgOiBzZXR0aW5ncy5zcGFjZUJldHdlZW4udGFibGV0LFxuICAgICAgICAgICAgICAgIG1vYmlsZTogISF1c2VyU2V0dGluZ3NbJ21hcmdpbi1tb2JpbGUnXVxuICAgICAgICAgICAgICAgICAgICA/IE51bWJlcih1c2VyU2V0dGluZ3NbJ21hcmdpbi1tb2JpbGUnXSlcbiAgICAgICAgICAgICAgICAgICAgOiBzZXR0aW5ncy5zcGFjZUJldHdlZW4ubW9iaWxlLFxuICAgICAgICAgICAgfSxcbiAgICAgICAgfTtcblxuICAgICAgICBjdXJyZW50U2V0dGluZ3MuY2VudGVyZWRTbGlkZXMgPSAnY292ZXJmbG93JyA9PT0gY3VycmVudFNldHRpbmdzLmVmZmVjdCA/IHRydWUgOiBzZXR0aW5ncy5jZW50ZXJlZFNsaWRlcztcblxuICAgICAgICB0aGlzLnNldFNldHRpbmdzKGN1cnJlbnRTZXR0aW5ncyk7XG4gICAgfVxuXG4gICAgaW5pdFN3aXBlcigpIHtcbiAgICAgICAgdmFyIHN3aXBlclNsaWRlcjtcblxuICAgICAgICBpZiAoICd1bmRlZmluZWQnID09PSB0eXBlb2YgU3dpcGVyICkge1xuICAgICAgICAgICAgLy8gSW1wcm92ZWQgQXNzZXQgTG9hZGluZyBlbmFibGVkXG4gICAgICAgICAgICB2YXIgYXN5bmNTd2lwZXIgPSBlbGVtZW50b3JGcm9udGVuZC51dGlscy5zd2lwZXI7XG4gICAgICAgICAgICBuZXcgYXN5bmNTd2lwZXIoIHRoaXMuZWxlbWVudHMuY2Fyb3VzZWwsIHRoaXMuc3dpcGVyT3B0aW9ucygpICkudGhlbiggZnVuY3Rpb24oIG5ld1N3aXBlclNsaWRlckluc3RhbmNlICkge1xuICAgICAgICAgICAgICAgIHN3aXBlclNsaWRlciA9IG5ld1N3aXBlclNsaWRlckluc3RhbmNlO1xuICAgICAgICAgICAgfSApO1xuICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgLy8gSW1wcm92ZWQgQXNzZXQgTG9hZGluZyBkaXNhYmxlZFxuICAgICAgICAgICAgc3dpcGVyU2xpZGVyID0gbmV3IFN3aXBlciggdGhpcy5lbGVtZW50cy5jYXJvdXNlbCwgdGhpcy5zd2lwZXJPcHRpb25zKCkgKTtcbiAgICAgICAgfVxuXG4gICAgICAgIHRoaXMuc2V0U2V0dGluZ3Moe1xuICAgICAgICAgICAgc3dpcGVySW5zdGFuY2U6IHN3aXBlclNsaWRlcixcbiAgICAgICAgfSk7XG4gICAgfVxuXG4gICAgc3dpcGVyT3B0aW9ucygpIHtcbiAgICAgICAgY29uc3Qgc2V0dGluZ3MgPSB0aGlzLmdldFNldHRpbmdzKCk7XG5cbiAgICAgICAgY29uc3Qgc3dpcGVyT3B0aW9ucyA9IHtcbiAgICAgICAgICAgIGRpcmVjdGlvbjogJ2hvcml6b250YWwnLFxuICAgICAgICAgICAgZWZmZWN0OiBzZXR0aW5ncy5lZmZlY3QsXG4gICAgICAgICAgICBsb29wOiBzZXR0aW5ncy5sb29wLFxuICAgICAgICAgICAgc3BlZWQ6IHNldHRpbmdzLnNwZWVkLFxuICAgICAgICAgICAgY2VudGVyZWRTbGlkZXM6IHNldHRpbmdzLmNlbnRlcmVkU2xpZGVzLFxuICAgICAgICAgICAgYXV0b0hlaWdodDogdHJ1ZSxcbiAgICAgICAgICAgIGF1dG9wbGF5OiAhc2V0dGluZ3MuYXV0b3BsYXlcbiAgICAgICAgICAgICAgICA/IGZhbHNlXG4gICAgICAgICAgICAgICAgOiB7XG4gICAgICAgICAgICAgICAgICAgICAgZGVsYXk6IHNldHRpbmdzLmF1dG9wbGF5LFxuICAgICAgICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIG5hdmlnYXRpb246ICFzZXR0aW5ncy5uYXZpZ2F0aW9uXG4gICAgICAgICAgICAgICAgPyBmYWxzZVxuICAgICAgICAgICAgICAgIDoge1xuICAgICAgICAgICAgICAgICAgICAgIG5leHRFbDogc2V0dGluZ3Muc2VsZWN0b3JzLmNhcm91c2VsTmV4dEJ0bixcbiAgICAgICAgICAgICAgICAgICAgICBwcmV2RWw6IHNldHRpbmdzLnNlbGVjdG9ycy5jYXJvdXNlbFByZXZCdG4sXG4gICAgICAgICAgICAgICAgICB9LFxuICAgICAgICAgICAgcGFnaW5hdGlvbjogIXNldHRpbmdzLnBhZ2luYXRpb25cbiAgICAgICAgICAgICAgICA/IGZhbHNlXG4gICAgICAgICAgICAgICAgOiB7XG4gICAgICAgICAgICAgICAgICAgICAgZWw6IHNldHRpbmdzLnNlbGVjdG9ycy5jYXJvdXNlbFBhZ2luYXRpb24sXG4gICAgICAgICAgICAgICAgICAgICAgY2xpY2thYmxlOiB0cnVlLFxuICAgICAgICAgICAgICAgICAgfSxcbiAgICAgICAgfTtcblxuICAgICAgICBpZiAoc2V0dGluZ3MuZWZmZWN0ID09PSAnZmFkZScpIHtcbiAgICAgICAgICAgIHN3aXBlck9wdGlvbnMuaXRlbXMgPSAxO1xuICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgc3dpcGVyT3B0aW9ucy5icmVha3BvaW50cyA9IHtcbiAgICAgICAgICAgICAgICAxMDI0OiB7XG4gICAgICAgICAgICAgICAgICAgIHNsaWRlc1BlclZpZXc6IHNldHRpbmdzLnNsaWRlc1BlclZpZXcuZGVza3RvcCxcbiAgICAgICAgICAgICAgICAgICAgc2xpZGVzUGVyR3JvdXA6IHNldHRpbmdzLnNsaWRlc1Blckdyb3VwLmRlc2t0b3AsXG4gICAgICAgICAgICAgICAgICAgIHNwYWNlQmV0d2Vlbjogc2V0dGluZ3Muc3BhY2VCZXR3ZWVuLmRlc2t0b3AsXG4gICAgICAgICAgICAgICAgfSxcbiAgICAgICAgICAgICAgICA3Njg6IHtcbiAgICAgICAgICAgICAgICAgICAgc2xpZGVzUGVyVmlldzogc2V0dGluZ3Muc2xpZGVzUGVyVmlldy50YWJsZXQsXG4gICAgICAgICAgICAgICAgICAgIHNsaWRlc1Blckdyb3VwOiBzZXR0aW5ncy5zbGlkZXNQZXJHcm91cC50YWJsZXQsXG4gICAgICAgICAgICAgICAgICAgIHNwYWNlQmV0d2Vlbjogc2V0dGluZ3Muc3BhY2VCZXR3ZWVuLnRhYmxldCxcbiAgICAgICAgICAgICAgICB9LFxuICAgICAgICAgICAgICAgIDMyMDoge1xuICAgICAgICAgICAgICAgICAgICBzbGlkZXNQZXJWaWV3OiBzZXR0aW5ncy5zbGlkZXNQZXJWaWV3Lm1vYmlsZSxcbiAgICAgICAgICAgICAgICAgICAgc2xpZGVzUGVyR3JvdXA6IHNldHRpbmdzLnNsaWRlc1Blckdyb3VwLm1vYmlsZSxcbiAgICAgICAgICAgICAgICAgICAgc3BhY2VCZXR3ZWVuOiBzZXR0aW5ncy5zcGFjZUJldHdlZW4ubW9iaWxlLFxuICAgICAgICAgICAgICAgIH0sXG4gICAgICAgICAgICB9O1xuICAgICAgICB9XG5cbiAgICAgICAgcmV0dXJuIHN3aXBlck9wdGlvbnM7XG4gICAgfVxuXG4gICAgc2V0dXBFdmVudExpc3RlbmVycygpIHtcbiAgICAgICAgaWYgKHRoaXMuZ2V0U2V0dGluZ3MoJ3BhdXNlT25Ib3ZlcicpKSB7XG4gICAgICAgICAgICB0aGlzLmVsZW1lbnRzLmNhcm91c2VsLmFkZEV2ZW50TGlzdGVuZXIoJ21vdXNlZW50ZXInLCB0aGlzLnBhdXNlU3dpcGVyLmJpbmQodGhpcykpO1xuICAgICAgICAgICAgdGhpcy5lbGVtZW50cy5jYXJvdXNlbC5hZGRFdmVudExpc3RlbmVyKCdtb3VzZWxlYXZlJywgdGhpcy5yZXN1bWVTd2lwZXIuYmluZCh0aGlzKSk7XG4gICAgICAgIH1cbiAgICB9XG5cbiAgICBwYXVzZVN3aXBlcihldmVudCkge1xuICAgICAgICB0aGlzLmdldFNldHRpbmdzKCdzd2lwZXJJbnN0YW5jZScpLmF1dG9wbGF5LnN0b3AoKTtcbiAgICB9XG5cbiAgICByZXN1bWVTd2lwZXIoZXZlbnQpIHtcbiAgICAgICAgdGhpcy5nZXRTZXR0aW5ncygnc3dpcGVySW5zdGFuY2UnKS5hdXRvcGxheS5zdGFydCgpO1xuICAgIH1cbn1cblxuZXhwb3J0IGRlZmF1bHQgWmV1c19DYXJvdXNlbDtcbiIsImltcG9ydCB7IHJlZ2lzdGVyV2lkZ2V0IH0gZnJvbSBcIi4uL2xpYi91dGlsc1wiO1xuaW1wb3J0IFpldXNfQ2Fyb3VzZWwgZnJvbSBcIi4vYmFzZS9jYXJvdXNlbFwiO1xuXG5jbGFzcyBaZXVzX0Jsb2dDYXJvdXNlbCBleHRlbmRzIFpldXNfQ2Fyb3VzZWwge31cblxucmVnaXN0ZXJXaWRnZXQoWmV1c19CbG9nQ2Fyb3VzZWwsIFwiemV1cy1ibG9nLWNhcm91c2VsXCIpO1xuIl19
