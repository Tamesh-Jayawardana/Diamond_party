<?php
/**
 * Theme custom styles
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


/* Theme setup section
-------------------------------------------------------------------- */

if (!function_exists('yacht_rental_action_theme_styles_theme_setup')) {
	add_action( 'yacht_rental_action_before_init_theme', 'yacht_rental_action_theme_styles_theme_setup', 1 );
	function yacht_rental_action_theme_styles_theme_setup() {
	
		// Add theme fonts in the used fonts list
		add_filter('yacht_rental_filter_used_fonts',			'yacht_rental_filter_theme_styles_used_fonts');
		// Add theme fonts (from Google fonts) in the main fonts list (if not present).
		add_filter('yacht_rental_filter_list_fonts',			'yacht_rental_filter_theme_styles_list_fonts');

		// Add theme stylesheets
		add_action('yacht_rental_action_add_styles',			'yacht_rental_action_theme_styles_add_styles');
		// Add theme inline styles
		add_filter('yacht_rental_filter_add_styles_inline',		'yacht_rental_filter_theme_styles_add_styles_inline');

		// Add theme scripts
		add_action('yacht_rental_action_add_scripts',			'yacht_rental_action_theme_styles_add_scripts');
		// Add theme scripts inline
		add_filter('yacht_rental_filter_localize_script',		'yacht_rental_filter_theme_styles_localize_script');

		// Add theme less files into list for compilation
		add_filter('yacht_rental_filter_compile_less',			'yacht_rental_filter_theme_styles_compile_less');


		/* Color schemes
		
		// Block's border and background
		bd_color		- border for the entire block
		bg_color		- background color for the entire block
		// Next settings are deprecated
		//bg_image, bg_image_position, bg_image_repeat, bg_image_attachment  - first background image for the entire block
		//bg_image2,bg_image2_position,bg_image2_repeat,bg_image2_attachment - second background image for the entire block
		
		// Additional accented colors (if need)
		accent2			- theme accented color 2
		accent2_hover	- theme accented color 2 (hover state)		
		accent3			- theme accented color 3
		accent3_hover	- theme accented color 3 (hover state)		
		
		// Headers, text and links
		text			- main content
		text_light		- post info
		text_dark		- headers
		text_link		- links
		text_hover		- hover links
		
		// Inverse blocks
		inverse_text	- text on accented background
		inverse_light	- post info on accented background
		inverse_dark	- headers on accented background
		inverse_link	- links on accented background
		inverse_hover	- hovered links on accented background
		
		// Input colors - form fields
		input_text		- inactive text
		input_light		- placeholder text
		input_dark		- focused text
		input_bd_color	- inactive border
		input_bd_hover	- focused borde
		input_bg_color	- inactive background
		input_bg_hover	- focused background
		
		// Alternative colors - highlight blocks, form fields, etc.
		alter_text		- text on alternative background
		alter_light		- post info on alternative background
		alter_dark		- headers on alternative background
		alter_link		- links on alternative background
		alter_hover		- hovered links on alternative background
		alter_bd_color	- alternative border
		alter_bd_hover	- alternative border for hovered state or active field
		alter_bg_color	- alternative background
		alter_bg_hover	- alternative background for hovered state or active field 
		// Next settings are deprecated
		//alter_bg_image, alter_bg_image_position, alter_bg_image_repeat, alter_bg_image_attachment - background image for the alternative block
		
		*/

		// Add color schemes
		yacht_rental_add_color_scheme('original', array(

			'title'					=> esc_html__('Original', 'yacht-rental'),
			
			// Whole block border and background
			'bd_color'				=> '#dae5eb',
			'bg_color'				=> '#eef7fd',
			'accent_1_color'		=> '#d7b084',
			
			// Headers, text and links colors
			'text'					=> '#515c6d',
			'text_light'			=> '#96A1A8',
			'text_dark'				=> '#050f36',
			'text_link'				=> '#050f36',
			'text_hover'			=> '#bc1834',

			// Inverse colors
			'inverse_text'			=> '#ffffff',
			'inverse_light'			=> '#ffffff',
			'inverse_dark'			=> '#ffffff',
			'inverse_link'			=> '#ffffff',
			'inverse_hover'			=> '#ffffff',
		
			// Input fields
			'input_text'			=> '#9baab4',
			'input_light'			=> '#9baab4',
			'input_dark'			=> '#9baab4',
			'input_bd_color'		=> '#eef7fd',
			'input_bd_hover'		=> '#dae5eb',
			'input_bg_color'		=> '#eef7fd',
			'input_bg_hover'		=> '#eef7fd',
		
			// Alternative blocks (submenu items, etc.)
			'alter_text'			=> '#a5b5bf',
			'alter_light'			=> '#66707F',
			'alter_dark'			=> '#ffffff',
			'alter_link'			=> '#ffffff',
			'alter_hover'			=> '#d7b084',
			'alter_bd_color'		=> '#384168',
			'alter_bd_hover'		=> '#ffffff',
			'alter_bg_color'		=> '#050f36',
			'alter_bg_hover'		=> '#1f284f',
			)
		);

		/* Font slugs:
		h1 ... h6	- headers
		p			- plain text
		link		- links
		info		- info blocks (Posted 15 May, 2015 by John Doe)
		menu		- main menu
		submenu		- dropdown menus
		logo		- logo text
		button		- button's caption
		input		- input fields
		*/

		// Add Custom fonts
		yacht_rental_add_custom_font('h1', array(
			'title'			=> esc_html__('Heading 1', 'yacht-rental'),
			'description'	=> '',
			'font-family'	=> 'Playfair Display',
			'font-size' 	=> '3.214em',
			'font-weight'	=> '600',
			'font-style'	=> '',
			'line-height'	=> '1.156em',
			'margin-top'	=> '1.333em',
			'margin-bottom'	=> '0.667em'
			)
		);
		yacht_rental_add_custom_font('h2', array(
			'title'			=> esc_html__('Heading 2', 'yacht-rental'),
			'description'	=> '',
			'font-family'	=> 'Raleway',
			'font-size' 	=> '1.929em',
			'font-weight'	=> '500',
			'font-style'	=> '',
			'line-height'	=> '1.185em',
			'margin-top'	=> '1.852em',
			'margin-bottom'	=> '1.296em'
			)
		);
		yacht_rental_add_custom_font('h3', array(
			'title'			=> esc_html__('Heading 3', 'yacht-rental'),
			'description'	=> '',
			'font-family'	=> 'Raleway',
			'font-size' 	=> '1.500em',
			'font-weight'	=> '500',
			'font-style'	=> '',
			'line-height'	=> '1.238em',
			'margin-top'	=> '2.381em',
			'margin-bottom'	=> '0.952em'
			)
		);
		yacht_rental_add_custom_font('h4', array(
			'title'			=> esc_html__('Heading 4', 'yacht-rental'),
			'description'	=> '',
			'font-family'	=> 'Raleway',
			'font-size' 	=> '1.143em',
			'font-weight'	=> '500',
			'font-style'	=> '',
			'line-height'	=> '1.563em',
			'margin-top'	=> '2.813em',
			'margin-bottom'	=> '1.563em'
			)
		);
		yacht_rental_add_custom_font('h5', array(
			'title'			=> esc_html__('Heading 5', 'yacht-rental'),
			'description'	=> '',
			'font-family'	=> 'Raleway',
			'font-size' 	=> '1em',
			'font-weight'	=> '700',
			'font-style'	=> '',
			'line-height'	=> '1.786em',
			'margin-top'	=> '3.571em',
			'margin-bottom'	=> '1.786em'
			)
		);
		yacht_rental_add_custom_font('h6', array(
			'title'			=> esc_html__('Heading 6', 'yacht-rental'),
			'description'	=> '',
			'font-family'	=> 'Raleway',
			'font-size' 	=> '1em',
			'font-weight'	=> '500',
			'font-style'	=> '',
			'line-height'	=> '1.429em',
			'margin-top'	=> '2.143em',
			'margin-bottom'	=> '1.786em'
			)
		);
		yacht_rental_add_custom_font('p', array(
			'title'			=> esc_html__('Text', 'yacht-rental'),
			'description'	=> '',
			'font-family'	=> 'Raleway',
			'font-size' 	=> '14px',
			'font-weight'	=> '400',
			'font-style'	=> '',
			'line-height'	=> '2.071em',
			'margin-top'	=> '',
			'margin-bottom'	=> '1em'
			)
		);
		yacht_rental_add_custom_font('link', array(
			'title'			=> esc_html__('Links', 'yacht-rental'),
			'description'	=> '',
			'font-family'	=> '',
			'font-size' 	=> '',
			'font-weight'	=> '',
			'font-style'	=> ''
			)
		);
		yacht_rental_add_custom_font('info', array(
			'title'			=> esc_html__('Post info', 'yacht-rental'),
			'description'	=> '',
			'font-family'	=> '',
			'font-size' 	=> '',
			'font-weight'	=> '',
			'font-style'	=> '',
			'line-height'	=> '',
			'margin-top'	=> '',
			'margin-bottom'	=> ''
			)
		);
		yacht_rental_add_custom_font('menu', array(
			'title'			=> esc_html__('Main menu items', 'yacht-rental'),
			'description'	=> '',
			'font-family'	=> '',
			'font-size' 	=> '13px',
			'font-weight'	=> '500',
			'font-style'	=> '',
			'line-height'	=> '',
			'margin-top'	=> '',
			'margin-bottom'	=> ''
			)
		);
		yacht_rental_add_custom_font('submenu', array(
			'title'			=> esc_html__('Dropdown menu items', 'yacht-rental'),
			'description'	=> '',
			'font-family'	=> '',
			'font-size' 	=> '13px',
			'font-weight'	=> '',
			'font-style'	=> '',
			'line-height'	=> '1.923em',
			'margin-top'	=> '',
			'margin-bottom'	=> ''
			)
		);
		yacht_rental_add_custom_font('logo', array(
			'title'			=> esc_html__('Logo', 'yacht-rental'),
			'description'	=> '',
			'font-family'	=> 'Playfair Display',
			'font-size' 	=> '2.286em',
			'font-weight'	=> '700',
			'font-style'	=> '',
			'line-height'	=> '',
			'margin-top'	=> '',
			'margin-bottom'	=> ''
			)
		);
		yacht_rental_add_custom_font('button', array(
			'title'			=> esc_html__('Buttons', 'yacht-rental'),
			'description'	=> '',
			'font-family'	=> 'Raleway',
			'font-size' 	=> '0.786em',
			'font-weight'	=> '700',
			'font-style'	=> '',
			'line-height'	=> ''
			)
		);
		yacht_rental_add_custom_font('input', array(
			'title'			=> esc_html__('Input fields', 'yacht-rental'),
			'description'	=> '',
			'font-family'	=> 'Raleway',
			'font-size' 	=> '11px',
			'font-weight'	=> '',
			'font-style'	=> '',
			'line-height'	=> '16px'
			)
		);

	}
}





//------------------------------------------------------------------------------
// Theme fonts
//------------------------------------------------------------------------------

// Add theme fonts in the used fonts list
if (!function_exists('yacht_rental_filter_theme_styles_used_fonts')) {
	function yacht_rental_filter_theme_styles_used_fonts($theme_fonts) {
		$theme_fonts['montserrat'] = 1;
		$theme_fonts['Playfair Display'] = 1;
		return $theme_fonts;
	}
}

// Add theme fonts (from Google fonts) in the main fonts list (if not present).
// To use custom font-face you not need add it into list in this function
// How to install custom @font-face fonts into the theme?
// All @font-face fonts are located in "theme_name/css/font-face/" folder in the separate subfolders for the each font. Subfolder name is a font-family name!
// Place full set of the font files (for each font style and weight) and css-file named stylesheet.css in the each subfolder.
// Create your @font-face kit by using Fontsquirrel @font-face Generator (http://www.fontsquirrel.com/fontface/generator)
// and then extract the font kit (with folder in the kit) into the "theme_name/css/font-face" folder to install
if (!function_exists('yacht_rental_filter_theme_styles_list_fonts')) {
	function yacht_rental_filter_theme_styles_list_fonts($list) {
		 if (!isset($list['montserrat'])) {
				$list['montserrat'] = array(
					'family' => 'sans-serif',									// (required) font family
					'css'    => yacht_rental_get_file_url('/css/font-face/montserrat/stylesheet.css') // (optional) if you use custom font-face
					);
		 }
		if (!isset($list['Playfair Display'])) {
			$list['Playfair Display'] = array(
				'family' => 'serif',																						// (required) font family
				'link'   => 'Playfair+Display:400,400italic,700,700italic,900,900italic',	// (optional) if you use Google font repository	
				);
		}
		if (!isset($list['montserrat']))	$list['montserrat'] = array('family'=>'sans-serif');
		if (!isset($list['Playfair Display']))	$list['Playfair Display'] = array('family'=>'serif');
		return $list;
	}
}



//------------------------------------------------------------------------------
// Theme stylesheets
//------------------------------------------------------------------------------

// Add theme.less into list files for compilation
if (!function_exists('yacht_rental_filter_theme_styles_compile_less')) {
	function yacht_rental_filter_theme_styles_compile_less($files) {
		if (file_exists(yacht_rental_get_file_dir('css/theme.less'))) {
		 	$files[] = yacht_rental_get_file_dir('css/theme.less');
		}
		return $files;	
	}
}

// Add theme stylesheets
if (!function_exists('yacht_rental_action_theme_styles_add_styles')) {
	function yacht_rental_action_theme_styles_add_styles() {
		// Add stylesheet files only if LESS supported
		if ( yacht_rental_get_theme_setting('less_compiler') != 'no' ) {
			wp_enqueue_style( 'yacht-rental-theme-style', yacht_rental_get_file_url('css/theme.css'), array(), null );
			wp_add_inline_style( 'yacht-rental-theme-style', yacht_rental_get_inline_css() );
		}
	}
}

// Add theme inline styles
if (!function_exists('yacht_rental_filter_theme_styles_add_styles_inline')) {
	function yacht_rental_filter_theme_styles_add_styles_inline($custom_style) {
		// Submenu width
		$menu_width = yacht_rental_get_theme_option('menu_width');
		if (!empty($menu_width)) {
			$custom_style .= "
				/* Submenu width */
				.menu_side_nav > li ul,
				.menu_main_nav > li ul {
					width: ".intval($menu_width)."px;
				}
				.menu_side_nav > li > ul ul,
				.menu_main_nav > li > ul ul {
					left:".intval($menu_width+4)."px;
				}
				.menu_side_nav > li > ul ul.submenu_left,
				.menu_main_nav > li > ul ul.submenu_left {
					left:-".intval($menu_width+1)."px;
				}
			";
		}
	
		// Logo height
		$logo_height = yacht_rental_get_custom_option('logo_height');
		if (!empty($logo_height)) {
			$custom_style .= "
				/* Logo header height */
				.sidebar_outer_logo .logo_main,
				.top_panel_wrap .logo_main,
				.top_panel_wrap .logo_fixed {
					height:".intval($logo_height)."px;
				}
			";
		}
	
		// Logo top offset
		$logo_offset = yacht_rental_get_custom_option('logo_offset');
		if (!empty($logo_offset)) {
			$custom_style .= "
				/* Logo header top offset */
				.top_panel_wrap .logo {
					margin-top:".intval($logo_offset)."px;
				}
			";
		}

		// Logo footer height
		$logo_height = yacht_rental_get_theme_option('logo_footer_height');
		if (!empty($logo_height)) {
			$custom_style .= "
				/* Logo footer height */
				.contacts_wrap .logo img {
					height:".intval($logo_height)."px;
				}
			";
		}

		// Custom css from theme options
		$custom_style .= yacht_rental_get_custom_option('custom_css');

		return $custom_style;	
	}
}


//------------------------------------------------------------------------------
// Theme scripts
//------------------------------------------------------------------------------

// Add theme scripts
if (!function_exists('yacht_rental_action_theme_styles_add_scripts')) {
	function yacht_rental_action_theme_styles_add_scripts() {
		if (yacht_rental_get_theme_option('show_theme_customizer') == 'yes' && file_exists(yacht_rental_get_file_dir('js/theme.customizer.js')))
			wp_enqueue_script( 'yacht-rental-theme-styles-customizer-script', yacht_rental_get_file_url('js/theme.customizer.js'), array(), null );
	}
}

// Add theme scripts inline
if (!function_exists('yacht_rental_filter_theme_styles_localize_script')) {
	function yacht_rental_filter_theme_styles_localize_script($vars) {
		if (empty($vars['theme_font']))
			$vars['theme_font'] = yacht_rental_get_custom_font_settings('p', 'font-family');
		$vars['theme_color'] = yacht_rental_get_scheme_color('text_dark');
		$vars['theme_bg_color'] = yacht_rental_get_scheme_color('bg_color');
		return $vars;
	}
}
?>