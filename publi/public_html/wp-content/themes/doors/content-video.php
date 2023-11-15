<li class="column column-block">
  <article id="post-<?php the_ID() ?>" <?php post_class(); ?>>
    <h2 class="node-title"><a
        href="<?php esc_url( the_permalink() ); ?>"><?php the_title(); ?></a></h2>


    <div class="post-thmbnail">
			<?php $_video_type = get_post_meta( get_the_ID(), "video_type", true ); ?>

			<?php if ( $_video_type == "youtube" ) { ?>

        <iframe src="<?php echo get_post_meta( get_the_ID(), "doors_youtube_link", true ); ?>?wmode=transparent"
                wmode="Opaque" frameborder="0" allowfullscreen></iframe>

			<?php } else if ( $_video_type == "vimeo" ) { ?>

        <iframe
          src="http://player.vimeo.com/video/<?php echo get_post_meta( get_the_ID(), "doors_vimeo_id", true ); ?>?title=0&amp;byline=0&amp;portrait=0"
          frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>

			<?php } else if ( $_video_type == "self_hosted" ) { ?>


        <video
          controls preload="auto" width="723" height="287">
          <source src="<?php echo get_post_meta( get_the_ID(), "doors_video_mp4", true ) ?>" type='video/mp4'/>
          <source src="<?php echo get_post_meta( get_the_ID(), "doors_video_webm", true ) ?>" type='video/webm'/>
          <source src="<?php echo get_post_meta( get_the_ID(), "doors_video_ogv", true ); ?>" type='video/ogg'/>

        </video>

			<?php } ?>
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