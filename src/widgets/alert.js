import { registerWidget } from "../lib/utils";

export const fadeOut = (element, speed = "normal", display, callback = null) => {
    element.style.opacity = 1;
    element.style.display = display || "block";

    const fade = () => {
        let opacity = parseFloat(element.style.opacity);

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

class Zeus_Alert extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
        return {
            selectors: {
                alert: ".zeus-alert",
                alertCloseBtn: ".zeus-alert-close-btn",
            },
        };
    }

    getDefaultElements() {
        const element = this.$element.get(0);
        const selectors = this.getSettings("selectors");

        return {
            alert: element.querySelector(selectors.alert),
            alertCloseBtn: element.querySelector(selectors.alertCloseBtn),
        };
    }

    bindEvents() {
        this.elements.alertCloseBtn?.addEventListener("click", this.onCloseBtnClick.bind(this));
    }

    onCloseBtnClick(event) {
        fadeOut(this.elements.alert);
    }
}

registerWidget(Zeus_Alert, "zeus-alert");
