<?php

/* Theme setup section
-------------------------------------------------------------------- */
if (!function_exists('yacht_rental_sc_boats_details_theme_setup')) {
	add_action( 'yacht_rental_action_before_init_theme', 'yacht_rental_sc_boats_details_theme_setup' );
	function yacht_rental_sc_boats_details_theme_setup() {
		add_action('yacht_rental_action_shortcodes_list', 		'yacht_rental_sc_boats_details_reg_shortcodes');
		if (function_exists('yacht_rental_exists_visual_composer') && yacht_rental_exists_visual_composer())
			add_action('yacht_rental_action_shortcodes_list_vc','yacht_rental_sc_boats_details_reg_shortcodes_vc');
	}
}



/* Shortcode implementation
-------------------------------------------------------------------- */

/*
[trx_boats_details id="unique_id" top="margin_in_pixels" bottom="margin_in_pixels"]
*/

if (!function_exists('yacht_rental_sc_boats_details')) {	
	function yacht_rental_sc_boats_details($atts, $content=null){	
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
			$boats_type = get_post_meta( $post_id, 'yacht_rental_boats_type', true );
			$boats_manufacturer = get_post_meta( $post_id, 'yacht_rental_boats_manufacturer', true );
			$boats_model = get_post_meta( $post_id, 'yacht_rental_boats_model', true );
			$boats_length = get_post_meta( $post_id, 'yacht_rental_boats_length', true );
				if ( $boats_length == "inherit" ) $boats_length = '';
			$boats_skipper = get_post_meta( $post_id, 'yacht_rental_boats_skipper', true );
				if ( $boats_skipper == "inherit" ) $boats_skipper = '';
			$boats_crew = (int) get_post_meta( $post_id, 'yacht_rental_boats_crew', true );
				if ( $boats_crew == 0 ) $boats_crew = '';
			$boats_charter_guest = get_post_meta( $post_id, 'yacht_rental_boats_charter_guest', true );
			$boats_cabins = (int) get_post_meta( $post_id, 'yacht_rental_boats_charter_cabins', true );
			$boats_year = get_post_meta( $post_id, 'yacht_rental_boats_year', true );
			$boats_cruising_speed = get_post_meta( $post_id, 'yacht_rental_boats_cruising_speed', true );
			
			$post_title = $post->post_title;
			
			$output = '<div' . ($id ? ' id="'.esc_attr($id) . '"' : '') 
				. ' class="sc_boats_details ' . (!empty($class) ? ' '.esc_attr($class) : '') . '"'
				. '>';
			
			$output .= '<div class="columns_wrap sc_columns_count_2">';
			$output .= '<div class="column-1_2c">';
			$output .= '<table cellpadding="0" cellspacing="0">';
			
			$output .= '<tr>';
			$output .= '<td>'.esc_html__('Boat type', 'trx_utils').':</td>';
			$output .= '<td>'.esc_html($boats_type).'</td>';
			$output .= '</tr>';
			
			$output .= '<tr>';
			$output .= '<td>'.esc_html__('Manufacturer', 'trx_utils').':</td>';
			$output .= '<td>'.esc_html($boats_manufacturer).'</td>';
			$output .= '</tr>';
			
			$output .= '<tr>';
			$output .= '<td>'.esc_html__('Model', 'trx_utils').':</td>';
			$output .= '<td>'.esc_html($boats_model).'</td>';
			$output .= '</tr>';
			
			$output .= '<tr>';
			$output .= '<td>'.esc_html__('Year', 'trx_utils').':</td>';
			$output .= '<td>'.esc_html($boats_year).'</td>';
			$output .= '</tr>';
			
			$output .= '<tr>';
			$output .= '<td>'.esc_html__('Length', 'trx_utils').':</td>';
			$output .= '<td>'.esc_html($boats_length).'</td>';
			$output .= '</tr>';
			
			$output .= '</table>';
			$output .= '</div>';
			
			
			$output .= '<div class="column-1_2c">';
			$output .= '<table cellpadding="0" cellspacing="0">';
			
			$output .= '<tr>';
			$output .= '<td>'.esc_html__('Cruising speed', 'trx_utils').':</td>';
			$output .= '<td>'.esc_html($boats_cruising_speed).'</td>';
			$output .= '</tr>';
			
			$output .= '<tr>';
			$output .= '<td>'.esc_html__('Boat skipper', 'trx_utils').':</td>';
			$output .= '<td>'.esc_html($boats_skipper).'</td>';
			$output .= '</tr>';
			
			$output .= '<tr>';
			$output .= '<td>'.esc_html__('Number of crew', 'trx_utils').':</td>';
			$output .= '<td>'.esc_html($boats_crew).'</td>';
			$output .= '</tr>';
			
			$output .= '<tr>';
			$output .= '<td>'.esc_html__('Charter guest', 'trx_utils').':</td>';
			$output .= '<td>'.esc_html($boats_charter_guest).'</td>';
			$output .= '</tr>';
			
			$output .= '<tr>';
			$output .= '<td>'.esc_html__('Cabbins', 'trx_utils').':</td>';
			$output .= '<td>'.esc_html($boats_cabins).'</td>';
			$output .= '</tr>';
			
			$output .= '</table>';
			$output .= '</div>';
			
			$output .= '</div>'; // end columns_wrap
			
			
			$output .= '</div>';
			
			
			
		} // end $post->post_type => 'boats'
		
		return apply_filters('yacht_rental_shortcode_output', $output, 'trx_boats_details', $atts, $content);
	}
	add_shortcode('trx_boats_details', 'yacht_rental_sc_boats_details');
}



/* Register shortcode in the internal SC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'yacht_rental_sc_boats_details_reg_shortcodes' ) ) {
	function yacht_rental_sc_boats_details_reg_shortcodes() {
	
		yacht_rental_sc_map("trx_boats_details", array(
			"title" => esc_html__("Boats details", 'trx_utils'),
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
if ( !function_exists( 'yacht_rental_sc_boats_details_reg_shortcodes_vc' ) ) {
	function yacht_rental_sc_boats_details_reg_shortcodes_vc() {
	
		vc_map( array(
			"base" => "trx_boats_details",
			"name" => esc_html__("Boats details", 'trx_utils'),
			"description" => wp_kses_data( __("Description", 'trx_utils') ),
			"category" => esc_html__('Content', 'trx_utils'),
			"class" => "trx_sc_single trx_sc_boats_details",
			'icon' => 'icon_trx_boats_details',
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
		
		class WPBakeryShortCode_Trx_Boats_Details extends Yacht_Rental_VC_ShortCodeSingle {}
	}
}
?>