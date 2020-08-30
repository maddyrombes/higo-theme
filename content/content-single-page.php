<?php
/**
 * Template part for displaying post content in page.php
 *
 * @package WordPress
 * @subpackage Higo
 * @since 1.0.0
 */
 ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('entry'); ?>>

    <header class="entry-header">
        <?php the_title( '<h1 class="post-title">', '</h1>' ); ?>
    </header>

    <div class="entry-content">
        <?php

        the_content();

        wp_link_pages();
        ?>
    </div>

    <?php if ( get_edit_post_link() ) : ?>
        <footer calss="entry-footer">
            <?php edit_post_link(); ?>
        </footer>
    <?php endif; ?>

</article>
