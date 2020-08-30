<?php
/**
 * Customizer Section: Identity
 *
 * @since 1.0.0
 *
 */

$wp_customize->add_setting('logo_height', array(
    'default' => '30',
    'sanitize_callback' => 'higo_sanitize_number_range',
));

$wp_customize->add_control('logo_height', array(
    'label' => esc_html__('Logo height', 'higo'),
    'description' => esc_html__('The width will adjust keeping original proportions. Default: 30; Max: 120; Min: 20.', 'higo'),
    'section' => 'title_tagline',
    'type' => 'number',
    'input_attrs' => array(
        'min' => '20',
        'step' => '1',
        'max' => '120',
    ),
));

$wp_customize->add_setting('logo_padding', array(
    'default' => '40',
    'sanitize_callback' => 'higo_sanitize_number_range',
));

$wp_customize->add_control('logo_padding', array(
    'label' => esc_html__('Logo vertical padding', 'higo'),
    'description' => esc_html__('Default: 40; Max: 80; Min: 20.', 'higo'),
    'section' => 'title_tagline',
    'type' => 'number',
    'input_attrs' => array(
        'min' => '20',
        'step' => '1',
        'max' => '80',
    ),
));

$wp_customize->add_setting('logo_height_mobile', array(
    'default' => '20',
    'sanitize_callback' => 'higo_sanitize_number_range',
));

$wp_customize->add_control('logo_height_mobile', array(
    'label' => esc_html__('Logo height on small screens', 'higo'),
    'description' => esc_html__('The width will adjust keeping original proportions. Default: 20; Max: 50; Min: 10.', 'higo'),
    'section' => 'title_tagline',
    'type' => 'number',
    'input_attrs' => array(
        'min' => '10',
        'step' => '1',
        'max' => '50',
    ),
));
