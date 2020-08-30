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

        <?php higo_post_categories(); ?>

        <?php the_title( '<h1 class="c-article__title">', '</h1>' ); ?>

        <?php
        if ( !get_theme_mod('single_posts_thumbnail_display') ) {
            the_post_thumbnail();
        } ?>

        <?php higo_manual_excerpt(); ?>

        <?php higo_social_share_buttons(); ?>

        <div class="c-post-meta-list">
            <?php higo_post_author(); ?>
            <?php higo_post_time(); ?>
            <?php higo_post_comments(); ?>
            <?php edit_post_link(); ?>
        </div>

    </header>

    <div class="c-article__content">
        <?php the_content(); ?>
        <?php wp_link_pages(); ?>

    </div>

    <?php if ( get_the_tag_list() ) : ?>
        <footer class="c-article__footer">
            <?php higo_post_tags(); ?>
        </footer>
    <?php endif; ?>

</article>
