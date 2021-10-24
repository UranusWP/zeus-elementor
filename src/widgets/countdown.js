import { registerWidget } from "../lib/utils";

class Zeus_CountDown extends elementorModules.frontend.handlers.Base {
    days;
    hours;
    minutes;
    seconds;
    timeRemaining;
    countDownIntervalID;

    getDefaultSettings() {
        return {
            selectors: {
                countDown: ".zeus-countdown-wrap",
                countDownDays: ".zeus-countdown-days",
                countDownHours: ".zeus-countdown-hours",
                countDownMinutes: ".zeus-countdown-minutes",
                countDownSeconds: ".zeus-countdown-seconds",
            },
            date: null,
        };
    }

    getDefaultElements() {
        const element = this.$element.get(0);
        const selectors = this.getSettings("selectors");

        return {
            countDown: element.querySelector(selectors.countDown),
            countDownDays: element.querySelector(selectors.countDownDays),
            countDownHours: element.querySelector(selectors.countDownHours),
            countDownMinutes: element.querySelector(selectors.countDownMinutes),
            countDownSeconds: element.querySelector(selectors.countDownSeconds),
        };
    }

    onInit(...args) {
        super.onInit(...args);

        this.setUserSettings();

        if (this.getSettings("date")) {
            this.initCountdown();
        }
    }

    setUserSettings() {
        const dateNumber = Number(this.elements.countDown.getAttribute("data-date"));

        if (dateNumber !== 0) {
            this.setSettings({
                date: new Date(dateNumber * 1000),
            });
        }
    }

    initCountdown() {
        this.updateDOM();

        const intervalID = setInterval(this.updateDOM.bind(this), 1000);

        this.countDownIntervalID = intervalID;
    }

    updateDOM() {
        this.getTime();

        if (!!this.elements.countDownDays) {
            this.elements.countDownDays.innerHTML = String(this.days).padStart(2, "0");
        }

        if (!!this.elements.countDownHours) {
            this.elements.countDownHours.innerHTML = String(this.hours).padStart(2, "0");
        }

        if (!!this.elements.countDownMinutes) {
            this.elements.countDownMinutes.innerHTML = String(this.minutes).padStart(2, "0");
        }

        if (!!this.elements.countDownSeconds) {
            this.elements.countDownSeconds.innerHTML = String(this.seconds).padStart(2, "0");
        }

        if (this.timeRemaining <= 0 && this.countDownIntervalID) {
            clearInterval(this.countDownIntervalID);
        }
    }

    getTime() {
        this.setTimeRemaining();
        this.setDays();
        this.setHours();
        this.setMinutes();
        this.setSeconds();
    }

    setTimeRemaining() {
        const now = new Date();

        this.timeRemaining = this.getSettings("date") - now;
    }

    setDays() {
        this.days = Number(this.timeRemaining) > 0 ? Math.floor(this.timeRemaining / (1000 * 60 * 60 * 24)) : 0;
    }

    setHours() {
        this.hours = Number(this.timeRemaining) > 0 ? Math.floor((this.timeRemaining / (1000 * 60 * 60)) % 24) : 0;
    }

    setMinutes() {
        this.minutes = Number(this.timeRemaining) > 0 ? Math.floor((this.timeRemaining / 1000 / 60) % 60) : 0;
    }

    setSeconds() {
        this.seconds = Number(this.timeRemaining) > 0 ? Math.floor((this.timeRemaining / 1000) % 60) : 0;
    }
}

registerWidget(Zeus_CountDown, "zeus-countdown");
