<?php
/**
 * @package   Fat_Portfolio
 * @author    roninwp <kenus.ronin@gmail.com>
 * @copyright 2016 RoninWP
 */

$image_thumbnails = array();
$more_detail_col = 'fat-col-md-12';

$country_attrs = $years_attrs = $type_attrs = $status_attrs = '';
if (isset($settings['enable_special_attribute']) && $settings['enable_special_attribute'] == '1') {
    $country = get_the_terms(get_the_ID(), FAT_PORTFOLIO_COUNTRY_TAXONOMY);
    $years = get_the_terms(get_the_ID(), FAT_PORTFOLIO_YEARS_TAXONOMY);
    $type = get_the_terms(get_the_ID(), FAT_PORTFOLIO_TYPE_TAXONOMY);
    $status = get_the_terms(get_the_ID(), FAT_PORTFOLIO_STATUS_TAXONOMY);
    $archive_page_id = isset($settings['archive_attr_page']) ? $settings['archive_attr_page'] : '';

    if(isset($country) && is_array($country)){
        foreach ($country as $c) {
            if($archive_page_id !== ''){
                $country_attrs .= sprintf('<a href="%s">%s</a>, ', esc_url(get_tag_link($c->term_id)), $c->name);
            }else{
                $country_attrs .= $c->name . ', ';
            }
        }
        $country_attrs = rtrim($country_attrs,', ');
    }

    if(isset($years) && is_array($years)){
        foreach ($years as $c) {
            if($archive_page_id !== ''){
                $years_attrs .= sprintf('<a href="%s">%s</a>, ', esc_url(get_tag_link($c->term_id)), $c->name);
            }else{
                $years_attrs .= $c->name . ', ';
            }
        }
        $years_attrs = rtrim($years_attrs,', ');
    }

    if(isset($type) && is_array($type)){
        foreach ($type as $c) {
            if($archive_page_id !== ''){
                $type_attrs .= sprintf('<a href="%s">%s</a>, ', esc_url(get_tag_link($c->term_id)), $c->name);
            }else{
                $type_attrs .= $c->name . ', ';
            }
        }
        $type_attrs = rtrim($type_attrs,', ');
    }

    if(isset($status) && is_array($status)){
        foreach ($status as $c) {
            if($archive_page_id !== ''){
                $status_attrs .= sprintf('<a href="%s">%s</a>, ', esc_url(get_tag_link($c->term_id)), $c->name);
            }else{
                $status_attrs .= $c->name . ', ';
            }
        }
        $status_attrs = rtrim($status_attrs,', ');
    }
}

?>

<div class="fat-portfolio-main-detail">
    <div class="fat-row  fat-mg-top-15">
        <div class="portfolio-title">
                <h2><?php the_title(); ?></h2>
        </div>
        <div class="portfolio-special-attrs">
            <div class="fat-col-md-4 portfolio-attr">
                <div class="portfolio-attr-title"><?php esc_html_e('Country','fat-portfolio'); ?></div>
                <div class="portfolio-attr-value">
                    <?php echo sprintf('%s',$country_attrs); ?>
                </div>
            </div>
            <div class="fat-col-md-4 portfolio-attr">
                <div class="portfolio-attr-title"><?php esc_html_e('Years','fat-portfolio'); ?></div>
                <div class="portfolio-attr-value">
                    <?php echo sprintf('%s',$years_attrs); ?>
                </div>
            </div>
            <div class="fat-col-md-4 portfolio-attr">
                <div class="portfolio-attr-title"><?php esc_html_e('Type','fat-portfolio'); ?></div>
                <div class="portfolio-attr-value">
                    <?php echo sprintf('%s',$type_attrs); ?>
                </div>
            </div>
            <div class="fat-col-md-4 portfolio-attr">
                <div class="portfolio-attr-title"><?php esc_html_e('Status','fat-portfolio'); ?></div>
                <div class="portfolio-attr-value">
                    <?php echo sprintf('%s',$status_attrs); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="fat-row  fat-mg-top-30">
        <div class="fat-col-md-12 fat-col-sm-12 fat-col-xs-12  image-gallery">
            <?php
            $media_template = FAT_PORTFOLIO_DIR_PATH . "/templates/single/big-$media_source.php";
            if (file_exists($media_template)) {
                include_once $media_template;
            }
            ?>
        </div>
    </div>

    <div class="fat-row">
        <?php if ($content_exists): ?>
            <div class="<?php echo esc_attr($more_detail_col); ?> detail-container fat-col-sm-12 fat-col-xs-12">
                <div class="portfolio-detail-label"><?php echo esc_html($more_detail_label); ?></div>
                <div class="portfolio-detail">
                    <?php the_content() ?>
                </div>
            </div>
        <?php endif; ?>

    </div>
</div>

