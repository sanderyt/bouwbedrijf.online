<?php
/**
 * @package   Fat_Portfolio
 * @author    roninwp <kenus.ronin@gmail.com>
 * @copyright 2016 RoninWP
 */

$image_thumbnails = array();
?>
<div class="fat-portfolio-main-detail">
    <div class="fat-row">
        <div class="fat-col-md-12 fat-col-sm-12 fat-col-xs-12">
            <?php
            $video_template = FAT_PORTFOLIO_DIR_PATH . "/templates/single/video-slider.php";
            if (file_exists($video_template)) {
                include_once $video_template;
            }
            ?>
        </div>
    </div>
    <div class="fat-row">
        <?php if (isset($content_exists) && $content_exists): ?>
            <div class="fat-col-md-12 detail-container  fat-col-sm-12 fat-col-xs-12">
                <div class="portfolio-detail">
                    <?php the_content() ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>