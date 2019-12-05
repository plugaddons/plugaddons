;(function($){
    elementor.hooks.addAction( "panel/open_editor/widget/testimonialsCarouselWidget", function( panel, model, view ) {
        $("input:hidden[value='style_select_hidden']").parents('.elementor-control').prev().find('select').on('change', function(){
            if('style-one' ==$(this).val()){
                $("input:hidden[value='items_hidden_selector']").parents('.elementor-control').prev().hide();
            }else{
                $("input:hidden[value='items_hidden_selector']").parents('.elementor-control').prev().show();
            }
        });
        if('style-one' ==$("input:hidden[value='style_select_hidden']").parents('.elementor-control').prev().find('select').val()){
            $("input:hidden[value='items_hidden_selector']").parents('.elementor-control').prev().hide();
        }else{
            $("input:hidden[value='items_hidden_selector']").parents('.elementor-control').prev().show();
        }
    } );

})(jQuery);