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
?>

<div class="clearfix"></div>
<div class="infinite-scroll-wrap text-center ">
    <a href="javascript:" class="infinite-scroll ladda-button" data-style="zoom-out" data-next-page="<?php echo esc_attr($current_page + 1); ?>">
        &nbsp;
    </a>
</div>
