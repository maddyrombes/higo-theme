<?php
/**
 * Customizer Section: Blog
 *
 * @since 1.0.0
 *
 */

$wp_customize->add_section('higo_customizer_section_blog', array(
    'title' => esc_html__('Blog', 'higo'),
));


// Blog layout
// ---------------------------------------------------------------

$wp_customize->add_setting('blog_layout', array(
    'default' => 'grid',
    'sanitize_callback' => 'higo_sanitize_select'
));

$wp_customize->add_control('blog_layout', array(
    'label'       => esc_html__('Blog layout.', 'higo'),
    'description' => esc_html__('Select the layout for the latest posts section.', 'higo'),
    'section'     => 'higo_customizer_section_blog',
    'type'        => 'select',
    'choices'     => array(
        'grid' => esc_html__('Grid blog layout', 'higo'),
        'list' => esc_html__('List blog layout', 'higo')
    )
));


// Blog sidebar
// ---------------------------------------------------------------

$wp_customize->add_setting('blog_sidebar_display', array(
    'default' => false,
    'sanitize_callback' => 'higo_sanitize_checkbox'
));

$wp_customize->add_control('blog_sidebar_display', array(
    'label'       => esc_html__('Show blog sidebar.', 'higo'),
    'description' => esc_html__('Uncheck if you want to hide the sidebar from the recent posts page. Same if you just remove all widgets from the blog sidebar.', 'higo'),
    'section'     => 'higo_customizer_section_blog',
    'type'        => 'checkbox'
));

// AJAX load more
// ---------------------------------------------------------------

$wp_customize->add_setting('blog_ajax_posts', array(
    'default' => false,
    'sanitize_callback' => 'higo_sanitize_checkbox'
));

$wp_customize->add_control('blog_ajax_posts', array(
    'label'       => esc_html__('Load more posts.', 'higo'),
    'description' => esc_html__('Include "Load More" button instead of the pagination.', 'higo'),
    'section'     => 'higo_customizer_section_blog',
    'type'        => 'checkbox'
));


// Footer popular posts
// ---------------------------------------------------------------

$wp_customize->add_setting('blog_popular_posts', array(
    'default' => false,
    'sanitize_callback' => 'higo_sanitize_checkbox'
));

$wp_customize->add_control('blog_popular_posts', array(
    'label'       => esc_html__('Blog popular posts.', 'higo'),
    'description' => esc_html__('Show popular posts section between the posts.', 'higo'),
    'section'     => 'higo_customizer_section_blog',
    'type'        => 'checkbox'
));
