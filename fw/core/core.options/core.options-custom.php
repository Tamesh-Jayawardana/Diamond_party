<?php
/**
 * Yacht rental Framework: Theme options custom fields
 *
 * @package	yacht_rental
 * @since	yacht_rental 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


/* Theme setup section
-------------------------------------------------------------------- */

if ( !function_exists( 'yacht_rental_options_custom_theme_setup' ) ) {
	add_action( 'yacht_rental_action_before_init_theme', 'yacht_rental_options_custom_theme_setup' );
	function yacht_rental_options_custom_theme_setup() {

		if ( is_admin() ) {
			add_action("admin_enqueue_scripts",	'yacht_rental_options_custom_load_scripts');
		}
		
	}
}

// Load required styles and scripts for custom options fields
if ( !function_exists( 'yacht_rental_options_custom_load_scripts' ) ) {
	function yacht_rental_options_custom_load_scripts() {
		wp_enqueue_script( 'yacht-rental-options-custom-script',	yacht_rental_get_file_url('core/core.options/js/core.options-custom.js'), array(), null, true );	
	}
}


// Show theme specific fields in Post (and Page) options
if ( !function_exists( 'yacht_rental_show_custom_field' ) ) {
	function yacht_rental_show_custom_field($id, $field, $value) {
		$output = '';
		switch ($field['type']) {
			case 'reviews':
				$output .= '<div class="reviews_block">' . trim(yacht_rental_reviews_get_markup($field, $value, true)) . '</div>';
				break;
	
			case 'mediamanager':
				wp_enqueue_media( );
				$output .= '<a id="'.esc_attr($id).'" class="button mediamanager yacht_rental_media_selector"
					data-param="' . esc_attr($id) . '"
					data-choose="'.esc_attr(isset($field['multiple']) && $field['multiple'] ? esc_html__( 'Choose Images', 'yacht-rental') : esc_html__( 'Choose Image', 'yacht-rental')).'"
					data-update="'.esc_attr(isset($field['multiple']) && $field['multiple'] ? esc_html__( 'Add to Gallery', 'yacht-rental') : esc_html__( 'Choose Image', 'yacht-rental')).'"
					data-multiple="'.esc_attr(isset($field['multiple']) && $field['multiple'] ? 'true' : 'false').'"
					data-linked-field="'.esc_attr($field['media_field_id']).'"
					>' . (isset($field['multiple']) && $field['multiple'] ? esc_html__( 'Choose Images', 'yacht-rental') : esc_html__( 'Choose Image', 'yacht-rental')) . '</a>';
				break;
		}
		return apply_filters('yacht_rental_filter_show_custom_field', $output, $id, $field, $value);
	}
}
?>