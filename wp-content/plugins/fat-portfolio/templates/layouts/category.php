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
    'taxonomy' => FAT_PORTFOLIO_CATEGORY_TAXONOMY,
    'hide_empty' => true,
);

$terms = get_terms(FAT_PORTFOLIO_CATEGORY_TAXONOMY, $args_terms);
$terms_order = array();
if (isset($current_categories) && is_array($current_categories) && count($current_categories) > 0) {
    foreach ($current_categories as $cat) {
        foreach ($terms as $term) {
            if ($term->slug === $cat) {
                $terms_order[] = $term;
            }
        }
    }
} else {
    foreach ($terms as $term) {
        if($term->count > 0){
            $terms_order[] = $term;
        }
    }
}
$terms = $terms_order;
$category_all = isset($current_categories) && $current_categories != '' ? implode(',', $current_categories) : '*';
$category_active = isset($hide_all_category) && $hide_all_category && isset($terms[0]) ? $terms[0]->slug : '';
$category_active = isset($_GET['category']) ? $_GET['category'] : $category_active;

?>
<div class="fat-portfolio-tabs">
    <?php
    if (count($terms) > 0) { ?>
        <div
                class="tab-wrapper line-height-1 <?php echo esc_attr($show_category) ?> ">
            <ul class="fat-mg-bottom-50 <?php echo esc_attr($show_category); ?>"
                data-sc-id="<?php echo esc_attr($id) ?>">

                <?php if (!isset($hide_all_category) || !$hide_all_category) : ?>
                    <li>
                        <a class="ladda-button <?php echo($category_active == '' ? 'active' : ''); ?> transition-slow letter-space"
                           data-category="<?php echo esc_attr($category_all) ?>" data-style="zoom-out"
                           data-spinner-color="<?php echo esc_attr($loading_color) ?>"
                           data-all-category="1"
                           href="javascript:">
                            <?php echo wp_kses_post($all_category_label); ?>
                        </a>
                    </li>
                <?php endif; ?>

                <?php
                $arr_term_show_up = array();
                foreach ($terms as $term) {
                    if (!in_array($term->term_id, $arr_term_show_up)) {
                        $arr_term_show_up[] = $term->term_id;
                        ?>
                        <li>
                            <a class="ladda-button <?php echo($category_active == $term->slug ? 'active' : ''); ?> letter-space "
                               data-category="<?php echo esc_attr($term->slug) ?>"
                               data-style="zoom-out" data-spinner-color="<?php echo esc_attr($loading_color) ?>"
                               href="javascript:"
                            >
                                <?php echo wp_kses_post($term->name) ?>
                            </a>
                        </li>
                        <?php
                    }
                }
                ?>
            </ul>
        </div>
        <?php
    }
    ?>
</div>
