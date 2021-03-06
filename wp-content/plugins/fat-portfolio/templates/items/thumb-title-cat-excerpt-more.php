<?php
/**
 * Created by PhpStorm.
 * User: roninwp
 * Date: 3/11/2017
 * Time: 11:02 AM
 */
$has_animation = $animation != 'none' ? 'has-animation' : '';
$tax_filter = isset($tax_filter) ? $tax_filter : '';
$skin = isset($skin) ? $skin : '';

$item_per_page = isset($item_per_page) ? $item_per_page : -1;
$full_gallery_index = isset($full_gallery_index) ? $full_gallery_index : 0;

if(isset($is_layout_flipster) && $is_layout_flipster===true){
    $item_class = sprintf('fat-portfolio-item %s %s %s ', $cat_filter, $tax_filter, $skin);
    $item_tag = 'li';
}else{
    $item_class = sprintf('fat-portfolio-item fat-col-md-%s fat-col-sm-6 fat-col-xs-6 %s %s %s ',$columns, $tax_filter, $cat_filter, $skin);
    $item_tag = 'div';
}
$item_class .= isset($css_class) ? $css_class : '';
$item_class .= $full_gallery_index > $item_per_page && $item_per_page !=-1 ? ' fat-lazy-load' : '';

$light_box = isset($light_box) ? $light_box : 'magnific-popup';
$link_to_detail =  get_post_meta($post_id,'fat-mb-portfolio-general',true);
if(isset($link_to_detail['link_to_detail']) && $link_to_detail['link_to_detail']!=''){
    $link_to_detail = $link_to_detail['link_to_detail'];
}else{
    $link_to_detail = isset($post_id) ?  get_permalink($post_id) : get_permalink();
}
$link_class = '';
if(isset($disable_detail) && $disable_detail=='1'){
    $link_to_detail = 'javascript:;';
    $link_class = 'fat-disable-link';
}
$title = isset($get_title_from) && $get_title_from === 'image-title' && isset($post_thumbnail_id) ? get_the_title($post_thumbnail_id) : get_the_title($post_id);
$excerpt = isset($get_title_from) && $get_title_from === 'image-title' && isset($post_thumbnail_id) ? get_the_excerpt($post_thumbnail_id) : get_the_excerpt($post_id);
?>
<<?php echo esc_attr($item_tag); ?> class="<?php echo esc_attr($item_class); ?> thumb-title-cat-excerpt-more">
<div class="fat-thumbnail" id="fat-thumbnail-<?php echo esc_attr($post_id); ?>">
    <div class="thumb-cat-title-wrap">
        <?php if($full_gallery_index <= $item_per_page || $item_per_page==0 || $item_per_page==-1): ?>
            <img src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php echo esc_attr($title); ?>" width="<?php echo isset($image_width) ? $image_width : 475; ?>"
                 height="<?php echo isset($image_height) ? $image_height : 375; ?>"
            >
        <?php else: ?>
            <img data-src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php echo esc_attr($title); ?>" width="<?php echo isset($image_width) ? $image_width : 475; ?>"
                 height="<?php echo isset($image_height) ? $image_height : 375; ?>"
            >
        <?php endif; ?>
        <div class="fat-hover-wrap transition-slow">
            <div class="fat-hover-inner transition-slow">
                <a href="<?php the_permalink($post_id); ?>">
                </a>
            </div>
        </div>
    </div>
    <div class="fat-title-cat-wrap">
        <div class="title">
            <a href="<?php echo esc_attr($link_to_detail); ?>" title="<?php echo esc_attr($title); ?>" class="<?php echo esc_attr($link_class); ?>">
                <?php echo esc_html($title); ?>
            </a>
        </div>
        <div class="category">
            <?php echo wp_kses_post($cat); ?>
        </div>
        <?php if(isset($settings['enable_special_attribute']) && $settings['enable_special_attribute'] == '1') : ?>
            <div class="attributes">
                <?php
                $tax = isset($tax) ? $tax : '';
                echo sprintf('%s', $tax); ?>
            </div>
        <?php endif; ?>

        <div class="excerpt">
            <?php
            if(isset($limit_excerpt) && $limit_excerpt > 0){
                echo wp_trim_words($excerpt, $limit_excerpt, ' ...');
            }else{
                echo wp_kses_post($excerpt);
            }
            ?>
        </div>
    </div>
    <div class="fat-item-footer">
        <a href="<?php echo esc_url($link_to_detail); ?>" class="more <?php echo esc_attr($link_class);?>">
            <?php esc_html_e('More', 'fat-portfolio'); ?>
        </a>
    </div>
</div>
</<?php echo esc_attr($item_tag); ?>>
