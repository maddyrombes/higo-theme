<?php


add_action( 'wp_dashboard_setup', 'higo_register_custom_dashboard_widgets' );

function higo_register_custom_dashboard_widgets() {

    global $wp_meta_boxes;

    wp_add_dashboard_widget(
        'higo_dashboard_widget_sopka',
        esc_html__('Sopka Themes', 'higo'),
        'higo_display_dashboard_widget_sopka'
    );

 	$dashboard = $wp_meta_boxes['dashboard']['normal']['core'];

	$my_widget = array( 'higo_dashboard_widget_sopka' => $dashboard['higo_dashboard_widget_sopka'] );

    unset( $dashboard['higo_dashboard_widget_sopka'] );

 	$sorted_dashboard = array_merge( $my_widget, $dashboard );

    $wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;
}

function higo_display_dashboard_widget_sopka() {

    ?>

    <h3><bold>Theme Support</bold></h3>
    <p>Should you have any questions about the theme, would like to suggest a feature or report a bug, please, open a support ticket <a href="http://help.sopkathemes.com" target="_blank">here</a>. We'll get back to you asap.</p>

    <h3><bold>Leave a Review</bold></h3>
    <p>We'd really appreciate your honest review. It can be something short, but it will definitely help to grow our little business! You can star rate the theme by going to your downloads page on <a href="https://themeforest.net/downloads" target="_blank">ThemeForest</a> or leave a review on our <a href="https://www.facebook.com/sopkathemes" target="_blank">Facebook</a> page. Thank you for your time.</p>

    <h3><bold>Follow us</bold></h3>
    <p>Follow us on <a href="https://twitter.com/sopkathemes" target="_blank">Twitter</a> for latest updates and check out our inpiration feed on <a href="https://www.instagram.com/sopkathemes" target="_blank">Instagram</a>.</p>

    <h3><bold>Join our newsletter</bold></h3>
    <p>You'll get a small email once in a while about new themes, updates, and promotions.</p>

    <!-- Begin MailChimp Signup Form -->
    <link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css">
    <style type="text/css">
        #mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; }
        /* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
        We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
    </style>

    <div id="mc_embed_signup">
        <form action="//sopkathemes.us13.list-manage.com/subscribe/post?u=8b4ddf4fbddf74732b2a0b348&amp;id=b341afe0b3" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
            <div id="mc_embed_signup_scroll">
                <div class="indicates-required"><span class="asterisk">*</span> indicates required</div>

                <div class="mc-field-group">
                    <label for="mce-EMAIL">Email Address  <span class="asterisk">*</span></label>
                    <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
                </div>

                <div class="mc-field-group">
                    <label for="mce-FNAME">First Name </label>
                    <input type="text" value="" name="FNAME" class="" id="mce-FNAME">
                </div>

                <div class="mc-field-group">
                    <label for="mce-LNAME">Last Name </label>
                    <input type="text" value="" name="LNAME" class="" id="mce-LNAME">
                </div>

                <div id="mce-responses" class="clear">
                    <div class="response" id="mce-error-response" style="display:none"></div>
                    <div class="response" id="mce-success-response" style="display:none"></div>
                </div>

                <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_8b4ddf4fbddf74732b2a0b348_b341afe0b3" tabindex="-1" value=""></div>

                <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
            </div>

        </form>

    </div>
    <!--End mc_embed_signup-->

	<?php
}
