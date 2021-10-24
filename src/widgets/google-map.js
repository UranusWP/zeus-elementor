import { registerWidget } from "../lib/utils";

class Zeus_GoogleMap extends elementorModules.frontend.handlers.Base {
    googleMap;
    infoWindow;

    getDefaultSettings() {
        return {
            selectors: {
                googleMap: ".zeus-google-map",
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
            styles: [],
        };
    }

    getDefaultElements() {
        const element = this.$element.get(0);
        const selectors = this.getSettings("selectors");

        return {
            googleMap: element.querySelector(selectors.googleMap),
        };
    }

    onInit(...args) {
        super.onInit(...args);

        this.setUserSettings();
        this.initGoogleMap();
    }

    initGoogleMap() {
        const googleMapOptions = this.getGoogleMapOptions();
        this.googleMap = new google.maps.Map(this.elements.googleMap, googleMapOptions);

        this.setAddresses();
    }

    getGoogleMapOptions() {
        const settings = this.getSettings();
        const latitude = settings.addresses[0][0];
        const longitude = settings.addresses[0][1];

        return {
            center: new google.maps.LatLng(latitude, longitude),
            zoom: settings.zoom,
            mapTypeId: settings.mapType,
            streetViewControl: settings.streetViewControl,
            mapTypeControl: settings.mapTypeControl,
            zoomControl: settings.zoomControl,
            fullscreenControl: settings.fullscreenControl,
            gestureHandling: settings.scrollToZoom,
            styles: settings.styles,
        };
    }

    setAddresses() {
        const settings = this.getSettings();

        settings.addresses.forEach((address) => {
            const addressLatitude = address[0];
            const addressLongitude = address[1];
            const addressTitle = address[3];

            if (!!addressLatitude && !!addressLongitude) {
                const markerIconType = address[5];
                const markerIconURL = address[6];
                const markerIconSize = address[7];

                // Set address marker
                const marker = this.createMarker(
                    addressLatitude,
                    addressLongitude,
                    addressTitle,
                    markerIconType,
                    markerIconURL,
                    markerIconSize
                );

                const enableInfoWindow = address[2];
                const enableInfoWindowOnDocumentLoad = address[8];
                const infoWindowDescription = address[4];

                if (!!enableInfoWindow && addressTitle) {
                    const infoWindow = this.createInfoWindow(marker, addressTitle, infoWindowDescription);

                    if (!!enableInfoWindowOnDocumentLoad) {
                        infoWindow.open(this.googleMap, marker);
                    }

                    google.maps.event.addListener(marker, "click", () => {
                        infoWindow.open(this.googleMap, marker);
                    });

                    google.maps.event.addListener(this.googleMap, "click", () => {
                        infoWindow.close();
                    });
                }
            }
        });
    }

    createMarker(addressLatitude, addressLongitude, addressTitle, markerIconType, markerIconURL, markerIconSize) {
        const markerAnimation = this.getSettings("markerAnimation");
        let animation = null;

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
            icon:
                markerIconType === "custom"
                    ? {
                          url: markerIconURL,
                          scaledSize: new google.maps.Size(markerIconSize, markerIconSize),
                          origin: new google.maps.Point(0, 0),
                          anchor: new google.maps.Point(0, 0),
                      }
                    : "",
        });
    }

    createInfoWindow(marker, addressTitle, infoWindowDescription) {
        const infoWindowOptinos = {};
        const datasetMaxWidth = this.elements.googleMap.dataset.iwMaxWidth;

        infoWindowOptinos.content = `
        <div class="zeus-infowindow-content">
            <div class="zeus-infowindow-title">${addressTitle}</div>
            ${!!infoWindowDescription ? `<div class="zeus-infowindow-description">${infoWindowDescription}</div>` : ``}
        </div>`;

        if (!!datasetMaxWidth) {
            infoWindowOptinos.maxWidth = datasetMaxWidth;
        }

        return new google.maps.InfoWindow(infoWindowOptinos);
    }

    setUserSettings() {
        const settings = this.getSettings();
        const datasetSettings = this.elements.googleMap.dataset;
        const elementSettings = this.getElementSettings();

        const addresses = !!datasetSettings.locations ? JSON.parse(datasetSettings.locations) : settings.addresses;
        const zoom = !Number.isNaN(Number(datasetSettings.zoom)) ? Number(datasetSettings.zoom) : settings.zoom;
        const mapType = !!elementSettings.map_type ? elementSettings.map_type : settings.mapType;
        const zoomControl = !!elementSettings.zoom_control ? elementSettings.zoom_control : settings.zoomControl;
        const styles = !!datasetSettings.customStyle ? JSON.parse(datasetSettings.customStyle) : settings.styles;

        const markerAnimation = !!elementSettings.marker_animation
            ? elementSettings.marker_animation
            : settings.markerAnimation;

        const streetViewControl = !!elementSettings.map_option_streetview
            ? elementSettings.map_option_streetview
            : settings.streetViewControl;

        const mapTypeControl = !!elementSettings.map_type_control
            ? elementSettings.map_type_control
            : settings.mapTypeControl;

        const fullscreenControl = !!elementSettings.fullscreen_control
            ? elementSettings.fullscreen_control
            : settings.fullscreenControl;

        const scrollToZoom = !!elementSettings.map_scroll_zoom ? elementSettings.map_scroll_zoom : settings.scrollToZoom;

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
            styles: styles,
        });
    }
}

registerWidget(Zeus_GoogleMap, "zeus-google-map");
