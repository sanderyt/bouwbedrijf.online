jQuery(function ($) {
    'use strict';

    function setFatCmbRangesSliderValueOutput(element) {
        var value = element.value;
        var outputId = $(element).attr('data-output-id');
        $('#' + outputId).val(value);
    }

    $(document).ready(function () {
        if ($.isFunction($.fn.rangeslider)){
            $('input[type="range"]', '.fat-cmb-range-slider-wrap').rangeslider({
                polyfill: false,
                onInit: function () {
                    setFatCmbRangesSliderValueOutput(this.$element[0]);
                },
                onSlide: function (position, value) {
                    setFatCmbRangesSliderValueOutput(this.$element[0]);
                },
            });

            $('input[type="number"]','.fat-cmb-range-slider').change(function () {
                var rangeId = $(this).attr('data-range-id');
                if (typeof rangeId != ' undefined' && rangeId != '') {
                    var value = $(this).val();
                    $('#' + rangeId).val(value).change();
                }
            });
        }

    });
});
