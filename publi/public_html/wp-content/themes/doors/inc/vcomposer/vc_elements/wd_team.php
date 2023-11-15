<?php

global $vc_add_css_animation;
/*********---------team--------------------------*/
vc_map( array(
	"name"            => esc_html__( "Team", 'doors' ), // add a name
	"base"            => "doors_team", // bind with our shortcode
	"category"        => __( "Webdevia", "doors" ),
	"icon"            => get_template_directory_uri() . "/images/icon/meknes.png",
	"content_element" => true, // set this parameter when element will has a content
	"is_container"    => false, // set this param when you need to add a content element in this element
	// Here starts the definition of array with parameters of our compnent
	"params"          => array(
		array(
			'type'       => 'dropdown',
			'param_name' => 'team_style',
			'heading'    => esc_html__( 'Team Style', 'doors' ),
			'value'      => array(
				esc_html__( 'Style 1', 'doors' ) => 'style_1',
				esc_html__( 'Style 2', 'doors' ) => 'style_2'
			),
		),
		array(
			"type"       => "dropdown", // it will bind a textfield in WP
			"heading"    => esc_html__( "Columns", 'doors' ),
			"param_name" => "columns",
			"value"      => array( '1', '2', '3', '4', '5', '6', '7' ),
		),
		array(
			"type"       => "textfield", // it will bind a textfield in WP
			"heading"    => esc_html__( "Items Per Page", 'doors' ),
			"param_name" => "itemperpage",
		),
		array(
			"type"       => "checkbox",
			"heading"    => esc_html__( "Display column gutters", 'doors' ),
			"param_name" => "team_collapse",
			"std"        => "yes",
			'value'      => array( esc_html__( 'Yes, please', 'doors' ) => 'yes' ),
		),
		array(
			"type"       => "checkbox",
			"heading"    => esc_html__( "Display team members description", 'doors' ),
			"param_name" => "show_description",
			"std"        => "yes",
			'value'      => array( esc_html__( 'Yes, please', 'doors' ) => 'yes' ),
		),
		$vc_add_css_animation
	)
) );