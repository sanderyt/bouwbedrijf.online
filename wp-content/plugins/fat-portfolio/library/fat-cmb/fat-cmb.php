<?php
/*
Plugin Name: FAT Custom MetaBox
Plugin URI:   http://roninwp.com/plugins/
Description: FAT CMB is a custom metabox for wordpress
Version:     1.0
Author:      Roninwp
Author URI:  http://roninwp.com/plugins/
Domain Path: /languages
Text Domain: fat-cmb
*/

if (!defined('ABSPATH')) die('-1');

defined('FAT_CMB_DIR_PATH') or define('FAT_CMB_DIR_PATH', plugin_dir_path(__FILE__));

defined('FAT_CMB_URL') or define('FAT_CMB_URL', plugins_url() . '/fat-portfolio/library/fat-cmb/');

defined('FAT_CMB_ASSET_JS_URL') or define('FAT_CMB_ASSET_JS_URL', trailingslashit(FAT_CMB_URL . 'assets/js'));

defined('FAT_CMB_ASSET_CSS_URL') or define('FAT_CMB_ASSET_CSS_URL', trailingslashit(FAT_CMB_URL . 'assets/css'));

if (!class_exists('FAT_Cmb')) {

    class FAT_Cmb
    {
        protected $page_options;

        /**
         * Metabox Defaults
         * @var   array
         * @since 1.0.1
         */
        //public $meta_boxes = array();

        function __construct()
        {
            add_action('add_meta_boxes', array($this, 'callback_add_metabox'));
            add_action('save_post', array($this, 'fat_cmb_meta_box_save'), 100);
            spl_autoload_extensions(".php");
            spl_autoload_register(array($this, 'fat_cmb_autload_class'));
            if (is_admin()) {
                add_action('admin_menu', array($this, 'callback_option_pages'));
            }
        }

        function fat_cmb_autload_class($class_name)
        {
            $class_path = FAT_CMB_DIR_PATH . "fields/{$class_name}.php";
            if (strrpos($class_name, 'fat_cmb') == 0 && file_exists($class_path)) {
                include_once($class_path);
            }
        }

        function callback_add_metabox()
        {
            add_action('admin_enqueue_scripts', array($this, 'enqueue_style'), 0);

            $meta_boxes = apply_filters('fat_cmb_register_metabox', array());
            if (count($meta_boxes) > 0) {
                foreach ($meta_boxes as $meta_box) {
                    if (isset($meta_box['id']) && isset($meta_box['pages'])) {
                        $meta_box['context'] = isset($meta_box['context']) ? $meta_box['context'] : 'advanced';
                        $meta_box['priority'] = isset($meta_box['priority']) ? $meta_box['priority'] : 'default';
                        add_meta_box(
                            $meta_box['id'],
                            $meta_box['title'],
                            array($this, 'fat_cmb_meta_box_callback'),
                            $meta_box['pages'],
                            $meta_box['context'],
                            $meta_box['priority'],
                            array($meta_box['id'], $meta_box['fields'])
                        );
                    }
                }
            }
        }

        function callback_option_pages()
        {
            add_filter('admin_body_class', array($this, 'fat_cmb_add_body_class'));
            add_action('admin_enqueue_scripts', array($this, 'option_page_enqueue'), 0);

            $options = apply_filters('fat_cmb_register_option_page', array());
            foreach ($options as $option) {
                if (isset($option['menu_type']) && isset($option['menu_slug']) && $option['menu_slug'] != '') {
                    $page_title = isset($option['page_title']) ? $option['page_title'] : '';
                    $menu_title = isset($option['menu_title']) ? $option['menu_title'] : '';
                    $capability = isset($option['capability']) ? $option['capability'] : '';
                    $menu_slug = isset($option['menu_slug']) ? $option['menu_slug'] : '';
                    $icon_url = isset($option['icon_url']) ? $option['icon_url'] : '';
                    $position = isset($option['position']) ? $option['position'] : null;
                    $page_id = isset($option['page_id']) ? $option['page_id'] : '';
                    $parent_slug = isset($option['parent_slug']) ? $option['parent_slug'] : '';
                    $fields = isset($option['fields']) ? $option['fields'] : array();

                    if ($option['menu_type'] === 'menu') {
                        $add_page = sprintf('%s_%s_page','add','menu');
                        $this->page_options[$option['menu_slug']] = $option;
                        $add_page($page_title, $menu_title, $capability, $menu_slug, array($this, 'initPageOptions'), $icon_url, $position);
                    }
                    if ($option['menu_type'] === 'sub-menu') {
                        $add_page = sprintf('%s_%s_page','add','submenu');
                        $this->page_options[$option['menu_slug']] = $option;
                        $add_page($parent_slug, $page_title, $menu_title, $capability, $menu_slug, array($this, 'initPageOptions'));
                    }
                }
            }
        }

        function fat_cmb_add_body_class($classes)
        {
            return $classes . ' fat-cmb-page-options';
        }

        function initPageOptions()
        {
            $template = FAT_CMB_DIR_PATH . 'templates/option-page.php';
            if (file_exists($template)) {
                include $template;
            } else {
                echo '<div>Cannot find option page template</div>';
            }
        }

        function fat_cmb_meta_box_callback($post, $callback_args)
        {
            if (count($callback_args['args']) <= 0) {
                return;
            }

            wp_enqueue_script('fat-cmb-utils', FAT_CMB_ASSET_JS_URL . 'fat-cmb-utils.js', array(), '1.0.0', true);
            wp_enqueue_script('fat-cmb', FAT_CMB_ASSET_JS_URL . 'fat-cmb.js', array('fat-cmb-utils'), '1.0.0', true);

            // We'll use this nonce field later on when saving.
            wp_nonce_field('my_meta_box_nonce', 'meta_box_nonce');
            $fat_field_type = null;
            $meta_box_id = $callback_args['args'][0];
            $fields = $callback_args['args'][1];

            global $post, $fat_cmb_post_meta, $fat_cmb_post_id, $fat_cmb_post_type;
            $fat_cmb_post_id = $post->ID;
            $fat_cmb_post_type = get_post_type($fat_cmb_post_id);
            $fat_cmb_post_meta = get_post_custom($fat_cmb_post_id);

            ?>
            <div class="fat-cmb-container fat-cmb-fields">
                <div class="fat-cmb-row">
                    <?php
                    foreach ($fields as $field) {
                        if (!isset($field['id'])) {
                            break;
                        }
                        switch ($field['type']) {
                            case 'text':
                                $fat_field_type = new fat_cmb_text();
                                $fat_field_type->metabox_id = $meta_box_id;
                                $fat_field_type->id = $field['id'];
                                $fat_field_type->css_class = isset($field['css_class']) ? $field['css_class'] : '';
                                $fat_field_type->label = isset($field['label']) ? $field['label'] : $fat_field_type->label;
                                $fat_field_type->std = isset($field['std']) ? $field['std'] : $fat_field_type->std;
                                $fat_field_type->description = isset($field['description']) ? $field['description'] : $fat_field_type->description;
                                $fat_field_type->col_width = isset($field['col_width']) ? $field['col_width'] : $fat_field_type->col_width;
                                $fat_field_type->depend_field = isset($field['depend_field']) ? $field['depend_field'] : $fat_field_type->depend_field;
                                $fat_field_type->render();
                                break;
                            case 'textarea':
                                $fat_field_type = new fat_cmb_textarea();
                                $fat_field_type->metabox_id = $meta_box_id;
                                $fat_field_type->id = $field['id'];
                                $fat_field_type->css_class = isset($field['css_class']) ? $field['css_class'] : '';
                                $fat_field_type->label = isset($field['label']) ? $field['label'] : $fat_field_type->label;
                                $fat_field_type->std = isset($field['std']) ? $field['std'] : $fat_field_type->std;
                                $fat_field_type->description = isset($field['description']) ? $field['description'] : $fat_field_type->description;
                                $fat_field_type->col_width = isset($field['col_width']) ? $field['col_width'] : $fat_field_type->col_width;
                                $fat_field_type->depend_field = isset($field['depend_field']) ? $field['depend_field'] : $fat_field_type->depend_field;
                                $fat_field_type->render();
                                break;
                            case 'font_icon':
                                $fat_field_type = new fat_cmb_font_icon();
                                $fat_field_type->metabox_id = $meta_box_id;
                                $fat_field_type->id = $field['id'];
                                $fat_field_type->css_class = isset($field['css_class']) ? $field['css_class'] : '';
                                $fat_field_type->label = isset($field['label']) ? $field['label'] : $fat_field_type->label;
                                $fat_field_type->std = isset($field['std']) ? $field['std'] : $fat_field_type->std;
                                $fat_field_type->description = isset($field['description']) ? $field['description'] : $fat_field_type->description;
                                $fat_field_type->col_width = isset($field['col_width']) ? $field['col_width'] : $fat_field_type->col_width;
                                $fat_field_type->depend_field = isset($field['depend_field']) ? $field['depend_field'] : $fat_field_type->depend_field;
                                $fat_field_type->render();
                                break;
                            case 'google_font':
                                $fat_field_type = new fat_cmb_google_font();
                                $fat_field_type->metabox_id = $meta_box_id;
                                $fat_field_type->id = $field['id'];
                                $fat_field_type->css_class = isset($field['css_class']) ? $field['css_class'] : '';
                                $fat_field_type->label = isset($field['label']) ? $field['label'] : $fat_field_type->label;
                                $fat_field_type->std = isset($field['std']) ? $field['std'] : $fat_field_type->std;
                                $fat_field_type->description = isset($field['description']) ? $field['description'] : $fat_field_type->description;
                                $fat_field_type->col_width = isset($field['col_width']) ? $field['col_width'] : $fat_field_type->col_width;
                                $fat_field_type->depend_field = isset($field['depend_field']) ? $field['depend_field'] : $fat_field_type->depend_field;
                                $fat_field_type->render();
                                break;
                            case 'number':
                                $fat_field_type = new fat_cmb_number();
                                $fat_field_type->metabox_id = $meta_box_id;
                                $fat_field_type->id = $field['id'];
                                $fat_field_type->css_class = isset($field['css_class']) ? $field['css_class'] : '';
                                $fat_field_type->label = isset($field['label']) ? $field['label'] : $fat_field_type->label;
                                $fat_field_type->std = isset($field['std']) ? $field['std'] : $fat_field_type->std;
                                $fat_field_type->min = isset($field['min']) ? $field['min'] : $fat_field_type->min;
                                $fat_field_type->max = isset($field['max']) ? $field['max'] : $fat_field_type->max;
                                $fat_field_type->step = isset($field['step']) ? $field['step'] : $fat_field_type->step;
                                $fat_field_type->description = isset($field['description']) ? $field['description'] : $fat_field_type->description;
                                $fat_field_type->col_width = isset($field['col_width']) ? $field['col_width'] : $fat_field_type->col_width;
                                $fat_field_type->depend_field = isset($field['depend_field']) ? $field['depend_field'] : $fat_field_type->depend_field;
                                $fat_field_type->render();
                                break;
                            case 'select':
                                $fat_field_type = new fat_cmb_select();
                                $fat_field_type->metabox_id = $meta_box_id;
                                $fat_field_type->id = $field['id'];
                                $fat_field_type->css_class = isset($field['css_class']) ? $field['css_class'] : '';
                                $fat_field_type->label = isset($field['label']) ? $field['label'] : $fat_field_type->label;
                                $fat_field_type->description = isset($field['description']) ? $field['description'] : $fat_field_type->description;
                                $fat_field_type->std = isset($field['std']) ? $field['std'] : $fat_field_type->std;
                                $fat_field_type->options = isset($field['options']) ? $field['options'] : '';
                                $fat_field_type->multiple = isset($field['multiple']) ? $field['multiple'] : false;
                                $fat_field_type->data_source = isset($field['data_source']) ? $field['data_source'] : '';
                                $fat_field_type->col_width = isset($field['col_width']) ? $field['col_width'] : $fat_field_type->col_width;
                                $fat_field_type->depend_field = isset($field['depend_field']) ? $field['depend_field'] : $fat_field_type->depend_field;
                                $fat_field_type->render();
                                break;
                            case 'radio':
                                $fat_field_type = new fat_cmb_radio();
                                $fat_field_type->metabox_id = $meta_box_id;
                                $fat_field_type->id = $field['id'];
                                $fat_field_type->css_class = isset($field['css_class']) ? $field['css_class'] : '';
                                $fat_field_type->label = isset($field['label']) ? $field['label'] : $fat_field_type->label;
                                $fat_field_type->description = isset($field['description']) ? $field['description'] : $fat_field_type->description;
                                $fat_field_type->std = isset($field['std']) ? $field['std'] : $fat_field_type->std;
                                $fat_field_type->options = isset($field['options']) ? $field['options'] : '';
                                $fat_field_type->col_width = isset($field['col_width']) ? $field['col_width'] : $fat_field_type->col_width;
                                $fat_field_type->depend_field = isset($field['depend_field']) ? $field['depend_field'] : $fat_field_type->depend_field;
                                $fat_field_type->render();
                                break;
                            case 'check':
                                $fat_field_type = new fat_cmb_check();
                                $fat_field_type->metabox_id = $meta_box_id;
                                $fat_field_type->id = $field['id'];
                                $fat_field_type->css_class = isset($field['css_class']) ? $field['css_class'] : '';
                                $fat_field_type->label = isset($field['label']) ? $field['label'] : $fat_field_type->label;
                                $fat_field_type->description = isset($field['description']) ? $field['description'] : $fat_field_type->description;
                                $fat_field_type->std = isset($field['std']) ? $field['std'] : $fat_field_type->std;
                                $fat_field_type->options = isset($field['options']) ? $field['options'] : '';
                                $fat_field_type->col_width = isset($field['col_width']) ? $field['col_width'] : $fat_field_type->col_width;
                                $fat_field_type->depend_field = isset($field['depend_field']) ? $field['depend_field'] : $fat_field_type->depend_field;
                                $fat_field_type->render();
                                break;
                            case 'images':
                                $fat_field_type = new fat_cmb_images();
                                $fat_field_type->metabox_id = $meta_box_id;
                                $fat_field_type->id = $field['id'];
                                $fat_field_type->css_class = isset($field['css_class']) ? $field['css_class'] : '';
                                $fat_field_type->label = isset($field['label']) ? $field['label'] : $fat_field_type->label;
                                $fat_field_type->description = isset($field['description']) ? $field['description'] : $fat_field_type->description;
                                $fat_field_type->col_width = isset($field['col_width']) ? $field['col_width'] : $fat_field_type->col_width;
                                $fat_field_type->depend_field = isset($field['depend_field']) ? $field['depend_field'] : $fat_field_type->depend_field;
                                $fat_field_type->render();
                                break;
                            case 'single_image':
                                $fat_field_type = new fat_cmb_single_image();
                                $fat_field_type->metabox_id = $meta_box_id;
                                $fat_field_type->id = $field['id'];
                                $fat_field_type->css_class = isset($field['css_class']) ? $field['css_class'] : '';
                                $fat_field_type->label = isset($field['label']) ? $field['label'] : $fat_field_type->label;
                                $fat_field_type->description = isset($field['description']) ? $field['description'] : $fat_field_type->description;
                                $fat_field_type->col_width = isset($field['col_width']) ? $field['col_width'] : $fat_field_type->col_width;
                                $fat_field_type->depend_field = isset($field['depend_field']) ? $field['depend_field'] : $fat_field_type->depend_field;
                                $fat_field_type->render();
                                break;
                            case 'color':
                                $fat_field_type = new fat_cmb_color();
                                $fat_field_type->metabox_id = $meta_box_id;
                                $fat_field_type->id = $field['id'];
                                $fat_field_type->css_class = isset($field['css_class']) ? $field['css_class'] : '';
                                $fat_field_type->label = isset($field['label']) ? $field['label'] : $fat_field_type->label;
                                $fat_field_type->description = isset($field['description']) ? $field['description'] : $fat_field_type->description;
                                $fat_field_type->std = isset($field['std']) ? $field['std'] : $fat_field_type->std;
                                $fat_field_type->col_width = isset($field['col_width']) ? $field['col_width'] : $fat_field_type->col_width;
                                $fat_field_type->depend_field = isset($field['depend_field']) ? $field['depend_field'] : $fat_field_type->depend_field;
                                $fat_field_type->render();
                                break;
                            case 'range_slider':
                                $fat_field_type = new fat_cmb_range_slider();
                                $fat_field_type->metabox_id = $meta_box_id;
                                $fat_field_type->id = $field['id'];
                                $fat_field_type->css_class = isset($field['css_class']) ? $field['css_class'] : '';
                                $fat_field_type->label = isset($field['label']) ? $field['label'] : $fat_field_type->label;
                                $fat_field_type->description = isset($field['description']) ? $field['description'] : $fat_field_type->description;
                                $fat_field_type->std = isset($field['std']) ? $field['std'] : $fat_field_type->std;
                                $fat_field_type->min = isset($field['min']) ? $field['min'] : $fat_field_type->min;
                                $fat_field_type->max = isset($field['max']) ? $field['max'] : $fat_field_type->max;
                                $fat_field_type->step = isset($field['step']) ? $field['step'] : $fat_field_type->step;
                                $fat_field_type->col_width = isset($field['col_width']) ? $field['col_width'] : $fat_field_type->col_width;
                                $fat_field_type->depend_field = isset($field['depend_field']) ? $field['depend_field'] : $fat_field_type->depend_field;
                                $fat_field_type->render();
                                break;
                            case 'ace':
                                $fat_field_type = new fat_cmb_ace();
                                $fat_field_type->metabox_id = $meta_box_id;
                                $fat_field_type->id = $field['id'];
                                $fat_field_type->css_class = isset($field['css_class']) ? $field['css_class'] : '';
                                $fat_field_type->label = isset($field['label']) ? $field['label'] : $fat_field_type->label;
                                $fat_field_type->mode = isset($field['mode']) ? $field['mode'] : 'css';
                                $fat_field_type->std = isset($field['std']) ? $field['std'] : '';
                                $fat_field_type->description = isset($field['description']) ? $field['description'] : $fat_field_type->description;
                                $fat_field_type->col_width = isset($field['col_width']) ? $field['col_width'] : $fat_field_type->col_width;
                                $fat_field_type->depend_field = isset($field['depend_field']) ? $field['depend_field'] : $fat_field_type->depend_field;
                                $fat_field_type->render();
                                break;
                            case 'repeat':
                                $fat_field_type = new fat_cmb_repeat();
                                $fat_field_type->metabox_id = $meta_box_id;
                                $fat_field_type->id = $field['id'];
                                $fat_field_type->css_class = isset($field['css_class']) ? $field['css_class'] : '';
                                $fat_field_type->label = isset($field['label']) ? $field['label'] : $fat_field_type->label;
                                $fat_field_type->fields = isset($field['fields']) ? $field['fields'] : $fat_field_type->fields;
                                $fat_field_type->description = isset($field['description']) ? $field['description'] : $fat_field_type->description;
                                $fat_field_type->col_width = isset($field['col_width']) ? $field['col_width'] : $fat_field_type->col_width;
                                $fat_field_type->depend_field = isset($field['depend_field']) ? $field['depend_field'] : $fat_field_type->depend_field;
                                $fat_field_type->render();
                                break;

                            case 'datetime':
                                $fat_field_type = new fat_cmb_datetime();
                                $fat_field_type->metabox_id = $meta_box_id;
                                $fat_field_type->id = $field['id'];
                                $fat_field_type->css_class = isset($field['css_class']) ? $field['css_class'] : '';
                                $fat_field_type->label = isset($field['label']) ? $field['label'] : $fat_field_type->label;
                                $fat_field_type->std = isset($field['std']) ? $field['std'] : $fat_field_type->std;
                                $fat_field_type->date_picker = isset($field['date_picker']) ? $field['date_picker'] : $fat_field_type->date_picker;
                                $fat_field_type->time_picker = isset($field['time_picker']) ? $field['time_picker'] : $fat_field_type->time_picker;
                                $fat_field_type->description = isset($field['description']) ? $field['description'] : $fat_field_type->description;
                                $fat_field_type->col_width = isset($field['col_width']) ? $field['col_width'] : $fat_field_type->col_width;
                                $fat_field_type->depend_field = isset($field['depend_field']) ? $field['depend_field'] : $fat_field_type->depend_field;
                                $fat_field_type->render();
                                break;
                            case 'instagram':
                                $fat_field_type = new fat_cmb_instagram();
                                $fat_field_type->metabox_id = $meta_box_id;
                                $fat_field_type->id = $field['id'];
                                $fat_field_type->css_class = isset($field['css_class']) ? $field['css_class'] : '';
                                $fat_field_type->label = isset($field['label']) ? $field['label'] : $fat_field_type->label;
                                $fat_field_type->description = isset($field['description']) ? $field['description'] : $fat_field_type->description;
                                $fat_field_type->col_width = isset($field['col_width']) ? $field['col_width'] : $fat_field_type->col_width;
                                $fat_field_type->depend_field = isset($field['depend_field']) ? $field['depend_field'] : $fat_field_type->depend_field;
                                $fat_field_type->render();
                                break;
                            case 'flickr':
                                $fat_field_type = new fat_cmb_flickr();
                                $fat_field_type->metabox_id = $meta_box_id;
                                $fat_field_type->id = $field['id'];
                                $fat_field_type->label = isset($field['label']) ? $field['label'] : $fat_field_type->label;
                                $fat_field_type->description = isset($field['description']) ? $field['description'] : $fat_field_type->description;
                                $fat_field_type->col_width = isset($field['col_width']) ? $field['col_width'] : $fat_field_type->col_width;
                                $fat_field_type->depend_field = isset($field['depend_field']) ? $field['depend_field'] : $fat_field_type->depend_field;
                                $fat_field_type->render();
                                break;
                            case 'section':
                                $fat_field_type = new fat_cmb_section();
                                $fat_field_type->id = $field['id'];
                                $fat_field_type->css_class = isset($field['css_class']) ? $field['css_class'] : '';
                                $fat_field_type->label = isset($field['label']) ? $field['label'] : $fat_field_type->label;
                                $fat_field_type->description = isset($field['description']) ? $field['description'] : $fat_field_type->description;
                                $fat_field_type->depend_field = isset($field['depend_field']) ? $field['depend_field'] : $fat_field_type->depend_field;
                                $fat_field_type->render();
                                break;
                            case 'file':
                                $fat_field_type = new fat_cmb_file();
                                $fat_field_type->metabox_id = $meta_box_id;
                                $fat_field_type->id = $field['id'];
                                $fat_field_type->css_class = isset($field['css_class']) ? $field['css_class'] : '';
                                $fat_field_type->file_type = isset($field['file_type']) ? $field['file_type'] : 'image';
                                $fat_field_type->std = isset($field['std']) ? $field['std'] : array();
                                $fat_field_type->label = isset($field['label']) ? $field['label'] : $fat_field_type->label;
                                $fat_field_type->description = isset($field['description']) ? $field['description'] : $fat_field_type->description;
                                $fat_field_type->col_width = isset($field['col_width']) ? $field['col_width'] : $fat_field_type->col_width;
                                $fat_field_type->depend_field = isset($field['depend_field']) ? $field['depend_field'] : $fat_field_type->depend_field;
                                $fat_field_type->render();
                                break;
                        }
                    }
                    ?>
                </div>
            </div>
            <?php

        }

        function fat_cmb_meta_box_save($post_id)
        {
            // Bail if we're doing an auto save
            if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

            // if our nonce isn't there, or we can't verify it, bail
            if (!isset($_POST['meta_box_nonce']) || !wp_verify_nonce($_POST['meta_box_nonce'], 'my_meta_box_nonce')) return;

            // if our current user can't edit this post, bail
            if (!current_user_can('edit_posts')) return;

            // now we can actually save the data
            $allowed = array(
                'a' => array( // on allow a tags
                    'href' => array() // and those anchors can only have href attribute
                ),
                'iframe' => array(
                    'width' => array(),
                    'height' => array(),
                    'style' => array(),
                    'src' => array(),
                    'frameborder' => array(),
                    'longdesc' => array(),
                    'name' => array(),
                    'scrolling' => array(),
                    'align' => array(),
                    'allowfullscreen' => array()
                )
            );

            // Make sure your data is set before trying to save it
            $meta_boxes = apply_filters('fat_cmb_register_metabox', array());
            $repeat_field_id = $instagram_access_token = $instagram_user_id = $flickr_api_key = $flickr_user_id = '';
            $post_type = get_post_type($post_id);
            foreach ($meta_boxes as $meta_box) {
                $fat_cmb_section_value = $repeat_fields = array();
                if (isset($meta_box['pages']) && is_array($meta_box['pages']) && in_array($post_type, $meta_box['pages'])) {
                    foreach ($meta_box['fields'] as $field) {
                        switch ($field['type']) {
                            case 'repeat':
                                $repeat_fields = $field['fields'];
                                foreach ($repeat_fields as $repeat_field) {
                                    $repeat_field_id = $field['id'] . '_' . $repeat_field['id'];
                                    if (isset($_POST[$repeat_field_id])) {
                                        $fat_cmb_section_value[$field['id']][$repeat_field['id']] = $_POST[$repeat_field_id];
                                    }
                                }
                                break;
                            case 'instagram':
                                $instagram_access_token = isset($_POST[$field['id']]['access_token']) ? $_POST[$field['id']]['access_token'] : '';
                                $instagram_user_id = isset($_POST[$field['id']]['user_id']) ? $_POST[$field['id']]['user_id'] : '';
                                $fat_cmb_section_value[$field['id']] = $_POST[$field['id']];
                                break;
                            case 'flickr':
                                $flickr_api_key = isset($_POST[$field['id']]['api_key']) ? $_POST[$field['id']]['api_key'] : '';
                                $flickr_user_id = isset($_POST[$field['id']]['user_id']) ? $_POST[$field['id']]['user_id'] : '';
                                $fat_cmb_section_value[$field['id']] = $_POST[$field['id']];
                                break;
                            default:
                                $field_value = isset($_POST[$field['id']]) ? $_POST[$field['id']] : '';
                                if ($field['type'] !== 'check' && $field['type'] !== 'ace' && $field['type'] !== 'select' && $field['type'] !== 'radio' ) {
                                    $fat_cmb_section_value[$field['id']] = wp_kses($field_value, $allowed);
                                } else {
                                    $fat_cmb_section_value[$field['id']] = $field_value;
                                }
                                break;
                        }
                    }
                    if ($instagram_access_token) {
                        $option_key = sprintf('%s_%s_instagram', $post_type, $meta_box['id']);
                        update_option($option_key, array(
                            'access_token' => $instagram_access_token,
                            'user_id'      => $instagram_user_id
                        ));
                    }
                    if ($flickr_api_key) {
                        $option_key = sprintf('%s_%s_flickr', $post_type, $meta_box['id']);
                        update_option($option_key, array(
                            'api_key' => $flickr_api_key,
                            'user_id' => $flickr_user_id
                        ));
                    }
                    update_post_meta($post_id, $meta_box['id'], $fat_cmb_section_value);
                }
            }
        }

        function enqueue_style()
        {
            wp_enqueue_style('fat-cmb-style', FAT_CMB_ASSET_CSS_URL . 'fat-cmb.css', array(), true);
        }

        function option_page_enqueue()
        {
             wp_enqueue_style('font-awesome', FAT_CMB_ASSET_CSS_URL.'/font-awesome/css/font-awesome.min.css', array(), '4.7.0');
            wp_enqueue_style('fat-cmb-option-page', FAT_CMB_ASSET_CSS_URL . 'option-page.css', array(), true);
            wp_enqueue_style('fat-cmb-style', FAT_CMB_ASSET_CSS_URL . 'fat-cmb.css', array(), true);

            wp_enqueue_script('fat-cmb', FAT_CMB_ASSET_JS_URL . 'fat-cmb.js', array('jquery'), '1.0.0', true);
            wp_enqueue_script('fat-cmb-option-page', FAT_CMB_ASSET_JS_URL . 'option-page.js', array('jquery'), '1.0.0', true);
        }
    }

    if (!function_exists('fat_cmb_load')) {
        function fat_cmb_load()
        {
            new FAT_Cmb();
        }

        add_action('wp_loaded', 'fat_cmb_load');
    }
}