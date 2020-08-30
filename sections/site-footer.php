<?php
/**
* The template part for displaying the site's footer
*
* @package WordPress
* @subpackage Higo
* @since 1.0.0
*/

$footer_copyright_text = get_theme_mod('footer_copyright_text', esc_html__('All rights reserved.', 'higo') );

$footer_text_safe = get_theme_mod('footer_text');

$mc4wp_form_id = get_theme_mod('footer_signup_form_id', '');
?>


<footer id="site-footer" class="siteFooter is-movable-by-off-canvas">

    <?php if( ( $mc4wp_form_id  ) || $footer_text_safe != '' ) : ?>

        <div class="siteFooter__top">
            <div class="siteFooter__container">

                <?php if ( $mc4wp_form_id && do_shortcode( '[mc4wp_form id="'.$mc4wp_form_id.'"]' ) != '[mc4wp_form id="'.$mc4wp_form_id.'"]' ) : ?>
                    <div class="siteFooter__from">
                        <?php echo do_shortcode( '[mc4wp_form id="'.$mc4wp_form_id.'"]' ); ?>
                    </div>
                <?php endif; ?>

                <?php if ($footer_text_safe != '' || has_nav_menu( 'higo_menu_footer_one' ) ) : ?>
                    <div class="siteFooter__text_n_menu">

                        <span><?php echo $footer_text_safe; ?></span>

                        <?php if ( has_nav_menu( 'higo_menu_footer_one' ) ) : ?>
                            <?php wp_nav_menu( array(
                                'theme_location' => 'higo_menu_footer_one',
                                'container'      => false,
                                'menu_class'      => 'menu',
                                'depth'          => '1',
                                'item_spacing' => 'discard'
                            )); ?>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

            </div>
        </div>

    <?php endif; ?>

    <div class="siteFooter__bottom">
        <div class="siteFooter__container">

            <span class="siteFooter__copyright"><?php printf( esc_html__( '&copy;%1$s %2$s', 'higo' ), date('Y'), $footer_copyright_text ); ?></span>

            <?php if ( has_nav_menu( 'higo_menu_footer_two' ) ) : ?>
                <nav class="siteFooter__menu">
                    <?php wp_nav_menu( array(
                        'theme_location' => 'higo_menu_footer_two',
                        'container'      => false,
                        'menu_class'      => 'menu',
                        'depth'          => '1',
                        'item_spacing' => 'discard'
                    )); ?>
                </nav>
            <?php endif; ?>

        </div>
    </div>

</footer>
