<?php
/**
* The search template file
*
* @package WordPress
* @subpackage Higo
* @since 1.1.0
*/

get_header(); ?>

<section class="loopSidebarHolder">

    <div class="loopSidebarHolder__inner">

        <div class="loopSidebarHolder__loop">

            <?php

            // Let's start the loop
            if ( have_posts() ) :

                get_template_part( 'sections/loop', 'search' );

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
