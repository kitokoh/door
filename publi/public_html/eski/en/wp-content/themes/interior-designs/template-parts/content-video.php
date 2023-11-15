<?php
/**
 * The template part for displaying single-post
 *
 * @package Interior Designs
 * @subpackage interior_designs
 * @since Interior Designs 1.0
 */
?>
<?php
  $content = apply_filters( 'the_content', get_the_content() );
  $video = false;
  // Only get video from the content if a playlist isn't present.
  if ( false === strpos( $content, 'wp-playlist-script' ) ) {
    $video = get_media_embedded_in_content( $content, array( 'video', 'object', 'embed', 'iframe' ) );
  }
?>
<?php 
  $archive_year  = get_the_time('Y'); 
  $archive_month = get_the_time('m'); 
  $archive_day   = get_the_time('d'); 
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('inner-service'); ?>>
  <div class="services-box mb-4">      
    <div class="service-image">
      <?php
        if ( ! is_single() ) {
          // If not a single post, highlight the video file.
          if ( ! empty( $video ) ) {
            foreach ( $video as $video_html ) {
              echo '<div class="entry-video">';
                echo $video_html;
              echo '</div>';
            }
          }
        }; 
      ?>
      <div class="middle">
        <div class="text"><i class="fas fa-th-large"></i></div>
      </div>
    </div>
    <div class="lower-box py-1">
      <div class="tc-category py-3">
         <?php the_category(); ?>
       </div>
      <h2 class="pt-0"><a href="<?php echo esc_url( get_permalink() ); ?>" ><?php the_title(); ?><span class="screen-reader-text"><?php the_title(); ?></span></a></h2>
      <?php if(get_theme_mod( 'interior_designs_date_hide',true) != '' ||
        get_theme_mod( 'interior_designs_comment_hide',true) != '' || get_theme_mod( 'interior_designs_author_hide',true) != '' || get_theme_mod( 'interior_designs_time_hide',true) != '') { ?>
        <div class="metabox py-1 px-3 mb-2">

          <?php if( get_theme_mod( 'interior_designs_date_hide',true) != '') { ?>
          <span class="entry-date me-2 d-block"><i class="far fa-calendar-alt me-1"></i><a href="<?php echo esc_url( get_day_link( $archive_year, $archive_month, $archive_day)); ?>"><?php echo esc_html( get_the_date() ); ?><span class="screen-reader-text"><?php echo esc_html( get_the_date() ); ?></span></a></span>
          <?php } ?>

          <?php if( get_theme_mod( 'interior_designs_author_hide',true) != '') { ?>
            <span class="entry-author me-2"><i class="fas fa-user me-1"></i><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' )) ); ?>"><?php the_author(); ?><span class="screen-reader-text"><?php the_author(); ?></span></a></span>
          <?php } ?>

          <?php if( get_theme_mod( 'interior_designs_comment_hide',true) != '') { ?>
            <span class="entry-comments me-2"><i class="fa fa-comments me-1" aria-hidden="true"></i><?php comments_number( __('0 Comment', 'interior-designs'), __('0 Comments', 'interior-designs'), __('% Comments', 'interior-designs') ); ?> </span>
          <?php } ?>

          <?php if( get_theme_mod( 'interior_designs_time_hide',false) != '') { ?>
            <span class="entry-time"><i class="fas fa-clock me-1"></i> <?php echo esc_html( get_the_time() ); ?></span>
          <?php }?>
        </div>
      <?php } ?>
      <?php if(get_theme_mod('interior_designs_post_content') == 'Full Content'){ ?>
        <?php the_content(); ?>
      <?php }
      if(get_theme_mod('interior_designs_post_content', 'Excerpt Content') == 'Excerpt Content'){ ?>
        <?php if(get_the_excerpt()) { ?>
          <div class="entry-content"><p><?php $interior_designs_excerpt = get_the_excerpt(); echo esc_html( interior_designs_string_limit_words( $interior_designs_excerpt, esc_attr(get_theme_mod('interior_designs_post_excerpt_length','20')))); ?><?php echo esc_html( get_theme_mod('interior_designs_button_excerpt_suffix','[...]') ); ?></p></div>
        <?php }?>
      <?php }?>
      <?php if ( get_theme_mod('interior_designs_post_button_text','Read More') != '' ) {?>
        <div class="service-btn my-4">
          <a href="<?php the_permalink(); ?>"><?php echo esc_html( get_theme_mod('interior_designs_post_button_text',__( 'Read More','interior-designs' )) ); ?><span class="screen-reader-text"><?php echo esc_html( get_theme_mod('interior_designs_post_button_text',__( 'Read More','interior-designs' )) ); ?></span></a>
        </div>
      <?php }?>
    </div>
  </div>
</article>