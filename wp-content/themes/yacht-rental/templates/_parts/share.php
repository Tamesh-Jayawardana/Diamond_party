<?php
// Get template args
extract(yacht_rental_template_last_args('single-footer'));

$show_share = yacht_rental_get_custom_option("show_share");
if (!yacht_rental_param_is_off($show_share) && function_exists('yacht_rental_show_share_links')) {
	$rez = yacht_rental_show_share_links(array(
		'post_id'    => $post_data['post_id'],
		'post_link'  => $post_data['post_link'],
		'post_title' => $post_data['post_title'],
		'post_descr' => strip_tags($post_data['post_excerpt']),
		'post_thumb' => $post_data['post_attachment'],
		'type'		 => 'block',
		'echo'		 => false
	));
	if ($rez) {
		?>
		<div class="post_info_share post_info_share_<?php echo esc_attr($show_share); ?>"><?php yacht_rental_show_layout($rez); ?></div>
		<?php
	}
}
?>