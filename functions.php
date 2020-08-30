<?php
/**
 * Higo functions and definitions
 *
 * @package WordPress
 * @subpackage Higo
 * @since 1.0.0
 */

/**
 * Set minimum allowed WordPress version
 *
 * @since 1.0.0
 */
define('HIGO_MIN_WP_VERSION', '4.8');

/**
 * Set minimum allowed PHP version
 *
 * @since 1.0.0
 */
define('HIGO_MIN_PHP_VERSION', '5.6.0');

// Admin
require get_parent_theme_file_path('/inc/back-compat.php');
require get_parent_theme_file_path('/customizer/customizer-init.php');
require get_parent_theme_file_path('/inc/dashboard.php');
require get_parent_theme_file_path('/inc/demo-import.php');

// Helper functions
require get_parent_theme_file_path('/inc/helpers.php');

// Theme Setup
require get_parent_theme_file_path('/inc/sidebar.php');
require get_parent_theme_file_path('/inc/setup.php');
require get_parent_theme_file_path('/inc/enqueue.php');
require get_parent_theme_file_path('/inc/filters.php');
require get_parent_theme_file_path('/inc/featured.php');

// SVG icons
require get_parent_theme_file_path('/inc/icon-functions.php');

// Filter gallery short code output
require get_parent_theme_file_path('/inc/gallery.php');

// AJAX load more posts
require get_parent_theme_file_path('/inc/ajax-load-more.php');

// Plugins
require get_parent_theme_file_path('/inc/class-tgm-plugin-activation.php');
require get_parent_theme_file_path('/inc/plugins.php');

// Custom Widgets
require get_parent_theme_file_path('/inc/class-higo-get-instagram.php');
require get_parent_theme_file_path('/inc/class-higo-widget-instagram.php');
require get_parent_theme_file_path('/inc/class-higo-widget-recent-posts.php');

// Custom template tags
require get_parent_theme_file_path('/template-tags/custom-logo.php');
require get_parent_theme_file_path('/template-tags/post-meta.php');
require get_parent_theme_file_path('/template-tags/search-menu.php');
require get_parent_theme_file_path('/template-tags/post-thumbnail.php');
require get_parent_theme_file_path('/template-tags/social-buttons.php');
require get_parent_theme_file_path('/template-tags/comment-form.php');
require get_parent_theme_file_path('/template-tags/comment.php');
require get_parent_theme_file_path('/template-tags/post-tags.php');
