<?php

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


/* Theme setup section
-------------------------------------------------------------------- */

if ( !function_exists( 'yacht_rental_template_list_theme_setup' ) ) {
	add_action( 'yacht_rental_action_before_init_theme', 'yacht_rental_template_list_theme_setup', 1 );
	function yacht_rental_template_list_theme_setup() {
		yacht_rental_add_template(array(
			'layout' => 'list',
			'mode'   => 'blogger',
			'need_columns' => true,
			'title'  => esc_html__('Blogger layout: List', 'yacht-rental')
			));
	}
}

// Template output
if ( !function_exists( 'yacht_rental_template_list_output' ) ) {
	function yacht_rental_template_list_output($post_options, $post_data) {
		$columns = max(1, min(12, $post_options['columns_count']));
		$title = '<li class="sc_blogger_item sc_list_item'.($columns > 1 ? ' column-1_'.esc_attr($columns) : '').'">'
			. (!isset($post_options['links']) || $post_options['links'] ? '<a href="' . esc_url($post_data['post_link']) . '">' : '')
			. '<span class="sc_list_icon '.($post_data['post_icon'] ? $post_data['post_icon'] : 'icon-right').'"></span>'
			. '<span class="sc_list_title">'.($post_data['post_title']).'</span>'
			. (!isset($post_options['links']) || $post_options['links'] ? '</a>' : '')
			. '</li>';
		yacht_rental_show_layout($title);
	}
}
?>