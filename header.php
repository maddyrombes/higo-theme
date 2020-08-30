<?php
/**
 * The theme's header template
 *
 * @package WordPress
 * @subpackage Higo
 * @since 1.0.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <?php get_template_part( 'sections/offcanvas'); ?>

    <?php get_template_part( 'sections/site-header'); ?>

    <main class="siteMain  is-movable-by-off-canvas">
