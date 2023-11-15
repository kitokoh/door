<?php
global $vc_add_css_animation;
global $doors_fonts_array;

vc_map( array(
	"name"            => esc_html__( "Button", 'doors' ),
	"base"            => "doors_button",
	"icon"            => get_template_directory_uri() . "/images/icon/meknes.png",
	"content_element" => true,
	"is_container"    => false,
	"category"        => 'Webdevia',
	"params"          => array(
		array(
			"type"        => "textfield",
			"heading"     => esc_html__( "Button Text", 'doors' ),
			"param_name"  => "doors_btn_text",
			"value"       => "Read More",
			"admin_label" => true,
		),
		array(
			"type"       => "vc_link",
			"heading"    => esc_html__( "Button Link", 'doors' ),
			"param_name" => "doors_btn_link",
			"value"      => "#",
		),
		array(
			"heading"    => esc_html__( "Button Style", "doors" ),
			"param_name" => "doors_btn_style",
			"type"       => "dropdown",
			'value'      => array(
				'Solid'     => "btn-solid",
				'Border'    => "btn-border",
				'Underline' => "btn-underline",
				'Shadow'    => "btn-shadow",
			),
		),
		array(
			"heading"    => esc_html__( "Normal Color", "doors" ),
			"param_name" => "doorsbtn_bg_color",
			"type"       => "dropdown",
			'value'      => array(
				'Color 1' => "btn-color-1",
				'Color 2' => "btn-color-2",
				'Color 3' => "btn-color-3",
				'Color 4' => "btn-color-4",
				'Color 5' => "btn-color-5",
				'Color 6' => "btn-color-6",
			),
		),
		array(
			"heading"    => esc_html__( "Hover Color", "doors" ),
			"param_name" => "doors_btn_hover_bg_color",
			"type"       => "dropdown",
			'value'      => array(
				'Color 1' => "hover-color-1",
				'Color 2' => "hover-color-2",
				'Color 3' => "hover-color-3",
				'Color 4' => "hover-color-4",
				'Color 5' => "hover-color-5",
				'Color 6' => "hover-color-6",
			),
		),
		array(
			"heading"    => esc_html__( "Button Size", "doors" ),
			"param_name" => "doorsbtn_btn_size",
			"type"       => "dropdown",
			'value'      => array(
				'Medium (Default)' => "btn-medium",
				'Big'              => "btn-big",
				'Small'            => "btn-small",
			),
		),
		array(
			"heading"    => esc_html__( "Button Border", "doors" ),
			"param_name" => "doorsbtn_btn_border",
			"type"       => "dropdown",
			'value'      => array(
				'Round (Default)' => "btn-round",
				'Radius'          => "btn-radius",
				'None'            => "btn-none",
			),
		),
		array(
			"heading"    => esc_html__( "Alignment", "doors" ),
			"param_name" => "doorsbtn_btn_align",
			"type"       => "dropdown",
			'value'      => array(
				'Left'   => "text-left",
				'Center' => "text-center",
				'Right'  => "text-right",
			),
		),
		array(
			"heading"    => esc_html__( "Show Icon", "doors" ),
			"param_name" => "doors_show_icon",
			"type"       => "checkbox",
			"std"        => "no",
			'value'      => array( esc_html__( 'Yes, Please', 'doors' ) => 'yes' ),
		),
		array(
			'type'       => 'iconpicker',
			'heading'    => esc_html__( 'Icon', 'doors' ),
			'param_name' => 'doors_btn_icon',
			"dependency" => Array( "element" => "doors_show_icon", "value" => array( 'yes' ) ),
		),
		array(
			"heading"    => esc_html__( "Icon Position", "doors" ),
			"param_name" => "doors_btn_icon_position",
			"type"       => "dropdown",
			'value'      => array(
				'After'  => "after",
				'Before' => "before",
			),
			"dependency" => Array( "element" => "doors_show_icon", "value" => array( 'yes' ) ),
		),
		array(
			"heading"    => esc_html__( "Icon Hover Style", "doors" ),
			"param_name" => "doors_btn_icon_style",
			"type"       => "dropdown",
			'value'      => array(
				'None'    => "",
				'Style 1' => "icon-hs-1",
				'Style 2' => "icon-hs-2",
			),
			"dependency" => Array( "element" => "doors_show_icon", "value" => array( 'yes' ) ),
		),

		$vc_add_css_animation

	)
) );