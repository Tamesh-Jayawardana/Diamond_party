<?php
/**
 * Yacht rental Framework: Clients support
 *
 * @package	yacht_rental
 * @since	yacht_rental 1.0
 */

// Theme init
if (!function_exists('yacht_rental_clients_theme_setup')) {
	add_action( 'yacht_rental_action_before_init_theme', 'yacht_rental_clients_theme_setup', 1 );
	function yacht_rental_clients_theme_setup() {

		// Detect current page type, taxonomy and title (for custom post_types use priority < 10 to fire it handles early, than for standard post types)
		add_filter('yacht_rental_filter_get_blog_type',			'yacht_rental_clients_get_blog_type', 9, 2);
		add_filter('yacht_rental_filter_get_blog_title',		'yacht_rental_clients_get_blog_title', 9, 2);
		add_filter('yacht_rental_filter_get_current_taxonomy',	'yacht_rental_clients_get_current_taxonomy', 9, 2);
		add_filter('yacht_rental_filter_is_taxonomy',			'yacht_rental_clients_is_taxonomy', 9, 2);
		add_filter('yacht_rental_filter_get_stream_page_title',	'yacht_rental_clients_get_stream_page_title', 9, 2);
		add_filter('yacht_rental_filter_get_stream_page_link',	'yacht_rental_clients_get_stream_page_link', 9, 2);
		add_filter('yacht_rental_filter_get_stream_page_id',	'yacht_rental_clients_get_stream_page_id', 9, 2);
		add_filter('yacht_rental_filter_query_add_filters',		'yacht_rental_clients_query_add_filters', 9, 2);
		add_filter('yacht_rental_filter_detect_inheritance_key','yacht_rental_clients_detect_inheritance_key', 9, 1);

		// Extra column for clients lists
		if (yacht_rental_get_theme_option('show_overriden_posts')=='yes') {
			add_filter('manage_edit-clients_columns',			'yacht_rental_post_add_options_column', 9);
			add_filter('manage_clients_posts_custom_column',	'yacht_rental_post_fill_options_column', 9, 2);
		}
		
		// Add supported data types
		yacht_rental_theme_support_pt('clients');
		yacht_rental_theme_support_tx('clients_group');
	}
}

if ( !function_exists( 'yacht_rental_clients_settings_theme_setup2' ) ) {
	add_action( 'yacht_rental_action_before_init_theme', 'yacht_rental_clients_settings_theme_setup2', 3 );
	function yacht_rental_clients_settings_theme_setup2() {
		// Add post type 'clients' and taxonomy 'clients_group' into theme inheritance list
		yacht_rental_add_theme_inheritance( array('clients' => array(
			'stream_template' => 'blog-clients',
			'single_template' => 'single-client',
			'taxonomy' => array('clients_group'),
			'taxonomy_tags' => array(),
			'post_type' => array('clients'),
			'override' => 'custom'
			) )
		);
	}
}


if (!function_exists('yacht_rental_clients_after_theme_setup')) {
	add_action( 'yacht_rental_action_after_init_theme', 'yacht_rental_clients_after_theme_setup' );
	function yacht_rental_clients_after_theme_setup() {
		// Update fields in the meta box
		if (yacht_rental_storage_get_array('post_override_options', 'page')=='clients') {
			// Meta box fields
			yacht_rental_storage_set_array('post_override_options', 'title', esc_html__('Client Options', 'yacht-rental'));
			yacht_rental_storage_set_array('post_override_options', 'fields', array(
				"mb_partition_clients" => array(
					"title" => esc_html__('Clients', 'yacht-rental'),
					"override" => "page,post,custom",
					"divider" => false,
					"icon" => "iconadmin-users",
					"type" => "partition"),
				"mb_info_clients_1" => array(
					"title" => esc_html__('Client details', 'yacht-rental'),
					"override" => "page,post,custom",
					"divider" => false,
					"desc" => wp_kses_data( __('In this section you can put details for this client', 'yacht-rental') ),
					"class" => "client_meta",
					"type" => "info"),
				"client_name" => array(
					"title" => esc_html__('Contact name',  'yacht-rental'),
					"desc" => wp_kses_data( __("Name of the contacts manager", 'yacht-rental') ),
					"override" => "page,post,custom",
					"class" => "client_name",
					"std" => '',
					"type" => "text"),
				"client_position" => array(
					"title" => esc_html__('Position',  'yacht-rental'),
					"desc" => wp_kses_data( __("Position of the contacts manager", 'yacht-rental') ),
					"override" => "page,post,custom",
					"class" => "client_position",
					"std" => '',
					"type" => "text"),
				"client_show_link" => array(
					"title" => esc_html__('Show link',  'yacht-rental'),
					"desc" => wp_kses_data( __("Show link to client page", 'yacht-rental') ),
					"override" => "page,post,custom",
					"class" => "client_show_link",
					"std" => "no",
					"options" => yacht_rental_get_list_yesno(),
					"type" => "switch"),
				"client_link" => array(
					"title" => esc_html__('Link',  'yacht-rental'),
					"desc" => wp_kses_data( __("URL of the client's site. If empty - use link to this page", 'yacht-rental') ),
					"override" => "page,post,custom",
					"class" => "client_link",
					"std" => '',
					"type" => "text")
				)
			);
		}
	}
}


// Return true, if current page is clients page
if ( !function_exists( 'yacht_rental_is_clients_page' ) ) {
	function yacht_rental_is_clients_page() {
		$is = in_array(yacht_rental_storage_get('page_template'), array('blog-clients', 'single-client'));
		if (!$is) {
			if (!yacht_rental_storage_empty('pre_query'))
				$is = yacht_rental_storage_call_obj_method('pre_query', 'get', 'post_type')=='clients'
						|| yacht_rental_storage_call_obj_method('pre_query', 'is_tax', 'clients_group') 
						|| (yacht_rental_storage_call_obj_method('pre_query', 'is_page') 
							&& ($id=yacht_rental_get_template_page_id('blog-clients')) > 0 
							&& $id==yacht_rental_storage_get_obj_property('pre_query', 'queried_object_id', 0)
							);
			else
				$is = get_query_var('post_type')=='clients' 
						|| is_tax('clients_group') 
						|| (is_page() && ($id=yacht_rental_get_template_page_id('blog-clients')) > 0 && $id==get_the_ID());
		}
		return $is;
	}
}

// Filter to detect current page inheritance key
if ( !function_exists( 'yacht_rental_clients_detect_inheritance_key' ) ) {
	function yacht_rental_clients_detect_inheritance_key($key) {
		if (!empty($key)) return $key;
		return yacht_rental_is_clients_page() ? 'clients' : '';
	}
}

// Filter to detect current page slug
if ( !function_exists( 'yacht_rental_clients_get_blog_type' ) ) {
	function yacht_rental_clients_get_blog_type($page, $query=null) {
		if (!empty($page)) return $page;
		if ($query && $query->is_tax('clients_group') || is_tax('clients_group'))
			$page = 'clients_category';
		else if ($query && $query->get('post_type')=='clients' || get_query_var('post_type')=='clients')
			$page = $query && $query->is_single() || is_single() ? 'clients_item' : 'clients';
		return $page;
	}
}

// Filter to detect current page title
if ( !function_exists( 'yacht_rental_clients_get_blog_title' ) ) {
	function yacht_rental_clients_get_blog_title($title, $page) {
		if (!empty($title)) return $title;
		if ( yacht_rental_strpos($page, 'clients')!==false ) {
			if ( $page == 'clients_category' ) {
				$term = get_term_by( 'slug', get_query_var( 'clients_group' ), 'clients_group', OBJECT);
				$title = $term->name;
			} else if ( $page == 'clients_item' ) {
				$title = yacht_rental_get_post_title();
			} else {
				$title = esc_html__('All clients', 'yacht-rental');
			}
		}
		return $title;
	}
}

// Filter to detect stream page title
if ( !function_exists( 'yacht_rental_clients_get_stream_page_title' ) ) {
	function yacht_rental_clients_get_stream_page_title($title, $page) {
		if (!empty($title)) return $title;
		if (yacht_rental_strpos($page, 'clients')!==false) {
			if (($page_id = yacht_rental_clients_get_stream_page_id(0, $page=='clients' ? 'blog-clients' : $page)) > 0)
				$title = yacht_rental_get_post_title($page_id);
			else
				$title = esc_html__('All clients', 'yacht-rental');				
		}
		return $title;
	}
}

// Filter to detect stream page ID
if ( !function_exists( 'yacht_rental_clients_get_stream_page_id' ) ) {
	function yacht_rental_clients_get_stream_page_id($id, $page) {
		if (!empty($id)) return $id;
		if (yacht_rental_strpos($page, 'clients')!==false) $id = yacht_rental_get_template_page_id('blog-clients');
		return $id;
	}
}

// Filter to detect stream page URL
if ( !function_exists( 'yacht_rental_clients_get_stream_page_link' ) ) {
	function yacht_rental_clients_get_stream_page_link($url, $page) {
		if (!empty($url)) return $url;
		if (yacht_rental_strpos($page, 'clients')!==false) {
			$id = yacht_rental_get_template_page_id('blog-clients');
			if ($id) $url = get_permalink($id);
		}
		return $url;
	}
}

// Filter to detect current taxonomy
if ( !function_exists( 'yacht_rental_clients_get_current_taxonomy' ) ) {
	function yacht_rental_clients_get_current_taxonomy($tax, $page) {
		if (!empty($tax)) return $tax;
		if ( yacht_rental_strpos($page, 'clients')!==false ) {
			$tax = 'clients_group';
		}
		return $tax;
	}
}

// Return taxonomy name (slug) if current page is this taxonomy page
if ( !function_exists( 'yacht_rental_clients_is_taxonomy' ) ) {
	function yacht_rental_clients_is_taxonomy($tax, $query=null) {
		if (!empty($tax))
			return $tax;
		else 
			return $query && $query->get('clients_group')!='' || is_tax('clients_group') ? 'clients_group' : '';
	}
}

// Add custom post type and/or taxonomies arguments to the query
if ( !function_exists( 'yacht_rental_clients_query_add_filters' ) ) {
	function yacht_rental_clients_query_add_filters($args, $filter) {
		if ($filter == 'clients') {
			$args['post_type'] = 'clients';
		}
		return $args;
	}
}

?>