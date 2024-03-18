<?php
/* Essential Grid support functions
------------------------------------------------------------------------------- */

// Theme init
if (!function_exists('yacht_rental_essgrids_theme_setup')) {
	add_action( 'yacht_rental_action_before_init_theme', 'yacht_rental_essgrids_theme_setup', 1 );
	function yacht_rental_essgrids_theme_setup() {
		// Register shortcode in the shortcodes list
		if (is_admin()) {
			add_filter( 'yacht_rental_filter_required_plugins',				'yacht_rental_essgrids_required_plugins' );
		}
	}
}


// Check if Ess. Grid installed and activated
if ( !function_exists( 'yacht_rental_exists_essgrids' ) ) {
	function yacht_rental_exists_essgrids() {
		return defined('EG_PLUGIN_PATH') || defined( 'ESG_PLUGIN_PATH' );
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'yacht_rental_essgrids_required_plugins' ) ) {
	function yacht_rental_essgrids_required_plugins($list=array()) {
		if (in_array('essgrids', (array)yacht_rental_storage_get('required_plugins'))) {
			$path = yacht_rental_get_file_dir('plugins/install/essential-grid.zip');
			if (file_exists($path)) {
				$list[] = array(
					'name' 		=> esc_html__('Essential Grid', 'yacht-rental'),
					'slug' 		=> 'essential-grid',
					'source'	=> $path,
					'version' => '3.1.0',
					'required' 	=> false
					);
			}
		}
		return $list;
	}
}

?>