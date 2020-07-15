/**
 * Created by roninwp on 4/24/2017.
 */
jQuery(function ($) {
    'use strict';
    $(document).ready(function () {
        var $fat_cmb_font_icon_wrap;

        function fat_cmb_initPopupFontIcon() {
            var $popup = $('<div class="fat-cmb-popup-font-icon-container">' +
                '<a class="fat-cmb-close-icon" href="javascript:;"><i class="fa fa-times-circle"></i></a>' +
                '<div class="fat-cmb-icon-search"><input type="text" placeholder="Input text to search icon" /></div>' +
                '<ul class="fat-cmb-font-icon-list"></ul>' +
                '</div>');
            if (typeof fat_cmb_fontIcons != ' undefined' && fat_cmb_fontIcons.length > 0) {
                var $font_icon = fat_cmb_fontIcons[0],
                    prefix = '';
                Object.keys($font_icon).map(function (key) {
                    prefix = key.indexOf('fa-') == 0 ? 'fa ' : '';
                    $('ul', $popup).append('<li><a href="javascript:;" data-icon="' + prefix +  key + '" ><i class="' + prefix + key + '"></i><span>' + $font_icon[key] + '</span></a>');
                });
            }
            if($('.fat-cmb-popup-font-icon-container','body').length == 0){
                $('body').append($popup);
            }else{
                return;
            }

            $('a', '.fat-cmb-popup-font-icon-container ul li').off('click').on('click', function () {
                $('input.fat-cmb-font-icon', $fat_cmb_font_icon_wrap).val($(this).attr('data-icon'));
                $('.fat-cmb-choice-font-icon i', $fat_cmb_font_icon_wrap).attr('class', $(this).attr('data-icon'));
                $('.fat-cmb-popup-font-icon-container', 'body').removeClass('show-up');
                $('a.fat-cmb-clear-font-icon',$fat_cmb_font_icon_wrap).removeClass('fat-cmb-hide');
            });

            $('a.fat-cmb-close-icon','.fat-cmb-popup-font-icon-container').off('click').on('click',function(){
                $('.fat-cmb-popup-font-icon-container', 'body').removeClass('show-up');
            });

            $('.fat-cmb-icon-search input','.fat-cmb-popup-font-icon-container').on('keyup',function(event){
                if ( event.which == 13 ) {
                    event.preventDefault();
                }
                var $icon,$icon_label,
                    $key = $(this).val();
                if($key == ''){
                    $('.fat-cmb-font-icon-list li','.fat-cmb-popup-font-icon-container').removeClass('fat-cmb-hide');
                }else{
                    $key = $key.toLowerCase();
                    $('.fat-cmb-font-icon-list li','.fat-cmb-popup-font-icon-container').each(function(){
                        $icon = $('a',this).attr('data-icon').toLowerCase();
                        $icon_label = $('a span',this).text().toLowerCase();
                        if($icon.indexOf($key) >=0 || $icon_label.indexOf($key) >=0){
                            $(this).removeClass('fat-cmb-hide');
                        }else{
                            $(this).addClass('fat-cmb-hide');
                        }
                    })
                }
            });
        }
        $('a.fat-cmb-choice-font-icon', '.fat-cmb-font-icon-wrap').off('click').on('click', function () {
            $fat_cmb_font_icon_wrap = $(this).closest('.fat-cmb-font-icon-wrap');
            var $icon = $('input.fat-cmb-font-icon', $fat_cmb_font_icon_wrap).val();
            $('.fat-cmb-popup-font-icon-container', 'body').addClass('show-up');
            $('a.fat-cmb-active', '.fat-cmb-popup-font-icon-container').removeClass('fat-cmb-active');
            $('a[data-icon="' + $icon + '"]', '.fat-cmb-popup-font-icon-container').addClass('fat-cmb-active');
            $('.fat-cmb-icon-search input','.fat-cmb-popup-font-icon-container').val('');
            $('.fat-cmb-font-icon-list li','.fat-cmb-popup-font-icon-container').removeClass('fat-cmb-hide');

        });

        $('a.fat-cmb-clear-font-icon', '.fat-cmb-font-icon-wrap').off('click').on('click',function(){
            $fat_cmb_font_icon_wrap = $(this).closest('.fat-cmb-font-icon-wrap');
            $('input.fat-cmb-font-icon', $fat_cmb_font_icon_wrap).val('');
            $('a.fat-cmb-active', '.fat-cmb-popup-font-icon-container').removeClass('fat-cmb-active');
            $('.fat-cmb-choice-font-icon i', $fat_cmb_font_icon_wrap).attr('class', '');
            $(this).addClass('fat-cmb-hide');
        });

        fat_cmb_initPopupFontIcon();
    });
});