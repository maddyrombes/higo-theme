<?php
/**
* The main loop
*
* @package WordPress
* @subpackage Higo
* @since 1.1.0
*/

$loop_class[] = 'c-card-list';

if ( get_theme_mod('blog_layout', 'grid') ) {
    $loop_class[] = 'c-card-list--' . get_theme_mod('blog_layout', 'grid');
}

$loop_classes = implode(' ', $loop_class);
?>

<section>

    <h2 class="bordered-title h3 <?php echo ( is_paged() ? 'screen-reader-text' : '') ?>"><span><?php esc_html_e('Latest stories', 'higo'); ?></span></h2>

    <div class="<?php echo esc_attr($loop_classes); ?> js-c-card-list-ajax">

        <?php while ( have_posts() ) : the_post(); ?>
            <div class="c-card-list__item js-c-card-list-ajax__item">
                <?php get_template_part( 'content/content', get_theme_mod('blog_layout', 'grid')); ?>
            </div>
        <?php endwhile; ?>

    </div>

</section>
