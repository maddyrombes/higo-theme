<?php

if ( ! function_exists( 'higo_get_search_menu' ) ) :
/**
 *
 *
 * @package WordPress
 * @subpackage Higo
 * @since 1.0.0
 */
function higo_get_search_menu() {

    // Check if this is a search results page
    if ( !is_search())
        return;


    // New query with current search request
    $query = new WP_Query(array(
        'post_status' => 'publish',
        's' => $_GET['s'],
        'posts_per_page' => '-1'
    ));

    // Total number of posts found
    $posts_count = $query->found_posts;

    // An array with all found post's IDs
    $post_id_array = array();

    foreach($query->posts as $post) {
        $post_id_array[] = $post->ID;
    }

    // An array with all categories of the found posts
    $cat_ids = array();

    foreach ($post_id_array as $post_id) {

        $categories = get_the_category($post_id);

        foreach($categories as $category) {
            $cat_id = $category->cat_ID;
            $cat_name = $category->cat_name;

                $cat_ids[] = $cat_id;

        }

        // Add an item for all posts results
        array_unshift($cat_ids , 'all');

        // Exclude duplicates
        $cat_ids = array_unique($cat_ids);
    }

    // If more than 1 ( 2 with added 'all') category, proceed with the menu markup
    if ( count($cat_ids) > '2'  ) {

        $return = '<ul class="c-search-menu">';

        foreach ($cat_ids as $cat_id) {

            if ( $cat_id == 'all') {
                $name = esc_html__( 'All', 'higo' ) . ' ('.$posts_count.')';
                $title = esc_html__( 'View all found posts.', 'higo' );
                $link = esc_url('/?s='.$_GET['s']);
                $class = isset($_GET['cat']) ? '' : 'c-search-menu__item--current';
            } else {
                $count_in_cat = count( get_posts('s='.$_GET['s'].'&category='.$cat_id.'') );
                $name = get_cat_name( $cat_id ) . ' ('.$count_in_cat.')';
                $title = get_cat_name( $cat_id );
                $link = home_url( '/' ) . '?s=' . $_GET['s'] . '&cat=' . $cat_id;
                $class = ( isset($_GET['cat']) && $_GET['cat'] == $cat_id ) ? 'c-search-menu__item--current' : '';
            }

            $return .= '<li class="c-search-menu__item '.$class.'">';
            $return .= '<a href="'.esc_url( $link ).'" title="'.$title.'?>">'.$name.'</a>';
            $return .= '</li>';
        }
        $return .= '</ul>';

        return $return;
    }

    wp_reset_query();


}
endif;
