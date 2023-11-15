<?php 
if(!function_exists('doors_blog')){
function doors_blog($atts) {
  global $doors_fonts_to_enqueue_array;
  extract( shortcode_atts( array(
    $doors_custom_blog_title_inline_style = $doors_custom_blog_text_inline_style = $doors_custom_blog_author_inline_style = $doors_custom_blog_tags_date_inline_style = "",
  	
    'doors_blog_type' => 'doors_multi_post',
    'doors_blog_affichage_one_post' => 'doors_blog_latest_post',
    'doors_blog_post_list' => '',
    "doors_blog_image_size" => '780x440',
    'doors_blog_display_filter' => 'doors_blog_show_filter',
    'doors_blog_category' => '',
    'show_pagination' => '',

    
    'doors_blog_item_perpage' => '',
    'doors_blog_columns' => '1',
    'doors_blog_style' => 'doors_grid_blog',
    'doors_blog_affichage_type' => 'doors_blog_image_left',
    'doors_blog_display_content' => 'yes',

    'doors_blog_title_tag' => 'h2',
    'doors_blog_title_font_family' => '',
    'doors_blog_title_font_size' => '',
    'doors_blog_title_color' => '',
    'doors_blog_title_font_weight' => '700',
    'doors_blog_title_text_transform' => '',
    'doors_blog_title_line_height' => '',
    'doors_blog_title_letter_spacing' => '',
    'doors_blog_title_font_style' => 'normal',


    'doors_blog_text_font_family' => '',
    'doors_blog_text_font_size' => '14',
    'doors_blog_text_color' => '#666666',
    'doors_blog_text_font_weight' => '400',
    'doors_blog_text_text_transform' => 'none',
    'doors_blog_text_line_height' => '28',
    'doors_blog_text_letter_spacing' => '',
    'doors_blog_text_font_style' => 'normal',


    'doors_blog_author_font_family' => '',
    'doors_blog_author_font_size' => '12',
    'doors_blog_author_color' => '#000',
    'doors_blog_author_font_weight' => '700',
    'doors_blog_author_text_transform' => '',
    'doors_blog_author_line_height' => '10',
    'doors_blog_author_letter_spacing' => '',
    'doors_blog_author_font_style' => 'normal',


    'doors_blog_tags_date_font_family' => '',
    'doors_blog_tags_date_font_size' => '12',
    'doors_blog_tags_date_color' => '#999999',
    'doors_blog_tags_date_font_weight' => '700',
    'doors_blog_tags_date_text_transform' => 'uppercase',
    'doors_blog_tags_date_line_height' => '',
    'doors_blog_tags_date_letter_spacing' => '0.3',
    'doors_blog_tags_date_font_style' => 'normal',

    'css_animation' => 'no'
  ), $atts ) );



  $doors_font_family_blog_to_enqueue = "";

    if($doors_blog_title_font_family != '' && $doors_blog_title_font_family != 'Default') {
      $doors_custom_blog_title_inline_style .= 'font-family:'.esc_attr($doors_blog_title_font_family).';';
      $doors_font_family_blog_to_enqueue .= esc_attr($doors_blog_title_font_family) . ":";
    }
    if($doors_blog_title_font_weight != '' && $doors_blog_title_font_family != '') {
      $doors_custom_blog_title_inline_style .= 'font-weight:'.esc_attr($doors_blog_title_font_weight).';';
      $doors_font_family_blog_to_enqueue .= esc_attr($doors_blog_title_font_weight) . "%7C";
    }
    if($doors_blog_title_font_size != '') {
      $doors_custom_blog_title_inline_style .= 'font-size:'.esc_attr($doors_blog_title_font_size).'px;';
    }
    if($doors_blog_title_color != '') {
      $doors_custom_blog_title_inline_style .= 'color:'.esc_attr($doors_blog_title_color).';';
    }
    if($doors_blog_title_text_transform != '') {
      $doors_custom_blog_title_inline_style .= 'text-transform:'.esc_attr($doors_blog_title_text_transform).';';
    }
    if($doors_blog_title_line_height != '') {
      $doors_custom_blog_title_inline_style .= 'line-height:'.esc_attr($doors_blog_title_line_height).'px;';
    }
    if($doors_blog_title_letter_spacing != '') {
      $doors_custom_blog_title_inline_style .= 'letter-spacing:'.esc_attr($doors_blog_title_letter_spacing).'px;';
    }
    if($doors_blog_title_font_style != '') {
      $doors_custom_blog_title_inline_style .= 'font-style:'.esc_attr($doors_blog_title_font_style).';';
    }

    $doors_fonts_to_enqueue_array[] = esc_attr($doors_font_family_blog_to_enqueue);





    $doors_font_family_blog_to_enqueue = "";

    if($doors_blog_text_font_family != '' && $doors_blog_text_font_family != 'Default') {
      $doors_custom_blog_text_inline_style .= 'font-family:'.esc_attr($doors_blog_text_font_family).';';
      $doors_font_family_blog_to_enqueue .= esc_attr($doors_blog_text_font_family) . ":";
    }
    if($doors_blog_text_font_weight != '' && $doors_blog_text_font_family != '') {
      $doors_custom_blog_text_inline_style .= 'font-weight:'.esc_attr($doors_blog_text_font_weight).';';
      $doors_font_family_blog_to_enqueue .= esc_attr($doors_blog_text_font_weight) . "%7C";
    }
    if($doors_blog_text_font_size != '') {
      $doors_custom_blog_text_inline_style .= 'font-size:'.esc_attr($doors_blog_text_font_size).'px;';
    }
    if($doors_blog_text_color != '') {
      $doors_custom_blog_text_inline_style .= 'color:'.esc_attr($doors_blog_text_color).';';
    }
    if($doors_blog_text_text_transform != '') {
      $doors_custom_blog_text_inline_style .= 'text-transform:'.esc_attr($doors_blog_text_text_transform).';';
    }
    if($doors_blog_text_line_height != '') {
      $doors_custom_blog_text_inline_style .= 'line-height:'.esc_attr($doors_blog_text_line_height).'px;';
    }
    if($doors_blog_text_letter_spacing != '') {
      $doors_custom_blog_text_inline_style .= 'letter-spacing:'.esc_attr($doors_blog_text_letter_spacing).'px;';
    }
    if($doors_blog_text_font_style != '') {
      $doors_custom_blog_text_inline_style .= 'font-style:'.esc_attr($doors_blog_text_font_style).';';
    }

    $doors_fonts_to_enqueue_array[] = esc_attr($doors_font_family_blog_to_enqueue);



    $doors_font_family_blog_to_enqueue = "";

    if($doors_blog_author_font_family != '' && $doors_blog_author_font_family != 'Default') {
      $doors_custom_blog_author_inline_style .= 'font-family:'.esc_attr($doors_blog_author_font_family).';';
      $doors_font_family_blog_to_enqueue .= esc_attr($doors_blog_author_font_family) . ":";
    }
    if($doors_blog_author_font_weight != '' && $doors_blog_author_font_family != '') {
      $doors_custom_blog_author_inline_style .= 'font-weight:'.esc_attr($doors_blog_author_font_weight).';';
      $doors_font_family_blog_to_enqueue .= esc_attr($doors_blog_author_font_weight) . "%7C";
    }
    if($doors_blog_author_font_size != '') {
      $doors_custom_blog_author_inline_style .= 'font-size:'.esc_attr($doors_blog_author_font_size).'px;';
    }
    if($doors_blog_author_color != '') {
      $doors_custom_blog_author_inline_style .= 'color:'.esc_attr($doors_blog_author_color).';';
    }
    if($doors_blog_author_text_transform != '') {
      $doors_custom_blog_author_inline_style .= 'text-transform:'.esc_attr($doors_blog_author_text_transform).';';
    }
    if($doors_blog_author_line_height != '') {
      $doors_custom_blog_author_inline_style .= 'line-height:'.esc_attr($doors_blog_author_line_height).'px;';
    }
    if($doors_blog_author_letter_spacing != '') {
      $doors_custom_blog_author_inline_style .= 'letter-spacing:'.esc_attr($doors_blog_author_letter_spacing).'px;';
    }
    if($doors_blog_author_font_style != '') {
      $doors_custom_blog_author_inline_style .= 'font-style:'.esc_attr($doors_blog_author_font_style).';';
    }

    $doors_fonts_to_enqueue_array[] = esc_attr($doors_font_family_blog_to_enqueue);




	$doors_custom_blog_name_inline_style = '';
    $doors_font_family_blog_to_enqueue = "";
    
    if($doors_blog_tags_date_font_family != '' && $doors_blog_tags_date_font_family != 'Default') {
      $doors_custom_blog_tags_date_inline_style .= 'font-family:'.esc_attr($doors_blog_tags_date_font_family).';';
      $doors_font_family_blog_to_enqueue .= esc_attr($doors_blog_tags_date_font_family) . ":";
    }
    if($doors_blog_tags_date_font_weight != '' && $doors_blog_tags_date_font_family != '') {
      $doors_custom_blog_tags_date_inline_style .= 'font-weight:'.esc_attr($doors_blog_tags_date_font_weight).';';
      $doors_font_family_blog_to_enqueue .= esc_attr($doors_blog_tags_date_font_weight) . "%7C";
    }
    if($doors_blog_tags_date_font_size != '') {
      $doors_custom_blog_tags_date_inline_style .= 'font-size:'.esc_attr($doors_blog_tags_date_font_size).'px;';
    }
    if($doors_blog_tags_date_color != '') {
      $doors_custom_blog_tags_date_inline_style .= 'color:'.esc_attr($doors_blog_tags_date_color).';';
    }
    if($doors_blog_tags_date_text_transform != '') {
      $doors_custom_blog_tags_date_inline_style .= 'text-transform:'.esc_attr($doors_blog_tags_date_text_transform).';';
    }
    if($doors_blog_tags_date_line_height != '') {
      $doors_custom_blog_tags_date_inline_style .= 'line-height:'.esc_attr($doors_blog_tags_date_line_height).'px;';
    }
    if($doors_blog_tags_date_letter_spacing != '') {
      $doors_custom_blog_tags_date_inline_style .= 'letter-spacing:'.esc_attr($doors_blog_tags_date_letter_spacing).'px;';
    }
    if($doors_blog_tags_date_font_style != '') {
      $doors_custom_blog_tags_date_inline_style .= 'font-style:'.esc_attr($doors_blog_tags_date_font_style).';';
    }

    $doors_fonts_to_enqueue_array[] = esc_attr($doors_font_family_blog_to_enqueue);


    
  ob_start();
  $animation_classes =  "";
      $data_animated = "";
  if(($css_animation != 'no')){
      $animation_classes =  " animated ";
      $data_animated = "data-animated=$css_animation";
}
  $sap = str_replace(array('X','x'),'X',$doors_blog_image_size);
  $doors_image_size_ = explode( 'X', $sap) ;
  if(isset($doors_image_size_[0])){
  	$doors_image_size_w = $doors_image_size_[0];
  }
  if(isset($doors_image_size_[1])){
  	$doors_image_size_h = $doors_image_size_[1];
  }else{
  	$doors_image_size_h = '';
  }
  

?>
<div class="blog-container">
  <?php 
  if($doors_blog_type  == 'doors_one_post')  {
    include( plugin_dir_path( __FILE__ ).'blog/one-post.php' )?>
  <?php }elseif($doors_blog_type  == 'doors_free_style') {
    include( plugin_dir_path( __FILE__ ).'blog/freestyle.php' );
  }else{      
     include( plugin_dir_path( __FILE__ ). 'blog/multi-post.php' );
    ?>
  <?php } ?>
</div>

	


  <?php return ob_get_clean();
  }
add_shortcode( 'doors_blog', 'doors_blog' ); }  ?>