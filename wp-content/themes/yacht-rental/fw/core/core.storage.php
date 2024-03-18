<?php
/**
 * Yacht rental Framework: theme variables storage
 *
 * @package	yacht_rental
 * @since	yacht_rental 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Get theme variable
if (!function_exists('yacht_rental_storage_get')) {
	function yacht_rental_storage_get($var_name, $default='') {
		global $YACHT_RENTAL_STORAGE;
		return isset($YACHT_RENTAL_STORAGE[$var_name]) ? $YACHT_RENTAL_STORAGE[$var_name] : $default;
	}
}

// Set theme variable
if (!function_exists('yacht_rental_storage_set')) {
	function yacht_rental_storage_set($var_name, $value) {
		global $YACHT_RENTAL_STORAGE;
		$YACHT_RENTAL_STORAGE[$var_name] = $value;
	}
}

// Check if theme variable is empty
if (!function_exists('yacht_rental_storage_empty')) {
	function yacht_rental_storage_empty($var_name, $key='', $key2='') {
		global $YACHT_RENTAL_STORAGE;
		if (!empty($key) && !empty($key2))
			return empty($YACHT_RENTAL_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return empty($YACHT_RENTAL_STORAGE[$var_name][$key]);
		else
			return empty($YACHT_RENTAL_STORAGE[$var_name]);
	}
}

// Check if theme variable is set
if (!function_exists('yacht_rental_storage_isset')) {
	function yacht_rental_storage_isset($var_name, $key='', $key2='') {
		global $YACHT_RENTAL_STORAGE;
		if (!empty($key) && !empty($key2))
			return isset($YACHT_RENTAL_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return isset($YACHT_RENTAL_STORAGE[$var_name][$key]);
		else
			return isset($YACHT_RENTAL_STORAGE[$var_name]);
	}
}

// Inc/Dec theme variable with specified value
if (!function_exists('yacht_rental_storage_inc')) {
	function yacht_rental_storage_inc($var_name, $value=1) {
		global $YACHT_RENTAL_STORAGE;
		if (empty($YACHT_RENTAL_STORAGE[$var_name])) $YACHT_RENTAL_STORAGE[$var_name] = 0;
		$YACHT_RENTAL_STORAGE[$var_name] += $value;
	}
}

// Concatenate theme variable with specified value
if (!function_exists('yacht_rental_storage_concat')) {
	function yacht_rental_storage_concat($var_name, $value) {
		global $YACHT_RENTAL_STORAGE;
		if (empty($YACHT_RENTAL_STORAGE[$var_name])) $YACHT_RENTAL_STORAGE[$var_name] = '';
		$YACHT_RENTAL_STORAGE[$var_name] .= $value;
	}
}

// Get array (one or two dim) element
if (!function_exists('yacht_rental_storage_get_array')) {
	function yacht_rental_storage_get_array($var_name, $key, $key2='', $default='') {
		global $YACHT_RENTAL_STORAGE;
		if (empty($key2))
			return !empty($var_name) && !empty($key) && isset($YACHT_RENTAL_STORAGE[$var_name][$key]) ? $YACHT_RENTAL_STORAGE[$var_name][$key] : $default;
		else
			return !empty($var_name) && !empty($key) && isset($YACHT_RENTAL_STORAGE[$var_name][$key][$key2]) ? $YACHT_RENTAL_STORAGE[$var_name][$key][$key2] : $default;
	}
}

// Set array element
if (!function_exists('yacht_rental_storage_set_array')) {
	function yacht_rental_storage_set_array($var_name, $key, $value) {
		global $YACHT_RENTAL_STORAGE;
		if (!isset($YACHT_RENTAL_STORAGE[$var_name])) $YACHT_RENTAL_STORAGE[$var_name] = array();
		if ($key==='')
			$YACHT_RENTAL_STORAGE[$var_name][] = $value;
		else
			$YACHT_RENTAL_STORAGE[$var_name][$key] = $value;
	}
}

// Set two-dim array element
if (!function_exists('yacht_rental_storage_set_array2')) {
	function yacht_rental_storage_set_array2($var_name, $key, $key2, $value) {
		global $YACHT_RENTAL_STORAGE;
		if (!isset($YACHT_RENTAL_STORAGE[$var_name])) $YACHT_RENTAL_STORAGE[$var_name] = array();
		if (!isset($YACHT_RENTAL_STORAGE[$var_name][$key])) $YACHT_RENTAL_STORAGE[$var_name][$key] = array();
		if ($key2==='')
			$YACHT_RENTAL_STORAGE[$var_name][$key][] = $value;
		else
			$YACHT_RENTAL_STORAGE[$var_name][$key][$key2] = $value;
	}
}

// Add array element after the key
if (!function_exists('yacht_rental_storage_set_array_after')) {
	function yacht_rental_storage_set_array_after($var_name, $after, $key, $value='') {
		global $YACHT_RENTAL_STORAGE;
		if (!isset($YACHT_RENTAL_STORAGE[$var_name])) $YACHT_RENTAL_STORAGE[$var_name] = array();
		if (is_array($key))
			yacht_rental_array_insert_after($YACHT_RENTAL_STORAGE[$var_name], $after, $key);
		else
			yacht_rental_array_insert_after($YACHT_RENTAL_STORAGE[$var_name], $after, array($key=>$value));
	}
}

// Add array element before the key
if (!function_exists('yacht_rental_storage_set_array_before')) {
	function yacht_rental_storage_set_array_before($var_name, $before, $key, $value='') {
		global $YACHT_RENTAL_STORAGE;
		if (!isset($YACHT_RENTAL_STORAGE[$var_name])) $YACHT_RENTAL_STORAGE[$var_name] = array();
		if (is_array($key))
			yacht_rental_array_insert_before($YACHT_RENTAL_STORAGE[$var_name], $before, $key);
		else
			yacht_rental_array_insert_before($YACHT_RENTAL_STORAGE[$var_name], $before, array($key=>$value));
	}
}

// Push element into array
if (!function_exists('yacht_rental_storage_push_array')) {
	function yacht_rental_storage_push_array($var_name, $key, $value) {
		global $YACHT_RENTAL_STORAGE;
		if (!isset($YACHT_RENTAL_STORAGE[$var_name])) $YACHT_RENTAL_STORAGE[$var_name] = array();
		if ($key==='')
			array_push($YACHT_RENTAL_STORAGE[$var_name], $value);
		else {
			if (!isset($YACHT_RENTAL_STORAGE[$var_name][$key])) $YACHT_RENTAL_STORAGE[$var_name][$key] = array();
			array_push($YACHT_RENTAL_STORAGE[$var_name][$key], $value);
		}
	}
}

// Pop element from array
if (!function_exists('yacht_rental_storage_pop_array')) {
	function yacht_rental_storage_pop_array($var_name, $key='', $defa='') {
		global $YACHT_RENTAL_STORAGE;
		$rez = $defa;
		if ($key==='') {
			if (isset($YACHT_RENTAL_STORAGE[$var_name]) && is_array($YACHT_RENTAL_STORAGE[$var_name]) && count($YACHT_RENTAL_STORAGE[$var_name]) > 0) 
				$rez = array_pop($YACHT_RENTAL_STORAGE[$var_name]);
		} else {
			if (isset($YACHT_RENTAL_STORAGE[$var_name][$key]) && is_array($YACHT_RENTAL_STORAGE[$var_name][$key]) && count($YACHT_RENTAL_STORAGE[$var_name][$key]) > 0) 
				$rez = array_pop($YACHT_RENTAL_STORAGE[$var_name][$key]);
		}
		return $rez;
	}
}

// Inc/Dec array element with specified value
if (!function_exists('yacht_rental_storage_inc_array')) {
	function yacht_rental_storage_inc_array($var_name, $key, $value=1) {
		global $YACHT_RENTAL_STORAGE;
		if (!isset($YACHT_RENTAL_STORAGE[$var_name])) $YACHT_RENTAL_STORAGE[$var_name] = array();
		if (empty($YACHT_RENTAL_STORAGE[$var_name][$key])) $YACHT_RENTAL_STORAGE[$var_name][$key] = 0;
		$YACHT_RENTAL_STORAGE[$var_name][$key] += $value;
	}
}

// Concatenate array element with specified value
if (!function_exists('yacht_rental_storage_concat_array')) {
	function yacht_rental_storage_concat_array($var_name, $key, $value) {
		global $YACHT_RENTAL_STORAGE;
		if (!isset($YACHT_RENTAL_STORAGE[$var_name])) $YACHT_RENTAL_STORAGE[$var_name] = array();
		if (empty($YACHT_RENTAL_STORAGE[$var_name][$key])) $YACHT_RENTAL_STORAGE[$var_name][$key] = '';
		$YACHT_RENTAL_STORAGE[$var_name][$key] .= $value;
	}
}

// Call object's method
if (!function_exists('yacht_rental_storage_call_obj_method')) {
	function yacht_rental_storage_call_obj_method($var_name, $method, $param=null) {
		global $YACHT_RENTAL_STORAGE;
		if ($param===null)
			return !empty($var_name) && !empty($method) && isset($YACHT_RENTAL_STORAGE[$var_name]) ? $YACHT_RENTAL_STORAGE[$var_name]->$method(): '';
		else
			return !empty($var_name) && !empty($method) && isset($YACHT_RENTAL_STORAGE[$var_name]) ? $YACHT_RENTAL_STORAGE[$var_name]->$method($param): '';
	}
}

// Get object's property
if (!function_exists('yacht_rental_storage_get_obj_property')) {
	function yacht_rental_storage_get_obj_property($var_name, $prop, $default='') {
		global $YACHT_RENTAL_STORAGE;
		return !empty($var_name) && !empty($prop) && isset($YACHT_RENTAL_STORAGE[$var_name]->$prop) ? $YACHT_RENTAL_STORAGE[$var_name]->$prop : $default;
	}
}
?>