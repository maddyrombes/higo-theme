<?php

/**
 *
 *
 * @package WordPress
 * @subpackage Higo
 * @since 1.0.0
 */
function higo_post_time() {

    // Get the post age in days
    $post_age = round((date('U') - get_post_time('U'))/60/60/24);

    // Display published date in human readable format is the post is not older than 4 days
    if ( $post_age < 4 ) {
        $published_date = sprintf(esc_html_x( '%s ago', '%s = human-readable time difference', 'higo' ), human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) );
    } else {
        $published_date = esc_html(get_the_date());
    }

    $time_string = '<time title="%1$s" datetime="%2$s">%3$s</time>';

    $time_title = sprintf( esc_html_x( 'Published on %s', 'Post publish date', 'higo' ), get_the_date() );

    // Include modified date if any. Avaliable to screen readers only
    if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
        $time_string = '<time title="%1$s" datetime="%2$s">%3$s</time><time class="screen-reader-text" datetime="%4$s">%5$s</time>';

        $time_title = sprintf( esc_html_x( 'Published on %1$s; Last updated on %2$s', 'Post publish and update dates', 'higo' ), get_the_date(), get_the_modified_date() );
    }

    $time_string = sprintf( $time_string,
        $time_title, // Published title
        esc_attr( get_the_date( 'c' ) ), // Published datetime
        $published_date, // Published date
        esc_attr( get_the_modified_date( 'c' ) ), // Modified datetime
        esc_html( get_the_modified_date() ) // Modified date
    );

    echo '<span><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a></span>';


}

/**
 *
 *
 * @package WordPress
 * @subpackage Higo
 * @since 1.0.0
 */
function higo_post_author() {
    echo '<span><a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';
}


/**
 *
 *
 * @package WordPress
 * @subpackage Higo
 * @since 1.0.0
 */
function higo_post_comments() {

    if ( !post_password_required() && ( comments_open() || get_comments_number() ) ) {
        echo '<span><a href="'. esc_url(get_comments_link()). '">' . higo_svg_icon('comment') . get_comments_number() .'</a></span>';
    }

}


/**
 * Display the categories (or terms from other taxonomies) assigned
 * to a post ordered by parent-child category relationship.
 *
 * @link https://developer.wordpress.org/reference/functions/wp_list_categories/#Display_Categories_Assigned_to_a_Post
 * @package WordPress
 * @subpackage Higo
 * @since 1.0.0
 */

function higo_post_categories( $taxonomy = 'category' ) {

    global $post;

    // Get the term IDs assigned to post.
    $post_terms = wp_get_object_terms( $post->ID, $taxonomy, array( 'fields' => 'ids' ) );

    // Separator between links.
    $separator = ' &sol; ';

    if ( ! empty( $post_terms ) && ! is_wp_error( $post_terms ) && higo_categorized_blog() ) {

        $term_ids = implode( ',' , $post_terms );

        $terms = wp_list_categories( array(
            'title_li' => '',
            'style'    => 'none',
            'echo'     => false,
            'taxonomy' => $taxonomy,
            'include'  => $term_ids
        ) );

        $terms = rtrim( trim( str_replace( '<br />',  $separator, $terms ) ), $separator );

        // Display post categories.
        printf( '<div class="c-post-categories" aria-label="%1$s">%2$s</div>', esc_html_x( 'Post categories', 'Used before category names.', 'higo' ), $terms);

    }

}






/**
 *
 *
 * @since 1.0.0
 */
function higo_manual_excerpt() {

    if( has_excerpt () ) :
        echo '<p class="post-excerpt">' . get_the_excerpt() . '</p>';
    endif;

}


if ( ! function_exists('higo_shorten_excerpt') ) :
/**
 * Sets the number of words displayed in the excerpt
 *
 * @since 1.0.0
 * @link https://stackoverflow.com/questions/4082662/multiple-excerpt-lengths-in-wordpress
 */
function higo_shorten_excerpt($limit) {

	$excerpt = explode(' ', get_the_excerpt(), $limit);

	if (count($excerpt)>=$limit) {
		array_pop($excerpt);
		$excerpt = implode(" ",$excerpt).'...';
	} else {
		$excerpt = implode(" ",$excerpt);
	}

	$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);

	echo wp_kses_post($excerpt);
}
endif;
