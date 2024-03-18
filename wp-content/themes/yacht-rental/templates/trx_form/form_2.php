<?php

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


/* Theme setup section
-------------------------------------------------------------------- */

if ( !function_exists( 'yacht_rental_template_form_2_theme_setup' ) ) {
	add_action( 'yacht_rental_action_before_init_theme', 'yacht_rental_template_form_2_theme_setup', 1 );
	function yacht_rental_template_form_2_theme_setup() {
		yacht_rental_add_template(array(
			'layout' => 'form_2',
			'mode'   => 'forms',
			'title'  => esc_html__('Contact Form 2', 'yacht-rental')
			));
	}
}

// Template output
if ( !function_exists( 'yacht_rental_template_form_2_output' ) ) {
	function yacht_rental_template_form_2_output($post_options, $post_data) {

		$form_style = yacht_rental_get_theme_option('input_hover');
		$address_1 = yacht_rental_get_theme_option('contact_address_1');
		$address_2 = yacht_rental_get_theme_option('contact_address_2');
		$phone = yacht_rental_get_theme_option('contact_phone');
		$fax = yacht_rental_get_theme_option('contact_fax');
		$email = yacht_rental_get_theme_option('contact_email');

        static $cnt = 0;
        $cnt++;
        $privacy = yacht_rental_get_privacy_text();
		
		?><div class="sc_columns columns_wrap"><?php

			// Form info
			?><div class="sc_form_address column-1_3">
				
				<div><h1 style="text-align:left;" class="sc_title sc_title_underline sc_align_left"><?php esc_html_e('Contacts', 'yacht-rental'); ?></h1></div>
				<div class="sc_form_address_field">
					<span class="sc_form_address_label"><?php esc_html_e('Address', 'yacht-rental'); ?></span>
					<span class="sc_form_address_data"><?php yacht_rental_show_layout(($address_1) . (!empty($address_1) && !empty($address_2) ? ', ' : '') . '<br>' . $address_2); ?></span><br>
				</div>
				<div class="sc_form_address_field">
					<span class="sc_form_address_label"><?php esc_html_e('Phone', 'yacht-rental'); ?></span>
					<span class="sc_form_address_data"><?php yacht_rental_show_layout($phone); ?></span>
				</div>
				<div class="sc_form_address_field">
					<span class="sc_form_address_label"><?php esc_html_e('E-mail', 'yacht-rental'); ?></span>
					<span class="sc_form_address_data sc_form_address_data_email"><?php yacht_rental_show_layout($email); ?></span>
				</div>
			</div><?php

			// Form fields
			?><div class="sc_form_fields column-2_3">
				<div><h1 style="text-align:left;" class="sc_title sc_title_underline sc_align_left"><?php esc_html_e('Get in Touch', 'yacht-rental'); ?></h1></div>
				<form <?php echo !empty($post_options['id']) ? ' id="'.esc_attr($post_options['id']).'_form"' : ''; ?> 
					class="sc_input_hover_<?php echo esc_attr($form_style); ?>"
					data-formtype="<?php echo esc_attr($post_options['layout']); ?>" 
					method="post" 
					action="<?php echo esc_url($post_options['action'] ? $post_options['action'] : admin_url('admin-ajax.php')); ?>">
					<?php yacht_rental_sc_form_show_fields($post_options['fields']); ?>
					<div class="sc_form_info">
						
						<div class="sc_form_item sc_form_field label_over"><?php
							if ($form_style!='default') { 
								?><label class="required" for="sc_form_username"><?php
									if ($form_style == 'path') {
										?><svg class="sc_form_graphic" preserveAspectRatio="none" viewBox="0 0 404 77" height="100%" width="100%"><path d="m0,0l404,0l0,77l-404,0l0,-77z"></svg><?php
									} else if ($form_style == 'iconed') {
										?><i class="sc_form_label_icon icon-user"></i><?php
									}
									?><span class="sc_form_label_content" data-content="<?php esc_attr_e('Name', 'yacht-rental'); ?>"><?php esc_html_e('Name', 'yacht-rental'); ?></span><?php
								?></label><?php
							}
						?><input id="sc_form_username" type="text" name="username"<?php if ($form_style=='default') echo ' placeholder="'.esc_attr__('Name *', 'yacht-rental').'"'; ?> aria-required="true"></div>
						
						
						<div class="sc_form_item sc_form_field label_over"><?php
							if ($form_style!='default') { 
								?><label class="required" for="sc_form_email"><?php
									if ($form_style == 'path') {
										?><svg class="sc_form_graphic" preserveAspectRatio="none" viewBox="0 0 404 77" height="100%" width="100%"><path d="m0,0l404,0l0,77l-404,0l0,-77z"></svg><?php
									} else if ($form_style == 'iconed') {
										?><i class="sc_form_label_icon icon-mail-empty"></i><?php
									}
									?><span class="sc_form_label_content" data-content="<?php esc_attr_e('Your E-mail', 'yacht-rental'); ?>"><?php esc_html_e('Your E-mail', 'yacht-rental'); ?></span><?php
								?></label><?php
							}
						?><input id="sc_form_email" type="text" name="email"<?php if ($form_style=='default') echo ' placeholder="'.esc_attr__('E-mail *', 'yacht-rental').'"'; ?> aria-required="true"></div>
					</div>
					
					
					<div class="sc_form_item sc_form_message"><?php
						if ($form_style!='default') { 
							?><label class="required" for="sc_form_message"><?php 
								if ($form_style == 'path') {
									?><svg class="sc_form_graphic" preserveAspectRatio="none" viewBox="0 0 404 77" height="100%" width="100%"><path d="m0,0l404,0l0,77l-404,0l0,-77z"></svg><?php
								} else if ($form_style == 'iconed') {
									?><i class="sc_form_label_icon icon-feather"></i><?php
								}
								?><span class="sc_form_label_content" data-content="<?php esc_attr_e('Message', 'yacht-rental'); ?>"><?php esc_html_e('Message', 'yacht-rental'); ?></span><?php
							?></label><?php
						}
					?><textarea id="sc_form_message" name="message"<?php if ($form_style=='default') echo ' placeholder="'.esc_attr__('Message', 'yacht-rental').'"'; ?> aria-required="true"></textarea></div>
                    <?php
                        if (!empty($privacy)) {
                        ?><div class="sc_form_field sc_form_field_checkbox"><?php
                        ?><input type="checkbox" id="i_agree_privacy_policy_sc_form_<?php echo esc_attr($cnt); ?>" name="i_agree_privacy_policy" class="sc_form_privacy_checkbox" value="1">
                        <label for="i_agree_privacy_policy_sc_form_<?php echo esc_attr($cnt); ?>"><?php yacht_rental_show_layout($privacy); ?></label>
                        </div><?php
                    }
                    ?>
					<div class="sc_form_item sc_form_button"><button class="sc_button_size_large" <?php
                        if (!empty($privacy)) echo ' disabled="disabled"'
                        ?>><?php esc_html_e('Send Message', 'yacht-rental'); ?></button></div>
					<div class="result sc_infobox"></div>
				</form>
			</div>
			
			<div class="cL"></div>
			
		</div>
		<?php
	}
}
?>