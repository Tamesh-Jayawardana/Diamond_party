<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Equipment Rental
 */

get_header(); ?>

<div class="header-image-box text-center">
  <div class="container">
    <?php echo '<h1 class="mb-0">' . esc_html__('You searched: ', 'equipment-rental') . get_search_query() . '</h1>'; ?>
    <div class="crumb-box mt-3">
      <?php equipment_rental_the_breadcrumb(); ?>
    </div>
  </div>
</div>

<div id="content" class="mt-5">
  <div class="container">
    <?php $equipment_rental_post_layout = get_theme_mod( 'equipment_rental_post_layout','Right Sidebar');
    if($equipment_rental_post_layout == 'Right Sidebar'): ?>
      <div class="row">
        <div class="col-lg-8 col-md-8">
          <div class="row">
            <?php
              if ( have_posts() ) :

                while ( have_posts() ) :

                  the_post();
                  get_template_part( 'template-parts/content' );

                endwhile;

              else:

                get_template_part( 'no-results' );

              endif;

              get_template_part( 'template-parts/pagination' );
            ?>
          </div>
        </div>
        <div class="col-lg-4 col-md-4">
          <?php get_sidebar(); ?>
        </div>
      </div>
    <?php elseif ($equipment_rental_post_layout == 'Left Sidebar') : ?>
      <div class="row">
        <div class="col-lg-4 col-md-4">
          <?php get_sidebar(); ?>
        </div>
        <div class="col-lg-8 col-md-8">
          <div class="row">
            <?php
              if ( have_posts() ) :

                while ( have_posts() ) :

                  the_post();
                  get_template_part( 'template-parts/content' );

                endwhile;

              else:

                get_template_part( 'no-results' );

              endif;

              get_template_part( 'template-parts/pagination' );
            ?>
          </div>
        </div>
      </div>
    <?php elseif ($equipment_rental_post_layout == 'One Column') : ?>
      <div class="row">
        <?php
          if ( have_posts() ) :

            while ( have_posts() ) :

              the_post();
              get_template_part( 'template-parts/content' );

            endwhile;

          else:

            get_template_part( 'no-results' );

          endif;

          get_template_part( 'template-parts/pagination' );
        ?>
      </div>
    <?php elseif ($equipment_rental_post_layout == 'Three Columns') : ?>
      <div class="row">
        <div class="col-lg-4 col-md-4">
          <?php get_sidebar(); ?>
        </div>
        <div class="col-lg-4 col-md-4">
          <div class="row">
            <?php
              if ( have_posts() ) :

                while ( have_posts() ) :

                  the_post();
                  get_template_part( 'template-parts/content' );

                endwhile;

              else:

                get_template_part( 'no-results' );

              endif;

              get_template_part( 'template-parts/pagination' );
            ?>
          </div>
        </div>
        <div class="col-lg-4 col-md-4">
          <div class="sidebar-area">
            <?php
              dynamic_sidebar('sidebar-2');
            ?>
          </div>
        </div>
      </div>
    <?php elseif ($equipment_rental_post_layout == 'Four Columns') : ?>
      <div class="row">
        <div class="col-lg-3 col-md-3">
          <?php get_sidebar(); ?>
        </div>
        <div class="col-lg-3 col-md-3">
          <div class="row">
            <?php
              if ( have_posts() ) :

                while ( have_posts() ) :

                  the_post();
                  get_template_part( 'template-parts/content' );

                endwhile;

              else:

                get_template_part( 'no-results' );

              endif;

              get_template_part( 'template-parts/pagination' );
            ?>
          </div>
        </div>
        <div class="col-lg-3 col-md-3">
          <div class="sidebar-area">
            <?php
              dynamic_sidebar('sidebar-2');
            ?>
          </div>
        </div>
        <div class="col-lg-3 col-md-3">
          <div class="sidebar-area sidebar-three">
            <?php
              dynamic_sidebar('sidebar-3');
            ?>
          </div>
        </div>
      </div>
    <?php endif; ?>
  </div>
</div>

<?php get_footer(); ?>