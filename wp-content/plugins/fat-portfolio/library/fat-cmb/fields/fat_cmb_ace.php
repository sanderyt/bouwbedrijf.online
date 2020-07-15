<?php
/**
 * Created by PhpStorm.
 * User: Roninwp
 * Date: 10/15/2016
 * Time: 10:03 PM
 */
class fat_cmb_ace{

    public $repeat_id;
    public $repeat_value;
    public $repeat_index;
    public $metabox_id;
    public $id;
    public $label;
    //css, javascript
    public $mode;
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
        wp_enqueue_script('ace_editor', '//cdnjs.cloudflare.com/ajax/libs/ace/1.2.5/ace.js', array('jquery'), '1.3.3', true);
        wp_enqueue_script('fat-cmb-ace', FAT_CMB_ASSET_JS_URL . 'ace.js', array('ace_editor'), '1.0.0', true);
    }

    public function render(){
        global $fat_cmb_post_meta;
        $post_meta = isset($fat_cmb_post_meta[$this->metabox_id][0]) ? unserialize($fat_cmb_post_meta[$this->metabox_id][0]) : '';
        if(isset($this->repeat_id)){
            $text = isset($this->repeat_value ) ?  $this->repeat_value : $this->std;
        }else{
            $text = isset($post_meta[$this->id] ) ?  $post_meta[$this->id] : $this->std;
        }

        $repeat_depend_prefix = '';// isset($this->repeat_id) ? $this->repeat_id.'_' : '';
        $data_depend_field = isset($this->depend_field['field']) ? sprintf(' data-depend-field="%s%s" ',$repeat_depend_prefix, $this->depend_field['field']) : '';
        $data_depend_field = isset($this->depend_field['field']) ? sprintf(' data-depend-field="%s" ',$this->depend_field['field'] ) : '';
        $data_depend_field .= isset($this->depend_field['value']) ? sprintf(' data-depend-value="%s" ',$this->depend_field['value'] ) : '';
        $data_depend_field .= isset($this->depend_field['compare']) ? sprintf(' data-depend-compare="%s" ',$this->depend_field['compare'] ) : '';

        $field_id = isset($this->repeat_id) ? sprintf('%s_%s',$this->repeat_id,$this->id) : $this->id;
        $field_name = isset($this->repeat_id) ? sprintf('%s_%s[]',$this->repeat_id,$this->id) : $this->id;

        ?>
        <div class="<?php echo esc_attr($this->col_width) ?> <?php echo esc_attr($this->css_class) ?> fat-cmb-ace-wrap" <?php  echo sprintf('%s',$data_depend_field) ; ?>>
            <label for="<?php echo esc_attr($this->id) ?>"><?php echo esc_attr($this->label) ?></label>
            <div class="fat-cmb-field">
                <textarea name="<?php echo esc_attr($field_name) ?>" style="display: none"><?php echo sprintf('%s', $text); ?></textarea>
                <pre data-mode="<?php echo esc_attr($this->mode); ?>"  id="<?php echo esc_attr($field_id) ?>" class="fat-cmb-ace-editor"><?php echo esc_html($text); ?></pre>
                <?php if(isset($this->description) && $this->description!=''): ?>
                    <span class="fat-cmb-description"><?php echo esc_html($this->description);?> </span>
                <?php endif; ?>
            </div>
        </div>
    <?php }
}
