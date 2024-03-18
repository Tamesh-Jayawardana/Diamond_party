<?php
//about theme info
add_action( 'admin_menu', 'equipment_rental_gettingstarted' );
function equipment_rental_gettingstarted() {
	add_theme_page( esc_html__('Equipment Rental', 'equipment-rental'), esc_html__('Equipment Rental', 'equipment-rental'), 'edit_theme_options', 'equipment_rental_about', 'equipment_rental_mostrar_guide');
}

// Add a Custom CSS file to WP Admin Area
function equipment_rental_admin_theme_style() {
	wp_enqueue_style('equipment-rental-custom-admin-style', esc_url(get_template_directory_uri()) . '/includes/getstart/getstart.css');
	wp_enqueue_script('equipment-rental-tabs', esc_url(get_template_directory_uri()) . '/includes/getstart/js/tab.js');
	wp_enqueue_style( 'font-awesome-css', get_template_directory_uri().'/assets/css/fontawesome-all.css' );
}
add_action('admin_enqueue_scripts', 'equipment_rental_admin_theme_style');

// Changelog
if ( ! defined( 'EQUIPMENT_RENTAL_CHANGELOG_URL' ) ) {
    define( 'EQUIPMENT_RENTAL_CHANGELOG_URL', get_template_directory() . '/readme.txt' );
}

function equipment_rental_changelog_screen() {	
	global $wp_filesystem;
	$changelog_file = apply_filters( 'equipment_rental_changelog_file', EQUIPMENT_RENTAL_CHANGELOG_URL );
	if ( $changelog_file && is_readable( $changelog_file ) ) {
		WP_Filesystem();
		$changelog = $wp_filesystem->get_contents( $changelog_file );
		$changelog_list = equipment_rental_parse_changelog( $changelog );
		echo wp_kses_post( $changelog_list );
	}
}

function equipment_rental_parse_changelog( $content ) {
	$content = explode ( '== ', $content );
	$changelog_isolated = '';
	foreach ( $content as $key => $value ) {
		if (strpos( $value, 'Changelog ==') === 0) {
	    	$changelog_isolated = str_replace( 'Changelog ==', '', $value );
	    }
	}
	$changelog_array = explode( '= ', $changelog_isolated );
	unset( $changelog_array[0] );
	$changelog = '<div class="changelog">';
	foreach ( $changelog_array as $value) {
		$value = preg_replace( '/\n+/', '</span><span>', $value );
		$value = '<div class="block"><span class="heading">= ' . $value . '</span></div><hr>';
		$changelog .= str_replace( '<span></span>', '', $value );
	}
	$changelog .= '</div>';
	return wp_kses_post( $changelog );
}

//guidline for about theme
function equipment_rental_mostrar_guide() { 
	//custom function about theme customizer
	$equipment_rental_return = add_query_arg( array()) ;
	$equipment_rental_theme = wp_get_theme( 'equipment-rental' );
?>

    <div class="top-head">
		<div class="top-title">
			<h2><?php esc_html_e( 'Equipment Rental', 'equipment-rental' ); ?></h2>
		</div>
		<div class="top-right">
			<span class="version"><?php esc_html_e( 'Version', 'equipment-rental' ); ?>: <?php echo esc_html($equipment_rental_theme['Version']);?></span>
		</div>
    </div>

    <div class="inner-cont">

	    <div class="tab-sec">
	    	<div class="tab">
				<button class="tablinks" onclick="equipment_rental_open_tab(event, 'wpelemento_importer_editor')"><?php esc_html_e( 'Setup With Elementor', 'equipment-rental' ); ?></button>
				<button class="tablinks" onclick="equipment_rental_open_tab(event, 'setup_customizer')"><?php esc_html_e( 'Setup With Customizer', 'equipment-rental' ); ?></button>
				<button class="tablinks" onclick="equipment_rental_open_tab(event, 'changelog_cont')"><?php esc_html_e( 'Changelog', 'equipment-rental' ); ?></button>
			</div>

			<div id="wpelemento_importer_editor" class="tabcontent open">
				<?php if(!class_exists('WPElemento_Importer_ThemeWhizzie')){
					$plugin_ins = Equipment_Rental_Plugin_Activation_WPElemento_Importer::get_instance();
					$equipment_rental_actions = $plugin_ins->recommended_actions;
					?>
					<div class="equipment-rental-recommended-plugins ">
							<div class="equipment-rental-action-list">
								<?php if ($equipment_rental_actions): foreach ($equipment_rental_actions as $key => $equipment_rental_actionValue): ?>
										<div class="equipment-rental-action" id="<?php echo esc_attr($equipment_rental_actionValue['id']);?>">
											<div class="action-inner plugin-activation-redirect">
												<h3 class="action-title"><?php echo esc_html($equipment_rental_actionValue['title']); ?></h3>
												<div class="action-desc"><?php echo esc_html($equipment_rental_actionValue['desc']); ?></div>
												<?php echo wp_kses_post($equipment_rental_actionValue['link']); ?>
											</div>
										</div>
									<?php endforeach;
								endif; ?>
							</div>
					</div>
				<?php }else{ ?>
					<div class="tab-outer-box">
						<h3><?php esc_html_e('Welcome to WPElemento Theme!', 'equipment-rental'); ?></h3>
						<p><?php esc_html_e('Click on the quick start button to import the demo.', 'equipment-rental'); ?></p>
						<div class="info-link">
							<a  href="<?php echo esc_url( admin_url('admin.php?page=wpelementoimporter-wizard') ); ?>"><?php esc_html_e('Quick Start', 'equipment-rental'); ?></a>
						</div>
					</div>
				<?php } ?>
			</div>

			<div id="setup_customizer" class="tabcontent ">
				<div class="tab-outer-box">
				  	<div class="lite-theme-inner">
						<h3><?php esc_html_e('Theme Customizer', 'equipment-rental'); ?></h3>
						<p><?php esc_html_e('To begin customizing your website, start by clicking "Customize".', 'equipment-rental'); ?></p>
						<div class="info-link">
							<a target="_blank" href="<?php echo esc_url( admin_url('customize.php') ); ?>"><?php esc_html_e('Customizing', 'equipment-rental'); ?></a>
						</div>
						<hr>
						<h3><?php esc_html_e('Help Docs', 'equipment-rental'); ?></h3>
						<p><?php esc_html_e('The complete procedure to configure and manage a WordPress Website from the beginning is shown in this documentation .', 'equipment-rental'); ?></p>
						<div class="info-link">
							<a href="<?php echo esc_url( EQUIPMENT_RENTAL_FREE_THEME_DOC ); ?>" target="_blank"><?php esc_html_e('Documentation', 'equipment-rental'); ?></a>
						</div>
						<hr>
						<h3><?php esc_html_e('Need Support?', 'equipment-rental'); ?></h3>
						<p><?php esc_html_e('Our dedicated team is well prepared to help you out in case of queries and doubts regarding our theme.', 'equipment-rental'); ?></p>
						<div class="info-link">
							<a href="<?php echo esc_url( EQUIPMENT_RENTAL_SUPPORT ); ?>" target="_blank"><?php esc_html_e('Support Forum', 'equipment-rental'); ?></a>
						</div>
						<hr>
						<h3><?php esc_html_e('Reviews & Testimonials', 'equipment-rental'); ?></h3>
						<p> <?php esc_html_e('All the features and aspects of this WordPress Theme are phenomenal. I\'d recommend this theme to all.', 'equipment-rental'); ?></p>
						<div class="info-link">
							<a href="<?php echo esc_url( EQUIPMENT_RENTAL_REVIEW ); ?>" target="_blank"><?php esc_html_e('Review', 'equipment-rental'); ?></a>
						</div>
						<hr>
						<div class="link-customizer">
							<h3><?php esc_html_e( 'Link to customizer', 'equipment-rental' ); ?></h3>
							<div class="first-row">
								<div class="row-box">
									<div class="row-box1">
										<span class="dashicons dashicons-buddicons-buddypress-logo"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[control]=custom_logo') ); ?>" target="_blank"><?php esc_html_e('Upload your logo','equipment-rental'); ?></a>
									</div>
									<div class="row-box2">
										<span class="dashicons dashicons-menu"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=nav_menus') ); ?>" target="_blank"><?php esc_html_e('Menus','equipment-rental'); ?></a>
									</div>
								</div>
							
								<div class="row-box">
									<div class="row-box1">
										<span class="dashicons dashicons-align-center"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=header_image') ); ?>" target="_blank"><?php esc_html_e('Header Image','equipment-rental'); ?></a>
									</div>
									<div class="row-box2">
										<span class="dashicons dashicons-screenoptions"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=widgets') ); ?>" target="_blank"><?php esc_html_e('Footer Widget','equipment-rental'); ?></a>
									</div>
								</div>
							</div>
						</div>
				  	</div>
				</div>
			</div>

			<div id="changelog_cont" class="tabcontent">
				<div class="tab-outer-box">
					<?php equipment_rental_changelog_screen(); ?>
				</div>
			</div>
			
		</div>

		<div class="inner-side-content">
			<h2><?php esc_html_e('Premium Theme', 'equipment-rental'); ?></h2>
			<div class="tab-outer-box">
				<img src="<?php echo esc_url(get_template_directory_uri()); ?>/screenshot.png" alt="" />
				<h3><?php esc_html_e('Equipment Rental WordPress Theme', 'equipment-rental'); ?></h3>
				<div class="iner-sidebar-pro-btn">
					<span class="premium-btn"><a href="<?php echo esc_url( EQUIPMENT_RENTAL_BUY_NOW ); ?>" target="_blank"><?php esc_html_e('Buy Premium', 'equipment-rental'); ?></a>
					</span>
					<span class="demo-btn"><a href="<?php echo esc_url( EQUIPMENT_RENTAL_LIVE_DEMO ); ?>" target="_blank"><?php esc_html_e('Live Demo', 'equipment-rental'); ?></a>
					</span>
					<span class="doc-btn"><a href="<?php echo esc_url( EQUIPMENT_RENTAL_THEME_BUNDLE ); ?>" target="_blank"><?php esc_html_e('Theme Bundle', 'equipment-rental'); ?></a>
					</span>
				</div>
				<hr>
				<div class="premium-coupon">
					<div class="premium-features">
						<h3><?php esc_html_e('premium Features', 'equipment-rental'); ?></h3>
						<ul>
							<li><?php esc_html_e( 'Multilingual', 'equipment-rental' ); ?></li>
							<li><?php esc_html_e( 'Drag and drop features', 'equipment-rental' ); ?></li>
							<li><?php esc_html_e( 'Zero Coding Required', 'equipment-rental' ); ?></li>
							<li><?php esc_html_e( 'Mobile Friendly Layout', 'equipment-rental' ); ?></li>
							<li><?php esc_html_e( 'Responsive Layout', 'equipment-rental' ); ?></li>
							<li><?php esc_html_e( 'Unique Designs', 'equipment-rental' ); ?></li>
						</ul>
					</div>
					<div class="coupon-box">
						<h3><?php esc_html_e('Use Coupon Code', 'equipment-rental'); ?></h3>
						<a class="coupon-btn" href="<?php echo esc_url( EQUIPMENT_RENTAL_BUY_NOW ); ?>" target="_blank"><?php esc_html_e('UPGRADE NOW', 'equipment-rental'); ?></a>
						<div class="coupon-container">
							<h3><?php esc_html_e( 'elemento20', 'equipment-rental' ); ?></h3>
						</div>
					</div>
				</div>
			</div>	
		</div>
	</div>

<?php } ?>