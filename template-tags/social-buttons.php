<?php
if ( ! function_exists( 'higo_social_share_buttons' ) ) :
/**
 * Prints HTML with social share buttons & share counts
 *
 * Social share links & counts are provided by goodshare.js
 *
 * @package WordPress
 * @subpackage Osom
 * @since Osom 1.0.0
 */
function higo_social_share_buttons() {

    $providers = array(
        'twitter' => get_theme_mod('twitter_share'),
        'vk' => get_theme_mod('vk_share'),
        'facebook' => get_theme_mod('facebook_share'),
        'pinterest' => get_theme_mod('pinterest_share'),
        'google-plus' => get_theme_mod('google-plus_share')
    );

    // If not providers are selected do nothing
    if( !array_filter($providers) ) {
        return;
    }

    $providers_titles = array(
        'twitter' => esc_html__('Twitter', 'higo'),
        'vk' => esc_html__('Vk', 'higo'),
        'facebook' => esc_html__('Facebook', 'higo'),
        'pinterest' => esc_html__('Pinterest', 'higo'),
        'google-plus' => esc_html__('Google Plus', 'higo')
    );

    $post_link = get_permalink();
    $post_title = get_the_title();
    $post_img = get_the_post_thumbnail_url();
    $twitter_via = '';

    if ( get_theme_mod('twitter_username') ) {
        $twitter_via = '&via='.get_theme_mod('twitter_username');
    }

    $providers_urls = array(
        'twitter' => 'https://twitter.com/intent/tweet?url='.$post_link.'&text='.$post_title . $twitter_via,
        'vk' => 'http://vk.com/share.php?url='.$post_link,
        'facebook' => 'https://www.facebook.com/sharer.php?u='.$post_link,
        'pinterest' => 'https://pinterest.com/pin/create/bookmarklet/?media='.$post_img.'&url='.$post_link.'&description='.$post_title,
        'google-plus' => 'https://plus.google.com/share?url='.$post_link
    );

    // Output
    ?>
    <span class="screen-reader-text"><?php esc_html_e('Share this post', 'higo'); ?></span>
    <div class="c-social-buttons">

        <?php foreach ( $providers as $key => $value ) {
            if ( $value ) { ?>
                <a href="<?php echo esc_url($providers_urls[$key])?>" target="_blank" title="<?php printf(esc_attr__('Share this post on %s.', 'higo'), $providers_titles[$key]); ?>">
                    <?php echo higo_svg_icon($key); ?>
                </a>
            <?php }
        } ?>

    </div>

<?php
}
endif;
