;(function($){
    $(document).ready(function(){
        $('input:hidden[value="style_select_hidden"]').parent('.elementor-control').prev().find('select').hide();
    });
})(jQuery);