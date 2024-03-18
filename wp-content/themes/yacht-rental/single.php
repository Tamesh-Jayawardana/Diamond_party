<?php
/**
 * Single post
 */
get_header(); 

$single_style = yacht_rental_storage_get('single_style');
if (empty($single_style)) $single_style = yacht_rental_get_custom_option('single_style');

while ( have_posts() ) { the_post();
	yacht_rental_show_post_layout(
		array(
			'layout' => $single_style,
			'sidebar' => !yacht_rental_param_is_off(yacht_rental_get_custom_option('show_sidebar_main')),
			'content' => yacht_rental_get_template_property($single_style, 'need_content'),
			'terms_list' => yacht_rental_get_template_property($single_style, 'need_terms')
		)
	);
}

get_footer();
?>