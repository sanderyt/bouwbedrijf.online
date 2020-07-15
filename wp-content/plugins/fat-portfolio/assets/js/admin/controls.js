/**
 * Created by roninwp on 3/10/2017.
 */
(function ($) {
    "use strict";

    function Fat_portfolio_dependence($elm) {
        var $value = $elm.val(),
            $data_id = $elm.attr('id');

        if($elm.is('select') && typeof $elm.attr('data-selected')!='undefined' && !$elm.hasClass('selectized')){
            $value = $elm.attr('data-selected');
        }
        $('[data-dependence-id="' + $data_id + '"]').hide();
        $('[data-dependence-id="' + $data_id + '"]').each(function () {
            var $dataValue = $(this).attr('data-value').replace('[','').replace(']','');
            var $arrValue = $dataValue.split(',');
            for(var $i=0; $i<$arrValue.length; $i++){
                $arrValue[$i] = $arrValue[$i].replace(/\'/g,'');
                if($arrValue[$i]==$value){
                    $(this).fadeIn();
                }
            }
        });
    }

    function Fat_portfolio_rangesSliderValueOutput(element) {
        var value = element.value;
        var outputId = $(element).attr('data-output-id');
        $('#' + outputId).val(value);
    }

    function Fat_portfolio_control_init(){

        var $setting_form_class = '.fat-portfolio-setting';
        //register tab change
        $('a', '.fat-portfolio-setting .tab-settings-nav').click(function () {
            var $liWrap = $(this).parent();
            if ($liWrap.hasClass('active')) {
                return;
            }
            $('li', $setting_form_class).removeClass('active');
            var tabId = $(this).attr('data-tab');
            var tab = $('#' + tabId, $setting_form_class);

            $('.tab-setting.active', $setting_form_class).fadeOut(300, function () {
                $(this).removeClass('active');
                $liWrap.addClass('active');
                tab.fadeIn(300, function () {
                    tab.addClass('active');
                });
            });
        });

        //register ranger slide
        $('input[type="range"]').rangeslider({
            polyfill: false,
            onInit: function () {
                Fat_portfolio_rangesSliderValueOutput(this.$element[0]);
            },
            onSlide: function (position, value) {
                Fat_portfolio_rangesSliderValueOutput(this.$element[0]);
            },
        });
        $('input[type="number"]').change(function () {
            var rangeId = $(this).attr('data-range-id');
            if (typeof rangeId != ' undefined' && rangeId != '') {
                var value = $(this).val();
                $('#' + rangeId).val(value).change();
            }
        });

        //register color picker
        $('.colorpicker-element').colorpicker();

        //register ace
        if(typeof ace !='undefined'){
            $('.ace-editor').each(function(){
                var $id = $(this).attr('id'),
                    $mode = $(this).attr('data-mode');
                if(typeof $id !='undefined'){
                    var $ace = ace.edit($id);
                    $mode = typeof $mode =='undefined' ? 'css' : $mode;
                    $ace.getSession().setMode('ace/mode/' + $mode);
                    $ace.setAutoScrollEditorIntoView(true);
                    $ace.getSession().on('change', function(e) {
                        var $container = $($ace.container).closest('.tab-setting');
                        $('textarea', $container).html($ace.getValue());
                    });
                }
            });
        }


        //register dependence
        $('.dependence').each(function () {
            Fat_portfolio_dependence($(this));
            $(this).change(function () {
                Fat_portfolio_dependence($(this));
            });
        });

        //register selectize
        var $option = {
            plugins: ['remove_button', 'drag_drop'],
            searchField: 'text',
            delimiter: ',',
            persist: false,
        };
        $('select:not(.manual)').selectize($option);

        $('select.manual').each(function(){
            var $data_selected = $(this).attr('data-selected');
            var $options_manual = $option;
            if(typeof $data_selected !='undefined' && $data_selected !=''){
                $options_manual.items = $data_selected.split(',');
            }else{
                $options_manual.items = [];
            }
            $(this).selectize($options_manual);
        });
    }

    $(document).ready(function () {
        Fat_portfolio_control_init();
    });

})(jQuery);