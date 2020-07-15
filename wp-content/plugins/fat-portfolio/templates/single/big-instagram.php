<?php
/**
 * Created by PhpStorm.
 * User: roninwp
 * Date: 3/8/2017
 * Time: 9:19 AM
 */
?>
<div class="instagram-media-wrap social-media-wrap" data-instagram='<?php echo json_encode($instagram_gallery_filter); ?>'>
    <div class="owl-carousel main-slide social-media" id="main_slide_<?php echo esc_attr($post_id); ?>">
    </div>
    <div class="owl-carousel thumb-slide social-media" data-current-index="0" data-total-items="0" id="thumb_slide_<?php echo esc_attr($post_id); ?>">
    </div>
</div>

