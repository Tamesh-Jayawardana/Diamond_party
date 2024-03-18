<?php

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


/* Theme setup section
-------------------------------------------------------------------- */

if ( !function_exists( 'yacht_rental_template_no_articles_theme_setup' ) ) {
	add_action( 'yacht_rental_action_before_init_theme', 'yacht_rental_template_no_articles_theme_setup', 1 );
	function yacht_rental_template_no_articles_theme_setup() {
		yacht_rental_add_template(array(
			'layout' => 'no-articles',
			'mode'   => 'internal',
			'title'  => esc_html__('No articles found', 'yacht-rental')
		));
	}
}

// Template output
if ( !function_exists( 'yacht_rental_template_no_articles_output' ) ) {
	function yacht_rental_template_no_articles_output($post_options, $post_data) {
		?>
		<article class="post_item">
			<div class="post_content">
				<h2 class="post_title"><?php esc_html_e('No posts found', 'yacht-rental'); ?></h2>
				<p><?php esc_html_e( 'Sorry, but nothing matched your search criteria.', 'yacht-rental' ); ?></p>
				<p><?php echo wp_kses_data( sprintf(__('Go back, or return to <a href="%s">%s</a> home page to choose a new page.', 'yacht-rental'), esc_url(home_url('/')), get_bloginfo()) ); ?>
				<br><?php esc_html_e('Please report any broken links to our team.', 'yacht-rental'); ?></p>
				<?php yacht_rental_show_layout(yacht_rental_sc_search(array('state'=>"fixed"))); ?>
			</div>	<!-- /.post_content -->
		</article>	<!-- /.post_item -->
		<?php
	}
}
?>