<?php
/**
 * @package   Fat_Portfolio
 * @author    roninwp <kenus.ronin@gmail.com>
 * @copyright 2016 RoninWP
 */

if ($show_category == '' || $show_category == 'none' || $data_source === 'ids') {
    return;
}
$settings = FAT_Portfolio::get_settings();
$args_terms = array(
    'taxonomy' => FAT_PORTFOLIO_CATEGORY_TAXONOMY
);

if (!isset($_GET['category']) && $current_categories) {
    $args_terms['slug'] = $current_categories;
}
$terms = get_terms(FAT_PORTFOLIO_CATEGORY_TAXONOMY, $args_terms);
$category_all = isset($current_categories) && $current_categories != '' ? implode(',', $current_categories) : '*';
$category_active = isset($_GET['category']) ? $_GET['category'] : '';

$country_tax = $years_tax = $type_tax = $status_tax = array();
$country_all = $years_all = $type_all = $status_all = '';
$country_active = isset($_GET['country']) ? $_GET['country'] : '';
$years_active = isset($_GET['years']) ? $_GET['years'] : '';
$type_active = isset($_GET['type']) ? $_GET['type'] : '';
$status_active = isset($_GET['status']) ? $_GET['status'] : '';

if (isset($shortcode['ds_country']) && $shortcode['ds_country'] == '') {
    $country_tax = Fat_Portfolio_Base::get_portfolio_taxonomy(FAT_PORTFOLIO_COUNTRY_TAXONOMY);
} else {
    $country_tax = Fat_Portfolio_Base::get_portfolio_taxonomy(FAT_PORTFOLIO_COUNTRY_TAXONOMY, true, $shortcode['ds_country']);
}
if(isset($country_tax) && is_array($country_tax)){
    foreach ($country_tax as $key => $value) {
        $country_all .= $key . ',';
    }
}
$country_all = rtrim($country_all, ',');

if (isset($shortcode['ds_years']) && $shortcode['ds_years'] == '') {
    $years_tax = Fat_Portfolio_Base::get_portfolio_taxonomy(FAT_PORTFOLIO_YEARS_TAXONOMY);
} else {
    $years_tax = Fat_Portfolio_Base::get_portfolio_taxonomy(FAT_PORTFOLIO_YEARS_TAXONOMY, true, $shortcode['ds_years']);
}
if(isset($years_tax) && is_array($years_tax)){
    foreach ($years_tax as $key => $value) {
        $years_all .= $key . ',';
    }
}

$years_all = rtrim($years_all, ',');

if (isset($shortcode['ds_type']) && $shortcode['ds_type'] == '') {
    $type_tax = Fat_Portfolio_Base::get_portfolio_taxonomy(FAT_PORTFOLIO_TYPE_TAXONOMY);
} else {
    $type_tax = Fat_Portfolio_Base::get_portfolio_taxonomy(FAT_PORTFOLIO_TYPE_TAXONOMY, true, $shortcode['ds_type']);
}
if(isset($type_tax) && is_array($type_tax)){
    foreach ($type_tax as $key => $value) {
        $type_all .= $key . ',';
    }
}
$type_all = rtrim($type_all, ',');

if (isset($shortcode['ds_status']) && $shortcode['ds_status'] == '') {
    $status_tax = Fat_Portfolio_Base::get_portfolio_taxonomy(FAT_PORTFOLIO_STATUS_TAXONOMY);
} else {
    $status_tax = Fat_Portfolio_Base::get_portfolio_taxonomy(FAT_PORTFOLIO_STATUS_TAXONOMY, true, $shortcode['ds_status']);
}
foreach ($status_tax as $key => $value) {
    $status_all .=  $key . ',';
}
$status_all = rtrim($status_all, ',');

?>
<div class="fat-portfolio-tabs special-attrs-filter">
    <div>
        <a class="attr-filter-loading" href="javascript:void(0)" class="ladda-button">&nbsp;</a>
    </div>
    <?php
    if (count($terms) > 0 || count($country_tax) > 0 || count($years_tax) > 0 || count($type_tax) > 0 || count($status_tax) > 0) { ?>
        <div class="tab-wrapper line-height-1 fat-mg-bottom-50 <?php echo esc_attr($show_category) ?> "
             data-category="<?php echo esc_attr($category_all) ?>" data-style="zoom-out"
             data-spinner-color="<?php echo esc_attr($loading_color) ?>"
        >
            <?php if (count($terms) > 0) : ?>
                <select name="category-filter" >
                    <option value="<?php echo esc_attr($category_all) ?>"
                            data-all-category="1"><?php echo wp_kses_post($all_category_label); ?></option>
                    <?php foreach ($terms as $term) { ?>
                        <option
                            value="<?php echo esc_attr($term->slug) ?>" <?php echo($category_active == $term->slug ? 'selected' : ''); ?>> <?php echo wp_kses_post($term->name) ?></option>
                    <?php } ?>
                </select>
            <?php endif; ?>

            <?php if (count($country_tax) > 0) : ?>
                <select name="country-filter">
                    <option value="<?php echo esc_attr($country_all) ?>"
                            data-all-country="1"><?php echo wp_kses_post($all_country_label); ?></option>
                    <?php foreach ($country_tax as $key => $value) { ?>
                        <option
                            value="<?php echo esc_attr($key) ?>" <?php echo(strtolower($country_active) == strtolower($key) ? 'selected' : ''); ?>> <?php echo wp_kses_post($value) ?></option>
                    <?php } ?>
                </select>
            <?php endif; ?>

            <?php if (count($years_tax) > 0) : ?>
                <select name="years-filter">
                    <option value="<?php echo esc_attr($years_all) ?>"
                            data-all-years="1"><?php echo wp_kses_post($all_years_label); ?></option>
                    <?php foreach ($years_tax as $key => $value) { ?>
                        <option
                            value="<?php echo esc_attr($key) ?>" <?php echo(strtolower($years_active) == strtolower($key) ? 'selected' : ''); ?>> <?php echo wp_kses_post($value) ?></option>
                    <?php } ?>
                </select>
            <?php endif; ?>

            <?php if (count($type_tax) > 0): ?>
                <select name="type-filter">
                    <option value="<?php echo esc_attr($type_all) ?>"
                            data-all-type="1"><?php echo wp_kses_post($all_type_label); ?></option>
                    <?php foreach ($type_tax as $key => $value) { ?>
                        <option
                            value="<?php echo esc_attr($key) ?>" <?php echo(strtolower($type_active) == strtolower($key) ? 'selected' : ''); ?>> <?php echo wp_kses_post($value) ?></option>
                    <?php } ?>
                </select>
            <?php endif; ?>

            <?php if (count($status_tax) > 0) : ?>
                <select name="status-filter">
                    <option value="<?php echo esc_attr($status_all) ?>"
                            data-all-status="1"><?php echo wp_kses_post($all_status_label); ?></option>
                    <?php
                    foreach ($status_tax as $key => $value) { ?>
                        <option
                            value="<?php echo esc_attr($key) ?>" <?php echo( strtolower($status_active) == strtolower($key) ? 'selected' : ''); ?>> <?php echo wp_kses_post($value) ?></option>
                    <?php } ?>
                </select>
            <?php endif; ?>

        </div>
        <?php
    }
    ?>

</div>
