<?php
/**
 * @package   Fat_Portfolio
 * @author    roninwp <kenus.ronin@gmail.com>
 * @copyright 2016 RoninWP
 */

$image_thumbnails = array();
$img_col = 'fat-col-md-8';
$has_right_col = (count($portfolio_attributes) > 0 && isset($portfolio_attributes['value_attribute'][0]) && $portfolio_attributes['value_attribute'][0] != '') || get_the_excerpt() != '';
$img_col = $has_right_col ? $img_col : 'fat-col-md-12';
?>
<div class="fat-portfolio-main-detail">
    <div class="fat-row">
        <?php if ($content_exists): ?>
            <div class="fat-col-md-4  fat-col-sm-12 fat-col-xs-12">
                <div class="portfolio-info-label">
                    <span><?php echo esc_html($project_info_label); ?></span>
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
                <div class="excerpt-container">
                    <div class="excerpt-label"><?php echo esc_html($project_detail_label); ?></div>
                    <div class="excerpt-detail">
                        <?php the_excerpt(); ?>
                    </div>
                </div>
                <?php
                $share_template = FAT_PORTFOLIO_DIR_PATH . "/templates/single/social-share.php";
                if (file_exists($share_template)) {
                    include_once $share_template;
                }
                ?>
            </div>
        <?php endif; ?>

        <div class="<?php echo esc_attr($img_col); ?> fat-col-sm-12 fat-col-xs-12 small-image-slide image-gallery">
            <?php
            $media_template = FAT_PORTFOLIO_DIR_PATH . "/templates/single/big-$media_source.php";
            if (file_exists($media_template)) {
                include_once $media_template;
            }
            ?>
        </div>

    </div>
    <?php if ($content_exists): ?>
        <div class="fat-row">
            <div class="fat-col-md-12 detail-container">
                <div class="portfolio-detail-label"><?php echo esc_html($more_detail_label); ?></div>
                <div class="portfolio-detail">
                    <?php the_content() ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>