<?php

add_action('customize_register', 'business_information_customizer');
add_action('customize_register', 'colors_settings');
add_action('customize_register', 'images_register');

function business_information_customizer($wp_customize) {
    $wp_customize->add_section('business_information', array(
        'title'          => 'Bedrijfsinformatie',
        'priority'       => 1, 
        'description'    => "Hier kunt u de gegevens van uw bedrijf invoeren. Dit wordt vervolgens getoond op uw website."
    ));

    $wp_customize->add_setting('business_name', array(
        'default'        => 'Bouwbedrijf de Vries',
    ));

    $wp_customize->add_control('business_name', array(
        'label'   => 'Bedrijfsnaam',
        'section' => 'business_information',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('business_email', array(
        'default'        => 'sales@bouwbedrijfdevries.nl',
    ));

    $wp_customize->add_control('business_email', array(
        'label'   => 'Email',
        'section' => 'business_information',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('business_phone', array(
        'default'        => '020-12345678',
    ));

    $wp_customize->add_control('business_phone', array(
        'label'   => 'Telefoon',
        'section' => 'business_information',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('business_street', array(
        'default'        => 'Prinsengracht 1',
    ));

    $wp_customize->add_control('business_street', array(
        'label'   => 'Straat',
        'section' => 'business_information',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('business_postalcode', array(
        'default'        => '1050HW',
    ));

    $wp_customize->add_control('business_postalcode', array(
        'label'   => 'Postcode',
        'section' => 'business_information',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('business_residence', array(
        'default'        => 'Amsterdam',
    ));

    $wp_customize->add_control('business_residence', array(
        'label'   => 'Stad',
        'section' => 'business_information',
        'type'    => 'text',
    ));
}

function colors_settings( $wp_customize ) {

    $wp_customize->add_section( 'colors' , array(
        'title'      => 'Kleuren',
        'priority'   => 2,
        'description' => 'Stel hier de kleuren in van uw bedrijf. Dit verandert de kleuren van de website.'
    ) );

    $wp_customize->add_setting( 'primary_color' , array(
        'default'     => '#4b84af',
        'transport'   => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'primary_color', array(
        'label'        => 'Primaire color',
        'description'  => 'De primaire kleur van uw bedrijf.',
        'section'    => 'colors',
        'settings'   => 'primary_color',
    ) ) );

    $wp_customize->add_setting( 'cta_color' , array(
        'default'     => '#ff851f',
        'transport'   => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cta_color', array(
        'label'        => 'Call-to-action color',
        'description'  => 'Een call-to-action kleur om bepaalde elementen te laten opvallen.',
        'section'    => 'colors',
        'settings'   => 'cta_color',
    ) ) );
}

function images_register( $wp_customize ) {

    $wp_customize->add_section('images', array(
        'title'             => __('Logo & subheader', 'name-theme'), 
        'priority'          => 3,
        ));    

    $wp_customize->add_setting('logo', array(
        'transport'         => 'refresh',
        'height'         => 325,
    ));

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo_control', array(
        'label'             => __('Logo bedrijf', 'name-theme'),
        'section'           => 'images',
        'settings'          => 'logo',    
    )));
}

?>