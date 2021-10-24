import { registerWidget } from "../lib/utils";

export const fadeIn = (element, speed = "normal", display, callback = null) => {
    element.style.opacity = 0;
    element.style.display = display || "block";

    const fade = () => {
        let opacity = parseFloat(element.style.opacity);

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

class Zeus_Modal extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
        return {
            selectors: {
                modal: ".zeus-modal-wrap",
                openModalButton: ".zeus-modal-button a",
                closeModalElements: ".zeus-modal-close, .zeus-modal-overlay",
            },
        };
    }

    getDefaultElements() {
        const element = this.$element.get(0);
        const selectors = this.getSettings("selectors");

        return {
            modal: element.querySelector(selectors.modal),
            openModalButton: element.querySelector(selectors.openModalButton),
            closeModalElements: element.querySelectorAll(selectors.closeModalElements),
            body: document.body,
            html: document.querySelector("html"),
        };
    }

    onInit(...args) {
        super.onInit(...args);

        this.moveModalToEndOfBody();
        this.setupEventListeners();
    }

    moveModalToEndOfBody() {
        document.querySelectorAll(`#zeus-modal-${this.getID()}`).forEach((modal) => {
            if (this.elements.modal !== modal) {
                modal.remove();
            }
        });

        document.body.insertAdjacentElement("beforeend", this.elements.modal);
    }

    setupEventListeners() {
        this.elements.openModalButton?.addEventListener("click", this.openModal.bind(this));
        this.elements.closeModalElements?.forEach((closeModalElement) => {
            closeModalElement.addEventListener("click", this.closeModal.bind(this));
        });
    }

    openModal(event) {
        event.preventDefault();

        const openModalButton = event.currentTarget;
        const targetID = openModalButton.getAttribute("href");
        const modal = document.querySelector(targetID);

        const initialHTMLInnerWidth = this.elements.html.innerWidth;
        this.elements.html.style.overflow = "hidden";
        const afterInitialHTMLInnerWidth = this.elements.html.innerWidth;
        this.elements.html.style.marginRight = afterInitialHTMLInnerWidth - initialHTMLInnerWidth + "px";

        fadeIn(modal);
    }

    closeModal(event) {
        const closeModalElements = event.currentTarget;
        const modal = closeModalElements.closest(".zeus-modal-wrap");

        this.elements.html.style.overflow = "";
        this.elements.html.style.marginRight = "";

        fadeOut(modal);
    }
}

registerWidget(Zeus_Modal, "zeus-modal");
