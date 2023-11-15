<?php get_header();

print get_template_part( 'parts/title-bar' );
?>
  <!-- content  -->
  <main class="row l-main">
    <div class="large-12 columns">

      <a id="main-content"></a>
			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>
          <article>

            <div class="large-7 columns">
              <div id="flexslider-1" class="flexslider flexslider-processed">
								<?php the_post_thumbnail( 'doors_650x350' ); ?>
              </div>
            </div>
            <div class="large-5 columns">
              <div class="project-tete clearfix">
                <h5
                  class="block-title project-description"><?php echo esc_html__( 'Project Description', 'doors' ) ?></h5>
                <span class="line"></span>
              </div>
              <div class="body field">
								<?php the_content(); ?>
              </div>
              <div class="project-tete clearfix">
                <h5 class="block-title project-description"><?php echo esc_html__( 'Project Type', 'doors' ) ?></h5>
                <span class="line"></span>
              </div>

              <div class="p-rl-20">
                <div
                  class="field field-name-field-project-type field-type-taxonomy-term-reference field-label-hidden field-wrapper clearfix">
                  <ul class="links">
                    <li class="taxonomy-term-reference-0">
											<?php
											$terms = get_terms( "projet" );

											foreach ( $terms as $term ) {
												?><span> <?php echo esc_attr( $term->name ); ?>  - </span> <?php
											}
											?>
                    </li>
                  </ul>
                </div>
              </div>

            </div>

          </article>
				<?php endwhile;
			endif;
			?>
    </div>
  </main>
  <!-- /content  -->
<?php get_footer(); ?>