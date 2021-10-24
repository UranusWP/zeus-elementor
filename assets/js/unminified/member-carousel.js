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
      var swiper = new Swiper(this.elements.carousel, this.swiperOptions());
      this.setSettings({
        swiperInstance: swiper
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

var Zeus_MemberCarousel = /*#__PURE__*/function (_Zeus_Carousel) {
  _inherits(Zeus_MemberCarousel, _Zeus_Carousel);

  var _super = _createSuper(Zeus_MemberCarousel);

  function Zeus_MemberCarousel() {
    _classCallCheck(this, Zeus_MemberCarousel);

    return _super.apply(this, arguments);
  }

  return Zeus_MemberCarousel;
}(_carousel.default);

(0, _utils.registerWidget)(Zeus_MemberCarousel, "zeus-member-carousel");

},{"../lib/utils":1,"./base/carousel":2}]},{},[3])
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm5vZGVfbW9kdWxlcy9icm93c2VyLXBhY2svX3ByZWx1ZGUuanMiLCJzcmMvbGliL3V0aWxzLmpzIiwic3JjL3dpZGdldHMvYmFzZS9jYXJvdXNlbC5qcyIsInNyYy93aWRnZXRzL21lbWJlci1jYXJvdXNlbC5qcyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFBQTs7Ozs7Ozs7QUNBTyxJQUFNLGNBQWMsR0FBRyxTQUFqQixjQUFpQixDQUFDLFNBQUQsRUFBWSxVQUFaLEVBQTZDO0FBQUEsTUFBckIsSUFBcUIsdUVBQWQsU0FBYzs7QUFDdkUsTUFBSSxFQUFFLFNBQVMsSUFBSSxVQUFmLENBQUosRUFBZ0M7QUFDNUI7QUFDSDtBQUVEO0FBQ0o7QUFDQTtBQUNBOzs7QUFDSSxFQUFBLE1BQU0sQ0FBQyxNQUFELENBQU4sQ0FBZSxFQUFmLENBQWtCLHlCQUFsQixFQUE2QyxZQUFNO0FBQy9DLFFBQU0sVUFBVSxHQUFHLFNBQWIsVUFBYSxDQUFDLFFBQUQsRUFBYztBQUM3QixNQUFBLGlCQUFpQixDQUFDLGVBQWxCLENBQWtDLFVBQWxDLENBQTZDLFNBQTdDLEVBQXdEO0FBQ3BELFFBQUEsUUFBUSxFQUFSO0FBRG9ELE9BQXhEO0FBR0gsS0FKRDs7QUFNQSxJQUFBLGlCQUFpQixDQUFDLEtBQWxCLENBQXdCLFNBQXhCLGtDQUE0RCxVQUE1RCxjQUEwRSxJQUExRSxHQUFrRixVQUFsRjtBQUNILEdBUkQ7QUFTSCxDQWxCTTs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7SUNBRCxhOzs7Ozs7Ozs7Ozs7O1dBQ0YsOEJBQXFCO0FBQ2pCLGFBQU87QUFDSCxRQUFBLFNBQVMsRUFBRTtBQUNQLFVBQUEsUUFBUSxFQUFFLDBCQURIO0FBRVAsVUFBQSxlQUFlLEVBQUUseUJBQXlCLEtBQUssS0FBTCxFQUZuQztBQUdQLFVBQUEsZUFBZSxFQUFFLHlCQUF5QixLQUFLLEtBQUwsRUFIbkM7QUFJUCxVQUFBLGtCQUFrQixFQUFFLHdCQUF3QixLQUFL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bnQiOlsiKGZ1bmN0aW9uKCl7ZnVuY3Rpb24gcihlLG4sdCl7ZnVuY3Rpb24gbyhpLGYpe2lmKCFuW2ldKXtpZighZVtpXSl7dmFyIGM9XCJmdW5jdGlvblwiPT10eXBlb2YgcmVxdWlyZSYmcmVxdWlyZTtpZighZiYmYylyZXR1cm4gYyhpLCEwKTtpZih1KXJldHVybiB1KGksITApO3ZhciBhPW5ldyBFcnJvcihcIkNhbm5vdCBmaW5kIG1vZHVsZSAnXCIraStcIidcIik7dGhyb3cgYS5jb2RlPVwiTU9EVUxFX05PVF9GT1VORFwiLGF9dmFyIHA9bltpXT17ZXhwb3J0czp7fX07ZVtpXVswXS5jYWxsKHAuZXhwb3J0cyxmdW5jdGlvbihyKXt2YXIgbj1lW2ldWzFdW3JdO3JldHVybiBvKG58fHIpfSxwLHAuZXhwb3J0cyxyLGUsbix0KX1yZXR1cm4gbltpXS5leHBvcnRzfWZvcih2YXIgdT1cImZ1bmN0aW9uXCI9PXR5cGVvZiByZXF1aXJlJiZyZXF1aXJlLGk9MDtpPHQubGVuZ3RoO2krKylvKHRbaV0pO3JldHVybiBvfXJldHVybiByfSkoKSIsImV4cG9ydCBjb25zdCByZWdpc3RlcldpZGdldCA9IChjbGFzc05hbWUsIHdpZGdldE5hbWUsIHNraW4gPSAnZGVmYXVsdCcpID0+IHtcbiAgICBpZiAoIShjbGFzc05hbWUgfHwgd2lkZ2V0TmFtZSkpIHtcbiAgICAgICAgcmV0dXJuO1xuICAgIH1cblxuICAgIC8qKlxuICAgICAqIEJlY2F1c2UgRWxlbWVudG9yIHBsdWdpbiB1c2VzIGpRdWVyeSBjdXN0b20gZXZlbnQsXG4gICAgICogV2UgYWxzbyBoYXZlIHRvIHVzZSBqUXVlcnkgdG8gdXNlIHRoaXMgZXZlbnRcbiAgICAgKi9cbiAgICBqUXVlcnkod2luZG93KS5vbignZWxlbWVudG9yL2Zyb250ZW5kL2luaXQnLCAoKSA9PiB7XG4gICAgICAgIGNvbnN0IGFkZEhhbmRsZXIgPSAoJGVsZW1lbnQpID0+IHtcbiAgICAgICAgICAgIGVsZW1lbnRvckZyb250ZW5kLmVsZW1lbnRzSGFuZGxlci5hZGRIYW5kbGVyKGNsYXNzTmFtZSwge1xuICAgICAgICAgICAgICAgICRlbGVtZW50LFxuICAgICAgICAgICAgfSk7XG4gICAgICAgIH07XG5cbiAgICAgICAgZWxlbWVudG9yRnJvbnRlbmQuaG9va3MuYWRkQWN0aW9uKGBmcm9udGVuZC9lbGVtZW50X3JlYWR5LyR7d2lkZ2V0TmFtZX0uJHtza2lufWAsIGFkZEhhbmRsZXIpO1xuICAgIH0pO1xufTtcbiIsImNsYXNzIFpldXNfQ2Fyb3VzZWwgZXh0ZW5kcyBlbGVtZW50b3JNb2R1bGVzLmZyb250ZW5kLmhhbmRsZXJzLkJhc2Uge1xuICAgIGdldERlZmF1bHRTZXR0aW5ncygpIHtcbiAgICAgICAgcmV0dXJuIHtcbiAgICAgICAgICAgIHNlbGVjdG9yczoge1xuICAgICAgICAgICAgICAgIGNhcm91c2VsOiAnLnpldXMtY2Fyb3VzZWwtY29udGFpbmVyJyxcbiAgICAgICAgICAgICAgICBjYXJvdXNlbE5leHRCdG46ICcuc3dpcGVyLWJ1dHRvbi1uZXh0LScgKyB0aGlzLmdldElEKCksXG4gICAgICAgICAgICAgICAgY2Fyb3VzZWxQcmV2QnRuOiAnLnN3aXBlci1idXR0b24tcHJldi0nICsgdGhpcy5nZXRJRCgpLFxuICAgICAgICAgICAgICAgIGNhcm91c2VsUGFnaW5hdGlvbjogJy5zd2lwZXItcGFnaW5hdGlvbi0nICsgdGhpcy5nZXRJRCgpLFxuICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIGVmZmVjdDogJ3NsaWRlJyxcbiAgICAgICAgICAgIGxvb3A6IGZhbHNlLFxuICAgICAgICAgICAgYXV0b3BsYXk6IDAsXG4gICAgICAgICAgICBzcGVlZDogNDAwLFxuICAgICAgICAgICAgbmF2aWdhdGlvbjogZmFsc2UsXG4gICAgICAgICAgICBwYWdpbmF0aW9uOiBmYWxzZSxcbiAgICAgICAgICAgIGNlbnRlcmVkU2xpZGVzOiBmYWxzZSxcbiAgICAgICAgICAgIHBhdXNlT25Ib3ZlcjogZmFsc2UsXG4gICAgICAgICAgICBzbGlkZXNQZXJWaWV3OiB7XG4gICAgICAgICAgICAgICAgZGVza3RvcDogMyxcbiAgICAgICAgICAgICAgICB0YWJsZXQ6IDIsXG4gICAgICAgICAgICAgICAgbW9iaWxlOiAxLFxuICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIHNsaWRlc1Blckdyb3VwOiB7XG4gICAgICAgICAgICAgICAgZGVza3RvcDogMyxcbiAgICAgICAgICAgICAgICB0YWJsZXQ6IDIsXG4gICAgICAgICAgICAgICAgbW9iaWxlOiAxLFxuICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIHNwYWNlQmV0d2Vlbjoge1xuICAgICAgICAgICAgICAgIGRlc2t0b3A6IDEwLFxuICAgICAgICAgICAgICAgIHRhYmxldDogMTAsXG4gICAgICAgICAgICAgICAgbW9iaWxlOiAxMCxcbiAgICAgICAgICAgIH0sXG4gICAgICAgICAgICBzd2lwZXJJbnN0YW5jZTogbnVsbCxcbiAgICAgICAgfTtcbiAgICB9XG5cbiAgICBnZXREZWZhdWx0RWxlbWVudHMoKSB7XG4gICAgICAgIGNvbnN0IGVsZW1lbnQgPSB0aGlzLiRlbGVtZW50LmdldCgwKTtcbiAgICAgICAgY29uc3Qgc2VsZWN0b3JzID0gdGhpcy5nZXRTZXR0aW5ncygnc2VsZWN0b3JzJyk7XG5cbiAgICAgICAgcmV0dXJuIHtcbiAgICAgICAgICAgIGNhcm91c2VsOiBlbGVtZW50LnF1ZXJ5U2VsZWN0b3Ioc2VsZWN0b3JzLmNhcm91c2VsKSxcbiAgICAgICAgICAgIGNhcm91c2VsTmV4dEJ0bjogZWxlbWVudC5xdWVyeVNlbGVjdG9yQWxsKHNlbGVjdG9ycy5jYXJvdXNlbE5leHRCdG4pLFxuICAgICAgICAgICAgY2Fyb3VzZWxQcmV2QnRuOiBlbGVtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoc2VsZWN0b3JzLmNhcm91c2VsUHJldkJ0biksXG4gICAgICAgICAgICBjYXJvdXNlbFBhZ2luYXRpb246IGVsZW1lbnQucXVlcnlTZWxlY3RvckFsbChzZWxlY3RvcnMuY2Fyb3VzZWxQYWdpbmF0aW9uKSxcbiAgICAgICAgfTtcbiAgICB9XG5cbiAgICBvbkluaXQoLi4uYXJncykge1xuICAgICAgICBzdXBlci5vbkluaXQoLi4uYXJncyk7XG5cbiAgICAgICAgdGhpcy5zZXRVc2VyU2V0dGluZ3MoKTtcbiAgICAgICAgdGhpcy5pbml0U3dpcGVyKCk7XG4gICAgICAgIHRoaXMuc2V0dXBFdmVudExpc3RlbmVycygpO1xuICAgIH1cblxuICAgIHNldFVzZXJTZXR0aW5ncygpIHtcbiAgICAgICAgY29uc3Qgc2V0dGluZ3MgPSB0aGlzLmdldFNldHRpbmdzKCk7XG4gICAgICAgIGNvbnN0IHVzZXJTZXR0aW5ncyA9IEpTT04ucGFyc2UodGhpcy5lbGVtZW50cy5jYXJvdXNlbC5nZXRBdHRyaWJ1dGUoJ2RhdGEtc2V0dGluZ3MnKSk7XG5cbiAgICAgICAgY29uc3QgY3VycmVudFNldHRpbmdzID0ge1xuICAgICAgICAgICAgZWZmZWN0OiAhIXVzZXJTZXR0aW5ncy5lZmZlY3QgPyB1c2VyU2V0dGluZ3MuZWZmZWN0IDogc2V0dGluZ3MuZWZmZWN0LFxuICAgICAgICAgICAgbG9vcDogISF1c2VyU2V0dGluZ3MubG9vcCA/IEJvb2xlYW4oTnVtYmVyKHVzZXJTZXR0aW5ncy5sb29wKSkgOiBzZXR0aW5ncy5sb29wLFxuICAgICAgICAgICAgYXV0b3BsYXk6ICEhdXNlclNldHRpbmdzLmF1dG9wbGF5ID8gTnVtYmVyKHVzZXJTZXR0aW5ncy5hdXRvcGxheSkgOiBzZXR0aW5ncy5hdXRvcGxheSxcbiAgICAgICAgICAgIHNwZWVkOiAhIXVzZXJTZXR0aW5ncy5zcGVlZCA/IE51bWJlcih1c2VyU2V0dGluZ3Muc3BlZWQpIDogc2V0dGluZ3Muc3BlZWQsXG4gICAgICAgICAgICBuYXZpZ2F0aW9uOiAhIXVzZXJTZXR0aW5ncy5hcnJvd3MgPyBCb29sZWFuKE51bWJlcih1c2VyU2V0dGluZ3MuYXJyb3dzKSkgOiBzZXR0aW5ncy5uYXZpZ2F0aW9uLFxuICAgICAgICAgICAgcGFnaW5hdGlvbjogISF1c2VyU2V0dGluZ3MuZG90cyA/IEJvb2xlYW4oTnVtYmVyKHVzZXJTZXR0aW5ncy5kb3RzKSkgOiBzZXR0aW5ncy5wYWdpbmF0aW9uLFxuICAgICAgICAgICAgcGF1c2VPbkhvdmVyOiAhIXVzZXJTZXR0aW5nc1sncGF1c2Utb24taG92ZXInXVxuICAgICAgICAgICAgICAgID8gSlNPTi5wYXJzZSh1c2VyU2V0dGluZ3NbJ3BhdXNlLW9uLWhvdmVyJ10pXG4gICAgICAgICAgICAgICAgOiBzZXR0aW5ncy5wYXVzZU9uSG92ZXIsXG4gICAgICAgICAgICBzbGlkZXNQZXJWaWV3OiB7XG4gICAgICAgICAgICAgICAgZGVza3RvcDogISF1c2VyU2V0dGluZ3MuaXRlbXMgPyBOdW1iZXIodXNlclNldHRpbmdzLml0ZW1zKSA6IHNldHRpbmdzLnNsaWRlc1BlclZpZXcuZGVza3RvcCxcbiAgICAgICAgICAgICAgICB0YWJsZXQ6ICEhdXNlclNldHRpbmdzWydpdGVtcy10YWJsZXQnXVxuICAgICAgICAgICAgICAgICAgICA/IE51bWJlcih1c2VyU2V0dGluZ3NbJ2l0ZW1zLXRhYmxldCddKVxuICAgICAgICAgICAgICAgICAgICA6IHNldHRpbmdzLnNsaWRlc1BlclZpZXcudGFibGV0LFxuICAgICAgICAgICAgICAgIG1vYmlsZTogISF1c2VyU2V0dGluZ3NbJ2l0ZW1zLW1vYmlsZSddXG4gICAgICAgICAgICAgICAgICAgID8gTnVtYmVyKHVzZXJTZXR0aW5nc1snaXRlbXMtbW9iaWxlJ10pXG4gICAgICAgICAgICAgICAgICAgIDogc2V0dGluZ3Muc2xpZGVzUGVyVmlldy5tb2JpbGUsXG4gICAgICAgICAgICB9LFxuICAgICAgICAgICAgc2xpZGVzUGVyR3JvdXA6IHtcbiAgICAgICAgICAgICAgICBkZXNrdG9wOiAhIXVzZXJTZXR0aW5ncy5zbGlkZXMgPyBOdW1iZXIodXNlclNldHRpbmdzLnNsaWRlcykgOiBzZXR0aW5ncy5zbGlkZXNQZXJHcm91cC5kZXNrdG9wLFxuICAgICAgICAgICAgICAgIHRhYmxldDogISF1c2VyU2V0dGluZ3NbJ3NsaWRlcy10YWJsZXQnXVxuICAgICAgICAgICAgICAgICAgICA/IE51bWJlcih1c2VyU2V0dGluZ3NbJ3NsaWRlcy10YWJsZXQnXSlcbiAgICAgICAgICAgICAgICAgICAgOiBzZXR0aW5ncy5zbGlkZXNQZXJHcm91cC50YWJsZXQsXG4gICAgICAgICAgICAgICAgbW9iaWxlOiAhIXVzZXJTZXR0aW5nc1snc2xpZGVzLW1vYmlsZSddXG4gICAgICAgICAgICAgICAgICAgID8gTnVtYmVyKHVzZXJTZXR0aW5nc1snc2xpZGVzLW1vYmlsZSddKVxuICAgICAgICAgICAgICAgICAgICA6IHNldHRpbmdzLnNsaWRlc1Blckdyb3VwLm1vYmlsZSxcbiAgICAgICAgICAgIH0sXG4gICAgICAgICAgICBzcGFjZUJldHdlZW46IHtcbiAgICAgICAgICAgICAgICBkZXNrdG9wOiAhIXVzZXJTZXR0aW5ncy5tYXJnaW4gPyBOdW1iZXIodXNlclNldHRpbmdzLm1hcmdpbikgOiBzZXR0aW5ncy5zcGFjZUJldHdlZW4uZGVza3RvcCxcbiAgICAgICAgICAgICAgICB0YWJsZXQ6ICEhdXNlclNldHRpbmdzWydtYXJnaW4tdGFibGV0J11cbiAgICAgICAgICAgICAgICAgICAgPyBOdW1iZXIodXNlclNldHRpbmdzWydtYXJnaW4tdGFibGV0J10pXG4gICAgICAgICAgICAgICAgICAgIDogc2V0dGluZ3Muc3BhY2VCZXR3ZWVuLnRhYmxldCxcbiAgICAgICAgICAgICAgICBtb2JpbGU6ICEhdXNlclNldHRpbmdzWydtYXJnaW4tbW9iaWxlJ11cbiAgICAgICAgICAgICAgICAgICAgPyBOdW1iZXIodXNlclNldHRpbmdzWydtYXJnaW4tbW9iaWxlJ10pXG4gICAgICAgICAgICAgICAgICAgIDogc2V0dGluZ3Muc3BhY2VCZXR3ZWVuLm1vYmlsZSxcbiAgICAgICAgICAgIH0sXG4gICAgICAgIH07XG5cbiAgICAgICAgY3VycmVudFNldHRpbmdzLmNlbnRlcmVkU2xpZGVzID0gJ2NvdmVyZmxvdycgPT09IGN1cnJlbnRTZXR0aW5ncy5lZmZlY3QgPyB0cnVlIDogc2V0dGluZ3MuY2VudGVyZWRTbGlkZXM7XG5cbiAgICAgICAgdGhpcy5zZXRTZXR0aW5ncyhjdXJyZW50U2V0dGluZ3MpO1xuICAgIH1cblxuICAgIGluaXRTd2lwZXIoKSB7XG4gICAgICAgIGNvbnN0IHN3aXBlciA9IG5ldyBTd2lwZXIodGhpcy5lbGVtZW50cy5jYXJvdXNlbCwgdGhpcy5zd2lwZXJPcHRpb25zKCkpO1xuXG4gICAgICAgIHRoaXMuc2V0U2V0dGluZ3Moe1xuICAgICAgICAgICAgc3dpcGVySW5zdGFuY2U6IHN3aXBlcixcbiAgICAgICAgfSk7XG4gICAgfVxuXG4gICAgc3dpcGVyT3B0aW9ucygpIHtcbiAgICAgICAgY29uc3Qgc2V0dGluZ3MgPSB0aGlzLmdldFNldHRpbmdzKCk7XG5cbiAgICAgICAgY29uc3Qgc3dpcGVyT3B0aW9ucyA9IHtcbiAgICAgICAgICAgIGRpcmVjdGlvbjogJ2hvcml6b250YWwnLFxuICAgICAgICAgICAgZWZmZWN0OiBzZXR0aW5ncy5lZmZlY3QsXG4gICAgICAgICAgICBsb29wOiBzZXR0aW5ncy5sb29wLFxuICAgICAgICAgICAgc3BlZWQ6IHNldHRpbmdzLnNwZWVkLFxuICAgICAgICAgICAgY2VudGVyZWRTbGlkZXM6IHNldHRpbmdzLmNlbnRlcmVkU2xpZGVzLFxuICAgICAgICAgICAgYXV0b0hlaWdodDogdHJ1ZSxcbiAgICAgICAgICAgIGF1dG9wbGF5OiAhc2V0dGluZ3MuYXV0b3BsYXlcbiAgICAgICAgICAgICAgICA/IGZhbHNlXG4gICAgICAgICAgICAgICAgOiB7XG4gICAgICAgICAgICAgICAgICAgICAgZGVsYXk6IHNldHRpbmdzLmF1dG9wbGF5LFxuICAgICAgICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIG5hdmlnYXRpb246ICFzZXR0aW5ncy5uYXZpZ2F0aW9uXG4gICAgICAgICAgICAgICAgPyBmYWxzZVxuICAgICAgICAgICAgICAgIDoge1xuICAgICAgICAgICAgICAgICAgICAgIG5leHRFbDogc2V0dGluZ3Muc2VsZWN0b3JzLmNhcm91c2VsTmV4dEJ0bixcbiAgICAgICAgICAgICAgICAgICAgICBwcmV2RWw6IHNldHRpbmdzLnNlbGVjdG9ycy5jYXJvdXNlbFByZXZCdG4sXG4gICAgICAgICAgICAgICAgICB9LFxuICAgICAgICAgICAgcGFnaW5hdGlvbjogIXNldHRpbmdzLnBhZ2luYXRpb25cbiAgICAgICAgICAgICAgICA/IGZhbHNlXG4gICAgICAgICAgICAgICAgOiB7XG4gICAgICAgICAgICAgICAgICAgICAgZWw6IHNldHRpbmdzLnNlbGVjdG9ycy5jYXJvdXNlbFBhZ2luYXRpb24sXG4gICAgICAgICAgICAgICAgICAgICAgY2xpY2thYmxlOiB0cnVlLFxuICAgICAgICAgICAgICAgICAgfSxcbiAgICAgICAgfTtcblxuICAgICAgICBpZiAoc2V0dGluZ3MuZWZmZWN0ID09PSAnZmFkZScpIHtcbiAgICAgICAgICAgIHN3aXBlck9wdGlvbnMuaXRlbXMgPSAxO1xuICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgc3dpcGVyT3B0aW9ucy5icmVha3BvaW50cyA9IHtcbiAgICAgICAgICAgICAgICAxMDI0OiB7XG4gICAgICAgICAgICAgICAgICAgIHNsaWRlc1BlclZpZXc6IHNldHRpbmdzLnNsaWRlc1BlclZpZXcuZGVza3RvcCxcbiAgICAgICAgICAgICAgICAgICAgc2xpZGVzUGVyR3JvdXA6IHNldHRpbmdzLnNsaWRlc1Blckdyb3VwLmRlc2t0b3AsXG4gICAgICAgICAgICAgICAgICAgIHNwYWNlQmV0d2Vlbjogc2V0dGluZ3Muc3BhY2VCZXR3ZWVuLmRlc2t0b3AsXG4gICAgICAgICAgICAgICAgfSxcbiAgICAgICAgICAgICAgICA3Njg6IHtcbiAgICAgICAgICAgICAgICAgICAgc2xpZGVzUGVyVmlldzogc2V0dGluZ3Muc2xpZGVzUGVyVmlldy50YWJsZXQsXG4gICAgICAgICAgICAgICAgICAgIHNsaWRlc1Blckdyb3VwOiBzZXR0aW5ncy5zbGlkZXNQZXJHcm91cC50YWJsZXQsXG4gICAgICAgICAgICAgICAgICAgIHNwYWNlQmV0d2Vlbjogc2V0dGluZ3Muc3BhY2VCZXR3ZWVuLnRhYmxldCxcbiAgICAgICAgICAgICAgICB9LFxuICAgICAgICAgICAgICAgIDMyMDoge1xuICAgICAgICAgICAgICAgICAgICBzbGlkZXNQZXJWaWV3OiBzZXR0aW5ncy5zbGlkZXNQZXJWaWV3Lm1vYmlsZSxcbiAgICAgICAgICAgICAgICAgICAgc2xpZGVzUGVyR3JvdXA6IHNldHRpbmdzLnNsaWRlc1Blckdyb3VwLm1vYmlsZSxcbiAgICAgICAgICAgICAgICAgICAgc3BhY2VCZXR3ZWVuOiBzZXR0aW5ncy5zcGFjZUJldHdlZW4ubW9iaWxlLFxuICAgICAgICAgICAgICAgIH0sXG4gICAgICAgICAgICB9O1xuICAgICAgICB9XG5cbiAgICAgICAgcmV0dXJuIHN3aXBlck9wdGlvbnM7XG4gICAgfVxuXG4gICAgc2V0dXBFdmVudExpc3RlbmVycygpIHtcbiAgICAgICAgaWYgKHRoaXMuZ2V0U2V0dGluZ3MoJ3BhdXNlT25Ib3ZlcicpKSB7XG4gICAgICAgICAgICB0aGlzLmVsZW1lbnRzLmNhcm91c2VsLmFkZEV2ZW50TGlzdGVuZXIoJ21vdXNlZW50ZXInLCB0aGlzLnBhdXNlU3dpcGVyLmJpbmQodGhpcykpO1xuICAgICAgICAgICAgdGhpcy5lbGVtZW50cy5jYXJvdXNlbC5hZGRFdmVudExpc3RlbmVyKCdtb3VzZWxlYXZlJywgdGhpcy5yZXN1bWVTd2lwZXIuYmluZCh0aGlzKSk7XG4gICAgICAgIH1cbiAgICB9XG5cbiAgICBwYXVzZVN3aXBlcihldmVudCkge1xuICAgICAgICB0aGlzLmdldFNldHRpbmdzKCdzd2lwZXJJbnN0YW5jZScpLmF1dG9wbGF5LnN0b3AoKTtcbiAgICB9XG5cbiAgICByZXN1bWVTd2lwZXIoZXZlbnQpIHtcbiAgICAgICAgdGhpcy5nZXRTZXR0aW5ncygnc3dpcGVySW5zdGFuY2UnKS5hdXRvcGxheS5zdGFydCgpO1xuICAgIH1cbn1cblxuZXhwb3J0IGRlZmF1bHQgWmV1c19DYXJvdXNlbDtcbiIsImltcG9ydCB7IHJlZ2lzdGVyV2lkZ2V0IH0gZnJvbSBcIi4uL2xpYi91dGlsc1wiO1xuaW1wb3J0IFpldXNfQ2Fyb3VzZWwgZnJvbSBcIi4vYmFzZS9jYXJvdXNlbFwiO1xuXG5jbGFzcyBaZXVzX01lbWJlckNhcm91c2VsIGV4dGVuZHMgWmV1c19DYXJvdXNlbCB7fVxuXG5yZWdpc3RlcldpZGdldChaZXVzX01lbWJlckNhcm91c2VsLCBcInpldXMtbWVtYmVyLWNhcm91c2VsXCIpO1xuIl19
