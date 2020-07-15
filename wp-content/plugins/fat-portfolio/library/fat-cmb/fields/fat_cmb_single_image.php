<?php

/**
 * Created by PhpStorm.
 * User: roninwp
 * Date: 11/2/2016
 * Time: 10:02 PM
 */
class fat_cmb_single_image
{
    public $repeat_id;
    public $repeat_value;
    public $repeat_index;
    public $metabox_id;
    public $id;
    public $label;
    public $std = '';
    public $col_width = 'fat-cmb-col-12';
    public $description = '';
    public $depend_field = null;
    public $css_class = '';

    public function __construct()
    {
        $this->enqueue_script();
    }

    private function enqueue_script()
    {
        wp_enqueue_media();
        wp_enqueue_script('fat-cmb-single-image', FAT_CMB_ASSET_JS_URL . 'single-image.js', array(), '1.0.0', true);
    }

    public function render()
    {
        global $fat_cmb_post_meta;
        $post_meta = isset($fat_cmb_post_meta[$this->metabox_id][0]) ? unserialize($fat_cmb_post_meta[$this->metabox_id][0]) : '';
        if (isset($this->repeat_id)) {
            $image_id = isset($this->repeat_value) ? $this->repeat_value : $this->std;
        } else {
            $image_id = isset($post_meta[$this->id]) ? $post_meta[$this->id] : $this->std;
        }
        $url = '';
        if ($image_id != '') {
            $url = wp_get_attachment_thumb_url($image_id);
        }

        $data_depend_field = isset($this->depend_field['field']) ? sprintf(' data-depend-field="%s" ', $this->depend_field['field']) : '';
        $data_depend_field .= isset($this->depend_field['value']) ? sprintf(' data-depend-value="%s" ', $this->depend_field['value']) : '';
        $data_depend_field .= isset($this->depend_field['compare']) ? sprintf(' data-depend-compare="%s" ', $this->depend_field['compare']) : '';

        $field_id = isset($this->repeat_id) ? sprintf('%s_%s', $this->repeat_id, $this->id) : $this->id;
        $field_name = isset($this->repeat_id) ? sprintf('%s_%s[]', $this->repeat_id, $this->id) : $this->id;

        ?>
        <div
            class="<?php echo esc_attr($this->col_width) ?> <?php echo esc_attr($this->css_class) ?> fat-cmb-images-wrap" <?php echo sprintf('%s', $data_depend_field); ?>>
            <label for="<?php echo esc_attr($this->id) ?>"><?php echo esc_attr($this->label) ?></label>
            <div class="fat-add-single-image-wrap fat-cmb-field">
                <input type="hidden" name="<?php echo esc_attr($field_name) ?>" id="<?php echo esc_attr($field_id) ?>"
                       data-field-id="<?php echo esc_attr($this->id) ?>"
                       value="<?php echo esc_attr($image_id); ?>">
                <div class="fat-list-image" data-input-id="<?php echo esc_attr($field_id) ?>">
                    <?php if($url!=''): ?>
                        <div class="fat-image-thumb" data-id="<?php echo esc_attr($image_id); ?>">
                            <img src="<?php echo esc_attr($url); ?>" />
                            <div class="fat-overlay fat-transition-30">
                            <span>
                                <a class="fat-delete-single-image" data-id="<?php echo esc_attr($image_id); ?>"
                                   href="javascript:"><i
                                        class="dashicons dashicons-no-alt"></i></a>
                            </span>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <a href="javascript:" class="fat-add-single-image"
                   data-input-id="<?php echo esc_attr($field_id) ?>"><?php esc_html_e('Choice image', 'fat-cmb'); ?></a>
            </div>
            <?php if (isset($this->description) && $this->description != ''): ?>
                <span class="fat-cmb-description"><?php echo esc_html($this->description); ?> </span>
            <?php endif; ?>
        </div>
    <?php }
}