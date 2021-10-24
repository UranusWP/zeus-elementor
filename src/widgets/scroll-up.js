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

class Zeus_ScrollUp extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
        return {
            selectors: {
                scrollBtn: ".zeus-scroll-button a",
                fixedBtn: ".zeus-fixed-yes",
                html: "html",
                body: "body",
            },
        };
    }

    getDefaultElements() {
        const element = this.$element.get(0);
        const selectors = this.getSettings("selectors");

        return {
            scrollBtn: element.querySelector(selectors.scrollBtn),
            fixedBtn: element.querySelector(selectors.fixedBtn),
            html: document.querySelector("html"),
            body: document.body,
        };
    }

    bindEvents() {
        this.elements.scrollBtn.addEventListener("click", this.onScrollBtnClick.bind(this));

        window.addEventListener("scroll", function() {
            var fixedBtn = document.querySelector(".zeus-fixed-yes");

            if (!fixedBtn) {
                return;
            }

            if (window.pageYOffset > 100) {
                if (window.getComputedStyle(fixedBtn).display === "none") {
                    fadeIn(fixedBtn);
                }
            } else if (window.getComputedStyle(fixedBtn).display !== "none") {
                fadeOut(fixedBtn);
            }
        });
    }

    onScrollBtnClick(event) {
        event.preventDefault();

        this.elements.html.scrollTo({
            top: 0,
            behavior: "smooth",
        });

        this.elements.body.scrollTo({
            top: 0,
            behavior: "smooth",
        });

        this.elements.scrollBtn.parentNode.classList.remove("sfHover");
    }
}

registerWidget(Zeus_ScrollUp, "zeus-scroll-up");
