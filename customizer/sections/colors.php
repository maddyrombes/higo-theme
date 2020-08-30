<?php
/**
 * Customizer Section: Colors
 *
 * @since 1.0.0
 *
 */


function higo_get_colors_options() {
    return array(
        'background_body' => array(
            'default' => '#ffffff',
            'label'   => esc_html__('Body background Color', 'higo'),
         ),
         'color_body' => array(
             'default' => '#263238',
             'label'   => esc_html__('Body text color', 'higo')
         ),
         'primary_color' => array(
             'default' => '#A29161',
             'label' => esc_html__('Accent Color', 'higo')
         )
    );
}


foreach (higo_get_colors_options() as $key => $value) {
    $setting_key = sanitize_title($key);

    $wp_customize->add_setting($setting_key, array(
        'default' => $value['default'],
        'sanitize_callback' => 'sanitize_hex_color'
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $setting_key, array(
        'label'       => $value['label'],
        'section' => 'colors'
    )));
}
