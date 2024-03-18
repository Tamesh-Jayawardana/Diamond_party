<?php
/**
 * Yacht rental Framework: Services support
 *
 * @package	yacht_rental
 * @since	yacht_rental 1.0
 */

// Theme init
if (!function_exists('yacht_rental_services_theme_setup')) {
	add_action( 'yacht_rental_action_before_init_theme', 'yacht_rental_services_theme_setup',1 );
	function yacht_rental_services_theme_setup() {
		
		// Detect current page type, taxonomy and title (for custom post_types use priority < 10 to fire it handles early, than for standard post types)
		add_filter('yacht_rental_filter_get_blog_type',			'yacht_rental_services_get_blog_type', 9, 2);
		add_filter('yacht_rental_filter_get_blog_title',		'yacht_rental_services_get_blog_title', 9, 2);
		add_filter('yacht_rental_filter_get_current_taxonomy',	'yacht_rental_services_get_current_taxonomy', 9, 2);
		add_filter('yacht_rental_filter_is_taxonomy',			'yacht_rental_services_is_taxonomy', 9, 2);
		add_filter('yacht_rental_filter_get_stream_page_title',	'yacht_rental_services_get_stream_page_title', 9, 2);
		add_filter('yacht_rental_filter_get_stream_page_link',	'yacht_rental_services_get_stream_page_link', 9, 2);
		add_filter('yacht_rental_filter_get_stream_page_id',	'yacht_rental_services_get_stream_page_id', 9, 2);
		add_filter('yacht_rental_filter_query_add_filters',		'yacht_rental_services_query_add_filters', 9, 2);
		add_filter('yacht_rental_filter_detect_inheritance_key','yacht_rental_services_detect_inheritance_key', 9, 1);

		// Extra column for services lists
		if (yacht_rental_get_theme_option('show_overriden_posts')=='yes') {
			add_filter('manage_edit-services_columns',			'yacht_rental_post_add_options_column', 9);
			add_filter('manage_services_posts_custom_column',	'yacht_rental_post_fill_options_column', 9, 2);
		}
		
		// Add supported data types
		yacht_rental_theme_support_pt('services');
		yacht_rental_theme_support_tx('services_group');
	}
}

if ( !function_exists( 'yacht_rental_services_settings_theme_setup2' ) ) {
	add_action( 'yacht_rental_action_before_init_theme', 'yacht_rental_services_settings_theme_setup2', 3 );
	function yacht_rental_services_settings_theme_setup2() {
		// Add post type 'services' and taxonomy 'services_group' into theme inheritance list
		yacht_rental_add_theme_inheritance( array('services' => array(
			'stream_template' => 'blog-services',
			'single_template' => 'single-service',
			'taxonomy' => array('services_group'),
			'taxonomy_tags' => array(),
			'post_type' => array('services'),
			'override' => 'custom'
			) )
		);
	}
}



// Return true, if current page is services page
if ( !function_exists( 'yacht_rental_is_services_page' ) ) {
	function yacht_rental_is_services_page() {
		$is = in_array(yacht_rental_storage_get('page_template'), array('blog-services', 'single-service'));
		if (!$is) {
			if (!yacht_rental_storage_empty('pre_query'))
				$is = yacht_rental_storage_call_obj_method('pre_query', 'get', 'post_type')=='services' 
						|| yacht_rental_storage_call_obj_method('pre_query', 'is_tax', 'services_group') 
						|| (yacht_rental_storage_call_obj_method('pre_query', 'is_page') 
								&& ($id=yacht_rental_get_template_page_id('blog-services')) > 0 
								&& $id==yacht_rental_storage_get_obj_property('pre_query', 'queried_object_id', 0) 
							);
			else
				$is = get_query_var('post_type')=='services' 
						|| is_tax('services_group') 
						|| (is_page() && ($id=yacht_rental_get_template_page_id('blog-services')) > 0 && $id==get_the_ID());
		}
		return $is;
	}
}

// Filter to detect current page inheritance key
if ( !function_exists( 'yacht_rental_services_detect_inheritance_key' ) ) {
	function yacht_rental_services_detect_inheritance_key($key) {
		if (!empty($key)) return $key;
		return yacht_rental_is_services_page() ? 'services' : '';
	}
}

// Filter to detect current page slug
if ( !function_exists( 'yacht_rental_services_get_blog_type' ) ) {
	function yacht_rental_services_get_blog_type($page, $query=null) {
		if (!empty($page)) return $page;
		if ($query && $query->is_tax('services_group') || is_tax('services_group'))
			$page = 'services_category';
		else if ($query && $query->get('post_type')=='services' || get_query_var('post_type')=='services')
			$page = $query && $query->is_single() || is_single() ? 'services_item' : 'services';
		return $page;
	}
}

// Filter to detect current page title
if ( !function_exists( 'yacht_rental_services_get_blog_title' ) ) {
	function yacht_rental_services_get_blog_title($title, $page) {
		if (!empty($title)) return $title;
		if ( yacht_rental_strpos($page, 'services')!==false ) {
			if ( $page == 'services_category' ) {
				$term = get_term_by( 'slug', get_query_var( 'services_group' ), 'services_group', OBJECT);
				$title = $term->name;
			} else if ( $page == 'services_item' ) {
				$title = yacht_rental_get_post_title();
			} else {
				$title = esc_html__('All services', 'yacht-rental');
			}
		}
		return $title;
	}
}

// Filter to detect stream page title
if ( !function_exists( 'yacht_rental_services_get_stream_page_title' ) ) {
	function yacht_rental_services_get_stream_page_title($title, $page) {
		if (!empty($title)) return $title;
		if (yacht_rental_strpos($page, 'services')!==false) {
			if (($page_id = yacht_rental_services_get_stream_page_id(0, $page=='services' ? 'blog-services' : $page)) > 0)
				$title = yacht_rental_get_post_title($page_id);
			else
				$title = esc_html__('All services', 'yacht-rental');				
		}
		return $title;
	}
}

// Filter to detect stream page ID
if ( !function_exists( 'yacht_rental_services_get_stream_page_id' ) ) {
	function yacht_rental_services_get_stream_page_id($id, $page) {
		if (!empty($id)) return $id;
		if (yacht_rental_strpos($page, 'services')!==false) $id = yacht_rental_get_template_page_id('blog-services');
		return $id;
	}
}

// Filter to detect stream page URL
if ( !function_exists( 'yacht_rental_services_get_stream_page_link' ) ) {
	function yacht_rental_services_get_stream_page_link($url, $page) {
		if (!empty($url)) return $url;
		if (yacht_rental_strpos($page, 'services')!==false) {
			$id = yacht_rental_get_template_page_id('blog-services');
			if ($id) $url = get_permalink($id);
		}
		return $url;
	}
}

// Filter to detect current taxonomy
if ( !function_exists( 'yacht_rental_services_get_current_taxonomy' ) ) {
	function yacht_rental_services_get_current_taxonomy($tax, $page) {
		if (!empty($tax)) return $tax;
		if ( yacht_rental_strpos($page, 'services')!==false ) {
			$tax = 'services_group';
		}
		return $tax;
	}
}

// Return taxonomy name (slug) if current page is this taxonomy page
if ( !function_exists( 'yacht_rental_services_is_taxonomy' ) ) {
	function yacht_rental_services_is_taxonomy($tax, $query=null) {
		if (!empty($tax))
			return $tax;
		else 
			return $query && $query->get('services_group')!='' || is_tax('services_group') ? 'services_group' : '';
	}
}

// Add custom post type and/or taxonomies arguments to the query
if ( !function_exists( 'yacht_rental_services_query_add_filters' ) ) {
	function yacht_rental_services_query_add_filters($args, $filter) {
		if ($filter == 'services') {
			$args['post_type'] = 'services';
		}
		return $args;
	}
}

?>