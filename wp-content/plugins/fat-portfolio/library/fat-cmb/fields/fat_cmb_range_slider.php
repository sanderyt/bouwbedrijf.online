<?php

/**
 * Created by PhpStorm.
 * User: roninwp
 * Date: 3/1/2017
 * Time: 2:37 PM
 */
class fat_cmb_range_slider
{

    public $repeat_id;
    public $repeat_value;
    public $repeat_index;
    public $metabox_id;
    public $id;
    public $label;
    public $std = '';
    public $min = 0;
    public $step = 1;
    public $max = 1000000;
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
        wp_enqueue_style('range-slider', FAT_CMB_ASSET_JS_URL . 'range-slider/range-slider.css', array(), '2.1.1');
        wp_enqueue_script('range-slider', FAT_CMB_ASSET_JS_URL . 'range-slider/range-slider.min.js', array(), '2.1.1', true);
        wp_enqueue_script('fat-cmb-range-slider', FAT_CMB_ASSET_JS_URL . 'range-slider.js', array(), '1.0.0', true);
    }

    public function render()
    {
        global $fat_cmb_post_meta;
        $post_meta = isset($fat_cmb_post_meta[$this->metabox_id][0]) ? unserialize($fat_cmb_post_meta[$this->metabox_id][0]) : '';
        if(isset($this->repeat_id)){
            $ranges_value = isset($this->repeat_value) ? $this->repeat_value : $this->std;;
        }else{
            $ranges_value = isset($post_meta[$this->id]) ? $post_meta[$this->id] : $this->std;
        }

        $data_depend_field = isset($this->depend_field['field']) ? sprintf(' data-depend-field="%s" ', $this->depend_field['field']) : '';
        $data_depend_field .= isset($this->depend_field['value']) ? sprintf(' data-depend-value="%s" ', $this->depend_field['value']) : '';
        $data_depend_field .= isset($this->depend_field['compare']) ? sprintf(' data-depend-compare="%s" ', $this->depend_field['compare']) : '';

        $field_id = isset($this->repeat_id) ? sprintf('%s_%s', $this->repeat_id, $this->id) : $this->id;
        $field_name = isset($this->repeat_id) ? sprintf('%s_%s[]', $this->repeat_id, $this->id) : $this->id;

        ?>
        <div
            class="<?php echo esc_attr($this->col_width) ?> <?php echo esc_attr($this->css_class) ?> fat-cmb-range-slider-wrap" <?php echo sprintf('%s', $data_depend_field); ?>>
            <label for="<?php echo esc_attr($this->id) ?>"><?php echo esc_attr($this->label) ?></label>
            <div class="fat-cmb-range-slider fat-cmb-field">
                <input id="range_slider_<?php echo esc_attr($field_id) ?>" type="range"
                       min="<?php echo esc_attr($this->min); ?>"
                       max="<?php echo esc_attr($this->max); ?>" step="<?php echo esc_attr($this->step); ?>"
                       value="<?php echo esc_attr($ranges_value) ?>"
                       data-output-id="<?php echo esc_attr($this->id) ?>"
                />

                <input id="<?php echo esc_attr($this->id) ?>"
                       data-field-id="<?php echo esc_attr($this->id) ?>"
                       data-range-id="range_slider_<?php echo esc_attr($this->id) ?>"
                       type="number" name="<?php echo esc_attr($field_name) ?>"
                       value="<?php echo esc_attr($ranges_value) ?>"
                       data-std="<?php echo esc_attr($this->std); ?>"
                >

                <?php if (isset($this->description) && $this->description != ''): ?>
                    <span class="fat-cmb-description"><?php echo esc_html($this->description); ?> </span>
                <?php endif; ?>
            </div>

        </div>
    <?php }
}