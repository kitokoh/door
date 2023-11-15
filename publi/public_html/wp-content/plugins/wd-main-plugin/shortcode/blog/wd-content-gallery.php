<?php
if($doors_blog_type == 'doors_multi_post') {
//_____________multi post  ________________________	
	//----------- masonry Posts ---------------
	if($doors_blog_style != 'doors_grid_blog') {
		$doors_class_name = doors_get_post_category ();
	   $doors_class_name .= " column column-block doors_multi_post_isotop_item all ".$animation_classes;
		?>
		<li id="post-<?php the_ID(); ?>" <?php post_class($doors_class_name); ?> <?php echo esc_attr($data_animated); ?>>
	   	<div class="doors_multi_post_gallery_masonry">
	   		  <ul class="doors_blog_post_gallery_masonry">
				  	<?php $portfolio_image_gallery_val = get_post_meta(get_the_ID(), 'doors_portfolio-image-gallery', true);
						if ($portfolio_image_gallery_val != '')
						 $portfolio_image_gallery_array = explode(',', $portfolio_image_gallery_val);
							if (isset($portfolio_image_gallery_array) && count($portfolio_image_gallery_array) != 0) :
								foreach ($portfolio_image_gallery_array as $gimg_id) :
									$thumb = wp_get_attachment_image_src($gimg_id, 'full');
									if($doors_image_size_h != '') {
										$image = doors_resize( $thumb[0], $doors_image_size_w, $doors_image_size_h , true );
									}else{
										$image = doors_resize( $thumb[0], $doors_image_size_w,477, true );
									}
									echo '<li><img src="' . $image . '" alt="'.get_the_title().'"/></li>';
								endforeach;
							endif;
				  	?>
			   </ul>
			   <div class="doors_multi_post_gallery_masonry_info">
				   <<?php echo esc_attr($doors_blog_title_tag); ?> style="<?php echo esc_attr($doors_custom_blog_name_inline_style); ?>">
					   <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
				   </<?php echo esc_attr($doors_blog_title_tag); ?>>
				   <div>
				   <span style="<?php echo esc_attr($doors_custom_blog_author_inline_style) ?>"><?php the_author() ?></span>
				   <span style="<?php echo esc_attr($doors_custom_blog_tags_date_inline_style) ?>">  <?php the_date('M, d, Y') ?>  </span>
				   <?php the_category() ?>
				   <p style="<?php echo esc_attr($doors_custom_blog_text_inline_style) ?>"><?php echo wp_trim_words(get_the_content(),25); ?></p>
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
			$doors_class_name .= " doors_multi_post_isotop_item wd-image-left all ".$animation_classes;
		?>
		<li id="post-<?php the_ID(); ?>" <?php post_class($doors_class_name); ?> <?php echo esc_attr($data_animated); ?>>
			<div class="large-12 columns doors_multi_post_gallery_left_image">
				<div class="columns large-4">
					<ul class="doors_blog_post_gallery_left_image">
				  	<?php $portfolio_image_gallery_val = get_post_meta(get_the_ID(), 'doors_portfolio-image-gallery', true);
						if ($portfolio_image_gallery_val != '')
						 $portfolio_image_gallery_array = explode(',', $portfolio_image_gallery_val);
							if (isset($portfolio_image_gallery_array) && count($portfolio_image_gallery_array) != 0) :
								foreach ($portfolio_image_gallery_array as $gimg_id) :
									$thumb = wp_get_attachment_image_src($gimg_id, 'full');
									if($doors_image_size_h != '') {
										$image = doors_resize( $thumb[0], $doors_image_size_w, $doors_image_size_h , true );
									}else{
										$image = doors_resize( $thumb[0], $doors_image_size_w, true );
									}
									echo '<li><img class="lazyOwl"  src ="' . $image . '" alt="'.get_the_title().'" /></li>';
								endforeach;
							endif;
				  	?>
				  	</ul>
			  	</div>
			  	<div class="large-8 columns doors_multi_post_gallery_left_image_info">
			  		<<?php echo esc_attr($doors_blog_title_tag); ?> style="<?php echo esc_attr($doors_custom_blog_name_inline_style); ?>">
				   		<a href="<?php the_permalink() ?>"><?php the_title() ?></a>
				   	</<?php echo esc_attr($doors_blog_title_tag); ?>>
				  	<div>
				    <span style="<?php echo esc_attr($doors_custom_blog_tags_date_inline_style) ?>"><?php the_date('M, d, Y') ?>  </span>
				   <span style="<?php echo esc_attr($doors_custom_blog_author_inline_style) ?>"> <?php the_author() ?></span>
				     <?php the_category() ?>
				    <?php if($doors_blog_display_content == 'yes') { ?>
				    <p style="<?php echo esc_attr($doors_custom_blog_text_inline_style) ?>"><?php echo wp_trim_words(get_the_content(),20); ?></p>
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
	   $doors_class_name .= " doors_multi_post_isotop_item all ".$animation_classes;
		?>
		<li id="post-<?php the_ID(); ?>" <?php post_class($doors_class_name); ?> <?php echo esc_attr($data_animated); ?>>
	   	<div class="doors_multi_post_gallery_top_image">
	   				<ul class="doors_blog_post_gallery_top_image">
				  	<?php $portfolio_image_gallery_val = get_post_meta(get_the_ID(), 'doors_portfolio-image-gallery', true);
						if ($portfolio_image_gallery_val != '')
						 $portfolio_image_gallery_array = explode(',', $portfolio_image_gallery_val);
							if (isset($portfolio_image_gallery_array) && count($portfolio_image_gallery_array) != 0) :
								foreach ($portfolio_image_gallery_array as $gimg_id) :
									$thumb = wp_get_attachment_image_src($gimg_id, 'full');
									if($doors_image_size_h != '') {
										$image = doors_resize( $thumb[0], $doors_image_size_w, $doors_image_size_h , true );
									}else{
										$image = doors_resize( $thumb[0], $doors_image_size_w,477, true );
									}
									echo '<li><img src="' . $image . '" alt="'.get_the_title().'" /></li>';
								endforeach;
							endif;
				  	?>
				  	</ul>
	   				<div class="doors_multi_post_gallery_top_image_info">
					   	<<?php echo esc_attr($doors_blog_title_tag); ?> style="<?php echo esc_attr($doors_custom_blog_name_inline_style); ?>">
				   			<a href="<?php the_permalink() ?>"><?php the_title() ?></a>
				   		</<?php echo esc_attr($doors_blog_title_tag); ?>>
					   <div>
						   <span style="<?php echo esc_attr($doors_custom_blog_author_inline_style) ?>"><?php the_author() ?></span>
						   <span style="<?php echo esc_attr($doors_custom_blog_tags_date_inline_style) ?>">  <?php the_date('M, d, Y') ?>  </span>
						   <?php the_category() ?>
						   <p style="<?php echo esc_attr($doors_custom_blog_text_inline_style) ?>"><?php echo wp_trim_words(get_the_content(),25); ?></p>
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
<div class="doors_one_post_gallery <?php echo esc_attr($animation_classes); ?>" <?php echo esc_attr($data_animated); ?>>
		<ul class="doors_blog_post_gallery">
	  	<?php $portfolio_image_gallery_val = get_post_meta(get_the_ID(), 'doors_portfolio-image-gallery', true);
			if ($portfolio_image_gallery_val != '')
			 $portfolio_image_gallery_array = explode(',', $portfolio_image_gallery_val);
				if (isset($portfolio_image_gallery_array) && count($portfolio_image_gallery_array) != 0) :
					foreach ($portfolio_image_gallery_array as $gimg_id) :
						$thumb = wp_get_attachment_image_src($gimg_id, 'full');
						if($doors_image_size_h != '') {
										$image = doors_resize( $thumb[0], $doors_image_size_w, $doors_image_size_h , true );
									}else{
										$image = doors_resize( $thumb[0], $doors_image_size_w,477, true );
									}
									echo '<li><img src="' . $image . '" alt="'.get_the_title().'" /></li>';
					endforeach;
				endif;
	  	?>
	  	</ul>
	  	
	  	<div class="doors_one_post_gallery_info">
				<<?php echo esc_attr($doors_blog_title_tag); ?> style="<?php echo esc_attr($doors_custom_blog_name_inline_style); ?>">
		   		<a href="<?php the_permalink() ?>"><?php the_title() ?></a>
		   	</<?php echo esc_attr($doors_blog_title_tag); ?>>
		    <div>
		    <span><?php the_date('M, d, Y') ?>  </span>
		    <span> <?php the_author() ?></span>
		    <?php the_category() ?>
		    </div>
		    <a class = "button small" href="<?php the_permalink() ?>">Continue</a>
	    </div>
</div>
	<?php
}else{
	if($doors_counter == 1) {
		?>
		<div class="large-12 columns doors_freestyle_content_position_<?php echo esc_attr($doors_counter) .' '. $animation_classes; ?>" <?php echo esc_attr($data_animated); ?>>
			<div class="large-6 columns">
				<ul class="doors_blog_post_gallery">
	  	<?php $portfolio_image_gallery_val = get_post_meta(get_the_ID(), 'doors_portfolio-image-gallery', true);
			if ($portfolio_image_gallery_val != '')
			 $portfolio_image_gallery_array = explode(',', $portfolio_image_gallery_val);
				if (isset($portfolio_image_gallery_array) && count($portfolio_image_gallery_array) != 0) :
					foreach ($portfolio_image_gallery_array as $gimg_id) :
						$thumb = wp_get_attachment_image_src($gimg_id, 'full');
						if($doors_image_size_h != '') {
										$image = doors_resize( $thumb[0], $doors_image_size_w, $doors_image_size_h , true );
									}else{
										$image = doors_resize( $thumb[0], $doors_image_size_w, true );
									}
									echo '<li><img src="' . $image . '" alt="'.get_the_title().'"/></li>';
					endforeach;
				endif;
	  	?>
	  	</ul>
			</div>
			
				<div class="large-6 columns doors_freestyle_content_position_<?php echo esc_attr($doors_counter) .' '. esc_attr($animation_classes); ?>_info">
					<<?php echo esc_attr($doors_blog_title_tag); ?> style="<?php echo esc_attr($doors_custom_blog_name_inline_style); ?>">
			   		<a href="<?php the_permalink() ?>"><?php the_title() ?></a>
			   	</<?php echo esc_attr($doors_blog_title_tag); ?>>
					<div>
					<span style="<?php echo esc_attr($doors_custom_blog_tags_date_inline_style) ?>"> <?php the_date('M, d, Y') ?></span>
			     	<span style="<?php echo esc_attr($doors_custom_blog_author_inline_style) ?>"><?php the_author() ?></span>
			     	<?php the_category() ?>
					</div>
			    	<div class="wd-redmore"><a href="<?php the_permalink() ?>">Continue</a><i class="ion-ios-arrow-thin-right"></i></div>
				</div>
			
		</div>
	<?php
	}elseif($doors_counter == 4) {
		?>
	<div class="doors_freestyle_content_position_<?php echo esc_attr($doors_counter) .' '. esc_attr($animation_classes); ?>" <?php echo esc_attr($data_animated); ?>>
			<div>
				<ul class="doors_blog_post_gallery">
	  	<?php $portfolio_image_gallery_val = get_post_meta(get_the_ID(), 'doors_portfolio-image-gallery', true);
			if ($portfolio_image_gallery_val != '')
			 $portfolio_image_gallery_array = explode(',', $portfolio_image_gallery_val);
				if (isset($portfolio_image_gallery_array) && count($portfolio_image_gallery_array) != 0) :
					foreach ($portfolio_image_gallery_array as $gimg_id) :
						$thumb = wp_get_attachment_image_src($gimg_id, 'full');
						if($doors_image_size_h != '') {
										$image = doors_resize( $thumb[0], $doors_image_size_w, $doors_image_size_h , true );
									}else{
										$image = doors_resize( $thumb[0], $doors_image_size_w, true );
									}
									echo '<li><img src="' . $image . '" alt="'.get_the_title().'" /></li>';
					endforeach;
				endif;
	  	?>
	  	</ul>
			</div>
			
				<div class="doors_freestyle_content_position_<?php echo esc_attr($doors_counter) .' '. esc_attr($animation_classes); ?>_info">
					<<?php echo esc_attr($doors_blog_title_tag); ?> style="<?php echo esc_attr($doors_custom_blog_name_inline_style); ?>">
			   		<a href="<?php the_permalink() ?>"><?php the_title() ?></a>
			   	</<?php echo esc_attr($doors_blog_title_tag); ?>>
					<div>
					<span> <?php the_date('M, d, Y') ?></span>	
			     	<span> by :</span><?php the_author() ?>
			     	<span> in :</span><?php the_category() ?>
					</div>
			    	<div class="wd-redmore"><a href="<?php the_permalink() ?>">Continue</a><i class="ion-ios-arrow-thin-right"></i></div>
				</div>
			
		</div>
	<?php
	}else{
		?>
		<div class="large-6 columns doors_freestyle_content_position_<?php echo esc_attr($doors_counter) .' '. esc_attr($animation_classes); ?>" <?php echo esc_attr($data_animated); ?>>
				<ul class="doors_blog_post_gallery">
	  	<?php $portfolio_image_gallery_val = get_post_meta(get_the_ID(), 'doors_portfolio-image-gallery', true);
			if ($portfolio_image_gallery_val != '')
			 $portfolio_image_gallery_array = explode(',', $portfolio_image_gallery_val);
				if (isset($portfolio_image_gallery_array) && count($portfolio_image_gallery_array) != 0) :
					foreach ($portfolio_image_gallery_array as $gimg_id) :
						$thumb = wp_get_attachment_image_src($gimg_id, 'full');
						if($doors_image_size_h != '') {
										$image = doors_resize( $thumb[0], $doors_image_size_w, $doors_image_size_h , true );
									}else{
										$image = doors_resize( $thumb[0], $doors_image_size_w, true );
									}
									echo '<li><img src="' . $image . '" alt="'.get_the_title().'"/></li>';
					endforeach;
				endif;
	  	?>
	  	</ul>
			</div>
	<?php
	}
}
