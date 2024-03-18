<?php

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


/* Theme setup section
-------------------------------------------------------------------- */

if ( !function_exists( 'yacht_rental_template_boats_2_theme_setup' ) ) {
	add_action( 'yacht_rental_action_before_init_theme', 'yacht_rental_template_boats_2_theme_setup', 1 );
	function yacht_rental_template_boats_2_theme_setup() {
		yacht_rental_add_template(array(
			'layout' => 'boats-2',
			'template' => 'boats-2',
			'mode'   => 'boats,blog',
			'need_columns' => 'true',
			'title'  => esc_html__('Boats /Style 2/', 'yacht-rental'),
			'thumb_title'  => esc_html__('Large image (crop)', 'yacht-rental'),
			'w'		 => 770,
			'h'		 => 434
		));
	}
}

// Template output
if ( !function_exists( 'yacht_rental_template_boats_2_output' ) ) {
	function yacht_rental_template_boats_2_output($post_options, $post_data) {
		$show_title = !empty($post_data['post_title']);
		$parts = explode('_', $post_options['layout']);
		$style = $parts[0];
		if ( $post_options['columns_count'] == 1 ) $post_options['columns_count'] = 2;
		$columns = max(1, min(12, empty($parts[1]) ? $post_options['columns_count'] : (int) $parts[1]));
		
		
		if ( !isset($post_options['slider']) ) {
			$post_options['slider'] = 'no';
		}
		
		if ( !isset($post_options['tag_animation']) ) {
			$post_options['tag_animation'] = '';
		}
		
		if ( !isset($post_options['boat_image']) ) {
			$post_options['boat_image'] = $post_data['post_thumb'];
		}
		
		
		$boats_id_web = get_post_meta( $post_data['post_id'], 'yacht_rental_boats_id_web', true );
		$boats_price_per = get_post_meta( $post_data['post_id'], 'yacht_rental_boats_price_per', true );
		$boats_price = (int) get_post_meta( $post_data['post_id'], 'yacht_rental_boats_price', true );
		$boats_price_sign = get_post_meta( $post_data['post_id'], 'yacht_rental_boats_price_sign', true );
		$boats_location = get_post_meta( $post_data['post_id'], 'yacht_rental_boats_location', true );
		$boats_type = get_post_meta( $post_data['post_id'], 'yacht_rental_boats_type', true );
		$boats_manufacturer = get_post_meta( $post_data['post_id'], 'yacht_rental_boats_manufacturer', true );
		$boats_model = get_post_meta( $post_data['post_id'], 'yacht_rental_boats_model', true );
		$boats_length = get_post_meta( $post_data['post_id'], 'yacht_rental_boats_length', true );
			if ( $boats_length == "inherit" ) $boats_length = '';
		$boats_skipper = get_post_meta( $post_data['post_id'], 'yacht_rental_boats_skipper', true );
		$boats_crew = (int) get_post_meta( $post_data['post_id'], 'yacht_rental_boats_crew', true );
		$boats_charter_guest = get_post_meta( $post_data['post_id'], 'yacht_rental_boats_charter_guest', true );
		$boats_cabins = (int) get_post_meta( $post_data['post_id'], 'yacht_rental_boats_charter_cabins', true );
		$boats_year = get_post_meta( $post_data['post_id'], 'yacht_rental_boats_year', true );
		$boats_cruising_speed = get_post_meta( $post_data['post_id'], 'yacht_rental_boats_cruising_speed', true );
		$boats_amenities = get_post_meta( $post_data['post_id'], 'yacht_rental_boat_amenities_list', true );
		$boats_addon = get_post_meta( $post_data['post_id'], 'yacht_rental_boat_addon_list', true );
		
		
		$boats_price_box = '';
		if ( $boats_price > 0 ) {
			$boats_price_box .= '<span class="boats_price_box">';
			$boats_price_box .= '<span class="boats_price_box_item">';
			
			$boats_price_box .= '<span class="boats_price_sign">';
			$boats_price_box .= esc_html($boats_price_sign);
			$boats_price_box .= '</span>';
			$boats_price_box .= '<span class="boats_price">';
			$boats_price_box .= esc_html($boats_price);
			$boats_price_box .= '</span>';
			
			$boats_price_box .= '<span class="boats_price_per">';
			$boats_price_box .= esc_html__('per', 'yacht-rental') . ' ' . esc_html($boats_price_per);
			$boats_price_box .= '</span>';
			
			$boats_price_box .= '</span>';
			$boats_price_box .= '</span>';
		}
		
		if (yacht_rental_param_is_on($post_options['slider'])) {
			?><div class="swiper-slide" data-style="<?php echo esc_attr($post_options['tag_css_wh']); ?>" style="<?php echo esc_attr($post_options['tag_css_wh']); ?>"><?php
		} else if ($columns > 1) {
			?><div class="column-1_<?php echo esc_attr($columns); ?> column_padding_bottom"><?php
		}
		?>
				
				<div<?php echo !empty($post_options['tag_id']) ? ' id="'.esc_attr($post_options['tag_id']).'"' : ''; ?> class="sc_boats_item sc_boats_item_<?php echo esc_attr($post_options['number']) . ($post_options['number'] % 2 == 1 ? ' odd' : ' even') . ($post_options['number'] == 1 ? ' first' : '').(!empty($post_options['tag_class']) ? ' '.esc_attr($post_options['tag_class']) : ''); ?>"<?php echo (!empty($post_options['tag_css']) ? ' style="'.esc_attr($post_options['tag_css']).'"' : '') . (!yacht_rental_param_is_off($post_options['tag_animation']) ? ' data-animation="'.esc_attr(yacht_rental_get_animation_classes($post_options['tag_animation'])).'"' : '');?>>
					
					<div class="sc_boats_item_top">
						<?php
						if ($post_options['boat_image']) {
							echo (!empty($post_data['post_link']) ? '<a href="'.esc_url($post_data['post_link']).'">'	: '')
								. $boats_price_box
								. trim($post_options['boat_image'])
								. (!empty($post_data['post_link']) ? '</a>' : '');
						}
						?>
					</div>
					<div class="sc_boats_item_middle">
						<div class="sc_boats_item_middle_title">
							<?php
							if ($post_data['post_title']) {
								echo (!empty($post_data['post_link']) ? '<a href="'.esc_url($post_data['post_link']).'">'	: '')
									. esc_html($post_data['post_title'])
									. (!empty($post_data['post_link']) ? '</a>' : '');

							}
							?>
						</div>
						<div class="sc_boats_item_middle_location">
							<?php
							if ($boats_location) {
								echo '<span class="icon-placeholder"></span> ' . esc_html($boats_location);
							}
							?>
						</div>
					</div>
					<div class="sc_boats_item_bottom">
						
						<?php if ( $boats_length != "" ) { ?>
						<div class="sc_boats_item_bottom_length">
							<span class="icon-meter"></span> <strong><?php echo esc_html($boats_length) . ' ' . esc_html__('M', 'yacht-rental'); ?></strong>
						</div>
						<?php } ?>
						
						<?php if ( $boats_crew > 0 ) { ?>
						<div class="sc_boats_item_bottom_crew">
							<span class="icon-profile"></span> <strong><?php echo esc_html($boats_crew); ?></strong>
						</div>
						<?php } ?>
						
						<?php if ( $boats_cabins > 0 ) { ?>
						<div class="sc_boats_item_bottom_cabins">
							<span class="icon-bed"></span> <strong><?php echo esc_html($boats_cabins); ?></strong>
						</div>
						<?php } ?>
						
						<div class="cL"></div>
						
					</div>
					
				</div>	
				
		<?php
		if (yacht_rental_param_is_on($post_options['slider']) || $columns > 1) {
			?></div><?php
		}
	}
}
?>