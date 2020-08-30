<?php
/**
 * The template part for displaying the navbar
 *
 * @package WordPress
 * @subpackage Higo
 * @since 1.0.0
 */
?>

<div id="navbar" class="navbar js-navbar">

    <div class="navbar__inner">

        <div class="container-xl">

            <div class="navbar__search">
                <button class="search-toggle js-search-toggle">
                    <?php echo higo_svg_icon('search'); ?>
                </button>
            </div>

            <?php if ( has_nav_menu( 'higo_menu_header' ) ) : ?>
                <nav class="navbar__nav">
                    <?php wp_nav_menu( array(
                        'theme_location' => 'higo_menu_header',
                        'container'      => false,
                        'menu_class'      => 'menu menu-navbar js-menu-navbar',
                        'depth'          => '3',
                        'item_spacing' => 'discard'
                    )); ?>
                </nav>
            <?php endif; ?>

            <div class="navbar__toggle">
                <button aria-expanded="false" type="button" aria-label="<?php esc_attr_e( 'Opens / Closes Menu', 'higo' ); ?>" class="offcanvas-toggle js-offcanvas-toggle"> <span></span><span></span><span></span><span></span></button>
            </div>

        </div>

    </div>

</div>
