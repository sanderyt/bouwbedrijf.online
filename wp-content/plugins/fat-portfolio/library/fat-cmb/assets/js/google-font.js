var Fat_Cmb_Google_Font = Fat_Cmb_Google_Font || {};
jQuery(function ($) {
    'use strict';
    Fat_Cmb_Google_Font = {
        init: function () {
            $('select.fat-cmb-font-family', '.fat-cmb-google-font-wrap').each(function () {
                var self = $(this),
                    $field_container = self.closest('.fat-cmb-field'),
                    $font_family_selected = self.attr('data-selected'),
                    $option = {
                        plugins: ['remove_button', 'drag_drop'],
                        searchField: 'text',
                        delimiter: ',',
                        persist: false,
                    };
                $option.items = [];
                if(typeof $font_family_selected !=='undefined' && $font_family_selected!==''){
                    $option.items = [$font_family_selected];
                }else{
                    $option.items = [];
                }

                self.selectize($option);
                if(typeof $font_family_selected !=='undefined' && $font_family_selected!==''){
                    Fat_Cmb_Google_Font.fat_cmb_google_font_change($font_family_selected, $field_container, 1);
                }
            });

            Fat_Cmb_Google_Font.initChangeFont();
            $('.fat-cmb-google-font-wrap', '.fat-cmb-page-fields').each(function () {
                Fat_Cmb_Google_Font.initFontPreview(1, $(this));
            });
        },

        initChangeFont: function () {
            $('.fat-cmb-font-weight', '.fat-cmb-google-font-wrap').off('change').on('change', function () {
                var $variant = $(this).val(),
                    $field_container = $(this).closest('.fat-cmb-field'),
                    $field_wrap = $(this).closest('.fat-cmb-google-font-wrap'),
                    $ul_font_file = $('ul.fat-cmb-google-font-file', $field_container),
                    $input_font_file = $('input.fat-cmb-google-font-file', $field_container),
                    $font_file = $('li[data-variant="' + $variant + '"]', $ul_font_file).html();

                $input_font_file.val($font_file);
                Fat_Cmb_Google_Font.initFontPreview(0, $field_wrap);
            });

            $('.fat-cmb-font-family', '.fat-cmb-google-font-wrap').off('change').on('change', function () {
                var $field_container = $(this).closest('.fat-cmb-field'),
                    $font_family_value = $(this).val(),
                    $field_wrap = $(this).closest('.fat-cmb-google-font-wrap');
                Fat_Cmb_Google_Font.fat_cmb_google_font_change($font_family_value, $field_container);
                Fat_Cmb_Google_Font.initFontPreview(1, $field_wrap);
            });

            $('.fat-cmb-google-font-wrap .fat-cmb-font-size, .fat-cmb-google-font-wrap .fat-cmb-letter-spacing, .fat-cmb-google-font-wrap .fat-cmb-line-height').off('change').on('change', function () {
                var $field_wrap = $(this).closest('.fat-cmb-google-font-wrap');
                Fat_Cmb_Google_Font.initFontPreview(0, $field_wrap);
            });

        },

        initFontPreview: function ($is_load_font_file, $field_wrap) {
            setTimeout(function () {
                var $link_font = 'https://fonts.googleapis.com/css?family=',
                    $font_file = $('input.fat-cmb-google-font-file', $field_wrap).val(),
                    $font_family_value = $('select.fat-cmb-font-family', $field_wrap).val(),
                    $font_size = $('input.fat-cmb-font-size', $field_wrap).val(),
                    $letter_spacing = $('input.fat-cmb-letter-spacing', $field_wrap).val(),
                    $line_height = $('input.fat-cmb-line-height', $field_wrap).val(),
                    $font_weight = $('select.fat-cmb-font-weight', $field_wrap).val(),
                    $font_subset = $('select.fat-cmb-font-subset', $field_wrap).val(),
                    $f_weight = 400, $f_style = 'normal', $font_weight_split;

                $f_weight = $font_weight;
                if (typeof $font_weight != 'undefined' && $font_weight.toLowerCase().indexOf('italic') >= 0) {
                    $f_weight = $font_weight.split('italic')[0];
                    $f_style = 'italic';
                }
                if (typeof $font_weight != 'undefined' && $font_weight.toLowerCase().indexOf('regular') >= 0) {
                    $f_weight = $font_weight.split('regular')[0];
                    $f_style = 'normal';
                }
                $f_weight = typeof $f_weight == 'undefined' || $f_weight == '' ? 400 : $f_weight;


                $link_font += $font_family_value;
                $link_font += ':100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i';
                $link_font += '&amp;' + $font_subset;
                if ($is_load_font_file == 1) {
                    $("head").append("<link href='" + $link_font + "' rel='stylesheet' type='text/css'>");
                }
                $('.fat-cmb-font-preview div', $field_wrap).fadeOut(500, function () {
                    $('.fat-cmb-font-preview > div', $field_wrap).css('font-family', $font_family_value);
                    $('.fat-cmb-font-preview > div', $field_wrap).css('font-size', $font_size + 'px');
                    $('.fat-cmb-font-preview > div', $field_wrap).css('font-weight', $f_weight);
                    $('.fat-cmb-font-preview > div', $field_wrap).css('font-style', $f_style);
                    if ($line_height != '') {
                        $('.fat-cmb-font-preview > div', $field_wrap).css('line-height', $line_height + 'em');
                    }
                    if ($letter_spacing != '') {
                        $('.fat-cmb-font-preview > div', $field_wrap).css('letter-spacing', $letter_spacing + 'em');
                    }
                    $('.fat-cmb-font-preview > div', $field_wrap).fadeIn();
                });
            }, 200);
        },

        fat_cmb_google_font_destroy_selectize_clone: function ($repeat_wrap) {
            $('.fat-cmb-repeat-field-group', $repeat_wrap).each(function () {
                var $field_group = $(this);
                $('.fat-cmb-google-font-wrap select', $field_group).each(function () {
                    if ($(this)[0].selectize) {
                        $(this).attr('data-selected', $(this).val());
                        $(this)[0].selectize.destroy();
                    }
                })
            })
        },

        fat_cmb_google_font_init_selectize_clone: function ($repeat_wrap) {
            $('.fat-cmb-repeat-field-group', $repeat_wrap).each(function () {
                var $field_group = $(this);
                $('.fat-cmb-google-font-wrap select', $field_group).each(function () {
                    var $font_family_value = $(this).attr('data-selected'),
                        $field_container;

                    if ($(this).hasClass('fat-cmb-font-family')) {
                        var $total_font = google_fonts.length,
                            $field_container = $(this).closest('.fat-cmb-field');
                        $('option', this).remove();
                        for (var $i = 0; $i < $total_font; $i++) {
                            if ($font_family_value == google_fonts[$i].family) {
                                $(this).append('<option selected value="' + google_fonts[$i].family + '">' + google_fonts[$i].family + '</option>');
                            } else {
                                $(this).append('<option value="' + google_fonts[$i].family + '">' + google_fonts[$i].family + '</option>');
                            }
                        }
                        $(this).selectize();
                        Fat_Cmb_Google_Font.fat_cmb_google_font_change($font_family_value, $field_container, 1);
                    }
                })
            });
            Fat_Cmb_Google_Font.initChangeFont();
        },

        fat_cmb_google_font_change: function ($font_family_value, $field_container, $is_set_by_default) {
            var $font_subset = $('.fat-cmb-font-subset', $field_container),
                $font_weight = $('.fat-cmb-font-weight', $field_container),
                $ul_font_file = $('ul.fat-cmb-google-font-file', $field_container),
                $input_font_file = $('input.fat-cmb-google-font-file', $field_container),
                $total_font = google_fonts.length,
                $option = {
                    plugins: ['remove_button', 'drag_drop'],
                    searchField: 'text',
                    delimiter: ',',
                    persist: false,
                };

            $is_set_by_default = typeof $is_set_by_default == 'undefined' ? 0 : $is_set_by_default;

            if ($($font_subset)[0].selectize) {
                $($font_subset)[0].selectize.destroy();
            }
            if ($($font_weight)[0].selectize) {
                $($font_weight)[0].selectize.destroy();
            }

            $('option', $font_subset).remove();
            $('option', $font_weight).remove();
            $('li', $ul_font_file).remove();

            for (var $i = 0; $i < $total_font; $i++) {
                if (typeof google_fonts[$i].family != 'undefined' && google_fonts[$i].family == $font_family_value) {
                    var $f_weight = '400',
                        $_style = 'Normal',
                        $font_file = '';
                    for (var $j = 0; $j < google_fonts[$i].variants.length; $j++) {
                        $f_weight = '400';
                        $_style = 'Normal';
                        if (google_fonts[$i].variants[$j].indexOf('italic') > 0) {
                            $_style = 'Italic';
                            $f_weight = google_fonts[$i].variants[$j].split('italic')[0];
                        } else {
                            $f_weight = google_fonts[$i].variants[$j] != 'regular' ? google_fonts[$i].variants[$j] : '400';
                        }
                        $font_file = google_fonts[$i].files[google_fonts[$i].variants[$j]];

                        $($ul_font_file).append('<li data-variant="' + google_fonts[$i].variants[$j] + '">' + $font_file + '</li>');
                        $($font_weight).append('<option data-font-file="' + $font_file + '" value="' + google_fonts[$i].variants[$j] + '">' + $_style + ' ' + $f_weight + '</option>');
                        if ($j == 0 && $is_set_by_default != 1) {
                            $('input.fat-cmb-google-font-file', $field_container).val(google_fonts[$i].files[google_fonts[$i].variants[$j]]);
                        }
                    }

                    if ($is_set_by_default == 1) {
                        var $font_weight_selected = $font_weight.attr('data-selected');
                        $font_weight_selected = $font_weight_selected === '400' ? 'regular' : $font_weight_selected;
                        if (typeof $font_weight_selected != 'undefined') {
                            $option.items = $font_weight_selected.split(',');
                        } else {
                            $option.items = [];
                        }
                    } else {
                        $option.items = [];
                    }
                    $font_weight.selectize($option);

                    for (var $j = 0; $j < google_fonts[$i].subsets.length; $j++) {
                        $($font_subset).append('<option value="' + google_fonts[$i].subsets[$j] + '">' + ( google_fonts[$i].subsets[$j].charAt(0).toUpperCase() + google_fonts[$i].subsets[$j].slice(1)) + '</option>');
                    }

                    if ($is_set_by_default == 1) {
                        var $font_subset_selected = $font_subset.attr('data-selected');
                        if (typeof $font_subset_selected != 'undefined') {
                            $option.items = $font_subset_selected.split(',');
                        } else {
                            $option.items = [];
                        }
                    } else {
                        $option.items = [];
                    }
                    $($font_subset).selectize($option);
                    return;
                }
            }
        }
    };
    $(document).ready(function () {
        Fat_Cmb_Google_Font.init();
    });
});