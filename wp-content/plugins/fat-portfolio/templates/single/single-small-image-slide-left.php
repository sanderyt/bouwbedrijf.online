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
        <div class="<?php echo esc_attr($img_col); ?> fat-col-sm-12 fat-col-xs-12 small-image-slide image-gallery">
            <?php
            $media_template = FAT_PORTFOLIO_DIR_PATH . "/templates/single/big-$media_source.php";
            if (file_exists($media_template)) {
                include_once $media_template;
            }
            ?>
        </div>
        <?php if ($has_right_col): ?>
            <div class="fat-col-md-4  fat-col-sm-12 fat-col-xs-12">
                <div class="excerpt-container">
                    <div class="excerpt-label">
                        <h3><?php echo esc_html($project_detail_label); ?></h3>
                    </div>
                    <div class="excerpt-detail">
                        <?php the_content() ?>
                        <br />
						<a href="/offerte-aanvragen" class="btn btn--cta">Offerte aanvragen</a>
                    </div>
                </div>
                </div>
			
            </div>
        <?php endif; ?>
    </div>
</div>