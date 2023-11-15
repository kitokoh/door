<?php

global $vc_add_css_animation;
global $doors_fonts_array;
/*********---------team--------------------------*/
vc_map( array(
	"name"            => esc_html__( "Wd Team Member", 'doors' ), // add a name
	"base"            => "doors_team_members", // bind with our shortcode
	"category"        => __( "Webdevia", "doors" ),
	"icon"            => get_template_directory_uri() . "/images/icon/meknes.png",
	"content_element" => true, // set this parameter when element will has a content
	"is_container"    => false, // set this param when you need to add a content element in this element
	// Here starts the definition of array with parameters of our compnent
	"params"          => array(
		array(
			"type"       => "dropdown", // it will bind a textfield in WP
			"heading"    => esc_html__( "Layout Style", 'doors' ),
			"param_name" => "layout_style",
			"value"      => array(
				'Slider'   => 'slider',
				'Carousel' => 'carousel',
				'Grid'     => 'grid'
			)
		),
		array(
			"type"       => "textfield", // it will bind a textfield in WP
			"heading"    => esc_html__( "Columns number in Mobile", 'doors' ),
			"param_name" => "columns_number_mobile",
			"dependency" => Array( "element" => "layout_style", "value" => array( 'grid' ) )
		),
		array(
			"type"       => "textfield", // it will bind a textfield in WP
			"heading"    => esc_html__( "Columns number in Tablet", 'doors' ),
			"param_name" => "columns_number_tablet",
			"dependency" => Array( "element" => "layout_style", "value" => array( 'grid' ) )
		),
		array(
			"type"       => "textfield", // it will bind a textfield in WP
			"heading"    => esc_html__( "Columns number in Desktop", 'doors' ),
			"param_name" => "columns_number_desktop",
			"dependency" => Array( "element" => "layout_style", "value" => array( 'grid' ) )
		),
		array(
			"type"       => "textfield", // it will bind a textfield in WP
			"heading"    => esc_html__( "Elements To Show in Mobile", 'doors' ),
			"param_name" => "elements_to_show_mobile",
			"dependency" => Array( "element" => "layout_style", "value" => array( 'grid' ) )
		),
		array(
			"type"       => "textfield", // it will bind a textfield in WP
			"heading"    => esc_html__( "Elements To Show in Tablet", 'doors' ),
			"param_name" => "elements_to_show_tablet",
			"dependency" => Array( "element" => "layout_style", "value" => array( 'grid' ) )
		),
		array(
			"type"       => "textfield", // it will bind a textfield in WP
			"heading"    => esc_html__( "Elements To Show in Desktop", 'doors' ),
			"param_name" => "elements_to_show_desktop",
			"dependency" => Array( "element" => "layout_style", "value" => array( 'grid' ) )
		),
		array(
			"type"       => "dropdown", // it will bind a textfield in WP
			"heading"    => esc_html__( "Picture Position", 'doors' ),
			"param_name" => "picture_position",
			"value"      => array(
				'Left'  => 'image_left',
				'Right' => 'image_right'
			),
			"dependency" => Array( "element" => "layout_style", "value" => array( 'slider' ) )
		),
		array(
			"type"       => "dropdown", // it will bind a textfield in WP
			"heading"    => esc_html__( "Slider Layout Style", 'doors' ),
			"param_name" => "slider_layout_style",
			"value"      => array(
				'Team Member name > Job Title > Bibliography' => 'name_jobtitle_biblio',
				'Job Title > Team Member name > Bibliography' => 'jobtitle_name_biblio'
			),
			"dependency" => Array( "element" => "layout_style", "value" => array( 'slider' ) )
		),
		array(
			"type"       => "dropdown", // it will bind a textfield in WP
			"heading"    => esc_html__( "Show Website", 'doors' ),
			"param_name" => "show_website",
			"value"      => array(
				'Yes' => 'yes',
				'No'  => 'no'
			),
			"dependency" => Array( "element" => "layout_style", "value" => array( 'slider', 'carousel', 'grid' ) ),
			"group"      => "Website Style"
		),
		array(
			"type"       => "dropdown", // it will bind a textfield in WP
			"heading"    => esc_html__( "Navigation style", 'doors' ),
			"param_name" => "navigation_style",
			"value"      => array(
				'Dots'   => 'dotts',
				'Arrows' => 'arrows'
			),
			"dependency" => Array( "element" => "layout_style", "value" => array( 'slider', 'carousel' ) )
		),
		array(
			"type"       => "dropdown", // it will bind a textfield in WP
			"heading"    => esc_html__( "Show Skills", 'doors' ),
			"param_name" => "show_skills",
			"value"      => array(
				'Yes' => 'yes',
				'No'  => 'no'
			),
			"dependency" => Array( "element" => "layout_style", "value" => array( 'slider' ) ),
			"group"      => "Skills Style",
		),
		array(
			"type"       => "dropdown", // it will bind a textfield in WP
			"heading"    => esc_html__( "Show Bibliography", 'doors' ),
			"param_name" => "show_description",
			"value"      => array(
				'Yes' => 'yes',
				'No'  => 'no'
			),
			"dependency" => Array( "element" => "layout_style", "value" => array( 'grid', 'carousel', 'grid' ) ),
		),
		array(
			"type"        => "textarea_raw_html", // it will bind a textfield in WP
			"heading"     => esc_html__( "Static HTML Item", 'doors' ),
			"description" => esc_html__( "Used for add description item", 'doors' ),
			"param_name"  => "static_html_item",
			"dependency"  => Array( "element" => "layout_style", "value" => array( 'grid' ) )
		),
		array(
			"type"       => "dropdown", // it will bind a textfield in WP
			"heading"    => esc_html__( "Static Html Item Description Position", 'doors' ),
			"param_name" => "static_html_item_position",
			"value"      => array(
				'Before' => 'before',
				'After'  => 'after'
			),
			"dependency" => Array( "element" => "layout_style", "value" => array( 'grid' ) )
		),
		array(
			"type"       => "textfield",
			"class"      => "",
			"heading"    => esc_html__( "Elements To Swipe", 'doors' ),
			"param_name" => "elements_to_swipe",
			"dependency" => Array( "element" => "layout_style", "value" => array( 'carousel' ) )
		),
		// Team Member Name typography
		array(
			"heading"    => esc_html__( "Team Member Name Tag", 'doors' ),
			"type"       => "dropdown",
			"param_name" => "team_member_name_tag",
			"value"      => array(
				'H2 (Default)' => 'h2',
				'H1'           => 'h1',
				'H3'           => 'h3',
				'H4'           => 'h4',
				'H5'           => 'h5',
				'H6'           => 'h6'
			),
			"group"      => "Typography",
			"dependency" => Array( "element" => "layout_style", "value" => array( 'slider', 'carousel', 'grid' ) ),
			"group"      => "Name Style",
		),
		array(
			"type"       => "dropdown",
			'value'      => $doors_fonts_array,
			"heading"    => esc_html__( "Team Member Name Font Family", 'doors' ),
			"param_name" => "team_member_name_font_family",
			"dependency" => Array( "element" => "layout_style", "value" => array( 'slider', 'carousel', 'grid' ) ),
			"group"      => "Name Style",
		),
		array(
			"type"       => "textfield",
			"class"      => "",
			"heading"    => esc_html__( "Team Member Name Font Size", 'doors' ),
			"param_name" => "team_member_name_font_size",
			"min"        => 14,
			"suffix"     => "px",
			"group"      => "Name Style",
			"dependency" => Array( "element" => "layout_style", "value" => array( 'slider', 'carousel', 'grid' ) )
		),
		array(
			"type"       => "colorpicker",
			"class"      => "",
			"heading"    => esc_html__( "Team Member Name Font Color", 'doors' ),
			"param_name" => "team_member_name_color",
			"value"      => "",
			"group"      => "Name Style",
			"dependency" => Array( "element" => "layout_style", "value" => array( 'slider', 'carousel', 'grid' ) )
		),
		array(
			"type"       => "dropdown",
			"heading"    => esc_html__( "Team Member Name Font Weight", 'doors' ),
			"param_name" => "team_member_name_font_weight",
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
			"dependency" => Array( "element" => "layout_style", "value" => array( 'slider', 'carousel', 'grid' ) )
		),
		array(
			"type"       => "dropdown",
			"heading"    => esc_html__( "Team Member Name Text Transform", 'doors' ),
			"param_name" => "team_member_name_text_transform",
			'value'      => array(
				esc_html__( 'Default', 'doors' ) => 'none',
				'Lowercase'                      => 'lowercase',
				'Uppercase'                      => 'uppercase',
				'Capitalize'                     => 'capitalize',
				'Inherit'                        => 'inherit',
			),
			"group"      => "Name Style",
			"dependency" => Array( "element" => "layout_style", "value" => array( 'slider', 'carousel', 'grid' ) )
		),
		array(
			"type"       => "textfield",
			"class"      => "",
			"heading"    => esc_html__( "Team Member Name Line Height", 'doors' ),
			"param_name" => "team_member_name_line_height",
			"value"      => "",
			"suffix"     => "px",
			"group"      => "Name Style",
			"dependency" => Array( "element" => "layout_style", "value" => array( 'slider', 'carousel', 'grid' ) )
		),
		array(
			"type"       => "textfield",
			"class"      => "",
			"heading"    => esc_html__( "Team Member Name Letter spacing", 'doors' ),
			"param_name" => "team_member_name_letter_spacing",
			"value"      => "",
			"suffix"     => "px",
			"group"      => "Name Style",
			"dependency" => Array( "element" => "layout_style", "value" => array( 'slider', 'carousel', 'grid' ) )
		),
		array(
			"type"       => "dropdown",
			"heading"    => esc_html__( "Team Member Name Font Style", 'doors' ),
			"param_name" => "team_member_name_font_style",
			'value'      => array(
				esc_html__( 'Normal', 'doors' )  => 'normal',
				esc_html__( 'Italic', 'doors' )  => 'italic',
				esc_html__( 'Inherit', 'doors' ) => 'inherit',
				esc_html__( 'Initial', 'doors' ) => 'initial',
			),
			"group"      => "Name Style",
			"dependency" => Array( "element" => "layout_style", "value" => array( 'slider', 'carousel', 'grid' ) )
		),

		// Job Title Tepography
		array(
			"heading"    => esc_html__( "Job Title Tag", 'doors' ),
			"type"       => "dropdown",
			"param_name" => "job_title_tag",
			"value"      => array(
				'H4 (Default)' => 'h4',
				'H1'           => 'h1',
				'H2'           => 'h2',
				'H3'           => 'h3',
				'H5'           => 'h5',
				'H6'           => 'h6'
			),
			"dependency" => Array( "element" => "layout_style", "value" => array( 'slider', 'carousel', 'grid' ) ),
			"group"      => "Job Title Style",
		),
		array(
			"type"       => "dropdown",
			'value'      => $doors_fonts_array,
			"heading"    => esc_html__( "Job Title Font Family", 'doors' ),
			"param_name" => "job_title_font_family",
			"group"      => "Job Title Style",
			"dependency" => Array( "element" => "layout_style", "value" => array( 'slider', 'carousel', 'grid' ) )
		),
		array(
			"type"       => "textfield",
			"class"      => "",
			"heading"    => esc_html__( "Job Title Font Size", 'doors' ),
			"param_name" => "job_title_font_size",
			"min"        => 14,
			"suffix"     => "px",
			"group"      => "Job Title Style",
			"dependency" => Array( "element" => "layout_style", "value" => array( 'slider', 'carousel', 'grid' ) )
		),
		array(
			"type"       => "colorpicker",
			"class"      => "",
			"heading"    => esc_html__( "Job Title Font Color", 'doors' ),
			"param_name" => "job_title_color",
			"value"      => "",
			"group"      => "Job Title Style",
			"dependency" => Array( "element" => "layout_style", "value" => array( 'slider', 'carousel', 'grid' ) )
		),
		array(
			"type"       => "dropdown",
			"heading"    => esc_html__( "Job Title Font Weight", 'doors' ),
			"param_name" => "job_title_font_weight",
			'value'      => array(
				esc_html__( 'Default', 'doors' ) => '400',
				'100'                            => '100',
				'200'                            => '200',
				'300'                            => '300',
				'500'                            => '500',
				'600'                            => '600',
				'700'                            => '700',
				'800'                            => '800',
				'900'                            => '900',
			),
			"group"      => "Job Title Style",
			"dependency" => Array( "element" => "layout_style", "value" => array( 'slider', 'carousel', 'grid' ) )
		),
		array(
			"type"       => "dropdown",
			"heading"    => esc_html__( "Job Title Text Transform", 'doors' ),
			"param_name" => "job_title_text_transform",
			'value'      => array(
				esc_html__( 'Default', 'doors' ) => 'none',
				'Lowercase'                      => 'lowercase',
				'Uppercase'                      => 'uppercase',
				'Capitalize'                     => 'capitalize',
				'Inherit'                        => 'inherit',
			),
			"group"      => "Job Title Style",
			"dependency" => Array( "element" => "layout_style", "value" => array( 'slider', 'carousel', 'grid' ) )
		),
		array(
			"type"       => "textfield",
			"class"      => "",
			"heading"    => esc_html__( "Job Title Line Height", 'doors' ),
			"param_name" => "job_title_line_height",
			"value"      => "",
			"suffix"     => "px",
			"group"      => "Job Title Style",
			"dependency" => Array( "element" => "layout_style", "value" => array( 'slider', 'carousel', 'grid' ) )
		),
		array(
			"type"       => "textfield",
			"class"      => "",
			"heading"    => esc_html__( "Job Title Letter spacing", 'doors' ),
			"param_name" => "job_title_letter_spacing",
			"value"      => "",
			"suffix"     => "px",
			"group"      => "Job Title Style",
			"dependency" => Array( "element" => "layout_style", "value" => array( 'slider', 'carousel', 'grid' ) )
		),
		array(
			"type"       => "dropdown",
			"heading"    => esc_html__( "Job Title Font Style", 'doors' ),
			"param_name" => "job_title_font_style",
			'value'      => array(
				esc_html__( 'Normal', 'doors' )  => 'normal',
				esc_html__( 'Italic', 'doors' )  => 'italic',
				esc_html__( 'Inherit', 'doors' ) => 'inherit',
				esc_html__( 'Initial', 'doors' ) => 'initial',
			),
			"group"      => "Job Title Style",
			"dependency" => Array( "element" => "layout_style", "value" => array( 'slider', 'carousel', 'grid' ) )
		),

		// About Team member Typography
		array(
			"type"       => "dropdown",
			'value'      => $doors_fonts_array,
			"heading"    => esc_html__( "About Font Family", 'doors' ),
			"param_name" => "about_font_family",
			"group"      => "Bibliography Style",
			"dependency" => Array( "element" => "layout_style", "value" => array( 'slider', 'carousel', 'grid' ) )
		),
		array(
			"type"       => "textfield",
			"class"      => "",
			"heading"    => esc_html__( "About Font Size", 'doors' ),
			"param_name" => "about_font_size",
			"min"        => 14,
			"suffix"     => "px",
			"group"      => "Bibliography Style",
			"dependency" => Array( "element" => "layout_style", "value" => array( 'slider', 'carousel', 'grid' ) )
		),
		array(
			"type"       => "colorpicker",
			"class"      => "",
			"heading"    => esc_html__( "About Font Color", 'doors' ),
			"param_name" => "about_color",
			"value"      => "",
			"group"      => "Bibliography Style",
			"dependency" => Array( "element" => "layout_style", "value" => array( 'slider', 'carousel', 'grid' ) )
		),
		array(
			"type"       => "dropdown",
			"heading"    => esc_html__( "About Font Weight", 'doors' ),
			"param_name" => "about_font_weight",
			'value'      => array(
				esc_html__( 'Default', 'doors' ) => '400',
				'100'                            => '100',
				'200'                            => '200',
				'300'                            => '300',
				'500'                            => '500',
				'600'                            => '600',
				'700'                            => '700',
				'800'                            => '800',
				'900'                            => '900',
			),
			"group"      => "Bibliography Style",
			"dependency" => Array( "element" => "layout_style", "value" => array( 'slider', 'carousel', 'grid' ) )
		),
		array(
			"type"       => "dropdown",
			"heading"    => esc_html__( "About Text Transform", 'doors' ),
			"param_name" => "about_text_transform",
			'value'      => array(
				esc_html__( 'Default', 'doors' ) => 'none',
				'Lowercase'                      => 'lowercase',
				'Uppercase'                      => 'uppercase',
				'Capitalize'                     => 'capitalize',
				'Inherit'                        => 'inherit',
			),
			"group"      => "Bibliography Style",
			"dependency" => Array( "element" => "layout_style", "value" => array( 'slider', 'carousel', 'grid' ) )
		),
		array(
			"type"       => "textfield",
			"class"      => "",
			"heading"    => esc_html__( "About Line Height", 'doors' ),
			"param_name" => "about_line_height",
			"value"      => "",
			"suffix"     => "px",
			"group"      => "Bibliography Style",
			"dependency" => Array( "element" => "layout_style", "value" => array( 'slider', 'carousel', 'grid' ) )
		),
		array(
			"type"       => "textfield",
			"class"      => "",
			"heading"    => esc_html__( "About Letter spacing", 'doors' ),
			"param_name" => "about_letter_spacing",
			"value"      => "",
			"suffix"     => "px",
			"group"      => "Bibliography Style",
			"dependency" => Array( "element" => "layout_style", "value" => array( 'slider', 'carousel', 'grid' ) )
		),
		array(
			"type"       => "dropdown",
			"heading"    => esc_html__( "About Font Style", 'doors' ),
			"param_name" => "about_font_style",
			'value'      => array(
				esc_html__( 'Normal', 'doors' )  => 'normal',
				esc_html__( 'Italic', 'doors' )  => 'italic',
				esc_html__( 'Inherit', 'doors' ) => 'inherit',
				esc_html__( 'Initial', 'doors' ) => 'initial',
			),
			"group"      => "Bibliography Style",
			"dependency" => Array( "element" => "layout_style", "value" => array( 'slider', 'carousel', 'grid' ) )
		),
		// Skills Typography
		array(
			"type"       => "dropdown",
			'value'      => $doors_fonts_array,
			"heading"    => esc_html__( "Skill Name Font Family", 'doors' ),
			"param_name" => "skill_name_font_family",
			"group"      => "Skills Style",
			"dependency" => Array( "element" => "layout_style", "value" => array( 'slider' ) )
		),
		array(
			"type"       => "dropdown",
			'value'      => $doors_fonts_array,
			"heading"    => esc_html__( "Skill Value Font Family", 'doors' ),
			"param_name" => "skill_value_font_family",
			"group"      => "Skills Style",
			"dependency" => Array( "element" => "layout_style", "value" => array( 'slider' ) )
		),
		array(
			"type"       => "textfield",
			"class"      => "",
			"heading"    => esc_html__( "Skill Name Font Size", 'doors' ),
			"param_name" => "skill_name_font_size",
			"min"        => 14,
			"suffix"     => "px",
			"group"      => "Skills Style",
			"dependency" => Array( "element" => "layout_style", "value" => array( 'slider' ) )
		),
		array(
			"type"       => "textfield",
			"class"      => "",
			"heading"    => esc_html__( "Skill Value Font Size", 'doors' ),
			"param_name" => "skill_value_font_size",
			"min"        => 14,
			"suffix"     => "px",
			"group"      => "Skills Style",
			"dependency" => Array( "element" => "layout_style", "value" => array( 'slider' ) )
		),
		array(
			"type"       => "colorpicker",
			"class"      => "",
			"heading"    => esc_html__( "Skill Name Font Color", 'doors' ),
			"param_name" => "skill_name_color",
			"value"      => "",
			"group"      => "Skills Style",
			"dependency" => Array( "element" => "layout_style", "value" => array( 'slider' ) )
		),
		array(
			"type"       => "colorpicker",
			"class"      => "",
			"heading"    => esc_html__( "Skill Value Font Color", 'doors' ),
			"param_name" => "skill_value_name_color",
			"value"      => "",
			"group"      => "Skills Style",
			"dependency" => Array( "element" => "layout_style", "value" => array( 'slider' ) )
		),
		array(
			"type"       => "dropdown",
			"heading"    => esc_html__( "Skill Name Font Weight", 'doors' ),
			"param_name" => "skill_name_font_weight",
			'value'      => array(
				esc_html__( 'Default', 'doors' ) => '900',
				'100'                            => '100',
				'200'                            => '200',
				'300'                            => '300',
				'500'                            => '500',
				'600'                            => '600',
				'700'                            => '700',
				'800'                            => '800',
				'900'                            => '400',
			),
			"group"      => "Skills Style",
			"dependency" => Array( "element" => "layout_style", "value" => array( 'slider' ) )
		),
		array(
			"type"       => "dropdown",
			"heading"    => esc_html__( "Skill Value Font Weight", 'doors' ),
			"param_name" => "skill_value_font_weight",
			'value'      => array(
				esc_html__( 'Default', 'doors' ) => '400',
				'100'                            => '100',
				'200'                            => '200',
				'300'                            => '300',
				'500'                            => '500',
				'600'                            => '600',
				'700'                            => '700',
				'800'                            => '800',
				'900'                            => '900',
			),
			"group"      => "Skills Style",
			"dependency" => Array( "element" => "layout_style", "value" => array( 'slider' ) )
		),
		array(
			"type"       => "dropdown",
			"heading"    => esc_html__( "Skill Name Text Transform", 'doors' ),
			"param_name" => "skill_name_text_transform",
			'value'      => array(
				esc_html__( 'Default', 'doors' ) => 'none',
				'Lowercase'                      => 'lowercase',
				'Uppercase'                      => 'uppercase',
				'Capitalize'                     => 'capitalize',
				'Inherit'                        => 'inherit',
			),
			"group"      => "Skills Style",
			"dependency" => Array( "element" => "layout_style", "value" => array( 'slider' ) )
		),
		array(
			"type"       => "dropdown",
			"heading"    => esc_html__( "Skill Value Text Transform", 'doors' ),
			"param_name" => "skill_value_text_transform",
			'value'      => array(
				esc_html__( 'Default', 'doors' ) => 'none',
				'Lowercase'                      => 'lowercase',
				'Uppercase'                      => 'uppercase',
				'Capitalize'                     => 'capitalize',
				'Inherit'                        => 'inherit',
			),
			"group"      => "Skills Style",
			"dependency" => Array( "element" => "layout_style", "value" => array( 'slider' ) )
		),
		array(
			"type"       => "textfield",
			"class"      => "",
			"heading"    => esc_html__( "Skill Name Letter spacing", 'doors' ),
			"param_name" => "skill_name_letter_spacing",
			"value"      => "",
			"suffix"     => "px",
			"group"      => "Skills Style",
			"dependency" => Array( "element" => "layout_style", "value" => array( 'slider' ) )
		),
		array(
			"type"       => "textfield",
			"class"      => "",
			"heading"    => esc_html__( "Skill Value Letter spacing", 'doors' ),
			"param_name" => "skill_value_letter_spacing",
			"value"      => "",
			"suffix"     => "px",
			"group"      => "Skills Style",
			"dependency" => Array( "element" => "layout_style", "value" => array( 'slider' ) )
		),
		array(
			"type"       => "dropdown",
			"heading"    => esc_html__( "Skill Name Font Style", 'doors' ),
			"param_name" => "skill_name_font_style",
			'value'      => array(
				esc_html__( 'Normal', 'doors' )  => 'normal',
				esc_html__( 'Italic', 'doors' )  => 'italic',
				esc_html__( 'Inherit', 'doors' ) => 'inherit',
				esc_html__( 'Initial', 'doors' ) => 'initial',
			),
			"group"      => "Skills Style",
			"dependency" => Array( "element" => "layout_style", "value" => array( 'slider' ) )
		),
		array(
			"type"       => "dropdown",
			"heading"    => esc_html__( "Skill Value Font Style", 'doors' ),
			"param_name" => "skill_value_font_style",
			'value'      => array(
				esc_html__( 'Normal', 'doors' )  => 'normal',
				esc_html__( 'Italic', 'doors' )  => 'italic',
				esc_html__( 'Inherit', 'doors' ) => 'inherit',
				esc_html__( 'Initial', 'doors' ) => 'initial',
			),
			"group"      => "Skills Style",
			"dependency" => Array( "element" => "layout_style", "value" => array( 'slider' ) )
		),
		// Team member Website Typography
		array(
			"type"       => "dropdown",
			'value'      => $doors_fonts_array,
			"heading"    => esc_html__( "Website Font Family", 'doors' ),
			"param_name" => "website_font_family",
			"group"      => "Website Style",
			"dependency" => Array( "element" => "layout_style", "value" => array( 'slider', 'carousel', 'grid' ) )
		),
		array(
			"type"       => "textfield",
			"class"      => "",
			"heading"    => esc_html__( "Website Font Size", 'doors' ),
			"param_name" => "website_font_size",
			"min"        => 14,
			"suffix"     => "px",
			"group"      => "Website Style",
			"dependency" => Array( "element" => "layout_style", "value" => array( 'slider', 'carousel', 'grid' ) )
		),
		array(
			"type"       => "colorpicker",
			"class"      => "",
			"heading"    => esc_html__( "Website Font Color", 'doors' ),
			"param_name" => "website_color",
			"value"      => "",
			"group"      => "Website Style",
			"dependency" => Array( "element" => "layout_style", "value" => array( 'slider', 'carousel', 'grid' ) )
		),
		array(
			"type"       => "dropdown",
			"heading"    => esc_html__( "Website Font Weight", 'doors' ),
			"param_name" => "website_font_weight",
			'value'      => array(
				esc_html__( 'Default', 'doors' ) => '400',
				'100'                            => '100',
				'200'                            => '200',
				'300'                            => '300',
				'500'                            => '500',
				'600'                            => '600',
				'700'                            => '700',
				'800'                            => '800',
				'900'                            => '900',
			),
			"group"      => "Website Style",
			"dependency" => Array( "element" => "layout_style", "value" => array( 'slider', 'carousel', 'grid' ) )
		),
		array(
			"type"       => "dropdown",
			"heading"    => esc_html__( "Website Text Transform", 'doors' ),
			"param_name" => "website_text_transform",
			'value'      => array(
				esc_html__( 'Default', 'doors' ) => 'none',
				'Lowercase'                      => 'lowercase',
				'Uppercase'                      => 'uppercase',
				'Capitalize'                     => 'capitalize',
				'Inherit'                        => 'inherit',
			),
			"group"      => "Website Style",
			"dependency" => Array( "element" => "layout_style", "value" => array( 'slider', 'carousel', 'grid' ) )
		),
		array(
			"type"       => "textfield",
			"class"      => "",
			"heading"    => esc_html__( "Website Letter spacing", 'doors' ),
			"param_name" => "website_letter_spacing",
			"value"      => "",
			"suffix"     => "px",
			"group"      => "Website Style",
			"dependency" => Array( "element" => "layout_style", "value" => array( 'slider', 'carousel', 'grid' ) )
		),
		array(
			"type"       => "dropdown",
			"heading"    => esc_html__( "Website Font Style", 'doors' ),
			"param_name" => "website_font_style",
			'value'      => array(
				esc_html__( 'Normal', 'doors' )  => 'normal',
				esc_html__( 'Italic', 'doors' )  => 'italic',
				esc_html__( 'Inherit', 'doors' ) => 'inherit',
				esc_html__( 'Initial', 'doors' ) => 'initial',
			),
			"group"      => "Website Style",
			"dependency" => Array( "element" => "layout_style", "value" => array( 'slider', 'carousel', 'grid' ) )
		),
		// Social Medias Typo
		array(
			"type"       => "dropdown",
			"heading"    => esc_html__( "Show Social Medias", 'doors' ),
			"param_name" => "show_social_media",
			'value'      => array(
				esc_html__( 'Yes', 'doors' ) => 'yes',
				esc_html__( 'No', 'doors' )  => 'no'
			),
			"dependency" => Array( "element" => "layout_style", "value" => array( 'grid', 'carousel', 'grid' ) )
		),
		array(
			"type"       => "textfield",
			"class"      => "",
			"heading"    => esc_html__( "social Icons Size", 'doors' ),
			"param_name" => "social_icons_size",
			"min"        => 14,
			"suffix"     => "px",
			"group"      => "Social Medias",
			"dependency" => Array( "element" => "layout_style", "value" => array( 'grid', 'carousel', 'grid' ) )
		),
		array(
			"type"       => "colorpicker",
			"class"      => "",
			"heading"    => esc_html__( "Social Icons Color", 'doors' ),
			"param_name" => "social_icons_color",
			"value"      => "",
			"group"      => "Social Medias",
			"dependency" => Array( "element" => "layout_style", "value" => array( 'grid', 'carousel', 'grid' ) )
		),


		$vc_add_css_animation
	)
) );