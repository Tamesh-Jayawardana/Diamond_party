<?php

/* Theme setup section
-------------------------------------------------------------------- */
if (!function_exists('yacht_rental_sc_price_block_theme_setup')) {
	add_action( 'yacht_rental_action_before_init_theme', 'yacht_rental_sc_price_block_theme_setup' );
	function yacht_rental_sc_price_block_theme_setup() {
		add_action('yacht_rental_action_shortcodes_list', 		'yacht_rental_sc_price_block_reg_shortcodes');
		if (function_exists('yacht_rental_exists_visual_composer') && yacht_rental_exists_visual_composer())
			add_action('yacht_rental_action_shortcodes_list_vc','yacht_rental_sc_price_block_reg_shortcodes_vc');
	}
}



/* Shortcode implementation
-------------------------------------------------------------------- */

if (!function_exists('yacht_rental_sc_price_block')) {	
	function yacht_rental_sc_price_block($atts, $content=null){	
		if (yacht_rental_in_shortcode_blogger()) return '';
		extract(yacht_rental_html_decode(shortcode_atts(array(
			// Individual params
			"style" => 1,
			"title" => "",
			"link" => "",
			"link_text" => "",
			"icon" => "",
			"money" => "",
			"currency" => "$",
			"period" => "",
			"align" => "",
			"scheme" => "",
			// Common params
			"id" => "",
			"class" => "",
			"animation" => "",
			"css" => "",
			"width" => "",
			"height" => "",
			"top" => "",
			"bottom" => "",
			"left" => "",
			"right" => ""
		), $atts)));
		$output = '';
		$class .= ($class ? ' ' : '') . yacht_rental_get_css_position_as_classes($top, $right, $bottom, $left);
		$css .= yacht_rental_get_css_dimensions_from_values($width, $height);
		if ($money) $money = do_shortcode('[trx_price money="'.esc_attr($money).'" period="'.esc_attr($period).'"'.($currency ? ' currency="'.esc_attr($currency).'"' : '').']');
		$content = do_shortcode(yacht_rental_sc_clear_around($content));
		$output = '<div' . ($id ? ' id="'.esc_attr($id).'"' : '') 
					. ' class="sc_price_block sc_price_block_style_'.max(1, min(3, $style))
						. (!empty($class) ? ' '.esc_attr($class) : '')
						. ($scheme && !yacht_rental_param_is_off($scheme) && !yacht_rental_param_is_inherit($scheme) ? ' scheme_'.esc_attr($scheme) : '') 
						. ($align && $align!='none' ? ' align'.esc_attr($align) : '') 
						. '"'
					. ($css!='' ? ' style="'.esc_attr($css).'"' : '')
					. (!yacht_rental_param_is_off($animation) ? ' data-animation="'.esc_attr(yacht_rental_get_animation_classes($animation)).'"' : '')
					. '>'
				. '<div class="sc_price_block_box1">'
				. (!empty($icon) ? '<div class="sc_price_block_icon '.esc_attr($icon).'"></div>' : '')
				. (!empty($title) ? '<div class="sc_price_block_title"><span>'.($title).'</span></div>' : '')
				. '<div class="sc_price_block_money">'
					. ($money)
				. '</div>'
				. '</div>' // END sc_price_block_box1
				. '<div class="sc_price_block_box2">'
				. (!empty($content) ? '<div class="sc_price_block_description">'.($content).'</div>' : '')
				. (!empty($link_text) ? '<div class="sc_price_block_link">'.do_shortcode('[trx_button style_color="style_color_3" link="'.($link ? esc_url($link) : '#').'"]'.($link_text).'[/trx_button]').'</div>' : '')
				. '</div>' // END sc_price_block_box2
			. '</div>';
		return apply_filters('yacht_rental_shortcode_output', $output, 'trx_price_block', $atts, $content);
	}
	add_shortcode('trx_price_block', 'yacht_rental_sc_price_block');
}



/* Register shortcode in the internal SC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'yacht_rental_sc_price_block_reg_shortcodes' ) ) {
	function yacht_rental_sc_price_block_reg_shortcodes() {
	
		yacht_rental_sc_map("trx_price_block", array(
			"title" => esc_html__("Price block", 'trx_utils'),
			"desc" => wp_kses_data( __("Insert price block with title, price and description", 'trx_utils') ),
			"decorate" => false,
			"container" => true,
			"params" => array(
//				"style" => array(
//					"title" => esc_html__("Block style", 'trx_utils'),
//					"desc" => wp_kses_data( __("Select style for this price block", 'trx_utils') ),
//					"value" => 1,
//					"options" => yacht_rental_get_list_styles(1, 3),
//					"type" => "checklist"
//				),
				"title" => array(
					"title" => esc_html__("Title", 'trx_utils'),
					"desc" => wp_kses_data( __("Block title", 'trx_utils') ),
					"value" => "",
					"type" => "text"
				),
				"link" => array(
					"title" => esc_html__("Link URL", 'trx_utils'),
					"desc" => wp_kses_data( __("URL for link from button (at bottom of the block)", 'trx_utils') ),
					"value" => "",
					"type" => "text"
				),
				"link_text" => array(
					"title" => esc_html__("Link text", 'trx_utils'),
					"desc" => wp_kses_data( __("Text (caption) for the link button (at bottom of the block). If empty - button not showed", 'trx_utils') ),
					"value" => "",
					"type" => "text"
				),
				"icon" => array(
					"title" => esc_html__("Icon",  'trx_utils'),
					"desc" => wp_kses_data( __('Select icon from Fontello icons set (placed before/instead price)',  'trx_utils') ),
					"value" => "",
					"type" => "icons",
					"options" => yacht_rental_get_sc_param('icons')
				),
				"money" => array(
					"title" => esc_html__("Money", 'trx_utils'),
					"desc" => wp_kses_data( __("Money value (dot or comma separated)", 'trx_utils') ),
					"divider" => true,
					"value" => "",
					"type" => "text"
				),
				"currency" => array(
					"title" => esc_html__("Currency", 'trx_utils'),
					"desc" => wp_kses_data( __("Currency character", 'trx_utils') ),
					"value" => "$",
					"type" => "text"
				),
				"period" => array(
					"title" => esc_html__("Period", 'trx_utils'),
					"desc" => wp_kses_data( __("Period text (if need). For example: monthly, daily, etc.", 'trx_utils') ),
					"value" => "",
					"type" => "text"
				),
				"scheme" => array(
					"title" => esc_html__("Color scheme", 'trx_utils'),
					"desc" => wp_kses_data( __("Select color scheme for this block", 'trx_utils') ),
					"value" => "",
					"type" => "checklist",
					"options" => yacht_rental_get_sc_param('schemes')
				),
				"align" => array(
					"title" => esc_html__("Alignment", 'trx_utils'),
					"desc" => wp_kses_data( __("Align price to left or right side", 'trx_utils') ),
					"divider" => true,
					"value" => "",
					"type" => "checklist",
					"dir" => "horizontal",
					"options" => yacht_rental_get_sc_param('float')
				), 
				"_content_" => array(
					"title" => esc_html__("Description", 'trx_utils'),
					"desc" => wp_kses_data( __("Description for this price block", 'trx_utils') ),
					"divider" => true,
					"rows" => 4,
					"value" => "",
					"type" => "textarea"
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
if ( !function_exists( 'yacht_rental_sc_price_block_reg_shortcodes_vc' ) ) {
	function yacht_rental_sc_price_block_reg_shortcodes_vc() {
	
		vc_map( array(
			"base" => "trx_price_block",
			"name" => esc_html__("Price block", 'trx_utils'),
			"description" => wp_kses_data( __("Insert price block with title, price and description", 'trx_utils') ),
			"category" => esc_html__('Content', 'trx_utils'),
			'icon' => 'icon_trx_price_block',
			"class" => "trx_sc_single trx_sc_price_block",
			"content_element" => true,
			"is_container" => false,
			"show_settings_on_create" => true,
			"params" => array(
//				array(
//					"param_name" => "style",
//					"heading" => esc_html__("Block style", 'trx_utils'),
//					"desc" => wp_kses_data( __("Select style of this price block", 'trx_utils') ),
//					"admin_label" => true,
//					"class" => "",
//					"std" => 1,
//					"value" => array_flip(yacht_rental_get_list_styles(1, 3)),
//					"type" => "dropdown"
//				),
				array(
					"param_name" => "title",
					"heading" => esc_html__("Title", 'trx_utils'),
					"description" => wp_kses_data( __("Block title", 'trx_utils') ),
					"admin_label" => true,
					"class" => "",
					"value" => "",
					"type" => "textfield"
				),
				array(
					"param_name" => "link",
					"heading" => esc_html__("Link URL", 'trx_utils'),
					"description" => wp_kses_data( __("URL for link from button (at bottom of the block)", 'trx_utils') ),
					"class" => "",
					"value" => "",
					"type" => "textfield"
				),
				array(
					"param_name" => "link_text",
					"heading" => esc_html__("Link text", 'trx_utils'),
					"description" => wp_kses_data( __("Text (caption) for the link button (at bottom of the block). If empty - button not showed", 'trx_utils') ),
					"class" => "",
					"value" => "",
					"type" => "textfield"
				),
				array(
					"param_name" => "icon",
					"heading" => esc_html__("Icon", 'trx_utils'),
					"description" => wp_kses_data( __("Select icon from Fontello icons set (placed before/instead price)", 'trx_utils') ),
					"class" => "",
					"value" => yacht_rental_get_sc_param('icons'),
					"type" => "dropdown"
				),
				array(
					"param_name" => "money",
					"heading" => esc_html__("Money", 'trx_utils'),
					"description" => wp_kses_data( __("Money value (dot or comma separated)", 'trx_utils') ),
					"admin_label" => true,
					"group" => esc_html__('Money', 'trx_utils'),
					"class" => "",
					"value" => "",
					"type" => "textfield"
				),
				array(
					"param_name" => "currency",
					"heading" => esc_html__("Currency symbol", 'trx_utils'),
					"description" => wp_kses_data( __("Currency character", 'trx_utils') ),
					"admin_label" => true,
					"group" => esc_html__('Money', 'trx_utils'),
					"class" => "",
					"value" => "$",
					"type" => "textfield"
				),
				array(
					"param_name" => "period",
					"heading" => esc_html__("Period", 'trx_utils'),
					"description" => wp_kses_data( __("Period text (if need). For example: monthly, daily, etc.", 'trx_utils') ),
					"admin_label" => true,
					"group" => esc_html__('Money', 'trx_utils'),
					"class" => "",
					"value" => "",
					"type" => "textfield"
				),
				array(
					"param_name" => "scheme",
					"heading" => esc_html__("Color scheme", 'trx_utils'),
					"description" => wp_kses_data( __("Select color scheme for this block", 'trx_utils') ),
					"group" => esc_html__('Colors and Images', 'trx_utils'),
					"class" => "",
					"value" => array_flip((array)yacht_rental_get_sc_param('schemes')),
					"type" => "dropdown"
				),
				array(
					"param_name" => "align",
					"heading" => esc_html__("Alignment", 'trx_utils'),
					"description" => wp_kses_data( __("Align price to left or right side", 'trx_utils') ),
					"admin_label" => true,
					"class" => "",
					"value" => array_flip((array)yacht_rental_get_sc_param('float')),
					"type" => "dropdown"
				),
				array(
					"param_name" => "content",
					"heading" => esc_html__("Description", 'trx_utils'),
					"description" => wp_kses_data( __("Description for this price block", 'trx_utils') ),
					"class" => "",
					"value" => "",
					"type" => "textarea_html"
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
		
		class WPBakeryShortCode_Trx_PriceBlock extends Yacht_Rental_VC_ShortCodeSingle {}
	}
}
?>