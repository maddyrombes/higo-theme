<?php
/**
 * The template for displaying the offcanvas section
 *
 * @package WordPress
 * @subpackage Higo
 * @since Higo 1.0.0
 */
?>

<section id="offcanvas" class="siteOffcanvas js-offcanvas" aria-expanded="false">

    <h2 class="screen-reader-text"><?php esc_html_e('Off canvas navigation', 'higo'); ?></h2>

    <?php if ( has_nav_menu( 'higo_menu_offcanvas_one' ) ) : ?>
        <nav class="siteOffcanvas__nav">
            <?php wp_nav_menu( array(
                'theme_location' => 'higo_menu_offcanvas_one',
                'container' => false,
                'menu_class' => 'menu menu-dropdown menu-offcanvas js-menu-offcanvas',
                'depth' => '3',
                'item_spacing' => 'discard'
            )); ?>
        </nav>
    <?php endif; ?>

    <?php if ( has_nav_menu( 'higo_menu_offcanvas_two' ) ) : ?>
        <nav class="siteOffcanvas__nav">
            <?php wp_nav_menu( array(
                'theme_location' => 'higo_menu_offcanvas_two',
                'container' => false,
                'menu_class' => 'menu menu--inline',
                'depth' => '1',
                'item_spacing' => 'discard'
            )); ?>
        </nav>
    <?php endif; ?>


    <?php if ( get_theme_mod('offcanvas_text', '') ) : ?>
        <p class="siteOffcanvas__text"><?php echo get_theme_mod('offcanvas_text'); ?></p>
    <?php endif; ?>


</section>

<div class="site-overlay js-site-overlay"></div>
