<?php
/**
* The
*
* @package WordPress
* @subpackage Higo
* @since 1.0.0
*/


$sticky_posts = get_option('sticky_posts');
if ( count($sticky_posts) == 1 ) {
    $size = 'thumb-featured-one';
} elseif ( count($sticky_posts) == 2) {
    $size = 'thumb-featured-two';
} else {
    $size = 'thumb-featured-three';
}

?>

<div class="c-card c-card--image">

    <a class="c-card__link" href="<?php echo esc_url(get_permalink()); ?>" rel="bookmark"></a>

    <?php if ( '' !== get_the_post_thumbnail() ) : ?>
        <div class="c-card__image">

            <div class="c-fluid-image js-c-fluid-image">
                <div class="c-fluid-image__inner">
                    <?php the_post_thumbnail($size); ?>
                </div>
            </div>

        </div>
    <?php endif; ?>

    <div class="c-card__content">

        <?php the_title( '<h3 class="c-card__title">', '</h3>' ); ?>

        <?php higo_post_categories(); ?>

    </div>

</div>
