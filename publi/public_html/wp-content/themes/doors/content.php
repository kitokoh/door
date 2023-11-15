<li class="column column-block">
  <article id="post-<?php the_ID() ?>" <?php post_class(); ?>>
    <div class="post-thmbnail">
			<?php if ( has_post_thumbnail() ) {
				 the_post_thumbnail( 'doors_blog-thumb' );
			} ?>
      <div class="date"><?php echo get_the_date( 'd M' );	?></div>
    </div>
    <h2 class="post-title"><a href="<?php esc_url( the_permalink() ); ?>"><?php the_title(); ?></a></h2>

    <div class="post-info">
			<span class="author">
					<?php echo esc_html__( 'By : ', 'doors' ) ?>
				<span><?php the_author(); ?></span>
			</span>
			<?php the_category() ?>
      <span class="comment-count">				
					<?php comments_number( '0', '1', '% responses' ); ?>
					<?php echo esc_html__( 'comment', 'doors' ) ?>
			</span>
    </div>

    <div class="body text-secondary">
      <p><?php echo esc_html( wp_trim_words( do_shortcode(get_the_content()), 25 ) ); ?></p>
    </div>

    <div class="read-more">
			<a href="<?php esc_url( the_permalink() ); ?>">
				<?php echo esc_html__( 'Read More', 'doors' ); ?><i class="fa fa-long-arrow-right"></i>
			</a>
		</div>
  </article>
</li>