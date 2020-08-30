<?php
/**
 * The template part for displaying the site's header
 *
 * @package WordPress
 * @subpackage Higo
 * @since 1.0.0
 */
?>

<header id="site-header" class="siteHeader js-site-header">

    <div class="siteHeader__inner">

        <div class="siteHeader__brand  is-movable-by-off-canvas">
            <?php higo_custom_logo(); ?>
        </div>

        <?php get_template_part( 'sections/navbar'); ?>

    </div>

</header>
