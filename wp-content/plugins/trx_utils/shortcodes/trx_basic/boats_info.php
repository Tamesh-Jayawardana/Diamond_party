<?php

/* Theme setup section
-------------------------------------------------------------------- */
if (!function_exists('yacht_rental_sc_boats_info_theme_setup')) {
	add_action( 'yacht_rental_action_before_init_theme', 'yacht_rental_sc_boats_info_theme_setup' );
	function yacht_rental_sc_boats_info_theme_setup() {
		add_action('yacht_rental_action_shortcodes_list', 		'yacht_rental_sc_boats_info_reg_shortcodes');
		if (function_exists('yacht_rental_exists_visual_composer') && yacht_rental_exists_visual_composer())
			add_action('yacht_rental_action_shortcodes_list_vc','yacht_rental_sc_boats_info_reg_shortcodes_vc');
	}
}



/* Shortcode implementation
-------------------------------------------------------------------- */

/*
[trx_boats_info id="unique_id" top="margin_in_pixels" bottom="margin_in_pixels"]
*/

if (!function_exists('yacht_rental_sc_boats_info')) {	
	function yacht_rental_sc_boats_info($atts, $content=null){	
		if (yacht_rental_in_shortcode_blogger()) return '';
		extract(yacht_rental_html_decode(shortcode_atts(array(
			// Individual params
			// Common params
			"id" => "",
			"class" => "",
			"top" => "",
			"bottom" => "",
			"left" => "",
			"right" => ""
		), $atts)));
		if (empty($position)) $position = 'center center';
		$class .= ($class ? ' ' : '') . yacht_rental_get_css_position_as_classes($top, $right, $bottom, $left);
		
		$output = '';
		
		$post_id = get_the_ID();
		$post = get_post( $post_id );

		if (  is_single($post_id) and ( $post->post_type == 'boats' ) ) {
			
			
			$boats_price_per = get_post_meta( $post_id, 'yacht_rental_boats_price_per', true );
			$boats_price = (int) get_post_meta( $post_id, 'yacht_rental_boats_price', true );
			$boats_price_sign = get_post_meta( $post_id, 'yacht_rental_boats_price_sign', true );
			$boats_location = get_post_meta( $post_id, 'yacht_rental_boats_location', true );
				if ( $boats_location == "inherit" ) $boats_location = '';
			$boats_length = get_post_meta( $post_id, 'yacht_rental_boats_length', true );
				if ( $boats_length == "inherit" ) $boats_length = '';
			$boats_crew = (int) get_post_meta( $post_id, 'yacht_rental_boats_crew', true );
			$boats_cabins = (int) get_post_meta( $post_id, 'yacht_rental_boats_charter_cabins', true );
			$boats_cruising_speed = get_post_meta( $post_id, 'yacht_rental_boats_cruising_speed', true );
			
			$post_title = $post->post_title;
			
			$output = '<div' . ($id ? ' id="'.esc_attr($id) . '"' : '') 
				. ' class="sc_boats_info ' . (!empty($class) ? ' '.esc_attr($class) : '') . '"'
				. '>';
			
			$output .= '<div class="sc_boats_info_post_title">'.esc_html($post_title).'</div>';
			
			if ( $boats_location != '' ) {
				$output .= '<div class="sc_boats_info_post_location">';
				$output .= '<span class="icon-placeholder"></span> ' . esc_html($boats_location);
				$output .= '</div>';
			}
			
			
			
			$output .= '<div class="sc_boats_info_post_list">';
			$output .= '<ul>';
				
			if (  $boats_price > 0 ) {
				$output .= '<li>';
				$output .= '<span class="sc_boats_info_post_list_price">';
				$output .= '<span class="sc_boats_info_post_list_price_sign">'.esc_html($boats_price_sign).'</span>';
				$output .= '<span class="sc_boats_info_post_list_price_price">'.esc_html($boats_price).'</span>';
				$output .= '<span class="sc_boats_info_post_list_price_per">'.esc_html__('per', 'trx_utils') . ' ' . esc_html($boats_price_per).'</span>';
				$output .= '</span>';
				$output .= '</li>';
			}
			
			$output .= '<li>';
			
			if ( $boats_length != "" ) {
				$output .= '<span class="sc_boats_info_post_list_icon"><span class="icon-meter"></span><strong>'.esc_html($boats_length). ' ' . esc_html__('M', 'trx_utils') . '</strong></span>';
			}
			
			if ( $boats_cruising_speed != "" ) {
				$output .= '<span class="sc_boats_info_post_list_icon"><span class="icon-download-speed"></span><strong>'.esc_html($boats_cruising_speed). ' ' . esc_html__('MPH', 'trx_utils') . '</strong></span>';
			}
			
			if ( $boats_crew > 0 ) {
				$output .= '<span class="sc_boats_info_post_list_icon"><span class="icon-profile"></span><strong>'.esc_html($boats_crew) . '</strong></span>';
			}
			
			if ( $boats_cabins > 0 ) {
				$output .= '<span class="sc_boats_info_post_list_icon"><span class="icon-bed"></span><strong>'.esc_html($boats_cabins) . '</strong></span>';
			}
			
			$output .= '</li>';
			
			
			$output .= '</ul>';
			$output .= '</div>';
			
			
			$output .= '</div>';
			
			
			
		} // end $post->post_type => 'boats'
		
		
		
		
		
		
		
		
		return apply_filters('yacht_rental_shortcode_output', $output, 'trx_boats_info', $atts, $content);
	}
	add_shortcode('trx_boats_info', 'yacht_rental_sc_boats_info');
}



/* Register shortcode in the internal SC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'yacht_rental_sc_boats_info_reg_shortcodes' ) ) {
	function yacht_rental_sc_boats_info_reg_shortcodes() {
	
		yacht_rental_sc_map("trx_boats_info", array(
			"title" => esc_html__("Boats info", 'trx_utils'),
			"desc" => wp_kses_data( __("Description", 'trx_utils') ),
			"decorate" => false,
			"container" => false,
			"params" => array(
				"top" => yacht_rental_get_sc_param('top'),
				"bottom" => yacht_rental_get_sc_param('bottom'),
				"left" => yacht_rental_get_sc_param('left'),
				"right" => yacht_rental_get_sc_param('right'),
				"id" => yacht_rental_get_sc_param('id'),
				"class" => yacht_rental_get_sc_param('class'),
			)
		));
	}
}


/* Register shortcode in the VC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'yacht_rental_sc_boats_info_reg_shortcodes_vc' ) ) {
	function yacht_rental_sc_boats_info_reg_shortcodes_vc() {
	
		vc_map( array(
			"base" => "trx_boats_info",
			"name" => esc_html__("Boats info", 'trx_utils'),
			"description" => wp_kses_data( __("Description", 'trx_utils') ),
			"category" => esc_html__('Content', 'trx_utils'),
			"class" => "trx_sc_single trx_sc_boats_info",
			'icon' => 'icon_trx_boats_info',
			"content_element" => true,
			"is_container" => false,
			"show_settings_on_create" => true,
			"params" => array(
				yacht_rental_get_vc_param('id'),
				yacht_rental_get_vc_param('class'),
				yacht_rental_get_vc_param('margin_top'),
				yacht_rental_get_vc_param('margin_bottom'),
				yacht_rental_get_vc_param('margin_left'),
				yacht_rental_get_vc_param('margin_right')
			)
		) );
		
		class WPBakeryShortCode_Trx_Boats_Info extends Yacht_Rental_VC_ShortCodeSingle {}
	}
}
?>