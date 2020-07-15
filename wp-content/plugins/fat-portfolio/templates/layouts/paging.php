<?php
/**
 * Created by PhpStorm.
 * User: roninwp
 * Date: 3/13/2017
 * Time: 8:43 AM
 */

$has_paging = false;
if ($item_per_page && $item_per_page > 0 && ($item_per_page < $total_item || $total_item == 0 || $total_item ==='')) {
    $max_num_pages = floor($total_post / $item_per_page) + ($total_post % $item_per_page > 0 ? 1 : 0);
    if ($max_num_pages > 1) {
        $has_paging = true;
    }
}
if (!$has_paging) {
    return;
}


global $wp_query, $wp_rewrite;
$paged = get_query_var('paged') ? intval(get_query_var('paged')) : $current_page;
$pagenum_link = html_entity_decode(get_pagenum_link());
$query_args = array();
$url_parts = explode('?', $pagenum_link);

if (isset($url_parts[1])) {
    wp_parse_str($url_parts[1], $query_args);
}

$pagenum_link = esc_url(remove_query_arg(array_keys($query_args), $pagenum_link));
$pagenum_link = trailingslashit($pagenum_link) . '%_%';

$format = $wp_rewrite->using_index_permalinks() && !strpos($pagenum_link, 'index.php') ? 'index.php/' : '';
$format .= $wp_rewrite->using_permalinks() ? user_trailingslashit($wp_rewrite->pagination_base . '/%#%', 'paged') : '?paged=%#%';

?>

<div class="fat-paging-navigation-wrap <?php echo esc_attr($paging_position); ?>">
    <div class="paging-navigation clearfix" >
        <?php echo paginate_links(array(
            'base'               => $pagenum_link,
            'format'             => $format,
            'total'              => $max_num_pages,
            'current'            => $paged,
            'mid_size'           => 1,
            'prev_text'          => '<span ><i class="fa fa-angle-left"></i>' . $page_prev_text . '</span>',
            'next_text'          => '<span >' . $page_next_text . '<i class="fa fa-angle-right"></i></span>',
            'before_page_number' => '<span >',
            'after_page_number'  => '</span>'
        )); ?>
    </div>
</div>
