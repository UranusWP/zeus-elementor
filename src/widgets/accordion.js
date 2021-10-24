import { registerWidget } from '../lib/utils';

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
    window.getComputedStyle(element).display === 'none' ? slideDown(element, duration) : slideUp(element, duration);

class Zeus_Accordion extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
        return {
            selectors: {
                accordion: '.zeus-accordion',
                accordionItem: '.zeus-accordion-item',
                accordionTitle: '.zeus-accordion-title',
                accordionContent: '.zeus-accordion-content',
            },
            classes: {
                active: 'zeus-active',
            },
            activeItemIndex: null,
            multiExpand: false,
        };
    }

    getDefaultElements() {
        const element = this.$element.get(0);
        const selectors = this.getSettings('selectors');

        return {
            accordion: element.querySelector(selectors.accordion),
            accordionItems: element.querySelectorAll(selectors.accordionItem),
            accordionTitles: element.querySelectorAll(selectors.accordionTitle),
            accordionContents: element.querySelectorAll(selectors.accordionContent),
        };
    }

    onInit(...args) {
        super.onInit(...args);

        this.setUserSettings();
        this.activateDefaultItem();
    }

    setUserSettings() {
        const settings = this.getSettings();
        const userSettings = JSON.parse(this.elements.accordion.getAttribute('data-settings'));

        this.setSettings({
            activeItemIndex: !!userSettings.active_item ? userSettings.active_item : settings.activeItemIndex,
            multiExpand: !!userSettings.multiple ? JSON.parse(userSettings.multiple) : settings.multiExpand,
        });
    }

    activateDefaultItem() {
        const settings = this.getSettings();
        const selectors = settings.selectors;
        const activeItemIndex = settings.activeItemIndex;
        const activeClass = settings.classes.active;

        if (!activeItemIndex) {
            return;
        }

        const activeAccordionItem = this.elements.accordion.querySelector(
            `${selectors.accordionItem}:nth-child(${activeItemIndex})`
        );

        activeAccordionItem.classList.remove(activeClass);

        this.changeActiveItem(activeAccordionItem);
    }

    bindEvents() {
        this.elements.accordionTitles.forEach((accordionTitle) => {
            accordionTitle.addEventListener('click', this.onTitleClick.bind(this));
        });
    }

    onTitleClick(event) {
        const enableMultiExpand = this.getSettings('multiExpand');
        const accordionTitle = event.currentTarget;
        const accordionItem = accordionTitle.parentNode;

        if (!!enableMultiExpand) {
            this.toggleMultiExpandItem(accordionItem);
        } else {
            this.changeActiveItem(accordionItem);
        }
    }

    toggleMultiExpandItem(accordionItem) {
        const activeClass = this.getSettings('classes.active');
        const accordionContent = this.getAccordionContent(accordionItem);

        accordionItem.classList.toggle(activeClass);
        slideToggle(accordionContent, 300);
    }

    changeActiveItem(accordionItem) {
        if (this.isActiveItem(accordionItem)) {
            this.deactiveItem(accordionItem);
        } else {
            this.elements.accordionItems.forEach((_accordionItem) => {
                if (_accordionItem !== accordionItem) {
                    this.deactiveItem(_accordionItem);
                }
            });

            this.activateItem(accordionItem);
        }
    }

    activateItem(accordionItem) {
        const activeClass = this.getSettings('classes.active');
        const accordionContent = this.getAccordionContent(accordionItem);

        accordionItem.classList.add(activeClass);
        slideDown(accordionContent, 300);
    }

    deactiveItem(accordionItem) {
        const activeClass = this.getSettings('classes.active');
        const accordionContent = this.getAccordionContent(accordionItem);

        accordionItem.classList.remove(activeClass);
        slideUp(accordionContent, 300);
    }

    isActiveItem(accordionItem) {
        return accordionItem.classList.contains(this.getSettings('classes.active'));
    }

    getAccordionContent(accordionItem) {
        return accordionItem.querySelector(this.getSettings('selectors.accordionContent'));
    }
}

registerWidget(Zeus_Accordion, 'zeus-accordion');
