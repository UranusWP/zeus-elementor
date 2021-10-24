export const registerWidget = (className, widgetName, skin = 'default') => {
    if (!(className || widgetName)) {
        return;
    }

    /**
     * Because Elementor plugin uses jQuery custom event,
     * We also have to use jQuery to use this event
     */
    jQuery(window).on('elementor/frontend/init', () => {
        const addHandler = ($element) => {
            elementorFrontend.elementsHandler.addHandler(className, {
                $element,
            });
        };

        elementorFrontend.hooks.addAction(`frontend/element_ready/${widgetName}.${skin}`, addHandler);
    });
};
