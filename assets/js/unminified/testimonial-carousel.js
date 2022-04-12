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

      if (this.getSettings('pauseOnHover')) {
        this.elements.carousel.addEventListener('mouseenter', function () {
          swiperSlider.autoplay.stop();
        });
        this.elements.carousel.addEventListener('mouseleave', function () {
          swiperSlider.autoplay.start();
        });
      }
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
        pauseOnMouseEnter: true,
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
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm5vZGVfbW9kdWxlcy9icm93c2VyLXBhY2svX3ByZWx1ZGUuanMiLCJzcmMvbGliL3V0aWxzLmpzIiwic3JjL3dpZGdldHMvYmFzZS9jYXJvdXNlbC5qcyIsInNyYy93aWRnZXRzL3Rlc3RpbW9uaWFsLWNhcm91c2VsLmpzIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUFBOzs7Ozs7OztBQ0FPLElBQU0sY0FBYyxHQUFHLFNBQWpCLGNBQWlCLENBQUMsU0FBRCxFQUFZLFVBQVosRUFBNkM7QUFBQSxNQUFyQixJQUFxQix1RUFBZCxTQUFjOztBQUN2RSxNQUFJLEVBQUUsU0FBUyxJQUFJLFVBQWYsQ0FBSixFQUFnQztBQUM1QjtBQUNIO0FBRUQ7QUFDSjtBQUNBO0FBQ0E7OztBQUNJLEVBQUEsTUFBTSxDQUFDLE1BQUQsQ0FBTixDQUFlLEVBQWYsQ0FBa0IseUJBQWxCLEVBQTZDLFlBQU07QUFDL0MsUUFBTSxVQUFVLEdBQUcsU0FBYixVQUFhLENBQUMsUUFBRCxFQUFjO0FBQzdCLE1BQUEsaUJBQWlCLENBQUMsZUFBbEIsQ0FBa0MsVUFBbEMsQ0FBNkMsU0FBN0MsRUFBd0Q7QUFDcEQsUUFBQSxRQUFRLEVBQVI7QUFEb0QsT0FBeEQ7QUFHSCxLQUpEOztBQU1BLElBQUEsaUJBQWlCLENBQUMsS0FBbEIsQ0FBd0IsU0FBeEIsa0NBQTRELFVBQTVELGNBQTBFLElBQTFFLEdBQWtGLFVBQWxGO0FBQ0gsR0FSRDtBQVNILENBbEJNOzs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7OztJQ0FELGE7Ozs7Ozs7Ozs7Ozs7V0FDRiw4QkFBcUI7QUFDakIsYUFBTztBQUNILFFBQUEsU0FBUyxFQUFFO0FBQ1AsVUFBQSxRQUFRLEVBQUUsMEJBREg7QUFFUCxVQUFBLGVBQWUsRUFBRSx5QkFBeUIsS0FBSyxLQUFMLEVBRm5DO0FBR1AsVUFBQSxlQUFlLEVBQUUseUJBQXlCLEtBQUssS0FBTCxFQUhuQztBQUlQLFVBQUEsa0JBQWtCLEVBQUUsd0JBQXdC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Ozs7Ozs7Ozs7Ozs7Ozs7OztJQUVNLHdCOzs7Ozs7Ozs7Ozs7RUFBaUMsaUI7O0FBRXZDLDJCQUFlLHdCQUFmLEVBQXlDLDJCQUF6QyIsImZpbGUiOiJnZW5lcmF0ZWQuanMiLCJzb3VyY2VSb290IjoiIiwic291cmNlc0NvbnRlbnQiOlsiKGZ1bmN0aW9uKCl7ZnVuY3Rpb24gcihlLG4sdCl7ZnVuY3Rpb24gbyhpLGYpe2lmKCFuW2ldKXtpZighZVtpXSl7dmFyIGM9XCJmdW5jdGlvblwiPT10eXBlb2YgcmVxdWlyZSYmcmVxdWlyZTtpZighZiYmYylyZXR1cm4gYyhpLCEwKTtpZih1KXJldHVybiB1KGksITApO3ZhciBhPW5ldyBFcnJvcihcIkNhbm5vdCBmaW5kIG1vZHVsZSAnXCIraStcIidcIik7dGhyb3cgYS5jb2RlPVwiTU9EVUxFX05PVF9GT1VORFwiLGF9dmFyIHA9bltpXT17ZXhwb3J0czp7fX07ZVtpXVswXS5jYWxsKHAuZXhwb3J0cyxmdW5jdGlvbihyKXt2YXIgbj1lW2ldWzFdW3JdO3JldHVybiBvKG58fHIpfSxwLHAuZXhwb3J0cyxyLGUsbix0KX1yZXR1cm4gbltpXS5leHBvcnRzfWZvcih2YXIgdT1cImZ1bmN0aW9uXCI9PXR5cGVvZiByZXF1aXJlJiZyZXF1aXJlLGk9MDtpPHQubGVuZ3RoO2krKylvKHRbaV0pO3JldHVybiBvfXJldHVybiByfSkoKSIsImV4cG9ydCBjb25zdCByZWdpc3RlcldpZGdldCA9IChjbGFzc05hbWUsIHdpZGdldE5hbWUsIHNraW4gPSAnZGVmYXVsdCcpID0+IHtcbiAgICBpZiAoIShjbGFzc05hbWUgfHwgd2lkZ2V0TmFtZSkpIHtcbiAgICAgICAgcmV0dXJuO1xuICAgIH1cblxuICAgIC8qKlxuICAgICAqIEJlY2F1c2UgRWxlbWVudG9yIHBsdWdpbiB1c2VzIGpRdWVyeSBjdXN0b20gZXZlbnQsXG4gICAgICogV2UgYWxzbyBoYXZlIHRvIHVzZSBqUXVlcnkgdG8gdXNlIHRoaXMgZXZlbnRcbiAgICAgKi9cbiAgICBqUXVlcnkod2luZG93KS5vbignZWxlbWVudG9yL2Zyb250ZW5kL2luaXQnLCAoKSA9PiB7XG4gICAgICAgIGNvbnN0IGFkZEhhbmRsZXIgPSAoJGVsZW1lbnQpID0+IHtcbiAgICAgICAgICAgIGVsZW1lbnRvckZyb250ZW5kLmVsZW1lbnRzSGFuZGxlci5hZGRIYW5kbGVyKGNsYXNzTmFtZSwge1xuICAgICAgICAgICAgICAgICRlbGVtZW50LFxuICAgICAgICAgICAgfSk7XG4gICAgICAgIH07XG5cbiAgICAgICAgZWxlbWVudG9yRnJvbnRlbmQuaG9va3MuYWRkQWN0aW9uKGBmcm9udGVuZC9lbGVtZW50X3JlYWR5LyR7d2lkZ2V0TmFtZX0uJHtza2lufWAsIGFkZEhhbmRsZXIpO1xuICAgIH0pO1xufTtcbiIsImNsYXNzIFpldXNfQ2Fyb3VzZWwgZXh0ZW5kcyBlbGVtZW50b3JNb2R1bGVzLmZyb250ZW5kLmhhbmRsZXJzLkJhc2Uge1xuICAgIGdldERlZmF1bHRTZXR0aW5ncygpIHtcbiAgICAgICAgcmV0dXJuIHtcbiAgICAgICAgICAgIHNlbGVjdG9yczoge1xuICAgICAgICAgICAgICAgIGNhcm91c2VsOiAnLnpldXMtY2Fyb3VzZWwtY29udGFpbmVyJyxcbiAgICAgICAgICAgICAgICBjYXJvdXNlbE5leHRCdG46ICcuc3dpcGVyLWJ1dHRvbi1uZXh0LScgKyB0aGlzLmdldElEKCksXG4gICAgICAgICAgICAgICAgY2Fyb3VzZWxQcmV2QnRuOiAnLnN3aXBlci1idXR0b24tcHJldi0nICsgdGhpcy5nZXRJRCgpLFxuICAgICAgICAgICAgICAgIGNhcm91c2VsUGFnaW5hdGlvbjogJy5zd2lwZXItcGFnaW5hdGlvbi0nICsgdGhpcy5nZXRJRCgpLFxuICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIGVmZmVjdDogJ3NsaWRlJyxcbiAgICAgICAgICAgIGxvb3A6IGZhbHNlLFxuICAgICAgICAgICAgYXV0b3BsYXk6IDAsXG4gICAgICAgICAgICBzcGVlZDogNDAwLFxuICAgICAgICAgICAgbmF2aWdhdGlvbjogZmFsc2UsXG4gICAgICAgICAgICBwYWdpbmF0aW9uOiBmYWxzZSxcbiAgICAgICAgICAgIGNlbnRlcmVkU2xpZGVzOiBmYWxzZSxcbiAgICAgICAgICAgIHBhdXNlT25Ib3ZlcjogZmFsc2UsXG4gICAgICAgICAgICBzbGlkZXNQZXJWaWV3OiB7XG4gICAgICAgICAgICAgICAgZGVza3RvcDogMyxcbiAgICAgICAgICAgICAgICB0YWJsZXQ6IDIsXG4gICAgICAgICAgICAgICAgbW9iaWxlOiAxLFxuICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIHNsaWRlc1Blckdyb3VwOiB7XG4gICAgICAgICAgICAgICAgZGVza3RvcDogMyxcbiAgICAgICAgICAgICAgICB0YWJsZXQ6IDIsXG4gICAgICAgICAgICAgICAgbW9iaWxlOiAxLFxuICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIHNwYWNlQmV0d2Vlbjoge1xuICAgICAgICAgICAgICAgIGRlc2t0b3A6IDEwLFxuICAgICAgICAgICAgICAgIHRhYmxldDogMTAsXG4gICAgICAgICAgICAgICAgbW9iaWxlOiAxMCxcbiAgICAgICAgICAgIH0sXG4gICAgICAgICAgICBzd2lwZXJJbnN0YW5jZTogbnVsbCxcbiAgICAgICAgfTtcbiAgICB9XG5cbiAgICBnZXREZWZhdWx0RWxlbWVudHMoKSB7XG4gICAgICAgIGNvbnN0IGVsZW1lbnQgPSB0aGlzLiRlbGVtZW50LmdldCgwKTtcbiAgICAgICAgY29uc3Qgc2VsZWN0b3JzID0gdGhpcy5nZXRTZXR0aW5ncygnc2VsZWN0b3JzJyk7XG5cbiAgICAgICAgcmV0dXJuIHtcbiAgICAgICAgICAgIGNhcm91c2VsOiBlbGVtZW50LnF1ZXJ5U2VsZWN0b3Ioc2VsZWN0b3JzLmNhcm91c2VsKSxcbiAgICAgICAgICAgIGNhcm91c2VsTmV4dEJ0bjogZWxlbWVudC5xdWVyeVNlbGVjdG9yQWxsKHNlbGVjdG9ycy5jYXJvdXNlbE5leHRCdG4pLFxuICAgICAgICAgICAgY2Fyb3VzZWxQcmV2QnRuOiBlbGVtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoc2VsZWN0b3JzLmNhcm91c2VsUHJldkJ0biksXG4gICAgICAgICAgICBjYXJvdXNlbFBhZ2luYXRpb246IGVsZW1lbnQucXVlcnlTZWxlY3RvckFsbChzZWxlY3RvcnMuY2Fyb3VzZWxQYWdpbmF0aW9uKSxcbiAgICAgICAgfTtcbiAgICB9XG5cbiAgICBvbkluaXQoLi4uYXJncykge1xuICAgICAgICBzdXBlci5vbkluaXQoLi4uYXJncyk7XG5cbiAgICAgICAgdGhpcy5zZXRVc2VyU2V0dGluZ3MoKTtcbiAgICAgICAgdGhpcy5pbml0U3dpcGVyKCk7XG4gICAgfVxuXG4gICAgc2V0VXNlclNldHRpbmdzKCkge1xuICAgICAgICBjb25zdCBzZXR0aW5ncyA9IHRoaXMuZ2V0U2V0dGluZ3MoKTtcbiAgICAgICAgY29uc3QgdXNlclNldHRpbmdzID0gSlNPTi5wYXJzZSh0aGlzLmVsZW1lbnRzLmNhcm91c2VsLmdldEF0dHJpYnV0ZSgnZGF0YS1zZXR0aW5ncycpKTtcblxuICAgICAgICBjb25zdCBjdXJyZW50U2V0dGluZ3MgPSB7XG4gICAgICAgICAgICBlZmZlY3Q6ICEhdXNlclNldHRpbmdzLmVmZmVjdCA/IHVzZXJTZXR0aW5ncy5lZmZlY3QgOiBzZXR0aW5ncy5lZmZlY3QsXG4gICAgICAgICAgICBsb29wOiAhIXVzZXJTZXR0aW5ncy5sb29wID8gQm9vbGVhbihOdW1iZXIodXNlclNldHRpbmdzLmxvb3ApKSA6IHNldHRpbmdzLmxvb3AsXG4gICAgICAgICAgICBhdXRvcGxheTogISF1c2VyU2V0dGluZ3MuYXV0b3BsYXkgPyBOdW1iZXIodXNlclNldHRpbmdzLmF1dG9wbGF5KSA6IHNldHRpbmdzLmF1dG9wbGF5LFxuICAgICAgICAgICAgc3BlZWQ6ICEhdXNlclNldHRpbmdzLnNwZWVkID8gTnVtYmVyKHVzZXJTZXR0aW5ncy5zcGVlZCkgOiBzZXR0aW5ncy5zcGVlZCxcbiAgICAgICAgICAgIG5hdmlnYXRpb246ICEhdXNlclNldHRpbmdzLmFycm93cyA/IEJvb2xlYW4oTnVtYmVyKHVzZXJTZXR0aW5ncy5hcnJvd3MpKSA6IHNldHRpbmdzLm5hdmlnYXRpb24sXG4gICAgICAgICAgICBwYWdpbmF0aW9uOiAhIXVzZXJTZXR0aW5ncy5kb3RzID8gQm9vbGVhbihOdW1iZXIodXNlclNldHRpbmdzLmRvdHMpKSA6IHNldHRpbmdzLnBhZ2luYXRpb24sXG4gICAgICAgICAgICBwYXVzZU9uSG92ZXI6ICEhdXNlclNldHRpbmdzWydwYXVzZS1vbi1ob3ZlciddXG4gICAgICAgICAgICAgICAgPyBKU09OLnBhcnNlKHVzZXJTZXR0aW5nc1sncGF1c2Utb24taG92ZXInXSlcbiAgICAgICAgICAgICAgICA6IHNldHRpbmdzLnBhdXNlT25Ib3ZlcixcbiAgICAgICAgICAgIHNsaWRlc1BlclZpZXc6IHtcbiAgICAgICAgICAgICAgICBkZXNrdG9wOiAhIXVzZXJTZXR0aW5ncy5pdGVtcyA/IE51bWJlcih1c2VyU2V0dGluZ3MuaXRlbXMpIDogc2V0dGluZ3Muc2xpZGVzUGVyVmlldy5kZXNrdG9wLFxuICAgICAgICAgICAgICAgIHRhYmxldDogISF1c2VyU2V0dGluZ3NbJ2l0ZW1zLXRhYmxldCddXG4gICAgICAgICAgICAgICAgICAgID8gTnVtYmVyKHVzZXJTZXR0aW5nc1snaXRlbXMtdGFibGV0J10pXG4gICAgICAgICAgICAgICAgICAgIDogc2V0dGluZ3Muc2xpZGVzUGVyVmlldy50YWJsZXQsXG4gICAgICAgICAgICAgICAgbW9iaWxlOiAhIXVzZXJTZXR0aW5nc1snaXRlbXMtbW9iaWxlJ11cbiAgICAgICAgICAgICAgICAgICAgPyBOdW1iZXIodXNlclNldHRpbmdzWydpdGVtcy1tb2JpbGUnXSlcbiAgICAgICAgICAgICAgICAgICAgOiBzZXR0aW5ncy5zbGlkZXNQZXJWaWV3Lm1vYmlsZSxcbiAgICAgICAgICAgIH0sXG4gICAgICAgICAgICBzbGlkZXNQZXJHcm91cDoge1xuICAgICAgICAgICAgICAgIGRlc2t0b3A6ICEhdXNlclNldHRpbmdzLnNsaWRlcyA/IE51bWJlcih1c2VyU2V0dGluZ3Muc2xpZGVzKSA6IHNldHRpbmdzLnNsaWRlc1Blckdyb3VwLmRlc2t0b3AsXG4gICAgICAgICAgICAgICAgdGFibGV0OiAhIXVzZXJTZXR0aW5nc1snc2xpZGVzLXRhYmxldCddXG4gICAgICAgICAgICAgICAgICAgID8gTnVtYmVyKHVzZXJTZXR0aW5nc1snc2xpZGVzLXRhYmxldCddKVxuICAgICAgICAgICAgICAgICAgICA6IHNldHRpbmdzLnNsaWRlc1Blckdyb3VwLnRhYmxldCxcbiAgICAgICAgICAgICAgICBtb2JpbGU6ICEhdXNlclNldHRpbmdzWydzbGlkZXMtbW9iaWxlJ11cbiAgICAgICAgICAgICAgICAgICAgPyBOdW1iZXIodXNlclNldHRpbmdzWydzbGlkZXMtbW9iaWxlJ10pXG4gICAgICAgICAgICAgICAgICAgIDogc2V0dGluZ3Muc2xpZGVzUGVyR3JvdXAubW9iaWxlLFxuICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIHNwYWNlQmV0d2Vlbjoge1xuICAgICAgICAgICAgICAgIGRlc2t0b3A6ICEhdXNlclNldHRpbmdzLm1hcmdpbiA/IE51bWJlcih1c2VyU2V0dGluZ3MubWFyZ2luKSA6IHNldHRpbmdzLnNwYWNlQmV0d2Vlbi5kZXNrdG9wLFxuICAgICAgICAgICAgICAgIHRhYmxldDogISF1c2VyU2V0dGluZ3NbJ21hcmdpbi10YWJsZXQnXVxuICAgICAgICAgICAgICAgICAgICA/IE51bWJlcih1c2VyU2V0dGluZ3NbJ21hcmdpbi10YWJsZXQnXSlcbiAgICAgICAgICAgICAgICAgICAgOiBzZXR0aW5ncy5zcGFjZUJldHdlZW4udGFibGV0LFxuICAgICAgICAgICAgICAgIG1vYmlsZTogISF1c2VyU2V0dGluZ3NbJ21hcmdpbi1tb2JpbGUnXVxuICAgICAgICAgICAgICAgICAgICA/IE51bWJlcih1c2VyU2V0dGluZ3NbJ21hcmdpbi1tb2JpbGUnXSlcbiAgICAgICAgICAgICAgICAgICAgOiBzZXR0aW5ncy5zcGFjZUJldHdlZW4ubW9iaWxlLFxuICAgICAgICAgICAgfSxcbiAgICAgICAgfTtcblxuICAgICAgICBjdXJyZW50U2V0dGluZ3MuY2VudGVyZWRTbGlkZXMgPSAnY292ZXJmbG93JyA9PT0gY3VycmVudFNldHRpbmdzLmVmZmVjdCA/IHRydWUgOiBzZXR0aW5ncy5jZW50ZXJlZFNsaWRlcztcblxuICAgICAgICB0aGlzLnNldFNldHRpbmdzKGN1cnJlbnRTZXR0aW5ncyk7XG4gICAgfVxuXG4gICAgaW5pdFN3aXBlcigpIHtcbiAgICAgICAgdmFyIHN3aXBlclNsaWRlcjtcblxuICAgICAgICBpZiAoICd1bmRlZmluZWQnID09PSB0eXBlb2YgU3dpcGVyICkge1xuICAgICAgICAgICAgLy8gSW1wcm92ZWQgQXNzZXQgTG9hZGluZyBlbmFibGVkXG4gICAgICAgICAgICB2YXIgYXN5bmNTd2lwZXIgPSBlbGVtZW50b3JGcm9udGVuZC51dGlscy5zd2lwZXI7XG4gICAgICAgICAgICBuZXcgYXN5bmNTd2lwZXIoIHRoaXMuZWxlbWVudHMuY2Fyb3VzZWwsIHRoaXMuc3dpcGVyT3B0aW9ucygpICkudGhlbiggZnVuY3Rpb24oIG5ld1N3aXBlclNsaWRlckluc3RhbmNlICkge1xuICAgICAgICAgICAgICAgIHN3aXBlclNsaWRlciA9IG5ld1N3aXBlclNsaWRlckluc3RhbmNlO1xuICAgICAgICAgICAgfSApO1xuICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgLy8gSW1wcm92ZWQgQXNzZXQgTG9hZGluZyBkaXNhYmxlZFxuICAgICAgICAgICAgc3dpcGVyU2xpZGVyID0gbmV3IFN3aXBlciggdGhpcy5lbGVtZW50cy5jYXJvdXNlbCwgdGhpcy5zd2lwZXJPcHRpb25zKCkgKTtcbiAgICAgICAgfVxuXG4gICAgICAgIHRoaXMuc2V0U2V0dGluZ3Moe1xuICAgICAgICAgICAgc3dpcGVySW5zdGFuY2U6IHN3aXBlclNsaWRlcixcbiAgICAgICAgfSk7XG5cbiAgICAgICAgaWYgKCB0aGlzLmdldFNldHRpbmdzKCAncGF1c2VPbkhvdmVyJyApICkge1xuICAgICAgICAgICAgdGhpcy5lbGVtZW50cy5jYXJvdXNlbC5hZGRFdmVudExpc3RlbmVyKCAnbW91c2VlbnRlcicsIGZ1bmN0aW9uKCkge1xuICAgICAgICAgICAgICAgIHN3aXBlclNsaWRlci5hdXRvcGxheS5zdG9wKCk7XG4gICAgICAgICAgICB9ICk7XG4gICAgICAgICAgICB0aGlzLmVsZW1lbnRzLmNhcm91c2VsLmFkZEV2ZW50TGlzdGVuZXIoICdtb3VzZWxlYXZlJywgZnVuY3Rpb24oKSB7XG4gICAgICAgICAgICAgICAgc3dpcGVyU2xpZGVyLmF1dG9wbGF5LnN0YXJ0KCk7XG4gICAgICAgICAgICB9ICk7XG4gICAgICAgIH1cbiAgICB9XG5cbiAgICBzd2lwZXJPcHRpb25zKCkge1xuICAgICAgICBjb25zdCBzZXR0aW5ncyA9IHRoaXMuZ2V0U2V0dGluZ3MoKTtcblxuICAgICAgICBjb25zdCBzd2lwZXJPcHRpb25zID0ge1xuICAgICAgICAgICAgZGlyZWN0aW9uOiAnaG9yaXpvbnRhbCcsXG4gICAgICAgICAgICBlZmZlY3Q6IHNldHRpbmdzLmVmZmVjdCxcbiAgICAgICAgICAgIGxvb3A6IHNldHRpbmdzLmxvb3AsXG4gICAgICAgICAgICBzcGVlZDogc2V0dGluZ3Muc3BlZWQsXG4gICAgICAgICAgICBjZW50ZXJlZFNsaWRlczogc2V0dGluZ3MuY2VudGVyZWRTbGlkZXMsXG4gICAgICAgICAgICBhdXRvSGVpZ2h0OiB0cnVlLFxuICAgICAgICAgICAgcGF1c2VPbk1vdXNlRW50ZXI6IHRydWUsXG4gICAgICAgICAgICBhdXRvcGxheTogIXNldHRpbmdzLmF1dG9wbGF5XG4gICAgICAgICAgICAgICAgPyBmYWxzZVxuICAgICAgICAgICAgICAgIDoge1xuICAgICAgICAgICAgICAgICAgICAgIGRlbGF5OiBzZXR0aW5ncy5hdXRvcGxheSxcbiAgICAgICAgICAgICAgICAgIH0sXG4gICAgICAgICAgICBuYXZpZ2F0aW9uOiAhc2V0dGluZ3MubmF2aWdhdGlvblxuICAgICAgICAgICAgICAgID8gZmFsc2VcbiAgICAgICAgICAgICAgICA6IHtcbiAgICAgICAgICAgICAgICAgICAgICBuZXh0RWw6IHNldHRpbmdzLnNlbGVjdG9ycy5jYXJvdXNlbE5leHRCdG4sXG4gICAgICAgICAgICAgICAgICAgICAgcHJldkVsOiBzZXR0aW5ncy5zZWxlY3RvcnMuY2Fyb3VzZWxQcmV2QnRuLFxuICAgICAgICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIHBhZ2luYXRpb246ICFzZXR0aW5ncy5wYWdpbmF0aW9uXG4gICAgICAgICAgICAgICAgPyBmYWxzZVxuICAgICAgICAgICAgICAgIDoge1xuICAgICAgICAgICAgICAgICAgICAgIGVsOiBzZXR0aW5ncy5zZWxlY3RvcnMuY2Fyb3VzZWxQYWdpbmF0aW9uLFxuICAgICAgICAgICAgICAgICAgICAgIGNsaWNrYWJsZTogdHJ1ZSxcbiAgICAgICAgICAgICAgICAgIH0sXG4gICAgICAgIH07XG5cbiAgICAgICAgaWYgKHNldHRpbmdzLmVmZmVjdCA9PT0gJ2ZhZGUnKSB7XG4gICAgICAgICAgICBzd2lwZXJPcHRpb25zLml0ZW1zID0gMTtcbiAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgIHN3aXBlck9wdGlvbnMuYnJlYWtwb2ludHMgPSB7XG4gICAgICAgICAgICAgICAgMTAyNDoge1xuICAgICAgICAgICAgICAgICAgICBzbGlkZXNQZXJWaWV3OiBzZXR0aW5ncy5zbGlkZXNQZXJWaWV3LmRlc2t0b3AsXG4gICAgICAgICAgICAgICAgICAgIHNsaWRlc1Blckdyb3VwOiBzZXR0aW5ncy5zbGlkZXNQZXJHcm91cC5kZXNrdG9wLFxuICAgICAgICAgICAgICAgICAgICBzcGFjZUJldHdlZW46IHNldHRpbmdzLnNwYWNlQmV0d2Vlbi5kZXNrdG9wLFxuICAgICAgICAgICAgICAgIH0sXG4gICAgICAgICAgICAgICAgNzY4OiB7XG4gICAgICAgICAgICAgICAgICAgIHNsaWRlc1BlclZpZXc6IHNldHRpbmdzLnNsaWRlc1BlclZpZXcudGFibGV0LFxuICAgICAgICAgICAgICAgICAgICBzbGlkZXNQZXJHcm91cDogc2V0dGluZ3Muc2xpZGVzUGVyR3JvdXAudGFibGV0LFxuICAgICAgICAgICAgICAgICAgICBzcGFjZUJldHdlZW46IHNldHRpbmdzLnNwYWNlQmV0d2Vlbi50YWJsZXQsXG4gICAgICAgICAgICAgICAgfSxcbiAgICAgICAgICAgICAgICAzMjA6IHtcbiAgICAgICAgICAgICAgICAgICAgc2xpZGVzUGVyVmlldzogc2V0dGluZ3Muc2xpZGVzUGVyVmlldy5tb2JpbGUsXG4gICAgICAgICAgICAgICAgICAgIHNsaWRlc1Blckdyb3VwOiBzZXR0aW5ncy5zbGlkZXNQZXJHcm91cC5tb2JpbGUsXG4gICAgICAgICAgICAgICAgICAgIHNwYWNlQmV0d2Vlbjogc2V0dGluZ3Muc3BhY2VCZXR3ZWVuLm1vYmlsZSxcbiAgICAgICAgICAgICAgICB9LFxuICAgICAgICAgICAgfTtcbiAgICAgICAgfVxuXG4gICAgICAgIHJldHVybiBzd2lwZXJPcHRpb25zO1xuICAgIH1cbn1cblxuZXhwb3J0IGRlZmF1bHQgWmV1c19DYXJvdXNlbDtcbiIsImltcG9ydCB7IHJlZ2lzdGVyV2lkZ2V0IH0gZnJvbSBcIi4uL2xpYi91dGlsc1wiO1xuaW1wb3J0IFpldXNfQ2Fyb3VzZWwgZnJvbSBcIi4vYmFzZS9jYXJvdXNlbFwiO1xuXG5jbGFzcyBaZXVzX1Rlc3RpbW9uaWFsQ2Fyb3VzZWwgZXh0ZW5kcyBaZXVzX0Nhcm91c2VsIHt9XG5cbnJlZ2lzdGVyV2lkZ2V0KFpldXNfVGVzdGltb25pYWxDYXJvdXNlbCwgXCJ6ZXVzLXRlc3RpbW9uaWFsLWNhcm91c2VsXCIpO1xuIl19
