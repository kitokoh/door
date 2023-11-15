<?php

function doors_get_heading_separator($headings_separator, $custom_separatore_style,$custom_separatore_img_style){
  if($headings_separator == "border"){
    echo "<hr style='$custom_separatore_style'/>"; }
  elseif($headings_separator == "image"){
    echo "<img src='$custom_separatore_img_style' style = '$custom_separatore_style' alt='separateur'/>";
  }
}


if(!function_exists('doors_headings')){
  function doors_headings($atts) {
    global $doors_fonts_to_enqueue_array;
    $headings_alignment = $custom_header_inline_style = $custom_subheader_inline_style = $custom_separatore_style = $doors_heading_spacing =$custom_separatore_img_style= $heading_extraclass = "";

    extract( shortcode_atts( array(
      'title'  => 'this is a title',
      'headings_title'  => 'The title..',
      'headings_title_tag'  => 'h2',
      'headings_subtitle'  => 'subtitle',
      'headings_subtitle_tag'  => 'h4',
      'headings_layout' => 's-under-t',
      'headings_alignment' => 'center',

      'headings_separator' => '',
      'headings_separator_position' => 'center',
      'headings_separator_border_style' => '',
      'headings_separator_border_width' => '',
      'headings_separator_border_color' => '',
      'doors_separateur_image' => '',
      'heading_extraclass' => '',

      'doors_heading_font_family' => '',
      'doors_heading_font_weight' => '',
      'doors_heading_font_size' => '',
      'wd_heading_color' => '',
      'doors_heading_text_transform' => '',
      'doors_heading_line_height' => '',
      'doors_heading_letter_spacing' => '',

      'doors_heading_spacing' => '10px',

      'doors_sub_heading_font_family' => '',
      'doors_sub_heading_font_weight' => '100',
      'doors_sub_heading_font_size' => '',
      'doors_sub_heading_color' => '',
      'doors_sub_heading_text_transform' => '',
      'doors_sub_heading_line_height' => '',
      'doors_sub_heading_letter_spacing' => '',

      'css_animation' => 'no'
    ), $atts ) );


    $headings_title = str_replace("{","<span>", $headings_title);
    $headings_title = str_replace("}","</span>",$headings_title);

    $headings_title = str_replace("/n","<br/>", $headings_title);

    $headings_subtitle = str_replace("/n","<br/>", $headings_subtitle);

    $animation_classes =  "";
    $data_animated = "";

    if(($css_animation != 'no')){
      $animation_classes =  " animated ";
      $data_animated = "data-animated=$css_animation";
    }

    $headings_alignment = "text-" . $headings_alignment;

    $custom_header_inline_style = "margin:0;";
    $doors_font_family_heading_to_enqueue = "";

    if($doors_heading_font_family != '' && $doors_heading_font_family != 'Default') {
      $custom_header_inline_style .= 'font-family:'.esc_attr($doors_heading_font_family).';';
      $doors_font_family_heading_to_enqueue .= esc_attr($doors_heading_font_family) . ":";
    }
    if($doors_heading_font_weight != '' && $doors_heading_font_family != '') {
      $custom_header_inline_style .= 'font-weight:'.esc_attr($doors_heading_font_weight).';';
      $doors_font_family_heading_to_enqueue .= esc_attr($doors_heading_font_weight) . "%7C";
    }
    if($doors_heading_font_size != '') {
      $custom_header_inline_style .= 'font-size:'.esc_attr($doors_heading_font_size).'px;';
    }
    if($wd_heading_color != '') {
      $custom_header_inline_style .= 'color:'.esc_attr($wd_heading_color).';';
    }
    if($doors_heading_text_transform != '') {
      $custom_header_inline_style .= 'text-transform:'.esc_attr($doors_heading_text_transform).';';
    }
    if($doors_heading_line_height != '') {
      $custom_header_inline_style .= 'line-height:'.esc_attr($doors_heading_line_height).'px;';
    }
    if($doors_heading_letter_spacing != '') {
      $custom_header_inline_style .= 'letter-spacing:'.esc_attr($doors_heading_letter_spacing).'px;';
    }

    $doors_fonts_to_enqueue_array[] = esc_attr($doors_font_family_heading_to_enqueue);




    // Separator : border
    if($headings_separator == 'border' && $headings_separator_border_style != '' ) {
      $custom_separatore_style .= 'border-bottom-style: ' . esc_attr( $headings_separator_border_style ) . ';';
    }
    if($headings_separator == 'border' && $headings_separator_border_width != '' ) {
      $custom_separatore_style .= 'border-bottom-width: ' . esc_attr( $headings_separator_border_width ) . ';';
    }
    if($headings_separator == 'border' && $headings_separator_border_color != '' ) {
      $custom_separatore_style .= 'border-color: '.esc_attr($headings_separator_border_color).';';
    }

    if($headings_separator == 'image' && $doors_separateur_image != '' ) {
      $custom_separatore_img_style .=  wp_get_attachment_url(esc_attr( $doors_separateur_image )) ;
    }

    $custom_separatore_style .= ' margin: '.esc_attr($doors_heading_spacing).' 0;';


    $doors_font_family_heading_to_enqueue = "";

    if($doors_sub_heading_font_family != '' && $doors_sub_heading_font_family != 'Default') {
      $custom_subheader_inline_style .= 'font-family:'.esc_attr($doors_sub_heading_font_family).';';
      $doors_font_family_heading_to_enqueue .= esc_attr($doors_sub_heading_font_family) . ":";
    }
    if($doors_sub_heading_font_weight != '' && $doors_sub_heading_font_family != '') {
      $custom_subheader_inline_style .= 'font-weight:'.esc_attr($doors_sub_heading_font_weight).';';
      $doors_font_family_heading_to_enqueue .= esc_attr($doors_sub_heading_font_weight) . "%7C";
    }
    if($doors_sub_heading_font_size != '') {
      $custom_subheader_inline_style .= 'font-size:'.esc_attr($doors_sub_heading_font_size).'px;';
    }
    if($doors_sub_heading_color != '') {
      $custom_subheader_inline_style .= 'color:'.esc_attr($doors_sub_heading_color).';';
    }
    if($doors_sub_heading_text_transform != '') {
      $custom_subheader_inline_style .= 'text-transform:'.esc_attr($doors_sub_heading_text_transform).';';
    }
    if($doors_sub_heading_line_height != '') {
      $custom_subheader_inline_style .= 'line-height:'.esc_attr($doors_sub_heading_line_height).'px;';
    }
    if($doors_sub_heading_letter_spacing != '') {
      $custom_subheader_inline_style .= 'letter-spacing:'.esc_attr($doors_sub_heading_letter_spacing).'px;';
    }

    $doors_fonts_to_enqueue_array[] = esc_attr($doors_font_family_heading_to_enqueue);




    ob_start(); ?>
		<div class="wd-heading <?php echo esc_attr($animation_classes .' '. $heading_extraclass .' '. $headings_alignment); ?>" <?php echo esc_attr($data_animated); ?>>
			<?php if($headings_layout == "t-under-s" ){ ?>

      <?php if( $headings_separator_position  == "top") {  doors_get_heading_separator($headings_separator, $custom_separatore_style,$custom_separatore_img_style); } ?>

      <?php if ($headings_subtitle != ""){ ?>
        <<?php echo $headings_subtitle_tag  ?> style="<?php echo esc_attr($custom_subheader_inline_style); ?>" >
              <?php echo $headings_subtitle  ?>
          </<?php echo $headings_subtitle_tag  ?>>
				<?php } ?>

      <?php
      if($headings_separator == "") {
        echo "<div style='margin-top: ".esc_attr($doors_heading_spacing).";'></div>";
      } ?>

      <?php if( $headings_separator_position  == "center") {  doors_get_heading_separator($headings_separator, $custom_separatore_style,$custom_separatore_img_style); } ?>

      <<?php echo $headings_title_tag  ?> style="<?php echo esc_attr($custom_header_inline_style); ?>" >
						<?php echo $headings_title  ?>
				</<?php echo $headings_title_tag  ?>>

				<?php if( $headings_separator_position  == "bottom") {  doors_get_heading_separator($headings_separator, $custom_separatore_style,$custom_separatore_img_style); }


    }elseif($headings_layout == "t-only"){

      if( $headings_separator_position  == "top") {  doors_get_heading_separator($headings_separator, $custom_separatore_style,$custom_separatore_img_style); } ?>

      <<?php echo $headings_title_tag  ?> style="<?php echo esc_attr($custom_header_inline_style); ?>" >
					<?php echo $headings_title  ?>
				</<?php echo $headings_title_tag  ?>>

				<?php if( $headings_separator_position  == "center") {  doors_get_heading_separator($headings_separator, $custom_separatore_style,$custom_separatore_img_style); }

    }else{ ?>

      <?php if( $headings_separator_position  == "top") {  doors_get_heading_separator($headings_separator, $custom_separatore_style,$custom_separatore_img_style); } ?>

      <<?php echo $headings_title_tag  ?> style="<?php echo esc_attr($custom_header_inline_style); ?>" >
					<?php echo $headings_title  ?>
				</<?php echo $headings_title_tag  ?>>

        <?php
      if($headings_separator == "") {
        echo "<div style='margin-top: ".esc_attr($doors_heading_spacing).";'></div>";
      } ?>
      <?php if( $headings_separator_position  == "center") {  doors_get_heading_separator($headings_separator, $custom_separatore_style,$custom_separatore_img_style); } ?>

      <?php if ($headings_subtitle != ""){ ?>
        <<?php echo $headings_subtitle_tag  ?> style="<?php echo esc_attr($custom_subheader_inline_style); ?>" >
					<?php echo $headings_subtitle  ?>
				</<?php echo $headings_subtitle_tag  ?>>
      <?php } ?>

      <?php if( $headings_separator_position  == "bottom") {  doors_get_heading_separator($headings_separator, $custom_separatore_style,$custom_separatore_img_style); } ?>

    <?php } ?>
		</div>

		<?php return ob_get_clean();
  }
  add_shortcode( 'doors_headings', 'doors_headings' );
}
?>