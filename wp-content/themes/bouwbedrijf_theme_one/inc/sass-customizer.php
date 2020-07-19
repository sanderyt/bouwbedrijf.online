<?php
/**
 * Customizer Sass
 *
 * Requires the WP-SCSS plugin to be installed and activated.
 *
 * @package      Customizer Sass
 * @link         https://seothemes.com
 * @author       SEO Themes
 * @copyright    Copyright © 2017 Seo Themes
 * @license      GPL-2.0+
 */
 
// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
 
    die;
 
}
 
// Check if WP-SCSS plugin is active.
if ( ! is_plugin_active( 'wp-scss/wp-scss.php' ) ) {
 
    return;
 
}
 
// Always recompile in the customizer.
if ( is_customize_preview() && ! defined( 'WP_SCSS_ALWAYS_RECOMPILE' ) ) {
 
    define( 'WP_SCSS_ALWAYS_RECOMPILE', true );
 
}

define( 'WP_SCSS_ALWAYS_RECOMPILE', true );
 
// Update the default paths to match theme.
$wpscss_options = get_option( 'wpscss_options' );
 
if ( $wpscss_options['scss_dir'] !== '/scss/' || $wpscss_options['css_dir'] !== '/css/' ) {
 
    // Alter the options array appropriately.
    $wpscss_options['scss_dir'] = '/scss/';
    $wpscss_options['css_dir']  = '/css/';
 
    // Update entire array
    update_option( 'wpscss_options', $wpscss_options );
 
}

function wp_scss_set_variables(){
    $variables = array(
        'primary-color' => get_theme_mod('primary_color', '#43C6E4'),
        'cta-color' => get_theme_mod('cta_color', '#43C6E4')
    );
    return $variables;
}

add_filter('wp_scss_variables','wp_scss_set_variables');

?>