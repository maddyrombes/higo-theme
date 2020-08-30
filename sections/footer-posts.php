<?php
/**
 * The template for displaying footer posts section
 *
 * @package WordPress
 * @subpackage Higo
 * @since 1.0.0
 */

if ( (get_theme_mod('blog_popular_posts') && is_home()) || is_404() || is_search() || is_attachment() ) {

    $title = esc_html__( 'Popular stories', 'higo' );

    $args = array(
        'orderby' => 'comment_count',
        'posts_per_page' => '4',
        'ignore_sticky_posts' => '1',
        'post_status'    => 'publish',
    );

} elseif ( is_single() ) {

    $title = esc_html__( 'Related stories', 'higo' );
    $categories = get_the_category();
    $category_id = $categories[0]->cat_ID;

    $args = array(
        'cat' => $category_id,
        'posts_per_page' => '4',
        'post__not_in' => explode(' ', get_the_ID()),
        'ignore_sticky_posts' => '1',
        'post_status'    => 'publish',
    );

} else {

    return;
}

$footer_posts = new WP_Query( $args );


// Return early if no posts
if ( $footer_posts->post_count < 1 ) {
    return;
}

$class = 'c-card-grid c-card-grid--m-2-cols c-card-grid--l-3-cols';

if ( $footer_posts->have_posts() ) : ?>

    <section class="footerPosts footerPosts--count-<?php echo esc_attr($footer_posts->post_count); ?>">

        <div class="container">

            <h2 class="footerPosts__title h3"><?php echo esc_html($title); ?></h2>

            <div class="row">

                <?php while ( $footer_posts->have_posts() ) : $footer_posts->the_post(); ?>

                    <div class="footerPosts__item">
                        <?php get_template_part( 'content/content-footer-posts'); ?>
                    </div>

                <?php endwhile; ?>

            </div>

        </div>

    </section>

<?php wp_reset_postdata(); endif;
