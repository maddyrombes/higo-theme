<?php
/**
 * Higo Customizer: Sanitize Callbacks
 *
 * @package WordPress
 * @subpackage Higo
 * @since 1.0.0
 */


/**
  * Sanitization callback for 'select' and 'radio' type controls.
  *
  * @since 1.0.0
  * @param string $input Slug to sanitize.
  * @param WP_Customize_Setting $setting Setting instance.
  * @return string Sanitized slug if it is a valid choice; otherwise, the setting default.
  */
function higo_sanitize_select($input, $setting)
{

    // Get list of choices from the control associated with the setting.
    $choices = $setting->manager->get_control($setting->id)->choices;

    // If the input is a valid key, return it; otherwise, return the default.
    return (array_key_exists($input, $choices) ? $input : $setting->default);
}

/**
 * Checkbox sanitization callback.
 *
 * @since 1.0.0
 * @param bool $checked Whether the checkbox is checked.
 * @return bool Whether the checkbox is checked.
 */
function higo_sanitize_checkbox($checked)
{
    return ((isset($checked) && true == $checked) ? true : false);
}


/**
 * Number Range sanitization callback
 *
 * - Sanitization: number_range
 * - Control: number, tel
 *
 * Sanitization callback for 'number' or 'tel' type text inputs. This callback sanitizes
 * `$number` as an absolute integer within a defined min-max range.
 *
 * @see absint() https://developer.wordpress.org/reference/functions/absint/
 *
 * @param int $number  Number to check within the numeric range defined by the setting.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return int|string The number, if it is zero or greater and falls within the defined range; otherwise, the setting default.
 */
function higo_sanitize_number_range($number, $setting) {

    // Ensure input is an absolute integer.
    $number = absint($number);

    // Get the input attributes associated with the setting.
    $atts = $setting->manager->get_control($setting->id)->input_attrs;

    // Get minimum number in the range.
    $min = (isset($atts['min']) ? $atts['min'] : $number);

    // Get maximum number in the range.
    $max = (isset($atts['max']) ? $atts['max'] : $number);

    // Get step.
    $step = (isset($atts['step']) ? $atts['step'] : 1);

    // If the number is within the valid range, return it; otherwise, return the default
    return ($min <= $number && $number <= $max && is_int($number / $step) ? $number : $setting->default);
}
