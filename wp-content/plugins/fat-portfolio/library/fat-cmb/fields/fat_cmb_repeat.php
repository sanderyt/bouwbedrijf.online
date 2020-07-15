<?php

/**
 * Created by PhpStorm.
 * User: Roninwp
 * Date: 10/15/2016
 * Time: 10:03 PM
 */
class fat_cmb_repeat
{

    public $metabox_id;
    public $id;
    public $label;
    public $fields;
    public $col_width = 'fat-cmb-col-12';
    public $description = '';
    public $depend_field = null;
    public $css_class = '';

    public function __construct()
    {
        $this->enqueue_script();
    }

    public function enqueue_script()
    {
        wp_enqueue_script('fat-cmb-repeat', FAT_CMB_ASSET_JS_URL . 'repeat.js', array(), '1.0.0', true);
    }

    public function render()
    {
        global $fat_cmb_post_meta;
        $post_meta = isset($fat_cmb_post_meta[$this->metabox_id][0]) ? unserialize($fat_cmb_post_meta[$this->metabox_id][0]) : '';
        $repeat_values = isset($post_meta[$this->id]) ? $post_meta[$this->id] : array();

        $data_depend_field = isset($this->depend_field['field']) ? sprintf(' data-depend-field="%s" ', $this->depend_field['field']) : '';
        $data_depend_field .= isset($this->depend_field['value']) ? sprintf(' data-depend-value="%s" ', $this->depend_field['value']) : '';
        $data_depend_field .= isset($this->depend_field['compare']) ? sprintf(' data-depend-compare="%s" ', $this->depend_field['compare']) : '';

        ?>
        <div
            class="<?php echo esc_attr($this->col_width) ?> <?php echo esc_attr($this->css_class) ?> fat-cmb-repeat-wrap" <?php echo sprintf('%s', $data_depend_field); ?>>
            <label for="<?php echo esc_attr($this->id) ?>"><?php echo esc_attr($this->label) ?></label>
            <div class="fat-cmb-field">
                <?php
                $field_value = null;
                $groups = 1;
                if (isset($repeat_values) && is_array($repeat_values)) {
                    $first_key = current(array_keys($repeat_values));
                    $groups = isset($repeat_values[$first_key]) ? count($repeat_values[$first_key]) : $groups;
                }
                for ($i = 0; $i < $groups; $i++) {
                    ?>
                    <div class="fat-cmb-repeat-field-group">
                        <?php foreach ($this->fields as $field) {
                            if (!isset($field['id'])) {
                                break;
                            }
                            switch ($field['type']) {
                                case 'text':
                                    $fat_field_type = new fat_cmb_text();
                                    $fat_field_type->repeat_id = $this->id;
                                    $fat_field_type->repeat_value = isset($repeat_values[$field['id']][$i]) ? $repeat_values[$field['id']][$i] : $fat_field_type->repeat_value;
                                    $fat_field_type->repeat_index = $i;
                                    $fat_field_type->metabox_id = $this->metabox_id;
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
                                    $fat_field_type->repeat_id = $this->id;
                                    $fat_field_type->repeat_value = isset($repeat_values[$field['id']][$i]) ? $repeat_values[$field['id']][$i] : $fat_field_type->repeat_value;
                                    $fat_field_type->repeat_index = $i;
                                    $fat_field_type->metabox_id = $this->metabox_id;
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
                                    $fat_field_type->repeat_id = $this->id;
                                    $fat_field_type->repeat_value = isset($repeat_values[$field['id']][$i]) ? $repeat_values[$field['id']][$i] : $fat_field_type->repeat_value;
                                    $fat_field_type->repeat_index = $i;
                                    $fat_field_type->metabox_id = $this->metabox_id;
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
                                    $fat_field_type->repeat_id = $this->id;
                                    $fat_field_type->repeat_value = isset($repeat_values[$field['id']][$i]) ? $repeat_values[$field['id']][$i] : $fat_field_type->repeat_value;
                                    $fat_field_type->repeat_index = $i;
                                    $fat_field_type->metabox_id = $this->metabox_id;
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
                                    $fat_field_type->repeat_id = $this->id;
                                    $fat_field_type->repeat_value = isset($repeat_values[$field['id']][$i]) ? $repeat_values[$field['id']][$i] : $fat_field_type->repeat_value;
                                    $fat_field_type->repeat_index = $i;
                                    $fat_field_type->metabox_id = $this->metabox_id;;
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
                                    $fat_field_type->repeat_id = $this->id;
                                    $fat_field_type->repeat_value = isset($repeat_values[$field['id']][$i]) ? $repeat_values[$field['id']][$i] : $fat_field_type->repeat_value;
                                    $fat_field_type->repeat_index = $i;
                                    $fat_field_type->metabox_id = $this->metabox_id;
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
                                    $fat_field_type->repeat_id = $this->id;
                                    $fat_field_type->repeat_value = isset($repeat_values[$field['id']][$i]) ? $repeat_values[$field['id']][$i] : $fat_field_type->repeat_value;
                                    $fat_field_type->repeat_index = $i;
                                    $fat_field_type->metabox_id = $this->metabox_id;
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
                                    $fat_field_type->repeat_id = $this->id;
                                    $fat_field_type->repeat_value = isset($repeat_values[$field['id']][$i]) ? $repeat_values[$field['id']][$i] : $fat_field_type->repeat_value;
                                    $fat_field_type->repeat_index = $i;
                                    $fat_field_type->metabox_id = $this->metabox_id;
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
                                case 'single_image':
                                    $fat_field_type = new fat_cmb_single_image();
                                    $fat_field_type->repeat_id = $this->id;
                                    $fat_field_type->repeat_value = isset($repeat_values[$field['id']][$i]) ? $repeat_values[$field['id']][$i] : $fat_field_type->repeat_value;
                                    $fat_field_type->repeat_index = $i;
                                    $fat_field_type->metabox_id = $this->metabox_id;;
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
                                    $fat_field_type->repeat_id = $this->id;
                                    $fat_field_type->repeat_value = isset($repeat_values[$field['id']][$i]) ? $repeat_values[$field['id']][$i] : $fat_field_type->repeat_value;
                                    $fat_field_type->repeat_index = $i;
                                    $fat_field_type->metabox_id = $this->metabox_id;
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
                                    $fat_field_type->repeat_id = $this->id;
                                    $fat_field_type->repeat_value = isset($repeat_values[$field['id']][$i]) ? $repeat_values[$field['id']][$i] : $fat_field_type->repeat_value;
                                    $fat_field_type->repeat_index = $i;
                                    $fat_field_type->metabox_id = $this->metabox_id;
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
                                    $fat_field_type->repeat_id = $this->id;
                                    $fat_field_type->repeat_value = isset($repeat_values[$field['id']][$i]) ? $repeat_values[$field['id']][$i] : $fat_field_type->repeat_value;
                                    $fat_field_type->repeat_index = $i;
                                    $fat_field_type->metabox_id = $this->metabox_id;
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
                                case 'datetime':
                                    $fat_field_type = new fat_cmb_datetime();
                                    $fat_field_type->repeat_id = $this->id;
                                    $fat_field_type->repeat_value = isset($repeat_values[$field['id']][$i]) ? $repeat_values[$field['id']][$i] : $fat_field_type->repeat_value;
                                    $fat_field_type->repeat_index = $i;
                                    $fat_field_type->metabox_id = $this->metabox_id;
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
                                case 'section':
                                    $fat_field_type = new fat_cmb_section();
                                    $fat_field_type->id = $field['id'];
                                    $fat_field_type->css_class = isset($field['css_class']) ? $field['css_class'] : '';
                                    $fat_field_type->repeat_id = $this->id;
                                    $fat_field_type->label = isset($field['label']) ? $field['label'] : $fat_field_type->label;
                                    $fat_field_type->description = isset($field['description']) ? $field['description'] : $fat_field_type->description;
                                    $fat_field_type->depend_field = isset($field['depend_field']) ? $field['depend_field'] : $fat_field_type->depend_field;
                                    $fat_field_type->render();
                                    break;
                                case 'file':
                                    $fat_field_type = new fat_cmb_file();
                                    $fat_field_type->repeat_id = $this->id;
                                    $fat_field_type->repeat_value = isset($repeat_values[$field['id']][$i]) ? $repeat_values[$field['id']][$i] : $fat_field_type->repeat_value;
                                    $fat_field_type->repeat_index = $i;
                                    $fat_field_type->metabox_id = $this->metabox_id;;
                                    $fat_field_type->id = $field['id'];
                                    $fat_field_type->css_class = isset($field['css_class']) ? $field['css_class'] : '';
                                    $fat_field_type->std = isset($field['std']) ? $field['std'] : array();
                                    $fat_field_type->file_type = isset($field['file_type']) ? $field['file_type'] : 'image';
                                    $fat_field_type->label = isset($field['label']) ? $field['label'] : $fat_field_type->label;
                                    $fat_field_type->description = isset($field['description']) ? $field['description'] : $fat_field_type->description;
                                    $fat_field_type->col_width = isset($field['col_width']) ? $field['col_width'] : $fat_field_type->col_width;
                                    $fat_field_type->depend_field = isset($field['depend_field']) ? $field['depend_field'] : $fat_field_type->depend_field;
                                    $fat_field_type->render();
                                    break;
                            }
                        } ?>
                        <a href="javascript:" class="fat-cmb-repeat-remove"
                           title="<?php echo esc_attr('Remove field', 'fat-cmb'); ?>"><i
                                class="dashicons dashicons-dismiss"></i></a>
                    </div>
                <?php } ?>
                <div class="fat-cmb-repeat-button-group">
                    <a href="javascript:"
                       class="button fat-cmb-repeat-add"><?php esc_html_e('Add field', 'fat-cmb'); ?></a>
                    <a href="javascript:"
                       class="button fat-cmb-repeat-remove-all"><?php esc_html_e('Remove all', 'fat-cmb'); ?></a>
                </div>
                <?php if (isset($this->description) && $this->description != ''): ?>
                    <span class="fat-cmb-description"><?php echo esc_html($this->description); ?> </span>
                <?php endif; ?>
            </div>
        </div>
    <?php }
}