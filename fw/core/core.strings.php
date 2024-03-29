<?php
/**
 * Yacht rental Framework: strings manipulations
 *
 * @package	yacht_rental
 * @since	yacht_rental 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Check multibyte functions
if ( ! defined( 'YACHT_RENTAL_MULTIBYTE' ) ) define( 'YACHT_RENTAL_MULTIBYTE', function_exists('mb_strpos') ? 'UTF-8' : false );

if (!function_exists('yacht_rental_strlen')) {
	function yacht_rental_strlen($text) {
		return YACHT_RENTAL_MULTIBYTE ? mb_strlen($text) : strlen($text);
	}
}

if (!function_exists('yacht_rental_strpos')) {
	function yacht_rental_strpos($text, $char, $from=0) {
		return YACHT_RENTAL_MULTIBYTE ? mb_strpos($text, $char, $from) : strpos($text, $char, $from);
	}
}

if (!function_exists('yacht_rental_strrpos')) {
	function yacht_rental_strrpos($text, $char, $from=0) {
		return YACHT_RENTAL_MULTIBYTE ? mb_strrpos($text, $char, $from) : strrpos($text, $char, $from);
	}
}

if (!function_exists('yacht_rental_substr')) {
	function yacht_rental_substr($text, $from, $len=-999999) {
		if ($len==-999999) { 
			if ($from < 0)
				$len = -$from; 
			else
				$len = yacht_rental_strlen($text)-$from;
		}
		return YACHT_RENTAL_MULTIBYTE ? mb_substr($text, $from, $len) : substr($text, $from, $len);
	}
}

if (!function_exists('yacht_rental_strtolower')) {
	function yacht_rental_strtolower($text) {
		return YACHT_RENTAL_MULTIBYTE ? mb_strtolower($text) : strtolower($text);
	}
}

if (!function_exists('yacht_rental_strtoupper')) {
	function yacht_rental_strtoupper($text) {
		return YACHT_RENTAL_MULTIBYTE ? mb_strtoupper($text) : strtoupper($text);
	}
}

if (!function_exists('yacht_rental_strtoproper')) {
	function yacht_rental_strtoproper($text) { 
		$rez = ''; $last = ' ';
		for ($i=0; $i<yacht_rental_strlen($text); $i++) {
			$ch = yacht_rental_substr($text, $i, 1);
			$rez .= yacht_rental_strpos(' .,:;?!()[]{}+=', $last)!==false ? yacht_rental_strtoupper($ch) : yacht_rental_strtolower($ch);
			$last = $ch;
		}
		return $rez;
	}
}

if (!function_exists('yacht_rental_strrepeat')) {
	function yacht_rental_strrepeat($str, $n) {
		$rez = '';
		for ($i=0; $i<$n; $i++)
			$rez .= $str;
		return $rez;
	}
}

if (!function_exists('yacht_rental_strshort')) {
	function yacht_rental_strshort($str, $maxlength, $add='...') {
		if ($maxlength < 0) 
			return $str;
		if ($maxlength == 0) 
			return '';
		if ($maxlength >= yacht_rental_strlen($str)) 
			return strip_tags($str);
		$str = yacht_rental_substr(strip_tags($str), 0, $maxlength - yacht_rental_strlen($add));
		$ch = yacht_rental_substr($str, $maxlength - yacht_rental_strlen($add), 1);
		if ($ch != ' ') {
			for ($i = yacht_rental_strlen($str) - 1; $i > 0; $i--)
				if (yacht_rental_substr($str, $i, 1) == ' ') break;
			$str = trim(yacht_rental_substr($str, 0, $i));
		}
		if (!empty($str) && yacht_rental_strpos(',.:;-', yacht_rental_substr($str, -1))!==false) $str = yacht_rental_substr($str, 0, -1);
		return ($str) . ($add);
	}
}

// Clear string from spaces, line breaks and tags (only around text)
if (!function_exists('yacht_rental_strclear')) {
	function yacht_rental_strclear($text, $tags=array()) {
		if (empty($text)) return $text;
		if (!is_array($tags)) {
			if ($tags != '')
				$tags = explode($tags, ',');
			else
				$tags = array();
		}
		$text = trim(chop($text));
		if (is_array($tags) && count($tags) > 0) {
			foreach ($tags as $tag) {
				$open  = '<'.esc_attr($tag);
				$close = '</'.esc_attr($tag).'>';
				if (yacht_rental_substr($text, 0, yacht_rental_strlen($open))==$open) {
					$pos = yacht_rental_strpos($text, '>');
					if ($pos!==false) $text = yacht_rental_substr($text, $pos+1);
				}
				if (yacht_rental_substr($text, -yacht_rental_strlen($close))==$close) $text = yacht_rental_substr($text, 0, yacht_rental_strlen($text) - yacht_rental_strlen($close));
				$text = trim(chop($text));
			}
		}
		return $text;
	}
}

// Return slug for the any title string
if (!function_exists('yacht_rental_get_slug')) {
	function yacht_rental_get_slug($title) {
		return yacht_rental_strtolower(str_replace(array('\\','/','-',' ','.'), '_', $title));
	}
}

// Replace macros in the string
if (!function_exists('yacht_rental_strmacros')) {
	function yacht_rental_strmacros($str) {
		return str_replace(array("{{", "}}", "((", "))", "||"), array("<i>", "</i>", "<b>", "</b>", "<br>"), $str);
	}
}

// Unserialize string (try replace \n with \r\n)
if (!function_exists('yacht_rental_unserialize')) {
	function yacht_rental_unserialize($str) {
		if ( is_serialized($str) ) {
			try {
				$data = unserialize($str);
			} catch (Exception $e) {
				dcl($e->getMessage());
				$data = false;
			}
			if ($data===false) {
				try {
					$data = unserialize(str_replace("\n", "\r\n", $str));
				} catch (Exception $e) {
					dcl($e->getMessage());
					$data = false;
				}
			}
			return $data;
		} else
			return $str;
	}
}
?>