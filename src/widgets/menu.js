import { registerWidget } from '../lib/utils';

export const navFadeIn = (element, _options = {}) => {
    const options = {
        duration: 300,
        display: null,
        opacity: 1,
        callback: null,
    };

    Object.assign(options, _options);

    element.style.opacity = 0;
    element.style.display = options.display || "block";

    setTimeout(() => {
        element.style.transition = `${options.duration}ms opacity ease`;
        element.style.opacity = options.opacity;
    }, 5);

    setTimeout(() => {
        element.style.removeProperty("transition");
        !!options.callback && options.callback();
    }, options.duration + 50);
};

export const navFadeOut = (element, _options = {}) => {
    const options = {
        duration: 300,
        display: null,
        opacity: 0,
        callback: null,
    };

    Object.assign(options, _options);

    element.style.opacity = 1;
    element.style.display = options.display || "block";

    setTimeout(() => {
        element.style.transition = `${options.duration}ms opacity ease`;
        element.style.opacity = options.opacity;
    }, 5);

    setTimeout(() => {
        element.style.display = "none";
        element.style.removeProperty("transition");
        !!options.callback && options.callback();
    }, options.duration + 50);
};

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

class Zeus_Menu extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
        return {
            selectors: {
                menuWrapper: '.zeus-menu-wrapper',
                hMenu: '.zeus-menu-layout-horizontal .zeus-menu',
                menuToggle: '.zeus-menu-toggle',
                menuToggleIcon: '.zeus-menu-toggle-icon',
                dropdownMenu: '.zeus-menu-toggle-dropdown',
                subDropdown: '.zeus-menu-layout-vertical .zeus-sub-icon, .zeus-dropdown-menu .zeus-sub-icon',
                dropdownSearch: '.zeus-searchform-menu',
                dropdownSearchLink: '.zeus-search-menu-item',
                dropdownSearchInput: '.zeus-searchform-menu input.field',
            },
        };
    }

    getDefaultElements() {
        const element = this.$element.get(0);
        const selectors = this.getSettings('selectors');

        return {
            menuWrapper: element.querySelector(selectors.menuWrapper),
            hMenu: element.querySelectorAll(selectors.hMenu),
            menuToggle: element.querySelector(selectors.menuToggle),
            menuToggleIcon: element.querySelector(selectors.menuToggleIcon),
            dropdownMenu: element.querySelector(selectors.dropdownMenu),
            subDropdown: element.querySelectorAll(selectors.subDropdown),
            dropdownSearch: element.querySelector(selectors.dropdownSearch),
            dropdownSearchLink: element.querySelector(selectors.dropdownSearchLink),
            dropdownSearchInput: element.querySelector(selectors.dropdownSearchInput),
        };
    }

    onInit(...args) {
        super.onInit(...args);

        this.setupEventListeners();
        this.fullWidthDropdown();
    }

    setupEventListeners() {
        // Open dropdown of parent menu on hover only for the horizontal layout
        this.elements.hMenu.forEach((menu) => {
            var parentMenuItems = menu.querySelectorAll('.menu-item-has-children');
            parentMenuItems.forEach((parentMenuItem) => {
                parentMenuItem.addEventListener('mouseenter', this.onParentMenuItemMouseenter.bind(this));
                parentMenuItem.addEventListener('mouseleave', this.onParentMenuItemMouseleave.bind(this));
            });
        });

        // If dropdown
        var dropdownMenu = this.elements.dropdownMenu;
        if ( dropdownMenu ) {
            // Dropdown toggle
            this.elements.menuToggleIcon.addEventListener('click', this.onToggleClick.bind(this));

            // Open submenu on dropdown toggle
            this.elements.subDropdown.forEach((toggle) => {
                toggle.setAttribute('aria-expanded', 'false');

                toggle.onclick = function () {
                    if (toggle.getAttribute('aria-expanded') === 'true') {
                        toggle.setAttribute('aria-expanded', 'false');
                        toggle.parentNode.classList.remove('zeus-dropdown-open');
                        return;
                    }

                    toggle.setAttribute('aria-expanded', 'true');
                    toggle.parentNode.classList.add('zeus-dropdown-open');
                    return;
                }
            });
        }

        // Open search form
        var searchLink = this.elements.dropdownSearchLink;
        if ( searchLink ) {
            searchLink.addEventListener('click', this.toggleDropdownSearch.bind(this));
        }


        if ( dropdownMenu ) {
            // Full width dropdown
            window.addEventListener('resize', this.fullWidthDropdown.bind(this));
            window.addEventListener('orientationchange', this.fullWidthDropdown.bind(this));
        }

        // Close elements when clicking elsewhere
        document.addEventListener('click', this.onDocumentClick.bind(this));

        // On sticky
        if (!document.querySelector('body').classList.contains('elementor-editor-active')
            && 'yes' === this.getElementSettings('is_sticky')) {
            this.onSticky();
        }

    }

    onParentMenuItemMouseenter(event) {
        var parentMenuItem = event.currentTarget;
        var subMenu = parentMenuItem.querySelector('ul.sub-menu');

        parentMenuItem.classList.add('sub-hover');

        navFadeIn(subMenu);
    }

    onParentMenuItemMouseleave(event) {
        var parentMenuItem = event.currentTarget;
        var subMenu = parentMenuItem.querySelector('ul.sub-menu');

        parentMenuItem.classList.remove('sub-hover');
        subMenu.style.pointerEvents = 'none';

        navFadeOut(subMenu, {
            callback: () => {
                subMenu.style.pointerEvents = null;
            },
        });
    }

    onToggleClick(event) {
        event.stopPropagation();
        this.elements.menuToggle.classList.toggle('zeus-active');
    }

    toggleDropdownSearch(event) {
        event.preventDefault();
        event.stopPropagation();

        fadeToggle(this.elements.dropdownSearch, 'fast');
        this.elements.dropdownSearchInput.focus();
    }

    fullWidthDropdown(event) {
        var dropdownMenu = this.elements.dropdownMenu;
        if ( dropdownMenu ) {
            this.stretchElement = new elementorModules.frontend.tools.StretchElement({
              element: dropdownMenu
            });

            if (this.getElementSettings('dropdown_full_width')) {
                this.stretchElement.stretch();
            } else {
                this.stretchElement.reset();
            }
        }
    }

    onSticky() {
        const menuWrapper = this.elements.menuWrapper;

        if (menuWrapper.hasAttribute('data-destroy-sticky')) {
            const destroyWidth = menuWrapper.getAttribute('data-destroy-sticky');

            if (window.innerWidth < destroyWidth) {
                return;
            }
        }

        var selector = menuWrapper.closest('.elementor-top-section'),
            top = selector.offsetTop;

        // Add sticky class
        selector.classList.add('zeus-has-sticky');

        // Add wrapper
        selector.insertAdjacentHTML('beforebegin', '<span class="zeus-sticky-wrapper"></span>');
        selector.previousSibling.appendChild(selector);

        function onScroll() {

            // Admin bar offset
            var barOffset = 0;
            if (document.querySelector('body').classList.contains('admin-bar') && window.innerWidth > 600) {
                barOffset = document.getElementById('wpadminbar').offsetHeight;
            }

            if ( window.pageYOffset > top ) {
                selector.style.position = 'fixed';
                selector.style.width = '100%';
                selector.style.top = barOffset + 'px';
                selector.style.backgroundColor = menuWrapper.getAttribute('data-background');
                selector.style.zIndex = '9999';

                menuWrapper.classList.add('zeus-is-sticky');

                if ( menuWrapper.classList.contains('zeus-has-shadow') ) {
                    selector.classList.add('zeus-sticky-shadow');
                }
            } else {
                selector.style.position = '';
                selector.style.width = '';
                selector.style.top = '';
                selector.style.backgroundColor = '';
                selector.style.zIndex = '';

                menuWrapper.classList.remove('zeus-is-sticky');

                if ( menuWrapper.classList.contains('zeus-has-shadow') ) {
                    selector.classList.remove('zeus-sticky-shadow');
                }
            }

        }

        window.addEventListener('scroll', onScroll);
        window.addEventListener('resize', onScroll);
        window.addEventListener('orientationchange', onScroll);

        function wrapperStyle() {
            selector.parentNode.style.display = 'block';
            selector.parentNode.style.width = window.innerWidth + 'px';
            selector.parentNode.style.height = selector.offsetHeight + 'px';
        }

        window.addEventListener('load', wrapperStyle);
        window.addEventListener('resize', wrapperStyle);
        window.addEventListener('orientationchange', wrapperStyle);

        // Anchor links
        document.querySelectorAll('.zeus-menu-wrapper a[href*="#"]:not([href="#"])').forEach((link) => {
            link.addEventListener('click', function(e) {
                
                const href = link.getAttribute('href');
                const id = href.substring(href.indexOf('#')).slice(1);

                // Check selector
                const validSelector = ((dummyElement) => (selector) => {
                    try {
                        dummyElement.querySelector(selector);
                    } catch {
                        return false;
                    }
                    return true;
                });

                if (validSelector('#' + id)) {
                   var targetElem = document.querySelector('#' + id);
                }

                if ( '' !== id && !! targetElem ) {
                    e.preventDefault();
                    e.stopPropagation();

                    let scrollPosition = targetElem.offsetTop - selector.offsetHeight;

                    document.querySelector('html').scrollTo({
                        top: scrollPosition,
                        behavior: 'smooth',
                    });
                }

            });
        });

        // Go top link
        var goTopLink = document.querySelector('.zeus-menu-wrapper a[href="#go-top"]'),
            goTopLinkSlash = document.querySelector('.zeus-menu-wrapper a[href="/#go-top"]');

        if ( goTopLink ) {
            goTopLink.addEventListener('click', goTop);
        }

        if ( goTopLinkSlash ) {
            goTopLinkSlash.addEventListener('click', goTop);
        }

        function goTop(e) {
            e.preventDefault();
                
            document.querySelector('html').scrollTo({
                top: 0,
                behavior: 'smooth',
            });
        }
    }

    onDocumentClick(event) {
        var searchLink = this.elements.dropdownSearchLink;
        if ( searchLink && !event.target.closest(this.getSettings('selectors.dropdownSearch')) ) {
            var searchForm = this.elements.dropdownSearch;

            const fade = () => {
                let opacity = parseFloat(searchForm.style.opacity);

                if ((opacity -= 0.1) < 0) {
                    searchForm.style.display = 'none';
                } else {
                    searchForm.style.opacity = opacity;

                    window.requestAnimationFrame(fade);
                }
            };

            window.requestAnimationFrame(fade);
        }

        var menuToggle = this.elements.menuToggle;
        if (menuToggle && !event.target.closest(this.getSettings('selectors.menuToggle'))) {
            menuToggle.classList.remove('zeus-active');
        }
    }
}

registerWidget(Zeus_Menu, 'zeus-menu');