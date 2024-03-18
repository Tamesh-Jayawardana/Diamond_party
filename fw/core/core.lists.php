<?php
/**
 * Yacht rental Framework: return lists
 *
 * @package yacht_rental
 * @since yacht_rental 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }



// Return styles list
if ( !function_exists( 'yacht_rental_get_list_styles' ) ) {
	function yacht_rental_get_list_styles($from=1, $to=2, $prepend_inherit=false) {
		$list = array();
		for ($i=$from; $i<=$to; $i++)
			$list[$i] = sprintf(esc_html__('Style %d', 'yacht-rental'), $i);
		return $prepend_inherit ? yacht_rental_array_merge(array('inherit' => esc_html__("Inherit", 'yacht-rental')), $list) : $list;
	}
}


// Return list of the shortcodes margins
if ( !function_exists( 'yacht_rental_get_list_margins' ) ) {
	function yacht_rental_get_list_margins($prepend_inherit=false) {
		if (($list = yacht_rental_storage_get('list_margins'))=='') {
			$list = array(
				'null'		=> esc_html__('0 (No margin)',	'yacht-rental'),
				'tiny'		=> esc_html__('Tiny',		'yacht-rental'),
				'small'		=> esc_html__('Small',		'yacht-rental'),
				'medium'	=> esc_html__('Medium',		'yacht-rental'),
				'large'		=> esc_html__('Large',		'yacht-rental'),
				'huge'		=> esc_html__('Huge',		'yacht-rental'),
				'px_10'		=> esc_html__('Px_10',		'yacht-rental'),
				'px_20'		=> esc_html__('Px_20',		'yacht-rental'),
				'px_30'		=> esc_html__('Px_30',		'yacht-rental'),
				'px_40'		=> esc_html__('Px_40',		'yacht-rental'),
				'px_50'		=> esc_html__('Px_50',		'yacht-rental'),
				'px_60'		=> esc_html__('Px_60',		'yacht-rental'),
				'px_70'		=> esc_html__('Px_70',		'yacht-rental'),
				'px_80'		=> esc_html__('Px_80',		'yacht-rental'),
				'px_90'		=> esc_html__('Px_90',		'yacht-rental'),
				'px_100'	=> esc_html__('Px_100',		'yacht-rental'),
				'px_110'	=> esc_html__('Px_110',		'yacht-rental'),
				'px_120'	=> esc_html__('Px_120',		'yacht-rental'),
				'px_130'	=> esc_html__('Px_130',		'yacht-rental'),
				'px_140'	=> esc_html__('Px_140',		'yacht-rental'),
				'px_150'	=> esc_html__('Px_150',		'yacht-rental'),
				);
			$list = apply_filters('yacht_rental_filter_list_margins', $list);
			if (yacht_rental_get_theme_setting('use_list_cache')) yacht_rental_storage_set('list_margins', $list);
		}
		return $prepend_inherit ? yacht_rental_array_merge(array('inherit' => esc_html__("Inherit", 'yacht-rental')), $list) : $list;
	}
}


// Return list of the line styles
if ( !function_exists( 'yacht_rental_get_list_line_styles' ) ) {
	function yacht_rental_get_list_line_styles($prepend_inherit=false) {
		if (($list = yacht_rental_storage_get('list_line_styles'))=='') {
			$list = array(
				'solid'	=> esc_html__('Solid', 'yacht-rental'),
				'dashed'=> esc_html__('Dashed', 'yacht-rental'),
				'dotted'=> esc_html__('Dotted', 'yacht-rental'),
				'double'=> esc_html__('Double', 'yacht-rental'),
				'image'	=> esc_html__('Image', 'yacht-rental')
				);
			$list = apply_filters('yacht_rental_filter_list_line_styles', $list);
			if (yacht_rental_get_theme_setting('use_list_cache')) yacht_rental_storage_set('list_line_styles', $list);
		}
		return $prepend_inherit ? yacht_rental_array_merge(array('inherit' => esc_html__("Inherit", 'yacht-rental')), $list) : $list;
	}
}


// Return list of the animations
if ( !function_exists( 'yacht_rental_get_list_animations' ) ) {
	function yacht_rental_get_list_animations($prepend_inherit=false) {
		if (($list = yacht_rental_storage_get('list_animations'))=='') {
			$list = array(
				'none'			=> esc_html__('- None -',	'yacht-rental'),
				'bounce'		=> esc_html__('Bounce',		'yacht-rental'),
				'elastic'		=> esc_html__('Elastic',	'yacht-rental'),
				'flash'			=> esc_html__('Flash',		'yacht-rental'),
				'flip'			=> esc_html__('Flip',		'yacht-rental'),
				'pulse'			=> esc_html__('Pulse',		'yacht-rental'),
				'rubberBand'	=> esc_html__('Rubber Band','yacht-rental'),
				'shake'			=> esc_html__('Shake',		'yacht-rental'),
				'swing'			=> esc_html__('Swing',		'yacht-rental'),
				'tada'			=> esc_html__('Tada',		'yacht-rental'),
				'wobble'		=> esc_html__('Wobble',		'yacht-rental')
				);
			$list = apply_filters('yacht_rental_filter_list_animations', $list);
			if (yacht_rental_get_theme_setting('use_list_cache')) yacht_rental_storage_set('list_animations', $list);
		}
		return $prepend_inherit ? yacht_rental_array_merge(array('inherit' => esc_html__("Inherit", 'yacht-rental')), $list) : $list;
	}
}


// Return list of the enter animations
if ( !function_exists( 'yacht_rental_get_list_animations_in' ) ) {
	function yacht_rental_get_list_animations_in($prepend_inherit=false) {
		if (($list = yacht_rental_storage_get('list_animations_in'))=='') {
			$list = array(
				'none'				=> esc_html__('- None -',			'yacht-rental'),
				'bounceIn'			=> esc_html__('Bounce In',			'yacht-rental'),
				'bounceInUp'		=> esc_html__('Bounce In Up',		'yacht-rental'),
				'bounceInDown'		=> esc_html__('Bounce In Down',		'yacht-rental'),
				'bounceInLeft'		=> esc_html__('Bounce In Left',		'yacht-rental'),
				'bounceInRight'		=> esc_html__('Bounce In Right',	'yacht-rental'),
				'elastic'			=> esc_html__('Elastic In',			'yacht-rental'),
				'fadeIn'			=> esc_html__('Fade In',			'yacht-rental'),
				'fadeInUp'			=> esc_html__('Fade In Up',			'yacht-rental'),
				'fadeInUpSmall'		=> esc_html__('Fade In Up Small',	'yacht-rental'),
				'fadeInUpBig'		=> esc_html__('Fade In Up Big',		'yacht-rental'),
				'fadeInDown'		=> esc_html__('Fade In Down',		'yacht-rental'),
				'fadeInDownBig'		=> esc_html__('Fade In Down Big',	'yacht-rental'),
				'fadeInLeft'		=> esc_html__('Fade In Left',		'yacht-rental'),
				'fadeInLeftBig'		=> esc_html__('Fade In Left Big',	'yacht-rental'),
				'fadeInRight'		=> esc_html__('Fade In Right',		'yacht-rental'),
				'fadeInRightBig'	=> esc_html__('Fade In Right Big',	'yacht-rental'),
				'flipInX'			=> esc_html__('Flip In X',			'yacht-rental'),
				'flipInY'			=> esc_html__('Flip In Y',			'yacht-rental'),
				'lightSpeedIn'		=> esc_html__('Light Speed In',		'yacht-rental'),
				'rotateIn'			=> esc_html__('Rotate In',			'yacht-rental'),
				'rotateInUpLeft'	=> esc_html__('Rotate In Down Left','yacht-rental'),
				'rotateInUpRight'	=> esc_html__('Rotate In Up Right',	'yacht-rental'),
				'rotateInDownLeft'	=> esc_html__('Rotate In Up Left',	'yacht-rental'),
				'rotateInDownRight'	=> esc_html__('Rotate In Down Right','yacht-rental'),
				'rollIn'			=> esc_html__('Roll In',			'yacht-rental'),
				'slideInUp'			=> esc_html__('Slide In Up',		'yacht-rental'),
				'slideInDown'		=> esc_html__('Slide In Down',		'yacht-rental'),
				'slideInLeft'		=> esc_html__('Slide In Left',		'yacht-rental'),
				'slideInRight'		=> esc_html__('Slide In Right',		'yacht-rental'),
				'wipeInLeftTop'		=> esc_html__('Wipe In Left Top',	'yacht-rental'),
				'zoomIn'			=> esc_html__('Zoom In',			'yacht-rental'),
				'zoomInUp'			=> esc_html__('Zoom In Up',			'yacht-rental'),
				'zoomInDown'		=> esc_html__('Zoom In Down',		'yacht-rental'),
				'zoomInLeft'		=> esc_html__('Zoom In Left',		'yacht-rental'),
				'zoomInRight'		=> esc_html__('Zoom In Right',		'yacht-rental')
				);
			$list = apply_filters('yacht_rental_filter_list_animations_in', $list);
			if (yacht_rental_get_theme_setting('use_list_cache')) yacht_rental_storage_set('list_animations_in', $list);
		}
		return $prepend_inherit ? yacht_rental_array_merge(array('inherit' => esc_html__("Inherit", 'yacht-rental')), $list) : $list;
	}
}


// Return list of the out animations
if ( !function_exists( 'yacht_rental_get_list_animations_out' ) ) {
	function yacht_rental_get_list_animations_out($prepend_inherit=false) {
		if (($list = yacht_rental_storage_get('list_animations_out'))=='') {
			$list = array(
				'none'				=> esc_html__('- None -',			'yacht-rental'),
				'bounceOut'			=> esc_html__('Bounce Out',			'yacht-rental'),
				'bounceOutUp'		=> esc_html__('Bounce Out Up',		'yacht-rental'),
				'bounceOutDown'		=> esc_html__('Bounce Out Down',	'yacht-rental'),
				'bounceOutLeft'		=> esc_html__('Bounce Out Left',	'yacht-rental'),
				'bounceOutRight'	=> esc_html__('Bounce Out Right',	'yacht-rental'),
				'fadeOut'			=> esc_html__('Fade Out',			'yacht-rental'),
				'fadeOutUp'			=> esc_html__('Fade Out Up',		'yacht-rental'),
				'fadeOutUpBig'		=> esc_html__('Fade Out Up Big',	'yacht-rental'),
				'fadeOutDown'		=> esc_html__('Fade Out Down',		'yacht-rental'),
				'fadeOutDownSmall'	=> esc_html__('Fade Out Down Small','yacht-rental'),
				'fadeOutDownBig'	=> esc_html__('Fade Out Down Big',	'yacht-rental'),
				'fadeOutLeft'		=> esc_html__('Fade Out Left',		'yacht-rental'),
				'fadeOutLeftBig'	=> esc_html__('Fade Out Left Big',	'yacht-rental'),
				'fadeOutRight'		=> esc_html__('Fade Out Right',		'yacht-rental'),
				'fadeOutRightBig'	=> esc_html__('Fade Out Right Big',	'yacht-rental'),
				'flipOutX'			=> esc_html__('Flip Out X',			'yacht-rental'),
				'flipOutY'			=> esc_html__('Flip Out Y',			'yacht-rental'),
				'hinge'				=> esc_html__('Hinge Out',			'yacht-rental'),
				'lightSpeedOut'		=> esc_html__('Light Speed Out',	'yacht-rental'),
				'rotateOut'			=> esc_html__('Rotate Out',			'yacht-rental'),
				'rotateOutUpLeft'	=> esc_html__('Rotate Out Down Left','yacht-rental'),
				'rotateOutUpRight'	=> esc_html__('Rotate Out Up Right','yacht-rental'),
				'rotateOutDownLeft'	=> esc_html__('Rotate Out Up Left',	'yacht-rental'),
				'rotateOutDownRight'=> esc_html__('Rotate Out Down Right','yacht-rental'),
				'rollOut'			=> esc_html__('Roll Out',			'yacht-rental'),
				'slideOutUp'		=> esc_html__('Slide Out Up',		'yacht-rental'),
				'slideOutDown'		=> esc_html__('Slide Out Down',		'yacht-rental'),
				'slideOutLeft'		=> esc_html__('Slide Out Left',		'yacht-rental'),
				'slideOutRight'		=> esc_html__('Slide Out Right',	'yacht-rental'),
				'zoomOut'			=> esc_html__('Zoom Out',			'yacht-rental'),
				'zoomOutUp'			=> esc_html__('Zoom Out Up',		'yacht-rental'),
				'zoomOutDown'		=> esc_html__('Zoom Out Down',		'yacht-rental'),
				'zoomOutLeft'		=> esc_html__('Zoom Out Left',		'yacht-rental'),
				'zoomOutRight'		=> esc_html__('Zoom Out Right',		'yacht-rental')
				);
			$list = apply_filters('yacht_rental_filter_list_animations_out', $list);
			if (yacht_rental_get_theme_setting('use_list_cache')) yacht_rental_storage_set('list_animations_out', $list);
		}
		return $prepend_inherit ? yacht_rental_array_merge(array('inherit' => esc_html__("Inherit", 'yacht-rental')), $list) : $list;
	}
}

// Return classes list for the specified animation
if (!function_exists('yacht_rental_get_animation_classes')) {
	function yacht_rental_get_animation_classes($animation, $speed='normal', $loop='none') {
		// speed:	fast=0.5s | normal=1s | slow=2s
		// loop:	none | infinite
		return yacht_rental_param_is_off($animation) ? '' : 'animated '.esc_attr($animation).' '.esc_attr($speed).(!yacht_rental_param_is_off($loop) ? ' '.esc_attr($loop) : '');
	}
}


// Return list of the main menu hover effects
if ( !function_exists( 'yacht_rental_get_list_menu_hovers' ) ) {
	function yacht_rental_get_list_menu_hovers($prepend_inherit=false) {
		if (($list = yacht_rental_storage_get('list_menu_hovers'))=='') {
			$list = array(
				'fade'			=> esc_html__('Fade',		'yacht-rental'),
				'slide_line'	=> esc_html__('Slide Line',	'yacht-rental'),
				'slide_box'		=> esc_html__('Slide Box',	'yacht-rental'),
				'zoom_line'		=> esc_html__('Zoom Line',	'yacht-rental'),
				'path_line'		=> esc_html__('Path Line',	'yacht-rental'),
				'roll_down'		=> esc_html__('Roll Down',	'yacht-rental'),
				'color_line'	=> esc_html__('Color Line',	'yacht-rental'),
				);
			$list = apply_filters('yacht_rental_filter_list_menu_hovers', $list);
			if (yacht_rental_get_theme_setting('use_list_cache')) yacht_rental_storage_set('list_menu_hovers', $list);
		}
		return $prepend_inherit ? yacht_rental_array_merge(array('inherit' => esc_html__("Inherit", 'yacht-rental')), $list) : $list;
	}
}


// Return list of the button's hover effects
if ( !function_exists( 'yacht_rental_get_list_button_hovers' ) ) {
	function yacht_rental_get_list_button_hovers($prepend_inherit=false) {
		if (($list = yacht_rental_storage_get('list_button_hovers'))=='') {
			$list = array(
				'default'		=> esc_html__('Default',			'yacht-rental'),
				'fade'			=> esc_html__('Fade',				'yacht-rental'),
				'slide_left'	=> esc_html__('Slide from Left',	'yacht-rental'),
				'slide_top'		=> esc_html__('Slide from Top',		'yacht-rental'),

				);
			$list = apply_filters('yacht_rental_filter_list_button_hovers', $list);
			if (yacht_rental_get_theme_setting('use_list_cache')) yacht_rental_storage_set('list_button_hovers', $list);
		}
		return $prepend_inherit ? yacht_rental_array_merge(array('inherit' => esc_html__("Inherit", 'yacht-rental')), $list) : $list;
	}
}


// Return list of the input field's hover effects
if ( !function_exists( 'yacht_rental_get_list_input_hovers' ) ) {
	function yacht_rental_get_list_input_hovers($prepend_inherit=false) {
		if (($list = yacht_rental_storage_get('list_input_hovers'))=='') {
			$list = array(
				'default'	=> esc_html__('Default',	'yacht-rental'),
				'accent'	=> esc_html__('Accented',	'yacht-rental'),
				'path'		=> esc_html__('Path',		'yacht-rental'),
				'jump'		=> esc_html__('Jump',		'yacht-rental'),
				'underline'	=> esc_html__('Underline',	'yacht-rental'),
				'iconed'	=> esc_html__('Iconed',		'yacht-rental'),
				);
			$list = apply_filters('yacht_rental_filter_list_input_hovers', $list);
			if (yacht_rental_get_theme_setting('use_list_cache')) yacht_rental_storage_set('list_input_hovers', $list);
		}
		return $prepend_inherit ? yacht_rental_array_merge(array('inherit' => esc_html__("Inherit", 'yacht-rental')), $list) : $list;
	}
}


// Return list of the search field's styles
if ( !function_exists( 'yacht_rental_get_list_search_styles' ) ) {
	function yacht_rental_get_list_search_styles($prepend_inherit=false) {
		if (($list = yacht_rental_storage_get('list_search_styles'))=='') {
			$list = array(
				'default'	=> esc_html__('Default',	'yacht-rental'),
				'fullscreen'=> esc_html__('Fullscreen',	'yacht-rental'),
				'slide'		=> esc_html__('Slide',		'yacht-rental'),
				'expand'	=> esc_html__('Expand',		'yacht-rental'),
				);
			$list = apply_filters('yacht_rental_filter_list_search_styles', $list);
			if (yacht_rental_get_theme_setting('use_list_cache')) yacht_rental_storage_set('list_search_styles', $list);
		}
		return $prepend_inherit ? yacht_rental_array_merge(array('inherit' => esc_html__("Inherit", 'yacht-rental')), $list) : $list;
	}
}


// Return list of categories
if ( !function_exists( 'yacht_rental_get_list_categories' ) ) {
	function yacht_rental_get_list_categories($prepend_inherit=false) {
		if (($list = yacht_rental_storage_get('list_categories'))=='') {
			$list = array();
			$args = array(
				'type'                     => 'post',
				'child_of'                 => 0,
				'parent'                   => '',
				'orderby'                  => 'name',
				'order'                    => 'ASC',
				'hide_empty'               => 0,
				'hierarchical'             => 1,
				'exclude'                  => '',
				'include'                  => '',
				'number'                   => '',
				'taxonomy'                 => 'category',
				'pad_counts'               => false );
			$taxonomies = get_categories( $args );
			if (is_array($taxonomies) && count($taxonomies) > 0) {
				foreach ($taxonomies as $cat) {
					$list[$cat->term_id] = $cat->name;
				}
			}
			if (yacht_rental_get_theme_setting('use_list_cache')) yacht_rental_storage_set('list_categories', $list);
		}
		return $prepend_inherit ? yacht_rental_array_merge(array('inherit' => esc_html__("Inherit", 'yacht-rental')), $list) : $list;
	}
}


// Return list of taxonomies
if ( !function_exists( 'yacht_rental_get_list_terms' ) ) {
	function yacht_rental_get_list_terms($prepend_inherit=false, $taxonomy='category') {
		if (($list = yacht_rental_storage_get('list_taxonomies_'.($taxonomy)))=='') {
			$list = array();
			if ( is_array($taxonomy) || taxonomy_exists($taxonomy) ) {
				$terms = get_terms( $taxonomy, array(
					'child_of'                 => 0,
					'parent'                   => '',
					'orderby'                  => 'name',
					'order'                    => 'ASC',
					'hide_empty'               => 0,
					'hierarchical'             => 1,
					'exclude'                  => '',
					'include'                  => '',
					'number'                   => '',
					'taxonomy'                 => $taxonomy,
					'pad_counts'               => false
					)
				);
			} else {
				$terms = yacht_rental_get_terms_by_taxonomy_from_db($taxonomy);
			}
			if (!is_wp_error( $terms ) && is_array($terms) && count($terms) > 0) {
				foreach ($terms as $cat) {
					$list[$cat->term_id] = $cat->name;	
				}
			}
			if (yacht_rental_get_theme_setting('use_list_cache')) yacht_rental_storage_set('list_taxonomies_'.($taxonomy), $list);
		}
		return $prepend_inherit ? yacht_rental_array_merge(array('inherit' => esc_html__("Inherit", 'yacht-rental')), $list) : $list;
	}
}

// Return list of post's types
if ( !function_exists( 'yacht_rental_get_list_posts_types' ) ) {
	function yacht_rental_get_list_posts_types($prepend_inherit=false) {
		if (($list = yacht_rental_storage_get('list_posts_types'))=='') {
			// Return only theme inheritance supported post types
			$list = apply_filters('yacht_rental_filter_list_post_types', array());
			if (yacht_rental_get_theme_setting('use_list_cache')) yacht_rental_storage_set('list_posts_types', $list);
		}
		return $prepend_inherit ? yacht_rental_array_merge(array('inherit' => esc_html__("Inherit", 'yacht-rental')), $list) : $list;
	}
}


// Return list post items from any post type and taxonomy
if ( !function_exists( 'yacht_rental_get_list_posts' ) ) {
	function yacht_rental_get_list_posts($prepend_inherit=false, $opt=array()) {
		$opt = array_merge(array(
			'post_type'			=> 'post',
			'post_status'		=> 'publish',
			'taxonomy'			=> 'category',
			'taxonomy_value'	=> '',
			'posts_per_page'	=> -1,
			'orderby'			=> 'post_date',
			'order'				=> 'desc',
			'return'			=> 'id'
			), is_array($opt) ? $opt : array('post_type'=>$opt));

		$hash = 'list_posts_'.($opt['post_type']).'_'.($opt['taxonomy']).'_'.($opt['taxonomy_value']).'_'.($opt['orderby']).'_'.($opt['order']).'_'.($opt['return']).'_'.($opt['posts_per_page']);
		if (($list = yacht_rental_storage_get($hash))=='') {
			$list = array();
			$list['none'] = esc_html__("- Not selected -", 'yacht-rental');
			$args = array(
				'post_type' => $opt['post_type'],
				'post_status' => $opt['post_status'],
				'posts_per_page' => $opt['posts_per_page'],
				'ignore_sticky_posts' => true,
				'orderby'	=> $opt['orderby'],
				'order'		=> $opt['order']
			);
			if (!empty($opt['taxonomy_value'])) {
				$args['tax_query'] = array(
					array(
						'taxonomy' => $opt['taxonomy'],
						'field' => (int) $opt['taxonomy_value'] > 0 ? 'id' : 'slug',
						'terms' => $opt['taxonomy_value']
					)
				);
			}
			$posts = get_posts( $args );
			if (is_array($posts) && count($posts) > 0) {
				foreach ($posts as $post) {
					$list[$opt['return']=='id' ? $post->ID : $post->post_title] = $post->post_title;
				}
			}
			if (yacht_rental_get_theme_setting('use_list_cache')) yacht_rental_storage_set($hash, $list);
		}
		return $prepend_inherit ? yacht_rental_array_merge(array('inherit' => esc_html__("Inherit", 'yacht-rental')), $list) : $list;
	}
}


// Return list pages
if ( !function_exists( 'yacht_rental_get_list_pages' ) ) {
	function yacht_rental_get_list_pages($prepend_inherit=false, $opt=array()) {
		$opt = array_merge(array(
			'post_type'			=> 'page',
			'post_status'		=> 'publish',
			'posts_per_page'	=> -1,
			'orderby'			=> 'title',
			'order'				=> 'asc',
			'return'			=> 'id'
			), is_array($opt) ? $opt : array('post_type'=>$opt));
		return yacht_rental_get_list_posts($prepend_inherit, $opt);
	}
}


// Return list of registered users
if ( !function_exists( 'yacht_rental_get_list_users' ) ) {
	function yacht_rental_get_list_users($prepend_inherit=false, $roles=array('administrator', 'editor', 'author', 'contributor', 'shop_manager')) {
		if (($list = yacht_rental_storage_get('list_users'))=='') {
			$list = array();
			$list['none'] = esc_html__("- Not selected -", 'yacht-rental');
			$args = array(
				'orderby'	=> 'display_name',
				'order'		=> 'ASC' );
			$users = get_users( $args );
			if (is_array($users) && count($users) > 0) {
				foreach ($users as $user) {
					$accept = true;
					if (is_array($user->roles)) {
						if (is_array($user->roles) && count($user->roles) > 0) {
							$accept = false;
							foreach ($user->roles as $role) {
								if (in_array($role, $roles)) {
									$accept = true;
									break;
								}
							}
						}
					}
					if ($accept) $list[$user->user_login] = $user->display_name;
				}
			}
			if (yacht_rental_get_theme_setting('use_list_cache')) yacht_rental_storage_set('list_users', $list);
		}
		return $prepend_inherit ? yacht_rental_array_merge(array('inherit' => esc_html__("Inherit", 'yacht-rental')), $list) : $list;
	}
}


// Return slider engines list, prepended inherit (if need)
if ( !function_exists( 'yacht_rental_get_list_sliders' ) ) {
	function yacht_rental_get_list_sliders($prepend_inherit=false) {
		if (($list = yacht_rental_storage_get('list_sliders'))=='') {
			$list = array(
				'swiper' => esc_html__("Posts slider (Swiper)", 'yacht-rental')
			);
			$list = apply_filters('yacht_rental_filter_list_sliders', $list);
			if (yacht_rental_get_theme_setting('use_list_cache')) yacht_rental_storage_set('list_sliders', $list);
		}
		return $prepend_inherit ? yacht_rental_array_merge(array('inherit' => esc_html__("Inherit", 'yacht-rental')), $list) : $list;
	}
}


// Return slider controls list, prepended inherit (if need)
if ( !function_exists( 'yacht_rental_get_list_slider_controls' ) ) {
	function yacht_rental_get_list_slider_controls($prepend_inherit=false) {
		if (($list = yacht_rental_storage_get('list_slider_controls'))=='') {
			$list = array(
				'no'		=> esc_html__('None', 'yacht-rental'),
				'side'		=> esc_html__('Side', 'yacht-rental'),
				'bottom'	=> esc_html__('Bottom', 'yacht-rental'),
				'pagination'=> esc_html__('Pagination', 'yacht-rental')
				);
			$list = apply_filters('yacht_rental_filter_list_slider_controls', $list);
			if (yacht_rental_get_theme_setting('use_list_cache')) yacht_rental_storage_set('list_slider_controls', $list);
		}
		return $prepend_inherit ? yacht_rental_array_merge(array('inherit' => esc_html__("Inherit", 'yacht-rental')), $list) : $list;
	}
}


// Return slider controls classes
if ( !function_exists( 'yacht_rental_get_slider_controls_classes' ) ) {
	function yacht_rental_get_slider_controls_classes($controls) {
		if (yacht_rental_param_is_off($controls))	$classes = 'sc_slider_nopagination sc_slider_nocontrols';
		else if ($controls=='bottom')			$classes = 'sc_slider_nopagination sc_slider_controls sc_slider_controls_bottom';
		else if ($controls=='pagination')		$classes = 'sc_slider_pagination sc_slider_pagination_bottom sc_slider_nocontrols';
		else									$classes = 'sc_slider_nopagination sc_slider_controls sc_slider_controls_side';
		return $classes;
	}
}

// Return list with popup engines
if ( !function_exists( 'yacht_rental_get_list_popup_engines' ) ) {
	function yacht_rental_get_list_popup_engines($prepend_inherit=false) {
		if (($list = yacht_rental_storage_get('list_popup_engines'))=='') {
			$list = array(
				"pretty"	=> esc_html__("Pretty photo", 'yacht-rental'),
				"magnific"	=> esc_html__("Magnific popup", 'yacht-rental')
				);
			$list = apply_filters('yacht_rental_filter_list_popup_engines', $list);
			if (yacht_rental_get_theme_setting('use_list_cache')) yacht_rental_storage_set('list_popup_engines', $list);
		}
		return $prepend_inherit ? yacht_rental_array_merge(array('inherit' => esc_html__("Inherit", 'yacht-rental')), $list) : $list;
	}
}

// Return menus list, prepended inherit
if ( !function_exists( 'yacht_rental_get_list_menus' ) ) {
	function yacht_rental_get_list_menus($prepend_inherit=false) {
		if (($list = yacht_rental_storage_get('list_menus'))=='') {
			$list = array();
			$list['default'] = esc_html__("Default", 'yacht-rental');
			$menus = wp_get_nav_menus();
			if (is_array($menus) && count($menus) > 0) {
				foreach ($menus as $menu) {
					$list[$menu->slug] = $menu->name;
				}
			}
			if (yacht_rental_get_theme_setting('use_list_cache')) yacht_rental_storage_set('list_menus', $list);
		}
		return $prepend_inherit ? yacht_rental_array_merge(array('inherit' => esc_html__("Inherit", 'yacht-rental')), $list) : $list;
	}
}

// Return custom sidebars list, prepended inherit and main sidebars item (if need)
if ( !function_exists( 'yacht_rental_get_list_sidebars' ) ) {
	function yacht_rental_get_list_sidebars($prepend_inherit=false) {
		if (($list = yacht_rental_storage_get('list_sidebars'))=='') {
			if (($list = yacht_rental_storage_get('registered_sidebars'))=='') $list = array();
			if (yacht_rental_get_theme_setting('use_list_cache')) yacht_rental_storage_set('list_sidebars', $list);
		}
		return $prepend_inherit ? yacht_rental_array_merge(array('inherit' => esc_html__("Inherit", 'yacht-rental')), $list) : $list;
	}
}

// Return sidebars positions
if ( !function_exists( 'yacht_rental_get_list_sidebars_positions' ) ) {
	function yacht_rental_get_list_sidebars_positions($prepend_inherit=false) {
		if (($list = yacht_rental_storage_get('list_sidebars_positions'))=='') {
			$list = array(
				'none'  => esc_html__('Hide',  'yacht-rental'),
				'left'  => esc_html__('Left',  'yacht-rental'),
				'right' => esc_html__('Right', 'yacht-rental')
				);
			if (yacht_rental_get_theme_setting('use_list_cache')) yacht_rental_storage_set('list_sidebars_positions', $list);
		}
		return $prepend_inherit ? yacht_rental_array_merge(array('inherit' => esc_html__("Inherit", 'yacht-rental')), $list) : $list;
	}
}

// Return sidebars class
if ( !function_exists( 'yacht_rental_get_sidebar_class' ) ) {
	function yacht_rental_get_sidebar_class() {
		$sb_main = yacht_rental_get_custom_option('show_sidebar_main');
		$sb_outer = yacht_rental_get_custom_option('show_sidebar_outer');
		return (yacht_rental_param_is_off($sb_main) ? 'sidebar_hide' : 'sidebar_show sidebar_'.($sb_main))
				. ' ' . (yacht_rental_param_is_off($sb_outer) ? 'sidebar_outer_hide' : 'sidebar_outer_show sidebar_outer_'.($sb_outer));
	}
}

// Return body styles list, prepended inherit
if ( !function_exists( 'yacht_rental_get_list_body_styles' ) ) {
	function yacht_rental_get_list_body_styles($prepend_inherit=false) {
		if (($list = yacht_rental_storage_get('list_body_styles'))=='') {
			$list = array(
				'boxed'	=> esc_html__('Boxed',		'yacht-rental'),
				'wide'	=> esc_html__('Wide',		'yacht-rental')
				);
			if (yacht_rental_get_theme_setting('allow_fullscreen')) {
				$list['fullwide']	= esc_html__('Fullwide',	'yacht-rental');
				$list['fullscreen']	= esc_html__('Fullscreen',	'yacht-rental');
			}
			$list = apply_filters('yacht_rental_filter_list_body_styles', $list);
			if (yacht_rental_get_theme_setting('use_list_cache')) yacht_rental_storage_set('list_body_styles', $list);
		}
		return $prepend_inherit ? yacht_rental_array_merge(array('inherit' => esc_html__("Inherit", 'yacht-rental')), $list) : $list;
	}
}

// Return css-themes list
if ( !function_exists( 'yacht_rental_get_list_themes' ) ) {
	function yacht_rental_get_list_themes($prepend_inherit=false) {
		if (($list = yacht_rental_storage_get('list_themes'))=='') {
			$list = yacht_rental_get_list_files("css/themes");
			if (yacht_rental_get_theme_setting('use_list_cache')) yacht_rental_storage_set('list_themes', $list);
		}
		return $prepend_inherit ? yacht_rental_array_merge(array('inherit' => esc_html__("Inherit", 'yacht-rental')), $list) : $list;
	}
}

// Return templates list, prepended inherit
if ( !function_exists( 'yacht_rental_get_list_templates' ) ) {
	function yacht_rental_get_list_templates($mode='') {
		if (($list = yacht_rental_storage_get('list_templates_'.($mode)))=='') {
			$list = array();
			$tpl = yacht_rental_storage_get('registered_templates');
			if (is_array($tpl) && count($tpl) > 0) {
				foreach ($tpl as $k=>$v) {
					if ($mode=='' || in_array($mode, explode(',', $v['mode'])))
						$list[$k] = !empty($v['icon']) 
									? $v['icon'] 
									: (!empty($v['title']) 
										? $v['title'] 
										: yacht_rental_strtoproper($v['layout'])
										);
				}
			}
			if (yacht_rental_get_theme_setting('use_list_cache')) yacht_rental_storage_set('list_templates_'.($mode), $list);
		}
		return $list;
	}
}

// Return blog styles list, prepended inherit
if ( !function_exists( 'yacht_rental_get_list_templates_blog' ) ) {
	function yacht_rental_get_list_templates_blog($prepend_inherit=false) {
		if (($list = yacht_rental_storage_get('list_templates_blog'))=='') {
			$list = yacht_rental_get_list_templates('blog');
			if (yacht_rental_get_theme_setting('use_list_cache')) yacht_rental_storage_set('list_templates_blog', $list);
		}
		return $prepend_inherit ? yacht_rental_array_merge(array('inherit' => esc_html__("Inherit", 'yacht-rental')), $list) : $list;
	}
}

// Return blogger styles list, prepended inherit
if ( !function_exists( 'yacht_rental_get_list_templates_blogger' ) ) {
	function yacht_rental_get_list_templates_blogger($prepend_inherit=false) {
		if (($list = yacht_rental_storage_get('list_templates_blogger'))=='') {
			$list = yacht_rental_array_merge(yacht_rental_get_list_templates('blogger'), yacht_rental_get_list_templates('blog'));
			if (yacht_rental_get_theme_setting('use_list_cache')) yacht_rental_storage_set('list_templates_blogger', $list);
		}
		return $prepend_inherit ? yacht_rental_array_merge(array('inherit' => esc_html__("Inherit", 'yacht-rental')), $list) : $list;
	}
}

// Return single page styles list, prepended inherit
if ( !function_exists( 'yacht_rental_get_list_templates_single' ) ) {
	function yacht_rental_get_list_templates_single($prepend_inherit=false) {
		if (($list = yacht_rental_storage_get('list_templates_single'))=='') {
			$list = yacht_rental_get_list_templates('single');
			if (yacht_rental_get_theme_setting('use_list_cache')) yacht_rental_storage_set('list_templates_single', $list);
		}
		return $prepend_inherit ? yacht_rental_array_merge(array('inherit' => esc_html__("Inherit", 'yacht-rental')), $list) : $list;
	}
}

// Return header styles list, prepended inherit
if ( !function_exists( 'yacht_rental_get_list_templates_header' ) ) {
	function yacht_rental_get_list_templates_header($prepend_inherit=false) {
		if (($list = yacht_rental_storage_get('list_templates_header'))=='') {
			$list = yacht_rental_get_list_templates('header');
			if (yacht_rental_get_theme_setting('use_list_cache')) yacht_rental_storage_set('list_templates_header', $list);
		}
		return $prepend_inherit ? yacht_rental_array_merge(array('inherit' => esc_html__("Inherit", 'yacht-rental')), $list) : $list;
	}
}

// Return form styles list, prepended inherit
if ( !function_exists( 'yacht_rental_get_list_templates_forms' ) ) {
	function yacht_rental_get_list_templates_forms($prepend_inherit=false) {
		if (($list = yacht_rental_storage_get('list_templates_forms'))=='') {
			$list = yacht_rental_get_list_templates('forms');
			if (yacht_rental_get_theme_setting('use_list_cache')) yacht_rental_storage_set('list_templates_forms', $list);
		}
		return $prepend_inherit ? yacht_rental_array_merge(array('inherit' => esc_html__("Inherit", 'yacht-rental')), $list) : $list;
	}
}

// Return article styles list, prepended inherit
if ( !function_exists( 'yacht_rental_get_list_article_styles' ) ) {
	function yacht_rental_get_list_article_styles($prepend_inherit=false) {
		if (($list = yacht_rental_storage_get('list_article_styles'))=='') {
			$list = array(
				"boxed"   => esc_html__('Boxed', 'yacht-rental'),
				"stretch" => esc_html__('Stretch', 'yacht-rental')
				);
			if (yacht_rental_get_theme_setting('use_list_cache')) yacht_rental_storage_set('list_article_styles', $list);
		}
		return $prepend_inherit ? yacht_rental_array_merge(array('inherit' => esc_html__("Inherit", 'yacht-rental')), $list) : $list;
	}
}

// Return post-formats filters list, prepended inherit
if ( !function_exists( 'yacht_rental_get_list_post_formats_filters' ) ) {
	function yacht_rental_get_list_post_formats_filters($prepend_inherit=false) {
		if (($list = yacht_rental_storage_get('list_post_formats_filters'))=='') {
			$list = array(
				"no"      => esc_html__('All posts', 'yacht-rental'),
				"thumbs"  => esc_html__('With thumbs', 'yacht-rental'),
				"reviews" => esc_html__('With reviews', 'yacht-rental'),
				"video"   => esc_html__('With videos', 'yacht-rental'),
				"audio"   => esc_html__('With audios', 'yacht-rental'),
				"gallery" => esc_html__('With galleries', 'yacht-rental')
				);
			if (yacht_rental_get_theme_setting('use_list_cache')) yacht_rental_storage_set('list_post_formats_filters', $list);
		}
		return $prepend_inherit ? yacht_rental_array_merge(array('inherit' => esc_html__("Inherit", 'yacht-rental')), $list) : $list;
	}
}

// Return portfolio filters list, prepended inherit
if ( !function_exists( 'yacht_rental_get_list_portfolio_filters' ) ) {
	function yacht_rental_get_list_portfolio_filters($prepend_inherit=false) {
		if (($list = yacht_rental_storage_get('list_portfolio_filters'))=='') {
			$list = array(
				"hide"		=> esc_html__('Hide', 'yacht-rental'),
				"tags"		=> esc_html__('Tags', 'yacht-rental'),
				"categories"=> esc_html__('Categories', 'yacht-rental')
				);
			if (yacht_rental_get_theme_setting('use_list_cache')) yacht_rental_storage_set('list_portfolio_filters', $list);
		}
		return $prepend_inherit ? yacht_rental_array_merge(array('inherit' => esc_html__("Inherit", 'yacht-rental')), $list) : $list;
	}
}

// Return hover styles list, prepended inherit
if ( !function_exists( 'yacht_rental_get_list_hovers' ) ) {
	function yacht_rental_get_list_hovers($prepend_inherit=false) {
		if (($list = yacht_rental_storage_get('list_hovers'))=='') {
			$list = array();
			$list['square effect_dir']   = esc_html__('Square Effect Dir',   'yacht-rental');
			$list['square effect_shift'] = esc_html__('Square Effect Shift', 'yacht-rental');
			$list['square effect_book']  = esc_html__('Square Effect Book',  'yacht-rental');
			$list['square effect_more']  = esc_html__('Square Effect More',  'yacht-rental');
			$list['square effect_fade']  = esc_html__('Square Effect Fade',  'yacht-rental');
			$list['square effect_pull']  = esc_html__('Square Effect Pull',  'yacht-rental');
			$list['square effect_slide'] = esc_html__('Square Effect Slide', 'yacht-rental');
			$list['square effect_border'] = esc_html__('Square Effect Border', 'yacht-rental');
			$list = apply_filters('yacht_rental_filter_portfolio_hovers', $list);
			if (yacht_rental_get_theme_setting('use_list_cache')) yacht_rental_storage_set('list_hovers', $list);
		}
		return $prepend_inherit ? yacht_rental_array_merge(array('inherit' => esc_html__("Inherit", 'yacht-rental')), $list) : $list;
	}
}


// Return list of the blog counters
if ( !function_exists( 'yacht_rental_get_list_blog_counters' ) ) {
	function yacht_rental_get_list_blog_counters($prepend_inherit=false) {
		if (($list = yacht_rental_storage_get('list_blog_counters'))=='') {
			$list = array(
				'views'		=> esc_html__('Views', 'yacht-rental'),
				'likes'		=> esc_html__('Likes', 'yacht-rental'),
				'comments'	=> esc_html__('Comments', 'yacht-rental')
				);
			$list = apply_filters('yacht_rental_filter_list_blog_counters', $list);
			if (yacht_rental_get_theme_setting('use_list_cache')) yacht_rental_storage_set('list_blog_counters', $list);
		}
		return $prepend_inherit ? yacht_rental_array_merge(array('inherit' => esc_html__("Inherit", 'yacht-rental')), $list) : $list;
	}
}

// Return list of the item sizes for the portfolio alter style, prepended inherit
if ( !function_exists( 'yacht_rental_get_list_alter_sizes' ) ) {
	function yacht_rental_get_list_alter_sizes($prepend_inherit=false) {
		if (($list = yacht_rental_storage_get('list_alter_sizes'))=='') {
			$list = array(
					'1_1' => esc_html__('1x1', 'yacht-rental'),
					'1_2' => esc_html__('1x2', 'yacht-rental'),
					'2_1' => esc_html__('2x1', 'yacht-rental'),
					'2_2' => esc_html__('2x2', 'yacht-rental'),
					'1_3' => esc_html__('1x3', 'yacht-rental'),
					'2_3' => esc_html__('2x3', 'yacht-rental'),
					'3_1' => esc_html__('3x1', 'yacht-rental'),
					'3_2' => esc_html__('3x2', 'yacht-rental'),
					'3_3' => esc_html__('3x3', 'yacht-rental')
					);
			$list = apply_filters('yacht_rental_filter_portfolio_alter_sizes', $list);
			if (yacht_rental_get_theme_setting('use_list_cache')) yacht_rental_storage_set('list_alter_sizes', $list);
		}
		return $prepend_inherit ? yacht_rental_array_merge(array('inherit' => esc_html__("Inherit", 'yacht-rental')), $list) : $list;
	}
}

// Return extended hover directions list, prepended inherit
if ( !function_exists( 'yacht_rental_get_list_hovers_directions' ) ) {
	function yacht_rental_get_list_hovers_directions($prepend_inherit=false) {
		if (($list = yacht_rental_storage_get('list_hovers_directions'))=='') {
			$list = array(
				'left_to_right' => esc_html__('Left to Right',  'yacht-rental'),
				'right_to_left' => esc_html__('Right to Left',  'yacht-rental'),
				'top_to_bottom' => esc_html__('Top to Bottom',  'yacht-rental'),
				'bottom_to_top' => esc_html__('Bottom to Top',  'yacht-rental'),
				'scale_up'      => esc_html__('Scale Up',  'yacht-rental'),
				'scale_down'    => esc_html__('Scale Down',  'yacht-rental'),
				'scale_down_up' => esc_html__('Scale Down-Up',  'yacht-rental'),
				'from_left_and_right' => esc_html__('From Left and Right',  'yacht-rental'),
				'from_top_and_bottom' => esc_html__('From Top and Bottom',  'yacht-rental')
			);
			$list = apply_filters('yacht_rental_filter_portfolio_hovers_directions', $list);
			if (yacht_rental_get_theme_setting('use_list_cache')) yacht_rental_storage_set('list_hovers_directions', $list);
		}
		return $prepend_inherit ? yacht_rental_array_merge(array('inherit' => esc_html__("Inherit", 'yacht-rental')), $list) : $list;
	}
}


// Return list of the label positions in the custom forms
if ( !function_exists( 'yacht_rental_get_list_label_positions' ) ) {
	function yacht_rental_get_list_label_positions($prepend_inherit=false) {
		if (($list = yacht_rental_storage_get('list_label_positions'))=='') {
			$list = array(
				'top'		=> esc_html__('Top',		'yacht-rental'),
				'bottom'	=> esc_html__('Bottom',		'yacht-rental'),
				'left'		=> esc_html__('Left',		'yacht-rental'),
				'over'		=> esc_html__('Over',		'yacht-rental')
			);
			$list = apply_filters('yacht_rental_filter_label_positions', $list);
			if (yacht_rental_get_theme_setting('use_list_cache')) yacht_rental_storage_set('list_label_positions', $list);
		}
		return $prepend_inherit ? yacht_rental_array_merge(array('inherit' => esc_html__("Inherit", 'yacht-rental')), $list) : $list;
	}
}


// Return list of the bg image positions
if ( !function_exists( 'yacht_rental_get_list_bg_image_positions' ) ) {
	function yacht_rental_get_list_bg_image_positions($prepend_inherit=false) {
		if (($list = yacht_rental_storage_get('list_bg_image_positions'))=='') {
			$list = array(
				'left top'	   => esc_html__('Left Top', 'yacht-rental'),
				'center top'   => esc_html__("Center Top", 'yacht-rental'),
				'right top'    => esc_html__("Right Top", 'yacht-rental'),
				'left center'  => esc_html__("Left Center", 'yacht-rental'),
				'center center'=> esc_html__("Center Center", 'yacht-rental'),
				'right center' => esc_html__("Right Center", 'yacht-rental'),
				'left bottom'  => esc_html__("Left Bottom", 'yacht-rental'),
				'center bottom'=> esc_html__("Center Bottom", 'yacht-rental'),
				'right bottom' => esc_html__("Right Bottom", 'yacht-rental')
			);
			if (yacht_rental_get_theme_setting('use_list_cache')) yacht_rental_storage_set('list_bg_image_positions', $list);
		}
		return $prepend_inherit ? yacht_rental_array_merge(array('inherit' => esc_html__("Inherit", 'yacht-rental')), $list) : $list;
	}
}


// Return list of the bg image repeat
if ( !function_exists( 'yacht_rental_get_list_bg_image_repeats' ) ) {
	function yacht_rental_get_list_bg_image_repeats($prepend_inherit=false) {
		if (($list = yacht_rental_storage_get('list_bg_image_repeats'))=='') {
			$list = array(
				'repeat'	=> esc_html__('Repeat', 'yacht-rental'),
				'repeat-x'	=> esc_html__('Repeat X', 'yacht-rental'),
				'repeat-y'	=> esc_html__('Repeat Y', 'yacht-rental'),
				'no-repeat'	=> esc_html__('No Repeat', 'yacht-rental')
			);
			if (yacht_rental_get_theme_setting('use_list_cache')) yacht_rental_storage_set('list_bg_image_repeats', $list);
		}
		return $prepend_inherit ? yacht_rental_array_merge(array('inherit' => esc_html__("Inherit", 'yacht-rental')), $list) : $list;
	}
}


// Return list of the bg image attachment
if ( !function_exists( 'yacht_rental_get_list_bg_image_attachments' ) ) {
	function yacht_rental_get_list_bg_image_attachments($prepend_inherit=false) {
		if (($list = yacht_rental_storage_get('list_bg_image_attachments'))=='') {
			$list = array(
				'scroll'	=> esc_html__('Scroll', 'yacht-rental'),
				'fixed'		=> esc_html__('Fixed', 'yacht-rental'),
				'local'		=> esc_html__('Local', 'yacht-rental')
			);
			if (yacht_rental_get_theme_setting('use_list_cache')) yacht_rental_storage_set('list_bg_image_attachments', $list);
		}
		return $prepend_inherit ? yacht_rental_array_merge(array('inherit' => esc_html__("Inherit", 'yacht-rental')), $list) : $list;
	}
}


// Return list of the bg tints
if ( !function_exists( 'yacht_rental_get_list_bg_tints' ) ) {
	function yacht_rental_get_list_bg_tints($prepend_inherit=false) {
		if (($list = yacht_rental_storage_get('list_bg_tints'))=='') {
			$list = array(
				'white'	=> esc_html__('White', 'yacht-rental'),
				'light'	=> esc_html__('Light', 'yacht-rental'),
				'dark'	=> esc_html__('Dark', 'yacht-rental')
			);
			$list = apply_filters('yacht_rental_filter_bg_tints', $list);
			if (yacht_rental_get_theme_setting('use_list_cache')) yacht_rental_storage_set('list_bg_tints', $list);
		}
		return $prepend_inherit ? yacht_rental_array_merge(array('inherit' => esc_html__("Inherit", 'yacht-rental')), $list) : $list;
	}
}

// Return custom fields types list, prepended inherit
if ( !function_exists( 'yacht_rental_get_list_field_types' ) ) {
	function yacht_rental_get_list_field_types($prepend_inherit=false) {
		if (($list = yacht_rental_storage_get('list_field_types'))=='') {
			$list = array(
				'text'     => esc_html__('Text',  'yacht-rental'),
				'textarea' => esc_html__('Text Area','yacht-rental'),
				'password' => esc_html__('Password',  'yacht-rental'),
				'radio'    => esc_html__('Radio',  'yacht-rental'),
				'checkbox' => esc_html__('Checkbox',  'yacht-rental'),
				'select'   => esc_html__('Select',  'yacht-rental'),
				'date'     => esc_html__('Date','yacht-rental'),
				'time'     => esc_html__('Time','yacht-rental'),
				'button'   => esc_html__('Button','yacht-rental')
			);
			$list = apply_filters('yacht_rental_filter_field_types', $list);
			if (yacht_rental_get_theme_setting('use_list_cache')) yacht_rental_storage_set('list_field_types', $list);
		}
		return $prepend_inherit ? yacht_rental_array_merge(array('inherit' => esc_html__("Inherit", 'yacht-rental')), $list) : $list;
	}
}

// Return Google map styles
if ( !function_exists( 'yacht_rental_get_list_googlemap_styles' ) ) {
	function yacht_rental_get_list_googlemap_styles($prepend_inherit=false) {
		if (($list = yacht_rental_storage_get('list_googlemap_styles'))=='') {
			$list = array(
				'default' => esc_html__('Default', 'yacht-rental')
			);
			$list = apply_filters('yacht_rental_filter_googlemap_styles', $list);
			if (yacht_rental_get_theme_setting('use_list_cache')) yacht_rental_storage_set('list_googlemap_styles', $list);
		}
		return $prepend_inherit ? yacht_rental_array_merge(array('inherit' => esc_html__("Inherit", 'yacht-rental')), $list) : $list;
	}
}

// Return iconed classes list
if ( !function_exists( 'yacht_rental_get_list_icons' ) ) {
	function yacht_rental_get_list_icons($prepend_inherit=false) {
		if (($list = yacht_rental_storage_get('list_icons'))=='') {
			$list = yacht_rental_parse_icons_classes(yacht_rental_get_file_dir("css/fontello/css/fontello-codes.css"));
			if (yacht_rental_get_theme_setting('use_list_cache')) yacht_rental_storage_set('list_icons', $list);
		}
		return $prepend_inherit ? array_merge(array('inherit'), $list) : $list;
	}
}

// Return socials list
if ( !function_exists( 'yacht_rental_get_list_socials' ) ) {
	function yacht_rental_get_list_socials($prepend_inherit=false) {
		if (($list = yacht_rental_storage_get('list_socials'))=='') {
			$list = yacht_rental_get_list_images(YACHT_RENTAL_FW_DIR."/images/socials", "png");
			if (yacht_rental_get_theme_setting('use_list_cache')) yacht_rental_storage_set('list_socials', $list);
		}
		return $prepend_inherit ? yacht_rental_array_merge(array('inherit' => esc_html__("Inherit", 'yacht-rental')), $list) : $list;
	}
}

// Return flags list
if ( !function_exists( 'yacht_rental_get_list_flags' ) ) {
	function yacht_rental_get_list_flags($prepend_inherit=false) {
		if (($list = yacht_rental_storage_get('list_flags'))=='') {
			$list = yacht_rental_get_list_files("images/flags", "png");
			if (yacht_rental_get_theme_setting('use_list_cache')) yacht_rental_storage_set('list_flags', $list);
		}
		return $prepend_inherit ? yacht_rental_array_merge(array('inherit' => esc_html__("Inherit", 'yacht-rental')), $list) : $list;
	}
}

// Return list with 'Yes' and 'No' items
if ( !function_exists( 'yacht_rental_get_list_yesno' ) ) {
	function yacht_rental_get_list_yesno($prepend_inherit=false) {
		$list = array(
			'yes' => esc_html__("Yes", 'yacht-rental'),
			'no'  => esc_html__("No", 'yacht-rental')
		);
		return $prepend_inherit ? yacht_rental_array_merge(array('inherit' => esc_html__("Inherit", 'yacht-rental')), $list) : $list;
	}
}

// Return list with 'On' and 'Of' items
if ( !function_exists( 'yacht_rental_get_list_onoff' ) ) {
	function yacht_rental_get_list_onoff($prepend_inherit=false) {
		$list = array(
			"on" => esc_html__("On", 'yacht-rental'),
			"off" => esc_html__("Off", 'yacht-rental')
		);
		return $prepend_inherit ? yacht_rental_array_merge(array('inherit' => esc_html__("Inherit", 'yacht-rental')), $list) : $list;
	}
}

// Return list with 'Show' and 'Hide' items
if ( !function_exists( 'yacht_rental_get_list_showhide' ) ) {
	function yacht_rental_get_list_showhide($prepend_inherit=false) {
		$list = array(
			"show" => esc_html__("Show", 'yacht-rental'),
			"hide" => esc_html__("Hide", 'yacht-rental')
		);
		return $prepend_inherit ? yacht_rental_array_merge(array('inherit' => esc_html__("Inherit", 'yacht-rental')), $list) : $list;
	}
}

// Return list with 'Ascending' and 'Descending' items
if ( !function_exists( 'yacht_rental_get_list_orderings' ) ) {
	function yacht_rental_get_list_orderings($prepend_inherit=false) {
		$list = array(
			"asc" => esc_html__("Ascending", 'yacht-rental'),
			"desc" => esc_html__("Descending", 'yacht-rental')
		);
		return $prepend_inherit ? yacht_rental_array_merge(array('inherit' => esc_html__("Inherit", 'yacht-rental')), $list) : $list;
	}
}

// Return list with 'Horizontal' and 'Vertical' items
if ( !function_exists( 'yacht_rental_get_list_directions' ) ) {
	function yacht_rental_get_list_directions($prepend_inherit=false) {
		$list = array(
			"horizontal" => esc_html__("Horizontal", 'yacht-rental'),
			"vertical" => esc_html__("Vertical", 'yacht-rental')
		);
		return $prepend_inherit ? yacht_rental_array_merge(array('inherit' => esc_html__("Inherit", 'yacht-rental')), $list) : $list;
	}
}

// Return list with item's shapes
if ( !function_exists( 'yacht_rental_get_list_shapes' ) ) {
	function yacht_rental_get_list_shapes($prepend_inherit=false) {
		$list = array(
			"round"  => esc_html__("Round", 'yacht-rental'),
			"square" => esc_html__("Square", 'yacht-rental')
		);
		return $prepend_inherit ? yacht_rental_array_merge(array('inherit' => esc_html__("Inherit", 'yacht-rental')), $list) : $list;
	}
}

// Return list with item's sizes
if ( !function_exists( 'yacht_rental_get_list_sizes' ) ) {
	function yacht_rental_get_list_sizes($prepend_inherit=false) {
		$list = array(
			"tiny"   => esc_html__("Tiny", 'yacht-rental'),
			"small"  => esc_html__("Small", 'yacht-rental'),
			"medium" => esc_html__("Medium", 'yacht-rental'),
			"large"  => esc_html__("Large", 'yacht-rental')
		);
		return $prepend_inherit ? yacht_rental_array_merge(array('inherit' => esc_html__("Inherit", 'yacht-rental')), $list) : $list;
	}
}

// Return list with slider (scroll) controls positions
if ( !function_exists( 'yacht_rental_get_list_controls' ) ) {
	function yacht_rental_get_list_controls($prepend_inherit=false) {
		$list = array(
			"hide" => esc_html__("Hide", 'yacht-rental'),
			"side" => esc_html__("Side", 'yacht-rental'),
			"bottom" => esc_html__("Bottom", 'yacht-rental')
		);
		return $prepend_inherit ? yacht_rental_array_merge(array('inherit' => esc_html__("Inherit", 'yacht-rental')), $list) : $list;
	}
}

// Return list with float items
if ( !function_exists( 'yacht_rental_get_list_floats' ) ) {
	function yacht_rental_get_list_floats($prepend_inherit=false) {
		$list = array(
			"none" => esc_html__("None", 'yacht-rental'),
			"left" => esc_html__("Float Left", 'yacht-rental'),
			"right" => esc_html__("Float Right", 'yacht-rental')
		);
		return $prepend_inherit ? yacht_rental_array_merge(array('inherit' => esc_html__("Inherit", 'yacht-rental')), $list) : $list;
	}
}

// Return list with alignment items
if ( !function_exists( 'yacht_rental_get_list_alignments' ) ) {
	function yacht_rental_get_list_alignments($justify=false, $prepend_inherit=false) {
		$list = array(
			"none" => esc_html__("None", 'yacht-rental'),
			"left" => esc_html__("Left", 'yacht-rental'),
			"center" => esc_html__("Center", 'yacht-rental'),
			"right" => esc_html__("Right", 'yacht-rental')
		);
		if ($justify) $list["justify"] = esc_html__("Justify", 'yacht-rental');
		return $prepend_inherit ? yacht_rental_array_merge(array('inherit' => esc_html__("Inherit", 'yacht-rental')), $list) : $list;
	}
}

// Return list with horizontal positions
if ( !function_exists( 'yacht_rental_get_list_hpos' ) ) {
	function yacht_rental_get_list_hpos($prepend_inherit=false, $center=false) {
		$list = array();
		$list['left'] = esc_html__("Left", 'yacht-rental');
		if ($center) $list['center'] = esc_html__("Center", 'yacht-rental');
		$list['right'] = esc_html__("Right", 'yacht-rental');
		return $prepend_inherit ? yacht_rental_array_merge(array('inherit' => esc_html__("Inherit", 'yacht-rental')), $list) : $list;
	}
}

// Return list with vertical positions
if ( !function_exists( 'yacht_rental_get_list_vpos' ) ) {
	function yacht_rental_get_list_vpos($prepend_inherit=false, $center=false) {
		$list = array();
		$list['top'] = esc_html__("Top", 'yacht-rental');
		if ($center) $list['center'] = esc_html__("Center", 'yacht-rental');
		$list['bottom'] = esc_html__("Bottom", 'yacht-rental');
		return $prepend_inherit ? yacht_rental_array_merge(array('inherit' => esc_html__("Inherit", 'yacht-rental')), $list) : $list;
	}
}

// Return sorting list items
if ( !function_exists( 'yacht_rental_get_list_sortings' ) ) {
	function yacht_rental_get_list_sortings($prepend_inherit=false) {
		if (($list = yacht_rental_storage_get('list_sortings'))=='') {
			$list = array(
				"date" => esc_html__("Date", 'yacht-rental'),
				"title" => esc_html__("Alphabetically", 'yacht-rental'),
				"views" => esc_html__("Popular (views count)", 'yacht-rental'),
				"comments" => esc_html__("Most commented (comments count)", 'yacht-rental'),
				"author_rating" => esc_html__("Author rating", 'yacht-rental'),
				"users_rating" => esc_html__("Visitors (users) rating", 'yacht-rental'),
				"random" => esc_html__("Random", 'yacht-rental')
			);
			$list = apply_filters('yacht_rental_filter_list_sortings', $list);
			if (yacht_rental_get_theme_setting('use_list_cache')) yacht_rental_storage_set('list_sortings', $list);
		}
		return $prepend_inherit ? yacht_rental_array_merge(array('inherit' => esc_html__("Inherit", 'yacht-rental')), $list) : $list;
	}
}

// Return list with columns widths
if ( !function_exists( 'yacht_rental_get_list_columns' ) ) {
	function yacht_rental_get_list_columns($prepend_inherit=false) {
		if (($list = yacht_rental_storage_get('list_columns'))=='') {
			$list = array(
				"none" => esc_html__("None", 'yacht-rental'),
				"1_1" => esc_html__("100%", 'yacht-rental'),
				"1_2" => esc_html__("1/2", 'yacht-rental'),
				"1_3" => esc_html__("1/3", 'yacht-rental'),
				"2_3" => esc_html__("2/3", 'yacht-rental'),
				"1_4" => esc_html__("1/4", 'yacht-rental'),
				"3_4" => esc_html__("3/4", 'yacht-rental'),
				"1_5" => esc_html__("1/5", 'yacht-rental'),
				"2_5" => esc_html__("2/5", 'yacht-rental'),
				"3_5" => esc_html__("3/5", 'yacht-rental'),
				"4_5" => esc_html__("4/5", 'yacht-rental'),
				"1_6" => esc_html__("1/6", 'yacht-rental'),
				"5_6" => esc_html__("5/6", 'yacht-rental'),
				"1_7" => esc_html__("1/7", 'yacht-rental'),
				"2_7" => esc_html__("2/7", 'yacht-rental'),
				"3_7" => esc_html__("3/7", 'yacht-rental'),
				"4_7" => esc_html__("4/7", 'yacht-rental'),
				"5_7" => esc_html__("5/7", 'yacht-rental'),
				"6_7" => esc_html__("6/7", 'yacht-rental'),
				"1_8" => esc_html__("1/8", 'yacht-rental'),
				"3_8" => esc_html__("3/8", 'yacht-rental'),
				"5_8" => esc_html__("5/8", 'yacht-rental'),
				"7_8" => esc_html__("7/8", 'yacht-rental'),
				"1_9" => esc_html__("1/9", 'yacht-rental'),
				"2_9" => esc_html__("2/9", 'yacht-rental'),
				"4_9" => esc_html__("4/9", 'yacht-rental'),
				"5_9" => esc_html__("5/9", 'yacht-rental'),
				"7_9" => esc_html__("7/9", 'yacht-rental'),
				"8_9" => esc_html__("8/9", 'yacht-rental'),
				"1_10"=> esc_html__("1/10", 'yacht-rental'),
				"3_10"=> esc_html__("3/10", 'yacht-rental'),
				"7_10"=> esc_html__("7/10", 'yacht-rental'),
				"9_10"=> esc_html__("9/10", 'yacht-rental'),
				"1_11"=> esc_html__("1/11", 'yacht-rental'),
				"2_11"=> esc_html__("2/11", 'yacht-rental'),
				"3_11"=> esc_html__("3/11", 'yacht-rental'),
				"4_11"=> esc_html__("4/11", 'yacht-rental'),
				"5_11"=> esc_html__("5/11", 'yacht-rental'),
				"6_11"=> esc_html__("6/11", 'yacht-rental'),
				"7_11"=> esc_html__("7/11", 'yacht-rental'),
				"8_11"=> esc_html__("8/11", 'yacht-rental'),
				"9_11"=> esc_html__("9/11", 'yacht-rental'),
				"10_11"=> esc_html__("10/11", 'yacht-rental'),
				"1_12"=> esc_html__("1/12", 'yacht-rental'),
				"5_12"=> esc_html__("5/12", 'yacht-rental'),
				"7_12"=> esc_html__("7/12", 'yacht-rental'),
				"10_12"=> esc_html__("10/12", 'yacht-rental'),
				"11_12"=> esc_html__("11/12", 'yacht-rental')
			);
			$list = apply_filters('yacht_rental_filter_list_columns', $list);
			if (yacht_rental_get_theme_setting('use_list_cache')) yacht_rental_storage_set('list_columns', $list);
		}
		return $prepend_inherit ? yacht_rental_array_merge(array('inherit' => esc_html__("Inherit", 'yacht-rental')), $list) : $list;
	}
}

// Return list of locations for the dedicated content
if ( !function_exists( 'yacht_rental_get_list_dedicated_locations' ) ) {
	function yacht_rental_get_list_dedicated_locations($prepend_inherit=false) {
		if (($list = yacht_rental_storage_get('list_dedicated_locations'))=='') {
			$list = array(
				"default" => esc_html__('As in the post defined', 'yacht-rental'),
				"center"  => esc_html__('Above the text of the post', 'yacht-rental'),
				"left"    => esc_html__('To the left the text of the post', 'yacht-rental'),
				"right"   => esc_html__('To the right the text of the post', 'yacht-rental'),
				"alter"   => esc_html__('Alternates for each post', 'yacht-rental')
			);
			$list = apply_filters('yacht_rental_filter_list_dedicated_locations', $list);
			if (yacht_rental_get_theme_setting('use_list_cache')) yacht_rental_storage_set('list_dedicated_locations', $list);
		}
		return $prepend_inherit ? yacht_rental_array_merge(array('inherit' => esc_html__("Inherit", 'yacht-rental')), $list) : $list;
	}
}

// Return post-format name
if ( !function_exists( 'yacht_rental_get_post_format_name' ) ) {
	function yacht_rental_get_post_format_name($format, $single=true) {
		$name = '';
		if ($format=='gallery')		$name = $single ? esc_html__('gallery', 'yacht-rental') : esc_html__('galleries', 'yacht-rental');
		else if ($format=='video')	$name = $single ? esc_html__('video', 'yacht-rental') : esc_html__('videos', 'yacht-rental');
		else if ($format=='audio')	$name = $single ? esc_html__('audio', 'yacht-rental') : esc_html__('audios', 'yacht-rental');
		else if ($format=='image')	$name = $single ? esc_html__('image', 'yacht-rental') : esc_html__('images', 'yacht-rental');
		else if ($format=='quote')	$name = $single ? esc_html__('quote', 'yacht-rental') : esc_html__('quotes', 'yacht-rental');
		else if ($format=='link')	$name = $single ? esc_html__('link', 'yacht-rental') : esc_html__('links', 'yacht-rental');
		else if ($format=='status')	$name = $single ? esc_html__('status', 'yacht-rental') : esc_html__('statuses', 'yacht-rental');
		else if ($format=='aside')	$name = $single ? esc_html__('aside', 'yacht-rental') : esc_html__('asides', 'yacht-rental');
		else if ($format=='chat')	$name = $single ? esc_html__('chat', 'yacht-rental') : esc_html__('chats', 'yacht-rental');
		else						$name = $single ? esc_html__('standard', 'yacht-rental') : esc_html__('standards', 'yacht-rental');
		return apply_filters('yacht_rental_filter_list_post_format_name', $name, $format);
	}
}

// Return post-format icon name (from Fontello library)
if ( !function_exists( 'yacht_rental_get_post_format_icon' ) ) {
	function yacht_rental_get_post_format_icon($format) {
		$icon = 'icon-';
		if ($format=='gallery')		$icon .= 'pictures';
		else if ($format=='video')	$icon .= 'video';
		else if ($format=='audio')	$icon .= 'note';
		else if ($format=='image')	$icon .= 'picture';
		else if ($format=='quote')	$icon .= 'quote';
		else if ($format=='link')	$icon .= 'link';
		else if ($format=='status')	$icon .= 'comment';
		else if ($format=='aside')	$icon .= 'doc-text';
		else if ($format=='chat')	$icon .= 'chat';
		else						$icon .= 'book-open';
		return apply_filters('yacht_rental_filter_list_post_format_icon', $icon, $format);
	}
}

// Return fonts styles list, prepended inherit
if ( !function_exists( 'yacht_rental_get_list_fonts_styles' ) ) {
	function yacht_rental_get_list_fonts_styles($prepend_inherit=false) {
		if (($list = yacht_rental_storage_get('list_fonts_styles'))=='') {
			$list = array(
				'i' => esc_html__('I','yacht-rental'),
				'u' => esc_html__('U', 'yacht-rental')
			);
			if (yacht_rental_get_theme_setting('use_list_cache')) yacht_rental_storage_set('list_fonts_styles', $list);
		}
		return $prepend_inherit ? yacht_rental_array_merge(array('inherit' => esc_html__("Inherit", 'yacht-rental')), $list) : $list;
	}
}

// Return Google fonts list
if ( !function_exists( 'yacht_rental_get_list_fonts' ) ) {
	function yacht_rental_get_list_fonts($prepend_inherit=false) {
		if (($list = yacht_rental_storage_get('list_fonts'))=='') {
			$list = array();
			$list = yacht_rental_array_merge($list, yacht_rental_get_list_font_faces());
			$list = yacht_rental_array_merge($list, array(
				'Advent Pro' => array('family'=>'sans-serif'),
				'Alegreya Sans' => array('family'=>'sans-serif'),
				'Arimo' => array('family'=>'sans-serif'),
				'Asap' => array('family'=>'sans-serif'),
				'Averia Sans Libre' => array('family'=>'cursive'),
				'Averia Serif Libre' => array('family'=>'cursive'),
				'Bree Serif' => array('family'=>'serif',),
				'Cabin' => array('family'=>'sans-serif'),
				'Cabin Condensed' => array('family'=>'sans-serif'),
				'Caudex' => array('family'=>'serif'),
				'Comfortaa' => array('family'=>'cursive'),
				'Cousine' => array('family'=>'sans-serif'),
				'Crimson Text' => array('family'=>'serif'),
				'Cuprum' => array('family'=>'sans-serif'),
				'Dosis' => array('family'=>'sans-serif'),
				'Economica' => array('family'=>'sans-serif'),
				'Exo' => array('family'=>'sans-serif'),
				'Expletus Sans' => array('family'=>'cursive'),
				'Karla' => array('family'=>'sans-serif'),
				'Lato' => array('family'=>'sans-serif'),
				'Lekton' => array('family'=>'sans-serif'),
				'Lobster Two' => array('family'=>'cursive'),
				'Maven Pro' => array('family'=>'sans-serif'),
				'Merriweather' => array('family'=>'serif'),

				'Neuton' => array('family'=>'serif'),
				'Noticia Text' => array('family'=>'serif'),
				'Old Standard TT' => array('family'=>'serif'),
				'Open Sans' => array('family'=>'sans-serif'),
				'Orbitron' => array('family'=>'sans-serif'),
				'Oswald' => array('family'=>'sans-serif'),
				'Overlock' => array('family'=>'cursive'),
				'Oxygen' => array('family'=>'sans-serif'),
				'Philosopher' => array('family'=>'serif'),
				'PT Serif' => array('family'=>'serif'),
				'Puritan' => array('family'=>'sans-serif'),
				'Raleway' => array('family'=>'sans-serif'),
				'Roboto' => array('family'=>'sans-serif'),
				'Roboto Slab' => array('family'=>'sans-serif'),
				'Roboto Condensed' => array('family'=>'sans-serif'),
				'Rosario' => array('family'=>'sans-serif'),
				'Share' => array('family'=>'cursive'),
				'Signika' => array('family'=>'sans-serif'),
				'Signika Negative' => array('family'=>'sans-serif'),
				'Source Sans Pro' => array('family'=>'sans-serif'),
				'Tinos' => array('family'=>'serif'),
				'Ubuntu' => array('family'=>'sans-serif'),
				'Vollkorn' => array('family'=>'serif')
				)
			);
			$list = apply_filters('yacht_rental_filter_list_fonts', $list);
			if (yacht_rental_get_theme_setting('use_list_cache')) yacht_rental_storage_set('list_fonts', $list);
		}
		return $prepend_inherit ? yacht_rental_array_merge(array('inherit' => esc_html__("Inherit", 'yacht-rental')), $list) : $list;
	}
}

// Return Custom font-face list
if ( !function_exists( 'yacht_rental_get_list_font_faces' ) ) {
    function yacht_rental_get_list_font_faces($prepend_inherit=false) {
        static $list = false;
        if (is_array($list)) return $list;
        $fonts = yacht_rental_storage_get('required_custom_fonts');
        $list = array();
        if (is_array($fonts)) {
            foreach ($fonts as $font) {
                if (($url = yacht_rental_get_file_url('css/font-face/'.trim($font).'/stylesheet.css'))!='') {
                    $list[sprintf(esc_html__('%s (uploaded font)', 'yacht-rental'), $font)] = array('css' => $url);
                }
            }
        }
        return $list;
    }
}
?>