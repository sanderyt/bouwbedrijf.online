<?php
/**
 * Created by PhpStorm.
 * User: roninwp
 * Date: 3/8/2017
 * Time: 9:20 AM
 */
$settings = function_exists('fat_get_settings') ? fat_get_settings() : array();
$is_disable_crop_image = isset($settings['single_disable_crop_image']) ? $settings['single_disable_crop_image'] : 0;

$item_class = isset($gallery_position) && ($gallery_position == 'top' || $gallery_position == 'bottom') ? 'item col-md-4 col-sm-6 col-xs-12' : 'item col-md-6 col-xs-12';
?>
<div class="main-slide">
    <div class="row fat-portfolio-row" data-disable-crop="<?php echo esc_attr($is_disable_crop_image); ?>">
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
                if ($is_disable_crop_image != '1') {
                    $resize = fat_portfolio_image_resize_id($post->ID, 750, 550);
                    if ($resize && isset($resize['url'])) {
                        $img = $resize['url'];
                    } else {
                        $img = $post->guid;
                    }
                } else {
                    $img = $post->guid;
                }
                $image_thumbnails[] = $img;
                ?>
                <div class="<?php echo esc_attr($item_class); ?>">
                    <a class="nav-slideshow" href="<?php echo esc_url($post->guid); ?>"  data-description="<?php echo ($post->post_excerpt!='' ? $post->post_excerpt : $post->post_title);?>"
                       data-index="<?php echo esc_attr($index++) ?>">
                        <?php if (isset($img) && $img !== ''): ?>
                            <img alt="portfolio" src="<?php echo esc_url($img) ?>" />
                        <?php endif; ?>
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

</div>
