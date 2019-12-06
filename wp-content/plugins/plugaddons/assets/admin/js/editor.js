;(function($){


    function elementObservation($element, callback){
        const MutationObserver = window.MutationObserver || window.WebKitMutationObserver || window.MozMutationObserver;
        const observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation){
                callback(mutation);
            });
        });
        observer.observe($element[0], {
            childList: true
        });
    }

    elementor.hooks.addAction( "panel/open_editor/widget/testimonialsCarouselWidget", function( panel, model, view ) {

        var $selector = $("input:hidden[value='style_select_hidden']").parents('.elementor-control').prev().find('select');
        $selector.on('change', function(){
            getValue($(this));
        });
        getValue($selector);
        var $element = panel.$el;

        elementObservation($element.find('.elementor-repeater-fields-wrapper'),function(mutation){
            getValue($selector);
        });

        function getValue(_select) {
            if('style-one' == _select.val() || 'style-four' == _select.val()){
                $("input:hidden[value='items_hidden_selector']").parents('.elementor-control').prev().hide();
            }else{
                $("input:hidden[value='items_hidden_selector']").parents('.elementor-control').prev().show();
            }
        }

    } );

})(jQuery);