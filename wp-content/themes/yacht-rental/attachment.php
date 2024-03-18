<?php
/**
 * Attachment page
 */
get_header(); 

while ( have_posts() ) { the_post();

	// Move yacht_rental_set_post_views to the javascript - counter will work under cache system
	if (yacht_rental_get_custom_option('use_ajax_views_counter')=='no') {
		yacht_rental_set_post_views(get_the_ID());
	}

	yacht_rental_show_post_layout(
		array(
			'layout' => 'attachment',
			'sidebar' => !yacht_rental_param_is_off(yacht_rental_get_custom_option('show_sidebar_main'))
		)
	);

}

get_footer();
?>