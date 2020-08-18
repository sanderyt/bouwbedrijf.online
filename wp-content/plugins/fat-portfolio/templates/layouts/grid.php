<?php
/**
 * @package   Fat_Portfolio
 * @author    roninwp <kenus.ronin@gmail.com>
 * @copyright 2016 RoninWP
 */

if ($paging_type == 'show_all' || $item_per_page == '') {
    $item_per_page = -1;
    $total_item = 0;
}

$offset = $item_per_page > 0 ? ($current_page - 1) * $item_per_page : 0;

$args = array(
    'offset'         => $offset,
    'posts_per_page' => $item_per_page,
    'post_type'      => FAT_PORTFOLIO_POST_TYPE,
    'post_status'    => 'publish'
);


$current_categories = isset($_GET['category']) ? explode(',', $_GET['category']) : $categories;
$current_categories = isset($atts['category']) && $atts['category'] != '' ? explode(',', $atts['category']) : $current_categories;
if ($data_source === 'categories' || $data_source === 'categories_attrs') {
    $args[FAT_PORTFOLIO_CATEGORY_TAXONOMY] = $current_categories;
} else {
    $args['post__in'] = $ids;
}

if (isset($atts['category']) && $atts['category'] != '') {
    $args[FAT_PORTFOLIO_CATEGORY_TAXONOMY] = $current_categories;
}

/* country taxonomy */
$current_country = isset($_GET['country']) ? explode(',', $_GET['country']) : $country_attr;
$current_country = isset($atts['country']) && $atts['country'] != '' ? explode(',', $atts['country']) : $current_country;
if ($data_source === 'categories_attrs' && isset($enable_special_attr) && $enable_special_attr) {
    $args[FAT_PORTFOLIO_COUNTRY_TAXONOMY] = $current_country;
    if (isset($atts['country']) && $atts['country'] != '') {
        $args[FAT_PORTFOLIO_COUNTRY_TAXONOMY] = $current_country;
    }
}

/* years taxonomy */
$current_years = isset($_GET['years']) ? explode(',', $_GET['years']) : $years_attr;
$current_years = isset($atts['years']) && $atts['years'] != '' ? explode(',', $atts['years']) : $current_years;
if ($data_source === 'categories_attrs' && isset($enable_special_attr) && $enable_special_attr) {
    $args[FAT_PORTFOLIO_YEARS_TAXONOMY] = $current_years;
    if (isset($atts['years']) && $atts['years'] != '') {
        $args[FAT_PORTFOLIO_YEARS_TAXONOMY] = $current_years;
    }
}


/* type taxonomy */
$current_type = isset($_GET['type']) ? explode(',', $_GET['type']) : $type_attr;
$current_type = isset($atts['type']) && $atts['type'] != '' ? explode(',', $atts['type']) : $current_type;
if ($data_source === 'categories_attrs' && isset($enable_special_attr) && $enable_special_attr) {
    $args[FAT_PORTFOLIO_TYPE_TAXONOMY] = $current_type;
    if (isset($atts['type']) && $atts['type'] != '') {
        $args[FAT_PORTFOLIO_TYPE_TAXONOMY] = $current_type;
    }
}


/* status taxonomy */
$current_status = isset($_GET['status']) ? explode(',', $_GET['status']) : $status_attr;
$current_status = isset($atts['status']) && $atts['status'] != '' ? explode(',', $atts['status']) : $current_status;
if ($data_source === 'categories_attrs' && isset($enable_special_attr) && $enable_special_attr) {
    $args[FAT_PORTFOLIO_STATUS_TAXONOMY] = $current_status;
    if (isset($atts['status']) && $atts['status'] != '') {
        $args[FAT_PORTFOLIO_STATUS_TAXONOMY] = $current_status;
    }
}


if (isset($_GET['tag']) && $_GET['tag'] != '') {
    $args[FAT_PORTFOLIO_TAG_TAXONOMY] = $_GET['tag'];
}

if (isset($exclude_post) && is_array($exclude_post) && count($exclude_post) > 0) {
    $args['post__not_in'] = $exclude_post;
}

if (isset($authors) && is_array($authors) && count($authors) > 0) {
    $args['author__in'] = $authors;
}

if ($order_by) {
    $args['orderby'] = isset($order_by[0]) ? $order_by[0] : $order_by;
    $args['order'] = $order;
}
$posts = new WP_Query($args);
$total_post = $posts->found_posts;

$has_animation = $animation != 'none' ? 'has-animation' : '';
$wrap_class = sprintf('fat-portfolio-shortcode fat-shortcode-%s clearfix fat-padding-%s filter-%s %s %s layout-%s ', $id, $gutter, $filter_type, $skin, $has_animation, $layout_type);
$wrap_class .= isset($full_gallery) && $full_gallery ? ' fat-full-gallery' : '';
$title_image_popup_gallery = isset($settings['title_image_popup_gallery']) ? $settings['title_image_popup_gallery'] : 'image_title';
$disable_detail = isset($settings['disable_detail']) ? $settings['disable_detail'] : '0';
$disable_crop_image =  isset($shortcode['disable_crop_image']) && $shortcode['disable_crop_image'] == 'true';
$wrap_class .= $full_gallery ? ' full-gallery' : '';
$wrap_class .= isset($hide_all_category) && $hide_all_category && $show_category!=='none' ? ' hide-all-category' : '';
$style = isset($hide_all_category) && $hide_all_category && $show_category!=='none' ? "opacity:0" : 'opacity:1';
?>
<div class="<?php echo esc_attr($wrap_class); ?>" id="<?php echo sprintf('fat-portfolio-shortcode-%s', $id); ?>"
     data-sc-name="<?php echo esc_attr($shortcode_name); ?>"
     data-animation="<?php echo esc_attr($animation); ?>"
     data-animation-duration="<?php echo esc_attr($animation_duration); ?>"
     data-fat-col="<?php echo esc_attr($columns); ?>"
     data-title-image-popup="<?php echo esc_attr($title_image_popup_gallery); ?>"
     data-item-per-page="<?php echo esc_attr($item_per_page);?>"
     style="<?php echo esc_html($style);?>"
>
    <?php
    if (isset($shortcode['data_source']) && $shortcode['data_source'] == 'categories_attrs' && isset($enable_special_attr) && $enable_special_attr) {
        $category_template = untrailingslashit(FAT_PORTFOLIO_DIR_PATH) . '/templates/layouts/category-attrs.php';
    } else {
        $category_template = untrailingslashit(FAT_PORTFOLIO_DIR_PATH) . '/templates/layouts/category.php';
    }
    if (file_exists($category_template)) {
        include $category_template;
    }
    ?>
    <div class="fat-item-wrap">
        <?php
        $skin_template = untrailingslashit(FAT_PORTFOLIO_DIR_PATH) . '/templates/items/' . $skin . '.php';
        if (!file_exists($skin_template)) {
            echo esc_html_e('Could not found skin template', 'fat-portfolio');
            return;
        }
        $index = $full_gallery_index = 1;
        $portfolio_general = null;
        while ($posts->have_posts()) : $posts->the_post();

            if ($total_item > 0 && ($offset + $index > $total_item)) {
                break;
            }
            $post_id = get_the_ID();
            $portfolio_general = get_post_meta($post_id, 'fat-mb-portfolio-general', false);
            $portfolio_general = isset($portfolio_general[0]) ? $portfolio_general[0] : array();
            $css_class = isset($portfolio_general['css_class']) ? $portfolio_general['css_class'] : '';

            $date = get_the_date('', $post_id);
            $cat = $cat_filter = $tax = $tax_filter = $thumbnail_url = $url_origin = '';

            if (isset($enable_special_attr) && $enable_special_attr) {
                $terms = wp_get_post_terms($post_id, array(
                    FAT_PORTFOLIO_CATEGORY_TAXONOMY,
                    FAT_PORTFOLIO_COUNTRY_TAXONOMY,
                    FAT_PORTFOLIO_YEARS_TAXONOMY,
                    FAT_PORTFOLIO_TYPE_TAXONOMY,
                    FAT_PORTFOLIO_STATUS_TAXONOMY
                ));
            } else {
                $terms = wp_get_post_terms($post_id, array(
                    FAT_PORTFOLIO_CATEGORY_TAXONOMY
                ));
            }


            if (isset($enable_special_attr) && $enable_special_attr) {
                foreach ($terms as $term) {
                    if (isset($term->taxonomy) && $term->taxonomy === FAT_PORTFOLIO_COUNTRY_TAXONOMY) {
                        $tax_filter .= 'country-' . $term->slug . ' ';
                    }
                    if (isset($term->taxonomy) && $term->taxonomy === FAT_PORTFOLIO_YEARS_TAXONOMY) {
                        $tax_filter .= 'years-' . $term->slug . ' ';
                    }
                    if (isset($term->taxonomy) && $term->taxonomy === FAT_PORTFOLIO_TYPE_TAXONOMY) {
                        $tax_filter .= 'type-' . $term->slug . ' ';
                    }
                    if (isset($term->taxonomy) && $term->taxonomy === FAT_PORTFOLIO_STATUS_TAXONOMY) {
                        $tax_filter .= 'status-' . $term->slug . ' ';
                    }
                    $tax .= '<a href="' . get_term_link($term) . '">' . $term->name . '</a>' . ', ';
                }
            }

            foreach ($terms as $term) {
                if (isset($term->taxonomy) && $term->taxonomy === FAT_PORTFOLIO_CATEGORY_TAXONOMY) {
                    $cat_filter .= $term->slug . ' ';
                    $cat .= $term->name . ', ';
                }
            }
            $cat = rtrim($cat, ', ');
            $tax = rtrim($tax, ', ');

            if (has_post_thumbnail()) {
                $post_thumbnail_id = get_post_thumbnail_id($post_id);

                $arrImages = wp_get_attachment_image_src($post_thumbnail_id, 'full');
                if (count($arrImages) > 0) {
                    $url_origin = $arrImages[0];
                    if(!$disable_crop_image){
                        $resize =  fat_portfolio_image_resize_id($post_thumbnail_id, $image_width, $image_height);
                        if ($resize != null && is_array($resize))
                            $thumbnail_url = $resize['url'];
                    }else{
                        $thumbnail_url = $arrImages[0];
                    }
                }
                include $skin_template;
                $index++;
                $full_gallery_index++;
            }

            /* include gallery */
            if (isset($full_gallery) && $full_gallery) {
                $full_gallery_template = untrailingslashit(FAT_PORTFOLIO_DIR_PATH) . '/templates/layouts/gallery.php';
                if (file_exists($full_gallery_template)) {
                    include $full_gallery_template;
                }
            }

        endwhile;
        wp_reset_postdata();


        ?>
    </div>

    <?php
    if ($paging_type != 'show_all') {
        $paging_template = untrailingslashit(FAT_PORTFOLIO_DIR_PATH) . '/templates/layouts/' . $paging_type . '.php';
        if (file_exists($paging_template)) {
            include $paging_template;
        }
    }
    ?>
</div>
