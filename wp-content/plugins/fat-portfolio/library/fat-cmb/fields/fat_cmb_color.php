<?php

/**
 * Created by PhpStorm.
 * User: roninwp
 * Date: 3/1/2017
 * Time: 2:09 PM
 */
class fat_cmb_color
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
        wp_enqueue_style('wp-color-picker');
        wp_enqueue_script('wp-color-picker');
        wp_enqueue_script('wp-color-picker-alpha', FAT_CMB_ASSET_JS_URL . 'color-picker/wp-color-picker-alpha.js', array('wp-color-picker'), '1.0', true);
        wp_enqueue_script('fat-cmb-color', FAT_CMB_ASSET_JS_URL . 'color.js', array(), '1.0.0', true);
    }


    public function render()
    {
        global $fat_cmb_post_meta;
        $post_meta = isset($fat_cmb_post_meta[$this->metabox_id][0]) ? unserialize($fat_cmb_post_meta[$this->metabox_id][0]) : '';
        if(isset($this->repeat_id)){
            $color = isset($this->repeat_value) ? $this->repeat_value : $this->std;
        }else{
            $color = isset($post_meta[$this->id]) ? $post_meta[$this->id] : $this->std;
        }

        $data_depend_field = isset($this->depend_field['field']) ? sprintf(' data-depend-field="%s" ',$this->depend_field['field']) : '';
        $data_depend_field .= isset($this->depend_field['value']) ? sprintf(' data-depend-value="%s" ', $this->depend_field['value']) : '';
        $data_depend_field .= isset($this->depend_field['compare']) ? sprintf(' data-depend-compare="%s" ', $this->depend_field['compare']) : '';

        $field_id = isset($this->repeat_id) ? sprintf('%s_%s', $this->repeat_id, $this->id) : $this->id;
        $field_name = isset($this->repeat_id) ? sprintf('%s_%s[]', $this->repeat_id, $this->id) : $this->id;

        ?>
        <div
            class="<?php echo esc_attr($this->col_width) ?> <?php echo esc_attr($this->css_class) ?> fat-cmb-color-wrap" <?php echo sprintf('%s', $data_depend_field); ?>>
            <label for="<?php echo esc_attr($field_id) ?>"><?php echo esc_attr($this->label) ?></label>
            <div class="fat-cmb-field">
                <input type="text" name="<?php echo esc_attr($field_name) ?>" id="<?php echo esc_attr($field_id) ?>" data-field-id="<?php echo esc_attr($this->id) ?>"
                       data-alpha="true"
                       value="<?php echo esc_attr($color) ?>"
                       data-std="<?php echo esc_attr($this->std); ?>"
                       class="fat-cmb-color-picker" />
                <span class="input-group-addon"><i></i></span>

                <?php if (isset($this->description) && $this->description != ''): ?>
                    <span class="fat-cmb-description"><?php echo esc_html($this->description); ?> </span>
                <?php endif; ?>
            </div>
        </div>
    <?php }
}