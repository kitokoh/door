<?php
/**
 *----------------- include ------------------------------------------
 */
include_once( get_template_directory() . '/inc/tools.php' );
include_once( get_template_directory() . '/inc/plugins/plugins.php' );
include_once( get_template_directory() . '/inc/panel.php' );
include_once( get_template_directory() . '/inc/mega-menu.php' );
require_once( get_template_directory() . '/inc/aq_resizer.php' );
include_once(get_template_directory() . '/inc/navigation.php');

require_once( get_template_directory() . '/inc/woocommerce.php' );

function doors_setup() {
	//----------- text domaine----------
	load_theme_textdomain( 'doors', get_template_directory() . '/languages' );

	if ( function_exists( 'add_theme_support' ) ) {
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'post-formats', array( 'gallery', 'link', 'quote', 'video', 'audio' ) );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'woocommerce' );
		add_theme_support( 'custom-background' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'editor-styles' );
		add_editor_style( 'editor.css' );
		add_theme_support( 'align-wide' );
		// -- Disable custom font sizes
		add_theme_support( 'disable-custom-font-sizes' );

// -- Editor Font Sizes
		add_theme_support( 'editor-font-sizes', array(
			array(
				'name'      => esc_html__( 'small', 'doors' ),
				'shortName' => esc_html__( 'S', 'doors' ),
				'size'      => 14,
				'slug'      => esc_html__( 'small', 'doors' )
			),
			array(
				'name'      => esc_html__( 'regular', 'doors' ),
				'shortName' => esc_html__( 'M', 'doors' ),
				'size'      => 16,
				'slug'      => esc_html__( 'regular', 'doors' )
			),
			array(
				'name'      => esc_html__( 'large', 'doors' ),
				'shortName' => esc_html__( 'L', 'doors' ),
				'size'      => 18,
				'slug'      => esc_html__( 'large', 'doors' )
			),
		) );

	}

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary'     => esc_html__( 'Primary Navigation', 'doors' ),
		'right-menu'  => esc_html__( 'Right', 'doors' ),
		'menu_button' => esc_html__( 'button menu', 'doors' ),
	) );

}

add_action( 'after_setup_theme', 'doors_setup' );

/*
 * ---------- Page Title----------
 */
function doors_wp_title( $title, $sep ) {

	if ( is_feed() ) {
		return $title;
	}

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'name', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = esc_html__( 'Home - ', 'doors' ) . "$title";
	}


	return $title;
}

add_filter( 'wp_title', 'doors_wp_title', 10, 2 );

/*-----------------add Body Classes------------------------------------------*/
function doors_body_classes( $classes ) {

	return $classes;
}

add_filter( 'body_class', 'doors_body_classes' );

// Add support for editor styles.
add_theme_support( 'editor-styles' );

// Enqueue editor styles.
add_editor_style( 'style-editor.css' );

/**
 *-----------------add sidebar------------------------------------------
 */

function doors_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Right', 'doors' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<section>',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="block-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Left', 'doors' ),
		'id'            => 'sidebar-2',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="block-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 1st column', 'doors' ),
		'id'            => 'footer',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="block-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 2nd column', 'doors' ),
		'id'            => 'footer_columns_tow',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="block-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 3rd column', 'doors' ),
		'id'            => 'footer_columns_three',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="block-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 4th column', 'doors' ),
		'id'            => 'footer_columns_four',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="block-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Woocommerce Sidebar', 'doors' ),
		'id'            => 'shop-widgets',
		'description'   => esc_html__( 'Appears on the shop page of your website.', 'doors' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s shop-widgets">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}

add_action( 'widgets_init', 'doors_widgets_init' );


/**
 *--------------- Image presets-----------
 */

add_image_size( 'doors_small-thumb', 100, 70, true );
add_image_size( 'doors_sidebar-thumb', 160, 150, true );
add_image_size( 'doors_recent-blog-h', 465, 243, true );
add_image_size( 'doors_recent-blog-v', 390, 308, true );
add_image_size( 'doors_blog-thumb', 800, 450, true );
add_image_size( 'doors_650x350', 650, 350, true );
add_image_size( 'doors_team', 550, 576, true );
add_image_size( 'doors_team_member_slider', 744, 833, true );
add_image_size( 'doors_team_member_carousel', 370, 370, true );
add_image_size( 'doors_sidebar-thumb', 140, 140, true );
add_image_size( 'doors_1900x620', 1900, 620, true );
add_image_size( 'doors_portfolio', 946, 802, true );
add_image_size('doors_testimonial', 250, 250, true);


/**
 * ---------------load scripts and styles--------------------------------
 */

function doors_fonts_url( $font_body_name, $doors_font_weight_style, $doors_main_text_font_subsets ) {
	$doors_font_url = '';

	/*
	Translators: If there are characters in your language that are not supported
	by chosen font(s), translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Google font: on or off', 'doors' ) ) {
		$doors_font_url = add_query_arg( 'family', urlencode( $font_body_name . ':' . $doors_font_weight_style . '&subset=' . $doors_main_text_font_subsets ), "//fonts.googleapis.com/css" );
	}

	return $doors_font_url;
}


function doors_load_js_css_file() {
	/*----------google -fonts ------------------*/
	$doors_font_body_name         = doors_get_option( 'doors_body_font_familly', "Archivo Narrow" );
	$doors_font_weight_style      = doors_get_option( 'doors_body_font_weight_list', '400' );
	$doors_main_text_font_subsets = doors_get_option( 'doors_main-text-font-subsets' );

	$font_header_name                = doors_get_option( 'doors_head_font_familly', "Archivo Narrow" );
	$doors_heading_font_weight_style = doors_get_option( 'doors_heading-font-weight-style-list', '700' );
	$doors_heading_text_font_subsets = doors_get_option( 'doors_heading-text-font-subsets' );

	$doors_navigation_font_familly      = doors_get_option( 'doors_navigation_font_familly', "Archivo Narrow" );
	$doors_navigation_font_weight_style = doors_get_option( 'doors_navigation-font-weight-style-list' );
	$doors_navigation_text_font_subsets = doors_get_option( 'doors_navigation-text-font-subsets' );


	$doors_protocol = is_ssl() ? 'https' : 'http';

	if ( is_rtl() ) {
        wp_enqueue_style('doors_body_google_fonts', doors_fonts_url('Droid Arabic Kufi', '400,700', 'latin,latin-ext'), array(), '1.0.0');
	} elseif ( $doors_font_body_name != "default" && $doors_font_weight_style != "" ) {
		wp_enqueue_style( 'doors_body_google_fonts', doors_fonts_url( $doors_font_body_name, $doors_font_weight_style, $doors_main_text_font_subsets ), array(), '1.0.0' );
	} else {
		wp_enqueue_style( 'doors_body_google_fonts', doors_fonts_url('Archivo Narrow','400,700','latin,latin-ext'), array(), '1.0.0' );
	}


	if ( $font_header_name != "default" && $doors_heading_font_weight_style != "" ) {
		wp_enqueue_style( 'doors_header_google_fonts', doors_fonts_url( $font_header_name, $doors_heading_font_weight_style, $doors_heading_text_font_subsets ), array(), '1.0.0' );
	}

	if ( $doors_navigation_font_familly != "default" && $doors_navigation_font_weight_style != "" ) {
		wp_enqueue_style( 'doors_navigation_google_fonts', doors_fonts_url( $doors_navigation_font_familly, $doors_navigation_font_weight_style, $doors_navigation_text_font_subsets ), array(), '1.0.0' );
	}

	wp_enqueue_style( 'animation-custom', get_template_directory_uri() . "/css/animate-custom.css" );
	wp_enqueue_style( 'doors_app', get_template_directory_uri() . "/css/app.css" );
	wp_enqueue_style( 'component', get_template_directory_uri() . "/css/vendor/component.css" );
	wp_enqueue_style( 'doors_style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'doors_owlcarousel', get_template_directory_uri() . "/css/owl.carousel.css" );
	wp_enqueue_style( 'mediaelementplayer', get_template_directory_uri() . "/css/mediaelementplayer.css" );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . "/css/font-awesome.min.css" );
	wp_enqueue_style( 'doors_custom-line', get_template_directory_uri() . '/style.css' );


	if ( is_singular() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	wp_enqueue_script('doors-main-scripts', get_template_directory_uri() . '/js/wd-script.min.js', array('jquery', 'hoverIntent'), '1.0.0', true );
	wp_enqueue_script( 'googleapismap', $doors_protocol."://maps.googleapis.com/maps/api/js?v=3.exp", array( 'jquery' ), 3, true );


}

add_action( 'wp_enqueue_scripts', 'doors_load_js_css_file' );


include_once(get_template_directory() . '/inc/custom_style.php');

/**
 * ---------------menu--------------------------------
 */
$doors_count = 1;

class doors_top_bar_walker extends Walker_Nav_Menu {
	static protected $menu_bg_test;

	function start_el( &$output, $item, $depth = 0, $args = Array(), $id = 0 ) {

		$doors_class = "";
		if ( is_object( $args ) ) {
			global $doors_count;
			$icon = $item->classes[1];
			if ( $item->mega_menu == 1 ) {
				$doors_class = 'doors_mega-menu';
			}
			$doors_icon         = $item->mega_menu_icon;
			self::$menu_bg_test = $item->mega_menu_bg_image;
			$indent             = ( $depth ) ? str_repeat( "\t", $depth ) : '';
			$class_names        = $value = '';

			$classes           = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[]         = ( $item->current ) ? 'active' : '';
			$classes[]         = ( $args->has_children ) ? 'menu-item color-1 has-dropdown not-click' : '';
			$args->link_before = ( in_array( 'section', $classes ) ) ? '<label>' : '';
			$args->link_after  = ( in_array( 'section', $classes ) ) ? '</label>' : '';
			$output            .= ( in_array( 'section', $classes ) );
			$class_names       = ( $args->has_children ) ? 'menu-item has-dropdown  not-click ' . $doors_class : '';
			$parent            = $item->menu_item_parent;
			if ( $parent == 0 ) {
				$doors_count ++;
			}

			$class_names .= ' color-' . $doors_count;
			$class_names = strlen( trim( $class_names ) ) > 0 ? ' class="' . esc_attr( $class_names ) . '"' : '';
			$output      .= $indent . '
			<li id="menu-item-' . $item->ID . '"' . $value . $class_names . '>';

			$attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
			$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
			$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
			$attributes .= ! empty( $item->url ) ? ' href="' . esc_url( $item->url ) . '"' : '';

			$attributes .= ' class="has-icon"';

			$item_output = $args->before;
			$item_output .= ( ! in_array( 'section', $classes ) ) ? '
			<a' . $attributes . '>' : '';
			if ( ( $icon != '' ) and ( $icon != '---- None ----' ) ) {

				$item_output .= '<i class="' . $doors_icon . ' fa"></i> ';
			}
			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID );
			$item_output .= $args->link_after;
			$item_output .= ( ! in_array( 'section', $classes ) ) ? '</a>' : '';
			$item_output .= $args->after;


			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}


	}

	function end_el( &$output, $item, $depth = 0, $args = Array() ) {
		$output .= '
</li>' . "\n";
	}

	function start_lvl( &$output, $depth = 0, $args = Array() ) {
		$indent = str_repeat( "\t", $depth );
		if ( isset( $menu_bg_test ) && $menu_bg_test != "" ) {
			$output .= "\n" . $indent . '
<ul class="menu-item sub-menu dropdown " style = "background-image : url(' . self::$menu_bg_test . ')">
	' . "\n";
		} else {
			$output .= "\n" . $indent . '
			<ul class="sub-menu dropdown ">
	' . "\n";
		}

	}

	function end_lvl( &$output, $depth = 0, $args = Array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= $indent .


		           '

 </ul>' . "\n";
	}

	function display_element( $element, &$children_elements, $max_depth, $depth , $args, &$output ) {
		$id_field = $this->db_fields['id'];
		if ( is_object( $args[0] ) ) {
			$args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );
		}

		return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}

}

function doors_main_menu_fallback() {
	echo '<div class="empty-menu">';
	echo esc_html__( 'Please assign a menu to the primary menu location under Menus Settings', 'doors' ); ?>
  </div> <?php
}

/**
 * Sets up the content width value based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 625;
}





// retrieves the attachment ID from the file URL
function doors_get_image_id( $image_url ) {
	global $wpdb;
	$image_url  = esc_sql( $image_url );
	$attachment = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url ) );
	if ( isset( $attachment[0] ) ) {
		return $attachment[0];
	}
}

// initialize options
if ( ! function_exists( 'doors_initialize_options' ) ) {
	function doors_initialize_options() {

		$options_array = get_option( "doors_options_array" );

		if ( ! $options_array ) {
			$options_array = array(
				'doors_show_logo'                      => "",
				'doors_show_cart'                      => "",
				"doors_language_area_html"             => "",
				'doors_search_icon'                    => "",
				'doors_menu_sticky'                    => "",
				'doors_show_title'                     => "",
				'doors_blog_bg_image'                  => "",
				'doors_footer_bg_image'                => "",
				'footer_bg_color'                      => "",
				'footer_text_color'                    => "",
				'doors_copyright'                      => "",
				'doors_poweredby'                      => "",
				'copyright_text_color'                 => "",
				'doors_logo'                           => "",
				'doors_favicon'                        => "",
				'doors_theme_custom_css'               => "",
				'primary_color'                        => "",
				'secondary_color'                      => "",
				'adress_bar_color'                     => "",
				'social_bar_color'                     => "",
				'copyright_bg'                         => "",
				'header_bg'                            => "",
				'container_bg'                         => "",
				'doors_footer_columns'                 => "",
				'navigation_text_color'                => "",
				'navigation_bg_color_sticky'           => "",
				'language_area_html'                   => "",
				'doors_show_wpml_widget'               => '',
				'twitter'                              => "",
				'facebook'                             => "",
				'flickr'                               => "",
				'vimeo'                                => "",
				'phone'                                => "",
				'adress'                               => "",
				'doors_body_font_familly'              => "lato",
				'doors_body_font_style'                => "",
				'doors_font-weight-style'              => "",
				'doors_main_text_lettre_spacing'       => '',
				'doors_main-text-font-subsets'         => "",
				'doors_head_font_familly'              => "Archivo Narrow",
				'doors_head_font_style'                => "",
				'doors_heading-font-weight-style'      => "",
				'doors_heading-text-font-subsets'      => "",
				'doors_heading_text_lettre_spacing'    => "",
				'doors_navigation_font_familly'        => "",
				'doors_navigation_font_style'          => "",
				'doors_navigation-font-weight-style'   => "",
				'doors_navigation-text-font-subsets'   => "",
				'doors_navigation_text_lettre_spacing' => "",
				'doors_menu_style'                     => "",
				'doors_theme_custom_js'                => ""
			);
			update_option( "doors_options_array", $options_array );
		}
	}
}


// get options value
if ( ! function_exists( 'doors_get_option' ) ) {
	function doors_get_option( $doors_option_key, $doors_option_default_value = null ) {
		doors_initialize_options();
		$options_array    = get_option( "doors_options_array" );
		// for demo purpose
		if ( function_exists( "wd_custom_options" ) ) {
			$options_array = wd_custom_options( $options_array );
		}
		$doors_meta_value = "";
		if ( array_key_exists( $doors_option_key, $options_array ) ) {
			if ( isset( $options_array[ $doors_option_key ] ) && ! empty( $options_array[ $doors_option_key ] ) ) {
				$doors_meta_value = esc_attr( $options_array[ $doors_option_key ] );
			}
		}

		if ( $doors_meta_value == "" ) {
			$doors_meta_value = $doors_option_default_value;
		}

		return $doors_meta_value;
	}
}

// get options value
if ( ! function_exists( 'doors_save_option' ) ) {
	function doors_save_option( $doors_option_key, $doors_option_value = null ) {
		$options_array                      = get_option( "doors_options_array" );
		$options_array[ $doors_option_key ] = $doors_option_value;
		update_option( "doors_options_array", $options_array );
	}
}


if ( ! function_exists( 'doors_get_categories' ) ) {
	function doors_get_categories( $taxonomy = '' ) {
		$args = array(
			'type'       => 'post',
			'hide_empty' => 0
		);

		$output = array();

		$args['taxonomy'] = $taxonomy;
		$categories       = get_categories( $args );

		if ( ! empty( $categories ) && is_array( $categories ) ) {
			foreach ( $categories as $category ) {
				if ( is_object( $category ) ) {
					$output[ $category->name ] = $category->slug;
				}
			}
		}

		return $output;
	}
}

function doors_theme_custom_js() {


	if ( doors_get_option( 'doors_theme_custom_js', '' ) != '' ) {
		echo '<script type="text/javascript">
				'. esc_js(doors_get_option( 'doors_theme_custom_js' )) . '
			</script>';
	}

}

add_action( 'wp_footer', 'doors_theme_custom_js' );


function doors_removeslashes( $string ) {
	$string = implode( "", explode( "\\", $string ) );

	return stripslashes( trim( $string ) );
}


function doors_init() {
	return Doors_class::instance();
}

//doors_init();

class Doors_class {

	private static $instance;

	public $helpers;

	public $customizer;

	public $activation;

	public $integrations;
	public $widgets;

	public $template;

	public $page_settings;
	public $widgetized_pages;

	public static function instance() {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Doors_class ) ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public function __construct() {
		$this->base();
		$this->setup();
	}

	// Integration getter helper
	public function get( $integration ) {
		return $this->integrations->get( $integration );
	}

	private function base() {
		$this->files = array(
			'customizer/class-customizer.php'
		);

		foreach ( $this->files as $file ) {
			require_once( get_template_directory() . '/inc/' . $file );
		}
	}

	private function setup() {

		$this->customizer = new Doors_Customizer();

		add_action( 'after_setup_theme', array( $this, 'setup_theme' ) );
	}
	



	public function setup_theme() {
		load_theme_textdomain( 'doors', get_template_directory() . '/languages' );
		add_editor_style( 'css/editor-style.css' );

		add_theme_support( 'custom-background', apply_filters( 'doors_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

	}

}

add_filter( 'woocommerce_subcategory_count_html', 'njengah_remove_category_products_count' );

function njengah_remove_category_products_count() {

  return;

}


