<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Equipment Rental
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

<meta http-equiv="Content-Type" content="<?php echo esc_attr(get_bloginfo('html_type')); ?>; charset=<?php echo esc_attr(get_bloginfo('charset')); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.2, user-scalable=yes" />

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<?php
	if ( function_exists( 'wp_body_open' ) )
	{
		wp_body_open();
	}else{
		do_action('wp_body_open');
	}
?>
<?php if(get_theme_mod('equipment_rental_preloader_hide','')){ ?>
	<div class="loader">
		<div class="preloader">
			<div class="diamond">
				<span></span>
				<span></span>
				<span></span>
			</div>
		</div>
	</div>
<?php } ?>
<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'equipment-rental' ); ?></a>

<div class="main-header">
	<div class="topheader pb-lg-4">
		<div class="container">
			<div class="row">
				<div class="col-lg-2"></div>
				<div class="col-lg-4 col-md-12 col-sm-12 align-self-center text-center ">
					<?php if ( get_theme_mod('equipment_rental_header_phone_number') ) : ?>
						<a href="tel:<?php echo esc_url( get_theme_mod('equipment_rental_header_phone_number')); ?>"><span class="mr-4 phone-text" ><i class="fas fa-phone mr-2"></i><?php echo esc_html( get_theme_mod('equipment_rental_header_phone_number' ) ); ?></span></a>
					<?php endif; ?>
					<?php if ( get_theme_mod('equipment_rental_header_email') ) : ?>
						<a href="mailto:<?php echo esc_url( get_theme_mod('equipment_rental_header_email' ) ); ?>"><span class="email-text" ><i class="fas fa-envelope mr-2"></i><?php echo esc_html( get_theme_mod('equipment_rental_header_email' ) ); ?></span></a>
					<?php endif; ?>
				</div>
				<div class="col-lg-6 col-md-12 col-sm-12 text-center text-lg-left align-self-center adver-text py-2">
					<?php if ( get_theme_mod('equipment_rental_header_advertisement_text') ) : ?>
						<p class="mb-0"><?php echo esc_html( get_theme_mod('equipment_rental_header_advertisement_text' ) ); ?></p>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<header id="site-navigation" class="header text-center">
		<div class="container">
			<div class="row middle-header">
				<div class="col-lg-3 col-md-4 col-sm-12 align-self-center">
					<div class="logo text-center text-md-left mb-3 mb-md-0">
						<div class="logo-image text-center">
							<?php the_custom_logo(); ?>
						</div>
						<div class="logo-content text-center">
							<?php
								if ( get_theme_mod('equipment_rental_display_header_title', true) == true ) :
									echo '<a href="' . esc_url(home_url('/')) . '" title="' . esc_attr(get_bloginfo('name')) . '">';
									echo esc_attr(get_bloginfo('name'));
									echo '</a>';
								endif;
								if ( get_theme_mod('equipment_rental_display_header_text', false) == true ) :
									echo '<span>'. esc_attr(get_bloginfo('description')) . '</span>';
								endif;
							?>
						</div>
					</div>
				</div>
				<div class="col-lg-8 col-md-7 col-sm-12 align-self-center">
					<button class="menu-toggle my-2 py-2 px-3" aria-controls="top-menu" aria-expanded="false" type="button">
						<span aria-hidden="true"><?php esc_html_e( 'Menu', 'equipment-rental' ); ?></span>
					</button>
					<nav id="main-menu" class="close-panal">
						<?php
							wp_nav_menu( array(
								'theme_location' => 'main-menu',
								'container' => 'false'
							));
						?>
						<button class="close-menu my-2 p-2" type="button">
							<span aria-hidden="true"><i class="fa fa-times"></i></span>
						</button>
					</nav>
				</div>
				<div class="col-lg-1 col-md-1 align-self-center text-center">
					<?php if ( get_theme_mod('equipment_rental_search_enable', 'on' ) == true ) : ?>
						<div class="search-cont py-2">
							<button type="button" class="search-cont-button"><i class="fas fa-search"></i></button>
						</div>
						<div class="outer-search">
							<div class="inner-search">
								<?php get_search_form(); ?>
							</div>
							<button type="button" class="closepop search-cont-button-close" >X</button>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>	
	</header>
</div>