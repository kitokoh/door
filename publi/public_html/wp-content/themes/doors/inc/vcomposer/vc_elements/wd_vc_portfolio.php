<?php

global $vc_add_css_animation;
//-----------------portfolio------------------*/

vc_map( array(
	"name"            => esc_html__( "Portfolio", 'doors' ),
	"base"            => "wd_vc_portfolio",
	"category"        => __( "Webdevia", "doors" ),
	"icon"            => get_template_directory_uri() . "/images/icon/meknes.png",
	"content_element" => true,
	"is_container"    => false,
	"params"          => array(
		array(
			"type"       => "textfield", // it will bind a textfield in WP
			"heading"    => esc_html__( "Items to display", 'doors' ),
			"param_name" => "itemperpage",
		),
		array(
			"type"       => "textfield", // it will bind a textfield in WP
			"heading"    => esc_html__( "Show", 'doors' ),
			"param_name" => "number",
		),
		array(
			"type"       => "textfield", // it will bind a textfield in WP
			"heading"    => esc_html__( "Margin", 'doors' ),
			"param_name" => "margin",
		),
		array(
			"type"       => "dropdown", // it will bind a textfield in WP
			"heading"    => esc_html__( "Layout", 'doors' ),
			"param_name" => "layout",
			"value"      => array( 'grid' => '1', 'carousel' => '2' ),
		),
		array(
			"type"       => "dropdown", // it will bind a textfield in WP
			"heading"    => esc_html__( "Style", 'doors' ),
			"param_name" => "style",
			"value"      => array(
				'Lily'   => 'lily',
				'Sadie'  => 'sadie',
				'Honey'  => 'honey',
				'Layla'  => 'layla',
				'Zoe'    => 'zoe',
				'Oscar'  => 'oscar',
				'Marley' => 'marley',
				'Ruby'   => 'ruby',
				'Roxy'   => 'roxy',
				'Bubba'  => 'bubba',
				'Romeo'  => 'romeo',
				'Dexter' => 'dexter',
				'Sarah'  => 'sarah',
				'Chico'  => 'chico',
				'Milo'   => 'milo',

			),
		),
		array(
			"type"       => "checkbox",
			"heading"    => esc_html__( "Display Pagination", 'doors' ),
			"param_name" => "show_pagination",
		),
		$vc_add_css_animation

	)
) );