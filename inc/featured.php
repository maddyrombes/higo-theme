<?php

/**
 * Filter the home page posts, and remove any featured post ID's from it. Hooked
 * onto the 'pre_get_posts' action, this changes the parameters of the query
 * before it gets any posts.
 *
 * @link https://developer.wordpress.com/2012/05/14/querying-posts-without-query_posts/
 * @param WP_Query $query
 * @return WP_Query Possibly modified WP_query
 */
function higo_featured_posts__remove_from_home( $query = false ) {

  // Return earlier if not home, not a query, not main query, or no featured posts
  if ( ! is_home() || ! is_a( $query, 'WP_Query' ) || ! $query->is_main_query() || ! higo_featured_posts_ids() ) :
    return;
  endif;

  // Exclude featured posts from the main query
  $query->set( 'post__not_in', higo_featured_posts_ids() );

}
add_action( 'pre_get_posts', 'higo_featured_posts__remove_from_home' );


/**
 * Get ids of all sticky posts with featured image.
 * The results are stored in a transient, to prevent running this extra query on every page load.
 *
 * @return array Sticky posts' ids
 */
function higo_featured_posts_ids() {

  if ( false === ( $featured_post_ids = get_transient( 'higo_featured_post_ids' ) ) ) {

    // Proceed only if sticky posts exist.
    if ( get_option( 'sticky_posts' ) ) {
      $featured_args = array(
        'post__in'      => get_option( 'sticky_posts' ),
        'post_status'   => 'publish',
        'no_found_rows' => true
      );

      // The Featured Posts query.
      $featured = new WP_Query( $featured_args );

      // Proceed only if published posts with thumbnails exist
      if ( $featured->have_posts() ) {
        while ( $featured->have_posts() ) {
          $featured->the_post();
          if ( has_post_thumbnail( $featured->post->ID ) ) {
            $featured_post_ids[] = $featured->post->ID;
          }
          set_transient( 'higo_featured_post_ids', $featured_post_ids, 12 * HOUR_IN_SECONDS );
        }
      }
    }
  }

  // Return the post ID's
  return $featured_post_ids;
}

/**
 * Reset the transient when sticky_posts option has been updated.
 *
 * @link https://wordpress.stackexchange.com/questions/288099/store-sticky-posts-ids-in-a-transient
 */
add_action('update_option_sticky_posts', function( $old_value, $value ) {

  // If we have sticky posts, run the query and set the transient
  if ( $value ) {

    $featured_args = array(
      'post__in'      => $value,
      'post_status'   => 'publish',
      'no_found_rows' => true
    );

    // The Featured Posts query.
    $featured = new WP_Query( $featured_args );

    // Proceed only if published posts with thumbnails exist
    if ( $featured->have_posts() ) {
      while ( $featured->have_posts() ) {
        $featured->the_post();
        if ( has_post_thumbnail( $featured->post->ID ) ) {
          $featured_post_ids[] = $featured->post->ID;
        }
      }

      set_transient( 'higo_featured_post_ids', $featured_post_ids );
    }

  } else {

    // Delete the transient if there are no sticky posts
    delete_transient( 'higo_featured_post_ids' );

  }

}, 10, 2);
