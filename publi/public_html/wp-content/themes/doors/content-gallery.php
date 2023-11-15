<li class="column column-block">
    <article id="post-<?php the_ID() ?>" <?php post_class(); ?>>
    <h2 class="node-title" datatype="" property="dc:title"><a
        href="<?php esc_url( the_permalink() ); ?>"><?php the_title(); ?></a></h2>

    <div class="post-thmbnail">
      <ul class="wd-gallery-images-holder clearfix">
				<?php $portfolio_image_gallery_val = get_post_meta( $post->ID, 'doors_portfolio-image-gallery', true );
				if ( $portfolio_image_gallery_val != '' ) {
					$portfolio_image_gallery_array = explode( ',', $portfolio_image_gallery_val );
				}
				if ( isset( $portfolio_image_gallery_array ) && count( $portfolio_image_gallery_array ) != 0 ) :
					foreach ( $portfolio_image_gallery_array as $gimg_id ) :
						$gimage_wp = wp_get_attachment_image_src( $gimg_id, 'doors_blog-thumb', true );
						echo '<li class="wd-gallery-image-holder"><img src="' . esc_url( $gimage_wp[0] ) . '" alt="' . the_title() . '"/></li>';
					endforeach;
				endif;
				?>
      </ul>
      <div class="date">
				<?php
				echo get_the_date( 'd M' );
				?>
      </div>
    </div>


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
      <p><?php echo wp_trim_words( get_the_content(), 60 ); ?></p>
    </div>
    <div class="read-more"><a
        href="<?php esc_url( the_permalink() ); ?>"><?php echo esc_html__( 'Read More', 'doors' ); ?><i
          class="fa fa-long-arrow-right"></i></a></div>

  </article>
</li>