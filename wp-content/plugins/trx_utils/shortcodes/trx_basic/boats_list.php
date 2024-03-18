<?php

/* Theme setup section
-------------------------------------------------------------------- */
if (!function_exists('yacht_rental_sc_boats_list_theme_setup')) {
	add_action( 'yacht_rental_action_before_init_theme', 'yacht_rental_sc_boats_list_theme_setup' );
	function yacht_rental_sc_boats_list_theme_setup() {
		add_action('yacht_rental_action_shortcodes_list', 		'yacht_rental_sc_boats_list_reg_shortcodes');
		if (function_exists('yacht_rental_exists_visual_composer') && yacht_rental_exists_visual_composer())
			add_action('yacht_rental_action_shortcodes_list_vc','yacht_rental_sc_boats_list_reg_shortcodes_vc');
	}
}



/* Shortcode implementation
-------------------------------------------------------------------- */

if (!function_exists('yacht_rental_sc_boats_list')) {	
	function yacht_rental_sc_boats_list($atts, $content=null){	
		if (yacht_rental_in_shortcode_blogger()) return '';
		extract(yacht_rental_html_decode(shortcode_atts(array(
			// Individual params
			"list" => "pramenities",
			"columns" => "2",
			// Common params
			"id" => "",
			"class" => "",
			"css" => "",
			"top" => "",
			"bottom" => "",
			"left" => "",
			"right" => ""
		), $atts)));
		$class .= ($class ? ' ' : '') . yacht_rental_get_css_position_as_classes($top, $right, $bottom, $left);

		$post_id = get_the_ID();
		$post = get_post( $post_id );
		$post_type = $post->post_type;
		$output = '';
		
		if ( $post_type == 'boats' ) {
			
			if ( $list == 'pramenities' )
				$pr_list = get_post_meta( $post_id, 'yacht_rental_boat_amenities_list', true );
			
			if ( $list == 'praddon' )
				$pr_list = get_post_meta( $post_id, 'yacht_rental_boat_addon_list', true );
			
			if (!empty($pr_list)) {
				$pr_arr = explode('|', $pr_list);
			}
			$pr_arr =  array_filter($pr_arr);
			
			$col = (int) $columns;
			if ( $col > 3 ) $col = 3;
			
			
			if ( !empty($pr_arr) ) {
				$output .= '<div' . ($id ? ' id="'.esc_attr($id) . '"' : '') 
					. ' class="sc_boats_list'. (!empty($class) ? ' '.esc_attr($class) : '') . '"'
					. ($css!='' ? ' style="'.esc_attr($css).'"' : '')
					. '>';
				
				
				if ($col > 1) {
					
					$output .= '<div class="columns_wrap sc_columns">';
					
					for ($i=1; $i<=$col; $i++) {
						$c[$i] = '';
						$c[$i] .= '<div class="column-1_'.$col.' sc_column_item sc_column_item_'.$i.'">';
						$c[$i] .= '<ul class="sc_list sc_list_style_iconed">';
					}
					
					$i = 1;
					foreach ($pr_arr as $value) {
						$c[$i] .= '<li class="sc_list_item">';
						$c[$i] .= '<span class="sc_list_icon icon-dot" style="color:#bc1834;"></span>';
						$c[$i] .= esc_html($value);
						$c[$i] .= '</li>';
						$i = $i + 1;
						if ( $i > $col ) { $i = 1; }
					}
					
					for ($i=1; $i<=$col; $i++) {
						$c[$i] .= '</ul>';
						$c[$i] .= '</div>';
					}
					
					for ($i=1; $i<=$col; $i++) { $output .= $c[$i]; }
					
				} else {
					$output .= '<ul class="sc_list sc_list_style_iconed">';
					foreach ($pr_arr as $value) {
						$output .= '<li class="sc_list_item">';
						$output .= '<span class="sc_list_icon icon-dot" style="color:#bc1834;"></span>';
						$output .= esc_html($value);
						$output .= '</li>';
					}
					$output .= '</ul>';
				}
				if ($col > 1) {$output .= '</div>';}
				
				$output .= '</div>';
			}

		}
		
		return apply_filters('yacht_rental_shortcode_output', $output, 'trx_boats_list', $atts, $content);
	}
	add_shortcode('trx_boats_list', 'yacht_rental_sc_boats_list');
}



/* Register shortcode in the internal SC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'yacht_rental_sc_boats_list_reg_shortcodes' ) ) {
	function yacht_rental_sc_boats_list_reg_shortcodes() {
	
		yacht_rental_sc_map("trx_boats_list", array(
			"title" => esc_html__("Boats list", 'trx_utils'),
			"desc" => wp_kses_data( __("Insert boats list into your post", 'trx_utils') ),
			"decorate" => false,
			"container" => false,
			"params" => array(
				"list" => array(
					"title" => esc_html__("Boats list", 'trx_utils'),
					"desc" => wp_kses_data( __("Select boats list", 'trx_utils') ),
					"value" => "pramenities",
					"type" => "select",
					"options" => array(
						'pramenities' => esc_html__('Boats amenities', 'trx_utils'),
						'praddon' => esc_html__("Boats add-on", 'trx_utils')
					),
				),
				"columns" => array(
					"title" => esc_html__("Columns", 'trx_utils'),
					"desc" => wp_kses_data( __("Select columns boats list", 'trx_utils') ),
					"value" => "2",
					"type" => "select",
					"options" => array(
						'1' => esc_html__('1 Columns', 'trx_utils'),
						'2' => esc_html__('2 Columns', 'trx_utils'),
						'3' => esc_html__('3 Columns', 'trx_utils')
					),
				),
				


				"top" => yacht_rental_get_sc_param('top'),
				"bottom" => yacht_rental_get_sc_param('bottom'),
				"left" => yacht_rental_get_sc_param('left'),
				"right" => yacht_rental_get_sc_param('right'),
				"id" => yacht_rental_get_sc_param('id'),
				"class" => yacht_rental_get_sc_param('class'),
				"css" => yacht_rental_get_sc_param('css')
			)
		));
	}
}


/* Register shortcode in the VC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'yacht_rental_sc_boats_list_reg_shortcodes_vc' ) ) {
	function yacht_rental_sc_boats_list_reg_shortcodes_vc() {
	
		vc_map( array(
			"base" => "trx_boats_list",
			"name" => esc_html__("Boats list", 'trx_utils'),
			"description" => wp_kses_data( __("Insert boats list into your post", 'trx_utils') ),
			"category" => esc_html__('Content', 'trx_utils'),
			"class" => "trx_sc_single trx_sc_boats_list",
			'icon' => 'icon_trx_boats_list',
			"content_element" => true,
			"is_container" => false,
			"show_settings_on_create" => true,
			"params" => array(
				array(
					"param_name" => "list",
					"heading" => esc_html__("Boats list", 'trx_utils'),
					"description" => wp_kses_data( __("Select boats list", 'trx_utils') ),
					"admin_label" => true,
					"class" => "",
//					"group" => esc_html__('Query', 'trx_utils'),
					"std" => 'pramenities',
					"value" => array(
							esc_html__('Boats amenities', 'trx_utils') => 'pramenities',
							esc_html__("Boats add-on", 'trx_utils') => 'praddon'
						),
					"type" => "dropdown"
				),
				array(
					"param_name" => "columns",
					"heading" => esc_html__("Columns", 'trx_utils'),
					"description" => wp_kses_data( __("Select boats list", 'trx_utils') ),
					"admin_label" => true,
					"class" => "",
					"std" => '2',
					"value" => array(
							esc_html__('1 Columns', 'trx_utils') => '1',
							esc_html__('2 Columns', 'trx_utils') => '2',
							esc_html__('3 Columns', 'trx_utils') => '3'
						),
					"type" => "dropdown"
				),
				


				yacht_rental_get_vc_param('id'),
				yacht_rental_get_vc_param('class'),
				yacht_rental_get_vc_param('css'),
				yacht_rental_get_vc_param('margin_top'),
				yacht_rental_get_vc_param('margin_bottom'),
				yacht_rental_get_vc_param('margin_left'),
				yacht_rental_get_vc_param('margin_right')
			)
		) );
		
		class WPBakeryShortCode_Trx_Boats_List extends Yacht_Rental_VC_ShortCodeSingle {}
	}
}
?>