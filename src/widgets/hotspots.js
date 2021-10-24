import { registerWidget } from "../lib/utils";

class Zeus_Hotspots extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
        return {
            selectors: {
                hotspots: ".zeus-hotspot-inner",
            },
            toolTip: {
                fadeInDuration: 200,
                fadeOutDuration: 100,
            },
        };
    }

    getDefaultElements() {
        const element = this.$element.get(0);
        const selectors = this.getSettings("selectors");

        return {
            hotspots: element.querySelectorAll(selectors.hotspots),
        };
    }

    onInit(...args) {
        super.onInit(...args);

        if (Array.from(this.elements.hotspots).some(({ classList }) => classList.contains("zeus-hotspot-tooltip"))) {
            this.setUserSettings();
            this.initTippyTooltip();
        }
    }

    initTippyTooltip() {
        const settings = this.getSettings();
        const self = this;

        this.elements.hotspots.forEach((hotspot) => {
            if (!hotspot.classList.contains("zeus-hotspot-tooltip")) {
                return;
            }

            tippy(hotspot, {
                allowHTML: true,
                duration: [settings.tooltip.fadeInDuration, settings.tooltip.fadeOutDuration],
                content: (reference) => reference.getAttribute("title"),
                placement: self.getTippyTooltipPlacement(hotspot.classList),
                onMount: (instance) => {
                    instance.popper.classList.add(`zeus-hotspot-powertip-${self.getID()}`);
                },
            });
        });
    }

    getTippyTooltipPlacement(classList) {
        switch (true) {
            case classList.contains("zeus-tooltip-n"):
                return "top";
                break;
            case classList.contains("zeus-tooltip-ne-alt"):
                return "top-start";
                break;
            case classList.contains("zeus-tooltip-ne"):
                return "top-end";
                break;
            case classList.contains("zeus-tooltip-e"):
                return "right";
                break;
            case classList.contains("zeus-tooltip-se-alt"):
                return "right-start";
                break;
            case classList.contains("zeus-tooltip-se"):
                return "right-end";
                break;
            case classList.contains("zeus-tooltip-s"):
                return "bottom";
                break;
            case classList.contains("zeus-tooltip-sw-alt"):
                return "bottom-start";
                break;
            case classList.contains("zeus-tooltip-sw"):
                return "bottom-end";
                break;
            case classList.contains("zeus-tooltip-w"):
                return "left";
                break;
            case classList.contains("zeus-tooltip-nw-alt"):
                return "left-start";
                break;
            case classList.contains("zeus-tooltip-nw"):
                return "left-end";
                break;

            default:
                return "top";
                break;
        }
    }

    setUserSettings() {
        const settings = this.getSettings();
        const elementSettings = this.getElementSettings();

        this.setSettings({
            tooltip: {
                fadeInDuration: !!elementSettings.fade_in_time.size
                    ? elementSettings.fade_in_time.size
                    : settings.tooltip.fadeInDuration,

                fadeOutDuration: !!elementSettings.fade_out_time.size
                    ? elementSettings.fade_out_time.size
                    : settings.tooltip.fadeOutDuration,
            },
        });
    }
}

registerWidget(Zeus_Hotspots, "zeus-hotspots");
