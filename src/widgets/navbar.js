import { registerWidget } from "../lib/utils";

export const slideUp = (element, duration = 300) => {
    element.style.boxSizing = 'border-box';
    element.style.transitionProperty = 'height, margin, padding';
    element.style.transitionDuration = `${duration}ms`;
    element.style.height = `${element.offsetHeight}px`;
    element.style.paddingTop = 0;
    element.style.paddingBottom = 0;
    element.style.marginTop = 0;
    element.style.marginBottom = 0;
    element.style.overflow = 'hidden';

    setTimeout(() => {
        element.style.height = 0;
    }, 10);

    window.setTimeout(() => {
        element.style.display = 'none';
        element.style.removeProperty('height');
        element.style.removeProperty('padding-top');
        element.style.removeProperty('padding-bottom');
        element.style.removeProperty('margin-top');
        element.style.removeProperty('margin-bottom');
        element.style.removeProperty('overflow');
        element.style.removeProperty('transition-duration');
        element.style.removeProperty('transition-property');
    }, duration);
};

export const slideDown = (element, duration = 300) => {
    element.style.removeProperty('display');

    let display = window.getComputedStyle(element).display;

    if (display === 'none') {
        display = 'block';
    }

    element.style.display = display;

    let height = element.offsetHeight;
    let paddingTop = window.getComputedStyle(element).paddingTop;
    let paddingBottom = window.getComputedStyle(element).paddingBottom;
    let marginTop = window.getComputedStyle(element).marginTop;
    let marginBottom = window.getComputedStyle(element).marginBottom;

    element.style.height = 0;
    element.style.paddingTop = 0;
    element.style.paddingBottom = 0;
    element.style.marginTop = 0;
    element.style.marginBottom = 0;
    element.style.overflow = 'hidden';

    element.style.boxSizing = 'border-box';
    element.style.transitionProperty = 'height';
    element.style.transitionDuration = `${duration}ms`;

    setTimeout(() => {
        element.style.height = `${height}px`;
        if (paddingTop !== '0px' || paddingBottom !== '0px') {
            element.style.transitionProperty = 'padding';
            element.style.transitionDuration = `${duration / 1.2}ms`;
            element.style.paddingTop = paddingTop;
            element.style.paddingBottom = paddingBottom;
            element.style.marginTop = marginTop;
            element.style.marginBottom = marginBottom;
        }
    }, 10);

    window.setTimeout(() => {
        element.style.removeProperty('height');
        element.style.removeProperty('overflow');
        element.style.removeProperty('transition-duration');
        element.style.removeProperty('transition-property');
        element.style.removeProperty('padding-top');
        element.style.removeProperty('padding-bottom');
        element.style.removeProperty('margin-top');
        element.style.removeProperty('margin-bottom');
    }, duration);
};

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
