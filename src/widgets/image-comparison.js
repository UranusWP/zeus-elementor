import { registerWidget } from "../lib/utils";

class Zeus_ImageComparison extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
        return {
            selectors: {
                imageComparison: ".zeus-image-comparison",
            },
            visibleRatio: 0.5,
            orientation: "horizontal",
            beforeLabel: "Before",
            afterLabel: "After",
            noOverlay: false,
            sliderOnHover: false,
            sliderWithHandle: true,
            sliderWithClick: false,
        };
    }

    getDefaultElements() {
        const element = this.$element.get(0);
        const selectors = this.getSettings("selectors");

        return {
            imageComparison: element.querySelector(selectors.imageComparison),
            $imageComparison: this.$element.find(selectors.imageComparison),
        };
    }

    onInit(...args) {
        super.onInit(...args);

        this.setUserSettings();
        this.initTwentyTwenty();
    }

    initTwentyTwenty() {
        const settings = this.getSettings();
        var imgLoad = imagesLoaded(this.elements.imageComparison);

        imgLoad.on("done", (instance) => {
            this.elements.$imageComparison.twentytwenty({
                default_offset_pct: settings.visibleRatio,
                orientation: settings.orientation,
                before_label: settings.beforeLabel,
                after_label: settings.afterLabel,
                no_overlay: settings.noOverlay,
                move_slider_on_hover: settings.sliderOnHover,
                move_with_handle_only: settings.sliderWithHandle,
                click_to_move: settings.sliderWithClick,
            });
        });
    }

    setUserSettings() {
        const settings = this.getSettings();
        const datasetSettings = JSON.parse(this.elements.imageComparison.dataset.settings);

        this.setSettings({
            visibleRatio: !!datasetSettings.visible_ratio ? datasetSettings.visible_ratio : settings.visibleRatio,
            orientation: !!datasetSettings.orientation ? datasetSettings.orientation : settings.orientation,
            beforeLabel: !!datasetSettings.before_label ? datasetSettings.before_label : settings.beforeLabel,
            afterLabel: !!datasetSettings.after_label ? datasetSettings.after_label : settings.afterLabel,
            noOverlay: !!datasetSettings.no_overlay ? datasetSettings.no_overlay : settings.noOverlay,
            sliderOnHover: !!datasetSettings.slider_on_hover ? datasetSettings.slider_on_hover : settings.sliderOnHover,
            sliderWithHandle: !!datasetSettings.slider_with_handle
                ? datasetSettings.slider_with_handle
                : settings.sliderWithHandle,
            sliderWithClick: !!datasetSettings.slider_with_click
                ? datasetSettings.slider_with_click
                : settings.sliderWithClick,
        });
    }
}

registerWidget(Zeus_ImageComparison, "zeus-image-comparison");
