<?php

global $vc_add_css_animation;
/*--------------------one post---------------*/

$posts       = get_posts( array( 'post_type' => 'portfolio' ) );
$posts_array = array();

foreach ( $posts as $key => $post ) {
	$posts_array[ $post->post_title ] = $post->ID;
}

vc_map( array(
	"name"            => esc_html__( "one post", 'doors' ),
	"base"            => "doors_one_post",
	"category"        => __( "Webdevia", "doors" ),
	"icon"            => get_template_directory_uri() . "/images/icon/meknes.png",
	"content_element" => true,
	"is_container"    => false,
	"params"          => array(
		array(
			"type"       => "textfield", // it will bind a textfield in WP
			"heading"    => esc_html__( "Title", 'doors' ),
			"param_name" => "title",
		),
		array(
			"type"       => "textarea", // it will bind a textfield in WP
			"heading"    => esc_html__( "Description", 'doors' ),
			"param_name" => "discription",
		),
		array(
			"type"       => "textfield", // it will bind a textfield in WP
			"heading"    => esc_html__( "Link to page", 'doors' ),
			"param_name" => "link",
		),
		array(
			"type"       => "dropdown", // it will bind a textfield in WP
			"heading"    => esc_html__( "Project", 'doors' ),
			"param_name" => "post_id",
			"value"      => $posts_array,

		),
		$vc_add_css_animation
	)
) );