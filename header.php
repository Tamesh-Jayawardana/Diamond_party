<?php
/**
 * The Header for our theme.
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="<?php
		// Add class 'scheme_xxx' into <html> because it used as context for the body classes!
		$body_scheme = yacht_rental_get_custom_option('body_scheme');
		if (empty($body_scheme) || yacht_rental_is_inherit_option($body_scheme)) $body_scheme = 'original';
		echo 'scheme_' . esc_attr($body_scheme); 
		?>">

<head>
	<?php wp_head(); ?>
</head>

<body <?php body_class();?>>
<?php wp_body_open(); ?>
	<?php do_action( 'before' ); ?>

	<?php if ( !yacht_rental_param_is_off(yacht_rental_get_custom_option('show_sidebar_outer')) ) { ?>
	<div class="outer_wrap">
	<?php } ?>

	<?php get_template_part(yacht_rental_get_file_slug('sidebar_outer.php')); ?>

	<?php
		$body_style  = yacht_rental_get_custom_option('body_style');
		$class = $style = '';
		if (yacht_rental_get_custom_option('bg_custom')=='yes' && ($body_style=='boxed' || yacht_rental_get_custom_option('bg_image_load')=='always')) {
			if (($img = yacht_rental_get_custom_option('bg_image_custom')) != '')
				$style = 'background: url('.esc_url($img).') ' . str_replace('_', ' ', yacht_rental_get_custom_option('bg_image_custom_position')) . ' no-repeat fixed;';
			else if (($img = yacht_rental_get_custom_option('bg_pattern_custom')) != '')
				$style = 'background: url('.esc_url($img).') 0 0 repeat fixed;';
			else if (($img = yacht_rental_get_custom_option('bg_image')) > 0)
				$class = 'bg_image_'.($img);
			else if (($img = yacht_rental_get_custom_option('bg_pattern')) > 0)
				$class = 'bg_pattern_'.($img);
			if (($img = yacht_rental_get_custom_option('bg_color')) != '')
				$style .= 'background-color: '.($img).';';
		}
	?>

	<div class="body_wrap<?php echo !empty($class) ? ' '.esc_attr($class) : ''; ?>"<?php echo !empty($style) ? ' style="'.esc_attr($style).'"' : ''; ?>>

		<?php
		$video_bg_show = yacht_rental_get_custom_option('show_video_bg')=='yes';
		$youtube = yacht_rental_get_custom_option('video_bg_youtube_code');
		$video   = yacht_rental_get_custom_option('video_bg_url');
		$overlay = yacht_rental_get_custom_option('video_bg_overlay')=='yes';
		if ($video_bg_show && (!empty($youtube) || !empty($video))) {
			if (!empty($youtube)) {
				?>
				<div class="video_bg<?php echo !empty($overlay) ? ' video_bg_overlay' : ''; ?>" data-youtube-code="<?php echo esc_attr($youtube); ?>"></div>
				<?php
			} else if (!empty($video)) {
				$info = pathinfo($video);
				$ext = !empty($info['extension']) ? $info['extension'] : 'src';
				?>
				<div class="video_bg<?php echo !empty($overlay) ? ' video_bg_overlay' : ''; ?>"><video class="video_bg_tag" width="1280" height="720" data-width="1280" data-height="720" data-ratio="16:9" preload="metadata" autoplay loop src="<?php echo esc_url($video); ?>"><source src="<?php echo esc_url($video); ?>" type="video/<?php echo esc_attr($ext); ?>"></source></video></div>
				<?php
			}
		}
		?>

		<div class="page_wrap">

			<?php
			$top_panel_style = yacht_rental_get_custom_option('top_panel_style');
			$top_panel_position = yacht_rental_get_custom_option('top_panel_position');
			$top_panel_scheme = yacht_rental_get_custom_option('top_panel_scheme');
			// Top panel 'Above' or 'Over'
			if (in_array($top_panel_position, array('above', 'over'))) {
				yacht_rental_show_post_layout(array(
					'layout' => $top_panel_style,
					'position' => $top_panel_position,
					'scheme' => $top_panel_scheme
					), false);
				// Mobile Menu
				get_template_part(yacht_rental_get_file_slug('templates/headers/_parts/header-mobile.php'));
			}

			// Slider
			get_template_part(yacht_rental_get_file_slug('templates/headers/_parts/slider.php'));
			
			// Top panel 'Below'
			if ($top_panel_position == 'below') {
				yacht_rental_show_post_layout(array(
					'layout' => $top_panel_style,
					'position' => $top_panel_position,
					'scheme' => $top_panel_scheme
					), false);
				// Mobile Menu
				get_template_part(yacht_rental_get_file_slug('templates/headers/_parts/header-mobile.php'));
			}

			// Top of page section: page title and breadcrumbs
			$show_title = yacht_rental_get_custom_option('show_page_title')=='yes' && !is_front_page();
			$show_navi = apply_filters('yacht_rental_filter_show_post_navi', false);
			$show_breadcrumbs = yacht_rental_get_custom_option('show_breadcrumbs')=='yes';
			if (!is_front_page() && ( $show_title || $show_breadcrumbs )) {
				?>
				<div class="top_panel_title top_panel_style_<?php echo esc_attr(str_replace('header_', '', $top_panel_style)); ?> <?php echo (!empty($show_title) ? ' title_present'.  ($show_navi ? ' navi_present' : '') : '') . (!empty($show_breadcrumbs) ? ' breadcrumbs_present' : ''); ?> scheme_<?php echo esc_attr($top_panel_scheme); ?>">
					<div class="top_panel_title_inner top_panel_inner_style_<?php echo esc_attr(str_replace('header_', '', $top_panel_style)); ?> <?php echo (!empty($show_title) ? ' title_present_inner' : '') . (!empty($show_breadcrumbs) ? ' breadcrumbs_present_inner' : ''); ?>">
						<div class="content_wrap">
							<?php
							if ($show_title) {
								if ($show_navi) {
									?><div class="post_navi"><?php 
										previous_post_link( '<span class="post_navi_item post_navi_prev">%link</span>', '%title', true, '', 'product_cat' );
										next_post_link( '<span class="post_navi_item post_navi_next">%link</span>', '%title', true, '', 'product_cat' );
									?></div><?php
								} else {
									?><div class="page_title"><?php echo wp_kses_post(yacht_rental_get_blog_title()); ?></div><?php
								}
							}
							if ($show_breadcrumbs) {
								?><div class="breadcrumbs"><?php if (!is_404()) yacht_rental_show_breadcrumbs(); ?></div><?php
							}
							?>
						</div>
					</div>
				</div>
				<?php
			}
			
			if (yacht_rental_get_custom_option('show_boats_search')=='yes') { ?>
				<div class="bs_header">
					<div class="content_wrap">
						<?php
						yacht_rental_show_layout(yacht_rental_do_shortcode('[vc_row][vc_column][trx_boats_search][/vc_column][/vc_row]'));
						?>
					</div>
				</div>
			<?php
			}
			?>
			
			
			

			<div class="page_content_wrap page_paddings_<?php echo esc_attr(yacht_rental_get_custom_option('body_paddings')); ?>">

				<?php
				// Content and sidebar wrapper
				if ($body_style!='fullscreen') yacht_rental_open_wrapper('<div class="content_wrap">');
				
				// Main content wrapper
				yacht_rental_open_wrapper('<div class="content">');
				?>