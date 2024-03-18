<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Equipment Rental
 */

?>

<footer class="footer-side">
  <div class="footer-widget">
    <div class="container">
      <?php if ( is_active_sidebar( 'footer1-sidebar' ) || is_active_sidebar( 'footer2- sidebar' ) || is_active_sidebar( 'footer3-sidebar' ) || is_active_sidebar( 'footer4-sidebar' ) ) : ?>
      <?php $count = 0;
        if ( is_active_sidebar('footer1-sidebar') ) : $count++; endif; 
        if ( is_active_sidebar('footer2-sidebar') ) : $count++; endif; 
        if ( is_active_sidebar('footer3-sidebar') ) : $count++; endif; 
        if ( is_active_sidebar('footer4-sidebar') ) : $count++; endif;
        $row = 'col-lg-'. 12/$count .' col-md-'. 12/$count .' col-sm-12';
      ?>
      <div class="row pt-2">
          <?php if ( is_active_sidebar('footer1-sidebar') ) : ?>
              <div class="footer-area <?php echo $row ?>">
                  <?php dynamic_sidebar('footer1-sidebar'); ?>
              </div>
          <?php endif; ?>
          <?php if ( is_active_sidebar('footer2-sidebar') ) : ?>
              <div class="footer-area <?php echo $row ?>">
                  <?php dynamic_sidebar('footer2-sidebar'); ?>
              </div>
          <?php endif; ?>
          <?php if ( is_active_sidebar('footer3-sidebar') ) : ?>
              <div class="footer-area <?php echo $row ?>">
                  <?php dynamic_sidebar('footer3-sidebar'); ?>
              </div>
          <?php endif; ?>
          <?php if ( is_active_sidebar('footer4-sidebar') ) : ?>
              <div class="footer-area <?php echo $row ?>">
                  <?php dynamic_sidebar('footer4-sidebar'); ?>
              </div>
          <?php endif; ?>
      </div>
      <?php endif; ?>
    </div>
  </div>
  <div class="footer-copyright">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-md-6 align-self-center">
          <p class="mb-0 py-3 text-center text-md-left">
            <?php
              if (!get_theme_mod('equipment_rental_footer_text') ) { ?>
              <a href="<?php echo esc_url(__('https://www.wpelemento.com/elementor/free-rental-wordpress-theme/', 'equipment-rental' )); ?>" target="_blank">  
                <?php esc_html_e('Equipment Rental WordPress Theme','equipment-rental'); ?>
              </a>
            <?php } else {
                echo esc_html(get_theme_mod('equipment_rental_footer_text'));
              }
            ?>
            <?php if ( get_theme_mod('equipment_rental_copyright_enable', true) == true ) : ?>
            <?php
              /* translators: %s: WP Elemento */
              printf( esc_html__( ' By %s', 'equipment-rental' ), 'WP Elemento' ); ?>
            <?php endif; ?>
          </p>
        </div>
        <div class="col-lg-6 col-md-6 align-self-center text-center text-md-right">
          <?php if ( get_theme_mod('equipment_rental_copyright_enable', true) == true ) : ?>
            <a href="<?php echo esc_url(__('https://wordpress.org','equipment-rental') ); ?>" rel="generator"><?php  /* translators: %s: WordPress */ printf( esc_html__( 'Proudly powered by %s', 'equipment-rental' ), 'WordPress' ); ?></a>
          <?php endif; ?>
        </div>
      </div>

    </div>
  </div>
  <?php if ( get_theme_mod('equipment_rental_scroll_enable_setting')) : ?>
    <div class="scroll-up">
      <a href="#tobottom"><i class="fa fa-arrow-up"></i></a>
    </div>
  <?php endif; ?>
</footer>

<?php wp_footer(); ?>

</body>
</html>