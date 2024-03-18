<?php
/* The GDPR Framework support functions
------------------------------------------------------------------------------- */

// Theme init
if (!function_exists('yacht_rental_gdpr_compliance_theme_setup')) {
    add_action( 'yacht_rental_action_before_init_theme', 'yacht_rental_gdpr_compliance_theme_setup', 1 );
    function yacht_rental_gdpr_compliance_theme_setup() {
        if (is_admin()) {
            add_filter( 'yacht_rental_filter_required_plugins', 'yacht_rental_gdpr_compliance_required_plugins' );
        }
    }
}

// Check if Instagram Widget installed and activated
if ( !function_exists( 'yacht_rental_exists_gdpr_compliance' ) ) {
    function yacht_rental_exists_gdpr_compliance() {
        return defined( 'WP_GDPR_C_SLUG' );
    }
}

// Filter to add in the required plugins list
if ( !function_exists( 'yacht_rental_gdpr_compliance_required_plugins' ) ) {
    function yacht_rental_gdpr_compliance_required_plugins($list=array()) {
        if (in_array('gdpr-compliance', (array)yacht_rental_storage_get('required_plugins')))
            $list[] = array(
                'name'         => esc_html__('Cookie Information', 'yacht-rental'),
                'slug'         => 'wp-gdpr-compliance',
                'required'     => false
            );
        return $list;
    }
}