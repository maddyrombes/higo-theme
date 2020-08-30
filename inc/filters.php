<?php
/**
 * Higo filters
 *
 * @package WordPress
 * @subpackage Higo
 * @since 1.0.0
 */

/**
 * Remove query strings from static resources
 *
 * @since 1.0.2
 */
function higo_remove_script_version( $src ){
    $parts = explode( '?ver', $src );
    return $parts[0];
}
add_filter( 'script_loader_src', 'higo_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', 'higo_remove_script_version', 15, 1 );


/**
 * Change the image markup on the attachment page
 *
 * @since 1.0.0
 */
function higo_prepend_attachment($p) {
    return '<p>'.wp_get_attachment_link(0, 'higo-xxl', false).'</p>';
}
add_filter('prepend_attachment', 'higo_prepend_attachment');


/**
 * Adds custom classes to the array of body classes.
 *
 * @since 1.0.0
 * @param array $classes Classes for the body element.
 * @return array
 */
function higo_body_classes($classes) {

    // Add class if sidebar is active or not
    if ( higo_display_sidebar() ) {
         $classes[] = 'has-sidebar';
     } else {
         $classes[] = 'has-no-sidebar';
     }

     if ( is_front_page() && !is_home() ) {
         $classes[] = 'static-front-page';
     }

     // Add class for current blog layout
     if ( is_home() ) {
         $classes[] = 'blog-layout-'.get_theme_mod('blog_layout', 'grid');
     }

     return $classes;
}
add_filter('body_class', 'higo_body_classes');


/**
 * Replaces 'http://#' with 'javascript:void(0)' in menus
 *
 * @since 1.0.0
 * @param string $menu_item item HTML
 * @return string item HTML
 */
function higo_nav_replace_hash($menu_item) {

    if (strpos($menu_item, 'href="http://#"') !== false) {
        $menu_item = str_replace('href="http://#"', 'href="javascript:void(0);"', $menu_item);
    }
    return $menu_item;

}
add_filter('walker_nav_menu_start_el', 'higo_nav_replace_hash', 10, 4);


/**
 * Removes font size inline style from tag cloud links
 *
 * @param string $tag_string tags markup
 * @since 1.0.0
 * @return string filtered tags markup
 */
function higo_remove_tag_cloud_styles($tag_string) {
   return preg_replace('/ style=("|\')(.*?)("|\')/', '', $tag_string);
}
add_filter('wp_generate_tag_cloud', 'higo_remove_tag_cloud_styles', 10, 1);


/**
 * Filters the default output of the `the_archive_title()` function
 *
 * @since 1.0.0
 */
function higo_archive_title($title) {
    if (is_category()) {
        $title = single_cat_title('', false);
    } elseif (is_tag()) {
        $title = single_tag_title('#', false);
    } elseif (is_author()) {
        /* translators: Author archive title. 1: Author name */
        $title = sprintf(esc_html('All posts by %s'), get_the_author());
    }

    return $title;
}
add_filter('get_the_archive_title', 'higo_archive_title');


/**
 * Replaces "[…]" with "..." at the end of cutout excerpt
 *
 * @since 1.0.0
 */
function higo_excerpt_more() {
    return '&hellip;';
}
add_filter('excerpt_more', 'higo_excerpt_more' );



/**
 * Calculate Image Sizes by type and breakpoint
 *
 * @since 1.0.1
 */
function higo_post_thumbnail_sizes_attr($attr, $attachment, $size) {

    if ($size === 'thumb-blog-grid') {

        $attr['sizes'] = '(max-width: 539px) calc(100vw - 30px), (max-width: 809px) 510px, (max-width: 989px) 360px, (max-width: 1169px) 290px, 350px';

    } elseif ($size === 'thumb-blog-list') {

        $attr['sizes'] = '(max-width: 539px) 33.33vw, (max-width: 809px) 510px, (max-width: 989px) 250px, (max-width: 1169px) 310px, 370px';

    } elseif ($size === 'thumb-blog-list-sidebar') {

        $attr['sizes'] = '(max-width: 539px) 33.33vw, (max-width: 809px) 510px, (max-width: 989px) 250px, (max-width: 1169px) 203px, 244px';

    } elseif ($size === 'thumb-related-posts') {

        $attr['sizes'] = '(min-width: 540px) 240px, (min-width: 810px) 360px, (min-width: 990px) 210px, (min-width: 1170px) 255px, 50vw';


    } elseif ($size === 'thumb-widget-recent-posts') {

        $attr['sizes'] = '(max-width: 539px) 33.33vw, (max-width: 809px) 204px, (max-width: 989px) 300px, (max-width: 1169px) 97px, 117px';

    } elseif ($size === 'higo-fsl-1-b' ) {

        $attr['sizes'] = '(max-width: 1169px) 100vw, 1110px';

    } elseif ($size === 'higo-fsl-2-b' ) {

        $attr['sizes'] = '(max-width: 809px) 100vw, (max-width: 1169px) 50vw, 555px';

    } elseif ($size === 'higo-fsl-3-b' ) {

        $attr['sizes'] = '(max-width: 809px) 100vw, (max-width: 989px) 50vw, (max-width: 1169px) 33.33vw, 370px';

    } elseif ($size === 'higo-fsl-4-b' ) {

        $attr['sizes'] = '(max-width: 809px) 100vw, (max-width: 989px) 50vw, (max-width: 1169px) 33.33vw, 278px';

    } elseif ($size === 'higo-fsl-1-f') {

        $attr['sizes'] = '100vw';

    } elseif ($size === 'higo-fsl-2-f') {

        $attr['sizes'] = '(max-width: 809px) 100vw, 50vw';

    } elseif ($size === 'higo-fsl-3-f') {

        $attr['sizes'] = '(max-width: 809px) 100vw, (max-width: 989px) 50vw, 33.33vw';

    } elseif ($size === 'higo-fsl-4-f') {

        $attr['sizes'] = '(max-width: 809px) 100vw, (max-width: 989px) 50vw, (max-width: 1169px) 33.33vw, 25vw';

    }

    return $attr;
}
add_filter('wp_get_attachment_image_attributes', 'higo_post_thumbnail_sizes_attr', 10 , 3);
