jQuery(function ($) {
    'use strict';

    function Fat_cmb_depend_field($fields){
        $fields = typeof $fields !='undefined' ? $fields : '.fat-cmb-fields';
        $('[data-depend-field]', $fields).each(function(){
            var $field_id = $(this).attr('data-depend-field'),
                $repeat_wrap = $(this).closest('.fat-cmb-repeat-field-group'),
                $field = $('[data-field-id="'  +  $field_id + '"]', $repeat_wrap),
                $field_value = '',
                $field_type = $field.attr('data-type'),
                $value = $(this).attr('data-depend-value'),
                $is_show = true,
                $compare = $(this).attr('data-depend-compare');

            if(typeof $field =='undefined' || $field.length ==0 ){
                $field = $('[data-field-id="'  +  $field_id + '"]');
                $field_type = $field.attr('data-type');
            }


            if(!$($field).is(':visible') && !$field.hasClass('selectized')){
                $(this).css({'display': 'none'});
            }else{
                if(typeof $field !=' undefined' && $field.length > 0){
                    $field_value = $field.val();

                    if (typeof $field_type != 'undefined' && $field_type === 'checkbox') {
                        $field_value = $('input',$field).is(':checked');
                    }

                    if (typeof $field_type != 'undefined' && $field_type === 'radio') {
                        $field_value = $('input:checked',$field).val();
                    }

                    if($compare == '='){
                        $is_show = $value == $field_value;
                    }
                    if($compare == '!='){
                        $is_show = $value != $field_value;
                    }
                    if($compare == 'in'){
                        $is_show = (',' + $value + ',').indexOf(',' + $field_value + ',') >= 0;
                    }

                    if($is_show){
                        $(this).css({'display': 'block'});
                    }else{
                        $(this).css({'display': 'none'});
                    }
                }
            }

            if (typeof $field_type!='undefined' && ( $field_type === 'checkbox' || $field_type === 'radio' ) ) {
                $('input',$field).off('change').on('change', function () {
                    Fat_cmb_depend_field();
                });

            }else{
                $field.off('change').on('change', function () {
                    Fat_cmb_depend_field();
                });
            }
        })
    }
    $(document).ready(function () {
        Fat_cmb_depend_field();
        $('.fat-cmb-container').on('container-show',function(){
            Fat_cmb_depend_field();
        });
        $(document).on('refresh_depend_field',function(){
            Fat_cmb_depend_field();
        });
    });
});