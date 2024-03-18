<?php
/**
 * The template for displaying the footer.
 */

				yacht_rental_close_wrapper();	// <!-- </.content> -->

				// Show main sidebar
				get_sidebar();

				if (yacht_rental_get_custom_option('body_style')!='fullscreen') yacht_rental_close_wrapper();	// <!-- </.content_wrap> -->
				?>
			
			</div>		<!-- </.page_content_wrap> -->
			
			<?php
			
			if (yacht_rental_get_custom_option('show_custom_shortcode_box_in_footer')=='yes') {
				$scbox = yacht_rental_get_custom_option('custom_shortcode_box');
				echo '<div class="custom_shortcode_box"><div class="content_wrap">';
				yacht_rental_show_layout(yacht_rental_do_shortcode($scbox));
				echo '</div></div>';
			}
			
			
			// Google map
			if ( yacht_rental_get_custom_option('show_googlemap')=='yes' && function_exists('yacht_rental_sc_googlemap')) {
				$map_address = yacht_rental_get_custom_option('googlemap_address');
				$map_latlng  = yacht_rental_get_custom_option('googlemap_latlng');
				$map_zoom    = yacht_rental_get_custom_option('googlemap_zoom');
				$map_style   = yacht_rental_get_custom_option('googlemap_style');
				$map_height  = yacht_rental_get_custom_option('googlemap_height');
				if (!empty($map_address) || !empty($map_latlng)) {
					$args = array();
					if (!empty($map_style))		$args['style'] = esc_attr($map_style);
					if (!empty($map_zoom))		$args['zoom'] = esc_attr($map_zoom);
					if (!empty($map_height))	$args['height'] = esc_attr($map_height);
					yacht_rental_show_layout(yacht_rental_sc_googlemap($args));
				}
			}
			
			
			// Footer sidebar
			$footer_show  = yacht_rental_get_custom_option('show_sidebar_footer');
			$sidebar_name = yacht_rental_get_custom_option('sidebar_footer');
			if (!yacht_rental_param_is_off($footer_show) && is_active_sidebar($sidebar_name)) { 
				yacht_rental_storage_set('current_sidebar', 'footer');
				?>
				<footer class="footer_wrap widget_area scheme_<?php echo esc_attr(yacht_rental_get_custom_option('sidebar_footer_scheme')); ?>">
					<div class="footer_wrap_inner widget_area_inner">
						<div class="content_wrap">
							<div class="columns_wrap"><?php
							ob_start();
							do_action( 'before_sidebar' );
							if ( is_active_sidebar( $sidebar_name ) ) {
								dynamic_sidebar($sidebar_name);
							}
							do_action( 'after_sidebar' );
							$out = ob_get_contents();
							ob_end_clean();
							yacht_rental_show_layout(chop(preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $out)));
							?></div>	<!-- /.columns_wrap -->
						</div>	<!-- /.content_wrap -->
					</div>	<!-- /.footer_wrap_inner -->
				</footer>	<!-- /.footer_wrap -->
				<?php
			}


			// Footer contacts
			if (yacht_rental_get_custom_option('show_contacts_in_footer')=='yes') { 
				$address_1 = yacht_rental_get_theme_option('contact_address_1');
				$address_2 = yacht_rental_get_theme_option('contact_address_2');
				$phone = yacht_rental_get_theme_option('contact_phone');
				$fax = yacht_rental_get_theme_option('contact_fax');
				if (!empty($address_1) || !empty($address_2) || !empty($phone) || !empty($fax)) {
					?>
					<footer class="contacts_wrap scheme_<?php echo esc_attr(yacht_rental_get_custom_option('contacts_scheme')); ?>">
						<div class="contacts_wrap_inner">
							<div class="content_wrap">
								<?php yacht_rental_show_logo(false, false, true, false, false, false ); ?>
								<div class="contacts_address">
									<address class="address_right">
										<?php if (!empty($phone)) echo esc_html__('Phone:', 'yacht-rental') . ' ' . '<a href="tel:'. esc_attr($phone) .'">' . esc_html($phone) . '</a><br>'; ?>
										<?php if (!empty($fax)) echo esc_html__('Fax:', 'yacht-rental') . ' ' . esc_html($fax); ?>
									</address>
									<address class="address_left">
										<?php if (!empty($address_2)) echo esc_html($address_2) . '<br>'; ?>
										<?php if (!empty($address_1)) echo esc_html($address_1); ?>
									</address>
								</div>
								<?php if(function_exists('yacht_rental_sc_socials')) yacht_rental_show_layout(yacht_rental_sc_socials(array('size'=>"medium"))); ?>
							</div>	<!-- /.content_wrap -->
						</div>	<!-- /.contacts_wrap_inner -->
					</footer>	<!-- /.contacts_wrap -->
					<?php
				}
			}

			// Copyright area
			$copyright_style = yacht_rental_get_custom_option('show_copyright_in_footer');
			if (!yacht_rental_param_is_off($copyright_style)) {
				?> 
				<div class="copyright_wrap copyright_style_<?php echo esc_attr($copyright_style); ?>  scheme_<?php echo esc_attr(yacht_rental_get_custom_option('copyright_scheme')); ?>">
					<div class="copyright_wrap_inner">
						<div class="content_wrap">
							<?php
							if ($copyright_style == 'menu') {
								if (($menu = yacht_rental_get_nav_menu('menu_footer'))!='') {
									yacht_rental_show_layout($menu);
								}
							} else if ($copyright_style == 'socials' && function_exists('yacht_rental_sc_socials')) {
								yacht_rental_show_layout(yacht_rental_sc_socials(array('size'=>"tiny")));
							}
							?>
							<div class="copyright_text"><?php yacht_rental_show_layout(do_shortcode(str_replace(array('{{Y}}', '{Y}'), date('Y'), yacht_rental_get_custom_option('footer_copyright')))); ?></div>
						</div>
					</div>
				</div>
				<?php
			}
			?>
			
		</div>	<!-- /.page_wrap -->

	</div>		<!-- /.body_wrap -->
	
	<?php if ( !yacht_rental_param_is_off(yacht_rental_get_custom_option('show_sidebar_outer')) ) { ?>
	</div>	<!-- /.outer_wrap -->
	<?php } ?>

	<?php wp_footer(); ?>

</body>
</html>