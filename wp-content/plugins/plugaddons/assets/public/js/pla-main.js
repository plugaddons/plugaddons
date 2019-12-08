;(function ($) {
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/progressbar_widget.default', function ($scope) {
            var EF = elementorFrontend,
                EM = elementorModules;
            EF.waypoint($scope, function () {
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
        elementorFrontend.hooks.addAction('frontend/element_ready/testimonialsCarouselWidget.default', function (scope, $) {
            var $slick = $(scope).find('.testimonial-carousel');
            var $slickSettings = $slick.data('settings');


            $(scope).find('.testimonial-carousel').slick({
                slidesToShow: 3,
                autoplay: false,
                //infinite: false,
                autoplaySpeed: '3000',
                dots: true,
                //fade: true,
                centerMode: true,
                centerPadding: '50px',
                rows: 0,
                prevArrow: '<button type="button" class="slick-prev"><i class="fa fa-chevron-left"></i></button>',
                nextArrow: '<button type="button" class="slick-next"><i class="fa fa-chevron-right"></i></button>',
                responsive: [
                    {
                        breakpoint: 768,
                        settings: {
                            arrows: false,
                            centerMode: true,
                            centerPadding: '40px',
                            slidesToShow: 3
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            arrows: false,
                            centerMode: true,
                            centerPadding: '40px',
                            slidesToShow: 1
                        }
                    }
                ]
            });
        });
    });
    $(document).ready(function(){

    });

})(jQuery);



