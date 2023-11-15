<?php
global $vc_add_css_animation;
global $doors_fonts_array;

vc_map( array(
	"name"            => esc_html__( "Headings", 'doors' ),
	"base"            => "doors_headings",
	"category"        => __( "Webdevia", "doors" ),
	"icon"            => get_template_directory_uri() . "/images/icon/meknes.png",
	"content_element" => true,
	"is_container"    => false,
	"params"          => array(
		array(
			"heading"    => esc_html__( "Title", 'doors' ),
			"type"       => "textfield",
			'value'      => 'I am a title change me',
			"param_name" => "headings_title",
		),
		array(
			"heading"    => esc_html__( "Title Tag", 'doors' ),
			"type"       => "dropdown",
			"param_name" => "headings_title_tag",
			"value"      => array(
				'H2 (Default)' => 'h2',
				'H1'           => 'h1',
				'H3'           => 'h3',
				'H4'           => 'h4',
				'H5'           => 'h5',
				'H6'           => 'h6'
			),
		),
		array(
			"heading"    => esc_html__( "subtitle", 'doors' ),
			"type"       => "textfield",
			'value'      => 'I am a subtitle change me',
			"param_name" => "headings_subtitle",
		),
		array(
			"heading"    => esc_html__( "Subtitle Tag", 'doors' ),
			"type"       => "dropdown",
			"param_name" => "headings_subtitle_tag",
			"value"      => array(
				'H4 (Default)' => 'h4',
				'H1'           => 'h1',
				'H2'           => 'h2',
				'H3'           => 'h3',
				'H5'           => 'h5',
				'H6'           => 'h6',
				'P'            => 'p',
				'Div'          => 'div'
			),
		),
		array(
			"heading"    => esc_html__( "Layout", 'doors' ),
			"type"       => "dropdown",
			"param_name" => "headings_layout",
			"value"      => array(
				'Subtitle under the title'   => "s-under-t",
				'Title under the subtitle'   => "t-under-s",
				'Subtitle behind the  title' => "s-behind-t",
				'Title only'                 => "t-only"
			),
		),
		array(
			"heading"    => esc_html__( "Alignment", 'doors' ),
			"type"       => "dropdown",
			"param_name" => "headings_alignment",
			"value"      => array(
				'Center' => "center",
				'Left'   => "left",
				'Right'  => "right"
			),
		),
		array(
			"heading"    => esc_html__( "Separator Type", 'doors' ),
			"type"       => "dropdown",
			"param_name" => "headings_separator",
			"value"      => array(
				'No separator' => "none",
				'Border'       => "border",
				'Image'        => "image"
			)
		),

		array(
			'type'       => 'attach_image',
			'heading'    => esc_html__( 'Image', 'doors' ),
			'param_name' => 'doors_separateur_image',
			"dependency" => Array( "element" => "headings_separator", "value" => array( 'image' ) ),
		),
		array(
			"heading"    => esc_html__( "Separator Position", 'doors' ),
			"type"       => "dropdown",
			"param_name" => "headings_separator_position",
			"value"      => array(
				'Center' => "center",
				'Top'    => "top",
				'Bottom' => "bottom"
			),
			"dependency" => Array( "element" => "headings_separator", "value" => array( 'border', 'image' ) ),
		),
		array(
			"heading"    => esc_html__( "Border Style", 'doors' ),
			"type"       => "dropdown",
			"param_name" => "headings_separator_border_style",
			"value"      => array(
				'Solid'  => "solid",
				'Dashed' => "dashed",
				'Dotted' => "dotted"
			),
			"dependency" => Array( "element" => "headings_separator", "value" => array( 'border' ) ),
		),
		array(
			"type"       => "colorpicker",
			"heading"    => esc_html__( "Border Color", 'doors' ),
			"param_name" => "headings_separator_border_color",
			"value"      => "#DB4436",
			"dependency" => Array( "element" => "headings_separator", "value" => array( 'border' ) ),
		),
		array(
			"type"       => "textfield",
			"heading"    => esc_html__( "Border Width", 'doors' ),
			"param_name" => "headings_separator_border_width",
			"value"      => "3px",
			"dependency" => Array( "element" => "headings_separator", "value" => array( 'border' ) ),
		),
		array(
			"type"       => "textfield",
			"heading"    => esc_html__( "Margin between Title and subtitle", 'doors' ),
			"param_name" => "doors_heading_spacing",
		),

		//////////// Typography
		array(
			"type"             => "dropdown",
			"heading"          => esc_html__( "Font Family", 'doors' ),
			"param_name"       => "wd_heading_font_family",
			'value'            => $doors_fonts_array,
			"group"            => "Title Typography",
			"dependency"       => Array( "element" => "custom_style", "value" => array( 'yes' ) ),
			'edit_field_class' => 'vc_col-xs-3 vc_column-with-padding',
		),
		array(
			"type"             => "dropdown",
			"heading"          => esc_html__( "Font Style", 'doors' ),
			"param_name"       => "wd_heading_font_style",
			'value'            => array(
				esc_html__( 'Normal', 'doors' )  => 'normal',
				esc_html__( 'Italic', 'doors' )  => 'italic',
				esc_html__( 'Inherit', 'doors' ) => 'inherit',
				esc_html__( 'Initial', 'doors' ) => 'initial',
			),
			"group"            => "Title Typography",
			"dependency"       => Array( "element" => "custom_style", "value" => array( 'yes' ) ),
			'edit_field_class' => 'vc_col-xs-3',
		),
		array(
			"type"             => "dropdown",
			"heading"          => esc_html__( "Font Weight", 'doors' ),
			"param_name"       => "wd_heading_font_weight",
			'value'            => array(
				esc_html__( 'Default', 'doors' ) => '',
				'100'                            => '100',
				'200'                            => '200',
				'300'                            => '300',
				'400'                            => '400',
				'500'                            => '500',
				'600'                            => '600',
				'700'                            => '700',
				'800'                            => '800',
				'900'                            => '900',
			),
			"group"            => "Title Typography",
			"dependency"       => Array( "element" => "custom_style", "value" => array( 'yes' ) ),
			'edit_field_class' => 'vc_col-xs-3',
		),
		array(
			"type"             => "dropdown",
			"heading"          => esc_html__( "Text Transform", 'doors' ),
			"param_name"       => "wd_heading_text_transform",
			'value'            => array(
				esc_html__( 'Default', 'doors' ) => 'None',
				'lowercase'                      => 'Lowercase',
				'uppercase'                      => 'Uppercase',
				'capitalize'                     => 'Capitalize',
				'inherit'                        => 'Inherit',
			),
			"group"            => "Title Typography",
			"dependency"       => Array( "element" => "custom_style", "value" => array( 'yes' ) ),
			'edit_field_class' => 'vc_col-xs-3',
		),
		array(
			"type"             => "textfield",
			"class"            => "",
			"heading"          => esc_html__( "Font Size", 'doors' ),
			"param_name"       => "wd_heading_font_size",
			"min"              => 14,
			"suffix"           => "px",
			"group"            => "Title Typography",
			"dependency"       => Array( "element" => "custom_style", "value" => array( 'yes' ) ),
			'edit_field_class' => 'vc_col-xs-3',
		),
		array(
			"type"             => "textfield",
			"class"            => "",
			"heading"          => esc_html__( "Line Height", 'doors' ),
			"param_name"       => "wd_heading_line_height",
			"value"            => "",
			"suffix"           => "px",
			"group"            => "Title Typography",
			"dependency"       => Array( "element" => "custom_style", "value" => array( 'yes' ) ),
			'edit_field_class' => 'vc_col-xs-3',
		),
		array(
			"type"             => "textfield",
			"class"            => "",
			"heading"          => esc_html__( "Letter spacing", 'doors' ),
			"param_name"       => "wd_heading_letter_spacing",
			"value"            => "",
			"suffix"           => "px",
			"group"            => "Title Typography",
			"dependency"       => Array( "element" => "custom_style", "value" => array( 'yes' ) ),
			'edit_field_class' => 'vc_col-xs-3',
		),
		array(
			"type"             => "colorpicker",
			"class"            => "",
			"heading"          => esc_html__( "Font Color", 'doors' ),
			"param_name"       => "wd_heading_color",
			"value"            => "",
			"group"            => "Title Typography",
			"dependency"       => Array( "element" => "custom_style", "value" => array( 'yes' ) ),
			'edit_field_class' => 'vc_col-xs-3',
		),
		/////// Sub Title
		array(
			"type"             => "dropdown",
			'value'            => $doors_fonts_array,
			"heading"          => esc_html__( "Font Family", 'doors' ),
			"param_name"       => "wd_sub_heading_font_family",
			"group"            => "SubTitle Typography",
			"dependency"       => Array(
				"element" => "custom_style",
				"value"   => array( 'yes' ),
				Array( "element" => "headings_layout", "value" => array( 's-under-t', 't-under-s', 's-behind-t' ) )
			),
			'edit_field_class' => 'vc_col-xs-3 vc_column-with-padding',
		),
		array(
			"type"             => "dropdown",
			"heading"          => esc_html__( "Font Style", 'doors' ),
			"param_name"       => "wd_sub_heading_font_style",
			'value'            => array(
				esc_html__( 'Normal', 'doors' )  => 'normal',
				esc_html__( 'Italic', 'doors' )  => 'italic',
				esc_html__( 'Inherit', 'doors' ) => 'inherit',
				esc_html__( 'Initial', 'doors' ) => 'initial',
			),
			"group"            => "SubTitle Typography",
			"dependency"       => Array(
				"element" => "custom_style",
				"value"   => array( 'yes' ),
				Array( "element" => "headings_layout", "value" => array( 's-under-t', 't-under-s', 's-behind-t' ) )
			),
			'edit_field_class' => 'vc_col-xs-3',

		),
		array(
			"type"             => "dropdown",
			"heading"          => esc_html__( "Font Weight", 'doors' ),
			"param_name"       => "wd_sub_heading_font_weight",
			'value'            => array(
				esc_html__( 'Default', 'doors' ) => '',
				'100'                            => '100',
				'200'                            => '200',
				'300'                            => '300',
				'400'                            => '400',
				'500'                            => '500',
				'600'                            => '600',
				'700'                            => '700',
				'800'                            => '800',
				'900'                            => '900',
			),
			"group"            => "SubTitle Typography",
			"dependency"       => Array(
				"element" => "custom_style",
				"value"   => array( 'yes' ),
				Array( "element" => "headings_layout", "value" => array( 's-under-t', 't-under-s', 's-behind-t' ) )
			),
			'edit_field_class' => 'vc_col-xs-3',
		),
		array(
			"type"             => "dropdown",
			"heading"          => esc_html__( "Text Transform", 'doors' ),
			"param_name"       => "wd_sub_heading_text_transform",
			'value'            => array(
				esc_html__( 'Default', 'doors' ) => 'None',
				'lowercase'                      => 'Lowercase',
				'uppercase'                      => 'Uppercase',
				'capitalize'                     => 'Capitalize',
				'inherit'                        => 'Inherit',
			),
			"group"            => "SubTitle Typography",
			"dependency"       => Array(
				"element" => "custom_style",
				"value"   => array( 'yes' ),
				Array( "element" => "headings_layout", "value" => array( 's-under-t', 't-under-s', 's-behind-t' ) )
			),
			'edit_field_class' => 'vc_col-xs-3',
		),
		array(
			"type"             => "textfield",
			"class"            => "",
			"heading"          => esc_html__( "Font Size", 'doors' ),
			"param_name"       => "wd_sub_heading_font_size",
			"min"              => 14,
			"suffix"           => "px",
			"group"            => "SubTitle Typography",
			"dependency"       => Array(
				"element" => "custom_style",
				"value"   => array( 'yes' ),
				Array( "element" => "headings_layout", "value" => array( 's-under-t', 't-under-s', 's-behind-t' ) )
			),
			'edit_field_class' => 'vc_col-xs-3',
		),
		array(
			"type"             => "textfield",
			"class"            => "",
			"heading"          => esc_html__( "Line Height", 'doors' ),
			"param_name"       => "wd_sub_heading_line_height",
			"value"            => "",
			"suffix"           => "px",
			"group"            => "SubTitle Typography",
			"dependency"       => Array(
				"element" => "custom_style",
				"value"   => array( 'yes' ),
				Array( "element" => "headings_layout", "value" => array( 's-under-t', 't-under-s', 's-behind-t' ) )
			),
			'edit_field_class' => 'vc_col-xs-3',
		),
		array(
			"type"             => "textfield",
			"class"            => "",
			"heading"          => esc_html__( "Letter spacing", 'doors' ),
			"param_name"       => "wd_sub_heading_letter_spacing",
			"value"            => "",
			"suffix"           => "px",
			"group"            => "SubTitle Typography",
			"dependency"       => Array(
				"element" => "custom_style",
				"value"   => array( 'yes' ),
				Array( "element" => "headings_layout", "value" => array( 's-under-t', 't-under-s', 's-behind-t' ) )
			),
			'edit_field_class' => 'vc_col-xs-3',
		),
		array(
			"type"             => "colorpicker",
			"class"            => "",
			"heading"          => esc_html__( "Font Color", 'doors' ),
			"param_name"       => "wd_sub_heading_color",
			"value"            => "",
			"group"            => "SubTitle Typography",
			"dependency"       => Array(
				"element" => "custom_style",
				"value"   => array( 'yes' ),
				Array( "element" => "headings_layout", "value" => array( 's-under-t', 't-under-s', 's-behind-t' ) )
			),
			'edit_field_class' => 'vc_col-xs-3',
		),

		array(
			"type"       => "textfield",
			"class"      => "",
			"heading"    => esc_html__( "Extra class name", 'doors' ),
			"param_name" => "heading_extraclass",
			"value"      => "",
			"dependency" => Array( "element" => "custom_style", "value" => array( 'yes' ) ),
		),


		$vc_add_css_animation
	)
) );