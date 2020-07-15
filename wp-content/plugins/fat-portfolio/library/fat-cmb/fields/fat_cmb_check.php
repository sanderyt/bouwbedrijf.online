<?php

/**
 * Created by PhpStorm.
 * User: Roninwp
 * Date: 10/23/2016
 * Time: 11:21 PM
 */
class fat_cmb_check
{
    public $repeat_id;
    public $repeat_value;
    public $repeat_index;
    public $metabox_id;
    public $id;
    public $label;
    public $std;
    public $col_width = 'fat-cmb-col-6';
    public $options = array();
    public $description = '';
    public $depend_field = null;
    public $css_class = '';

    public function __construct()
    {
    }

    public function render()
    {
        global $fat_cmb_post_meta;
        $post_meta = isset($fat_cmb_post_meta[$this->metabox_id][0]) ? unserialize($fat_cmb_post_meta[$this->metabox_id][0]) : '';

        $data_depend_field = isset($this->depend_field['field']) ? sprintf(' data-depend-field="%s" ',$this->depend_field['field']) : '';
        $data_depend_field .= isset($this->depend_field['value']) ? sprintf(' data-depend-value="%s" ', $this->depend_field['value']) : '';
        $data_depend_field .= isset($this->depend_field['compare']) ? sprintf(' data-depend-compare="%s" ', $this->depend_field['compare']) : '';

        $field_id = isset($this->repeat_id) ? sprintf('%s_%s', $this->repeat_id, $this->id) : $this->id;
        $field_name = isset($this->repeat_id) ? sprintf('%s_%s[%s][]', $this->repeat_id, $this->id, $this->repeat_index) : $this->id.'[]';

        ?>
        <div
            class="<?php echo esc_attr($this->col_width) ?> <?php echo esc_attr($this->css_class) ?> fat-cmb-check-wrap" <?php echo sprintf('%s', $data_depend_field); ?>>
            <label for="<?php echo esc_attr($this->id) ?>"><?php echo esc_attr($this->label) ?></label>
            <div class="fat-cmb-field">
                <ul name="<?php echo esc_attr($field_name) ?>" id="<?php echo esc_attr($field_id) ?>" data-field-id="<?php echo esc_attr($this->id) ?>"
                    class="fat-radio-group " data-type="checkbox">
                    <?php
                    $index = 0;
                    $checked = $name = '';
                    foreach ($this->options as $key => $value):
                        if(isset($key) && $key !=''){
                            if(isset($this->repeat_id)){
                                $checked = isset($this->repeat_value) && in_array($key, $this->repeat_value) || (!isset($post_meta[$this->id]) && $this->std == $key) ? 'checked' : '';
                                $name =  sprintf('%s_%s[%s]', $this->repeat_id, $this->id, $this->repeat_index);
                            }else{
                                $checked = (isset($post_meta[$this->id]) && is_array($post_meta[$this->id]) && in_array($key, $post_meta[$this->id])) || (!isset($post_meta[$this->id]) && $this->std == $key) ? 'checked' : '';
                                $name =  $this->id . '[' . $index++ . ']';
                            }
                        }
                        ?>
                        <li>
                            <input type="checkbox" value="<?php echo esc_attr($key) ?>" id="<?php echo sprintf('%s_%s',$field_id, $index); ?>"
                                   name="<?php echo esc_attr($field_name) ?>" <?php echo esc_attr($checked); ?>
                                <?php echo ($key == $this->std ? 'data-std="1"' : ''); ?>
                            >
                            <label for="<?php echo sprintf('%s_%s',$field_id, $index); ?>"><?php echo esc_html($value) ?></label>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <?php if (isset($this->description) && $this->description != ''): ?>
                    <span class="fat-cmb-description"><?php echo esc_html($this->description); ?> </span>
                <?php endif; ?>
            </div>
        </div>
    <?php }
}
