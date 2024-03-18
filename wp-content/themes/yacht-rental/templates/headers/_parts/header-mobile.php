<?php
$header_options = yacht_rental_storage_get('header_mobile');
$contact_address_1 = trim(yacht_rental_get_custom_option('contact_address_1'));
$contact_address_2 = trim(yacht_rental_get_custom_option('contact_address_2'));
$contact_phone = trim(yacht_rental_get_custom_option('contact_phone'));
$contact_email = trim(yacht_rental_get_custom_option('contact_email'));
?>
	<div class="header_mobile">
		<div class="content_wrap">
			<div class="menu_button icon-menu"></div>
			<?php 
			yacht_rental_show_logo();
			?>
		</div>
		<div class="side_wrap">
			<div class="close"><?php esc_html_e('Close', 'yacht-rental'); ?></div>
			<div class="panel_top">
				<nav class="menu_main_nav_area">
					<?php
						$menu_main = yacht_rental_get_nav_menu('menu_main');
						if (empty($menu_main)) $menu_main = yacht_rental_get_nav_menu();
						$menu_main = yacht_rental_set_tag_attrib($menu_main, '<ul>', 'id', 'menu_mobile');
						yacht_rental_show_layout($menu_main);
					?>
				</nav>
			</div>
			
			<?php if ($header_options['contact_address'] || $header_options['contact_phone_email'] || $header_options['open_hours']) { ?>
			<div class="panel_middle">
				<?php
				if ($header_options['contact_address'] && (!empty($contact_address_1) || !empty($contact_address_2))) {
					?><div class="contact_field contact_address">
								<span class="contact_icon icon-home"></span>
								<span class="contact_label contact_address_1"><?php yacht_rental_show_layout($contact_address_1); ?></span>
								<span class="contact_address_2"><?php yacht_rental_show_layout($contact_address_2); ?></span>
							</div><?php
				}
						
				if ($header_options['contact_phone_email'] && (!empty($contact_phone) || !empty($contact_email))) {
					?><div class="contact_field contact_phone">
						<span class="contact_icon icon-phone"></span>
						<span class="contact_label contact_phone"><?php yacht_rental_show_layout($contact_phone); ?></span>
					</div><?php
				}
				
				yacht_rental_template_set_args('top-panel-top', array(
					'menu_user_id' => 'menu_user_mobile',
					'top_panel_top_components' => array(
						($header_options['open_hours'] ? 'open_hours' : '')
					)
				));
				get_template_part(yacht_rental_get_file_slug('templates/headers/_parts/top-panel-top.php'));
				?>
			</div>
			<?php } ?>

			<div class="panel_bottom">
				<?php if ($header_options['socials'] && yacht_rental_get_custom_option('show_socials')=='yes' && function_exists('yacht_rental_sc_socials')) { ?>
					<div class="contact_socials">
						<?php yacht_rental_show_layout(yacht_rental_sc_socials(array('size'=>'small'))); ?>
					</div>
				<?php } ?>
			</div>
		</div>
		<div class="mask"></div>
	</div>