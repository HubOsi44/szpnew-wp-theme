<?php


function biprotech_wp_theme_customize_register($wp_customize)
{
    // Add control for logo uploader
    $wp_customize->add_setting('biprotech_wp_theme_logo', array(
        'sanitize_callback' => 'esc_url',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'biprotech_wp_theme_logo', array(
        'label'    => __('Upload Logo (replaces text)', 'szpnew-wp-theme'),
        'section'  => 'title_tagline',
        'settings' => 'biprotech_wp_theme_logo',
    )));
}

add_action('customize_register', 'biprotech_wp_theme_customize_register');
