<?php
/**
 * Customizer Section: Single Post/Page
 *
 * @since 1.0.2
 *
 */

$wp_customize->add_section('higo_customizer_section_single', array(
    'title' => esc_html__('Single Post', 'higo'),
));

// Hide single post thumbnails
// ---------------------------------------------------------------

$wp_customize->add_setting('single_posts_thumbnail_display', array(
    'default' => false,
    'sanitize_callback' => 'higo_sanitize_checkbox'
));

$wp_customize->add_control('single_posts_thumbnail_display', array(
    'label'       => esc_html__('Hide single post thumbnails.', 'higo'),
    'description' => esc_html__('Check to hide posts thumbnails from single posts.', 'higo'),
    'section'     => 'higo_customizer_section_single',
    'type'        => 'checkbox'
));
