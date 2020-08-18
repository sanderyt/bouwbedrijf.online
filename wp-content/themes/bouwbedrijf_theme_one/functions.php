<?php

require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/sass-customizer.php';

require_once 'custom-elementor.php';

function register_my_menus() {
  register_nav_menus(
    array(
      'header-menu' => __( 'Bovenste menu' ),
      'footer-menu1' => __( 'Eerste footer menu' ),
	    'footer-menu2' => __( 'Tweede footer menu' ),
    )
  );
}

add_action( 'init', 'register_my_menus' );

add_theme_support( 'post-thumbnails' );

?>
