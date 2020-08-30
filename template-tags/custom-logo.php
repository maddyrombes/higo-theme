<?php
if ( ! function_exists( 'higo_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 *
 * Displays site title & subtitle if the custom logo is not available.
 *
 * @package WordPress
 * @subpackage Higo
 * @since 1.0.0
 */
function higo_custom_logo() {

    if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {

        the_custom_logo();

        if ( is_front_page() ) : ?>
            <h1 class="screen-reader-text"><?php bloginfo( 'name' ); ?></h1>
        <?php else : ?>
            <p class="screen-reader-text"><?php bloginfo( 'name' ); ?></p>
        <?php endif;

    } else {

        if ( is_front_page() ) : ?>
            <h1 class="site-name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
        <?php else : ?>
            <p class="site-name h1"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
        <?php endif;

    }

}
endif;
