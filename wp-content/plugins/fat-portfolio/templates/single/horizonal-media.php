<?php
/**
 * Created by PhpStorm.
 * User: roninwp
 * Date: 3/8/2017
 * Time: 2:12 PM
 */
$settings = function_exists('fat_get_settings') ? fat_get_settings() : array();
$is_disable_crop_image = isset($settings['single_disable_crop_image']) ? $settings['single_disable_crop_image'] : 0;

if (count($portfolio_gallery) > 0) {
    $index = 0;
    foreach ($portfolio_gallery as $image) {
        $urls = wp_get_attachment_image_src($image, 'full');
        $img = '';
        if (is_array($urls) && count($urls) > 0) {
            if($is_disable_crop_image != '1'){
                $resize = fat_portfolio_image_resize_id($image, 770, 497);
                if ($resize && isset($resize['url'])) {
                    $img = $resize['url'];
                } else {
                    $img = $urls[0];
                }
            }else{
                $img = $urls[0];
            }

            $image_thumbnails[] = $img;
        }
        ?>
        <div class="item  fat-mg-bottom-30">
            <img alt="portfolio" src="<?php echo esc_url($img) ?>" />
        </div>
    <?php }
} else {
    if (is_array($template_args['imgThumbs']) && count($template_args['imgThumbs']) > 0) { ?>
        <div class="item">
            <img alt="portfolio"
                 src="<?php echo esc_url($template_args['imgThumbs'][0]) ?>" /></div>
    <?php }
}
?>
