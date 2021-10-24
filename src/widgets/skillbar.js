import { registerWidget } from "../lib/utils";

class Zeus_Skillbar extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
        return {
            selectors: {
                skillbar: ".zeus-skillbar",
                skillbarBar: ".zeus-skillbar-bar",
            },
        };
    }

    getDefaultElements() {
        const element = this.$element.get(0);
        const selectors = this.getSettings("selectors");

        return {
            skillbar: element.querySelector(selectors.skillbar),
            skillbarBar: element.querySelector(selectors.skillbarBar),
        };
    }

    onInit(...args) {
        super.onInit(...args);

        this.observer();
    }

    initProgress() {
        const skillbarPercentage = this.elements.skillbar.dataset.percent;

        this.elements.skillbarBar.style.transition = "width 0.8s ease";
        this.elements.skillbarBar.style.width = skillbarPercentage;
    }

    observer() {
        const observer = new IntersectionObserver(this.observerCallback.bind(this), {
            threshold: 1,
        });

        observer.observe(this.elements.skillbar);
    }

    observerCallback(entries, observer) {
        const entry = entries[0];

        if (!entry.isIntersecting) {
            return;
        }

        this.initProgress();

        observer.unobserve(entry.target);
    }
}

registerWidget(Zeus_Skillbar, "zeus-skillbar");
