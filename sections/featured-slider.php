<?php
/**
 * The featured slider section
 *
 * @package WordPress
 * @subpackage Higo
 * @since 1.1.0
 */

$featured_posts = higo_featured_posts_ids();

if ( $featured_posts && !is_paged() && is_home() && is_front_page() ) {

  // Get featured slider settings from the Customizer
  $autoplay = get_theme_mod('featured_posts_autoplay', true);
  $slidesToShow = get_theme_mod('featured_posts_num', 2); // Number of slides for `xl` breakpont and up
  $arrows = get_theme_mod('featured_posts_arrows', true);
  $dots = get_theme_mod('featured_posts_dots', false);
  $boxed = get_theme_mod('featured_posts_boxed', false);
  $gutters = get_theme_mod('featured_posts_gutters', true);
  $centerMode = get_theme_mod('featured_posts_center_mode', false);
  $infinite = true; // Infinite looping through slides

  // Center mode only avaliable for $slidesToShow = 1
  if ( $slidesToShow != 1 ) {
      $centerMode = false;
  }

  // Number of slides for `m` breakpont and up
  if ( $slidesToShow == 1) {
      $slidesToShow_m = 1;
  } else {
      $slidesToShow_m = 2;
  }

  // Number of slides for `l` breakpont and up
  if ( $slidesToShow == 1) {
      $slidesToShow_l = 1;
  } elseif ( $slidesToShow == 2) {
      $slidesToShow_l = 2;
  } else {
      $slidesToShow_l = 3;
  }

  // Number of slides to scroll at a time
  $slidesToScroll = 1;

  // Side padding when in center mode. (px or %)
  $centerPadding = "10%";

  // Featured section classes array
  $class = array();

  $class[] = 's-featured';

  if ( $boxed ) {
      $class[] = 's-featured--boxed';
  } else {
      $class[] = 's-featured--full';
  }

  if ( $gutters ) {
      $class[] = 's-featured--gutters';
  } else {
      $class[] = 's-featured--no-gutters';
  }

  if ( $centerMode ) {
      $class[] = 's-featured--centered';
  }

  $class[] = 's-featured--'.$slidesToShow.'-cols';

  $classes = implode(' ', $class);

  $featured_args = array(
    'post__in' => $featured_posts,
  );

  $counter = 1;

  $featured = new WP_Query( $featured_args );

      if ( $featured->have_posts() ) :

          // Update number of slides to show if we have insufficient
          // number of posts
          if ( $featured->post_count < $slidesToShow ):
              $slidesToShow = $featured->post_count;
          endif;

          if ( $featured->post_count < $slidesToShow_l ):
              $slidesToShow_l = $featured->post_count;
          endif;

          if ( $featured->post_count < $slidesToShow_m ):
              $slidesToShow_m = $featured->post_count;
          endif;


          // Center mode only available is there are 3 or more posts to show
          if ( $featured->post_count < 3 ) {
              $centerMode = false;
          }

          // Define thumbnail size
          if ( $boxed ) {
              $size = 'higo-fsl-' . $slidesToShow . '-b';
          } else {
              $size = 'higo-fsl-' . $slidesToShow . '-f';
          }

          ?>

      <section class="<?php esc_attr_e($classes); ?>">

          <h2 class="screen-reader-text"><?php esc_html_e('Featured posts', 'higo'); ?></h2>

          <div class="s-featured__inner">

              <div class="s-featured__holder js-slick-carousel" data-slick='{
                  "slidesToScroll": <?php esc_attr_e($slidesToScroll); ?>,
                  "arrows": <?php esc_attr_e($arrows ? 'true' : 'false'); ?>,
                  "dots": <?php esc_attr_e($dots ? 'true' : 'false'); ?>,
                  "infinite": <?php esc_attr_e($infinite ? 'true' : 'false'); ?>,
                  "autoplay": <?php esc_attr_e($autoplay ? 'true' : 'false'); ?>,
                  "centerMode": <?php esc_attr_e($centerMode ? 'true' : 'false'); ?>,
                  "centerPadding": "<?php esc_attr_e($centerPadding); ?>",
                  "mobileFirst": true,
                  "rtl": <?php esc_attr_e(is_rtl() ? 'true' : 'false'); ?>,
                  "responsive": [{"breakpoint":1170,"settings":{"slidesToShow": <?php esc_attr_e($slidesToShow); ?>}},{"breakpoint":990,"settings":{"slidesToShow": <?php esc_attr_e($slidesToShow_l); ?>}},{"breakpoint":810,"settings":{"slidesToShow": <?php esc_attr_e($slidesToShow_m); ?>}},{"breakpoint":0,"settings":{"slidesToShow": 1,"centerPadding":false}}]
              }'>

              <?php while ( $featured->have_posts() ) : $featured->the_post(); ?>
                  <div class="s-featured__item">
                      <div class="c-card c-card--image">

                          <a class="c-card__link" href="<?php echo esc_url(get_permalink()); ?>" rel="bookmark"></a>

                          <?php if ( '' !== get_the_post_thumbnail() ) : ?>
                              <div class="c-card__image">
                                  <div class="c-fluid-image js-c-fluid-image">
                                      <div class="c-fluid-image__inner">
                                          <?php the_post_thumbnail($size); ?>
                                      </div>
                                  </div>
                              </div>
                          <?php endif; ?>

                          <div class="c-card__content">
                              <?php the_title( '<h3 class="c-card__title">', '</h3>' ); ?>
                              <?php higo_post_categories(); ?>
                          </div>
                      </div>
                  </div>
              <?php $counter++; endwhile; ?>

              </div>

          </div>

      </section>

      <?php wp_reset_postdata(); endif; ?>

  <?php // endif;

}
