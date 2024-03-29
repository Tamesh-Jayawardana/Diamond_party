<?php
/**
 * Yacht rental Framework: Theme specific actions
 *
 * @package	yacht_rental
 * @since	yacht_rental 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


/* Theme setup section
-------------------------------------------------------------------- */

// Default Theme Options
if ( !function_exists( 'yacht_rental_core_theme_setup1' ) ) {
	add_action( 'yacht_rental_action_before_init_theme', 'yacht_rental_core_theme_setup1', 1 );	// Priority 1 for add yacht_rental_filter handlers
	function yacht_rental_core_theme_setup1() {
		// Make theme available for translation
		// Translations can be filled in the /languages directory
		load_theme_textdomain( 'yacht-rental', yacht_rental_get_folder_dir('languages') );
	}
}


if ( !function_exists( 'yacht_rental_core_theme_setup' ) ) {
	add_action( 'yacht_rental_action_before_init_theme', 'yacht_rental_core_theme_setup', 11 );
	function yacht_rental_core_theme_setup() {
		
		// Editor custom stylesheet - for user
		add_editor_style(yacht_rental_get_file_url('css/editor-style.css'));


		/* Front and Admin actions and filters:
		------------------------------------------------------------------------ */

		if ( !is_admin() || wp_use_widgets_block_editor() ) {
			// Enqueue scripts and styles
			add_action('wp_enqueue_scripts', 				'yacht_rental_core_frontend_scripts');
			add_filter('yacht_rental_filter_localize_script',	'yacht_rental_core_localize_script');
		  }

		if ( !is_admin() ) {
			
			/* Front actions and filters:
			------------------------------------------------------------------------ */
	
			// Filters wp_title to print a neat <title> tag based on what is being viewed
			if (floatval(get_bloginfo('version')) < "4.1") {
				add_action('wp_head',						'yacht_rental_wp_title_show');
				add_filter('wp_title',						'yacht_rental_wp_title_modify', 10, 2);
			}

			// Prepare logo text
			add_filter('yacht_rental_filter_prepare_logo_text',	'yacht_rental_prepare_logo_text', 10, 1);
	
			// Add class "widget_number_#' for each widget
			add_filter('dynamic_sidebar_params', 			'yacht_rental_add_widget_number', 10, 1);
	
			// Enqueue scripts and styles

			add_action('wp_footer',		 					'yacht_rental_core_frontend_scripts_inline', 1);
			add_action('wp_footer',		 					'yacht_rental_core_frontend_add_js_vars', 2);
			add_action('yacht_rental_action_add_scripts_inline','yacht_rental_core_add_scripts_inline');


			// Prepare theme core global variables
			add_action('yacht_rental_action_prepare_globals',	'yacht_rental_core_prepare_globals');
		}

		// Frontend editor: Save post data
		add_action('wp_ajax_frontend_editor_save',		'yacht_rental_callback_frontend_editor_save');

		// Frontend editor: Delete post
		add_action('wp_ajax_frontend_editor_delete', 	'yacht_rental_callback_frontend_editor_delete');

		// Register theme specific nav menus
		yacht_rental_register_theme_menus();

		// Register theme specific sidebars
		yacht_rental_register_theme_sidebars();
	}
}


/* Theme init
------------------------------------------------------------------------ */

// Init theme template
function yacht_rental_core_init_theme() {
	if (yacht_rental_storage_get('theme_inited')===true) return;
	yacht_rental_storage_set('theme_inited', true);

	// Load custom options from GET and post/page/cat options
	if (isset($_GET['set']) && $_GET['set']==1) {
		foreach ($_GET as $k=>$v) {
			if (yacht_rental_get_theme_option($k, null) !== null) {
				setcookie($k, $v, 0, '/');
				$_COOKIE[$k] = $v;
			}
		}
	}

	// Get custom options from current category / page / post / shop / event
	yacht_rental_load_custom_options();

	// Fire init theme actions (after custom options are loaded)
	do_action('yacht_rental_action_init_theme');

	// Prepare theme core global variables
	do_action('yacht_rental_action_prepare_globals');

	// Fire after init theme actions
	do_action('yacht_rental_action_after_init_theme');
}


// Prepare theme global variables
if ( !function_exists( 'yacht_rental_core_prepare_globals' ) ) {
	function yacht_rental_core_prepare_globals() {
		if (!is_admin()) {
			// Logo text and slogan
			yacht_rental_storage_set('logo_text', apply_filters('yacht_rental_filter_prepare_logo_text', yacht_rental_get_custom_option('logo_text')));
			yacht_rental_storage_set('logo_slogan', get_bloginfo('description'));
			
			// Logo image and icons
			$logo        = yacht_rental_get_logo_icon('logo');
			$logo_side   = yacht_rental_get_logo_icon('logo_side');
			$logo_fixed  = yacht_rental_get_logo_icon('logo_fixed');
			$logo_footer = yacht_rental_get_logo_icon('logo_footer');
			yacht_rental_storage_set('logo', $logo);
			yacht_rental_storage_set('logo_icon',   yacht_rental_get_logo_icon('logo_icon'));
			yacht_rental_storage_set('logo_side',   $logo_side   ? $logo_side   : $logo);
			yacht_rental_storage_set('logo_fixed',  $logo_fixed  ? $logo_fixed  : $logo);
			yacht_rental_storage_set('logo_footer', $logo_footer ? $logo_footer : $logo);
	
			$shop_mode = '';
			if (yacht_rental_get_custom_option('show_mode_buttons')=='yes')
				$shop_mode = yacht_rental_get_value_gpc('yacht_rental_shop_mode');
			if (empty($shop_mode))
				$shop_mode = yacht_rental_get_custom_option('shop_mode', '');
			if (empty($shop_mode) || !is_archive())
				$shop_mode = 'thumbs';
			yacht_rental_storage_set('shop_mode', $shop_mode);
		}
	}
}


// Return url for the uploaded logo image
if ( !function_exists( 'yacht_rental_get_logo_icon' ) ) {
	function yacht_rental_get_logo_icon($slug) {
		// This way to load retina logo only if 'Retina' enabled in the Theme Options
		
		// This way ignore the 'Retina' setting and load retina logo on any display with retina support
		$mult = (int) yacht_rental_get_value_gpc('yacht_rental_retina', 0) > 0 ? 2 : 1;
		$logo_icon = '';
		if ($mult > 1) 			$logo_icon = yacht_rental_get_custom_option($slug.'_retina');
		if (empty($logo_icon))	$logo_icon = yacht_rental_get_custom_option($slug);
		return $logo_icon;
	}
}


// Display logo image with text and slogan (if specified)
if ( !function_exists( 'yacht_rental_show_logo' ) ) {
	function yacht_rental_show_logo($logo_main=true, $logo_fixed=false, $logo_footer=false, $logo_side=false, $logo_text=true, $logo_slogan=true) {
		if ($logo_main===true) 		$logo_main   = yacht_rental_storage_get('logo');
		if ($logo_fixed===true)		$logo_fixed  = yacht_rental_storage_get('logo_fixed');
		if ($logo_footer===true)	$logo_footer = yacht_rental_storage_get('logo_footer');
		if ($logo_side===true)		$logo_side   = yacht_rental_storage_get('logo_side');
		if ($logo_text===true)		$logo_text   = yacht_rental_storage_get('logo_text');
		if ($logo_slogan===true)	$logo_slogan = yacht_rental_storage_get('logo_slogan');
		if (empty($logo_main) && empty($logo_fixed) && empty($logo_footer) && empty($logo_side) && empty($logo_text))
			 $logo_text = get_bloginfo('name');
		if ($logo_main || $logo_fixed || $logo_footer || $logo_side || $logo_text) {
		?>
		<div class="logo">
			<a href="<?php echo esc_url(home_url('/')); ?>"><?php
				if (!empty($logo_main)) {
					$attr = yacht_rental_getimagesize($logo_main);
					echo '<img src="'.esc_url($logo_main).'" class="logo_main" alt="'.esc_attr__('img', 'yacht-rental').'"'.(!empty($attr[3]) ? ' '.trim($attr[3]) : '').'>';
				}
				if (!empty($logo_fixed)) {
					$attr = yacht_rental_getimagesize($logo_fixed);
					echo '<img src="'.esc_url($logo_fixed).'" class="logo_fixed" alt="'.esc_attr__('img', 'yacht-rental').'"'.(!empty($attr[3]) ? ' '.trim($attr[3]) : '').'>';
				}
				if (!empty($logo_footer)) {
					$attr = yacht_rental_getimagesize($logo_footer);
					echo '<img src="'.esc_url($logo_footer).'" class="logo_footer" alt="'.esc_attr__('img', 'yacht-rental').'"'.(!empty($attr[3]) ? ' '.trim($attr[3]) : '').'>';
				}
				if (!empty($logo_side)) {
					$attr = yacht_rental_getimagesize($logo_side);
					echo '<img src="'.esc_url($logo_side).'" class="logo_side" alt="'.esc_attr__('img', 'yacht-rental').'"'.(!empty($attr[3]) ? ' '.trim($attr[3]) : '').'>';
				}
				echo !empty($logo_text) ? '<div class="logo_text">'.trim($logo_text).'</div>' : '';
				echo !empty($logo_slogan) ? '<br><div class="logo_slogan">' . esc_html($logo_slogan) . '</div>' : '';
			?></a>
		</div>
		<?php 
		}
	} 
}


// Add menu locations
if ( !function_exists( 'yacht_rental_register_theme_menus' ) ) {
	function yacht_rental_register_theme_menus() {
		register_nav_menus(apply_filters('yacht_rental_filter_add_theme_menus', array(
			'menu_main'		=> esc_html__('Main Menu', 'yacht-rental'),
			'menu_user'		=> esc_html__('User Menu', 'yacht-rental'),
			'menu_footer'	=> esc_html__('Footer Menu', 'yacht-rental'),
			'menu_side'		=> esc_html__('Side Menu', 'yacht-rental')
		)));
	}
}


// Register widgetized area
if ( !function_exists( 'yacht_rental_register_theme_sidebars' ) ) {
    add_action('widgets_init', 'yacht_rental_register_theme_sidebars');
	function yacht_rental_register_theme_sidebars($sidebars=array()) {
		if (!is_array($sidebars)) $sidebars = array();
		// Custom sidebars
		$custom = yacht_rental_get_theme_option('custom_sidebars');
		if (is_array($custom) && count($custom) > 0) {
			foreach ($custom as $i => $sb) {
				if (trim(chop($sb))=='') continue;
				$sidebars['sidebar_custom_'.($i)]  = $sb;
			}
		}
		$sidebars = apply_filters( 'yacht_rental_filter_add_theme_sidebars', $sidebars );
        $registered = yacht_rental_storage_get('registered_sidebars');
        if (!is_array($registered)) $registered = array();
		if (is_array($sidebars) && count($sidebars) > 0) {
			foreach ($sidebars as $id=>$name) {
                if (isset($registered[$id])) continue;
                $registered[$id] = $name;
				register_sidebar( array_merge( array(
													'name'          => $name,
													'id'            => $id
												),
												yacht_rental_storage_get('widgets_args')
									)
				);
			}
		}
        yacht_rental_storage_set('registered_sidebars', $registered);
	}
}





/* Front actions and filters:
------------------------------------------------------------------------ */

//  Enqueue scripts and styles
if ( !function_exists( 'yacht_rental_core_frontend_scripts' ) ) {
	function yacht_rental_core_frontend_scripts() {
		
		// Modernizr will load in head before other scripts and styles
		// Use older version (from photostack)
		wp_enqueue_script( 'modernizr', yacht_rental_get_file_url('js/photostack/modernizr.min.js'), array(), null, false );
		
		// Enqueue styles
		//-----------------------------------------------------------------------------------------------------
		
		// Prepare custom fonts
	    if ( 'off' !== esc_html_x ( 'on', 'Google fonts: on or off', 'yacht-rental' ) ) {
			$fonts = yacht_rental_get_list_fonts(false);
			$theme_fonts = array();
			$custom_fonts = yacht_rental_get_custom_fonts();
			if (is_array($custom_fonts) && count($custom_fonts) > 0) {
				foreach ($custom_fonts as $s=>$f) {
					if (!empty($f['font-family']) && !yacht_rental_is_inherit_option($f['font-family'])) $theme_fonts[$f['font-family']] = 1;
				}
			}
			// Prepare current theme fonts
			$theme_fonts = apply_filters('yacht_rental_filter_used_fonts', $theme_fonts);
			// Link to selected fonts
			if (is_array($theme_fonts) && count($theme_fonts) > 0) {
				$google_fonts = '';
				foreach ($theme_fonts as $font=>$v) {
					if (isset($fonts[$font])) {
						$font_name = ($pos=yacht_rental_strpos($font,' ('))!==false ? yacht_rental_substr($font, 0, $pos) : $font;
						if (!empty($fonts[$font]['css'])) {
							$css = $fonts[$font]['css'];
							wp_enqueue_style( 'yacht-rental-font-'.str_replace(' ', '-', $font_name).'-style', $css, array(), null );
						} else {
							$google_fonts .= ($google_fonts ? '|' : '') // %7C = |
								. (!empty($fonts[$font]['link']) ? $fonts[$font]['link'] : str_replace(' ', '+', $font_name).':300,300italic,400,400italic,700,700italic');
						}
					}
				}
				if ($google_fonts) {
                    /*
                Translators: If there are characters in your language that are not supported
                by chosen font(s), translate this to 'off'. Do not translate into your own language.
                */
                    $google_fonts_enabled = ( 'off' !== esc_html_x ( 'on', 'Google fonts: on or off', 'yacht-rental' ) );
                    if ( $google_fonts_enabled ) {
                        wp_enqueue_style( 'yacht-rental-font-google-fonts-style', add_query_arg( 'family', $google_fonts . '&subset=' . yacht_rental_get_theme_option('fonts_subset'), "//fonts.googleapis.com/css" ), array(), null );

                    }
				}
			}
		}
		
		// Fontello styles must be loaded before main stylesheet
		wp_enqueue_style( 'fontello-style',  yacht_rental_get_file_url('css/fontello/css/fontello.css'),  array(), null);

		// Main stylesheet
		wp_enqueue_style( 'yacht-rental-main-style', get_stylesheet_uri(), array(), null );
		
		// Animations
		if (yacht_rental_get_theme_option('css_animation')=='yes' && (yacht_rental_get_theme_option('animation_on_mobile')=='yes' || !wp_is_mobile()) && !yacht_rental_vc_is_frontend())
			wp_enqueue_style( 'yacht-rental-animation-style',	yacht_rental_get_file_url('css/core.animation.css'), array(), null );

		// Theme stylesheets
		do_action('yacht_rental_action_add_styles');

		// Responsive
		if (yacht_rental_get_theme_option('responsive_layouts') == 'yes') {
			$suffix = yacht_rental_param_is_off(yacht_rental_get_custom_option('show_sidebar_outer')) ? '' : '-outer';
			wp_enqueue_style( 'yacht-rental-responsive-style', yacht_rental_get_file_url('css/responsive'.($suffix).'.css'), array(), null );
			do_action('yacht_rental_action_add_responsive');
			$css = apply_filters('yacht_rental_filter_add_responsive_inline', '');
			if (!empty($css)) wp_add_inline_style( 'yacht-rental-responsive-style', $css );
		}

		// Disable loading JQuery UI CSS
		wp_deregister_style('jquery_ui');
		wp_deregister_style('date-picker-css');


		// Enqueue scripts	
		//----------------------------------------------------------------------------------------------------------------------------
		
		// Load separate theme scripts
		wp_enqueue_script( 'superfish', yacht_rental_get_file_url('js/superfish.js'), array('jquery'), null, true );
		if (in_array(yacht_rental_get_theme_option('menu_hover'), array('slide_line', 'slide_box'))) {
			wp_enqueue_script( 'slidemenu-script', yacht_rental_get_file_url('js/jquery.slidemenu.js'), array('jquery'), null, true );
		}


		wp_enqueue_script( 'yacht-rental-core-utils-script',	yacht_rental_get_file_url('js/core.utils.js'), array('jquery'), null, true );
		wp_enqueue_script( 'yacht-rental-core-init-script',	yacht_rental_get_file_url('js/core.init.js'), array('jquery'), null, true );
		wp_enqueue_script( 'jquery-ui-theme',	yacht_rental_get_file_url('js/jquery-ui.min.js'), array('jquery'), null, true );
		wp_enqueue_script( 'yacht-rental-theme-init-script',	yacht_rental_get_file_url('js/theme.init.js'), array('jquery'), null, true );

		// Media elements library	
		if (yacht_rental_get_theme_option('use_mediaelement')=='yes') {
			wp_enqueue_style ( 'mediaelement' );
			wp_enqueue_style ( 'wp-mediaelement' );
			wp_enqueue_script( 'mediaelement' );
			wp_enqueue_script( 'wp-mediaelement' );
		}
		
		// Video background
		if (yacht_rental_get_custom_option('show_video_bg') == 'yes' && yacht_rental_get_custom_option('video_bg_youtube_code') != '') {
			wp_enqueue_script( 'video-bg-script', yacht_rental_get_file_url('js/jquery.tubular.js'), array('jquery'), null, true );
		}

			
		// Social share buttons
		if (is_singular() && !yacht_rental_storage_get('blog_streampage') && yacht_rental_get_custom_option('show_share')!='hide') {
			wp_enqueue_script( 'yacht-rental-social-share-script', yacht_rental_get_file_url('js/social/social-share.js'), array('jquery'), null, true );
		}

		// Comments
		if ( is_singular() && !yacht_rental_storage_get('blog_streampage') && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply', false, array(), null, true );
		}

		// Custom panel
		if (yacht_rental_get_theme_option('show_theme_customizer') == 'yes') {
			if (file_exists(yacht_rental_get_file_dir('core/core.customizer/front.customizer.css')))
				wp_enqueue_style(  'yacht-rental-customizer-style',  yacht_rental_get_file_url('core/core.customizer/front.customizer.css'), array(), null );
			if (file_exists(yacht_rental_get_file_dir('core/core.customizer/front.customizer.js')))
				wp_enqueue_script( 'yacht-rental-customizer-script', yacht_rental_get_file_url('core/core.customizer/front.customizer.js'), array(), null, true );
		}
		
		//Debug utils
		if (yacht_rental_get_theme_option('debug_mode')=='yes') {
			wp_enqueue_script( 'yacht-rental-core-debug-script', yacht_rental_get_file_url('js/core.debug.js'), array(), null, true );
		}

		// Theme scripts
		do_action('yacht_rental_action_add_scripts');
	}
}

//  Enqueue Swiper Slider scripts and styles
if ( !function_exists( 'yacht_rental_enqueue_slider' ) ) {
	function yacht_rental_enqueue_slider($engine='all') {
		if ($engine=='all' || $engine=='swiper') {
			wp_enqueue_style(  'swiperslider-style', 			yacht_rental_get_file_url('js/swiper/swiper.css'), array(), null );
			// jQuery version of Swiper conflict with Revolution Slider!!! Use DOM version
			wp_enqueue_script( 'swiperslider-script', 			yacht_rental_get_file_url('js/swiper/swiper.js'), array(), null, true );
		}
	}
}

//  Enqueue Photostack gallery
if ( !function_exists( 'yacht_rental_enqueue_polaroid' ) ) {
	function yacht_rental_enqueue_polaroid() {
		wp_enqueue_style(  'polaroid-style', 	yacht_rental_get_file_url('js/photostack/component.css'), array(), null );
		wp_enqueue_script( 'classie-script',		yacht_rental_get_file_url('js/photostack/classie.js'), array(), null, true );
		wp_enqueue_script( 'polaroid-script',	yacht_rental_get_file_url('js/photostack/photostack.js'), array(), null, true );
	}
}

//  Enqueue Messages scripts and styles
if ( !function_exists( 'yacht_rental_enqueue_messages' ) ) {
	function yacht_rental_enqueue_messages() {
		wp_enqueue_style(  'yacht-rental-messages-style',		yacht_rental_get_file_url('js/core.messages/core.messages.css'), array(), null );
		wp_enqueue_script( 'yacht-rental-messages-script',	yacht_rental_get_file_url('js/core.messages/core.messages.js'),  array('jquery'), null, true );
	}
}

//  Enqueue Portfolio hover scripts and styles
if ( !function_exists( 'yacht_rental_enqueue_portfolio' ) ) {
	function yacht_rental_enqueue_portfolio($hover='') {
		wp_enqueue_style( 'yacht-rental-portfolio-style',  yacht_rental_get_file_url('css/core.portfolio.css'), array(), null );
		if (yacht_rental_strpos($hover, 'effect_dir')!==false)
			wp_enqueue_script( 'hoverdir', yacht_rental_get_file_url('js/hover/jquery.hoverdir.js'), array(), null, true );
	}
}

//  Enqueue Charts and Diagrams scripts and styles
if ( !function_exists( 'yacht_rental_enqueue_diagram' ) ) {
	function yacht_rental_enqueue_diagram($type='all') {
		if ($type=='all' || $type=='pie') wp_enqueue_script( 'diagram-chart-script-theme',	yacht_rental_get_file_url('js/diagram/chart.min.js'), array(), null, true );
		if ($type=='all' || $type=='arc') wp_enqueue_script( 'diagram-raphael-script-theme',	yacht_rental_get_file_url('js/diagram/diagram.raphael.min.js'), array(), 'no-compose', true );
	}
}

// Enqueue Theme Popup scripts and styles
// Link must have attribute: data-rel="popup" or data-rel="popup[gallery]"
if ( !function_exists( 'yacht_rental_enqueue_popup' ) ) {
	function yacht_rental_enqueue_popup($engine='') {
		if ($engine=='pretty' || (empty($engine) && yacht_rental_get_theme_option('popup_engine')=='pretty')) {
			wp_enqueue_style(  'prettyphoto-style',	yacht_rental_get_file_url('js/prettyphoto/css/prettyPhoto.css'), array(), null );
			wp_enqueue_script( 'prettyphoto-script',	yacht_rental_get_file_url('js/prettyphoto/jquery.prettyPhoto.min.js'), array('jquery'), 'no-compose', true );
		} else if ($engine=='magnific' || (empty($engine) && yacht_rental_get_theme_option('popup_engine')=='magnific')) {
			wp_enqueue_style(  'magnific-style',	yacht_rental_get_file_url('js/magnific/magnific-popup.css'), array(), null );
			wp_enqueue_script( 'magnific-script-theme',yacht_rental_get_file_url('js/magnific/jquery.magnific-popup.min.js'), array('jquery'), '', true );
		} else if ($engine=='internal' || (empty($engine) && yacht_rental_get_theme_option('popup_engine')=='internal')) {
			yacht_rental_enqueue_messages();
		}
	}
}

//  Add inline scripts in the footer hook
if ( !function_exists( 'yacht_rental_core_frontend_scripts_inline' ) ) {
	function yacht_rental_core_frontend_scripts_inline() {
		do_action('yacht_rental_action_add_scripts_inline');
	}
}

//  Localize scripts in the footer hook
if ( !function_exists( 'yacht_rental_core_frontend_add_js_vars' ) ) {
	function yacht_rental_core_frontend_add_js_vars() {
		$vars = apply_filters( 'yacht_rental_filter_localize_script', yacht_rental_storage_empty('js_vars') ? array() : yacht_rental_storage_get('js_vars'));
		if (!empty($vars)) wp_localize_script( 'yacht-rental-core-init-script', 'YACHT_RENTAL_STORAGE', $vars);
	}
}


//  Add property="stylesheet" into all tags <link> in the footer
if (!function_exists('yacht_rental_core_add_property_to_link')) {
	function yacht_rental_core_add_property_to_link($link, $handle='', $href='') {
		return str_replace('<link ', '<link property="stylesheet" ', $link);
	}
}

//  Add inline scripts in the footer
if (!function_exists('yacht_rental_core_add_scripts_inline')) {
	function yacht_rental_core_add_scripts_inline() {
		// System message
		$msg = yacht_rental_get_system_message(true); 
		if (!empty($msg['message'])) yacht_rental_enqueue_messages();
		yacht_rental_storage_set_array('js_vars', 'system_message',	$msg);
	}
}

//  Localize script
if (!function_exists('yacht_rental_core_localize_script')) {
	function yacht_rental_core_localize_script($vars) {

		// AJAX parameters
		$vars['ajax_url'] = esc_url(admin_url('admin-ajax.php'));
		$vars['ajax_nonce'] = wp_create_nonce(admin_url('admin-ajax.php'));

		// Site base url
		$vars['site_url'] = esc_url(get_site_url());

		// Site protocol
		$vars['site_protocol'] = yacht_rental_get_protocol();
			
		// VC frontend edit mode
		$vars['vc_edit_mode'] = function_exists('yacht_rental_vc_is_frontend') && yacht_rental_vc_is_frontend();
			
		// Theme base font
		$vars['theme_font'] = yacht_rental_get_custom_font_settings('p', 'font-family');
			
		// Theme colors
		$vars['theme_color'] = yacht_rental_get_scheme_color('text_dark');
		$vars['theme_bg_color'] = yacht_rental_get_scheme_color('bg_color');
		$vars['accent1_color'] = yacht_rental_get_scheme_color('text_link');
		$vars['accent1_hover'] = yacht_rental_get_scheme_color('text_hover');
			
		// Slider height
		$vars['slider_height'] = max(100, yacht_rental_get_custom_option('slider_height'));
			
		// User logged in
		$vars['user_logged_in'] = is_user_logged_in();
			
		// Show table of content for the current page
		$vars['toc_menu'] = yacht_rental_get_custom_option('menu_toc');
		$vars['toc_menu_home'] = yacht_rental_get_custom_option('menu_toc')!='hide' && yacht_rental_get_custom_option('menu_toc_home')=='yes';
		$vars['toc_menu_top'] = yacht_rental_get_custom_option('menu_toc')!='hide' && yacht_rental_get_custom_option('menu_toc_top')=='yes';

		// Fix main menu
		$vars['menu_fixed'] = yacht_rental_get_theme_option('menu_attachment')=='fixed';
			
		// Use responsive version for main menu
		$vars['menu_mobile'] = yacht_rental_get_theme_option('responsive_layouts') == 'yes' ? max(0, (int) yacht_rental_get_theme_option('menu_mobile')) : 0;
		$vars['menu_hover'] = yacht_rental_get_theme_option('menu_hover');
			
		// Menu cache is used
		$vars['menu_cache'] = yacht_rental_get_theme_option('use_menu_cache')=='yes';

		// Theme's buttons hover
		$vars['button_hover'] = yacht_rental_get_theme_option('button_hover');

		// Theme's form fields style
		$vars['input_hover'] = yacht_rental_get_theme_option('input_hover');

		// Right panel demo timer
		$vars['demo_time'] = yacht_rental_get_theme_option('show_theme_customizer')=='yes' ? max(0, (int) yacht_rental_get_theme_option('customizer_demo')) : 0;

		// Video and Audio tag wrapper
		$vars['media_elements_enabled'] = yacht_rental_get_theme_option('use_mediaelement')=='yes';
			
		// Use AJAX search
		$vars['ajax_search_enabled'] = yacht_rental_get_theme_option('use_ajax_search')=='yes';
		$vars['ajax_search_min_length'] = min(3, yacht_rental_get_theme_option('ajax_search_min_length'));
		$vars['ajax_search_delay'] = min(200, max(1000, yacht_rental_get_theme_option('ajax_search_delay')));

		// Use CSS animation
		$vars['css_animation'] = yacht_rental_get_theme_option('css_animation')=='yes';
		$vars['menu_animation_in'] = yacht_rental_get_theme_option('menu_animation_in');
		$vars['menu_animation_out'] = yacht_rental_get_theme_option('menu_animation_out');

		// Popup windows engine
		$vars['popup_engine'] = yacht_rental_get_theme_option('popup_engine');

		// E-mail mask
		$vars['email_mask'] = '^([a-zA-Z0-9_\\-]+\\.)*[a-zA-Z0-9_\\-]+@[a-z0-9_\\-]+(\\.[a-z0-9_\\-]+)*\\.[a-z]{2,6}$';
			
		// Messages max length
		$vars['contacts_maxlength'] = yacht_rental_get_theme_option('message_maxlength_contacts');
		$vars['comments_maxlength'] = yacht_rental_get_theme_option('message_maxlength_comments');

		// Remember visitors settings
		$vars['remember_visitors_settings'] = yacht_rental_get_theme_option('remember_visitors_settings')=='yes';

		// Internal vars - do not change it!
		// Flag for review mechanism
		$vars['admin_mode'] = false;
		// Max scale factor for the portfolio and other isotope elements before relayout
		$vars['isotope_resize_delta'] = 0.3;
		// jQuery object for the message box in the form
		$vars['error_message_box'] = null;
		// Waiting for the viewmore results
		$vars['viewmore_busy'] = false;
		$vars['video_resize_inited'] = false;
		$vars['top_panel_height'] = 0;

		return $vars;
	}
}

// Show content with the html layout (if not empty)
if ( !function_exists('yacht_rental_show_layout') ) {
	function yacht_rental_show_layout($str, $before='', $after='') {
		if ($str != '') {
			printf("%s%s%s", $before, $str, $after);
		}
	}
}

// Add class "widget_number_#' for each widget
if ( !function_exists( 'yacht_rental_add_widget_number' ) ) {
	function yacht_rental_add_widget_number($prm) {
		if (is_admin()) return $prm;
		static $num=0, $last_sidebar='', $last_sidebar_id='', $last_sidebar_columns=0, $last_sidebar_count=0, $sidebars_widgets=array();
		$cur_sidebar = yacht_rental_storage_get('current_sidebar');
		if (empty($cur_sidebar)) $cur_sidebar = 'undefined';
		if (count($sidebars_widgets) == 0)
			$sidebars_widgets = wp_get_sidebars_widgets();
		if ($last_sidebar != $cur_sidebar) {
			$num = 0;
			$last_sidebar = $cur_sidebar;
			$last_sidebar_id = $prm[0]['id'];
			$last_sidebar_columns = max(1, (int) yacht_rental_get_custom_option('sidebar_'.($cur_sidebar).'_columns'));
			$last_sidebar_count = count($sidebars_widgets[$last_sidebar_id]);
		}
		$num++;
		$prm[0]['before_widget'] = str_replace(' class="', ' class="widget_number_'.esc_attr($num).($last_sidebar_columns > 1 ? ' column-1_'.esc_attr($last_sidebar_columns) : '').' ', $prm[0]['before_widget']);
		return $prm;
	}
}


// Show <title> tag under old WP (version < 4.1)
if ( !function_exists( 'yacht_rental_wp_title_show' ) ) {
	function yacht_rental_wp_title_show() {
		?><title><?php wp_title( '|', true, 'right' ); ?></title><?php
	}
}

// Filters wp_title to print a neat <title> tag based on what is being viewed.
if ( !function_exists( 'yacht_rental_wp_title_modify' ) ) {
	function yacht_rental_wp_title_modify( $title, $sep ) {
		global $page, $paged;
		if ( is_feed() ) return $title;
		// Add the blog name
		$title .= get_bloginfo( 'name' );
		// Add the blog description for the home/front page.
		if ( is_home() || is_front_page() ) {
			$site_description = get_bloginfo( 'description', 'display' );
			if ( $site_description )
				$title .= " $sep $site_description";
		}
		// Add a page number if necessary:
		if ( $paged >= 2 || $page >= 2 )
			$title .= " $sep " . sprintf( esc_html__( 'Page %s', 'yacht-rental' ), max( $paged, $page ) );
		return $title;
	}
}

// Add main menu classes
if ( !function_exists( 'yacht_rental_add_mainmenu_classes' ) ) {
	function yacht_rental_add_mainmenu_classes($items, $args) {
		if (is_admin()) return $items;
		if ($args->menu_id == 'mainmenu' && yacht_rental_get_theme_option('menu_colored')=='yes' && is_array($items) && count($items) > 0) {
			foreach($items as $k=>$item) {
				if ($item->menu_item_parent==0) {
					if ($item->type=='taxonomy' && $item->object=='category') {
						$cur_tint = yacht_rental_taxonomy_get_inherited_property('category', $item->object_id, 'bg_tint');
						if (!empty($cur_tint) && !yacht_rental_is_inherit_option($cur_tint))
							$items[$k]->classes[] = 'bg_tint_'.esc_attr($cur_tint);
					}
				}
			}
		}
		return $items;
	}
}


// Save post data from frontend editor
if ( !function_exists( 'yacht_rental_callback_frontend_editor_save' ) ) {
	function yacht_rental_callback_frontend_editor_save() {

		if ( !wp_verify_nonce( yacht_rental_get_value_gp('nonce'), admin_url('admin-ajax.php') ) )
			wp_die();
		$response = array('error'=>'');

        parse_str(yacht_rental_get_value_gp('data'), $output);
		$post_id = $output['frontend_editor_post_id'];

		if ( yacht_rental_get_theme_option("allow_editor")=='yes' && (current_user_can('edit_posts', $post_id) || current_user_can('edit_pages', $post_id)) ) {
			if ($post_id > 0) {
				$title   = stripslashes($output['frontend_editor_post_title']);
				$content = stripslashes($output['frontend_editor_post_content']);
				$excerpt = stripslashes($output['frontend_editor_post_excerpt']);
				$rez = wp_update_post(array(
					'ID'           => $post_id,
					'post_content' => $content,
					'post_excerpt' => $excerpt,
					'post_title'   => $title
				));
				if ($rez == 0) 
					$response['error'] = esc_html__('Post update error!', 'yacht-rental');
			} else {
				$response['error'] = esc_html__('Post update error!', 'yacht-rental');
			}
		} else
			$response['error'] = esc_html__('Post update denied!', 'yacht-rental');
		
		echo json_encode($response);
		wp_die();
	}
}

// Delete post from frontend editor
if ( !function_exists( 'yacht_rental_callback_frontend_editor_delete' ) ) {
	function yacht_rental_callback_frontend_editor_delete() {

		if ( !wp_verify_nonce( yacht_rental_get_value_gp('nonce'), admin_url('admin-ajax.php') ) )
			wp_die();

		$response = array('error'=>'');
		
		$post_id = sanitize_text_field($_REQUEST['post_id']);

		if ( yacht_rental_get_theme_option("allow_editor")=='yes' && (current_user_can('delete_posts', $post_id) || current_user_can('delete_pages', $post_id)) ) {
			if ($post_id > 0) {
				$rez = wp_delete_post($post_id);
				if ($rez === false) 
					$response['error'] = esc_html__('Post delete error!', 'yacht-rental');
			} else {
				$response['error'] = esc_html__('Post delete error!', 'yacht-rental');
			}
		} else
			$response['error'] = esc_html__('Post delete denied!', 'yacht-rental');

		echo json_encode($response);
		wp_die();
	}
}


// Prepare logo text
if ( !function_exists( 'yacht_rental_prepare_logo_text' ) ) {
	function yacht_rental_prepare_logo_text($text) {
		$text = str_replace(array('[', ']'), array('<span class="theme_accent">', '</span>'), $text);
		$text = str_replace(array('{', '}'), array('<strong>', '</strong>'), $text);
		return $text;
	}
}
?>