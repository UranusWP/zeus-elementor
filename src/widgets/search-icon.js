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

export const fadeToggle = (element, speed = "normal", display, callback = null) =>
    window.getComputedStyle(element).display === "none"
        ? fadeIn(element, speed, display, callback)
        : fadeOut(element, speed, display, callback);

class Zeus_SearchIcon extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
        return {
            selectors: {
                dropdownSearch: ".zeus-search-dropdown",
                dropdownSearchIcon: ".zeus-search-icon-dropdown",
                dropdownSearchIconLink: ".zeus-dropdown-link",
                dropdownSearchInput: ".zeus-search-dropdown input.field",
                overlaySearch: ".zeus-search-overlay",
                overlaySearchForm: ".zeus-search-overlay form",
                overlaySearchIcon: ".zeus-search-icon-overlay",
                overlaySearchIconLink: "a.zeus-overlay-link",
                overlaySearchInput: "input.zeus-search-overlay-input",
                overlaySearchCloseBtn: "a.zeus-search-overlay-close",
            },
        };
    }

    getDefaultElements() {
        const element = this.$element.get(0);
        const selectors = this.getSettings("selectors");

        return {
            dropdownSearch: element.querySelector(selectors.dropdownSearch),
            dropdownSearchIcon: element.querySelector(selectors.dropdownSearchIcon),
            dropdownSearchIconLink: element.querySelector(selectors.dropdownSearchIconLink),
            dropdownSearchInput: element.querySelector(selectors.dropdownSearchInput),
            overlaySearch: element.querySelector(selectors.overlaySearch),
            overlaySearchForm: element.querySelector(selectors.overlaySearchForm),
            overlaySearchIcon: element.querySelector(selectors.overlaySearchIcon),
            overlaySearchIconLink: element.querySelector(selectors.overlaySearchIconLink),
            overlaySearchInput: element.querySelector(selectors.overlaySearchInput),
            overlaySearchCloseBtn: element.querySelector(selectors.overlaySearchCloseBtn),
        };
    }

    onInit(...args) {
        super.onInit(...args);

        if (this.getSearchType() === "overlay") {
            this.initOverlaySearch();
        }

        this.setupEventListeners();
    }

    initOverlaySearch() {
        document.querySelectorAll(`#zeus-search-${this.getID()}`).forEach((overlaySearch) => {
            if (this.elements.overlaySearch !== overlaySearch) {
                overlaySearch.remove();
            }
        });

        document.body.insertAdjacentElement("beforeend", this.elements.overlaySearch);

        if (this.elements.overlaySearchInput.value.length) {
            this.elements.overlaySearchForm.classList.add("search-filled");
        }
    }

    setupEventListeners() {
        if (this.getSearchType() === "overlay") {
            this.elements.overlaySearchIconLink.addEventListener("click", this.openOverlaySearch.bind(this));
            this.elements.overlaySearchCloseBtn.addEventListener("click", this.closeOverlaySearch.bind(this));
            this.elements.overlaySearchInput.addEventListener("keyup", this.toggleInputPlaceholder.bind(this));
            this.elements.overlaySearchInput.addEventListener("blur", this.toggleInputPlaceholder.bind(this));
        } else {
            this.elements.dropdownSearchIconLink.addEventListener("click", this.toggleDropdownSearch.bind(this));
            document.addEventListener("click", this.onDocumentClick.bind(this));
        }
    }

    toggleDropdownSearch(event) {
        event.preventDefault();
        event.stopPropagation();

        fadeToggle(this.elements.dropdownSearch, "fast");
        this.elements.dropdownSearchIcon.classList.toggle("active");
        this.elements.dropdownSearchInput.focus();
    }

    openOverlaySearch(event) {
        event.preventDefault();

        this.elements.overlaySearch.classList.add("active");
        fadeIn(this.elements.overlaySearch, "fast");
        this.elements.overlaySearchInput.focus();

        setTimeout(() => {
            document.querySelector("html").style.overflow = "hidden";
        }, 400);
    }

    closeOverlaySearch(event) {
        event.preventDefault();

        this.elements.overlaySearch.classList.remove("active");
        fadeOut(this.elements.overlaySearch, "fast");

        setTimeout(() => {
            document.querySelector("html").style.overflow = "visible";
        }, 400);
    }

    toggleInputPlaceholder(event) {
        if (this.elements.overlaySearchInput.value.length > 0) {
            this.elements.overlaySearchForm.classList.add("search-filled");
        } else {
            this.elements.overlaySearchForm.classList.remove("search-filled");
        }
    }

    onDocumentClick(event) {
        // Close Dropdown Search
        if (!event.target.closest(this.getSettings("selectors.dropdownSearch"))) {
            this.elements.dropdownSearchIcon.classList.remove("show");
            fadeOut(this.elements.dropdownSearch, "fast");
        }
    }

    getSearchType() {
        return !!this.elements.overlaySearchIcon ? "overlay" : "dropdown";
    }
}

registerWidget(Zeus_SearchIcon, "zeus-search-icon");
