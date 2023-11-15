<?php 

if($doors_blog_type == 'doors_multi_post') {
//_____________multi post  ________________________	
	//----------- masonry Posts ---------------
	if($doors_blog_style != 'doors_grid_blog') {
		//var_dump('masonry');
		$doors_class_name = doors_get_post_category ();
			$doors_class_name .= " column column-block doors_multi_post_isotop_item all ".$animation_classes;
		?>
		<li id="post-<?php the_ID(); ?>" <?php post_class($doors_class_name); ?> <?php echo esc_attr($data_animated); ?>>
			<div class="doors_one_post_quote">
				<div>
					<blockquote style="<?php echo esc_attr($doors_custom_blog_text_inline_style) ?>"><?php the_content() ?></blockquote>
				        <div  class="doors_author">
				        	<span style="<?php echo esc_attr($doors_custom_blog_author_inline_style) ?>"><?php the_author() ?></span>
				        </div>     
					<i class="fa fa-quote-right"></i>
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
			$doors_class_name .= " doors_multi_post_isotop_item all ".$animation_classes;
		?>
		<li id="post-<?php the_ID(); ?>" <?php post_class($doors_class_name); ?> <?php echo esc_attr($data_animated); ?>>
			<div class="doors_one_post_quote">
				<div>
					<blockquote style="<?php echo esc_attr($doors_custom_blog_text_inline_style) ?>"><?php the_content() ?></blockquote>
				        <div  class="doors_author">
				        	<span style="<?php echo esc_attr($doors_custom_blog_author_inline_style) ?>"><?php the_author() ?></span>
				        </div>     
					<i class="fa fa-quote-right"></i>
				</div>
				
			</div>
			</li>
			<?php
			
		//----------------post image top -------------------
		}else{
			//var_dump('grid image top');
			$doors_class_name = doors_get_post_category ();
			$doors_class_name .= " doors_multi_post_isotop_item all ".$animation_classes;
		?>
		<li id="post-<?php the_ID(); ?>" <?php post_class($doors_class_name); ?> <?php echo esc_attr($data_animated); ?>>
				<div class="doors_one_post_quote">
				<div>
					<blockquote style="<?php echo esc_attr($doors_custom_blog_text_inline_style) ?>"><?php the_content() ?></blockquote>
				        <div  class="doors_author">
				        	<span style="<?php echo esc_attr($doors_custom_blog_author_inline_style) ?>"><?php the_author() ?></span>
				        </div>     
					<i class="fa fa-quote-right"></i>
				</div>
				
			</div>
			</li>
			<?php
			
		}
		
	}
		
   
//__________________one post___________________________
}elseif($doors_blog_type == 'doors_one_post') {
	
	?>
	<div class="doors_one_post_quote <?php echo esc_attr($animation_classes); ?>" <?php echo esc_attr($data_animated); ?>>
		<div>
			<blockquote style="<?php echo esc_attr($doors_custom_blog_text_inline_style) ?>"><?php the_content() ?></blockquote>
		        <div  class="doors_author">
		        	<span style="<?php echo esc_attr($doors_custom_blog_author_inline_style) ?>"><?php the_author() ?></span>
		        </div>     
			<i class="fa fa-quote-right"></i>
		</div>
		
	</div>
<?php 
}else{
	if($doors_counter == 1) {
		?>
		<div class="large-12 columns doors_freestyle_quote_position_<?php echo esc_attr($doors_counter) .' '. esc_attr($animation_classes); ?>" <?php echo esc_attr($data_animated); ?>>
			<div class="doors_one_post_quote">
				<i class="fa fa-quote-right"></i>
				<div>
					<blockquote style="<?php echo esc_attr($doors_custom_blog_text_inline_style) ?>"><?php the_content() ?></blockquote>
				        <div  class="doors_author">
				        	<span style="<?php echo esc_attr($doors_custom_blog_author_inline_style) ?>"><?php the_author() ?></span>
				        </div>     
					
				</div>
			</div>
		</div>
	<?php
	}elseif($doors_counter == 4) {
		?>
	<div class="doors_freestyle_quote_position_<?php echo esc_attr($doors_counter) .' '. esc_attr($animation_classes); ?>" <?php echo esc_attr($data_animated); ?>>
			<div class="doors_one_post_quote">
				<i class="fa fa-quote-right"></i>
				<div>
					<blockquote style="<?php echo esc_attr($doors_custom_blog_text_inline_style) ?>"><?php the_content() ?></blockquote>
				        <div  class="doors_author">
				        	<span style="<?php echo esc_attr($doors_custom_blog_author_inline_style) ?>"><?php the_author() ?></span>
				        </div>
				</div>
				
			</div>
			
		</div>
	<?php
	}else{
		?>
		<div class="large-6 columns doors_freestyle_quote_position_<?php echo esc_attr($doors_counter) .' '. esc_attr($animation_classes); ?>" <?php echo esc_attr($data_animated); ?>>
				<div class="doors_one_post_quote">
					<i class="fa fa-quote-right"></i>
				<div>
					<blockquote style="<?php echo esc_attr($doors_custom_blog_text_inline_style) ?>"><?php the_content() ?></blockquote>
				        <div  class="doors_author">
				        	<span style="<?php echo esc_attr($doors_custom_blog_author_inline_style) ?>"><?php the_author() ?></span>
				        </div>     
					
				</div>
				
			</div>
			</div>
	<?php
	}
}
 
