<?php
/**
 * @package   Fat_Portfolio
 * @author    roninwp <kenus.ronin@gmail.com>
 * @copyright 2016 RoninWP
 */

$image_thumbnails = array();
?>

<div class="fat-portfolio-main-detail fat-portfolio-single-content-float">
    <div class="fat-row  fat-hide-on-mobile">
        <?php if ($content_exists): ?>
            <div class="fat-portfolio-content-float fat-col-md-3 fat-col-sm-6 fat-col-xs-6">
                <div class="fat-portfolio-single-content-float-icon">
                    <a href="javascript:" data-show-title="<?php echo esc_attr($single_show_info_label);?>" data-hide-title="<?php echo esc_attr($single_hide_info_label);?>"><i class="fa fa-angle-right" aria-hidden="true"></i><span><?php echo esc_html($single_show_info_label);?></span> </a>
                </div>
                <div class="detail-container">
                    <div class="portfolio-title fat-mg-top-15">
                        <h4><?php the_title(); ?></h4>
                    </div>
                    <div class="portfolio-detail fat-mg-top-15">
                        <?php the_content() ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <div class="fat-row">
        <div class="fat-col-md-12 fat-col-sm-12 fat-col-xs-12  image-gallery">
            <?php
            $media_template = FAT_PORTFOLIO_DIR_PATH . "/templates/single/big-$media_source.php";
            if (file_exists($media_template)) {
                include_once $media_template;
            }
            ?>
        </div>
    </div>
    <div class="fat-hide-on-desktop">
        <div class="portfolio-title fat-mg-top-15">
            <h4><?php the_title(); ?></h4>
        </div>
        <div class="portfolio-detail fat-mg-top-15">
            <?php the_content() ?>
        </div>

    </div>
</div>

