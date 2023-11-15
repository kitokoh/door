<?php
/* Hero Image
---------------------------------------------------------- */
vc_map( array(
	"name"            => esc_html__( "Hero Image", 'doors' ),
	"base"            => "doors_hero_image",
	"category"        => __( "Webdevia", "doors" ),
	"icon"            => get_template_directory_uri() . "/images/icon/meknes.png",
	"content_element" => true,
	"is_container"    => false,
	"params"          => array(
		array(
			"type"       => "attach_image", // it will bind a img choice in WP
			"heading"    => esc_html__( "Image", 'doors' ),
			"param_name" => "image",
		),
		array(
			"type"       => "checkbox",
			"heading"    => esc_html__( "Full Screen", 'doors' ),
			"param_name" => "hero_full_screen",
			'value'      => array( esc_html__( 'Yes, please', 'doors' ) => 'yes' ),
		),
		array(
			"type"       => "textarea_raw_html", // it will bind a textfield in WP
			"heading"    => esc_html__( "Text", 'doors' ),
			"param_name" => "hero_text",
		)
	)
) );