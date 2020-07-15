<?php

/**
 * Created by PhpStorm.
 * User: Roninwp
 * Date: 10/15/2016
 * Time: 10:03 PM
 */
class fat_cmb_instagram
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
        wp_enqueue_script('instafeed', FAT_CMB_ASSET_JS_URL . 'instafeed/instafeed.min.js', array(), '1.9.3', true);
        wp_enqueue_script('fat-cmb-instagram', FAT_CMB_ASSET_JS_URL . 'instagram.js', array(), '1.0.0', true);
    }

    public function render()
    {
        global $fat_cmb_post_meta, $fat_cmb_post_type;
        $post_meta = isset($fat_cmb_post_meta[$this->metabox_id][0]) ? unserialize($fat_cmb_post_meta[$this->metabox_id][0]) : '';
        $instagram_filter = isset($post_meta[$this->id]) ? $post_meta[$this->id] : array();
        $access_token = isset($instagram_filter['access_token']) ? $instagram_filter['access_token'] : '';
        $get_by = isset($instagram_filter['get_by']) ? $instagram_filter['get_by'] : 'user';
        $image_click_action = isset($instagram_filter['image_click_action']) ? $instagram_filter['image_click_action'] : 'open_new_window';
        $tag_name = isset($instagram_filter['tag_name']) ? $instagram_filter['tag_name'] : '';
        $user_id = isset($instagram_filter['user_id']) ? $instagram_filter['user_id'] : '';
        $limit = isset($instagram_filter['limit']) ? $instagram_filter['limit'] : '';
        $sort_by = isset($instagram_filter['sort_by']) ? $instagram_filter['sort_by'] : 'none';

        if($access_token==''){
            $option_key = sprintf('%s_%s_instagram',$fat_cmb_post_type, $this->metabox_id);
            $instagram = get_option($option_key,array());
            $access_token = isset($instagram['access_token']) ? $instagram['access_token'] : $access_token;
            $user_id = isset($instagram['user_id']) ? $instagram['user_id'] : $user_id;
            $get_by = 'user';
        }

        $data_depend_field = isset($this->depend_field['field']) ? sprintf(' data-depend-field="%s" ', $this->depend_field['field']) : '';
        $data_depend_field .= isset($this->depend_field['value']) ? sprintf(' data-depend-value="%s" ', $this->depend_field['value']) : '';
        $data_depend_field .= isset($this->depend_field['compare']) ? sprintf(' data-depend-compare="%s" ', $this->depend_field['compare']) : '';

        ?>
        <div
            class="<?php echo esc_attr($this->col_width) ?> <?php echo esc_attr($this->css_class) ?> fat-cmb-instagram-wrap fat-cmb-social-wrap " <?php echo sprintf('%s', $data_depend_field); ?> >
            <label for="<?php echo esc_attr($this->id) ?>"><?php echo esc_attr($this->label) ?></label>
            <div class="fat-cmb-field">
                <div class="fat-cmb-instagram-title fat-cmb-social-title"><?php esc_html_e('Instagram Filter','fat-cmb'); ?></div>
                <div class="instagram-filter social-filter">
                    <div class="instagram-access-token">
                        <label><?php esc_html_e('Access token:','fat-cmb'); ?></label>
                        <input type="text" name="<?php echo esc_attr($this->id) ?>[access_token]" value="<?php echo esc_attr($access_token); ?>"
                               id="<?php echo esc_attr($this->id) ?>[access_token]"
                        />
                    </div>

                    <div class="instagram-get-by">
                        <label><?php esc_html_e('Get by:','fat-cmb'); ?></label>
                        <select name="<?php echo esc_attr($this->id) ?>[get_by]" id="<?php echo esc_attr($this->id) ?>[get_by]">
                            <option value="user" <?php echo ($get_by=='user' ? 'selected' : '') ;?> ><?php esc_html_e('User','fat-cmb'); ?></option>
                            <option value="tagged" <?php echo ($get_by=='tagged' ? 'selected' : '') ;?>><?php esc_html_e('Tagged ','fat-cmb'); ?></option>
                        </select>
                    </div>

                    <div class="instagram-tag-filter" style="display: <?php echo ($get_by=='tagged' ? 'block' : 'none') ;?>">
                        <label><?php esc_html_e('Tag name:','fat-cmb'); ?></label>
                        <input type="text" name="<?php echo esc_attr($this->id) ?>[tag_name]" id="<?php echo esc_attr($this->id) ?>[tag_name]"
                         value="<?php echo esc_attr($tag_name); ?>"
                        />
                    </div>

                    <div class="instagram-user-filter" style="display: <?php echo ($get_by=='user' ? 'block' : 'none') ;?>">
                        <label><?php esc_html_e('User Id:','fat-cmb'); ?></label>
                        <input type="number" name="<?php echo esc_attr($this->id) ?>[user_id]" id="<?php echo esc_attr($this->id) ?>[user_id]"
                               value="<?php echo esc_attr($user_id); ?>"
                        />

                    </div>

                    <div class="instagram-limit-filter">
                        <label><?php esc_html_e('Limit (empty for get all):','fat-cmb'); ?></label>
                        <input type="number" name="<?php echo esc_attr($this->id) ?>[limit]" id="<?php echo esc_attr($this->id) ?>[limit]"
                               value="<?php echo esc_attr($limit); ?>"
                        />

                    </div>

                    <div class="instagram-sort-by">
                        <label><?php esc_html_e('Sort by:','fat-cmb'); ?></label>
                        <select name="<?php echo esc_attr($this->id) ?>[sort_by]" id="<?php echo esc_attr($this->id) ?>[sort_by]" >
                            <option value="none" <?php echo ($sort_by=='none' ? 'selected' : '') ;?>><?php esc_html_e('None','fat-cmb'); ?></option>
                            <option value="most-recent" <?php echo ($sort_by=='most-recent' ? 'selected' : '') ;?>><?php esc_html_e('Newest to oldest','fat-cmb'); ?></option>
                            <option value="least-recent" <?php echo ($sort_by=='least-recent' ? 'selected' : '') ;?>><?php esc_html_e('Oldest to newest','fat-cmb'); ?></option>
                            <option value="most-liked" <?php echo ($sort_by=='most-liked' ? 'selected' : '') ;?>><?php esc_html_e('Highest # of likes to lowest','fat-cmb'); ?></option>
                            <option value="least-liked" <?php echo ($sort_by=='least-liked' ? 'selected' : '') ;?>><?php esc_html_e('Lowest # likes to highest','fat-cmb'); ?></option>
                            <option value="most-commented" <?php echo ($sort_by=='most-commented' ? 'selected' : '') ;?>><?php esc_html_e('Highest # of comments to lowest','fat-cmb'); ?></option>
                            <option value="least-commented" <?php echo ($sort_by=='least-commented' ? 'selected' : '') ;?>><?php esc_html_e('Lowest # of comments to highest','fat-cmb'); ?></option>
                            <option value="random" <?php echo ($get_by=='random' ? 'selected' : '') ;?>><?php esc_html_e('Random order','fat-cmb'); ?></option>
                        </select>
                    </div>

                    <div class="instagram-image-click-action">
                        <label><?php esc_html_e('Image click action:','fat-cmb'); ?></label>
                        <select name="<?php echo esc_attr($this->id) ?>[image_click_action]" id="<?php echo esc_attr($this->id) ?>[image_click_action]">
                            <option value="open_new_window" <?php echo ($image_click_action=='open_new_window' ? 'selected' : '') ;?> ><?php esc_html_e('Open instagram post in new window','fat-cmb'); ?></option>
                            <option value="open_same_window" <?php echo ($image_click_action=='open_same_window' ? 'selected' : '') ;?>><?php esc_html_e('Open instagram post in same window ','fat-cmb'); ?></option>
                            <option value="open_popup_image" <?php echo ($image_click_action=='open_popup_image' ? 'selected' : '') ;?>><?php esc_html_e('Open popup image ','fat-cmb'); ?></option>
                        </select>
                    </div>

                    <div class="instagram-button social-button">
                        <span class="fat-cmb-description"><?php esc_html_e('Please click "Get image" button after input filter to get image from instagram','fat-cmb'); ?></span>
                        <span class="fat-cmb-loading">
                            <i class="dashicons dashicons-update fat-cmb-spin"></i>
                        </span>
                        <a href="javascript:" class="button"><?php esc_html_e('Get image','fat-cmb'); ?> </a>
                    </div>

                </div>

                <div class="fat-cmb-instagram-title fat-cmb-social-title"><?php esc_html_e('Instagram images','fat-cmb'); ?></div>
                <div class="fat-cmb-instagram-list fat-cmb-social-list" id="fat_cmb_instagram_<?php echo esc_attr($this->id) ?>">

                </div>
                <?php if (isset($this->description) && $this->description != ''): ?>
                    <span class="fat-cmb-description"><?php echo esc_html($this->description); ?> </span>
                <?php endif; ?>
            </div>
        </div>
    <?php }
}
