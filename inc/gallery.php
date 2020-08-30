<?php

add_filter('post_gallery', 'higo_gallery_shortcode', 10, 2 );

/**
 * Filters the output of the default gallery shortcode
 *
 * @package WordPress
 * @subpackage Higo
 * @since 1.0.0
 */
function higo_gallery_shortcode( $output, $attr ) {

	$post = get_post();

	static $instance = 0;
	$instance++;

	if ( ! empty( $attr['ids'] ) ) {
		if ( empty( $attr['orderby'] ) ) {
			$attr['orderby'] = 'post__in';
		}
		$attr['include'] = $attr['ids'];
	}

	$atts = shortcode_atts( array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post ? $post->ID : 0,
		'columns'    => 3,
		'size'       => 'thumbnail',
		'include'    => '',
		'exclude'    => '',
		'link'       => ''
	), $attr, 'gallery' );

	$id = intval( $atts['id'] );

	if ( ! empty( $atts['include'] ) ) {
		$_attachments = get_posts( array( 'include' => $atts['include'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif ( ! empty( $atts['exclude'] ) ) {
		$attachments = get_children( array( 'post_parent' => $id, 'exclude' => $atts['exclude'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
	} else {
		$attachments = get_children( array( 'post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
	}

	if ( empty( $attachments ) ) {
		return '';
	}

	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $att_id => $attachment ) {
			$output .= wp_get_attachment_link( $att_id, $size, true ) . "\n";
		}
		return $output;
	}

	$columns = intval( $atts['columns'] );

	$selector = "gallery-{$instance}";

	$size = $atts['size'];

	$size_class = sanitize_html_class( $size );

	$post_title = esc_attr(get_the_title());

	$output = "<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}' data-columns data-chocolat-title='{$post_title}'>";

	foreach ( $attachments as $id => $attachment ) {

		// Get image caption if any
		$image_caption = esc_attr($attachment->post_excerpt);

		$attr = ( trim( $attachment->post_excerpt ) ) ? array( 'aria-describedby' => "$selector-$id" ) : '';

		if ( ! empty( $atts['link'] ) && 'file' === $atts['link'] ) {
			$image_output = wp_get_attachment_link( $id, $size, false, false, false, $attr );

			// Add title and class for the popup.
			$image_output = str_replace('<a', '<a title="'.$image_caption.'" class="chocolat-image"', $image_output);

		} elseif ( ! empty( $atts['link'] ) && 'none' === $atts['link'] ) {

			$image_output = wp_get_attachment_image( $id, $size, false, $attr );

		} else {

			$image_output = wp_get_attachment_link( $id, $size, true, false, false, $attr );

		}

		$output .= "<figure class='gallery-item'>";

		$output .= "
			<div class='gallery-icon'>
				$image_output
			</div>";
		if ( trim($attachment->post_excerpt) ) {
			$output .= "
				<figcaption class='wp-caption-text gallery-caption' id='$selector-$id'>
				" . wptexturize($attachment->post_excerpt) . "
				</figcaption>";
		}

		$output .= "</figure>";
	}

	$output .= "
		</div>\n";

	return $output;
}
