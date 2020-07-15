<?php

/**
 * Created by PhpStorm.
 * User: Roninwp
 * Date: 10/15/2016
 * Time: 10:03 PM
 */
class fat_cmb_datetime
{

    public $repeat_id;
    public $repeat_value;
    public $repeat_index;
    public $metabox_id;
    public $id;
    public $label;
    public $date_picker = true;
    public $time_picker = true;
    public $std = '';
    public $col_width = 'fat-cmb-col-6';
    public $description = '';
    public $depend_field = null;
    public $css_class = '';

    public function __construct()
    {
        $this->enqueue_script();
    }

    private function enqueue_script(){
        wp_enqueue_style('datetime-picker', FAT_CMB_ASSET_JS_URL . 'datetime-picker/jquery.datetimepicker.min.css', array(), '1.2.5');
        wp_enqueue_script('datetime-picker', FAT_CMB_ASSET_JS_URL . 'datetime-picker/jquery.datetimepicker.full.min.js', array(), '1.2.5', true);
        wp_enqueue_script('fat-cmb-datetime-picker', FAT_CMB_ASSET_JS_URL . 'datetime-picker.js', array(), '1.0.0', true);
    }

    public function render()
    {
        global $fat_cmb_post_meta;
        $post_meta = isset($fat_cmb_post_meta[$this->metabox_id][0]) ? unserialize($fat_cmb_post_meta[$this->metabox_id][0]) : '';
        if(isset($this->repeat_id)){
            $text = isset($this->repeat_value) ? $this->repeat_value : $this->std;
        }else{
            $text = isset($post_meta[$this->id]) ? $post_meta[$this->id] : $this->std;
        }

        $data_depend_field = isset($this->depend_field['field']) ? sprintf(' data-depend-field="%s" ',$this->depend_field['field']) : '';
        $data_depend_field .= isset($this->depend_field['value']) ? sprintf(' data-depend-value="%s" ', $this->depend_field['value']) : '';
        $data_depend_field .= isset($this->depend_field['compare']) ? sprintf(' data-depend-compare="%s" ', $this->depend_field['compare']) : '';

        $field_id = isset($this->repeat_id) ? sprintf('%s_%s', $this->repeat_id, $this->id) : $this->id;
        $field_name = isset($this->repeat_id) ? sprintf('%s_%s[]', $this->repeat_id, $this->id) : $this->id;
        $locate = get_locale();
        $locate = explode('_',$locate);
        $locate = isset($locate[0]) ? $locate[0] : 'en';
        ?>
        <div
            class="<?php echo esc_attr($this->col_width) ?> <?php echo esc_attr($this->css_class) ?> fat-cmb-date-wrap" <?php echo sprintf('%s', $data_depend_field); ?> >
            <label for="<?php echo esc_attr($this->id) ?>"><?php echo esc_attr($this->label) ?></label>
            <div class="fat-cmb-field">
                <input class="fat-cmb-datetime-picker" type="text" name="<?php echo esc_attr($field_name) ?>" value="<?php echo esc_attr($text); ?>"
                       id="<?php echo esc_attr($field_id) ?>" data-date-picker="<?php echo ($this->date_picker ? '1' : '0'); ?>"
                       data-field-id="<?php echo esc_attr($this->id) ?>"
                       data-time-picker="<?php echo ($this->time_picker ? '1' : '0'); ?>"
                       data-locale = "<?php echo esc_attr($locate); ?>"
                       data-std="<?php echo esc_attr($this->std); ?>"
                />

                <?php if (isset($this->description) && $this->description != ''): ?>
                    <span class="fat-cmb-description"><?php echo esc_html($this->description); ?> </span>
                <?php endif; ?>
            </div>
        </div>
    <?php }
}
