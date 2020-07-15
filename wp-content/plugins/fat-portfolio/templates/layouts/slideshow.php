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

$wrap_class = sprintf('fat-portfolio-shortcode fat-shortcode-%s clearfix  layout-%s ', $id, $layout_type);
$title_image_popup_gallery = isset($settings['title_image_popup_gallery']) ? $settings['title_image_popup_gallery'] : 'image_title';
$disable_detail = isset($settings['disable_detail']) ? $settings['disable_detail'] : '0';
?>
<div class="<?php echo esc_attr($wrap_class); ?>" id="<?php echo sprintf('fat-portfolio-shortcode-%s', $id); ?>"
     data-sc-name="<?php echo esc_attr($shortcode_name); ?>"
     data-title-image-popup="<?php echo esc_attr($title_image_popup_gallery); ?>"
>
    <div class="fat-item-wrap">
        <?php
        $galleries = array();
        $gallery_ids = array();
        $portfolio_gallery = $gallery_type = '';
        while ($posts->have_posts()) : $posts->the_post();
            $post_id = get_the_ID();
            if (has_post_thumbnail()) {
                $post_thumbnail_id = get_post_thumbnail_id($post_id);
                $gallery_ids[] = $post_thumbnail_id;
            }
            $gallery_type = get_post_meta($post_id, 'fat-meta-box-gallery-type', true);
            $portfolio_gallery = isset($gallery_type['fat_mb_image_gallery']) ? $gallery_type['fat_mb_image_gallery'] : '';
            $portfolio_gallery = explode(',', $portfolio_gallery);
            $gallery_ids = array_merge($gallery_ids, $portfolio_gallery);

        endwhile;
        wp_reset_postdata();

        $args = array(
            'orderby'        => 'post__in',
            'post__in'       => $gallery_ids,
            'post_type'      => 'attachment',
            'posts_per_page' => '-1',
            'post_status'    => 'inherit');

        $attachments = new WP_Query($args);
        global $post;
        $resize = null;
        $thumb = '';
        while ($attachments->have_posts()) : $attachments->the_post();
            $thumb = '';
            $resize = fat_portfolio_image_resize_id($post->ID, 274, 164 );
            $thumb = $resize && isset($resize['url']) ? $resize['url'] : $post->guid;
            $galleries[] = array(
                'url' => $post->guid,
                'thumb' => $thumb,
                'title' => $post->post_title,
                'excerpt' => $post->post_excerpt
            );
        endwhile;
        wp_reset_postdata();
        ?>
        <div class="owl-carousel main-slide" data-auto-height="1">
            <?php foreach($galleries as $key => $value){ ?>
                <div class="item">
                    <a class="nav-slideshow" href="<?php echo esc_url($value['url']); ?>" data-thumb="<?php echo esc_url($value['thumb']) ?>"
                       data-title="<?php echo esc_attr($value['excerpt']) ?>" data-sub-html="<?php echo esc_attr($value['excerpt']) ?>" data-description="<?php echo esc_attr($value['excerpt']) ?>"
                       data-index="<?php echo esc_attr($key) ?>">
                        <img alt="portfolio" src="<?php echo esc_url($value['url']); ?>" />
                    </a>
                </div>
            <?php } ?>
        </div>

        <div class="owl-carousel thumb-slide" data-current-index="0" data-total-items="<?php echo count($galleries); ?>">
            <?php
            if(isset($galleries) && is_array($galleries)) {
                foreach ($galleries as $key => $value) { ?>
                    <div class="thumb <?php if ($key == 0) {
                        echo 'active';
                    } ?>">
                        <a class="nav-thumb" href="javascript:"
                           data-index="<?php echo esc_attr($key) ?>">
                            <img src="<?php echo esc_url($value['thumb']) ?>"/>
                        </a>
                        <div class="bg-overlay fat-overlay transition"></div>
                    </div>
                <?php }
            }
            ?>
        </div>
    </div>
</div>
