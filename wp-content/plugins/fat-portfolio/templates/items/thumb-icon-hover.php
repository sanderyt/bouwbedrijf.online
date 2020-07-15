<?php
/**
 * Created by PhpStorm.
 * User: roninwp
 * Date: 3/11/2017
 * Time: 11:02 AM
 */
$has_animation = $animation !='none' ? 'has-animation' : '';
$tax_filter = isset($tax_filter) ? $tax_filter : '';
$skin = isset($skin) ? $skin : '';

$item_per_page = isset($item_per_page) ? $item_per_page : 0;
$full_gallery_index = isset($full_gallery_index) ? $full_gallery_index : -1;

if(isset($is_layout_flipster) && $is_layout_flipster===true){
    $item_class = sprintf('fat-portfolio-item %s %s %s ', $cat_filter, $tax_filter, $skin);
    $item_tag = 'li';
}else{
    $item_class = sprintf('fat-portfolio-item fat-col-md-%s fat-col-sm-6 fat-col-xs-6 %s %s %s ',$columns, $cat_filter, $tax_filter, $skin);
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
    $link_to_detail = 'javascript:void(0);';
    $link_class = 'fat-disable-link';
}
?>
<<?php echo esc_attr($item_tag); ?> class="<?php echo esc_attr($item_class); ?>">
    <div class="fat-thumbnail" id="fat-thumbnail-<?php the_ID() ?>">
        <?php if($full_gallery_index <= $item_per_page || $item_per_page==0 || $item_per_page==-1): ?>
            <img src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php echo get_the_title(); ?>" width="<?php echo isset($image_width) ? $image_width : 475; ?>"
                 height="<?php echo isset($image_height) ? $image_height : 375; ?>"
            >
        <?php else: ?>
            <img data-src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php echo get_the_title(); ?>" width="<?php echo isset($image_width) ? $image_width : 475; ?>"
                 height="<?php echo isset($image_height) ? $image_height : 375; ?>"
            >
        <?php endif; ?>
        <div class="fat-hover-wrap transition-slow">
            <div class="fat-hover-inner transition-slow">
                <div class="icon">
                    <a href="<?php echo esc_url($url_origin); ?>" data-post-id="<?php echo esc_attr($post_id); ?>" class="fat-view-gallery <?php echo esc_attr($light_box); ?>"
                       data-post-title="<?php echo get_the_title($post_id) ; ?>"
                       data-guid="<?php echo esc_attr($id) ?>">
                        <i class="fa fa-search icon-effect"></i>
                    </a>
                    <a href="<?php echo esc_url($link_to_detail); ?>" class="<?php echo esc_attr($link_class); ?>">
                        <i class="fa fa-link  icon-effect"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</<?php echo esc_attr($item_tag); ?>>
