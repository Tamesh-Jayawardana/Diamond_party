<?php

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


/* Theme setup section
-------------------------------------------------------------------- */

if ( !function_exists( 'yacht_rental_template_header_2_theme_setup' ) ) {
	add_action( 'yacht_rental_action_before_init_theme', 'yacht_rental_template_header_2_theme_setup', 1 );
	function yacht_rental_template_header_2_theme_setup() {
		yacht_rental_add_template(array(
			'layout' => 'header_2',
			'mode'   => 'header',
			'title'  => esc_html__('Header 2', 'yacht-rental'),
			'icon'   => yacht_rental_get_file_url('templates/headers/images/2.jpg')
			));
	}
}

// Template output
if ( !function_exists( 'yacht_rental_template_header_2_output' ) ) {
	function yacht_rental_template_header_2_output($post_options, $post_data) {

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

		<header class="top_panel_wrap top_panel_style_2 scheme_<?php echo esc_attr($post_options['scheme']); ?>">
			<div class="top_panel_wrap_inner top_panel_inner_style_2 top_panel_position_<?php echo esc_attr(yacht_rental_get_custom_option('top_panel_position')); ?>">
				<div class="top_panel_middle" <?php yacht_rental_show_layout($header_css); ?>>
					<div class="content_wrap">
						<div class="columns_wrap columns_fluid">
                            <div class="column-1 contact_logo">
								<?php yacht_rental_show_logo(); ?>
							</div>
						</div>
					</div>
				</div>

				<div class="top_panel_bottom">
					<div class="content_wrap clearfix">
						<nav class="menu_main_nav_area">
							<?php
							$menu_main = yacht_rental_get_nav_menu('menu_main');
							if (empty($menu_main)) $menu_main = yacht_rental_get_nav_menu();
							yacht_rental_show_layout($menu_main);
							?>
						</nav>
					</div>
				</div>

			</div>
		</header>

		<?php
		yacht_rental_storage_set('header_mobile', array(
			'open_hours' => false,
			'login' => true,
			'socials' => true,
			'bookmarks' => true,
			'contact_address' => false,
			'contact_phone_email' => true,
			'woo_cart' => true,
			'search' => true
			)
		);
	}
}
?>