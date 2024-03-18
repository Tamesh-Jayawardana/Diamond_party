<?php
/**
 * Yacht rental Framework: messages subsystem
 *
 * @package	yacht_rental
 * @since	yacht_rental 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Theme init
if (!function_exists('yacht_rental_messages_theme_setup')) {
	add_action( 'yacht_rental_action_before_init_theme', 'yacht_rental_messages_theme_setup' );
	function yacht_rental_messages_theme_setup() {
		// Core messages strings
		add_filter('yacht_rental_filter_localize_script', 'yacht_rental_messages_localize_script');
	}
}


/* Session messages
------------------------------------------------------------------------------------- */

if (!function_exists('yacht_rental_get_error_msg')) {
	function yacht_rental_get_error_msg() {
		return yacht_rental_storage_get('error_msg');
	}
}

if (!function_exists('yacht_rental_set_error_msg')) {
	function yacht_rental_set_error_msg($msg) {
		$msg2 = yacht_rental_get_error_msg();
		yacht_rental_storage_set('error_msg', trim($msg2) . ($msg2=='' ? '' : '<br />') . trim($msg));
	}
}

if (!function_exists('yacht_rental_get_success_msg')) {
	function yacht_rental_get_success_msg() {
		return yacht_rental_storage_get('success_msg');
	}
}

if (!function_exists('yacht_rental_set_success_msg')) {
	function yacht_rental_set_success_msg($msg) {
		$msg2 = yacht_rental_get_success_msg();
		yacht_rental_storage_set('success_msg', trim($msg2) . ($msg2=='' ? '' : '<br />') . trim($msg));
	}
}

if (!function_exists('yacht_rental_get_notice_msg')) {
	function yacht_rental_get_notice_msg() {
		return yacht_rental_storage_get('notice_msg');
	}
}

if (!function_exists('yacht_rental_set_notice_msg')) {
	function yacht_rental_set_notice_msg($msg) {
		$msg2 = yacht_rental_get_notice_msg();
		yacht_rental_storage_set('notice_msg', trim($msg2) . ($msg2=='' ? '' : '<br />') . trim($msg));
	}
}


/* System messages (save when page reload)
------------------------------------------------------------------------------------- */
if (!function_exists('yacht_rental_set_system_message')) {
	function yacht_rental_set_system_message($msg, $status='info', $hdr='') {
		update_option(yacht_rental_storage_get('options_prefix') . '_message', array('message' => $msg, 'status' => $status, 'header' => $hdr));
	}
}

if (!function_exists('yacht_rental_get_system_message')) {
	function yacht_rental_get_system_message($del=false) {
		$msg = get_option(yacht_rental_storage_get('options_prefix') . '_message', false);
		if (!$msg)
			$msg = array('message' => '', 'status' => '', 'header' => '');
		else if ($del)
			yacht_rental_del_system_message();
		return $msg;
	}
}

if (!function_exists('yacht_rental_del_system_message')) {
	function yacht_rental_del_system_message() {
		delete_option(yacht_rental_storage_get('options_prefix') . '_message');
	}
}


/* Messages strings
------------------------------------------------------------------------------------- */

if (!function_exists('yacht_rental_messages_localize_script')) {
	function yacht_rental_messages_localize_script($vars) {
		$vars['strings'] = array(
			'ajax_error'		=> esc_html__('Invalid server answer', 'yacht-rental'),
			'bookmark_add'		=> esc_html__('Add the bookmark', 'yacht-rental'),
            'bookmark_added'	=> esc_html__('Current page has been successfully added to the bookmarks. You can see it in the right panel on the tab \'Bookmarks\'', 'yacht-rental'),
            'bookmark_del'		=> esc_html__('Delete this bookmark', 'yacht-rental'),
            'bookmark_title'	=> esc_html__('Enter bookmark title', 'yacht-rental'),
            'bookmark_exists'	=> esc_html__('Current page already exists in the bookmarks list', 'yacht-rental'),
			'search_error'		=> esc_html__('Error occurs in AJAX search! Please, type your query and press search icon for the traditional search way.', 'yacht-rental'),
			'email_confirm'		=> esc_html__('On the e-mail address "%s" we sent a confirmation email. Please, open it and click on the link.', 'yacht-rental'),
			'reviews_vote'		=> esc_html__('Thanks for your vote! New average rating is:', 'yacht-rental'),
			'reviews_error'		=> esc_html__('Error saving your vote! Please, try again later.', 'yacht-rental'),
			'error_like'		=> esc_html__('Error saving your like! Please, try again later.', 'yacht-rental'),
			'error_global'		=> esc_html__('Global error text', 'yacht-rental'),
			'name_empty'		=> esc_html__('The name can\'t be empty', 'yacht-rental'),
			'name_long'			=> esc_html__('Too long name', 'yacht-rental'),
			'email_empty'		=> esc_html__('Too short (or empty) email address', 'yacht-rental'),
			'email_long'		=> esc_html__('Too long email address', 'yacht-rental'),
			'email_not_valid'	=> esc_html__('Invalid email address', 'yacht-rental'),
			'subject_empty'		=> esc_html__('The subject can\'t be empty', 'yacht-rental'),
			'subject_long'		=> esc_html__('Too long subject', 'yacht-rental'),
			'text_empty'		=> esc_html__('The message text can\'t be empty', 'yacht-rental'),
			'text_long'			=> esc_html__('Too long message text', 'yacht-rental'),
			'send_complete'		=> esc_html__("Send message complete!", 'yacht-rental'),
			'send_error'		=> esc_html__('Transmit failed!', 'yacht-rental'),
			'not_agree'			=> esc_html__('Please, check \'I agree with Terms and Conditions\'', 'yacht-rental'),
			'login_empty'		=> esc_html__('The Login field can\'t be empty', 'yacht-rental'),
			'login_long'		=> esc_html__('Too long login field', 'yacht-rental'),
			'login_success'		=> esc_html__('Login success! The page will be reloaded in 3 sec.', 'yacht-rental'),
			'login_failed'		=> esc_html__('Login failed!', 'yacht-rental'),
			'password_empty'	=> esc_html__('The password can\'t be empty and shorter then 4 characters', 'yacht-rental'),
			'password_long'		=> esc_html__('Too long password', 'yacht-rental'),
			'password_not_equal'	=> esc_html__('The passwords in both fields are not equal', 'yacht-rental'),
			'registration_success'	=> esc_html__('Registration success! Please log in!', 'yacht-rental'),
			'registration_failed'	=> esc_html__('Registration failed!', 'yacht-rental'),
			'geocode_error'			=> esc_html__('Geocode was not successful for the following reason:', 'yacht-rental'),
			'googlemap_not_avail'	=> esc_html__('Google map API not available!', 'yacht-rental'),
			'editor_save_success'	=> esc_html__("Post content saved!", 'yacht-rental'),
			'editor_save_error'		=> esc_html__("Error saving post data!", 'yacht-rental'),
			'editor_delete_post'	=> esc_html__("You really want to delete the current post?", 'yacht-rental'),
			'editor_delete_post_header'	=> esc_html__("Delete post", 'yacht-rental'),
			'editor_delete_success'	=> esc_html__("Post deleted!", 'yacht-rental'),
			'editor_delete_error'	=> esc_html__("Error deleting post!", 'yacht-rental'),
			'editor_caption_cancel'	=> esc_html__('Cancel', 'yacht-rental'),
			'editor_caption_close'	=> esc_html__('Close', 'yacht-rental')
			);
		return $vars;
	}
}
?>