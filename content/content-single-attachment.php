<?php
/**
 * Template part for displaying post content in single.php
 *
 * @package WordPress
 * @subpackage Higo
 * @since 1.0.0
 */
 ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('c-article'); ?>>

    <header class="c-article__header">

        <?php the_title( '<h1 class="c-article__title">', '</h1>' ); ?>

        <?php higo_manual_excerpt(); ?>

        <div class="c-post-meta-list">
            <?php edit_post_link(); ?>
        </div>

    </header>

    <div class="c-article__content">
        <?php the_content(); ?>
    </div>


</article>
