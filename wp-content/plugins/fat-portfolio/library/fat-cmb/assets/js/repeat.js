/**
 * Created by roninwp on 3/3/2017.
 */
jQuery(function ($) {
    'use strict';

    function Fat_cmb_repeat_add_field(){
        $('.fat-cmb-repeat-wrap').each(function(){
            var $this = $(this);
            $('a.fat-cmb-repeat-add', $this).off('click').on('click',function(){

                $('select.fat-cmb-select',$this).each(function(){
                    if($(this)[0].selectize){
                        var value = $(this).val();
                        $(this)[0].selectize.destroy();
                        $(this).val(value);
                    }
                });

                if(typeof Fat_Cmb_Google_Font !='undefined'){
                    Fat_Cmb_Google_Font.fat_cmb_google_font_destroy_selectize_clone($this);
                }

                var $field_group = $('.fat-cmb-repeat-field-group:last',$this).clone(true),
                    $total_group = $('.fat-cmb-repeat-field-group',$this).length;

                Fat_cmb_repeat_reset_field($field_group);
                Fat_cmb_re_index_field_group($field_group, $total_group);
                $field_group.insertBefore($('.fat-cmb-repeat-button-group',$this));

                $('select.fat-cmb-select',$this).selectize({
                    plugins: ['remove_button', 'drag_drop'],
                    searchField: 'text',
                    delimiter: ',',
                    persist: false
                });
                $('.fat-cmb-select',$this).css('opacity',1);

                if(typeof Fat_Cmb_Google_Font !='undefined'){
                    Fat_Cmb_Google_Font.fat_cmb_google_font_init_selectize_clone($this);
                }

            });
        })
    }
    function Fat_cmb_repeat_remove(){
        $('.fat-cmb-repeat-wrap').each(function(){
            var $this = $(this);
            $('a.fat-cmb-repeat-remove', $this).off('click').on('click',function(){
                var $groups = $('.fat-cmb-repeat-field-group',$this).length,
                    $field_group = $(this).closest('.fat-cmb-repeat-field-group'),
                    $repeat_wrap = $(this).closest('.fat-cmb-repeat-wrap');
                if($groups>1){
                    $field_group.remove();
                }else{
                    Fat_cmb_repeat_reset_field($field_group);
                }
                Fat_cmb_repeat_re_index($repeat_wrap);

            });
        })
    }
    function Fat_cmb_repeat_reset_field($field_group){
        $('input[type="text"],input[type="hidden"]',$field_group).each(function(){
            var $std = $(this).attr('data-std');
            $std = typeof $std !='undefined' ? $std : '';
            $(this).val($std);
        });
        $('input[type="checkbox"], input[type="radio"]',$field_group).each(function(){
            var $std = $(this).attr('data-std');
            $std = typeof $std !='undefined' ? $std : '0';
            if($std=='1'){
                $(this).attr('checked','checked');
            }else{
                $(this).removeAttr('checked');
            }
        });

        //remove for single image
        $('.fat-image-thumb',$field_group).remove();
    }
    function Fat_cmb_repeat_re_index($repeat_wrap){
        var $index = 0;
        $('.fat-cmb-repeat-field-group', $repeat_wrap).each(function(){
            var pattern =/\[\d+\]/ig;
            $('select, input[type="radio"], input[type="checkbox"]',this).each(function(){
                var $name = $(this).attr('name');
                if(typeof $name != 'undefined'){
                    $name = $name.replace(pattern, '[' + $index + ']');
                    $(this).attr('name', $name);
                }
            });
            $index++;
        })
    }
    function Fat_cmb_re_index_field_group($field_group, $index){
        var pattern =/\[\d+\]/ig;
        $('select, textarea, input[type="text"], input[type="radio"], input[type="checkbox"], input[type="hidden"], input[type="number"]',$field_group).each(function(){
            var $name = $(this).attr('name');
            if(typeof $name != 'undefined'){
                $name = $name.replace(pattern, '[' + $index + ']');
                $(this).attr('name', $name);
            }
        });
    }

    function Fat_cmb_repeat_register_event(){
        Fat_cmb_repeat_add_field();
        Fat_cmb_repeat_remove();
    }
    $(document).ready(function () {
        Fat_cmb_repeat_register_event();
    });
});