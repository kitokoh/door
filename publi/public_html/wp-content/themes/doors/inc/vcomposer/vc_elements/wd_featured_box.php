<?php

global $vc_add_css_animation;
global $icons;
/* Feature Box
---------------------------------------------------------- */
vc_map( array(
	"name"            => esc_html__( "Featured Box", 'doors' ),
	"base"            => "doors_featured_box",
	"category"        => __( "Webdevia", "doors" ),
	"icon"            => get_template_directory_uri() . "/images/icon/meknes.png",
	"content_element" => true,
	"is_container"    => false,
	"params"          => array(
		array(
			'type'        => 'colorpicker',
			'heading'     => esc_html__( 'Backround Color', 'doors' ),
			'param_name'  => 'background_color',
			'description' => esc_html__( 'Select font color', 'doors' ),
		),
		array(
			"type"       => "textfield", // it will bind a textfield in WP
			"heading"    => esc_html__( "Title", 'doors' ),
			"param_name" => "title",
		),
		array(
			"type"       => "textarea", // it will bind a textfield in WP
			"heading"    => esc_html__( "Text", 'doors' ),
			"param_name" => "text",
		),
		array(
			"type"       => "checkbox",
			"heading"    => esc_html__( "Display image instead of icon", 'doors' ),
			"param_name" => "image_checkbox",
			'value'      => array( esc_html__( 'Yes, please', 'doors' ) => 'yes' ),
		),
		array(
			"type"       => "attach_image", // it will bind a img choice in WP
			"heading"    => esc_html__( "Image", 'doors' ),
			"param_name" => "image",
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Icon', 'doors' ),
			'param_name'  => 'icon',
			'value'       => $icons,
			'description' => esc_html__( 'Select the icon to use.', 'doors' ),
			'admin_label' => true
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Layout', 'doors' ),
			'param_name'  => 'layout',
			'value'       => array(
				'Layout 1'         => 1,
				'Layout 2'         => 2,
				'Layout 3'         => 3,
				'Layout 4'         => 4,
				'Layout 5'         => 5,
				'Layout 5 inverse' => '5-inverse',
				'Layout 6'         => 6,
				'Layout 7'         => 7,
				'Layout 8'         => 8,
			),
			'description' => esc_html__( 'Select the icon to use.', 'doors' ),
			'admin_label' => true
		),
		array(
			"type"       => "textfield", // it will bind a textfield in WP
			"heading"    => esc_html__( "URL to :", 'doors' ),
			"param_name" => "url",
		),
		array(
			"type"       => "textfield", // it will bind a textfield in WP
			"heading"    => esc_html__( "Extra Classes", 'doors' ),
			"param_name" => "extra_classes",
		),
		$vc_add_css_animation
	)
) );