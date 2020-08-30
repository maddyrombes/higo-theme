<?php
/**
 * Enqueue scripts and styles
 *
 * @package WordPress
 * @subpackage Higo
 * @since 1.0.0
 */

function higo_enqueue() {

    // Enqueue the Modernizr script in the head
    wp_enqueue_script('modernizr', get_theme_file_uri('/assets/js/modernizr.js'), array(), false, false);

    // Enqueue theme's main stylesheet
    wp_enqueue_style('higo-style', get_theme_file_uri('/assets/css/main.css'), array(), '');

    // Add support for languages written in a Right To Left (RTL) direction
    wp_style_add_data( 'higo-style', 'rtl', 'replace' );

    // Enqueue various vendor scripts used by the theme, combined in one file
    wp_enqueue_script('higo-vendors-js', get_theme_file_uri('/assets/js/vendors.js'), array('jquery'), '', true);

    // Enqueue theme's custom scripts
    wp_enqueue_script('higo-custom-js', get_theme_file_uri('/assets/js/custom.js'), array('jquery', 'higo-vendors-js'), '', true);

    // Enqueue comment reply script if required
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    /* Dequeue Contact Form 7 Plugin's styles
     * Higo has it's own styles for that
     * @see https://codex.wordpress.org/Function_Reference/is_plugin_active
     */
    include_once(ABSPATH . 'wp-admin/includes/plugin.php');
    if (is_plugin_active('contact-form-7/wp-contact-form-7.php')) {
        wp_dequeue_style('contact-form-7');
    }

    $custom_css = '';

    // Navbar height is set in `src/sass/_variables.scss`
    $navbar_height = 60;
    $logo_height = get_theme_mod('logo_height', '30');
    $logo_padding = get_theme_mod('logo_padding', '40');
    $logo_height_mobile = get_theme_mod('logo_height_mobile', '20');
    $logo_padding_mobile = ($navbar_height - $logo_height_mobile)/2;
    $navbar_btns_top = ($navbar_height + (($logo_height + ($logo_padding*2) - $navbar_height) / 2)) * -1;

    // Apply styles from customzier for bigger screens
    // See 'grid-breakpoint l' in `_variables.scss`
    $custom_css .= '

        .siteHeader__brand {
            padding-top: '.$logo_padding_mobile.'px;
            padding-bottom: '.$logo_padding_mobile.'px;
        }
        .custom-logo {
            height: '.$logo_height_mobile.'px;
            width: auto;
        }

		@media (min-width: 990px) {
			.siteHeader__brand {
				padding-top: '.$logo_padding.'px;
				padding-bottom: '.$logo_padding.'px;
			}
            .custom-logo {
                height: '.$logo_height.'px;
                width: auto;
            }
			.navbar__toggle,
			.navbar__search {
				top: '.$navbar_btns_top.'px;
			}
		}
	';

    $color_body = get_theme_mod( 'color_body' );
    $background_body = get_theme_mod('background_body');
    $primary_color = get_theme_mod( 'primary_color' );


    $custom_css .= '
    	body {
    		color: '.$color_body.';
            background-color: '.$background_body.';
    	}

        .button:hover,
        button:hover,
        input[type="button"]:hover,
        input[type="reset"]:hover,
        input[type="submit"]:hover {
            border-color: '.$primary_color.';
            background-color: '.$primary_color.';
        }

        .offcanvas-toggle:hover span {
            background-color: '.$primary_color.';
        }

        a,
        a:hover,
        .c-post-categories a:hover,
        .c-post-meta-list a:hover,
        .menu-navbar .menu-item a:hover,
        .menu-offcanvas .menu-item a:hover,
        .c-card:hover .c-card__title,
        .c-social-buttons a:hover,
        .search-toggle:hover,
        .c-search-menu a:hover,
        .c-search-menu .c-search-menu__item--current a,
        .siteFooter__text_n_menu a:hover,
        .siteFooter__text_n_menu a:focus {
            color: '.$primary_color.';
        }
    ';

    wp_add_inline_style('higo-style', $custom_css);
}
add_action('wp_enqueue_scripts', 'higo_enqueue');
