<?php
/**
 * The
 *
 * @package WordPress
 * @subpackage Higo
 * @since 1.0.0
 */

?>


<article class="c-card">

    <a class="c-card__link" href="<?php echo esc_url(get_permalink()); ?>" rel="bookmark"></a>

    <?php if ( '' !== get_the_post_thumbnail() ) : ?>
        <div class="c-card__image">

            <div class="c-fluid-image c-fluid-image--3x2  js-c-fluid-image">
                <div class="c-fluid-image__inner">
                    <?php the_post_thumbnail('thumb-related-posts'); ?>
                </div>
            </div>

        </div>
    <?php endif; ?>

    <div class="c-card__content">

        <?php the_title( '<h3 class="c-card__title h4">', '</h3>' ); ?>


        <div class="c-post-meta-list">
            <?php higo_post_time(); ?>
            <?php higo_post_comments(); ?>
        </div>

    </div>

</article>
