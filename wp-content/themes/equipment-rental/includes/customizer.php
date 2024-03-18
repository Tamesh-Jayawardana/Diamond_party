<?php

if ( class_exists("Kirki")){

	Kirki::add_config('theme_config_id', array(
		'capability'   =>  'edit_theme_options',
		'option_type'  =>  'theme_mod',
	));

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'slider',
		'settings'    => 'equipment_rental_logo_resizer',
		'label'       => esc_html__( 'Adjust Logo Size', 'equipment-rental' ),
		'section'     => 'title_tagline',
		'default'     => 70,
		'choices'     => [
			'min'  => 10,
			'max'  => 300,
			'step' => 10,
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'equipment_rental_enable_logo_text',
		'section'     => 'title_tagline',
		'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Enable / Disable Site Title and Tagline', 'equipment-rental' ) . '</h3>',
		'priority'    => 10,
	] );

  	Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'equipment_rental_display_header_title',
		'label'       => esc_html__( 'Site Title Enable / Disable Button', 'equipment-rental' ),
		'section'     => 'title_tagline',
		'default'     => '1',
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'equipment-rental' ),
			'off' => esc_html__( 'Disable', 'equipment-rental' ),
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'equipment_rental_display_header_text',
		'label'       => esc_html__( 'Tagline Enable / Disable Button', 'equipment-rental' ),
		'section'     => 'title_tagline',
		'default'     => '0',
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'equipment-rental' ),
			'off' => esc_html__( 'Disable', 'equipment-rental' ),
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'equipment_rental_site_tittle_font_heading',
		'section'     => 'title_tagline',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Site Title Font Size', 'equipment-rental' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'equipment_rental_site_tittle_font_size',
		'type'        => 'number',
		'section'     => 'title_tagline',
		'transport' => 'auto',
		'output' => array(
			array(
				'element'  => array('.logo a'),
				'property' => 'font-size',
				'suffix' => 'px'
			),
		),
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'equipment_rental_site_tittle_transform_heading',
		'section'     => 'title_tagline',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Site Title Text Transform', 'equipment-rental' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'select',
		'settings'    => 'equipment_rental_site_tittle_transform',
		'section'     => 'title_tagline',
		'default'     => 'none',
		'choices'     => [
			'none' => esc_html__( 'Normal', 'equipment-rental' ),
			'uppercase' => esc_html__( 'Uppercase', 'equipment-rental' ),
			'lowercase' => esc_html__( 'Lowercase', 'equipment-rental' ),
			'capitalize' => esc_html__( 'Capitalize', 'equipment-rental' ),
		],
		'output' => array(
			array(
				'element'  => array( '.logo a'),
				'property' => ' text-transform',
			),
		),
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'equipment_rental_site_tagline_font_heading',
		'section'     => 'title_tagline',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Site Tagline Font Size', 'equipment-rental' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'equipment_rental_site_tagline_font_size',
		'type'        => 'number',
		'section'     => 'title_tagline',
		'transport' => 'auto',
		'output' => array(
			array(
				'element'  => array('.logo span'),
				'property' => 'font-size',
				'suffix' => 'px'
			),
		),
	) );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'custom',
		'settings'    => 'equipment_rental_logo_settings_premium_features',
		'section'     => 'title_tagline',
		'priority'    => 50,
		'default'     => '<h3 style="color: #2271b1; padding:5px 20px 5px 20px; background:#fff; margin:0;  box-shadow: 0 2px 4px rgba(0,0,0, .2); ">' . esc_html__( 'Unlock More Features in the Premium Version!', 'equipment-rental' ) . '</h3><ul style="color: #121212; padding: 5px 20px 20px 30px; background:#fff; margin:0;" ><li style="list-style-type: square;" >' . esc_html__( 'Customizable Text Logo', 'equipment-rental' ) . '</li><li style="list-style-type: square;" >'.esc_html__( 'Enhanced Typography Options', 'equipment-rental' ) .'</li><li style="list-style-type: square;" >'.esc_html__( 'Priority Support', 'equipment-rental' ) .'</li><li style="list-style-type: square;" >'.esc_html__( '....and Much More', 'equipment-rental' ) . '</li></ul><div style="background: #fff; padding: 0px 10px 10px 20px;"><a href="' . esc_url( __( 'https://www.wpelemento.com/elementor/equipment-rental-wordpress-theme/', 'equipment-rental' ) ) . '" class="button button-primary" target="_blank">'. esc_html__( 'Upgrade for more', 'equipment-rental' ) .'</a></div>',
	) );

	// TYPOGRAPHY SETTINGS

	Kirki::add_panel( 'equipment_rental_typography_panel', array(
		'priority' => 10,
		'title'    => __( 'Typography', 'equipment-rental' ),
	) );

	//Heading 1 Section

	Kirki::add_section( 'equipment_rental_h1_typography_setting', array(
		'title'    => __( 'Heading 1', 'equipment-rental' ),
		'panel'    => 'equipment_rental_typography_panel',
		'priority' => 0,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'equipment_rental_h1_typography_heading',
		'section'     => 'equipment_rental_h1_typography_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Heading 1 Typography', 'equipment-rental' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'  =>  'typography',
		'settings'  => 'equipment_rental_h1_typography_font',
		'section'   =>  'equipment_rental_h1_typography_setting',
		'default'   =>  [
			'font-family'   =>  'Plus Jakarta Sans',
			'variant'       =>  '700',
			'font-size'       => '',
			'line-height'   =>  '',
			'letter-spacing'    =>  '',
			'text-transform'    =>  '',
		],
		'transport'     =>  'auto',
		'output'        =>  [
			[
				'element'   =>  'h1',
				'suffix' => '!important'
			],
		],
	) );

	//Heading 2 Section

	Kirki::add_section( 'equipment_rental_h2_typography_setting', array(
		'title'    => __( 'Heading 2', 'equipment-rental' ),
		'panel'    => 'equipment_rental_typography_panel',
		'priority' => 0,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'equipment_rental_h2_typography_heading',
		'section'     => 'equipment_rental_h2_typography_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Heading 2 Typography', 'equipment-rental' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'  =>  'typography',
		'settings'  => 'equipment_rental_h2_typography_font',
		'section'   =>  'equipment_rental_h2_typography_setting',
		'default'   =>  [
			'font-family'   =>  'Plus Jakarta Sans',
			'font-size'       => '',
			'variant'       =>  '700',
			'line-height'   =>  '',
			'letter-spacing'    =>  '',
			'text-transform'    =>  '',
		],
		'transport'     =>  'auto',
		'output'        =>  [
			[
				'element'   =>  'h2',
				'suffix' => '!important'
			],
		],
	) );

	//Heading 3 Section

	Kirki::add_section( 'equipment_rental_h3_typography_setting', array(
		'title'    => __( 'Heading 3', 'equipment-rental' ),
		'panel'    => 'equipment_rental_typography_panel',
		'priority' => 0,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'equipment_rental_h3_typography_heading',
		'section'     => 'equipment_rental_h3_typography_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Heading 3 Typography', 'equipment-rental' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'  =>  'typography',
		'settings'  => 'equipment_rental_h3_typography_font',
		'section'   =>  'equipment_rental_h3_typography_setting',
		'default'   =>  [
			'font-family'   =>  'Plus Jakarta Sans',
			'variant'       =>  '700',
			'font-size'       => '',
			'line-height'   =>  '',
			'letter-spacing'    =>  '',
			'text-transform'    =>  '',
		],
		'transport'     =>  'auto',
		'output'        =>  [
			[
				'element'   =>  'h3',
				'suffix' => '!important'
			],
		],
	) );

	//Heading 4 Section

	Kirki::add_section( 'equipment_rental_h4_typography_setting', array(
		'title'    => __( 'Heading 4', 'equipment-rental' ),
		'panel'    => 'equipment_rental_typography_panel',
		'priority' => 0,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'equipment_rental_h4_typography_heading',
		'section'     => 'equipment_rental_h4_typography_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Heading 4 Typography', 'equipment-rental' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'  =>  'typography',
		'settings'  => 'equipment_rental_h4_typography_font',
		'section'   =>  'equipment_rental_h4_typography_setting',
		'default'   =>  [
			'font-family'   =>  'Plus Jakarta Sans',
			'variant'       =>  '700',
			'font-size'       => '',
			'line-height'   =>  '',
			'letter-spacing'    =>  '',
			'text-transform'    =>  '',
		],
		'transport'     =>  'auto',
		'output'        =>  [
			[
				'element'   =>  'h4',
				'suffix' => '!important'
			],
		],
	) );

	//Heading 5 Section

	Kirki::add_section( 'equipment_rental_h5_typography_setting', array(
		'title'    => __( 'Heading 5', 'equipment-rental' ),
		'panel'    => 'equipment_rental_typography_panel',
		'priority' => 0,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'equipment_rental_h5_typography_heading',
		'section'     => 'equipment_rental_h5_typography_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Heading 5 Typography', 'equipment-rental' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'  =>  'typography',
		'settings'  => 'equipment_rental_h5_typography_font',
		'section'   =>  'equipment_rental_h5_typography_setting',
		'default'   =>  [
			'font-family'   =>  'Plus Jakarta Sans',
			'variant'       =>  '700',
			'font-size'       => '',
			'line-height'   =>  '',
			'letter-spacing'    =>  '',
			'text-transform'    =>  '',
		],
		'transport'     =>  'auto',
		'output'        =>  [
			[
				'element'   =>  'h5',
				'suffix' => '!important'
			],
		],
	) );

	//Heading 6 Section

	Kirki::add_section( 'equipment_rental_h6_typography_setting', array(
		'title'    => __( 'Heading 6', 'equipment-rental' ),
		'panel'    => 'equipment_rental_typography_panel',
		'priority' => 0,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'equipment_rental_h6_typography_heading',
		'section'     => 'equipment_rental_h6_typography_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Heading 6 Typography', 'equipment-rental' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'  =>  'typography',
		'settings'  => 'equipment_rental_h6_typography_font',
		'section'   =>  'equipment_rental_h6_typography_setting',
		'default'   =>  [
			'font-family'   =>  'Plus Jakarta Sans',
			'variant'       =>  '700',
			'font-size'       => '',
			'line-height'   =>  '',
			'letter-spacing'    =>  '',
			'text-transform'    =>  '',
		],
		'transport'     =>  'auto',
		'output'        =>  [
			[
				'element'   =>  'h6',
				'suffix' => '!important'
			],
		],
	) );

	//body Typography

	Kirki::add_section( 'equipment_rental_body_typography_setting', array(
		'title'    => __( 'Content Typography', 'equipment-rental' ),
		'panel'    => 'equipment_rental_typography_panel',
		'priority' => 0,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'equipment_rental_body_typography_heading',
		'section'     => 'equipment_rental_body_typography_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Content  Typography', 'equipment-rental' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'  =>  'typography',
		'settings'  => 'equipment_rental_body_typography_font',
		'section'   =>  'equipment_rental_body_typography_setting',
		'default'   =>  [
			'font-family'   =>  'Plus Jakarta Sans',
			'variant'       =>  '',
		],
		'transport'     =>  'auto',
		'output'        =>  [
			[
				'element'   => 'body',
				'suffix' => '!important'
			],
		],
	) );

	// Theme Options Panel
	Kirki::add_panel( 'equipment_rental_theme_options_panel', array(
		'priority' => 10,
		'title'    => __( 'Theme Options', 'equipment-rental' ),
	) );

	// HEADER SECTION

	Kirki::add_section( 'equipment_rental_section_header',array(
			'title' => esc_html__( 'Header Settings', 'equipment-rental' ),
			'description'    => esc_html__( 'Here you can add header information.', 'equipment-rental' ),
			'panel' => 'equipment_rental_theme_options_panel',
			'tabs'  => [
				'header' => [
					'label' => esc_html__( 'Header', 'equipment-rental' ),
				],
				'menu'  => [
					'label' => esc_html__( 'Menu', 'equipment-rental' ),
				],
			],
			'priority'       => 160,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'menu',
		'settings'    => 'equipment_rental_menu_size_heading',
		'section'     => 'equipment_rental_section_header',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Menu Font Size(px)', 'equipment-rental' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'equipment_rental_menu_size',
		'tab'      => 'menu',
		'label'       => __( 'Enter a value in pixels. Example:20px', 'equipment-rental' ),
		'type'        => 'text',
		'section'     => 'equipment_rental_section_header',
		'transport' => 'auto',
		'output' => array(
			array(
				'element'  => array( '#main-menu a', '#main-menu ul li a', '#main-menu li a'),
				'property' => 'font-size',
			),
		),
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'menu',
		'settings'    => 'equipment_rental_menu_text_transform_heading',
		'section'     => 'equipment_rental_section_header',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Menu Text Transform', 'equipment-rental' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'select',
		'tab'      => 'menu',
		'settings'    => 'equipment_rental_menu_text_transform',
		'section'     => 'equipment_rental_section_header',
		'default'     => 'capitalize',
		'choices'     => [
			'none' => esc_html__( 'Normal', 'equipment-rental' ),
			'uppercase' => esc_html__( 'Uppercase', 'equipment-rental' ),
			'lowercase' => esc_html__( 'Lowercase', 'equipment-rental' ),
			'capitalize' => esc_html__( 'Capitalize', 'equipment-rental' ),
		],
		'output' => array(
			array(
				'element'  => array( '#main-menu a', '#main-menu ul li a', '#main-menu li a'),
				'property' => ' text-transform',
			),
		),
	 ) );


	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'header',
		'settings'    => 'equipment_rental_enable_email_heading',
		'section'     => 'equipment_rental_section_header',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Add Email Address', 'equipment-rental' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'tab'      => 'header',
		'settings' => 'equipment_rental_header_email',
		'section'  => 'equipment_rental_section_header',
		'default'  => '',
		'sanitize_callback' => 'sanitize_email',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'header',
		'settings'    => 'equipment_rental_header_phone_number_heading',
		'section'     => 'equipment_rental_section_header',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Add Phone Number', 'equipment-rental' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'tab'      => 'header',
		'settings' => 'equipment_rental_header_phone_number',
		'section'  => 'equipment_rental_section_header',
		'default'  => '',
		'sanitize_callback' => 'equipment_rental_sanitize_phone_number',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'header',
		'settings'    => 'equipment_rental_header_advertisement_text_heading',
		'section'     => 'equipment_rental_section_header',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Advertisement Text', 'equipment-rental' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'tab'      => 'header',
		'settings' => 'equipment_rental_header_advertisement_text',
		'section'  => 'equipment_rental_section_header',
		'default'  => '',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'tab'      => 'header',
		'settings'    => 'equipment_rental_search_enable',
		'label'       => esc_html__( 'Enable/Disable Search', 'equipment-rental' ),
		'section'     => 'equipment_rental_section_header',
		'default'     => 'on',
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'equipment-rental' ),
			'off' => esc_html__( 'Disable', 'equipment-rental' ),
		],
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'custom',
		'tab'      => 'header',
		'settings'    => 'equipment_rental_logo_settings_premium_features_header',
		'section'     => 'equipment_rental_section_header',
		'priority'    => 50,
		'default'     => '<h3 style="color: #2271b1; padding:5px 20px 5px 20px; background:#fff; margin:0;  box-shadow: 0 2px 4px rgba(0,0,0, .2); ">' . esc_html__( 'Enhance your header design now!', 'equipment-rental' ) . '</h3><ul style="color: #121212; padding: 5px 20px 20px 30px; background:#fff; margin:0;" ><li style="list-style-type: square;" >' . esc_html__( 'Customize your header background color', 'equipment-rental' ) . '</li><li style="list-style-type: square;" >'.esc_html__( 'Adjust icon and text font sizes', 'equipment-rental' ) .'</li><li style="list-style-type: square;" >'.esc_html__( 'Explore enhanced typography options', 'equipment-rental' ) .'</li><li style="list-style-type: square;" >'.esc_html__( '....and Much More', 'equipment-rental' ) . '</li></ul><div style="background: #fff; padding: 0px 10px 10px 20px;"><a href="' . esc_url( __( 'https://www.wpelemento.com/elementor/equipment-rental-wordpress-theme/', 'equipment-rental' ) ) . '" class="button button-primary" target="_blank">'. esc_html__( 'Upgrade for more', 'equipment-rental' ) .'</a></div>',
	) );

	// WOOCOMMERCE SETTINGS

	Kirki::add_section( 'equipment_rental_woocommerce_settings', array(
		'title'          => esc_html__( 'Woocommerce Settings', 'equipment-rental' ),
		'description'    => esc_html__( 'Woocommerce Settings of themes', 'equipment-rental' ),
		'panel'    => 'woocommerce',
		'priority'       => 160,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'equipment_rental_shop_page_sidebar',
		'label'       => esc_html__( 'Enable/Disable Shop Page Sidebar', 'equipment-rental' ),
		'section'     => 'equipment_rental_woocommerce_settings',
		'default'     => 'true',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'select',
		'label'       => esc_html__( 'Shop Page Layouts', 'equipment-rental' ),
		'settings'    => 'equipment_rental_shop_page_layout',
		'section'     => 'equipment_rental_woocommerce_settings',
		'default'     => 'Right Sidebar',
		'choices'     => [
			'Right Sidebar' => esc_html__( 'Right Sidebar', 'equipment-rental' ),
			'Left Sidebar' => esc_html__( 'Left Sidebar', 'equipment-rental' ),
		],
		'active_callback'  => [
			[
				'setting'  => 'equipment_rental_shop_page_sidebar',
				'operator' => '===',
				'value'    => true,
			],
		]

	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'select',
		'label'       => esc_html__( 'Products Per Row', 'equipment-rental' ),
		'settings'    => 'equipment_rental_products_per_row',
		'section'     => 'equipment_rental_woocommerce_settings',
		'default'     => '3',
		'priority'    => 10,
		'choices'     => [
			'2' => '2',
			'3' => '3',
			'4' => '4',
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'number',
		'label'       => esc_html__( 'Products Per Page', 'equipment-rental' ),
		'settings'    => 'equipment_rental_products_per_page',
		'section'     => 'equipment_rental_woocommerce_settings',
		'default'     => '9',
		'priority'    => 10,
		'choices'  => [
					'min'  => 0,
					'max'  => 50,
					'step' => 1,
				],
	] );

	//ADDITIONAL SETTINGS

	Kirki::add_section( 'equipment_rental_additional_setting',array(
		'title' => esc_html__( 'Additional Settings', 'equipment-rental' ),
		'panel' => 'equipment_rental_theme_options_panel',
		'tabs'  => [
			'general' => [
				'label' => esc_html__( 'General', 'equipment-rental' ),
			],
			'header-image'  => [
				'label' => esc_html__( 'Header Image', 'equipment-rental' ),
			],
		],
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'equipment_rental_scroll_enable_setting',
		'label'       => esc_html__( 'Here you can enable or disable your scroller.', 'equipment-rental' ),
		'section'     => 'equipment_rental_additional_setting',
		'default'     => '0',
		'priority'    => 10,
		'tab'      => 'general',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'equipment_rental_preloader_hide',
		'label'       => esc_html__( 'Here you can enable or disable your preloader.', 'equipment-rental' ),
		'section'     => 'equipment_rental_additional_setting',
		'default'     => '0',
		'priority'    => 10,
		'tab'      => 'general',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'equipment_rental_single_page_layout_heading',
		'section'     => 'equipment_rental_additional_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Single Page Layout', 'equipment-rental' ) . '</h3>',
		'tab'      => 'general',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'select',
		'settings'    => 'equipment_rental_single_page_layout',
		'section'     => 'equipment_rental_additional_setting',
		'default'     => 'One Column',
		'tab'      => 'general',
		'choices'     => [
			'Left Sidebar' => esc_html__( 'Left Sidebar', 'equipment-rental' ),
			'Right Sidebar' => esc_html__( 'Right Sidebar', 'equipment-rental' ),
			'One Column' => esc_html__( 'One Column', 'equipment-rental' ),
		],
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'equipment_rental_header_background_attachment_heading',
		'section'     => 'equipment_rental_additional_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Header Image Attachment', 'equipment-rental' ) . '</h3>',
		'tab'      => 'header-image',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'select',
		'tab'      => 'header-image',
		'settings'    => 'equipment_rental_header_background_attachment',
		'section'     => 'equipment_rental_additional_setting',
		'default'     => 'scroll',
		'choices'     => [
			'scroll' => esc_html__( 'Scroll', 'equipment-rental' ),
			'fixed' => esc_html__( 'Fixed', 'equipment-rental' ),
		],
		'output' => array(
			array(
				'element'  => '.header-image-box',
				'property' => 'background-attachment',
			),
		),
	 ) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'header-image',
		'settings'    => 'equipment_rental_header_image_height_heading',
		'section'     => 'equipment_rental_additional_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Header Image height', 'equipment-rental' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'equipment_rental_header_image_height',
		'tab'      => 'header-image',
		'label'       => __( 'Image Height', 'equipment-rental' ),
		'description'    => esc_html__( 'Enter a value in pixels. Example:500px', 'equipment-rental' ),
		'type'        => 'text',
		'default'    => [
			'desktop' => '550px',
			'tablet'  => '350px',
			'mobile'  => '200px',
		],
		'responsive' => true,
		'section'     => 'equipment_rental_additional_setting',
		'transport' => 'auto',
		'output' => array(
			array(
				'element'  => array('.header-image-box'),
				'property' => 'height',
				'media_query' => [
					'desktop' => '@media (min-width: 1024px)',
					'tablet'  => '@media (min-width: 768px) and (max-width: 1023px)',
					'mobile'  => '@media (max-width: 767px)',
				],
			),
		),
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'header-image',
		'settings'    => 'equipment_rental_header_overlay_heading',
		'section'     => 'equipment_rental_additional_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Header Image Overlay', 'equipment-rental' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'equipment_rental_header_overlay_setting',
		'tab'      => 'header-image',
		'label'       => __( 'Overlay Color', 'equipment-rental' ),
		'type'        => 'color',
		'section'     => 'equipment_rental_additional_setting',
		'transport' => 'auto',
		'default'     => '#00000066',
		'choices'     => [
			'alpha' => true,
		],
		'output' => array(
			array(
				'element'  => '.header-image-box:before',
				'property' => 'background',
			),
		),
	) );

	 Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'header-image',
		'settings'    => 'equipment_rental_header_page_title',
		'label'       => esc_html__( 'Enable / Disable Header Image Page Title.', 'equipment-rental' ),
		'section'     => 'equipment_rental_additional_setting',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'header-image',
		'settings'    => 'equipment_rental_header_breadcrumb',
		'label'       => esc_html__( 'Enable / Disable Header Image Breadcrumb.', 'equipment-rental' ),
		'section'     => 'equipment_rental_additional_setting',
		'default'     => '1',
		'priority'    => 10,
	] );

	// POST SECTION

	Kirki::add_section( 'equipment_rental_blog_post',array(
		'title' => esc_html__( 'Post Settings', 'equipment-rental' ),
		'description'    => esc_html__( 'Here you can add post information.', 'equipment-rental' ),
		'panel' => 'equipment_rental_theme_options_panel',
		'tabs'  => [
			'blog-post' => [
				'label' => esc_html__( 'Blog Post', 'equipment-rental' ),
			],
			'single-post'  => [
				'label' => esc_html__( 'Single Post', 'equipment-rental' ),
			],
		],
		'priority'       => 160,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'equipment_rental_post_layout_heading',
		'section'     => 'equipment_rental_blog_post',
		'tab'      => 'blog-post',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Blog Layout', 'equipment-rental' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'select',
		'settings'    => 'equipment_rental_post_layout',
		'tab'      => 'blog-post',
		'section'     => 'equipment_rental_blog_post',
		'default'     => 'Right Sidebar',
		'choices'     => [
			'Left Sidebar' => esc_html__( 'Left Sidebar', 'equipment-rental' ),
			'Right Sidebar' => esc_html__( 'Right Sidebar', 'equipment-rental' ),
			'One Column' => esc_html__( 'One Column', 'equipment-rental' ),
			'Three Columns' => esc_html__( 'Three Columns', 'equipment-rental' ),
			'Four Columns' => esc_html__( 'Four Columns', 'equipment-rental' ),
		],
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'blog-post',
		'settings'    => 'equipment_rental_date_hide',
		'label'       => esc_html__( 'Enable / Disable Post Date', 'equipment-rental' ),
		'section'     => 'equipment_rental_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'blog-post',
		'settings'    => 'equipment_rental_author_hide',
		'label'       => esc_html__( 'Enable / Disable Post Author', 'equipment-rental' ),
		'section'     => 'equipment_rental_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'blog-post',
		'settings'    => 'equipment_rental_comment_hide',
		'label'       => esc_html__( 'Enable / Disable Post Comment', 'equipment-rental' ),
		'section'     => 'equipment_rental_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'blog-post',
		'settings'    => 'equipment_rental_blog_post_featured_image',
		'label'       => esc_html__( 'Enable / Disable Post Image', 'equipment-rental' ),
		'section'     => 'equipment_rental_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'blog-post',
		'settings'    => 'equipment_rental_length_setting_heading',
		'section'     => 'equipment_rental_blog_post',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Blog Post Content Limit', 'equipment-rental' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'number',
		'tab'      => 'blog-post',
		'settings'    => 'equipment_rental_length_setting',
		'section'     => 'equipment_rental_blog_post',
		'default'     => '15',
		'priority'    => 10,
		'choices'  => [
					'min'  => -10,
					'max'  => 40,
		 			'step' => 1,
				],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'single-post',
		'label'       => esc_html__( 'Enable / Disable Single Post Tag', 'equipment-rental' ),
		'settings'    => 'equipment_rental_single_post_tag',
		'section'     => 'equipment_rental_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'single-post',
		'label'       => esc_html__( 'Enable / Disable Single Post Category', 'equipment-rental' ),
		'settings'    => 'equipment_rental_single_post_category',
		'section'     => 'equipment_rental_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );


	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'single-post',
		'settings'    => 'equipment_rental_post_comment_show_hide',
		'label'       => esc_html__( 'Show / Hide Comment Box', 'equipment-rental' ),
		'section'     => 'equipment_rental_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'single-post',
		'settings'    => 'equipment_rental_single_post_featured_image',
		'label'       => esc_html__( 'Enable / Disable Single Post Image', 'equipment-rental' ),
		'section'     => 'equipment_rental_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'single-post',
		'settings'    => 'equipment_rental_single_post_radius',
		'section'     => 'equipment_rental_blog_post',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Single Post Image Border Radius(px)', 'equipment-rental' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'equipment_rental_single_post_border_radius',
		'tab'      => 'single-post',
		'label'       => __( 'Enter a value in pixels. Example:15px', 'equipment-rental' ),
		'type'        => 'text',
		'section'     => 'equipment_rental_blog_post',
		'transport' => 'auto',
		'output' => array(
			array(
				'element'  => array('.post-img img'),
				'property' => 'border-radius',
			),
		),
	) );

	// No Results Page Settings

	Kirki::add_section( 'equipment_rental_no_result_section', array(
		'title'          => esc_html__( '404 & No Results Page Settings', 'equipment-rental' ),
		'panel'    => 'equipment_rental_theme_options_panel',
		'priority'       => 160,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'equipment_rental_page_not_found_title_heading',
		'section'     => 'equipment_rental_no_result_section',
		'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( '404 Page Title', 'equipment-rental' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'equipment_rental_page_not_found_title',
		'section'  => 'equipment_rental_no_result_section',
		'default'  => esc_html__('404 Error!', 'equipment-rental'),
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'equipment_rental_page_not_found_text_heading',
		'section'     => 'equipment_rental_no_result_section',
		'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( '404 Page Text', 'equipment-rental' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'equipment_rental_page_not_found_text',
		'section'  => 'equipment_rental_no_result_section',
		'default'  => esc_html__('The page you are looking for may have been moved, deleted, or possibly never existed.', 'equipment-rental'),
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'     => 'custom',
		'settings' => 'equipment_rental_page_not_found_line_break',
		'section'  => 'equipment_rental_no_result_section',
		'default'  => '<hr>',
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'equipment_rental_no_results_title_heading',
		'section'     => 'equipment_rental_no_result_section',
		'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'No Results Title', 'equipment-rental' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'equipment_rental_no_results_title',
		'section'  => 'equipment_rental_no_result_section',
		'default'  => esc_html__('Nothing Found', 'equipment-rental'),
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'equipment_rental_no_results_content_heading',
		'section'     => 'equipment_rental_no_result_section',
		'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'No Results Content', 'equipment-rental' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'equipment_rental_no_results_content',
		'section'  => 'equipment_rental_no_result_section',
		'default'  => esc_html__('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'equipment-rental'),
	] );

	// FOOTER SECTION

	Kirki::add_section( 'equipment_rental_footer_section', array(
        'title'          => esc_html__( 'Footer Settings', 'equipment-rental' ),
        'description'    => esc_html__( 'Here you can change copyright text', 'equipment-rental' ),
		'panel'    => 'equipment_rental_theme_options_panel',
		'priority'       => 160,
    ) );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'equipment_rental_footer_text_heading',
		'section'     => 'equipment_rental_footer_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Footer Copyright Text', 'equipment-rental' ) . '</h3>',
		'priority'    => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'equipment_rental_footer_text',
		'section'  => 'equipment_rental_footer_section',
		'default'  => '',
		'priority' => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'equipment_rental_footer_enable_heading',
		'section'     => 'equipment_rental_footer_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Enable / Disable Footer Link', 'equipment-rental' ) . '</h3>',
		'priority'    => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'equipment_rental_copyright_enable',
		'label'       => esc_html__( 'Section Enable / Disable', 'equipment-rental' ),
		'section'     => 'equipment_rental_footer_section',
		'default'     => '1',
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'equipment-rental' ),
			'off' => esc_html__( 'Disable', 'equipment-rental' ),
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'equipment_rental_footer_background_widget_heading',
		'section'     => 'equipment_rental_footer_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Footer Widget Background', 'equipment-rental' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id',[
		'settings'    => 'equipment_rental_footer_background_widget',
		'type'        => 'background',
		'section'     => 'equipment_rental_footer_section',
		'default'     => [
			'background-color'      => 'rgba(18,18,18,1)',
			'background-image'      => '',
			'background-repeat'     => 'no-repeat',
			'background-position'   => 'center center',
			'background-size'       => 'cover',
			'background-attachment' => 'scroll',
		],
		'transport'   => 'auto',
		'output'      => [
			[
				'element' => '.footer-widget',
			],
		],
	]);

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'equipment_rental_footer_widget_alignment_heading',
		'section'     => 'equipment_rental_footer_section',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Footer Widget Alignment', 'equipment-rental' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'select',
		'settings'    => 'equipment_rental_footer_widget_alignment',
		'section'     => 'equipment_rental_footer_section',
		'default'     => 'left',
		'choices'     => [
			'center' => esc_html__( 'center', 'equipment-rental' ),
			'right' => esc_html__( 'right', 'equipment-rental' ),
			'left' => esc_html__( 'left', 'equipment-rental' ),
		],
		'output' => array(
			array(
				'element'  => '.footer-area',
				'property' => 'text-align',
			),
		),
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'equipment_rental_footer_copright_color_heading',
		'section'     => 'equipment_rental_footer_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Copyright Background Color', 'equipment-rental' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'equipment_rental_footer_copright_color',
		'type'        => 'color',
		'label'       => __( 'Background Color', 'equipment-rental' ),
		'section'     => 'equipment_rental_footer_section',
		'transport' => 'auto',
		'default'     => '#121212',
		'choices'     => [
			'alpha' => true,
		],
		'output' => array(
			array(
				'element'  => '.footer-copyright',
				'property' => 'background',
			),
		),
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'equipment_rental_footer_copright_text_color_heading',
		'section'     => 'equipment_rental_footer_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Copyright Text Color', 'equipment-rental' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'equipment_rental_footer_copright_text_color',
		'type'        => 'color',
		'label'       => __( 'Text Color', 'equipment-rental' ),
		'section'     => 'equipment_rental_footer_section',
		'transport' => 'auto',
		'default'     => '#ffffff',
		'choices'     => [
			'alpha' => true,
		],
		'output' => array(
			array(
				'element'  => array( '.footer-copyright a', '.footer-copyright p'),
				'property' => 'color',
			),
		),
	) );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'custom',
		'settings'    => 'equipment_rental_logo_settings_premium_features_footer',
		'section'     => 'equipment_rental_footer_section',
		'priority'    => 50,
		'default'     => '<h3 style="color: #2271b1; padding:5px 20px 5px 20px; background:#fff; margin:0;  box-shadow: 0 2px 4px rgba(0,0,0, .2); ">' . esc_html__( 'Elevate your footer with premium features:', 'equipment-rental' ) . '</h3><ul style="color: #121212; padding: 5px 20px 20px 30px; background:#fff; margin:0;" ><li style="list-style-type: square;" >' . esc_html__( 'Tailor your footer layout', 'equipment-rental' ) . '</li><li style="list-style-type: square;" >'.esc_html__( 'Integrate an email subscription form', 'equipment-rental' ) .'</li><li style="list-style-type: square;" >'.esc_html__( 'Personalize social media icons', 'equipment-rental' ) .'</li><li style="list-style-type: square;" >'.esc_html__( '....and Much More', 'equipment-rental' ) . '</li></ul><div style="background: #fff; padding: 0px 10px 10px 20px;"><a href="' . esc_url( __( 'https://www.wpelemento.com/elementor/equipment-rental-wordpress-theme/', 'equipment-rental' ) ) . '" class="button button-primary" target="_blank">'. esc_html__( 'Upgrade for more', 'equipment-rental' ) .'</a></div>',
	) );
}
