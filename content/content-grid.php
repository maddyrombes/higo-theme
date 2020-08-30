<?php
/**
* The
*
* @package WordPress
* @subpackage Higo
* @since 1.0.0
*/

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('c-card'); ?>>

    <a class="c-card__link" href="<?php echo esc_url(get_permalink()); ?>" rel="bookmark"></a>

    <?php if ( '' !== get_the_post_thumbnail() ) : ?>
        <div class="c-card__image">

            <div class="c-fluid-image  js-c-fluid-image">
                <div class="c-fluid-image__inner">
                    <?php the_post_thumbnail('thumb-blog-grid'); ?>
                </div>
            </div>

        </div>
    <?php endif; ?>

    <div class="c-card__content">

        <?php higo_post_categories(); ?>

        <?php the_title( '<h3 class="c-card__title">', '</h3>' ); ?>

        <?php if ( !post_password_required() ) : ?>
            <span class="c-card__body"><?php higo_shorten_excerpt(15); ?></span>
        <?php endif; ?>

        <div class="c-post-meta-list">
            <?php higo_post_time(); ?>
            <?php higo_post_comments(); ?>
        </div>



    </div>

</article>
