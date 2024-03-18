<?php

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


/* Theme setup section
-------------------------------------------------------------------- */

if ( !function_exists( 'yacht_rental_template_team_2_theme_setup' ) ) {
	add_action( 'yacht_rental_action_before_init_theme', 'yacht_rental_template_team_2_theme_setup', 1 );
	function yacht_rental_template_team_2_theme_setup() {
		yacht_rental_add_template(array(
			'layout' => 'team-2',
			'template' => 'team-2',
			'mode'   => 'team',
			'title'  => esc_html__('Team /Style 2/', 'yacht-rental'),
			'thumb_title'  => esc_html__('Medium square image (crop)', 'yacht-rental'),
			'w' => 370,
			'h' => 370
		));
	}
}

// Template output
if ( !function_exists( 'yacht_rental_template_team_2_output' ) ) {
	function yacht_rental_template_team_2_output($post_options, $post_data) {
		$show_title = true;
		$parts = explode('_', $post_options['layout']);
		$style = $parts[0];
		$columns = max(1, min(12, empty($parts[1]) ? (!empty($post_options['columns_count']) ? $post_options['columns_count'] : 1) : (int) $parts[1]));
		if (yacht_rental_param_is_on($post_options['slider'])) {
			?><div class="swiper-slide" data-style="<?php echo esc_attr($post_options['tag_css_wh']); ?>" style="<?php echo esc_attr($post_options['tag_css_wh']); ?>"><?php
		} else if ($columns > 1) {
			?><div class="column-1_<?php echo esc_attr($columns); ?> column_padding_bottom"><?php
		}
		?>
			<div<?php echo !empty($post_options['tag_id']) ? ' id="'.esc_attr($post_options['tag_id']).'"' : ''; ?>
				class="sc_team_item sc_team_item_<?php echo esc_attr($post_options['number']) . ($post_options['number'] % 2 == 1 ? ' odd' : ' even') . ($post_options['number'] == 1 ? ' first' : ''). (!empty($post_options['tag_class']) ? ' '.esc_attr($post_options['tag_class']) : ''); ?> columns_wrap"
				<?php echo (!empty($post_options['tag_css']) ? ' style="'.esc_attr($post_options['tag_css']).'"' : '') 
					. (!yacht_rental_param_is_off($post_options['tag_animation']) ? ' data-animation="'.esc_attr(yacht_rental_get_animation_classes($post_options['tag_animation'])).'"' : ''); ?>
			>
				<div class="sc_team_item_content">
				
					<div class="sc_team_item_content_top">
						<div class="sc_team_item_content_top_photo"><?php yacht_rental_show_layout($post_options['photo']); ?></div>
						<div class="sc_team_item_content_top_info">
							<div class="sc_team_item_content_top_info_title"><?php echo (!empty($post_options['link']) ? '<a href="'.esc_url($post_options['link']).'">' : '') . ($post_data['post_title']) . (!empty($post_options['link']) ? '</a>' : ''); ?></div>
							<?php if ( $post_options['position'] != '' ) { ?>
							<div class="sc_team_item_content_top_info_position"><?php yacht_rental_show_layout($post_options['position']);?></div>
							<?php } ?>
							<?php if ( $post_options['socials'] != '' ) { ?>
							<div class="sc_team_item_content_top_info_socials"><?php yacht_rental_show_layout($post_options['socials']); ?></div>
							<?php } ?>
						</div>
						<div class="cL"></div>
					</div>
					<div class="sc_team_item_content_bottom">
						<?php if ( $post_options['phone'] != '' ) { ?>
						<div class="sc_team_item_content_bottom_phone"><span class="icon-telephone"></span><a href="tel:<?php yacht_rental_show_layout($post_options['phone']) ?>"><?php yacht_rental_show_layout($post_options['phone']); ?></a></div>
						<?php } ?>
						<?php if ( $post_options['email'] != '' ) { ?>
                            <div class="sc_team_item_content_bottom_email"><span class="icon-e-mail-envelope"></span><a href="mailto:<?php antispambot(yacht_rental_show_layout($post_options['email'])); ?>"><?php yacht_rental_show_layout($post_options['email']); ?></a></div>
						<?php } ?>
					</div>
					
				</div>
				
			</div>
		<?php
		if (yacht_rental_param_is_on($post_options['slider']) || $columns > 1) {
			?></div><?php
		}
	}
}
?>