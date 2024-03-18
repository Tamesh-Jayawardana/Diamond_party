<?php
/**
 * Theme sprecific functions and definitions
 */

/* Theme setup section
------------------------------------------------------------------- */

// Set the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width ) ) $content_width = 1170; /* pixels */


// Add theme specific actions and filters
// Attention! Function were add theme specific actions and filters handlers must have priority 1
if ( !function_exists( 'yacht_rental_theme_setup' ) ) {
	add_action( 'yacht_rental_action_before_init_theme', 'yacht_rental_theme_setup', 1 );
	function yacht_rental_theme_setup() {

		// Add default posts and comments RSS feed links to head
		add_theme_support( 'automatic-feed-links' );

		// Enable support for Post Thumbnails
		add_theme_support( 'post-thumbnails' );

		// Custom header setup
		add_theme_support( 'custom-header', array('header-text'=>false));

		// Custom backgrounds setup
		add_theme_support( 'custom-background');

		// Supported posts formats
		add_theme_support( 'post-formats', array('gallery', 'video', 'audio', 'link', 'quote', 'image', 'status', 'aside', 'chat') );

		// Autogenerate title tag
		add_theme_support('title-tag');

		// Add user menu
		add_theme_support('nav-menus');

		// Register theme sidebars
		add_filter( 'yacht_rental_filter_add_theme_sidebars',	'yacht_rental_add_theme_sidebars' );

		// Set options for importer
		add_filter( 'yacht_rental_filter_importer_options',		'yacht_rental_set_importer_options' );

		// Add theme required plugins
		add_filter( 'yacht_rental_filter_required_plugins',		'yacht_rental_add_required_plugins' );
		
		// Add preloader styles
		add_filter('yacht_rental_filter_add_styles_inline',		'yacht_rental_head_add_page_preloader_styles');

		// Init theme after WP is created
		add_action( 'wp',									'yacht_rental_core_init_theme' );

		// Add theme specified classes into the body
		add_filter( 'body_class', 							'yacht_rental_body_classes' );

		// Add data to the head and to the beginning of the body
		add_action('wp_head',								'yacht_rental_head_add_page_meta', 0);
		add_action('before',								'yacht_rental_body_add_gtm');
		add_action('before',								'yacht_rental_body_add_toc');
		add_action('before',								'yacht_rental_body_add_page_preloader');

		// Add data to the footer (priority 1, because priority 2 used for localize scripts)
		add_action('wp_footer',								'yacht_rental_footer_add_views_counter', 1);
		add_action('wp_footer',								'yacht_rental_footer_add_theme_customizer', 1);
		add_action('wp_footer',								'yacht_rental_footer_add_custom_html', 1);
		add_action('wp_footer',								'yacht_rental_footer_add_gtm2', 1);

		// Set list of the theme required plugins
		yacht_rental_storage_set('required_plugins', array(
			'booked',
			'quickcal',
			'essgrids',
			'revslider',
			'trx_utils',
			'visual_composer',
			'mailchimp',
			'gdpr-compliance',
			'contact-form-7',
			'trx_updater',
			)
		);

		// Set list of the theme required custom fonts from folder /css/font-faces
		// Attention! Font's folder must have name equal to the font's name
		yacht_rental_storage_set('required_custom_fonts', array(
			'Amadeus',
			'montserrat'
			)
		);

		yacht_rental_storage_set('demo_data_url',  esc_url(yacht_rental_get_protocol() . '://demofiles.themerex.net/yacht-rental/'));

        // Gutenberg support
        add_theme_support( 'align-wide' );
	}
}

// Add theme specific widgetized areas
if ( !function_exists( 'yacht_rental_add_theme_sidebars' ) ) {
	function yacht_rental_add_theme_sidebars($sidebars=array()) {
		if (is_array($sidebars)) {
			$theme_sidebars = array(
				'sidebar_main'		=> esc_html__( 'Main Sidebar', 'yacht-rental' ),
				'sidebar_footer'	=> esc_html__( 'Footer Sidebar', 'yacht-rental' )
			);
			$sidebars = array_merge($theme_sidebars, $sidebars);
		}
		return $sidebars;
	}
}

// Add theme required plugins
if ( !function_exists( 'yacht_rental_add_required_plugins' ) ) {
	function yacht_rental_add_required_plugins($plugins) {
		$plugins[] = array(
			'name' 		=> esc_html__('ThemeREX Utilities', 'yacht-rental'),
			'version'	=> '3.2.4',					// Minimal required version
			'slug' 		=> 'trx_utils',
			'source'	=> yacht_rental_get_file_dir('plugins/install/trx_utils.zip'),
			'required' 	=> true
		);
		return $plugins;
	}
}

//------------------------------------------------------------------------
// One-click import support
//------------------------------------------------------------------------

// Set theme specific importer options
if ( ! function_exists( 'yacht_rental_importer_set_options' ) ) {
    add_filter( 'trx_utils_filter_importer_options', 'yacht_rental_importer_set_options', 9 );
    function yacht_rental_importer_set_options( $options=array() ) {
        if ( is_array( $options ) ) {
            // Save or not installer's messages to the log-file
            $options['debug'] = false;
            // Prepare demo data
            if ( is_dir( YACHT_RENTAL_THEME_PATH . 'demo/' ) ) {
                $options['demo_url'] = YACHT_RENTAL_THEME_PATH . 'demo/';
            } else {
                $options['demo_url'] = esc_url(yacht_rental_get_protocol() . '://demofiles.themerex.net/yacht-rental/' ); // Demo-site domain
            }

            // Required plugins
            $options['required_plugins'] =  array(
                'booked',
					 'quickcal',
                'essential-grid',
                'revslider',
                'the-events-calendar',
                'js_composer',
            );

            $options['theme_slug'] = 'yacht_rental';

            // Set number of thumbnails to regenerate when its imported (if demo data was zipped without cropped images)
            // Set 0 to prevent regenerate thumbnails (if demo data archive is already contain cropped images)
            $options['regenerate_thumbnails'] = 3;
            // Default demo
            $options['files']['default']['title'] = esc_html__( 'Yacht Rental Demo', 'yacht-rental' );
            $options['files']['default']['domain_dev'] = esc_url(yacht_rental_get_protocol() . '://yacht-rental.upd.themerex.net'); // Developers domain
            $options['files']['default']['domain_demo']= esc_url(yacht_rental_get_protocol() . '://yacht-rental.themerex.net'); // Demo-site domain

        }
        return $options;
    }
}

// Add data to the head and to the beginning of the body
//------------------------------------------------------------------------

// Add theme specified classes to the body tag
if ( !function_exists('yacht_rental_body_classes') ) {
	function yacht_rental_body_classes( $classes ) {

		$classes[] = 'yacht_rental_body';
		$classes[] = 'body_style_' . trim(yacht_rental_get_custom_option('body_style'));
		$classes[] = 'body_' . (yacht_rental_get_custom_option('body_filled')=='yes' ? 'filled' : 'transparent');
		$classes[] = 'article_style_' . trim(yacht_rental_get_custom_option('article_style'));
		
		$blog_style = yacht_rental_get_custom_option(is_singular() && !yacht_rental_storage_get('blog_streampage') ? 'single_style' : 'blog_style');
		$classes[] = 'layout_' . trim($blog_style);
		$classes[] = 'template_' . trim(yacht_rental_get_template_name($blog_style));
		
		$body_scheme = yacht_rental_get_custom_option('body_scheme');
		if (empty($body_scheme)  || yacht_rental_is_inherit_option($body_scheme)) $body_scheme = 'original';
		$classes[] = 'scheme_' . $body_scheme;

		$top_panel_position = yacht_rental_get_custom_option('top_panel_position');
		if (!yacht_rental_param_is_off($top_panel_position)) {
			$classes[] = 'top_panel_show';
			$classes[] = 'top_panel_' . trim($top_panel_position);
		} else 
			$classes[] = 'top_panel_hide';
		$classes[] = yacht_rental_get_sidebar_class();

		if (yacht_rental_get_custom_option('show_video_bg')=='yes' && (yacht_rental_get_custom_option('video_bg_youtube_code')!='' || yacht_rental_get_custom_option('video_bg_url')!=''))
			$classes[] = 'video_bg_show';

		if (!yacht_rental_param_is_off(yacht_rental_get_theme_option('page_preloader')))
			$classes[] = 'preloader';

		return $classes;
	}
}

// Add page meta to the head
if (!function_exists('yacht_rental_head_add_page_meta')) {
	function yacht_rental_head_add_page_meta() {
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1<?php if (yacht_rental_get_theme_option('responsive_layouts')=='yes') echo ', maximum-scale=1'; ?>">
		<meta name="format-detection" content="telephone=no">
	
		<link rel="profile" href="//gmpg.org/xfn/11" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<?php
	}
}

// Add page preloader styles to the head
if (!function_exists('yacht_rental_head_add_page_preloader_styles')) {
	function yacht_rental_head_add_page_preloader_styles($css) {
		if (($preloader=yacht_rental_get_theme_option('page_preloader'))!='none') {
			$image = yacht_rental_get_theme_option('page_preloader_image');
			$bg_clr = yacht_rental_get_scheme_color('bg_color');
			$link_clr = yacht_rental_get_scheme_color('text_link');
			$css .= '
				#page_preloader {
					background-color: '. esc_attr($bg_clr) . ';'
					. ($preloader=='custom' && $image
						? 'background-image:url('.esc_url($image).');'
						: ''
						)
				    . '
				}
				.preloader_wrap > div {
					background-color: '.esc_attr($link_clr).';
				}';
		}
		return $css;
	}
}

// Add gtm code to the beginning of the body 
if (!function_exists('yacht_rental_body_add_gtm')) {
	function yacht_rental_body_add_gtm() {
		yacht_rental_show_layout(yacht_rental_get_custom_option('gtm_code'));
	}
}

// Add TOC anchors to the beginning of the body 
if (!function_exists('yacht_rental_body_add_toc')) {
	function yacht_rental_body_add_toc() {
		// Add TOC items 'Home' and "To top"
		if (yacht_rental_get_custom_option('menu_toc_home')=='yes' && function_exists('yacht_rental_sc_anchor'))
			yacht_rental_show_layout(yacht_rental_sc_anchor(array(
				'id' => "toc_home",
				'title' => esc_html__('Home', 'yacht-rental'),
				'description' => esc_html__('{{Return to Home}} - ||navigate to home page of the site', 'yacht-rental'),
				'icon' => "icon-home",
				'separator' => "yes",
				'url' => esc_url(home_url('/'))
				)
			)); 
		if (yacht_rental_get_custom_option('menu_toc_top')=='yes' && function_exists('yacht_rental_sc_anchor'))
			yacht_rental_show_layout(yacht_rental_sc_anchor(array(
				'id' => "toc_top",
				'title' => esc_html__('To Top', 'yacht-rental'),
				'description' => esc_html__('{{Back to top}} - ||scroll to top of the page', 'yacht-rental'),
				'icon' => "icon-double-up",
				'separator' => "yes")
				)); 
	}
}

// Add page preloader to the beginning of the body
if (!function_exists('yacht_rental_body_add_page_preloader')) {
	function yacht_rental_body_add_page_preloader() {
		if ( ($preloader=yacht_rental_get_theme_option('page_preloader')) != 'none' && ( $preloader != 'custom' || ($image=yacht_rental_get_theme_option('page_preloader_image')) != '')) {
			?><div id="page_preloader"><?php
				if ($preloader == 'circle') {
					?><div class="preloader_wrap preloader_<?php echo esc_attr($preloader); ?>"><div class="preloader_circ1"></div><div class="preloader_circ2"></div><div class="preloader_circ3"></div><div class="preloader_circ4"></div></div><?php
				} else if ($preloader == 'square') {
					?><div class="preloader_wrap preloader_<?php echo esc_attr($preloader); ?>"><div class="preloader_square1"></div><div class="preloader_square2"></div></div><?php
				}
			?></div><?php
		}
	}
}

// Add theme required plugins
if ( !function_exists( 'yacht_rental_add_trx_utils' ) ) {
    add_filter( 'trx_utils_active', 'yacht_rental_add_trx_utils' );
    function yacht_rental_add_trx_utils($enable=true) {
        return true;
    }
}

// Return text for the Privacy Policy checkbox
if ( ! function_exists('yacht_rental_get_privacy_text' ) ) {
    function yacht_rental_get_privacy_text() {
        $page = get_option( 'wp_page_for_privacy_policy' );
        $privacy_text = yacht_rental_get_theme_option( 'privacy_text' );
        return apply_filters( 'yacht_rental_filter_privacy_text', wp_kses_post(
                $privacy_text
                . ( ! empty( $page ) && ! empty( $privacy_text )
                    // Translators: Add url to the Privacy Policy page
                    ? ' ' . sprintf( __( 'For further details on handling user data, see our %s', 'yacht-rental' ),
                        '<a href="' . esc_url( get_permalink( $page ) ) . '" target="_blank">'
                        . __( 'Privacy Policy', 'yacht-rental' )
                        . '</a>' )
                    : ''
                )
            )
        );
    }
}


// Return text for the "I agree ..." checkbox
if ( ! function_exists( 'yacht_rental_trx_donations_privacy_text' ) ) {
    function yacht_rental_trx_donations_privacy_text( $text='' ) {
        return yacht_rental_get_privacy_text();
    }
}

// Add data to the footer
//------------------------------------------------------------------------

// Add post/page views counter
if (!function_exists('yacht_rental_footer_add_views_counter')) {
	function yacht_rental_footer_add_views_counter() {
		// Post/Page views counter
		get_template_part(yacht_rental_get_file_slug('templates/_parts/views-counter.php'));
	}
}

// Add theme customizer
if (!function_exists('yacht_rental_footer_add_theme_customizer')) {
	function yacht_rental_footer_add_theme_customizer() {
		// Front customizer
		if (yacht_rental_get_custom_option('show_theme_customizer')=='yes') {
			require_once YACHT_RENTAL_FW_PATH . 'core/core.customizer/front.customizer.php';
		}
	}
}

// Add custom html
if (!function_exists('yacht_rental_footer_add_custom_html')) {
	function yacht_rental_footer_add_custom_html() {
		?><div class="custom_html_section"><?php
			yacht_rental_show_layout(yacht_rental_get_custom_option('custom_code'));
		?></div><?php
	}
}

// Add gtm code
if (!function_exists('yacht_rental_footer_add_gtm2')) {
	function yacht_rental_footer_add_gtm2() {
		yacht_rental_show_layout(yacht_rental_get_custom_option('gtm_code2'));
	}
}


/**
 * Fire the wp_body_open action.
 *
 * Added for backwards compatibility to support pre 5.2.0 WordPress versions.
 */
if ( ! function_exists( 'wp_body_open' ) ) {
    function wp_body_open() {
        /**
         * Triggered after the opening <body> tag.
         */
        do_action('wp_body_open');
    }
}

// Include framework core files
//-------------------------------------------------------------------
require_once trailingslashit( get_template_directory() ) . 'fw/loader.php';
?>