<style type="text/css">
html, #wpwrap, #wp-content-editor-tools { background: <?php echo $this->aof_options['bg_color']; ?>; }
ul#adminmenu a.wp-has-current-submenu:after, ul#adminmenu>li.current>a.current:after { <?php if(is_rtl()) echo 'border-left-color: '; else echo 'border-right-color: '; echo $this->aof_options['bg_color']; ?>; }
/* Headings */
h1 { color: <?php echo $this->aof_options['h1_color']; ?>; }
h2 { color: <?php echo $this->aof_options['h2_color']; ?>; }
h3 { color: <?php echo $this->aof_options['h3_color']; ?>; }
h4 { color: <?php echo $this->aof_options['h4_color']; ?>; }
h5 { color: <?php echo $this->aof_options['h5_color']; ?>; }
/* Admin Bar */
<?php
if(empty($this->aof_options['default_adminbar_height'])) { ?>
  #wpadminbar {height:50px;}
  @media only screen and (max-width: 782px){
    #wpadminbar .quicklinks .ab-empty-item, #wpadminbar .quicklinks a, #wpadminbar .shortlink-input {
        height: 46px;
    }
  }
  @media only screen and (min-width:782px) {
    html.wp-toolbar {padding-top: 50px;}
    #wpadminbar .quicklinks>ul>li>a, div.ab-empty-item { padding: 9px !important }
  }
<?php
}
?>
<?php if(!empty($this->aof_options['admin_bar_shadow'])) { ?>
div#wpadminbar {
  box-shadow: 0 1px 3px 0 rgba(0,0,0,.3),0 1px 1px 0 rgba(0,0,0,.14),0px 3px 1px -1px rgba(0,0,0,.2);
  -webkit-box-shadow: 0 1px 3px 0 rgba(0,0,0,.3),0 1px 1px 0 rgba(0,0,0,.14),0px 3px 1px -1px rgba(0,0,0,.2);
  -moz-box-shadow: 0 1px 3px 0 rgba(0,0,0,.3),0 1px 1px 0 rgba(0,0,0,.14),0px 3px 1px -1px rgba(0,0,0,.2);
}
<?php } ?>
div#wpadminbar li#wp-admin-bar-alter_admin_title {
    <?php if(isset($this->aof_options['admin_bar_logo_bg_color'])) { ?>
    background-color: <?php echo $this->aof_options['admin_bar_logo_bg_color']; ?>;
    <?php } ?>
    <?php if(empty($this->aof_options['admin_bar_shadow']) && !empty($this->aof_options['admin_bar_logo_shadow'])) { ?>
      box-shadow: 0 1px 3px 0 rgba(0,0,0,.3),0 1px 1px 0 rgba(0,0,0,.14),0px 3px 1px -1px rgba(0,0,0,.2);
      -webkit-box-shadow: 0 1px 3px 0 rgba(0,0,0,.3),0 1px 1px 0 rgba(0,0,0,.14),0px 3px 1px -1px rgba(0,0,0,.2);
      -moz-box-shadow: 0 1px 3px 0 rgba(0,0,0,.3),0 1px 1px 0 rgba(0,0,0,.14),0px 3px 1px -1px rgba(0,0,0,.2);
    <?php } ?>
}
#wpadminbar, #wpadminbar .menupop .ab-sub-wrapper, .ab-sub-secondary, #wpadminbar .quicklinks .menupop ul.ab-sub-secondary, #wpadminbar .quicklinks .menupop ul.ab-sub-secondary .ab-submenu { background: <?php echo $this->aof_options['admin_bar_color']; ?>;}
#wpadminbar a.ab-item, #wpadminbar>#wp-toolbar span.ab-label, #wpadminbar>#wp-toolbar span.noticon, #wpadminbar .ab-icon:before, #wpadminbar .ab-item:before { color: <?php echo $this->aof_options['admin_bar_menu_color']; ?> }
#wpadminbar .quicklinks .menupop ul li a, #wpadminbar .quicklinks .menupop ul li a strong, #wpadminbar .quicklinks .menupop.hover ul li a, #wpadminbar.nojs .quicklinks .menupop:hover ul li a { color: <?php echo $this->aof_options['admin_bar_menu_color']; ?>; font-size:13px !important }

#wpadminbar .ab-top-menu>li.hover>.ab-item,#wpadminbar.nojq .quicklinks .ab-top-menu>li>.ab-item:focus,#wpadminbar:not(.mobile) .ab-top-menu>li:hover>.ab-item,#wpadminbar:not(.mobile) .ab-top-menu>li>.ab-item:focus{background:<?php echo $this->aof_options['admin_bar_menu_bg_hover_color']; ?>; color:<?php echo $this->aof_options['admin_bar_menu_hover_color']; ?>}
#wpadminbar:not(.mobile)>#wp-toolbar a:focus span.ab-label,#wpadminbar:not(.mobile)>#wp-toolbar li:hover span.ab-label,#wpadminbar>#wp-toolbar li.hover span.ab-label, #wpadminbar.mobile .quicklinks .hover .ab-icon:before,#wpadminbar.mobile .quicklinks .hover .ab-item:before, #wpadminbar .quicklinks .menupop .ab-sub-secondary>li .ab-item:focus a,#wpadminbar .quicklinks .menupop .ab-sub-secondary>li>a:hover, #wpadminbar #wp-admin-bar-user-info .display-name, #wpadminbar>#wp-toolbar>#wp-admin-bar-root-default li:hover span.ab-label  {color:<?php echo $this->aof_options['admin_bar_menu_hover_color']; ?>}
#wpadminbar .quicklinks .ab-sub-wrapper .menupop.hover>a,#wpadminbar .quicklinks .menupop ul li a:focus,#wpadminbar .quicklinks .menupop ul li a:focus strong,#wpadminbar .quicklinks .menupop ul li a:hover,#wpadminbar .quicklinks .menupop ul li a:hover strong,#wpadminbar .quicklinks .menupop.hover ul li a:focus,#wpadminbar .quicklinks .menupop.hover ul li a:hover,#wpadminbar li #adminbarsearch.adminbar-focused:before,#wpadminbar li .ab-item:focus:before,#wpadminbar li a:focus .ab-icon:before,#wpadminbar li.hover .ab-icon:before,#wpadminbar li.hover .ab-item:before,#wpadminbar li:hover #adminbarsearch:before,#wpadminbar li:hover .ab-icon:before,#wpadminbar li:hover .ab-item:before,#wpadminbar.nojs .quicklinks .menupop:hover ul li a:focus,#wpadminbar.nojs .quicklinks .menupop:hover ul li a:hover, #wpadminbar .quicklinks .ab-sub-wrapper .menupop.hover>a .blavatar,#wpadminbar .quicklinks li a:focus .blavatar,#wpadminbar .quicklinks li a:hover .blavatar{color:<?php echo $this->aof_options['admin_bar_menu_hover_color']; ?>}
#wpadminbar .menupop .ab-sub-wrapper, #wpadminbar .shortlink-input {background:<?php echo $this->aof_options['admin_bar_menu_bg_hover_color']; ?>;}

#wpadminbar .ab-submenu .ab-item, #wpadminbar .quicklinks .menupop ul.ab-submenu li a, #wpadminbar .quicklinks .menupop ul.ab-submenu li a.ab-item { color: <?php echo $this->aof_options['admin_bar_sbmenu_link_color']; ?>;}
#wpadminbar .ab-submenu .ab-item:hover, #wpadminbar .quicklinks .menupop ul.ab-submenu li a:hover, #wpadminbar .quicklinks .menupop ul.ab-submenu li a.ab-item:hover { color: <?php echo $this->aof_options['admin_bar_sbmenu_link_hover_color']; ?>;}

.quicklinks li.alter_admin_title a { <?php if($this->aof_options['logo_top_margin'] != 0) echo 'margin-top:-' . $this->aof_options['logo_top_margin'] . 'px !important;'; if($this->aof_options['logo_bottom_margin'] != 0) echo 'margin-top:' . $this->aof_options['logo_bottom_margin'] . 'px !important;'; ?>}
.quicklinks li.alter_admin_title a{ outline:none; border:none; }
<?php
if(!empty($this->aof_options['admin_external_logo_url']) && filter_var($this->aof_options['admin_external_logo_url'], FILTER_VALIDATE_URL)) {
  $adminbar_logo = esc_url( $this->aof_options['admin_external_logo_url']);
}
else {
  $adminbar_logo = (is_numeric($this->aof_options['admin_logo'])) ? $this->alter_get_image_url($this->aof_options['admin_logo']) : $this->aof_options['admin_logo'];
}

if(!empty($adminbar_logo)){
  $hor_position = (empty($this->aof_options['logo_position']) || $this->aof_options['logo_position'] == 1) ?
  "20px" : $this->aof_options['logo_position'];
  ?>
.quicklinks li.alter_admin_title a, .quicklinks li.alter_admin_title a:hover, .quicklinks li.alter_admin_title a:focus {
    background:url(<?php echo $adminbar_logo;  ?>) <?php echo $hor_position; ?> center no-repeat !important; text-indent:-9999px !important; width: auto;
    <?php if(!empty($this->aof_options['logo_autofit'])){ ?>
    background-size: contain!important;
    <?php } else { ?>
    background-size: auto!important;
      <?php } ?>
}
<?php } ?>

/* Buttons */
.wp-core-ui .button,.wp-core-ui .button-secondary{color:<?php echo $this->aof_options['sec_button_text_color']; ?>;background:<?php echo $this->aof_options['sec_button_color']; ?>;}
.wp-core-ui .button a {color:<?php echo $this->aof_options['sec_button_text_color']; ?>}
.wp-core-ui .button-secondary:focus, .wp-core-ui .button-secondary:hover, .wp-core-ui .button.focus, .wp-core-ui .button.hover, .wp-core-ui .button:focus, .wp-core-ui .button:hover { color:<?php echo $this->aof_options['sec_button_hover_text_color']; ?>;background:<?php echo $this->aof_options['sec_button_hover_color']; ?>;text-shadow: none;-webkit-box-shadow: none;moz-box-shadow: none;box-shadow: none;}
.wp-core-ui .button-primary, .wp-core-ui .button-primary-disabled, .wp-core-ui .button-primary.disabled, .wp-core-ui .button-primary:disabled, .wp-core-ui .button-primary[disabled] { background: <?php echo $this->aof_options['pry_button_color']; ?>;  color: <?php echo $this->aof_options['pry_button_text_color']; ?>;text-shadow: none;-webkit-box-shadow: none;moz-box-shadow: none;box-shadow: none;}
.wp-core-ui .button-primary a {color: <?php echo $this->aof_options['pry_button_text_color']; ?>}
.wp-core-ui .button-primary.focus, .wp-core-ui .button-primary.hover, .wp-core-ui .button-primary:focus, .wp-core-ui .button-primary:hover, .wp-core-ui .button-primary.active,.wp-core-ui .button-primary.active:focus,.wp-core-ui .button-primary.active:hover,.wp-core-ui .button-primary:active {background: <?php echo $this->aof_options['pry_button_hover_color']; ?> !important; color: <?php echo $this->aof_options['pry_button_hover_text_color']; ?> !important;text-shadow: none;-webkit-box-shadow: none;moz-box-shadow: none;box-shadow: none;}

<?php if($this->aof_options['design_type'] == 2) { ?>
.wp-core-ui .button,.wp-core-ui .button-secondary {border-color:<?php echo $this->aof_options['sec_button_border_color']; ?>;-webkit-box-shadow:inset 0 1px 0 <?php echo $this->aof_options['sec_button_shadow_color']; ?>,0 1px 0 rgba(0,0,0,.08);box-shadow:inset 0 1px 0 <?php echo $this->aof_options['sec_button_shadow_color']; ?>,0 1px 0 rgba(0,0,0,.08);}
.wp-core-ui .button-secondary:focus, .wp-core-ui .button-secondary:hover, .wp-core-ui .button.focus, .wp-core-ui .button.hover, .wp-core-ui .button:focus, .wp-core-ui .button:hover {border-color:<?php echo $this->aof_options['sec_button_hover_border_color']; ?>; -webkit-box-shadow:inset 0 1px 0 <?php echo $this->aof_options['sec_button_hover_shadow_color']; ?>,0 1px 0 rgba(0,0,0,.08);box-shadow:inset 0 1px 0 <?php echo $this->aof_options['sec_button_hover_shadow_color']; ?>,0 1px 0 rgba(0,0,0,.08);}
.wp-core-ui .button-primary, .wp-core-ui .button-primary-disabled, .wp-core-ui .button-primary.disabled, .wp-core-ui .button-primary:disabled, .wp-core-ui .button-primary[disabled] {border-color:<?php echo $this->aof_options['pry_button_border_color']; ?> !important;-webkit-box-shadow:inset 0 1px 0 <?php echo $this->aof_options['pry_button_shadow_color']; ?>,0 1px 0 rgba(0,0,0,.15) !important; box-shadow: inset 0 1px 0 <?php echo $this->aof_options['pry_button_shadow_color']; ?>, 0 1px 0 rgba(0,0,0,.15) !important;}
.wp-core-ui .button-primary.focus, .wp-core-ui .button-primary.hover, .wp-core-ui .button-primary:focus, .wp-core-ui .button-primary:hover, .wp-core-ui .button-primary.active,.wp-core-ui .button-primary.active:focus,.wp-core-ui .button-primary.active:hover,.wp-core-ui .button-primary:active {border-color:<?php echo $this->aof_options['pry_button_hover_border_color']; ?> !important;-webkit-box-shadow:inset 0 1px 0 <?php echo $this->aof_options['pry_button_hover_shadow_color']; ?>,0 1px 0 rgba(0,0,0,.15) !important; box-shadow: inset 0 1px 0 <?php echo $this->aof_options['pry_button_hover_shadow_color']; ?>,0 1px 0 rgba(0,0,0,.15) !important;}
<?php } ?>

/* Left Menu */
    <?php
    if(isset($this->aof_options['admin_menu_width']) && !empty($this->aof_options['admin_menu_width'])) {
        $admin_menu_width = $this->aof_options['admin_menu_width'];
        $wp_content_margin = $admin_menu_width + 20;
        ?>
        #adminmenu, #adminmenu .wp-submenu, #adminmenuback, #adminmenuwrap {
            width: <?php echo $admin_menu_width . 'px'; ?>;
        }
        #wpcontent, #wpfooter {
            <?php if(is_rtl()) { ?>
                margin-right: <?php echo $wp_content_margin . 'px'; ?>;
            <?php } else { ?>
            margin-left: <?php echo $wp_content_margin . 'px'; ?>;
            <?php } ?>
        }
        #adminmenu .wp-submenu {
            <?php if(is_rtl()) echo 'right: ' . $admin_menu_width . 'px'; else echo 'left: ' . $admin_menu_width . 'px'; ?>;
        }
        .quicklinks li.alter_admin_title {
            width: <?php echo $admin_menu_width . 'px'; ?> !important;
        }
  <?php  } else { ?>
        #adminmenu, #adminmenu .wp-submenu, #adminmenuback, #adminmenuwrap {
            width: 230px;
        }
        #wpcontent, #wpfooter {
        <?php if(is_rtl()) echo 'margin-right: '; else echo 'margin-left: '; ?>250px;
        }
        #adminmenu .wp-submenu { <?php if(is_rtl()) echo 'right: 230px'; else echo 'left:230px'; ?>; }
        .quicklinks li.alter_admin_title {
            width: 230px !important;
        }
  <?php }
  if(!empty($this->aof_options['menu_separator_color'])) {
  ?>
#adminmenu li.wp-menu-separator { background-color: <?php echo $this->aof_options['menu_separator_color']; ?>; }
  <?php } ?>
#adminmenuback, #adminmenuwrap, #adminmenu { background: <?php echo $this->aof_options['nav_wrap_color']; ?>;}
#adminmenu div.wp-menu-image:before, #adminmenu a, #adminmenu .wp-submenu a, #collapse-menu, #collapse-button div:after { color: <?php echo $this->aof_options['nav_text_color']; ?>; }
#adminmenu li.menu-top:hover, #adminmenu li.menu-top:focus, #adminmenu li.menu-top a:hover, #adminmenu li.menu-top a:focus,
#adminmenu li.opensub>a.menu-top, #adminmenu li>a.menu-top:focus {
  background: <?php echo $this->aof_options['hover_menu_color']; ?>; color: <?php echo $this->aof_options['menu_hover_text_color']; ?>;
}
#adminmenu li a:focus div.wp-menu-image:before, #adminmenu li.opensub div.wp-menu-image:before, #adminmenu li:hover div.wp-menu-image:before,
#adminmenu .opensub .wp-submenu li.current a, #adminmenu .wp-submenu li.current, #adminmenu a.wp-has-current-submenu:focus+.wp-submenu li.current a {color: <?php echo $this->aof_options['menu_hover_text_color']; ?>;}
#adminmenu .wp-submenu li.current a, #adminmenu .wp-menu-open .wp-submenu li a, #adminmenu .wp-submenu a {color: <?php echo $this->aof_options['submenu_active_text_color']; ?>;}
#adminmenu li.wp-has-current-submenu > a.menu-top, #adminmenu li.wp-has-current-submenu div.wp-menu-image:before,
#adminmenu li.wp-has-current-submenu:hover > a.menu-top, #adminmenu li.wp-has-current-submenu:hover div.wp-menu-image:before { color: <?php echo $this->aof_options['menu_active_text_color']; ?>;}

#adminmenu .wp-submenu-head, #adminmenu a.menu-top { <?php if(is_rtl()) echo 'padding: 5px 10px 5px 0'; else echo'padding: 5px 0 5px 10px'; ?> }
.folded #wpcontent, .folded #wpfooter {<?php if(is_rtl()) echo 'margin-right: '; else echo 'margin-left: '; ?>78px; }
.folded #adminmenu .opensub .wp-submenu, .folded #adminmenu .wp-has-current-submenu .wp-submenu.sub-open, .folded #adminmenu .wp-has-current-submenu a.menu-top:focus+.wp-submenu, .folded #adminmenu .wp-has-current-submenu.opensub .wp-submenu, .folded #adminmenu .wp-submenu.sub-open, .folded #adminmenu a.menu-top:focus+.wp-submenu, .no-js.folded #adminmenu .wp-has-submenu:hover .wp-submenu { <?php if(is_rtl()) echo 'right: 58px'; else echo 'left: 58px'; ?>; }

#adminmenu li.wp-has-current-submenu a.wp-has-current-submenu, #adminmenu li.current a.menu-top, .folded #adminmenu li.wp-has-current-submenu, .folded #adminmenu li.current.menu-top, #adminmenu .wp-menu-arrow, #adminmenu .wp-has-current-submenu .wp-submenu .wp-submenu-head, #adminmenu .wp-menu-arrow div { background: <?php echo $this->aof_options['active_menu_color']; ?>; }

#adminmenu .wp-menu-open li a:focus, #adminmenu .wp-menu-open li a:hover, #adminmenu a.wp-has-current-submenu:focus+.wp-submenu li.current a
{ color: <?php echo $this->aof_options['menu_hover_text_color']; ?>; }

#adminmenu .wp-has-current-submenu .wp-submenu, .no-js li.wp-has-current-submenu:hover .wp-submenu, #adminmenu a.wp-has-current-submenu:focus+.wp-submenu, #adminmenu .wp-has-current-submenu .wp-submenu.sub-open, #adminmenu .wp-has-current-submenu.opensub .wp-submenu, #adminmenu .wp-not-current-submenu .wp-submenu, .folded #adminmenu .wp-has-current-submenu .wp-submenu{ background: <?php echo $this->aof_options['sub_nav_wrap_color']; ?>; }

#adminmenu li.wp-has-submenu.wp-not-current-submenu.opensub:hover:after { <?php if(is_rtl()) echo 'border-left-color: '; else echo 'border-right-color: '; echo $this->aof_options['sub_nav_wrap_color']; ?> }
#adminmenu .awaiting-mod, #adminmenu .update-plugins, #sidemenu li a span.update-plugins, #adminmenu li a.wp-has-current-submenu .update-plugins { background-color: <?php echo $this->aof_options['menu_updates_count_bg']; ?>; color: <?php echo $this->aof_options['menu_updates_count_text']; ?>; }

#adminmenu .wp-menu-image img { padding: 6px 0 0 }

/* Metabox handles */
.menu.ui-sortable .menu-item-handle, .meta-box-sortables.ui-sortable .hndle, .sortUls div.menu_handle, .wp-list-table thead, .menu-item-handle, .widget .widget-top { background: <?php echo $this->aof_options['metabox_h3_color']; ?>; border: 1px solid <?php echo $this->aof_options['metabox_h3_border_color']; ?>; color: <?php echo $this->aof_options['metabox_text_color']; ?>; }
.postbox .hndle { border: none !important}
ol.sortUls a.plus:before, ol.sortUls a.minus:before { color: <?php echo $this->aof_options['metabox_handle_color']; ?>; }
.postbox .accordion-section-title:after, .handlediv, .item-edit, .sidebar-name-arrow, .widget-action, .sortUls a.admin_menu_edit { color:<?php echo $this->aof_options['metabox_handle_color']; ?>}
.postbox .accordion-section-title:hover:after, .handlediv:hover, .item-edit:hover, .sidebar-name:hover .sidebar-name-arrow, .widget-action:hover, .sortUls a.admin_menu_edit:hover { color: <?php echo $this->aof_options['metabox_handle_hover_color']; ?> }
.wp-list-table thead tr th, .wp-list-table thead tr th a, .wp-list-table thead tr th:hover, .wp-list-table thead tr th a:hover, span.sorting-indicator:before, span.comment-grey-bubble:before, .ui-sortable .item-type {color: <?php echo $this->aof_options['metabox_text_color']; ?>; }

/* Add new buttons */
.wrap .add-new-h2, .wrap .page-title-action { background-color: <?php echo $this->aof_options['pry_button_color']; ?>; color: <?php echo $this->aof_options['pry_button_text_color']; ?>; }
.wrap .add-new-h2:hover, .wrap .page-title-action:hover, .wrap .add-new-h2:active { background-color: <?php echo $this->aof_options['pry_button_hover_color']; ?>; color: <?php echo $this->aof_options['pry_button_hover_text_color']; ?>; }

/* Message box */
.notice, div.updated { border-left: 4px solid <?php echo $this->aof_options['msgbox_border_color']; ?>; background-color: <?php echo $this->aof_options['msg_box_color']; ?>; color: <?php echo $this->aof_options['msgbox_text_color']; ?>; }
div.updated #bulk-titles div a:before, .notice-dismiss:before, .tagchecklist span a:before, .welcome-panel .welcome-panel-close:before { color: <?php echo $this->aof_options['msgbox_text_color']; ?>; }
div.updated a { color: <?php echo $this->aof_options['msgbox_link_color']; ?>; }
div.updated a:hover { color: <?php echo $this->aof_options['msgbox_link_hover_color']; ?>; }

.notice-error, div.error, #setting-error-tgmpa {
  border-left-color: <?php echo $this->aof_options['error_border_color']; ?>;
  background: <?php echo $this->aof_options['error_box_color']; ?>;
  color: <?php echo $this->aof_options['error_text_color']; ?>;
}

.notice-error a, div.error a, #setting-error-tgmpa a {
  color: <?php echo $this->aof_options['error_link_color']; ?>;
}

.notice-error a:hover, div.error a:hover, #setting-error-tgmpa a:hover {
  color: <?php echo $this->aof_options['error_link_hover_color']; ?>;
}

.notice-warning, div.notice.notice-warning {
  border-left-color: <?php echo $this->aof_options['warn_border_color']; ?>;
  background: <?php echo $this->aof_options['warn_box_color']; ?>;
  color: <?php echo $this->aof_options['warn_text_color']; ?>;
}

.notice-warning a, div.notice.notice-warning a {
  color: <?php echo $this->aof_options['warn_link_color']; ?>;
}

.notice-warning a:hover, div.notice.notice-warning a:hover {
  color: <?php echo $this->aof_options['warn_link_hover_color']; ?>;
}

<?php
//alter options css
if(is_rtl()) {
  ?>
.alter-edit-expand {
  right: auto!important;
  left: 20px!important;
}
  <?php
}

 //gutenberg styles
 if(isset($this->aof_options['admin_menu_width']) && !empty($this->aof_options['admin_menu_width'])) {
   $guttenberg_header_width = $this->aof_options['admin_menu_width'] . 'px';
 }
 else {
   $guttenberg_header_width = '200px';
 }
 ?>
 @media screen and (min-width: 782px){
   .block-editor .edit-post-header, .block-editor .components-notice-list {
     left: <?php echo $guttenberg_header_width; ?>
   }
   .block-editor .edit-post-header {
       top: 50px!important;
   }
   .block-editor .edit-post-sidebar {
     top:105px;
   }
 }

<?php if($this->aof_options['design_type'] == 1) { ?>
.wp-core-ui .button-primary, .postbox,.wp-core-ui .button-primary.focus, .wp-core-ui .button-primary.hover, .wp-core-ui .button-primary:focus, .wp-core-ui .button-primary:hover, .wp-core-ui .button, .wp-core-ui .button-secondary, .wp-core-ui .button-secondary:focus, .wp-core-ui .button-secondary:hover, .wp-core-ui .button.focus, .wp-core-ui .button.hover, .wp-core-ui .button:focus, .wp-core-ui .button:hover, #wpadminbar .menupop .ab-sub-wrapper, #wpadminbar .shortlink-input, .theme-browser .theme, .wrap .add-new-h2, .wrap .page-title-action,.wrap .add-new-h2:hover, .wrap .page-title-action:hover, .wrap .add-new-h2:active {
	-webkit-box-shadow: none !important;
	-moz-box-shadow: none !important;
	box-shadow: none !important;
	border: none !important;
  text-shadow: none !important;
}
input[type=checkbox], input[type=radio], #update-nag, .update-nag, .wp-list-table, .widefat, input[type=email], input[type=number], input[type=password], input[type=search], input[type=tel], input[type=text], input[type=url], select, textarea, #adminmenu .wp-submenu, .folded #adminmenu .wp-has-current-submenu .wp-submenu, .folded #adminmenu a.wp-has-current-submenu:focus+.wp-submenu, .mce-toolbar .mce-btn-group .mce-btn.mce-listbox, .wp-color-result, .widget-top, .widgets-holder-wrap {
	-webkit-box-shadow: none !important;
	-moz-box-shadow: none !important;
	box-shadow: none !important;
}
<?php }
echo $this->aof_options['admin_page_custom_css'];
?>
</style>
