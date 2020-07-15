jQuery(function ($) {
    'use strict';
    $(document).ready(function () {
        if ($.isFunction($.fn.selectize)){
            $('.fat-cmb-select').selectize({
                plugins: ['remove_button', 'drag_drop'],
                searchField: 'text',
                delimiter: ',',
                persist: false
            });
        }
        $('.fat-cmb-select').css('opacity',1);
    });
});
