<?php

/**
 * Created by PhpStorm.
 * User: Roninwp
 * Date: 10/15/2016
 * Time: 10:03 PM
 */
class fat_cmb_flickr
{

    public $metabox_id;
    public $id;
    public $label;
    public $col_width = 'fat-cmb-col-12';
    public $description = '';
    public $depend_field = null;
    public $css_class = '';

    public function __construct()
    {
        $this->enqueue_script();
    }

    private function enqueue_script(){
        wp_enqueue_script('flickr-api', FAT_CMB_ASSET_JS_URL . 'flickr/flickr-api.js', array(), '1.0.0', true);
        wp_enqueue_script('fat-cmb-flickr', FAT_CMB_ASSET_JS_URL . 'flickr.js', array('flickr-api'), '1.0.0', true);
    }

    public function render()
    {
        global $fat_cmb_post_meta, $fat_cmb_post_type;
        $post_meta = isset($fat_cmb_post_meta[$this->metabox_id][0]) ? unserialize($fat_cmb_post_meta[$this->metabox_id][0]) : '';
        $flickr_filter = isset($post_meta[$this->id]) ? $post_meta[$this->id] : array();
        $api_key = isset($flickr_filter['api_key']) ? $flickr_filter['api_key'] : '';
        $get_by = isset($flickr_filter['get_by']) ? $flickr_filter['get_by'] : 'album';
        $album = isset($flickr_filter['album']) ? $flickr_filter['album'] : '';
        $gallery = isset($flickr_filter['gallery']) ? $flickr_filter['gallery'] : '';
        $media_click_action = isset($flickr_filter['media_click_action']) ? $flickr_filter['media_click_action'] : 'open_new_window';
        $tag_name = isset($flickr_filter['tag_name']) ? $flickr_filter['tag_name'] : '';
        $user_id = isset($flickr_filter['user_id']) ? $flickr_filter['user_id'] : '';
        $limit = isset($flickr_filter['limit']) ? $flickr_filter['limit'] : '';
        $media = isset($flickr_filter['media']) ? $flickr_filter['media'] : 'all';

        if($api_key == ''){
            $option_key = sprintf('%s_%s_flickr',$fat_cmb_post_type, $this->metabox_id);
            $flickr = get_option($option_key,array());
            $api_key = isset($flickr['api_key']) ? $flickr['api_key'] : $api_key;
            $user_id = isset($flickr['user_id']) ? $flickr['user_id'] : $user_id;
            $get_by = 'album';
        }

        $data_depend_field = isset($this->depend_field['field']) ? sprintf(' data-depend-field="%s" ', $this->depend_field['field']) : '';
        $data_depend_field .= isset($this->depend_field['value']) ? sprintf(' data-depend-value="%s" ', $this->depend_field['value']) : '';
        $data_depend_field .= isset($this->depend_field['compare']) ? sprintf(' data-depend-compare="%s" ', $this->depend_field['compare']) : '';

        ?>
        <div
            class="<?php echo esc_attr($this->col_width) ?> <?php echo esc_attr($this->css_class) ?> fat-cmb-flickr-wrap fat-cmb-social-wrap" <?php echo sprintf('%s', $data_depend_field); ?> >
            <label for="<?php echo esc_attr($this->id) ?>"><?php echo esc_attr($this->label) ?></label>
            <div class="fat-cmb-field">
                <div class="fat-cmb-flickr-title fat-cmb-social-title"><?php esc_html_e('Flickr Filter','fat-cmb'); ?></div>
                <div class="flickr-filter social-filter">
                    <div class="flickr-api-key">
                        <label><?php esc_html_e('Api Key:','fat-cmb'); ?></label>
                        <input type="text" name="<?php echo esc_attr($this->id) ?>[api_key]" value="<?php echo esc_attr($api_key); ?>"
                               id="<?php echo esc_attr($this->id) ?>[api_key]"
                        />
                    </div>

                    <div class="flickr-user-filter">
                        <label><?php esc_html_e('User Id:','fat-cmb'); ?></label>
                        <input type="text" name="<?php echo esc_attr($this->id) ?>[user_id]" id="<?php echo esc_attr($this->id) ?>[user_id]"
                               value="<?php echo esc_attr($user_id); ?>"
                        />
                        <a class="button connect-flickr"><?php esc_html_e('Connect Flickr','fat-cmb'); ?></a>
                        <span class="connect-success"><?php esc_html_e('Connect success','fat-cmb'); ?> </span>
                    </div>

                    <div class="flickr-get-by">
                        <label><?php esc_html_e('Get by:','fat-cmb'); ?></label>
                        <select name="<?php echo esc_attr($this->id) ?>[get_by]" id="<?php echo esc_attr($this->id) ?>[get_by]">
                            <option value="album" <?php echo ($get_by=='album' ? 'selected' : '') ;?> ><?php esc_html_e('Album','fat-cmb'); ?></option>
                            <option value="gallery" <?php echo ($get_by=='gallery' ? 'selected' : '') ;?> ><?php esc_html_e('Gallery','fat-cmb'); ?></option>
                            <option value="tag" <?php echo ($get_by=='tag' ? 'selected' : '') ;?>><?php esc_html_e('Tags ','fat-cmb'); ?></option>
                        </select>
                    </div>

                    <div class="flickr-media">
                        <label><?php esc_html_e('Media:','fat-cmb'); ?></label>
                        <select name="<?php echo esc_attr($this->id) ?>[media]" id="<?php echo esc_attr($this->id) ?>[media]">
                            <option value="all" <?php echo ($media=='all' ? 'selected' : '') ;?> ><?php esc_html_e('All','fat-cmb'); ?></option>
                            <option value="photos" <?php echo ($media=='image' ? 'selected' : '') ;?> ><?php esc_html_e('Photo only','fat-cmb'); ?></option>
                            <option value="videos" <?php echo ($media=='video' ? 'selected' : '') ;?>><?php esc_html_e('Video only ','fat-cmb'); ?></option>
                        </select>
                    </div>

                    <div class="flickr-tag-filter" style="display: <?php echo ($get_by=='tag' ? 'block' : 'none') ;?>">
                        <label><?php esc_html_e('Tag name:','fat-cmb'); ?></label>
                        <select name="<?php echo esc_attr($this->id) ?>[tag_name]" data-selected="<?php echo esc_attr($tag_name); ?>" id="<?php echo esc_attr($this->id) ?>[tag_name]">
                        </select>

                    </div>

                    <div class="flickr-album-filter" style="display: <?php echo ($get_by=='album' ? 'block' : 'none') ;?>">
                        <label><?php esc_html_e('Album:','fat-cmb'); ?></label>
                        <select name="<?php echo esc_attr($this->id) ?>[album]" data-selected="<?php echo esc_attr($album); ?>" id="<?php echo esc_attr($this->id) ?>[album]">
                        </select>
                    </div>

                    <div class="flickr-gallery-filter" style="display: <?php echo ($get_by=='gallery' ? 'block' : 'none') ;?>">
                        <label><?php esc_html_e('Gallery:','fat-cmb'); ?></label>
                        <select name="<?php echo esc_attr($this->id) ?>[gallery]" data-selected="<?php echo esc_attr($gallery); ?>" id="<?php echo esc_attr($this->id) ?>[gallery]">
                        </select>
                    </div>

                    <div class="flickr-limit-filter">
                        <label><?php esc_html_e('Limit (empty for get all):','fat-cmb'); ?></label>
                        <input type="number" name="<?php echo esc_attr($this->id) ?>[limit]" id="<?php echo esc_attr($this->id) ?>[limit]"
                               value="<?php echo esc_attr($limit); ?>"
                        />

                    </div>

                    <div class="flickr-media-click-action">
                        <label><?php esc_html_e('Media click action:','fat-cmb'); ?></label>
                        <select name="<?php echo esc_attr($this->id) ?>[media_click_action]" id="<?php echo esc_attr($this->id) ?>[media_click_action]">
                            <option value="open_new_window" <?php echo ($media_click_action=='open_new_window' ? 'selected' : '') ;?> ><?php esc_html_e('Open flickr post in new window','fat-cmb'); ?></option>
                            <option value="open_same_window" <?php echo ($media_click_action=='open_same_window' ? 'selected' : '') ;?>><?php esc_html_e('Open flickr post in same window ','fat-cmb'); ?></option>
                            <option value="open_popup_image" <?php echo ($media_click_action=='open_popup_image' ? 'selected' : '') ;?>><?php esc_html_e('Open popup image ','fat-cmb'); ?></option>
                        </select>
                    </div>

                    <div class="flickr-button social-button">
                        <span class="fat-cmb-description"><?php esc_html_e('Please click "Get image" button after input filter to get media from flickr','fat-cmb'); ?></span>
                        <span class="fat-cmb-loading">
                            <i class="dashicons dashicons-update fat-cmb-spin"></i>
                        </span>
                        <a href="javascript:" class="button"><?php esc_html_e('Get media','fat-cmb'); ?> </a>
                    </div>

                </div>

                <div class="fat-cmb-flickr-title fat-cmb-social-title"><?php esc_html_e('Flickr media','fat-cmb'); ?></div>
                <div class="fat-cmb-flickr-list fat-cmb-social-list" id="fat_cmb_flickr_<?php echo esc_attr($this->id) ?>">

                </div>
                <?php if (isset($this->description) && $this->description != ''): ?>
                    <span class="fat-cmb-description"><?php echo esc_html($this->description); ?> </span>
                <?php endif; ?>
            </div>
        </div>
    <?php }
}
