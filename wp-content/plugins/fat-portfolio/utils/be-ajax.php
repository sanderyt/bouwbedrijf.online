<?php
/**
 * Created by PhpStorm.
 * User: roninwp
 * Date: 3/10/2017
 * Time: 4:21 PM
 */

if (!function_exists('fat_portfolio_shortcode_save_callback')) {
    function fat_portfolio_shortcode_save_callback()
    {
        $shortcode_config = isset($_POST['shortcode_config']) ? $_POST['shortcode_config'] : array();

        $fat_portfolio_shortcode = get_option(FAT_PORTFOLIO_SHORTCODE_OPTION_KEY, array());

        if (!isset($shortcode_config['id']) || $shortcode_config['id'] == '') {
            $shortcode = Fat_Portfolio_Base::get_shortcode_by_name(strtolower($shortcode_config['name']));
            if ($shortcode != null) {
                echo json_encode(array(
                    'code'    => -1,
                    'message' => esc_html__('The shortcode name already exist. Please input another shortcode name !', 'fat-portfolio')
                ));
                wp_die();
            }
            $shortcode_config['id'] = uniqid("sc");
        }

        $fat_portfolio_shortcode[$shortcode_config['id']] = array(
            'id'   => $shortcode_config['id'],
            'name' => $shortcode_config['name']
        );;

        update_option(FAT_PORTFOLIO_SHORTCODE_OPTION_KEY, $fat_portfolio_shortcode);

        update_option(FAT_PORTFOLIO_SHORTCODE_OPTION_KEY . '_' . $shortcode_config['id'], $shortcode_config, false);

        // set flag to flush rewrite rules
        update_option(FAT_PORTFOLIO_FLUSH_REWRITE_KEY, 1);

        echo json_encode(array(
            'id' => $shortcode_config['id'],
        ));

        wp_die();
    }

    add_action("wp_ajax_fat_portfolio_shortcode_save", 'fat_portfolio_shortcode_save_callback');
}

if(!function_exists('fat_portfolio_shortcode_delete_callback')){
    function fat_portfolio_shortcode_delete_callback()
    {
        $shortcode_id = $_POST['sc_id'];
        $shortcodes = get_option(FAT_PORTFOLIO_SHORTCODE_OPTION_KEY, array());
        unset($shortcodes[$shortcode_id]);
        update_option(FAT_PORTFOLIO_SHORTCODE_OPTION_KEY, $shortcodes);
        delete_option(FAT_PORTFOLIO_SHORTCODE_OPTION_KEY . '_' . $shortcode_id);

        $list_shortcode = array();
        foreach($shortcodes as $key => $value){
            $list_shortcode[] = $value;
        }
        echo json_encode($list_shortcode);
        wp_die();
    }
    add_action("wp_ajax_fat_portfolio_shortcode_delete", 'fat_portfolio_shortcode_delete_callback');
}

if(!function_exists('fat_portfolio_shortcode_get_info_callback')){
    function fat_portfolio_shortcode_get_info_callback()
    {
        $shortcode_id = $_POST['sc_id'];
        $shortcode =  get_option(FAT_PORTFOLIO_SHORTCODE_OPTION_KEY. '_' . $shortcode_id, array());
        if (isset($shortcode['id'])) {
            echo json_encode($shortcode);
        } else {
            echo json_encode(array(
                'code'    => -1,
                'message' => esc_html__('Cannot find shortcode information !', 'fat-portfolio')
            ));
        }
        wp_die();
    }
    add_action("wp_ajax_fat_portfolio_shortcode_get_info", 'fat_portfolio_shortcode_get_info_callback');
}


