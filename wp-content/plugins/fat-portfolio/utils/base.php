<?php
/**
 * Created by PhpStorm.
 * User: roninwp
 * Date: 3/10/2017
 * Time: 9:24 AM
 */

if(!class_exists('Fat_Portfolio_Base')){
    class Fat_Portfolio_Base{

        public static function get_portfolios(){
            $args = array(
                'posts_per_page' => -1,
                'post_type' => FAT_PORTFOLIO_POST_TYPE,
                'post_status' => 'publish'
            );
            $posts = new WP_Query($args);
            $portfolios = array();
            $post_id = $post_title = '';

            while ($posts->have_posts()) : $posts->the_post();
                $post_id = get_the_ID();
                $post_title = get_the_title();
                $portfolios[$post_id] = $post_title;
            endwhile;
            wp_reset_postdata();

            return $portfolios;
        }

        public static  function get_authors(){
            $users = get_users(array(
                'orderby' => 'display_name',
                'order'   => 'DESC',
                'fields'  => array('ID', 'user_nicename'),
            ));
            $authors = array();
            if ($users) {
                foreach ($users as $user) {
                    $authors[$user->ID] = $user->user_nicename;
                }
            }
            return $authors;
        }

        public static function get_portfolio_categories(){
            $terms = get_terms(array(
                'taxonomy' => FAT_PORTFOLIO_CATEGORY_TAXONOMY
            ));
            $categories = array();
            foreach($terms as $term){
                $categories[$term->slug] = sprintf('%s (%s)',$term->name, $term->count);
            }
            return $categories;
        }

        public static function get_portfolio_taxonomy($taxonomy, $hide_empty = true, $slug = null){

            if (!taxonomy_exists($taxonomy)){
                return array();
            }
            $args = array(
                'taxonomy' => $taxonomy,
                'hide_empty' => $hide_empty,
            );
            if($slug!=null){
                $args['slug'] = $slug;
            }
            $terms = get_terms($args);
            $portfolio_tax = array();
            foreach($terms as $term){
                $portfolio_tax[$term->slug] = sprintf('%s (%s)',$term->name, $term->count);
            }
            return $portfolio_tax;
        }

        public static function get_portfolio_taxonomy_slug($taxonomy, $hide_empty = true, $slug = null){

            if (!taxonomy_exists($taxonomy)){
                return array();
            }
            $args = array(
                'taxonomy' => $taxonomy,
                'hide_empty' => $hide_empty,
            );
            if($slug!=null){
                $args['slug'] = $slug;
            }
            $terms = get_terms($args);
            $portfolio_tax = array();
            foreach($terms as $term){
                $portfolio_tax[] = $term->slug;
            }
            return $portfolio_tax;
        }

        /**
         * GET grid by grid name
         * *******************************************************
         */
        public static function get_shortcode_by_name($name)
        {
            $shortcodes = get_option(FAT_PORTFOLIO_SHORTCODE_OPTION_KEY, array());
            if (is_array($shortcodes)) {
                foreach ($shortcodes as $shortcode) {
                    if (strtolower($shortcode['name']) == strtolower($name)) {
                        return get_option(FAT_PORTFOLIO_SHORTCODE_OPTION_KEY . '_' . $shortcode['id'], array());
                    }
                }
            }
            return null;
        }

        public static function enqueue_custom_css()
        {
            global $fat_portfolio_custom_css;
            if (isset($fat_portfolio_custom_css) && is_array($fat_portfolio_custom_css)) {
                $output_custom_css = $css_path = '';
                ob_start();
                foreach ($fat_portfolio_custom_css as $custom_css) {
                    $css_path = untrailingslashit(FAT_PORTFOLIO_DIR_PATH) . '/assets/css/frontend/sc-custom-css.php';
                    if(file_exists($css_path)){
                        include $css_path;
                    }
                }
                $output_custom_css .= ob_get_contents();
                ob_end_clean();
                echo sprintf('%s',$output_custom_css);
            }
        }
    }
}