<?php
/**
 *
 *
 * @package WordPress
 * @subpackage Higo
 * @since 1.0.0
 */
 function higo_post_tags() {

     /* translators: used between list items, there is a space after the comma */
     $tags_list = get_the_tag_list();
     if ( $tags_list ) {
         echo '<span class="c-post-tags">' . $tags_list . '</span>';
     }

}
