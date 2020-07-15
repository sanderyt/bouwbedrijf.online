(function ($) {
    "use strict";
    $(document).ready(function () {
        //register layout choice
        $('.layout-item','.layout-wrap').on('click',function(){
            var $layout_type = $(this).attr('data-value'),
                $container = $(this).closest('.layout-wrap');
            $('.layout-item',$container).removeClass('active');
            $($parent).addClass('active');
            $('input[type="hidden"]', $container).val($layout_type);

        })
    });
})(jQuery);
