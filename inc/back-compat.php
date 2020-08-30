<?php
/**
 * Higo back compatibility functionality
 *
 * Prevents Higo from running on WordPress versions prior to `HIGO_MIN_WP_VERSION`
 * and on PHP versions prior to `HIGO_MIN_PHP_VERSION`.
 * `HIGO_MIN_WP_VERSION` and `HIGO_MIN_PHP_VERSION` must be defined in functions.php file.
 *
 * @package WordPress
 * @subpackage Higo
 * @since 1.0.0
 */


/**
 * Checks if WordPress and PHP versions match min requirements
 *
 * @since 1.0.0
 * @return string|null
 */
function higo_check_wp_php() {

	if ( version_compare( PHP_VERSION, HIGO_MIN_PHP_VERSION, '<' ) && version_compare( $GLOBALS['wp_version'], HIGO_MIN_WP_VERSION, '<' ) ) :
		 $flag = 'php-wp';
	elseif ( version_compare( $GLOBALS['wp_version'], HIGO_MIN_WP_VERSION, '<' ) ) :
		$flag = 'wp';
	elseif ( version_compare( PHP_VERSION, HIGO_MIN_PHP_VERSION, '<' ) ) :
		$flag = 'php';
	 else:
		 return;
	 endif;

     return  $flag;

}

// Return earlier if we're good to go
if ( !higo_check_wp_php() ) {
	return;
}

/**
 * Prevents switching to Higo on not supported WordPress and PHP versions.
 *
 * Switches to the default theme.
 *
 * @since 1.0.0
 */
function higo_theme_switch() {
	switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );
	unset( $_GET['activated'] );
	add_action( 'admin_notices', 'higo_upgrade_notice' );
}
add_action( 'after_switch_theme', 'higo_theme_switch' );


/**
 * Adds message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * Higo on not supported WordPress and PHP versions
 *
 * @since 1.0.0
 */
function higo_upgrade_notice() {
	if ( higo_check_wp_php() == 'wp') {
		$message = sprintf( esc_html__( 'Higo requires at least WordPress version %s. You are running version %s. Please upgrade and try again.', 'higo' ), HIGO_MIN_WP_VERSION, $GLOBALS['wp_version'] );
	} elseif ( higo_check_wp_php() == 'php') {
		$message = sprintf( esc_html__( 'Higo requires at least PHP version %s. You are running version %s. Please upgrade and try again.', 'higo' ), HIGO_MIN_PHP_VERSION, PHP_VERSION );
	} else {
		$message = sprintf( esc_html__( 'Higo requires at least WordPress version %s and PHP version %s. You are running version %s and %s accordingly. Please upgrade and try again.', 'higo' ), HIGO_MIN_WP_VERSION, HIGO_MIN_PHP_VERSION, $GLOBALS['wp_version'], PHP_VERSION );
	}
	printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Prevents the Customizer from being loaded on not supported WordPress and PHP versions.
 *
 * @since 1.0.0
 */
function higo_theme_customize() {

	if ( higo_check_wp_php() == 'wp') {
		wp_die(  sprintf( esc_html__( 'Higo requires at least WordPress version %s. You are running version %s. Please upgrade and try again.', 'higo' ), HIGO_MIN_WP_VERSION, $GLOBALS['wp_version'] ), '', array('back_link' => true,));
	} elseif ( higo_check_wp_php() == 'php') {
		$message = sprintf( esc_html__( 'Higo requires at least PHP version %s. You are running version %s. Please upgrade and try again.', 'higo' ), HIGO_MIN_PHP_VERSION, PHP_VERSION );
		wp_die(  sprintf( esc_html__( 'Higo requires at least PHP version %s. You are running version %s. Please upgrade and try again.', 'higo' ), HIGO_MIN_PHP_VERSION, PHP_VERSION ), '', array('back_link' => true,));
	} else {
		wp_die(  sprintf( esc_html__( 'Higo requires at least WordPress version %s and PHP version %s. You are running version %s and %s accordingly. Please upgrade and try again.', 'higo' ), HIGO_MIN_WP_VERSION, HIGO_MIN_PHP_VERSION, $GLOBALS['wp_version'], PHP_VERSION ), '', array('back_link' => true,));
	}
}
add_action( 'load-customize.php', 'higo_theme_customize' );


/**
 * Prevents the Theme Preview from being loaded on not supported WordPress and PHP versions
 *
 * @since 1.0.0
 */
function higo_theme_preview() {
	if ( isset( $_GET['preview'] ) ) {
		if ( higo_check_wp_php() == 'wp') {
			wp_die(  sprintf( esc_html__( 'Higo requires at least WordPress version %s. You are running version %s. Please upgrade and try again.', 'higo' ), HIGO_MIN_WP_VERSION, $GLOBALS['wp_version'] ), '', array('back_link' => true,));
		} elseif ( higo_check_wp_php() == 'php') {
			$message = sprintf( esc_html__( 'Higo requires at least PHP version %s. You are running version %s. Please upgrade and try again.', 'higo' ), HIGO_MIN_PHP_VERSION, PHP_VERSION );
			wp_die(  sprintf( esc_html__( 'Higo requires at least PHP version %s. You are running version %s. Please upgrade and try again.', 'higo' ), HIGO_MIN_PHP_VERSION, PHP_VERSION ), '', array('back_link' => true,));
		} else {
			wp_die(  sprintf( esc_html__( 'Higo requires at least WordPress version %s and PHP version %s. You are running version %s and %s accordingly. Please upgrade and try again.', 'higo' ), HIGO_MIN_WP_VERSION, HIGO_MIN_PHP_VERSION, $GLOBALS['wp_version'], PHP_VERSION ), '', array('back_link' => true,));
		}
	}
}
add_action( 'template_redirect', 'higo_theme_preview' );
