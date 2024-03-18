<?php
/* QuickCal support functions
------------------------------------------------------------------------------- */

// Theme init
if (!function_exists('yacht_rental_quickcal_theme_setup')) {
	add_action( 'yacht_rental_action_before_init_theme', 'yacht_rental_quickcal_theme_setup', 1 );
	function yacht_rental_quickcal_theme_setup() {
		// Register shortcode in the shortcodes list
		if (yacht_rental_exists_quickcal()) {
			add_action('yacht_rental_action_add_styles', 					'yacht_rental_quickcal_frontend_scripts');
		}
	}
}


// Check if plugin installed and activated
if ( !function_exists( 'yacht_rental_exists_quickcal' ) ) {
	function yacht_rental_exists_quickcal() {
		return class_exists( 'quickcal_plugin' );
	}
}

// Enqueue custom styles
if ( !function_exists( 'yacht_rental_quickcal_frontend_scripts' ) ) {
	function yacht_rental_quickcal_frontend_scripts() {
		if (file_exists(yacht_rental_get_file_dir('css/plugin.booked.css')))
			wp_enqueue_style( 'yacht-rental-plugin-booked-style',  yacht_rental_get_file_url('css/plugin.booked.css'), array(), null );
	}
}



// Lists
//------------------------------------------------------------------------

// Return booked calendars list, prepended inherit (if need)
if ( !function_exists( 'yacht_rental_get_list_quickcal_calendars' ) ) {
	function yacht_rental_get_list_quickcal_calendars($prepend_inherit=false) {
		return yacht_rental_exists_quickcal() ? yacht_rental_get_list_terms($prepend_inherit, 'quickcal_custom_calendars') : array();
	}
}
?>