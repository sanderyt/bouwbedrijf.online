<?php

/**
 * Created by PhpStorm.
 * User: Roninwp
 * Date: 10/15/2016
 * Time: 10:03 PM
 */
class fat_cmb_section
{
    public $id;
    public $repeat_id;
    public $label;
    public $description = '';
    public $depend_field = null;
    public $css_class = '';

    public function __construct()
    {
    }

    public function render()
    {
        $data_depend_field = isset($this->depend_field['field']) ? sprintf(' data-depend-field="%s" ', $this->depend_field['field']) : '';
        $data_depend_field .= isset($this->depend_field['value']) ? sprintf(' data-depend-value="%s" ', $this->depend_field['value']) : '';
        $data_depend_field .= isset($this->depend_field['compare']) ? sprintf(' data-depend-compare="%s" ', $this->depend_field['compare']) : '';

        $field_id = isset($this->repeat_id) ? sprintf('%s_%s', $this->repeat_id, $this->id) : $this->id;
        $field_name = isset($this->repeat_id) ? sprintf('%s_%s[]', $this->repeat_id, $this->id) : $this->id;

        ?>
        <div class="fat-cmb-col-12 <?php echo esc_attr($this->css_class) ?> fat-cmb-section-wrap"  id="<?php echo esc_attr($field_id) ?>"
             data-field-id="<?php echo esc_attr($this->id) ?>" <?php echo sprintf('%s', $data_depend_field); ?> >
            <label><?php echo esc_attr($this->label) ?></label>
            <span class="fat-cmb-section-note">
                <?php echo esc_html($this->description); ?>
            </span>
        </div>
    <?php }
}
