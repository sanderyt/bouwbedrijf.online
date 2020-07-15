<?php

/**
 * Created by PhpStorm.
 * User: Roninwp
 * Date: 10/15/2016
 * Time: 10:03 PM
 */
require_once(ABSPATH . 'wp-admin/includes/file.php');

class fat_cmb_google_font
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

    function enqueue_script()
    {
        WP_Filesystem();
        global $wp_filesystem, $fat_cmb_google_font_file, $fat_cmb_font_opt_out;

        wp_enqueue_style('selectize-default', FAT_CMB_ASSET_JS_URL . 'selectize/css/selectize.default.css', array(), '0.12.4');
        wp_enqueue_script('selectize', FAT_CMB_ASSET_JS_URL . 'selectize/js/selectize.min.js', array('jquery', 'jquery-ui-sortable'), '0.12.4', true);

        if(!isset($fat_cmb_google_font_file)){
            $font_file_path = FAT_CMB_DIR_PATH . 'assets/fonts/google-font.json';
            $fat_cmb_google_font_file = file_exists($font_file_path) ? $wp_filesystem->get_contents($font_file_path) : ''; //file_get_contents($font_file_path) : '';
            if ($fat_cmb_google_font_file != '') {
                $fat_cmb_google_font_file = json_decode($fat_cmb_google_font_file);
                wp_register_script('fat-cmb-google-font', FAT_CMB_ASSET_JS_URL . 'google-font.js', array(), '1.0', true);
                wp_localize_script('fat-cmb-google-font', 'google_fonts', $fat_cmb_google_font_file->items);
                wp_enqueue_script('fat-cmb-google-font');
            }
        }

    }

    public function render()
    {
        WP_Filesystem();
        global $wp_filesystem;
        global $fat_cmb_post_meta;

        $post_meta = isset($fat_cmb_post_meta[$this->metabox_id][0]) ? unserialize($fat_cmb_post_meta[$this->metabox_id][0]) : '';
        if (isset($this->repeat_id)) {
            $font_value = isset($this->repeat_value) ? $this->repeat_value : $this->std;
        } else {
            $font_value = isset($post_meta[$this->id]) ? $post_meta[$this->id] : $this->std;
        }
        $font_family_value = isset($font_value['font_family']) ? $font_value['font_family'] : '';
        $font_weight_value = isset($font_value['font_weight']) ? $font_value['font_weight'] : '';
        $font_size_value = isset($font_value['font_size']) ? $font_value['font_size'] : '';
        $font_subset_value = isset($font_value['font_subset']) ? $font_value['font_subset'] : '';
        $font_file_value = isset($font_value['font_file']) ? $font_value['font_file'] : '';
        $letter_spacing_value = isset($font_value['letter_spacing']) ? $font_value['letter_spacing'] : '';
        $line_height_value = isset($font_value['line_height']) ? $font_value['line_height'] : '';

        $data_depend_field = isset($this->depend_field['field']) ? sprintf(' data-depend-field="%s" ', $this->depend_field['field']) : '';
        $data_depend_field .= isset($this->depend_field['value']) ? sprintf(' data-depend-value="%s" ', $this->depend_field['value']) : '';
        $data_depend_field .= isset($this->depend_field['compare']) ? sprintf(' data-depend-compare="%s" ', $this->depend_field['compare']) : '';


        $field_id = isset($this->repeat_id) ? sprintf('%s_%s', $this->repeat_id, $this->id) : ($this->id . '_family');
        $field_name = isset($this->repeat_id) ? sprintf('%s_%s[%s]', $this->repeat_id, $this->id, $this->repeat_index) : $this->id;

        $family_field_id = isset($this->repeat_id) ? sprintf('%s_%s_font_family', $this->repeat_id, $this->id) : ($this->id . '_font_family');
        $family_field_name = isset($this->repeat_id) ? sprintf('%s_%s[%s][font_family]', $this->repeat_id, $this->id, $this->repeat_index) : ($this->id . '[font_family]');

        $font_file_field_id = isset($this->repeat_id) ? sprintf('%s_%s_font_file', $this->repeat_id, $this->id) : ($this->id . '_font_file');
        $font_file_field_name = isset($this->repeat_id) ? sprintf('%s_%s[%s][font_file]', $this->repeat_id, $this->id, $this->repeat_index) : ($this->id . '[font_file]');

        $font_weight_field_id = isset($this->repeat_id) ? sprintf('%s_%s_font_weight', $this->repeat_id, $this->id) : ($this->id . '_font_weight');
        $font_weight_field_name = isset($this->repeat_id) ? sprintf('%s_%s[%s][font_weight]', $this->repeat_id, $this->id, $this->repeat_index) : ($this->id . '[font_weight]');

        $subset_field_id = isset($this->repeat_id) ? sprintf('%s_%s_font_subset', $this->repeat_id, $this->id) : ($this->id . '_font_subset');
        $subset_field_name = isset($this->repeat_id) ? sprintf('%s_%s[%s][font_subset]', $this->repeat_id, $this->id, $this->repeat_index) : ($this->id . '[font_subset]');

        $font_size_field_id = isset($this->repeat_id) ? sprintf('%s_%s_font_size', $this->repeat_id, $this->id) : ($this->id . '_font_size');
        $font_size_field_name = isset($this->repeat_id) ? sprintf('%s_%s[%s][font_size]', $this->repeat_id, $this->id, $this->repeat_index) : ($this->id . '[font_size]');

        $letter_spacing_field_id = isset($this->repeat_id) ? sprintf('%s_%s_letter_spacing', $this->repeat_id, $this->id) : ($this->id . '_letter_spacing');
        $letter_spacing_field_name = isset($this->repeat_id) ? sprintf('%s_%s[%s][letter_spacing]', $this->repeat_id, $this->id, $this->repeat_index) : ($this->id . '[letter_spacing]');

        $line_height_field_id = isset($this->repeat_id) ? sprintf('%s_%s_line_height', $this->repeat_id, $this->id) : ($this->id . '_line_height');
        $line_height_field_name = isset($this->repeat_id) ? sprintf('%s_%s[%s][line_height]', $this->repeat_id, $this->id, $this->repeat_index) : ($this->id . '[line_height]');

        global $fat_cmb_google_font_file, $fat_cmb_font_opt_out;
        if(!isset($fat_cmb_google_font_file)){
            $font_file_path = FAT_CMB_DIR_PATH . 'assets/fonts/google-font.json';
            $fat_cmb_google_font_file = file_exists($font_file_path) ? $wp_filesystem->get_contents($font_file_path) : ''; // file_get_contents($font_file_path) : '';
            if ($fat_cmb_google_font_file == '') {
                echo '<div>Cannot find font file</div>';
                return;
            }
            $fat_cmb_google_font_file = json_decode($fat_cmb_google_font_file);
            if (!isset($fat_cmb_google_font_file->items)) {
                echo '<div>Font file is invalid</div>';
                return;
            }
        }
        if(!isset($fat_cmb_font_opt_out) || $fat_cmb_font_opt_out === ''){
            $total_font = count($fat_cmb_google_font_file->items);
            $fat_cmb_font_opt_out = '';
            for ($i=0; $i < $total_font; $i++) {
                $fat_cmb_font_opt_out.= '<option value="'. $fat_cmb_google_font_file->items[$i]->family.'">'.$fat_cmb_google_font_file->items[$i]->family.'</option>';
            }
        }
        ?>
        <div
            class="<?php echo esc_attr($this->col_width) ?> <?php echo esc_attr($this->css_class) ?> fat-cmb-google-font-wrap" <?php echo sprintf('%s', $data_depend_field); ?> >
            <label for="<?php echo esc_attr($this->id) ?>"><?php echo esc_attr($this->label) ?></label>
            <div class="fat-cmb-field">
                <div class="fat-cmb-google-font-group">
                    <div class="fat-cmb-google-font-section">
                        <label><?php esc_html_e('Font family', 'fat-cmb'); ?> </label>
                        <select data-selected="<?php echo esc_attr($font_family_value); ?>"
                                class="fat-cmb-google-font fat-cmb-font-family  manual"
                                name="<?php echo esc_attr($family_field_name) ?>"
                                id="<?php echo esc_attr($family_field_id) ?>"
                                data-field-id="<?php echo esc_attr($this->id) ?>"
                        >
                            <option value="none"><?php esc_html_e('Inherit', 'fat-cmb'); ?></option>
                            <?php echo sprintf('%s',$fat_cmb_font_opt_out); ?>
                        </select>
                    </div>

                    <div class="fat-cmb-google-font-section">
                        <label><?php esc_html_e('Subset', 'fat-cmb'); ?> </label>
                        <select data-selected="<?php echo esc_attr($font_subset_value); ?>"
                                class="fat-cmb-google-font fat-cmb-font-subset manual"
                                name="<?php echo esc_attr($subset_field_name) ?>"
                                id="<?php echo esc_attr($subset_field_id) ?>">
                        </select>
                    </div>

                    <div class="fat-cmb-google-font-section">
                        <label><?php esc_html_e('Font weight', 'fat-cmb'); ?> </label>
                        <select data-selected="<?php echo esc_attr($font_weight_value); ?>"
                                class="fat-cmb-google-font fat-cmb-font-weight manual"
                                name="<?php echo esc_attr($font_weight_field_name) ?>"
                                id="<?php echo esc_attr($font_weight_field_id) ?>">
                        </select>
                    </div>

                    <div class="fat-cmb-google-font-section">
                        <label><?php esc_html_e('Font size', 'fat-cmb'); ?> </label>
                        <input type="number" name="<?php echo esc_attr($font_size_field_name); ?>"
                               class="fat-cmb-font-size" id="<?php echo esc_attr($font_size_field_id); ?>"
                               value="<?php echo esc_attr($font_size_value); ?>" />
                    </div>

                    <div class="fat-cmb-google-font-section">
                        <label><?php esc_html_e('Letter spacing (em)', 'fat-cmb'); ?> </label>
                        <input type="number" min="0" step="0.1"
                               name="<?php echo esc_attr($letter_spacing_field_name); ?>" class="fat-cmb-letter-spacing"
                               id="<?php echo esc_attr($letter_spacing_field_id); ?>"
                               value="<?php echo esc_attr($letter_spacing_value); ?>" />
                    </div>

                    <div class="fat-cmb-google-font-section">
                        <label><?php esc_html_e('Line height (em)', 'fat-cmb'); ?> </label>
                        <input type="number" min="0" step="0.5" name="<?php echo esc_attr($line_height_field_name); ?>"
                               class="fat-cmb-line-height" id="<?php echo esc_attr($line_height_field_id); ?>"
                               value="<?php echo esc_attr($line_height_value); ?>" />
                    </div>

                    <div class="fat-cmb-google-font-section hidden">
                        <ul class="fat-cmb-google-font-file">
                        </ul>
                        <input type="text" class="fat-cmb-google-font-file"
                               name="<?php echo esc_attr($font_file_field_name); ?>"
                               id="<?php echo esc_attr($font_file_field_id); ?>"
                               value= <?php echo esc_attr($font_file_value); ?>
                        />
                    </div>

                </div>
                <?php if (isset($this->description) && $this->description != ''): ?>
                    <span class="fat-cmb-description"><?php echo esc_html($this->description); ?> </span>
                <?php endif; ?>

                <div class="fat-cmb-font-preview">
                    <div>
                        abcdefghjklmnopiuytrwqzxv. ABCDEFGHJKLMNOPIUYTRWQZXV. 1234567890
                    </div>
                </div>
            </div>

        </div>
    <?php }
}