<?php

/* Theme setup section
-------------------------------------------------------------------- */
if (!function_exists('yacht_rental_sc_boats_search_theme_setup')) {
	add_action( 'yacht_rental_action_before_init_theme', 'yacht_rental_sc_boats_search_theme_setup' );
	function yacht_rental_sc_boats_search_theme_setup() {
		add_action('yacht_rental_action_shortcodes_list', 		'yacht_rental_sc_boats_search_reg_shortcodes');
		if (function_exists('yacht_rental_exists_visual_composer') && yacht_rental_exists_visual_composer())
			add_action('yacht_rental_action_shortcodes_list_vc','yacht_rental_sc_boats_search_reg_shortcodes_vc');
	}
}



/* Shortcode implementation
-------------------------------------------------------------------- */

/*
[trx_boats_search id="unique_id" top="margin_in_pixels" bottom="margin_in_pixels"]
*/

if (!function_exists('yacht_rental_sc_boats_search')) {
	function yacht_rental_sc_boats_search($atts, $content=null){
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
		
		$url = '';
		$page = 'boats';
		$url = yacht_rental_boats_get_stream_page_link($url, $page);
		
		$output = '<div' . ($id ? ' id="'.esc_attr($id) . '"' : '')
				. ' class="sc_boats_search ' . (!empty($class) ? ' '.esc_attr($class) : '') . '"'
				. '>';
		
		$output .= '<form method="get" action="' . esc_url($url) . '">';
		
		
		/* ***** show_type ***** */
		$output .= '<div class="sc_bs_type">';
		$bs_type = '';
		if ( isset($_GET['bs_type']) ) {
			$bs_type = htmlspecialchars(trim($_GET['bs_type']));
		}
		$list_type = yacht_rental_get_boats_list('boat_type_list');
		$output .= '<select class="mb" name="bs_type">';
		if ( $bs_type=='-1' ) { $selected="selected"; } else { $selected=""; }
		$output .= '<option '. esc_html($selected).' value="-1">'.esc_html__('Boats Type', 'trx_utils').'</option>';
		$i = 1;
		foreach ($list_type as $key => $value) {
			if ( $bs_type == $i ) { $selected="selected"; } else { $selected=""; }
			$output .= '<option '. esc_html($selected).' value="' . esc_html($i) . '">' . esc_html($value) . '</option>';
			$i++;
		}
		$output .= '</select>';
		$output .= '</div>';
		
		
		/* ***** show_location ***** */
		$output .= '<div class="sc_bs_location">';
		$bs_location = '';
		if ( isset($_GET['bs_location']) ) {
			$bs_location = htmlspecialchars(trim($_GET['bs_location']));
		}
		$list_location = yacht_rental_get_boats_list('boat_location_list');
		$output .= '<select class="mb" name="bs_location">';
		if ( $bs_location=='-1' ) { $selected="selected"; } else { $selected=""; }
		$output .= '<option '. esc_html($selected).' value="-1">'.esc_html__('Boats Location', 'trx_utils').'</option>';
		$i = 1;
		foreach ($list_location as $key => $value) {
			if ( $bs_location == $i ) { $selected="selected"; } else { $selected=""; }
			$output .= '<option '. esc_html($selected).' value="' . esc_html($i) . '">' . esc_html($value) . '</option>';
			$i++;
		}
		$output .= '</select>';
		$output .= '</div>';
		
		
		/* ***** show_crew ***** */
		$output .= '<div class="sc_bs_crew">';
		$bs_crew = '';
		if ( isset($_GET['bs_crew']) ) {
			$bs_crew = htmlspecialchars(trim($_GET['bs_crew']));
		}
		$output .= '<select class="mb" name="bs_crew">';
		if ( $bs_crew=='-1' ) { $selected="selected"; } else { $selected=""; }
		$output .= '<option '. esc_html($selected).' value="-1">'.esc_html__('# Crew', 'trx_utils').'</option>';
		if ( $bs_crew=='0' ) { $selected="selected"; } else { $selected=""; }
		$output .= '<option '. esc_html($selected).' value="0">'.esc_html__('Without crew', 'trx_utils').'</option>';
		if ( $bs_crew=='1' ) { $selected="selected"; } else { $selected=""; }
		$output .= '<option '. esc_html($selected).' value="1">'.esc_html__('With crew', 'trx_utils').'</option>';
		$output .= '</select>';
		$output .= '</div>';
		
		
		/* ***** show_length ***** */
		$output .= '<div class="sc_bs_length">';
		$bs_length_big = (int) yacht_rental_get_custom_option('boat_search_length');
		$bs_length_min = 0; $bs_length_max = $bs_length_big;
		if ( isset($_GET['bs_length_min']) ) {
			$bs_length_min = (int) htmlspecialchars(trim($_GET['bs_length_min']));
		}
		if ( isset($_GET['bs_length_max']) ) {
			$bs_length_max = (int) htmlspecialchars(trim($_GET['bs_length_max']));
		}
		$output .= '<div class="bs_length bs_range_slider">';
		$output .= '<div class="bs_length_info">';
		$output .= '<div class="bs_length_info_title">'.esc_html__('Length', 'trx_utils').'</div>';
		$output .= '<div class="bs_length_info_value">'.esc_html__('Any', 'trx_utils').'</div>';
		$output .= '<div class="cL"></div>';
		$output .= '</div>';
		$output .= '<div id="slider-range-area"></div>';
		$output .= '<input type="hidden" class="mb bs_length_min" name="bs_length_min" value="' . esc_html($bs_length_min) . '" >';
		$output .= '<input type="hidden" class="mb bs_length_max" name="bs_length_max" value="' . esc_html($bs_length_max) . '" >';
		$output .= '<input type="hidden" class="mb bs_length_big" name="bs_length_big" value="' . esc_html($bs_length_big) . '" >';
		$output .= '</div>';
		$output .= '</div>';
		
		
		/* ***** show_price ***** */
		$output .= '<div class="sc_bs_price">';
		$bs_price_big = (int) yacht_rental_get_custom_option('boat_search_price_max');
		$bs_price_min = 0; $bs_price_max = $bs_price_big;
		if ( isset($_GET['bs_price_min']) ) {
			$bs_price_min = (int) htmlspecialchars(trim($_GET['bs_price_min']));
		}
		if ( isset($_GET['bs_price_max']) ) {
			$bs_price_max = (int) htmlspecialchars(trim($_GET['bs_price_max']));
		}
		$output .= '<div class="bs_price bs_range_slider">';
		$output .= '<div class="bs_price_info">';
		$output .= '<div class="bs_price_info_title">'.esc_html__('Price', 'trx_utils').'</div>';
		$output .= '<div class="bs_price_info_value">'.esc_html__('Any', 'trx_utils').'</div>';
		$output .= '<div class="cL"></div>';
		$output .= '</div>';
		$output .= '<div id="slider-range-price"></div>';
		$output .= '<input type="hidden" class="mb bs_price_min" name="bs_price_min" value="' . esc_html($bs_price_min) . '" >';
		$output .= '<input type="hidden" class="mb bs_price_max" name="bs_price_max" value="' . esc_html($bs_price_max) . '" >';
		$output .= '<input type="hidden" class="mb bs_price_big" name="bs_price_big" value="' . esc_html($bs_price_big) . '" >';
		$output .= '</div>';
		$output .= '</div>';
		

		
		
		
		
		$output .= '<div class="sc_bs_submit">';
		$output .= '<input type="submit" class="sc_button sc_button_round sc_button_style_filled sc_button_style_color_style_color_2 sc_button_size_large bs" value="'.esc_html__('search for boats', 'trx_utils').'">';
		$output .= '</div>';
		
		
		
		$output .= '</form>';
		$output .= '</div>';
		return apply_filters('yacht_rental_shortcode_output', $output, 'trx_boats_search', $atts, $content);
	}
	add_shortcode('trx_boats_search', 'yacht_rental_sc_boats_search');
}



/* Register shortcode in the internal SC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'yacht_rental_sc_boats_search_reg_shortcodes' ) ) {
	function yacht_rental_sc_boats_search_reg_shortcodes() {
	
		yacht_rental_sc_map("trx_boats_search", array(
			"title" => esc_html__("Boats search", 'trx_utils'),
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
if ( !function_exists( 'yacht_rental_sc_boats_search_reg_shortcodes_vc' ) ) {
	function yacht_rental_sc_boats_search_reg_shortcodes_vc() {
	
		vc_map( array(
			"base" => "trx_boats_search",
			"name" => esc_html__("Boats search", 'trx_utils'),
			"description" => wp_kses_data( __("Description", 'trx_utils') ),
			"category" => esc_html__('Content', 'trx_utils'),
			"class" => "trx_sc_single trx_sc_boats_search",
			'icon' => 'icon_trx_boats_search',
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
		
		class WPBakeryShortCode_Trx_Boats_Search extends Yacht_Rental_VC_ShortCodeSingle {}
	}
}
?>