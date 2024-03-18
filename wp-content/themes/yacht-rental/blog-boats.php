<?php
/*
Template Name: Boats list
*/

/**
 * Make empty page with this template 
 * and put it into menu
 * to display all Boats as streampage
 */

yacht_rental_storage_set('blog_filters', 'boats');

if (!function_exists('yacht_rental_property_where')) {
	add_filter('posts_where', 'yacht_rental_property_where', 11, 2);
	function yacht_rental_property_where($where, $query) {
		global $wpdb; 
		if (is_admin() || $query->is_attachment || yacht_rental_strpos($where, "post_type = 'boats'")===false) return $where;
		$where = str_replace('\\\\%', '%', $where);
		return $where;
	}
}

$bfp = array();

if ( isset($_GET['bs_type']) ) {
	$bs_type = htmlspecialchars(trim($_GET['bs_type']));
	if ( $bs_type != '-1' ) {
		$bfp['type'] = $bs_type;
	}
}

if ( isset($_GET['bs_location']) ) {
	$bs_location = htmlspecialchars(trim($_GET['bs_location']));
	if ( $bs_location != '-1' ) {
		$bfp['location'] = $bs_location;
	}
}

if ( isset($_GET['bs_crew']) ) {
	$bs_crew = htmlspecialchars(trim($_GET['bs_crew']));
	if ( $bs_crew != '-1' ) {
		$bfp['crew'] = $bs_crew;
	}
}

if ( isset($_GET['bs_length_min']) ) {
	$bs_length_min = (int) htmlspecialchars(trim($_GET['bs_length_min']));
	if ( $bs_length_min != 0 ) {
		$bfp['length_min'] = $bs_length_min;
	}
}
if ( isset($_GET['bs_length_max']) ) {
	$bs_length_max = (int) htmlspecialchars(trim($_GET['bs_length_max']));
	if ( $bs_length_max != ((int) yacht_rental_get_custom_option('boat_search_length')) ) {
		$bfp['length_max'] = $bs_length_max;
	}
	
}

if ( isset($_GET['bs_price_min']) ) {
	$bs_price_min = (int) htmlspecialchars(trim($_GET['bs_price_min']));
	if ( $bs_price_min != 0 ) {
		$bfp['price_min'] = $bs_price_min;
	}
}
if ( isset($_GET['bs_price_max']) ) {
	$bs_price_max = (int) htmlspecialchars(trim($_GET['bs_price_max']));
	if ( $bs_price_max != ((int) yacht_rental_get_custom_option('boat_search_price_max')) ) {
		$bfp['price_max'] = $bs_price_max;
	}
}

if ( isset($_GET['bs_amenities']) ) {
	if ( is_array($_GET['bs_amenities']) ) {
    	$sanitize_arr = array();
    	foreach( $_GET['bs_amenities'] as $key => $value ) {
        	$sanitize_arr[sanitize_text_field($key)] = sanitize_text_field($value);
        }
		$bfp['amenities'] = $sanitize_arr;
    } else {
		$bfp['amenities'] = sanitize_text_field($_GET['bs_amenities']);
    }
}
if ( isset($_GET['bs_addon']) ) {
	if ( is_array($_GET['bs_addon']) ) {
    	$sanitize_arr = array();
    	foreach( $_GET['bs_addon'] as $key => $value ) {
        	$sanitize_arr[sanitize_text_field($key)] = sanitize_text_field($value);
        }
		$bfp['addon'] = $sanitize_arr;
    } else {
		$bfp['addon'] = sanitize_text_field($_GET['bs_addon']);
    }
}

yacht_rental_storage_set('blog_filters_boats', $bfp);
get_template_part('blog');
?>