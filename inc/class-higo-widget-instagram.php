<?php
if (!class_exists('Higo_Widget_Instagram')) :
/**
 * Custom Instagram Widget
 *
 * @package WordPress
 * @subpackage Higo
 * @since 1.0.0
 */

class Higo_Widget_Instagram extends WP_Widget {

    // Register widget with WordPress.
    public function __construct() {
        parent::__construct(
            'higo_widget_instagram',
            esc_html__('Higo Instagram', 'higo'),
            array( 'classname' => 'higo_widget_instagram', 'description' => esc_html__('Displays your latest Instagram posts', 'higo') )
        );
    }


    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance) {

        if ( ! isset( $args['widget_id'] ) ) {
            $args['widget_id'] = $this->id;
        }

        $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

        $username = empty($instance['username']) ? '' : $instance['username'];

        $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 6;

        if ( ! $number ) {
            $number = 6;
        }

        $show_meta = isset( $instance['show_meta'] ) ? $instance['show_meta'] : false;

        echo $args['before_widget'];

        // Widget title
        if ( $title ) {
			echo $args['before_title'] . esc_html($title) . $args['after_title'];
		}

        if ($username != '') {
            $new_instagram = new Higo_Get_Instagram($username, $number);

            $new_instagram_array = $new_instagram->get();

            // Check for errors
            if (is_wp_error($new_instagram_array)) {

                echo '<p>' . $new_instagram_array->get_error_message() . '</p>';

            } else {

                $insta_link_title  = sprintf(esc_html_x('See the picture by @%s on Instagram', '%s = instagram username', 'higo'), $username);

                $insta_class = 'instagramFeed--' . $number . '-photos';

                ?>

				<div class="instagramFeed <?php echo esc_attr($insta_class); ?>">

				    <?php foreach ($new_instagram_array as $item) {

                        $img_title = sprintf(esc_html_x('Image by @%s on Instagram', '%s - Instagram username.', 'higo'), $username);

                        ?>

						<div class="instagramFeed__item">
							<a href="<?php echo esc_url($item['link']); ?>" target="_blank" title="<?php echo esc_attr($insta_link_title); ?>">
                                <img width="320" height="320" title="<?php echo esc_attr($img_title); ?>" src="<?php echo esc_url($item['img_m']); ?>" alt="<?php echo esc_attr($item['description']); ?>" srcset="<?php echo esc_url($item['img_m']); ?> 320w, <?php echo esc_url($item['img_s']); ?> 150w, <?php echo esc_url($item['img_l']); ?> 640w" sizes="(max-width: 539px) calc(100vw - 30px), (max-width: 809px) 248px, (max-width: 989px) 240px, (max-width: 1169px) 138px, 168px">
							</a>

							<?php if ($show_meta) : ?>

								<div class="instagramFeed__item__meta">
								    <span>
								        <?php echo higo_svg_icon('heart'); ?><?php echo esc_html($item['likes']); ?>
								    </span>
									<span>
										<?php echo higo_svg_icon('comment'); ?><?php echo esc_html($item['comments']); ?>
									</span>
								</div>

							<?php endif; ?>

						</div>

				    <?php

                } ?>

				</div>

			<?php

            }
        }

        echo $args['after_widget'];
    }


    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {

        $title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
        $username  = isset( $instance['username'] ) ? esc_attr( $instance['username'] ) : '';
        $number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 6;
        $show_meta = isset( $instance['show_meta'] ) ? (bool) $instance['show_meta'] : false;

        ?>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>">
                <?php esc_html_e('Title:', 'higo'); ?>
            </label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>


        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'username' )); ?>">
                <?php esc_html_e('Username:', 'higo'); ?>
            </label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'username' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'username' )); ?>" type="text" value="<?php echo esc_attr($username); ?>" />
        </p>


		<p>
			<label for="<?php echo esc_attr($this->get_field_id('number')); ?>">
                <?php esc_html_e('Number of photos:', 'higo'); ?>
            </label>
            <select class="widefat" id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>">
                <option <?php selected($number,'2'); ?> value="2"><?php esc_html_e('2 photos', 'higo'); ?></option>
                <option <?php selected($number,'4'); ?> value="4"><?php esc_html_e('4 photos', 'higo'); ?></option>
                <option <?php selected($number,'6'); ?> value="6"><?php esc_html_e('6 photos', 'higo'); ?></option>
            </select>
		</p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'show_meta' )); ?>">
                <?php esc_html_e( 'Display likes & comments counts?', 'higo' ); ?>
            </label>
            <input class="checkbox" type="checkbox"<?php checked( $show_meta ); ?> id="<?php echo esc_attr($this->get_field_id( 'show_meta' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show_meta' )); ?>" />
        </p>

        <?php

    }


    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {

        $instance = $old_instance;
        $instance['title'] = sanitize_text_field( $new_instance['title'] );
        $instance['username'] = sanitize_text_field($new_instance['username']);
        $instance['number'] = (int) $new_instance['number'];
        $instance['show_meta'] = isset( $new_instance['show_meta'] ) ? (bool) $new_instance['show_meta'] : false;

        return $instance;
    }

} // class Higo_Widget_Instagram
endif;
