

(function ($) {
    $(window).on('elementor/frontend/init', function () {

        elementorFrontend.hooks.addAction('frontend/element_ready/progressbar_widget.default', function ($scope) {
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

            isCarousel: function() {
                return this.$element.hasClass('elementor-widget-testimonials-carousel');
            },
            getDefaultSettings: function() {
                return {
                    arrows: false,
                    dots: false,
                    checkVisible: false,
                    infinite: true,
                    slidesToShow: this.isCarousel() ? 3 : 1,
                    rows: 0,
                    prevArrow: '<button type="button" class="slick-prev"><i class="fa fa-chevron-left"></i></button>',
                    nextArrow: '<button type="button" class="slick-next"><i class="fa fa-chevron-right"></i></button>',
                }
            },
            onElementChange: function() {
                this.$container.slick('unslick');
                this.run();
            },
            getReadySettings: function() {
                var settings = {
                    infinite: !! this.getElementSettings('loop'),
                    autoplay: !! this.getElementSettings('autoplay'),
                    autoplaySpeed: this.getElementSettings('autoplay_speed'),
                    speed: this.getElementSettings('animation_speed'),
                    centerMode: !! this.getElementSettings('center'),
                    slidesToScroll: 4,
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

                if (this.isCarousel()) {
                    settings.slidesToShow = this.getElementSettings('slides_to_show') || 3;
                    console.log(this.getElementSettings('slides_to_show'));
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
                }

                return $.extend({}, this.getDefaultSettings(), settings);
            },
            run: function() {
                this.$container.slick(this.getReadySettings());
            }

        });

        var handlersClassInit = {
            'testimonials-carousel.default': testimonialCarousel,
        };
        $.each( handlersClassInit, function( widgetName, handlerClass ) {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/' + widgetName, function( $scope ) {
                elementorFrontend.elementsHandler.addHandler( handlerClass, { $element: $scope });
            });
        });
    });
})(jQuery);




