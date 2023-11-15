<?php
if($doors_blog_type == 'doors_multi_post') {
//_____________multi post  ________________________	
	//----------- masonry Posts ---------------
	if($doors_blog_style != 'doors_grid_blog') {
		//var_dump('masonry');
		$doors_class_name = doors_get_post_category ();
		$doors_class_name .= " column column-block doors_multi_post_isotop_item all ". esc_attr($animation_classes);
		?>
		<li id="post-<?php the_ID(); ?>" <?php post_class($doors_class_name); ?> <?php echo esc_attr($data_animated); ?>>
		 <div class="doors_multi_post_masonry">
				<?php
			if ( has_post_thumbnail() ) {
				$thumb = get_post_thumbnail_id(); 
			$img_url = wp_get_attachment_url( $thumb,'full' ); 
			if($doors_image_size_h != '') {
				$image = aq_resize( $img_url, $doors_image_size_w, $doors_image_size_h , true );
			}else{
				$image = aq_resize( $img_url, $doors_image_size_w, true );
			}
			
		  ?>
		  <img src="<?php echo esc_attr($image) ?>" alt="<?php the_title(); ?>"/>	
		  <?php 
			}
		   ?>
		   <div class="doors_multi_post_masonry_info">
			   <<?php echo esc_attr($doors_blog_title_tag); ?> style="<?php echo esc_attr($doors_custom_blog_title_inline_style); ?>">
				   <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
			   </<?php echo esc_attr($doors_blog_title_tag); ?>>
			   <div>
				   <span style="<?php echo esc_attr($doors_custom_blog_author_inline_style) ?>"><?php the_author() ?></span>
				   <span style="<?php echo esc_attr($doors_custom_blog_tags_date_inline_style) ?>">  <?php the_date('M, d, Y') ?>  </span>
				   <?php the_category() ?>
				   <p style="<?php echo esc_attr($doors_custom_blog_text_inline_style) ?>"><?php echo wp_trim_words(do_shortcode(get_the_content()),25); ?></p>
			   </div>
			  <div class="wd-redmore"><a href="<?php the_permalink() ?>">Continue</a><i class="ion-ios-arrow-thin-right"></i></div> 
		   </div>
		</div>
	   </li>
		<?php
	//----------- Grid Posts ---------------	
	}else{
		//----------------post image left -------------------
		if($doors_blog_affichage_type == 'doors_blog_image_left'){
			//var_dump('grid image left');
			$doors_class_name = doors_get_post_category ();
	   $doors_class_name .= " column column-block doors_multi_post_isotop_item wd-image-left all ". esc_attr($animation_classes);
		?>
		<li id="post-<?php the_ID(); ?>" <?php post_class($doors_class_name); ?> <?php echo esc_attr($data_animated); ?>>
	   <div class="large-12 columns doors_multi_post_left_image">
	   	<?php if ( has_post_thumbnail() ) { ?>
			<div class="columns large-4">
			<?php 
			$thumb = get_post_thumbnail_id(); 
			$img_url = wp_get_attachment_url( $thumb,'full' ); 
			if($doors_image_size_h != '') {
				$image = aq_resize( $img_url, $doors_image_size_w, $doors_image_size_h , true );
			}else{
				$image = aq_resize( $img_url, $doors_image_size_w, true );
			}
		  ?>
		  <img src="<?php echo esc_attr($image) ?>" alt="<?php the_title(); ?>"/>	
		  	</div>
		  	<?php } ?>
		  	<div class="large-8 columns doors_multi_post_left_image_info">
			   <<?php echo esc_attr($doors_blog_title_tag); ?> style="<?php echo esc_attr($doors_custom_blog_title_inline_style); ?>">
				   <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
			   </<?php echo esc_attr($doors_blog_title_tag); ?>>
			  	<div>
			    <span style="<?php echo esc_attr($doors_custom_blog_tags_date_inline_style) ?>"><?php the_date('M, d, Y') ?>  </span>
			   <span style="<?php echo esc_attr($doors_custom_blog_author_inline_style) ?>"><?php the_author() ?></span>
			     <?php the_category() ?>
			    <?php if($doors_blog_display_content == 'yes') { ?>
			    <p style="<?php echo esc_attr($doors_custom_blog_text_inline_style) ?>"><?php echo wp_trim_words(do_shortcode(get_the_content()),20); ?></p>
			    <?php } ?>
			    </div>
			  <div class="wd-redmore"><a href="<?php the_permalink() ?>">Read More</a><i class="ion-ios-arrow-thin-right"></i></div> 
		   </div>
	   </div>
	   </li>
		<?php
		//----------------post image top -------------------
		}else{
		$doors_class_name = doors_get_post_category ();
			$doors_class_name .= " column column-block doors_multi_post_isotop_item all ". esc_attr($animation_classes);
		?>
		<li id="post-<?php the_ID(); ?>" <?php post_class($doors_class_name); ?> <?php echo esc_attr($data_animated); ?>>
				<div class="doors_multi_post_top_image">
					<?php if ( has_post_thumbnail() ) { 
					 $thumb = get_post_thumbnail_id(); 
					 $img_url = wp_get_attachment_url( $thumb,'full' ); 
					 if($doors_image_size_h != '') {
							$image = aq_resize( $img_url, $doors_image_size_w, $doors_image_size_h , true );
						}else{
							$image = aq_resize( $img_url, $doors_image_size_w, true );
						} 
					?>
					<img src="<?php echo esc_attr($image) ?>" alt="<?php the_title(); ?>"/>
				   <?php } ?>
				   <div class="doors_multi_post_top_image_info">
					   <<?php echo esc_attr($doors_blog_title_tag); ?> style="<?php echo esc_attr($doors_custom_blog_title_inline_style); ?>">
					   <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
				   </<?php echo esc_attr($doors_blog_title_tag); ?>>
					   <div>
						   <span style="<?php echo esc_attr($doors_custom_blog_tags_date_inline_style) ?>"><?php the_date('M, d, Y') ?>  </span>
			    <span style="<?php echo esc_attr($doors_custom_blog_author_inline_style) ?>"><?php the_author() ?></span>
			    <?php the_category() ?>
						   <p style="<?php echo esc_attr($doors_custom_blog_text_inline_style) ?>"><?php echo wp_trim_words(do_shortcode(get_the_content()),25); ?></p>
					   </div>
					   <div class="wd-redmore"><a href="<?php the_permalink() ?>">Continue</a><i class="ion-ios-arrow-thin-right"></i></div>
				   </div>
			   </div>
		   </li>
		<?php	
		}
		
	}
		
   
//__________________one post___________________________
}elseif($doors_blog_type == 'doors_one_post') {
?>
<div class="doors_one_post_standar <?php echo esc_attr( esc_attr($animation_classes)); ?>" <?php echo esc_attr($data_animated); ?>>
	<?php 
    if ( has_post_thumbnail() ) {
		 $thumb = get_post_thumbnail_id(); 
		 $img_url = wp_get_attachment_url( $thumb,'full' ); 
		 if($doors_image_size_h != '') {
				$image = aq_resize( $img_url, $doors_image_size_w, $doors_image_size_h , true );
			}else{
				$image = aq_resize( $img_url, $doors_image_size_w, true );
			} 
		 ?>
		 <img src="<?php echo esc_attr($image) ?>" alt="<?php the_title(); ?>"/>
		 <?php
	} ?>
	<div class="doors_one_post_standar_info">
		<<?php echo esc_attr($doors_blog_title_tag); ?> style="<?php echo esc_attr($doors_custom_blog_title_inline_style); ?>">
					   <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
				   </<?php echo esc_attr($doors_blog_title_tag); ?>>
		<div>
		<span style="<?php echo esc_attr($doors_custom_blog_tags_date_inline_style) ?>"><?php the_date('M, d, Y') ?>  </span>
   <span style="<?php echo esc_attr($doors_custom_blog_author_inline_style) ?>"><?php the_author() ?></span>
    <span style="<?php echo esc_attr($doors_custom_blog_tags_date_inline_style) ?>"><?php the_category() ?></span>
		</div>
    <a class="button small" href="<?php the_permalink() ?>">Continue</a>
	</div>
	
</div>
	
	<?php
	//__________________freestyle
}else{
	
	if($doors_counter == 1) {
		?>
		<div class="large-12 columns doors_freestyle_content_position_<?php echo esc_attr($doors_counter) .' '.  esc_attr($animation_classes); ?>" <?php echo esc_attr($data_animated); ?>>
			<div class="large-6 columns">
				<?php if ( has_post_thumbnail() ) { 
					 $thumb = get_post_thumbnail_id(); 
					 $img_url = wp_get_attachment_url( $thumb,'full' ); 
					 if($doors_image_size_h != '') {
							$image = aq_resize( $img_url, $doors_image_size_w, $doors_image_size_h , true );
						}else{
							$image = aq_resize( $img_url, $doors_image_size_w, true );
						} 
					?>
					<img src="<?php echo esc_attr($image) ?>" alt="<?php the_title(); ?>"/>
				   <?php } ?>
			</div>
			
				<div class="large-6 columns doors_freestyle_content_position_<?php echo esc_attr($doors_counter) ?>_info">
					<<?php echo esc_attr($doors_blog_title_tag); ?> style="<?php echo esc_attr($doors_custom_blog_title_inline_style); ?>">
					   <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
				   </<?php echo esc_attr($doors_blog_title_tag); ?>>
					<div>
					<span style="<?php echo esc_attr($doors_custom_blog_tags_date_inline_style) ?>"><?php the_date('M, d, Y') ?>  </span>
			    <span>by :</span> <span style="<?php echo esc_attr($doors_custom_blog_author_inline_style) ?>"><?php the_author() ?></span>
			    <span> in :</span> <span style="<?php echo esc_attr($doors_custom_blog_tags_date_inline_style) ?>"><?php the_category() ?></span>
					</div>
			    	<div class="wd-redmore"><a href="<?php the_permalink() ?>">Continue</a><i class="ion-ios-arrow-thin-right"></i></div>
				</div>
			
		</div>
	<?php
	}elseif($doors_counter == 4) {
		?>
	<div class="doors_freestyle_content_position_<?php echo esc_attr($doors_counter) .' '.  esc_attr($animation_classes); ?>" <?php echo esc_attr($data_animated); ?>>
			<div>
				<?php if ( has_post_thumbnail() ) { 
					 $thumb = get_post_thumbnail_id(); 
					 $img_url = wp_get_attachment_url( $thumb,'full' ); 
					 if($doors_image_size_h != '') {
							$image = aq_resize( $img_url, $doors_image_size_w, $doors_image_size_h , true );
						}else{
							$image = aq_resize( $img_url, $doors_image_size_w, true );
						} 
					?>
					<img src="<?php echo esc_attr($image) ?>" alt="<?php the_title(); ?>"/>
				   <?php } ?>
			</div>
			
				<div class="doors_freestyle_content_position_<?php echo esc_attr($doors_counter) ?>_info">
					<<?php echo esc_attr($doors_blog_title_tag); ?> style="<?php echo esc_attr($doors_custom_blog_title_inline_style); ?>">
					   <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
				   </<?php echo esc_attr($doors_blog_title_tag); ?>>
					<div>
					<span style="<?php echo esc_attr($doors_custom_blog_tags_date_inline_style) ?>"><?php the_date('M, d, Y') ?>  </span>
			    <span>by :</span> <span style="<?php echo esc_attr($doors_custom_blog_author_inline_style) ?>"><?php the_author() ?></span>
			    <span> in :</span> <span style="<?php echo esc_attr($doors_custom_blog_tags_date_inline_style) ?>"><?php the_category() ?></span>
					</div>
			    	<div class="wd-redmore"><a href="<?php the_permalink() ?>">Continue</a><i class="ion-ios-arrow-thin-right"></i></div>
				</div>
			
		</div>
	<?php
	}else{
		?>
		<div class="large-6 columns doors_freestyle_content_position_<?php echo esc_attr($doors_counter) .' '.  esc_attr($animation_classes); ?>" <?php echo esc_attr($data_animated); ?>>
				<?php if ( has_post_thumbnail() ) { 
					 $thumb = get_post_thumbnail_id(); 
					 $img_url = wp_get_attachment_url( $thumb,'full' ); 
					 if($doors_image_size_h != '') {
							$image = aq_resize( $img_url, $doors_image_size_w, $doors_image_size_h , true );
						}else{
							$image = aq_resize( $img_url, $doors_image_size_w, true );
						} 
					?>
					<img src="<?php echo esc_attr($image) ?>" alt="<?php the_title(); ?>"/>
				   <?php } ?>
			</div>
	<?php
	}
	
}
