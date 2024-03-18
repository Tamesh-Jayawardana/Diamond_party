<?php
/* Contact Form 7 support functions
------------------------------------------------------------------------------- */

// Theme init
if (!function_exists('yacht_rental_cf7_theme_setup')) {
    add_action( 'yacht_rental_action_before_init_theme', 'yacht_rental_cf7_theme_setup', 1 );
    function yacht_rental_cf7_theme_setup() {

		if (yacht_rental_exists_cf7()) {
			add_filter('wpcf7_autop_or_not', '__return_false');
			add_action('yacht_rental_action_add_styles',		 				'yacht_rental_cf7_scripts' );
		}
		

        if (is_admin()) {
            add_filter( 'yacht_rental_filter_required_plugins', 'yacht_rental_cf7_required_plugins' );
        }
    }
}

// Filter to add in the required plugins list
if ( !function_exists( 'yacht_rental_cf7_required_plugins' ) ) {
    function yacht_rental_cf7_required_plugins($list=array()) {
        if (in_array('contact-form-7', (array)yacht_rental_storage_get('required_plugins')))
            $list[] = array(
                'name'         => esc_html__('Contact Form 7', 'yacht-rental'),
                'slug'         => 'contact-form-7',
                'required'     => false
            );
        return $list;
    }
}


// Check if cf7 installed and activated
if ( !function_exists( 'yacht_rental_exists_cf7' ) ) {
	function yacht_rental_exists_cf7() {
		return class_exists( 'WPCF7' ) && class_exists( 'WPCF7_ContactForm' );
	}
}

// Enqueue VC custom styles
if ( !function_exists( 'yacht_rental_cf7_scripts' ) ) {
	function yacht_rental_cf7_scripts() {
		if (file_exists(yacht_rental_get_file_dir('css/plugin.contact-form-7.css')))
			wp_enqueue_style( 'yacht-rental-plugin-contact-form-7-style',  yacht_rental_get_file_url('css/plugin.contact-form-7.css'), array(), null );
	}
}
?>