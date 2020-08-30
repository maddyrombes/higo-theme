<?php

if (! function_exists('higo_comment_form')) :
/**
 * Displays custom comment form
 *
 * @package WordPress
 * @subpackage Higo
 * @since 1.0.0
 */
function higo_comment_form() {
    $commenter = wp_get_current_commenter();
    $req = get_option('require_name_email');
    $aria_req = ($req ? " aria-required='true'" : '');
    $req_icon = ($req ? ' *' : '');

    $required_text = esc_html__(' Required fields are marked *', 'higo');

    $args = array(

         'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title">',
            'title_reply_after'  => '</h3>',

         'fields' => apply_filters('comment_form_default_fields', array(

            'author' => '<div class="comment-inputs"><p class="comment-form-author"><label class="screen-reader-text" for="author">' . esc_html__('Name', 'higo') . '</label>' . ($req ? '<span class="required screen-reader-text">*</span>' : '') . '<input id="author" placeholder="' . esc_attr__('Name', 'higo') . '' . $req_icon . '" name="author" type="text" class="" value="' . esc_attr($commenter['comment_author']) . '" size="30"' . $aria_req . ' /></p>',

            'email' => '<p class="comment-form-email"><label class="screen-reader-text" for="email">' . esc_html__('Email', 'higo') . '</label>'. ($req ? '<span class="required screen-reader-text">*</span>' : '') . '<input id="email" placeholder="' . esc_attr__('Email', 'higo') . '' . $req_icon . '" name="email" type="text" value="' . esc_attr($commenter['comment_author_email']) .  '" size="30"' . $aria_req . ' /></p>',

            'url' => '<p class="comment-form-website"><label class="screen-reader-text" for="url">' . esc_html__('Website', 'higo') . '</label>'. '<input id="url" placeholder="' . esc_attr__('Website', 'higo') . '" name="url" type="text" value="' . esc_attr($commenter['comment_author_url']) . '" size="30" /></p></div>'

         )),

         'comment_field' => '<p class="comment-form-comment"><label class="screen-reader-text" for="comment">' . esc_html__('Comment', 'higo') . '</label><textarea id="comment" name="comment" cols="45" rows="6" placeholder="' . esc_html__('Comment', 'higo') . '" aria-required="true"></textarea></p>'
     );

    comment_form($args);
}
endif;
