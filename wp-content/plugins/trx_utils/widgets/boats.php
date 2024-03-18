<?php

/**
 * Theme Widget: Boats search
 */


// Load widget
if (!function_exists('yacht_rental_widget_boats_search_load')) {
	add_action( 'widgets_init', 'yacht_rental_widget_boats_search_load' );
	function yacht_rental_widget_boats_search_load() {
		register_widget('yacht_rental_widget_boats_search');
	}
}

// Widget Class
class yacht_rental_widget_boats_search extends WP_Widget {
	
	function __construct() {
		$widget_ops = array('classname' => 'widget_boats_search scheme_dark scps', 'description' => esc_html__('Boats search (extended)', 'trx_utils'));
		parent::__construct( 'yacht_rental_widget_boats_search', esc_html__('Yacht rental - Boats search', 'trx_utils'), $widget_ops );

		// Add thumb sizes into list
        if(function_exists('yacht_rental_add_thumb_sizes'))
		yacht_rental_add_thumb_sizes( array( 'layout' => 'widgets', 'w' => 75, 'h' => 75, 'title'=>esc_html__('Widgets', 'trx_utils') ) );
	}
	
	
	// Show widget
	function widget($args, $instance) {
		extract($args);

		
		$url = ''; $id = '';
		$page = 'boats';
		$url = yacht_rental_boats_get_stream_page_link($url, $page);
		$title = apply_filters('widget_title', isset($instance['title']) ? $instance['title'] : '');
		
		$show_type = isset($instance['show_type']) ? (int) $instance['show_type'] : 0;
		$show_location = isset($instance['show_location']) ? (int) $instance['show_location'] : 0;
		$show_crew = isset($instance['show_crew']) ? (int) $instance['show_crew'] : 0;
		$show_length = isset($instance['show_length']) ? (int) $instance['show_length'] : 0;
		$show_price = isset($instance['show_price']) ? (int) $instance['show_price'] : 0;
		
		$show_amenities = isset($instance['show_amenities']) ? (int) $instance['show_amenities'] : 0;
		$show_addon = isset($instance['show_addon']) ? (int) $instance['show_addon'] : 0;
		
//		$show_keyword = isset($instance['show_keyword']) ? (int) $instance['show_keyword'] : 0;
//		$show_status = isset($instance['show_status']) ? (int) $instance['show_status'] : 0;
//		
//		$show_location = isset($instance['show_location']) ? (int) $instance['show_location'] : 0;
//		$show_type = isset($instance['show_type']) ? (int) $instance['show_type'] : 0;
//		$show_style = isset($instance['show_style']) ? (int) $instance['show_style'] : 0;
//		
//		$show_rooms = isset($instance['show_rooms']) ? (int) $instance['show_rooms'] : 0;
//		$show_bedrooms = isset($instance['show_bedrooms']) ? (int) $instance['show_bedrooms'] : 0;
//		$show_bathrooms = isset($instance['show_keyword']) ? (int) $instance['show_bathrooms'] : 0;
//		$show_garages = isset($instance['show_garages']) ? (int) $instance['show_garages'] : 0;
//		
//		$show_area = isset($instance['show_area']) ? (int) $instance['show_area'] : 0;
//		$show_amenities = isset($instance['show_keyword']) ? (int) $instance['show_amenities'] : 0;
//		$show_options = isset($instance['show_keyword']) ? (int) $instance['show_options'] : 0;
		
		
		$output = '';
		$output .= '<form method="get" action="' . esc_url($url) . '">';
		
		
		if ( ( $show_type == 1 ) or ( $show_location == 1 ) or ( $show_crew == 1 ) or ( $show_length == 1 ) or ( $show_price == 1 ) ) {
			$output .= '<div class="bs_box_1">';
		}
		
		/* ***** show_type ***** */
		if ( $show_type == 1 ) {
			$bs_type = '';
			if ( isset($_GET['bs_type']) ) {
				$bs_type = htmlspecialchars(trim($_GET['bs_type']));
			}
			$list_type = yacht_rental_get_boats_list('boat_type_list');
			$output .= '<div class="bs_box_select"><select class="mb" name="bs_type">';
			if ( $bs_type=='-1' ) { $selected="selected"; } else { $selected=""; }
			$output .= '<option '. esc_html($selected).' value="-1">'.esc_html__('Boats Type', 'trx_utils').'</option>';
			$i = 1;
			foreach ($list_type as $key => $value) {
				if ( $bs_type == $i ) { $selected="selected"; } else { $selected=""; }
				$output .= '<option '. esc_html($selected).' value="' . esc_html($i) . '">' . esc_html($value) . '</option>';
				$i++;
			}
			$output .= '</select></div>';
		}
		
		/* ***** show_location ***** */
		if ( $show_location == 1 ) {
			$bs_location = '';
			if ( isset($_GET['bs_location']) ) {
				$bs_location = htmlspecialchars(trim($_GET['bs_location']));
			}
			$list_location = yacht_rental_get_boats_list('boat_location_list');
			$output .= '<div class="bs_box_select"><select class="mb" name="bs_location">';
			if ( $bs_location=='-1' ) { $selected="selected"; } else { $selected=""; }
			$output .= '<option '. esc_html($selected).' value="-1">'.esc_html__('Boats Location', 'trx_utils').'</option>';
			$i = 1;
			foreach ($list_location as $key => $value) {
				if ( $bs_location == $i ) { $selected="selected"; } else { $selected=""; }
				$output .= '<option '. esc_html($selected).' value="' . esc_html($i) . '">' . esc_html($value) . '</option>';
				$i++;
			}
			$output .= '</select></div>';
		}
		
		
		/* ***** show_crew ***** */
		if ( $show_crew == 1 ) {
			$bs_crew = '';
			if ( isset($_GET['bs_crew']) ) {
				$bs_crew = htmlspecialchars(trim($_GET['bs_crew']));
			}
			$output .= '<div class="bs_box_select"><select class="mb" name="bs_crew">';
			if ( $bs_crew=='-1' ) { $selected="selected"; } else { $selected=""; }
			$output .= '<option '. esc_html($selected).' value="-1">'.esc_html__('# Crew', 'trx_utils').'</option>';
			if ( $bs_crew=='0' ) { $selected="selected"; } else { $selected=""; }
			$output .= '<option '. esc_html($selected).' value="0">'.esc_html__('Without crew', 'trx_utils').'</option>';
			if ( $bs_crew=='1' ) { $selected="selected"; } else { $selected=""; }
			$output .= '<option '. esc_html($selected).' value="1">'.esc_html__('With crew', 'trx_utils').'</option>';
			$output .= '</select></div>';
		}
		
		
		/* ***** show_area ***** */
		/* ***** show_length ***** */
		if ( $show_length == 1 ) {
			$bs_length_big = (int) yacht_rental_get_custom_option('boat_search_length');
			$bs_length_min = 0; $bs_length_max = $bs_length_big;
			if ( isset($_GET['bs_length_min']) ) {
				$bs_length_min = (int) htmlspecialchars(trim($_GET['bs_length_min']));
			}
			if ( isset($_GET['bs_length_max']) ) {
				$bs_length_max = (int) htmlspecialchars(trim($_GET['bs_length_max']));
			}
			$output .= '<div class="bs_length bs_range_slider">';
			$output .= '<div class="bs_length_info">';
			$output .= '<div class="bs_length_info_title">'.esc_html__('Length', 'trx_utils').'</div>';
			$output .= '<div class="bs_length_info_value">'.esc_html__('Any', 'trx_utils').'</div>';
			$output .= '<div class="cL"></div>';
			$output .= '</div>';
			$output .= '<div id="slider-range-area"></div>';
			$output .= '<input type="hidden" class="mb bs_length_min" name="bs_length_min" value="' . esc_html($bs_length_min) . '" >';
			$output .= '<input type="hidden" class="mb bs_length_max" name="bs_length_max" value="' . esc_html($bs_length_max) . '" >';
			$output .= '<input type="hidden" class="mb bs_length_big" name="bs_length_big" value="' . esc_html($bs_length_big) . '" >';
			$output .= '</div>';
		}
		
		
		/* ***** show_price ***** */
		if ( $show_price == 1 ) {
			$bs_price_big = (int) yacht_rental_get_custom_option('boat_search_price_max');
			$bs_price_min = 0; $bs_price_max = $bs_price_big;
			if ( isset($_GET['bs_price_min']) ) {
				$bs_price_min = (int) htmlspecialchars(trim($_GET['bs_price_min']));
			}
			if ( isset($_GET['bs_price_max']) ) {
				$bs_price_max = (int) htmlspecialchars(trim($_GET['bs_price_max']));
			}

			$output .= '<div class="bs_price bs_range_slider">';
			$output .= '<div class="bs_price_info">';
			$output .= '<div class="bs_price_info_title">'.esc_html__('Price', 'trx_utils').'</div>';
			$output .= '<div class="bs_price_info_value">'.esc_html__('Any', 'trx_utils').'</div>';
			$output .= '<div class="cL"></div>';
			$output .= '</div>';
			$output .= '<div id="slider-range-price"></div>';
			$output .= '<input type="hidden" class="mb bs_price_min" name="bs_price_min" value="' . esc_html($bs_price_min) . '" >';
			$output .= '<input type="hidden" class="mb bs_price_max" name="bs_price_max" value="' . esc_html($bs_price_max) . '" >';
			$output .= '<input type="hidden" class="mb bs_price_big" name="bs_price_big" value="' . esc_html($bs_price_big) . '" >';
			$output .= '</div>';
		}
		if ( ( $show_type == 1 ) or ( $show_location == 1 ) or ( $show_crew == 1 ) or ( $show_length == 1 ) or ( $show_price == 1 ) ) {
			$output .= '</div>';
		}
		
		
		if ( $show_amenities == 1 ) {
			$output .= '<div class="bs_box_2">';
		}
		/* ***** show_amenities ***** */
		if ( $show_amenities == 1 ) {
			$bs_amenities = array();
			if ( isset($_GET['bs_amenities']) ) {
				$bs_amenities = $_GET['bs_amenities'];
			}
			$list_amenities = yacht_rental_get_boats_list('boat_amenities_list');
			
			$output .= '<div class="bs_amenities">';
			$output .= '<div class="accent1h">'.esc_html__('Amenities', 'trx_utils').'</div>';
			foreach ($list_amenities as $value1) {
				$checked = ''; $checkedclass = '';
				foreach ($bs_amenities as $key2 => $value2) {
					if ( ($key2 == $value1) and ( $checked == '' ) ) { 
						$checked="checked";
						$checkedclass = ' boatsLabelCheckBoxSelected';
					}
				}
				$output .= '<label class="boatsLabelCheckBox'.esc_attr($checkedclass).'">';
				$output .= '<input '.esc_attr($checked).' class="boatsCheckBox" type="checkbox" name="bs_amenities['.esc_html($value1).']" value="1">';
				$output .= esc_html($value1);
				$output .= '</label>';
				
			}
			$output .= '</div>';
		}
		if ( $show_amenities == 1 ) {
			$output .= '</div>';
		}

		
		
		if ( $show_addon == 1 ) {
			$output .= '<div class="bs_box_3">';
		}
		/* ***** show_addon ***** */
		if ( $show_addon == 1 ) {
			$bs_addon = array();
			if ( isset($_GET['bs_addon']) ) {
				$bs_addon = $_GET['bs_addon'];
			}
			$list_addon = yacht_rental_get_boats_list('boat_addon_list');
			$output .= '<div class="bs_addon">';
			$output .= '<div class="accent1h">'.esc_html__('Specifications', 'trx_utils').'</div>';
			foreach ($list_addon as $value1) {
				$checked = ''; $checkedclass = '';
				foreach ($bs_addon as $key2 => $value2) {
					if ( ($key2 == $value1) and ( $checked == '' ) ) { 
						$checked="checked";
						$checkedclass = ' boatsLabelCheckBoxSelected';
					}
				}
				$output .= '<label class="boatsLabelCheckBox'.esc_attr($checkedclass).'">';
				$output .= '<input '.esc_attr($checked).' class="boatsCheckBox" type="checkbox" name="bs_addon['.esc_html($value1).']" value="1">';
				$output .= esc_html($value1);
				$output .= '</label>';
			}
			$output .= '</div>';
		}
		if ( $show_addon == 1 ) {
			$output .= '</div>';
		}
		
		
		
		
		
		
		/* ***** show_amenities ***** */
//		if ( $show_amenities == 1 ) {
//			$ps_amenities = array();
//			if ( isset($_GET['ps_amenities']) ) {
//				$ps_amenities = $_GET['ps_amenities'];
//			}
//			$list_amenities = yacht_rental_get_boats_list('boats_amenities_list');
//			$output .= '<div class="ps_amenities">';
//			$output .= '<div class="accent1h">'.esc_html__('Amenities', 'trx_utils').'</div>';
//			foreach ($list_amenities as $value1) {
//				$checked = ''; $checkedclass = '';
//				foreach ($ps_amenities as $key2 => $value2) {
//					if ( ($key2 == $value1) and ( $checked == '' ) ) { 
//						$checked="checked";
//						$checkedclass = ' estateLabelCheckBoxSelected';
//					}
//				}
//				$output .= '<label class="estateLabelCheckBox'.esc_attr($checkedclass).'">';
//				$output .= '<input '.esc_attr($checked).' class="estateCheckBox" type="checkbox" name="ps_amenities['.esc_html($value1).']" value="1">';
//				$output .= esc_html($value1);
//				$output .= '</label>';
//				
//			}
//			$output .= '</div>';
//		}
		
		/* ***** show_options ***** */
//		if ( $show_options == 1 ) {
//			$ps_options = array();
//			if ( isset($_GET['ps_options']) ) {
//				$ps_options = $_GET['ps_options'];
//			}
//			$list_options = yacht_rental_get_boats_list('boats_options_list');
//			$output .= '<div class="ps_options">';
//			$output .= '<div class="accent1h">'.esc_html__('Options', 'trx_utils').'</div>';
//			foreach ($list_options as $value1) {
//				$checked = ''; $checkedclass = '';
//				foreach ($ps_options as $key2 => $value2) {
//					if ( ($key2 == $value1) and ( $checked == '' ) ) { 
//						$checked="checked";
//						$checkedclass = ' estateLabelCheckBoxSelected';
//					}
//				}
//				$output .= '<label class="estateLabelCheckBox'.esc_attr($checkedclass).'">';
//				$output .= '<input '.esc_attr($checked).' class="estateCheckBox" type="checkbox" name="ps_options['.esc_html($value1).']" value="1">';
//				$output .= esc_html($value1);
//				$output .= '</label>';
//			}
//			$output .= '</div>';
//		}
		
		
		$output .= '<input type="submit" class="sc_button sc_button_round sc_button_style_filled sc_button_style_color_style_color_2 sc_button_size_large aligncenter bs" value="'.esc_html__('search for boats', 'trx_utils').'">';
		$output .= '</form>';

		if (!empty($output)) {
	
			// Before widget (defined by themes)
			yacht_rental_show_layout($before_widget);
			
			// Display the widget title if one was input (before and after defined by themes)
			if ($title) yacht_rental_show_layout($before_title . $title . $after_title);
	
			yacht_rental_show_layout($output);
			
			// After widget (defined by themes)
			yacht_rental_show_layout($after_widget);
		}
	}
	
	
	// Update the widget settings.
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['show_type'] = isset($new_instance['show_type']) ? 1 : 0;
		$instance['show_location'] = isset($new_instance['show_location']) ? 1 : 0;
		$instance['show_crew'] = isset($new_instance['show_crew']) ? 1 : 0;
		$instance['show_length'] = isset($new_instance['show_length']) ? 1 : 0;
		$instance['show_price'] = isset($new_instance['show_price']) ? 1 : 0;
		$instance['show_amenities'] = isset($new_instance['show_amenities']) ? 1 : 0;
		$instance['show_addon'] = isset($new_instance['show_addon']) ? 1 : 0;
		return $instance;
	}
	
	
	
	// Displays the widget settings controls on the widget panel.
	function form($instance) {

		// Set up some default widget settings
		$instance = wp_parse_args( (array) $instance, array(
			'title' => '',
			'show_type' => '1',
			'show_location' => '1',
			'show_crew' => '1',
			'show_length' => '1',
			'show_price' => '1',
			'show_amenities' => '1',
			'show_addon' => '1',
			)
		);
		$title = $instance['title'];
		$show_type = (int) $instance['show_type'];
		$show_location = (int) $instance['show_location'];
		$show_crew = (int) $instance['show_crew'];
		$show_length = (int) $instance['show_length'];
		$show_price = (int) $instance['show_price'];
		$show_amenities = (int) $instance['show_amenities'];
		$show_addon = (int) $instance['show_addon'];
//		$show_keyword = (int) $instance['show_keyword'];
//		$show_status = (int) $instance['show_status'];
//		$show_style = (int) $instance['show_style'];
//		$show_rooms = (int) $instance['show_rooms'];
//		$show_bedrooms = (int) $instance['show_bedrooms'];
//		$show_bathrooms = (int) $instance['show_bathrooms'];
//		$show_garages = (int) $instance['show_garages'];
//		$show_area = (int) $instance['show_area'];
//		$show_options = (int) $instance['show_options'];
		?>



		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Widget title:', 'trx_utils'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($title); ?>" class="widgets_param_fullwidth" />
		</p>
		
		<p>
			<label>
				<?php if ( $show_type==1 ) { $checked="checked"; } else { $checked=""; } ?>
				<input type="checkbox" name="<?php echo esc_attr($this->get_field_name('show_type')); ?>" <?php echo esc_attr($checked); ?> >
				<?php esc_html_e('Show type field', 'trx_utils'); ?>
			</label>
		</p>
		<p>
			<label>
				<?php if ( $show_location==1 ) { $checked="checked"; } else { $checked=""; } ?>
				<input type="checkbox" name="<?php echo esc_attr($this->get_field_name('show_location')); ?>" <?php echo esc_attr($checked); ?> >
				<?php esc_html_e('Show location field', 'trx_utils'); ?>
			</label>
		</p>
		<p>
			<label>
				<?php if ( $show_crew==1 ) { $checked="checked"; } else { $checked=""; } ?>
				<input type="checkbox" name="<?php echo esc_attr($this->get_field_name('show_crew')); ?>" <?php echo esc_attr($checked); ?> >
				<?php esc_html_e('Show crew field', 'trx_utils'); ?>
			</label>
		</p>
		<p>
			<label>
				<?php if ( $show_length==1 ) { $checked="checked"; } else { $checked=""; } ?>
				<input type="checkbox" name="<?php echo esc_attr($this->get_field_name('show_length')); ?>" <?php echo esc_attr($checked); ?> >
				<?php esc_html_e('Show length field', 'trx_utils'); ?>
			</label>
		</p>
		<p>
			<label>
				<?php if ( $show_price==1 ) { $checked="checked"; } else { $checked=""; } ?>
				<input type="checkbox" name="<?php echo esc_attr($this->get_field_name('show_price')); ?>" <?php echo esc_attr($checked); ?> >
				<?php esc_html_e('Show price field', 'trx_utils'); ?>
			</label>
		</p>
		<p>
			<label>
				<?php if ( $show_amenities==1 ) { $checked="checked"; } else { $checked=""; } ?>
				<input type="checkbox" name="<?php echo esc_attr($this->get_field_name('show_amenities')); ?>" <?php echo esc_attr($checked); ?> >
				<?php esc_html_e('Show amenities field', 'trx_utils'); ?>
			</label>
		</p>
		<p>
			<label>
				<?php if ( $show_addon==1 ) { $checked="checked"; } else { $checked=""; } ?>
				<input type="checkbox" name="<?php echo esc_attr($this->get_field_name('show_addon')); ?>" <?php echo esc_attr($checked); ?> >
				<?php esc_html_e('Show specifications field', 'trx_utils'); ?>
			</label>
		</p>
		
		

	<?php
	}
	
	
	
}
