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
exports.fadeOut = exports.fadeIn = void 0;

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

var Zeus_Modal = /*#__PURE__*/function (_elementorModules$fro) {
  _inherits(Zeus_Modal, _elementorModules$fro);

  var _super = _createSuper(Zeus_Modal);

  function Zeus_Modal() {
    _classCallCheck(this, Zeus_Modal);

    return _super.apply(this, arguments);
  }

  _createClass(Zeus_Modal, [{
    key: "getDefaultSettings",
    value: function getDefaultSettings() {
      return {
        selectors: {
          modal: ".zeus-modal-wrap",
          openModalButton: ".zeus-modal-button a",
          closeModalElements: ".zeus-modal-close, .zeus-modal-overlay"
        }
      };
    }
  }, {
    key: "getDefaultElements",
    value: function getDefaultElements() {
      var element = this.$element.get(0);
      var selectors = this.getSettings("selectors");
      return {
        modal: element.querySelector(selectors.modal),
        openModalButton: element.querySelector(selectors.openModalButton),
        closeModalElements: element.querySelectorAll(selectors.closeModalElements),
        body: document.body,
        html: document.querySelector("html")
      };
    }
  }, {
    key: "onInit",
    value: function onInit() {
      var _get2;

      for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
        args[_key] = arguments[_key];
      }

      (_get2 = _get(_getPrototypeOf(Zeus_Modal.prototype), "onInit", this)).call.apply(_get2, [this].concat(args));

      this.moveModalToEndOfBody();
      this.setupEventListeners();
    }
  }, {
    key: "moveModalToEndOfBody",
    value: function moveModalToEndOfBody() {
      var _this = this;

      document.querySelectorAll("#zeus-modal-".concat(this.getID())).forEach(function (modal) {
        if (_this.elements.modal !== modal) {
          modal.remove();
        }
      });
      document.body.insertAdjacentElement("beforeend", this.elements.modal);
    }
  }, {
    key: "setupEventListeners",
    value: function setupEventListeners() {
      var _this$elements$openMo,
          _this$elements$closeM,
          _this2 = this;

      (_this$elements$openMo = this.elements.openModalButton) === null || _this$elements$openMo === void 0 ? void 0 : _this$elements$openMo.addEventListener("click", this.openModal.bind(this));
      (_this$elements$closeM = this.elements.closeModalElements) === null || _this$elements$closeM === void 0 ? void 0 : _this$elements$closeM.forEach(function (closeModalElement) {
        closeModalElement.addEventListener("click", _this2.closeModal.bind(_this2));
      });
    }
  }, {
    key: "openModal",
    value: function openModal(event) {
      event.preventDefault();
      var openModalButton = event.currentTarget;
      var targetID = openModalButton.getAttribute("href");
      var modal = document.querySelector(targetID);
      var initialHTMLInnerWidth = this.elements.html.innerWidth;
      this.elements.html.style.overflow = "hidden";
      var afterInitialHTMLInnerWidth = this.elements.html.innerWidth;
      this.elements.html.style.marginRight = afterInitialHTMLInnerWidth - initialHTMLInnerWidth + "px";
      fadeIn(modal);
    }
  }, {
    key: "closeModal",
    value: function closeModal(event) {
      var closeModalElements = event.currentTarget;
      var modal = closeModalElements.closest(".zeus-modal-wrap");
      this.elements.html.style.overflow = "";
      this.elements.html.style.marginRight = "";
      fadeOut(modal);
    }
  }]);

  return Zeus_Modal;
}(elementorModules.frontend.handlers.Base);

(0, _utils.registerWidget)(Zeus_Modal, "zeus-modal");

},{"../lib/utils":1}]},{},[2])
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm5vZGVfbW9kdWxlcy9icm93c2VyLXBhY2svX3ByZWx1ZGUuanMiLCJzcmMvbGliL3V0aWxzLmpzIiwic3JjL3dpZGdldHMvbW9kYWwuanMiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBQUE7Ozs7Ozs7O0FDQU8sSUFBTSxjQUFjLEdBQUcsU0FBakIsY0FBaUIsQ0FBQyxTQUFELEVBQVksVUFBWixFQUE2QztBQUFBLE1BQXJCLElBQXFCLHVFQUFkLFNBQWM7O0FBQ3ZFLE1BQUksRUFBRSxTQUFTLElBQUksVUFBZixDQUFKLEVBQWdDO0FBQzVCO0FBQ0g7QUFFRDtBQUNKO0FBQ0E7QUFDQTs7O0FBQ0ksRUFBQSxNQUFNLENBQUMsTUFBRCxDQUFOLENBQWUsRUFBZixDQUFrQix5QkFBbEIsRUFBNkMsWUFBTTtBQUMvQyxRQUFNLFVBQVUsR0FBRyxTQUFiLFVBQWEsQ0FBQyxRQUFELEVBQWM7QUFDN0IsTUFBQSxpQkFBaUIsQ0FBQyxlQUFsQixDQUFrQyxVQUFsQyxDQUE2QyxTQUE3QyxFQUF3RDtBQUNwRCxRQUFBLFFBQVEsRUFBUjtBQURvRCxPQUF4RDtBQUdILEtBSkQ7O0FBTUEsSUFBQSxpQkFBaUIsQ0FBQyxLQUFsQixDQUF3QixTQUF4QixrQ0FBNEQsVUFBNUQsY0FBMEUsSUFBMUUsR0FBa0YsVUFBbEY7QUFDSCxHQVJEO0FBU0gsQ0FsQk07Ozs7Ozs7Ozs7Ozs7O0FDQVA7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7O0FBRU8sSUFBTSxNQUFNLEdBQUcsU0FBVCxNQUFTLENBQUMsT0FBRCxFQUF5RDtBQUFBLE1BQS9DLEtBQStDLHVFQUF2QyxRQUF1QztBQUFBLE1BQTdCLE9BQTZCO0FBQUEsTUFBcEIsUUFBb0IsdUVBQVQsSUFBUztBQUMzRSxFQUFBLE9BQU8sQ0FBQyxLQUFSLENBQWMsT0FBZCxHQUF3QixDQUF4QjtBQUNBLEVBQUEsT0FBTyxDQUFDLEtBQVIsQ0FBYyxPQUFkLEdBQXdCLE9BQU8sSUFBSSxPQUFuQzs7QUFFQSxNQUFNLElBQUks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QUNBLFdBQUssUUFBTCxDQUFjLElBQWQsQ0FBbUIsS0FBbkIsQ0FBeUIsV0FBekIsR0FBdUMsMEJBQTBCLEdBQUcscUJBQTdCLEdBQXFELElBQTVGO0FBRUEsTUFBQSxNQUFNLENBQUMsS0FBRCxDQUFOO0FBQ0g7OztXQUVELG9CQUFXLEtBQVgsRUFBa0I7QUFDZCxVQUFNLGtCQUFrQixHQUFHLEtBQUssQ0FBQyxhQUFqQztBQUNBLFVBQU0sS0FBSyxHQUFHLGtCQUFrQixDQUFDLE9BQW5CLENBQTJCLGtCQUEzQixDQUFkO0FBRUEsV0FBSyxRQUFMLENBQWMsSUFBZCxDQUFtQixLQUFuQixDQUF5QixRQUF6QixHQUFvQyxFQUFwQztBQUNBLFdBQUssUUFBTCxDQUFjLElBQWQsQ0FBbUIsS0FBbkIsQ0FBeUIsV0FBekIsR0FBdUMsRUFBdkM7QUFFQSxNQUFBLE9BQU8sQ0FBQyxLQUFELENBQVA7QUFDSDs7OztFQXZFb0IsZ0JBQWdCLENBQUMsUUFBakIsQ0FBMEIsUUFBMUIsQ0FBbUMsSTs7QUEwRTVELDJCQUFlLFVBQWYsRUFBMkIsWUFBM0IiLCJmaWxlIjoiZ2VuZXJhdGVkLmpzIiwic291cmNlUm9vdCI6IiIsInNvdXJjZXNDb250ZW50IjpbIihmdW5jdGlvbigpe2Z1bmN0aW9uIHIoZSxuLHQpe2Z1bmN0aW9uIG8oaSxmKXtpZighbltpXSl7aWYoIWVbaV0pe3ZhciBjPVwiZnVuY3Rpb25cIj09dHlwZW9mIHJlcXVpcmUmJnJlcXVpcmU7aWYoIWYmJmMpcmV0dXJuIGMoaSwhMCk7aWYodSlyZXR1cm4gdShpLCEwKTt2YXIgYT1uZXcgRXJyb3IoXCJDYW5ub3QgZmluZCBtb2R1bGUgJ1wiK2krXCInXCIpO3Rocm93IGEuY29kZT1cIk1PRFVMRV9OT1RfRk9VTkRcIixhfXZhciBwPW5baV09e2V4cG9ydHM6e319O2VbaV1bMF0uY2FsbChwLmV4cG9ydHMsZnVuY3Rpb24ocil7dmFyIG49ZVtpXVsxXVtyXTtyZXR1cm4gbyhufHxyKX0scCxwLmV4cG9ydHMscixlLG4sdCl9cmV0dXJuIG5baV0uZXhwb3J0c31mb3IodmFyIHU9XCJmdW5jdGlvblwiPT10eXBlb2YgcmVxdWlyZSYmcmVxdWlyZSxpPTA7aTx0Lmxlbmd0aDtpKyspbyh0W2ldKTtyZXR1cm4gb31yZXR1cm4gcn0pKCkiLCJleHBvcnQgY29uc3QgcmVnaXN0ZXJXaWRnZXQgPSAoY2xhc3NOYW1lLCB3aWRnZXROYW1lLCBza2luID0gJ2RlZmF1bHQnKSA9PiB7XG4gICAgaWYgKCEoY2xhc3NOYW1lIHx8IHdpZGdldE5hbWUpKSB7XG4gICAgICAgIHJldHVybjtcbiAgICB9XG5cbiAgICAvKipcbiAgICAgKiBCZWNhdXNlIEVsZW1lbnRvciBwbHVnaW4gdXNlcyBqUXVlcnkgY3VzdG9tIGV2ZW50LFxuICAgICAqIFdlIGFsc28gaGF2ZSB0byB1c2UgalF1ZXJ5IHRvIHVzZSB0aGlzIGV2ZW50XG4gICAgICovXG4gICAgalF1ZXJ5KHdpbmRvdykub24oJ2VsZW1lbnRvci9mcm9udGVuZC9pbml0JywgKCkgPT4ge1xuICAgICAgICBjb25zdCBhZGRIYW5kbGVyID0gKCRlbGVtZW50KSA9PiB7XG4gICAgICAgICAgICBlbGVtZW50b3JGcm9udGVuZC5lbGVtZW50c0hhbmRsZXIuYWRkSGFuZGxlcihjbGFzc05hbWUsIHtcbiAgICAgICAgICAgICAgICAkZWxlbWVudCxcbiAgICAgICAgICAgIH0pO1xuICAgICAgICB9O1xuXG4gICAgICAgIGVsZW1lbnRvckZyb250ZW5kLmhvb2tzLmFkZEFjdGlvbihgZnJvbnRlbmQvZWxlbWVudF9yZWFkeS8ke3dpZGdldE5hbWV9LiR7c2tpbn1gLCBhZGRIYW5kbGVyKTtcbiAgICB9KTtcbn07XG4iLCJpbXBvcnQgeyByZWdpc3RlcldpZGdldCB9IGZyb20gXCIuLi9saWIvdXRpbHNcIjtcblxuZXhwb3J0IGNvbnN0IGZhZGVJbiA9IChlbGVtZW50LCBzcGVlZCA9IFwibm9ybWFsXCIsIGRpc3BsYXksIGNhbGxiYWNrID0gbnVsbCkgPT4ge1xuICAgIGVsZW1lbnQuc3R5bGUub3BhY2l0eSA9IDA7XG4gICAgZWxlbWVudC5zdHlsZS5kaXNwbGF5ID0gZGlzcGxheSB8fCBcImJsb2NrXCI7XG5cbiAgICBjb25zdCBmYWRlID0gKCkgPT4ge1xuICAgICAgICBsZXQgb3BhY2l0eSA9IHBhcnNlRmxvYXQoZWxlbWVudC5zdHlsZS5vcGFjaXR5KTtcblxuICAgICAgICBpZiAoKG9wYWNpdHkgKz0gc3BlZWQgPT09IFwiZmFzdFwiID8gMC4yIDogMC4xKSA8PSAxKSB7XG4gICAgICAgICAgICBlbGVtZW50LnN0eWxlLm9wYWNpdHkgPSBvcGFjaXR5O1xuXG4gICAgICAgICAgICBpZiAob3BhY2l0eSA9PT0gMSAmJiBjYWxsYmFjaykge1xuICAgICAgICAgICAgICAgIGNhbGxiYWNrKCk7XG4gICAgICAgICAgICB9XG5cbiAgICAgICAgICAgIHdpbmRvdy5yZXF1ZXN0QW5pbWF0aW9uRnJhbWUoZmFkZSk7XG4gICAgICAgIH1cbiAgICB9O1xuXG4gICAgd2luZG93LnJlcXVlc3RBbmltYXRpb25GcmFtZShmYWRlKTtcbn07XG5cbmV4cG9ydCBjb25zdCBmYWRlT3V0ID0gKGVsZW1lbnQsIHNwZWVkID0gXCJub3JtYWxcIiwgZGlzcGxheSwgY2FsbGJhY2sgPSBudWxsKSA9PiB7XG4gICAgZWxlbWVudC5zdHlsZS5vcGFjaXR5ID0gMTtcbiAgICBlbGVtZW50LnN0eWxlLmRpc3BsYXkgPSBkaXNwbGF5IHx8IFwiYmxvY2tcIjtcblxuICAgIGNvbnN0IGZhZGUgPSAoKSA9PiB7XG4gICAgICAgIGxldCBvcGFjaXR5ID0gcGFyc2VGbG9hdChlbGVtZW50LnN0eWxlLm9wYWNpdHkpO1xuXG4gICAgICAgIGlmICgob3BhY2l0eSAtPSBzcGVlZCA9PT0gXCJmYXN0XCIgPyAwLjIgOiAwLjEpIDwgMCkge1xuICAgICAgICAgICAgZWxlbWVudC5zdHlsZS5kaXNwbGF5ID0gXCJub25lXCI7XG4gICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICBlbGVtZW50LnN0eWxlLm9wYWNpdHkgPSBvcGFjaXR5O1xuXG4gICAgICAgICAgICBpZiAob3BhY2l0eSA9PT0gMCAmJiBjYWxsYmFjaykge1xuICAgICAgICAgICAgICAgIGNhbGxiYWNrKCk7XG4gICAgICAgICAgICB9XG5cbiAgICAgICAgICAgIHdpbmRvdy5yZXF1ZXN0QW5pbWF0aW9uRnJhbWUoZmFkZSk7XG4gICAgICAgIH1cbiAgICB9O1xuXG4gICAgd2luZG93LnJlcXVlc3RBbmltYXRpb25GcmFtZShmYWRlKTtcbn07XG5cbmNsYXNzIFpldXNfTW9kYWwgZXh0ZW5kcyBlbGVtZW50b3JNb2R1bGVzLmZyb250ZW5kLmhhbmRsZXJzLkJhc2Uge1xuICAgIGdldERlZmF1bHRTZXR0aW5ncygpIHtcbiAgICAgICAgcmV0dXJuIHtcbiAgICAgICAgICAgIHNlbGVjdG9yczoge1xuICAgICAgICAgICAgICAgIG1vZGFsOiBcIi56ZXVzLW1vZGFsLXdyYXBcIixcbiAgICAgICAgICAgICAgICBvcGVuTW9kYWxCdXR0b246IFwiLnpldXMtbW9kYWwtYnV0dG9uIGFcIixcbiAgICAgICAgICAgICAgICBjbG9zZU1vZGFsRWxlbWVudHM6IFwiLnpldXMtbW9kYWwtY2xvc2UsIC56ZXVzLW1vZGFsLW92ZXJsYXlcIixcbiAgICAgICAgICAgIH0sXG4gICAgICAgIH07XG4gICAgfVxuXG4gICAgZ2V0RGVmYXVsdEVsZW1lbnRzKCkge1xuICAgICAgICBjb25zdCBlbGVtZW50ID0gdGhpcy4kZWxlbWVudC5nZXQoMCk7XG4gICAgICAgIGNvbnN0IHNlbGVjdG9ycyA9IHRoaXMuZ2V0U2V0dGluZ3MoXCJzZWxlY3RvcnNcIik7XG5cbiAgICAgICAgcmV0dXJuIHtcbiAgICAgICAgICAgIG1vZGFsOiBlbGVtZW50LnF1ZXJ5U2VsZWN0b3Ioc2VsZWN0b3JzLm1vZGFsKSxcbiAgICAgICAgICAgIG9wZW5Nb2RhbEJ1dHRvbjogZWxlbWVudC5xdWVyeVNlbGVjdG9yKHNlbGVjdG9ycy5vcGVuTW9kYWxCdXR0b24pLFxuICAgICAgICAgICAgY2xvc2VNb2RhbEVsZW1lbnRzOiBlbGVtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoc2VsZWN0b3JzLmNsb3NlTW9kYWxFbGVtZW50cyksXG4gICAgICAgICAgICBib2R5OiBkb2N1bWVudC5ib2R5LFxuICAgICAgICAgICAgaHRtbDogZG9jdW1lbnQucXVlcnlTZWxlY3RvcihcImh0bWxcIiksXG4gICAgICAgIH07XG4gICAgfVxuXG4gICAgb25Jbml0KC4uLmFyZ3MpIHtcbiAgICAgICAgc3VwZXIub25Jbml0KC4uLmFyZ3MpO1xuXG4gICAgICAgIHRoaXMubW92ZU1vZGFsVG9FbmRPZkJvZHkoKTtcbiAgICAgICAgdGhpcy5zZXR1cEV2ZW50TGlzdGVuZXJzKCk7XG4gICAgfVxuXG4gICAgbW92ZU1vZGFsVG9FbmRPZkJvZHkoKSB7XG4gICAgICAgIGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoYCN6ZXVzLW1vZGFsLSR7dGhpcy5nZXRJRCgpfWApLmZvckVhY2goKG1vZGFsKSA9PiB7XG4gICAgICAgICAgICBpZiAodGhpcy5lbGVtZW50cy5tb2RhbCAhPT0gbW9kYWwpIHtcbiAgICAgICAgICAgICAgICBtb2RhbC5yZW1vdmUoKTtcbiAgICAgICAgICAgIH1cbiAgICAgICAgfSk7XG5cbiAgICAgICAgZG9jdW1lbnQuYm9keS5pbnNlcnRBZGphY2VudEVsZW1lbnQoXCJiZWZvcmVlbmRcIiwgdGhpcy5lbGVtZW50cy5tb2RhbCk7XG4gICAgfVxuXG4gICAgc2V0dXBFdmVudExpc3RlbmVycygpIHtcbiAgICAgICAgdGhpcy5lbGVtZW50cy5vcGVuTW9kYWxCdXR0b24/LmFkZEV2ZW50TGlzdGVuZXIoXCJjbGlja1wiLCB0aGlzLm9wZW5Nb2RhbC5iaW5kKHRoaXMpKTtcbiAgICAgICAgdGhpcy5lbGVtZW50cy5jbG9zZU1vZGFsRWxlbWVudHM/LmZvckVhY2goKGNsb3NlTW9kYWxFbGVtZW50KSA9PiB7XG4gICAgICAgICAgICBjbG9zZU1vZGFsRWxlbWVudC5hZGRFdmVudExpc3RlbmVyKFwiY2xpY2tcIiwgdGhpcy5jbG9zZU1vZGFsLmJpbmQodGhpcykpO1xuICAgICAgICB9KTtcbiAgICB9XG5cbiAgICBvcGVuTW9kYWwoZXZlbnQpIHtcbiAgICAgICAgZXZlbnQucHJldmVudERlZmF1bHQoKTtcblxuICAgICAgICBjb25zdCBvcGVuTW9kYWxCdXR0b24gPSBldmVudC5jdXJyZW50VGFyZ2V0O1xuICAgICAgICBjb25zdCB0YXJnZXRJRCA9IG9wZW5Nb2RhbEJ1dHRvbi5nZXRBdHRyaWJ1dGUoXCJocmVmXCIpO1xuICAgICAgICBjb25zdCBtb2RhbCA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IodGFyZ2V0SUQpO1xuXG4gICAgICAgIGNvbnN0IGluaXRpYWxIVE1MSW5uZXJXaWR0aCA9IHRoaXMuZWxlbWVudHMuaHRtbC5pbm5lcldpZHRoO1xuICAgICAgICB0aGlzLmVsZW1lbnRzLmh0bWwuc3R5bGUub3ZlcmZsb3cgPSBcImhpZGRlblwiO1xuICAgICAgICBjb25zdCBhZnRlckluaXRpYWxIVE1MSW5uZXJXaWR0aCA9IHRoaXMuZWxlbWVudHMuaHRtbC5pbm5lcldpZHRoO1xuICAgICAgICB0aGlzLmVsZW1lbnRzLmh0bWwuc3R5bGUubWFyZ2luUmlnaHQgPSBhZnRlckluaXRpYWxIVE1MSW5uZXJXaWR0aCAtIGluaXRpYWxIVE1MSW5uZXJXaWR0aCArIFwicHhcIjtcblxuICAgICAgICBmYWRlSW4obW9kYWwpO1xuICAgIH1cblxuICAgIGNsb3NlTW9kYWwoZXZlbnQpIHtcbiAgICAgICAgY29uc3QgY2xvc2VNb2RhbEVsZW1lbnRzID0gZXZlbnQuY3VycmVudFRhcmdldDtcbiAgICAgICAgY29uc3QgbW9kYWwgPSBjbG9zZU1vZGFsRWxlbWVudHMuY2xvc2VzdChcIi56ZXVzLW1vZGFsLXdyYXBcIik7XG5cbiAgICAgICAgdGhpcy5lbGVtZW50cy5odG1sLnN0eWxlLm92ZXJmbG93ID0gXCJcIjtcbiAgICAgICAgdGhpcy5lbGVtZW50cy5odG1sLnN0eWxlLm1hcmdpblJpZ2h0ID0gXCJcIjtcblxuICAgICAgICBmYWRlT3V0KG1vZGFsKTtcbiAgICB9XG59XG5cbnJlZ2lzdGVyV2lkZ2V0KFpldXNfTW9kYWwsIFwiemV1cy1tb2RhbFwiKTtcbiJdfQ==
