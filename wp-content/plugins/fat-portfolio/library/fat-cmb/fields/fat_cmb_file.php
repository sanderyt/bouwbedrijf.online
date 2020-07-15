<?php

/**
 * Created by PhpStorm.
 * User: roninwp
 * Date: 11/2/2016
 * Time: 10:02 PM
 */
class fat_cmb_file
{
    public $repeat_id;
    public $repeat_value;
    public $repeat_index;
    public $metabox_id;
    public $id;
    public $label;
    public $std = '';
    public $file_type; //image, document, video, audio
    public $col_width = 'fat-cmb-col-12';
    public $description = '';
    public $depend_field = null;
    public $css_class = '';

    public function __construct()
    {
    }

    private function enqueue_script()
    {
        wp_enqueue_media();
        wp_enqueue_script('fat-cmb-file', FAT_CMB_ASSET_JS_URL . 'file.js', array(), '1.0.0', true);
        wp_localize_script('fat-cmb-file', 'fat_file', array('type' => $this->file_type ));
    }

    public function render()
    {
        $this->enqueue_script();

        global $fat_cmb_post_meta;
        $post_meta = isset($fat_cmb_post_meta[$this->metabox_id][0]) ? unserialize($fat_cmb_post_meta[$this->metabox_id][0]) : '';
        if (isset($this->repeat_id)) {
            $field_value = isset($this->repeat_value) ? $this->repeat_value : $this->std;
        } else {
            $field_value = isset($post_meta[$this->id]) ? $post_meta[$this->id] : $this->std;
        }

        $data_depend_field = isset($this->depend_field['field']) ? sprintf(' data-depend-field="%s" ',$this->depend_field['field']) : '';
        $data_depend_field .= isset($this->depend_field['value']) ? sprintf(' data-depend-value="%s" ', $this->depend_field['value']) : '';
        $data_depend_field .= isset($this->depend_field['compare']) ? sprintf(' data-depend-compare="%s" ', $this->depend_field['compare']) : '';

        $field_attach_id = isset($this->repeat_id) ? sprintf('%s_%s_id', $this->repeat_id, $this->id) : $this->id .'_id';
        $field_attach_name = isset($this->repeat_id) ? sprintf('%s_%s[%s][id]', $this->repeat_id, $this->id, $this->repeat_index) : $this->id .'[id]';
        $field_attach_value = isset($field_value['id']) ? $field_value['id'] : '';

        $field_url_id = isset($this->repeat_id) ? sprintf('%s_%s_url', $this->repeat_id, $this->id) : $this->id .'_url';
        $field_url_name = isset($this->repeat_id) ? sprintf('%s_%s[%s][url]', $this->repeat_id, $this->id, $this->repeat_index) : $this->id .'[url]';
        $field_url_value = isset($field_value['url']) ? $field_value['url'] : '';

        $field_title_id = isset($this->repeat_id) ? sprintf('%s_%s_title', $this->repeat_id, $this->id) : $this->id .'_title';
        $field_title_name = isset($this->repeat_id) ? sprintf('%s_%s[%s][title]', $this->repeat_id, $this->id, $this->repeat_index) : $this->id .'[title]';
        $field_title_value = isset($field_value['title']) ? $field_value['title'] : '';

        $field_type_id = isset($this->repeat_id) ? sprintf('%s_%s_type', $this->repeat_id, $this->id) : $this->id .'_type';
        $field_type_name = isset($this->repeat_id) ? sprintf('%s_%s[%s][type]', $this->repeat_id, $this->id, $this->repeat_index) : $this->id .'[type]';
        $field_type_value = isset($field_value['type']) ? $field_value['type'] : 'image';

        $field_icon_id = isset($this->repeat_id) ? sprintf('%s_%s_icon', $this->repeat_id, $this->id) : $this->id .'_icon';
        $field_icon_name = isset($this->repeat_id) ? sprintf('%s_%s[%s][icon]', $this->repeat_id, $this->id, $this->repeat_index) : $this->id .'[icon]';
        $field_icon_value = isset($field_value['icon']) ? $field_value['icon'] : '';

        $field_icon_value = $this->file_type === 'image' ? $field_url_value : $field_icon_value;
        ?>
        <div
            class="<?php echo esc_attr($this->col_width) ?> <?php echo esc_attr($this->css_class) ?> fat-cmb-file-wrap" <?php echo sprintf('%s', $data_depend_field); ?>>
            <label for="<?php echo esc_attr($this->id) ?>"><?php echo esc_attr($this->label) ?></label>
            <div class="fat-add-file-wrap fat-cmb-field">
                <input type="hidden" class="fat-cmb-file-id" name="<?php echo esc_attr($field_attach_name) ?>" id="<?php echo esc_attr($field_attach_id) ?>"
                       data-field-id="<?php echo esc_attr($this->id) ?>"
                       value="<?php echo esc_attr($field_attach_value); ?>">
                <input type="hidden" class="fat-cmb-file-title" name="<?php echo esc_attr($field_title_name) ?>" id="<?php echo esc_attr($field_title_id) ?>"
                        value="<?php echo esc_attr($field_title_value); ?>">
                <input type="hidden" class="fat-cmb-file-type" name="<?php echo esc_attr($field_type_name) ?>" id="<?php echo esc_attr($field_type_id) ?>"
                       value="<?php echo esc_attr($field_type_value); ?>">
                <input type="hidden" class="fat-cmb-file-icon" name="<?php echo esc_attr($field_icon_name) ?>" id="<?php echo esc_attr($field_icon_id) ?>"
                       value="<?php echo esc_attr($field_icon_value); ?>">

                <input type="text" class="fat-cmb-file-path" readonly name="<?php echo esc_attr($field_url_name) ?>" id="<?php echo esc_attr($field_url_id) ?>"
                       value="<?php echo esc_attr($field_url_value); ?>">

                <a href="javascript:" class="fat-add-file"><?php esc_html_e('Choice file', 'fat-cmb'); ?></a>
                <a href="javascript:" class="fat-delete-file"><?php esc_html_e('Delete file', 'fat-cmb'); ?></a>

                <div class="fat-cmb-file-icon fat-file-type-<?php echo esc_attr($this->file_type);?>">
                    <?php if($field_icon_value !== ''  ): ?>
                        <img src="<?php echo esc_url($field_icon_value); ?>" />
                    <?php endif; ?>
                </div>
            </div>
            <?php if (isset($this->description) && $this->description != ''): ?>
                <span class="fat-cmb-description"><?php echo esc_html($this->description); ?> </span>
            <?php endif; ?>
        </div>
    <?php }
}