<?php
// Get template args
extract(yacht_rental_template_get_args('widgets-posts'));

$post_id = get_the_ID();
$post_date = yacht_rental_get_date_or_difference(apply_filters('yacht_rental_filter_post_date', get_the_date('Y-m-d H:i:s'), $post_id, get_post_type()));
$post_title = get_the_title();
$post_link = !isset($show_links) || $show_links ? get_permalink($post_id) : '';

$output = '<article class="post_item' . ($show_image == 0 ? ' no_thumb' : ' with_thumb') . ($post_number==1 ? ' first' : '') . '">';

if ($show_image) {
	$post_thumb = yacht_rental_get_resized_image_tag($post_id, 70, 70);
	if ($post_thumb) {
		$output .= '<div class="post_thumb">' . ($post_thumb) . '</div>';
	}
}

$output .= '<div class="post_content">'
			.'<div class="post_title">'
			.($post_link ? '<a href="' . esc_url($post_link) . '">' : '') . ($post_title) . ($post_link ? '</a>' : '')
			.'</div>';

$post_counters = $post_counters_icon = '';

if ($show_counters && !yacht_rental_param_is_off($show_counters)) {

	if (yacht_rental_strpos($show_counters, 'views')!==false) {
		$post_counters = yacht_rental_storage_isset('post_data_'.$post_id) && yacht_rental_storage_get_array('post_data_'.$post_id, 'post_options_counters') 
							? yacht_rental_storage_get_array('post_data_'.$post_id, 'post_views') 
							: apply_filters('trx_utils_filter_get_post_views', 0, $post_id);
		$post_counters_icon = 'post_counters_views icon-eye';

	} else if (yacht_rental_strpos($show_counters, 'likes')!==false) {
		$likes = isset($_COOKIE['yacht_rental_likes']) ? sanitize_text_field($_COOKIE['yacht_rental_likes']) : '';
		$allow = yacht_rental_strpos($likes, ','.($post_id).',')===false;
		$post_counters = yacht_rental_storage_isset('post_data_'.$post_id) && yacht_rental_storage_get_array('post_data_'.$post_id, 'post_options_counters') 
							? yacht_rental_storage_get_array('post_data_'.$post_id, 'post_likes') 
							: apply_filters('trx_utils_filter_get_post_likes', 0, $post_id);
		$post_counters_icon = 'post_counters_likes icon-heart '.($allow ? 'enabled' : 'disabled');
		yacht_rental_enqueue_messages();

	} else if (yacht_rental_strpos($show_counters, 'stars')!==false || yacht_rental_strpos($show_counters, 'rating')!==false) {
		$post_counters = yacht_rental_reviews_marks_to_display(yacht_rental_storage_isset('post_data_'.$post_id) && yacht_rental_storage_get_array('post_data_'.$post_id, 'post_options_reviews')
							? yacht_rental_storage_get_array('post_data_'.$post_id, $post_rating) 
							: get_post_meta($post_id, $post_rating, true));
		$post_counters_icon = 'post_counters_rating icon-star';

	} else {
		$post_counters = yacht_rental_storage_isset('post_data_'.$post_id) && yacht_rental_storage_get_array('post_data_'.$post_id, 'post_options_counters') 
							? yacht_rental_storage_get_array('post_data_'.$post_id, 'post_comments') 
							: get_comments_number($post_id);
		$post_counters_icon = 'post_counters_comments icon-comment';
	}

	if (yacht_rental_strpos($show_counters, 'stars')!==false && $post_counters > 0) {
		if (yacht_rental_strpos($post_counters, '.')===false) 
			$post_counters .= '.0';
		if (yacht_rental_get_custom_option('show_reviews')=='yes') {
			$output .= '<div class="post_rating reviews_summary blog_reviews">'
				. '<div class="criteria_summary criteria_row">' . trim(yacht_rental_reviews_get_summary_stars($post_counters, false, false, 5)) . '</div>'
				. '</div>';
		}
	}
}

if ($show_date || $show_counters || $show_author) {
	$output .= '<div class="post_info">';
	if ($show_date) {
		$output .= '<span class="post_info_item post_info_posted">'.($post_link ? '<a href="' . esc_url($post_link) . '" class="post_info_date">' : '') . ($post_date) . ($post_link ? '</a>' : '').'</span>';
	}
	if ($show_author) {
		if (yacht_rental_storage_isset('post_data_'.$post_id)) {
			$post_author_id		= yacht_rental_storage_get_array('post_data_'.$post_id, 'post_author_id');
			$post_author_name	= yacht_rental_storage_get_array('post_data_'.$post_id, 'post_author');
			$post_author_url	= yacht_rental_storage_get_array('post_data_'.$post_id, 'post_author_url');
		} else {
			$post_author_id   = get_the_author_meta('ID');
			$post_author_name = get_the_author_meta('display_name', $post_author_id);
			$post_author_url  = get_author_posts_url($post_author_id, '');
		}
		$output .= '<span class="post_info_item post_info_posted_by">' . esc_html__('by', 'yacht-rental') . ' ' . ($post_link ? '<a href="' . esc_url($post_author_url) . '" class="post_info_author">' : '') . ($post_author_name) . ($post_link ? '</a>' : '') . '</span>';
	}
	if ($show_counters && yacht_rental_strpos($show_counters, 'stars')===false) {
		$post_counters_link = yacht_rental_strpos($show_counters, 'comments')!==false 
									? get_comments_link( $post_id ) 
									: (yacht_rental_strpos($show_counters, 'likes')!==false
									    ? '#'
									    : $post_link
									    );
		$output .= '<span class="post_info_item post_info_counters">'
			. ($post_counters_link ? '<a href="' . esc_url($post_counters_link) . '"' : '<span') 
				. ' class="post_counters_item ' . esc_attr($post_counters_icon) . '"'
				. (yacht_rental_strpos($show_counters, 'likes')!==false
					? ' title="' . ($allow ? esc_attr__('Like', 'yacht-rental') : esc_attr__('Dislike', 'yacht-rental')) . '"'
						. ' data-postid="' . esc_attr($post_id) . '"'
                        . ' data-likes="' . esc_attr($post_counters) . '"'
                        . ' data-title-like="' . esc_attr__('Like', 'yacht-rental') . '"'
                        . ' data-title-dislike="' . esc_attr__('Dislike', 'yacht-rental') . '"'
					: ''
				)
				. '>'
			. '<span class="post_counters_number">' . ($post_counters) . '</span>'
			. ($post_counters_link ? '</a>' : '</span>')
			. '</span>';
	}
	$output .= '<div class="cL"></div>';
	$output .= '</div>';
}
$output .= '</div>'
		.'</article>';

// Return result
yacht_rental_storage_set('widgets_posts_output', $output);
?>