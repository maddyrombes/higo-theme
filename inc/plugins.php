<?php
/**
 * Register required plugins for Higo.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Higo
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

/** Include the TGM_Plugin_Activation class. */
require_once get_parent_theme_file_path( '/inc/class-tgm-plugin-activation.php' );

add_action( 'tgmpa_register', 'higo_register_required_plugins' );

// Registers the required plugins for Higo.
function higo_register_required_plugins() {

	$plugins = array(

		array(
			'name'               => esc_html__( 'SVG support', 'higo' ),
			'slug'               => 'svg-support',
			'required'           => false,
		),

		array(
			'name'               => esc_html__( 'Force Regenerate Thumbnails', 'higo' ),
			'slug'               => 'force-regenerate-thumbnails',
			'required'           => false,
		),

		array(
			'name'               => esc_html__( 'Contact Form 7', 'higo' ),
			'slug'               => 'contact-form-7',
			'required'           => false,
		),

		array(
			'name'               => esc_html__( 'MailChimp for WordPress', 'higo' ),
			'slug'               => 'mailchimp-for-wp',
			'required'           => false,
		),

		array(
			'name'               => esc_html__( 'One Click Demo Import', 'higo' ),
			'slug'               => 'one-click-demo-import',
			'required'           => false,
		)
	);

	$config = array(
		'id'           => 'higo',
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'parent_slug'  => 'themes.php',
		'capability'   => 'edit_theme_options',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
		'message'      => '',
	);

	tgmpa( $plugins, $config );

}
