<?php
global $vc_add_css_animation;
global $doors_fonts_array;
$doors_posts       = get_posts( array( 'post_type' => 'post', 'posts_per_page' => '99999', ) );
$doors_posts_array = array();
foreach ( $doors_posts as $key => $post ) {
	$doors_posts_array[ $post->post_title ] = $post->ID;
}
$doors_terms     = get_terms( array( 'category' ), array( 'hide_empty' => false ) );
$doors_cat_array = array( 'all' );
foreach ( $doors_terms as $key => $term ) {
	$doors_cat_array[] = $term->name;
}

vc_map( array(
	"name"            => esc_html__( "Recent From Blog", 'doors' ),
	"base"            => "doors_blog",
	"category"        => __( "Webdevia", "doors" ),
	"icon"            => get_template_directory_uri() . "/images/icon/meknes.png",
	"content_element" => true,
	"is_container"    => false,
	"params"          => array(

		array(
			"type"       => "dropdown",
			"heading"    => esc_html__( "Blog type", 'doors' ),
			"param_name" => "doors_blog_type",
			"value"      => array(
				'Latest Posts' => 'doors_multi_post',
				'One Post'     => 'doors_one_post',
				'Free Style'   => 'doors_free_style'

			),
		),
		array(
			"type"        => "textfield",
			"heading"     => esc_html__( "Image Size", 'doors' ),
			"param_name"  => "doors_blog_image_size",
			"value"       => '',
			"description" => 'Enter image size  Alternatively enter size in pixels (Example: 200x100 (Width x Height) or 200 (Width)).'
		),
		array(
			"type"       => "dropdown",
			"heading"    => esc_html__( "Chose One Post", 'doors' ),
			"param_name" => "doors_blog_affichage_one_post",
			"value"      => array(
				'Show Latest Post' => 'doors_blog_latest_post',
				'chose frome List' => 'doors_blog_Post_from_list'
			),
			"dependency" => Array( "element" => "doors_blog_type", "value" => array( 'doors_one_post' ) ),
		),
		array(
			"type"       => "dropdown",
			"heading"    => esc_html__( "Blog Post List", 'doors' ),
			"param_name" => "doors_blog_post_list",
			"value"      => $doors_posts_array,
			"dependency" => Array( "element" => "doors_blog_type", "value" => array( 'doors_one_post' ) ),
			"dependency" => Array(
				"element" => "doors_blog_affichage_one_post",
				"value"   => array( 'doors_blog_Post_from_list' )
			),
		),
		array(
			"type"       => "dropdown",
			"heading"    => esc_html__( "Show / Hide Filter Categories", 'doors' ),
			"param_name" => "doors_blog_display_filter",
			"std"        => "yes",
			'value'      => array(
				'Show Filter' => 'doors_blog_show_filter',
				'Hide Filter' => 'doors_blog_hide_filter'
			),
			"dependency" => Array( "element" => "doors_blog_type", "value" => array( 'doors_multi_post' ) ),

		),
		array(
			"type"       => "dropdown",
			"heading"    => esc_html__( "Blog Category", 'doors' ),
			"param_name" => "doors_blog_category",
			"value"      => $doors_cat_array,
			"dependency" => Array( "element" => "doors_blog_type", "value" => array( 'doors_multi_post' ) ),
			"dependency" => Array( "element" => "doors_blog_display_filter", "value" => array( 'doors_blog_hide_filter' ) ),
		),
		array(
			"type"       => "textfield",
			"heading"    => esc_html__( "Item perpage", 'doors' ),
			"param_name" => "doors_blog_item_perpage",
			"value"      => '',
			"dependency" => Array( "element" => "doors_blog_type", "value" => array( 'doors_multi_post' ) ),
		),
		array(
			"type"       => "dropdown",
			"heading"    => esc_html__( "Columns", 'doors' ),
			"param_name" => "doors_blog_columns",
			"value"      => array( '1', '2', '3', '4', '5', '6', '7' ),
			"dependency" => Array( "element" => "doors_blog_type", "value" => array( 'doors_multi_post' ) ),
		),
		array(
			"type"       => "dropdown",
			"heading"    => esc_html__( "Blog Style", 'doors' ),
			"param_name" => "doors_blog_style",
			"value"      => array(
				'Grid'     => 'doors_grid_blog',
				'Massonry' => 'doors_masonry_blog'

			),
			"dependency" => Array( "element" => "doors_blog_type", "value" => array( 'doors_multi_post' ) ),
		),
		array(
			"type"       => "dropdown",
			"heading"    => esc_html__( "Display Style", 'doors' ),
			"param_name" => "doors_blog_affichage_type",
			"value"      => array(
				'Image Post in Left' => 'doors_blog_image_left',
				'Image Post in Top'  => 'doors_blog_image_top'

			),
			"dependency" => Array( "element" => "doors_blog_type", "value" => array( 'doors_multi_post' ) ),
			"dependency" => Array( "element" => "doors_blog_style", "value" => array( 'doors_grid_blog' ) ),
		),
		array(
			"type"       => "checkbox",
			"heading"    => esc_html__( "Display Content", 'doors' ),
			"param_name" => "doors_blog_display_content",
			"std"        => "yes",
			'value'      => array( esc_html__( 'Yes, Please', 'doors' ) => 'yes' ),
			"dependency" => Array(
				"element" => "doors_blog_affichage_type",
				"value"   => array( 'doors_blog_image_left', 'doors_multi_post' )
			),
		),
		array(
			"type"       => "checkbox",
			"heading"    => esc_html__( "Display Pagination", 'doors' ),
			"param_name" => "show_pagination",
			"dependency" => Array( "element" => "doors_blog_type", "value" => array( 'doors_multi_post' ) ),
		),


		// ________Blog Title Typo
		array(
			"heading"    => esc_html__( "Blog Title Tag", 'doors' ),
			"type"       => "dropdown",
			"param_name" => "doors_blog_title_tag",
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
			"group"      => "Title Style",
		),
		array(
			"type"       => "dropdown",
			'value'      => $doors_fonts_array,
			"heading"    => esc_html__( "Font Family", 'doors' ),
			"param_name" => "doors_blog_title_font_family",
			"group"      => "Title Style",
		),
		array(
			"type"       => "textfield",
			"class"      => "",
			"heading"    => esc_html__( "Font Size", 'doors' ),
			"param_name" => "doors_blog_title_font_size",
			"min"        => 14,
			"suffix"     => "px",
			"group"      => "Title Style",
		),
		array(
			"type"       => "colorpicker",
			"class"      => "",
			"heading"    => esc_html__( "Font Color", 'doors' ),
			"param_name" => "doors_blog_title_color",
			"value"      => "",
			"group"      => "Title Style",
		),
		array(
			"type"       => "dropdown",
			"heading"    => esc_html__( "Font Weight", 'doors' ),
			"param_name" => "doors_blog_title_font_weight",
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
			"group"      => "Title Style",
		),
		array(
			"type"       => "dropdown",
			"heading"    => esc_html__( "Text Transform", 'doors' ),
			"param_name" => "doors_blog_title_text_transform",
			'value'      => array(
				esc_html__( 'Default', 'doors' ) => 'none',
				'Lowercase'                      => 'lowercase',
				'Uppercase'                      => 'uppercase',
				'Capitalize'                     => 'capitalize',
				'Inherit'                        => 'inherit',
			),
			"group"      => "Title Style",
		),
		array(
			"type"       => "textfield",
			"class"      => "",
			"heading"    => esc_html__( "Line Height", 'doors' ),
			"param_name" => "doors_blog_title_line_height",
			"value"      => "",
			"suffix"     => "px",
			"group"      => "Title Style",
		),
		array(
			"type"       => "textfield",
			"class"      => "",
			"heading"    => esc_html__( "Letter spacing", 'doors' ),
			"param_name" => "doors_blog_title_letter_spacing",
			"value"      => "",
			"suffix"     => "px",
			"group"      => "Title Style",
		),
		array(
			"type"       => "dropdown",
			"heading"    => esc_html__( "Font Style", 'doors' ),
			"param_name" => "doors_blog_title_font_style",
			'value'      => array(
				esc_html__( 'Normal', 'doors' )  => 'normal',
				esc_html__( 'Italic', 'doors' )  => 'italic',
				esc_html__( 'Inherit', 'doors' ) => 'inherit',
				esc_html__( 'Initial', 'doors' ) => 'initial',
			),
			"group"      => "Title Style",
		),

		// ________Blog Text Typo
		array(
			"type"       => "dropdown",
			'value'      => $doors_fonts_array,
			"heading"    => esc_html__( "Font Family", 'doors' ),
			"param_name" => "doors_blog_text_font_family",
			"group"      => "Text Style",
		),
		array(
			"type"       => "textfield",
			"class"      => "",
			"heading"    => esc_html__( "Font Size", 'doors' ),
			"param_name" => "doors_blog_text_font_size",
			"min"        => 14,
			"suffix"     => "px",
			"group"      => "Text Style",
		),
		array(
			"type"       => "colorpicker",
			"class"      => "",
			"heading"    => esc_html__( "Font Color", 'doors' ),
			"param_name" => "doors_blog_text_color",
			"value"      => "",
			"group"      => "Text Style",
		),
		array(
			"type"       => "dropdown",
			"heading"    => esc_html__( "Font Weight", 'doors' ),
			"param_name" => "doors_blog_text_font_weight",
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
			"group"      => "Text Style",
		),
		array(
			"type"       => "dropdown",
			"heading"    => esc_html__( "Text Transform", 'doors' ),
			"param_name" => "doors_blog_text_text_transform",
			'value'      => array(
				esc_html__( 'Default', 'doors' ) => 'none',
				'Lowercase'                      => 'lowercase',
				'Uppercase'                      => 'uppercase',
				'Capitalize'                     => 'capitalize',
				'Inherit'                        => 'inherit',
			),
			"group"      => "Text Style",
		),
		array(
			"type"       => "textfield",
			"class"      => "",
			"heading"    => esc_html__( "Line Height", 'doors' ),
			"param_name" => "doors_blog_text_line_height",
			"value"      => "",
			"suffix"     => "px",
			"group"      => "Text Style",
		),
		array(
			"type"       => "textfield",
			"class"      => "",
			"heading"    => esc_html__( "Letter spacing", 'doors' ),
			"param_name" => "doors_blog_text_letter_spacing",
			"value"      => "",
			"suffix"     => "px",
			"group"      => "Text Style",
		),
		array(
			"type"       => "dropdown",
			"heading"    => esc_html__( "Font Style", 'doors' ),
			"param_name" => "doors_blog_text_font_style",
			'value'      => array(
				esc_html__( 'Normal', 'doors' )  => 'normal',
				esc_html__( 'Italic', 'doors' )  => 'italic',
				esc_html__( 'Inherit', 'doors' ) => 'inherit',
				esc_html__( 'Initial', 'doors' ) => 'initial',
			),
			"group"      => "Text Style",
		),


		// ________Blog Author Typo
		array(
			"type"       => "dropdown",
			'value'      => $doors_fonts_array,
			"heading"    => esc_html__( "Font Family", 'doors' ),
			"param_name" => "doors_blog_author_font_family",
			"group"      => "Text Author",
		),
		array(
			"type"       => "textfield",
			"class"      => "",
			"heading"    => esc_html__( "Font Size", 'doors' ),
			"param_name" => "doors_blog_author_font_size",
			"min"        => 14,
			"suffix"     => "px",
			"group"      => "Text Author",
		),
		array(
			"type"       => "colorpicker",
			"class"      => "",
			"heading"    => esc_html__( "Font Color", 'doors' ),
			"param_name" => "doors_blog_author_color",
			"value"      => "",
			"group"      => "Text Author",
		),
		array(
			"type"       => "dropdown",
			"heading"    => esc_html__( "Font Weight", 'doors' ),
			"param_name" => "doors_blog_author_font_weight",
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
			"group"      => "Text Author",
		),
		array(
			"type"       => "dropdown",
			"heading"    => esc_html__( "Text Transform", 'doors' ),
			"param_name" => "doors_blog_author_text_transform",
			'value'      => array(
				esc_html__( 'Default', 'doors' ) => 'none',
				'Lowercase'                      => 'lowercase',
				'Uppercase'                      => 'uppercase',
				'Capitalize'                     => 'capitalize',
				'Inherit'                        => 'inherit',
			),
			"group"      => "Text Author",
		),
		array(
			"type"       => "textfield",
			"class"      => "",
			"heading"    => esc_html__( "Line Height", 'doors' ),
			"param_name" => "doors_blog_author_line_height",
			"value"      => "",
			"suffix"     => "px",
			"group"      => "Text Author",
		),
		array(
			"type"       => "textfield",
			"class"      => "",
			"heading"    => esc_html__( "Letter spacing", 'doors' ),
			"param_name" => "doors_blog_author_letter_spacing",
			"value"      => "",
			"suffix"     => "px",
			"group"      => "Text Author",
		),
		array(
			"type"       => "dropdown",
			"heading"    => esc_html__( "Font Style", 'doors' ),
			"param_name" => "doors_blog_author_font_style",
			'value'      => array(
				esc_html__( 'Normal', 'doors' )  => 'normal',
				esc_html__( 'Italic', 'doors' )  => 'italic',
				esc_html__( 'Inherit', 'doors' ) => 'inherit',
				esc_html__( 'Initial', 'doors' ) => 'initial',
			),
			"group"      => "Text Author",
		),

		// ________Blog Author Typo
		array(
			"type"       => "dropdown",
			'value'      => $doors_fonts_array,
			"heading"    => esc_html__( "Blog Tags And Post Date Font Family", 'doors' ),
			"param_name" => "doors_blog_tags_date_font_family",
			"group"      => "Text Author",
		),
		array(
			"type"       => "textfield",
			"class"      => "",
			"heading"    => esc_html__( "Blog Tags And Post Date Font Size", 'doors' ),
			"param_name" => "doors_blog_tags_date_font_size",
			"min"        => 14,
			"suffix"     => "px",
			"group"      => "Text Author",
		),
		array(
			"type"       => "colorpicker",
			"class"      => "",
			"heading"    => esc_html__( "Blog Tags And Post Date Font Color", 'doors' ),
			"param_name" => "doors_blog_tags_date_color",
			"value"      => "",
			"group"      => "Text Author",
		),
		array(
			"type"       => "dropdown",
			"heading"    => esc_html__( "Blog Tags And Post Date Font Weight", 'doors' ),
			"param_name" => "doors_blog_tags_date_font_weight",
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
			"group"      => "Text Author",
		),
		array(
			"type"       => "dropdown",
			"heading"    => esc_html__( "Blog Tags And Post Date Text Transform", 'doors' ),
			"param_name" => "doors_blog_tags_date_text_transform",
			'value'      => array(
				esc_html__( 'Default', 'doors' ) => 'none',
				'Lowercase'                      => 'lowercase',
				'Uppercase'                      => 'uppercase',
				'Capitalize'                     => 'capitalize',
				'Inherit'                        => 'inherit',
			),
			"group"      => "Text Author",
		),
		array(
			"type"       => "textfield",
			"class"      => "",
			"heading"    => esc_html__( "Blog Tags And Post Date Line Height", 'doors' ),
			"param_name" => "doors_blog_tags_date_line_height",
			"value"      => "",
			"suffix"     => "px",
			"group"      => "Text Author",
		),
		array(
			"type"       => "textfield",
			"class"      => "",
			"heading"    => esc_html__( "Blog Tags And Post Date Letter spacing", 'doors' ),
			"param_name" => "doors_blog_tags_date_letter_spacing",
			"value"      => "",
			"suffix"     => "px",
			"group"      => "Text Author",
		),
		array(
			"type"       => "dropdown",
			"heading"    => esc_html__( "Blog Tags And Post Date Font Style", 'doors' ),
			"param_name" => "doors_blog_tags_date_font_style",
			'value'      => array(
				esc_html__( 'Normal', 'doors' )  => 'normal',
				esc_html__( 'Italic', 'doors' )  => 'italic',
				esc_html__( 'Inherit', 'doors' ) => 'inherit',
				esc_html__( 'Initial', 'doors' ) => 'initial',
			),
			"group"      => "Text Author",
		),


		$vc_add_css_animation


	)
) );