<?php

/* Theme setup section
-------------------------------------------------------------------- */

// ONLY FOR PROGRAMMERS, NOT FOR CUSTOMER
// Framework settings

yacht_rental_storage_set('settings', array(
	
	'less_compiler'		=> 'no',								// no|lessc|less|external - Compiler for the .less
																// lessc	- fast & low memory required, but .less-map, shadows & gradients not supprted
																// less		- slow, but support all features
																// external	- used if you have external .less compiler (like WinLess or Koala)
																// no		- don't use .less, all styles stored in the theme.styles.php
	'less_nested'		=> false,								// Use nested selectors when compiling less - increase .css size, but allow using nested color schemes
	'less_prefix'		=> '',									// any string - Use prefix before each selector when compile less. For example: 'html '
	'less_split'		=> false,								// If true - load each file into memory, split it (see below) and compile separate.
																// Else - compile each file without loading to memory
	'less_separator'	=> '/*---LESS_SEPARATOR---*/',			// string - separator inside .less file to split it when compiling to reduce memory usage
																// (compilation speed gets a bit slow)
	'less_map'			=> 'no',								// no|internal|external - Generate map for .less files. 
																// Warning! You need more then 128Mb for PHP scripts on your server! Supported only if less_compiler=less (see above)
	
	'customizer_demo'	=> true,								// Show color customizer demo (if many color settings) or not (if only accent colors used)

	'allow_fullscreen'	=> false,								// Allow fullscreen and fullwide body styles

	'socials_type'		=> 'icons',								// images|icons - Use this kind of pictograms for all socials: share, social profiles, team members socials, etc.
	'slides_type'		=> 'bg',								// images|bg - Use image as slide's content or as slide's background

	'add_image_size'	=> false,								// Add theme's thumb sizes into WP list sizes. 
																// If false - new image thumb will be generated on demand,
																// otherwise - all thumb sizes will be generated when image is loaded

	'use_list_cache'	=> true,								// Use cache for any lists (increase theme speed, but get 15-20K memory)
	'use_post_cache'	=> true,								// Use cache for post_data (increase theme speed, decrease queries number, but get more memory - up to 300K)

	'admin_dummy_style' => 2									// 1 | 2 - Progress bar style when import dummy data
	)
);



// Default Theme Options
if ( !function_exists( 'yacht_rental_options_settings_theme_setup' ) ) {
	add_action( 'yacht_rental_action_before_init_theme', 'yacht_rental_options_settings_theme_setup', 2 );	// Priority 1 for add yacht_rental_filter handlers
	function yacht_rental_options_settings_theme_setup() {
		
		// Clear all saved Theme Options on first theme run
		add_action('after_switch_theme', 'yacht_rental_options_reset');

		// Settings 
		$socials_type = yacht_rental_get_theme_setting('socials_type');
				
		// Prepare arrays 
		yacht_rental_storage_set('options_params', apply_filters('yacht_rental_filter_theme_options_params', array(
			'list_fonts'				=> array('$yacht_rental_get_list_fonts' => ''),
			'list_fonts_styles'			=> array('$yacht_rental_get_list_fonts_styles' => ''),
			'list_socials' 				=> array('$yacht_rental_get_list_socials' => ''),
			'list_icons' 				=> array('$yacht_rental_get_list_icons(true)' => ''),
			'list_posts_types' 			=> array('$yacht_rental_get_list_posts_types' => ''),
			'list_categories' 			=> array('$yacht_rental_get_list_categories' => ''),
			'list_menus'				=> array('$yacht_rental_get_list_menus(true)' => ''),
			'list_sidebars'				=> array('$yacht_rental_get_list_sidebars' => ''),
			'list_positions' 			=> array('$yacht_rental_get_list_sidebars_positions' => ''),
			'list_color_schemes'		=> array('$yacht_rental_get_list_color_schemes' => ''),
			'list_bg_tints'				=> array('$yacht_rental_get_list_bg_tints' => ''),
			'list_body_styles'			=> array('$yacht_rental_get_list_body_styles' => ''),
			'list_header_styles'		=> array('$yacht_rental_get_list_templates_header' => ''),
			'list_blog_styles'			=> array('$yacht_rental_get_list_templates_blog' => ''),
			'list_single_styles'		=> array('$yacht_rental_get_list_templates_single' => ''),
			'list_article_styles'		=> array('$yacht_rental_get_list_article_styles' => ''),
			'list_blog_counters' 		=> array('$yacht_rental_get_list_blog_counters' => ''),
			'list_menu_hovers' 			=> array('$yacht_rental_get_list_menu_hovers' => ''),
			'list_button_hovers'		=> array('$yacht_rental_get_list_button_hovers' => ''),
			'list_input_hovers'			=> array('$yacht_rental_get_list_input_hovers' => ''),
			'list_search_styles'		=> array('$yacht_rental_get_list_search_styles' => ''),
			'list_animations_in' 		=> array('$yacht_rental_get_list_animations_in' => ''),
			'list_animations_out'		=> array('$yacht_rental_get_list_animations_out' => ''),
			'list_filters'				=> array('$yacht_rental_get_list_portfolio_filters' => ''),
			'list_hovers'				=> array('$yacht_rental_get_list_hovers' => ''),
			'list_hovers_dir'			=> array('$yacht_rental_get_list_hovers_directions' => ''),
			'list_alter_sizes'			=> array('$yacht_rental_get_list_alter_sizes' => ''),
			'list_sliders' 				=> array('$yacht_rental_get_list_sliders' => ''),
			'list_bg_image_positions'	=> array('$yacht_rental_get_list_bg_image_positions' => ''),
			'list_popups' 				=> array('$yacht_rental_get_list_popup_engines' => ''),
			'list_gmap_styles'		 	=> array('$yacht_rental_get_list_googlemap_styles' => ''),
			'list_yes_no' 				=> array('$yacht_rental_get_list_yesno' => ''),
			'list_on_off' 				=> array('$yacht_rental_get_list_onoff' => ''),
			'list_show_hide' 			=> array('$yacht_rental_get_list_showhide' => ''),
			'list_sorting' 				=> array('$yacht_rental_get_list_sortings' => ''),
			'list_ordering' 			=> array('$yacht_rental_get_list_orderings' => ''),
			'list_locations' 			=> array('$yacht_rental_get_list_dedicated_locations' => '')
			)
		));


		// Theme options array
        yacht_rental_storage_set('options', apply_filters('yacht_rental_filter_options', array(



                //###############################
		//#### Customization         #### 
		//###############################
		'partition_customization' => array(
					"title" => esc_html__('Customization', 'yacht-rental'),
					"start" => "partitions",
					"override" => "category,services_group,post,page,custom",
					"icon" => "iconadmin-cog-alt",
					"type" => "partition"
					),
		
		
		// Customization -> Body Style
		//-------------------------------------------------
		
		'customization_body' => array(
					"title" => esc_html__('Body style', 'yacht-rental'),
					"override" => "category,services_group,post,page,custom",
					"icon" => 'iconadmin-picture',
					"start" => "customization_tabs",
					"type" => "tab"
					),
		
		'info_body_1' => array(
					"title" => esc_html__('Body parameters', 'yacht-rental'),
					"desc" => wp_kses_data( __('Select body style and color scheme for entire site. You can override this parameters on any page, post or category', 'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"type" => "info"
					),

		'body_style' => array(
					"title" => esc_html__('Body style', 'yacht-rental'),
					"desc" => wp_kses_data( __('Select body style:', 'yacht-rental') )
								. ' <br>' 
								. wp_kses_data( __('<b>boxed</b> - if you want use background color and/or image', 'yacht-rental') )
								. ',<br>'
								. wp_kses_data( __('<b>wide</b> - page fill whole window with centered content', 'yacht-rental') )
								. (yacht_rental_get_theme_setting('allow_fullscreen') 
									? ',<br>' . wp_kses_data( __('<b>fullwide</b> - page content stretched on the full width of the window (with few left and right paddings)', 'yacht-rental') )
									: '')
								. (yacht_rental_get_theme_setting('allow_fullscreen') 
									? ',<br>' . wp_kses_data( __('<b>fullscreen</b> - page content fill whole window without any paddings', 'yacht-rental') )
									: ''),
					"info" => true,
					"override" => "category,services_group,post,page,custom",
					"std" => "wide",
					"options" => yacht_rental_get_options_param('list_body_styles'),
					"dir" => "horizontal",
					"type" => "radio"
					),
			
		'body_paddings' => array(
					"title" => esc_html__('Page paddings', 'yacht-rental'),
					"desc" => wp_kses_data( __('Add paddings above and below the page content', 'yacht-rental') ),
					"override" => "post,page,custom",
					"std" => "yes",
					"options" => array(
						"no"=>esc_html__("No", 'yacht-rental'),
						"yes"=>esc_html__("Yes", 'yacht-rental'),
						"top"=>esc_html__("Top", 'yacht-rental'),
						"bottom"=>esc_html__("Bottom", 'yacht-rental'),
					),
					"type" => "radio",
					),
			

		"body_scheme" => array(
					"title" => esc_html__('Color scheme', 'yacht-rental'),
					"desc" => wp_kses_data( __('Select predefined color scheme for the entire page', 'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "original",
					"dir" => "horizontal",
					"options" => yacht_rental_get_options_param('list_color_schemes'),
					"type" => "checklist"),
		
		'body_filled' => array(
					"title" => esc_html__('Fill body', 'yacht-rental'),
					"desc" => wp_kses_data( __('Fill the page background with the solid color or leave it transparend to show background image (or video background)', 'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "yes",
					"options" => yacht_rental_get_options_param('list_yes_no'),
					"type" => "switch"
					),

		'info_body_2' => array(
					"title" => esc_html__('Background color and image', 'yacht-rental'),
					"desc" => wp_kses_data( __('Color and image for the site background', 'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"type" => "info"
					),

		'bg_custom' => array(
					"title" => esc_html__('Use custom background',  'yacht-rental'),
					"desc" => wp_kses_data( __("Use custom color and/or image as the site background", 'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "no",
					"options" => yacht_rental_get_options_param('list_yes_no'),
					"type" => "switch"
					),
		
		'bg_color' => array(
					"title" => esc_html__('Background color',  'yacht-rental'),
					"desc" => wp_kses_data( __('Body background color',  'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'bg_custom' => array('yes')
					),
					"std" => "#ffffff",
					"type" => "color"
					),

		'bg_pattern' => array(
					"title" => esc_html__('Background predefined pattern',  'yacht-rental'),
					"desc" => wp_kses_data( __('Select theme background pattern (first case - without pattern)',  'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'bg_custom' => array('yes')
					),
					"std" => "",
					"options" => array(
						0 => yacht_rental_get_file_url('images/spacer.png'),
						1 => yacht_rental_get_file_url('images/bg/pattern_1.jpg'),
						2 => yacht_rental_get_file_url('images/bg/pattern_2.jpg'),
						3 => yacht_rental_get_file_url('images/bg/pattern_3.jpg'),
						4 => yacht_rental_get_file_url('images/bg/pattern_4.jpg'),
						5 => yacht_rental_get_file_url('images/bg/pattern_5.jpg')
					),
					"style" => "list",
					"type" => "images"
					),
		
		'bg_pattern_custom' => array(
					"title" => esc_html__('Background custom pattern',  'yacht-rental'),
					"desc" => wp_kses_data( __('Select or upload background custom pattern. If selected - use it instead the theme predefined pattern (selected in the field above)',  'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'bg_custom' => array('yes')
					),
					"std" => "",
					"type" => "media"
					),
		
		'bg_image' => array(
					"title" => esc_html__('Background predefined image',  'yacht-rental'),
					"desc" => wp_kses_data( __('Select theme background image (first case - without image)',  'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "",
					"dependency" => array(
						'bg_custom' => array('yes')
					),
					"options" => array(
						0 => yacht_rental_get_file_url('images/spacer.png'),
						1 => yacht_rental_get_file_url('images/bg/image_1_thumb.jpg'),
						2 => yacht_rental_get_file_url('images/bg/image_2_thumb.jpg'),
						3 => yacht_rental_get_file_url('images/bg/image_3_thumb.jpg')
					),
					"style" => "list",
					"type" => "images"
					),
		
		'bg_image_custom' => array(
					"title" => esc_html__('Background custom image',  'yacht-rental'),
					"desc" => wp_kses_data( __('Select or upload background custom image. If selected - use it instead the theme predefined image (selected in the field above)',  'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'bg_custom' => array('yes')
					),
					"std" => "",
					"type" => "media"
					),
		
		'bg_image_custom_position' => array( 
					"title" => esc_html__('Background custom image position',  'yacht-rental'),
					"desc" => wp_kses_data( __('Select custom image position',  'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "left_top",
					"dependency" => array(
						'bg_custom' => array('yes')
					),
					"options" => array(
						'left_top' => "Left Top",
						'center_top' => "Center Top",
						'right_top' => "Right Top",
						'left_center' => "Left Center",
						'center_center' => "Center Center",
						'right_center' => "Right Center",
						'left_bottom' => "Left Bottom",
						'center_bottom' => "Center Bottom",
						'right_bottom' => "Right Bottom",
					),
					"type" => "select"
					),
		
		'bg_image_load' => array(
					"title" => esc_html__('Load background image', 'yacht-rental'),
					"desc" => wp_kses_data( __('Always load background images or only for boxed body style', 'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "boxed",
					"size" => "medium",
					"dependency" => array(
						'bg_custom' => array('yes')
					),
					"options" => array(
						'boxed' => esc_html__('Boxed', 'yacht-rental'),
						'always' => esc_html__('Always', 'yacht-rental')
					),
					"type" => "switch"
					),

		
		'info_body_3' => array(
					"title" => esc_html__('Video background', 'yacht-rental'),
					"desc" => wp_kses_data( __('Parameters of the video, used as site background', 'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"type" => "info"
					),

		'show_video_bg' => array(
					"title" => esc_html__('Show video background',  'yacht-rental'),
					"desc" => wp_kses_data( __("Show video as the site background", 'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "no",
					"options" => yacht_rental_get_options_param('list_yes_no'),
					"type" => "switch"
					),

		'video_bg_youtube_code' => array(
					"title" => esc_html__('Youtube code for video bg',  'yacht-rental'),
					"desc" => wp_kses_data( __("Youtube code of video", 'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'show_video_bg' => array('yes')
					),
					"std" => "",
					"type" => "text"
					),

		'video_bg_url' => array(
					"title" => esc_html__('Local video for video bg',  'yacht-rental'),
					"desc" => wp_kses_data( __("URL to video-file (uploaded on your site)", 'yacht-rental') ),
					"readonly" =>false,
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'show_video_bg' => array('yes')
					),
					"before" => array(	'title' => esc_html__('Choose video', 'yacht-rental'),
										'action' => 'media_upload',
										'multiple' => false,
										'linked_field' => '',
										'type' => 'video',
										'captions' => array('choose' => esc_html__( 'Choose Video', 'yacht-rental'),
															'update' => esc_html__( 'Select Video', 'yacht-rental')
														)
								),
					"std" => "",
					"type" => "media"
					),

		'video_bg_overlay' => array(
					"title" => esc_html__('Use overlay for video bg', 'yacht-rental'),
					"desc" => wp_kses_data( __('Use overlay texture for the video background', 'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'show_video_bg' => array('yes')
					),
					"std" => "no",
					"options" => yacht_rental_get_options_param('list_yes_no'),
					"type" => "switch"
					),
		
		
		
		
		
		// Customization -> Header
		//-------------------------------------------------
		
		'customization_header' => array(
					"title" => esc_html__("Header", 'yacht-rental'),
					"override" => "category,services_group,post,page,custom",
					"icon" => 'iconadmin-window',
					"type" => "tab"),
		
		"info_header_1" => array(
					"title" => esc_html__('Top panel', 'yacht-rental'),
					"desc" => wp_kses_data( __('Top panel settings. It include user menu area (with contact info, cart button, language selector, login/logout menu and user menu) and main menu area (with logo and main menu).', 'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"type" => "info"),
		
		"top_panel_style" => array(
					"title" => esc_html__('Top panel style', 'yacht-rental'),
					"desc" => wp_kses_data( __('Select desired style of the page header', 'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "header_2",
					"options" => yacht_rental_get_options_param('list_header_styles'),
					"style" => "list",
					"type" => "images"),

		"top_panel_image" => array(
					"title" => esc_html__('Top panel image', 'yacht-rental'),
					"desc" => wp_kses_data( __('Select default background image of the page header (if not single post or featured image for current post is not specified)', 'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'top_panel_style' => array('header_7')
					),
					"std" => "",
					"type" => "media"),
		
		"top_panel_position" => array( 
					"title" => esc_html__('Top panel position', 'yacht-rental'),
					"desc" => wp_kses_data( __('Select position for the top panel with logo and main menu', 'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "above",
					"options" => array(
						'hide'  => esc_html__('Hide', 'yacht-rental'),
						'above' => esc_html__('Above slider', 'yacht-rental'),
						'below' => esc_html__('Below slider', 'yacht-rental'),
					),
					"type" => "checklist"),

		"pushy_panel_scheme" => array(
					"title" => esc_html__('Push panel color scheme', 'yacht-rental'),
					"desc" => wp_kses_data( __('Select predefined color scheme for the push panel (with logo, menu and socials)', 'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'top_panel_style' => array('header_8')
					),
					"std" => "dark",
					"dir" => "horizontal",
					"options" => yacht_rental_get_options_param('list_color_schemes'),
					"type" => "checklist"),
		
		"show_page_title" => array(
					"title" => esc_html__('Show Page title', 'yacht-rental'),
					"desc" => wp_kses_data( __('Show post/page/category title', 'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "yes",
					"options" => yacht_rental_get_options_param('list_yes_no'),
					"type" => "switch"),
		
		"show_breadcrumbs" => array(
					"title" => esc_html__('Show Breadcrumbs', 'yacht-rental'),
					"desc" => wp_kses_data( __('Show path to current category (post, page)', 'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "yes",
					"options" => yacht_rental_get_options_param('list_yes_no'),
					"type" => "switch"),
		
		"breadcrumbs_max_level" => array(
					"title" => esc_html__('Breadcrumbs max nesting', 'yacht-rental'),
					"desc" => wp_kses_data( __("Max number of the nested categories in the breadcrumbs (0 - unlimited)", 'yacht-rental') ),
					"dependency" => array(
						'show_breadcrumbs' => array('yes')
					),
					"std" => "0",
					"min" => 0,
					"max" => 100,
					"step" => 1,
					"type" => "spinner"),
		
		"show_boats_search" => array(
					"title" => esc_html__('Show boats search box in header', 'yacht-rental'),
					"override" => "category,services_group,post,page,custom",
					"std" => "no",
					"options" => yacht_rental_get_options_param('list_yes_no'),
					"type" => "switch"),
		

		"contact_address_header" => array(
					"title" => esc_html__('Company address in header', 'yacht-rental'),
					"desc" => wp_kses_data( __('Company country, post code and city', 'yacht-rental') ),
					"std" => "",
					"before" => array('icon'=>'iconadmin-home'),
					"type" => "text"),
		"contact_phone_header" => array(
					"title" => esc_html__('Company phone in header', 'yacht-rental'),
					"desc" => wp_kses_data( __('Phone number', 'yacht-rental') ),
					"std" => "",
					"before" => array('icon'=>'iconadmin-phone'),
					"type" => "text"),
		"button_in_header" => array(
					"title" => esc_html__('Button text in header', 'yacht-rental'),
					"desc" => wp_kses_data( __('Button text', 'yacht-rental') ),
					"std" => "",
					"type" => "text"),
		"button_url_in_header" => array(
					"title" => esc_html__('Button URL in header', 'yacht-rental'),
					"desc" => wp_kses_data( __('Button URL', 'yacht-rental') ),
					"std" => "",
					"type" => "text"),
		
		
		"info_header_2" => array( 
					"title" => esc_html__('Main menu style and position', 'yacht-rental'),
					"desc" => wp_kses_data( __('Select the Main menu style and position', 'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"type" => "info"),
		
		"menu_main" => array( 
					"title" => esc_html__('Select main menu',  'yacht-rental'),
					"desc" => wp_kses_data( __('Select main menu for the current page',  'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "default",
					"options" => yacht_rental_get_options_param('list_menus'),
					"type" => "select"),

            "menu_attachment" => array(
                "title" => esc_html__('Main menu attachment', 'yacht-rental'),
                "desc" => wp_kses_data( __('Attach main menu to top of window then page scroll down', 'yacht-rental') ),
                "std" => "none",
                "options" => array(
                    "fixed"=>esc_html__("Fix menu position", 'yacht-rental'),
                    "none"=>esc_html__("Don't fix menu position", 'yacht-rental')
                ),
                "dir" => "vertical",
                "type" => "radio"),

		"menu_hover" => array( 
					"title" => esc_html__('Main menu hover effect', 'yacht-rental'),
					"desc" => wp_kses_data( __('Select hover effect for the main menu items', 'yacht-rental') ),
					"std" => "fade",
					"type" => "select",
					"options" => yacht_rental_get_options_param('list_menu_hovers')),

		"menu_animation_in" => array( 
					"title" => esc_html__('Submenu show animation', 'yacht-rental'),
					"desc" => wp_kses_data( __('Select animation to show submenu ', 'yacht-rental') ),
					"std" => "bounceIn",
					"type" => "select",
					"options" => yacht_rental_get_options_param('list_animations_in')),

		"menu_animation_out" => array( 
					"title" => esc_html__('Submenu hide animation', 'yacht-rental'),
					"desc" => wp_kses_data( __('Select animation to hide submenu ', 'yacht-rental') ),
					"std" => "fadeOutDown",
					"type" => "select",
					"options" => yacht_rental_get_options_param('list_animations_out')),
		
		"menu_mobile" => array( 
					"title" => esc_html__('Main menu responsive', 'yacht-rental'),
					"desc" => wp_kses_data( __('Allow responsive version for the main menu if window width less then this value', 'yacht-rental') ),
					"std" => 1024,
					"min" => 320,
					"max" => 1024,
					"type" => "spinner"),
		
		"menu_width" => array( 
					"title" => esc_html__('Submenu width', 'yacht-rental'),
					"desc" => wp_kses_data( __('Width for dropdown menus in main menu', 'yacht-rental') ),
					"step" => 5,
					"std" => "",
					"min" => 180,
					"max" => 300,
					"mask" => "?999",
					"type" => "spinner"),

			
		'info_header_5' => array(
					"title" => esc_html__('Main logo', 'yacht-rental'),
					"desc" => wp_kses_data( __("Select or upload logos for the site's header and select it position", 'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"type" => "info"
					),

		'logo' => array(
					"title" => esc_html__('Logo image', 'yacht-rental'),
					"desc" => wp_kses_data( __('Main logo image', 'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "",
					"type" => "media"
					),

		'logo_retina' => array(
					"title" => esc_html__('Logo image for Retina', 'yacht-rental'),
					"desc" => wp_kses_data( __('Main logo image used on Retina display', 'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "",
					"type" => "media"
					),

		'logo_fixed' => array(
					"title" => esc_html__('Logo image (fixed header)', 'yacht-rental'),
					"desc" => wp_kses_data( __('Logo image for the header (if menu is fixed after the page is scrolled)', 'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"divider" => false,
					"std" => "",
					"type" => "media"
					),

		'logo_text' => array(
					"title" => esc_html__('Logo text', 'yacht-rental'),
					"desc" => wp_kses_data( __('Logo text - display it after logo image', 'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"std" => '',
					"type" => "text"
					),

		'logo_height' => array(
					"title" => esc_html__('Logo height', 'yacht-rental'),
					"desc" => wp_kses_data( __('Height for the logo in the header area', 'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"step" => 1,
					"std" => '',
					"min" => 10,
					"max" => 300,
					"mask" => "?999",
					"type" => "spinner"
					),

		'logo_offset' => array(
					"title" => esc_html__('Logo top offset', 'yacht-rental'),
					"desc" => wp_kses_data( __('Top offset for the logo in the header area', 'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"step" => 1,
					"std" => '',
					"min" => 0,
					"max" => 99,
					"mask" => "?99",
					"type" => "spinner"
					),
		
		
		
		
		
		
		
		// Customization -> Slider
		//-------------------------------------------------
		
		"customization_slider" => array( 
					"title" => esc_html__('Slider', 'yacht-rental'),
					"icon" => "iconadmin-picture",
					"override" => "category,services_group,page,custom",
					"type" => "tab"),
		
		"info_slider_1" => array(
					"title" => esc_html__('Main slider parameters', 'yacht-rental'),
					"desc" => wp_kses_data( __('Select parameters for main slider (you can override it in each category and page)', 'yacht-rental') ),
					"override" => "category,services_group,page,custom",
					"type" => "info"),
					
		"show_slider" => array(
					"title" => esc_html__('Show Slider', 'yacht-rental'),
					"desc" => wp_kses_data( __('Do you want to show slider on each page (post)', 'yacht-rental') ),
					"override" => "category,services_group,page,custom",
					"std" => "no",
					"options" => yacht_rental_get_options_param('list_yes_no'),
					"type" => "switch"),
					
		"slider_display" => array(
					"title" => esc_html__('Slider display', 'yacht-rental'),
					"desc" => wp_kses_data( __('How display slider: boxed (fixed width and height), fullwide (fixed height) or fullscreen', 'yacht-rental') ),
					"override" => "category,services_group,page,custom",
					"dependency" => array(
						'show_slider' => array('yes')
					),
					"std" => "fullwide",
					"options" => array(
						"boxed"=>esc_html__("Boxed", 'yacht-rental'),
						"fullwide"=>esc_html__("Fullwide", 'yacht-rental'),
						"fullscreen"=>esc_html__("Fullscreen", 'yacht-rental')
					),
					"type" => "checklist"),
		
		"slider_height" => array(
					"title" => esc_html__("Height (in pixels)", 'yacht-rental'),
					"desc" => wp_kses_data( __("Slider height (in pixels) - only if slider display with fixed height.", 'yacht-rental') ),
					"override" => "category,services_group,page,custom",
					"dependency" => array(
						'show_slider' => array('yes')
					),
					"std" => '',
					"min" => 100,
					"step" => 10,
					"type" => "spinner"),
		
		"slider_engine" => array(
					"title" => esc_html__('Slider engine', 'yacht-rental'),
					"desc" => wp_kses_data( __('What engine use to show slider?', 'yacht-rental') ),
					"override" => "category,services_group,page,custom",
					"dependency" => array(
						'show_slider' => array('yes')
					),
					"std" => "swiper",
					"options" => yacht_rental_get_options_param('list_sliders'),
					"type" => "radio"),

		"slider_over_content" => array(
					"title" => esc_html__('Put content over slider',  'yacht-rental'),
					"desc" => wp_kses_data( __('Put content below on fixed layer over this slider',  'yacht-rental') ),
					"override" => "category,services_group,page,custom",
					"dependency" => array(
						'show_slider' => array('yes')
					),
					"cols" => 80,
					"rows" => 20,
					"std" => "",
					"allow_html" => true,
					"allow_js" => true,
					"type" => "editor"),
		
		"slider_category" => array(
					"title" => esc_html__('Posts Slider: Category to show', 'yacht-rental'),
					"desc" => wp_kses_data( __('Select category to show in Flexslider (ignored for Revolution and Royal sliders)', 'yacht-rental') ),
					"override" => "category,services_group,page,custom",
					"dependency" => array(
						'show_slider' => array('yes'),
						'slider_engine' => array('swiper')
					),
					"std" => "",
					"options" => yacht_rental_array_merge(array(0 => esc_html__('- Select category -', 'yacht-rental')), yacht_rental_get_options_param('list_categories')),
					"type" => "select",
					"multiple" => true,
					"style" => "list"),
		
		"slider_posts" => array(
					"title" => esc_html__('Posts Slider: Number posts or comma separated posts list',  'yacht-rental'),
					"desc" => wp_kses_data( __("How many recent posts display in slider or comma separated list of posts ID (in this case selected category ignored)", 'yacht-rental') ),
					"override" => "category,services_group,page,custom",
					"dependency" => array(
						'show_slider' => array('yes'),
						'slider_engine' => array('swiper')
					),
					"std" => "5",
					"type" => "text"),
		
		"slider_orderby" => array(
					"title" => esc_html__("Posts Slider: Posts order by",  'yacht-rental'),
					"desc" => wp_kses_data( __("Posts in slider ordered by date (default), comments, views, author rating, users rating, random or alphabetically", 'yacht-rental') ),
					"override" => "category,services_group,page,custom",
					"dependency" => array(
						'show_slider' => array('yes'),
						'slider_engine' => array('swiper')
					),
					"std" => "date",
					"options" => yacht_rental_get_options_param('list_sorting'),
					"type" => "select"),
		
		"slider_order" => array(
					"title" => esc_html__("Posts Slider: Posts order", 'yacht-rental'),
					"desc" => wp_kses_data( __('Select the desired ordering method for posts', 'yacht-rental') ),
					"override" => "category,services_group,page,custom",
					"dependency" => array(
						'show_slider' => array('yes'),
						'slider_engine' => array('swiper')
					),
					"std" => "desc",
					"options" => yacht_rental_get_options_param('list_ordering'),
					"size" => "big",
					"type" => "switch"),
					
		"slider_interval" => array(
					"title" => esc_html__("Posts Slider: Slide change interval", 'yacht-rental'),
					"desc" => wp_kses_data( __("Interval (in ms) for slides change in slider", 'yacht-rental') ),
					"override" => "category,services_group,page,custom",
					"dependency" => array(
						'show_slider' => array('yes'),
						'slider_engine' => array('swiper')
					),
					"std" => 7000,
					"min" => 100,
					"step" => 100,
					"type" => "spinner"),
		
		"slider_pagination" => array(
					"title" => esc_html__("Posts Slider: Pagination", 'yacht-rental'),
					"desc" => wp_kses_data( __("Choose pagination style for the slider", 'yacht-rental') ),
					"override" => "category,services_group,page,custom",
					"dependency" => array(
						'show_slider' => array('yes'),
						'slider_engine' => array('swiper')
					),
					"std" => "no",
					"options" => array(
						'no'   => esc_html__('None', 'yacht-rental'),
						'yes'  => esc_html__('Dots', 'yacht-rental'), 
						'over' => esc_html__('Titles', 'yacht-rental')
					),
					"type" => "checklist"),
		
		"slider_infobox" => array(
					"title" => esc_html__("Posts Slider: Show infobox", 'yacht-rental'),
					"desc" => wp_kses_data( __("Do you want to show post's title, reviews rating and description on slides in slider", 'yacht-rental') ),
					"override" => "category,services_group,page,custom",
					"dependency" => array(
						'show_slider' => array('yes'),
						'slider_engine' => array('swiper')
					),
					"std" => "slide",
					"options" => array(
						'no'    => esc_html__('None',  'yacht-rental'),
						'slide' => esc_html__('Slide', 'yacht-rental'), 
						'fixed' => esc_html__('Fixed', 'yacht-rental')
					),
					"type" => "checklist"),
					
		"slider_info_category" => array(
					"title" => esc_html__("Posts Slider: Show post's category", 'yacht-rental'),
					"desc" => wp_kses_data( __("Do you want to show post's category on slides in slider", 'yacht-rental') ),
					"override" => "category,services_group,page,custom",
					"dependency" => array(
						'show_slider' => array('yes'),
						'slider_engine' => array('swiper')
					),
					"std" => "yes",
					"options" => yacht_rental_get_options_param('list_yes_no'),
					"type" => "switch"),
					
		"slider_info_reviews" => array(
					"title" => esc_html__("Posts Slider: Show post's reviews rating", 'yacht-rental'),
					"desc" => wp_kses_data( __("Do you want to show post's reviews rating on slides in slider", 'yacht-rental') ),
					"override" => "category,services_group,page,custom",
					"dependency" => array(
						'show_slider' => array('yes'),
						'slider_engine' => array('swiper')
					),
					"std" => "yes",
					"options" => yacht_rental_get_options_param('list_yes_no'),
					"type" => "switch"),
					
		"slider_info_descriptions" => array(
					"title" => esc_html__("Posts Slider: Show post's descriptions", 'yacht-rental'),
					"desc" => wp_kses_data( __("How many characters show in the post's description in slider. 0 - no descriptions", 'yacht-rental') ),
					"override" => "category,services_group,page,custom",
					"dependency" => array(
						'show_slider' => array('yes'),
						'slider_engine' => array('swiper')
					),
					"std" => 0,
					"min" => 0,
					"step" => 10,
					"type" => "spinner"),
		
		
		
		
		
		// Customization -> Sidebars
		//-------------------------------------------------
		
		"customization_sidebars" => array( 
					"title" => esc_html__('Sidebars', 'yacht-rental'),
					"icon" => "iconadmin-indent-right",
					"override" => "category,services_group,post,page,custom",
					"type" => "tab"),
		
		"info_sidebars_1" => array( 
					"title" => esc_html__('Custom sidebars', 'yacht-rental'),
					"desc" => wp_kses_data( __('In this section you can create unlimited sidebars. You can fill them with widgets in the menu Appearance - Widgets', 'yacht-rental') ),
					"type" => "info"),
		
		"custom_sidebars" => array(
					"title" => esc_html__('Custom sidebars',  'yacht-rental'),
					"desc" => wp_kses_data( __('Manage custom sidebars. You can use it with each category (page, post) independently',  'yacht-rental') ),
					"std" => "",
					"cloneable" => true,
					"type" => "text"),
		
		"info_sidebars_2" => array(
					"title" => esc_html__('Main sidebar', 'yacht-rental'),
					"desc" => wp_kses_data( __('Show / Hide and select main sidebar', 'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"type" => "info"),
		
		'show_sidebar_main' => array( 
					"title" => esc_html__('Show main sidebar',  'yacht-rental'),
					"desc" => wp_kses_data( __('Select position for the main sidebar or hide it',  'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "right",
					"options" => yacht_rental_get_options_param('list_positions'),
					"dir" => "horizontal",
					"type" => "checklist"),
		
		"sidebar_main" => array( 
					"title" => esc_html__('Select main sidebar',  'yacht-rental'),
					"desc" => wp_kses_data( __('Select main sidebar content',  'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'show_sidebar_main' => array('left', 'right')
					),
					"std" => "sidebar_main",
					"options" => yacht_rental_get_options_param('list_sidebars'),
					"type" => "select"),

		
		// Customization -> Footer
		//-------------------------------------------------
		
		'customization_footer' => array(
					"title" => esc_html__("Footer", 'yacht-rental'),
					"override" => "category,services_group,post,page,custom",
					"icon" => 'iconadmin-window',
					"type" => "tab"),
		
		
		"info_footer_1" => array(
					"title" => esc_html__("Footer components", 'yacht-rental'),
					"desc" => wp_kses_data( __("Select components of the footer, set style and put the content for the user's footer area", 'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"type" => "info"),
		
		"show_sidebar_footer" => array(
					"title" => esc_html__('Show footer sidebar', 'yacht-rental'),
					"desc" => wp_kses_data( __('Select style for the footer sidebar or hide it', 'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "yes",
					"options" => yacht_rental_get_options_param('list_yes_no'),
					"type" => "switch"),

		"sidebar_footer_scheme" => array(
					"title" => esc_html__("Color scheme", 'yacht-rental'),
					"desc" => wp_kses_data( __('Select predefined color scheme for the footer', 'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'show_sidebar_footer' => array('yes')
					),
					"std" => "original",
					"dir" => "horizontal",
					"options" => yacht_rental_get_options_param('list_color_schemes'),
					"type" => "checklist"),
		
		"sidebar_footer" => array( 
					"title" => esc_html__('Select footer sidebar',  'yacht-rental'),
					"desc" => wp_kses_data( __('Select footer sidebar for the blog page',  'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'show_sidebar_footer' => array('yes')
					),
					"std" => "sidebar_footer",
					"options" => yacht_rental_get_options_param('list_sidebars'),
					"type" => "select"),
		
		"sidebar_footer_columns" => array( 
					"title" => esc_html__('Footer sidebar columns',  'yacht-rental'),
					"desc" => wp_kses_data( __('Select columns number for the footer sidebar',  'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'show_sidebar_footer' => array('yes')
					),
					"std" => 3,
					"min" => 1,
					"max" => 6,
					"type" => "spinner"),
		
		"info_footer_2" => array(
					"title" => esc_html__('Custom shortcode box', 'yacht-rental'),
					"override" => "category,services_group,post,page,custom",
					"type" => "info"),

		"show_custom_shortcode_box_in_footer" => array(
					"title" => esc_html__('Show shortcode box', 'yacht-rental'),
					"override" => "category,services_group,post,page,custom",
					"std" => "no",
					"options" => yacht_rental_get_options_param('list_yes_no'),
					"type" => "switch"),

		'custom_shortcode_box' => array(
					"title" => esc_html__('Your custom HTML/JS code',  'yacht-rental'),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'show_custom_shortcode_box_in_footer' => array('yes')
					),
					"cols" => 80,
					"rows" => 10,
					"std" => "",
					"allow_html" => true,
					"allow_js" => true,
					"type" => "textarea"),



		"info_footer_4" => array(
					"title" => esc_html__('Google map parameters', 'yacht-rental'),
					"desc" => wp_kses_data( __('Select parameters for Google map (you can override it in each category and page)', 'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"type" => "info"),
					
		"show_googlemap" => array(
					"title" => esc_html__('Show Google Map', 'yacht-rental'),
					"desc" => wp_kses_data( __('Do you want to show Google map on each page (post)', 'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "no",
					"options" => yacht_rental_get_options_param('list_yes_no'),
					"type" => "switch"),
		
		"googlemap_height" => array(
					"title" => esc_html__("Map height", 'yacht-rental'),
					"desc" => wp_kses_data( __("Map height (default - in pixels, allows any CSS units of measure)", 'yacht-rental') ),
					"override" => "category,services_group,page,custom",
					"dependency" => array(
						'show_googlemap' => array('yes')
					),
					"std" => 400,
					"min" => 100,
					"step" => 10,
					"type" => "spinner"),
		
		"googlemap_address" => array(
					"title" => esc_html__('Address to show on map',  'yacht-rental'),
					"desc" => wp_kses_data( __("Enter address to show on map center", 'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'show_googlemap' => array('yes')
					),
					"std" => "",
					"type" => "text"),
		
		"googlemap_latlng" => array(
					"title" => esc_html__('Latitude and Longitude to show on map',  'yacht-rental'),
					"desc" => wp_kses_data( __("Enter coordinates (separated by comma) to show on map center (instead of address)", 'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'show_googlemap' => array('yes')
					),
					"std" => "",
					"type" => "text"),
		
		
		"googlemap_zoom" => array(
					"title" => esc_html__('Google map initial zoom',  'yacht-rental'),
					"desc" => wp_kses_data( __("Enter desired initial zoom for Google map", 'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'show_googlemap' => array('yes')
					),
					"std" => 16,
					"min" => 1,
					"max" => 20,
					"step" => 1,
					"type" => "spinner"),
		
		"googlemap_style" => array(
					"title" => esc_html__('Google map style',  'yacht-rental'),
					"desc" => wp_kses_data( __("Select style to show Google map", 'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'show_googlemap' => array('yes')
					),
					"std" => 'style1',
					"options" => yacht_rental_get_options_param('list_gmap_styles'),
					"type" => "select"),
		
		"googlemap_marker" => array(
					"title" => esc_html__('Google map marker',  'yacht-rental'),
					"desc" => wp_kses_data( __("Select or upload png-image with Google map marker", 'yacht-rental') ),
					"dependency" => array(
						'show_googlemap' => array('yes')
					),
					"std" => '',
					"type" => "media"),
		
		
		
		"info_footer_5" => array(
					"title" => esc_html__("Contacts area", 'yacht-rental'),
					"desc" => wp_kses_data( __("Show/Hide contacts area in the footer", 'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"type" => "info"),
		
		"show_contacts_in_footer" => array(
					"title" => esc_html__('Show Contacts in footer', 'yacht-rental'),
					"desc" => wp_kses_data( __('Show contact information area in footer: site logo, contact info and large social icons', 'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "yes",
					"options" => yacht_rental_get_options_param('list_yes_no'),
					"type" => "switch"),

		"contacts_scheme" => array(
					"title" => esc_html__("Color scheme", 'yacht-rental'),
					"desc" => wp_kses_data( __('Select predefined color scheme for the contacts area', 'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'show_contacts_in_footer' => array('yes')
					),
					"std" => "original",
					"dir" => "horizontal",
					"options" => yacht_rental_get_options_param('list_color_schemes'),
					"type" => "checklist"),

		'logo_footer' => array(
					"title" => esc_html__('Logo image for footer', 'yacht-rental'),
					"desc" => wp_kses_data( __('Logo image in the footer (in the contacts area)', 'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'show_contacts_in_footer' => array('yes')
					),
					"std" => "",
					"type" => "media"
					),

		'logo_footer_retina' => array(
					"title" => esc_html__('Logo image for footer for Retina', 'yacht-rental'),
					"desc" => wp_kses_data( __('Logo image in the footer (in the contacts area) used on Retina display', 'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'show_contacts_in_footer' => array('yes')
					),
					"std" => "",
					"type" => "media"
					),
		
		'logo_footer_height' => array(
					"title" => esc_html__('Logo height', 'yacht-rental'),
					"desc" => wp_kses_data( __('Height for the logo in the footer area (in the contacts area)', 'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'show_contacts_in_footer' => array('yes')
					),
					"step" => 1,
					"std" => 30,
					"min" => 10,
					"max" => 300,
					"mask" => "?999",
					"type" => "spinner"
					),
		
		
		
		"info_footer_6" => array(
					"title" => esc_html__("Copyright and footer menu", 'yacht-rental'),
					"desc" => wp_kses_data( __("Show/Hide copyright area in the footer", 'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"type" => "info"),

		"show_copyright_in_footer" => array(
					"title" => esc_html__('Show Copyright area in footer', 'yacht-rental'),
					"desc" => wp_kses_data( __('Show area with copyright information, footer menu and small social icons in footer', 'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "plain",
					"options" => array(
						'none' => esc_html__('Hide', 'yacht-rental'),
						'text' => esc_html__('Text', 'yacht-rental'),
						'menu' => esc_html__('Text and menu', 'yacht-rental')
					),
					"type" => "checklist"),


		
		"menu_footer" => array( 
					"title" => esc_html__('Select footer menu',  'yacht-rental'),
					"desc" => wp_kses_data( __('Select footer menu for the current page',  'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "default",
					"dependency" => array(
						'show_copyright_in_footer' => array('menu')
					),
					"options" => yacht_rental_get_options_param('list_menus'),
					"type" => "select"),

		"footer_copyright" => array(
					"title" => esc_html__('Footer copyright text',  'yacht-rental'),
					"desc" => wp_kses_data( __("Copyright text to show in footer area (bottom of site)", 'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'show_copyright_in_footer' => array('text', 'menu', 'socials')
					),
					"allow_html" => true,
					"std" => "ThemeREX &copy; {Y} All Rights Reserved ",
					"rows" => "10",
					"type" => "editor"),




		// Customization -> Other
		//-------------------------------------------------
		
		'customization_other' => array(
					"title" => esc_html__('Other', 'yacht-rental'),
					"override" => "category,services_group,post,page,custom",
					"icon" => 'iconadmin-cog',
					"type" => "tab"
					),

		'info_other_0' => array(
						"title" => esc_html__('Widgets Block Editor', 'yacht-rental'),
						"desc" => wp_kses_data( __('Put here your custom CSS and JS code', 'yacht-rental') ),
						"override" => "category,services_group,post,page,custom",
						"type" => "info"
					),
		"disable_widgets_block_editor" => array(
						"title" => esc_html__('Disable new Widgets Block Editor', 'yacht-rental'),
						"desc" => wp_kses_data( __('Attention! If after the update to WordPress 5.8+ you are having trouble editing widgets or working in Customizer - disable new Widgets Block Editor (used in WordPress 5.8+ instead of a classic widgets panel)', 'yacht-rental') ),
						"std" => "no",
						"options" => yacht_rental_get_options_param('list_yes_no'),
						"type" => "switch"
					),		

		'info_other_1' => array(
					"title" => esc_html__('Theme customization other parameters', 'yacht-rental'),
					"desc" => wp_kses_data( __('Animation parameters and responsive layouts for the small screens', 'yacht-rental') ),
					"type" => "info"
					),

		'show_theme_customizer' => array(
					"title" => esc_html__('Show Theme customizer', 'yacht-rental'),
					"desc" => wp_kses_data( __('Do you want to show theme customizer in the right panel? Your website visitors will be able to customise it yourself.', 'yacht-rental') ),
					"std" => "no",
					"options" => yacht_rental_get_options_param('list_yes_no'),
					"type" => "switch"
					),

		"customizer_demo" => array(
					"title" => esc_html__('Theme customizer panel demo time', 'yacht-rental'),
					"desc" => wp_kses_data( __('Timer for demo mode for the customizer panel (in milliseconds: 1000ms = 1s). If 0 - no demo.', 'yacht-rental') ),
					"dependency" => array(
						'show_theme_customizer' => array('yes')
					),
					"std" => "0",
					"min" => 0,
					"max" => 10000,
					"step" => 500,
					"type" => "spinner"),
		
		'css_animation' => array(
					"title" => esc_html__('Extended CSS animations', 'yacht-rental'),
					"desc" => wp_kses_data( __('Do you want use extended animations effects on your site?', 'yacht-rental') ),
					"std" => "yes",
					"options" => yacht_rental_get_options_param('list_yes_no'),
					"type" => "switch"
					),
		
		'animation_on_mobile' => array(
					"title" => esc_html__('Allow CSS animations on mobile', 'yacht-rental'),
					"desc" => wp_kses_data( __('Do you allow extended animations effects on mobile devices?', 'yacht-rental') ),
					"std" => "yes",
					"options" => yacht_rental_get_options_param('list_yes_no'),
					"type" => "switch"
					),

		"button_hover" => array( 
					"title" => esc_html__("Buttons hover", 'yacht-rental'),
					"desc" => wp_kses_data( __("Select hover effect for all theme's buttons (and buttons from the thirdparty plugins if possible)", 'yacht-rental') ),
					"std" => "fade",
					"type" => "select",
					"options" => yacht_rental_get_options_param('list_button_hovers')),


		'remember_visitors_settings' => array(
					"title" => esc_html__("Remember visitor's settings", 'yacht-rental'),
					"desc" => wp_kses_data( __('To remember the settings that were made by the visitor, when navigating to other pages or to limit their effect only within the current page', 'yacht-rental') ),
					"std" => "no",
					"options" => yacht_rental_get_options_param('list_yes_no'),
					"type" => "switch"
					),
					
		'responsive_layouts' => array(
					"title" => esc_html__('Responsive Layouts', 'yacht-rental'),
					"desc" => wp_kses_data( __('Do you want use responsive layouts on small screen or still use main layout?', 'yacht-rental') ),
					"std" => "yes",
					"options" => yacht_rental_get_options_param('list_yes_no'),
					"type" => "switch"
					),

		"page_preloader" => array( 
					"title" => esc_html__("Show page preloader", 'yacht-rental'),
					"desc" => wp_kses_data( __("Select one of predefined styles for the page preloader or upload preloader image", 'yacht-rental') ),
					"std" => "none",
					"type" => "select",
					"options" => array(
						'none'   => esc_html__('Hide preloader', 'yacht-rental'),
						'circle' => esc_html__('Circle', 'yacht-rental'),
						'square' => esc_html__('Square', 'yacht-rental'),
						'custom' => esc_html__('Custom', 'yacht-rental'),
					)),

            'privacy_text' => array(
                "title" => esc_html__("Text with Privacy Policy link", 'yacht-rental'),
                "desc"  => wp_kses_data( __("Specify text with Privacy Policy link for the checkbox 'I agree ...'", 'yacht-rental') ),
                "std"   => wp_kses_post( __( 'I agree that my submitted data is being collected and stored.', 'yacht-rental') ),
                "type"  => "text"
            ),
		
		'page_preloader_image' => array(
					"title" => esc_html__('Upload preloader image',  'yacht-rental'),
					"desc" => wp_kses_data( __('Upload animated GIF to use it as page preloader',  'yacht-rental') ),
					"dependency" => array(
						'page_preloader' => array('custom')
					),
					"std" => "",
					"type" => "media"
					),


		'info_other_2' => array(
					"title" => esc_html__('Google fonts parameters', 'yacht-rental'),
					"desc" => wp_kses_data( __('Specify additional parameters, used to load Google fonts', 'yacht-rental') ),
					"type" => "info"
					),
		
		"fonts_subset" => array(
					"title" => esc_html__('Characters subset', 'yacht-rental'),
					"desc" => wp_kses_data( __('Select subset, included into used Google fonts', 'yacht-rental') ),
					"std" => "latin,latin-ext",
					"options" => array(
						'latin' => esc_html__('Latin', 'yacht-rental'),
						'latin-ext' => esc_html__('Latin Extended', 'yacht-rental'),
						'greek' => esc_html__('Greek', 'yacht-rental'),
						'greek-ext' => esc_html__('Greek Extended', 'yacht-rental'),
						'cyrillic' => esc_html__('Cyrillic', 'yacht-rental'),
						'cyrillic-ext' => esc_html__('Cyrillic Extended', 'yacht-rental'),
						'vietnamese' => esc_html__('Vietnamese', 'yacht-rental')
					),
					"size" => "medium",
					"dir" => "vertical",
					"multiple" => true,
					"type" => "checklist"),

		
		
		//###############################
		//#### Blog and Single pages #### 
		//###############################
		"partition_blog" => array(
					"title" => esc_html__('Blog &amp; Single', 'yacht-rental'),
					"icon" => "iconadmin-docs",
					"override" => "category,services_group,post,page,custom",
					"type" => "partition"),
		
		
		
		// Blog -> Stream page
		//-------------------------------------------------
		
		'blog_tab_stream' => array(
					"title" => esc_html__('Stream page', 'yacht-rental'),
					"start" => 'blog_tabs',
					"icon" => "iconadmin-docs",
					"override" => "category,services_group,post,page,custom",
					"type" => "tab"),
		
		"info_blog_1" => array(
					"title" => esc_html__('Blog streampage parameters', 'yacht-rental'),
					"desc" => wp_kses_data( __('Select desired blog streampage parameters (you can override it in each category)', 'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"type" => "info"),
		
		"blog_style" => array(
					"title" => esc_html__('Blog style', 'yacht-rental'),
					"desc" => wp_kses_data( __('Select desired blog style', 'yacht-rental') ),
					"override" => "category,services_group,page,custom",
					"std" => "excerpt",
					"options" => yacht_rental_get_options_param('list_blog_styles'),
					"type" => "select"),
		
		"hover_style" => array(
					"title" => esc_html__('Hover style', 'yacht-rental'),
					"desc" => wp_kses_data( __('Select desired hover style (only for Blog style = Portfolio)', 'yacht-rental') ),
					"override" => "category,services_group,page,custom",
					"dependency" => array(
						'blog_style' => array('portfolio','grid','square','colored')
					),
					"std" => "square effect_shift",
					"options" => yacht_rental_get_options_param('list_hovers'),
					"type" => "select"),
		
		"hover_dir" => array(
					"title" => esc_html__('Hover dir', 'yacht-rental'),
					"desc" => wp_kses_data( __('Select hover direction (only for Blog style = Portfolio and Hover style = Circle or Square)', 'yacht-rental') ),
					"override" => "category,services_group,page,custom",
					"dependency" => array(
						'blog_style' => array('portfolio','grid','square','colored'),
						'hover_style' => array('square','circle')
					),
					"std" => "left_to_right",
					"options" => yacht_rental_get_options_param('list_hovers_dir'),
					"type" => "select"),
		
		"article_style" => array(
					"title" => esc_html__('Article style', 'yacht-rental'),
					"desc" => wp_kses_data( __('Select article display method: boxed or stretch', 'yacht-rental') ),
					"override" => "category,services_group,page,custom",
					"std" => "stretch",
					"options" => yacht_rental_get_options_param('list_article_styles'),
					"size" => "medium",
					"type" => "switch"),
		
		"dedicated_location" => array(
					"title" => esc_html__('Dedicated location', 'yacht-rental'),
					"desc" => wp_kses_data( __('Select location for the dedicated content or featured image in the "excerpt" blog style', 'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'blog_style' => array('excerpt')
					),
					"std" => "default",
					"options" => yacht_rental_get_options_param('list_locations'),
					"type" => "select"),
		
		"show_filters" => array(
					"title" => esc_html__('Show filters', 'yacht-rental'),
					"desc" => wp_kses_data( __('What taxonomy use for filter buttons', 'yacht-rental') ),
					"override" => "category,services_group,page,custom",
					"dependency" => array(
						'blog_style' => array('portfolio','grid','square','colored')
					),
					"std" => "hide",
					"options" => yacht_rental_get_options_param('list_filters'),
					"type" => "checklist"),
		
		"blog_sort" => array(
					"title" => esc_html__('Blog posts sorted by', 'yacht-rental'),
					"desc" => wp_kses_data( __('Select the desired sorting method for posts', 'yacht-rental') ),
					"override" => "category,services_group,page,custom",
					"std" => "date",
					"options" => yacht_rental_get_options_param('list_sorting'),
					"dir" => "vertical",
					"type" => "radio"),
		
		"blog_order" => array(
					"title" => esc_html__('Blog posts order', 'yacht-rental'),
					"desc" => wp_kses_data( __('Select the desired ordering method for posts', 'yacht-rental') ),
					"override" => "category,services_group,page,custom",
					"std" => "desc",
					"options" => yacht_rental_get_options_param('list_ordering'),
					"size" => "big",
					"type" => "switch"),
		
		"posts_per_page" => array(
					"title" => esc_html__('Blog posts per page',  'yacht-rental'),
					"desc" => wp_kses_data( __('How many posts display on blog pages for selected style. If empty or 0 - inherit system wordpress settings',  'yacht-rental') ),
					"override" => "category,services_group,page,custom",
					"std" => "12",
					"mask" => "?99",
					"type" => "text"),
		
		"post_excerpt_maxlength" => array(
					"title" => esc_html__('Excerpt maxlength for streampage',  'yacht-rental'),
					"desc" => wp_kses_data( __('How many characters from post excerpt are display in blog streampage (only for Blog style = Excerpt). 0 - do not trim excerpt.',  'yacht-rental') ),
					"override" => "category,services_group,page,custom",
					"dependency" => array(
						'blog_style' => array('excerpt', 'portfolio', 'grid', 'square', 'related')
					),
					"std" => "250",
					"mask" => "?9999",
					"type" => "text"),
		
		"post_excerpt_maxlength_masonry" => array(
					"title" => esc_html__('Excerpt maxlength for classic and masonry',  'yacht-rental'),
					"desc" => wp_kses_data( __('How many characters from post excerpt are display in blog streampage (only for Blog style = Classic or Masonry). 0 - do not trim excerpt.',  'yacht-rental') ),
					"override" => "category,services_group,page,custom",
					"dependency" => array(
						'blog_style' => array('masonry', 'classic')
					),
					"std" => "150",
					"mask" => "?9999",
					"type" => "text"),
		
		
		
		
		// Blog -> Single page
		//-------------------------------------------------
		
		'blog_tab_single' => array(
					"title" => esc_html__('Single page', 'yacht-rental'),
					"icon" => "iconadmin-doc",
					"override" => "category,services_group,post,page,custom",
					"type" => "tab"),
		
		
		"info_single_1" => array(
					"title" => esc_html__('Single (detail) pages parameters', 'yacht-rental'),
					"desc" => wp_kses_data( __('Select desired parameters for single (detail) pages (you can override it in each category and single post (page))', 'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"type" => "info"),
		
		"single_style" => array(
					"title" => esc_html__('Single page style', 'yacht-rental'),
					"desc" => wp_kses_data( __('Select desired style for single page', 'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "single-standard",
					"options" => yacht_rental_get_options_param('list_single_styles'),
					"dir" => "horizontal",
					"type" => "radio"),

		"icon" => array(
					"title" => esc_html__('Select post icon', 'yacht-rental'),
					"desc" => wp_kses_data( __('Select icon for output before post/category name in some layouts', 'yacht-rental') ),
					"override" => "services_group,post,page,custom",
					"std" => "",
					"options" => yacht_rental_get_options_param('list_icons'),
					"style" => "select",
					"type" => "icons"
					),

		"alter_thumb_size" => array(
					"title" => esc_html__('Alter thumb size (WxH)',  'yacht-rental'),
					"override" => "page,post",
					"desc" => wp_kses_data( __("Select thumb size for the alternative portfolio layout (number items horizontally x number items vertically)", 'yacht-rental') ),
					"class" => "",
					"std" => "1_1",
					"type" => "radio",
					"options" => yacht_rental_get_options_param('list_alter_sizes')
					),
		
		"show_featured_image" => array(
					"title" => esc_html__('Show featured image before post',  'yacht-rental'),
					"desc" => wp_kses_data( __("Show featured image (if selected) before post content on single pages", 'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "yes",
					"options" => yacht_rental_get_options_param('list_yes_no'),
					"type" => "switch"),
		
		"show_post_title" => array(
					"title" => esc_html__('Show post title', 'yacht-rental'),
					"desc" => wp_kses_data( __('Show area with post title on single pages', 'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "yes",
					"options" => yacht_rental_get_options_param('list_yes_no'),
					"type" => "switch"),
		
		"show_post_title_on_quotes" => array(
					"title" => esc_html__('Show post title on links, chat, quote, status', 'yacht-rental'),
					"desc" => wp_kses_data( __('Show area with post title on single and blog pages in specific post formats: links, chat, quote, status', 'yacht-rental') ),
					"override" => "category,services_group,page,custom",
					"std" => "no",
					"options" => yacht_rental_get_options_param('list_yes_no'),
					"type" => "switch"),
		
		"show_post_info" => array(
					"title" => esc_html__('Show post info', 'yacht-rental'),
					"desc" => wp_kses_data( __('Show area with post info on single pages', 'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "yes",
					"options" => yacht_rental_get_options_param('list_yes_no'),
					"type" => "switch"),
		
		"show_text_before_readmore" => array(
					"title" => esc_html__('Show text before "Read more" tag', 'yacht-rental'),
					"desc" => wp_kses_data( __('Show text before "Read more" tag on single pages', 'yacht-rental') ),
					"std" => "yes",
					"options" => yacht_rental_get_options_param('list_yes_no'),
					"type" => "switch"),
					
		"show_post_author" => array(
					"title" => esc_html__('Show post author details',  'yacht-rental'),
					"desc" => wp_kses_data( __("Show post author information block on single post page", 'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "yes",
					"options" => yacht_rental_get_options_param('list_yes_no'),
					"type" => "switch"),
		
		"show_post_tags" => array(
					"title" => esc_html__('Show post tags',  'yacht-rental'),
					"desc" => wp_kses_data( __("Show tags block on single post page", 'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "yes",
					"options" => yacht_rental_get_options_param('list_yes_no'),
					"type" => "switch"),
		
		
		
		// Blog -> Other parameters
		//-------------------------------------------------
		
		'blog_tab_other' => array(
					"title" => esc_html__('Other parameters', 'yacht-rental'),
					"icon" => "iconadmin-newspaper",
					"override" => "category,services_group,page,custom",
					"type" => "tab"),
		
		"info_blog_other_1" => array(
					"title" => esc_html__('Other Blog parameters', 'yacht-rental'),
					"desc" => wp_kses_data( __('Select excluded categories, substitute parameters, etc.', 'yacht-rental') ),
					"type" => "info"),
		
		"exclude_cats" => array(
					"title" => esc_html__('Exclude categories', 'yacht-rental'),
					"desc" => wp_kses_data( __('Select categories, which posts are exclude from blog page', 'yacht-rental') ),
					"std" => "",
					"options" => yacht_rental_get_options_param('list_categories'),
					"multiple" => true,
					"style" => "list",
					"type" => "select"),
		
		"blog_pagination" => array(
					"title" => esc_html__('Blog pagination', 'yacht-rental'),
					"desc" => wp_kses_data( __('Select type of the pagination on blog streampages', 'yacht-rental') ),
					"std" => "pages",
					"override" => "category,services_group,page,custom",
					"options" => array(
						'pages'    => esc_html__('Standard page numbers', 'yacht-rental'),
					),
					"dir" => "vertical",
					"type" => "radio"),
		
		"blog_counters" => array(
					"title" => esc_html__('Blog counters', 'yacht-rental'),
					"desc" => wp_kses_data( __('Select counters, displayed near the post title', 'yacht-rental') ),
					"override" => "category,services_group,page,custom",
					"std" => "views",
					"options" => yacht_rental_get_options_param('list_blog_counters'),
					"dir" => "vertical",
					"multiple" => true,
					"type" => "checklist"),
		
		"close_category" => array(
					"title" => esc_html__("Post's category announce", 'yacht-rental'),
					"desc" => wp_kses_data( __('What category display in announce block (over posts thumb) - original or nearest parental', 'yacht-rental') ),
					"override" => "category,services_group,page,custom",
					"std" => "parental",
					"options" => array(
						'parental' => esc_html__('Nearest parental category', 'yacht-rental'),
						'original' => esc_html__("Original post's category", 'yacht-rental')
					),
					"dir" => "vertical",
					"type" => "radio"),
		
		"show_date_after" => array(
					"title" => esc_html__('Show post date after', 'yacht-rental'),
					"desc" => wp_kses_data( __('Show post date after N days (before - show post age)', 'yacht-rental') ),
					"override" => "category,services_group,page,custom",
					"std" => "30",
					"mask" => "?99",
					"type" => "text"),
		
		
		
		
		




		//###############################
		//#### Media                #### 
		//###############################
		"partition_media" => array(
					"title" => esc_html__('Media', 'yacht-rental'),
					"icon" => "iconadmin-picture",
					"override" => "category,services_group,post,page,custom",
					"type" => "partition"),
		
		"info_media_1" => array(
					"title" => esc_html__('Media settings', 'yacht-rental'),
					"desc" => wp_kses_data( __('Set up parameters to show images, galleries, audio and video posts', 'yacht-rental') ),
					"override" => "category,services_group,services_group",
					"type" => "info"),
					
		"retina_ready" => array(
					"title" => esc_html__('Image dimensions', 'yacht-rental'),
					"desc" => wp_kses_data( __('What dimensions use for uploaded image: Original or "Retina ready" (twice enlarged)', 'yacht-rental') ),
					"std" => "1",
					"size" => "medium",
					"options" => array(
						"1" => esc_html__("Original", 'yacht-rental'), 
						"2" => esc_html__("Retina", 'yacht-rental')
					),
					"type" => "switch"),
		
		"images_quality" => array(
					"title" => esc_html__('Quality for cropped images', 'yacht-rental'),
					"desc" => wp_kses_data( __('Quality (1-100) to save cropped images', 'yacht-rental') ),
					"std" => "70",
					"min" => 1,
					"max" => 100,
					"type" => "spinner"),
		
		"substitute_gallery" => array(
					"title" => esc_html__('Substitute standard Wordpress gallery', 'yacht-rental'),
					"desc" => wp_kses_data( __('Substitute standard Wordpress gallery with our slider on the single pages', 'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "no",
					"options" => yacht_rental_get_options_param('list_yes_no'),
					"type" => "switch"),
		
		"gallery_instead_image" => array(
					"title" => esc_html__('Show gallery instead featured image', 'yacht-rental'),
					"desc" => wp_kses_data( __('Show slider with gallery instead featured image on blog streampage and in the related posts section for the gallery posts', 'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "yes",
					"options" => yacht_rental_get_options_param('list_yes_no'),
					"type" => "switch"),
		
		"gallery_max_slides" => array(
					"title" => esc_html__('Max images number in the slider', 'yacht-rental'),
					"desc" => wp_kses_data( __('Maximum images number from gallery into slider', 'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"dependency" => array(
						'gallery_instead_image' => array('yes')
					),
					"std" => "5",
					"min" => 2,
					"max" => 10,
					"type" => "spinner"),
		
		"popup_engine" => array(
					"title" => esc_html__('Popup engine to zoom images', 'yacht-rental'),
					"desc" => wp_kses_data( __('Select engine to show popup windows with images and galleries', 'yacht-rental') ),
					"std" => "magnific",
					"options" => yacht_rental_get_options_param('list_popups'),
					"type" => "select"),
		
		"substitute_audio" => array(
					"title" => esc_html__('Substitute audio tags', 'yacht-rental'),
					"desc" => wp_kses_data( __('Substitute audio tag with source from soundcloud to embed player', 'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "yes",
					"options" => yacht_rental_get_options_param('list_yes_no'),
					"type" => "switch"),
		
		"substitute_video" => array(
					"title" => esc_html__('Substitute video tags', 'yacht-rental'),
					"desc" => wp_kses_data( __('Substitute video tags with embed players or leave video tags unchanged (if you use third party plugins for the video tags)', 'yacht-rental') ),
					"override" => "category,services_group,post,page,custom",
					"std" => "yes",
					"options" => yacht_rental_get_options_param('list_yes_no'),
					"type" => "switch"),
		
		"use_mediaelement" => array(
					"title" => esc_html__('Use Media Element script for audio and video tags', 'yacht-rental'),
					"desc" => wp_kses_data( __('Do you want use the Media Element script for all audio and video tags on your site or leave standard HTML5 behaviour?', 'yacht-rental') ),
					"std" => "yes",
					"options" => yacht_rental_get_options_param('list_yes_no'),
					"type" => "switch"),
		
		
		
		
		//###############################
		//#### Socials               #### 
		//###############################
		"partition_socials" => array(
					"title" => esc_html__('Socials', 'yacht-rental'),
					"icon" => "iconadmin-users",
					"override" => "category,services_group,page,custom",
					"type" => "partition"),
		
		"info_socials_1" => array(
					"title" => esc_html__('Social networks', 'yacht-rental'),
					"desc" => wp_kses_data( __("Social networks list for site footer and Social widget", 'yacht-rental') ),
					"type" => "info"),
		
		"social_icons" => array(
					"title" => esc_html__('Social networks',  'yacht-rental'),
					"desc" => wp_kses_data( __('Select icon and write URL to your profile in desired social networks.',  'yacht-rental') ),
					"std" => array(array('url'=>'', 'icon'=>'')),
					"cloneable" => true,
					"size" => "small",
					"style" => $socials_type,
					"options" => $socials_type=='images' ? yacht_rental_get_options_param('list_socials') : yacht_rental_get_options_param('list_icons'),
					"type" => "socials"),
		
					"info_socials_2" => array(
						"title" => esc_html__('Share buttons', 'yacht-rental'),
						"desc" => wp_kses_data(  esc_html__("Add button's code for each social share network.",'yacht-rental')).'<br>'
						.wp_kses_data(  esc_html__("In share url you can use next macro:",'yacht-rental')).'<br>'
						.wp_kses_data(  sprintf(esc_html__("%s - share post (page) URL,",'yacht-rental'), '<b>{url}</b>')).'<br>'
						.wp_kses_data(  sprintf(esc_html__("%s - post title,",'yacht-rental'), '<b>{title}</b>')).'<br>'
						.wp_kses_data(  sprintf(esc_html__("%s - post image,",'yacht-rental'), '<b>{image}</b>')).'<br>'
						.wp_kses_data(  sprintf(esc_html__("%s - post description (if supported)",'yacht-rental'), '<b>{descr}</b>')).'<br>'
						.wp_kses_data(  esc_html__("For example:",'yacht-rental')).'<br>'
						.wp_kses_data(  sprintf(esc_html__("%s share string: %s",'yacht-rental'), '<b>Facebook</b>','<em>http://www.facebook.com/sharer.php?u={link}&amp;t={title}</em>' )).'<br>'
						.wp_kses_data(  sprintf(esc_html__("%s share string: %s",'yacht-rental'), '<b>Delicious</b>','<em>http://delicious.com/save?url={link}&amp;title={title}&amp;note={descr}</em>' )),
					"override" => "category,services_group,page,custom",
					"type" => "info"),
		
		"show_share" => array(
					"title" => esc_html__('Show social share buttons',  'yacht-rental'),
					"desc" => wp_kses_data( __("Show social share buttons block", 'yacht-rental') ),
					"override" => "category,services_group,page,custom",
					"std" => "horizontal",
					"options" => array(
						'hide'		=> esc_html__('Hide', 'yacht-rental'),
						'horizontal'=> esc_html__('Horizontal', 'yacht-rental')
					),
					"type" => "checklist"),
		
		"share_buttons" => array(
					"title" => esc_html__('Share buttons',  'yacht-rental'),
					"desc" => wp_kses_data( __('Select icon and write share URL for desired social networks.<br><b>Important!</b> If you leave text field empty - internal theme link will be used (if present).',  'yacht-rental') ),
					"dependency" => array(
						'show_share' => array('vertical', 'horizontal')
					),
					"std" => array(array('url'=>'', 'icon'=>'')),
					"cloneable" => true,
					"size" => "small",
					"style" => $socials_type,
					"options" => $socials_type=='images' ? yacht_rental_get_options_param('list_socials') : yacht_rental_get_options_param('list_icons'),
					"type" => "socials"),
		
		
		"info_socials_4" => array(
					"title" => esc_html__('Google API Keys', 'yacht-rental'),
					"desc" => wp_kses_data( __('API Keys for some Web services', 'yacht-rental') ),
					"type" => "info"),
		'api_google' => array(
					"title" => esc_html__('Google API Key for browsers', 'yacht-rental'),
					"desc" => wp_kses_data( __("Insert Google API Key for browsers into the field above to generate Google Maps", 'yacht-rental') ),
					"std" => "",
					"type" => "text"),
		
		"info_socials_5" => array(
					"title" => esc_html__('Login via Socials', 'yacht-rental'),
					"desc" => wp_kses_data( __('Settings for the Login via Social networks', 'yacht-rental') ),
					"type" => "info"),
		
		"social_login" => array(
					"title" => esc_html__('Shortcode or any HTML/JS code',  'yacht-rental'),
					"desc" => wp_kses_data( __('Specify shortcode from your Social Login Plugin or any HTML/JS code to make Social Login section',  'yacht-rental') ),
					"std" => "",
					"type" => "textarea"),
		
		
		
		
		//###############################
		//#### Contact info          #### 
		//###############################
		"partition_contacts" => array(
					"title" => esc_html__('Contact info', 'yacht-rental'),
					"icon" => "iconadmin-mail",
					"type" => "partition"),
		
		"info_contact_1" => array(
					"title" => esc_html__('Contact information', 'yacht-rental'),
					"desc" => wp_kses_data( __('Company address, phones and e-mail', 'yacht-rental') ),
					"type" => "info"),
		
		
		"contact_email" => array(
					"title" => esc_html__('Contact form email', 'yacht-rental'),
					"desc" => wp_kses_data( __('E-mail for send contact form and user registration data', 'yacht-rental') ),
					"std" => "",
					"before" => array('icon'=>'iconadmin-mail'),
					"type" => "text"),
		
		"contact_address_1" => array(
					"title" => esc_html__('Company address (part 1)', 'yacht-rental'),
					"desc" => wp_kses_data( __('Company country, post code and city', 'yacht-rental') ),
					"std" => "",
					"before" => array('icon'=>'iconadmin-home'),
					"type" => "text"),
		
		"contact_address_2" => array(
					"title" => esc_html__('Company address (part 2)', 'yacht-rental'),
					"desc" => wp_kses_data( __('Street and house number', 'yacht-rental') ),
					"std" => "",
					"before" => array('icon'=>'iconadmin-home'),
					"type" => "text"),
		
		"contact_phone" => array(
					"title" => esc_html__('Phone', 'yacht-rental'),
					"desc" => wp_kses_data( __('Phone number', 'yacht-rental') ),
					"std" => "",
					"before" => array('icon'=>'iconadmin-phone'),
					"allow_html" => true,
					"type" => "text"),
		
		"contact_fax" => array(
					"title" => esc_html__('Fax', 'yacht-rental'),
					"desc" => wp_kses_data( __('Fax number', 'yacht-rental') ),
					"std" => "",
					"before" => array('icon'=>'iconadmin-phone'),
					"allow_html" => true,
					"type" => "text"),
		
		"info_contact_2" => array(
					"title" => esc_html__('Contact and Comments form', 'yacht-rental'),
					"desc" => wp_kses_data( __('Maximum length of the messages in the contact form shortcode and in the comments form', 'yacht-rental') ),
					"type" => "info"),
		
		"message_maxlength_contacts" => array(
					"title" => esc_html__('Contact form message', 'yacht-rental'),
					"desc" => wp_kses_data( __("Message's maxlength in the contact form shortcode", 'yacht-rental') ),
					"std" => "1000",
					"min" => 0,
					"max" => 10000,
					"step" => 100,
					"type" => "spinner"),
		
		"message_maxlength_comments" => array(
					"title" => esc_html__('Comments form message', 'yacht-rental'),
					"desc" => wp_kses_data( __("Message's maxlength in the comments form", 'yacht-rental') ),
					"std" => "1000",
					"min" => 0,
					"max" => 10000,
					"step" => 100,
					"type" => "spinner"),
		
		"info_contact_3" => array(
					"title" => esc_html__('Default mail function', 'yacht-rental'),
					"desc" => wp_kses_data( __('What function use to send mail: the built-in Wordpress wp_mail or standard PHP mail function? Attention! Some plugins may not work with one of them and you always have the ability to switch to alternative.', 'yacht-rental') ),
					"type" => "info"),
		
		"mail_function" => array(
					"title" => esc_html__("Mail function", 'yacht-rental'),
					"desc" => wp_kses_data( __("What function use to send mail? Attention! Only wp_mail support attachment in the mail!", 'yacht-rental') ),
					"std" => "wp_mail",
					"size" => "medium",
					"options" => array(
						'wp_mail' => esc_html__('WP mail', 'yacht-rental'),
						'mail' => esc_html__('PHP mail', 'yacht-rental')
					),
					"type" => "switch"),
		
		
		
		
		
		
		
		
		
		//###############################
		//#### Service               #### 
		//###############################
		
		"partition_service" => array(
					"title" => esc_html__('Service', 'yacht-rental'),
					"icon" => "iconadmin-wrench",
					"type" => "partition"),
		
		"info_service_1" => array(
					"title" => esc_html__('Theme functionality', 'yacht-rental'),
					"desc" => wp_kses_data( __('Basic theme functionality settings', 'yacht-rental') ),
					"type" => "info"),
		
		"use_ajax_views_counter" => array(
					"title" => esc_html__('Use AJAX post views counter', 'yacht-rental'),
					"desc" => wp_kses_data( __('Use javascript for post views count (if site work under the caching plugin) or increment views count in single page template', 'yacht-rental') ),
					"std" => "no",
					"options" => yacht_rental_get_options_param('list_yes_no'),
					"type" => "switch"),
		
		"allow_editor" => array(
					"title" => esc_html__('Frontend editor',  'yacht-rental'),
					"desc" => wp_kses_data( __("Allow authors to edit their posts in frontend area", 'yacht-rental') ),
					"std" => "no",
					"options" => yacht_rental_get_options_param('list_yes_no'),
					"type" => "switch"),

		"admin_add_filters" => array(
					"title" => esc_html__('Additional filters in the admin panel', 'yacht-rental'),
					"desc" => wp_kses_data( __('Show additional filters (on post formats, tags and categories) in admin panel page "Posts". <br>Attention! If you have more than 2.000-3.000 posts, enabling this option may cause slow load of the "Posts" page! If you encounter such slow down, simply open Appearance - Theme Options - Service and set "No" for this option.', 'yacht-rental') ),
					"std" => "no",
					"options" => yacht_rental_get_options_param('list_yes_no'),
					"type" => "switch"),

		"show_overriden_taxonomies" => array(
					"title" => esc_html__('Show overriden options for taxonomies', 'yacht-rental'),
					"desc" => wp_kses_data( __('Show extra column in categories list, where changed (overriden) theme options are displayed.', 'yacht-rental') ),
					"std" => "yes",
					"options" => yacht_rental_get_options_param('list_yes_no'),
					"type" => "switch"),

		"show_overriden_posts" => array(
					"title" => esc_html__('Show overriden options for posts and pages', 'yacht-rental'),
					"desc" => wp_kses_data( __('Show extra column in posts and pages list, where changed (overriden) theme options are displayed.', 'yacht-rental') ),
					"std" => "yes",
					"options" => yacht_rental_get_options_param('list_yes_no'),
					"type" => "switch"),
		
		"admin_dummy_data" => array(
					"title" => esc_html__('Enable Dummy Data Installer', 'yacht-rental'),
					"desc" => wp_kses_data( __('Show "Install Dummy Data" in the menu "Appearance". <b>Attention!</b> When you install dummy data all content of your site will be replaced!', 'yacht-rental') ),
					"std" => "yes",
					"options" => yacht_rental_get_options_param('list_yes_no'),
					"type" => "switch"),

		"admin_dummy_timeout" => array(
					"title" => esc_html__('Dummy Data Installer Timeout',  'yacht-rental'),
					"desc" => wp_kses_data( __('Web-servers set the time limit for the execution of php-scripts. By default, this is 30 sec. Therefore, the import process will be split into parts. Upon completion of each part - the import will resume automatically! The import process will try to increase this limit to the time, specified in this field.',  'yacht-rental') ),
					"std" => 120,
					"min" => 30,
					"max" => 1800,
					"type" => "spinner"),
		
		"debug_mode" => array(
					"title" => esc_html__('Debug mode', 'yacht-rental'),
					"desc" => wp_kses_data( __('In debug mode we are using unpacked scripts and styles, else - using minified scripts and styles (if present). <b>Attention!</b> If you have modified the source code in the js or css files, regardless of this option will be used latest (modified) version stylesheets and scripts. You can re-create minified versions of files using on-line services or utilities', 'yacht-rental') ),
					"std" => "no",
					"options" => yacht_rental_get_options_param('list_yes_no'),
					"type" => "switch"),
			
			
			
		//###############################
		//#### Boat               #### 
		//###############################
		
		"partition_boat" => array(
			"title" => esc_html__('Boat', 'yacht-rental'),
			"icon" => "iconadmin-info-circled",
			"type" => "partition"),
		
		"info_service_1" => array(
			"title" => esc_html__('Theme functionality', 'yacht-rental'),
			"desc" => wp_kses_data( __('Basic theme functionality settings', 'yacht-rental') ),
			"type" => "info"),
			
		"boat_location_list" => array(
			"title" => esc_html__('Boat location list', 'yacht-rental'),
			"desc" => wp_kses_data( __('Boat location list', 'yacht-rental') ),
			"std" => esc_html__("Asia,Bahamas,Caribbean,Central &amp; south america,Cuba,Europe - Atlantic,Indian Ocean,Mediterranean Sea,Pacific Ocean,USA", 'yacht-rental'),
			"type" => "tags"),
			
		"boat_type_list" => array(
			"title" => esc_html__('Boat type list', 'yacht-rental'),
			"desc" => wp_kses_data( __('Boat type list', 'yacht-rental') ),
			"std" => esc_html__("Catamaran,Monohull,Motor boat,Powered catamaran,Rib Boat,Semi rigid", 'yacht-rental'),
			"type" => "tags"),
			
		"boat_price_sign_list" => array(
			"title" => esc_html__('Currency Available', 'yacht-rental'),
			"desc" => wp_kses_data( __('Add your currecy and press Enter/Return Button', 'yacht-rental') ),
			"std" => esc_html__("$,&euro;", 'yacht-rental'),
			"type" => "tags"),
			
		"boat_price_per_list" => array(
			"title" => esc_html__('Rent Term', 'yacht-rental'),
			"desc" => wp_kses_data( __('Add available rent term here and press  Enter/Return Button', 'yacht-rental') ),
			"std" => esc_html__("year,month,week,day", 'yacht-rental'),
			"type" => "tags"),
			
		"boat_amenities_list" => array(
			"title" => esc_html__('Boat amenities list', 'yacht-rental'),
			"desc" => wp_kses_data( __('Boat amenities list', 'yacht-rental') ),
			"std" => esc_html__("Events and Meetings,Scuba Gear,Hot Tub/Jacuzzi on Deck,Sport Fishing,Speciality Classic Yacht,Gulet", 'yacht-rental'),
			"type" => "tags"),
			
		"boat_addon_list" => array(
			"title" => esc_html__("Boat add-on's list", 'yacht-rental'),
			"desc" => wp_kses_data( __('Boat add-on\'s list', 'yacht-rental') ),
			"std" => esc_html__("Bimini Top,Front Fishing Seats,Fish Finder,Deck Chairs", 'yacht-rental'),
			"type" => "tags"),
			
		"boat_search_length" => array(
			"title" => esc_html__('Boat search length max', 'yacht-rental'),
			"desc" => wp_kses_data( __('Boat search length max', 'yacht-rental') ),
			"std" => "100",
			"type" => "text"),

		"boat_search_price_max" => array(
			"title" => esc_html__('Boat search price max', 'yacht-rental'),
			"desc" => wp_kses_data( __('Boat search price max', 'yacht-rental') ),
			"std" => "10000",
			"type" => "text"),
			
		)));

	}
}


// Update all temporary vars (start with $yacht_rental_) in the Theme Options with actual lists
if ( !function_exists( 'yacht_rental_options_settings_theme_setup2' ) ) {
	add_action( 'yacht_rental_action_after_init_theme', 'yacht_rental_options_settings_theme_setup2', 1 );
	function yacht_rental_options_settings_theme_setup2() {
		if (yacht_rental_options_is_used()) {
			// Replace arrays with actual parameters
			$lists = array();
			$tmp = yacht_rental_storage_get('options');
			if (is_array($tmp) && count($tmp) > 0) {
				$prefix = '$yacht_rental_';
				$prefix_len = yacht_rental_strlen($prefix);
				foreach ($tmp as $k=>$v) {
					if (isset($v['options']) && is_array($v['options']) && count($v['options']) > 0) {
						foreach ($v['options'] as $k1=>$v1) {
							if (yacht_rental_substr($k1, 0, $prefix_len) == $prefix || yacht_rental_substr($v1, 0, $prefix_len) == $prefix) {
								$list_func = yacht_rental_substr(yacht_rental_substr($k1, 0, $prefix_len) == $prefix ? $k1 : $v1, 1);
								$inherit = strpos($list_func, '(true)')!==false;
								$list_func = str_replace('(true)', '', $list_func);
								unset($tmp[$k]['options'][$k1]);
								if (isset($lists[$list_func]))
									$tmp[$k]['options'] = yacht_rental_array_merge($tmp[$k]['options'], $lists[$list_func]);
								else {
									if (function_exists($list_func)) {
										$tmp[$k]['options'] = $lists[$list_func] = yacht_rental_array_merge($tmp[$k]['options'], $list_func($inherit));
								   	} else
								   		dfl(sprintf(esc_html__('Wrong function name %s in the theme options array', 'yacht-rental'), $list_func));
								}
							}
						}
					}
				}
				yacht_rental_storage_set('options', $tmp);
			}
		}
	}
}



// Reset old Theme Options while theme first run
if ( !function_exists( 'yacht_rental_options_reset' ) ) {
	function yacht_rental_options_reset($clear=true) {
		$theme_slug = str_replace(' ', '_', trim(yacht_rental_strtolower(get_stylesheet())));
		$option_name = yacht_rental_storage_get('options_prefix') . '_' . trim($theme_slug) . '_options_reset';
		if ( get_option($option_name, false) === false ) {	
			if ($clear) {
				// Remove Theme Options from WP Options
				global $wpdb;
				$wpdb->query( $wpdb->prepare(
										"DELETE FROM {$wpdb->options} WHERE option_name LIKE %s",
										yacht_rental_storage_get('options_prefix').'_%'
										)
							);
				// Add Templates Options

				$txt = yacht_rental_fgc(yacht_rental_storage_get('demo_data_url') . 'default/templates_options.txt');
				if (!empty($txt)) {
					$data = yacht_rental_unserialize($txt);
					// Replace upload url in options
					if (is_array($data) && count($data) > 0) {
						foreach ($data as $k=>$v) {
							if (is_array($v) && count($v) > 0) {
								foreach ($v as $k1=>$v1) {
									$v[$k1] = yacht_rental_replace_uploads_url(yacht_rental_replace_uploads_url($v1, 'uploads'), 'imports');
								}
							}
							add_option( $k, $v, '', 'yes' );
						}
					}
				}
			}
			add_option($option_name, 1, '', 'yes');
		}
	}
}
?>