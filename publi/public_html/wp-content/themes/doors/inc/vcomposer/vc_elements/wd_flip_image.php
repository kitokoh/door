<?php

global $vc_add_css_animation;
// Flip image
vc_map( array(
	"name"            => esc_html__( "Flip image", 'doors' ), // add a name
	"base"            => "doors_flip_image", // bind with our shortcode
	"category"        => __( "Webdevia", "doors" ),
	"icon"            => get_template_directory_uri() . "/images/icon/meknes.png",
	"content_element" => true, // set this parameter when element will has a content
	"is_container"    => false, // set this param when you need to add a content element in this element
	// Here starts the definition of array with parameters of our compnent
	"params"          => array(
		array(
			"type"       => "attach_image", // it will bind a img choice in WP
			"heading"    => esc_html__( "Image", 'doors' ),
			"param_name" => "image",
		),

		array(
			"type"       => "textfield", // it will bind a textfield in WP
			"heading"    => esc_html__( "Title", 'doors' ),
			"param_name" => "title",
		),
		array(
			"type"       => "textarea", // it will bind a textarea in WP
			"heading"    => esc_html__( "Text", 'doors' ),
			"param_name" => "text",
		),
		$vc_add_css_animation
	)
) );