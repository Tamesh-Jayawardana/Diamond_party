<?php
/**
 * Plugin support: QuickCal
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.5
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

// Check if plugin is installed and activated
if ( !function_exists( 'trx_utils_exists_quickcal' ) ) {
	function trx_utils_exists_quickcal() {
		return class_exists( 'quickcal_plugin' );
	}
}


// One-click import support
//------------------------------------------------------------------------

// Check plugin in the required plugins
if ( !function_exists( 'trx_utils_quickcal_importer_required_plugins' ) ) {
	if (is_admin()) add_filter( 'trx_utils_filter_importer_required_plugins',	'trx_utils_quickcal_importer_required_plugins', 10, 2 );
	function trx_utils_quickcal_importer_required_plugins($not_installed='', $list='') {
		if ( strpos( $list, 'quickcal' ) !== false && ! trx_utils_exists_quickcal() ) {
			$not_installed .= '<br>' . esc_html__('QuickCal', 'trx_utils');
		}
		return $not_installed;
	}
}

// Set plugin's specific importer options
if ( !function_exists( 'trx_utils_quickcal_importer_set_options' ) ) {
	if (is_admin()) add_filter( 'trx_utils_filter_importer_options', 'trx_utils_quickcal_importer_set_options', 10, 1 );
	function trx_utils_quickcal_importer_set_options($options=array()) {
		if ( trx_utils_exists_quickcal() && in_array( 'quickcal', $options['required_plugins'] ) ) {
			$options['additional_options'][] = 'quickcal_%';			// Add slugs to export options of this plugin
			$options['additional_options'][] = 'booked_%';				// Attention! QuickCal use Booked plugin options
		}
		return $options;
	}
}

// Check if the row will be imported
if ( !function_exists( 'trx_utils_quickcal_importer_check_row' ) ) {
	if (is_admin()) add_filter('trx_utils_filter_importer_import_row', 'trx_utils_quickcal_importer_check_row', 9, 4);
	function trx_utils_quickcal_importer_check_row($flag, $table, $row, $list) {
		if ( $flag || strpos( $list, 'quickcal' ) === false ) {
			return $flag;
		}
		if ( trx_utils_exists_quickcal() || ( function_exists( 'trx_utils_exists_booked' ) && trx_utils_exists_booked() ) ) {
			if ( $table == 'posts' ) {
				$flag = in_array( $row['post_type'], array( 'quickcal_appointments', 'booked_appointments' ) );
			}
		}
		return $flag;
	}
}

?>