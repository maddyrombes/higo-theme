<?php

if ( get_theme_mod('blog_ajax_posts') == true  ) {
    add_action( 'wp_enqueue_scripts', 'higo_ajax_pagination_scripts' );

    // For logged in users
    add_action( 'wp_ajax_nopriv_ajax_pagination', 'higo_ajax_pagination' );

    // For anonymous users
    add_action( 'wp_ajax_ajax_pagination', 'higo_ajax_pagination' );
}


function higo_ajax_pagination_scripts() {

    wp_enqueue_script( 'higo-ajax-pagination', get_theme_file_uri('/assets/js/ajax-pagination.js'), array('jquery'), '1.0', true );

    global $template, $wp_query;

    wp_localize_script( 'higo-ajax-pagination', 'ajax_load_more_setings', array(
        'ajaxurl'      => admin_url( 'admin-ajax.php'),
        'query_vars'   => json_encode( $wp_query->query ),
        'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
		'max_page'     => $wp_query->max_num_pages,
        'template'     => basename($template),
        'nonce'        => wp_create_nonce('higo_load_posts_nonce_new'),
        'textLoadMore' => esc_html__('Load more', 'higo'),
        'textLoading'  => esc_html__('Loading...', 'higo')
    ));
}

function higo_ajax_pagination() {

    // Verifying nonce here
    if ( ! wp_verify_nonce( $_REQUEST['nonce'], 'higo_load_posts_nonce_new' ) ) {
        die( 'Security check' );
    }

    $args = json_decode( stripslashes( $_POST['query_vars'] ), true );
    $args['paged'] = $_POST['page'] + 1;
    $args['post_status'] = 'publish';

    // Exclude featured posts from the query
    $args['post__not_in'] = higo_featured_posts_ids();

    $ajax_next_posts = new WP_Query( $args );

    if ($ajax_next_posts->have_posts()) {
        while ( $ajax_next_posts->have_posts() ) : $ajax_next_posts->the_post();

            echo '<div class="c-card-list__item  js-c-card-list-ajax__item">';

                if ( $_POST['template'] == 'search.php') {
                    define('AJAX_SEARCH', true);
                    get_template_part( 'content/content', 'search');
                } elseif ( $_POST['template'] == 'archive.php' ) {
                    define('AJAX_ARCHIVE', true);
                    get_template_part( 'content/content', 'grid');
                } else {
                    define('AJAX_HOME', true);
                    get_template_part( 'content/content', get_theme_mod('blog_layout', 'grid'));
                }

            echo '</div>';

        endwhile;
    }

    // Reset the post data
    wp_reset_postdata();
    die();

}
