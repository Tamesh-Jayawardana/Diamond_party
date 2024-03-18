<?php
// Get template args
extract(yacht_rental_template_get_args('counters'));
$show_all_counters = !isset($post_options['counters']);
$counters_tag = is_single() ? 'span' : 'a';

// Views
if ($show_all_counters || yacht_rental_strpos($post_options['counters'], 'views')!==false && function_exists('yacht_rental_reviews_theme_setup')) {
	?>
	<<?php yacht_rental_show_layout($counters_tag); ?> class="post_counters_item post_counters_views icon-eye" title="<?php echo esc_attr( sprintf(__('Views - %s', 'yacht-rental'), $post_data['post_views']) ); ?>" href="<?php echo esc_url($post_data['post_link']); ?>"><span class="post_counters_number"><?php yacht_rental_show_layout($post_data['post_views']); ?></span><?php if (yacht_rental_strpos($post_options['counters'], 'captions')!==false) echo ' '.esc_html__('Views', 'yacht-rental'); ?></<?php yacht_rental_show_layout($counters_tag); ?>>
	<?php
}

// Comments
if ($show_all_counters || yacht_rental_strpos($post_options['counters'], 'comments')!==false) {
	?>
	<a class="post_counters_item post_counters_comments icon-comment" title="<?php echo esc_attr( sprintf(__('Comments - %s', 'yacht-rental'), $post_data['post_comments']) ); ?>" href="<?php echo esc_url($post_data['post_comments_link']); ?>"><span class="post_counters_number"><?php yacht_rental_show_layout($post_data['post_comments']); ?></span><?php if (yacht_rental_strpos($post_options['counters'], 'captions')!==false) echo ' '.esc_html__('Comments', 'yacht-rental'); ?></a>
	<?php 
}
 
// Rating
$rating = $post_data['post_reviews_'.(yacht_rental_get_theme_option('reviews_first')=='author' ? 'author' : 'users')];
if ($rating > 0 && ($show_all_counters || yacht_rental_strpos($post_options['counters'], 'rating')!==false)) { 
	?>
	<<?php yacht_rental_show_layout($counters_tag); ?> class="post_counters_item post_counters_rating icon-star" title="<?php echo esc_attr( sprintf(__('Rating - %s', 'yacht-rental'), $rating) ); ?>" href="<?php echo esc_url($post_data['post_link']); ?>"><span class="post_counters_number"><?php yacht_rental_show_layout($rating); ?></span></<?php yacht_rental_show_layout($counters_tag); ?>>
	<?php
}

// Likes
if ($show_all_counters || yacht_rental_strpos($post_options['counters'], 'likes')!==false && function_exists('yacht_rental_reviews_theme_setup')) {
	// Load core messages
	yacht_rental_enqueue_messages();
	$likes = isset($_COOKIE['yacht_rental_likes']) ? sanitize_text_field($_COOKIE['yacht_rental_likes']) : '';
	$allow = yacht_rental_strpos($likes, ','.($post_data['post_id']).',')===false;
	?>
	<a class="post_counters_item post_counters_likes icon-heart <?php echo !empty($allow) ? 'enabled' : 'disabled'; ?>" title="<?php echo !empty($allow) ? esc_attr__('Like', 'yacht-rental') : esc_attr__('Dislike', 'yacht-rental'); ?>" href="#"
		data-postid="<?php echo esc_attr($post_data['post_id']); ?>"
		data-likes="<?php echo esc_attr($post_data['post_likes']); ?>"
		data-title-like="<?php esc_attr_e('Like', 'yacht-rental'); ?>"
		data-title-dislike="<?php esc_attr_e('Dislike', 'yacht-rental'); ?>"><span class="post_counters_number"><?php yacht_rental_show_layout($post_data['post_likes']); ?></span><?php if (yacht_rental_strpos($post_options['counters'], 'captions')!==false) echo ' '.esc_html__('Likes', 'yacht-rental'); ?></a>
	<?php
}

// Edit page link
if (yacht_rental_strpos($post_options['counters'], 'edit')!==false) {
	edit_post_link( esc_html__( 'Edit', 'yacht-rental' ), '<span class="post_edit edit-link">', '</span>' );
}

// Markup for search engines
if (is_single() && yacht_rental_strpos($post_options['counters'], 'markup')!==false) {
	?>
	<meta itemprop="interactionCount" content="User<?php echo esc_attr(yacht_rental_strpos($post_options['counters'],'comments')!==false ? 'Comments' : 'PageVisits'); ?>:<?php echo esc_attr(yacht_rental_strpos($post_options['counters'], 'comments')!==false ? $post_data['post_comments'] : $post_data['post_views']); ?>" />
	<?php
}
?>