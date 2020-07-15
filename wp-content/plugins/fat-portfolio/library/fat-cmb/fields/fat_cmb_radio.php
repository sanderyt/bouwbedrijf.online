<?php

/**
 * Created by PhpStorm.
 * User: Roninwp
 * Date: 10/23/2016
 * Time: 11:21 PM
 */
class fat_cmb_radio
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
        if(isset($this->repeat_id)){
            $check = isset($this->repeat_value[0]) ? $this->repeat_value[0] : $this->std;
        }else{
            $check = isset($post_meta[$this->id]) ? $post_meta[$this->id] : $this->std;
        }
        $data_depend_field = isset($this->depend_field['field']) ? sprintf(' data-depend-field="%s" ', $this->depend_field['field']) : '';
        $data_depend_field .= isset($this->depend_field['value']) ? sprintf(' data-depend-value="%s" ', $this->depend_field['value']) : '';
        $data_depend_field .= isset($this->depend_field['compare']) ? sprintf(' data-depend-compare="%s" ', $this->depend_field['compare']) : '';

        $field_id = isset($this->repeat_id) ? sprintf('%s_%s', $this->repeat_id, $this->id) : $this->id;
        $field_name = isset($this->repeat_id) ? sprintf('%s_%s[%s][]', $this->repeat_id, $this->id, $this->repeat_index) : $this->id;

        ?>
        <div
            class="<?php echo esc_attr($this->col_width) ?> <?php echo esc_attr($this->css_class) ?> fat-cmb-radio-wrap" <?php echo sprintf('%s', $data_depend_field); ?>>
            <label for="<?php echo esc_attr($this->id) ?>"><?php echo esc_attr($this->label) ?></label>
            <div class="fat-cmb-field">
                <ul name="<?php echo esc_attr($this->id) ?>_group" class="fat-radio-group "
                    data-field-id="<?php echo esc_attr($this->id) ?>"
                    id="<?php echo esc_attr($field_id) ?>" data-type="radio">
                    <?php
                    $index = 0;
                    foreach ($this->options as $key => $value):
                        $index++;
                        ?>
                        <li>
                            <input id="<?php echo sprintf('%s_%s',$field_id,$index );?>" type="radio" value="<?php echo esc_attr($key) ?>"
                                   name="<?php echo esc_attr($field_name) ?>" <?php checked($check, $key, 'checked'); ?>
                                <?php echo ($key == $this->std ? 'data-std="1"' : ''); ?>
                            >
                            <label for="<?php echo sprintf('%s_%s',$field_id,$index );?>"><?php echo esc_html($value) ?></label>

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