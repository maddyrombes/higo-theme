<?php

/**
 * Determines whether to show the sidebar
 *
 * @return bool
 * @since 1.0.0
 */
function higo_display_sidebar() {

    // The sidebar will NOT be displayed if ANY of the following return true
    return in_array(true, array(
        ( is_attachment() ),
        ( is_404() ),
        ( is_archive() || defined('AJAX_ARCHIVE') ),
        ( is_search() || defined('AJAX_SEARCH') ),
        ( is_singular() && is_page_template('singular-no-sidebar-full.php') ),
        ( is_singular() && is_page_template('singular-no-sidebar-narrow.php') ),
        ( is_single() && !is_active_sidebar('higo_sidebar_single_post') ),
        ( is_page() && !is_active_sidebar('higo_sidebar_single_page') ),
        ( is_front_page() && !is_home() ),
        ( ( is_home() || defined('AJAX_HOME')) && (!is_active_sidebar('higo_sidebar_blog') || !get_theme_mod('blog_sidebar_display', false)) ),
    )) ? false : true;

}
