<?php
/**
 * Higo setup
 *
 * @package WordPress
 * @subpackage Higo
 * @since 1.0.0
 */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 * @since 1.0.0
 */
function higo_setup() {

    // Make theme available for translation.
    load_theme_textdomain('higo', get_template_directory() . '/languages');

    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    // Add support for custom logo
    add_theme_support('custom-logo');

    // Let WordPress manage the document title.
    add_theme_support('title-tag');

    // Add support for selective refresh widgets
    add_theme_support('customize-selective-refresh-widgets');

    // Add support for post thumbnails
    add_theme_support('post-thumbnails');

    // Set the default content width.
	$GLOBALS['content_width'] = 730;

    // Add editor styles to the visual editor to resemble the theme style
    add_editor_style( 'assets/css/editor.css' );

    // Add HTML5 markup support
    add_theme_support('html5', array('caption', 'comment-form', 'comment-list', 'gallery', 'search-form'));

    // Register theme's menus
    register_nav_menus(array(
        'higo_menu_header' => esc_html__('Header Menu', 'higo'),
        'higo_menu_offcanvas_one' => esc_html__('Off-canvas Menu One', 'higo'),
        'higo_menu_offcanvas_two' => esc_html__('Off-canvas Menu Two', 'higo'),
        'higo_menu_footer_one' => esc_html__('Footer Menu One', 'higo'),
        'higo_menu_footer_two' => esc_html__('Footer Menu Two', 'higo')
    ));

    //  Add custom image sizes based on the theme's design
    add_image_size('higo-xxl', 1110);
    add_image_size('higo-xl', 930);
    add_image_size('higo-l', 750);
    add_image_size('higo-m', 510);
    add_image_size('higo-s', 360);
    add_image_size('higo-xs', 300);
    add_image_size('higo-xxs', 120);

    // Define different image size for different placement throughout the theme
    add_image_size('thumb-blog-grid', 510);
    add_image_size('thumb-blog-list', 510);
    add_image_size('thumb-blog-list-sidebar', 510);
    add_image_size('thumb-related-posts', 360);
    add_image_size('thumb-widget-recent-posts', 300);

    add_image_size('higo-fsl-1-b', 1110);
    add_image_size('higo-fsl-2-b', 750);
    add_image_size('higo-fsl-3-b', 750);
    add_image_size('higo-fsl-4-b', 750);
    add_image_size('higo-fsl-1-f', 1110);
    add_image_size('higo-fsl-2-f', 750);
    add_image_size('higo-fsl-3-f', 750);
    add_image_size('higo-fsl-4-f', 750);


}
add_action('after_setup_theme', 'higo_setup');

/**
 * Set the content width in pixels, based on the theme's design.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function higo_content_width() {

    $content_width = $GLOBALS['content_width'];

    if ( !higo_display_sidebar() ) {
        $content_width = 1110;
    }

    $GLOBALS['content_width'] = apply_filters( 'higo_content_width', $content_width );
}
add_action( 'template_redirect', 'higo_content_width', 0 );

/**
 * Register widget areas and custom widgets
 *
 * @since 1.0.0
 */
function higo_widgets_init() {

    register_sidebar(array(
        'name'          => esc_html__('Blog', 'higo'),
        'id'            => 'higo_sidebar_blog',
        'description'   => esc_html__('Displayed on page with latest posts. Can be turned off from the customizer.', 'higo'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title bordered-title h3"><span>',
        'after_title'   => '</span></h2>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Single post', 'higo'),
        'id'            => 'higo_sidebar_single_post',
        'description'   => esc_html__('Displayed on all single posts if has any widgets. Can be turned off for each individual post from within the post edit screen.', 'higo'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title bordered-title h3"><span>',
        'after_title'   => '</span></h2>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Single page', 'higo'),
        'id'            => 'higo_sidebar_single_page',
        'description'   => esc_html__('Displayed on all single pages. Can be turned off for each individual page from within the post edit screen.', 'higo'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title bordered-title h3"><span>',
        'after_title'   => '</span></h2>',
    ));

    register_widget('Higo_Widget_Recent_Posts');
    register_widget('Higo_Widget_Instagram');
}
add_action('widgets_init', 'higo_widgets_init');


// Add a pingback url auto-discovery header for singularly identifiable articles.
function higo_pingback_header() {
    if (is_singular() && pings_open()) {
        echo '<link rel="pingback" href="', esc_url(get_bloginfo('pingback_url')), '">';
    }
}
add_action('wp_head', 'higo_pingback_header');
