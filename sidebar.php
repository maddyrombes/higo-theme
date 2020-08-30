<?php
/**
 * The template for the sidebar with widgets for various pages
 *
 * @package WordPress
 * @subpackage Higo
 * @since 1.0.0
 */

// Return earlier if there must be no sidebar for current page
if ( ! higo_display_sidebar() ) {
    return;
}
?>

<aside id="site-sidebar" class="loopSidebarHolder__sidebar">

    <?php if ( is_single() ) :
        dynamic_sidebar( 'higo_sidebar_single_post' );
    elseif ( is_page() ) :
        dynamic_sidebar( 'higo_sidebar_single_page' );
    else:
        dynamic_sidebar( 'higo_sidebar_blog' );
    endif; ?>

</aside>
