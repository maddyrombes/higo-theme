<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @package WordPress
 * @subpackage Higo
 * @since 1.0.0
 */
?>

<section class="no-results not-found">

	<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

		<h1><?php esc_html_e( 'No posts yet.', 'higo' ); ?></h1>

		<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'higo' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

	<?php elseif ( is_search() ) : ?>

		<h1><?php esc_html_e( 'Nothing found.', 'higo' ); ?></h1>

		<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'higo' ); ?></p>

		<?php
			get_search_form();

	elseif ( is_404() ) : ?>


		<h1><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'higo' ); ?></h1>

		<p><?php esc_html_e( 'It looks like nothing was found. Perhaps searching can help?', 'higo' ); ?></p>

		<?php get_search_form();

	endif; ?>

</section>
