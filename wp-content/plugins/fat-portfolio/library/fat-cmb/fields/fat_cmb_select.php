<?php

/**
 * Created by PhpStorm.
 * User: Roninwp
 * Date: 10/23/2016
 * Time: 11:21 PM
 */
class fat_cmb_select
{
    public $repeat_id;
    public $repeat_value;
    public $repeat_index;
    public $metabox_id;
    public $id;
    public $label;
    public $std;
    public $multiple = false;
    public $col_width = 'fat-cmb-col-6';
    public $options = array();
    public $data_source = '';
    public $description = '';
    public $depend_field = null;
    public $css_class = '';

    public function __construct()
    {
        $this->enqueue_script();
    }

    private function enqueue_script()
    {
        wp_enqueue_style('selectize-default', FAT_CMB_ASSET_JS_URL . 'selectize/css/selectize.default.css', array(), '0.12.4');
        wp_enqueue_script('selectize', FAT_CMB_ASSET_JS_URL . 'selectize/js/selectize.min.js', array('jquery', 'jquery-ui-sortable'), '0.12.4', true);
        wp_enqueue_script('fat-cmb-select', FAT_CMB_ASSET_JS_URL . 'select.js', array(), '1.0.0', true);
    }

    public function render()
    {
        global $fat_cmb_post_meta;
        $post_meta = isset($fat_cmb_post_meta[$this->metabox_id][0]) ? unserialize($fat_cmb_post_meta[$this->metabox_id][0]) : '';
        if (isset($this->repeat_id)) {
            if (isset($this->repeat_value) && is_array(isset($this->repeat_value))) {
                $selected = array();
                foreach ($this->repeat_value as $value) {
                    $selected[] = $value;
                }
            } else {
                $selected = array($this->std);
            }
            $selected = isset($this->repeat_value) ? $this->repeat_value : array($this->std);
        } else {
            $selected = isset($post_meta[$this->id]) ? $post_meta[$this->id] : array($this->std);
        }
        $this->multiple = isset($this->multiple) && $this->multiple ? 'multiple="multiple"' : '';

        $data_depend_field = isset($this->depend_field['field']) ? sprintf(' data-depend-field="%s" ', $this->depend_field['field']) : '';
        $data_depend_field .= isset($this->depend_field['value']) ? sprintf(' data-depend-value="%s" ', $this->depend_field['value']) : '';
        $data_depend_field .= isset($this->depend_field['compare']) ? sprintf(' data-depend-compare="%s" ', $this->depend_field['compare']) : '';

        $is_selected = '';
        if (isset($this->data_source) && $this->data_source != '') {
            $args = array(
                'posts_per_page' => -1,
                'post_status'    => 'publish',
                'post_type'      => $this->data_source,
            );
            $posts = new WP_Query($args);
            $this->options = array();
            $post_id = $post_title = '';
            while ($posts->have_posts()) : $posts->the_post();
                $post_id = get_the_ID();
                $post_title = get_the_title();
                $this->options[$post_id] = $post_title;
            endwhile;
            wp_reset_postdata();
        }
        $field_id = isset($this->repeat_id) ? sprintf('%s_%s', $this->repeat_id, $this->id) : $this->id;
        $field_name = isset($this->repeat_id) ? sprintf('%s_%s[%s]', $this->repeat_id, $this->id, $this->repeat_index) : $this->id;
        $field_id = $this->multiple ? $field_id . '[]' : $field_id;
        $field_name = $this->multiple ? $field_name . '[]' : $field_name;
        ?>
        <div
            class="<?php echo esc_attr($this->col_width) ?> <?php echo esc_attr($this->css_class) ?> fat-cmb-select-wrap" <?php echo sprintf('%s', $data_depend_field); ?>>
            <label for="<?php echo esc_attr($this->id) ?>"><?php echo esc_attr($this->label) ?></label>
            <div class="fat-cmb-field">
                <select class="fat-cmb-select " name="<?php echo esc_attr($field_name) ?>"
                        data-field-id="<?php echo esc_attr($this->id) ?>"
                        id="<?php echo esc_attr($field_id) ?>"
                    <?php echo esc_attr($this->multiple); ?> >

                    <?php
                    if ($this->multiple) {
                        foreach ($selected as $key) {
                            if (isset($this->options[$key])) { ?>
                                <option value="<?php echo esc_attr($key) ?>"
                                        selected><?php echo esc_html($this->options[$key]) ?></option>
                            <?php }
                        }
                    } elseif (isset($this->options) && !is_array($selected) && isset($this->options[$selected])) { ?>
                        <option value="<?php echo esc_attr($selected) ?>"
                                selected><?php echo esc_html($this->options[$selected]) ?></option>
                    <?php } ?>

                    <?php foreach ($this->options as $key => $value):
                        if ($this->multiple) {
                            $is_selected = isset($selected) && is_array($selected) && in_array($key, $selected) ? 'selected' : '';
                        } else {
                            $is_selected = isset($selected) && $key == $selected ? 'selected' : '';
                        }
                        if (!$is_selected):
                            ?>
                            <option value="<?php echo esc_attr($key) ?>"><?php echo esc_html($value) ?></option>
                            <?php
                        endif;
                    endforeach; ?>

                </select>

                <?php if (isset($this->description) && $this->description != ''): ?>
                    <span class="fat-cmb-description"><?php echo esc_html($this->description); ?> </span>
                <?php endif; ?>
            </div>

        </div>
    <?php }
}
