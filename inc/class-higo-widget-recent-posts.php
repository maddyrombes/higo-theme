<?php
if (!class_exists('Higo_Widget_Recent_Posts')) :
/**
 * Custom Recent Posts Widget
 *
 * @package WordPress
 * @subpackage Higo
 * @since 1.0.0
 */
class Higo_Widget_Recent_Posts extends WP_Widget {
    public function __construct() {
        $widget_ops = array(
            'classname' => 'higo_widget_recent_posts widget-max-width',
            'description' => esc_html__('Your site&#8217;s most recent Posts.', 'higo')
        );
        parent::__construct('higo-recent-posts', esc_html__('Higo Recent Posts', 'higo'), $widget_ops);
        $this->alt_option_name = 'higo_widget_recent_posts';
    }

    public function widget($args, $instance) {
        if (! isset($args['widget_id'])) {
            $args['widget_id'] = $this->id;
        }

        $title = (! empty($instance['title'])) ? $instance['title'] : '';

        /* This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
        $title = apply_filters('widget_title', $title, $instance, $this->id_base);

        $number = (! empty($instance['number'])) ? absint($instance['number']) : 3;
        if (! $number) {
            $number = 3;
        }

        $orderby = empty($instance['orderby']) ? 'date' : $instance['orderby'];

        $category = empty($instance['category']) ? '' : $instance['category'];

        $include = empty($instance['include']) ? '' : $instance['include'];

        if (!empty($include)) {
            $include_array = explode(', ', $include);
        } else {
            $include_array = null;
        }

        global $post;

        if (!$post) {
            $post__not_in = '';
        } else {
            $post__not_in = array($post->ID);
        }

        $r = new WP_Query(apply_filters('widget_posts_args', array(
             'posts_per_page'      => $number,
             'no_found_rows'       => true,
             'orderby'             => $orderby,
             'post_status'         => 'publish',
             'post__in'            => $include_array,
             'post__not_in'        => $post__not_in,
             'ignore_sticky_posts' => true,
             'cat'                 => $category
         )));


        if ($r->have_posts()) :

            echo $args['before_widget'];

        if ($title) {
            echo $args['before_title'] . esc_html($title) . $args['after_title'];
        }

        echo '<div class="c-card-list">';

            while ($r->have_posts()) : $r->the_post();

                echo '<div class="c-card-list__item">';

                    get_template_part( 'content/content-widget-recent-posts' );

                echo '</div>';

            endwhile;

        echo '</div>';

        echo $args['after_widget'];

            // Reset the global $the_post as this query will have stomped on it
            wp_reset_postdata();

        endif;
    }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $instance['title'] = sanitize_text_field(stripslashes($new_instance['title']));

        $instance['number'] = (int) $new_instance['number'];

        if (in_array($new_instance['orderby'], array( 'comment_count', 'date' ))) {
            $instance['orderby'] = $new_instance['orderby'];
        } else {
            $instance['orderby'] = 'date';
        }

        $instance['category'] = $new_instance['category'];

        $instance['include'] = sanitize_text_field($new_instance['include']);

        return $instance;
    }

    public function form($instance) {
        $title       = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $number      = isset($instance['number']) ? absint($instance['number']) : 3;
        $orderby     = isset($instance['orderby']) ? $instance['orderby'] : 'date';
        $category    = isset($instance['category']) ? $instance['category'] : '';
        $include     = isset($instance['include']) ? $instance['include'] : '';

        $cats = get_terms('category'); ?>

		<p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'higo'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<p><label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php esc_html_e('Number of posts to show:', 'higo'); ?></label>
		<input class="tiny-text" id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="number" step="1" min="1" value="<?php echo esc_attr($number); ?>" size="3" /></p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id('orderby')); ?>"><?php esc_html_e('Order by:', 'higo'); ?></label>
			<select name="<?php echo esc_attr($this->get_field_name('orderby')); ?>" id="<?php echo esc_attr($this->get_field_id('orderby')); ?>" class="widefat">
				<option value="date"<?php selected($orderby, 'date'); ?>><?php esc_html_e('Date', 'higo'); ?></option>
				<option value="comment_count"<?php selected($orderby, 'comment_count'); ?>><?php echo esc_html__('Comment count', 'higo'); ?></option>
			</select>
		</p>

		<p>
		    <label for="<?php echo esc_attr($this->get_field_id('category')); ?>"><?php esc_html_e('Select Category', 'higo'); ?></label>

		    <select id="<?php echo esc_attr($this->get_field_id('category')); ?>" name="<?php echo esc_attr($this->get_field_name('category')); ?>">
		        <option value="0"><?php esc_html_e('All Categories', 'higo'); ?></option>
		        <?php foreach ($cats as $cat) : ?>
		            <option value="<?php echo esc_attr($cat->term_id); ?>" <?php selected($category, $cat->term_id); ?>>
		                <?php echo esc_html($cat->name); ?>
		            </option>
		        <?php endforeach; ?>
		    </select>
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id('include')); ?>"><?php esc_html_e('Include only:', 'higo'); ?></label>
			<input type="text" value="<?php echo esc_attr($include); ?>" name="<?php echo esc_attr($this->get_field_name('include')); ?>" id="<?php echo esc_attr($this->get_field_id('include')); ?>" class="widefat" />
			<br />
			<small><?php esc_html_e('Post IDs, separated by commas.', 'higo'); ?></small>
		</p>

		<?php

    }
}
endif;
