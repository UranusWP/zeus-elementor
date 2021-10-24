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
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm5vZGVfbW9kdWxlcy9icm93c2VyLXBhY2svX3ByZWx1ZGUuanMiLCJzcmMvbGliL3V0aWxzLmpzIiwic3JjL3dpZGdldHMvYmFzZS9jYXJvdXNlbC5qcyIsInNyYy93aWRnZXRzL2Jsb2ctY2Fyb3VzZWwuanMiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBQUE7Ozs7Ozs7O0FDQU8sSUFBTSxjQUFjLEdBQUcsU0FBakIsY0FBaUIsQ0FBQyxTQUFELEVBQVksVUFBWixFQUE2QztBQUFBLE1BQXJCLElBQXFCLHVFQUFkLFNBQWM7O0FBQ3ZFLE1BQUksRUFBRSxTQUFTLElBQUksVUFBZixDQUFKLEVBQWdDO0FBQzVCO0FBQ0g7QUFFRDtBQUNKO0FBQ0E7QUFDQTs7O0FBQ0ksRUFBQSxNQUFNLENBQUMsTUFBRCxDQUFOLENBQWUsRUFBZixDQUFrQix5QkFBbEIsRUFBNkMsWUFBTTtBQUMvQyxRQUFNLFVBQVUsR0FBRyxTQUFiLFVBQWEsQ0FBQyxRQUFELEVBQWM7QUFDN0IsTUFBQSxpQkFBaUIsQ0FBQyxlQUFsQixDQUFrQyxVQUFsQyxDQUE2QyxTQUE3QyxFQUF3RDtBQUNwRCxRQUFBLFFBQVEsRUFBUjtBQURvRCxPQUF4RDtBQUdILEtBSkQ7O0FBTUEsSUFBQSxpQkFBaUIsQ0FBQyxLQUFsQixDQUF3QixTQUF4QixrQ0FBNEQsVUFBNUQsY0FBMEUsSUFBMUUsR0FBa0YsVUFBbEY7QUFDSCxHQVJEO0FBU0gsQ0FsQk07Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7O0lDQUQsYTs7Ozs7Ozs7Ozs7OztXQUNGLDhCQUFxQjtBQUNqQixhQUFPO0FBQ0gsUUFBQSxTQUFTLEVBQUU7QUFDUCxVQUFBLFFBQVEsRUFBRSwwQkFESDtBQUVQLFVBQUEsZUFBZSxFQUFFLHlCQUF5QixLQUFLLEtBQUwsRUFGbkM7QUFHUCxVQUFBLGVBQWUsRUFBRSx5QkFBeUIsS0FBSyxLQUFMLEVBSG5DO0FBSVAsVUFBQSxrQkFBa0IsRUFBRSx3QkFBd0IsS0FBSyxL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IjpbIihmdW5jdGlvbigpe2Z1bmN0aW9uIHIoZSxuLHQpe2Z1bmN0aW9uIG8oaSxmKXtpZighbltpXSl7aWYoIWVbaV0pe3ZhciBjPVwiZnVuY3Rpb25cIj09dHlwZW9mIHJlcXVpcmUmJnJlcXVpcmU7aWYoIWYmJmMpcmV0dXJuIGMoaSwhMCk7aWYodSlyZXR1cm4gdShpLCEwKTt2YXIgYT1uZXcgRXJyb3IoXCJDYW5ub3QgZmluZCBtb2R1bGUgJ1wiK2krXCInXCIpO3Rocm93IGEuY29kZT1cIk1PRFVMRV9OT1RfRk9VTkRcIixhfXZhciBwPW5baV09e2V4cG9ydHM6e319O2VbaV1bMF0uY2FsbChwLmV4cG9ydHMsZnVuY3Rpb24ocil7dmFyIG49ZVtpXVsxXVtyXTtyZXR1cm4gbyhufHxyKX0scCxwLmV4cG9ydHMscixlLG4sdCl9cmV0dXJuIG5baV0uZXhwb3J0c31mb3IodmFyIHU9XCJmdW5jdGlvblwiPT10eXBlb2YgcmVxdWlyZSYmcmVxdWlyZSxpPTA7aTx0Lmxlbmd0aDtpKyspbyh0W2ldKTtyZXR1cm4gb31yZXR1cm4gcn0pKCkiLCJleHBvcnQgY29uc3QgcmVnaXN0ZXJXaWRnZXQgPSAoY2xhc3NOYW1lLCB3aWRnZXROYW1lLCBza2luID0gJ2RlZmF1bHQnKSA9PiB7XG4gICAgaWYgKCEoY2xhc3NOYW1lIHx8IHdpZGdldE5hbWUpKSB7XG4gICAgICAgIHJldHVybjtcbiAgICB9XG5cbiAgICAvKipcbiAgICAgKiBCZWNhdXNlIEVsZW1lbnRvciBwbHVnaW4gdXNlcyBqUXVlcnkgY3VzdG9tIGV2ZW50LFxuICAgICAqIFdlIGFsc28gaGF2ZSB0byB1c2UgalF1ZXJ5IHRvIHVzZSB0aGlzIGV2ZW50XG4gICAgICovXG4gICAgalF1ZXJ5KHdpbmRvdykub24oJ2VsZW1lbnRvci9mcm9udGVuZC9pbml0JywgKCkgPT4ge1xuICAgICAgICBjb25zdCBhZGRIYW5kbGVyID0gKCRlbGVtZW50KSA9PiB7XG4gICAgICAgICAgICBlbGVtZW50b3JGcm9udGVuZC5lbGVtZW50c0hhbmRsZXIuYWRkSGFuZGxlcihjbGFzc05hbWUsIHtcbiAgICAgICAgICAgICAgICAkZWxlbWVudCxcbiAgICAgICAgICAgIH0pO1xuICAgICAgICB9O1xuXG4gICAgICAgIGVsZW1lbnRvckZyb250ZW5kLmhvb2tzLmFkZEFjdGlvbihgZnJvbnRlbmQvZWxlbWVudF9yZWFkeS8ke3dpZGdldE5hbWV9LiR7c2tpbn1gLCBhZGRIYW5kbGVyKTtcbiAgICB9KTtcbn07XG4iLCJjbGFzcyBaZXVzX0Nhcm91c2VsIGV4dGVuZHMgZWxlbWVudG9yTW9kdWxlcy5mcm9udGVuZC5oYW5kbGVycy5CYXNlIHtcbiAgICBnZXREZWZhdWx0U2V0dGluZ3MoKSB7XG4gICAgICAgIHJldHVybiB7XG4gICAgICAgICAgICBzZWxlY3RvcnM6IHtcbiAgICAgICAgICAgICAgICBjYXJvdXNlbDogJy56ZXVzLWNhcm91c2VsLWNvbnRhaW5lcicsXG4gICAgICAgICAgICAgICAgY2Fyb3VzZWxOZXh0QnRuOiAnLnN3aXBlci1idXR0b24tbmV4dC0nICsgdGhpcy5nZXRJRCgpLFxuICAgICAgICAgICAgICAgIGNhcm91c2VsUHJldkJ0bjogJy5zd2lwZXItYnV0dG9uLXByZXYtJyArIHRoaXMuZ2V0SUQoKSxcbiAgICAgICAgICAgICAgICBjYXJvdXNlbFBhZ2luYXRpb246ICcuc3dpcGVyLXBhZ2luYXRpb24tJyArIHRoaXMuZ2V0SUQoKSxcbiAgICAgICAgICAgIH0sXG4gICAgICAgICAgICBlZmZlY3Q6ICdzbGlkZScsXG4gICAgICAgICAgICBsb29wOiBmYWxzZSxcbiAgICAgICAgICAgIGF1dG9wbGF5OiAwLFxuICAgICAgICAgICAgc3BlZWQ6IDQwMCxcbiAgICAgICAgICAgIG5hdmlnYXRpb246IGZhbHNlLFxuICAgICAgICAgICAgcGFnaW5hdGlvbjogZmFsc2UsXG4gICAgICAgICAgICBjZW50ZXJlZFNsaWRlczogZmFsc2UsXG4gICAgICAgICAgICBwYXVzZU9uSG92ZXI6IGZhbHNlLFxuICAgICAgICAgICAgc2xpZGVzUGVyVmlldzoge1xuICAgICAgICAgICAgICAgIGRlc2t0b3A6IDMsXG4gICAgICAgICAgICAgICAgdGFibGV0OiAyLFxuICAgICAgICAgICAgICAgIG1vYmlsZTogMSxcbiAgICAgICAgICAgIH0sXG4gICAgICAgICAgICBzbGlkZXNQZXJHcm91cDoge1xuICAgICAgICAgICAgICAgIGRlc2t0b3A6IDMsXG4gICAgICAgICAgICAgICAgdGFibGV0OiAyLFxuICAgICAgICAgICAgICAgIG1vYmlsZTogMSxcbiAgICAgICAgICAgIH0sXG4gICAgICAgICAgICBzcGFjZUJldHdlZW46IHtcbiAgICAgICAgICAgICAgICBkZXNrdG9wOiAxMCxcbiAgICAgICAgICAgICAgICB0YWJsZXQ6IDEwLFxuICAgICAgICAgICAgICAgIG1vYmlsZTogMTAsXG4gICAgICAgICAgICB9LFxuICAgICAgICAgICAgc3dpcGVySW5zdGFuY2U6IG51bGwsXG4gICAgICAgIH07XG4gICAgfVxuXG4gICAgZ2V0RGVmYXVsdEVsZW1lbnRzKCkge1xuICAgICAgICBjb25zdCBlbGVtZW50ID0gdGhpcy4kZWxlbWVudC5nZXQoMCk7XG4gICAgICAgIGNvbnN0IHNlbGVjdG9ycyA9IHRoaXMuZ2V0U2V0dGluZ3MoJ3NlbGVjdG9ycycpO1xuXG4gICAgICAgIHJldHVybiB7XG4gICAgICAgICAgICBjYXJvdXNlbDogZWxlbWVudC5xdWVyeVNlbGVjdG9yKHNlbGVjdG9ycy5jYXJvdXNlbCksXG4gICAgICAgICAgICBjYXJvdXNlbE5leHRCdG46IGVsZW1lbnQucXVlcnlTZWxlY3RvckFsbChzZWxlY3RvcnMuY2Fyb3VzZWxOZXh0QnRuKSxcbiAgICAgICAgICAgIGNhcm91c2VsUHJldkJ0bjogZWxlbWVudC5xdWVyeVNlbGVjdG9yQWxsKHNlbGVjdG9ycy5jYXJvdXNlbFByZXZCdG4pLFxuICAgICAgICAgICAgY2Fyb3VzZWxQYWdpbmF0aW9uOiBlbGVtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoc2VsZWN0b3JzLmNhcm91c2VsUGFnaW5hdGlvbiksXG4gICAgICAgIH07XG4gICAgfVxuXG4gICAgb25Jbml0KC4uLmFyZ3MpIHtcbiAgICAgICAgc3VwZXIub25Jbml0KC4uLmFyZ3MpO1xuXG4gICAgICAgIHRoaXMuc2V0VXNlclNldHRpbmdzKCk7XG4gICAgICAgIHRoaXMuaW5pdFN3aXBlcigpO1xuICAgICAgICB0aGlzLnNldHVwRXZlbnRMaXN0ZW5lcnMoKTtcbiAgICB9XG5cbiAgICBzZXRVc2VyU2V0dGluZ3MoKSB7XG4gICAgICAgIGNvbnN0IHNldHRpbmdzID0gdGhpcy5nZXRTZXR0aW5ncygpO1xuICAgICAgICBjb25zdCB1c2VyU2V0dGluZ3MgPSBKU09OLnBhcnNlKHRoaXMuZWxlbWVudHMuY2Fyb3VzZWwuZ2V0QXR0cmlidXRlKCdkYXRhLXNldHRpbmdzJykpO1xuXG4gICAgICAgIGNvbnN0IGN1cnJlbnRTZXR0aW5ncyA9IHtcbiAgICAgICAgICAgIGVmZmVjdDogISF1c2VyU2V0dGluZ3MuZWZmZWN0ID8gdXNlclNldHRpbmdzLmVmZmVjdCA6IHNldHRpbmdzLmVmZmVjdCxcbiAgICAgICAgICAgIGxvb3A6ICEhdXNlclNldHRpbmdzLmxvb3AgPyBCb29sZWFuKE51bWJlcih1c2VyU2V0dGluZ3MubG9vcCkpIDogc2V0dGluZ3MubG9vcCxcbiAgICAgICAgICAgIGF1dG9wbGF5OiAhIXVzZXJTZXR0aW5ncy5hdXRvcGxheSA/IE51bWJlcih1c2VyU2V0dGluZ3MuYXV0b3BsYXkpIDogc2V0dGluZ3MuYXV0b3BsYXksXG4gICAgICAgICAgICBzcGVlZDogISF1c2VyU2V0dGluZ3Muc3BlZWQgPyBOdW1iZXIodXNlclNldHRpbmdzLnNwZWVkKSA6IHNldHRpbmdzLnNwZWVkLFxuICAgICAgICAgICAgbmF2aWdhdGlvbjogISF1c2VyU2V0dGluZ3MuYXJyb3dzID8gQm9vbGVhbihOdW1iZXIodXNlclNldHRpbmdzLmFycm93cykpIDogc2V0dGluZ3MubmF2aWdhdGlvbixcbiAgICAgICAgICAgIHBhZ2luYXRpb246ICEhdXNlclNldHRpbmdzLmRvdHMgPyBCb29sZWFuKE51bWJlcih1c2VyU2V0dGluZ3MuZG90cykpIDogc2V0dGluZ3MucGFnaW5hdGlvbixcbiAgICAgICAgICAgIHBhdXNlT25Ib3ZlcjogISF1c2VyU2V0dGluZ3NbJ3BhdXNlLW9uLWhvdmVyJ11cbiAgICAgICAgICAgICAgICA/IEpTT04ucGFyc2UodXNlclNldHRpbmdzWydwYXVzZS1vbi1ob3ZlciddKVxuICAgICAgICAgICAgICAgIDogc2V0dGluZ3MucGF1c2VPbkhvdmVyLFxuICAgICAgICAgICAgc2xpZGVzUGVyVmlldzoge1xuICAgICAgICAgICAgICAgIGRlc2t0b3A6ICEhdXNlclNldHRpbmdzLml0ZW1zID8gTnVtYmVyKHVzZXJTZXR0aW5ncy5pdGVtcykgOiBzZXR0aW5ncy5zbGlkZXNQZXJWaWV3LmRlc2t0b3AsXG4gICAgICAgICAgICAgICAgdGFibGV0OiAhIXVzZXJTZXR0aW5nc1snaXRlbXMtdGFibGV0J11cbiAgICAgICAgICAgICAgICAgICAgPyBOdW1iZXIodXNlclNldHRpbmdzWydpdGVtcy10YWJsZXQnXSlcbiAgICAgICAgICAgICAgICAgICAgOiBzZXR0aW5ncy5zbGlkZXNQZXJWaWV3LnRhYmxldCxcbiAgICAgICAgICAgICAgICBtb2JpbGU6ICEhdXNlclNldHRpbmdzWydpdGVtcy1tb2JpbGUnXVxuICAgICAgICAgICAgICAgICAgICA/IE51bWJlcih1c2VyU2V0dGluZ3NbJ2l0ZW1zLW1vYmlsZSddKVxuICAgICAgICAgICAgICAgICAgICA6IHNldHRpbmdzLnNsaWRlc1BlclZpZXcubW9iaWxlLFxuICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIHNsaWRlc1Blckdyb3VwOiB7XG4gICAgICAgICAgICAgICAgZGVza3RvcDogISF1c2VyU2V0dGluZ3Muc2xpZGVzID8gTnVtYmVyKHVzZXJTZXR0aW5ncy5zbGlkZXMpIDogc2V0dGluZ3Muc2xpZGVzUGVyR3JvdXAuZGVza3RvcCxcbiAgICAgICAgICAgICAgICB0YWJsZXQ6ICEhdXNlclNldHRpbmdzWydzbGlkZXMtdGFibGV0J11cbiAgICAgICAgICAgICAgICAgICAgPyBOdW1iZXIodXNlclNldHRpbmdzWydzbGlkZXMtdGFibGV0J10pXG4gICAgICAgICAgICAgICAgICAgIDogc2V0dGluZ3Muc2xpZGVzUGVyR3JvdXAudGFibGV0LFxuICAgICAgICAgICAgICAgIG1vYmlsZTogISF1c2VyU2V0dGluZ3NbJ3NsaWRlcy1tb2JpbGUnXVxuICAgICAgICAgICAgICAgICAgICA/IE51bWJlcih1c2VyU2V0dGluZ3NbJ3NsaWRlcy1tb2JpbGUnXSlcbiAgICAgICAgICAgICAgICAgICAgOiBzZXR0aW5ncy5zbGlkZXNQZXJHcm91cC5tb2JpbGUsXG4gICAgICAgICAgICB9LFxuICAgICAgICAgICAgc3BhY2VCZXR3ZWVuOiB7XG4gICAgICAgICAgICAgICAgZGVza3RvcDogISF1c2VyU2V0dGluZ3MubWFyZ2luID8gTnVtYmVyKHVzZXJTZXR0aW5ncy5tYXJnaW4pIDogc2V0dGluZ3Muc3BhY2VCZXR3ZWVuLmRlc2t0b3AsXG4gICAgICAgICAgICAgICAgdGFibGV0OiAhIXVzZXJTZXR0aW5nc1snbWFyZ2luLXRhYmxldCddXG4gICAgICAgICAgICAgICAgICAgID8gTnVtYmVyKHVzZXJTZXR0aW5nc1snbWFyZ2luLXRhYmxldCddKVxuICAgICAgICAgICAgICAgICAgICA6IHNldHRpbmdzLnNwYWNlQmV0d2Vlbi50YWJsZXQsXG4gICAgICAgICAgICAgICAgbW9iaWxlOiAhIXVzZXJTZXR0aW5nc1snbWFyZ2luLW1vYmlsZSddXG4gICAgICAgICAgICAgICAgICAgID8gTnVtYmVyKHVzZXJTZXR0aW5nc1snbWFyZ2luLW1vYmlsZSddKVxuICAgICAgICAgICAgICAgICAgICA6IHNldHRpbmdzLnNwYWNlQmV0d2Vlbi5tb2JpbGUsXG4gICAgICAgICAgICB9LFxuICAgICAgICB9O1xuXG4gICAgICAgIGN1cnJlbnRTZXR0aW5ncy5jZW50ZXJlZFNsaWRlcyA9ICdjb3ZlcmZsb3cnID09PSBjdXJyZW50U2V0dGluZ3MuZWZmZWN0ID8gdHJ1ZSA6IHNldHRpbmdzLmNlbnRlcmVkU2xpZGVzO1xuXG4gICAgICAgIHRoaXMuc2V0U2V0dGluZ3MoY3VycmVudFNldHRpbmdzKTtcbiAgICB9XG5cbiAgICBpbml0U3dpcGVyKCkge1xuICAgICAgICBjb25zdCBzd2lwZXIgPSBuZXcgU3dpcGVyKHRoaXMuZWxlbWVudHMuY2Fyb3VzZWwsIHRoaXMuc3dpcGVyT3B0aW9ucygpKTtcblxuICAgICAgICB0aGlzLnNldFNldHRpbmdzKHtcbiAgICAgICAgICAgIHN3aXBlckluc3RhbmNlOiBzd2lwZXIsXG4gICAgICAgIH0pO1xuICAgIH1cblxuICAgIHN3aXBlck9wdGlvbnMoKSB7XG4gICAgICAgIGNvbnN0IHNldHRpbmdzID0gdGhpcy5nZXRTZXR0aW5ncygpO1xuXG4gICAgICAgIGNvbnN0IHN3aXBlck9wdGlvbnMgPSB7XG4gICAgICAgICAgICBkaXJlY3Rpb246ICdob3Jpem9udGFsJyxcbiAgICAgICAgICAgIGVmZmVjdDogc2V0dGluZ3MuZWZmZWN0LFxuICAgICAgICAgICAgbG9vcDogc2V0dGluZ3MubG9vcCxcbiAgICAgICAgICAgIHNwZWVkOiBzZXR0aW5ncy5zcGVlZCxcbiAgICAgICAgICAgIGNlbnRlcmVkU2xpZGVzOiBzZXR0aW5ncy5jZW50ZXJlZFNsaWRlcyxcbiAgICAgICAgICAgIGF1dG9IZWlnaHQ6IHRydWUsXG4gICAgICAgICAgICBhdXRvcGxheTogIXNldHRpbmdzLmF1dG9wbGF5XG4gICAgICAgICAgICAgICAgPyBmYWxzZVxuICAgICAgICAgICAgICAgIDoge1xuICAgICAgICAgICAgICAgICAgICAgIGRlbGF5OiBzZXR0aW5ncy5hdXRvcGxheSxcbiAgICAgICAgICAgICAgICAgIH0sXG4gICAgICAgICAgICBuYXZpZ2F0aW9uOiAhc2V0dGluZ3MubmF2aWdhdGlvblxuICAgICAgICAgICAgICAgID8gZmFsc2VcbiAgICAgICAgICAgICAgICA6IHtcbiAgICAgICAgICAgICAgICAgICAgICBuZXh0RWw6IHNldHRpbmdzLnNlbGVjdG9ycy5jYXJvdXNlbE5leHRCdG4sXG4gICAgICAgICAgICAgICAgICAgICAgcHJldkVsOiBzZXR0aW5ncy5zZWxlY3RvcnMuY2Fyb3VzZWxQcmV2QnRuLFxuICAgICAgICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIHBhZ2luYXRpb246ICFzZXR0aW5ncy5wYWdpbmF0aW9uXG4gICAgICAgICAgICAgICAgPyBmYWxzZVxuICAgICAgICAgICAgICAgIDoge1xuICAgICAgICAgICAgICAgICAgICAgIGVsOiBzZXR0aW5ncy5zZWxlY3RvcnMuY2Fyb3VzZWxQYWdpbmF0aW9uLFxuICAgICAgICAgICAgICAgICAgICAgIGNsaWNrYWJsZTogdHJ1ZSxcbiAgICAgICAgICAgICAgICAgIH0sXG4gICAgICAgIH07XG5cbiAgICAgICAgaWYgKHNldHRpbmdzLmVmZmVjdCA9PT0gJ2ZhZGUnKSB7XG4gICAgICAgICAgICBzd2lwZXJPcHRpb25zLml0ZW1zID0gMTtcbiAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgIHN3aXBlck9wdGlvbnMuYnJlYWtwb2ludHMgPSB7XG4gICAgICAgICAgICAgICAgMTAyNDoge1xuICAgICAgICAgICAgICAgICAgICBzbGlkZXNQZXJWaWV3OiBzZXR0aW5ncy5zbGlkZXNQZXJWaWV3LmRlc2t0b3AsXG4gICAgICAgICAgICAgICAgICAgIHNsaWRlc1Blckdyb3VwOiBzZXR0aW5ncy5zbGlkZXNQZXJHcm91cC5kZXNrdG9wLFxuICAgICAgICAgICAgICAgICAgICBzcGFjZUJldHdlZW46IHNldHRpbmdzLnNwYWNlQmV0d2Vlbi5kZXNrdG9wLFxuICAgICAgICAgICAgICAgIH0sXG4gICAgICAgICAgICAgICAgNzY4OiB7XG4gICAgICAgICAgICAgICAgICAgIHNsaWRlc1BlclZpZXc6IHNldHRpbmdzLnNsaWRlc1BlclZpZXcudGFibGV0LFxuICAgICAgICAgICAgICAgICAgICBzbGlkZXNQZXJHcm91cDogc2V0dGluZ3Muc2xpZGVzUGVyR3JvdXAudGFibGV0LFxuICAgICAgICAgICAgICAgICAgICBzcGFjZUJldHdlZW46IHNldHRpbmdzLnNwYWNlQmV0d2Vlbi50YWJsZXQsXG4gICAgICAgICAgICAgICAgfSxcbiAgICAgICAgICAgICAgICAzMjA6IHtcbiAgICAgICAgICAgICAgICAgICAgc2xpZGVzUGVyVmlldzogc2V0dGluZ3Muc2xpZGVzUGVyVmlldy5tb2JpbGUsXG4gICAgICAgICAgICAgICAgICAgIHNsaWRlc1Blckdyb3VwOiBzZXR0aW5ncy5zbGlkZXNQZXJHcm91cC5tb2JpbGUsXG4gICAgICAgICAgICAgICAgICAgIHNwYWNlQmV0d2Vlbjogc2V0dGluZ3Muc3BhY2VCZXR3ZWVuLm1vYmlsZSxcbiAgICAgICAgICAgICAgICB9LFxuICAgICAgICAgICAgfTtcbiAgICAgICAgfVxuXG4gICAgICAgIHJldHVybiBzd2lwZXJPcHRpb25zO1xuICAgIH1cblxuICAgIHNldHVwRXZlbnRMaXN0ZW5lcnMoKSB7XG4gICAgICAgIGlmICh0aGlzLmdldFNldHRpbmdzKCdwYXVzZU9uSG92ZXInKSkge1xuICAgICAgICAgICAgdGhpcy5lbGVtZW50cy5jYXJvdXNlbC5hZGRFdmVudExpc3RlbmVyKCdtb3VzZWVudGVyJywgdGhpcy5wYXVzZVN3aXBlci5iaW5kKHRoaXMpKTtcbiAgICAgICAgICAgIHRoaXMuZWxlbWVudHMuY2Fyb3VzZWwuYWRkRXZlbnRMaXN0ZW5lcignbW91c2VsZWF2ZScsIHRoaXMucmVzdW1lU3dpcGVyLmJpbmQodGhpcykpO1xuICAgICAgICB9XG4gICAgfVxuXG4gICAgcGF1c2VTd2lwZXIoZXZlbnQpIHtcbiAgICAgICAgdGhpcy5nZXRTZXR0aW5ncygnc3dpcGVySW5zdGFuY2UnKS5hdXRvcGxheS5zdG9wKCk7XG4gICAgfVxuXG4gICAgcmVzdW1lU3dpcGVyKGV2ZW50KSB7XG4gICAgICAgIHRoaXMuZ2V0U2V0dGluZ3MoJ3N3aXBlckluc3RhbmNlJykuYXV0b3BsYXkuc3RhcnQoKTtcbiAgICB9XG59XG5cbmV4cG9ydCBkZWZhdWx0IFpldXNfQ2Fyb3VzZWw7XG4iLCJpbXBvcnQgeyByZWdpc3RlcldpZGdldCB9IGZyb20gXCIuLi9saWIvdXRpbHNcIjtcbmltcG9ydCBaZXVzX0Nhcm91c2VsIGZyb20gXCIuL2Jhc2UvY2Fyb3VzZWxcIjtcblxuY2xhc3MgWmV1c19CbG9nQ2Fyb3VzZWwgZXh0ZW5kcyBaZXVzX0Nhcm91c2VsIHt9XG5cbnJlZ2lzdGVyV2lkZ2V0KFpldXNfQmxvZ0Nhcm91c2VsLCBcInpldXMtYmxvZy1jYXJvdXNlbFwiKTtcbiJdfQ==
