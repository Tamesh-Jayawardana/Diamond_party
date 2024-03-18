<?php

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


/* Theme setup section
-------------------------------------------------------------------- */

if ( !function_exists( 'yacht_rental_template_form_custom_theme_setup' ) ) {
	add_action( 'yacht_rental_action_before_init_theme', 'yacht_rental_template_form_custom_theme_setup', 1 );
	function yacht_rental_template_form_custom_theme_setup() {
		yacht_rental_add_template(array(
			'layout' => 'form_custom',
			'mode'   => 'forms',
			'title'  => esc_html__('Custom Form', 'yacht-rental')
			));
	}
}

// Template output
if ( !function_exists( 'yacht_rental_template_form_custom_output' ) ) {
	function yacht_rental_template_form_custom_output($post_options, $post_data) {
		$form_style = yacht_rental_get_theme_option('input_hover');
		?>
		<form <?php echo !empty($post_options['id']) ? ' id="'.esc_attr($post_options['id']).'_form"' : ''; ?>
			class="sc_input_hover_<?php echo esc_attr($form_style); ?>"
			data-formtype="<?php echo esc_attr($post_options['layout']); ?>" 
			method="post" 
			action="<?php echo esc_url($post_options['action'] ? $post_options['action'] : admin_url('admin-ajax.php')); ?>">
			<?php
			if(function_exists('yacht_rental_sc_form_show_fields')) yacht_rental_sc_form_show_fields($post_options['fields']);
			yacht_rental_show_layout($post_options['content']);
			?>
			<div class="result sc_infobox"></div>
		</form>
		<?php
	}
}
?>