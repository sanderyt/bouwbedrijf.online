<?php
/**
 * Created by PhpStorm.
 * User: roninwp
 * Date: 4/20/2017
 * Time: 1:43 PM
 */
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
                    $fat_field_type->label = isset($field['label']) ? $field['label'] : $fat_field_type->label;
                    $fat_field_type->description = isset($field['description']) ? $field['description'] : $fat_field_type->description;
                    $fat_field_type->render();
                    break;
                case 'file':
                    $fat_field_type = new fat_cmb_file();
                    $fat_field_type->metabox_id = $meta_box_id;
                    $fat_field_type->id = $field['id'];
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