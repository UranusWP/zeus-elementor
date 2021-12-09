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

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

var Zeus_GoogleMap = /*#__PURE__*/function (_elementorModules$fro) {
  _inherits(Zeus_GoogleMap, _elementorModules$fro);

  var _super = _createSuper(Zeus_GoogleMap);

  function Zeus_GoogleMap() {
    var _this;

    _classCallCheck(this, Zeus_GoogleMap);

    for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
      args[_key] = arguments[_key];
    }

    _this = _super.call.apply(_super, [this].concat(args));

    _defineProperty(_assertThisInitialized(_this), "googleMap", void 0);

    _defineProperty(_assertThisInitialized(_this), "infoWindow", void 0);

    return _this;
  }

  _createClass(Zeus_GoogleMap, [{
    key: "getDefaultSettings",
    value: function getDefaultSettings() {
      return {
        selectors: {
          googleMap: ".zeus-google-map"
        },
        addresses: [],
        zoom: 4,
        mapType: "roadmap",
        markerAnimation: null,
        streetViewControl: false,
        mapTypeControl: false,
        zoomControl: false,
        fullscreenControl: false,
        scrollToZoom: "none",
        styles: []
      };
    }
  }, {
    key: "getDefaultElements",
    value: function getDefaultElements() {
      var element = this.$element.get(0);
      var selectors = this.getSettings("selectors");
      return {
        googleMap: element.querySelector(selectors.googleMap)
      };
    }
  }, {
    key: "onInit",
    value: function onInit() {
      var _get2;

      for (var _len2 = arguments.length, args = new Array(_len2), _key2 = 0; _key2 < _len2; _key2++) {
        args[_key2] = arguments[_key2];
      }

      (_get2 = _get(_getPrototypeOf(Zeus_GoogleMap.prototype), "onInit", this)).call.apply(_get2, [this].concat(args));

      this.setUserSettings();
      this.initGoogleMap();
    }
  }, {
    key: "initGoogleMap",
    value: function initGoogleMap() {
      var googleMapOptions = this.getGoogleMapOptions();
      this.googleMap = new google.maps.Map(this.elements.googleMap, googleMapOptions);
      this.setAddresses();
    }
  }, {
    key: "getGoogleMapOptions",
    value: function getGoogleMapOptions() {
      var settings = this.getSettings();
      var latitude = settings.addresses[0][0];
      var longitude = settings.addresses[0][1];
      return {
        center: new google.maps.LatLng(latitude, longitude),
        zoom: settings.zoom,
        mapTypeId: settings.mapType,
        streetViewControl: settings.streetViewControl,
        mapTypeControl: settings.mapTypeControl,
        zoomControl: settings.zoomControl,
        fullscreenControl: settings.fullscreenControl,
        gestureHandling: settings.scrollToZoom,
        styles: settings.styles
      };
    }
  }, {
    key: "setAddresses",
    value: function setAddresses() {
      var _this2 = this;

      var settings = this.getSettings();
      settings.addresses.forEach(function (address) {
        var addressLatitude = address[0];
        var addressLongitude = address[1];
        var addressTitle = address[3];

        if (!!addressLatitude && !!addressLongitude) {
          var markerIconType = address[5];
          var markerIconURL = address[6];
          var markerIconSize = address[7]; // Set address marker

          var marker = _this2.createMarker(addressLatitude, addressLongitude, addressTitle, markerIconType, markerIconURL, markerIconSize);

          var enableInfoWindow = address[2];
          var enableInfoWindowOnDocumentLoad = address[8];
          var infoWindowDescription = address[4];

          if (!!enableInfoWindow && addressTitle) {
            var infoWindow = _this2.createInfoWindow(marker, addressTitle, infoWindowDescription);

            if (!!enableInfoWindowOnDocumentLoad) {
              infoWindow.open(_this2.googleMap, marker);
            }

            google.maps.event.addListener(marker, "click", function () {
              infoWindow.open(_this2.googleMap, marker);
            });
            google.maps.event.addListener(_this2.googleMap, "click", function () {
              infoWindow.close();
            });
          }
        }
      });
    }
  }, {
    key: "createMarker",
    value: function createMarker(addressLatitude, addressLongitude, addressTitle, markerIconType, markerIconURL, markerIconSize) {
      var markerAnimation = this.getSettings("markerAnimation");
      var animation = null;

      switch (markerAnimation) {
        case "drop":
          animation = google.maps.Animation.DROP;
          break;

        case "bounce":
          animation = google.maps.Animation.BOUNCE;
          break;
      }

      return new google.maps.Marker({
        position: new google.maps.LatLng(addressLatitude, addressLongitude),
        map: this.googleMap,
        title: addressTitle,
        animation: animation,
        icon: markerIconType === "custom" ? {
          url: markerIconURL,
          scaledSize: new google.maps.Size(markerIconSize, markerIconSize),
          origin: new google.maps.Point(0, 0),
          anchor: new google.maps.Point(0, 0)
        } : ""
      });
    }
  }, {
    key: "createInfoWindow",
    value: function createInfoWindow(marker, addressTitle, infoWindowDescription) {
      var infoWindowOptinos = {};
      var datasetMaxWidth = this.elements.googleMap.dataset.iwMaxWidth;
      infoWindowOptinos.content = "\n        <div class=\"zeus-infowindow-content\">\n            <div class=\"zeus-infowindow-title\">".concat(addressTitle, "</div>\n            ").concat(!!infoWindowDescription ? "<div class=\"zeus-infowindow-description\">".concat(infoWindowDescription, "</div>") : "", "\n        </div>");

      if (!!datasetMaxWidth) {
        infoWindowOptinos.maxWidth = datasetMaxWidth;
      }

      return new google.maps.InfoWindow(infoWindowOptinos);
    }
  }, {
    key: "setUserSettings",
    value: function setUserSettings() {
      var settings = this.getSettings();
      var datasetSettings = this.elements.googleMap.dataset;
      var elementSettings = this.getElementSettings();
      var addresses = !!datasetSettings.locations ? JSON.parse(datasetSettings.locations) : settings.addresses;
      var zoom = !Number.isNaN(Number(datasetSettings.zoom)) ? Number(datasetSettings.zoom) : settings.zoom;
      var mapType = !!elementSettings.map_type ? elementSettings.map_type : settings.mapType;
      var zoomControl = !!elementSettings.zoom_control ? elementSettings.zoom_control : settings.zoomControl;
      var styles = !!datasetSettings.customStyle ? JSON.parse(datasetSettings.customStyle) : settings.styles;
      var markerAnimation = !!elementSettings.marker_animation ? elementSettings.marker_animation : settings.markerAnimation;
      var streetViewControl = !!elementSettings.map_option_streetview ? elementSettings.map_option_streetview : settings.streetViewControl;
      var mapTypeControl = !!elementSettings.map_type_control ? elementSettings.map_type_control : settings.mapTypeControl;
      var fullscreenControl = !!elementSettings.fullscreen_control ? elementSettings.fullscreen_control : settings.fullscreenControl;
      var scrollToZoom = !!elementSettings.map_scroll_zoom ? elementSettings.map_scroll_zoom : settings.scrollToZoom;
      this.setSettings({
        addresses: addresses,
        zoom: zoom,
        mapType: mapType,
        markerAnimation: markerAnimation,
        streetViewControl: streetViewControl,
        mapTypeControl: mapTypeControl,
        zoomControl: zoomControl,
        fullscreenControl: fullscreenControl,
        scrollToZoom: scrollToZoom,
        styles: styles
      });
    }
  }]);

  return Zeus_GoogleMap;
}(elementorModules.frontend.handlers.Base);

(0, _utils.registerWidget)(Zeus_GoogleMap, "zeus-google-map");

},{"../lib/utils":1}]},{},[2])
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm5vZGVfbW9kdWxlcy9icm93c2VyLXBhY2svX3ByZWx1ZGUuanMiLCJzcmMvbGliL3V0aWxzLmpzIiwic3JjL3dpZGdldHMvZ29vZ2xlLW1hcC5qcyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFBQTs7Ozs7Ozs7QUNBTyxJQUFNLGNBQWMsR0FBRyxTQUFqQixjQUFpQixDQUFDLFNBQUQsRUFBWSxVQUFaLEVBQTZDO0FBQUEsTUFBckIsSUFBcUIsdUVBQWQsU0FBYzs7QUFDdkUsTUFBSSxFQUFFLFNBQVMsSUFBSSxVQUFmLENBQUosRUFBZ0M7QUFDNUI7QUFDSDtBQUVEO0FBQ0o7QUFDQTtBQUNBOzs7QUFDSSxFQUFBLE1BQU0sQ0FBQyxNQUFELENBQU4sQ0FBZSxFQUFmLENBQWtCLHlCQUFsQixFQUE2QyxZQUFNO0FBQy9DLFFBQU0sVUFBVSxHQUFHLFNBQWIsVUFBYSxDQUFDLFFBQUQsRUFBYztBQUM3QixNQUFBLGlCQUFpQixDQUFDLGVBQWxCLENBQWtDLFVBQWxDLENBQTZDLFNBQTdDLEVBQXdEO0FBQ3BELFFBQUEsUUFBUSxFQUFSO0FBRG9ELE9BQXhEO0FBR0gsS0FKRDs7QUFNQSxJQUFBLGlCQUFpQixDQUFDLEtBQWxCLENBQXdCLFNBQXhCLGtDQUE0RCxVQUE1RCxjQUEwRSxJQUExRSxHQUFrRixVQUFsRjtBQUNILEdBUkQ7QUFTSCxDQWxCTTs7Ozs7Ozs7O0FDQVA7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7SUFFTSxjOzs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7O1dBSUYsOEJBQXFCO0FBQ2pCLGFBQU87QUFDSCxRQUFBLFNBQVMsRUFBRTtBQUNQLFVBQUEsU0FBUyxFQUFFO0FBREosU0FEUjtBQUlILFFBQUEsU0FBUyxFQUFFLEVBSlI7QUFLSCxRQUFBLElBQUksRUFBRSxDQUxIO0FBTUgsUUFBQSxPQUFPLEVBQUUsU0FOTjtBQU9ILFFBQUEsZUFBZSxFQUFFLElBUGQ7QUFRSCxRQUFBLGlCQUFpQixFQUFFLEtBUmhCO0FBU0gsUUFB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R0FFcEIsUUFBUSxDQUFDLGlCQUZmO0FBSUEsVUFBTSxjQUFjLEdBQUcsQ0FBQyxDQUFDLGVBQWUsQ0FBQyxnQkFBbEIsR0FDakIsZUFBZSxDQUFDLGdCQURDLEdBRWpCLFFBQVEsQ0FBQyxjQUZmO0FBSUEsVUFBTSxpQkFBaUIsR0FBRyxDQUFDLENBQUMsZUFBZSxDQUFDLGtCQUFsQixHQUNwQixlQUFlLENBQUMsa0JBREksR0FFcEIsUUFBUSxDQUFDLGlCQUZmO0FBSUEsVUFBTSxZQUFZLEdBQUcsQ0FBQyxDQUFDLGVBQWUsQ0FBQyxlQUFsQixHQUFvQyxlQUFlLENBQUMsZUFBcEQsR0FBc0UsUUFBUSxDQUFDLFlBQXBHO0FBRUEsV0FBSyxXQUFMLENBQWlCO0FBQ2IsUUFBQSxTQUFTLEVBQUUsU0FERTtBQUViLFFBQUEsSUFBSSxFQUFFLElBRk87QUFHYixRQUFBLE9BQU8sRUFBRSxPQUhJO0FBSWIsUUFBQSxlQUFlLEVBQUUsZUFKSjtBQUtiLFFBQUEsaUJBQWlCLEVBQUUsaUJBTE47QUFNYixRQUFBLGNBQWMsRUFBRSxjQU5IO0FBT2IsUUFBQSxXQUFXLEVBQUUsV0FQQTtBQVFiLFFBQUEsaUJBQWlCLEVBQUUsaUJBUk47QUFTYixRQUFBLFlBQVksRUFBRSxZQVREO0FBVWIsUUFBQSxNQUFNLEVBQUU7QUFWSyxPQUFqQjtBQVlIOzs7O0VBdE13QixnQkFBZ0IsQ0FBQyxRQUFqQixDQUEwQixRQUExQixDQUFtQyxJOztBQXlNaEUsMkJBQWUsY0FBZixFQUErQixpQkFBL0IiLCJmaWxlIjoiZ2VuZXJhdGVkLmpzIiwic291cmNlUm9vdCI6IiIsInNvdXJjZXNDb250ZW50IjpbIihmdW5jdGlvbigpe2Z1bmN0aW9uIHIoZSxuLHQpe2Z1bmN0aW9uIG8oaSxmKXtpZighbltpXSl7aWYoIWVbaV0pe3ZhciBjPVwiZnVuY3Rpb25cIj09dHlwZW9mIHJlcXVpcmUmJnJlcXVpcmU7aWYoIWYmJmMpcmV0dXJuIGMoaSwhMCk7aWYodSlyZXR1cm4gdShpLCEwKTt2YXIgYT1uZXcgRXJyb3IoXCJDYW5ub3QgZmluZCBtb2R1bGUgJ1wiK2krXCInXCIpO3Rocm93IGEuY29kZT1cIk1PRFVMRV9OT1RfRk9VTkRcIixhfXZhciBwPW5baV09e2V4cG9ydHM6e319O2VbaV1bMF0uY2FsbChwLmV4cG9ydHMsZnVuY3Rpb24ocil7dmFyIG49ZVtpXVsxXVtyXTtyZXR1cm4gbyhufHxyKX0scCxwLmV4cG9ydHMscixlLG4sdCl9cmV0dXJuIG5baV0uZXhwb3J0c31mb3IodmFyIHU9XCJmdW5jdGlvblwiPT10eXBlb2YgcmVxdWlyZSYmcmVxdWlyZSxpPTA7aTx0Lmxlbmd0aDtpKyspbyh0W2ldKTtyZXR1cm4gb31yZXR1cm4gcn0pKCkiLCJleHBvcnQgY29uc3QgcmVnaXN0ZXJXaWRnZXQgPSAoY2xhc3NOYW1lLCB3aWRnZXROYW1lLCBza2luID0gJ2RlZmF1bHQnKSA9PiB7XG4gICAgaWYgKCEoY2xhc3NOYW1lIHx8IHdpZGdldE5hbWUpKSB7XG4gICAgICAgIHJldHVybjtcbiAgICB9XG5cbiAgICAvKipcbiAgICAgKiBCZWNhdXNlIEVsZW1lbnRvciBwbHVnaW4gdXNlcyBqUXVlcnkgY3VzdG9tIGV2ZW50LFxuICAgICAqIFdlIGFsc28gaGF2ZSB0byB1c2UgalF1ZXJ5IHRvIHVzZSB0aGlzIGV2ZW50XG4gICAgICovXG4gICAgalF1ZXJ5KHdpbmRvdykub24oJ2VsZW1lbnRvci9mcm9udGVuZC9pbml0JywgKCkgPT4ge1xuICAgICAgICBjb25zdCBhZGRIYW5kbGVyID0gKCRlbGVtZW50KSA9PiB7XG4gICAgICAgICAgICBlbGVtZW50b3JGcm9udGVuZC5lbGVtZW50c0hhbmRsZXIuYWRkSGFuZGxlcihjbGFzc05hbWUsIHtcbiAgICAgICAgICAgICAgICAkZWxlbWVudCxcbiAgICAgICAgICAgIH0pO1xuICAgICAgICB9O1xuXG4gICAgICAgIGVsZW1lbnRvckZyb250ZW5kLmhvb2tzLmFkZEFjdGlvbihgZnJvbnRlbmQvZWxlbWVudF9yZWFkeS8ke3dpZGdldE5hbWV9LiR7c2tpbn1gLCBhZGRIYW5kbGVyKTtcbiAgICB9KTtcbn07XG4iLCJpbXBvcnQgeyByZWdpc3RlcldpZGdldCB9IGZyb20gXCIuLi9saWIvdXRpbHNcIjtcblxuY2xhc3MgWmV1c19Hb29nbGVNYXAgZXh0ZW5kcyBlbGVtZW50b3JNb2R1bGVzLmZyb250ZW5kLmhhbmRsZXJzLkJhc2Uge1xuICAgIGdvb2dsZU1hcDtcbiAgICBpbmZvV2luZG93O1xuXG4gICAgZ2V0RGVmYXVsdFNldHRpbmdzKCkge1xuICAgICAgICByZXR1cm4ge1xuICAgICAgICAgICAgc2VsZWN0b3JzOiB7XG4gICAgICAgICAgICAgICAgZ29vZ2xlTWFwOiBcIi56ZXVzLWdvb2dsZS1tYXBcIixcbiAgICAgICAgICAgIH0sXG4gICAgICAgICAgICBhZGRyZXNzZXM6IFtdLFxuICAgICAgICAgICAgem9vbTogNCxcbiAgICAgICAgICAgIG1hcFR5cGU6IFwicm9hZG1hcFwiLFxuICAgICAgICAgICAgbWFya2VyQW5pbWF0aW9uOiBudWxsLFxuICAgICAgICAgICAgc3RyZWV0Vmlld0NvbnRyb2w6IGZhbHNlLFxuICAgICAgICAgICAgbWFwVHlwZUNvbnRyb2w6IGZhbHNlLFxuICAgICAgICAgICAgem9vbUNvbnRyb2w6IGZhbHNlLFxuICAgICAgICAgICAgZnVsbHNjcmVlbkNvbnRyb2w6IGZhbHNlLFxuICAgICAgICAgICAgc2Nyb2xsVG9ab29tOiBcIm5vbmVcIixcbiAgICAgICAgICAgIHN0eWxlczogW10sXG4gICAgICAgIH07XG4gICAgfVxuXG4gICAgZ2V0RGVmYXVsdEVsZW1lbnRzKCkge1xuICAgICAgICBjb25zdCBlbGVtZW50ID0gdGhpcy4kZWxlbWVudC5nZXQoMCk7XG4gICAgICAgIGNvbnN0IHNlbGVjdG9ycyA9IHRoaXMuZ2V0U2V0dGluZ3MoXCJzZWxlY3RvcnNcIik7XG5cbiAgICAgICAgcmV0dXJuIHtcbiAgICAgICAgICAgIGdvb2dsZU1hcDogZWxlbWVudC5xdWVyeVNlbGVjdG9yKHNlbGVjdG9ycy5nb29nbGVNYXApLFxuICAgICAgICB9O1xuICAgIH1cblxuICAgIG9uSW5pdCguLi5hcmdzKSB7XG4gICAgICAgIHN1cGVyLm9uSW5pdCguLi5hcmdzKTtcblxuICAgICAgICB0aGlzLnNldFVzZXJTZXR0aW5ncygpO1xuICAgICAgICB0aGlzLmluaXRHb29nbGVNYXAoKTtcbiAgICB9XG5cbiAgICBpbml0R29vZ2xlTWFwKCkge1xuICAgICAgICBjb25zdCBnb29nbGVNYXBPcHRpb25zID0gdGhpcy5nZXRHb29nbGVNYXBPcHRpb25zKCk7XG4gICAgICAgIHRoaXMuZ29vZ2xlTWFwID0gbmV3IGdvb2dsZS5tYXBzLk1hcCh0aGlzLmVsZW1lbnRzLmdvb2dsZU1hcCwgZ29vZ2xlTWFwT3B0aW9ucyk7XG5cbiAgICAgICAgdGhpcy5zZXRBZGRyZXNzZXMoKTtcbiAgICB9XG5cbiAgICBnZXRHb29nbGVNYXBPcHRpb25zKCkge1xuICAgICAgICBjb25zdCBzZXR0aW5ncyA9IHRoaXMuZ2V0U2V0dGluZ3MoKTtcbiAgICAgICAgY29uc3QgbGF0aXR1ZGUgPSBzZXR0aW5ncy5hZGRyZXNzZXNbMF1bMF07XG4gICAgICAgIGNvbnN0IGxvbmdpdHVkZSA9IHNldHRpbmdzLmFkZHJlc3Nlc1swXVsxXTtcblxuICAgICAgICByZXR1cm4ge1xuICAgICAgICAgICAgY2VudGVyOiBuZXcgZ29vZ2xlLm1hcHMuTGF0TG5nKGxhdGl0dWRlLCBsb25naXR1ZGUpLFxuICAgICAgICAgICAgem9vbTogc2V0dGluZ3Muem9vbSxcbiAgICAgICAgICAgIG1hcFR5cGVJZDogc2V0dGluZ3MubWFwVHlwZSxcbiAgICAgICAgICAgIHN0cmVldFZpZXdDb250cm9sOiBzZXR0aW5ncy5zdHJlZXRWaWV3Q29udHJvbCxcbiAgICAgICAgICAgIG1hcFR5cGVDb250cm9sOiBzZXR0aW5ncy5tYXBUeXBlQ29udHJvbCxcbiAgICAgICAgICAgIHpvb21Db250cm9sOiBzZXR0aW5ncy56b29tQ29udHJvbCxcbiAgICAgICAgICAgIGZ1bGxzY3JlZW5Db250cm9sOiBzZXR0aW5ncy5mdWxsc2NyZWVuQ29udHJvbCxcbiAgICAgICAgICAgIGdlc3R1cmVIYW5kbGluZzogc2V0dGluZ3Muc2Nyb2xsVG9ab29tLFxuICAgICAgICAgICAgc3R5bGVzOiBzZXR0aW5ncy5zdHlsZXMsXG4gICAgICAgIH07XG4gICAgfVxuXG4gICAgc2V0QWRkcmVzc2VzKCkge1xuICAgICAgICBjb25zdCBzZXR0aW5ncyA9IHRoaXMuZ2V0U2V0dGluZ3MoKTtcblxuICAgICAgICBzZXR0aW5ncy5hZGRyZXNzZXMuZm9yRWFjaCgoYWRkcmVzcykgPT4ge1xuICAgICAgICAgICAgY29uc3QgYWRkcmVzc0xhdGl0dWRlID0gYWRkcmVzc1swXTtcbiAgICAgICAgICAgIGNvbnN0IGFkZHJlc3NMb25naXR1ZGUgPSBhZGRyZXNzWzFdO1xuICAgICAgICAgICAgY29uc3QgYWRkcmVzc1RpdGxlID0gYWRkcmVzc1szXTtcblxuICAgICAgICAgICAgaWYgKCEhYWRkcmVzc0xhdGl0dWRlICYmICEhYWRkcmVzc0xvbmdpdHVkZSkge1xuICAgICAgICAgICAgICAgIGNvbnN0IG1hcmtlckljb25UeXBlID0gYWRkcmVzc1s1XTtcbiAgICAgICAgICAgICAgICBjb25zdCBtYXJrZXJJY29uVVJMID0gYWRkcmVzc1s2XTtcbiAgICAgICAgICAgICAgICBjb25zdCBtYXJrZXJJY29uU2l6ZSA9IGFkZHJlc3NbN107XG5cbiAgICAgICAgICAgICAgICAvLyBTZXQgYWRkcmVzcyBtYXJrZXJcbiAgICAgICAgICAgICAgICBjb25zdCBtYXJrZXIgPSB0aGlzLmNyZWF0ZU1hcmtlcihcbiAgICAgICAgICAgICAgICAgICAgYWRkcmVzc0xhdGl0dWRlLFxuICAgICAgICAgICAgICAgICAgICBhZGRyZXNzTG9uZ2l0dWRlLFxuICAgICAgICAgICAgICAgICAgICBhZGRyZXNzVGl0bGUsXG4gICAgICAgICAgICAgICAgICAgIG1hcmtlckljb25UeXBlLFxuICAgICAgICAgICAgICAgICAgICBtYXJrZXJJY29uVVJMLFxuICAgICAgICAgICAgICAgICAgICBtYXJrZXJJY29uU2l6ZVxuICAgICAgICAgICAgICAgICk7XG5cbiAgICAgICAgICAgICAgICBjb25zdCBlbmFibGVJbmZvV2luZG93ID0gYWRkcmVzc1syXTtcbiAgICAgICAgICAgICAgICBjb25zdCBlbmFibGVJbmZvV2luZG93T25Eb2N1bWVudExvYWQgPSBhZGRyZXNzWzhdO1xuICAgICAgICAgICAgICAgIGNvbnN0IGluZm9XaW5kb3dEZXNjcmlwdGlvbiA9IGFkZHJlc3NbNF07XG5cbiAgICAgICAgICAgICAgICBpZiAoISFlbmFibGVJbmZvV2luZG93ICYmIGFkZHJlc3NUaXRsZSkge1xuICAgICAgICAgICAgICAgICAgICBjb25zdCBpbmZvV2luZG93ID0gdGhpcy5jcmVhdGVJbmZvV2luZG93KG1hcmtlciwgYWRkcmVzc1RpdGxlLCBpbmZvV2luZG93RGVzY3JpcHRpb24pO1xuXG4gICAgICAgICAgICAgICAgICAgIGlmICghIWVuYWJsZUluZm9XaW5kb3dPbkRvY3VtZW50TG9hZCkge1xuICAgICAgICAgICAgICAgICAgICAgICAgaW5mb1dpbmRvdy5vcGVuKHRoaXMuZ29vZ2xlTWFwLCBtYXJrZXIpO1xuICAgICAgICAgICAgICAgICAgICB9XG5cbiAgICAgICAgICAgICAgICAgICAgZ29vZ2xlLm1hcHMuZXZlbnQuYWRkTGlzdGVuZXIobWFya2VyLCBcImNsaWNrXCIsICgpID0+IHtcbiAgICAgICAgICAgICAgICAgICAgICAgIGluZm9XaW5kb3cub3Blbih0aGlzLmdvb2dsZU1hcCwgbWFya2VyKTtcbiAgICAgICAgICAgICAgICAgICAgfSk7XG5cbiAgICAgICAgICAgICAgICAgICAgZ29vZ2xlLm1hcHMuZXZlbnQuYWRkTGlzdGVuZXIodGhpcy5nb29nbGVNYXAsIFwiY2xpY2tcIiwgKCkgPT4ge1xuICAgICAgICAgICAgICAgICAgICAgICAgaW5mb1dpbmRvdy5jbG9zZSgpO1xuICAgICAgICAgICAgICAgICAgICB9KTtcbiAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICB9XG4gICAgICAgIH0pO1xuICAgIH1cblxuICAgIGNyZWF0ZU1hcmtlcihhZGRyZXNzTGF0aXR1ZGUsIGFkZHJlc3NMb25naXR1ZGUsIGFkZHJlc3NUaXRsZSwgbWFya2VySWNvblR5cGUsIG1hcmtlckljb25VUkwsIG1hcmtlckljb25TaXplKSB7XG4gICAgICAgIGNvbnN0IG1hcmtlckFuaW1hdGlvbiA9IHRoaXMuZ2V0U2V0dGluZ3MoXCJtYXJrZXJBbmltYXRpb25cIik7XG4gICAgICAgIGxldCBhbmltYXRpb24gPSBudWxsO1xuXG4gICAgICAgIHN3aXRjaCAobWFya2VyQW5pbWF0aW9uKSB7XG4gICAgICAgICAgICBjYXNlIFwiZHJvcFwiOlxuICAgICAgICAgICAgICAgIGFuaW1hdGlvbiA9IGdvb2dsZS5tYXBzLkFuaW1hdGlvbi5EUk9QO1xuICAgICAgICAgICAgICAgIGJyZWFrO1xuXG4gICAgICAgICAgICBjYXNlIFwiYm91bmNlXCI6XG4gICAgICAgICAgICAgICAgYW5pbWF0aW9uID0gZ29vZ2xlLm1hcHMuQW5pbWF0aW9uLkJPVU5DRTtcbiAgICAgICAgICAgICAgICBicmVhaztcbiAgICAgICAgfVxuXG4gICAgICAgIHJldHVybiBuZXcgZ29vZ2xlLm1hcHMuTWFya2VyKHtcbiAgICAgICAgICAgIHBvc2l0aW9uOiBuZXcgZ29vZ2xlLm1hcHMuTGF0TG5nKGFkZHJlc3NMYXRpdHVkZSwgYWRkcmVzc0xvbmdpdHVkZSksXG4gICAgICAgICAgICBtYXA6IHRoaXMuZ29vZ2xlTWFwLFxuICAgICAgICAgICAgdGl0bGU6IGFkZHJlc3NUaXRsZSxcbiAgICAgICAgICAgIGFuaW1hdGlvbjogYW5pbWF0aW9uLFxuICAgICAgICAgICAgaWNvbjpcbiAgICAgICAgICAgICAgICBtYXJrZXJJY29uVHlwZSA9PT0gXCJjdXN0b21cIlxuICAgICAgICAgICAgICAgICAgICA/IHtcbiAgICAgICAgICAgICAgICAgICAgICAgICAgdXJsOiBtYXJrZXJJY29uVVJMLFxuICAgICAgICAgICAgICAgICAgICAgICAgICBzY2FsZWRTaXplOiBuZXcgZ29vZ2xlLm1hcHMuU2l6ZShtYXJrZXJJY29uU2l6ZSwgbWFya2VySWNvblNpemUpLFxuICAgICAgICAgICAgICAgICAgICAgICAgICBvcmlnaW46IG5ldyBnb29nbGUubWFwcy5Qb2ludCgwLCAwKSxcbiAgICAgICAgICAgICAgICAgICAgICAgICAgYW5jaG9yOiBuZXcgZ29vZ2xlLm1hcHMuUG9pbnQoMCwgMCksXG4gICAgICAgICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICAgICAgICA6IFwiXCIsXG4gICAgICAgIH0pO1xuICAgIH1cblxuICAgIGNyZWF0ZUluZm9XaW5kb3cobWFya2VyLCBhZGRyZXNzVGl0bGUsIGluZm9XaW5kb3dEZXNjcmlwdGlvbikge1xuICAgICAgICBjb25zdCBpbmZvV2luZG93T3B0aW5vcyA9IHt9O1xuICAgICAgICBjb25zdCBkYXRhc2V0TWF4V2lkdGggPSB0aGlzLmVsZW1lbnRzLmdvb2dsZU1hcC5kYXRhc2V0Lml3TWF4V2lkdGg7XG5cbiAgICAgICAgaW5mb1dpbmRvd09wdGlub3MuY29udGVudCA9IGBcbiAgICAgICAgPGRpdiBjbGFzcz1cInpldXMtaW5mb3dpbmRvdy1jb250ZW50XCI+XG4gICAgICAgICAgICA8ZGl2IGNsYXNzPVwiemV1cy1pbmZvd2luZG93LXRpdGxlXCI+JHthZGRyZXNzVGl0bGV9PC9kaXY+XG4gICAgICAgICAgICAkeyEhaW5mb1dpbmRvd0Rlc2NyaXB0aW9uID8gYDxkaXYgY2xhc3M9XCJ6ZXVzLWluZm93aW5kb3ctZGVzY3JpcHRpb25cIj4ke2luZm9XaW5kb3dEZXNjcmlwdGlvbn08L2Rpdj5gIDogYGB9XG4gICAgICAgIDwvZGl2PmA7XG5cbiAgICAgICAgaWYgKCEhZGF0YXNldE1heFdpZHRoKSB7XG4gICAgICAgICAgICBpbmZvV2luZG93T3B0aW5vcy5tYXhXaWR0aCA9IGRhdGFzZXRNYXhXaWR0aDtcbiAgICAgICAgfVxuXG4gICAgICAgIHJldHVybiBuZXcgZ29vZ2xlLm1hcHMuSW5mb1dpbmRvdyhpbmZvV2luZG93T3B0aW5vcyk7XG4gICAgfVxuXG4gICAgc2V0VXNlclNldHRpbmdzKCkge1xuICAgICAgICBjb25zdCBzZXR0aW5ncyA9IHRoaXMuZ2V0U2V0dGluZ3MoKTtcbiAgICAgICAgY29uc3QgZGF0YXNldFNldHRpbmdzID0gdGhpcy5lbGVtZW50cy5nb29nbGVNYXAuZGF0YXNldDtcbiAgICAgICAgY29uc3QgZWxlbWVudFNldHRpbmdzID0gdGhpcy5nZXRFbGVtZW50U2V0dGluZ3MoKTtcblxuICAgICAgICBjb25zdCBhZGRyZXNzZXMgPSAhIWRhdGFzZXRTZXR0aW5ncy5sb2NhdGlvbnMgPyBKU09OLnBhcnNlKGRhdGFzZXRTZXR0aW5ncy5sb2NhdGlvbnMpIDogc2V0dGluZ3MuYWRkcmVzc2VzO1xuICAgICAgICBjb25zdCB6b29tID0gIU51bWJlci5pc05hTihOdW1iZXIoZGF0YXNldFNldHRpbmdzLnpvb20pKSA/IE51bWJlcihkYXRhc2V0U2V0dGluZ3Muem9vbSkgOiBzZXR0aW5ncy56b29tO1xuICAgICAgICBjb25zdCBtYXBUeXBlID0gISFlbGVtZW50U2V0dGluZ3MubWFwX3R5cGUgPyBlbGVtZW50U2V0dGluZ3MubWFwX3R5cGUgOiBzZXR0aW5ncy5tYXBUeXBlO1xuICAgICAgICBjb25zdCB6b29tQ29udHJvbCA9ICEhZWxlbWVudFNldHRpbmdzLnpvb21fY29udHJvbCA/IGVsZW1lbnRTZXR0aW5ncy56b29tX2NvbnRyb2wgOiBzZXR0aW5ncy56b29tQ29udHJvbDtcbiAgICAgICAgY29uc3Qgc3R5bGVzID0gISFkYXRhc2V0U2V0dGluZ3MuY3VzdG9tU3R5bGUgPyBKU09OLnBhcnNlKGRhdGFzZXRTZXR0aW5ncy5jdXN0b21TdHlsZSkgOiBzZXR0aW5ncy5zdHlsZXM7XG5cbiAgICAgICAgY29uc3QgbWFya2VyQW5pbWF0aW9uID0gISFlbGVtZW50U2V0dGluZ3MubWFya2VyX2FuaW1hdGlvblxuICAgICAgICAgICAgPyBlbGVtZW50U2V0dGluZ3MubWFya2VyX2FuaW1hdGlvblxuICAgICAgICAgICAgOiBzZXR0aW5ncy5tYXJrZXJBbmltYXRpb247XG5cbiAgICAgICAgY29uc3Qgc3RyZWV0Vmlld0NvbnRyb2wgPSAhIWVsZW1lbnRTZXR0aW5ncy5tYXBfb3B0aW9uX3N0cmVldHZpZXdcbiAgICAgICAgICAgID8gZWxlbWVudFNldHRpbmdzLm1hcF9vcHRpb25fc3RyZWV0dmlld1xuICAgICAgICAgICAgOiBzZXR0aW5ncy5zdHJlZXRWaWV3Q29udHJvbDtcblxuICAgICAgICBjb25zdCBtYXBUeXBlQ29udHJvbCA9ICEhZWxlbWVudFNldHRpbmdzLm1hcF90eXBlX2NvbnRyb2xcbiAgICAgICAgICAgID8gZWxlbWVudFNldHRpbmdzLm1hcF90eXBlX2NvbnRyb2xcbiAgICAgICAgICAgIDogc2V0dGluZ3MubWFwVHlwZUNvbnRyb2w7XG5cbiAgICAgICAgY29uc3QgZnVsbHNjcmVlbkNvbnRyb2wgPSAhIWVsZW1lbnRTZXR0aW5ncy5mdWxsc2NyZWVuX2NvbnRyb2xcbiAgICAgICAgICAgID8gZWxlbWVudFNldHRpbmdzLmZ1bGxzY3JlZW5fY29udHJvbFxuICAgICAgICAgICAgOiBzZXR0aW5ncy5mdWxsc2NyZWVuQ29udHJvbDtcblxuICAgICAgICBjb25zdCBzY3JvbGxUb1pvb20gPSAhIWVsZW1lbnRTZXR0aW5ncy5tYXBfc2Nyb2xsX3pvb20gPyBlbGVtZW50U2V0dGluZ3MubWFwX3Njcm9sbF96b29tIDogc2V0dGluZ3Muc2Nyb2xsVG9ab29tO1xuXG4gICAgICAgIHRoaXMuc2V0U2V0dGluZ3Moe1xuICAgICAgICAgICAgYWRkcmVzc2VzOiBhZGRyZXNzZXMsXG4gICAgICAgICAgICB6b29tOiB6b29tLFxuICAgICAgICAgICAgbWFwVHlwZTogbWFwVHlwZSxcbiAgICAgICAgICAgIG1hcmtlckFuaW1hdGlvbjogbWFya2VyQW5pbWF0aW9uLFxuICAgICAgICAgICAgc3RyZWV0Vmlld0NvbnRyb2w6IHN0cmVldFZpZXdDb250cm9sLFxuICAgICAgICAgICAgbWFwVHlwZUNvbnRyb2w6IG1hcFR5cGVDb250cm9sLFxuICAgICAgICAgICAgem9vbUNvbnRyb2w6IHpvb21Db250cm9sLFxuICAgICAgICAgICAgZnVsbHNjcmVlbkNvbnRyb2w6IGZ1bGxzY3JlZW5Db250cm9sLFxuICAgICAgICAgICAgc2Nyb2xsVG9ab29tOiBzY3JvbGxUb1pvb20sXG4gICAgICAgICAgICBzdHlsZXM6IHN0eWxlcyxcbiAgICAgICAgfSk7XG4gICAgfVxufVxuXG5yZWdpc3RlcldpZGdldChaZXVzX0dvb2dsZU1hcCwgXCJ6ZXVzLWdvb2dsZS1tYXBcIik7XG4iXX0=
