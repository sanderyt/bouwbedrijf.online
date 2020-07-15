<?php
/**
 * Created by PhpStorm.
 * User: roninwp
 * Date: 3/8/2017
 * Time: 2:47 PM
 */
?>
<div class="owl-carousel main-slide">
                <?php  if (count($portfolio_attributes) > 0) {
    $index = 0;
    for($i=0; $i<count($portfolio_videos['link_video']);$i++){
        ?>
        <div class="item">
            <a class="nav-slideshow" href="javascript:"
               data-index="<?php echo esc_attr($index++) ?>">
                <?php echo sprintf('%s',$portfolio_videos['link_video'][$i]); ?>
            </a>
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
</div>
<div class="owl-carousel thumb-slide" data-current-index="0" data-total-items="<?php echo count($image_thumbnails); ?>">
    <?php  if (count($portfolio_videos) > 0) {
        $index = 0;
        for($i=0; $i<count($portfolio_videos['link_video']);$i++){ ?>
            <div class="thumb <?php if($index==0){echo 'active';} ?>">
                <a class="nav-thumb" href="javascript:"
                   data-index="<?php echo esc_attr($index) ?>">
                    <?php echo sprintf('%s',$portfolio_videos['link_video'][$i]); ?>
                    <div class="bg-overlay fat-overlay transition play-video" data-index="<?php echo esc_attr($index++) ?>">></div>
                </a>

            </div>
        <?php }
    }?>
</div>