<?php
/**
 * Yacht rental Framework
 *
 * @package yacht_rental
 * @since yacht_rental 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Framework directory path from theme root
if ( ! defined( 'YACHT_RENTAL_FW_DIR' ) )			define( 'YACHT_RENTAL_FW_DIR', 'fw' );
if ( ! defined( 'YACHT_RENTAL_THEME_PATH' ) )		define( 'YACHT_RENTAL_THEME_PATH',	trailingslashit( get_template_directory() ) );
if ( ! defined( 'YACHT_RENTAL_FW_PATH' ) )		define( 'YACHT_RENTAL_FW_PATH',		YACHT_RENTAL_THEME_PATH . YACHT_RENTAL_FW_DIR . '/' );

// Include theme variables storage
require_once YACHT_RENTAL_FW_PATH . 'core/core.storage.php';

// Theme variables storage
yacht_rental_storage_set('options_prefix', 'yacht_rental');	
yacht_rental_storage_set('page_template', '');			// Storage for current page template name (used in the inheritance system)
yacht_rental_storage_set('widgets_args', array(			// Arguments to register widgets
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="widget_title">',
		'after_title'   => '</h5>',
	)
);

/* Theme setup section
-------------------------------------------------------------------- */
if ( !function_exists( 'yacht_rental_loader_theme_setup' ) ) {
	add_action( 'after_setup_theme', 'yacht_rental_loader_theme_setup', 20 );
	function yacht_rental_loader_theme_setup() {

		// Before init theme
		do_action('yacht_rental_action_before_init_theme');

		// Load current values for main theme options
		yacht_rental_load_main_options();

		// Theme core init - only for admin side. In frontend it called from action 'wp'
		if ( is_admin() ) {
			yacht_rental_core_init_theme();
		}
	}
}


/* Include core parts
------------------------------------------------------------------------ */
// Manual load important libraries before load all rest files
// core.strings must be first - we use yacht_rental_str...() in the yacht_rental_get_file_dir()
require_once trailingslashit( get_template_directory() ) . YACHT_RENTAL_FW_DIR . '/core/core.strings.php';
// core.files must be first - we use yacht_rental_get_file_dir() to include all rest parts
require_once trailingslashit( get_template_directory() ) . YACHT_RENTAL_FW_DIR . '/core/core.files.php';

// Include debug utilities
require_once trailingslashit( get_template_directory() ) . YACHT_RENTAL_FW_DIR . '/core/core.debug.php';

// Include custom theme files
yacht_rental_autoload_folder( 'includes' );

// Include core files
yacht_rental_autoload_folder( 'core' );

// Include theme-specific plugins and post types
yacht_rental_autoload_folder( 'plugins' );

// Include theme templates
yacht_rental_autoload_folder( 'templates' );

// Include theme widgets
yacht_rental_autoload_folder( 'widgets' );
?>