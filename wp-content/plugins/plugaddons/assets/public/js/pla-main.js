(function ($, window, document) {
    "use strict";
    $(window).on('elementor/frontend/init', function () {

        elementorFrontend.hooks.addAction('frontend/element_ready/team-carousel.default', function ($scope) {
            $scope.find('.share').each(function () {
                $('.share .toggle').on('click', function () {
                    var $thisItem = $(this),
                    $allItems = $thisItem.parent(),
                    $thisChildrenList = $allItems.find('.pla-social');
                    $thisChildrenList.toggleClass('active');
                    $thisItem.toggleClass('active');
                });
            });
        });

        // Accordion JS
        elementorFrontend.hooks.addAction('frontend/element_ready/accordion.default', function ($scope) {
            $scope.find('.accordion').each(function () {
                var $thisItem = $(this);
                $thisItem.accordable({
                    openPanel: [1],
                })
            })

        });

        elementorFrontend.hooks.addAction('frontend/element_ready/progressbar.default', function ($scope) {
            elementorFrontend.waypoint($scope, function () {
                $scope.find('.pla-skill-level').each(function () {
                    var $current = $(this),
                        $lt = $current.find('.pla-skill-level-text'),
                        lv = $current.data('level');
                    $current.animate({
                        width: lv + '%'
                    }, 500);
                    $lt.numerator({
                        toValue: lv + '%',
                        duration: 1300,
                        onStep: function () {
                            $lt.append('%');
                        }
                    });

                });
            });
        });

        var testimonialCarousel = elementorModules.frontend.handlers.Base.extend({
            onInit: function () {
                elementorModules.frontend.handlers.Base.prototype.onInit.apply(this, arguments);
                this.$container = this.$element.find('.testimonial-carousel');
                this.run();
            },

            // isCarousel: function() {
            //     return this.$element.hasClass('elementor-widget-testimonials-carousel');
            // },
            getDefaultSettings: function () {
                return {
                    arrows: false,
                    dots: false,
                    checkVisible: true,
                    infinite: true,
                    slidesToShow: 3,
                    centerMode: false,
                    fade: false,
                    prevArrow: '<button type="button" class="slick-prev"><i class="fa fa-chevron-left"></i></button>',
                    nextArrow: '<button type="button" class="slick-next"><i class="fa fa-chevron-right"></i></button>',
                }
            },
            onElementChange: function () {
                this.$container.slick('unslick');
                this.run();
            },
            getReadySettings: function () {
                var settings = {
                    infinite: !!this.getElementSettings('loop'),
                    autoplay: !!this.getElementSettings('autoplay'),
                    autoplaySpeed: this.getElementSettings('autoplay_speed'),
                    speed: this.getElementSettings('animation_speed'),
                    centerMode: !!this.getElementSettings('center'),
                    fade: !!this.getElementSettings('animation_fade'),
                };

                switch (this.getElementSettings('navigation')) {
                    case 'arrow':
                        settings.arrows = true;
                        break;
                    case 'dots':
                        settings.dots = true;
                        break;
                    case 'both':
                        settings.arrows = true;
                        settings.dots = true;
                        break;
                }

                // if (this.isCarousel()) {
                settings.slidesToShow = this.getElementSettings('slides_to_show') || 3;
                settings.responsive = [
                    {
                        breakpoint: elementorFrontend.config.breakpoints.lg,
                        settings: {
                            slidesToShow: (this.getElementSettings('slides_to_show_tablet') || settings.slidesToShow),
                        }
                    },
                    {
                        breakpoint: elementorFrontend.config.breakpoints.md,
                        settings: {
                            slidesToShow: (this.getElementSettings('slides_to_show_mobile') || this.getElementSettings('slides_to_show_tablet')) || settings.slidesToShow,
                        }
                    }
                ];
                // }

                return $.extend({}, this.getDefaultSettings(), settings);
            },
            run: function () {
                this.$container.slick(this.getReadySettings());
            }

        });



        var teamCarousel = elementorModules.frontend.handlers.Base.extend({
            onInit: function () {
                elementorModules.frontend.handlers.Base.prototype.onInit.apply(this, arguments);
                this.$container = this.$element.find('.team-carousel');
                this.run();
            },

            // isCarousel: function() {
            //     return this.$element.hasClass('elementor-widget-testimonials-carousel');
            // },
            getDefaultSettings: function () {
                return {
                    arrows: false,
                    dots: false,
                    checkVisible: true,
                    infinite: true,
                    slidesToShow: 3,
                    centerMode: false,
                    fade: false,
                    prevArrow: '<button type="button" class="slick-prev"><i class="fa fa-chevron-left"></i></button>',
                    nextArrow: '<button type="button" class="slick-next"><i class="fa fa-chevron-right"></i></button>',
                }
            },
            onElementChange: function () {
                this.$container.slick('unslick');
                this.run();
            },
            getReadySettings: function () {
                var settings = {
                    infinite: !!this.getElementSettings('loop'),
                    autoplay: !!this.getElementSettings('autoplay'),
                    autoplaySpeed: this.getElementSettings('autoplay_speed'),
                    speed: this.getElementSettings('animation_speed'),
                    centerMode: !!this.getElementSettings('center'),
                    fade: !!this.getElementSettings('animation_fade'),
                };

                switch (this.getElementSettings('navigation')) {
                    case 'arrow':
                        settings.arrows = true;
                        break;
                    case 'dots':
                        settings.dots = true;
                        break;
                    case 'both':
                        settings.arrows = true;
                        settings.dots = true;
                        break;
                }

                // if (this.isCarousel()) {
                settings.slidesToShow = this.getElementSettings('slides_to_show') || 3;
                settings.responsive = [
                    {
                        breakpoint: elementorFrontend.config.breakpoints.lg,
                        settings: {
                            slidesToShow: (this.getElementSettings('slides_to_show_tablet') || settings.slidesToShow),
                        }
                    },
                    {
                        breakpoint: elementorFrontend.config.breakpoints.md,
                        settings: {
                            slidesToShow: (this.getElementSettings('slides_to_show_mobile') || this.getElementSettings('slides_to_show_tablet')) || settings.slidesToShow,
                        }
                    }
                ];
                // }

                return $.extend({}, this.getDefaultSettings(), settings);
            },
            run: function () {
                this.$container.slick(this.getReadySettings());
            }

        });

        var handlersClassInit = {
            'testimonials-carousel.default': testimonialCarousel,
            'team-carousel.default': teamCarousel,
        };
        $.each(handlersClassInit, function (widgetName, handlerClass) {
            elementorFrontend.hooks.addAction('frontend/element_ready/' + widgetName, function ($scope) {
                elementorFrontend.elementsHandler.addHandler(handlerClass, {$element: $scope});
            });
        });

    });


})(jQuery, window, document);




