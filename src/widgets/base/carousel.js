class Zeus_Carousel extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
        return {
            selectors: {
                carousel: '.zeus-carousel-container',
                carouselNextBtn: '.swiper-button-next-' + this.getID(),
                carouselPrevBtn: '.swiper-button-prev-' + this.getID(),
                carouselPagination: '.swiper-pagination-' + this.getID(),
            },
            effect: 'slide',
            loop: false,
            autoplay: 0,
            speed: 400,
            navigation: false,
            pagination: false,
            centeredSlides: false,
            pauseOnHover: false,
            slidesPerView: {
                desktop: 3,
                tablet: 2,
                mobile: 1,
            },
            slidesPerGroup: {
                desktop: 3,
                tablet: 2,
                mobile: 1,
            },
            spaceBetween: {
                desktop: 10,
                tablet: 10,
                mobile: 10,
            },
            swiperInstance: null,
        };
    }

    getDefaultElements() {
        const element = this.$element.get(0);
        const selectors = this.getSettings('selectors');

        return {
            carousel: element.querySelector(selectors.carousel),
            carouselNextBtn: element.querySelectorAll(selectors.carouselNextBtn),
            carouselPrevBtn: element.querySelectorAll(selectors.carouselPrevBtn),
            carouselPagination: element.querySelectorAll(selectors.carouselPagination),
        };
    }

    onInit(...args) {
        super.onInit(...args);

        this.setUserSettings();
        this.initSwiper();
    }

    setUserSettings() {
        const settings = this.getSettings();
        const userSettings = JSON.parse(this.elements.carousel.getAttribute('data-settings'));

        const currentSettings = {
            effect: !!userSettings.effect ? userSettings.effect : settings.effect,
            loop: !!userSettings.loop ? Boolean(Number(userSettings.loop)) : settings.loop,
            autoplay: !!userSettings.autoplay ? Number(userSettings.autoplay) : settings.autoplay,
            speed: !!userSettings.speed ? Number(userSettings.speed) : settings.speed,
            navigation: !!userSettings.arrows ? Boolean(Number(userSettings.arrows)) : settings.navigation,
            pagination: !!userSettings.dots ? Boolean(Number(userSettings.dots)) : settings.pagination,
            pauseOnHover: !!userSettings['pause-on-hover']
                ? JSON.parse(userSettings['pause-on-hover'])
                : settings.pauseOnHover,
            slidesPerView: {
                desktop: !!userSettings.items ? Number(userSettings.items) : settings.slidesPerView.desktop,
                tablet: !!userSettings['items-tablet']
                    ? Number(userSettings['items-tablet'])
                    : settings.slidesPerView.tablet,
                mobile: !!userSettings['items-mobile']
                    ? Number(userSettings['items-mobile'])
                    : settings.slidesPerView.mobile,
            },
            slidesPerGroup: {
                desktop: !!userSettings.slides ? Number(userSettings.slides) : settings.slidesPerGroup.desktop,
                tablet: !!userSettings['slides-tablet']
                    ? Number(userSettings['slides-tablet'])
                    : settings.slidesPerGroup.tablet,
                mobile: !!userSettings['slides-mobile']
                    ? Number(userSettings['slides-mobile'])
                    : settings.slidesPerGroup.mobile,
            },
            spaceBetween: {
                desktop: !!userSettings.margin ? Number(userSettings.margin) : settings.spaceBetween.desktop,
                tablet: !!userSettings['margin-tablet']
                    ? Number(userSettings['margin-tablet'])
                    : settings.spaceBetween.tablet,
                mobile: !!userSettings['margin-mobile']
                    ? Number(userSettings['margin-mobile'])
                    : settings.spaceBetween.mobile,
            },
        };

        currentSettings.centeredSlides = 'coverflow' === currentSettings.effect ? true : settings.centeredSlides;

        this.setSettings(currentSettings);
    }

    initSwiper() {
        var swiperSlider;

        if ( 'undefined' === typeof Swiper ) {
            // Improved Asset Loading enabled
            var asyncSwiper = elementorFrontend.utils.swiper;
            new asyncSwiper( this.elements.carousel, this.swiperOptions() ).then( function( newSwiperSliderInstance ) {
                swiperSlider = newSwiperSliderInstance;
            } );
        } else {
            // Improved Asset Loading disabled
            swiperSlider = new Swiper( this.elements.carousel, this.swiperOptions() );
        }

        this.setSettings({
            swiperInstance: swiperSlider,
        });

        if ( this.getSettings( 'pauseOnHover' ) ) {
            this.elements.carousel.addEventListener( 'mouseenter', function() {
                swiperSlider.autoplay.stop();
            } );
            this.elements.carousel.addEventListener( 'mouseleave', function() {
                swiperSlider.autoplay.start();
            } );
        }
    }

    swiperOptions() {
        const settings = this.getSettings();

        const swiperOptions = {
            direction: 'horizontal',
            effect: settings.effect,
            loop: settings.loop,
            speed: settings.speed,
            centeredSlides: settings.centeredSlides,
            autoHeight: true,
            pauseOnMouseEnter: true,
            autoplay: !settings.autoplay
                ? false
                : {
                      delay: settings.autoplay,
                  },
            navigation: !settings.navigation
                ? false
                : {
                      nextEl: settings.selectors.carouselNextBtn,
                      prevEl: settings.selectors.carouselPrevBtn,
                  },
            pagination: !settings.pagination
                ? false
                : {
                      el: settings.selectors.carouselPagination,
                      clickable: true,
                  },
        };

        if (settings.effect === 'fade') {
            swiperOptions.items = 1;
        } else {
            swiperOptions.breakpoints = {
                1024: {
                    slidesPerView: settings.slidesPerView.desktop,
                    slidesPerGroup: settings.slidesPerGroup.desktop,
                    spaceBetween: settings.spaceBetween.desktop,
                },
                768: {
                    slidesPerView: settings.slidesPerView.tablet,
                    slidesPerGroup: settings.slidesPerGroup.tablet,
                    spaceBetween: settings.spaceBetween.tablet,
                },
                320: {
                    slidesPerView: settings.slidesPerView.mobile,
                    slidesPerGroup: settings.slidesPerGroup.mobile,
                    spaceBetween: settings.spaceBetween.mobile,
                },
            };
        }

        return swiperOptions;
    }
}

export default Zeus_Carousel;
