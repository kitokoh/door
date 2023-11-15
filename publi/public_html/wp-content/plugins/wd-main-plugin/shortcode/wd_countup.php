<?php
if(!function_exists('doors_count_up')){
	function doors_count_up($atts) {
		global $doors_fonts_to_enqueue_array;
		extract( shortcode_atts( array(
			//___________general_________



			'doors_countup_alignment'  => 'left',
			"doors_countup_layout"=> 'style1',
			//___________Title_________
			'doors_countup_title'  => '',
			'doors_countup_title_color'  => '',
			'doors_countup_title_padding'  => '',
			'doors_countup_title_font_family'  => '',
			'doors_countup_title_font_weight'  => '',
			'doors_countup_title_font_size'  => '',
			'doors_countup_title_text_transform'  => '',
			'doors_countup_title_line_height'  => '',
			'doors_countup_title_letter_spacing'  => '',
			//___________Number_________
			'doors_countup_number'  => '',
			'doors_countup_number_padding'  => '',
			'doors_countup_number_color'  => '',
			'doors_countup_number_font_family'  => '',
			'doors_countup_number_font_weight'  => '',
			'doors_countup_number_font_size'  => '',
			'doors_countup_number_text_transform'  => '',
			'doors_countup_number_line_height'  => '',
			'doors_countup_number_letter_spacing'  => '',
			//___________icon_________
			'doors_countup_switch'  => '',
			'doors_countup_image'  => '',
			'doors_coundup_fontawesome'  => '',
			'doors_countup_icon_padding'  => '',
			'doors_countup_icon_color'  => '',
			'doors_countup_icon_font_size'  => '',
			'css_animation' => 'no'
		), $atts ) );


		$animation_classes =  "";
		$data_animated = "";

		if(($css_animation != 'no')){
			$animation_classes =  " animated ";
			$data_animated = "data-animated=$css_animation";
		}
		//___________________ Title font Style _______________

		$doors_font_family_countup_to_enqueue = "";

		$custom_title_inline_style = '';
		if($doors_countup_title_font_family != '' && $doors_countup_title_font_family != 'Default') {
			$custom_title_inline_style .= 'font-family:'.esc_attr($doors_countup_title_font_family).';';
			$doors_font_family_countup_to_enqueue .= esc_attr($doors_countup_title_font_family) . ":";
		}
		if($doors_countup_title_padding != '') {
			$custom_title_inline_style .= 'padding:'.esc_attr($doors_countup_title_padding).';';
		}
		if($doors_countup_title_color != '') {
			$custom_title_inline_style .= 'color:'.esc_attr($doors_countup_title_color).';';
		}
		if($doors_countup_title_font_weight != '' && $doors_countup_title_font_family != '') {
			$custom_title_inline_style .= 'font-weight:'.esc_attr($doors_countup_title_font_weight) . ';';
			$doors_font_family_countup_to_enqueue .= esc_attr($doors_countup_title_font_weight) . "%7C";
		}
		if($doors_countup_title_font_size != '') {
			$custom_title_inline_style .= 'font-size:'.esc_attr($doors_countup_title_font_size).'px;';
		}
		if($doors_countup_title_text_transform != '') {
			$custom_title_inline_style .= 'text-transform:'.esc_attr($doors_countup_title_text_transform).';';
		}
		if($doors_countup_title_line_height != '') {
			$custom_title_inline_style .= 'line-height:'.esc_attr($doors_countup_title_line_height).'px;';
		}
		if($doors_countup_title_letter_spacing != '') {
			$custom_title_inline_style .= 'letter-spacing:'.esc_attr($doors_countup_title_letter_spacing).'px;';
		}

		$doors_fonts_to_enqueue_array[] = esc_attr($doors_font_family_countup_to_enqueue);


		$doors_font_family_countup_to_enqueue = "";
		//___________Number style_________
		$custom_number_inline_style ='';
		if($doors_countup_number_color != '') {
			$custom_number_inline_style .= 'color:'.esc_attr($doors_countup_number_color).';';
		}
		if($doors_countup_number_font_family != '' && $doors_countup_number_font_family != 'Default') {
			$custom_number_inline_style .= 'font-family:'.esc_attr($doors_countup_number_font_family).';';
			$doors_font_family_countup_to_enqueue .= esc_attr($doors_countup_number_font_family) . ":";
		}
		if($doors_countup_number_font_weight != '' && $doors_countup_number_font_family != '') {
			$custom_number_inline_style .= 'font-weight:'.esc_attr($doors_countup_number_font_weight).';';
			$doors_font_family_countup_to_enqueue .= esc_attr($doors_countup_number_font_weight) . "%7C";
		}
		if($doors_countup_number_font_size != '') {
			$custom_number_inline_style .= 'font-size:'.esc_attr($doors_countup_number_font_size).'px;';
		}
		if($doors_countup_number_text_transform != '') {
			$custom_number_inline_style .= 'text-transform:'.esc_attr($doors_countup_number_text_transform).';';
		}
		if($doors_countup_number_line_height != '') {
			$custom_number_inline_style .= 'line-height:'.esc_attr($doors_countup_number_line_height).'px;';
		}
		if($doors_countup_number_letter_spacing != '') {
			$custom_number_inline_style .= 'letter-spacing:'.esc_attr($doors_countup_number_letter_spacing).'px;';
		}
		if($doors_countup_number_padding != '') {
			$custom_number_inline_style .= 'padding:'.esc_attr($doors_countup_number_padding).';';
		}

		$doors_fonts_to_enqueue_array[] = esc_attr($doors_font_family_countup_to_enqueue);

		//_________________________Icon style ___________________________
		$custom_icon_inline_style ='';
		if($doors_countup_icon_color != '') {
			$custom_icon_inline_style .= 'color:'.esc_attr($doors_countup_icon_color).';';
		}
		if($doors_countup_icon_font_size != '') {
			$custom_icon_inline_style .= 'font-size:'.esc_attr($doors_countup_icon_font_size).'px;';
		}
		if($doors_countup_icon_padding != '') {
			$custom_icon_inline_style .= 'padding:'.esc_attr($doors_countup_icon_padding).';';
		}

		ob_start(); ?>

		<div class="<?php echo  esc_attr($animation_classes); ?> clearfix" style="text-align:<?php echo esc_attr($doors_countup_alignment) ?>" <?php echo esc_attr($data_animated); ?>>

			<?php if($doors_countup_layout == 'style1') {  ?>
				<?php if($doors_countup_switch == 'doors_countup_icon') { ?>
					<i class="fa fa-<?php echo esc_attr($doors_coundup_fontawesome) ?>" style="<?php echo esc_attr($custom_icon_inline_style) ?>"></i>
				<?php }elseif($doors_countup_switch == 'doors_countup_image'){
					$doors_image = wp_get_attachment_image_src( $doors_countup_image, '150X150');
					?>
					<img src="<?php echo $doors_image[0] ?>" style="<?php echo esc_attr($custom_icon_inline_style) ?>">
				<?php
				} ?>
				<h5 style="<?php echo esc_attr($custom_number_inline_style) ?>" class="counter" data-file="<?php echo $doors_countup_number ?>"><?php echo esc_attr($doors_countup_number) ?> </h5>
				<h2 style="<?php echo esc_attr($custom_title_inline_style) ?>"><?php echo esc_attr($doors_countup_title) ?></h2>

			<?php }elseif($doors_countup_layout == 'style2'){ ?>
				<h2 style="<?php echo esc_attr($custom_title_inline_style) ?>"><?php echo esc_attr($doors_countup_title) ?></h2>
				<?php if($doors_countup_switch == 'doors_countup_icon') { ?>
					<i class="fa fa-<?php echo esc_attr($doors_coundup_fontawesome) ?>" style="<?php echo esc_attr($custom_icon_inline_style) ?>"></i>
				<?php }elseif($doors_countup_switch == 'doors_countup_image'){
					$doors_image = wp_get_attachment_image_src( $doors_countup_image, '150X150');
					?>
					<img src="<?php echo $doors_image[0] ?>" style="<?php echo esc_attr($custom_icon_inline_style) ?>">
				<?php
				} ?>
				<h5 style="<?php echo esc_attr($custom_number_inline_style) ?>" class="counter" data-file="<?php echo $doors_countup_number ?>"><?php echo esc_attr($doors_countup_number) ?> </h5>


			<?php }else{ ?>
				<h5 style="<?php echo esc_attr($custom_number_inline_style) ?>" class="counter" data-file="<?php echo $doors_countup_number ?>"><?php echo esc_attr($doors_countup_number) ?> </h5>
				<?php if($doors_countup_switch == 'doors_countup_icon') { ?>
					<i class="fa fa-<?php echo esc_attr($doors_coundup_fontawesome) ?>" style="<?php echo esc_attr($custom_icon_inline_style) ?>"></i>
				<?php }elseif($doors_countup_switch == 'doors_countup_image'){
					$doors_image = wp_get_attachment_image_src( $doors_countup_image, '150X150');
					?>
					<img src="<?php echo $doors_image[0] ?>" style="<?php echo esc_attr($custom_icon_inline_style) ?>">
				<?php
				} ?>

				<h2 style="<?php echo esc_attr($custom_title_inline_style) ?>"><?php echo esc_attr($doors_countup_title) ?></h2>

			<?php } ?>

		</div>

		<?php return ob_get_clean();
	}
	add_shortcode( 'doors_count_up', 'doors_count_up' );
}
?>