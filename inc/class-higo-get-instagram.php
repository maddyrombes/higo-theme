<?php

if (!class_exists('Higo_Get_Instagram')) :

/**
 * Class to retrieve images and data from Instagram by username
 *
 * @package WordPress
 * @subpackage Higo
 * @since 1.0.0
 */

class Higo_Get_Instagram {

    /**
     * The username
     *
     * @since    1.0.0
     * @var      string    $username
     */
    protected $username;

    /**
     * Number of images
     *
     * @since    1.0.0
     * @var      int    $num
     */
    protected $num;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $username
     * @param      string    $num
     */
    public function __construct($username, $num) {
        $this->username = $username;
        $this->num = $num;
    }

    /**
     *
     *
     * @since    1.0.0
     * @var      int    $num
     * @link https://gist.github.com/cosmocatalano/4544576
     */
    public function get() {
        $username = $this->username;
        $num = $this->num;

        // Get the username
        $username = strtolower($username);

        // Remove the '@' symbol from the username string if any
        // $username = str_replace('@', '', $username);

        // If transient doesn't exists
        if (false === ($instagram = get_transient('instagram-media-new-'.sanitize_title_with_dashes($username)))) {

            // $url = 'https://instagram.com/'.trim( $username );
            $url = 'https://instagram.com/' . str_replace( '@', '', $username );
            $remote = wp_remote_get( $url );

            // Check for errors
            if (is_wp_error($remote)) {
                return new WP_Error('site_down', esc_html__('Unable to communicate with Instagram.', 'higo'));
            }

            if (503 == wp_remote_retrieve_response_code($remote)) {
                return new WP_Error('invalid_response', esc_html__('503 Service Temporarily Unavailable.', 'higo'));
            }

            if (200 != wp_remote_retrieve_response_code($remote)) {
                return new WP_Error('invalid_response', esc_html__('This user does not exist.', 'higo'));
            }

            // Get the data from Instagram
            $shards = explode( 'window._sharedData = ', $remote['body'] );
            $insta_json = explode( ';</script>', $shards[1] );
            $insta_array = json_decode( $insta_json[0], TRUE );

            if (!$insta_array) {
                return new WP_Error('bad_json', esc_html__('Instagram has returned invalid data.', 'higo'));
            }

            if ( isset( $insta_array['entry_data']['ProfilePage'][0]['user']['media']['nodes'] ) ) {
                $images = $insta_array['entry_data']['ProfilePage'][0]['user']['media']['nodes'];
            } else {
                return new WP_Error('bad_json_2', esc_html__('Instagram has returned invalid data.', 'higo'));
            }

            if (!is_array($images)) {
                return new WP_Error('bad_array', esc_html__('Instagram has returned invalid data.', 'higo'));
            }

            $instagram = array();

            foreach ($images as $image) {
                $instagram[] = array(
                  'description' => $image['caption'],
                  'comments'    => $this->shorten_number($image['comments']['count']),
                  'likes'       => $this->shorten_number($image['likes']['count']),
                  'link'        => '//instagram.com/p/'.$image['code'],
                  'img_l'       => $image['thumbnail_src'],
                  'img_s'       => str_replace('s640x640','s150x150',$image['thumbnail_src']),
                  'img_m'       => str_replace('s640x640','s320x320',$image['thumbnail_src']),
                );
            }

        // do not set an empty transient - should help catch private or empty accounts
           if (! empty($instagram)) {
               set_transient('instagram-media-new-'.sanitize_title_with_dashes($username), $instagram, HOUR_IN_SECONDS*2);
           }
        }

        if (! empty($instagram)) {
            return array_slice($instagram, 0, $num);
        } else {
            return new WP_Error('no_images', esc_html__('Instagram did not return any images.', 'higo'));
        }
    }

    /**
     * Shortens the number if it's too big.
     * @since 1.0.0
     * @link http://stackoverflow.com/a/4371114/1843626
     */
    private function shorten_number($val) {

        $k = esc_html_x( 'K', 'Used as shorthand for thousand.', 'higo' );
        $m = esc_html_x( 'M', 'Used as shorthand for million.', 'higo' );
        $b = esc_html_x( 'B', 'Used as shorthand for billion', 'higo' );

        if ($val < 1) {
            $return = '0';
        } elseif ($val < 1000) {
            // Anything less than a thousand
            $return = number_format($val);
        } else if ($val < 1000000) {
            // Anything less than a million
            $return = number_format($val / 1000, 1) . $k;
        } else if ($val < 1000000000) {
            // Anything less than a billion
            $return = number_format($val / 1000000, 1) . $m;
        } else {
            // At least a billion
            $return = number_format($val / 1000000000, 1) . $b;
        }

        return $return;
    }

}
endif;
