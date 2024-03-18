<?php
/* Gutenberg support functions
------------------------------------------------------------------------------- */

// Theme init
if (!function_exists('yacht_rental_gutenberg_theme_setup')) {
    add_action( 'yacht_rental_action_before_init_theme', 'yacht_rental_gutenberg_theme_setup', 1 );
    function yacht_rental_gutenberg_theme_setup() {
        if (is_admin()) {
            add_filter( 'yacht_rental_filter_required_plugins', 'yacht_rental_gutenberg_required_plugins' );
        }
    }
}

// Check if Instagram Widget installed and activated
if ( !function_exists( 'yacht_rental_exists_gutenberg' ) ) {
    function yacht_rental_exists_gutenberg() {
        return function_exists( 'the_gutenberg_project' ) && function_exists( 'register_block_type' );
    }
}

// Filter to add in the required plugins list
if ( !function_exists( 'yacht_rental_gutenberg_required_plugins' ) ) {
    function yacht_rental_gutenberg_required_plugins($list=array()) {
        if (in_array('gutenberg', (array)yacht_rental_storage_get('required_plugins')))
            $list[] = array(
                'name'         => esc_html__('Gutenberg', 'yacht-rental'),
                'slug'         => 'gutenberg',
                'required'     => false
            );
        return $list;
    }
}