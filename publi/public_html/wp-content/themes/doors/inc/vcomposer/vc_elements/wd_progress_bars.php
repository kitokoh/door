<?php

global $vc_add_css_animation;
/*--------------progress bars -------------------------*/
vc_map( array(
	"name"            => esc_html__( "Progress bars", 'doors' ),
	"base"            => "doors_progress_bars",
	"category"        => __( "Webdevia", "doors" ),
	"content_element" => true,
	"is_container"    => true,
	"params"          => array(
		array(
			"type"       => "textfield", // it will bind a textfield in WP
			"heading"    => esc_html__( "Progress bar title", 'doors' ),
			"param_name" => "progress_title1",
		),
		array(
			"type"       => "textfield", // it will bind a textfield in WP
			"heading"    => esc_html__( "Progress bar longer", 'doors' ),
			"param_name" => "progress_meter1",
		),

		array(
			"type"       => "textfield", // it will bind a textfield in WP
			"heading"    => esc_html__( "Progress bar title", 'doors' ),
			"param_name" => "progress_title2",
		),
		array(
			"type"       => "textfield", // it will bind a textfield in WP
			"heading"    => esc_html__( "Progress bar longer", 'doors' ),
			"param_name" => "progress_meter2",
		),

		array(
			"type"       => "textfield", // it will bind a textfield in WP
			"heading"    => esc_html__( "Progress bar title", 'doors' ),
			"param_name" => "progress_title3",
		),
		array(
			"type"       => "textfield", // it will bind a textfield in WP
			"heading"    => esc_html__( "Progress bar longer", 'doors' ),
			"param_name" => "progress_meter3",
		),

		array(
			"type"       => "textfield", // it will bind a textfield in WP
			"heading"    => esc_html__( "Progress bar title", 'doors' ),
			"param_name" => "progress_title4",
		),
		array(
			"type"       => "textfield", // it will bind a textfield in WP
			"heading"    => esc_html__( "Progress bar longer", 'doors' ),
			"param_name" => "progress_meter4",
		),
		$vc_add_css_animation

	)
) );