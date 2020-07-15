<?php
/**
 * @package   Fat_Portfolio
 * @author    roninwp <kenus.ronin@gmail.com>
 * @copyright 2016 RoninWP
 */
if (!function_exists('fat_portfolio_get_setting_default')) {
    function fat_portfolio_get_setting_default()
    {
        return array(
            'post_type_name'                    => FAT_PORTFOLIO_POST_TYPE_NAME,
            'post_type_slug'                    => FAT_PORTFOLIO_POST_TYPE,
            'enable_pattern_slug'               => '0',
            'taxonomy_name'                     => FAT_PORTFOLIO_CATEGORY_TAXONOMY_NAME,
            'taxonomy_slug'                     => FAT_PORTFOLIO_CATEGORY_TAXONOMY,
            'tag_name'                          => FAT_PORTFOLIO_TAG_TAXONOMY_NAME,
            'tag_slug'                          => FAT_PORTFOLIO_TAG_TAXONOMY,
            'country_name'                      => FAT_PORTFOLIO_COUNTRY_TAXONOMY_NAME,
            'country_slug'                      => FAT_PORTFOLIO_COUNTRY_TAXONOMY,
            'years_name'                        => FAT_PORTFOLIO_YEARS_TAXONOMY_NAME,
            'years_slug'                        => FAT_PORTFOLIO_YEARS_TAXONOMY,
            'type_name'                         => FAT_PORTFOLIO_TYPE_TAXONOMY_NAME,
            'type_slug'                         => FAT_PORTFOLIO_TYPE_TAXONOMY,
            'status_name'                       => FAT_PORTFOLIO_STATUS_TAXONOMY_NAME,
            'status_slug'                       => FAT_PORTFOLIO_STATUS_TAXONOMY,
            'archive_page'                      => '',
            'archive_tag_page'                  => '',
            'archive_attr_page'                 => '',
            'all_country_label'                 => esc_html__('All country', 'fat-portfolio'),
            'all_years_label'                   => esc_html__('All years', 'fat-portfolio'),
            'all_type_label'                    => esc_html__('All type', 'fat-portfolio'),
            'all_status_label'                  => esc_html__('All status', 'fat-portfolio'),
            'all_category_label'                => esc_html__('All Portfolio', 'fat-portfolio'),
            'enable_special_attribute'          => 0,
            'disable_detail'                    => 0,
            'exclude_thumbnail'                    => 0,
            'title_image_popup_gallery'         => 'image_title',
            'load_script_first'                 => 0,
            'unload_script_modernizr'           => 0,
            'unload_script_isotope'             => 0,
            'unload_script_owl_carousel'        => 0,
            'unload_script_magnific_popup'      => 0,
            'unload_script_light_gallery'       => 0,
            'unload_script_flipster'            => 0,
            'unload_script_waterwheel_carousel' => 0,
            'show_single_page_title'            => 0,
            'single_layout'                     => '',
            'single_light_box_gallery'          => 'magnific-popup',
            'single_disable_crop_image'         => 0,
            'single_big_image_size_width'       => 1170,
            'single_big_image_size_height'      => 700,
            'single_small_image_size_width'     => 750,
            'single_small_image_size_height'    => 450,
            'project_info_label'                => 'Project info',
            'single_category_label'             => 'Category',
            'project_detail_label'              => 'Project detail',
            'more_detail_label'                 => 'More detail',
            'single_related_label'              => 'Related',
            'single_show_info_label'            => 'Show info',
            'single_hide_info_label'            => 'Hide info',
            'enable_link_on_category'           => 1,
            'enable_social_share'               => 1,
            'enable_navigation'                 => 1,
            'navigation_in_same_category'       => 0,
            'enable_related_portfolio'          => 1,
            'related_item_skin'                 => '',
            'display_random_related'            => 0,
            'related_portfolio_col'             => 3,
            'related_portfolio_item'            => 6,
            'related_image_size_width'          => 375,
            'related_image_size_height'         => 275,
            'single_unload_header'              => 0,
            'single_unload_footer'              => 0,
            'single_unload_bootstrap'           => 0,
            'custom_css'                        => '',
        );
    }
}

if (!function_exists('fat_get_settings')) {
    function fat_get_settings()
    {
        $fat_settings = array();
        if (function_exists('fat_portfolio_get_setting_default')) {
            $fat_settings = fat_portfolio_get_setting_default();
        }
        $settings = get_option(FAT_PORTFOLIO_POST_TYPE . '-settings');
        if (isset($settings) && is_array($settings)) {
            $fat_settings = array_merge($fat_settings, $settings);
        }
        return $fat_settings;
    }
}

if (!function_exists('fat_portfolio_get_template_path')) {
    function fat_portfolio_get_template_path($template, $atts)
    {
        $path = untrailingslashit(FAT_PORTFOLIO_DIR_PATH) . '/templates/' . $template . '.php';
        if (file_exists($path)) {
            include($path);
        } else {
            echo 'Could not find template';
        }
    }
}