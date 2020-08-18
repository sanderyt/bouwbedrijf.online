<?php
/*
Plugin Name: FAT Portfolio
Plugin URI:  http://plugins.roninwp.com/portfolio
Description: Advanced portfolio plugin for show portfolio, gallery and more your work
Version:     1.17
Author:      Roninwp
Author URI:  http://themes.roninwp.com
Domain Path: /languages
Text Domain: fat-portfolio
*/

if (!defined('ABSPATH')) die('-1');

defined('FAT_PORTFOLIO_SHORTCODE_OPTION_KEY') or define('FAT_PORTFOLIO_SHORTCODE_OPTION_KEY', 'fat-portfolio-shortcode');

defined('FAT_PORTFOLIO_FLUSH_REWRITE_KEY') or define('FAT_PORTFOLIO_FLUSH_REWRITE_KEY', 'fat_portfolio_need_flush_rewrite_rules');

defined('FAT_PORTFOLIO_CATEGORY_TAXONOMY') or define('FAT_PORTFOLIO_CATEGORY_TAXONOMY', 'fat-portfolio-category');

defined('FAT_PORTFOLIO_CATEGORY_TAXONOMY_NAME') or define('FAT_PORTFOLIO_CATEGORY_TAXONOMY_NAME', 'Category');

/* start customize for client */
defined('FAT_PORTFOLIO_COUNTRY_TAXONOMY') or define('FAT_PORTFOLIO_COUNTRY_TAXONOMY', 'fat-portfolio-country');
defined('FAT_PORTFOLIO_COUNTRY_TAXONOMY_NAME') or define('FAT_PORTFOLIO_COUNTRY_TAXONOMY_NAME', 'Country');

defined('FAT_PORTFOLIO_YEARS_TAXONOMY') or define('FAT_PORTFOLIO_YEARS_TAXONOMY', 'fat-portfolio-years');
defined('FAT_PORTFOLIO_YEARS_TAXONOMY_NAME') or define('FAT_PORTFOLIO_YEARS_TAXONOMY_NAME', 'Years');

defined('FAT_PORTFOLIO_TYPE_TAXONOMY') or define('FAT_PORTFOLIO_TYPE_TAXONOMY', 'fat-portfolio-type');
defined('FAT_PORTFOLIO_TYPE_TAXONOMY_NAME') or define('FAT_PORTFOLIO_TYPE_TAXONOMY_NAME', 'Type');

defined('FAT_PORTFOLIO_STATUS_TAXONOMY') or define('FAT_PORTFOLIO_STATUS_TAXONOMY', 'fat-portfolio-status');
defined('FAT_PORTFOLIO_STATUS_TAXONOMY_NAME') or define('FAT_PORTFOLIO_STATUS_TAXONOMY_NAME', 'Status');
/* end customize for client */

defined('FAT_PORTFOLIO_TAG_TAXONOMY') or define('FAT_PORTFOLIO_TAG_TAXONOMY', 'fat-portfolio-tag');

defined('FAT_PORTFOLIO_TAG_TAXONOMY_NAME') or define('FAT_PORTFOLIO_TAG_TAXONOMY_NAME', 'Tag');

defined('FAT_PORTFOLIO_POST_TYPE') or define('FAT_PORTFOLIO_POST_TYPE', 'fat-portfolio');

defined('FAT_PORTFOLIO_POST_TYPE_NAME') or define('FAT_PORTFOLIO_POST_TYPE_NAME', 'Portfolio');

defined('FAT_PORTFOLIO_PLUGIN_URL') or define('FAT_PORTFOLIO_PLUGIN_URL', plugins_url());

defined('FAT_PORTFOLIO_ASSET_JS_URL') or define('FAT_PORTFOLIO_ASSET_JS_URL', plugins_url() . '/fat-portfolio/assets/js/');

defined('FAT_PORTFOLIO_ASSET_CSS_URL') or define('FAT_PORTFOLIO_ASSET_CSS_URL', plugins_url() . '/fat-portfolio/assets/css/');

defined('FAT_PORTFOLIO_ASSET_IMAGES_URL') or define('FAT_PORTFOLIO_ASSET_IMAGES_URL', plugins_url() . '/fat-portfolio/assets/images/');

defined('FAT_PORTFOLIO_DIR_PATH') or define('FAT_PORTFOLIO_DIR_PATH', plugin_dir_path(__FILE__));

if (!class_exists('FAT_Portfolio')) {

    class FAT_Portfolio
    {
        public $bg_hover_color = '';
        private $version = '1.16';

        function __construct()
        {
            $this->includes();
            $this->fat_portfolio_load_textdomain();
            $settings = get_option(FAT_PORTFOLIO_POST_TYPE . '-settings');

            add_action('init', array($this, 'register_post_types'), 5);
            add_action('init', array($this, 'register_taxonomies'), 6);
            add_action('init', array($this, 'register_attribute_taxonomies'), 7);
            add_action('init', array($this, 'register_tag_taxonomies'), 7);
            add_action('init', array($this, 'register_vc_shortcode'), 7);

            if(isset($settings['enable_pattern_slug']) && $settings['enable_pattern_slug']=='1'){
                add_action( 'wp_loaded', array($this,'add_portfolio_permastructure') );
                add_filter( 'post_type_link', array($this,'portfolio_permalinks'), 10, 2 );
               // add_filter( 'term_link', array($this,'add_term_parents_to_permalinks'), 10, 2 );
            }

            add_filter('fat_cmb_register_metabox', array($this, 'register_meta_boxes'));
            add_action('init', array($this, 'load_text_domain'), 0);

            add_filter('single_template', array($this, 'get_portfolio_single_template'));
            add_filter('archive_template', array($this, 'get_portfolio_archive_template'));

            add_shortcode('fat_portfolio', array($this, 'fat_portfolio_shortcode'));

            if (is_admin()) {
                add_action('admin_enqueue_scripts', array($this, 'admin_enqueue_scripts'), 0);
                add_action('admin_menu', array($this, 'addMenuPage'));
                add_filter('manage_edit-' . FAT_PORTFOLIO_POST_TYPE . '_columns', array($this, 'add_admin_listing_portfolio_columns'));
                add_action('manage_' . FAT_PORTFOLIO_POST_TYPE . '_posts_custom_column', array($this, 'set_admin_listing_portfolio_columns_value'), 10, 2);
                add_action('restrict_manage_posts', array($this, 'admin_listing_portfolio_manage_posts'));
                add_filter('parse_query', array($this, 'admin_convert_taxonomy_term_in_query'));
                add_action('admin_enqueue_scripts', array($this, 'admin_enqueue_scripts'), 0);
            } else {

                if (isset($settings['load_script_first']) && $settings['load_script_first'] == '1') {
                    add_action('wp_enqueue_scripts', array($this, 'front_enqueue_scripts'), 100);
                }
            }

        }

        function fat_portfolio_load_textdomain()
        {
            load_plugin_textdomain('fat-portfolio', FALSE, dirname(plugin_basename(__FILE__)) . '/languages');
        }

        //region Register Post type

        function register_post_types()
        {

            $post_type = FAT_PORTFOLIO_POST_TYPE;
            $slug = 'fat-portfolio';
            $name = $singular_name = 'FAT Portfolio';

            if (post_type_exists($post_type)) {
                return;
            }

            $fat_settings = FAT_Portfolio::get_settings();

            if (isset($fat_settings['post_type_slug']) && $fat_settings['post_type_slug'] != '') {
                $slug = $fat_settings['post_type_slug'];
                $name = $fat_settings['post_type_name'];
                $singular_name = $fat_settings['post_type_name'];
            } else {
                $slug = 'portfolio';
                $name = $singular_name = 'Portfolio';
            }

            register_post_type($post_type,
                array(
                    'label'       => esc_html__('FAT Portfolio', 'fat-portfolio'),
                    'description' => esc_html__('FAT Portfolio Description', 'fat-portfolio'),
                    'labels'      => array(
                        'name'               => $name,
                        'singular_name'      => $singular_name,
                        'menu_name'          => ucfirst($name),
                        'parent_item_colon'  => esc_html__('Parent Item:', 'fat-portfolio'),
                        'all_items'          => sprintf(esc_html__('Alle projecten', 'fat-portfolio'), $name),
                        'view_item'          => esc_html__('View Item', 'fat-portfolio'),
                        'add_new_item'       => sprintf(esc_html__('Nieuw project toevoegen', 'fat-portfolio'), $name),
                        'add_new'            => esc_html__('Project toevoegen', 'fat-portfolio'),
                        'edit_item'          => esc_html__('Project wijzigen', 'fat-portfolio'),
                        'update_item'        => esc_html__('Update Item', 'fat-portfolio'),
                        'search_items'       => esc_html__('Search Item', 'fat-portfolio'),
                        'not_found'          => esc_html__('Not found', 'fat-portfolio'),
                        'not_found_in_trash' => esc_html__('Not found in Trash', 'fat-portfolio'),
                    ),
                    'supports'    => array('title', 'thumbnail', 'editor', 'excerpt', 'comments'),
                    'public'      => true,
                    'show_ui'     => true,
                    '_builtin'    => false,
                    'has_archive' => true,
                    'menu_icon'   => 'dashicons-layout',
                    'hierarchical'      =>  true,
                    'rewrite'     => array('slug' => $slug, 'with_front' => true),
                )
            );
            flush_rewrite_rules();
        }

        function register_tag_taxonomies()
        {
            if (taxonomy_exists(FAT_PORTFOLIO_TAG_TAXONOMY)) {
                return;
            }

            $taxonomy_slug = FAT_PORTFOLIO_TAG_TAXONOMY;
            $taxonomy_name = esc_html__('Portfolio Tag', 'fat-portfolio');

            $fat_settings = FAT_Portfolio::get_settings();

            if (isset($fat_settings['tag_slug']) && $fat_settings['tag_slug'] != '') {
                $taxonomy_slug = $fat_settings['tag_slug'];
                $taxonomy_name = $fat_settings['tag_name'];
            }

            $labels = array(
                'name'                       => $taxonomy_name,
                'singular_name'              => $taxonomy_name,
                'search_items'               => esc_html__('Search Tags', 'fat-portfolio'),
                'popular_items'              => esc_html__('Popular Tags', 'fat-portfolio'),
                'all_items'                  => esc_html__('All Tags', 'fat-portfolio'),
                'parent_item'                => null,
                'parent_item_colon'          => null,
                'edit_item'                  => esc_html__('Edit Tag', 'fat-portfolio'),
                'update_item'                => esc_html__('Update Tag', 'fat-portfolio'),
                'add_new_item'               => esc_html__('Add New Tag', 'fat-portfolio'),
                'new_item_name'              => esc_html__('New Tag Name', 'fat-portfolio'),
                'separate_items_with_commas' => esc_html__('Separate tags with commas', 'fat-portfolio'),
                'add_or_remove_items'        => esc_html__('Add or remove tags', 'fat-portfolio'),
                'choose_from_most_used'      => esc_html__('Choose from the most used tags', 'fat-portfolio'),
                'menu_name'                  => $taxonomy_name,
            );

            register_taxonomy(FAT_PORTFOLIO_TAG_TAXONOMY, FAT_PORTFOLIO_POST_TYPE, array(
                'hierarchical'          => false,
                'labels'                => $labels,
                'show_ui'               => true,
                'update_count_callback' => '_update_post_term_count',
                'query_var'             => true,
                'rewrite'               => array('slug' => $taxonomy_slug),
            ));

            $this->flush_rewrite();
        }

        function register_taxonomies()
        {
            if (taxonomy_exists(FAT_PORTFOLIO_CATEGORY_TAXONOMY)) {
                return;
            }

            $taxonomy_slug = FAT_PORTFOLIO_CATEGORY_TAXONOMY;
            $taxonomy_name = esc_html__('Categories', 'fat-portfolio');

            $fat_settings = FAT_Portfolio::get_settings();

            if (isset($fat_settings['taxonomy_slug']) && $fat_settings['taxonomy_slug'] != '') {
                $taxonomy_slug = $fat_settings['taxonomy_slug'];
                $taxonomy_name = $fat_settings['taxonomy_name'];
            }

            register_taxonomy(FAT_PORTFOLIO_CATEGORY_TAXONOMY, FAT_PORTFOLIO_POST_TYPE,
                array('hierarchical' => true,
                      'label'        => $taxonomy_name,
                      'query_var'    => true,
                      'rewrite'      => array('slug' => $taxonomy_slug))
            );

            $this->flush_rewrite();
        }

        function register_attribute_taxonomies()
        {
            $fat_settings = FAT_Portfolio::get_settings();
            if (!isset($fat_settings['enable_special_attribute']) || $fat_settings['enable_special_attribute'] != '1') {
                return;
            }
            $fat_settings = FAT_Portfolio::get_settings();

            if (!taxonomy_exists(FAT_PORTFOLIO_COUNTRY_TAXONOMY)) {
                $taxonomy_slug = FAT_PORTFOLIO_COUNTRY_TAXONOMY;
                $taxonomy_name = FAT_PORTFOLIO_COUNTRY_TAXONOMY_NAME;

                if (isset($fat_settings['country_slug']) && $fat_settings['country_slug'] != '') {
                    $taxonomy_slug = $fat_settings['country_slug'];
                    $taxonomy_name = isset($fat_settings['country_name']) ? $fat_settings['country_name'] : $taxonomy_name;
                }

                register_taxonomy(FAT_PORTFOLIO_COUNTRY_TAXONOMY, FAT_PORTFOLIO_POST_TYPE,
                    array('hierarchical' => true,
                          'label'        => $taxonomy_name,
                          'query_var'    => true,
                          'rewrite'      => array('slug' => $taxonomy_slug))
                );
            }

            if (!taxonomy_exists(FAT_PORTFOLIO_YEARS_TAXONOMY)) {
                $taxonomy_slug = FAT_PORTFOLIO_YEARS_TAXONOMY;
                $taxonomy_name = FAT_PORTFOLIO_YEARS_TAXONOMY_NAME;

                if (isset($fat_settings['years_slug']) && $fat_settings['years_slug'] != '') {
                    $taxonomy_slug = $fat_settings['years_slug'];
                    $taxonomy_name = isset($fat_settings['years_name']) ? $fat_settings['years_name'] : $taxonomy_name;
                }

                register_taxonomy(FAT_PORTFOLIO_YEARS_TAXONOMY, FAT_PORTFOLIO_POST_TYPE,
                    array('hierarchical' => true,
                          'label'        => $taxonomy_name,
                          'query_var'    => true,
                          'rewrite'      => array('slug' => $taxonomy_slug))
                );
            }

            if (!taxonomy_exists(FAT_PORTFOLIO_TYPE_TAXONOMY)) {
                $taxonomy_slug = FAT_PORTFOLIO_TYPE_TAXONOMY;
                $taxonomy_name = FAT_PORTFOLIO_TYPE_TAXONOMY_NAME;

                if (isset($fat_settings['type_slug']) && $fat_settings['type_slug'] != '') {
                    $taxonomy_slug = $fat_settings['type_slug'];
                    $taxonomy_name = isset($fat_settings['type_name']) ? $fat_settings['type_name'] : $taxonomy_name;
                }

                register_taxonomy(FAT_PORTFOLIO_TYPE_TAXONOMY, FAT_PORTFOLIO_POST_TYPE,
                    array('hierarchical' => true,
                          'label'        => $taxonomy_name,
                          'query_var'    => true,
                          'rewrite'      => array('slug' => $taxonomy_slug))
                );
            }

            if (!taxonomy_exists(FAT_PORTFOLIO_STATUS_TAXONOMY)) {
                $taxonomy_slug = FAT_PORTFOLIO_STATUS_TAXONOMY;
                $taxonomy_name = FAT_PORTFOLIO_STATUS_TAXONOMY_NAME;

                if (isset($fat_settings['status_slug']) && $fat_settings['status_slug'] != '') {
                    $taxonomy_slug = $fat_settings['status_slug'];
                    $taxonomy_name = isset($fat_settings['status_name']) ? $fat_settings['status_name'] : $taxonomy_name;
                }

                register_taxonomy(FAT_PORTFOLIO_STATUS_TAXONOMY, FAT_PORTFOLIO_POST_TYPE,
                    array('hierarchical' => true,
                          'label'        => $taxonomy_name,
                          'query_var'    => true,
                          'rewrite'      => array('slug' => $taxonomy_slug))
                );
            }

            $this->flush_rewrite();

        }

        function add_admin_listing_portfolio_columns($columns)
        {
            unset(
                $columns['cb'],
                $columns['title'],
                $columns['date'],
                $columns['author']
            );
            $cols = array_merge(array('cb' => ('')), $columns);
            $cols = array_merge($cols, array('title' => esc_html__('Projecten', 'fat-portfolio')));
            $cols = array_merge($cols, array('thumbnail' => esc_html__('Afbeelding', 'fat-portfolio')));
            $cols = array_merge($cols, array(FAT_PORTFOLIO_CATEGORY_TAXONOMY => esc_html__('Werkzaamheden', 'fat-portfolio')));
            $cols = array_merge($cols, array('author' => esc_html__('Auteur', 'fat-portfolio')));
            $cols = array_merge($cols, array('date' => esc_html__('Datum', 'fat-portfolio')));
            return $cols;
        }

        function set_admin_listing_portfolio_columns_value($column, $post_id)
        {
            switch ($column) {
                case 'id': {
                    echo wp_kses_post($post_id);
                    break;
                }
                case 'thumbnail': {
                    echo get_the_post_thumbnail($post_id, 'thumbnail');
                    break;
                }
                case 'author': {
                    echo get_the_author_link();
                    break;
                }
                case FAT_PORTFOLIO_CATEGORY_TAXONOMY: {
                    $terms = wp_get_post_terms(get_the_ID(), array(FAT_PORTFOLIO_CATEGORY_TAXONOMY));
                    $cat = '<ul>';
                    foreach ($terms as $term) {
                        $cat .= '<li><a href="' . get_term_link($term, FAT_PORTFOLIO_CATEGORY_TAXONOMY) . '">' . $term->name . '<a/></li>';
                    }
                    $cat .= '</ul>';
                    echo wp_kses_post($cat);
                    break;
                }
            }
        }

        function admin_listing_portfolio_manage_posts()
        {
            global $typenow;
            if ($typenow == FAT_PORTFOLIO_POST_TYPE) {
                $selected = isset($_GET[FAT_PORTFOLIO_CATEGORY_TAXONOMY]) ? $_GET[FAT_PORTFOLIO_CATEGORY_TAXONOMY] : '';
                $args = array(
                    'show_count'      => true,
                    'show_option_all' => esc_html__('Alle werkzaamheden', 'fat-portfolio'),
                    'taxonomy'        => FAT_PORTFOLIO_CATEGORY_TAXONOMY,
                    'name'            => FAT_PORTFOLIO_CATEGORY_TAXONOMY,
                    'selected'        => $selected,
                );
                wp_dropdown_categories($args);
            }
        }

        function admin_convert_taxonomy_term_in_query($query)
        {
            global $pagenow;
            $qv = &$query->query_vars;
            if ($pagenow == 'edit.php' &&
                isset($qv[FAT_PORTFOLIO_CATEGORY_TAXONOMY]) &&
                is_numeric($qv[FAT_PORTFOLIO_CATEGORY_TAXONOMY])
            ) {
                $term = get_term_by('id', $qv[FAT_PORTFOLIO_CATEGORY_TAXONOMY], FAT_PORTFOLIO_CATEGORY_TAXONOMY);
                $qv[FAT_PORTFOLIO_CATEGORY_TAXONOMY] = $term->slug;
            }
        }

        //endregion Register Post type

        /* begin register custom structure slug */
        function add_portfolio_permastructure(){
            global $wp_rewrite;
            $slug = 'fat-portfolio';
            $fat_settings = FAT_Portfolio::get_settings();
            if (isset($fat_settings['post_type_slug']) && $fat_settings['post_type_slug'] != '') {
                $slug = $fat_settings['post_type_slug'];
            }
            add_permastruct( FAT_PORTFOLIO_POST_TYPE, $slug.'/%'.FAT_PORTFOLIO_CATEGORY_TAXONOMY.'%/%'.FAT_PORTFOLIO_POST_TYPE.'%', false );
        }
        function portfolio_permalinks($permalink, $post ){
            if ( $post->post_type !== FAT_PORTFOLIO_POST_TYPE )
                return $permalink;
            $terms = get_the_terms( $post->ID, FAT_PORTFOLIO_CATEGORY_TAXONOMY );

            if ( ! $terms )
                return str_replace( '%'.FAT_PORTFOLIO_CATEGORY_TAXONOMY .'%/', '', $permalink );
            $post_terms = '';
            if(isset($terms) && is_array($terms) && count($terms)){
                $term_parents = $this->get_term_parents( $terms[0] );
                $total = count($term_parents);
                for($i=$total;$i>=0;$i--){
                    if(isset($term_parents[$i-1]->slug)){
                        $post_terms .= $term_parents[$i-1]->slug;
                        $post_terms .= $i > 0 ? '-' : '';
                    }
                }
                $post_terms.= $terms[0]->slug;
            }
            return str_replace( '%'.FAT_PORTFOLIO_CATEGORY_TAXONOMY .'%', $post_terms , $permalink );
        }
        function add_term_parents_to_permalinks($permalink, $term){
            $term_parents = $this->get_term_parents( $term );
            foreach ( $term_parents as $term_parent )
                $permlink = str_replace( $term->slug, $term_parent->slug . ',' . $term->slug, $permalink );
            return $permlink;
        }
        function get_term_parents( $term, &$parents = array() ) {
            $parent = get_term( $term->parent, $term->taxonomy );

            if ( is_wp_error( $parent ) )
                return $parents;

            $parents[] = $parent;
            if ( $parent->parent )
                $this->get_term_parents( $parent, $parents );
            return $parents;
        }
        /* end register custom structure slug */

        //region Load text domain

        function load_text_domain()
        {
            load_plugin_textdomain('fat-portfolio', false, plugin_basename(dirname(__FILE__)) . '/languages');
        }

        //endregion Load text domain

        //region Enqueue Script

        function front_enqueue_scripts()
        {
            $settings = function_exists('fat_get_settings') ? fat_get_settings() : array();

            wp_enqueue_style('fat-animate', FAT_PORTFOLIO_ASSET_JS_URL . 'library/animate/animate.css', array(), false);
            wp_enqueue_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css', array(), false);
            wp_enqueue_style('fat-ladda-css', FAT_PORTFOLIO_ASSET_JS_URL . 'library/ladda/ladda-themeless.min.css', array(), false);
            wp_enqueue_style('jquery-light-gallery', FAT_PORTFOLIO_ASSET_JS_URL . 'library/light-gallery/css/lightgallery.min.css', array(), false);
            wp_enqueue_style('jquery-light-gallery-transition', FAT_PORTFOLIO_ASSET_JS_URL . 'library/light-gallery/css/lg-transitions.min.css', array(), false);

            wp_enqueue_style('jssocials', FAT_PORTFOLIO_ASSET_JS_URL . 'library/jssocials/jssocials.css', array(), false);
            wp_enqueue_style('jssocials-flat', FAT_PORTFOLIO_ASSET_JS_URL . 'library/jssocials/jssocials-theme-flat.css', array(), false);

            wp_enqueue_style('jquery-magnific-popup', FAT_PORTFOLIO_ASSET_JS_URL . 'library/magnific-popup/magnific-popup.css', array(), '1.1.0');
            wp_enqueue_style('carousel', FAT_PORTFOLIO_ASSET_JS_URL . 'library/owl-carousel/assets/owl.carousel.min.css', array(), false);

            wp_enqueue_style('fat-portfolio', FAT_PORTFOLIO_ASSET_CSS_URL . 'frontend/portfolio.css', array(), false);
            //wp_print_styles('fat-portfolio');

            if (!isset($settings['unload_script_owl_carousel']) || $settings['unload_script_owl_carousel'] == '0' || $settings['unload_script_owl_carousel'] == '') {
                wp_enqueue_script('carousel', FAT_PORTFOLIO_ASSET_JS_URL . 'library/owl-carousel/owl.carousel.min.js', array('jquery'), false, true);
            }

            wp_enqueue_style('flipster', FAT_PORTFOLIO_ASSET_JS_URL . 'library/flipster/jquery.flipster.min.css', array(), '1.1.2');
            if (!isset($settings['unload_script_flipster']) || $settings['unload_script_flipster'] == '0' || $settings['unload_script_flipster'] == '') {
                wp_enqueue_script('flipster', FAT_PORTFOLIO_ASSET_JS_URL . 'library/flipster/jquery.flipster.min.js', array('jquery'), '1.1.2', true);
            }

            if (!isset($settings['unload_script_waterwheel_carousel']) || $settings['unload_script_waterwheel_carousel'] == '0' || $settings['unload_script_waterwheel_carousel'] == '') {
                wp_enqueue_script('waterwheel', FAT_PORTFOLIO_ASSET_JS_URL . 'library/waterwheel/jquery.waterwheelCarousel.min.js', array('jquery'), false, true);
            }

            wp_enqueue_script('jssocials', FAT_PORTFOLIO_ASSET_JS_URL . 'library/jssocials/jssocials.min.js', array('jquery'), false, true);

            if (!isset($settings['unload_script_isotope']) || $settings['unload_script_isotope'] == '0' || $settings['unload_script_isotope'] == '') {
                wp_enqueue_script('imagesloaded', FAT_PORTFOLIO_ASSET_JS_URL . 'library/isotope/imagesloaded.pkgd.min.js', array('jquery'), false, true);
                wp_enqueue_script('fat-isotope', FAT_PORTFOLIO_ASSET_JS_URL . 'library/isotope/isotope.pkgd.min.js', array('jquery'), false, true);
                wp_enqueue_script('fat-masonry', FAT_PORTFOLIO_ASSET_JS_URL . 'library/isotope/masonry.pkgd.min.js', array('jquery'), false, true);
            }
            if (!isset($settings['unload_script_modernizr']) || $settings['unload_script_modernizr'] == '0' || $settings['unload_script_modernizr'] == '') {
                wp_enqueue_script('modernizr', FAT_PORTFOLIO_ASSET_JS_URL . 'library/modernizr-custom.js', array('jquery'), false, true);
            }

            wp_enqueue_script('ladda-spin', FAT_PORTFOLIO_ASSET_JS_URL . 'library/ladda/spin.min.js', false, true);
            wp_enqueue_script('ladda', FAT_PORTFOLIO_ASSET_JS_URL . 'library/ladda/ladda.min.js', false, true);


            if (!isset($settings['unload_script_light_gallery']) || $settings['unload_script_light_gallery'] == '0' || $settings['unload_script_light_gallery'] == '') {
                wp_enqueue_script('jquery-light-gallery', FAT_PORTFOLIO_ASSET_JS_URL . 'library/light-gallery/js/lightgallery.min.js', array('jquery'), false, true);
            }
            if (!isset($settings['unload_script_magnific_popup']) || $settings['unload_script_magnific_popup'] == '0' || $settings['unload_script_magnific_popup'] == '') {
                wp_enqueue_script('jquery-magnific-popup', FAT_PORTFOLIO_ASSET_JS_URL . 'library/magnific-popup/jquery.magnific-popup.min.js', array('jquery'), false, true);
            }

            wp_enqueue_script('fat-flickr-api', FAT_PORTFOLIO_ASSET_JS_URL . 'library/flickr/flickr-api.js', false, true);
            wp_enqueue_script('fat-instagram-api', FAT_PORTFOLIO_ASSET_JS_URL . 'library/instafeed/instafeed.min.js', false, true);
            wp_enqueue_script('fat-portfolio', FAT_PORTFOLIO_ASSET_JS_URL . 'frontend/portfolio.js', array('fat-flickr-api', 'fat-instagram-api'), $this->version, true);
            wp_localize_script('fat-portfolio', 'fat_ajax', array('ajaxurl' => admin_url('admin-ajax.php')));

        }

        function admin_enqueue_scripts()
        {
            $screen = get_current_screen();
            if (isset($screen->base)) {
                if ($screen->base === 'fat-portfolio_page_fat_portfolio_shortcode_edit' || $screen->base === 'fat-portfolio_page_fat-portfolio-settings') {

                    wp_enqueue_style('animate', FAT_PORTFOLIO_ASSET_JS_URL . 'library/animate/animate.css', array(), false);
                    wp_enqueue_style('selectize', FAT_PORTFOLIO_ASSET_JS_URL . 'library/selectize/css/selectize.default.css', array(), false);
                    wp_enqueue_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css', array(), false);
                    wp_enqueue_style('rangeslider', FAT_PORTFOLIO_ASSET_JS_URL . 'library/rangeslider/rangeslider.css', array(), false);
                    wp_enqueue_style('bootstrap-colorpicker', FAT_PORTFOLIO_ASSET_JS_URL . 'library/color-picker/css/bootstrap-colorpicker.min.css', array(), false);
                    wp_enqueue_style('fat-portfolio-setting', FAT_PORTFOLIO_ASSET_CSS_URL . 'admin/setting.css', array(), false);

                    wp_enqueue_script('clipboard', FAT_PORTFOLIO_ASSET_JS_URL . 'library/clipboard/clipboard.min.js', false, true);
                    wp_enqueue_script('ace_editor', '//cdnjs.cloudflare.com/ajax/libs/ace/1.2.5/ace.js', array('jquery'), '1.3.3', true);
                    wp_enqueue_script('selectize', FAT_PORTFOLIO_ASSET_JS_URL . 'library/selectize/js/selectize.min.js', array('jquery-ui-sortable'), '0.12.4', true);
                    wp_enqueue_script('bootstrap-colorpicker', FAT_PORTFOLIO_ASSET_JS_URL . 'library/color-picker/js/bootstrap-colorpicker.min.js', false, true);
                    wp_enqueue_script('rangeslider', FAT_PORTFOLIO_ASSET_JS_URL . 'library/rangeslider/rangeslider.min.js', false, true);
                    wp_enqueue_script('fat-portfolio-utils', FAT_PORTFOLIO_ASSET_JS_URL . 'admin/utils.js', array('jquery-ui-dialog'), false, true);
                    wp_enqueue_script('fat-portfolio-controls', FAT_PORTFOLIO_ASSET_JS_URL . 'admin/controls.js', array('ace_editor'), false, true);

                    $shortcode_data = array(
                        'shortcode_id' => isset($_GET['sc_id']) ? $_GET['sc_id'] : '',
                        'ajax_url'     => admin_url('admin-ajax.php')
                    );
                    if ($screen->base === 'fat-portfolio_page_fat-portfolio-settings') {
                        wp_register_script('fat-portfolio-setting', FAT_PORTFOLIO_ASSET_JS_URL . 'admin/setting.js', array('wp-util', 'ace_editor', 'fat-portfolio-utils', 'fat-portfolio-controls'), false, true);
                        wp_localize_script('fat-portfolio-setting', 'shortcode_data', $shortcode_data);
                        wp_enqueue_script('fat-portfolio-setting');
                    }

                    if ($screen->base === 'fat-portfolio_page_fat_portfolio_shortcode_edit') {
                        wp_register_script('fat-portfolio-shortcodes-edit', FAT_PORTFOLIO_ASSET_JS_URL . 'admin/shortcodes-edit.js', array('wp-util', 'ace_editor', 'fat-portfolio-utils', 'fat-portfolio-controls'), $this->version, true);
                        wp_localize_script('fat-portfolio-shortcodes-edit', 'shortcode_data', $shortcode_data);
                        wp_enqueue_script('fat-portfolio-shortcodes-edit');
                    }

                }
                if ($screen->base === 'fat-portfolio_page_fat-portfolio-shortcode') {
                    wp_enqueue_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css', array(), false);
                    wp_enqueue_style('fat-portfolio-setting', FAT_PORTFOLIO_ASSET_CSS_URL . 'admin/setting.css', array('font-awesome'), false);

                    $shortcode_data = array(
                        'ajax_url' => admin_url('admin-ajax.php')
                    );
                    wp_enqueue_script('clipboard', FAT_PORTFOLIO_ASSET_JS_URL . 'library/clipboard/clipboard.min.js', false, true);
                    wp_enqueue_script('fat-portfolio-utils', FAT_PORTFOLIO_ASSET_JS_URL . 'admin/utils.js', array('jquery-ui-dialog'), false, true);
                    wp_register_script('fat-portfolio-shortcodes', FAT_PORTFOLIO_ASSET_JS_URL . 'admin/shortcodes.js', array('clipboard', 'clipboard', 'wp-util', 'fat-portfolio-utils'), false, true);
                    wp_localize_script('fat-portfolio-shortcodes', 'shortcode_data', $shortcode_data);
                    wp_enqueue_script('fat-portfolio-shortcodes');
                }
            }
            wp_enqueue_style('fat-portfolio-vc', FAT_PORTFOLIO_ASSET_CSS_URL . 'admin/vc.css', array(), false);
        }

        //endregion Endqueue Script

        //region Post type metabox

        function register_meta_boxes($meta_boxes)
        {
            /** new metabox */
            $single_layout = array(
                'none'                                 => esc_html__('Inherit from FAT Portfolio Single Setting', 'fat-portfolio'),
                'single-small-image-slide-left'        => esc_html__('Small image slide left', 'fat-portfolio'),
                'single-small-image-slide-right'       => esc_html__('Small image slide right', 'fat-portfolio'),
                'single-big-image-slide'               => esc_html__('Big image slide', 'fat-portfolio'),
                'single-big-image-slide-post-content'  => esc_html__('Big image slide with portfolio content center', 'fat-portfolio'),
                'single-big-image-slide-content-float' => esc_html__('Big image slide with portfolio content float', 'fat-portfolio'),
                'single-horizonal-image-left'          => esc_html__('Horizonal image left', 'fat-portfolio'),
                'single-horizonal-image-right'         => esc_html__('Horizonal image right', 'fat-portfolio'),
                'single-image-gallery-left'            => esc_html__('Image gallery left', 'fat-portfolio'),
                'single-image-gallery-right'           => esc_html__('Image gallery right', 'fat-portfolio'),
                'single-image-gallery-top'             => esc_html__('Image gallery top', 'fat-portfolio'),
                'single-image-gallery-bottom'          => esc_html__('Image gallery bottom', 'fat-portfolio'),
                'single-small-video-slide-left'        => esc_html__('Small video slide left', 'fat-portfolio'),
                'single-small-video-slide-right'       => esc_html__('Small video slide right', 'fat-portfolio'),
                'single-big-video-slide'               => esc_html__('Big video slide', 'fat-portfolio'),
                'single-big-video-slide-post-content'  => esc_html__('Big video slide with portfolio content', 'fat-portfolio'),
            );
            $fat_settings = FAT_Portfolio::get_settings();
            if (isset($fat_settings['enable_special_attribute']) && $fat_settings['enable_special_attribute'] == '1') {
                $single_layout['single-attr-big-image-slide'] = esc_html__('Big image slide with special attribute', 'fat-portfolio');
            }
            $meta_boxes[] = array(
                'title'    => esc_html__('Portfolio General', 'fat-portfolio'),
                'id'       => 'fat-mb-portfolio-general',
                'priority' => 'high',
                'pages'    => array(FAT_PORTFOLIO_POST_TYPE),
                'fields'   => array(
                    array(
                        'label'       => esc_html__('Css class', 'fat-portfolio'),
                        'id'          => 'css_class',
                        'type'        => 'text',
                        'std'         => '',
                        'description' => 'This is css class add to single portfolio page'
                    ),
                    array(
                        'label'       => esc_html__('Link to detail', 'fat-portfolio'),
                        'id'          => 'link_to_detail',
                        'type'        => 'text',
                        'std'         => '',
                        'description' => 'Paste link to detail what you want go to when client click icon link'
                    ),
                    array(
                        'label'    => esc_html__('Single layout', 'fat-portfolio'),
                        'id'       => 'fat_portfolio_single_layout',
                        'type'     => 'select',
                        'multiple' => false,
                        'options'  => $single_layout,
                        'std'      => ''
                    )
                )

            );
            $meta_boxes[] = array(
                'title'    => esc_html__('Afbeeldingen/video toevoegen', 'fat-portfolio'),
                'id'       => 'fat-meta-box-gallery-type',
                'priority' => 'high',
                'pages'    => array(FAT_PORTFOLIO_POST_TYPE),
                'fields'   => array(
                    array(
                        'label'   => esc_html__('Selecteer afbeelding/video', 'fat-portfolio'),
                        'id'      => 'fat_mb_gallery_type',
                        'type'    => 'radio',
                        'options' => array(
                            'image' => 'Afbeeldingen',
                            'video' => 'Video'
                        ),
                        'std'     => 'image'
                    ),
                    array(
                        'label'        => esc_html__('Selecteer media bron', 'fat-portfolio'),
                        'id'           => 'fat_mb_media_source',
                        'type'         => 'radio',
                        'options'      => array(
                            'media'     => 'Uploaden',
                            'flickr'    => 'From Flickr',
                            'instagram' => 'From Instagram'
                        ),
                        'std'          => 'media',
                        'depend_field' => array(
                            'field'   => 'fat_mb_gallery_type',
                            'value'   => 'image',
                            'compare' => '='
                        ),
                    ),
                    array(
                        'label'        => esc_html__('Mediabibliotheek', 'fat-portfolio'),
                        'id'           => 'fat_mb_image_gallery',
                        'type'         => 'images',
                        'depend_field' => array(
                            'field'   => 'fat_mb_media_source',
                            'value'   => 'media',
                            'compare' => '='
                        ),
                        'description'  => 'U kunt de volgorde wijzigen, door de afbeeldingen te slepen.'
                    ),
                    array(
                        'label'        => esc_html__('Flickr Media', 'fat-portfolio'),
                        'id'           => 'fat_mb_flickr_gallery',
                        'type'         => 'flickr',
                        'depend_field' => array(
                            'field'   => 'fat_mb_media_source',
                            'value'   => 'flickr',
                            'compare' => '='
                        ),
                    ),
                    array(
                        'label'        => esc_html__('Instagram Media', 'fat-portfolio'),
                        'id'           => 'fat_mb_instagram_gallery',
                        'type'         => 'instagram',
                        'depend_field' => array(
                            'field'   => 'fat_mb_media_source',
                            'value'   => 'instagram',
                            'compare' => '='
                        ),
                    ),
                    array(
                        'label'        => esc_html__('Video Gallery', 'fat-portfolio'),
                        'id'           => 'fat_mb_video_gallery',
                        'type'         => 'repeat',
                        'fields'       => array(
                            array(
                                'label'     => 'Link video',
                                'id'        => 'link_video',
                                'type'      => 'text',
                                'col_width' => 'fat-cmb-col-12',
                                'std'       => ''
                            )
                        ),
                        'depend_field' => array(
                            'field'   => 'fat_mb_gallery_type',
                            'value'   => 'video',
                            'compare' => '='
                        )
                    )
                )
            );

            $meta_boxes[] = array(
                'title'    => esc_html__('Kenmerken project', 'fat-portfolio'),
                'id'       => 'fat-meta-box-attribute',
                'priority' => 'high',
                'pages'    => array(FAT_PORTFOLIO_POST_TYPE),
                'fields'   => array(
                    array(
                        'label'  => esc_html__('Kenmerk', 'fat-portfolio'),
                        'id'     => 'fat_mb_portfolio_attribute',
                        'type'   => 'repeat',
                        'fields' => array(
                            array(
                                'label' => 'Titel',
                                'id'    => 'title_attribute',
                                'type'  => 'text',
                                'std'   => ''
                            ),
                            array(
                                'label' => 'Waarde',
                                'id'    => 'value_attribute',
                                'type'  => 'text',
                                'std'   => ''
                            )
                        )
                    )
                )
            );

            return $meta_boxes;
        }


        //endregion Post type metabox

        //region Register Setting page

        function addMenuPage()
        {
            add_submenu_page(
                'edit.php?post_type=' . FAT_PORTFOLIO_POST_TYPE,
                esc_html__('Shortcodes', 'fat-portfolio'),
                esc_html__('Shortcodes', 'fat-portfolio'),
                'manage_options',
                'fat-portfolio-shortcode',
                array($this, 'initPageShortcodes')
            );

            add_submenu_page(
                'edit.php?post_type=' . FAT_PORTFOLIO_POST_TYPE,
                esc_html__('Add shortcode', 'fat-portfolio'),
                esc_html__('Add shortcode', 'fat-portfolio'),
                'manage_options',
                'fat_portfolio_shortcode_edit',
                array($this, 'initPageShortcodesEdit')
            );

            add_submenu_page(
                'edit.php?post_type=' . FAT_PORTFOLIO_POST_TYPE,
                'Setting',
                'Settings',
                'edit_posts',
                'fat-portfolio-settings',
                array($this, 'initPageSettings')
            );
        }

        function initPageSettings()
        {
            $setting_path = untrailingslashit(plugin_dir_path(__FILE__) . 'settings/settings.php');
            if (!file_exists($setting_path)) {
                $setting_path = ABSPATH . 'wp-content/plugins/fa-portfolio/settings/settings.php';
            }
            if (file_exists($setting_path))
                include_once $setting_path;
        }

        function initPageShortcodes()
        {
            $shortcodes_path = untrailingslashit(plugin_dir_path(__FILE__) . 'settings/shortcodes.php');
            if (!file_exists($shortcodes_path)) {
                $shortcodes_path = ABSPATH . 'wp-content/plugins/fa-portfolio/settings/shortcodes.php';
            }
            if (file_exists($shortcodes_path))
                include_once $shortcodes_path;
        }

        function initPageShortcodesEdit()
        {
            $shortcodes_path = untrailingslashit(plugin_dir_path(__FILE__) . 'settings/shortcodes-edit.php');
            $base_class_path = untrailingslashit(plugin_dir_path(__FILE__) . 'utils/base.php');
            if (!file_exists($shortcodes_path)) {
                $shortcodes_path = ABSPATH . 'wp-content/plugins/fa-portfolio/settings/shortcodes-edit.php';
            }
            if (file_exists($shortcodes_path) && file($base_class_path)) {
                require_once $base_class_path;
                include_once $shortcodes_path;
            }
        }

        //endregion Setting page

        //region Register Shortcode

        function fat_portfolio_shortcode($atts)
        {
            $atts = shortcode_atts(array(
                'name'         => 'grid',
                'current_page' => 1,
                'category'     => '',
                'country'      => '',
                'years'        => '',
                'type'         => '',
                'status'       => '',
                'ajax'         => 0
            ), $atts, 'fat_portfolio');

            $shortcode_name = isset($atts['name']) ? $atts['name'] : '';
            if ($shortcode_name == '') {
                esc_html_e('Missing shortcode name ', 'fat-portfolio');
                return;
            }
            $shortcode = Fat_Portfolio_Base::get_shortcode_by_name($shortcode_name);
            if ($shortcode == null) {
                esc_html_e('Could not found shortcode with this name', 'fat-portfolio');
                return;
            }

            $settings = function_exists('fat_get_settings') ? fat_get_settings() : array();

            $id = $shortcode['id'];
            $shortcode_name = isset($shortcode['name']) ? $shortcode['name'] : '';
            $layout_type = isset($shortcode['layout_type']) ? $shortcode['layout_type'] : 'grid';
            $light_box = isset($shortcode['light_box_gallery']) ? $shortcode['light_box_gallery'] : 'magnific-popup';
            $crop_image = isset($shortcode['crop_image']) && $shortcode['crop_image'] == 'true';
            $full_gallery = isset($shortcode['full_gallery']) && $shortcode['full_gallery'] == 'true';
            $image_width = isset($shortcode['image_width']) ? $shortcode['image_width'] : 475;
            $image_height = isset($shortcode['image_height']) ? $shortcode['image_height'] : 375;
            $columns = isset($shortcode['columns']) ? $shortcode['columns'] : 3;
            $gutter = isset($shortcode['gutter']) ? $shortcode['gutter'] : 10;
            $get_title_from = isset($shortcode['title_from']) && $shortcode['title_from'] != '' ? $shortcode['title_from'] : 'portfolio-title';
            $data_source = isset($shortcode['data_source']) ? $shortcode['data_source'] : 'categories';
            $categories = isset($shortcode['categories']) ? $shortcode['categories'] : array();
            $hide_all_category = isset($shortcode['hide_all_category']) && $shortcode['hide_all_category'] == '1';

            $country_attr = $years_attr = $type_attr = $status_attr = array();
            $enable_special_attr = isset($settings['enable_special_attribute']) && $settings['enable_special_attribute'] == '1';
            if ($enable_special_attr) {
                $country_attr = isset($shortcode['ds_country']) && $shortcode['ds_country'] !== '' ? $shortcode['ds_country'] : Fat_Portfolio_Base::get_portfolio_taxonomy_slug(FAT_PORTFOLIO_COUNTRY_TAXONOMY);
                $years_attr = isset($shortcode['ds_years']) && $shortcode['ds_years'] !== '' ? $shortcode['ds_years'] : Fat_Portfolio_Base::get_portfolio_taxonomy_slug(FAT_PORTFOLIO_YEARS_TAXONOMY);
                $type_attr = isset($shortcode['ds_type']) && $shortcode['ds_type'] !== '' ? $shortcode['ds_type'] : Fat_Portfolio_Base::get_portfolio_taxonomy_slug(FAT_PORTFOLIO_TYPE_TAXONOMY);
                $status_attr = isset($shortcode['ds_status']) && $shortcode['ds_status'] !== '' ? $shortcode['ds_status'] : Fat_Portfolio_Base::get_portfolio_taxonomy_slug(FAT_PORTFOLIO_STATUS_TAXONOMY);
            }

            $ids = isset($shortcode['ids']) ? $shortcode['ids'] : array();
            $authors = isset($shortcode['author']) ? $shortcode['author'] : '';
            $exclude_post = isset($shortcode['exclude_post']) ? $shortcode['exclude_post'] : '';
            $filter_type = isset($shortcode['filter_type']) ? $shortcode['filter_type'] : 'isotope';
            $show_category = isset($shortcode['show_category']) ? $shortcode['show_category'] : 'none';
            $order = isset($shortcode['order']) ? $shortcode['order'] : '';
            $order_by = isset($shortcode['order_by']) ? $shortcode['order_by'] : '';
            $paging_type = isset($shortcode['paging_type']) ? $shortcode['paging_type'] : 'paging';
            $page_prev_text = isset($shortcode['prev_text']) ? $shortcode['prev_text'] : esc_html__('Prev', 'fat-portfolio');
            $page_next_text = isset($shortcode['next_text']) ? $shortcode['next_text'] : esc_html__('Next', 'fat-portfolio');
            $paging_position = isset($shortcode['paging_position']) ? $shortcode['paging_position'] : 'center';
            $item_per_page = isset($shortcode['item_per_page']) ? $shortcode['item_per_page'] : 9;
            $total_item = isset($shortcode['total_item']) ? $shortcode['total_item'] : 0;
            $limit_excerpt = isset($shortcode['limit_words_excerpt']) ? $shortcode['limit_words_excerpt'] : 0;
            $skin = isset($shortcode['skin']) ? $shortcode['skin'] : 'thumb-icon-hover';
            $animation = isset($shortcode['animation']) ? $shortcode['animation'] : 'none';
            $animation_duration = isset($shortcode['animation_duration']) ? $shortcode['animation_duration'] : 200;
            $current_page = isset($atts['current_page']) ? $atts['current_page'] : 1;
            $ajax = isset($atts['ajax']) ? $atts['ajax'] : 0;
            $loading_color = isset($shortcode['loading_color']) ? $shortcode['loading_color'] : '#343434';
            $all_category_label = isset($settings['all_category_label']) ? $settings['all_category_label'] : esc_html__('All', 'fat-portfolio');
            $all_country_label = isset($settings['all_country_label']) && $settings['all_country_label']!=='' ? $settings['all_country_label'] : esc_html__('All Country', 'fat-portfolio');
            $all_years_label = isset($settings['all_years_label']) && $settings['all_years_label']!=='' ? $settings['all_years_label'] : esc_html__('All Years', 'fat-portfolio');
            $all_type_label = isset($settings['all_type_label']) && $settings['all_type_label']!=='' ? $settings['all_type_label'] : esc_html__('All Type', 'fat-portfolio');
            $all_status_label = isset($settings['all_status_label']) && $settings['all_status_label']!=='' ? $settings['all_status_label'] : esc_html__('All Status', 'fat-portfolio');
            $all_category_label = apply_filters('wpml_translate_single_string', $all_category_label, 'fat-portfolio', 'All Portfolio');

            ob_start();

            $this->front_enqueue_scripts();

            $shortcode_path = untrailingslashit(FAT_PORTFOLIO_DIR_PATH) . '/templates/layouts/' . $layout_type . '.php';
                if (file_exists($shortcode_path)) {
                    include $shortcode_path;
                }

            global $fat_portfolio_custom_css;
            if (!isset($fat_portfolio_custom_css) || !is_array($fat_portfolio_custom_css)) {
                $fat_portfolio_custom_css = array();
            }
            $fat_portfolio_custom_css[$shortcode['id']] = $shortcode;

            remove_action('wp_footer', 'Fat_Portfolio_Base::enqueue_custom_css');
            add_action('wp_footer', 'Fat_Portfolio_Base::enqueue_custom_css');

            $ret = ob_get_contents();
            ob_end_clean();
            return $ret;
        }

        //endregion Register Shortcode

        // Register VC shortcode
        function register_vc_shortcode()
        {
            if (function_exists('vc_map')) {
                $shortcodes = get_option(FAT_PORTFOLIO_SHORTCODE_OPTION_KEY, array());
                $list_shortcode = array();
                $list_shortcode[esc_html__('Please choice shortcode name', 'fat-portfolio')] = '';
                foreach ($shortcodes as $key => $value) {
                    if (isset($value['name'])) {
                        $list_shortcode[$value['name']] = $value['name'];
                    }
                }
                vc_map(array(
                    'name'        => 'FAT Portfolio',
                    'base'        => 'fat_portfolio',
                    'icon'        => 'dashicons dashicons-layout',
                    'category'    => esc_html__('FAT Portfolio', 'fat-portfolio'),
                    'description' => esc_html__('A custom portfolio for your site', 'fat-portfolio'),
                    'params'      => array(
                        array(
                            'type'        => 'dropdown',
                            'heading'     => esc_html__('Shortcode name', 'fat-portfolio'),
                            'param_name'  => 'name',
                            'admin_label' => true,
                            'value'       => $list_shortcode
                        )
                    )
                ));
            }
        }

        function get_portfolio_single_template($single)
        {
            /* Checks for single template by post type */
            if (is_singular(FAT_PORTFOLIO_POST_TYPE)) {
                $fat_settings = FAT_Portfolio::get_settings();

                if (isset($fat_settings['disable_detail']) && $fat_settings['disable_detail'] == '1') {
                    $home_url = get_home_url();
                    wp_redirect($home_url);
                } else {
                    $plugin_path = untrailingslashit(FAT_PORTFOLIO_DIR_PATH);
                    $template_path = $plugin_path . '/templates/single/single-portfolio.php';
                    if (file_exists($template_path)) {
                        add_action('wp_footer', array($this, 'generate_custom_css'));
                        return $template_path;
                    }
                }
            }
            return $single;
        }

        function get_portfolio_archive_template($archive_template)
        {
            /* Checks for archive template by post type */
            if (is_post_type_archive(FAT_PORTFOLIO_POST_TYPE) || is_tax(FAT_PORTFOLIO_CATEGORY_TAXONOMY) || is_tax(FAT_PORTFOLIO_TAG_TAXONOMY)
                || is_tax(FAT_PORTFOLIO_COUNTRY_TAXONOMY) || is_tax(FAT_PORTFOLIO_YEARS_TAXONOMY) ||
                is_tax(FAT_PORTFOLIO_TYPE_TAXONOMY) || is_tax(FAT_PORTFOLIO_STATUS_TAXONOMY)
            ) {
                $fat_settings = FAT_Portfolio::get_settings();
                $archive_page_id = isset($fat_settings['archive_page']) ? $fat_settings['archive_page'] : '';

                if (is_tax(FAT_PORTFOLIO_TAG_TAXONOMY)) {
                    $archive_page_id = isset($fat_settings['archive_tag_page']) ? $fat_settings['archive_tag_page'] : '';
                }

                if (is_tax(FAT_PORTFOLIO_COUNTRY_TAXONOMY) || is_tax(FAT_PORTFOLIO_YEARS_TAXONOMY)
                    || is_tax(FAT_PORTFOLIO_TYPE_TAXONOMY) || is_tax(FAT_PORTFOLIO_STATUS_TAXONOMY)
                ) {
                    $archive_page_id = isset($fat_settings['archive_attr_page']) ? $fat_settings['archive_attr_page'] : '';
                }

                if (isset($archive_page_id) && $archive_page_id != '') {
                    $cat = get_queried_object();
                    $category = '';
                    if (isset($cat) && isset($cat->slug)) {
                        $category = $cat->slug;
                    }
                    $archive_url = get_permalink($archive_page_id);

                    if (is_tax(FAT_PORTFOLIO_TAG_TAXONOMY)) {
                        $archive_url = $category ? $archive_url . '?tag=' . $category : $archive_url;

                    } else if (is_tax(FAT_PORTFOLIO_COUNTRY_TAXONOMY)) {
                        $archive_url = $category ? $archive_url . '?country=' . $category : $archive_url;

                    } else if (is_tax(FAT_PORTFOLIO_YEARS_TAXONOMY)) {
                        $archive_url = $category ? $archive_url . '?years=' . $category : $archive_url;

                    } else if (is_tax(FAT_PORTFOLIO_TYPE_TAXONOMY)) {
                        $archive_url = $category ? $archive_url . '?type=' . $category : $archive_url;

                    } else if (is_tax(FAT_PORTFOLIO_STATUS_TAXONOMY)) {
                        $archive_url = $category ? $archive_url . '?status=' . $category : $archive_url;

                    } else {
                        $archive_url = $category ? $archive_url . '?category=' . $category : $archive_url;
                    }

                    wp_redirect($archive_url);
                } else {
                    $home_url = get_home_url();
                    wp_redirect($home_url);
                }
            }
            return $archive_template;
        }

        //region Generate Custom Css

        function generate_custom_css()
        {
            $fat_settings = FAT_Portfolio::get_settings();
            $plugin_path = untrailingslashit(plugin_dir_path(__FILE__));
            $css_template = $plugin_path . '/assets/css/frontend/custom-css.php';
            if (file_exists($css_template)) {
                ob_start();
                include_once($css_template);
                $custom_css = ob_get_contents();
                ob_end_clean();
                echo sprintf('%s', $custom_css);
            }
        }

        //endregion Generate Custom Css

        //region Include library

        private function includes()
        {
            if (!class_exists('FAT_Cmb')) {
                include_once('library/fat-cmb/fat-cmb.php');
            }
            if (is_admin()) {
                include_once('utils/be-ajax.php');
            }
            include_once('utils/base.php');
            include_once('utils/fe-ajax.php');
            include_once('utils/resize.php');
            include_once('utils/functions.php');
        }

        //endregion Include library

        //region Another function

        public static function get_settings()
        {
            $fat_settings = array();
            if (function_exists('fat_portfolio_get_setting_default')) {
                $fat_settings = fat_portfolio_get_setting_default();
            }
            $settings = get_option(FAT_PORTFOLIO_POST_TYPE . '-settings', $fat_settings);
            if (isset($settings) && is_array($settings)) {
                $fat_settings = array_merge($fat_settings, $settings);
            }
            return $fat_settings;
        }

        public function flush_rewrite()
        {
            $need_flush = get_option(FAT_PORTFOLIO_FLUSH_REWRITE_KEY, 0);
            if ($need_flush == 1) {
                flush_rewrite_rules(false);
                update_option(FAT_PORTFOLIO_FLUSH_REWRITE_KEY, 0);
            }
        }

        //endregion Another function
    }

    new FAT_Portfolio();
}