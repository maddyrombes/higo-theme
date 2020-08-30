<?php
/**
 * SVG icons related functions and filters
 *
 * @package WordPress
 * @subpackage Higo
 * @since 1.0.0
 */

/**
 * Add SVG definitions to the footer
 * @since 1.0.0
 */
function higo_include_svg_icons() {

    // Define SVG sprite file.
    $svg_icons = get_parent_theme_file_path('/assets/images/svg-icons.svg');

    // If it exists, include it.
    if (file_exists($svg_icons)) {
        require_once($svg_icons);
    }
}
add_action('wp_footer', 'higo_include_svg_icons', 9999);


/**
 * Return SVG markup
 *
 * @since 1.0.0
 * @param string $icon  Required SVG icon filename.
 * @return string SVG markup.
 */
function higo_svg_icon($icon) {

    // Define an icon.
    if (! $icon) {
        return esc_html__('Please define an SVG icon filename.', 'higo');
    }

    // Begin SVG markup.
    $svg = '<svg class="icon icon-' . esc_attr($icon) . '" aria-hidden="true" role="img">';

    /*
     * Display the icon.
     *
     * The whitespace around `<use>` is intentional - it is a work around to a keyboard navigation bug in Safari 10.
     *
     * See https://core.trac.wordpress.org/ticket/38387.
     */

     $svg .= ' <use href="#icon-' . esc_html($icon) . '" xlink:href="#icon-' . esc_html($icon) . '"></use> ';

    $svg .= '</svg>';

    return $svg;
}


/**
 * Add dropdown icon if menu item has children.
 *
 * @since 1.0.0
 * @param  string $title The menu item's title.
 * @param  object $item  The current menu item.
 * @param  array  $args  An array of wp_nav_menu() arguments.
 * @param  int    $depth Depth of menu item. Used for padding.
 * @return string $title The menu item's title with dropdown icon.
 */
function higo_dropdown_icon_to_menu_link($title, $item, $args, $depth) {
    if ('higo_menu_header' === $args->theme_location || 'higo_menu_offcanvas_one' === $args->theme_location) {
        foreach ($item->classes as $value) {
            if (strpos($args->menu_class, 'menu-navbar') !== false) {
                $icon = (0 === $depth) ? 'chevron-bottom' : 'chevron-right';
            } elseif (strpos($args->menu_class, 'menu-offcanvas') !== false) {
                $icon = 'chevron-bottom';
            } else {
                $icon = '';
            }
            if ($icon && ('menu-item-has-children' === $value || 'page_item_has_children' === $value)) {
                $title = $title . higo_svg_icon($icon);
            }
        }
    }

    return $title;
}
add_filter('nav_menu_item_title', 'higo_dropdown_icon_to_menu_link', 10, 4);


/**
 * Display SVG icons in social links menu.
 *
 * @param  string  $item_output The menu item output.
 * @param  WP_Post $item        Menu item object.
 * @param  int     $depth       Depth of the menu.
 * @param  array   $args        wp_nav_menu() arguments.
 * @return string  $item_output The menu item output with social icon.
 */
function higo_nav_menu_social_icons($item_output, $item, $depth, $args) {
    $social_icons = higo_social_links_icons();

   // Add SVG icon inside menu if there is supported URL.
   if ('higo_menu_header' != $args->theme_location && 'higo_menu_offcanvas' != $args->theme_location) {
       foreach ($social_icons as $attr => $value) {
           if (false !== strpos($item_output, $attr)) {
               $pattern = '/<a(.+?)>.+?<\/a>/i';
               $item_output = preg_replace($pattern, '<a$1>'.higo_svg_icon($value).'</a>', $item_output);
           }
       }
   }

    return $item_output;
}
add_filter('walker_nav_menu_start_el', 'higo_nav_menu_social_icons', 10, 4);


/**
 * Returns an array of supported social links (URL and icon name).
 *
 * @return array $social_links_icons
 */
function higo_social_links_icons() {

    // Supported social links icons.
    $social_links_icons = array(
        '?feed=rss'       => 'rss',
        '/feed'           => 'rss',
        'behance.net'     => 'behance',
        'bloglovin.com'   => 'bloglovin',
        'codepen.io'      => 'codepen',
        'deviantart.com'  => 'deviantart',
        'digg.com'        => 'digg',
        'dribbble.com'    => 'dribbble',
        'facebook.com'    => 'facebook',
        'flickr.com'      => 'flickr',
        'foursquare.com'  => 'foursquare',
        'github.com'      => 'github',
        'instagram.com'   => 'instagram',
        'linkedin.com'    => 'linkedin',
        'livejournal.com' => 'livejournal',
        'mailto:'         => 'envelope-o',
        'medium.com'      => 'medium',
        'pinterest.com'   => 'pinterest',
        'plus.google.com' => 'google-plus',
        'reddit.com'      => 'reddit-alien',
        'slideshare.net'  => 'slideshare',
        'snapchat.com'    => 'snapchat-ghost',
        'soundcloud.com'  => 'soundcloud',
        'spotify.com'     => 'spotify',
        'stumbleupon.com' => 'stumbleupon',
        'tumblr.com'      => 'tumblr',
        'twitch.tv'       => 'twitch',
        'twitter.com'     => 'twitter',
        'vimeo.com'       => 'vimeo',
        'vk.com'          => 'vk',
        'yelp.com'        => 'yelp',
        'youtube.com'     => 'youtube'
    );

    /**
     * Filter Higo social links icons.
     *
     * @since 1.0.0
     *
     * @param array $social_links_icons Array of social links icons.
     */
    return apply_filters('higo_social_links_icons', $social_links_icons);
}
