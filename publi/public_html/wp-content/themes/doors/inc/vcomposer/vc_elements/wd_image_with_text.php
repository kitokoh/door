<?php

global $vc_add_css_animation;

vc_map( array(
	"name"            => esc_html__( "Image Box", 'doors' ),
	"base"            => "doors_image_with_text",
	"category"        => __( "Webdevia", "doors" ),
	"icon"            => get_template_directory_uri() . "/images/icon/meknes.png",
	"content_element" => true,
	"is_container"    => false,
	"params"          => array(
		array(
			"type"       => "textfield",
			"heading"    => esc_html__( "Title", 'doors' ),
			"param_name" => "title",
		),
		array(
			"type"       => "textarea",
			"heading"    => esc_html__( "Text", 'doors' ),
			"param_name" => "text",
		),
		array(
			"type"       => "attach_image", // it will bind a img choice in WP
			"heading"    => esc_html__( "Image", 'doors' ),
			"param_name" => "image",
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Layout', 'doors' ),
			'param_name'  => 'layout',
			'value'       => array(
				'Layout 1' => 1,
				'Layout 2' => 2,
				'Layout 3' => 3,
				'Layout 4' => 4
			),
			'description' => esc_html__( 'Select the box style.', 'doors' ),
			'admin_label' => true
		),
		array(
			"type"       => "textfield",
			"heading"    => esc_html__( "URL to :", 'doors' ),
			"param_name" => "url",
		),
		array(
			"type"       => "textfield",
			"heading"    => esc_html__( "Extra Classes", 'doors' ),
			"param_name" => "extra_classes",
		),
		$vc_add_css_animation
	)
) );