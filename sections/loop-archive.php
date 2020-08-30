<?php
/**
* The archive loop
*
* @package WordPress
* @subpackage Higo
* @since 1.1.0
*/
?>

<section class="archive-results">

    <header class="archive-results__header">
        <?php the_archive_title('<h1>', '</h1>'); ?>
        <?php the_archive_description('<div>', '</div>'); ?>
    </header>

    <div class="c-card-list c-card-list--grid  js-c-card-list-ajax">
        <?php while (have_posts()) : the_post(); ?>
            <div class="c-card-list__item  js-c-card-list-ajax__item">
                <?php get_template_part( 'content/content', 'grid'); ?>
            </div>
        <?php endwhile; ?>
    </div>

</section>
