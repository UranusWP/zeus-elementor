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

export const slideUp = (element, duration = 300) => {
    element.style.boxSizing = "border-box";
    element.style.transitionProperty = "height, margin, padding";
    element.style.transitionDuration = `${duration}ms`;
    element.style.height = `${element.offsetHeight}px`;
    element.style.paddingTop = 0;
    element.style.paddingBottom = 0;
    element.style.marginTop = 0;
    element.style.marginBottom = 0;
    element.style.overflow = "hidden";

    setTimeout(() => {
        element.style.height = 0;
    }, 10);

    window.setTimeout(() => {
        element.style.display = "none";
        element.style.removeProperty("height");
        element.style.removeProperty("padding-top");
        element.style.removeProperty("padding-bottom");
        element.style.removeProperty("margin-top");
        element.style.removeProperty("margin-bottom");
        element.style.removeProperty("overflow");
        element.style.removeProperty("transition-duration");
        element.style.removeProperty("transition-property");
    }, duration);
};

export const slideDown = (element, duration = 300) => {
    element.style.removeProperty("display");

    let display = window.getComputedStyle(element).display;

    if (display === "none") {
        display = "block";
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
    element.style.overflow = "hidden";

    element.style.boxSizing = "border-box";
    element.style.transitionProperty = "height";
    element.style.transitionDuration = `${duration}ms`;

    setTimeout(() => {
        element.style.height = `${height}px`;
        if (paddingTop !== "0px" || paddingBottom !== "0px") {
            element.style.transitionProperty = "padding";
            element.style.transitionDuration = `${duration / 1.2}ms`;
            element.style.paddingTop = paddingTop;
            element.style.paddingBottom = paddingBottom;
            element.style.marginTop = marginTop;
            element.style.marginBottom = marginBottom;
        }
    }, 10);

    window.setTimeout(() => {
        element.style.removeProperty("height");
        element.style.removeProperty("overflow");
        element.style.removeProperty("transition-duration");
        element.style.removeProperty("transition-property");
        element.style.removeProperty("padding-top");
        element.style.removeProperty("padding-bottom");
        element.style.removeProperty("margin-top");
        element.style.removeProperty("margin-bottom");
    }, duration);
};

class Zeus_Search extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
        return {
            selectors: {
                search: ".zeus-search-wrap",
                searchForm: "form.zeus-searchform",
                searchInput: ".zeus-searchform input.field",
                searchResults: ".zeus-search-results",
                searchLoadingSpinner: ".zeus-search-wrap .zeus-ajax-loading",
            },
            ajaxSearchTimeoutID: null,
        };
    }

    getDefaultElements() {
        const element = this.$element.get(0);
        const selectors = this.getSettings("selectors");

        return {
            search: element.querySelector(selectors.search),
            searchForm: element.querySelector(selectors.searchForm),
            searchInput: element.querySelector(selectors.searchInput),
            searchResults: element.querySelector(selectors.searchResults),
            searchLoadingSpinner: element.querySelector(selectors.searchLoadingSpinner),
        };
    }

    bindEvents() {
        this.elements.searchInput?.addEventListener("keyup", this.onAjaxSearch.bind(this));
        this.elements.searchForm?.addEventListener("submit", this.onSearchFormSubmit.bind(this));
        this.elements.searchForm?.addEventListener("click", this.onSearchFormClick.bind(this));
        document.addEventListener("click", this.onDocumentClick.bind(this));
    }

    onAjaxSearch(event) {
        var sInput      = this.elements.searchInput,
            sValue      = this.elements.searchInput.value,
            sResult     = this.elements.searchResults,
            sSpinner    = this.elements.searchLoadingSpinner;

        clearTimeout(this.getSettings("ajaxSearchTimeoutID"));

        if (sValue.length > 2) {
            const ajaxSearchTimeoutID = setTimeout(() => {
                const httpRequest   = new XMLHttpRequest();
                const formData      = new FormData();
                formData.append("action", "zeus_ajax_search");
                formData.append("nonce", searchData.nonce);
                formData.append("search", sValue);
                formData.append("type", sInput.getAttribute('data-type'));

                httpRequest.onreadystatechange = function() {
                    if (this.readyState === 4 && this.status === 200) {
                        sResult.innerHTML = this.responseText;
                        fadeIn(sSpinner, "fast");

                        setTimeout(() => {
                            slideDown(sResult, 400);
                            sResult.classList.add("filled");
                            fadeOut(sSpinner, "fast");
                        }, 200);
                    }
                };

                httpRequest.open("POST", searchData.ajax_url, true);
                httpRequest.send(formData);
            }, 400);

            this.setSettings({
                ajaxSearchTimeoutID: ajaxSearchTimeoutID,
            });

        }
    }

    onSearchFormSubmit(event) {
        event.preventDefault();
    }

    onSearchFormClick(event) {
        const searchResults = this.elements.search.querySelector(`${this.getSettings("selectors.searchResults")}.filled`);

        if (searchResults) {
            slideDown(searchResults, 400);
        }
    }

    onDocumentClick(event) {
        // Close search results
        const searchArea = event.target.closest(this.getSettings("selectors.searchForm"));
        const searchResultsArea = event.target.closest(this.getSettings("selectors.searchResults"));

        if (!(searchArea || searchResultsArea)) {
            slideUp(this.elements.searchResults, 200);
        }
    }
}

registerWidget(Zeus_Search, "zeus-search");
