<?php
/**
 * Yacht rental Framework: Boats support
 *
 * @package	yacht_rental
 * @since	yacht_rental 1.0
 */

// Theme init
if (!function_exists('yacht_rental_boats_theme_setup')) {
	add_action( 'yacht_rental_action_before_init_theme', 'yacht_rental_boats_theme_setup', 1 );
	function yacht_rental_boats_theme_setup() {

		// Detect current page type, taxonomy and title (for custom post_types use priority < 10 to fire it handles early, than for standard post types)
		add_filter('yacht_rental_filter_get_blog_type',			'yacht_rental_boats_get_blog_type', 9, 2);
		add_filter('yacht_rental_filter_get_blog_title',		'yacht_rental_boats_get_blog_title', 9, 2);
		add_filter('yacht_rental_filter_get_current_taxonomy',	'yacht_rental_boats_get_current_taxonomy', 9, 2);
		add_filter('yacht_rental_filter_is_taxonomy',			'yacht_rental_boats_is_taxonomy', 9, 2);
		add_filter('yacht_rental_filter_get_stream_page_title',	'yacht_rental_boats_get_stream_page_title', 9, 2);
		add_filter('yacht_rental_filter_get_stream_page_link',	'yacht_rental_boats_get_stream_page_link', 9, 2);
		add_filter('yacht_rental_filter_get_stream_page_id',	'yacht_rental_boats_get_stream_page_id', 9, 2);
		add_filter('yacht_rental_filter_query_add_filters',		'yacht_rental_boats_query_add_filters', 9, 2);
		add_filter('yacht_rental_filter_detect_inheritance_key','yacht_rental_boats_detect_inheritance_key', 9, 1);
		add_filter('yacht_rental_filter_post_save_custom_options', 'yacht_rental_boats_post_save_custom_options', 10, 3);

		// Extra column for boats lists
		if (yacht_rental_get_theme_option('show_overriden_posts')=='yes') {
			add_filter('manage_edit-boats_columns',			'yacht_rental_post_add_options_column', 9);
			add_filter('manage_boats_posts_custom_column',	'yacht_rental_post_fill_options_column', 9, 2);
		}
		
		// Add supported data types
		yacht_rental_theme_support_pt('boats');
		yacht_rental_theme_support_tx('boats_group');
	}
}

if ( !function_exists( 'yacht_rental_boats_settings_theme_setup2' ) ) {
	add_action( 'yacht_rental_action_before_init_theme', 'yacht_rental_boats_settings_theme_setup2', 3 );
	function yacht_rental_boats_settings_theme_setup2() {
		// Add post type 'boats' and taxonomy 'boats_group' into theme inheritance list
		yacht_rental_add_theme_inheritance( array('boats' => array(
			'stream_template' => 'blog-boats',
			'single_template' => 'single-boat',
			'taxonomy' => array('boats_group'),
			'taxonomy_tags' => array(),
			'post_type' => array('boats'),
			'override' => 'custom'
			) )
		);
	}
}

// Return boats options list in array
if ( !function_exists( 'yacht_rental_get_boats_list' ) ) {
	function yacht_rental_get_boats_list($boats_options) {
		$options = yacht_rental_get_custom_option($boats_options);
		$list = array(); $_list = array();
		if (!empty($options)) {
			$_list = explode(',',$options);
			foreach ($_list as $value) {
				$list[$value] = $value;
			}
		}
		return $list;
	}
}
// Return boats options list in array
if ( !function_exists( 'yacht_rental_boats_list_save_custom_fields' ) ) {
	function yacht_rental_boats_list_save_custom_fields($post_id, $options, $text) {
		$list1 = yacht_rental_get_boats_list($text);
		$list2 = array();
		if (!empty($options)) {
			$list2 = explode(',', $options);
			sort($list2);
		}
		$t = 'yacht_rental_'.$text;
		$v = '|';
		foreach ( $list2 as $val ) {
			if (in_array($val, $list1))
				$v .= $val . '|';
		}
		update_post_meta($post_id, $t, $v);
	}
}


if (!function_exists('yacht_rental_boats_after_theme_setup')) {
	add_action( 'yacht_rental_action_after_init_theme', 'yacht_rental_boats_after_theme_setup' );
	function yacht_rental_boats_after_theme_setup() {
		// Update fields in the meta box
		if (yacht_rental_storage_get_array('post_override_options', 'page')=='boats') {
			// Meta box fields
			yacht_rental_storage_set_array('post_override_options', 'title', esc_html__('Boat Options', 'yacht-rental'));
			yacht_rental_storage_set_array('post_override_options', 'fields', array(
				"mb_partition_boats" => array(
					"title" => esc_html__('Boats details', 'yacht-rental'),
					"override" => "page,post,custom",
					"divider" => false,
					"icon" => "iconadmin-info-circled",
					"type" => "partition"),
				"mb_info_boats_1" => array(
					"title" => esc_html__('Boat details', 'yacht-rental'),
					"override" => "page,post,custom",
					"divider" => false,
					"desc" => wp_kses_data( __('In this section you can put details for this boat', 'yacht-rental') ),
					"class" => "boat_meta",
					"type" => "info"),
				
				"boat_id_web" => array(
					"title" => esc_html__('Boat ID',  'yacht-rental'),
					"desc" => wp_kses_data( __("Add unique boat ID", 'yacht-rental') ),
					"override" => "page,post,custom",
					"std" => '',
					"type" => "text"),
				
				"boat_price_per" => array(
					"title" => esc_html__('Rent period',  'yacht-rental'),
					"desc" => wp_kses_data( __('Select rent period here. Default: week.',  'yacht-rental') ),
					"override" => "post,page,custom",
					"std" => "week",
					"options" => yacht_rental_get_boats_list('boat_price_per_list'),
					"type" => "select"),
				
				"boat_price" => array(
					"title" => esc_html__('Boat price',  'yacht-rental'),
					"desc" => wp_kses_data( __("Set your boat price here (no currency sign required)", 'yacht-rental') ),
					"override" => "page,post,custom",
					"std" => '0',
					"type" => "text"),
				
				"boat_price_sign" => array(
					"title" => esc_html__('Currecny',  'yacht-rental'),
					"desc" => wp_kses_data( __('Select your currency. Default: $.',  'yacht-rental') ),
					"override" => "post,page,custom",
					"std" => "$",
					"options" => yacht_rental_get_boats_list('boat_price_sign_list'),
					"type" => "checklist"),
				
				"boat_location" => array(
					"title" => esc_html__('Boat location',  'yacht-rental'),
					"desc" => wp_kses_data( __('Select boat location.',  'yacht-rental') ),
					"override" => "post,page,custom",
					"std" => "default",
					"options" => yacht_rental_get_boats_list('boat_location_list'),
					"type" => "select"),
				
				"boat_type" => array(
					"title" => esc_html__('Boat type',  'yacht-rental'),
					"desc" => wp_kses_data( __('Select boat type.',  'yacht-rental') ),
					"override" => "post,page,custom",
					"std" => "",
					"options" => yacht_rental_get_boats_list('boat_type_list'),
					"type" => "select"),
				
				
				"boat_manufacturer" => array(
					"title" => esc_html__('Manufacturer',  'yacht-rental'),
					"override" => "page,post,custom",
					"std" => '',
					"type" => "text"),
				"boat_model" => array(
					"title" => esc_html__('Model',  'yacht-rental'),
					"override" => "page,post,custom",
					"std" => '',
					"type" => "text"),
				"boat_length" => array(
					"title" => esc_html__('Length',  'yacht-rental'),
					"override" => "page,post,custom",
					"std" => '',
					"type" => "text"),
				
				"boat_skipper" => array(
					"title" => esc_html__('Boat skipper',  'yacht-rental'),
					"desc" => wp_kses_data( __("Select boat skipper.", 'yacht-rental') ),
					"override" => "page,post,custom",
					"std" => "",
					"options" => array(
						"bareboat" => esc_html__("Bareboat", 'yacht-rental'),
						"skipper_crew" => esc_html__("With skipper/crew", 'yacht-rental'),
						"cabin_charter" => esc_html__("Cabin charter", 'yacht-rental')
					),
					"type" => "select"),
				
				"boat_crew" => array(
					"title" => esc_html__('# Crew',  'yacht-rental'),
					"override" => "page,post,custom",
					"std" => '',
					"type" => "text"),
				"boat_charter_guest" => array(
					"title" => esc_html__('Charter Guest',  'yacht-rental'),
					"override" => "page,post,custom",
					"std" => '',
					"type" => "text"),
				"boat_cabins" => array(
					"title" => esc_html__('Cabins',  'yacht-rental'),
					"override" => "page,post,custom",
					"std" => '',
					"type" => "text"),
				"boat_year" => array(
					"title" => esc_html__('Year',  'yacht-rental'),
					"override" => "page,post,custom",
					"std" => '',
					"type" => "text"),
				"boat_cruising_speed" => array(
					"title" => esc_html__('Cruising Speed',  'yacht-rental'),
					"override" => "page,post,custom",
					"std" => '',
					"type" => "text"),
				
				
				"boat_amenities" => array(
					"title" => esc_html__('Boat amenities',  'yacht-rental'),
					"desc" => wp_kses_data( __('Select boat amenities.',  'yacht-rental') ),
					"override" => "post,page,custom",
					"std" => "",
					"options" => yacht_rental_get_boats_list('boat_amenities_list'),
					"multiple" => true,
					"style" => "list",
					"type" => "select"),
				
				"boat_addon" => array(
					"title" => esc_html__("Boat add-on's",  'yacht-rental'),
					"desc" => wp_kses_data( __("Select boat add-on's.",  'yacht-rental') ),
					"override" => "post,page,custom",
					"std" => "",
					"options" => yacht_rental_get_boats_list('boat_addon_list'),
					"multiple" => true,
					"style" => "list",
					"type" => "select"),

				
				)
			);
		}
	}
}


// Return true, if current page is boats page
if ( !function_exists( 'yacht_rental_is_boats_page' ) ) {
	function yacht_rental_is_boats_page() {
		$is = in_array(yacht_rental_storage_get('page_template'), array('blog-boats', 'single-boat'));
		if (!$is) {
			if (!yacht_rental_storage_empty('pre_query'))
				$is = yacht_rental_storage_call_obj_method('pre_query', 'get', 'post_type')=='boats'
						|| yacht_rental_storage_call_obj_method('pre_query', 'is_tax', 'boats_group')
						|| (yacht_rental_storage_call_obj_method('pre_query', 'is_page')
							&& ($id=yacht_rental_get_template_page_id('blog-boats')) > 0
							&& $id==yacht_rental_storage_get_obj_boats('pre_query', 'queried_object_id', 0)
							);
			else
				$is = get_query_var('post_type')=='boats'
						|| is_tax('boats_group')
						|| (is_page() && ($id=yacht_rental_get_template_page_id('blog-boats')) > 0 && $id==get_the_ID());
		}
		return $is;
	}
}

// Filter to detect current page inheritance key
if ( !function_exists( 'yacht_rental_boats_detect_inheritance_key' ) ) {
	function yacht_rental_boats_detect_inheritance_key($key) {
		if (!empty($key)) return $key;
		return yacht_rental_is_boats_page() ? 'boats' : '';
	}
}

// Filter to detect current page slug
if ( !function_exists( 'yacht_rental_boats_get_blog_type' ) ) {
	function yacht_rental_boats_get_blog_type($page, $query=null) {
		if (!empty($page)) return $page;
		if ($query && $query->is_tax('boats_group') || is_tax('boats_group'))
			$page = 'boats_category';
		else if ($query && $query->get('post_type')=='boats' || get_query_var('post_type')=='boats')
			$page = $query && $query->is_single() || is_single() ? 'boats_item' : 'boats';
		return $page;
	}
}

// Filter to detect current page title
if ( !function_exists( 'yacht_rental_boats_get_blog_title' ) ) {
	function yacht_rental_boats_get_blog_title($title, $page) {
		if (!empty($title)) return $title;
		if ( yacht_rental_strpos($page, 'boats')!==false ) {
			if ( $page == 'boats_category' ) {
				$term = get_term_by( 'slug', get_query_var( 'boats_group' ), 'boats_group', OBJECT);
				$title = $term->name;
			} else if ( $page == 'boats_item' ) {
				$title = yacht_rental_get_post_title();
			} else {
				$title = esc_html__('All boats', 'yacht-rental');
			}
		}
		return $title;
	}
}

// Filter to detect stream page title
if ( !function_exists( 'yacht_rental_boats_get_stream_page_title' ) ) {
	function yacht_rental_boats_get_stream_page_title($title, $page) {
		if (!empty($title)) return $title;
		if (yacht_rental_strpos($page, 'boats')!==false) {
			if (($page_id = yacht_rental_boats_get_stream_page_id(0, $page=='boats' ? 'blog-boats' : $page)) > 0)
				$title = yacht_rental_get_post_title($page_id);
			else
				$title = esc_html__('All boats', 'yacht-rental');
		}
		return $title;
	}
}

// Filter to detect stream page ID
if ( !function_exists( 'yacht_rental_boats_get_stream_page_id' ) ) {
	function yacht_rental_boats_get_stream_page_id($id, $page) {
		if (!empty($id)) return $id;
		if (yacht_rental_strpos($page, 'boats')!==false) $id = yacht_rental_get_template_page_id('blog-boats');
		return $id;
	}
}

// Filter to detect stream page URL
if ( !function_exists( 'yacht_rental_boats_get_stream_page_link' ) ) {
	function yacht_rental_boats_get_stream_page_link($url, $page) {
		if (!empty($url)) return $url;
		if (yacht_rental_strpos($page, 'boats')!==false) {
			$id = yacht_rental_get_template_page_id('blog-boats');
			if ($id) $url = get_permalink($id);
		}
		return $url;
	}
}

// Filter to detect current taxonomy
if ( !function_exists( 'yacht_rental_boats_get_current_taxonomy' ) ) {
	function yacht_rental_boats_get_current_taxonomy($tax, $page) {
		if (!empty($tax)) return $tax;
		if ( yacht_rental_strpos($page, 'boats')!==false ) {
			$tax = 'boats_group';
		}
		return $tax;
	}
}

// Return taxonomy name (slug) if current page is this taxonomy page
if ( !function_exists( 'yacht_rental_boats_is_taxonomy' ) ) {
	function yacht_rental_boats_is_taxonomy($tax, $query=null) {
		if (!empty($tax))
			return $tax;
		else
			return $query && $query->get('boats_group')!='' || is_tax('boats_group') ? 'boats_group' : '';
	}
}

// Add custom post type and/or taxonomies arguments to the query
if ( !function_exists( 'yacht_rental_boats_query_add_filters' ) ) {
	function yacht_rental_boats_query_add_filters($args, $filter) {
		if ($filter == 'boats') {
			$args['post_type'] = 'boats';
		}
		/* ********************************************************************************************************************************************************************************************************************************************************************************************************************************** */
		$j = array();
		$a = yacht_rental_storage_get('blog_filters_boats');
		
		if ( !empty($a) ) {
			
			if ( isset($a['type']) ) {
				$list_type = yacht_rental_get_boats_list('boat_type_list');
				$list_type = array_values($list_type);
				$n = (int) ($a['type']); $n = $n - 1;
				$args['meta_query'][] = array (
					'key' => 'yacht_rental_boats_type',
					'value' => $list_type[$n],
					'compare' => '='
				);
			}
			
			if ( isset($a['location']) ) {
				$list_location = yacht_rental_get_boats_list('boat_location_list');
				$list_location = array_values($list_location);
				$n = (int) ($a['location']); $n = $n - 1;
				$args['meta_query'][] = array (
					'key' => 'yacht_rental_boats_location',
					'value' => $list_location[$n],
					'compare' => '='
				);
			}
			
			if ( isset($a['crew']) ) {
				if ( $a['crew'] == "0" ) {
					$args['meta_query'][] = array (
						'key' => 'yacht_rental_boats_crew',
						'value' => (int) $a['crew'],
						'compare' => '=',
						'type' => 'NUMERIC'
					);
				} else {
					$args['meta_query'][] = array (
						'key' => 'yacht_rental_boats_crew',
						'value' => (int) $a['crew'],
						'compare' => '>=',
						'type' => 'NUMERIC'
					);
				}
			}
			
			if ( isset($a['length_min']) and isset($a['length_max']) ) {
				$args['meta_query'][] = array (
					'key' => 'yacht_rental_boats_length',
					'value' => array( $a['length_min'], $a['length_max'] ),
					'compare' => 'BETWEEN',
					'type' => 'NUMERIC'
				);
			} elseif ( isset($a['length_min']) ) {
				$args['meta_query'][] = array (
					'key' => 'yacht_rental_boats_length',
					'value' => $a['length_min'],
					'compare' => '>=',
					'type' => 'NUMERIC'
				);
			} elseif ( isset($a['length_max']) ) {
				$args['meta_query'][] = array (
					'key' => 'yacht_rental_boats_length',
					'value' => $a['length_max'],
					'compare' => '<=',
					'type' => 'NUMERIC'
				);
			}
			
			if ( isset($a['price_min']) and isset($a['price_max']) ) {
				$args['meta_query'][] = array (
					'key' => 'yacht_rental_boats_price',
					'value' => array( $a['price_min'], $a['price_max'] ),
					'compare' => 'BETWEEN',
					'type' => 'NUMERIC'
				);
			} elseif ( isset($a['price_min']) ) {
				$args['meta_query'][] = array (
					'key' => 'yacht_rental_boats_price',
					'value' => $a['price_min'],
					'compare' => '>=',
					'type' => 'NUMERIC'
				);
			} elseif ( isset($a['price_max']) ) {
				$args['meta_query'][] = array (
					'key' => 'yacht_rental_boats_price',
					'value' => $a['price_max'],
					'compare' => '<=',
					'type' => 'NUMERIC'
				);
			}
			
			if ( isset($a['amenities']) ) {
				$arr = array_keys($a['amenities']);
				sort($arr);
				$v = join('%', $arr);
				$args['meta_query'][] = array (
					'key' => 'yacht_rental_boat_amenities_list',
					'value' => $v,
					'compare' => 'LIKE'
				);
			}
			
			if ( isset($a['addon']) ) {
				$arr = array_keys($a['addon']);
				sort($arr);
				$v = join('%', $arr);
				$args['meta_query'][] = array (
					'key' => 'yacht_rental_boat_addon_list',
					'value' => $v,
					'compare' => 'LIKE'
				);
			}
			
			
			if (!empty($j)) {
				$v = join('%', $j);
				$args['meta_query'][] = array (
					'key' => 'yacht_rental_boats_sco',
					'value' => $v,
					'compare' => 'LIKE'
				);
			}
			
		}
		return $args;
	}
}



// Before save custom options
if (!function_exists('yacht_rental_boats_post_save_custom_options')) {
	function yacht_rental_boats_post_save_custom_options($custom_options, $post_type, $post_id) {
		
		$s_c_o = '|';
		// Save custom options
		// ###################
		
		// boat_id_web
		if ( isset($custom_options['boat_id_web']) ) {
			$temp = htmlspecialchars(trim($custom_options['boat_id_web']));
			update_post_meta($post_id, 'yacht_rental_boats_id_web', $temp);
		}
		
		// boat_price_per
		if ( isset($custom_options['boat_price_per']) ) {
			$temp = htmlspecialchars(trim($custom_options['boat_price_per']));
			if ( $temp == 'inherit' ) { $temp = 'week';	}
			update_post_meta($post_id, 'yacht_rental_boats_price_per', $temp);
		}
		
		
		// boat_price_sign
		if ( isset($custom_options['boat_price_sign']) ) {
			$temp = htmlspecialchars(trim($custom_options['boat_price_sign']));
			if ( $temp == 'inherit' ) { $temp = '$';	}
			update_post_meta($post_id, 'yacht_rental_boats_price_sign', $temp);
		}
		
		// boat_manufacturer
		if ( isset($custom_options['boat_manufacturer']) ) {
			$temp = htmlspecialchars(trim($custom_options['boat_manufacturer']));
			update_post_meta($post_id, 'yacht_rental_boats_manufacturer', $temp);
		}
		
		// boat_model
		if ( isset($custom_options['boat_model']) ) {
			$temp = htmlspecialchars(trim($custom_options['boat_model']));
			update_post_meta($post_id, 'yacht_rental_boats_model', $temp);
		}
		
		// boat_skipper
		if ( isset($custom_options['boat_skipper']) ) {
			$temp = htmlspecialchars(trim($custom_options['boat_skipper']));
			update_post_meta($post_id, 'yacht_rental_boats_skipper', $temp);
		}
		
		// boat_charter_guest
		if ( isset($custom_options['boat_charter_guest']) ) {
			$temp = (int) str_replace(" ", "", htmlspecialchars(trim($custom_options['boat_charter_guest'])));
			update_post_meta($post_id, 'yacht_rental_boats_charter_guest', $temp);
		}
		
		// boat_cabins
		if ( isset($custom_options['boat_cabins']) ) {
			$temp = (int) str_replace(" ", "", htmlspecialchars(trim($custom_options['boat_cabins'])));
			update_post_meta($post_id, 'yacht_rental_boats_charter_cabins', $temp);
		}
		
		// boat_year
		if ( isset($custom_options['boat_year']) ) {
			$temp = (int) str_replace(" ", "", htmlspecialchars(trim($custom_options['boat_year'])));
			update_post_meta($post_id, 'yacht_rental_boats_year', $temp);
		}
		
		// boat_cruising_speed
		if ( isset($custom_options['boat_cruising_speed']) ) {
			$temp = (int) str_replace(" ", "", htmlspecialchars(trim($custom_options['boat_cruising_speed'])));
			update_post_meta($post_id, 'yacht_rental_boats_cruising_speed', $temp);
		}
		
		// boat_type
		if ( isset($custom_options['boat_type']) ) {
			$temp = htmlspecialchars(trim($custom_options['boat_type']));
			update_post_meta($post_id, 'yacht_rental_boats_type', $temp);
			$s_c_o .= 'TYPE='.$temp.'|';
		}
		
		// boat_location
		if ( isset($custom_options['boat_location']) ) {
			$temp = htmlspecialchars(trim($custom_options['boat_location']));
			update_post_meta($post_id, 'yacht_rental_boats_location', $temp);
			$s_c_o .= 'LOCATION='.$temp.'|';
		}
		
		// boat_crew
		if ( isset($custom_options['boat_crew']) ) {
			$temp = (int) str_replace(" ", "", htmlspecialchars(trim($custom_options['boat_crew'])));
			update_post_meta($post_id, 'yacht_rental_boats_crew', $temp);
			$s_c_o .= 'CREW='.$temp.'|';
		}
		
		// boat_length
		if ( isset($custom_options['boat_length']) ) {
			$temp = str_replace(" ", "", htmlspecialchars(trim($custom_options['boat_length'])));
			update_post_meta($post_id, 'yacht_rental_boats_length', $temp);
			$s_c_o .= 'LENGTH='.$temp.'|';
		}
		
		// boat_price
		if ( isset($custom_options['boat_price']) ) {
			$temp = (int) str_replace(" ", "", htmlspecialchars(trim($custom_options['boat_price'])));
			update_post_meta($post_id, 'yacht_rental_boats_price', $temp);
			$s_c_o .= 'PRICE='.$temp.'|';
		}
		
		// boat_amenities
		if ( isset($custom_options['boat_amenities']) ) {
			$temp = htmlspecialchars(trim($custom_options['boat_amenities']));
			yacht_rental_boats_list_save_custom_fields($post_id, $temp, 'boat_amenities_list');
			
			$list1 = yacht_rental_get_boats_list('boat_amenities_list');
			$list2 = array();
			if (!empty($temp)) {
				$list2 = explode(',', $temp);
				sort($list2);
			}
			foreach ( $list2 as $val ) {
				if (in_array($val, $list1))
					$s_c_o .= 'AMENITIES='.$val . '|';
			}
		}
		
		// boat_addon
		if ( isset($custom_options['boat_addon']) ) {
			$temp = htmlspecialchars(trim($custom_options['boat_addon']));
			yacht_rental_boats_list_save_custom_fields($post_id, $temp, 'boat_addon_list');
			
			$list1 = yacht_rental_get_boats_list('boat_addon_list');
			$list2 = array();
			if (!empty($temp)) {
				$list2 = explode(',', $temp);
				sort($list2);
			}
			foreach ( $list2 as $val ) {
				if (in_array($val, $list1))
					$s_c_o .= 'ADDON='.$val . '|';
			}
		}
		update_post_meta($post_id, 'yacht_rental_boats_sco', $s_c_o);
		return $custom_options;
	}
}
?>