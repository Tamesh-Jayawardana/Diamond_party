<?php
/* Themerex Updater support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('yacht_rental_trx_updater_theme_setup')) {
    add_action( 'yacht_rental_action_before_init_theme', 'yacht_rental_trx_updater_theme_setup', 1 );
    function yacht_rental_trx_updater_theme_setup() {
        if (is_admin()) {
            add_filter( 'yacht_rental_filter_required_plugins',		'yacht_rental_trx_updater_required_plugins' );
        }
    }
}

// Filter to add in the required plugins list
if ( !function_exists( 'yacht_rental_trx_updater_required_plugins' ) ) {
    function yacht_rental_trx_updater_required_plugins($list=array()) {
        if (in_array('trx_updater', (array)yacht_rental_storage_get('required_plugins'))) {
            $list[] = array(
                'name' 		=> esc_html__('ThemeREX Updater', 'yacht-rental'),
                'slug' 		=> 'trx_updater',
                'version'   => '2.1.2',
                'source'	=> yacht_rental_get_file_dir('plugins/install/trx_updater.zip'),
                'required' 	=> false
            );
        }
        return $list;
    }
}

// Check if Instagram Feed installed and activated
if ( !function_exists( 'yacht_rental_exists_trx_updater' ) ) {
    function yacht_rental_exists_trx_updater() {
        return defined('TRX_UPDATER_VERSION');
    }
}