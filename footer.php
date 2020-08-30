<?php
/**
 * The theme's footer template
 *
 * @package WordPress
 * @subpackage Higo
 * @since 1.0.0
 */
?>

        <?php get_template_part( 'sections/footer-posts'); ?>

    </main>

    <?php get_template_part( 'sections/site-footer'); ?>

    <div class="js-search-overlay search-overlay">
        <?php get_search_form(); ?>
    </div>

<?php wp_footer(); ?>

</body>
</html>
