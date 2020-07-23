<?php
/*
 * ALTER
 * @author   AcmeeDesign
 * @url     http://acmeedesign.com
*/

defined('ABSPATH') || die;

if (!class_exists('ALTERADMINMENU')) {

    class ALTERADMINMENU extends ALTER
    {
        function __construct()
        {
            $this->aof_options = parent::alter_get_option_data(ALTER_OPTIONS_SLUG);
            add_action('admin_init', array($this, 'initialize_default_menu'), 9);
            add_action('admin_menu', array($this, 'add_admin_menu_management_menu'));
            add_action('admin_init', array($this, 'alter_customize_menu'), 999);
            add_action( 'admin_enqueue_scripts', array($this, 'load_menu_assets'), 999 );
            add_action('plugins_loaded', array($this, 'save_menu_data'));
            if(empty($this->aof_options['disable_menu_customize']) && $this->aof_options['disable_menu_customize'] != 1) {
              add_filter('custom_menu_order', array($this, 'alter_reorder_menu'), 999);
              add_filter('menu_order', array($this, 'alter_reorder_menu'), 999);
            }
            add_action('admin_head', array($this, 'alterMenucss'), 998);
        }

        function initialize_default_menu(){
            global $menu, $submenu;
            $this->wp_df_menu = $menu;
            $this->wp_df_submenu = $submenu;
        }

        function alter_menu_data() {
           if (isset($this->aof_options['custom_admin_menu']) && !empty($this->aof_options['custom_admin_menu'])) {
               return $this->aof_options['custom_admin_menu'];
           }
           else
               return null;;
        }

        function add_admin_menu_management_menu()
        {
            add_submenu_page( ALTER_MENU_SLUG , __('Manage Admin menu', 'alter'), __('Manage Admin menu', 'alter'), 'manage_options', 'admin_menu_management', array($this, 'alter_admin_menu_management') );
        }

        function load_menu_assets($nowpage)
        {
          if(!empty($this->aof_options['disable_menu_customize']) && $this->aof_options['disable_menu_customize'] == 1)
              return;
            wp_enqueue_style( 'dashicons' );
            wp_enqueue_style('font-awesome', ALTER_DIR_URI . 'assets/font-awesome/css/font-awesome.min.css', '', ALTER_VERSION);
            if($nowpage == 'alter_page_admin_menu_management') {
                wp_enqueue_script( 'jquery-ui-sortable' );
                wp_enqueue_script( 'alter-sortable', ALTER_DIR_URI . 'assets/js/sortjs.js', array( 'jquery' ), '', true );
                wp_enqueue_style( 'iconPicker-css', ALTER_DIR_URI . 'assets/icon-picker/css/icon-picker.css', '', ALTER_VERSION );
                wp_enqueue_script( 'iconPicker-js', ALTER_DIR_URI . 'assets/icon-picker/js/icon-picker.js', array( 'jquery' ), '', true );
            }
        }

        function predict_menu_name($menu_slug, $strlen=250, $like = false, $likeword = '') {
          if(false === $like) {
            return substr($menu_slug, 0, $strlen);
          }
          else {
            if(strpos($menu_slug, $likeword) !== false) {
              return true;
            }
            else return false;
          }
        }

        function save_menu_data() {
            if(isset($_POST['alter_menu_order'])) {
                $custom_menu_data = array();
                $custom_menu_data['custom_admin_menu'] = array( 'top_level_menu' => $_POST['top_lvl_menu'], 'sub_level_menu' => $_POST['sub_lvl_menu']); //echo '<pre>'; print_r($custom_menu_data['custom_admin_menu']); echo '</pre>'; exit();
                $saved_data = parent::alter_get_option_data(ALTER_OPTIONS_SLUG);
                $data = array_merge($saved_data, $custom_menu_data);
                parent::updateOption(ALTER_OPTIONS_SLUG, $data);
                wp_safe_redirect( admin_url( 'admin.php?page=admin_menu_management&status=updated' ) );
                exit();
            }
        }

        function alter_admin_menu_management()
        {
          if(!empty($this->aof_options['disable_menu_customize']) && $this->aof_options['disable_menu_customize'] == 1) {
            echo '<div style="background:#ff3131;color:#ffffff;padding:25px;margin:25px 15px;">Alter menu customization is disabled. To enable menu customization ';
            echo '<a style="color:#262d25" href="' . admin_url() . 'admin.php?page='. ALTER_MENU_SLUG .'"><strong>';
            echo __('Click here ', 'alter');
            echo '</strong></a></div>';
              return;
          }
            ?>
            <div class="wrap alter-wrap">
                <h2><?php _e('Manage Admin Menu', 'alter'); ?></h2>
                <div id="message" class="updated below-h2"><p>
                <?php _e('By default, all menu items will be shown to administrator users. ', 'alter');
                echo '<a href="' . admin_url() . 'admin.php?page='. ALTER_MENU_SLUG .'"><strong>';
                echo __('Click here ', 'alter');
                echo '</strong></a>';
                echo __('to customize who can access to all menu items.', 'alter');
                ?>
                </p></div>
                <div class="manage_admin_menu_sorter">
                <form name="alter_manage_admin_menu" method="post">

                    <ol class="sortable sortUls" id="admin_menu_sortable">
                    <?php
                    global $menu;

                    $alter_toplv_menu_data = (isset($this->aof_options['custom_admin_menu']['top_level_menu']) && !empty($this->aof_options['custom_admin_menu']['top_level_menu'])) ? $this->aof_options['custom_admin_menu']['top_level_menu'] : "";
                    $alter_sublv_menu_data = (isset($this->aof_options['custom_admin_menu']['sub_level_menu']) && !empty($this->aof_options['custom_admin_menu']['sub_level_menu'])) ? $this->aof_options['custom_admin_menu']['sub_level_menu'] : "";
                    $mm_cu = 0;
                    $inm = 0;

                    foreach($this->wp_df_menu as $menu_key => $top_lv_menu) {
                      $inm++;
                      $top_lv_menu_slug = parent::alter_clean_slug($top_lv_menu[2]);
                      $menu_icon_class = (isset($alter_toplv_menu_data[$top_lv_menu_slug]['menu_icon']) && !empty($alter_toplv_menu_data[$top_lv_menu_slug]['menu_icon'])) ? parent::alter_get_icon_class($alter_toplv_menu_data[$top_lv_menu_slug]['menu_icon']) : "";
                      ?>
                        <li>
                            <?php
                              $menu_title = ((!empty($top_lv_menu[0]))) ? parent::clean_title($top_lv_menu[0]) : "Separator";
                              ?>
                            <div class="alter-sort-list alter-top-menu-<?php echo $menu_key; ?>">
                                <span class="menu_title">
                                    <i class="fa fa-caret-down" aria-hidden="true"></i><i class="fa fa-caret-up" aria-hidden="true"></i>
                                 <?php echo wp_kses($menu_title, array()); ?>
                                </span>
                                <a href="#" class="alter-edit-expand"><i class="fa fa-chevron-down" aria-hidden="true"></i> <span>Edit</span></a>
                                <div class="alter-menu-contents">
                                    <input type="hidden" name="top_lvl_menu[<?php echo $top_lv_menu_slug; ?>][menu_slug]" value="<?php echo $top_lv_menu[2]; ?>" />
                                <?php if(!empty($top_lv_menu[0])) { ?>
                                    <div class="menu_title">
                                        <label for="menu_title"><em><?php _e('Rename Title', 'alter'); ?></em></label>
                                        <input type="text" name="top_lvl_menu[<?php echo $top_lv_menu_slug; ?>][menu_title]" value="<?php if(isset($alter_toplv_menu_data[$top_lv_menu_slug]['menu_title'])) echo $alter_toplv_menu_data[$top_lv_menu_slug]['menu_title']; ?>" />
                                    </div>
                                    <div class="menu_icon">
                                        <label for="icon_picker"><em><?php _e('Choose Icon', 'alter'); ?></em></label>
                                        <div id="" data-target="#menu-icon-for-<?php echo $mm_cu; ?>" class="icon-picker <?php echo $menu_icon_class; ?>"></div>
                                        <input type="hidden" id="menu-icon-for-<?php echo $mm_cu; ?>" name="top_lvl_menu[<?php echo $top_lv_menu_slug; ?>][menu_icon]" value="<?php if(!empty($alter_toplv_menu_data[$top_lv_menu_slug]['menu_icon'])) echo $alter_toplv_menu_data[$top_lv_menu_slug]['menu_icon']; ?>" />
                                    </div>
                                <?php } ?>
                                    <?php echo self::hide_for_menu("top_lvl_menu", $top_lv_menu_slug, $inm); ?>


                            <?php
                            if(isset($this->wp_df_submenu[$top_lv_menu[2]]) && !empty($this->wp_df_submenu[$top_lv_menu[2]])) {
                                ?>
                            <ol class="menu_child_<?php echo $menu_key; ?>">
                            <?php
                                $sm_cu = 0;
                                foreach ($this->wp_df_submenu[$top_lv_menu[2]] as $sub_menu_k => $sub_menu_v) {
                                    $inm++;
                                    $sub_lv_menu_slug = parent::alter_clean_slug($sub_menu_v[2]);
                                    if($this->predict_menu_name($sub_lv_menu_slug, '', true, 'custombackground') == true || $this->predict_menu_name($sub_lv_menu_slug, '', true, 'customheader') == true) {
                                      continue;
                                    }
                                    elseif($this->predict_menu_name($sub_lv_menu_slug, 12) == 'customizephp') {
                                      if($this->predict_menu_name($sub_lv_menu_slug, '', true, 'background') == true || $this->predict_menu_name($sub_lv_menu_slug, '', true, 'header') == true)
                                        continue;
                                      $sub_lv_menu_name = 'customizephp';
                                      $sub_lv_menu_value = 'customize.php';
                                    }
                                    else {
                                      $sub_lv_menu_name = $sub_lv_menu_slug;
                                      $sub_lv_menu_value = $sub_menu_v[2];
                                    }
                             ?>
                                <li>
                                    <div class="alter-sort-list submenu_contents">
                                        <span class="menu_title"><?php echo parent::clean_title($sub_menu_v[0]); ?></span>
                                        <a href="#" class="alter-edit-expand"><i class="fa fa-chevron-down" aria-hidden="true"></i> <span><?php esc_html_e('Edit', 'alter'); ?></span></a>
                                        <div class="alter-menu-contents">
                                          <?php

                                          ?>
                                            <input type="hidden" name="sub_lvl_menu[<?php echo $sub_lv_menu_name; ?>][menu_slug]" value="<?php echo $sub_lv_menu_value; ?>" />
                                            <div class="menu_title">
                                                <label for="menu_title"><em><?php _e('Rename Title', 'alter'); ?></em></label>
                                                <input type="text" name="sub_lvl_menu[<?php echo $sub_lv_menu_slug; ?>][menu_title]" value="<?php if(isset($alter_sublv_menu_data[$sub_lv_menu_slug]['menu_title'])) echo $alter_sublv_menu_data[$sub_lv_menu_slug]['menu_title']; ?>" />
                                            </div>
                                            <a href="#" class="alter-edit-expand"><i class="fa fa-chevron-down" aria-hidden="true"></i> <span>Edit</span></a>
                                            <?php echo self::hide_for_menu("sub_lvl_menu", $sub_lv_menu_slug, $inm); ?>
                                        </div>
                                    </div>
                                </li>
                            <?php
                            $sm_cu++;
                                } //foreach
                             ?>
                            </ol>

                        <?php } ?>

                                    </div>
                            </div>

                        </li>
                        <?php
                        $mm_cu++;
                    }
                    ?>
                    </ol>
                    <input type="hidden" name="alter_menu_order" value="" />
                    <input type="submit" class="button button-primary button-large" value="<?php esc_html_e('Save Changes', 'alter'); ?>" />
                </form>
                </div>
            </div>

<?php
        }

        function hide_for_menu($level, $admin_menu_slug, $menu_count) {
            $level_name = (empty($level)) ? "top_lvl_menu" : $level;

            $alter_menu_data = $this->alter_menu_data();

            $output = '<div class="hide-for-roles">' .
                '<label class="hide-for-roles" for="hide-for-roles"><em>' . __('Hide menu for', 'alter') . '</em></label>';
                $get_all_roles = parent::alter_get_wproles();

                if(!empty($get_all_roles) && is_array($get_all_roles)) {
                    $role_nm = 0;
                    $role_max_nm = count($get_all_roles);
                    if($this->predict_menu_name($admin_menu_slug, 12) == 'customizephp') {
                      $admin_menu_slug = 'customizephp';
                    }
                    $output .= "<table id='box-input-{$menu_count}' class='hide-for-roles-inputs'><tbody>";
                    $output .= "<tr><td style='width:200px;display:block'><a class='alter-role-selector select_all' rel='box-input-{$menu_count}' href='#select_all'>Select all</a>
                    <a class='alter-role-selector select_none' rel='box-input-{$menu_count}' href='#select_none'>Select none</a></td></tr>";
                    $output .= "<tr>";
                    foreach ($get_all_roles as $wprole_name => $wprole_label) {
                        if($level_name == "top_lvl_menu") {
                            $chk_value_array = (isset($alter_menu_data['top_level_menu'][$admin_menu_slug]['hide_for'])) ? $alter_menu_data['top_level_menu'][$admin_menu_slug]['hide_for'] : "";
                        }
                        elseif($level_name == "sub_lvl_menu") {
                            $chk_value_array = (isset($alter_menu_data['sub_level_menu'][$admin_menu_slug]['hide_for'])) ? $alter_menu_data['sub_level_menu'][$admin_menu_slug]['hide_for'] : "";
                        }
                        $chk_value = (!empty($chk_value_array) && array_key_exists($wprole_name, $chk_value_array)) ? "checked=checked" : "";
                        if($role_nm !=0 && $role_nm % 4 == 0) {
                            $output .= "</tr><tr>";
                        }

                        $output .= '<td>';
                        $output .= '<input class="alter-inputs" type="checkbox" name="' . $level_name . '[' . $admin_menu_slug .  '][hide_for][' . $wprole_name .  ']" value="1"' . $chk_value . ' />
                        <span>' . $wprole_label . '</span>';
                        $output .= '</td>';

                        if($role_nm == $role_max_nm) {
                            $output .= '</tr>';
                        }
                        $role_nm++;
                    }
                    $output .= '</tbody></table>';
                }
                //print_r($get_all_roles);

            $output .= '</div>';

            return $output;

        }

        function alter_reorder_menu($menu_ord) {
          if(!empty($this->aof_options['disable_menu_customize']) && $this->aof_options['disable_menu_customize'] == 1)
              return;

          if(isset($this->aof_options['custom_admin_menu']) && !empty($this->aof_options['custom_admin_menu'])) {
              if (!$menu_ord) return true;
              $alter_admin_menu = $this->aof_options['custom_admin_menu']['top_level_menu'];
              $alter_menu_order = array();
              foreach ( $alter_admin_menu as $alter_menu_value) {
                  $alter_menu_order[] =$alter_menu_value['menu_slug'];
              }
              return $alter_menu_order;
          }
          else {
              return array(
                  'index.php',
                  'separator1',
              );
          }
        }

        function alter_reorder_menu_key() {
            if(isset($this->aof_options['custom_admin_menu']) && !empty($this->aof_options['custom_admin_menu'])) {
                $alter_admin_menu = $this->aof_options['custom_admin_menu']['top_level_menu'];
                $alter_menu_order = array();
                foreach ( $alter_admin_menu as $alter_menu_value) {
                    $alter_menu_order[$alter_menu_value['menu_slug']] = $alter_menu_value['menu_slug'];
                }
                return $alter_menu_order;
            }
            else
                return false;
        }

        function alter_customize_menu() {

          if(!empty($this->aof_options['disable_menu_customize']) && $this->aof_options['disable_menu_customize'] == 1)
              return;

          if(!isset($this->aof_options['custom_admin_menu']))
              return;

          global $menu, $submenu;

          //echo '<pre>'; print_r($submenu); echo '</pre>';

          $current_user_role = parent::alter_get_user_role();
          $current_user_id = get_current_user_id();
          $alter_menu_access = $this->aof_options['show_all_menu_to_admin'];
          $alter_privilege_users = (!empty($this->aof_options['privilege_users'])) ? $this->aof_options['privilege_users'] : "";
          $alter_toplv_menu_data = (!empty($this->aof_options['custom_admin_menu']['top_level_menu'])) ? $this->aof_options['custom_admin_menu']['top_level_menu'] : "";
          $alter_sublv_menu_data = (!empty($this->aof_options['custom_admin_menu']['sub_level_menu'])) ? $this->aof_options['custom_admin_menu']['sub_level_menu'] : "";

          if(isset($menu) && !empty($menu)){
              foreach ($menu as $menu_key => &$menu_value) {
                  $top_level_menu_slug = parent::alter_clean_slug($menu_value[2]);
                  $hide_for_roles_for_top = isset($this->aof_options['custom_admin_menu']['top_level_menu'][$top_level_menu_slug]['hide_for']) ?
                          $this->aof_options['custom_admin_menu']['top_level_menu'][$top_level_menu_slug]['hide_for'] : "";
                  $menu_icon_class = (isset($alter_toplv_menu_data[$top_level_menu_slug]['menu_icon']) && !empty($alter_toplv_menu_data[$top_level_menu_slug]['menu_icon'])) ? parent::alter_get_icon_class($alter_toplv_menu_data[$top_level_menu_slug]['menu_icon']) : "";

                  //customize top level menu
                  //if($menu_value[4] != 'wp-menu-separator' && !preg_match("/separator/i",$menu_value[4])) {
                    //if(isset($menu_value[5]) && $menu_value[5] != "toplevel_page_jetpack") { //if list ID removed, jetpack v4.3.2 or higher could not load its settings using list ID
                      //$menu_value[5] = ""; //removing list ID in order to override icons set by other plugins
                    //}

                    if(is_super_admin($current_user_id)) {
                        if(!empty($alter_menu_access) && $alter_menu_access == 2 && !empty($alter_privilege_users) && !in_array($current_user_id, $alter_privilege_users)
                        && !empty($hide_for_roles_for_top) && is_array($hide_for_roles_for_top) && array_key_exists($current_user_role, $hide_for_roles_for_top))
                            unset($menu[$menu_key]);
                    }
                    // elseif(is_multisite() && !is_super_admin()) {
                    //     if(!empty($hide_for_roles_for_top) && is_array($hide_for_roles_for_top) && array_key_exists($current_user_role, $hide_for_roles_for_top)) {
                    //         unset($menu[$menu_key]);
                    //     }
                    // }
                    else {
                        if(!empty($hide_for_roles_for_top) && is_array($hide_for_roles_for_top) && array_key_exists($current_user_role, $hide_for_roles_for_top)) {
                            unset($menu[$menu_key]);
                        }
                    }

                    //temporory fix for remove vc menu
                    if($top_level_menu_slug == "vcwelcome") { //if top menu slug is vcwelcome, definitely it's not an admin user
                      $if_vc_general_hidden = isset($this->aof_options['custom_admin_menu']['top_level_menu']['vcgeneral']['hide_for']) ?
                          $this->aof_options['custom_admin_menu']['top_level_menu']['vcgeneral']['hide_for'] : "";
                          if(!empty($if_vc_general_hidden) && is_array($if_vc_general_hidden) && array_key_exists($current_user_role, $if_vc_general_hidden)) {
                            unset($menu[$menu_key]);
                          }

                    }

                    //temporory fix for remove profile.php
                    if($top_level_menu_slug == "profilephp") { //if top menu slug is profilephp, definitely it's not an admin user
                      $if_profile_hidden = isset($this->aof_options['custom_admin_menu']['sub_level_menu']['profilephp']['hide_for']) ?
                          $this->aof_options['custom_admin_menu']['sub_level_menu']['profilephp']['hide_for'] : "";
                          if(!empty($if_profile_hidden) && is_array($if_profile_hidden) && array_key_exists($current_user_role, $if_profile_hidden)) {
                            unset($menu[$menu_key]);
                          }

                    }

                    if(isset($alter_toplv_menu_data[$top_level_menu_slug]['menu_title']) && !empty($alter_toplv_menu_data[$top_level_menu_slug]['menu_title'])) {
                        $menu_value[0] = trim($alter_toplv_menu_data[$top_level_menu_slug]['menu_title']);
                    }

                    if(!empty($menu_icon_class)) {
                        $menu_value[4] = str_replace('menu-icon-', 'alter-menu-icon-', $menu_value[4]);
                        $menu_value[4] = str_replace('toplevel_page', 'alter-icon-selected alter-toplevel_page', $menu_value[4]);
                        $iconType = explode(" ", $menu_icon_class);
                        if($iconType[1] != "dashicons-blank") {
                            if($iconType[0] == "dashicons") {
                                $menu_value[6] = trim($iconType[1]);
                            }
                            else {
                                $menu_value[6] = "dashicons-" . $iconType[1];
                            }
                        }
                    }

                    //customize sub level menu
                    if(isset($submenu[$menu_value[2]]) && !empty($alter_sublv_menu_data)){
                            foreach ($submenu[$menu_value[2]] as $submenu_key => &$submenu_val){ //echo '<pre>'; print_r($submenu_val); echo '</pre>';
                              if($this->predict_menu_name($submenu_val[2], 9) == 'customize') {
                                $sub_level_menu_slug = 'customizephp';
                              }
                              else {
                                $sub_level_menu_slug = parent::alter_clean_slug($submenu_val[2]); //set customize.php for customize menu here
                              }
                                $hide_for_roles_for_sub = isset($alter_sublv_menu_data[$sub_level_menu_slug]['hide_for']) ? $alter_sublv_menu_data[$sub_level_menu_slug]['hide_for'] : "";

                                    if(is_multisite() && !is_super_admin()) {
                                        if(!empty($hide_for_roles_for_sub) && is_array($hide_for_roles_for_sub) && array_key_exists($current_user_role, $hide_for_roles_for_sub)) {
                                            unset($submenu[$menu_value[2]][$submenu_key]);
                                        }
                                    }
                                    elseif(is_super_admin($current_user_id)) {
                                        if(!empty($alter_menu_access) && $alter_menu_access == 2 && !empty($alter_privilege_users) && !in_array($current_user_id, $alter_privilege_users)
                                        && !empty($hide_for_roles_for_sub) && is_array($hide_for_roles_for_sub) && array_key_exists($current_user_role, $hide_for_roles_for_sub)) {
                                          unset($submenu[$menu_value[2]][$submenu_key]);
                                        }
                                    }
                                    else {
                                        if(!empty($hide_for_roles_for_sub) && is_array($hide_for_roles_for_sub) && array_key_exists($current_user_role, $hide_for_roles_for_sub)) {
                                            unset($submenu[$menu_value[2]][$submenu_key]);
                                        }
                                    }

                                    if(isset($alter_sublv_menu_data[$sub_level_menu_slug]['menu_title']) && !empty($alter_sublv_menu_data[$sub_level_menu_slug]['menu_title'])) {
                                        $submenu_val[0] = trim($alter_sublv_menu_data[$sub_level_menu_slug]['menu_title']);
                                    }

                            }
                    }

                //  } //end if


                }
            }

        }

        function alter_fa_iconStyles(){
            if(class_exists('ALTERFAICONS')) {
                $alter_toplv_menu_data = (isset($this->aof_options['custom_admin_menu']['top_level_menu']) && !empty($this->aof_options['custom_admin_menu']['top_level_menu'])) ? $this->aof_options['custom_admin_menu']['top_level_menu'] : "";
                $faicons = new ALTERFAICONS();
                $faicons_data = $faicons->alter_fa_icons();
                $icon_styles = "";
                if(!empty($alter_toplv_menu_data)){
                        foreach($alter_toplv_menu_data as $menu_data){
                            if(isset($menu_data['menu_icon']) && !empty($menu_data['menu_icon'])) {
                                $get_icon_type = explode("|", $menu_data['menu_icon']);
                                if($get_icon_type[0] == "fa") {
                                    $icon_styles .= '#adminmenu li.menu-top .dashicons-' . $get_icon_type[1] . ':before {';
                                        $icon_styles .= 'font-family: "FontAwesome" !important; content: "' . $faicons_data[$get_icon_type[1]] . '" !important';
                                        $icon_styles .= '} ';
                                }
                            }

                        } //end of foreach
                }
                return $icon_styles;
            }
        }

        function alterMenucss() {
            ?>
        <style type="text/css">
            <?php
                if($this->alter_fa_iconStyles()) {
                    echo parent::alterCompress_css($this->alter_fa_iconStyles());
                }
            ?>
        </style>
<?php
        }

    }

}

new ALTERADMINMENU();
