<?php
/**
 * The
 *
 * @package WordPress
 * @subpackage Higo
 * @since 1.0.0
 */

if ( ! function_exists( 'higo_post_thumbnail' ) ) :
/**
 * Prints HTML with post thumbnail
 *
 * @package WordPress
 * @subpackage Higo
 * @since 1.0.0
 */
function higo_post_thumbnail($size, $fluid = false) {

    if ($fluid) {
        $class = 'post-thumbnail--fluid';
    } else {
        $class = '';
    }

    if ( '' !== get_the_post_thumbnail() ) { ?>

        <div class="post-thumbnail <?php echo esc_attr($class); ?> js-c-fluid-image">

            <?php if ($fluid) { ?>
                <div class="post-thumbnail__inner">
            <?php } ?>
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail($size); ?>
            </a>
            <?php if ($fluid) { ?>
                </div>
            <?php } ?>
        </div>

    <?php }

}
endif;
