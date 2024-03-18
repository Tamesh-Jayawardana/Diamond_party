<?php
/* Mail Chimp support functions
------------------------------------------------------------------------------- */

// Theme init
if (!function_exists('yacht_rental_mailchimp_theme_setup')) {
	add_action( 'yacht_rental_action_before_init_theme', 'yacht_rental_mailchimp_theme_setup', 1 );
	function yacht_rental_mailchimp_theme_setup() {
		if (is_admin()) {
			add_filter( 'yacht_rental_filter_required_plugins',					'yacht_rental_mailchimp_required_plugins' );
		}
	}
}

// Check if Instagram Feed installed and activated
if ( !function_exists( 'yacht_rental_exists_mailchimp' ) ) {
	function yacht_rental_exists_mailchimp() {
		return function_exists('mc4wp_load_plugin');
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'yacht_rental_mailchimp_required_plugins' ) ) {
	function yacht_rental_mailchimp_required_plugins($list=array()) {
		if (in_array('mailchimp', (array)yacht_rental_storage_get('required_plugins')))
			$list[] = array(
				'name' 		=> esc_html__('MailChimp for WP', 'yacht-rental'),
				'slug' 		=> 'mailchimp-for-wp',
				'required' 	=> false
			);
		return $list;
	}
}

?>