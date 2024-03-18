<?php
if (!function_exists('yacht_rental_theme_shortcodes_setup')) {
	add_action( 'yacht_rental_action_before_init_theme', 'yacht_rental_theme_shortcodes_setup', 1 );
	function yacht_rental_theme_shortcodes_setup() {
		add_filter('yacht_rental_filter_googlemap_styles', 'yacht_rental_theme_shortcodes_googlemap_styles');
	}
}


// Add theme-specific Google map styles
if ( !function_exists( 'yacht_rental_theme_shortcodes_googlemap_styles' ) ) {
	function yacht_rental_theme_shortcodes_googlemap_styles($list) {
		$list['simple']		= esc_html__('Simple', 'yacht-rental');
		$list['greyscale']	= esc_html__('Greyscale', 'yacht-rental');
		$list['inverse']	= esc_html__('Inverse', 'yacht-rental');
		$list['apple']		= esc_html__('Apple', 'yacht-rental');
		return $list;
	}
}
?>