<?php
/**
 * Created by PhpStorm.
 * User: roninwp
 * Date: 3/8/2017
 * Time: 2:58 PM
 */

if (count($portfolio_attributes) > 0) {
    $value = $is_link = '';
    for ($i = 0; $i < count($portfolio_attributes['title_attribute']); $i++) {
        $value = $portfolio_attributes['value_attribute'][$i];
        $value = trim($value);
        if (isset($portfolio_attributes['title_attribute'][$i]) && $portfolio_attributes['title_attribute'][$i] != '' && $value != ''):
            ?>
            <div class="attr-item">
                            <span
                                class="attr-title"><?php echo wp_kses_post($portfolio_attributes['title_attribute'][$i]) ?>
                                : </span>
                            <span class="attr-value">
                                <?php
                                $is_link = strpos($value, 'http://');
                                if (!is_bool($is_link) && $is_link == 0) {
                                    echo '<a href="' . $value . '" target="_blank">' . $value . '</a>';
                                } else {
                                    echo wp_kses_post($value);
                                }
                                ?>
                            </span>
            </div>
        <?php endif;
    }
}
?>
<?php
if (isset($settings['enable_special_attribute']) && $settings['enable_special_attribute'] == '1') {
    $country = get_the_terms(get_the_ID(), FAT_PORTFOLIO_COUNTRY_TAXONOMY);
    $years = get_the_terms(get_the_ID(), FAT_PORTFOLIO_YEARS_TAXONOMY);
    $type = get_the_terms(get_the_ID(), FAT_PORTFOLIO_TYPE_TAXONOMY);
    $status = get_the_terms(get_the_ID(), FAT_PORTFOLIO_STATUS_TAXONOMY);
    $archive_page_id = isset($settings['archive_attr_page']) ? $settings['archive_attr_page'] : '';

    $country_attrs = $years_attrs = $type_attrs = $status_attrs = '';
    foreach ($country as $c) {
        if($archive_page_id !== ''){
            $country_attrs .= sprintf('<a href="%s">%s</a>, ', esc_url(get_tag_link($c->term_id)), $c->name);
        }else{
            $country_attrs .= $c->name . ', ';
        }

    }
    $country_attrs = rtrim($country_attrs,', ');

    foreach ($years as $c) {
        if($archive_page_id !== ''){
            $years_attrs .= sprintf('<a href="%s">%s</a>, ', esc_url(get_tag_link($c->term_id)), $c->name);
        }else{
            $years_attrs .= $c->name . ', ';
        }

    }
    $years_attrs = rtrim($years_attrs,', ');

    foreach ($type as $c) {
        if($archive_page_id !== ''){
            $type_attrs .= sprintf('<a href="%s">%s</a>, ', esc_url(get_tag_link($c->term_id)), $c->name);
        }else{
            $type_attrs .= $c->name . ', ';
        }

    }
    $type_attrs = rtrim($type_attrs,', ');

    foreach ($status as $c) {
        if($archive_page_id !== ''){
            $status_attrs .= sprintf('<a href="%s">%s</a>, ', esc_url(get_tag_link($c->term_id)), $c->name);
        }else{
            $status_attrs .= $c->name . ', ';
        }

    }
    $status_attrs = rtrim($status_attrs,', ');

    ?>

    <?php if ($country_attrs !== '') { ?>
        <div class="attr-item">
            <span class="attr-title"><?php esc_html_e('Country :', 'fat-portfolio') ?> </span>
            <span class="attr-value"><?php echo sprintf('%s', $country_attrs); ?> </span>
        </div>
    <?php } ?>

    <?php if ($years_attrs !== '') { ?>
        <div class="attr-item">
            <span class="attr-title"><?php esc_html_e('Years :', 'fat-portfolio') ?> </span>
            <span class="attr-value"><?php echo sprintf('%s', $years_attrs); ?> </span>
        </div>
    <?php } ?>

    <?php if ($type_attrs !== '') { ?>
        <div class="attr-item">
            <span class="attr-title"><?php esc_html_e('Type :', 'fat-portfolio') ?> </span>
            <span class="attr-value"><?php echo sprintf('%s', $type_attrs); ?> </span>
        </div>
    <?php } ?>

    <?php if ($status_attrs !== '') { ?>
        <div class="attr-item">
            <span class="attr-title"><?php esc_html_e('Status :', 'fat-portfolio') ?> </span>
            <span class="attr-value"><?php echo sprintf('%s', $status_attrs); ?> </span>
        </div>
    <?php } ?>

<?php } ?>
