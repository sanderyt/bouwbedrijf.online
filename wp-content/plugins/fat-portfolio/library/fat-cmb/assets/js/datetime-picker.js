jQuery(function ($) {
    'use strict';
    $(document).ready(function () {
        if ($.isFunction($.fn.datetimepicker)) {
            $('input.fat-cmb-datetime-picker', '.fat-cmb-date-wrap').each(function () {
                var $date_picker = $(this).attr('data-date-picker'),
                    $time_picker = $(this).attr('data-time-picker'),
                    $locale = $(this).attr('data-locale');

                $date_picker = typeof $date_picker != 'undefined' && $date_picker == '1';
                $time_picker = typeof $time_picker != 'undefined' && $time_picker == '1';
                $(this).datetimepicker({
                    datepicker: $date_picker,
                    timepicker: $time_picker
                });
                $.datetimepicker.setLocale($locale);
            });
        }
    });
});
