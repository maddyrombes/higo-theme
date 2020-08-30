<?php
/**
* The search loop
*
* @package WordPress
* @subpackage Higo
* @since 1.1.0
*/
?>

<section class="search-results">

    <header class="search-results__header">
        <h1><?php
        /* translators: %s: search query. */
        printf(esc_html__('Search Results for: %s', 'higo'), '<span>' . get_search_query() . '</span>');
        ?></h1>
        <?php get_search_form(); ?>
    </header>

    <?php if (higo_get_search_menu()): ?>
        <div class="search-results__menu">
            <?php echo higo_get_search_menu(); ?>
        </div>
    <?php endif; ?>

    <div class="search-results__results">

        <div class="c-card-list  js-c-card-list-ajax">
            <?php while (have_posts()) : the_post(); ?>
                <div class="c-card-list__item  js-c-card-list-ajax__item">
                    <?php get_template_part('content/content', 'search'); ?>
                </div>
            <?php endwhile; ?>
        </div>

    </div>

</section>
