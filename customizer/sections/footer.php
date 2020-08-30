<?php
/**
 * Customizer Section: Footer
 *
 * @since 1.0.0
 *
 */

$wp_customize->add_section('higo_customizer_section_footer', array(
    'title' => esc_html__('Footer', 'higo'),
));


// Footer Text
// ---------------------------------------------------------------

$wp_customize->add_setting('footer_text', array(
    'default' =>'',
    'sanitize_callback' => 'wp_kses_post'
));

$wp_customize->add_control('footer_text', array(
    'label'       => esc_html__('Footer text.', 'higo'),
    'description' => esc_html__('Small piece of text to display in the footer.', 'higo'),
    'section'     => 'higo_customizer_section_footer',
    'type'        => 'textarea'
));


// Footer Sign-up Form
// ---------------------------------------------------------------

$wp_customize->add_setting('footer_signup_form_id', array(
    'default' => '',
    'sanitize_callback' => 'absint'
));

$wp_customize->add_control('footer_signup_form_id', array(
    'label'       => esc_html__('Sign up form ID', 'higo'),
    'description' => esc_html__('Insert from ID from the MailChimp plugin settings. Leave blank if you do not want to display a sign up form in the footer.', 'higo'),
    'section'     => 'higo_customizer_section_footer',
    'type'        => 'text'
));


// Footer Copyright Text
// ---------------------------------------------------------------

$wp_customize->add_setting('footer_copyright_text', array(
    'default' => esc_html__('All rights reserved.', 'higo'),
    'sanitize_callback' => 'wp_filter_nohtml_kses'
));

$wp_customize->add_control('footer_copyright_text', array(
    'label'       => esc_html__('Copyright text.', 'higo'),
    'description' => esc_html__('Will be displayed in the footer.', 'higo'),
    'section'     => 'higo_customizer_section_footer',
    'type'        => 'text'
));
