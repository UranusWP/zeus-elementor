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
exports.fadeToggle = exports.fadeOut = exports.fadeIn = void 0;

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

var Zeus_SearchIcon = /*#__PURE__*/function (_elementorModules$fro) {
  _inherits(Zeus_SearchIcon, _elementorModules$fro);

  var _super = _createSuper(Zeus_SearchIcon);

  function Zeus_SearchIcon() {
    _classCallCheck(this, Zeus_SearchIcon);

    return _super.apply(this, arguments);
  }

  _createClass(Zeus_SearchIcon, [{
    key: "getDefaultSettings",
    value: function getDefaultSettings() {
      return {
        selectors: {
          dropdownSearch: ".zeus-search-dropdown",
          dropdownSearchIcon: ".zeus-search-icon-dropdown",
          dropdownSearchIconLink: ".zeus-dropdown-link",
          dropdownSearchInput: ".zeus-search-dropdown input.field",
          overlaySearch: ".zeus-search-overlay",
          overlaySearchForm: ".zeus-search-overlay form",
          overlaySearchIcon: ".zeus-search-icon-overlay",
          overlaySearchIconLink: "a.zeus-overlay-link",
          overlaySearchInput: "input.zeus-search-overlay-input",
          overlaySearchCloseBtn: "a.zeus-search-overlay-close"
        }
      };
    }
  }, {
    key: "getDefaultElements",
    value: function getDefaultElements() {
      var element = this.$element.get(0);
      var selectors = this.getSettings("selectors");
      return {
        dropdownSearch: element.querySelector(selectors.dropdownSearch),
        dropdownSearchIcon: element.querySelector(selectors.dropdownSearchIcon),
        dropdownSearchIconLink: element.querySelector(selectors.dropdownSearchIconLink),
        dropdownSearchInput: element.querySelector(selectors.dropdownSearchInput),
        overlaySearch: element.querySelector(selectors.overlaySearch),
        overlaySearchForm: element.querySelector(selectors.overlaySearchForm),
        overlaySearchIcon: element.querySelector(selectors.overlaySearchIcon),
        overlaySearchIconLink: element.querySelector(selectors.overlaySearchIconLink),
        overlaySearchInput: element.querySelector(selectors.overlaySearchInput),
        overlaySearchCloseBtn: element.querySelector(selectors.overlaySearchCloseBtn)
      };
    }
  }, {
    key: "onInit",
    value: function onInit() {
      var _get2;

      for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
        args[_key] = arguments[_key];
      }

      (_get2 = _get(_getPrototypeOf(Zeus_SearchIcon.prototype), "onInit", this)).call.apply(_get2, [this].concat(args));

      if (this.getSearchType() === "overlay") {
        this.initOverlaySearch();
      }

      this.setupEventListeners();
    }
  }, {
    key: "initOverlaySearch",
    value: function initOverlaySearch() {
      var _this = this;

      document.querySelectorAll("#zeus-search-".concat(this.getID())).forEach(function (overlaySearch) {
        if (_this.elements.overlaySearch !== overlaySearch) {
          overlaySearch.remove();
        }
      });
      document.body.insertAdjacentElement("beforeend", this.elements.overlaySearch);

      if (this.elements.overlaySearchInput.value.length) {
        this.elements.overlaySearchForm.classList.add("search-filled");
      }
    }
  }, {
    key: "setupEventListeners",
    value: function setupEventListeners() {
      if (this.getSearchType() === "overlay") {
        this.elements.overlaySearchIconLink.addEventListener("click", this.openOverlaySearch.bind(this));
        this.elements.overlaySearchCloseBtn.addEventListener("click", this.closeOverlaySearch.bind(this));
        this.elements.overlaySearchInput.addEventListener("keyup", this.toggleInputPlaceholder.bind(this));
        this.elements.overlaySearchInput.addEventListener("blur", this.toggleInputPlaceholder.bind(this));
      } else {
        this.elements.dropdownSearchIconLink.addEventListener("click", this.toggleDropdownSearch.bind(this));
        document.addEventListener("click", this.onDocumentClick.bind(this));
      }
    }
  }, {
    key: "toggleDropdownSearch",
    value: function toggleDropdownSearch(event) {
      event.preventDefault();
      event.stopPropagation();
      fadeToggle(this.elements.dropdownSearch, "fast");
      this.elements.dropdownSearchIcon.classList.toggle("active");
      this.elements.dropdownSearchInput.focus();
    }
  }, {
    key: "openOverlaySearch",
    value: function openOverlaySearch(event) {
      event.preventDefault();
      this.elements.overlaySearch.classList.add("active");
      fadeIn(this.elements.overlaySearch, "fast");
      this.elements.overlaySearchInput.focus();
      setTimeout(function () {
        document.querySelector("html").style.overflow = "hidden";
      }, 400);
    }
  }, {
    key: "closeOverlaySearch",
    value: function closeOverlaySearch(event) {
      event.preventDefault();
      this.elements.overlaySearch.classList.remove("active");
      fadeOut(this.elements.overlaySearch, "fast");
      setTimeout(function () {
        document.querySelector("html").style.overflow = "visible";
      }, 400);
    }
  }, {
    key: "toggleInputPlaceholder",
    value: function toggleInputPlaceholder(event) {
      if (this.elements.overlaySearchInput.value.length > 0) {
        this.elements.overlaySearchForm.classList.add("search-filled");
      } else {
        this.elements.overlaySearchForm.classList.remove("search-filled");
      }
    }
  }, {
    key: "onDocumentClick",
    value: function onDocumentClick(event) {
      // Close Dropdown Search
      if (!event.target.closest(this.getSettings("selectors.dropdownSearch"))) {
        this.elements.dropdownSearchIcon.classList.remove("show");
        fadeOut(this.elements.dropdownSearch, "fast");
      }
    }
  }, {
    key: "getSearchType",
    value: function getSearchType() {
      return !!this.elements.overlaySearchIcon ? "overlay" : "dropdown";
    }
  }]);

  return Zeus_SearchIcon;
}(elementorModules.frontend.handlers.Base);

(0, _utils.registerWidget)(Zeus_SearchIcon, "zeus-search-icon");

},{"../lib/utils":1}]},{},[2])
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm5vZGVfbW9kdWxlcy9icm93c2VyLXBhY2svX3ByZWx1ZGUuanMiLCJzcmMvbGliL3V0aWxzLmpzIiwic3JjL3dpZGdldHMvc2VhcmNoLWljb24uanMiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBQUE7Ozs7Ozs7O0FDQU8sSUFBTSxjQUFjLEdBQUcsU0FBakIsY0FBaUIsQ0FBQyxTQUFELEVBQVksVUFBWixFQUE2QztBQUFBLE1BQXJCLElBQXFCLHVFQUFkLFNBQWM7O0FBQ3ZFLE1BQUksRUFBRSxTQUFTLElBQUksVUFBZixDQUFKLEVBQWdDO0FBQzVCO0FBQ0g7QUFFRDtBQUNKO0FBQ0E7QUFDQTs7O0FBQ0ksRUFBQSxNQUFNLENBQUMsTUFBRCxDQUFOLENBQWUsRUFBZixDQUFrQix5QkFBbEIsRUFBNkMsWUFBTTtBQUMvQyxRQUFNLFVBQVUsR0FBRyxTQUFiLFVBQWEsQ0FBQyxRQUFELEVBQWM7QUFDN0IsTUFBQSxpQkFBaUIsQ0FBQyxlQUFsQixDQUFrQyxVQUFsQyxDQUE2QyxTQUE3QyxFQUF3RDtBQUNwRCxRQUFBLFFBQVEsRUFBUjtBQURvRCxPQUF4RDtBQUdILEtBSkQ7O0FBTUEsSUFBQSxpQkFBaUIsQ0FBQyxLQUFsQixDQUF3QixTQUF4QixrQ0FBNEQsVUFBNUQsY0FBMEUsSUFBMUUsR0FBa0YsVUFBbEY7QUFDSCxHQVJEO0FBU0gsQ0FsQk07Ozs7Ozs7Ozs7Ozs7O0FDQVA7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7O0FBRU8sSUFBTSxNQUFNLEdBQUcsU0FBVCxNQUFTLENBQUMsT0FBRCxFQUF5RDtBQUFBLE1BQS9DLEtBQStDLHVFQUF2QyxRQUF1QztBQUFBLE1BQTdCLE9BQTZCO0FBQUEsTUFBcEIsUUFBb0IsdUVBQVQsSUFBUztBQUMzRSxFQUFBLE9BQU8sQ0FBQyxLQUFSLENBQWMsT0FBZCxHQUF3QixDQUF4QjtBQUNBLEVBQUEsT0FBTyxDQUFDLEtBQVIsQ0FBYyxPQUFkLEdBQXdCLE9BQU8sSUFBSSxPQUFuQzs7QUFFQSxNQUFN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QUFQO0FBRUEsTUFBQSxVQUFVLENBQUMsWUFBTTtBQUNiLFFBQUEsUUFBUSxDQUFDLGFBQVQsQ0FBdUIsTUFBdkIsRUFBK0IsS0FBL0IsQ0FBcUMsUUFBckMsR0FBZ0QsU0FBaEQ7QUFDSCxPQUZTLEVBRVAsR0FGTyxDQUFWO0FBR0g7OztXQUVELGdDQUF1QixLQUF2QixFQUE4QjtBQUMxQixVQUFJLEtBQUssUUFBTCxDQUFjLGtCQUFkLENBQWlDLEtBQWpDLENBQXVDLE1BQXZDLEdBQWdELENBQXBELEVBQXVEO0FBQ25ELGFBQUssUUFBTCxDQUFjLGlCQUFkLENBQWdDLFNBQWhDLENBQTBDLEdBQTFDLENBQThDLGVBQTlDO0FBQ0gsT0FGRCxNQUVPO0FBQ0gsYUFBSyxRQUFMLENBQWMsaUJBQWQsQ0FBZ0MsU0FBaEMsQ0FBMEMsTUFBMUMsQ0FBaUQsZUFBakQ7QUFDSDtBQUNKOzs7V0FFRCx5QkFBZ0IsS0FBaEIsRUFBdUI7QUFDbkI7QUFDQSxVQUFJLENBQUMsS0FBSyxDQUFDLE1BQU4sQ0FBYSxPQUFiLENBQXFCLEtBQUssV0FBTCxDQUFpQiwwQkFBakIsQ0FBckIsQ0FBTCxFQUF5RTtBQUNyRSxhQUFLLFFBQUwsQ0FBYyxrQkFBZCxDQUFpQyxTQUFqQyxDQUEyQyxNQUEzQyxDQUFrRCxNQUFsRDtBQUNBLFFBQUEsT0FBTyxDQUFDLEtBQUssUUFBTCxDQUFjLGNBQWYsRUFBK0IsTUFBL0IsQ0FBUDtBQUNIO0FBQ0o7OztXQUVELHlCQUFnQjtBQUNaLGFBQU8sQ0FBQyxDQUFDLEtBQUssUUFBTCxDQUFjLGlCQUFoQixHQUFvQyxTQUFwQyxHQUFnRCxVQUF2RDtBQUNIOzs7O0VBMUh5QixnQkFBZ0IsQ0FBQyxRQUFqQixDQUEwQixRQUExQixDQUFtQyxJOztBQTZIakUsMkJBQWUsZUFBZixFQUFnQyxrQkFBaEMiLCJmaWxlIjoiZ2VuZXJhdGVkLmpzIiwic291cmNlUm9vdCI6IiIsInNvdXJjZXNDb250ZW50IjpbIihmdW5jdGlvbigpe2Z1bmN0aW9uIHIoZSxuLHQpe2Z1bmN0aW9uIG8oaSxmKXtpZighbltpXSl7aWYoIWVbaV0pe3ZhciBjPVwiZnVuY3Rpb25cIj09dHlwZW9mIHJlcXVpcmUmJnJlcXVpcmU7aWYoIWYmJmMpcmV0dXJuIGMoaSwhMCk7aWYodSlyZXR1cm4gdShpLCEwKTt2YXIgYT1uZXcgRXJyb3IoXCJDYW5ub3QgZmluZCBtb2R1bGUgJ1wiK2krXCInXCIpO3Rocm93IGEuY29kZT1cIk1PRFVMRV9OT1RfRk9VTkRcIixhfXZhciBwPW5baV09e2V4cG9ydHM6e319O2VbaV1bMF0uY2FsbChwLmV4cG9ydHMsZnVuY3Rpb24ocil7dmFyIG49ZVtpXVsxXVtyXTtyZXR1cm4gbyhufHxyKX0scCxwLmV4cG9ydHMscixlLG4sdCl9cmV0dXJuIG5baV0uZXhwb3J0c31mb3IodmFyIHU9XCJmdW5jdGlvblwiPT10eXBlb2YgcmVxdWlyZSYmcmVxdWlyZSxpPTA7aTx0Lmxlbmd0aDtpKyspbyh0W2ldKTtyZXR1cm4gb31yZXR1cm4gcn0pKCkiLCJleHBvcnQgY29uc3QgcmVnaXN0ZXJXaWRnZXQgPSAoY2xhc3NOYW1lLCB3aWRnZXROYW1lLCBza2luID0gJ2RlZmF1bHQnKSA9PiB7XG4gICAgaWYgKCEoY2xhc3NOYW1lIHx8IHdpZGdldE5hbWUpKSB7XG4gICAgICAgIHJldHVybjtcbiAgICB9XG5cbiAgICAvKipcbiAgICAgKiBCZWNhdXNlIEVsZW1lbnRvciBwbHVnaW4gdXNlcyBqUXVlcnkgY3VzdG9tIGV2ZW50LFxuICAgICAqIFdlIGFsc28gaGF2ZSB0byB1c2UgalF1ZXJ5IHRvIHVzZSB0aGlzIGV2ZW50XG4gICAgICovXG4gICAgalF1ZXJ5KHdpbmRvdykub24oJ2VsZW1lbnRvci9mcm9udGVuZC9pbml0JywgKCkgPT4ge1xuICAgICAgICBjb25zdCBhZGRIYW5kbGVyID0gKCRlbGVtZW50KSA9PiB7XG4gICAgICAgICAgICBlbGVtZW50b3JGcm9udGVuZC5lbGVtZW50c0hhbmRsZXIuYWRkSGFuZGxlcihjbGFzc05hbWUsIHtcbiAgICAgICAgICAgICAgICAkZWxlbWVudCxcbiAgICAgICAgICAgIH0pO1xuICAgICAgICB9O1xuXG4gICAgICAgIGVsZW1lbnRvckZyb250ZW5kLmhvb2tzLmFkZEFjdGlvbihgZnJvbnRlbmQvZWxlbWVudF9yZWFkeS8ke3dpZGdldE5hbWV9LiR7c2tpbn1gLCBhZGRIYW5kbGVyKTtcbiAgICB9KTtcbn07XG4iLCJpbXBvcnQgeyByZWdpc3RlcldpZGdldCB9IGZyb20gXCIuLi9saWIvdXRpbHNcIjtcblxuZXhwb3J0IGNvbnN0IGZhZGVJbiA9IChlbGVtZW50LCBzcGVlZCA9IFwibm9ybWFsXCIsIGRpc3BsYXksIGNhbGxiYWNrID0gbnVsbCkgPT4ge1xuICAgIGVsZW1lbnQuc3R5bGUub3BhY2l0eSA9IDA7XG4gICAgZWxlbWVudC5zdHlsZS5kaXNwbGF5ID0gZGlzcGxheSB8fCBcImJsb2NrXCI7XG5cbiAgICBjb25zdCBmYWRlID0gKCkgPT4ge1xuICAgICAgICBsZXQgb3BhY2l0eSA9IHBhcnNlRmxvYXQoZWxlbWVudC5zdHlsZS5vcGFjaXR5KTtcblxuICAgICAgICBpZiAoKG9wYWNpdHkgKz0gc3BlZWQgPT09IFwiZmFzdFwiID8gMC4yIDogMC4xKSA8PSAxKSB7XG4gICAgICAgICAgICBlbGVtZW50LnN0eWxlLm9wYWNpdHkgPSBvcGFjaXR5O1xuXG4gICAgICAgICAgICBpZiAob3BhY2l0eSA9PT0gMSAmJiBjYWxsYmFjaykge1xuICAgICAgICAgICAgICAgIGNhbGxiYWNrKCk7XG4gICAgICAgICAgICB9XG5cbiAgICAgICAgICAgIHdpbmRvdy5yZXF1ZXN0QW5pbWF0aW9uRnJhbWUoZmFkZSk7XG4gICAgICAgIH1cbiAgICB9O1xuXG4gICAgd2luZG93LnJlcXVlc3RBbmltYXRpb25GcmFtZShmYWRlKTtcbn07XG5cbmV4cG9ydCBjb25zdCBmYWRlT3V0ID0gKGVsZW1lbnQsIHNwZWVkID0gXCJub3JtYWxcIiwgZGlzcGxheSwgY2FsbGJhY2sgPSBudWxsKSA9PiB7XG4gICAgZWxlbWVudC5zdHlsZS5vcGFjaXR5ID0gMTtcbiAgICBlbGVtZW50LnN0eWxlLmRpc3BsYXkgPSBkaXNwbGF5IHx8IFwiYmxvY2tcIjtcblxuICAgIGNvbnN0IGZhZGUgPSAoKSA9PiB7XG4gICAgICAgIGxldCBvcGFjaXR5ID0gcGFyc2VGbG9hdChlbGVtZW50LnN0eWxlLm9wYWNpdHkpO1xuXG4gICAgICAgIGlmICgob3BhY2l0eSAtPSBzcGVlZCA9PT0gXCJmYXN0XCIgPyAwLjIgOiAwLjEpIDwgMCkge1xuICAgICAgICAgICAgZWxlbWVudC5zdHlsZS5kaXNwbGF5ID0gXCJub25lXCI7XG4gICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICBlbGVtZW50LnN0eWxlLm9wYWNpdHkgPSBvcGFjaXR5O1xuXG4gICAgICAgICAgICBpZiAob3BhY2l0eSA9PT0gMCAmJiBjYWxsYmFjaykge1xuICAgICAgICAgICAgICAgIGNhbGxiYWNrKCk7XG4gICAgICAgICAgICB9XG5cbiAgICAgICAgICAgIHdpbmRvdy5yZXF1ZXN0QW5pbWF0aW9uRnJhbWUoZmFkZSk7XG4gICAgICAgIH1cbiAgICB9O1xuXG4gICAgd2luZG93LnJlcXVlc3RBbmltYXRpb25GcmFtZShmYWRlKTtcbn07XG5cbmV4cG9ydCBjb25zdCBmYWRlVG9nZ2xlID0gKGVsZW1lbnQsIHNwZWVkID0gXCJub3JtYWxcIiwgZGlzcGxheSwgY2FsbGJhY2sgPSBudWxsKSA9PlxuICAgIHdpbmRvdy5nZXRDb21wdXRlZFN0eWxlKGVsZW1lbnQpLmRpc3BsYXkgPT09IFwibm9uZVwiXG4gICAgICAgID8gZmFkZUluKGVsZW1lbnQsIHNwZWVkLCBkaXNwbGF5LCBjYWxsYmFjaylcbiAgICAgICAgOiBmYWRlT3V0KGVsZW1lbnQsIHNwZWVkLCBkaXNwbGF5LCBjYWxsYmFjayk7XG5cbmNsYXNzIFpldXNfU2VhcmNoSWNvbiBleHRlbmRzIGVsZW1lbnRvck1vZHVsZXMuZnJvbnRlbmQuaGFuZGxlcnMuQmFzZSB7XG4gICAgZ2V0RGVmYXVsdFNldHRpbmdzKCkge1xuICAgICAgICByZXR1cm4ge1xuICAgICAgICAgICAgc2VsZWN0b3JzOiB7XG4gICAgICAgICAgICAgICAgZHJvcGRvd25TZWFyY2g6IFwiLnpldXMtc2VhcmNoLWRyb3Bkb3duXCIsXG4gICAgICAgICAgICAgICAgZHJvcGRvd25TZWFyY2hJY29uOiBcIi56ZXVzLXNlYXJjaC1pY29uLWRyb3Bkb3duXCIsXG4gICAgICAgICAgICAgICAgZHJvcGRvd25TZWFyY2hJY29uTGluazogXCIuemV1cy1kcm9wZG93bi1saW5rXCIsXG4gICAgICAgICAgICAgICAgZHJvcGRvd25TZWFyY2hJbnB1dDogXCIuemV1cy1zZWFyY2gtZHJvcGRvd24gaW5wdXQuZmllbGRcIixcbiAgICAgICAgICAgICAgICBvdmVybGF5U2VhcmNoOiBcIi56ZXVzLXNlYXJjaC1vdmVybGF5XCIsXG4gICAgICAgICAgICAgICAgb3ZlcmxheVNlYXJjaEZvcm06IFwiLnpldXMtc2VhcmNoLW92ZXJsYXkgZm9ybVwiLFxuICAgICAgICAgICAgICAgIG92ZXJsYXlTZWFyY2hJY29uOiBcIi56ZXVzLXNlYXJjaC1pY29uLW92ZXJsYXlcIixcbiAgICAgICAgICAgICAgICBvdmVybGF5U2VhcmNoSWNvbkxpbms6IFwiYS56ZXVzLW92ZXJsYXktbGlua1wiLFxuICAgICAgICAgICAgICAgIG92ZXJsYXlTZWFyY2hJbnB1dDogXCJpbnB1dC56ZXVzLXNlYXJjaC1vdmVybGF5LWlucHV0XCIsXG4gICAgICAgICAgICAgICAgb3ZlcmxheVNlYXJjaENsb3NlQnRuOiBcImEuemV1cy1zZWFyY2gtb3ZlcmxheS1jbG9zZVwiLFxuICAgICAgICAgICAgfSxcbiAgICAgICAgfTtcbiAgICB9XG5cbiAgICBnZXREZWZhdWx0RWxlbWVudHMoKSB7XG4gICAgICAgIGNvbnN0IGVsZW1lbnQgPSB0aGlzLiRlbGVtZW50LmdldCgwKTtcbiAgICAgICAgY29uc3Qgc2VsZWN0b3JzID0gdGhpcy5nZXRTZXR0aW5ncyhcInNlbGVjdG9yc1wiKTtcblxuICAgICAgICByZXR1cm4ge1xuICAgICAgICAgICAgZHJvcGRvd25TZWFyY2g6IGVsZW1lbnQucXVlcnlTZWxlY3RvcihzZWxlY3RvcnMuZHJvcGRvd25TZWFyY2gpLFxuICAgICAgICAgICAgZHJvcGRvd25TZWFyY2hJY29uOiBlbGVtZW50LnF1ZXJ5U2VsZWN0b3Ioc2VsZWN0b3JzLmRyb3Bkb3duU2VhcmNoSWNvbiksXG4gICAgICAgICAgICBkcm9wZG93blNlYXJjaEljb25MaW5rOiBlbGVtZW50LnF1ZXJ5U2VsZWN0b3Ioc2VsZWN0b3JzLmRyb3Bkb3duU2VhcmNoSWNvbkxpbmspLFxuICAgICAgICAgICAgZHJvcGRvd25TZWFyY2hJbnB1dDogZWxlbWVudC5xdWVyeVNlbGVjdG9yKHNlbGVjdG9ycy5kcm9wZG93blNlYXJjaElucHV0KSxcbiAgICAgICAgICAgIG92ZXJsYXlTZWFyY2g6IGVsZW1lbnQucXVlcnlTZWxlY3RvcihzZWxlY3RvcnMub3ZlcmxheVNlYXJjaCksXG4gICAgICAgICAgICBvdmVybGF5U2VhcmNoRm9ybTogZWxlbWVudC5xdWVyeVNlbGVjdG9yKHNlbGVjdG9ycy5vdmVybGF5U2VhcmNoRm9ybSksXG4gICAgICAgICAgICBvdmVybGF5U2VhcmNoSWNvbjogZWxlbWVudC5xdWVyeVNlbGVjdG9yKHNlbGVjdG9ycy5vdmVybGF5U2VhcmNoSWNvbiksXG4gICAgICAgICAgICBvdmVybGF5U2VhcmNoSWNvbkxpbms6IGVsZW1lbnQucXVlcnlTZWxlY3RvcihzZWxlY3RvcnMub3ZlcmxheVNlYXJjaEljb25MaW5rKSxcbiAgICAgICAgICAgIG92ZXJsYXlTZWFyY2hJbnB1dDogZWxlbWVudC5xdWVyeVNlbGVjdG9yKHNlbGVjdG9ycy5vdmVybGF5U2VhcmNoSW5wdXQpLFxuICAgICAgICAgICAgb3ZlcmxheVNlYXJjaENsb3NlQnRuOiBlbGVtZW50LnF1ZXJ5U2VsZWN0b3Ioc2VsZWN0b3JzLm92ZXJsYXlTZWFyY2hDbG9zZUJ0biksXG4gICAgICAgIH07XG4gICAgfVxuXG4gICAgb25Jbml0KC4uLmFyZ3MpIHtcbiAgICAgICAgc3VwZXIub25Jbml0KC4uLmFyZ3MpO1xuXG4gICAgICAgIGlmICh0aGlzLmdldFNlYXJjaFR5cGUoKSA9PT0gXCJvdmVybGF5XCIpIHtcbiAgICAgICAgICAgIHRoaXMuaW5pdE92ZXJsYXlTZWFyY2goKTtcbiAgICAgICAgfVxuXG4gICAgICAgIHRoaXMuc2V0dXBFdmVudExpc3RlbmVycygpO1xuICAgIH1cblxuICAgIGluaXRPdmVybGF5U2VhcmNoKCkge1xuICAgICAgICBkb2N1bWVudC5xdWVyeVNlbGVjdG9yQWxsKGAjemV1cy1zZWFyY2gtJHt0aGlzLmdldElEKCl9YCkuZm9yRWFjaCgob3ZlcmxheVNlYXJjaCkgPT4ge1xuICAgICAgICAgICAgaWYgKHRoaXMuZWxlbWVudHMub3ZlcmxheVNlYXJjaCAhPT0gb3ZlcmxheVNlYXJjaCkge1xuICAgICAgICAgICAgICAgIG92ZXJsYXlTZWFyY2gucmVtb3ZlKCk7XG4gICAgICAgICAgICB9XG4gICAgICAgIH0pO1xuXG4gICAgICAgIGRvY3VtZW50LmJvZHkuaW5zZXJ0QWRqYWNlbnRFbGVtZW50KFwiYmVmb3JlZW5kXCIsIHRoaXMuZWxlbWVudHMub3ZlcmxheVNlYXJjaCk7XG5cbiAgICAgICAgaWYgKHRoaXMuZWxlbWVudHMub3ZlcmxheVNlYXJjaElucHV0LnZhbHVlLmxlbmd0aCkge1xuICAgICAgICAgICAgdGhpcy5lbGVtZW50cy5vdmVybGF5U2VhcmNoRm9ybS5jbGFzc0xpc3QuYWRkKFwic2VhcmNoLWZpbGxlZFwiKTtcbiAgICAgICAgfVxuICAgIH1cblxuICAgIHNldHVwRXZlbnRMaXN0ZW5lcnMoKSB7XG4gICAgICAgIGlmICh0aGlzLmdldFNlYXJjaFR5cGUoKSA9PT0gXCJvdmVybGF5XCIpIHtcbiAgICAgICAgICAgIHRoaXMuZWxlbWVudHMub3ZlcmxheVNlYXJjaEljb25MaW5rLmFkZEV2ZW50TGlzdGVuZXIoXCJjbGlja1wiLCB0aGlzLm9wZW5PdmVybGF5U2VhcmNoLmJpbmQodGhpcykpO1xuICAgICAgICAgICAgdGhpcy5lbGVtZW50cy5vdmVybGF5U2VhcmNoQ2xvc2VCdG4uYWRkRXZlbnRMaXN0ZW5lcihcImNsaWNrXCIsIHRoaXMuY2xvc2VPdmVybGF5U2VhcmNoLmJpbmQodGhpcykpO1xuICAgICAgICAgICAgdGhpcy5lbGVtZW50cy5vdmVybGF5U2VhcmNoSW5wdXQuYWRkRXZlbnRMaXN0ZW5lcihcImtleXVwXCIsIHRoaXMudG9nZ2xlSW5wdXRQbGFjZWhvbGRlci5iaW5kKHRoaXMpKTtcbiAgICAgICAgICAgIHRoaXMuZWxlbWVudHMub3ZlcmxheVNlYXJjaElucHV0LmFkZEV2ZW50TGlzdGVuZXIoXCJibHVyXCIsIHRoaXMudG9nZ2xlSW5wdXRQbGFjZWhvbGRlci5iaW5kKHRoaXMpKTtcbiAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgIHRoaXMuZWxlbWVudHMuZHJvcGRvd25TZWFyY2hJY29uTGluay5hZGRFdmVudExpc3RlbmVyKFwiY2xpY2tcIiwgdGhpcy50b2dnbGVEcm9wZG93blNlYXJjaC5iaW5kKHRoaXMpKTtcbiAgICAgICAgICAgIGRvY3VtZW50LmFkZEV2ZW50TGlzdGVuZXIoXCJjbGlja1wiLCB0aGlzLm9uRG9jdW1lbnRDbGljay5iaW5kKHRoaXMpKTtcbiAgICAgICAgfVxuICAgIH1cblxuICAgIHRvZ2dsZURyb3Bkb3duU2VhcmNoKGV2ZW50KSB7XG4gICAgICAgIGV2ZW50LnByZXZlbnREZWZhdWx0KCk7XG4gICAgICAgIGV2ZW50LnN0b3BQcm9wYWdhdGlvbigpO1xuXG4gICAgICAgIGZhZGVUb2dnbGUodGhpcy5lbGVtZW50cy5kcm9wZG93blNlYXJjaCwgXCJmYXN0XCIpO1xuICAgICAgICB0aGlzLmVsZW1lbnRzLmRyb3Bkb3duU2VhcmNoSWNvbi5jbGFzc0xpc3QudG9nZ2xlKFwiYWN0aXZlXCIpO1xuICAgICAgICB0aGlzLmVsZW1lbnRzLmRyb3Bkb3duU2VhcmNoSW5wdXQuZm9jdXMoKTtcbiAgICB9XG5cbiAgICBvcGVuT3ZlcmxheVNlYXJjaChldmVudCkge1xuICAgICAgICBldmVudC5wcmV2ZW50RGVmYXVsdCgpO1xuXG4gICAgICAgIHRoaXMuZWxlbWVudHMub3ZlcmxheVNlYXJjaC5jbGFzc0xpc3QuYWRkKFwiYWN0aXZlXCIpO1xuICAgICAgICBmYWRlSW4odGhpcy5lbGVtZW50cy5vdmVybGF5U2VhcmNoLCBcImZhc3RcIik7XG4gICAgICAgIHRoaXMuZWxlbWVudHMub3ZlcmxheVNlYXJjaElucHV0LmZvY3VzKCk7XG5cbiAgICAgICAgc2V0VGltZW91dCgoKSA9PiB7XG4gICAgICAgICAgICBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKFwiaHRtbFwiKS5zdHlsZS5vdmVyZmxvdyA9IFwiaGlkZGVuXCI7XG4gICAgICAgIH0sIDQwMCk7XG4gICAgfVxuXG4gICAgY2xvc2VPdmVybGF5U2VhcmNoKGV2ZW50KSB7XG4gICAgICAgIGV2ZW50LnByZXZlbnREZWZhdWx0KCk7XG5cbiAgICAgICAgdGhpcy5lbGVtZW50cy5vdmVybGF5U2VhcmNoLmNsYXNzTGlzdC5yZW1vdmUoXCJhY3RpdmVcIik7XG4gICAgICAgIGZhZGVPdXQodGhpcy5lbGVtZW50cy5vdmVybGF5U2VhcmNoLCBcImZhc3RcIik7XG5cbiAgICAgICAgc2V0VGltZW91dCgoKSA9PiB7XG4gICAgICAgICAgICBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKFwiaHRtbFwiKS5zdHlsZS5vdmVyZmxvdyA9IFwidmlzaWJsZVwiO1xuICAgICAgICB9LCA0MDApO1xuICAgIH1cblxuICAgIHRvZ2dsZUlucHV0UGxhY2Vob2xkZXIoZXZlbnQpIHtcbiAgICAgICAgaWYgKHRoaXMuZWxlbWVudHMub3ZlcmxheVNlYXJjaElucHV0LnZhbHVlLmxlbmd0aCA+IDApIHtcbiAgICAgICAgICAgIHRoaXMuZWxlbWVudHMub3ZlcmxheVNlYXJjaEZvcm0uY2xhc3NMaXN0LmFkZChcInNlYXJjaC1maWxsZWRcIik7XG4gICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICB0aGlzLmVsZW1lbnRzLm92ZXJsYXlTZWFyY2hGb3JtLmNsYXNzTGlzdC5yZW1vdmUoXCJzZWFyY2gtZmlsbGVkXCIpO1xuICAgICAgICB9XG4gICAgfVxuXG4gICAgb25Eb2N1bWVudENsaWNrKGV2ZW50KSB7XG4gICAgICAgIC8vIENsb3NlIERyb3Bkb3duIFNlYXJjaFxuICAgICAgICBpZiAoIWV2ZW50LnRhcmdldC5jbG9zZXN0KHRoaXMuZ2V0U2V0dGluZ3MoXCJzZWxlY3RvcnMuZHJvcGRvd25TZWFyY2hcIikpKSB7XG4gICAgICAgICAgICB0aGlzLmVsZW1lbnRzLmRyb3Bkb3duU2VhcmNoSWNvbi5jbGFzc0xpc3QucmVtb3ZlKFwic2hvd1wiKTtcbiAgICAgICAgICAgIGZhZGVPdXQodGhpcy5lbGVtZW50cy5kcm9wZG93blNlYXJjaCwgXCJmYXN0XCIpO1xuICAgICAgICB9XG4gICAgfVxuXG4gICAgZ2V0U2VhcmNoVHlwZSgpIHtcbiAgICAgICAgcmV0dXJuICEhdGhpcy5lbGVtZW50cy5vdmVybGF5U2VhcmNoSWNvbiA/IFwib3ZlcmxheVwiIDogXCJkcm9wZG93blwiO1xuICAgIH1cbn1cblxucmVnaXN0ZXJXaWRnZXQoWmV1c19TZWFyY2hJY29uLCBcInpldXMtc2VhcmNoLWljb25cIik7XG4iXX0=
