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

var Zeus_TestimonialCarousel = /*#__PURE__*/function (_Zeus_Carousel) {
  _inherits(Zeus_TestimonialCarousel, _Zeus_Carousel);

  var _super = _createSuper(Zeus_TestimonialCarousel);

  function Zeus_TestimonialCarousel() {
    _classCallCheck(this, Zeus_TestimonialCarousel);

    return _super.apply(this, arguments);
  }

  return Zeus_TestimonialCarousel;
}(_carousel.default);

(0, _utils.registerWidget)(Zeus_TestimonialCarousel, "zeus-testimonial-carousel");

},{"../lib/utils":1,"./base/carousel":2}]},{},[3])
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm5vZGVfbW9kdWxlcy9icm93c2VyLXBhY2svX3ByZWx1ZGUuanMiLCJzcmMvbGliL3V0aWxzLmpzIiwic3JjL3dpZGdldHMvYmFzZS9jYXJvdXNlbC5qcyIsInNyYy93aWRnZXRzL3Rlc3RpbW9uaWFsLWNhcm91c2VsLmpzIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUFBOzs7Ozs7OztBQ0FPLElBQU0sY0FBYyxHQUFHLFNBQWpCLGNBQWlCLENBQUMsU0FBRCxFQUFZLFVBQVosRUFBNkM7QUFBQSxNQUFyQixJQUFxQix1RUFBZCxTQUFjOztBQUN2RSxNQUFJLEVBQUUsU0FBUyxJQUFJLFVBQWYsQ0FBSixFQUFnQztBQUM1QjtBQUNIO0FBRUQ7QUFDSjtBQUNBO0FBQ0E7OztBQUNJLEVBQUEsTUFBTSxDQUFDLE1BQUQsQ0FBTixDQUFlLEVBQWYsQ0FBa0IseUJBQWxCLEVBQTZDLFlBQU07QUFDL0MsUUFBTSxVQUFVLEdBQUcsU0FBYixVQUFhLENBQUMsUUFBRCxFQUFjO0FBQzdCLE1BQUEsaUJBQWlCLENBQUMsZUFBbEIsQ0FBa0MsVUFBbEMsQ0FBNkMsU0FBN0MsRUFBd0Q7QUFDcEQsUUFBQSxRQUFRLEVBQVI7QUFEb0QsT0FBeEQ7QUFHSCxLQUpEOztBQU1BLElBQUEsaUJBQWlCLENBQUMsS0FBbEIsQ0FBd0IsU0FBeEIsa0NBQTRELFVBQTVELGNBQTBFLElBQTFFLEdBQWtGLFVBQWxGO0FBQ0gsR0FSRDtBQVNILENBbEJNOzs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7OztJQ0FELGE7Ozs7Ozs7Ozs7Ozs7V0FDRiw4QkFBcUI7QUFDakIsYUFBTztBQUNILFFBQUEsU0FBUyxFQUFFO0FBQ1AsVUFBQSxRQUFRLEVBQUUsMEJBREg7QUFFUCxVQUFBLGVBQWUsRUFBRSx5QkFBeUIsS0FBSyxLQUFMLEVBRm5DO0FBR1AsVUFBQSxlQUFlLEVBQUUseUJBQXlCLEtBQUssS0FBTCxFQUhuQztBQUlQLFVBQUEsa0JBQWtCLEVBQUUsd0JBQXdC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LEVBQW9CO0FBQ2hCLFdBQUssV0FBTCxDQUFpQixnQkFBakIsRUFBbUMsUUFBbkMsQ0FBNEMsS0FBNUM7QUFDSDs7OztFQTlMdUIsZ0JBQWdCLENBQUMsUUFBakIsQ0FBMEIsUUFBMUIsQ0FBbUMsSTs7ZUFpTWhELGE7Ozs7Ozs7O0FDak1mOztBQUNBOzs7Ozs7Ozs7Ozs7Ozs7Ozs7OztJQUVNLHdCOzs7Ozs7Ozs7Ozs7RUFBaUMsaUI7O0FBRXZDLDJCQUFlLHdCQUFmLEVBQXlDLDJCQUF6QyIsImZpbGUiOiJnZW5lcmF0ZWQuanMiLCJzb3VyY2VSb290IjoiIiwic291cmNlc0NvbnRlbnQiOlsiKGZ1bmN0aW9uKCl7ZnVuY3Rpb24gcihlLG4sdCl7ZnVuY3Rpb24gbyhpLGYpe2lmKCFuW2ldKXtpZighZVtpXSl7dmFyIGM9XCJmdW5jdGlvblwiPT10eXBlb2YgcmVxdWlyZSYmcmVxdWlyZTtpZighZiYmYylyZXR1cm4gYyhpLCEwKTtpZih1KXJldHVybiB1KGksITApO3ZhciBhPW5ldyBFcnJvcihcIkNhbm5vdCBmaW5kIG1vZHVsZSAnXCIraStcIidcIik7dGhyb3cgYS5jb2RlPVwiTU9EVUxFX05PVF9GT1VORFwiLGF9dmFyIHA9bltpXT17ZXhwb3J0czp7fX07ZVtpXVswXS5jYWxsKHAuZXhwb3J0cyxmdW5jdGlvbihyKXt2YXIgbj1lW2ldWzFdW3JdO3JldHVybiBvKG58fHIpfSxwLHAuZXhwb3J0cyxyLGUsbix0KX1yZXR1cm4gbltpXS5leHBvcnRzfWZvcih2YXIgdT1cImZ1bmN0aW9uXCI9PXR5cGVvZiByZXF1aXJlJiZyZXF1aXJlLGk9MDtpPHQubGVuZ3RoO2krKylvKHRbaV0pO3JldHVybiBvfXJldHVybiByfSkoKSIsImV4cG9ydCBjb25zdCByZWdpc3RlcldpZGdldCA9IChjbGFzc05hbWUsIHdpZGdldE5hbWUsIHNraW4gPSAnZGVmYXVsdCcpID0+IHtcbiAgICBpZiAoIShjbGFzc05hbWUgfHwgd2lkZ2V0TmFtZSkpIHtcbiAgICAgICAgcmV0dXJuO1xuICAgIH1cblxuICAgIC8qKlxuICAgICAqIEJlY2F1c2UgRWxlbWVudG9yIHBsdWdpbiB1c2VzIGpRdWVyeSBjdXN0b20gZXZlbnQsXG4gICAgICogV2UgYWxzbyBoYXZlIHRvIHVzZSBqUXVlcnkgdG8gdXNlIHRoaXMgZXZlbnRcbiAgICAgKi9cbiAgICBqUXVlcnkod2luZG93KS5vbignZWxlbWVudG9yL2Zyb250ZW5kL2luaXQnLCAoKSA9PiB7XG4gICAgICAgIGNvbnN0IGFkZEhhbmRsZXIgPSAoJGVsZW1lbnQpID0+IHtcbiAgICAgICAgICAgIGVsZW1lbnRvckZyb250ZW5kLmVsZW1lbnRzSGFuZGxlci5hZGRIYW5kbGVyKGNsYXNzTmFtZSwge1xuICAgICAgICAgICAgICAgICRlbGVtZW50LFxuICAgICAgICAgICAgfSk7XG4gICAgICAgIH07XG5cbiAgICAgICAgZWxlbWVudG9yRnJvbnRlbmQuaG9va3MuYWRkQWN0aW9uKGBmcm9udGVuZC9lbGVtZW50X3JlYWR5LyR7d2lkZ2V0TmFtZX0uJHtza2lufWAsIGFkZEhhbmRsZXIpO1xuICAgIH0pO1xufTtcbiIsImNsYXNzIFpldXNfQ2Fyb3VzZWwgZXh0ZW5kcyBlbGVtZW50b3JNb2R1bGVzLmZyb250ZW5kLmhhbmRsZXJzLkJhc2Uge1xuICAgIGdldERlZmF1bHRTZXR0aW5ncygpIHtcbiAgICAgICAgcmV0dXJuIHtcbiAgICAgICAgICAgIHNlbGVjdG9yczoge1xuICAgICAgICAgICAgICAgIGNhcm91c2VsOiAnLnpldXMtY2Fyb3VzZWwtY29udGFpbmVyJyxcbiAgICAgICAgICAgICAgICBjYXJvdXNlbE5leHRCdG46ICcuc3dpcGVyLWJ1dHRvbi1uZXh0LScgKyB0aGlzLmdldElEKCksXG4gICAgICAgICAgICAgICAgY2Fyb3VzZWxQcmV2QnRuOiAnLnN3aXBlci1idXR0b24tcHJldi0nICsgdGhpcy5nZXRJRCgpLFxuICAgICAgICAgICAgICAgIGNhcm91c2VsUGFnaW5hdGlvbjogJy5zd2lwZXItcGFnaW5hdGlvbi0nICsgdGhpcy5nZXRJRCgpLFxuICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIGVmZmVjdDogJ3NsaWRlJyxcbiAgICAgICAgICAgIGxvb3A6IGZhbHNlLFxuICAgICAgICAgICAgYXV0b3BsYXk6IDAsXG4gICAgICAgICAgICBzcGVlZDogNDAwLFxuICAgICAgICAgICAgbmF2aWdhdGlvbjogZmFsc2UsXG4gICAgICAgICAgICBwYWdpbmF0aW9uOiBmYWxzZSxcbiAgICAgICAgICAgIGNlbnRlcmVkU2xpZGVzOiBmYWxzZSxcbiAgICAgICAgICAgIHBhdXNlT25Ib3ZlcjogZmFsc2UsXG4gICAgICAgICAgICBzbGlkZXNQZXJWaWV3OiB7XG4gICAgICAgICAgICAgICAgZGVza3RvcDogMyxcbiAgICAgICAgICAgICAgICB0YWJsZXQ6IDIsXG4gICAgICAgICAgICAgICAgbW9iaWxlOiAxLFxuICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIHNsaWRlc1Blckdyb3VwOiB7XG4gICAgICAgICAgICAgICAgZGVza3RvcDogMyxcbiAgICAgICAgICAgICAgICB0YWJsZXQ6IDIsXG4gICAgICAgICAgICAgICAgbW9iaWxlOiAxLFxuICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIHNwYWNlQmV0d2Vlbjoge1xuICAgICAgICAgICAgICAgIGRlc2t0b3A6IDEwLFxuICAgICAgICAgICAgICAgIHRhYmxldDogMTAsXG4gICAgICAgICAgICAgICAgbW9iaWxlOiAxMCxcbiAgICAgICAgICAgIH0sXG4gICAgICAgICAgICBzd2lwZXJJbnN0YW5jZTogbnVsbCxcbiAgICAgICAgfTtcbiAgICB9XG5cbiAgICBnZXREZWZhdWx0RWxlbWVudHMoKSB7XG4gICAgICAgIGNvbnN0IGVsZW1lbnQgPSB0aGlzLiRlbGVtZW50LmdldCgwKTtcbiAgICAgICAgY29uc3Qgc2VsZWN0b3JzID0gdGhpcy5nZXRTZXR0aW5ncygnc2VsZWN0b3JzJyk7XG5cbiAgICAgICAgcmV0dXJuIHtcbiAgICAgICAgICAgIGNhcm91c2VsOiBlbGVtZW50LnF1ZXJ5U2VsZWN0b3Ioc2VsZWN0b3JzLmNhcm91c2VsKSxcbiAgICAgICAgICAgIGNhcm91c2VsTmV4dEJ0bjogZWxlbWVudC5xdWVyeVNlbGVjdG9yQWxsKHNlbGVjdG9ycy5jYXJvdXNlbE5leHRCdG4pLFxuICAgICAgICAgICAgY2Fyb3VzZWxQcmV2QnRuOiBlbGVtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoc2VsZWN0b3JzLmNhcm91c2VsUHJldkJ0biksXG4gICAgICAgICAgICBjYXJvdXNlbFBhZ2luYXRpb246IGVsZW1lbnQucXVlcnlTZWxlY3RvckFsbChzZWxlY3RvcnMuY2Fyb3VzZWxQYWdpbmF0aW9uKSxcbiAgICAgICAgfTtcbiAgICB9XG5cbiAgICBvbkluaXQoLi4uYXJncykge1xuICAgICAgICBzdXBlci5vbkluaXQoLi4uYXJncyk7XG5cbiAgICAgICAgdGhpcy5zZXRVc2VyU2V0dGluZ3MoKTtcbiAgICAgICAgdGhpcy5pbml0U3dpcGVyKCk7XG4gICAgICAgIHRoaXMuc2V0dXBFdmVudExpc3RlbmVycygpO1xuICAgIH1cblxuICAgIHNldFVzZXJTZXR0aW5ncygpIHtcbiAgICAgICAgY29uc3Qgc2V0dGluZ3MgPSB0aGlzLmdldFNldHRpbmdzKCk7XG4gICAgICAgIGNvbnN0IHVzZXJTZXR0aW5ncyA9IEpTT04ucGFyc2UodGhpcy5lbGVtZW50cy5jYXJvdXNlbC5nZXRBdHRyaWJ1dGUoJ2RhdGEtc2V0dGluZ3MnKSk7XG5cbiAgICAgICAgY29uc3QgY3VycmVudFNldHRpbmdzID0ge1xuICAgICAgICAgICAgZWZmZWN0OiAhIXVzZXJTZXR0aW5ncy5lZmZlY3QgPyB1c2VyU2V0dGluZ3MuZWZmZWN0IDogc2V0dGluZ3MuZWZmZWN0LFxuICAgICAgICAgICAgbG9vcDogISF1c2VyU2V0dGluZ3MubG9vcCA/IEJvb2xlYW4oTnVtYmVyKHVzZXJTZXR0aW5ncy5sb29wKSkgOiBzZXR0aW5ncy5sb29wLFxuICAgICAgICAgICAgYXV0b3BsYXk6ICEhdXNlclNldHRpbmdzLmF1dG9wbGF5ID8gTnVtYmVyKHVzZXJTZXR0aW5ncy5hdXRvcGxheSkgOiBzZXR0aW5ncy5hdXRvcGxheSxcbiAgICAgICAgICAgIHNwZWVkOiAhIXVzZXJTZXR0aW5ncy5zcGVlZCA/IE51bWJlcih1c2VyU2V0dGluZ3Muc3BlZWQpIDogc2V0dGluZ3Muc3BlZWQsXG4gICAgICAgICAgICBuYXZpZ2F0aW9uOiAhIXVzZXJTZXR0aW5ncy5hcnJvd3MgPyBCb29sZWFuKE51bWJlcih1c2VyU2V0dGluZ3MuYXJyb3dzKSkgOiBzZXR0aW5ncy5uYXZpZ2F0aW9uLFxuICAgICAgICAgICAgcGFnaW5hdGlvbjogISF1c2VyU2V0dGluZ3MuZG90cyA/IEJvb2xlYW4oTnVtYmVyKHVzZXJTZXR0aW5ncy5kb3RzKSkgOiBzZXR0aW5ncy5wYWdpbmF0aW9uLFxuICAgICAgICAgICAgcGF1c2VPbkhvdmVyOiAhIXVzZXJTZXR0aW5nc1sncGF1c2Utb24taG92ZXInXVxuICAgICAgICAgICAgICAgID8gSlNPTi5wYXJzZSh1c2VyU2V0dGluZ3NbJ3BhdXNlLW9uLWhvdmVyJ10pXG4gICAgICAgICAgICAgICAgOiBzZXR0aW5ncy5wYXVzZU9uSG92ZXIsXG4gICAgICAgICAgICBzbGlkZXNQZXJWaWV3OiB7XG4gICAgICAgICAgICAgICAgZGVza3RvcDogISF1c2VyU2V0dGluZ3MuaXRlbXMgPyBOdW1iZXIodXNlclNldHRpbmdzLml0ZW1zKSA6IHNldHRpbmdzLnNsaWRlc1BlclZpZXcuZGVza3RvcCxcbiAgICAgICAgICAgICAgICB0YWJsZXQ6ICEhdXNlclNldHRpbmdzWydpdGVtcy10YWJsZXQnXVxuICAgICAgICAgICAgICAgICAgICA/IE51bWJlcih1c2VyU2V0dGluZ3NbJ2l0ZW1zLXRhYmxldCddKVxuICAgICAgICAgICAgICAgICAgICA6IHNldHRpbmdzLnNsaWRlc1BlclZpZXcudGFibGV0LFxuICAgICAgICAgICAgICAgIG1vYmlsZTogISF1c2VyU2V0dGluZ3NbJ2l0ZW1zLW1vYmlsZSddXG4gICAgICAgICAgICAgICAgICAgID8gTnVtYmVyKHVzZXJTZXR0aW5nc1snaXRlbXMtbW9iaWxlJ10pXG4gICAgICAgICAgICAgICAgICAgIDogc2V0dGluZ3Muc2xpZGVzUGVyVmlldy5tb2JpbGUsXG4gICAgICAgICAgICB9LFxuICAgICAgICAgICAgc2xpZGVzUGVyR3JvdXA6IHtcbiAgICAgICAgICAgICAgICBkZXNrdG9wOiAhIXVzZXJTZXR0aW5ncy5zbGlkZXMgPyBOdW1iZXIodXNlclNldHRpbmdzLnNsaWRlcykgOiBzZXR0aW5ncy5zbGlkZXNQZXJHcm91cC5kZXNrdG9wLFxuICAgICAgICAgICAgICAgIHRhYmxldDogISF1c2VyU2V0dGluZ3NbJ3NsaWRlcy10YWJsZXQnXVxuICAgICAgICAgICAgICAgICAgICA/IE51bWJlcih1c2VyU2V0dGluZ3NbJ3NsaWRlcy10YWJsZXQnXSlcbiAgICAgICAgICAgICAgICAgICAgOiBzZXR0aW5ncy5zbGlkZXNQZXJHcm91cC50YWJsZXQsXG4gICAgICAgICAgICAgICAgbW9iaWxlOiAhIXVzZXJTZXR0aW5nc1snc2xpZGVzLW1vYmlsZSddXG4gICAgICAgICAgICAgICAgICAgID8gTnVtYmVyKHVzZXJTZXR0aW5nc1snc2xpZGVzLW1vYmlsZSddKVxuICAgICAgICAgICAgICAgICAgICA6IHNldHRpbmdzLnNsaWRlc1Blckdyb3VwLm1vYmlsZSxcbiAgICAgICAgICAgIH0sXG4gICAgICAgICAgICBzcGFjZUJldHdlZW46IHtcbiAgICAgICAgICAgICAgICBkZXNrdG9wOiAhIXVzZXJTZXR0aW5ncy5tYXJnaW4gPyBOdW1iZXIodXNlclNldHRpbmdzLm1hcmdpbikgOiBzZXR0aW5ncy5zcGFjZUJldHdlZW4uZGVza3RvcCxcbiAgICAgICAgICAgICAgICB0YWJsZXQ6ICEhdXNlclNldHRpbmdzWydtYXJnaW4tdGFibGV0J11cbiAgICAgICAgICAgICAgICAgICAgPyBOdW1iZXIodXNlclNldHRpbmdzWydtYXJnaW4tdGFibGV0J10pXG4gICAgICAgICAgICAgICAgICAgIDogc2V0dGluZ3Muc3BhY2VCZXR3ZWVuLnRhYmxldCxcbiAgICAgICAgICAgICAgICBtb2JpbGU6ICEhdXNlclNldHRpbmdzWydtYXJnaW4tbW9iaWxlJ11cbiAgICAgICAgICAgICAgICAgICAgPyBOdW1iZXIodXNlclNldHRpbmdzWydtYXJnaW4tbW9iaWxlJ10pXG4gICAgICAgICAgICAgICAgICAgIDogc2V0dGluZ3Muc3BhY2VCZXR3ZWVuLm1vYmlsZSxcbiAgICAgICAgICAgIH0sXG4gICAgICAgIH07XG5cbiAgICAgICAgY3VycmVudFNldHRpbmdzLmNlbnRlcmVkU2xpZGVzID0gJ2NvdmVyZmxvdycgPT09IGN1cnJlbnRTZXR0aW5ncy5lZmZlY3QgPyB0cnVlIDogc2V0dGluZ3MuY2VudGVyZWRTbGlkZXM7XG5cbiAgICAgICAgdGhpcy5zZXRTZXR0aW5ncyhjdXJyZW50U2V0dGluZ3MpO1xuICAgIH1cblxuICAgIGluaXRTd2lwZXIoKSB7XG4gICAgICAgIHZhciBzd2lwZXJTbGlkZXI7XG5cbiAgICAgICAgaWYgKCAndW5kZWZpbmVkJyA9PT0gdHlwZW9mIFN3aXBlciApIHtcbiAgICAgICAgICAgIC8vIEltcHJvdmVkIEFzc2V0IExvYWRpbmcgZW5hYmxlZFxuICAgICAgICAgICAgdmFyIGFzeW5jU3dpcGVyID0gZWxlbWVudG9yRnJvbnRlbmQudXRpbHMuc3dpcGVyO1xuICAgICAgICAgICAgbmV3IGFzeW5jU3dpcGVyKCB0aGlzLmVsZW1lbnRzLmNhcm91c2VsLCB0aGlzLnN3aXBlck9wdGlvbnMoKSApLnRoZW4oIGZ1bmN0aW9uKCBuZXdTd2lwZXJTbGlkZXJJbnN0YW5jZSApIHtcbiAgICAgICAgICAgICAgICBzd2lwZXJTbGlkZXIgPSBuZXdTd2lwZXJTbGlkZXJJbnN0YW5jZTtcbiAgICAgICAgICAgIH0gKTtcbiAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgIC8vIEltcHJvdmVkIEFzc2V0IExvYWRpbmcgZGlzYWJsZWRcbiAgICAgICAgICAgIHN3aXBlclNsaWRlciA9IG5ldyBTd2lwZXIoIHRoaXMuZWxlbWVudHMuY2Fyb3VzZWwsIHRoaXMuc3dpcGVyT3B0aW9ucygpICk7XG4gICAgICAgIH1cblxuICAgICAgICB0aGlzLnNldFNldHRpbmdzKHtcbiAgICAgICAgICAgIHN3aXBlckluc3RhbmNlOiBzd2lwZXJTbGlkZXIsXG4gICAgICAgIH0pO1xuICAgIH1cblxuICAgIHN3aXBlck9wdGlvbnMoKSB7XG4gICAgICAgIGNvbnN0IHNldHRpbmdzID0gdGhpcy5nZXRTZXR0aW5ncygpO1xuXG4gICAgICAgIGNvbnN0IHN3aXBlck9wdGlvbnMgPSB7XG4gICAgICAgICAgICBkaXJlY3Rpb246ICdob3Jpem9udGFsJyxcbiAgICAgICAgICAgIGVmZmVjdDogc2V0dGluZ3MuZWZmZWN0LFxuICAgICAgICAgICAgbG9vcDogc2V0dGluZ3MubG9vcCxcbiAgICAgICAgICAgIHNwZWVkOiBzZXR0aW5ncy5zcGVlZCxcbiAgICAgICAgICAgIGNlbnRlcmVkU2xpZGVzOiBzZXR0aW5ncy5jZW50ZXJlZFNsaWRlcyxcbiAgICAgICAgICAgIGF1dG9IZWlnaHQ6IHRydWUsXG4gICAgICAgICAgICBhdXRvcGxheTogIXNldHRpbmdzLmF1dG9wbGF5XG4gICAgICAgICAgICAgICAgPyBmYWxzZVxuICAgICAgICAgICAgICAgIDoge1xuICAgICAgICAgICAgICAgICAgICAgIGRlbGF5OiBzZXR0aW5ncy5hdXRvcGxheSxcbiAgICAgICAgICAgICAgICAgIH0sXG4gICAgICAgICAgICBuYXZpZ2F0aW9uOiAhc2V0dGluZ3MubmF2aWdhdGlvblxuICAgICAgICAgICAgICAgID8gZmFsc2VcbiAgICAgICAgICAgICAgICA6IHtcbiAgICAgICAgICAgICAgICAgICAgICBuZXh0RWw6IHNldHRpbmdzLnNlbGVjdG9ycy5jYXJvdXNlbE5leHRCdG4sXG4gICAgICAgICAgICAgICAgICAgICAgcHJldkVsOiBzZXR0aW5ncy5zZWxlY3RvcnMuY2Fyb3VzZWxQcmV2QnRuLFxuICAgICAgICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIHBhZ2luYXRpb246ICFzZXR0aW5ncy5wYWdpbmF0aW9uXG4gICAgICAgICAgICAgICAgPyBmYWxzZVxuICAgICAgICAgICAgICAgIDoge1xuICAgICAgICAgICAgICAgICAgICAgIGVsOiBzZXR0aW5ncy5zZWxlY3RvcnMuY2Fyb3VzZWxQYWdpbmF0aW9uLFxuICAgICAgICAgICAgICAgICAgICAgIGNsaWNrYWJsZTogdHJ1ZSxcbiAgICAgICAgICAgICAgICAgIH0sXG4gICAgICAgIH07XG5cbiAgICAgICAgaWYgKHNldHRpbmdzLmVmZmVjdCA9PT0gJ2ZhZGUnKSB7XG4gICAgICAgICAgICBzd2lwZXJPcHRpb25zLml0ZW1zID0gMTtcbiAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgIHN3aXBlck9wdGlvbnMuYnJlYWtwb2ludHMgPSB7XG4gICAgICAgICAgICAgICAgMTAyNDoge1xuICAgICAgICAgICAgICAgICAgICBzbGlkZXNQZXJWaWV3OiBzZXR0aW5ncy5zbGlkZXNQZXJWaWV3LmRlc2t0b3AsXG4gICAgICAgICAgICAgICAgICAgIHNsaWRlc1Blckdyb3VwOiBzZXR0aW5ncy5zbGlkZXNQZXJHcm91cC5kZXNrdG9wLFxuICAgICAgICAgICAgICAgICAgICBzcGFjZUJldHdlZW46IHNldHRpbmdzLnNwYWNlQmV0d2Vlbi5kZXNrdG9wLFxuICAgICAgICAgICAgICAgIH0sXG4gICAgICAgICAgICAgICAgNzY4OiB7XG4gICAgICAgICAgICAgICAgICAgIHNsaWRlc1BlclZpZXc6IHNldHRpbmdzLnNsaWRlc1BlclZpZXcudGFibGV0LFxuICAgICAgICAgICAgICAgICAgICBzbGlkZXNQZXJHcm91cDogc2V0dGluZ3Muc2xpZGVzUGVyR3JvdXAudGFibGV0LFxuICAgICAgICAgICAgICAgICAgICBzcGFjZUJldHdlZW46IHNldHRpbmdzLnNwYWNlQmV0d2Vlbi50YWJsZXQsXG4gICAgICAgICAgICAgICAgfSxcbiAgICAgICAgICAgICAgICAzMjA6IHtcbiAgICAgICAgICAgICAgICAgICAgc2xpZGVzUGVyVmlldzogc2V0dGluZ3Muc2xpZGVzUGVyVmlldy5tb2JpbGUsXG4gICAgICAgICAgICAgICAgICAgIHNsaWRlc1Blckdyb3VwOiBzZXR0aW5ncy5zbGlkZXNQZXJHcm91cC5tb2JpbGUsXG4gICAgICAgICAgICAgICAgICAgIHNwYWNlQmV0d2Vlbjogc2V0dGluZ3Muc3BhY2VCZXR3ZWVuLm1vYmlsZSxcbiAgICAgICAgICAgICAgICB9LFxuICAgICAgICAgICAgfTtcbiAgICAgICAgfVxuXG4gICAgICAgIHJldHVybiBzd2lwZXJPcHRpb25zO1xuICAgIH1cblxuICAgIHNldHVwRXZlbnRMaXN0ZW5lcnMoKSB7XG4gICAgICAgIGlmICh0aGlzLmdldFNldHRpbmdzKCdwYXVzZU9uSG92ZXInKSkge1xuICAgICAgICAgICAgdGhpcy5lbGVtZW50cy5jYXJvdXNlbC5hZGRFdmVudExpc3RlbmVyKCdtb3VzZWVudGVyJywgdGhpcy5wYXVzZVN3aXBlci5iaW5kKHRoaXMpKTtcbiAgICAgICAgICAgIHRoaXMuZWxlbWVudHMuY2Fyb3VzZWwuYWRkRXZlbnRMaXN0ZW5lcignbW91c2VsZWF2ZScsIHRoaXMucmVzdW1lU3dpcGVyLmJpbmQodGhpcykpO1xuICAgICAgICB9XG4gICAgfVxuXG4gICAgcGF1c2VTd2lwZXIoZXZlbnQpIHtcbiAgICAgICAgdGhpcy5nZXRTZXR0aW5ncygnc3dpcGVySW5zdGFuY2UnKS5hdXRvcGxheS5zdG9wKCk7XG4gICAgfVxuXG4gICAgcmVzdW1lU3dpcGVyKGV2ZW50KSB7XG4gICAgICAgIHRoaXMuZ2V0U2V0dGluZ3MoJ3N3aXBlckluc3RhbmNlJykuYXV0b3BsYXkuc3RhcnQoKTtcbiAgICB9XG59XG5cbmV4cG9ydCBkZWZhdWx0IFpldXNfQ2Fyb3VzZWw7XG4iLCJpbXBvcnQgeyByZWdpc3RlcldpZGdldCB9IGZyb20gXCIuLi9saWIvdXRpbHNcIjtcbmltcG9ydCBaZXVzX0Nhcm91c2VsIGZyb20gXCIuL2Jhc2UvY2Fyb3VzZWxcIjtcblxuY2xhc3MgWmV1c19UZXN0aW1vbmlhbENhcm91c2VsIGV4dGVuZHMgWmV1c19DYXJvdXNlbCB7fVxuXG5yZWdpc3RlcldpZGdldChaZXVzX1Rlc3RpbW9uaWFsQ2Fyb3VzZWwsIFwiemV1cy10ZXN0aW1vbmlhbC1jYXJvdXNlbFwiKTtcbiJdfQ==
