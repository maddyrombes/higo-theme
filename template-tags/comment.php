<?php
if (! function_exists('higo_comment')) :
/**
* Custom callback for listing comments.
*
* @package WordPress
* @subpackage Higo
* @since 1.0.0
*/
function higo_comment($comment, $args, $depth) {
    ?>

   <article id="comment-<?php comment_ID(); ?>" <?php comment_class('comment-' . get_comment_ID()); ?>>

       <?php
       $GLOBALS['comment'] = $comment;


       switch ($comment->comment_type) :

           case '': ?>

           <div class="comment__avatar">
               <?php echo get_avatar(get_the_author_meta('ID'), '50'); ?>
           </div>

           <div class="comment__body">



               <div class="comment__body__meta">

                   <span><?php echo get_comment_author_link(); ?></span>

                   <span>
                       <?php
                       // Check if the comments is 3 or less days old
                       if (floor((current_time('U') - get_comment_date('U'))/86400) <= 3) {
                           printf(_x('%s ago', '%s = human-readable time difference', 'higo'), human_time_diff(get_comment_date('U'), current_time('timestamp')));
                       } else {
                           echo get_comment_date();
                       } ?>
                   </span>

                   <?php edit_comment_link(esc_html__('Edit', 'higo'), '<span>', '</span>'); ?>

                   <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth'], 'before' => '<span>', 'after' => '</span>' ))); ?>

               </div>

               <div class="comment__body__text">

                   <?php comment_text(); ?>

                   <?php if ($comment->comment_approved == '0') : ?>
                       <small class="comment-moderation">
                           <?php esc_html_e('Your comment is awaiting moderation.', 'higo'); ?>
                       </small>
                   <?php endif; ?>

               </div>

           </div>

           <?php
           break;

    case 'pingback': case 'trackback': ?>

               <p><?php _e('Pingback:', 'higo'); ?>
                   <?php comment_author_link(); ?>
                   <?php edit_comment_link(esc_html__('Edit', 'higo'), '', ''); ?>
               </p>

           <?php
           break;

    endswitch; ?>

   </article>
   <?php

}
endif;
