<?php get_header();
print get_template_part( 'parts/title-bar' ); ?>

  <!-- content  -->
  <main  class="row l-main">
    <ul class="blog-post blog-grid clearfix small-up-1 medium-up-2 large-up-3">
      <!-- loop ... -->
			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'content', get_post_format() ); ?>
				<?php endwhile;
			endif;

			if ( comments_open() ) {
				comments_template( '', true );
			}
			?>
      <!-- /loop.. ********-->
    </ul>
    <!-- Pagination -->
    <div class="wd-pagination">
			<?php echo paginate_links(); ?>
    </div>

  </main>
<?php get_footer(); ?>