;(function ($) {

    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/progressbar_widget.default', function ($scope) {
            var EF = elementorFrontend,
                EM = elementorModules;
            EF.waypoint($scope, function () {
                $scope.find('.ha-skill-level').each(function () {
                    var $current = $(this),
                        $lt = $current.find('.ha-skill-level-text'),
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
    });

})(jQuery);