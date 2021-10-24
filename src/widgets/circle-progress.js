import { registerWidget } from "../lib/utils";

class Zeus_CircleProccess extends elementorModules.frontend.handlers.Base {
    pieProgress;

    getDefaultSettings() {
        return {
            selectors: {
                circleProgress: ".zeus-circle-progress",
            },
        };
    }

    getDefaultElements() {
        const element = this.$element.get(0);
        const selectors = this.getSettings("selectors");

        return {
            circleProgress: element.querySelector(selectors.circleProgress),
            $circleProgress: this.$element.find(selectors.circleProgress),
        };
    }

    onInit(...args) {
        super.onInit(...args);

        this.registerPieProgress();
        this.observer();
    }

    registerPieProgress() {
        this.elements.$circleProgress.asPieProgress({
            namespace: "pieProgress",
            classes: {
                svg: "zeus-circle-progress-svg",
                number: "zeus-circle-progress-number",
                content: "zeus-circle-progress-content",
            },
        });
    }

    initPieProgress() {
        this.elements.$circleProgress.asPieProgress("start");
    }

    observer() {
        const observer = new IntersectionObserver(this.observerCallback.bind(this), {
            threshold: 0.65,
        });

        observer.observe(this.elements.circleProgress);
    }

    observerCallback(entries, observer) {
        const entry = entries[0];

        if (!entry.isIntersecting) {
            return;
        }

        this.initPieProgress();

        observer.unobserve(entry.target);
    }
}

registerWidget(Zeus_CircleProccess, "zeus-circle-progress");
