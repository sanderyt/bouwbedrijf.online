<div class="nta-wrap">
    <h1 class="wp-heading-inline nta-text-heading">Locations</h1>
    <div class="wrap-dropdown add-new-location">
        <div class="button add-location-btn">
            Add new
        </div>
        <div class="dropdown-menu">
            <ul>
                <li class="hidden-add njt-ggreviews-add-location-btn"><?php _e('Add Location', 'gdx_yelprv');?></li>
                <li class="hidden-add njt-ggreviews-add-placeID-btn"><?php _e('Add Place ID', 'gdx_yelprv');?></li>
            </ul>
        </div>
    </div>
    
</div>
<p class="description">It is recommended that you should type your business addresses carefully, do not type a place wrongly many times.</p>
<?php
settings_fields('njt_options_group_locations');
//delete_option("njt_gg_reviews_location");
$locations = get_option('njt_gg_reviews_location', array());
if (empty($locations)) {
    $locations = array();
} else {
    //echo "<pre>";
    //print_r($locations);
    //echo "</pre>";

}
$location_html = "";
$location_html .= '<div class="njt_gg_reviews_add_location_wrap" data-location_id="%3$s">';
$location_html .= '<input readonly name="njt_gg_reviews_location[location_look][]" class="njt-location-autocomplete-snippet regular-text" id="njt-autocomplete-snippet" type="text" value="%1$s"/>';
$location_html .= '<input class="location-rich regular-text" type="hidden" readonly id="location-rich" name="njt_gg_reviews_location[location_name][]" type="text" value="%2$s"  placeholder="No location set"/>';
$location_html .= '<input class="njt_google_place_id regular-text" type="hidden" readonly id="njt_google_place_id" name="njt_gg_reviews_location[place_id][]" type="text" placeholder="No location set " value="%3$s"/>';
$location_html .= '<div class="njt_google_reviews_add_business_btns">';
$location_html .= '%4$s';
$location_html .= '<a href="#" class="button njt-gg-review-remove-location">' . __('Remove', 'njt-fi') . '</a>';
$location_html .= '</div>';
$location_html .= '</div>';
$more_btns = '<a href="#" class="button njt_google_get_new_reviews">' . __('Get New Reviews', 'gdx_yelprv') . '</a>';
if (!empty($locations)) {
    foreach ($locations["location_look"] as $k => $v) {
        $njt_google_reviews = new njt_google_reviews();
        $reviews = $njt_google_reviews->findReviewsById($locations["place_id"][$k]);
        $view_review = '<a href="' . esc_url(add_query_arg(array('post_type' => "njt_google_reviews", 'location_id' => $locations["place_id"][$k]), admin_url('edit.php'))) . '" target="_blank" class="button njt_google_view_reviews">' . sprintf(__('View Reviews (%1$d)', 'njt-fi'), count($reviews)) . '</a>';
        echo sprintf($location_html, esc_attr($locations["location_look"][$k]), esc_attr($locations["location_name"][$k]), esc_attr($locations["place_id"][$k]), $more_btns . $view_review);
    }
}
?>