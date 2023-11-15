<?php get_header();

if ( ! ( is_front_page() ) ) {
	if ( get_post_meta( get_the_ID(), 'doors_page_show_title_area', true ) != 'no' ) { ?>
    <section class="titlebar ">
      <div class="row">
          <div class="large-8 columns">
              <h1 id="page-title"
                  class="title <?php echo 'text-' . get_post_meta( get_the_ID(), 'doors_page_title_position', true ) ?>"><?php the_title(); ?></h1>
          </div>
        <div class="large-4 columns">
					<?php doors_breadcrumb(); ?>
        </div>

      </div>
    </section>
		<?php
	}
} ?>

  <!-- content  -->
  <main class="l-main">
    <div class="row <?php if(is_front_page()) echo 'main'; ?>">
			<?php if ( have_posts() ) :
				while ( have_posts() ) : the_post(); ?>
          <article>
            <div class="body field clearfix">
							<?php the_content(); ?>
            </div>
              <?php wp_link_pages(array('before' => '<div class="page-links">' . esc_html__('Pages:', 'doors'), 'after' => '</div>')); ?>
          </article>
				<?php endwhile;
			endif; ?>


    </div>
  </main>
  <!-- /content  -->

<?php get_footer(); ?>