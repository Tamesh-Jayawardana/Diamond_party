<?php
// Get template args
extract(yacht_rental_template_last_args('single-footer'));

if ($post_data['post_edit_enable']) {
	wp_register_script( 'wp-color-picker', get_site_url().'/wp-admin/js/color-picker.min.js', array('jquery'), '1.0', true);
	wp_enqueue_style ( 'fontello-admin',        yacht_rental_get_file_url('css/fontello-admin/css/fontello-admin.css'), array(), null);
	wp_enqueue_style ( 'yacht-rental-frontend-editor-style', yacht_rental_get_file_url('js/core.editor/core.editor.css'), array(), null );
	wp_enqueue_script( 'yacht-rental-frontend-editor',       yacht_rental_get_file_url('js/core.editor/core.editor.js'),  array(), null, true );
	yacht_rental_enqueue_messages();
	yacht_rental_options_load_scripts();
	yacht_rental_options_prepare_scripts($post_data['post_type']);
	yacht_rental_sc_load_scripts();
	yacht_rental_sc_prepare_scripts();
	?>
	<div id="frontend_editor">
		<div id="frontend_editor_inner">
			<form method="post">
				<label id="frontend_editor_post_title_label" for="frontend_editor_post_title"><?php esc_html_e('Title', 'yacht-rental'); ?></label>
				<input type="text" name="frontend_editor_post_title" id="frontend_editor_post_title" value="<?php echo esc_attr($post_data['post_title']); ?>" />
				<?php
				wp_editor($post_data['post_content_original'], 'frontend_editor_post_content', array(
					'wpautop' => true,
					'textarea_rows' => 16
				));
				?>
				<label id="frontend_editor_post_excerpt_label" for="frontend_editor_post_excerpt"><?php esc_html_e('Excerpt', 'yacht-rental'); ?></label>
				<textarea name="frontend_editor_post_excerpt" id="frontend_editor_post_excerpt"><?php echo htmlspecialchars($post_data['post_excerpt_original']); ?></textarea>
				<input type="button" id="frontend_editor_button_save" value="<?php esc_attr_e('Save', 'yacht-rental'); ?>" />
				<input type="button" id="frontend_editor_button_cancel" value="<?php esc_attr_e('Cancel', 'yacht-rental'); ?>" />
				<input type="hidden" id="frontend_editor_post_id" name="frontend_editor_post_id" value="<?php echo esc_attr($post_data['post_id']); ?>" />
			</form>
		</div>
	</div>
	<?php
}
?>
