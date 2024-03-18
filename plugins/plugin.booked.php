<?php
/* Booked Appointments support functions
------------------------------------------------------------------------------- */

// Theme init
if (!function_exists('yacht_rental_booked_theme_setup')) {
	add_action( 'yacht_rental_action_before_init_theme', 'yacht_rental_booked_theme_setup', 1 );
	function yacht_rental_booked_theme_setup() {
		// Register shortcode in the shortcodes list
		if (yacht_rental_exists_booked()) {
			add_action('yacht_rental_action_add_styles', 					'yacht_rental_booked_frontend_scripts');
		}
		if (is_admin()) {
			add_filter( 'yacht_rental_filter_required_plugins',				'yacht_rental_booked_required_plugins' );
		}
	}
}


// Check if plugin installed and activated
if ( !function_exists( 'yacht_rental_exists_booked' ) ) {
	function yacht_rental_exists_booked() {
		return class_exists('booked_plugin');
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'yacht_rental_booked_required_plugins' ) ) {
	function yacht_rental_booked_required_plugins($list=array()){
        if (in_array('booked', (array)yacht_rental_storage_get('required_plugins'))) {
            $path = yacht_rental_get_file_dir('plugins/install/booked.zip');
                if (file_exists($path)) {
                    $list[] = array(
                        'name' => esc_html__('Booked', 'yacht-rental'),
                        'slug' => 'booked',
                        'version' => '2.4.4',
                        'source' => $path,
                        'required' => false
                    );
                }
            }
            return $list;
        }

}

// Enqueue custom styles
if ( !function_exists( 'yacht_rental_booked_frontend_scripts' ) ) {
	function yacht_rental_booked_frontend_scripts() {
		if (file_exists(yacht_rental_get_file_dir('css/plugin.booked.css')))
			wp_enqueue_style( 'yacht-rental-plugin-booked-style',  yacht_rental_get_file_url('css/plugin.booked.css'), array(), null );
	}
}



// Lists
//------------------------------------------------------------------------

// Return booked calendars list, prepended inherit (if need)
if ( !function_exists( 'yacht_rental_get_list_booked_calendars' ) ) {
	function yacht_rental_get_list_booked_calendars($prepend_inherit=false) {
		return yacht_rental_exists_booked() ? yacht_rental_get_list_terms($prepend_inherit, 'booked_custom_calendars') : array();
	}
}
?>