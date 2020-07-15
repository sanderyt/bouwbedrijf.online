jQuery(function ($) {
    'use strict';
    $(document).ready(function () {

        /** Process switch tab **/
        $('li > a', '.fat-cmb-tab-settings-nav').off('click').on('click', function () {
            var $container = $(this).closest('.fat-cmb-form-container'),
                $ul = $(this).closest('.fat-cmb-tab-settings-nav'),
                $li = $(this).closest('li'),
                $tab_id = $(this).attr('data-tab');

            $('li.active', $ul).removeClass('active');
            $li.addClass('active');

            $('.fat-tab-setting.active', $container).removeClass('active');
            $('#' + $tab_id, $container).addClass('active');
            $('#' + $tab_id + ' .fat-cmb-container', $container).trigger('container-show'); //trigger show
            $('#fat_cmb_active_tab', $container).val($tab_id);
        });

        /** Process submit **/
        $('input.fat-cmb-reset-all, input.fat-cmb-save, input.fat-cmb-reset-section','.fat-cmb-option-page-container form').off('click').on('click',function(){
            var $this = $(this),
                $form_container = $(this).closest('.fat-cmb-form-container'),
                $form = $(this).closest('form');
            if($this.hasClass('fat-cmb-save')){
                $('input[name="action"]', $form_container).val('save');
            }
            if($this.hasClass('fat-cmb-reset-all')){
                $('input[name="action"]', $form_container).val('reset-all');
            }
            if($this.hasClass('fat-cmb-reset-section')){
                $('input[name="action"]', $form_container).val('reset-section');
            }
            if($this.hasClass('fat-cmb-reset-all') || $this.hasClass('fat-cmb-reset-section')){
                var r = confirm("Please confirm reset option !");
                if (r == true) {
                    $form.submit();
                }
            }
        });

    });
});

