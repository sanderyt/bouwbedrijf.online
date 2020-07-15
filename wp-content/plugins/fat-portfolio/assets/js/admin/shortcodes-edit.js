(function ($) {
    "use strict";

    function Fat_portfolio_shortcode_animation() {
        $('#sc_animation').on('change', function () {
            var $animation_wrap = $('.animation-wrap');
            $animation_wrap.attr('class', 'animation-wrap animated ' + $(this).val());
            setTimeout(function () {
                $animation_wrap.attr('class', 'animation-wrap');
            }, 1000);
        });
        $('.preview-animation').on('click', function () {
            $('#sc_animation').trigger('change');
        });
    }

    function Fat_portfolio_shortcode_event_process() {

        //register image choice
        $('.image-item', '.fat-image-wrap').on('click', function () {
            var $layout_type = $(this).attr('data-value'),
                $image = $(this).attr('data-img'),
                $container = $(this).closest('.fat-image-wrap'),
                $tab_container = $(this).closest('.tab-setting');

            $('.image-item', $container).removeClass('active');
            $(this).addClass('active');
            $('input[type="hidden"]', $container).val($layout_type).trigger('change');

            if ($('.animation-wrap img', $tab_container).length > 0) {
                $('.animation-wrap img', $tab_container).attr('src', $image);
            }
        });

        //register shortcode name change
        $('#sc_name').on('keyup', function (event) {
            var $shortcode = '[fat_portfolio name="' + $(this).val() + '"]';
            $('#layout_shortcode').text($shortcode);
        });

        $('.sc-save', '.fat-shortcode-edit-wrap').off('click').on('click', function () {
            Fat_portfolio_shortcode_save();
        });

        //register copy clipboard
        var clipboard = new Clipboard('.copy-clipboard');
        clipboard.on('success', function (e) {
            $(e.trigger).append('<i class="fa fa-check active"></i>');
            e.clearSelection();
            setTimeout(function () {
                $('i.active', e.trigger).fadeOut(function () {
                    $(this).remove();
                });
            }, 2000);
        });
    }

    function Fat_portfolio_shortcode_save() {

        var $shortcode_config = {
            id: $('#sc_id').val(),
            name: $('#sc_name').val(),
            layout_type: $('#sc_layout_type').val(),
            light_box_gallery: $('#sc_light_box_gallery').val(),
            columns: $('#sc_columns').val(),
            gutter: $('#sc_gutter').val(),
            title_from: $('#sc_title_from').val(),
            image_width: $('#sc_image_width').val(),
            image_height: $('#sc_image_height').val(),
            crop_image: $('#sc_crop_image').is(":checked"),
            disable_crop_image: $('#sc_disable_crop_image').is(":checked"),
            full_gallery: $('#sc_full_gallery').is(":checked"),
            data_source: $('#sc_data_source').val(),
            categories: $('#sc_data_source_categories').val(),
            ds_country: $('#sc_data_source_country').val(),
            ds_years: $('#sc_data_source_years').val(),
            ds_type: $('#sc_data_source_type').val(),
            ds_status: $('#sc_data_source_status').val(),
            ids: $('#sc_data_source_ids').val(),
            author: $('#sc_data_source_author').val(),
            exclude_post: $('#sc_data_source_exclude_post').val(),
            filter_type: $('#sc_filter_type').val(),
            show_category: $('#sc_show_category').val(),
            hide_all_category: $('#sc_hide_all_category').is(":checked") ? 1 : 0,
            order: $('#sc_order').val(),
            order_by: $('#sc_order_by').val(),
            paging_type: $('#sc_paging_type').val(),
            item_per_page: $('#sc_item_per_page').val(),
            total_item: $('#sc_total_item').val(),
            prev_text: $('#sc_prev_text').val(),
            next_text: $('#sc_next_text').val(),
            paging_position: $('#sc_paging_position').val(),
            paging_background_color: $('#sc_paging_background_color').val(),
            paging_text_color: $('#sc_paging_text_color').val(),
            load_more: $('#sc_load_more_text').val(),
            load_more_background_color: $('#sc_load_more_background_color').val(),
            load_more_text_color: $('#sc_load_more_text_color').val(),
            load_more_background_hover_color: $('#sc_load_more_background_hover_color').val(),
            load_more_text_hover_color: $('#sc_load_more_text_hover_color').val(),
            infinity_loading_color: $('#sc_infinity_loading_color').val(),
            slider_total_item: $('#sc_slider_total_item').val(),
            slider_show_dot: $('#sc_slider_show_dot').is(":checked"),
            slider_show_nav_text:$('#sc_slider_show_nav_text').is(":checked"),
            slider_nav_bg_color: $('#sc_slider_nav_bg_color').val(),
            slider_nav_text_color: $('#sc_slider_nav_text_color').val(),
            slider_nav_bg_hover_color: $('#sc_slider_nav_bg_hover_color').val(),
            slider_nav_text_hover_color: $('#sc_slider_nav_text_hover_color').val(),
            slider_loop: $('#sc_slider_loop').is(":checked"),
            slider_auto_play:  $('#sc_slider_auto_play').is(":checked"),
            slider_auto_play_time: $('#sc_slider_auto_play_time').val(),
            slider_rtl: $('#sc_slider_rtl').is(":checked"),
            slider_desktop_large_column: $('#sc_slider_desktop_large_column').val(),
            slider_desktop_medium_column: $('#sc_slider_desktop_medium_column').val(),
            slider_desktop_medium_width: $('#sc_slider_desktop_medium_width').val(),
            slider_desktop_small_column: $('#sc_slider_desktop_small_column').val(),
            slider_desktop_small_width: $('#sc_slider_desktop_small_width').val(),
            slider_tablet_column: $('#sc_slider_tablet_column').val(),
            slider_tablet_width: $('#sc_slider_tablet_width').val(),
            slider_tablet_small_column: $('#sc_slider_tablet_small_column').val(),
            slider_tablet_small_width: $('#sc_slider_tablet_small_width').val(),
            slider_mobile_column: $('#sc_slider_mobile_column').val(),
            slider_mobile_width: $('#sc_slider_mobile_width').val(),
            flispter_total_item: $('#sc_flispter_total_item').val(),
            flispter_loop: $('#sc_flispter_loop').is(":checked"),
            flispter_autoplay: $('#sc_flispter_autoplay').val(),
            flispter_pause_on_hover: $('#sc_flispter_pause_on_hover').is(":checked"),
            flispter_item_spacing: $('#sc_flispter_item_spacing').val(),
            flispter_nav: $('#sc_flispter_nav').is(":checked"),
            flipster_nav_color: $('#sc_flipster_nav_color').val(),
            skin: $('#sc_skin').val(),
            limit_words_excerpt : $('#sc_limit_words_excerpt').val(),
            animation: $('#sc_animation').val(),
            animation_duration: $('#sc_animation_duration').val(),
            category_filter_font_size: $('#sc_category_filter_font_size').val(),
            category_filter_style: $('#sc_category_filter_style').val(),
            category_filter_weight: $('#sc_category_filter_weight').val(),
            category_filter_text_transform: $('#sc_category_filter_text_transform').val(),
            category_filter_letter_spacing: $('#sc_category_filter_letter_spacing').val(),
            category_filter_text_color: $('#sc_category_filter_text_color').val(),
            category_filter_text_hover_color: $('#sc_category_filter_text_hover_color').val(),
            category_font_size: $('#sc_category_font_size').val(),
            category_style: $('#sc_category_style').val(),
            category_style_weight: $('#sc_category_style_weight').val(),
            category_text_transform: $('#sc_category_text_transform').val(),
            category_letter_spacing: $('#sc_category_letter_spacing').val(),
            category_text_color: $('#sc_category_text_color').val(),
            title_font_size: $('#sc_title_font_size').val(),
            title_style: $('#sc_title_style').val(),
            title_style_weight: $('#sc_title_style_weight').val(),
            title_text_transform: $('#sc_title_text_transform').val(),
            title_letter_spacing: $('#sc_title_letter_spacing').val(),
            title_text_color: $('#sc_title_text_color').val(),
            icon_font_size: $('#sc_icon_font_size').val(),
            icon_color: $('#sc_icon_color').val(),
            icon_hover_color: $('#sc_icon_hover_color').val(),
            loading_color: $('#sc_loading_color').val(),
            bg_hover_color: $('#sc_bg_hover_color').val(),
            custom_css: $('#sc_custom_css').text()
        };

        if($shortcode_config.name==''){
            FatUtil.popupAlert('fa fa-exclamation-triangle', 'Please input shortcode name before save');
            return;
        }
        if($shortcode_config.layout_type==''){
            FatUtil.popupAlert('fa fa-exclamation-triangle', 'Please choice layout type before save');
            return;
        }
        if($shortcode_config.skin==''){
            FatUtil.popupAlert('fa fa-exclamation-triangle', 'Please choice skin before save');
            return;
        }


        FatUtil.showLoading('Save shortcode');

        $.ajax({
            url: shortcode_data.ajax_url,
            type: 'POST',
            data: ({
                action: 'fat_portfolio_shortcode_save',
                shortcode_config: $shortcode_config
            }),
            success: function (data) {
                data = JSON.parse(data);
                if (typeof data.code != 'undefined' && data.code == '-1') {
                    FatUtil.closeLoading(0);
                    FatUtil.popupAlert('fa fa-exclamation-triangle', data.message);
                } else {
                    $('#sc_id').val(data.id);
                    $('#layout_shortcode').text('[fat_portfolio name="' + $shortcode_config.name + '"]');
                    FatUtil.changeLoadingStatus('fa fa-check-square-o', 'Shortcode has been saved');
                   FatUtil.closeLoading();
                }
            },
            error: function () {
                FatUtil.changeLoadingStatus('fa fa-exclamation-triangle', 'Have error when save information');
                FatUtil.closeLoading();
            }
        });

    }
    $(document).ready(function () {
        Fat_portfolio_shortcode_event_process();
        Fat_portfolio_shortcode_animation();
    });
})(jQuery);
