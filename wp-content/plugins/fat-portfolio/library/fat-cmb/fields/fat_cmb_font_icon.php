<?php

/**
 * Created by PhpStorm.
 * User: Roninwp
 * Date: 10/15/2016
 * Time: 10:03 PM
 */
require_once(ABSPATH . 'wp-admin/includes/file.php');

class fat_cmb_font_icon
{

    public $repeat_id;
    public $repeat_value;
    public $repeat_index;
    public $metabox_id;
    public $id;
    public $label;
    public $std = '';
    public $col_width = 'fat-cmb-col-6';
    public $description = '';
    public $depend_field = null;
    public $css_class = '';

    public function __construct()
    {
        $this->enqueue_script();
    }

    private function enqueue_script()
    {
        WP_Filesystem();
        global $wp_filesystem;

        wp_enqueue_style('fat-cmb-fontawesome',FAT_CMB_ASSET_CSS_URL.'/font-awesome/css/font-awesome.min.css', array(), '4.7.0');

        $font_file_path = FAT_CMB_DIR_PATH . 'assets/fonts/fa-icons.json';
        $font_file = file_exists($font_file_path) ?  $wp_filesystem->get_contents($font_file_path) : '' ; //file_get_contents($font_file_path) : '';
        if ($font_file != '') {
            $font_file = json_decode($font_file, true);
            $extra_font_file = apply_filters('fat-font-icon',array());
            if(isset($extra_font_file) && is_array($extra_font_file)){
                $font_file = array_merge($font_file,$extra_font_file);
            }
            wp_register_script('fat-cmb-font-icon', FAT_CMB_ASSET_JS_URL . 'font-icon.js', array(), '1.0', true);
            wp_localize_script('fat-cmb-font-icon', 'fat_cmb_fontIcons',array($font_file));
            wp_enqueue_script('fat-cmb-font-icon');
        }
    }

    public function render()
    {
        global $fat_cmb_post_meta;
        $post_meta = isset($fat_cmb_post_meta[$this->metabox_id][0]) ? unserialize($fat_cmb_post_meta[$this->metabox_id][0]) : '';
        if (isset($this->repeat_id)) {
            $font_icon = isset($this->repeat_value) ? $this->repeat_value : $this->std;
        } else {
            $font_icon = isset($post_meta[$this->id]) ? $post_meta[$this->id] : $this->std;
        }

        $data_depend_field = isset($this->depend_field['field']) ? sprintf(' data-depend-field="%s" ',$this->depend_field['field']) : '';
        $data_depend_field .= isset($this->depend_field['value']) ? sprintf(' data-depend-value="%s" ', $this->depend_field['value']) : '';
        $data_depend_field .= isset($this->depend_field['compare']) ? sprintf(' data-depend-compare="%s" ', $this->depend_field['compare']) : '';

        $field_id = isset($this->repeat_id) ? sprintf('%s_%s', $this->repeat_id, $this->id) : $this->id;
        $field_name = isset($this->repeat_id) ? sprintf('%s_%s[]', $this->repeat_id, $this->id) : $this->id;
        ?>
        <div
            class="<?php echo esc_attr($this->col_width) ?> <?php echo esc_attr($this->css_class) ?> fat-cmb-font-icon-wrap" <?php echo sprintf('%s', $data_depend_field); ?> >
            <label for="<?php echo esc_attr($this->id) ?>"><?php echo esc_attr($this->label) ?></label>
            <div class="fat-cmb-field">
                <div>
                    <a href="javascript:" class="fat-cmb-choice-font-icon">
                        <i class="<?php echo esc_attr($font_icon); ?>"></i>
                        <span> <?php esc_html_e('Choice icon','fat-cmb'); ?> </span>
                    </a>
                    <a href="javascript:" class="fat-cmb-clear-font-icon <?php if(!isset($font_icon) || $font_icon ==''){echo 'fat-cmb-hide'; } ?>">
                        <?php esc_html_e('Clear icon','fat-cmb'); ?>
                    </a>
                </div>
                <input type="text" name="<?php echo esc_attr($field_name) ?>" class="fat-cmb-font-icon"
                       value="<?php echo esc_attr($font_icon); ?>"
                       id="<?php echo esc_attr($field_id) ?>"
                       data-field-id="<?php echo esc_attr($this->id) ?>"
                       data-std="<?php echo esc_attr($this->std); ?>"
                />
                <?php if (isset($this->description) && $this->description != ''): ?>
                    <span class="fat-cmb-description"><?php echo esc_html($this->description); ?> </span>
                <?php endif; ?>
            </div>
        </div>
    <?php }
}
