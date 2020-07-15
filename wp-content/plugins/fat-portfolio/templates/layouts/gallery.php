<?php
/**
 * Created by PhpStorm.
 * User: roninwp
 * Date: 5/26/2017
 * Time: 9:02 PM
 */

$gallery_type = get_post_meta($post_id, 'fat-meta-box-gallery-type', true);
$portfolio_gallery = isset($gallery_type['fat_mb_image_gallery']) ? $gallery_type['fat_mb_image_gallery'] : array();
$gallery_ids = explode(',', $portfolio_gallery);
$get_origin_image_size = isset($get_origin_image_size) ? $get_origin_image_size : null;
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
$galleries = array();

while ($attachments->have_posts()) : $attachments->the_post();
    $thumb = '';
    if(isset($disable_crop_image) && $disable_crop_image){
        $thumb = $post->guid;
    }else{
        if(isset($layout_type) && $layout_type === 'masonry'){
            fat_resize_constrain($post->ID, $image_width, $image_height, $get_origin_image_size );
            $resize = fat_portfolio_image_resize_id($post->ID, $image_width, $image_height);
        }else{
            $resize = fat_portfolio_image_resize_id($post->ID, $image_width, $image_height);
        }

        if(isset($layout_type) &&
            ( $layout_type === 'metro-style-two' || $layout_type === 'metro-style-one' || $layout_type === 'metro-style-three')
        ){
            $metro_index = $layout_type === 'metro-style-three' ? ((($index - 1) % 10) + 1) : ((($index - 1) % 8) + 1);
            $metro_item =  $metro_grid[$metro_index];
            $resize =  fat_portfolio_image_resize_id($post->ID, $metro_item['width'], $metro_item['height']);

        }

        $thumb = $resize && isset($resize['url']) ? $resize['url'] : $post->guid;
    }

    $galleries[] = array(
        'post_thumbnail_id' => $post->ID,
        'url' => $post->guid,
        'thumb' => $thumb,
        'title' => $post->post_title,
        'excerpt' => $post->post_excerpt,
        'columns' => isset($metro_item['columns']) ? $metro_item['columns'] : $columns
    );
    $index++;
endwhile;
wp_reset_postdata();

if(is_array($galleries)){
    foreach($galleries as $key => $value){
        $url_origin = $value['url'];
        $thumbnail_url = $value['thumb'];
        $columns = $value['columns'];
        $post_thumbnail_id = $value['post_thumbnail_id'];
        include $skin_template;
        $full_gallery_index ++;
        $total_post ++;
    }
}
?>