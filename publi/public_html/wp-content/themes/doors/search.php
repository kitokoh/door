<?php get_header(); ?>

  <section class="titlebar ">
    <div class="row">
      <div class="right">
				<?php doors_breadcrumb(); ?>
      </div>
      <div class="large-12 columns">
        <h1 id="page-title"
            class="title"><?php printf( esc_html__( 'Search Results for: %s', 'doors' ), get_search_query() ); ?></h1>
      </div>
    </div>
  </section>


  <main class="row l-main">
    <div class="large-9 main columns">
			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>
          <article class="p-t-30">

            <h2 class="node-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

            <div class="field field-name-field-blog-image field-type-image field-label-hidden field-wrapper">
							<?php the_post_thumbnail( 'doors_blog-thumb' ); ?>
            </div>
            <div class="body text-secondary">
							<?php echo strip_shortcodes(wp_trim_words( get_the_content(), 70 ) ); ?>
            </div>
          </article>
				<?php endwhile; ?>
        <div class="wd-pagination">
					<?php
					global $wp_query;

					$big = 999999999;
					echo paginate_links( array(
						'base'    => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
						'format'  => '?paged=%#%',
						'current' => max( 1, get_query_var( 'paged' ) ),
						'total'   => $wp_query->max_num_pages,

					) );
					?>
        </div>

			<?php else : ?>
        <header class="page-header">
          <h1 class="page-title"><?php echo esc_html__( 'Nothing Found', 'doors' ); ?></h1>
        </header>
        <p> <?php echo esc_html__( 'It seems we cant find what youre looking for. Perhaps searching can help.', 'doors' ) ?></p>
			<?php
			endif;

			?>
    </div>
		<?php get_sidebar(); ?>
  </main>

<?php get_footer(); ?>