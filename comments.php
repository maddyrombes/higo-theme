<?php
/**
 * The template for displaying comments
 *
 * @package WordPress
 * @subpackage Higo
 * @since 1.0.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
    return;
}
?>

<section id="comments" class="comments-area">

    <?php if ( have_comments() ) : ?>
    <h3 class="comments-area__title">
        <?php
            $comments_number = get_comments_number();
            if ( 1 === $comments_number ) {
                esc_html_e('One comment', 'higo' );
            } else {
                printf(
                    /* translators: %s: number of comments */
                    _n( '%s comment', '%s comments', $comments_number, 'higo' ),
                    number_format_i18n( $comments_number )
                );
            }
        ?>
    </h3>

    <div class="comment-list">
        <?php wp_list_comments(array('callback' => 'higo_comment'));?>
    </div>

    <?php the_comments_navigation(); ?>

<?php endif; // Check for have_comments(). ?>

<?php
    // If comments are closed and there are comments, let's leave a little note, shall we?
    if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
?>
    <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'higo' ); ?></p>
<?php endif; ?>

<?php higo_comment_form(); ?>
<?php // comment_form(); ?>

</section>
