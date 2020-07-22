<?php
/**
 * @package   Fat_Portfolio
 * @author    roninwp <kenus.ronin@gmail.com>
 * @copyright 2016 RoninWP
 */

$settings = function_exists('fat_get_settings') ? fat_get_settings() : array();

wp_enqueue_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css', array(), false);

wp_enqueue_script('images-loaded', FAT_PORTFOLIO_ASSET_JS_URL . 'library/isotope/imagesloaded.pkgd.min.js', false, true);
wp_enqueue_script('isotope', FAT_PORTFOLIO_ASSET_JS_URL . 'library/isotope/isotope.pkgd.min.js', false, true);
wp_enqueue_script('masonry', FAT_PORTFOLIO_ASSET_JS_URL . 'library/isotope/masonry.pkgd.min.js', false, true);

wp_enqueue_style('jssocials', FAT_PORTFOLIO_ASSET_JS_URL . 'library/jssocials/jssocials.css', array(), false);
wp_enqueue_style('jssocials-flat', FAT_PORTFOLIO_ASSET_JS_URL . 'library/jssocials/jssocials-theme-flat.css', array(), false);
wp_enqueue_script('jssocials', FAT_PORTFOLIO_ASSET_JS_URL . 'library/jssocials/jssocials.min.js', array('jquery'), false, true);

wp_enqueue_style('fat-portfolio', FAT_PORTFOLIO_ASSET_CSS_URL . 'frontend/portfolio.css', array(), false);
wp_enqueue_style('fat-portfolio-single', FAT_PORTFOLIO_ASSET_CSS_URL . 'frontend/portfolio-single.css', array(), false);
wp_enqueue_style('fat-owl-carousel', FAT_PORTFOLIO_ASSET_JS_URL . 'library/owl-carousel/assets/owl.carousel.min.css', array(), false);
wp_enqueue_style('jquery-light-gallery', FAT_PORTFOLIO_ASSET_JS_URL . 'library/light-gallery/css/lightgallery.min.css', array(), false);
wp_enqueue_style('jquery-light-gallery-transition', FAT_PORTFOLIO_ASSET_JS_URL . 'library/light-gallery/css/lg-transitions.min.css', array(), false);
wp_enqueue_style('jquery-magnific-popup', FAT_PORTFOLIO_ASSET_JS_URL . 'library/magnific-popup/magnific-popup.css', array(), '1.1.0');

wp_enqueue_script('fat-portfolio-flick-api', FAT_PORTFOLIO_ASSET_JS_URL . 'library/flickr/flickr-api.js', false, true);
wp_enqueue_script('instafeed', FAT_PORTFOLIO_ASSET_JS_URL . 'library/instafeed/instafeed.min.js', false, true);

wp_enqueue_style('perfect-scrollbar', FAT_PORTFOLIO_ASSET_JS_URL .'library/perfect-scrollbar/css/perfect-scrollbar.min.css', array(), false);
wp_enqueue_script('perfect-scrollbar', FAT_PORTFOLIO_ASSET_JS_URL . 'library/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js',array('jquery'), false, true);
wp_enqueue_script('jquery-light-gallery', FAT_PORTFOLIO_ASSET_JS_URL . 'library/light-gallery/js/lightgallery.min.js', array('jquery'),false, true);
wp_enqueue_script('jquery-magnific-popup', FAT_PORTFOLIO_ASSET_JS_URL . 'library/magnific-popup/jquery.magnific-popup.min.js',array('jquery'), false, true);
wp_enqueue_script('fat-owl-carousel', FAT_PORTFOLIO_ASSET_JS_URL . 'library/owl-carousel/owl.carousel.min.js',array('jquery'), false, true);
wp_register_script('fat-portfolio', FAT_PORTFOLIO_ASSET_JS_URL . 'frontend/portfolio.js',array('jquery'), false, true);
wp_localize_script('fat-portfolio', 'fat_ajax', array('ajaxurl' => admin_url('admin-ajax.php')));
wp_enqueue_script('fat-portfolio-single', FAT_PORTFOLIO_ASSET_JS_URL . 'frontend/portfolio-single.js', array('jquery','imagesloaded','fat-owl-carousel','perfect-scrollbar','jquery-light-gallery'), false, true);



$enable_related_portfolio = isset($settings['enable_related_portfolio']) ? $settings['enable_related_portfolio'] : 0;
$enable_navigation = isset($settings['enable_navigation']) ? $settings['enable_navigation'] : 0;
$single_light_box_gallery = isset($settings['single_light_box_gallery']) ? $settings['single_light_box_gallery'] : 'magnific-popup';

$portfolio_general =  get_post_meta(get_the_ID(),'fat-mb-portfolio-general', false);
$portfolio_general = isset($portfolio_general[0]) ? $portfolio_general[0] : array();
$detail_style = isset($portfolio_general['fat_portfolio_single_layout']) ? $portfolio_general['fat_portfolio_single_layout'] : '';
$css_class = isset($portfolio_general['css_class']) ? $portfolio_general['css_class'] : '';
if (!isset($detail_style) || $detail_style == 'none' || $detail_style == '') {
    $detail_style = isset($settings['single_layout']) && $settings['single_layout']!=='' && $settings['single_layout']!= null ? $settings['single_layout'] : 'single-image-gallery-left' ;
}

if(!isset($settings['single_unload_header']) || $settings['single_unload_header'] != '1'){
    get_header();
}

do_action('fat_portfolio_before_single');

?>
    <?php if(isset($settings['show_single_page_title']) && $settings['show_single_page_title'] == '1') : ?>
        <div class="fat-container">
            <div class="fat-portfolio-single-page-title">
                <h1><?php the_title(); ?></h1>
            </div>
        </div>
    <?php endif; ?>
    <main>
        <div class="container-fluid">
            <div class="row subheader">
                <div class="col d-flex justify-content-center align-items-center">
                    <h1><?php the_title();?></h1>
                </div>
            </div>
        </div>
    <div class="fat-portfolio-single <?php echo sprintf('%s %s %s', $css_class, $detail_style, $single_light_box_gallery); ?>">
        <div class="fat-container">
            <?php
            if (have_posts()) {
                // Start the Loop.
                $template_single = FAT_PORTFOLIO_DIR_PATH . "/templates/single/$detail_style.php";
                $template_single = apply_filters('fat-portfolio-single-template', $template_single,$detail_style);

                $project_detail_label = isset($settings['project_detail_label']) ? $settings['project_detail_label'] : esc_html__('Project detail label', 'fat-portfolio');
                $project_info_label = isset($settings['project_info_label']) ? $settings['project_info_label'] : esc_html__('Project info label', 'fat-portfolio');
                $more_detail_label = isset($settings['more_detail_label']) ? $settings['more_detail_label'] : esc_html__('More detail label', 'fat-portfolio');
                $single_category_label = isset($settings['single_category_label']) ? $settings['single_category_label'] : esc_html__('Category', 'fat-portfolio');
                $single_related_label = isset($settings['single_related_label']) ? $settings['single_related_label'] : esc_html__('Related', 'fat-portfolio');
                $single_show_info_label = isset($settings['single_show_info_label']) ? $settings['single_show_info_label'] : esc_html__('Show info', 'fat-portfolio');
                $single_hide_info_label = isset($settings['single_hide_info_label']) ? $settings['single_hide_info_label'] : esc_html__('Hide info', 'fat-portfolio');

                $project_detail_label = apply_filters( 'wpml_translate_single_string', $project_detail_label, 'fat-portfolio', 'Project detail label');
                $project_info_label = apply_filters( 'wpml_translate_single_string', $project_info_label, 'fat-portfolio', 'Project info label');
                $more_detail_label = apply_filters( 'wpml_translate_single_string', $more_detail_label, 'fat-portfolio', 'More detail label');
                $single_category_label = apply_filters( 'wpml_translate_single_string', $single_category_label, 'fat-portfolio', 'Single Category label');
                $single_related_label = apply_filters( 'wpml_translate_single_string', $single_related_label, 'fat-portfolio', 'Single Related label');
                $single_show_info_label = apply_filters( 'wpml_translate_single_string', $single_show_info_label, 'fat-portfolio', 'Single Show info label');
                $single_hide_info_label = apply_filters( 'wpml_translate_single_string', $single_hide_info_label, 'fat-portfolio', 'Single Hide info label');

                global $post;
                while (have_posts()) : the_post();
                    $post_id = get_the_ID();
                    $template_args = array();
                    $content_exists = $post->post_content == "" ? false : true;

                    $categories = get_the_terms($post_id, FAT_PORTFOLIO_CATEGORY_TAXONOMY);

                    $template_args['imgThumbs'] = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'full');

                    $gallery_type = get_post_meta(get_the_ID(), 'fat-meta-box-gallery-type', true);
                    $media_type = isset($gallery_type['fat_mb_gallery_type']) ? $gallery_type['fat_mb_gallery_type'] : 'image';
                    $media_source = isset($gallery_type['fat_mb_media_source']) ? $gallery_type['fat_mb_media_source'] : 'media';
                    $portfolio_gallery = isset($gallery_type['fat_mb_image_gallery']) ? $gallery_type['fat_mb_image_gallery'] : '';
                    $flickr_gallery_filter = isset($gallery_type['fat_mb_flickr_gallery']) ? $gallery_type['fat_mb_flickr_gallery'] : array();
                    $instagram_gallery_filter = isset($gallery_type['fat_mb_instagram_gallery']) ? $gallery_type['fat_mb_instagram_gallery'] : array();

                    $portfolio_videos =  isset($gallery_type['fat_mb_video_gallery']) ? $gallery_type['fat_mb_video_gallery'] : array();

                    $portfolio_attributes = get_post_meta(get_the_ID(), 'fat-meta-box-attribute', true);
                    $portfolio_attributes = isset($portfolio_attributes['fat_mb_portfolio_attribute']) ? $portfolio_attributes['fat_mb_portfolio_attribute'] : array();

                    $portfolio_gallery = explode(',', $portfolio_gallery);

                    $cat = '';
                    $arrCatId = array();
                    $cat_links = array();
                    if ($categories) {
                        foreach ($categories as $category) {
                            $cat .= $category->name . ', ';
                            $arrCatId[] = $category->term_id;
                            $cat_links[] = sprintf('<a href="%s">%s</a>', get_term_link($category->term_id), $category->name);
                        }
                        $template_args['cat'] = trim($cat, ', ');
                    }
                    $cat = isset($settings['enable_link_on_category']) && $settings['enable_link_on_category']==='1' ? implode(', ',$cat_links) : rtrim($cat, ', ');

                    if(file_exists($template_single)){
                        include_once $template_single;
                    }else{
                        echo 'Could not find single template';
                    }

                endwhile;
            } else {
                return;
            }

            $template_navigation = FAT_PORTFOLIO_DIR_PATH . "/templates/single/navigation.php";
            $template_navigation = apply_filters('fat-portfolio-single-navigation-template',$template_navigation);
            if ($enable_navigation && file_exists($template_navigation)) {
                include_once $template_navigation;
            }
            $template_related = FAT_PORTFOLIO_DIR_PATH . "/templates/single/single-related.php";
            $template_related = apply_filters('fat-portfolio-single-related-template', $template_related, $post_id);
            if ($enable_related_portfolio && file_exists($template_related)) {
                include_once $template_related;
            }

            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) {
                comments_template();
            }

            ?>
        </div>
    </div>
        </main>

<?php

do_action('fat_portfolio_end_single');
if(!isset($settings['single_unload_footer']) || $settings['single_unload_footer'] != '1'){
    get_footer();
}