<?php

/* Theme setup section
-------------------------------------------------------------------- */
if (!function_exists('yacht_rental_sc_hide_theme_setup')) {
	add_action( 'yacht_rental_action_before_init_theme', 'yacht_rental_sc_hide_theme_setup' );
	function yacht_rental_sc_hide_theme_setup() {
		add_action('yacht_rental_action_shortcodes_list', 		'yacht_rental_sc_hide_reg_shortcodes');
	}
}



/* Shortcode implementation
-------------------------------------------------------------------- */

/*
[trx_hide selector="unique_id"]
*/

if (!function_exists('yacht_rental_sc_hide')) {	
	function yacht_rental_sc_hide($atts, $content=null){	
		if (yacht_rental_in_shortcode_blogger()) return '';
		extract(yacht_rental_html_decode(shortcode_atts(array(
			// Individual params
			"selector" => "",
			"hide" => "on",
			"delay" => 0
		), $atts)));
		$selector = trim(chop($selector));
		if (!empty($selector)) {
			yacht_rental_storage_concat('js_code', '
				'.($delay>0 ? 'setTimeout(function() {' : '').'
					jQuery("'.esc_attr($selector).'").' . ($hide=='on' ? 'hide' : 'show') . '();
				'.($delay>0 ? '},'.($delay).');' : '').'
			');
		}
		return apply_filters('yacht_rental_shortcode_output', $output, 'trx_hide', $atts, $content);
	}
	add_shortcode('trx_hide', 'yacht_rental_sc_hide');
}



/* Register shortcode in the internal SC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'yacht_rental_sc_hide_reg_shortcodes' ) ) {
	function yacht_rental_sc_hide_reg_shortcodes() {
	
		yacht_rental_sc_map("trx_hide", array(
			"title" => esc_html__("Hide/Show any block", 'trx_utils'),
			"desc" => wp_kses_data( __("Hide or Show any block with desired CSS-selector", 'trx_utils') ),
			"decorate" => false,
			"container" => false,
			"params" => array(
				"selector" => array(
					"title" => esc_html__("Selector", 'trx_utils'),
					"desc" => wp_kses_data( __("Any block's CSS-selector", 'trx_utils') ),
					"value" => "",
					"type" => "text"
				),
				"hide" => array(
					"title" => esc_html__("Hide or Show", 'trx_utils'),
					"desc" => wp_kses_data( __("New state for the block: hide or show", 'trx_utils') ),
					"value" => "yes",
					"size" => "small",
					"options" => yacht_rental_get_sc_param('yes_no'),
					"type" => "switch"
				)
			)
		));
	}
}
?>