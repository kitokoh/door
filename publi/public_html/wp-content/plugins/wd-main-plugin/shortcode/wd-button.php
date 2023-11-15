<?php
function doors_button($atts) {
	extract(shortcode_atts(array(
		'doors_btn_text' => 'Text',
		'doors_btn_link' => '',
		'doors_btn_style' => 'btn-solid',
		'doorsbtn_bg_color' => 'btn-color-1',
		'doors_btn_hover_bg_color' => 'hover-color-1',
		'doorsbtn_btn_size' => 'btn-medium',
		'doorsbtn_btn_border' => 'btn-round',
		'doorsbtn_btn_align' => 'text-left',
		'doors_btn_icon' => '',
		'doors_btn_icon_position' => 'after',
		'doors_show_icon' => '',
		'doors_btn_icon_style' => '',
		'css_animation' => 'no'),
		$atts));
	ob_start();

	$btn_classes = $doors_btn_style . " " . $doorsbtn_bg_color . " " . $doors_btn_hover_bg_color . " " . $doorsbtn_btn_size . " " . $doorsbtn_btn_border . " " . $doors_btn_icon_style . " icon-" . $doors_btn_icon_position;

	$animation_classes = "";
	$data_animated = "";

	if (($css_animation != 'no')) {
		$animation_classes = " animated ";
		$data_animated = "data-animated=$css_animation";
	}
	$href = vc_build_link( $doors_btn_link );
	?>

	<div class="wd-btn-wrap <?php echo esc_attr($doorsbtn_btn_align) . ' ' . esc_attr($animation_classes); ?>" <?php echo esc_attr($data_animated); ?>>
		<a href="<?php echo esc_url($href['url']) ?>" class="wd-btn
			<?php echo esc_attr($btn_classes) ?>">
			<?php if ($doors_show_icon == 'yes') { ?>
				<span class="button-wrp">
					<?php if($doors_btn_icon_position == 'before') { ?>
					 	<i class="<?php echo esc_html($doors_btn_icon); ?> before"></i>
					<?php } ?>
					 <span><?php echo esc_attr($doors_btn_text); ?></span>
					<?php if($doors_btn_icon_position == 'after') { ?>
					 	<i class="<?php echo esc_html($doors_btn_icon); ?> after"></i>
					<?php } ?>
				</span>
			<?php } else {
				echo esc_attr($doors_btn_text);
			} ?>
		</a>
	</div>

	<?php	return ob_get_clean();
}

add_shortcode('doors_button', 'doors_button'); ?>
