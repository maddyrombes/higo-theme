<?php
/**
 * Customizer Section: Off-canvas
 *
 * @since 1.0.0
 *
 */

$wp_customize->add_section('higo_customizer_section_offcanvas', array(
    'title' => esc_html__('Off-canvas', 'higo'),
));

// Off-canvas Text
// ---------------------------------------------------------------

$wp_customize->add_setting('offcanvas_text', array(
    'default' =>'',
    'sanitize_callback' => 'wp_kses_post'
));

$wp_customize->add_control('offcanvas_text', array(
    'label'       => esc_html__('Off-canvas text.', 'higo'),
    'description' => esc_html__('Small piece of text to display in the off-canvas section.', 'higo'),
    'section'     => 'higo_customizer_section_offcanvas',
    'type'        => 'textarea'
));
