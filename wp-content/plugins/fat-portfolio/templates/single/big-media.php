<?php
/**
 * Created by PhpStorm.
 * User: roninwp
 * Date: 3/8/2017
 * Time: 9:20 AM
 */

$settings = function_exists('fat_get_settings') ? fat_get_settings() : array();
$is_disable_crop_image = isset($settings['single_disable_crop_image']) ? $settings['single_disable_crop_image'] : 0;

if(isset($detail_style) && ($detail_style =='single-small-image-slide-left' || $detail_style =='single-small-image-slide-right' )){
    $width = isset($settings['single_small_image_size_width']) ? $settings['single_small_image_size_width'] : '';
    $height = isset($settings['single_small_image_size_height']) ? $settings['single_small_image_size_height'] : '';
}else{
    $width = isset($settings['single_big_image_size_width']) ? $settings['single_big_image_size_width'] : '';
    $height = isset($settings['single_big_image_size_height']) ? $settings['single_big_image_size_height'] : '';
}
?>
<div class="owl-carousel main-slide" data-auto-height="<?php echo $is_disable_crop_image != '1' ? 0 : 1; ?>">
    <?php if (count($portfolio_gallery) > 0) {
        $index = 0;
        $args_attachment = array(
            'orderby'        => 'post__in',
            'post__in'       => $portfolio_gallery,
            'post_type'      => 'attachment',
            'posts_per_page' => '-1',
            'post_status'    => 'inherit');

        $attachments = new WP_Query($args_attachment);
        global $post;
        $img = '';
        while ($attachments->have_posts()) : $attachments->the_post();
            $img = '';
            if($width !='' && $height !='' && $is_disable_crop_image != '1'){
                $resize = fat_portfolio_image_resize_id($post->ID, $width, $height );
                if ($resize && isset($resize['url'])) {
                    $img = $resize['url'];
                }else{
                    $img = $post->guid;
                }
            }else{
                $img = $post->guid;
            }
            $resize = fat_portfolio_image_resize_id($post->ID, 274, 164 );
            if ($resize && isset($resize['url'])) {
                $image_thumbnails[] = $resize['url'];
            }else{
                $image_thumbnails[] = $post->guid;
            }
            ?>
            <div class="item">
                <a class="nav-slideshow" href="<?php echo esc_url($post->guid); ?>" data-description="<?php echo ($post->post_excerpt!='' ? $post->post_excerpt : $post->post_title);?>"
                   data-index="<?php echo esc_attr($index++) ?>">
                    <img alt="portfolio" src="<?php echo esc_url($img) ?>" />
                    <span class="fat-portfolio-image-title">
                        <?php echo esc_html($post->post_title);?>
                    </span>
                </a>
            </div>
            <?php
        endwhile;
        wp_reset_postdata();
    } else {
        if (is_array($template_args['imgThumbs']) && count($template_args['imgThumbs']) > 0) { ?>
            <div class="item">
                <img alt="portfolio"
                     src="<?php echo esc_url($template_args['imgThumbs'][0]) ?>" /></div>
        <?php }
    }
    ?>
</div>
<div class="owl-carousel thumb-slide" data-current-index="0" data-total-items="<?php echo count($image_thumbnails); ?>">
    <?php
    $index = 0;
    foreach($image_thumbnails as $thumb){ ?>
        <div class="thumb <?php if($index==0){echo 'active';} ?>">
            <a class="nav-thumb" href="javascript:"
               data-index="<?php echo esc_attr($index++) ?>">
                <img src="<?php echo esc_url($thumb) ?>" />
            </a>
            <div class="bg-overlay fat-overlay transition"></div>
        </div>
    <?php } ?>
</div>
