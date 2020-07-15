<?php
/**
 * Created by PhpStorm.
 * User: roninwp
 * Date: 4/20/2017
 * Time: 10:26 AM
 */
$page_id = isset($_GET['page']) ? $_GET['page'] : '';
if (isset($this->page_options[$page_id]) && isset($this->page_options[$page_id]['screen_default'])) {
    $page_id = $this->page_options[$page_id]['screen_default'];
    $url = get_admin_url() . 'admin.php?page=' . $page_id;
    ?>
    <script type="text/javascript">
        window.location.href = '<?php echo esc_url($url); ?>';
    </script>
    <?php
    exit;
}
$page_option = isset($this->page_options[$page_id]) ? $this->page_options[$page_id] : array();

$tabs = isset($page_option['tabs']) ? $page_option['tabs'] : array();
$page_fields = isset($page_option['fields']) ? $page_option['fields'] : array();
$tab_id_active = isset($_POST['fat_cmb_active_tab']) ? $_POST['fat_cmb_active_tab'] : '';

if (isset($_POST['action']) && ($_POST['action'] == 'save' || $_POST['action'] == 'reset-all' || $_POST['action'] == 'reset-section')) {
    $post_options_page = apply_filters('fat_cmb_register_option_page', array());
    $repeat_field_id = '';

    $allowed = array(
        'a' => array( // on allow a tags
            'href' => array() // and those anchors can only have href attribute
        )
    );

    foreach ($post_options_page as $post_option) {
        $fat_cmb_section_value = $repeat_fields = array();
        $message = '';
        $field_value = '';
        $options_default = array();

        if (!isset($post_option['page_id'])) {
            break;
        }
        $db_options_page = get_option($post_option['page_id'], array());
        if (count($db_options_page) > 0) {
            $fat_cmb_section_value = $db_options_page;
        }

        if ($_POST['action'] === 'reset-all' || $_POST['action'] === 'reset-section') {
            foreach ($post_option['fields'] as $opt_field) {
                if ($opt_field['type'] !== 'section') {
                    $options_default[$opt_field['id']] = array(
                        'tab_id' => isset($opt_field['tab_id']) ? $opt_field['tab_id'] : '',
                        'id'     => $opt_field['id'],
                        'std'    => isset($opt_field['std']) ? $opt_field['std'] : '',
                        'fields' => isset($opt_field['fields']) ? $opt_field['fields'] : ''
                    );
                }
            }
        }

        if ($post_option['page_id'] == $_POST['fat_cmb_option_page_id']) {
            foreach ($post_option['fields'] as $field) {
                switch ($field['type']) {
                    case 'repeat':
                        $repeat_fields = $field['fields'];
                        foreach ($repeat_fields as $repeat_field) {
                            $repeat_field_id = $field['id'] . '_' . $repeat_field['id'];
                            if (isset($_POST[$repeat_field_id])) {
                                $field_value = $_POST[$repeat_field_id];

                                if ($_POST['action'] === 'reset-section') {
                                    if (isset($options_default[$field['id']]) && $options_default[$field['id']]['tab_id'] === $tab_id_active) {
                                        foreach($options_default[$field['id']]['fields'] as $rpt_field){
                                            if($rpt_field['id'] === $repeat_field['id']){
                                                $field_value = $rpt_field;
                                                break;
                                            }
                                        }
                                        //only change for this section
                                        $fat_cmb_section_value[$field['id']][$repeat_field['id']] = array($field_value['std']);
                                    }
                                } else {
                                    if ($_POST['action'] === 'reset-all') {
                                        if (isset($options_default[$field['id']])) {
                                            foreach($options_default[$field['id']]['fields'] as $rpt_field){
                                                $field_value = $rpt_field['std'];
                                            }
                                        }
                                    }
                                    $fat_cmb_section_value[$field['id']][$repeat_field['id']] = $field_value;
                                }
                            }
                        }
                        break;
                    default:
                        $field_value = isset($_POST[$field['id']]) ? $_POST[$field['id']] : '';

                        if ($_POST['action'] === 'reset-section') {
                            if (isset($options_default[$field['id']]) && $options_default[$field['id']]['tab_id'] === $tab_id_active) {
                                $field_value = $options_default[$field['id']]['std'];
                                //only change for this section
                                if ($field['type'] !== 'check' && $field['type'] !== 'ace' ) {
                                    $fat_cmb_section_value[$field['id']] = wp_kses($field_value, $allowed);
                                } else {
                                    $fat_cmb_section_value[$field['id']] = $field_value;
                                }
                            }
                        } else {
                            if ($_POST['action'] === 'reset-all') {
                                if (isset($options_default[$field['id']])) {
                                    $field_value = $options_default[$field['id']]['std'];
                                }
                            }

                            if ($field['type'] != 'check' && $field['type'] !== 'ace' ) {
                                $fat_cmb_section_value[$field['id']] = wp_kses($field_value, $allowed);
                            } else {
                                $fat_cmb_section_value[$field['id']] = $field_value;
                            }
                        }
                        break;
                }
            }
            if ($_POST['action'] == 'save') {
                $message = esc_html__("Options has been saved", "fat-cmb");
            }
            if ($_POST['action'] == 'reset-all') {
                $message = esc_html__("Options has been reset", "fat-cmb");
            }
            if ($_POST['action'] == 'reset-section') {
                $message = esc_html__("Section has been reset", "fat-cmb");
            }

            update_option($post_option['page_id'], $fat_cmb_section_value, true);
            do_action('fat-cmb-after-update-' . $post_option['page_id'], $fat_cmb_section_value);
            echo "<div class='fat-cmb-notice notice notice-success is-dismissible'><p>" . $message . "</p></div>";
        }
    }
}
$tab_type = isset($tabs['tab_type']) ? $tabs['tab_type'] : 'horizontal';
?>
<div class="wrap fat-cmb-option-page-container">
    <h4 class="fat-cmb-page-title"><?php echo(isset($page_option['page_title']) ? esc_html($page_option['page_title']) : ''); ?></h4>
    <div class="fat-cmb-form-container">
        <form name="frmFatCmbOptionPage" id="frmFatCmbOptionPage" method="post" novalidate
              data-tab-type="<?php echo esc_attr($tab_type); ?>">
            <?php if (isset($tabs['tab']) && count($tabs['tab']) > 0):
                $tab_icon = $tab_title = '';
                $tab_class = 'fat-cmb-tab-settings-nav fat-tab-' . $tab_type;

                if (isset($tabs['tab_width']) && $tabs['tab_width'] == 'equal') {
                    $tab_class .= ' fat-tab-width-equal';
                }
                ?>
                <ul class="<?php echo esc_attr($tab_class); ?>">
                    <?php foreach ($tabs['tab'] as $tab) {
                        $tab_icon = isset($tab['icon']) ? $tab['icon'] : '';
                        $tab_title = isset($tab['title']) ? $tab['title'] : 'Tab title';
                        $tab_id_active = $tab_id_active === '' && $tab['id'] ? $tab['id'] : $tab_id_active;

                        ?>
                        <li class="<?php echo($tab_id_active === $tab['id'] ? 'active' : ''); ?>">
                            <a href="javascript:"
                               data-tab="<?php echo esc_attr($tab['id']); ?>">
                                <i class="<?php echo esc_attr($tab_icon); ?>"></i>
                                <span><?php echo esc_html($tab_title); ?></span>
                            </a>
                        </li>
                    <?php }; ?>
                </ul>
                <div class="fat-cmb-page-fields">

                    <div class="fat-cmb-button-groups fat-top-button-groups">
                        <input class="button fat-cmb-save button-large button-primary" type="submit" value="Save">
                        <input class="button fat-cmb-reset-section button-large button-primary" type="button"
                               value="Reset Section">
                        <input class="button fat-cmb-reset-all button-large button-primary" type="button"
                               value="Reset All">
                    </div>

                    <?php if (isset($tabs['tab']) && count($tabs['tab']) > 0):
                        $meta_box_id = $page_option['page_id'];
                        global $fat_cmb_post_meta;
                        $fat_cmb_post_meta = array();
                        $fat_cmb_post_meta[$page_option['page_id']] = array();
                        $fat_cmb_post_meta[$page_option['page_id']][] = serialize(get_option($page_option['page_id'], array()));

                        foreach ($tabs['tab'] as $tab) { ?>
                            <div class="fat-tab-setting <?php echo($tab_id_active === $tab['id'] ? 'active' : ''); ?>"
                                 id="<?php echo esc_attr($tab['id']); ?>">
                                <?php
                                $fields = array();
                                foreach ($page_fields as $field) {
                                    if (isset($field['tab_id']) && $field['tab_id'] == $tab['id']) {
                                        $fields[] = $field;
                                    }
                                }
                                    $template = FAT_CMB_DIR_PATH . 'templates/init-field.php';
                                if (file_exists($template)) {
                                    include $template;
                                }
                                ?>

                            </div>
                        <?php } ?>
                    <?php endif; ?>

                    <div class="fat-cmb-button-groups">
                        <input name="action" type="hidden" value="save">
                        <input name="fat_cmb_active_tab" id="fat_cmb_active_tab" type="text" style="display: none"
                               value="<?php echo esc_attr($tab_id_active); ?>">
                        <input name="fat_cmb_option_page_id" type="hidden"
                               value="<?php echo esc_attr($page_option['page_id']); ?>">
                        <input class="button fat-cmb-save button-large button-primary" type="submit" value="Save">
                        <input class="button fat-cmb-reset-section button-large button-primary" type="button"
                               value="Reset Section">
                        <input class="button fat-cmb-reset-all button-large button-primary" type="button"
                               value="Reset All">
                    </div>
                </div>
            <?php endif; ?>
        </form>

    </div>
</div>
