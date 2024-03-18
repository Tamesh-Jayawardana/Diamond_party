<?php

/* Theme setup section
-------------------------------------------------------------------- */
if (!function_exists('yacht_rental_sc_button_theme_setup')) {
	add_action( 'yacht_rental_action_before_init_theme', 'yacht_rental_sc_button_theme_setup' );
	function yacht_rental_sc_button_theme_setup() {
		add_action('yacht_rental_action_shortcodes_list', 		'yacht_rental_sc_button_reg_shortcodes');
		if (function_exists('yacht_rental_exists_visual_composer') && yacht_rental_exists_visual_composer())
			add_action('yacht_rental_action_shortcodes_list_vc','yacht_rental_sc_button_reg_shortcodes_vc');
	}
}



/* Shortcode implementation
-------------------------------------------------------------------- */

/*
[trx_button id="unique_id" type="square|round" fullsize="0|1" style="global|light|dark" size="mini|medium|big|huge|banner" icon="icon-name" link='#' target='']Button caption[/trx_button]
*/

if (!function_exists('yacht_rental_sc_button')) {	
	function yacht_rental_sc_button($atts, $content=null){	
		if (yacht_rental_in_shortcode_blogger()) return '';
		extract(yacht_rental_html_decode(shortcode_atts(array(
			// Individual params
			"type" => "round",
			"style" => "filled",
			"style_color" => "style_color_1",
			"size" => "small",
			"icon" => "",
			"color" => "",
			"bg_color" => "",
			"link" => "",
			"target" => "",
			"align" => "",
			"rel" => "",
			"popup" => "no",
			// Common params
			"id" => "",
			"class" => "",
			"css" => "",
			"animation" => "",
			"width" => "",
			"height" => "",
			"top" => "",
			"bottom" => "",
			"left" => "",
			"right" => ""
		), $atts)));
		$class .= ($class ? ' ' : '') . yacht_rental_get_css_position_as_classes($top, $right, $bottom, $left);
		$css .= yacht_rental_get_css_dimensions_from_values($width, $height)
			. ($color !== '' ? 'color:' . esc_attr($color) .';' : '')
			. ($bg_color !== '' ? 'background-color:' . esc_attr($bg_color) . '; border-color:'. esc_attr($bg_color) .';' : '');
		if (yacht_rental_param_is_on($popup)) yacht_rental_enqueue_popup('magnific');
		$output = '<a href="' . (empty($link) ? '#' : $link) . '"'
			. (!empty($target) ? ' target="'.esc_attr($target).'"' : '')
			. (!empty($rel) ? ' rel="'.esc_attr($rel).'"' : '')
			. (!yacht_rental_param_is_off($animation) ? ' data-animation="'.esc_attr(yacht_rental_get_animation_classes($animation)).'"' : '')
			. ' class="sc_button sc_button_' . esc_attr($type) 
					. ' sc_button_style_' . esc_attr($style) 
					. ' sc_button_style_color_' . esc_attr($style_color) 
					. ' sc_button_size_' . esc_attr($size)
					. ($align && $align!='none' ? ' align'.esc_attr($align) : '') 
					. (!empty($class) ? ' '.esc_attr($class) : '')
					. ($icon!='' ? '  sc_button_iconed '. esc_attr($icon) : '') 
					. (yacht_rental_param_is_on($popup) ? ' sc_popup_link' : '') 
					. '"'
			. ($id ? ' id="'.esc_attr($id).'"' : '') 
			. ($css!='' ? ' style="'.esc_attr($css).'"' : '') 
			. '>'
			. do_shortcode($content)
			. '</a>';
		return apply_filters('yacht_rental_shortcode_output', $output, 'trx_button', $atts, $content);
	}
	add_shortcode('trx_button', 'yacht_rental_sc_button');
}



/* Register shortcode in the internal SC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'yacht_rental_sc_button_reg_shortcodes' ) ) {
	function yacht_rental_sc_button_reg_shortcodes() {
	
		yacht_rental_sc_map("trx_button", array(
			"title" => esc_html__("Button", 'trx_utils'),
			"desc" => wp_kses_data( __("Button with link", 'trx_utils') ),
			"decorate" => false,
			"container" => true,
			"params" => array(
				"_content_" => array(
					"title" => esc_html__("Caption", 'trx_utils'),
					"desc" => wp_kses_data( __("Button caption", 'trx_utils') ),
					"value" => "",
					"type" => "text"
				),
//				"type" => array(
//					"title" => esc_html__("Button's shape", 'trx_utils'),
//					"desc" => wp_kses_data( __("Select button's shape", 'trx_utils') ),
//					"value" => "square",
//					"size" => "medium",
//					"options" => array(
//						'square' => esc_html__('Square', 'trx_utils'),
//						'round' => esc_html__('Round', 'trx_utils')
//					),
//					"type" => "switch"
//				), 
//				"style" => array(
//					"title" => esc_html__("Button's style", 'trx_utils'),
//					"desc" => wp_kses_data( __("Select button's style", 'trx_utils') ),
//					"value" => "default",
//					"dir" => "horizontal",
//					"options" => array(
//						'filled' => esc_html__('Filled', 'trx_utils'),
//						'border' => esc_html__('Border', 'trx_utils')
//					),
//					"type" => "checklist"
//				), 
				"style_color" => array(
					"title" => esc_html__("Button's color style", 'trx_utils'),
					"desc" => wp_kses_data( __("Select button's color style", 'trx_utils') ),
					"value" => "default",
					"dir" => "horizontal",
					"options" => array(
						'style_color_1' => esc_html__('Style 1', 'trx_utils'),
						'style_color_2' => esc_html__('Style 2', 'trx_utils'),
						'style_color_3' => esc_html__('Style 3', 'trx_utils')
					),
					"type" => "checklist"
				), 
				"size" => array(
					"title" => esc_html__("Button's size", 'trx_utils'),
					"desc" => wp_kses_data( __("Select button's size", 'trx_utils') ),
					"value" => "small",
					"dir" => "horizontal",
					"options" => array(
						'small' => esc_html__('Small', 'trx_utils'),
//						'medium' => esc_html__('Medium', 'trx_utils'),
						'large' => esc_html__('Large', 'trx_utils')
					),
					"type" => "checklist"
				), 
				"icon" => array(
					"title" => esc_html__("Button's icon",  'trx_utils'),
					"desc" => wp_kses_data( __('Select icon for the title from Fontello icons set',  'trx_utils') ),
					"value" => "",
					"type" => "icons",
					"options" => yacht_rental_get_sc_param('icons')
				),
				"color" => array(
					"title" => esc_html__("Button's text color", 'trx_utils'),
					"desc" => wp_kses_data( __("Any color for button's caption", 'trx_utils') ),
					"std" => "",
					"value" => "",
					"type" => "color"
				),
				"bg_color" => array(
					"title" => esc_html__("Button's backcolor", 'trx_utils'),
					"desc" => wp_kses_data( __("Any color for button's background", 'trx_utils') ),
					"value" => "",
					"type" => "color"
				),
				"align" => array(
					"title" => esc_html__("Button's alignment", 'trx_utils'),
					"desc" => wp_kses_data( __("Align button to left, center or right", 'trx_utils') ),
					"value" => "none",
					"type" => "checklist",
					"dir" => "horizontal",
					"options" => yacht_rental_get_sc_param('align')
				), 
				"link" => array(
					"title" => esc_html__("Link URL", 'trx_utils'),
					"desc" => wp_kses_data( __("URL for link on button click", 'trx_utils') ),
					"divider" => true,
					"value" => "",
					"type" => "text"
				),
				"target" => array(
					"title" => esc_html__("Link target", 'trx_utils'),
					"desc" => wp_kses_data( __("Target for link on button click", 'trx_utils') ),
					"dependency" => array(
						'link' => array('not_empty')
					),
					"value" => "",
					"type" => "text"
				),
				"popup" => array(
					"title" => esc_html__("Open link in popup", 'trx_utils'),
					"desc" => wp_kses_data( __("Open link target in popup window", 'trx_utils') ),
					"dependency" => array(
						'link' => array('not_empty')
					),
					"value" => "no",
					"type" => "switch",
					"options" => yacht_rental_get_sc_param('yes_no')
				), 
				"rel" => array(
					"title" => esc_html__("Rel attribute", 'trx_utils'),
					"desc" => wp_kses_data( __("Rel attribute for button's link (if need)", 'trx_utils') ),
					"dependency" => array(
						'link' => array('not_empty')
					),
					"value" => "",
					"type" => "text"
				),
				"width" => yacht_rental_shortcodes_width(),
				"height" => yacht_rental_shortcodes_height(),
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
if ( !function_exists( 'yacht_rental_sc_button_reg_shortcodes_vc' ) ) {
	function yacht_rental_sc_button_reg_shortcodes_vc() {
	
		vc_map( array(
			"base" => "trx_button",
			"name" => esc_html__("Button", 'trx_utils'),
			"description" => wp_kses_data( __("Button with link", 'trx_utils') ),
			"category" => esc_html__('Content', 'trx_utils'),
			'icon' => 'icon_trx_button',
			"class" => "trx_sc_single trx_sc_button",
			"content_element" => true,
			"is_container" => false,
			"show_settings_on_create" => true,
			"params" => array(
				array(
					"param_name" => "content",
					"heading" => esc_html__("Caption", 'trx_utils'),
					"description" => wp_kses_data( __("Button caption", 'trx_utils') ),
					"class" => "",
					"value" => "",
					"type" => "textfield"
				),
//				array(
//					"param_name" => "type",
//					"heading" => esc_html__("Button's shape", 'trx_utils'),
//					"description" => wp_kses_data( __("Select button's shape", 'trx_utils') ),
//					"class" => "",
//					"value" => array(
//						esc_html__('Square', 'trx_utils') => 'square',
//						esc_html__('Round', 'trx_utils') => 'round'
//					),
//					"type" => "dropdown"
//				),
//				array(
//					"param_name" => "style",
//					"heading" => esc_html__("Button's style", 'trx_utils'),
//					"description" => wp_kses_data( __("Select button's style", 'trx_utils') ),
//					"class" => "",
//					"value" => array(
//						esc_html__('Filled', 'trx_utils') => 'filled',
//						esc_html__('Border', 'trx_utils') => 'border'
//					),
//					"type" => "dropdown"
//				),
				array(
					"param_name" => "style_color",
					"heading" => esc_html__("Button's color style", 'trx_utils'),
					"description" => wp_kses_data( __("Select button's color style", 'trx_utils') ),
					"class" => "",
					"value" => array(
						esc_html__('Style 1', 'trx_utils') => 'style_color_1',
						esc_html__('Style 2', 'trx_utils') => 'style_color_2',
						esc_html__('Style 3', 'trx_utils') => 'style_color_3'
					),
					"type" => "dropdown"
				),
				array(
					"param_name" => "size",
					"heading" => esc_html__("Button's size", 'trx_utils'),
					"description" => wp_kses_data( __("Select button's size", 'trx_utils') ),
					"admin_label" => true,
					"class" => "",
					"value" => array(
						esc_html__('Small', 'trx_utils') => 'small',
//						esc_html__('Medium', 'trx_utils') => 'medium',
						esc_html__('Large', 'trx_utils') => 'large'
					),
					"type" => "dropdown"
				),
				array(
					"param_name" => "icon",
					"heading" => esc_html__("Button's icon", 'trx_utils'),
					"description" => wp_kses_data( __("Select icon for the title from Fontello icons set", 'trx_utils') ),
					"class" => "",
					"value" => yacht_rental_get_sc_param('icons'),
					"type" => "dropdown"
				),
				array(
					"param_name" => "color",
					"heading" => esc_html__("Button's text color", 'trx_utils'),
					"description" => wp_kses_data( __("Any color for button's caption", 'trx_utils') ),
					"class" => "",
					"value" => "",
					"type" => "colorpicker"
				),
				array(
					"param_name" => "bg_color",
					"heading" => esc_html__("Button's backcolor", 'trx_utils'),
					"description" => wp_kses_data( __("Any color for button's background", 'trx_utils') ),
					"class" => "",
					"value" => "",
					"type" => "colorpicker"
				),
				array(
					"param_name" => "align",
					"heading" => esc_html__("Button's alignment", 'trx_utils'),
					"description" => wp_kses_data( __("Align button to left, center or right", 'trx_utils') ),
					"class" => "",
					"value" => array_flip((array)yacht_rental_get_sc_param('align')),
					"type" => "dropdown"
				),
				array(
					"param_name" => "link",
					"heading" => esc_html__("Link URL", 'trx_utils'),
					"description" => wp_kses_data( __("URL for the link on button click", 'trx_utils') ),
					"class" => "",
					"group" => esc_html__('Link', 'trx_utils'),
					"value" => "",
					"type" => "textfield"
				),
				array(
					"param_name" => "target",
					"heading" => esc_html__("Link target", 'trx_utils'),
					"description" => wp_kses_data( __("Target for the link on button click", 'trx_utils') ),
					"class" => "",
					"group" => esc_html__('Link', 'trx_utils'),
					"value" => "",
					"type" => "textfield"
				),
				array(
					"param_name" => "popup",
					"heading" => esc_html__("Open link in popup", 'trx_utils'),
					"description" => wp_kses_data( __("Open link target in popup window", 'trx_utils') ),
					"class" => "",
					"group" => esc_html__('Link', 'trx_utils'),
					"value" => array(esc_html__('Open in popup', 'trx_utils') => 'yes'),
					"type" => "checkbox"
				),
				array(
					"param_name" => "rel",
					"heading" => esc_html__("Rel attribute", 'trx_utils'),
					"description" => wp_kses_data( __("Rel attribute for the button's link (if need", 'trx_utils') ),
					"class" => "",
					"group" => esc_html__('Link', 'trx_utils'),
					"value" => "",
					"type" => "textfield"
				),
				yacht_rental_get_vc_param('id'),
				yacht_rental_get_vc_param('class'),
				yacht_rental_get_vc_param('animation'),
				yacht_rental_get_vc_param('css'),
				yacht_rental_vc_width(),
				yacht_rental_vc_height(),
				yacht_rental_get_vc_param('margin_top'),
				yacht_rental_get_vc_param('margin_bottom'),
				yacht_rental_get_vc_param('margin_left'),
				yacht_rental_get_vc_param('margin_right')
			),
			'js_view' => 'VcTrxTextView'
		) );
		
		class WPBakeryShortCode_Trx_Button extends Yacht_Rental_VC_ShortCodeSingle {}
	}
}
?>