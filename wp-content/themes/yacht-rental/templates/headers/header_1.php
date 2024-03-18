<?php

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


/* Theme setup section
-------------------------------------------------------------------- */

if ( !function_exists( 'yacht_rental_template_header_1_theme_setup' ) ) {
	add_action( 'yacht_rental_action_before_init_theme', 'yacht_rental_template_header_1_theme_setup', 1 );
	function yacht_rental_template_header_1_theme_setup() {
		yacht_rental_add_template(array(
			'layout' => 'header_1',
			'mode'   => 'header',
			'title'  => esc_html__('Header 1', 'yacht-rental'),
			'icon'   => yacht_rental_get_file_url('templates/headers/images/1.jpg')
			));
	}
}

// Template output
if ( !function_exists( 'yacht_rental_template_header_1_output' ) ) {
	function yacht_rental_template_header_1_output($post_options, $post_data) {

		// WP custom header
		$header_css = '';
		if ($post_options['position'] != 'over') {
			$header_image = get_header_image();
			$header_css = $header_image!='' 
				? ' style="background-image: url('.esc_url($header_image).')"' 
				: '';
		}
		?>
		
		<div class="top_panel_fixed_wrap"></div>

		<header class="top_panel_wrap top_panel_style_1 scheme_<?php echo esc_attr($post_options['scheme']); ?>">
			<div class="top_panel_wrap_inner top_panel_inner_style_1 top_panel_position_<?php echo esc_attr(yacht_rental_get_custom_option('top_panel_position')); ?>">

			<div class="top_panel_middle" <?php yacht_rental_show_layout($header_css); ?>>
				<div class="content_wrap">
						<div class="top_panel_left maxHBoxItem"><?php yacht_rental_show_logo(true, true); ?></div>
						<div class="top_panel_right maxHBoxItem">
							<div class="top_panel_right_row">
								
								<?php
								$contact_address_header = trim(yacht_rental_get_custom_option('contact_address_header'));
								$contact_phone_header = trim(yacht_rental_get_custom_option('contact_phone_header'));
								?>
								<div class="top_panel_right_row_1">
									<div class="top_panel_right_row_1_left">
										<?php
										if ( !empty($contact_address_header) ) {
										?>
										<div class="top_panel_right_row_1_left_address">
											<span class="contact_icon icon-placeholder"></span>
											<span class="contact_label contact_address"><?php yacht_rental_show_layout($contact_address_header); ?></span>
										</div>
										<?php } ?>
										<?php
										if ( !empty($contact_address_header) ) {
										?>
										<div class="top_panel_right_row_1_left_phone">
											<span class="contact_icon icon-telephone"></span>
                                            <span class="contact_label contact_address"><?php echo esc_html__( 'Call us: ', 'yacht-rental' ) . '<a href="tel:' . $contact_phone_header .'">' . $contact_phone_header . '</a>'; ?></span>
										</div>
										<?php } ?>
									</div>
									
									<?php
									$button_in_header = 'book nowss';
									$button_in_header = trim(yacht_rental_get_custom_option('button_in_header'));
									$button_url_in_header = trim(yacht_rental_get_custom_option('button_url_in_header'));
									if ( !empty($button_in_header) && function_exists('yacht_rental_sc_button')) {
									?>
									
									<div class="top_panel_right_row_1_right"><?php yacht_rental_show_layout(yacht_rental_sc_button(array(
										'size'=>"small",
										'style_color'=>"style_color_3",
										'link'=>$button_url_in_header
										), $button_in_header)); ?>
									</div>
									<?php } ?>
									
									<div class="cL"></div>
								</div>
								<div class="top_panel_right_row_2">
									<nav class="menu_main_nav_area menu_hover_<?php echo esc_attr(yacht_rental_get_theme_option('menu_hover')); ?>">
										<?php
										$menu_main = yacht_rental_get_nav_menu('menu_main');
										if (empty($menu_main)) $menu_main = yacht_rental_get_nav_menu();
										yacht_rental_show_layout($menu_main);
										?>
									</nav>
								</div>
							</div>
						</div>
						<div class="cL"></div>
				</div>
			</div>


				

			</div>
		</header>

		<?php
		yacht_rental_storage_set('header_mobile', array(
			 'open_hours' => true,
			 'login' => true,
			 'socials' => true,
			 'bookmarks' => true,
			 'contact_address' => true,
			 'contact_phone_email' => true,
			 'woo_cart' => true,
			 'search' => true
			)
		);
	}
}
?>