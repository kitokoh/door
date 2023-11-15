<?php
vc_map( array(
	"name"            => esc_html__( "Wd Empty Space", 'doors' ),
	"base"            => "doors_empty_spaces",
	"category"        => __( "Webdevia", "doors" ),
	"icon"            => get_template_directory_uri() . "/images/icon/meknes.png",
	"content_element" => true,
	"is_container"    => false,
	"params"          => array(
		array(
			"type"       => "textfield",
			"heading"    => esc_html__( "Height in Mobile", 'doors' ),
			"param_name" => "height_mobile",
		),
		array(
			"type"       => "textfield",
			"heading"    => esc_html__( "Height in Tablet", 'doors' ),
			"param_name" => "height_tablet",
		),
		array(
			"type"       => "textfield",
			"heading"    => esc_html__( "Height in Desktop", 'doors' ),
			"param_name" => "height_desktop",
		),
		array(
			"type"       => "textfield",
			"heading"    => esc_html__( "Extra Classes", 'doors' ),
			"param_name" => "extra_classes",
		)
	)
) );