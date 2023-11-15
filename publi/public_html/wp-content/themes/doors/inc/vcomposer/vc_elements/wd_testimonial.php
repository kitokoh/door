<?php

/*********---------testimonial--------------------------*/
add_action( 'admin_init', 'doors_testimonial_init' );

function doors_testimonial_init() {
	global $vc_add_css_animation;
	global $doors_fonts_array;
	vc_map( array(
		"name"            => esc_html__( "Wd Testimonail", 'doors' ), // add a name
		"base"            => "doors_testimonials", // bind with our shortcode
		"category"        => __( "Webdevia", "doors" ),
		"icon"            => get_template_directory_uri() . "/images/icon/meknes.png",
		"content_element" => true, // set this parameter when element will has a content
		"is_container"    => false, // set this param when you need to add a content element in this element
		// Here starts the definition of array with parameters of our compnent
		"params"          => array(
	 	array(
				'type'       => 'dropdown',
				'param_name' => 'testimonials_style',
				'heading'    => esc_html__( 'testimonials Style', 'doors' ),
				'value'      => array(
					esc_html__( 'Style 1', 'doors' ) => 'style_1',
					esc_html__( 'Style 2', 'doors' ) => 'style_2'
				),
			),
			array(
				"type"       => "dropdown",
				"heading"    => esc_html__( "Layout Style", 'doors' ),
				"param_name" => "layout_style",
				"value"      => array(
					'Carousel'       => 'carousel',
					'Slider'         => 'slider',
					'Boxes Carousel' => 'boxes-carousel'

				),
			),
			array(
				"type"       => "dropdown",
				"heading"    => esc_html__( "Show Thumbnail", 'doors' ),
				"param_name" => "show_thumbnail",
				"value"      => array(
					'Yes' => 'yes',
					'No'  => 'no'
				),
			),
			array(
				"type"       => "dropdown",
				"heading"    => esc_html__( "Carousel Style", 'doors' ),
				"param_name" => "carousel_style",
				"value"      => array(
					'Style 1(Default)' => '',
					'Style 2'          => 'carousel-s2'
				),
				"dependency" => Array( "element" => "layout_style", "value" => array( 'carousel' ) ),
			),
			array(
				"type"       => "dropdown",
				"heading"    => esc_html__( "Thumbnail position", 'doors' ),
				"param_name" => "thumbnail_position",
				"value"      => array(
					'Bottom' => 'bottom',
					'Top'    => 'top'
				),
			),
			array(
				"type"       => "checkbox",
				"heading"    => esc_html__( "Categories", 'doors' ),
				"param_name" => "doors_testimonial_categories",
				'value'      => doors_get_categories( 'testimonials_categories' ),
			),
			array(
				"type"       => "checkbox",
				"heading"    => esc_html__( "Infinity Scroll", 'doors' ),
				"param_name" => "infinity_scroll",
				'value'      => array( esc_html__( 'Yes, please', 'doors' ) => 'yes' ),
			),
			array(
				"type"       => "dropdown",
				"heading"    => esc_html__( "Items To Show", 'doors' ),
				"param_name" => "testimonial_items_to_show",
				'value'      => array(
					'All items' => '-1',
					'1 item'    => '1',
					'2 items'   => '2',
					'3 items'   => '3',
					'4 items'   => '4',
					'5 items'   => '5',
					'6 items'   => '6',
					'7 items'   => '7',
					'8 items'   => '8',
					'9 items'   => '9',
					'10 items'  => '10',
					'11 items'  => '11',
					'12 items'  => '12',
					'13 items'  => '13',
					'14 items'  => '14',
					'15 items'  => '15',
					'20 items'  => '20',
					'25 items'  => '25',
					'30 items'  => '30',
					'35 items'  => '35',
					'40 items'  => '40'


				),
			),
			array(
				"type"        => "textfield",
				"class"       => "",
				"heading"     => esc_html__( "Text margin", 'doors' ),
				"param_name"  => "testimonial_text_margin",
				'description' => esc_html__( 'for example : 10px 10px 10px 10px', 'doors' ),
			),
			array(
				"type"        => "textfield",
				"class"       => "",
				"heading"     => esc_html__( "Quotes margin", 'doors' ),
				"param_name"  => "testimonial_quotes_margin",
				'description' => esc_html__( 'for example : 10px 10px 10px 10px', 'doors' ),
			),
			// ________Name Typo
			array(
				"heading"    => esc_html__( "Testimonial Title Tag", 'doors' ),
				"type"       => "dropdown",
				"param_name" => "testimonial_title_tag",
				"value"      => array(
					'H6 (Default)' => 'h6',
					'H1'           => 'h1',
					'H2'           => 'h2',
					'H3'           => 'h3',
					'H4'           => 'h4',
					'H5'           => 'h5',
					'P'            => 'p',
					'Span'         => 'span',
				),
				"group"      => "Name Style",
			),
			array(
				"type"       => "dropdown",
				'value'      => $doors_fonts_array,
				"heading"    => esc_html__( "Testimonial Title Font Family", 'doors' ),
				"param_name" => "testimonial_title_font_family",
				"group"      => "Name Style",
			),
			array(
				"type"       => "textfield",
				"class"      => "",
				"heading"    => esc_html__( "Testimonial Title Font Size", 'doors' ),
				"param_name" => "testimonial_title_font_size",
				"min"        => 14,
				"suffix"     => "px",
				"group"      => "Name Style",
			),
			array(
				"type"       => "colorpicker",
				"class"      => "",
				"heading"    => esc_html__( "Testimonial Title Font Color", 'doors' ),
				"param_name" => "testimonial_title_color",
				"value"      => "",
				"group"      => "Name Style",
			),
			array(
				"type"       => "dropdown",
				"heading"    => esc_html__( "Testimonial Title Font Weight", 'doors' ),
				"param_name" => "testimonial_title_font_weight",
				'value'      => array(
					esc_html__( 'Default', 'doors' ) => '900',
					'100'                            => '100',
					'200'                            => '200',
					'300'                            => '300',
					'500'                            => '500',
					'600'                            => '600',
					'700'                            => '700',
					'800'                            => '800',
					'400'                            => '400',
				),
				"group"      => "Name Style",
			),
			array(
				"type"       => "dropdown",
				"heading"    => esc_html__( "Testimonial Title Text Transform", 'doors' ),
				"param_name" => "testimonial_title_text_transform",
				'value'      => array(
					esc_html__( 'Default', 'doors' ) => 'none',
					'Lowercase'                      => 'lowercase',
					'Uppercase'                      => 'uppercase',
					'Capitalize'                     => 'capitalize',
					'Inherit'                        => 'inherit',
				),
				"group"      => "Name Style",
			),
			array(
				"type"       => "textfield",
				"class"      => "",
				"heading"    => esc_html__( "Testimonial Title Line Height", 'doors' ),
				"param_name" => "testimonial_title_line_height",
				"value"      => "",
				"suffix"     => "px",
				"group"      => "Name Style",
			),
			array(
				"type"       => "textfield",
				"class"      => "",
				"heading"    => esc_html__( "Testimonial Title Letter spacing", 'doors' ),
				"param_name" => "testimonial_title_letter_spacing",
				"value"      => "",
				"suffix"     => "px",
				"group"      => "Name Style",
			),
			array(
				"type"       => "dropdown",
				"heading"    => esc_html__( "Testimonial Title Font Style", 'doors' ),
				"param_name" => "testimonial_title_font_style",
				'value'      => array(
					esc_html__( 'Normal', 'doors' )  => 'normal',
					esc_html__( 'Italic', 'doors' )  => 'italic',
					esc_html__( 'Inherit', 'doors' ) => 'inherit',
					esc_html__( 'Initial', 'doors' ) => 'initial',
				),
				"group"      => "Name Style",
			),
			// ________Job Title Typo
			array(
				"heading"    => esc_html__( "Testimonial Job Title Tag", 'doors' ),
				"type"       => "dropdown",
				"param_name" => "testimonial_job_title_tag",
				"value"      => array(
					'H2 (Default)' => 'h2',
					'H1'           => 'h1',
					'H3'           => 'h3',
					'H4'           => 'h4',
					'H5'           => 'h5',
					'H6'           => 'h6',
					'P'            => 'p',
					'Span'         => 'span',
				),
				"group"      => "Job Title Style",
			),
			array(
				"type"       => "dropdown",
				'value'      => $doors_fonts_array,
				"heading"    => esc_html__( "Testimonial Job Title Font Family", 'doors' ),
				"param_name" => "testimonial_job_title_font_family",
				"group"      => "Job Title Style",
			),
			array(
				"type"       => "textfield",
				"class"      => "",
				"heading"    => esc_html__( "Testimonial Job Title Font Size", 'doors' ),
				"param_name" => "testimonial_job_title_font_size",
				"min"        => 14,
				"suffix"     => "px",
				"group"      => "Job Title Style",
			),
			array(
				"type"       => "colorpicker",
				"class"      => "",
				"heading"    => esc_html__( "Testimonial Job Title Font Color", 'doors' ),
				"param_name" => "testimonial_job_title_color",
				"value"      => "",
				"group"      => "Job Title Style",
			),
			array(
				"type"       => "dropdown",
				"heading"    => esc_html__( "Testimonial Job Title Font Weight", 'doors' ),
				"param_name" => "testimonial_job_title_font_weight",
				'value'      => array(
					esc_html__( 'Default', 'doors' ) => '900',
					'100'                            => '100',
					'200'                            => '200',
					'300'                            => '300',
					'500'                            => '500',
					'600'                            => '600',
					'700'                            => '700',
					'800'                            => '800',
					'400'                            => '400',
				),
				"group"      => "Job Title Style",
			),
			array(
				"type"       => "dropdown",
				"heading"    => esc_html__( "Testimonial Job Title Text Transform", 'doors' ),
				"param_name" => "testimonial_job_title_text_transform",
				'value'      => array(
					esc_html__( 'Default', 'doors' ) => 'none',
					'Lowercase'                      => 'lowercase',
					'Uppercase'                      => 'uppercase',
					'Capitalize'                     => 'capitalize',
					'Inherit'                        => 'inherit',
				),
				"group"      => "Job Title Style",
			),
			array(
				"type"       => "textfield",
				"class"      => "",
				"heading"    => esc_html__( "Testimonial Job Title Line Height", 'doors' ),
				"param_name" => "testimonial_job_title_line_height",
				"value"      => "",
				"suffix"     => "px",
				"group"      => "Job Title Style",
			),
			array(
				"type"       => "textfield",
				"class"      => "",
				"heading"    => esc_html__( "Testimonial Job Title Letter spacing", 'doors' ),
				"param_name" => "testimonial_job_title_letter_spacing",
				"value"      => "",
				"suffix"     => "px",
				"group"      => "Job Title Style",
			),
			array(
				"type"       => "dropdown",
				"heading"    => esc_html__( "Testimonial Job Title Font Style", 'doors' ),
				"param_name" => "testimonial_job_title_font_style",
				'value'      => array(
					esc_html__( 'Normal', 'doors' )  => 'normal',
					esc_html__( 'Italic', 'doors' )  => 'italic',
					esc_html__( 'Inherit', 'doors' ) => 'inherit',
					esc_html__( 'Initial', 'doors' ) => 'initial',
				),
				"group"      => "Job Title Style",
			),

			// ________Paragraph Typo
			array(
				"type"       => "dropdown",
				'value'      => $doors_fonts_array,
				"heading"    => esc_html__( "Testimonial Text Font Family", 'doors' ),
				"param_name" => "testimonial_text_font_family",
				"group"      => "Testimonial Text",
			),
			array(
				"type"       => "textfield",
				"class"      => "",
				"heading"    => esc_html__( "Testimonial Text Font Size", 'doors' ),
				"param_name" => "testimonial_text_font_size",
				"min"        => 14,
				"suffix"     => "px",
				"group"      => "Testimonial Text",
			),
			array(
				"type"       => "colorpicker",
				"class"      => "",
				"heading"    => esc_html__( "Testimonial Text Font Color", 'doors' ),
				"param_name" => "testimonial_text_color",
				"value"      => "",
				"group"      => "Testimonial Text",
			),
			array(
				"type"       => "dropdown",
				"heading"    => esc_html__( "Testimonial Text Font Weight", 'doors' ),
				"param_name" => "testimonial_text_font_weight",
				'value'      => array(
					esc_html__( 'Default', 'doors' ) => '900',
					'100'                            => '100',
					'200'                            => '200',
					'300'                            => '300',
					'500'                            => '500',
					'600'                            => '600',
					'700'                            => '700',
					'800'                            => '800',
					'400'                            => '400',
				),
				"group"      => "Testimonial Text",
			),
			array(
				"type"       => "dropdown",
				"heading"    => esc_html__( "Testimonial Text Text Transform", 'doors' ),
				"param_name" => "testimonial_text_text_transform",
				'value'      => array(
					esc_html__( 'Default', 'doors' ) => 'none',
					'Lowercase'                      => 'lowercase',
					'Uppercase'                      => 'uppercase',
					'Capitalize'                     => 'capitalize',
					'Inherit'                        => 'inherit',
				),
				"group"      => "Testimonial Text",
			),
			array(
				"type"       => "textfield",
				"class"      => "",
				"heading"    => esc_html__( "Testimonial Text Line Height", 'doors' ),
				"param_name" => "testimonial_text_line_height",
				"value"      => "",
				"suffix"     => "px",
				"group"      => "Testimonial Text",
			),
			array(
				"type"       => "textfield",
				"class"      => "",
				"heading"    => esc_html__( "Testimonial Text Letter spacing", 'doors' ),
				"param_name" => "testimonial_text_letter_spacing",
				"value"      => "",
				"suffix"     => "px",
				"group"      => "Testimonial Text",
			),
			array(
				"type"       => "dropdown",
				"heading"    => esc_html__( "Testimonial Text Font Style", 'doors' ),
				"param_name" => "testimonial_text_font_style",
				'value'      => array(
					esc_html__( 'Italic', 'doors' )  => 'italic',
					esc_html__( 'Normal', 'doors' )  => 'normal',
					esc_html__( 'Inherit', 'doors' ) => 'inherit',
					esc_html__( 'Initial', 'doors' ) => 'initial',
				),
				"group"      => "Testimonial Text",
			),
			// Quots Typo
			array(
				"type"       => "textfield",
				"class"      => "",
				"heading"    => esc_html__( "Testimonial Quotes Font Size", 'doors' ),
				"param_name" => "testimonial_quotes_font_size",
				"min"        => 14,
				"suffix"     => "px",
				"group"      => "Quotes Style",
			),
			array(
				"type"       => "colorpicker",
				"class"      => "",
				"heading"    => esc_html__( "Testimonial Quotes Font Color", 'doors' ),
				"param_name" => "testimonial_quotes_color",
				"value"      => "",
				"group"      => "Quotes Style",
			),
			array(
				"type"       => "textfield",
				"class"      => "",
				"heading"    => esc_html__( "Testimonial Quotes Opacity", 'doors' ),
				"param_name" => "testimonial_quotes_opacity",
				"group"      => "Quotes Style",
			),

			$vc_add_css_animation
		)
	) );
}