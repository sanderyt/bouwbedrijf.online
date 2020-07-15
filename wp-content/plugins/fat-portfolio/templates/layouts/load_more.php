<?php
/**
 * @package   Fat_Portfolio
 * @author    roninwp <kenus.ronin@gmail.com>
 * @copyright 2016 RoninWP
 */
$has_paging = false;
if ($item_per_page && $item_per_page > 0 && ($item_per_page < $total_item || $total_item == 0 || $total_item ==='')) {
    $max_num_pages = floor($total_post / $item_per_page) + ($total_post % $item_per_page > 0 ? 1 : 0);
    if ($max_num_pages > $current_page) {
        $has_paging = true;
    }
}
if (!$has_paging) {
    return;
}
$load_more_text = isset($shortcode['load_more']) ? $shortcode['load_more'] : esc_html__('Load more','fat-portfolio');
$loading_color = isset($shortcode['paging_text_color']) ? $shortcode['paging_text_color'] : '#343434';
?>

<div class="clearfix"></div>
<div class="load-more-container text-center ">
    <div class="load-more-wrap">
        <a href="javascript:" class="load-more letter-space ladda-button" data-style="zoom-out" data-next-page="<?php echo esc_attr($current_page + 1); ?>"
           data-spinner-color="<?php echo esc_attr($loading_color) ?>" >
            <?php echo wp_kses_post($load_more_text); ?>
        </a>
    </div>
</div>