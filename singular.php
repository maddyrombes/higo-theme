<?php
/**
* The template for displaying all single posts and pages
*
* @package WordPress
* @subpackage Higo
* @since 1.0.0
*/

get_header(); ?>

<section class="loopSidebarHolder">

    <div class="loopSidebarHolder__inner">

        <div class="loopSidebarHolder__loop">

            <?php while ( have_posts() ) : the_post();

                if ( is_page() ) {
                    get_template_part( 'content/content-single', 'page' );
                } elseif (is_attachment() ) {
                    get_template_part( 'content/content-single', 'attachment' );
                } else {
                    get_template_part( 'content/content-single', 'post' );
                }

                // If comments are open or we have at least one comment, load up the comment template.
                if ( ( comments_open() || get_comments_number() ) && !is_attachment() ) :
                    comments_template();
                endif;

            endwhile; // End of the loop. ?>

        </div>

        <?php get_sidebar(); ?>

    </div>

</section>

<?php get_footer();
