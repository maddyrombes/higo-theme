<?php
/**
 * Customizer Section: Blog Featured Posts
 *
 * @since 1.1.0
 *
 */

$wp_customize->add_section('higo_customizer_section_blog_featured_posts', array(
    'title' => esc_html__('Blog Featured Posts', 'higo'),
    'description' => esc_html__('Here you can setup the front blog page carousel with featured posts. In order for the featured posts to show up, there must be at least one sticky post.', 'higo'),
));

// Number of slides
// ---------------------------------------------------------------

$wp_customize->add_setting('featured_posts_num', array(
    'default' => '2',
    'sanitize_callback' => 'higo_sanitize_select'
));

$wp_customize->add_control('featured_posts_num', array(
    // 'label'       => esc_html__('Featured posts: number of slides.', 'higo'),
    'description' => esc_html__('Max number of slides to show at a time on large screens. Each slide will have equal width.', 'higo'),
    'section'     => 'higo_customizer_section_blog_featured_posts',
    'type'        => 'select',
    'choices'     => array(
        '1' => esc_html__('1 Slide', 'higo'),
        '2' => esc_html__('2 Slides', 'higo'),
        '3' => esc_html__('3 Slides', 'higo'),
        '4' => esc_html__('4 Slides', 'higo'),
    )
));

// Arrows
// ---------------------------------------------------------------

$wp_customize->add_setting('featured_posts_arrows', array(
    'default' => true,
    'sanitize_callback' => 'higo_sanitize_checkbox'
));

$wp_customize->add_control('featured_posts_arrows', array(
    'label'       => esc_html__('Arrows.', 'higo'),
    'description' => esc_html__('Enables next/prev arrows buttons.', 'higo'),
    'section'     => 'higo_customizer_section_blog_featured_posts',
    'type'        => 'checkbox'
));

// Dots
// ---------------------------------------------------------------

$wp_customize->add_setting('featured_posts_dots', array(
    'default' => false,
    'sanitize_callback' => 'higo_sanitize_checkbox'
));

$wp_customize->add_control('featured_posts_dots', array(
    'label'       => esc_html__('Dots.', 'higo'),
    'description' => esc_html__('Displays dots navigation at the bottom of the slider.', 'higo'),
    'section'     => 'higo_customizer_section_blog_featured_posts',
    'type'        => 'checkbox'
));

// Boxed
// ---------------------------------------------------------------

$wp_customize->add_setting('featured_posts_boxed', array(
    'default' => false,
    'sanitize_callback' => 'higo_sanitize_checkbox'
));

$wp_customize->add_control('featured_posts_boxed', array(
    'label'       => esc_html__('Boxed.', 'higo'),
    'description' => esc_html__('Makes the slider boxed instead of full width on larger screens.', 'higo'),
    'section'     => 'higo_customizer_section_blog_featured_posts',
    'type'        => 'checkbox'
));

// Gutters
// ---------------------------------------------------------------

$wp_customize->add_setting('featured_posts_gutters', array(
    'default' => true,
    'sanitize_callback' => 'higo_sanitize_checkbox'
));

$wp_customize->add_control('featured_posts_gutters', array(
    'label'       => esc_html__('Gutters.', 'higo'),
    'description' => esc_html__('Adds gutters between slides.', 'higo'),
    'section'     => 'higo_customizer_section_blog_featured_posts',
    'type'        => 'checkbox'
));

// Autoplay
// ---------------------------------------------------------------

$wp_customize->add_setting('featured_posts_autoplay', array(
    'default' => true,
    'sanitize_callback' => 'higo_sanitize_checkbox'
));

$wp_customize->add_control('featured_posts_autoplay', array(
    'label'       => esc_html__('Autoplay.', 'higo'),
    'description' => esc_html__('Enables auto play of slides.', 'higo'),
    'section'     => 'higo_customizer_section_blog_featured_posts',
    'type'        => 'checkbox'
));

// Center mode
// ---------------------------------------------------------------

$wp_customize->add_setting('featured_posts_center_mode', array(
    'default' => true,
    'sanitize_callback' => 'higo_sanitize_checkbox'
));

$wp_customize->add_control('featured_posts_center_mode', array(
    'label'       => esc_html__('Center mode.', 'higo'),
    'description' => esc_html__('Enables center view with partial prev/next slides. Only works with number of slides set to 1 and if there are at least 3 sticky posts.', 'higo'),
    'section'     => 'higo_customizer_section_blog_featured_posts',
    'type'        => 'checkbox'
));
