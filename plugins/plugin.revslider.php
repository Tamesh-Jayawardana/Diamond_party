<?php
/* Revolution Slider support functions
------------------------------------------------------------------------------- */

// Theme init
if (!function_exists('yacht_rental_revslider_theme_setup')) {
	add_action( 'yacht_rental_action_before_init_theme', 'yacht_rental_revslider_theme_setup', 1 );
	function yacht_rental_revslider_theme_setup() {
		if (yacht_rental_exists_revslider()) {
			add_filter( 'yacht_rental_filter_list_sliders',					'yacht_rental_revslider_list_sliders' );
			add_filter( 'yacht_rental_filter_shortcodes_params',			'yacht_rental_revslider_shortcodes_params' );
			add_filter( 'yacht_rental_filter_theme_options_params',			'yacht_rental_revslider_theme_options_params' );
		}
		if (is_admin()) {
			add_filter( 'yacht_rental_filter_required_plugins',				'yacht_rental_revslider_required_plugins' );
		}
	}
}

if ( !function_exists( 'yacht_rental_revslider_settings_theme_setup2' ) ) {
	add_action( 'yacht_rental_action_before_init_theme', 'yacht_rental_revslider_settings_theme_setup2', 3 );
	function yacht_rental_revslider_settings_theme_setup2() {
		if (yacht_rental_exists_revslider()) {

			// Add Revslider specific options in the Theme Options
			yacht_rental_storage_set_array_after('options', 'slider_engine', "slider_alias", array(
				"title" => esc_html__('Revolution Slider: Select slider',  'yacht-rental'),
				"desc" => wp_kses_data( __("Select slider to show (if engine=revo in the field above)", 'yacht-rental') ),
				"override" => "category,services_group,page",
				"dependency" => array(
					'show_slider' => array('yes'),
					'slider_engine' => array('revo')
				),
				"std" => "",
				"options" => yacht_rental_get_options_param('list_revo_sliders'),
				"type" => "select"
				)
			);

		}
	}
}

// Check if RevSlider installed and activated
if ( !function_exists( 'yacht_rental_exists_revslider' ) ) {
	function yacht_rental_exists_revslider() {
		return function_exists('rev_slider_shortcode');
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'yacht_rental_revslider_required_plugins' ) ) {
	function yacht_rental_revslider_required_plugins($list=array()) {
		if (in_array('revslider', (array)yacht_rental_storage_get('required_plugins'))) {
			$path = yacht_rental_get_file_dir('plugins/install/revslider.zip');
			if (file_exists($path)) {
				$list[] = array(
					'name' 		=> esc_html__('Revolution Slider', 'yacht-rental'),
					'slug' 		=> 'revslider',
					'source'	=> $path,
					'version'   => '6.6.15',
					'required' 	=> false
					);
			}
		}
		return $list;
	}
}

// Lists
//------------------------------------------------------------------------

// Add RevSlider in the sliders list, prepended inherit (if need)
if ( !function_exists( 'yacht_rental_revslider_list_sliders' ) ) {
	function yacht_rental_revslider_list_sliders($list=array()) {
		$list = is_array($list) ? $list : array();
		$list["revo"] = esc_html__("Layer slider (Revolution)", 'yacht-rental');
		return $list;
	}
}

// Return Revo Sliders list, prepended inherit (if need)
if ( !function_exists( 'yacht_rental_get_list_revo_sliders' ) ) {
	function yacht_rental_get_list_revo_sliders($prepend_inherit=false) {
		if (($list = yacht_rental_storage_get('list_revo_sliders'))=='') {
			$list = array();
			if (yacht_rental_exists_revslider()) {
				global $wpdb;
				$rows = $wpdb->get_results( "SELECT alias, title FROM " . esc_sql($wpdb->prefix) . "revslider_sliders" );
				if (is_array($rows) && count($rows) > 0) {
					foreach ($rows as $row) {
						$list[$row->alias] = $row->title;
					}
				}
			}
			$list = apply_filters('yacht_rental_filter_list_revo_sliders', $list);
			if (yacht_rental_get_theme_setting('use_list_cache')) yacht_rental_storage_set('list_revo_sliders', $list);
		}
		return $prepend_inherit ? yacht_rental_array_merge(array('inherit' => esc_html__("Inherit", 'yacht-rental')), $list) : $list;
	}
}

// Add RevSlider in the shortcodes params
if ( !function_exists( 'yacht_rental_revslider_shortcodes_params' ) ) {
	function yacht_rental_revslider_shortcodes_params($list=array()) {
		$list["revo_sliders"] = yacht_rental_get_list_revo_sliders();
		return $list;
	}
}

// Add RevSlider in the Theme Options params
if ( !function_exists( 'yacht_rental_revslider_theme_options_params' ) ) {
	function yacht_rental_revslider_theme_options_params($list=array()) {
		$list["list_revo_sliders"] = array('$yacht_rental_get_list_revo_sliders' => '');
		return $list;
	}
}
?>