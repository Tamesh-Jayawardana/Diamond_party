<?php

/* Theme setup section
-------------------------------------------------------------------- */
if (!function_exists('yacht_rental_sc_tooltip_theme_setup')) {
	add_action( 'yacht_rental_action_before_init_theme', 'yacht_rental_sc_tooltip_theme_setup' );
	function yacht_rental_sc_tooltip_theme_setup() {
		add_action('yacht_rental_action_shortcodes_list', 		'yacht_rental_sc_tooltip_reg_shortcodes');
	}
}



/* Shortcode implementation
-------------------------------------------------------------------- */

/*
[trx_tooltip id="unique_id" title="Tooltip text here"]Et adipiscing integer, scelerisque pid, augue mus vel tincidunt porta[/tooltip]
*/

if (!function_exists('yacht_rental_sc_tooltip')) {	
	function yacht_rental_sc_tooltip($atts, $content=null){	
		if (yacht_rental_in_shortcode_blogger()) return '';
		extract(yacht_rental_html_decode(shortcode_atts(array(
			// Individual params
			"title" => "",
			// Common params
			"id" => "",
			"class" => "",
			"css" => ""
		), $atts)));
		$output = '<span' . ($id ? ' id="'.esc_attr($id).'"' : '') 
					. ' class="sc_tooltip_parent'. (!empty($class) ? ' '.esc_attr($class) : '').'"'
					. ($css!='' ? ' style="'.esc_attr($css).'"' : '') 
					. '>'
						. do_shortcode($content)
						. '<span class="sc_tooltip">' . ($title) . '</span>'
					. '</span>';
		return apply_filters('yacht_rental_shortcode_output', $output, 'trx_tooltip', $atts, $content);
	}
	add_shortcode('trx_tooltip', 'yacht_rental_sc_tooltip');
}



/* Register shortcode in the internal SC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'yacht_rental_sc_tooltip_reg_shortcodes' ) ) {
	function yacht_rental_sc_tooltip_reg_shortcodes() {
	
		yacht_rental_sc_map("trx_tooltip", array(
			"title" => esc_html__("Tooltip", 'trx_utils'),
			"desc" => wp_kses_data( __("Create tooltip for selected text", 'trx_utils') ),
			"decorate" => false,
			"container" => true,
			"params" => array(
				"title" => array(
					"title" => esc_html__("Title", 'trx_utils'),
					"desc" => wp_kses_data( __("Tooltip title (required)", 'trx_utils') ),
					"value" => "",
					"type" => "text"
				),
				"_content_" => array(
					"title" => esc_html__("Tipped content", 'trx_utils'),
					"desc" => wp_kses_data( __("Highlighted content with tooltip", 'trx_utils') ),
					"divider" => true,
					"rows" => 4,
					"value" => "",
					"type" => "textarea"
				),
				"id" => yacht_rental_get_sc_param('id'),
				"class" => yacht_rental_get_sc_param('class'),
				"css" => yacht_rental_get_sc_param('css')
			)
		));
	}
}
?>