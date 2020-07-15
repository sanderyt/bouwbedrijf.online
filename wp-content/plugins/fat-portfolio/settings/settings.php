<?php
/**
 * @package   Fat_Portfolio
 * @author    roninwp <kenus.ronin@gmail.com>
 * @copyright 2016 RoninWP
 */


$portfolio_categories = get_terms(FAT_PORTFOLIO_CATEGORY_TAXONOMY, array('hide_empty' => 0, 'orderby' => 'ASC'));

if (!current_user_can('edit_posts')) {
    wp_die(__('You do not have sufficient permissions to access this page.', 'fat-portfolio'));
}

$screen = get_current_screen();
$post_type = $screen->post_type;
if (!isset($post_type) || $post_type == '') {
    if (isset($_REQUEST['post_type'])) {
        $post_type = sanitize_key($_REQUEST['post_type']);
    }
}

$message = '';
$message_class = 'updated';

$fat_settings = array();
if (function_exists('fat_portfolio_get_setting_default')) {
    $fat_settings = fat_portfolio_get_setting_default();
}

$settings = get_option($post_type . '-settings');
if (isset($settings) && is_array($settings)) {
    $fat_settings = array_merge($fat_settings, $settings);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($fat_settings as $key => $value) {
        $fat_settings[$key] = isset($_POST[$key]) ? $_POST[$key] : '';
    }
    update_option($post_type . '-settings', $fat_settings);

    // set flag to flush rewrite rules
    update_option(FAT_PORTFOLIO_FLUSH_REWRITE_KEY, 1);

    $message = 'Your settings have been saved.';
}
if (isset($message) && $message != '') {
    ?>
    <div id="message" class="<?php echo esc_attr($message_class) ?>">
        <p><?php echo esc_html($message) ?> </p>
    </div>
<?php }

$args = array(
    'posts_per_page' => -1,
    'post_type' => 'page',
    'post_status' => 'publish'
);
$posts = new WP_Query($args);
$pages = array();
while ($posts->have_posts()) : $posts->the_post();
    $post_id = get_the_ID();
    $post_title = get_the_title();
    $pages[$post_id] = $post_title;
endwhile;
wp_reset_postdata();

$skins = array(
    'thumb-icon-hover' => esc_html__('Thumbnail, icon hover', 'fat-portfolio'),
    'thumb-icon-title-hover' => esc_html__('Thumbnail, icon - title hover', 'fat-portfolio'),
    'thumb-icon-title-cat-hover' => esc_html__('Thumbnail, icon - title - category hover', 'fat-portfolio'),
    'thumb-icon-gallery-hover' => esc_html__('Thumbnail, icon gallery hover', 'fat-portfolio'),
    'thumb-link-gallery' => esc_html__('Image gallery click able', 'fat-portfolio'),
    'thumb-link-detail' => esc_html__('Image to detail click able', 'fat-portfolio'),
    'thumb-title-cat-hover' => esc_html__('Thumbnail, title - category hover', 'fat-portfolio'),
    'thumb-title' => esc_html__('Thumbnail, title hover', 'fat-portfolio'),
    'thumb-title-cat-center' => esc_html__('Thumbnail, title - category - center', 'fat-portfolio'),
    'thumb-title-cat-left' => esc_html__('Thumbnail, title - category - left', 'fat-portfolio'),
    'thumb-cat-title-excerpt' => esc_html__('Thumbnail, category - title - excerpt', 'fat-portfolio'),
    'thumb-title-date-excerpt' => esc_html__('Thumbnail, title - date - excerpt', 'fat-portfolio')
);
do_action('wpml_register_single_string', 'fat-portfolio', 'All Country', $fat_settings['all_country_label']);
do_action('wpml_register_single_string', 'fat-portfolio', 'All Years', $fat_settings['all_years_label']);
do_action('wpml_register_single_string', 'fat-portfolio', 'All Type', $fat_settings['all_type_label']);
do_action('wpml_register_single_string', 'fat-portfolio', 'All Status', $fat_settings['all_status_label']);
do_action('wpml_register_single_string', 'fat-portfolio', 'All Portfolio', $fat_settings['all_category_label']);
do_action('wpml_register_single_string', 'fat-portfolio', 'Project info label', $fat_settings['project_info_label']);
do_action('wpml_register_single_string', 'fat-portfolio', 'Project detail label', $fat_settings['project_detail_label']);
do_action('wpml_register_single_string', 'fat-portfolio', 'More detail label', $fat_settings['more_detail_label']);
do_action('wpml_register_single_string', 'fat-portfolio', 'Single Category label', $fat_settings['single_category_label']);
do_action('wpml_register_single_string', 'fat-portfolio', 'Single Related label', $fat_settings['single_related_label']);
do_action('wpml_register_single_string', 'fat-portfolio', 'Single Show info label', $fat_settings['single_show_info_label']);
do_action('wpml_register_single_string', 'fat-portfolio', 'Single Hide info label', $fat_settings['single_hide_info_label']);

?>
<div class="wrap">
    <h1></h1>
    <form name="frmFatPortfolioSetting" id="frmFatPortfolioSetting" method="post"
          class="fat-portfolio-setting fat-portfolio-tabs"
          action="">
        <h1 class="setting-title">FAT Portfolio Settings</h1>
        <ul class="tab-settings-nav">
            <li class="active"><a href="#"
                                  data-tab="tab-layout">
                    <i class="fa fa-cogs"></i>
                    <span><?php echo esc_html__('General Setting', 'fat-portfolio'); ?></span>
                </a>
            </li>
            <li><a href="#" data-tab="tab-single">
                    <i class="fa fa-sliders"></i>
                    <span><?php echo esc_html__('Single Setting', 'fat-portfolio'); ?></a></span>
            </li>

            <li><a href="#" data-tab="tab-custom-css">
                    <i class="fa fa-paint-brush" aria-hidden="true"></i>
                    <span><?php echo esc_html__('Single Custom CSS', 'fat-portfolio'); ?></span>
                </a></li>
        </ul>

        <div class="tab-setting active" id="tab-layout">
            <ul>
                <li class="field-group">
                    <div class="fat-title"><?php echo esc_html__('Post type name:', 'fat-portfolio'); ?></div>
                    <div class="fat-field">
                        <input type="text" name="post_type_name"
                               value="<?php echo esc_attr($fat_settings['post_type_name']) ?>">
                    </div>
                </li>
                <li class="field-group">
                    <div class="fat-title"><?php echo esc_html__('Post type slug:', 'fat-portfolio'); ?></div>
                    <div class="fat-field">
                        <input type="text" name="post_type_slug"
                               value="<?php echo esc_attr($fat_settings['post_type_slug']) ?>">

                        <span class="description"><?php esc_html_e('Remember go to Setting -> Permalinks and click Save Change after change Post type slug to apply change', 'fat-portfolio'); ?></span>
                    </div>

                </li>
                <li class="field-group">
                    <div class="fat-title"><?php echo esc_html__('Enable custom structure slug', 'fat-portfolio'); ?></div>
                    <div class="fat-field">
                        <input type="checkbox" name="enable_pattern_slug" value="1"
                               title="Enable custom structure" <?php if (isset($fat_settings['enable_pattern_slug']) && $fat_settings['enable_pattern_slug'] === '1') {
                            echo 'checked';
                        } ?> >
                    </div>
                    <div class="fat-desc">
                        <span class="description"><?php esc_html_e('If you want use slug: %category%/%portfolio_name%  please check this option. If choose this, it will be override \'Post type slug\' above', 'fat-portfolio'); ?></span>
                    </div>
                </li>

                <li class="field-group">
                    <div class="fat-title"><?php echo esc_html__('Category name:', 'fat-portfolio'); ?></div>
                    <div class="fat-field">
                        <input type="text" name="taxonomy_name"
                               value="<?php echo esc_attr($fat_settings['taxonomy_name']) ?>">
                    </div>
                </li>

                <li class="field-group">
                    <div class="fat-title"><?php echo esc_html__('Category slug:', 'fat-portfolio'); ?></div>
                    <div class="fat-field">
                        <input type="text" name="taxonomy_slug"
                               value="<?php echo esc_attr($fat_settings['taxonomy_slug']) ?>">
                    </div>
                </li>

                <li class="field-group">
                    <div class="fat-title"><?php echo esc_html__('Tag name:', 'fat-portfolio'); ?></div>
                    <div class="fat-field">
                        <input type="text" name="tag_name"
                               value="<?php echo esc_attr($fat_settings['tag_name']) ?>">
                    </div>
                </li>

                <li class="field-group">
                    <div class="fat-title"><?php echo esc_html__('Tag slug:', 'fat-portfolio'); ?></div>
                    <div class="fat-field">
                        <input type="text" name="tag_slug"
                               value="<?php echo esc_attr($fat_settings['tag_slug']) ?>">
                    </div>
                </li>

                <!-- start special attribute slug -->
                <?php
                $show_special_attr = 'style = "display:none"';
                if (isset($fat_settings['enable_special_attribute']) && $fat_settings['enable_special_attribute'] == '1') {
                    $show_special_attr = '';
                } ?>

                <li class="field-group" <?php echo sprintf('%s', $show_special_attr); ?> >
                    <div class="fat-title"><?php echo esc_html__('Country name:', 'fat-portfolio'); ?></div>
                    <div class="fat-field">
                        <input type="text" name="country_name"
                               value="<?php echo esc_attr($fat_settings['country_name']) ?>">
                    </div>
                </li>

                <li class="field-group" <?php echo sprintf('%s', $show_special_attr); ?>>
                    <div class="fat-title"><?php echo esc_html__('Country slug:', 'fat-portfolio'); ?></div>
                    <div class="fat-field">
                        <input type="text" name="country_slug"
                               value="<?php echo esc_attr($fat_settings['country_slug']) ?>">
                    </div>
                </li>

                <li class="field-group" <?php echo sprintf('%s', $show_special_attr); ?>>
                    <div class="fat-title"><?php echo esc_html__('Years name:', 'fat-portfolio'); ?></div>
                    <div class="fat-field">
                        <input type="text" name="years_name"
                               value="<?php echo esc_attr($fat_settings['years_name']) ?>">
                    </div>
                </li>

                <li class="field-group" <?php echo sprintf('%s', $show_special_attr); ?>>
                    <div class="fat-title"><?php echo esc_html__('Years slug:', 'fat-portfolio'); ?></div>
                    <div class="fat-field">
                        <input type="text" name="years_slug"
                               value="<?php echo esc_attr($fat_settings['years_slug']) ?>">
                    </div>
                </li>

                <li class="field-group" <?php echo sprintf('%s', $show_special_attr); ?>>
                    <div class="fat-title"><?php echo esc_html__('Type name:', 'fat-portfolio'); ?></div>
                    <div class="fat-field">
                        <input type="text" name="type_name"
                               value="<?php echo esc_attr($fat_settings['type_name']) ?>">
                    </div>
                </li>

                <li class="field-group" <?php echo sprintf('%s', $show_special_attr); ?>>
                    <div class="fat-title"><?php echo esc_html__('Type slug:', 'fat-portfolio'); ?></div>
                    <div class="fat-field">
                        <input type="text" name="type_slug"
                               value="<?php echo esc_attr($fat_settings['type_slug']) ?>">
                    </div>
                </li>

                <li class="field-group" <?php echo sprintf('%s', $show_special_attr); ?>>
                    <div class="fat-title"><?php echo esc_html__('Status name:', 'fat-portfolio'); ?></div>
                    <div class="fat-field">
                        <input type="text" name="status_name"
                               value="<?php echo esc_attr($fat_settings['status_name']) ?>">
                    </div>
                </li>

                <li class="field-group" <?php echo sprintf('%s', $show_special_attr); ?>>
                    <div class="fat-title"><?php echo esc_html__('Status slug:', 'fat-portfolio'); ?></div>
                    <div class="fat-field">
                        <input type="text" name="status_slug"
                               value="<?php echo esc_attr($fat_settings['status_slug']) ?>">
                    </div>
                </li>

                <!-- end special attribute slug -->

                <li class="field-group">
                    <div class="fat-title"><?php echo esc_html__('Archive page:', 'fat-portfolio'); ?></div>
                    <div class="fat-field">
                        <select name="archive_page">
                            <option value=""><?php esc_html_e('Disable archive page', 'fat-portfolio'); ?></option>
                            <?php foreach ($pages as $key => $value) { ?>
                                <option
                                        value="<?php echo esc_attr($key); ?>" <?php echo isset($fat_settings['archive_page']) && $fat_settings['archive_page'] == $key ? 'selected' : ''; ?> ><?php echo esc_html($value); ?></option>
                            <?php }; ?>
                        </select>
                    </div>
                </li>

                <li class="field-group">
                    <div class="fat-title"><?php echo esc_html__('Archive Tag page:', 'fat-portfolio'); ?></div>
                    <div class="fat-field">
                        <select name="archive_tag_page">
                            <option value=""><?php esc_html_e('Disable archive tag page', 'fat-portfolio'); ?></option>
                            <?php foreach ($pages as $key => $value) { ?>
                                <option
                                        value="<?php echo esc_attr($key); ?>" <?php echo isset($fat_settings['archive_tag_page']) && $fat_settings['archive_tag_page'] == $key ? 'selected' : ''; ?> ><?php echo esc_html($value); ?></option>
                            <?php }; ?>
                        </select>
                    </div>
                </li>

                <?php if (isset($fat_settings['enable_special_attribute']) && $fat_settings['enable_special_attribute'] == '1') : ?>
                    <li class="field-group">
                        <div class="fat-title"><?php echo esc_html__('Archive special attribute page:', 'fat-portfolio'); ?></div>
                        <div class="fat-field">
                            <select name="archive_attr_page">
                                <option value=""><?php esc_html_e('Disable archive attribute page', 'fat-portfolio'); ?></option>
                                <?php foreach ($pages as $key => $value) { ?>
                                    <option
                                            value="<?php echo esc_attr($key); ?>" <?php echo isset($fat_settings['archive_attr_page']) && $fat_settings['archive_attr_page'] == $key ? 'selected' : ''; ?> ><?php echo esc_html($value); ?></option>
                                <?php }; ?>
                            </select>
                        </div>
                    </li>

                    <li class="field-group">
                        <div class="fat-title"><?php echo esc_html__('All country label:', 'fat-portfolio'); ?></div>
                        <div class="fat-field">
                            <input type="text" name="all_country_label"
                                   value="<?php echo esc_attr($fat_settings['all_country_label']) ?>">
                        </div>
                    </li>

                    <li class="field-group">
                        <div class="fat-title"><?php echo esc_html__('All years label:', 'fat-portfolio'); ?></div>
                        <div class="fat-field">
                            <input type="text" name="all_years_label"
                                   value="<?php echo esc_attr($fat_settings['all_years_label']) ?>">
                        </div>
                    </li>

                    <li class="field-group">
                        <div class="fat-title"><?php echo esc_html__('All type label:', 'fat-portfolio'); ?></div>
                        <div class="fat-field">
                            <input type="text" name="all_type_label"
                                   value="<?php echo esc_attr($fat_settings['all_type_label']) ?>">
                        </div>
                    </li>

                    <li class="field-group">
                        <div class="fat-title"><?php echo esc_html__('All status label:', 'fat-portfolio'); ?></div>
                        <div class="fat-field">
                            <input type="text" name="all_status_label"
                                   value="<?php echo esc_attr($fat_settings['all_status_label']) ?>">
                        </div>
                    </li>

                <?php endif; ?>

                <li class="field-group">
                    <div class="fat-title"><?php echo esc_html__('All category label:', 'fat-portfolio'); ?></div>
                    <div class="fat-field">
                        <input type="text" name="all_category_label"
                               value="<?php echo esc_attr($fat_settings['all_category_label']) ?>">
                    </div>
                </li>

                <li class="field-group">
                    <div class="fat-title"><?php echo esc_html__('Title image in popup gallery:', 'fat-portfolio'); ?></div>
                    <div class="fat-field">
                        <select name="title_image_popup_gallery">
                            <option value="image_title" <?php if ($fat_settings['title_image_popup_gallery'] === 'image_title') {
                                echo 'selected';
                            }; ?> ><?php esc_html_e('Image title', 'fat-portfolio'); ?></option>
                            <option value="image_caption" <?php if ($fat_settings['title_image_popup_gallery'] === 'image_caption') {
                                echo 'selected';
                            }; ?> ><?php esc_html_e('Image caption', 'fat-portfolio'); ?></option>
                            <option value="portfolio_title" <?php if ($fat_settings['title_image_popup_gallery'] === 'portfolio_title') {
                                echo 'selected';
                            }; ?>><?php esc_html_e('Portfolio/Project title', 'fat-portfolio'); ?></option>
                        </select>
                    </div>
                </li>

                <li class="field-group">
                    <div class="fat-title"><?php echo esc_html__('Enable special attribute', 'fat-portfolio'); ?></div>
                    <div class="fat-field">
                        <input type="checkbox" name="enable_special_attribute" value="1"
                               title="Enable special attribute" <?php if (isset($fat_settings['enable_special_attribute']) && $fat_settings['enable_special_attribute'] === '1') {
                            echo 'checked';
                        } ?> >
                    </div>
                    <div class="fat-desc">
                        <span class="description"><?php esc_html_e('Choice this option to enable Country, Year, Type, Status attribute', 'fat-portfolio'); ?></span>
                    </div>
                </li>

                <li class="field-group">
                    <div class="fat-title"><?php echo esc_html__('Disable view detail:', 'fat-portfolio'); ?></div>
                    <div class="fat-field">
                        <input type="checkbox" name="disable_detail" value="1"
                               title="Disable view detail" <?php if (isset($fat_settings['disable_detail']) && $fat_settings['disable_detail'] === '1') {
                            echo 'checked';
                        } ?> >
                    </div>
                </li>

                <li class="field-group">
                    <div class="fat-title"><?php echo esc_html__('Exclude thumbnail for popup gallery:', 'fat-portfolio'); ?></div>
                    <div class="fat-field">
                        <input type="checkbox" name="exclude_thumbnail" value="1"
                               title="Exclude thumbnail" <?php if (isset($fat_settings['exclude_thumbnail']) && $fat_settings['exclude_thumbnail'] === '1') {
                            echo 'checked';
                        } ?> >
                    </div>
                </li>

                <li class="field-group">
                    <div class="fat-title"><?php echo esc_html__('Load script with ajax switch page:', 'fat-portfolio'); ?></div>
                    <div class="fat-field">
                        <input type="checkbox" name="load_script_first"
                               value="1" <?php if (isset($fat_settings['load_script_first']) && $fat_settings['load_script_first'] === '1') {
                            echo 'checked';
                        } ?> >
                    </div>
                    <div class="fat-desc">
                        <span class="description"><?php esc_html_e('Choice this option to load script when website load in theme what use ajax switch page', 'fat-portfolio'); ?></span>
                    </div>

                </li>

                <li class="field-group">
                    <div class="fat-title"><?php echo esc_html__('Unload script:', 'fat-portfolio'); ?></div>
                    <div class="fat-field">
                        <p>
                            <input type="checkbox" name="unload_script_modernizr"
                                   value="1" <?php if (isset($fat_settings['unload_script_modernizr']) && $fat_settings['unload_script_modernizr'] === '1') {
                                echo 'checked';
                            } ?> > Unload Modernizr
                        </p>
                        <p>
                            <input type="checkbox" name="unload_script_isotope"
                                   value="1" <?php if (isset($fat_settings['unload_script_isotope']) && $fat_settings['unload_script_isotope'] === '1') {
                                echo 'checked';
                            } ?> > Unload Isotope
                        </p>
                        <p>
                            <input type="checkbox" name="unload_script_owl_carousel"
                                   value="1" <?php if (isset($fat_settings['unload_script_owl_carousel']) && $fat_settings['unload_script_owl_carousel'] === '1') {
                                echo 'checked';
                            } ?> > Unload Owl-Carousel
                        </p>
                        <p>
                            <input type="checkbox" name="unload_script_magnific_popup"
                                   value="1" <?php if (isset($fat_settings['unload_script_magnific_popup']) && $fat_settings['unload_script_magnific_popup'] === '1') {
                                echo 'checked';
                            } ?> > Unload Magnific Popup
                        </p>
                        <p>
                            <input type="checkbox" name="unload_script_light_gallery"
                                   value="1" <?php if (isset($fat_settings['unload_script_light_gallery']) && $fat_settings['unload_script_light_gallery'] === '1') {
                                echo 'checked';
                            } ?> > Unload Light Gallery
                        </p>
                        <p>
                            <input type="checkbox" name="unload_script_flipster"
                                   value="1" <?php if (isset($fat_settings['unload_script_flipster']) && $fat_settings['unload_script_flipster'] === '1') {
                                echo 'checked';
                            } ?> > Unload flipster carousel
                        </p>
                        <p>
                            <input type="checkbox" name="unload_script_waterwheel_carousel"
                                   value="1" <?php if (isset($fat_settings['unload_script_waterwheel_carousel']) && $fat_settings['unload_script_waterwheel_carousel'] === '1') {
                                echo 'checked';
                            } ?> > Unload Waterwheel Carousel
                        </p>
                    </div>
                    <div class="fat-desc">
                        <span class="description"><?php esc_html_e('Choice this option to unload some script to resolve duplicate with your theme', 'fat-portfolio'); ?></span>
                    </div>

                </li>

                <li class="field-group">
                    <div class="fat-title">&nbsp;</div>
                    <div class="fat-field">
                        <input class="button button-large button-primary" type="submit" value="Save Changes"/>
                    </div>
                </li>

            </ul>
        </div>
        <div class="tab-setting" id="tab-single">
            <ul>

                <li class="field-group">
                    <div class="fat-title"><?php esc_html_e('Show single page title:', 'fat-portfolio'); ?></div>
                    <div class="fat-field">
                        <input type="checkbox" name="show_single_page_title" value="1"
                               title="Show single page title" <?php if (isset($fat_settings['show_single_page_title']) && $fat_settings['show_single_page_title'] === '1') {
                            echo 'checked';
                        } ?> >
                    </div>
                </li>

                <li class="field-group">
                    <div class="fat-title"><?php echo esc_html__('Single layout:', 'fat-portfolio'); ?></div>
                    <div class="fat-field">
                        <select name="single_layout">
                            <option
                                    value="single-small-image-slide-left" <?php if ($fat_settings['single_layout'] == 'single-small-image-slide-left') {
                                echo 'selected';
                            } ?> ><?php echo esc_html__('Small image slide left', 'fat-portfolio'); ?></option>

                            <option
                                    value="single-small-image-slide-right" <?php if ($fat_settings['single_layout'] == 'single-small-image-slide-right') {
                                echo 'selected';
                            } ?> ><?php echo esc_html__('Small image slide right', 'fat-portfolio'); ?></option>

                            <option
                                    value="single-big-image-slide" <?php if ($fat_settings['single_layout'] == 'single-big-image-slide') {
                                echo 'selected';
                            } ?> ><?php echo esc_html__('Big image slide', 'fat-portfolio'); ?></option>

                            <option
                                    value="single-big-image-slide-post-content" <?php if ($fat_settings['single_layout'] == 'single-big-image-slide-post-content') {
                                echo 'selected';
                            } ?> ><?php echo esc_html__('Big image slide with portfolio content center', 'fat-portfolio'); ?></option>

                            <option
                                    value="single-big-image-slide-content-float" <?php if ($fat_settings['single_layout'] == 'single-big-image-slide-content-float') {
                                echo 'selected';
                            } ?> ><?php echo esc_html__('Big image slide with content float', 'fat-portfolio'); ?></option>

                            <option
                                    value="single-horizonal-image-left" <?php if ($fat_settings['single_layout'] == 'single-horizonal-image-left') {
                                echo 'selected';
                            } ?> ><?php echo esc_html__('Horizonal image left', 'fat-portfolio'); ?></option>

                            <option
                                    value="single-horizonal-image-right" <?php if ($fat_settings['single_layout'] == 'single-horizonal-image-right') {
                                echo 'selected';
                            } ?> ><?php echo esc_html__('Horizonal image right', 'fat-portfolio'); ?></option>

                            <option
                                    value="single-image-gallery-left" <?php if ($fat_settings['single_layout'] == 'single-image-gallery-left') {
                                echo 'selected';
                            } ?> ><?php echo esc_html__('Image gallery left', 'fat-portfolio'); ?></option>

                            <option
                                    value="single-image-gallery-right" <?php if ($fat_settings['single_layout'] == 'single-image-gallery-right') {
                                echo 'selected';
                            } ?> ><?php echo esc_html__('Image gallery right', 'fat-portfolio'); ?></option>

                            <option
                                    value="single-image-gallery-top" <?php if ($fat_settings['single_layout'] == 'single-image-gallery-top') {
                                echo 'selected';
                            } ?> ><?php echo esc_html__('Image gallery top', 'fat-portfolio'); ?></option>

                            <option
                                    value="single-image-gallery-bottom" <?php if ($fat_settings['single_layout'] == 'single-image-gallery-bottom') {
                                echo 'selected';
                            } ?> ><?php echo esc_html__('Image gallery bottom', 'fat-portfolio'); ?></option>

                            <option
                                    value="single-small-video-slide-left" <?php if ($fat_settings['single_layout'] == 'single-small-video-slide-left') {
                                echo 'selected';
                            } ?> ><?php echo esc_html__('Small video slide left', 'fat-portfolio'); ?></option>

                            <option
                                    value="single-small-video-slide-right" <?php if ($fat_settings['single_layout'] == 'single-small-video-slide-right') {
                                echo 'selected';
                            } ?> ><?php echo esc_html__('Small video slide right', 'fat-portfolio'); ?></option>

                            <option
                                    value="single-big-video-slide" <?php if ($fat_settings['single_layout'] == 'single-big-video-slide') {
                                echo 'selected';
                            } ?> ><?php echo esc_html__('Big video slide', 'fat-portfolio'); ?></option>

                            <option
                                    value="single-big-video-slide-post-content" <?php if ($fat_settings['single_layout'] == 'single-big-video-slide-post-content') {
                                echo 'selected';
                            } ?> ><?php echo esc_html__('Big video slide with portfolio content', 'fat-portfolio'); ?></option>

                            <?php if (isset($fat_settings['enable_special_attribute']) && $fat_settings['enable_special_attribute'] == '1') : ?>
                                <option
                                        value="single-attr-big-image-slide" <?php if ($fat_settings['single_layout'] == 'single-attr-big-image-slide') {
                                    echo 'selected';
                                } ?> ><?php echo esc_html__('Big image slide with special attribute', 'fat-portfolio'); ?></option>
                            <?php endif; ?>

                        </select>
                    </div>

                </li>

                <li class="field-group">
                    <div class="fat-title"><?php echo esc_attr__('Light box type:', 'fat-portfolio'); ?></div>
                    <div class="fat-field">
                        <select name="single_light_box_gallery">
                            <option value="magnific-popup" <?php echo isset($fat_settings['single_light_box_gallery']) && $fat_settings['single_light_box_gallery'] === 'magnific-popup' ? 'selected' : ''; ?> ><?php esc_html_e('Magnific popup gallery', 'fat-portfolio'); ?></option>
                            <option value="light-gallery" <?php echo isset($fat_settings['single_light_box_gallery']) && $fat_settings['single_light_box_gallery'] === 'light-gallery' ? 'selected' : ''; ?> ><?php esc_html_e('Light box gallery', 'fat-portfolio'); ?></option>
                        </select>
                    </div>
                </li>

                <li class="field-group">
                    <div class="fat-title"><?php esc_html_e('Disable crop image:', 'fat-portfolio'); ?></div>
                    <div class="fat-field">
                        <input type="checkbox" name="single_disable_crop_image" value="1"
                               title="Disable crop image" <?php if (isset($fat_settings['single_disable_crop_image']) && $fat_settings['single_disable_crop_image'] === '1') {
                            echo 'checked';
                        } ?> >
                    </div>
                </li>

                <li class="field-group">
                    <div class="fat-title"><?php esc_html_e('Big slide image size:', 'fat-portfolio'); ?></div>
                    <div class="fat-field">
                        <input type="number" name="single_big_image_size_width" id="single_big_image_size_width"
                               class="number"
                               value="<?php echo esc_attr($fat_settings['single_big_image_size_width']) ?>"/> x <input
                                value="<?php echo esc_attr($fat_settings['single_big_image_size_height']) ?>"
                                type="number"
                                name="single_big_image_size_height" id="single_big_image_size_height" class="number"/>
                        (px)
                    </div>
                    <div class="fat-desc">
                        <span
                                class="description"><?php esc_html_e('The image size for Big slide. Default: 1170 x 700', 'fat-portfolio'); ?></span>
                    </div>
                </li>

                <li class="field-group">
                    <div class="fat-title"><?php esc_html_e('Small slide image size:', 'fat-portfolio'); ?></div>
                    <div class="fat-field">
                        <input type="number" name="single_small_image_size_width" id="single_small_image_size_width"
                               class="number"
                               value="<?php echo esc_attr($fat_settings['single_small_image_size_width']) ?>"/> x <input
                                value="<?php echo esc_attr($fat_settings['single_small_image_size_height']) ?>"
                                type="number"
                                name="single_small_image_size_height" id="single_small_image_size_height"
                                class="number"/> (px)
                    </div>
                    <div class="fat-desc">
                        <span
                                class="description"><?php esc_html_e('The image size for small slide. Default: 750x450 (Ex: Image gallery slide left, slide right)', 'fat-portfolio'); ?></span>
                    </div>
                </li>

                <li class="field-group">
                    <div class="fat-title"><?php echo esc_html__('Project info label:', 'fat-portfolio'); ?></div>
                    <div class="fat-field">
                        <input type="text" name="project_info_label"
                               value="<?php echo esc_attr($fat_settings['project_info_label']) ?>">
                    </div>
                </li>

                <li class="field-group">
                    <div class="fat-title"><?php echo esc_html__('Project detail label:', 'fat-portfolio'); ?></div>
                    <div class="fat-field">
                        <input type="text" name="project_detail_label"
                               value="<?php echo esc_attr($fat_settings['project_detail_label']) ?>">
                    </div>
                </li>

                <li class="field-group">
                    <div class="fat-title"><?php echo esc_html__('More detail label:', 'fat-portfolio'); ?></div>
                    <div class="fat-field">
                        <input type="text" name="more_detail_label"
                               value="<?php echo esc_attr($fat_settings['more_detail_label']) ?>">
                    </div>
                </li>

                <li class="field-group">
                    <div class="fat-title"><?php echo esc_html__('Category label:', 'fat-portfolio'); ?></div>
                    <div class="fat-field">
                        <input type="text" name="single_category_label"
                               value="<?php echo esc_attr($fat_settings['single_category_label']) ?>">
                    </div>
                </li>
                <li class="field-group">
                    <div class="fat-title"><?php echo esc_html__('Related label:', 'fat-portfolio'); ?></div>
                    <div class="fat-field">
                        <input type="text" name="single_related_label"
                               value="<?php echo esc_attr($fat_settings['single_related_label']) ?>">
                    </div>
                </li>

                <li class="field-group">
                    <div class="fat-title"><?php echo esc_html__('Show info label:', 'fat-portfolio'); ?></div>
                    <div class="fat-field">
                        <input type="text" name="single_show_info_label"
                               value="<?php echo esc_attr($fat_settings['single_show_info_label']) ?>">
                    </div>
                </li>

                <li class="field-group">
                    <div class="fat-title"><?php echo esc_html__('Hide info label:', 'fat-portfolio'); ?></div>
                    <div class="fat-field">
                        <input type="text" name="single_hide_info_label"
                               value="<?php echo esc_attr($fat_settings['single_hide_info_label']) ?>">
                    </div>
                </li>

                <!-- <li class="field-group">
                    <div class="fat-title"><?php /*esc_html_e('Enable Social Share:', 'fat-portfolio'); */ ?></div>
                    <div class="fat-field">
                        <input type="checkbox" name="enable_social_share" value="1"
                               title="Enable Social Share" <?php /*if (isset($fat_settings['enable_social_share']) && $fat_settings['enable_social_share'] === '1') {
                            echo 'checked';
                        } */ ?> >
                    </div>
                </li>-->

                <li class="field-group">
                    <div class="fat-title"><?php esc_html_e('Enable link on category:', 'fat-portfolio'); ?></div>
                    <div class="fat-field">
                        <input type="checkbox" name="enable_link_on_category" value="1"
                               title="Enable link on category" <?php if (isset($fat_settings['enable_link_on_category']) && $fat_settings['enable_link_on_category'] === '1') {
                            echo 'checked';
                        } ?> >
                    </div>
                </li>

                <li class="field-group">
                    <div class="fat-title"><?php esc_html_e('Enable Navigation:', 'fat-portfolio'); ?></div>
                    <div class="fat-field">
                        <input type="checkbox" name="enable_navigation" value="1"
                               title="Enable Navigation" <?php if (isset($fat_settings['enable_navigation']) && $fat_settings['enable_navigation'] === '1') {
                            echo 'checked';
                        } ?> >
                    </div>
                </li>
                <li class="field-group">
                    <div class="fat-title"><?php esc_html_e('Navigation in same category:', 'fat-portfolio'); ?></div>
                    <div class="fat-field">
                        <input type="checkbox" name="navigation_in_same_category" value="1"
                               title="Navigation in same category" <?php if (isset($fat_settings['navigation_in_same_category']) && $fat_settings['navigation_in_same_category'] === '1') {
                            echo 'checked';
                        } ?> >
                    </div>
                    <div class="fat-desc">
                        <span
                                class="description"><?php esc_html_e('If check this then it navigation only apply on portfolio what same category with current portfolio, else it show all', 'fat-portfolio'); ?></span>
                    </div>
                </li>

                <li class="field-group">
                    <div class="fat-title"><?php esc_html_e('Enable related portfolio:', 'fat-portfolio'); ?></div>
                    <div class="fat-field">
                        <input type="checkbox" name="enable_related_portfolio" value="1"
                               title="Enable related portfolio" <?php if (isset($fat_settings['enable_related_portfolio']) && $fat_settings['enable_related_portfolio'] === '1') {
                            echo 'checked';
                        } ?> >
                    </div>
                </li>

                <li class="field-group">
                    <div class="fat-title"><?php echo esc_html__('Related item skin:', 'fat-portfolio'); ?></div>
                    <div class="fat-field">
                        <select name="related_item_skin">
                            <?php foreach ($skins as $key => $value) { ?>
                                <option value="<?php echo esc_attr($key); ?>" <?php echo isset($fat_settings['related_item_skin']) && $fat_settings['related_item_skin'] == $key ? 'selected' : ''; ?>><?php echo esc_html($value); ?></option>
                            <?php }; ?>
                        </select>
                    </div>

                </li>

                <li class="field-group">
                    <div class="fat-title"><?php esc_html_e('Display random related:', 'fat-portfolio'); ?></div>
                    <div class="fat-field">
                        <input type="checkbox" name="display_random_related" value="1"
                               title="Display random related" <?php if (isset($fat_settings['display_random_related']) && $fat_settings['display_random_related'] === '1') {
                            echo 'checked';
                        } ?> >
                    </div>
                </li>
                <li class="field-group">
                    <div class="fat-title"><?php esc_html_e('Related portfolio columns:', 'fat-portfolio'); ?></div>
                    <div class="fat-field">
                        <input type="number" name="related_portfolio_col"
                               value="<?php echo esc_attr($fat_settings['related_portfolio_col']) ?>"
                               id="related_portfolio_col" min="1" max="4">
                    </div>
                </li>
                <li class="field-group">
                    <div class="fat-title"><?php esc_html_e('Related portfolio items:', 'fat-portfolio'); ?></div>
                    <div class="fat-field">
                        <input type="number" name="related_portfolio_item"
                               value="<?php echo esc_attr($fat_settings['related_portfolio_item']) ?>"
                               id="related_portfolio_item" min="1">
                    </div>
                </li>

                <li class="field-group">
                    <div class="fat-title"><?php esc_html_e('Related image size:', 'fat-portfolio'); ?></div>
                    <div class="fat-field">
                        <input type="number" name="related_image_size_width" id="related_image_size_width"
                               class="number"
                               value="<?php echo esc_attr($fat_settings['related_image_size_width']) ?>"/> x <input
                                value="<?php echo esc_attr($fat_settings['related_image_size_height']) ?>" type="number"
                                name="related_image_size_height" id="related_image_size_height" class="number"/> (px)
                    </div>
                    <div class="fat-desc">
                        <span
                                class="description"><?php esc_html_e('The image size for thumbnails', 'fat-portfolio'); ?></span>
                    </div>
                </li>

                <li class="field-group">
                    <div class="fat-title"><?php echo esc_html__('Unload:', 'fat-portfolio'); ?></div>
                    <div class="fat-field">
                        <p>
                            <input type="checkbox" name="single_unload_header"
                                   value="1" <?php if (isset($fat_settings['single_unload_header']) && $fat_settings['single_unload_header'] === '1') {
                                echo 'checked';
                            } ?> > <?php esc_html_e('Unload Header', 'fat-portfolio'); ?>
                        </p>
                        <p>
                            <input type="checkbox" name="single_unload_footer"
                                   value="1" <?php if (isset($fat_settings['single_unload_footer']) && $fat_settings['single_unload_footer'] === '1') {
                                echo 'checked';
                            } ?> > <?php esc_html_e('Unload Footer', 'fat-portfolio'); ?>
                        </p>
                        <p>
                            <input type="checkbox" name="single_unload_bootstrap"
                                   value="1" <?php if (isset($fat_settings['single_unload_bootstrap']) && $fat_settings['single_unload_bootstrap'] === '1') {
                                echo 'checked';
                            } ?> > <?php esc_html_e('Unload Bootstrap Font', 'fat-portfolio'); ?>
                        </p>
                    </div>
                    <div class="fat-desc">
                        <span class="description"><?php esc_html_e('Choice this option to unload header, footer or bootstrap to resolve duplicate with your theme', 'fat-portfolio'); ?></span>
                    </div>

                </li>

                <li class="field-group">
                    <div class="fat-title">&nbsp;</div>
                    <div class="fat-field">
                        <input class="button button-large button-primary" type="submit" value="Save Changes"/>
                    </div>
                </li>
            </ul>
        </div>
        <div class="tab-setting" id="tab-custom-css">
            <ul>
                <li class="field-group">
                    <div class="fat-title"><?php esc_html_e('Custom Css', 'fat-portfolio'); ?></div>
                    <div class="fat-field">
                        <textarea name="custom_css"
                                  style="display: none"><?php echo isset($fat_settings['custom_css']) ? $fat_settings['custom_css'] : ''; ?></textarea>
                        <pre id="custom_css" class="ace-editor custom-css"
                             data-mode="css"><?php echo isset($fat_settings['custom_css']) ? $fat_settings['custom_css'] : ''; ?></pre>
                    </div>
                </li>
                <li class="field-group">
                    <div class="fat-title">&nbsp;</div>
                    <div class="fat-field">
                        <input class="button button-large button-primary" type="submit" value="Save Changes"/>
                    </div>
                </li>
            </ul>
        </div>
    </form>
</div>