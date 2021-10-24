import { registerWidget } from "../lib/utils";

export const slideToggle = (element, duration) =>
    window.getComputedStyle(element).display === "none" ? slideDown(element, duration) : slideUp(element, duration);

class Zeus_Navbar extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
        return {
            selectors: {
                navbar: ".zeus-navbar-wrap",
                offCanvas: ".zeus-off-canvas-wrap",
                offCanvasOpenBtn: ".zeus-off-canvas-button",
                offCanvasCloseElems: ".zeus-off-canvas-close, .zeus-off-canvas-overlay",
                responsiveNavbar: ".zeus-navbar-wrap.zeus-is-responsive ul.zeus-navbar",
                responsiveNavbarOpenBtn: ".zeus-mobile-button",
            },
        };
    }

    getDefaultElements() {
        const element = this.$element.get(0);
        const selectors = this.getSettings("selectors");

        return {
            navbar: element.querySelector(selectors.navbar),
            offCanvas: element.querySelector(selectors.offCanvas),
            offCanvasOpenBtn: element.querySelector(selectors.offCanvasOpenBtn),
            offCanvasCloseElems: element.querySelectorAll(selectors.offCanvasCloseElems),
            responsiveNavbar: element.querySelector(selectors.responsiveNavbar),
            responsiveNavbarOpenBtn: element.querySelector(selectors.responsiveNavbarOpenBtn),
        };
    }

    onInit(...args) {
        super.onInit(...args);

        if (this.isOffCanvasActive()) {
            this.moveModalToEndOfBody();
        }

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
        if (this.isOffCanvasActive()) {
            this.elements.offCanvasOpenBtn.addEventListener("click", this.openOffCanvas.bind(this));
            this.elements.offCanvasCloseElems.forEach((offCanvasCloseElem) => {
                offCanvasCloseElem.addEventListener("click", this.closeOffCanvas.bind(this));
            });
        }

        if (this.isResponsiveNavbarActive()) {
            this.elements.responsiveNavbarOpenBtn.addEventListener("click", this.openResponsiveNavbar.bind(this));
        }
    }

    openOffCanvas(event) {
        event.preventDefault();

        const targetID = this.elements.offCanvasOpenBtn.getAttribute("href");

        document.querySelector(targetID).classList.toggle("show");
    }

    closeOffCanvas(event) {
        const offCanvasCloseElem = event.currentTarget;

        offCanvasCloseElem.closest(".zeus-off-canvas-wrap").classList.remove("show");
    }

    openResponsiveNavbar(event) {
        event.preventDefault();

        slideToggle(this.elements.responsiveNavbar, 500);
        this.elements.responsiveNavbarOpenBtn.classList.toggle("opened");
    }

    isOffCanvasActive() {
        return this.elements.navbar.classList.contains("zeus-has-off-canvas");
    }

    isResponsiveNavbarActive() {
        return this.elements.navbar.classList.contains("zeus-is-responsive");
    }
}

registerWidget(Zeus_Navbar, "zeus-navbar");
