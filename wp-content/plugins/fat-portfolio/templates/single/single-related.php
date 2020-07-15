<?php
/**
 * @package   Fat_Portfolio
 * @author    roninwp <kenus.ronin@gmail.com>
 * @copyright 2016 RoninWP
 */

$items_related = isset($settings['related_portfolio_item']) ? $settings['related_portfolio_item'] : 6;
$columns = 1;
$col_related = isset($settings['related_portfolio_col']) ? $settings['related_portfolio_col'] : 4;
$display_random_related = isset($settings['display_random_related']) ? $settings['display_random_related'] : 0;
$image_width = isset($settings['related_image_size_width']) ? $settings['related_image_size_width'] : 475;
$image_height = isset($settings['related_image_size_height']) ? $settings['related_image_size_height'] : 375;
$animation = 'none';
$args_related = array(
    'post__not_in' => array($post_id),
    'posts_per_page'   => $items_related,
    'post_type'        => FAT_PORTFOLIO_POST_TYPE,
    'tax_query' => array(
        array(
            'taxonomy' => FAT_PORTFOLIO_CATEGORY_TAXONOMY,
            'field'    => 'term_id',
            'terms'    => $arrCatId,
        ),
    ),
    'post_status'      => 'publish'
);
if($display_random_related){
    $args_related['orderby'] = 'rand';
}
$portfolio_relateds = new WP_Query( $args_related );
?>
<div class="portfolio-related-container fat-mg-bottom-50 fat-mg-top-50">
    <div class="fat-row">
        <div class="fat-col-md-12 fat-col-sm-12 fat-col-xs-12">
            <h4 class="related-title"><?php echo esc_attr($single_related_label); ?></h4>
        </div>
        <div class="fat-col-md-12  fat-col-sm-12 fat-col-xs-12">
            <div class="fat-item-wrap owl-carousel" data-fat-col="<?php echo esc_attr($col_related) ?>">
                <?php
                $skin = isset($settings['related_item_skin']) && $settings['related_item_skin']!='' ? $settings['related_item_skin'] :  'thumb-icon-hover';
                $skin_template = untrailingslashit(FAT_PORTFOLIO_DIR_PATH) . '/templates/items/'. $skin .'.php';
                if (!file_exists($skin_template)) {
                    echo esc_html_e('Could not found skin template', 'fat-portfolio');
                    return;
                }
                while ($portfolio_relateds->have_posts()) : $portfolio_relateds->the_post();
                    $cat = $cat_filter = $thumbnail_url = '';
                    $post_id = get_the_ID();
                    $terms = wp_get_post_terms(get_the_ID(), array(FAT_PORTFOLIO_CATEGORY_TAXONOMY));
                    foreach ($terms as $term) {
                        $cat_filter .= $term->slug . ' ';
                        $cat .= $term->name . ', ';
                    }
                    $cat = rtrim($cat, ', ');
                    if (has_post_thumbnail()) {
                        $post_thumbnail_id = get_post_thumbnail_id(get_the_ID());
                        $arrImages = wp_get_attachment_image_src($post_thumbnail_id, 'full');
                        if (count($arrImages) > 0) {
                            $url_origin = $arrImages[0];
                            $resize = fat_portfolio_image_resize_id($post_thumbnail_id, $image_width, $image_height);
                            if ($resize != null && is_array($resize))
                                $thumbnail_url = $resize['url'];
                        }
                    }
                    include $skin_template;
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </div>
</div>
