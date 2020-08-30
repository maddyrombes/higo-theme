<?php
/**
 * Customizer Section: Social
 *
 * @since 1.0.0
 *
 */

$wp_customize->add_section('higo_customizer_section_social', array(
    'title' => esc_html__('Social', 'higo'),
));

$wp_customize->add_setting('twitter_username', array(
    'default' => '',
    'sanitize_callback' => 'wp_filter_nohtml_kses'
));

$wp_customize->add_control('twitter_username', array(
    'label'       => esc_html__('Twitter username.', 'higo'),
    'description' => esc_html__('Will be used when sharing from you site to Twitter', 'higo'),
    'section'     => 'higo_customizer_section_social',
    'type'        => 'text'
));


$providers = array(
    'twitter' => esc_html__('Twitter', 'higo'),
    'vk' => esc_html__('Vk', 'higo'),
    'facebook' => esc_html__('Facebook', 'higo'),
    'pinterest' => esc_html__('Pinterest', 'higo'),
    'google-plus' => esc_html__('Google Plus', 'higo')
);

foreach ($providers as $key => $value) {

    $key = sanitize_title($key);

    $wp_customize->add_setting($key.'_share', array(
        'default'           => false,
        'capability'        => 'manage_options',
        'sanitize_callback' => 'higo_sanitize_checkbox'
    ));

    $wp_customize->add_control($key.'_share', array(
        'label'       => sprintf(esc_html__('Display %s share link.', 'higo'), $value),
        'section'     => 'higo_customizer_section_social',
        'type'        => 'checkbox'
    ));
}
