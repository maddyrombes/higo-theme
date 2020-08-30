<?php
/**
* The main template file
*
* @package WordPress
* @subpackage Higo
* @since 1.0.0
*/

get_header(); ?>

<?php get_template_part( 'sections/featured-slider'); ?>

<section class="loopSidebarHolder">

    <div class="loopSidebarHolder__inner">

        <div class="loopSidebarHolder__loop">

            <?php

            // Let's start the loop
            if ( have_posts() ) :

                get_template_part( 'sections/loop', 'main' );

                the_posts_pagination();

            else :

                get_template_part( 'sections/no-results' );

            endif;
            ?>

        </div>

        <?php get_sidebar(); ?>

    </div>

</section>

<?php get_footer();
