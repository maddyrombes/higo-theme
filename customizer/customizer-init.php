<?php
/**
 * Higo Customizer functionality
 *
 * @package WordPress
 * @subpackage Higo
 * @since 1.0.0
 */

/**
 * Registers the Customizer with all the settings
 *
 * @since 1.0.0
 * @param WP_Customize_Manager $wp_customize The Customizer object.
 */
function higo_customize_register($wp_customize) {

    if (! isset($wp_customize)) {
        return;
    }

    require get_template_directory() . '/customizer/sections/identity.php';
    require get_template_directory() . '/customizer/sections/colors.php';
    require get_template_directory() . '/customizer/sections/blog.php';
    require get_template_directory() . '/customizer/sections/blog-featured-posts.php';
    require get_template_directory() . '/customizer/sections/single.php';
    require get_template_directory() . '/customizer/sections/social.php';
    require get_template_directory() . '/customizer/sections/footer.php';
    require get_template_directory() . '/customizer/sections/offcanvas.php';
}

add_action('customize_register', 'higo_customize_register');

require get_parent_theme_file_path('/customizer/customizer-sanitize-callbacks.php');
