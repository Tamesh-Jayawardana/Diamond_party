<?php
/* WPBakery PageBuilder support functions
------------------------------------------------------------------------------- */

// Theme init
if (!function_exists('yacht_rental_vc_theme_setup')) {
	add_action( 'yacht_rental_action_before_init_theme', 'yacht_rental_vc_theme_setup', 1 );
	function yacht_rental_vc_theme_setup() {
		if (yacht_rental_exists_visual_composer()) {
			add_action('yacht_rental_action_add_styles',		 				'yacht_rental_vc_frontend_scripts' );
		}
		if (is_admin()) {
			add_filter( 'yacht_rental_filter_required_plugins',					'yacht_rental_vc_required_plugins' );
		}
	}
}

// Check if WPBakery PageBuilder installed and activated
if ( !function_exists( 'yacht_rental_exists_visual_composer' ) ) {
	function yacht_rental_exists_visual_composer() {
		return class_exists('Vc_Manager');
	}
}

// Check if WPBakery PageBuilder in frontend editor mode
if ( !function_exists( 'yacht_rental_vc_is_frontend' ) ) {
	function yacht_rental_vc_is_frontend() {
		return (isset($_GET['vc_editable']) && $_GET['vc_editable']=='true')
			|| (isset($_GET['vc_action']) && $_GET['vc_action']=='vc_inline');
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'yacht_rental_vc_required_plugins' ) ) {
	function yacht_rental_vc_required_plugins($list=array()) {
		if (in_array('visual_composer', (array)yacht_rental_storage_get('required_plugins'))) {
			$path = yacht_rental_get_file_dir('plugins/install/js_composer.zip');
			if (file_exists($path)) {
				$list[] = array(
					'name' 		=> esc_html__('WPBakery PageBuilder', 'yacht-rental'),
					'slug' 		=> 'js_composer',
					'source'	=> $path,
					'version'   => '7.1',
					'required' 	=> false
				);
			}
		}
		return $list;
	}
}

// Enqueue VC custom styles
if ( !function_exists( 'yacht_rental_vc_frontend_scripts' ) ) {
	function yacht_rental_vc_frontend_scripts() {
		if (file_exists(yacht_rental_get_file_dir('css/plugin.visual-composer.css')))
			wp_enqueue_style( 'yacht-rental-plugin-visual-composer-style',  yacht_rental_get_file_url('css/plugin.visual-composer.css'), array(), null );
	}
}

?>