<?php
/**
 * Higo one-click demo import functionality
 *
 * @package WordPress
 * @subpackage Higo
 * @since 1.2.0
 */

 function higo_import_demo_files() {
   return array(
     array(
       'import_file_name'             => esc_html__( 'Higo Demo Content', 'higo' ),
       'categories'                   => array( 'Higo Demo Content' ),
       'local_import_file'            => get_template_directory() . '/assets/demo/demo-content.xml',
       'local_import_widget_file'     => get_template_directory() . '/assets/demo/widgets.wie',
       'local_import_customizer_file' => get_template_directory() . '/assets/demo/customizer.dat'
     )
   );
 }
 add_filter( 'pt-ocdi/import_files', 'higo_import_demo_files' );

//
add_filter( 'pt-ocdi/regenerate_thumbnails_in_content_import', '__return_false' );

//
function ocdi_after_import_setup() {

  // Assign menus to their locations.
  $main_menu = get_term_by( 'name', 'Main', 'nav_menu' );
  $footer_menu = get_term_by( 'name', 'Footer menu', 'nav_menu' );
  $offcanvas_menu = get_term_by( 'name', 'Offcanvas', 'nav_menu' );
  $social_menu = get_term_by( 'name', 'Social short', 'nav_menu' );

	set_theme_mod( 'nav_menu_locations', array(
      'higo_menu_header' => $main_menu->term_id,
      'higo_menu_offcanvas_one' => $offcanvas_menu->term_id,
      'higo_menu_offcanvas_two' => $social_menu->term_id,
      'higo_menu_footer_two' => $footer_menu->term_id,
      'higo_menu_footer_one' => $social_menu->term_id,
		)
	);
}
add_action( 'pt-ocdi/after_import', 'ocdi_after_import_setup' );
