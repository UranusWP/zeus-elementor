import { registerWidget } from "../lib/utils";

class Zeus_Tabs extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
        return {
            selectors: {
                tabs: ".zeus-tabs",
                tabTitle: ".zeus-tab-title",
                tabContent: ".zeus-tab-content",
            },
        };
    }

    getDefaultElements() {
        const element = this.$element.get(0);
        const selectors = this.getSettings("selectors");

        return {
            tabs: element.querySelector(selectors.tabs),
            tabTitles: element.querySelectorAll(selectors.tabTitle),
            tabContents: element.querySelectorAll(selectors.tabContent),
        };
    }

    onInit(...args) {
        super.onInit(...args);

        this.setUserSettings();
        this.initTabs();
        this.setupEventListeners();
    }

    initTabs() {
        const settings = this.getSettings();
        const activeTab = !!settings.active_item ? settings.active_item : 1;

        this.elements.tabs.querySelector(`.zeus-tab-title[data-tab="${activeTab}"]`).classList.add("zeus-active");
        this.elements.tabs.querySelector(`#zeus-tab-content-${activeTab}`).classList.add("zeus-active");
    }

    setupEventListeners() {
        this.elements.tabTitles.forEach((tabTitle) => {
            tabTitle.addEventListener("click", this.openTab.bind(this));
        });
    }

    openTab(event) {
        event.preventDefault();

        const activeTab = event.currentTarget.dataset.tab;

        this.elements.tabTitles.forEach((tabTitle) => {
            tabTitle.classList.remove("zeus-active");
        });

        this.elements.tabContents.forEach((tabContent) => {
            tabContent.classList.remove("zeus-active");
        });

        this.elements.tabs.querySelector(`.zeus-tab-title[data-tab="${activeTab}"]`).classList.add("zeus-active");
        this.elements.tabs.querySelector(`#zeus-tab-content-${activeTab}`).classList.add("zeus-active");
    }

    setUserSettings() {
        const elementSettings = this.getElementSettings();

        this.setSettings(elementSettings);
    }
}

registerWidget(Zeus_Tabs, "zeus-tabs");
