<?php

/* Theme setup section
-------------------------------------------------------------------- */
if (!function_exists('yacht_rental_sc_reviews_theme_setup')) {
	add_action( 'yacht_rental_action_before_init_theme', 'yacht_rental_sc_reviews_theme_setup' );
	function yacht_rental_sc_reviews_theme_setup() {
		add_action('yacht_rental_action_shortcodes_list', 		'yacht_rental_sc_reviews_reg_shortcodes');
		if (function_exists('yacht_rental_exists_visual_composer') && yacht_rental_exists_visual_composer())
			add_action('yacht_rental_action_shortcodes_list_vc','yacht_rental_sc_reviews_reg_shortcodes_vc');
	}
}



/* Shortcode implementation
-------------------------------------------------------------------- */

/*
[trx_reviews]
*/

if (!function_exists('yacht_rental_sc_reviews')) {	
	function yacht_rental_sc_reviews($atts, $content = null) {
		if (yacht_rental_in_shortcode_blogger()) return '';
		extract(yacht_rental_html_decode(shortcode_atts(array(
			// Individual params
			"align" => "right",
			// Common params
			"id" => "",
			"class" => "",
			"animation" => "",
			"css" => "",
			"top" => "",
			"bottom" => "",
			"left" => "",
			"right" => ""
		), $atts)));
		$class .= ($class ? ' ' : '') . yacht_rental_get_css_position_as_classes($top, $right, $bottom, $left);
		$output = yacht_rental_param_is_off(yacht_rental_get_custom_option('show_sidebar_main'))
			? '<div' . ($id ? ' id="'.esc_attr($id).'"' : '') 
						. ' class="sc_reviews'
							. ($align && $align!='none' ? ' align'.esc_attr($align) : '')
							. ($class ? ' '.esc_attr($class) : '')
							. '"'
						. ($css!='' ? ' style="'.esc_attr($css).'"' : '')
						. (!yacht_rental_param_is_off($animation) ? ' data-animation="'.esc_attr(yacht_rental_get_animation_classes($animation)).'"' : '')
						. '>'
					. trim(yacht_rental_get_reviews_placeholder())
					. '</div>'
			: '';
		return apply_filters('yacht_rental_shortcode_output', $output, 'trx_reviews', $atts, $content);
	}
	add_shortcode("trx_reviews", "yacht_rental_sc_reviews");
}



/* Register shortcode in the internal SC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'yacht_rental_sc_reviews_reg_shortcodes' ) ) {
	function yacht_rental_sc_reviews_reg_shortcodes() {
	
		yacht_rental_sc_map("trx_reviews", array(
			"title" => esc_html__("Reviews", 'trx_utils'),
			"desc" => wp_kses_data( __("Insert reviews block in the single post", 'trx_utils') ),
			"decorate" => false,
			"container" => false,
			"params" => array(
				"align" => array(
					"title" => esc_html__("Alignment", 'trx_utils'),
					"desc" => wp_kses_data( __("Align counter to left, center or right", 'trx_utils') ),
					"divider" => true,
					"value" => "none",
					"type" => "checklist",
					"dir" => "horizontal",
					"options" => yacht_rental_get_sc_param('align')
				), 
				"top" => yacht_rental_get_sc_param('top'),
				"bottom" => yacht_rental_get_sc_param('bottom'),
				"left" => yacht_rental_get_sc_param('left'),
				"right" => yacht_rental_get_sc_param('right'),
				"id" => yacht_rental_get_sc_param('id'),
				"class" => yacht_rental_get_sc_param('class'),
				"animation" => yacht_rental_get_sc_param('animation'),
				"css" => yacht_rental_get_sc_param('css')
			)
		));
	}
}


/* Register shortcode in the VC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'yacht_rental_sc_reviews_reg_shortcodes_vc' ) ) {
	function yacht_rental_sc_reviews_reg_shortcodes_vc() {
	
		vc_map( array(
			"base" => "trx_reviews",
			"name" => esc_html__("Reviews", 'trx_utils'),
			"description" => wp_kses_data( __("Insert reviews block in the single post", 'trx_utils') ),
			"category" => esc_html__('Content', 'trx_utils'),
			'icon' => 'icon_trx_reviews',
			"class" => "trx_sc_single trx_sc_reviews",
			"content_element" => true,
			"is_container" => false,
			"show_settings_on_create" => true,
			"params" => array(
				array(
					"param_name" => "align",
					"heading" => esc_html__("Alignment", 'trx_utils'),
					"description" => wp_kses_data( __("Align counter to left, center or right", 'trx_utils') ),
					"class" => "",
					"value" => array_flip((array)yacht_rental_get_sc_param('align')),
					"type" => "dropdown"
				),
				yacht_rental_get_vc_param('id'),
				yacht_rental_get_vc_param('class'),
				yacht_rental_get_vc_param('animation'),
				yacht_rental_get_vc_param('css'),
				yacht_rental_get_vc_param('margin_top'),
				yacht_rental_get_vc_param('margin_bottom'),
				yacht_rental_get_vc_param('margin_left'),
				yacht_rental_get_vc_param('margin_right')
			)
		) );
		
		class WPBakeryShortCode_Trx_Reviews extends Yacht_Rental_VC_ShortCodeSingle {}
	}
}
?>