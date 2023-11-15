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
  $archive_year  = get_the_time('Y'); 
  $archive_month = get_the_time('m'); 
  $archive_day   = get_the_time('d'); 
?>
<div class="col-lg-4 col-md-4">
  <article id="post-<?php the_ID(); ?>" <?php post_class('inner-service'); ?>>
    <div class="services-box mb-4">    
      <?php if( get_theme_mod( 'interior_designs_feature_image_hide',true) != '' && has_post_thumbnail()) { ?>     
        <div class="service-image">
          <a href="<?php echo esc_url( get_permalink() ); ?>">
            <?php the_post_thumbnail(); ?><span class="screen-reader-text"><?php the_title(); ?></span></a>
          <div class="middle">
            <div class="text"><i class="fas fa-th-large"></i></div>
          </div>
        </div>
      <?php }?>
      <div class="lower-box py-1">
        <div class="tc-category py-3">
         <?php the_category(); ?>
       </div>
         <h2 class="pt-0"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?><span class="screen-reader-text"><?php the_title(); ?></span></a></h2>
        <?php if(get_the_excerpt()) { ?>
          <div class="entry-content"><p><?php $interior_designs_excerpt = get_the_excerpt(); echo esc_html( interior_designs_string_limit_words( $interior_designs_excerpt, esc_attr(get_theme_mod('interior_designs_post_excerpt_length','20')))); ?><?php echo esc_html( get_theme_mod('interior_designs_button_excerpt_suffix','[...]') ); ?></p></div>
        <?php }?>
        <?php if ( get_theme_mod('interior_designs_post_button_text','Read More') != '' ) {?>
          <div class="service-btn my-4">
            <a href="<?php the_permalink(); ?>"><?php echo esc_html( get_theme_mod('interior_designs_post_button_text',__( 'Read More','interior-designs' )) ); ?><span class="screen-reader-text"><?php echo esc_html( get_theme_mod('interior_designs_post_button_text',__( 'Read More','interior-designs' )) ); ?></span></a>
          </div>
        <?php }?>
      </div>
    </div>
  </article>
</div>