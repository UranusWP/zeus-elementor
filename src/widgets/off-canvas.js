import { registerWidget } from "../lib/utils";

class Zeus_OffCanvas extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
        return {
            selectors: {
                offCanvas: ".zeus-off-canvas-wrap",
                offCanvasOpenBtn: ".zeus-off-canvas-button a",
                offCanvasCloseElems: ".zeus-off-canvas-close, .zeus-off-canvas-overlay",
            },
        };
    }

    getDefaultElements() {
        const element = this.$element.get(0);
        const selectors = this.getSettings("selectors");

        return {
            offCanvas: element.querySelector(selectors.offCanvas),
            offCanvasOpenBtn: element.querySelector(selectors.offCanvasOpenBtn),
            offCanvasCloseElems: element.querySelectorAll(selectors.offCanvasCloseElems),
        };
    }

    onInit(...args) {
        super.onInit(...args);

        this.moveModalToEndOfBody();
        this.setupEventListeners();
    }

    moveModalToEndOfBody() {
        document.querySelectorAll(`#zeus-off-canvas-${this.getID()}`).forEach((offCanvas) => {
            if (this.elements.offCanvas !== offCanvas) {
                offCanvas.remove();
            }
        });

        document.body.insertAdjacentElement("beforeend", this.elements.offCanvas);
    }

    setupEventListeners() {
        this.elements.offCanvasOpenBtn?.addEventListener("click", this.openCanvas.bind(this));

        this.elements.offCanvasCloseElems?.forEach((offCanvasCloseElem) => {
            offCanvasCloseElem.addEventListener("click", this.closeCanvas.bind(this));
        });
    }

    openCanvas(event) {
        event.preventDefault();

        const targetID = this.elements.offCanvasOpenBtn.getAttribute("href");
        const offCanvas = document.querySelector(targetID);

        offCanvas.classList.toggle("show");
    }

    closeCanvas(event) {
        const offCanvasCloseElem = event.currentTarget;

        offCanvasCloseElem.closest(".zeus-off-canvas-wrap").classList.remove("show");
    }
}

registerWidget(Zeus_OffCanvas, "zeus-off-canvas");
