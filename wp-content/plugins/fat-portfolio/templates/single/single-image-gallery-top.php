<?php
/**
 * @package   Fat_Portfolio
 * @author    roninwp <kenus.ronin@gmail.com>
 * @copyright 2016 RoninWP
 */

$image_thumbnails = array();
$more_detail_col = 'fat-col-md-8';
$has_right_col = (count($portfolio_attributes) > 0 && isset($portfolio_attributes['value_attribute'][0]) && $portfolio_attributes['value_attribute'][0] != '') || get_the_excerpt() != '';
$more_detail_col = $has_right_col ? $more_detail_col : 'fat-col-md-12';
?>

<div class="fat-portfolio-main-detail">
    <div class="fat-row">
        <div class="fat-col-md-12 fat-col-sm-12 fat-col-xs-12 image-gallery">
            <?php
            $image_gallery_template = FAT_PORTFOLIO_DIR_PATH . "/templates/single/image-gallery-$media_source.php";
            $gallery_position = 'top';
            if (file_exists($image_gallery_template)) {
                include_once $image_gallery_template;
            }
            ?>
        </div>
    </div>
    <div class="fat-row">
        <div class="fat-col-md-8 detail-container fat-col-sm-12 fat-col-xs-12">
            <div class="portfolio-detail-label"><?php echo esc_html($more_detail_label); ?></div>
            <div class="portfolio-detail">
                <?php the_content() ?>
            </div>
        </div>
        <div class="fat-col-md-4 fat-mg-top-50 fat-col-sm-12 fat-col-xs-12">
            <div class="portfolio-info-label">
                <span><?php esc_html_e('Project Info', 'fat-portfolio') ?></span>
            </div>
            <div class="attribute-container">
                <?php if ($cat): ?>
                    <div class="attr-item">
                        <span class="attr-title"><?php echo esc_html($single_category_label); ?> : </span>
                        <span class="attr-value"><?php echo wp_kses_post($cat); ?> </span>
                    </div>
                <?php endif; ?>

                <?php
                $attribute_template = FAT_PORTFOLIO_DIR_PATH . "/templates/single/attribute.php";
                if (file_exists($attribute_template)) {
                    include_once $attribute_template;
                }
                ?>

                <?php
                $tag_template = FAT_PORTFOLIO_DIR_PATH . "/templates/single/tag.php";
                if (file_exists($tag_template)) {
                    include_once $tag_template;
                }
                ?>
            </div>
            <?php
            $share_template = FAT_PORTFOLIO_DIR_PATH . "/templates/single/social-share.php";
            if (file_exists($share_template)) {
                include_once $share_template;
            }
            ?>

        </div>
    </div>
</div>

