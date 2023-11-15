<?php
/**
 * Interior Designs Theme Customizer
 *
 * @package Interior Designs
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function interior_designs_customize_register( $wp_customize ) {

	load_template( trailingslashit( get_template_directory() ) . '/inc/icon-changer.php' );

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	$wp_customize->selective_refresh->add_partial(
		'blogname',
		array(
			'selector'        => '.site-title a',
			'render_callback' => 'interior_designs_customize_partial_blogname',
		)
	);
	$wp_customize->selective_refresh->add_partial(
		'blogdescription',
		array(
			'selector'        => '.site-description',
			'render_callback' => 'interior_designs_customize_partial_blogdescription',
		)
	);

	//add home page setting pannel
	$wp_customize->add_panel( 'interior_designs_panel_id', array(
	    'priority' => 10,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Theme Settings', 'interior-designs' ),
	    'description' => __( 'Description of what this panel does.', 'interior-designs' )
	) );

	//Layouts
	$wp_customize->add_section( 'interior_designs_left_right', array(
    	'title' => __( 'Theme Layout Settings', 'interior-designs' ),
		'priority' => 10,
		'panel' => 'interior_designs_panel_id'
	) );

	// Preloader
	$wp_customize->add_setting( 'interior_designs_preloader_hide',array(
		'default' => true,
      	'sanitize_callback'	=> 'interior_designs_sanitize_checkbox'
    ) );
    $wp_customize->add_control('interior_designs_preloader_hide',array(
    	'type' => 'checkbox',
        'label' => __( 'Show / Hide Preloader','interior-designs' ),
        'section' => 'interior_designs_left_right'
    ));

    $wp_customize->add_setting('interior_designs_preloader_type',array(
        'default'   => 'center-square',
        'sanitize_callback' => 'interior_designs_sanitize_choices'
	));
	$wp_customize->add_control( 'interior_designs_preloader_type', array(
		'label' => __( 'Preloader Type','interior-designs' ),
		'section' => 'interior_designs_left_right',
		'type'  => 'select',
		'settings' => 'interior_designs_preloader_type',
		'choices' => array(
		    'center-square' => __('Center Square','interior-designs'),
		    'chasing-square' => __('Chasing Square','interior-designs'),
	    ),
	));

	$wp_customize->add_setting( 'interior_designs_preloader_color', array(
	    'default' => '#333333',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'interior_designs_preloader_color', array(
  		'label' => 'Preloader Color',
	    'section' => 'interior_designs_left_right',
	    'settings' => 'interior_designs_preloader_color',
  	)));

  	$wp_customize->add_setting( 'interior_designs_preloader_bg_color', array(
	    'default' => '#fff',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'interior_designs_preloader_bg_color', array(
  		'label' => 'Preloader Background Color',
	    'section' => 'interior_designs_left_right',
	    'settings' => 'interior_designs_preloader_bg_color',
  	)));

	$wp_customize->add_setting('interior_designs_width_options',array(
        'default' => 'Full Layout',
        'sanitize_callback' => 'interior_designs_sanitize_choices'
	));
	$wp_customize->add_control('interior_designs_width_options',array(
        'type' => 'select',
        'label' => __('Select Site Layout','interior-designs'),
        'section' => 'interior_designs_left_right',
        'choices' => array(
            'Full Layout' => __('Full Layout','interior-designs'),
            'Contained Layout' => __('Contained Layout','interior-designs'),
            'Boxed Layout' => __('Boxed Layout','interior-designs'),
        ),
	) );

	// Add Settings and Controls for Layout
	$wp_customize->add_setting('interior_designs_theme_options',array(
	        'default' => 'Right Sidebar',
	        'sanitize_callback' => 'interior_designs_sanitize_choices'
	) );
	$wp_customize->add_control('interior_designs_theme_options',
	    array(
	        'type' => 'radio',
	        'label' => __( 'Sidebar Options', 'interior-designs' ),
	        'section' => 'interior_designs_left_right',
	        'choices' => array(
	            'Left Sidebar' => __('Left Sidebar','interior-designs'),
	            'Right Sidebar' => __('Right Sidebar','interior-designs'),
	            'One Column' => __('One Column','interior-designs'),
	            'Three Columns' => __('Three Columns','interior-designs'),
	            'Four Columns' => __('Four Columns','interior-designs'),
	            'Grid Layout' => __('Grid Layout','interior-designs')
	        ),
	    )
    );

    // Add Settings and Controls for Layout
	$wp_customize->add_setting('interior_designs_single_post_sidebar',array(
        'default' => 'Right Sidebar',
        'sanitize_callback' => 'interior_designs_sanitize_choices'
	) );
	$wp_customize->add_control('interior_designs_single_post_sidebar', array(
        'type' => 'radio',
        'label' => __('Single Post Sidebar Layout','interior-designs'),
        'section' => 'interior_designs_left_right',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','interior-designs'),
            'Right Sidebar' => __('Right Sidebar','interior-designs'),
            'One Column' => __('One Column','interior-designs'),
        ),
    ));

    $wp_customize->add_setting( 'interior_designs_single_page_breadcrumb',array(
		'default' => true,
      	'sanitize_callback'	=> 'interior_designs_sanitize_checkbox'
    ) );
    $wp_customize->add_control('interior_designs_single_page_breadcrumb',array(
    	'type' => 'checkbox',
        'label' => __( 'Show / Hide Single Page Breadcrumb','interior-designs' ),
        'section' => 'interior_designs_left_right'
    ));

    $interior_designs_font_array = array(
        '' =>'No Fonts',
        'Abril Fatface' => 'Abril Fatface',
        'Acme' =>'Acme', 
        'Anton' => 'Anton', 
        'Architects Daughter' =>'Architects Daughter',
        'Arimo' => 'Arimo', 
        'Arsenal' =>'Arsenal',
        'Arvo' =>'Arvo',
        'Alegreya' =>'Alegreya',
        'Alfa Slab One' =>'Alfa Slab One',
        'Averia Serif Libre' =>'Averia Serif Libre', 
        'Bangers' =>'Bangers', 
        'Boogaloo' =>'Boogaloo', 
        'Bad Script' =>'Bad Script',
        'Bitter' =>'Bitter', 
        'Bree Serif' =>'Bree Serif', 
        'BenchNine' =>'BenchNine',
        'Cabin' =>'Cabin',
        'Cardo' =>'Cardo', 
        'Courgette' =>'Courgette', 
        'Cherry Swash' =>'Cherry Swash',
        'Cormorant Garamond' =>'Cormorant Garamond', 
        'Crimson Text' =>'Crimson Text',
        'Cuprum' =>'Cuprum', 
        'Cookie' =>'Cookie',
        'Chewy' =>'Chewy',
        'Days One' =>'Days One',
        'Dosis' =>'Dosis',
        'Droid Sans' =>'Droid Sans', 
        'Economica' =>'Economica', 
        'Fredoka One' =>'Fredoka One',
        'Fjalla One' =>'Fjalla One',
        'Francois One' =>'Francois One', 
        'Frank Ruhl Libre' => 'Frank Ruhl Libre', 
        'Gloria Hallelujah' =>'Gloria Hallelujah',
        'Great Vibes' =>'Great Vibes', 
        'Handlee' =>'Handlee', 
        'Hammersmith One' =>'Hammersmith One',
        'Inconsolata' =>'Inconsolata',
        'Indie Flower' =>'Indie Flower', 
        'IM Fell English SC' =>'IM Fell English SC',
        'Julius Sans One' =>'Julius Sans One',
        'Josefin Slab' =>'Josefin Slab',
        'Josefin Sans' =>'Josefin Sans',
        'Kanit' =>'Kanit',
        'Lobster' =>'Lobster',
        'Lato' => 'Lato',
        'Lora' =>'Lora', 
        'Libre Baskerville' =>'Libre Baskerville',
        'Lobster Two' => 'Lobster Two',
        'Merriweather' =>'Merriweather',
        'Monda' =>'Monda',
        'Montserrat' =>'Montserrat',
        'Muli' =>'Muli',
        'Marck Script' =>'Marck Script',
        'Noto Serif' =>'Noto Serif',
        'Open Sans' =>'Open Sans',
        'Overpass' => 'Overpass', 
        'Overpass Mono' =>'Overpass Mono',
        'Oxygen' =>'Oxygen',
        'Orbitron' =>'Orbitron',
        'Patua One' =>'Patua One',
        'Pacifico' =>'Pacifico',
        'Padauk' =>'Padauk',
        'Playball' =>'Playball',
        'Playfair Display' =>'Playfair Display',
        'PT Sans' =>'PT Sans',
        'Philosopher' =>'Philosopher',
        'Permanent Marker' =>'Permanent Marker',
        'Poiret One' =>'Poiret One',
        'Quicksand' =>'Quicksand',
        'Quattrocento Sans' =>'Quattrocento Sans',
        'Raleway' =>'Raleway',
        'Rubik' =>'Rubik',
        'Rokkitt' =>'Rokkitt',
        'Russo One' => 'Russo One', 
        'Righteous' =>'Righteous', 
        'Slabo' =>'Slabo', 
        'Source Sans Pro' =>'Source Sans Pro',
        'Shadows Into Light Two' =>'Shadows Into Light Two',
        'Shadows Into Light' =>  'Shadows Into Light',
        'Sacramento' =>'Sacramento',
        'Shrikhand' =>'Shrikhand',
        'Tangerine' => 'Tangerine',
        'Ubuntu' =>'Ubuntu',
        'VT323' =>'VT323',
        'Varela Round' =>'Varela Round',
        'Vampiro One' =>'Vampiro One',
        'Vollkorn' => 'Vollkorn',
        'Volkhov' =>'Volkhov',
        'Kavoon' =>'Kavoon',
        'Yanone Kaffeesatz' =>'Yanone Kaffeesatz'
    );

	//Color / Font Pallete
	$wp_customize->add_section( 'interior_designs_typography', array(
    	'title'      => __( 'Color / Font Pallete', 'interior-designs' ),
		'priority'   => 20,
		'panel' => 'interior_designs_panel_id'
	) );

	// This is Body Color setting
	$wp_customize->add_setting( 'interior_designs_body_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'interior_designs_body_color', array(
		'label' => __('Body Color', 'interior-designs'),
		'section' => 'interior_designs_typography',
		'settings' => 'interior_designs_body_color',
	)));

	//This is Body FontFamily  setting
	$wp_customize->add_setting('interior_designs_body_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'interior_designs_sanitize_choices'
	));
	$wp_customize->add_control(
		'interior_designs_body_font_family', array(
		'section'  => 'interior_designs_typography',
		'label'    => __( 'Body Fonts','interior-designs'),
		'type'     => 'select',
		'choices'  => $interior_designs_font_array,
	));

    //This is Body Fontsize setting
	$wp_customize->add_setting('interior_designs_body_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('interior_designs_body_font_size',array(
		'label'	=> __('Body Font Size','interior-designs'),
		'section'	=> 'interior_designs_typography',
		'setting'	=> 'interior_designs_body_font_size',
		'type'	=> 'text'
	));

	// Add the Theme Color Option section.
	$wp_customize->add_setting( 'interior_designs_theme_color_first', array(
	    'default' => '',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'interior_designs_theme_color_first', array(
  		'label' => 'Theme Color Option 1',
	    'section' => 'interior_designs_typography',
	    'settings' => 'interior_designs_theme_color_first',
  	)));

  	$wp_customize->add_setting( 'interior_designs_theme_color_second', array(
	    'default' => '',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'interior_designs_theme_color_second', array(
  		'label' => 'Theme Color Option 2',
	    'section' => 'interior_designs_typography',
	    'settings' => 'interior_designs_theme_color_second',
  	)));
	
	// This is Paragraph Color picker setting
	$wp_customize->add_setting( 'interior_designs_paragraph_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'interior_designs_paragraph_color', array(
		'label' => __('Paragraph Color', 'interior-designs'),
		'section' => 'interior_designs_typography',
		'settings' => 'interior_designs_paragraph_color',
	)));

	//This is Paragraph FontFamily picker setting
	$wp_customize->add_setting('interior_designs_paragraph_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'interior_designs_sanitize_choices'
	));
	$wp_customize->add_control(
	    'interior_designs_paragraph_font_family', array(
	    'section'  => 'interior_designs_typography',
	    'label'    => __( 'Paragraph Fonts','interior-designs'),
	    'type'     => 'select',
	    'choices'  => $interior_designs_font_array,
	));

	$wp_customize->add_setting('interior_designs_paragraph_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('interior_designs_paragraph_font_size',array(
		'label'	=> __('Paragraph Font Size','interior-designs'),
		'section'	=> 'interior_designs_typography',
		'setting'	=> 'interior_designs_paragraph_font_size',
		'type'	=> 'text'
	));

	// This is "a" Tag Color picker setting
	$wp_customize->add_setting( 'interior_designs_atag_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'interior_designs_atag_color', array(
		'label' => __('"a" Tag Color', 'interior-designs'),
		'section' => 'interior_designs_typography',
		'settings' => 'interior_designs_atag_color',
	)));

	//This is "a" Tag FontFamily picker setting
	$wp_customize->add_setting('interior_designs_atag_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'interior_designs_sanitize_choices'
	));
	$wp_customize->add_control(
	    'interior_designs_atag_font_family', array(
	    'section'  => 'interior_designs_typography',
	    'label'    => __( '"a" Tag Fonts','interior-designs'),
	    'type'     => 'select',
	    'choices'  => $interior_designs_font_array,
	));

	// This is "a" Tag Color picker setting
	$wp_customize->add_setting( 'interior_designs_li_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'interior_designs_li_color', array(
		'label' => __('"li" Tag Color', 'interior-designs'),
		'section' => 'interior_designs_typography',
		'settings' => 'interior_designs_li_color',
	)));

	//This is "li" Tag FontFamily picker setting
	$wp_customize->add_setting('interior_designs_li_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'interior_designs_sanitize_choices'
	));
	$wp_customize->add_control(
	    'interior_designs_li_font_family', array(
	    'section'  => 'interior_designs_typography',
	    'label'    => __( '"li" Tag Fonts','interior-designs'),
	    'type'     => 'select',
	    'choices'  => $interior_designs_font_array,
	));

	// This is H1 Color picker setting
	$wp_customize->add_setting( 'interior_designs_h1_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'interior_designs_h1_color', array(
		'label' => __('h1 Color', 'interior-designs'),
		'section' => 'interior_designs_typography',
		'settings' => 'interior_designs_h1_color',
	)));

	//This is H1 FontFamily picker setting
	$wp_customize->add_setting('interior_designs_h1_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'interior_designs_sanitize_choices'
	));
	$wp_customize->add_control(
	    'interior_designs_h1_font_family', array(
	    'section'  => 'interior_designs_typography',
	    'label'    => __( 'h1 Fonts','interior-designs'),
	    'type'     => 'select',
	    'choices'  => $interior_designs_font_array,
	));

	//This is H1 FontSize setting
	$wp_customize->add_setting('interior_designs_h1_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('interior_designs_h1_font_size',array(
		'label'	=> __('h1 Font Size','interior-designs'),
		'section'	=> 'interior_designs_typography',
		'setting'	=> 'interior_designs_h1_font_size',
		'type'	=> 'text'
	));

	// This is H2 Color picker setting
	$wp_customize->add_setting( 'interior_designs_h2_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'interior_designs_h2_color', array(
		'label' => __('h2 Color', 'interior-designs'),
		'section' => 'interior_designs_typography',
		'settings' => 'interior_designs_h2_color',
	)));

	//This is H2 FontFamily picker setting
	$wp_customize->add_setting('interior_designs_h2_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'interior_designs_sanitize_choices'
	));
	$wp_customize->add_control(
	    'interior_designs_h2_font_family', array(
	    'section'  => 'interior_designs_typography',
	    'label'    => __( 'h2 Fonts','interior-designs'),
	    'type'     => 'select',
	    'choices'  => $interior_designs_font_array,
	));

	//This is H2 FontSize setting
	$wp_customize->add_setting('interior_designs_h2_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('interior_designs_h2_font_size',array(
		'label'	=> __('h2 Font Size','interior-designs'),
		'section'	=> 'interior_designs_typography',
		'setting'	=> 'interior_designs_h2_font_size',
		'type'	=> 'text'
	));

	// This is H3 Color picker setting
	$wp_customize->add_setting( 'interior_designs_h3_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'interior_designs_h3_color', array(
		'label' => __('h3 Color', 'interior-designs'),
		'section' => 'interior_designs_typography',
		'settings' => 'interior_designs_h3_color',
	)));

	//This is H3 FontFamily picker setting
	$wp_customize->add_setting('interior_designs_h3_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'interior_designs_sanitize_choices'
	));
	$wp_customize->add_control(
	    'interior_designs_h3_font_family', array(
	    'section'  => 'interior_designs_typography',
	    'label'    => __( 'h3 Fonts','interior-designs'),
	    'type'     => 'select',
	    'choices'  => $interior_designs_font_array,
	));

	//This is H3 FontSize setting
	$wp_customize->add_setting('interior_designs_h3_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('interior_designs_h3_font_size',array(
		'label'	=> __('h3 Font Size','interior-designs'),
		'section'	=> 'interior_designs_typography',
		'setting'	=> 'interior_designs_h3_font_size',
		'type'	=> 'text'
	));

	// This is H4 Color picker setting
	$wp_customize->add_setting( 'interior_designs_h4_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'interior_designs_h4_color', array(
		'label' => __('h4 Color', 'interior-designs'),
		'section' => 'interior_designs_typography',
		'settings' => 'interior_designs_h4_color',
	)));

	//This is H4 FontFamily picker setting
	$wp_customize->add_setting('interior_designs_h4_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'interior_designs_sanitize_choices'
	));
	$wp_customize->add_control(
	    'interior_designs_h4_font_family', array(
	    'section'  => 'interior_designs_typography',
	    'label'    => __( 'h4 Fonts','interior-designs'),
	    'type'     => 'select',
	    'choices'  => $interior_designs_font_array,
	));

	//This is H4 FontSize setting
	$wp_customize->add_setting('interior_designs_h4_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('interior_designs_h4_font_size',array(
		'label'	=> __('h4 Font Size','interior-designs'),
		'section'	=> 'interior_designs_typography',
		'setting'	=> 'interior_designs_h4_font_size',
		'type'	=> 'text'
	));

	// This is H5 Color picker setting
	$wp_customize->add_setting( 'interior_designs_h5_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'interior_designs_h5_color', array(
		'label' => __('h5 Color', 'interior-designs'),
		'section' => 'interior_designs_typography',
		'settings' => 'interior_designs_h5_color',
	)));

	//This is H5 FontFamily picker setting
	$wp_customize->add_setting('interior_designs_h5_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'interior_designs_sanitize_choices'
	));
	$wp_customize->add_control(
	    'interior_designs_h5_font_family', array(
	    'section'  => 'interior_designs_typography',
	    'label'    => __( 'h5 Fonts','interior-designs'),
	    'type'     => 'select',
	    'choices'  => $interior_designs_font_array,
	));

	//This is H5 FontSize setting
	$wp_customize->add_setting('interior_designs_h5_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('interior_designs_h5_font_size',array(
		'label'	=> __('h5 Font Size','interior-designs'),
		'section'	=> 'interior_designs_typography',
		'setting'	=> 'interior_designs_h5_font_size',
		'type'	=> 'text'
	));

	// This is H6 Color picker setting
	$wp_customize->add_setting( 'interior_designs_h6_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'interior_designs_h6_color', array(
		'label' => __('h6 Color', 'interior-designs'),
		'section' => 'interior_designs_typography',
		'settings' => 'interior_designs_h6_color',
	)));

	//This is H6 FontFamily picker setting
	$wp_customize->add_setting('interior_designs_h6_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'interior_designs_sanitize_choices'
	));
	$wp_customize->add_control(
	    'interior_designs_h6_font_family', array(
	    'section'  => 'interior_designs_typography',
	    'label'    => __( 'h6 Fonts','interior-designs'),
	    'type'     => 'select',
	    'choices'  => $interior_designs_font_array,
	));

	//This is H6 FontSize setting
	$wp_customize->add_setting('interior_designs_h6_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('interior_designs_h6_font_size',array(
		'label'	=> __('h6 Font Size','interior-designs'),
		'section'	=> 'interior_designs_typography',
		'setting'	=> 'interior_designs_h6_font_size',
		'type'	=> 'text'
	));

    //topbar
	$wp_customize->add_section('interior_designs_topbar',array(
		'title'	=> __('Top Header','interior-designs'),
		'description'	=> __('Add Header Content here','interior-designs'),
		'priority'	=> 30,
		'panel' => 'interior_designs_panel_id',
	));

	//Show /Hide Topbar
	$wp_customize->add_setting( 'interior_designs_topbar_hide',array(
		'default' => false,
      	'sanitize_callback'	=> 'interior_designs_sanitize_checkbox'
    ) );
    $wp_customize->add_control('interior_designs_topbar_hide',array(
    	'type' => 'checkbox',
        'label' => __( 'Show / Hide Topbar','interior-designs' ),
        'section' => 'interior_designs_topbar'
    ));

	$wp_customize->add_setting('interior_designs_topbar_top_bottom',array(
		'default'=> '5',
		'sanitize_callback'	=> 'interior_designs_sanitize_float'
	));
	$wp_customize->add_control('interior_designs_topbar_top_bottom',array(
		'label'	=> __('Topbar Top Bottom Padding','interior-designs'),
		'input_attrs' => array(
            'step' => 1,
			'min'  => 0,
			'max'  => 50,
        ),
		'section'=> 'interior_designs_topbar',
		'type'=> 'number',
	));

	//Sticky Header
	$wp_customize->add_setting( 'interior_designs_sticky_header',array(
      	'sanitize_callback'	=> 'interior_designs_sanitize_checkbox'
    ) );
    $wp_customize->add_control('interior_designs_sticky_header',array(
    	'type' => 'checkbox',
        'label' => __( 'Sticky Header','interior-designs' ),
        'section' => 'interior_designs_topbar'
    ));

    $wp_customize->add_setting('interior_designs_sticky_header_padding', array(
		'default'=> '',
		'sanitize_callback'	=> 'interior_designs_sanitize_float'
	));
	$wp_customize->add_control('interior_designs_sticky_header_padding', array(
		'label'	=> __('Sticky Header Padding','interior-designs'),
		'input_attrs' => array(
            'step' => 1,
			'min'  => 0,
			'max'  => 50,
        ),
		'section'=> 'interior_designs_topbar',
		'type'=> 'number',
	));

	$wp_customize->add_setting('interior_designs_search_icon',array(
		'default'	=> 'fas fa-search',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Interior_Designs_Icon_Changer(
        $wp_customize, 'interior_designs_search_icon',array(
		'label'	=> __('Search Icon','interior-designs'),
		'section'	=> 'interior_designs_topbar',
		'type'		=> 'icon'
	)));

    $wp_customize->selective_refresh->add_partial('interior_designs_text',array(
		'selector'        => '.site-text span',
		'render_callback' => 'interior_designs_customize_partial_interior_designs_text',
	));

    $wp_customize->add_setting('interior_designs_text',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('interior_designs_text',array(
		'label'	=> __('Site Text','interior-designs'),
		'section'	=> 'interior_designs_topbar',
		'setting'	=> 'interior_designs_text',
		'type'	=> 'text'
	));

	$wp_customize->selective_refresh->add_partial(
		'interior_designs_facebook_url',
		array(
			'selector'        => '.social-media',
			'render_callback' => 'interior_designs_customize_partial_interior_designs_facebook_url',
		)
	);

	$wp_customize->add_setting('interior_designs_facebook_icon',array(
		'default'	=> 'fab fa-facebook-f',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Interior_Designs_Icon_Changer(
        $wp_customize, 'interior_designs_facebook_icon',array(
		'label'	=> __('Facebook Icon','interior-designs'),
		'section'	=> 'interior_designs_topbar',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('interior_designs_facebook_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('interior_designs_facebook_url',array(
		'label'	=> __('Add Facebook link','interior-designs'),
		'section'	=> 'interior_designs_topbar',
		'setting'	=> 'interior_designs_facebook_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('interior_designs_twitter_icon',array(
		'default'	=> 'fab fa-twitter',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Interior_Designs_Icon_Changer(
        $wp_customize, 'interior_designs_twitter_icon',array(
		'label'	=> __('Twitter Icon','interior-designs'),
		'section'	=> 'interior_designs_topbar',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('interior_designs_twitter_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('interior_designs_twitter_url',array(
		'label'	=> __('Add Twitter link','interior-designs'),
		'section'	=> 'interior_designs_topbar',
		'setting'	=> 'interior_designs_twitter_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('interior_designs_instagram_icon',array(
		'default'	=> 'fab fa-instagram',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Interior_Designs_Icon_Changer(
        $wp_customize, 'interior_designs_instagram_icon',array(
		'label'	=> __('Instagram Icon','interior-designs'),
		'section'	=> 'interior_designs_topbar',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('interior_designs_insta_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('interior_designs_insta_url',array(
		'label'	=> __('Add Instagram link','interior-designs'),
		'section'	=> 'interior_designs_topbar',
		'setting'	=> 'interior_designs_insta_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('interior_designs_linkedin_icon',array(
		'default'	=> 'fab fa-linkedin-in',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Interior_Designs_Icon_Changer(
        $wp_customize, 'interior_designs_linkedin_icon',array(
		'label'	=> __('Linkedin Icon','interior-designs'),
		'section'	=> 'interior_designs_topbar',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('interior_designs_linkdin_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('interior_designs_linkdin_url',array(
		'label'	=> __('Add Linkedin link','interior-designs'),
		'section'	=> 'interior_designs_topbar',
		'setting'	=> 'interior_designs_linkdin_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('interior_designs_youtube_icon',array(
		'default'	=> 'fab fa-youtube',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Interior_Designs_Icon_Changer(
        $wp_customize, 'interior_designs_youtube_icon',array(
		'label'	=> __('Youtube Icon','interior-designs'),
		'section'	=> 'interior_designs_topbar',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('interior_designs_youtube_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('interior_designs_youtube_url',array(
		'label'	=> __('Add Youtube link','interior-designs'),
		'section'	=> 'interior_designs_topbar',
		'setting'	=> 'interior_designs_youtube_url',
		'type'		=> 'url'
	));

	$wp_customize->add_setting('interior_designs_social_icons_font_size',array(
		'default'=> 12,
		'sanitize_callback'	=> 'interior_designs_sanitize_float',
	));
	$wp_customize->add_control('interior_designs_social_icons_font_size',array(
		'label'	=> __('Social Icons Font Size ','interior-designs'),
		'section'=> 'interior_designs_topbar',
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 50,
        ),
		'type'=> 'number'
	));

	//Header
	$wp_customize->add_section('interior_designs_header',array(
		'title'	=> __('Header','interior-designs'),
		'description'	=> __('Add Header Content here','interior-designs'),
		'priority'	=> 40,
		'panel' => 'interior_designs_panel_id',
	));

	$wp_customize->selective_refresh->add_partial(
		'interior_designs_call_text',
		array(
			'selector'        => '.call',
			'render_callback' => 'interior_designs_customize_partial_interior_designs_call_text',
		)
	);

	$wp_customize->add_setting('interior_designs_phone_icon',array(
		'default'	=> 'fas fa-phone',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Interior_Designs_Icon_Changer(
        $wp_customize, 'interior_designs_phone_icon',array(
		'label'	=> __('Phone Icon','interior-designs'),
		'section'	=> 'interior_designs_header',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting('interior_designs_call_text',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('interior_designs_call_text',array(
		'label'	=> __('Call Text','interior-designs'),
		'section'	=> 'interior_designs_header',
		'setting'	=> 'interior_designs_call_text',
		'type'	=> 'text'
	));

	$wp_customize->add_setting('interior_designs_call',array(
		'default'	=> '',
		'sanitize_callback'	=> 'interior_designs_sanitize_phone_number'
	));	
	$wp_customize->add_control('interior_designs_call',array(
		'label'	=> __('Call No.','interior-designs'),
		'section'	=> 'interior_designs_header',
		'setting'	=> 'interior_designs_call',
		'type'	=> 'text'
	));

	$wp_customize->add_setting('interior_designs_location_icon',array(
		'default'	=> 'fas fa-location-arrow',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Interior_Designs_Icon_Changer(
        $wp_customize, 'interior_designs_location_icon',array(
		'label'	=> __('Location Icon','interior-designs'),
		'section'	=> 'interior_designs_header',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('interior_designs_location_text',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('interior_designs_location_text',array(
		'label'	=> __('Street Details','interior-designs'),
		'section'	=> 'interior_designs_header',
		'setting'	=> 'interior_designs_location_text',
		'type'	=> 'text'
	));

	$wp_customize->add_setting('interior_designs_location',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('interior_designs_location',array(
		'label'	=> __('City Details','interior-designs'),
		'section'	=> 'interior_designs_header',
		'setting'	=> 'interior_designs_location',
		'type'	=> 'text'
	));

	$wp_customize->add_setting('interior_designs_time_icon',array(
		'default'	=> 'far fa-clock',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Interior_Designs_Icon_Changer(
        $wp_customize, 'interior_designs_time_icon',array(
		'label'	=> __('Time Icon','interior-designs'),
		'section'	=> 'interior_designs_header',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('interior_designs_time',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('interior_designs_time',array(
		'label'	=> __('Time','interior-designs'),
		'section'	=> 'interior_designs_header',
		'setting'	=> 'interior_designs_time',
		'type'	=> 'text'
	));

	$wp_customize->add_setting('interior_designs_day',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('interior_designs_day',array(
		'label'	=> __('Day','interior-designs'),
		'section'	=> 'interior_designs_header',
		'setting'	=> 'interior_designs_day',
		'type'	=> 'text'
	));

	$wp_customize->add_setting('interior_designs_navigation_case',array(
        'default' => 'capitalize',
        'sanitize_callback' => 'interior_designs_sanitize_choices'
	));
	$wp_customize->add_control('interior_designs_navigation_case',array(
        'type' => 'select',
        'label' => __('Navigation Case','interior-designs'),
        'section' => 'interior_designs_header',
        'choices' => array(
            'uppercase' => __('Uppercase','interior-designs'),
            'capitalize' => __('Capitalize','interior-designs'),
        ),
	) );

	$wp_customize->add_setting( 'interior_designs_nav_font_size', array(
		'default'           => 14,
		'sanitize_callback' => 'interior_designs_sanitize_float',
	) );
	$wp_customize->add_control( 'interior_designs_nav_font_size', array(
		'label' => __( 'Navigation Font Size','interior-designs' ),
		'section'     => 'interior_designs_header',
		'type'        => 'number',
		'input_attrs' => array(
			'step' => 1,
			'min' => 0,
			'max' => 50,
		),
	) );

	$wp_customize->add_setting('interior_designs_font_weight_menu_option',array(
        'default' => 'Defalt',
        'sanitize_callback' => 'interior_designs_sanitize_choices'
    ));
    $wp_customize->add_control('interior_designs_font_weight_menu_option',array(
        'type' => 'select',
        'label' => __('Navigation Font Weight','interior-designs'),
        'section' => 'interior_designs_header',
        'choices' => array(
            '300' => __('300','interior-designs'),
            '400' => __('400','interior-designs'),
            'Defalt' => __('500','interior-designs'),
            '700' => __('700','interior-designs'),
        ),
	) );

	$wp_customize->add_setting('interior_designs_menu_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'interior_designs_menu_color', array(
		'label'    => __('Menu Color', 'interior-designs'),
		'section'  => 'interior_designs_header',
		'settings' => 'interior_designs_menu_color',
	)));

	$wp_customize->add_setting('interior_designs_menu_hover_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'interior_designs_menu_hover_color', array(
		'label'    => __('Menu Hover Color', 'interior-designs'),
		'section'  => 'interior_designs_header',
		'settings' => 'interior_designs_menu_hover_color',
	)));

	$wp_customize->add_setting('interior_designs_submenu_menu_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'interior_designs_submenu_menu_color', array(
		'label'    => __('Submenu Color', 'interior-designs'),
		'section'  => 'interior_designs_header',
		'settings' => 'interior_designs_submenu_menu_color',
	)));

	//home page slider
	$wp_customize->add_section( 'interior_designs_slidersettings' , array(
    	'title'      => __( 'Slider Settings', 'interior-designs' ),
		'priority'   => 50,
		'panel' => 'interior_designs_panel_id'
	) );

	$wp_customize->selective_refresh->add_partial(
		'interior_designs_slider_arrows',
		array(
			'selector'        => '#slider .carousel-control-prev-icon',
			'render_callback' => 'interior_designs_customize_partial_interior_designs_slider_arrows',
		)
	);

	$wp_customize->add_setting('interior_designs_slider_arrows',array(
        'default' => false,
        'sanitize_callback'	=> 'interior_designs_sanitize_checkbox'
	));
	$wp_customize->add_control('interior_designs_slider_arrows',array(
		'type' => 'checkbox',
		'label' => __('Show / Hide slider','interior-designs'),
		'section' => 'interior_designs_slidersettings',
	));

	for ( $count = 1; $count <= 4; $count++ ) {
		$wp_customize->add_setting( 'interior_designs_slider_page' . $count, array(
			'default'           => '',
			'sanitize_callback' => 'interior_designs_sanitize_dropdown_pages'
		) );
		$wp_customize->add_control( 'interior_designs_slider_page' . $count, array(
			'label'    => __( 'Select Slide Image Page', 'interior-designs' ),
			'section'  => 'interior_designs_slidersettings',
			'type'     => 'dropdown-pages'
		) );
	}

	$wp_customize->add_setting( 'interior_designs_slider_speed', array(
		'default'  => 3000,
		'sanitize_callback'	=> 'interior_designs_sanitize_float'
	) );
	$wp_customize->add_control( 'interior_designs_slider_speed', array(
		'label' => esc_html__('Slider Speed','interior-designs'),
		'section' => 'interior_designs_slidersettings',
		'type'  => 'number',
		'input_attrs' => array(
			'step' => 500,
			'min' => 500,
			'max' => 5000,
		),
	) );
	$wp_customize->add_setting( 'interior_designs_slider_height', array(
		'default'  => ' ',
		'sanitize_callback'	=> 'interior_designs_sanitize_float'
	) );
	$wp_customize->add_control( 'interior_designs_slider_height', array(
		'label' => esc_html__('Slider Height','interior-designs'),
		'section' => 'interior_designs_slidersettings',
		'type'  => 'number',
		'input_attrs' => array(
			'step' => 5,
			'min' => 500,
			'max' => 1000,
		),
	) );

	$wp_customize->add_setting('interior_designs_home_slider_overlay',array(
       'default' => true,
       'sanitize_callback'	=> 'interior_designs_sanitize_checkbox'
    ));
    $wp_customize->add_control('interior_designs_home_slider_overlay',array(
       'type' => 'checkbox',
       'label' => __('Slider Overlay','interior-designs'),
		'description'    => __('This option will add colors over the slider.','interior-designs'),
       'section' => 'interior_designs_slidersettings'
    ));

    $wp_customize->add_setting('interior_designs_home_slider_overlay_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'interior_designs_home_slider_overlay_color', array(
		'label'    => __('Slider Overlay Color', 'interior-designs'),
		'section'  => 'interior_designs_slidersettings',
		'settings' => 'interior_designs_home_slider_overlay_color',
	)));

	//Opacity
	$wp_customize->add_setting('interior_designs_slider_opacity',array(
        'default'   => 0.9,
        'sanitize_callback' => 'interior_designs_sanitize_choices'
	));
	$wp_customize->add_control( 'interior_designs_slider_opacity', array(
		'label'       => esc_html__( 'Slider Image Opacity','interior-designs' ),
		'section'    => 'interior_designs_slidersettings',
		'type'        => 'select',
		'settings'   => 'interior_designs_slider_opacity',
		'choices' => array(
	      '0' =>  esc_attr('0','interior-designs'),
	      '0.1' =>  esc_attr('0.1','interior-designs'),
	      '0.2' =>  esc_attr('0.2','interior-designs'),
	      '0.3' =>  esc_attr('0.3','interior-designs'),
	      '0.4' =>  esc_attr('0.4','interior-designs'),
	      '0.5' =>  esc_attr('0.5','interior-designs'),
	      '0.6' =>  esc_attr('0.6','interior-designs'),
	      '0.7' =>  esc_attr('0.7','interior-designs'),
	      '0.8' =>  esc_attr('0.8','interior-designs'),
	      '0.9' =>  esc_attr('0.9','interior-designs')
	  ),
	));

	//Discover More
	$wp_customize->add_section('interior_designs_discover',array(
		'title'	=> __('Discover Section','interior-designs'),
		'description'	=> __('Add About sections below.','interior-designs'),
		'panel' => 'interior_designs_panel_id',
	));

	$wp_customize->selective_refresh->add_partial(
		'interior_designs_discover_post',
		array(
			'selector'        => '#discover h1',
			'render_callback' => 'interior_designs_customize_partial_interior_designs_discover_post',
		)
	);

	$args = array('numberposts' => -1);
	$post_list = get_posts($args);
	$i = 0;
	$posts[]= 'select';
	foreach($post_list as $post){
		$posts[$post->post_title] = $post->post_title;
	}

	$wp_customize->add_setting('interior_designs_discover_post',array(
		'sanitize_callback' => 'interior_designs_sanitize_choices',
	));
	$wp_customize->add_control('interior_designs_discover_post',array(
		'type'    => 'select',
		'choices' => $posts,
		'label' => __('Select post','interior-designs'),
		'section' => 'interior_designs_discover',
	));

	$wp_customize->add_setting( 'interior_designs_discover_button_text', array(
		'default'   => __('DISCOVER MORE','interior-designs' ),
		'sanitize_callback'	=> 'sanitize_text_field'
	) );
	$wp_customize->add_control( 'interior_designs_discover_button_text', array(
		'label'    => __( 'Post Button text','interior-designs' ),
		'section'  => 'interior_designs_discover',
		'type'     => 'text',
		'settings' => 'interior_designs_discover_button_text'
	) );

	//Services
	$wp_customize->add_section('interior_designs_services',array(
		'title'	=> __('Services Section','interior-designs'),
		'description'=> __('This section will appear below the slider.','interior-designs'),
		'panel' => 'interior_designs_panel_id',
	));	

	$wp_customize->selective_refresh->add_partial(
		'interior_designs_service_title',
		array(
			'selector'        => '#services h2',
			'render_callback' => 'interior_designs_customize_partial_interior_designs_service_title',
		)
	);
	
	$wp_customize->add_setting('interior_designs_service_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('interior_designs_service_title',array(
		'label'	=> __('Section Title','interior-designs'),
		'section'=> 'interior_designs_services',
		'setting'=> 'interior_designs_service_title',
		'type'=> 'text'
	));
	
	$wp_customize->add_setting('interior_designs_service_tag_line',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('interior_designs_service_tag_line',array(
		'label'	=> __('Section Sub-Title','interior-designs'),
		'section'=> 'interior_designs_services',
		'setting'=> 'interior_designs_service_tag_line',
		'type'=> 'text'
	));

	$categories = get_categories();
	$cats = array();
	$i = 0;
	$cats[]= 'select';
	foreach($categories as $category){
		if($i==0){
			$default = $category->slug;
			$i++;
		}
		$cats[$category->slug] = $category->name;
	}

	$wp_customize->add_setting('interior_designs_services_category',array(
		'default'	=> 'select',
		'sanitize_callback' => 'interior_designs_sanitize_choices',
	));
	$wp_customize->add_control('interior_designs_services_category',array(
		'type'    => 'select',
		'choices' => $cats,
		'label' => __('Select Category to display Latest Post','interior-designs'),
		'section' => 'interior_designs_services',
	));

	//Blog Post
	$wp_customize->add_section('interior_designs_blog_post',array(
		'title'	=> __('Post Settings','interior-designs'),
		'panel' => 'interior_designs_panel_id',
	));	

	$wp_customize->add_setting('interior_designs_date_hide',array(
       'default' => 'false',
       'sanitize_callback'	=> 'interior_designs_sanitize_checkbox'
    ));
    $wp_customize->add_control('interior_designs_date_hide',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Post Date','interior-designs'),
       'section' => 'interior_designs_blog_post'
    ));

    $wp_customize->add_setting('interior_designs_author_hide',array(
       'default' => 'false',
       'sanitize_callback'	=> 'interior_designs_sanitize_checkbox'
    ));
    $wp_customize->add_control('interior_designs_author_hide',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Post Author','interior-designs'),
       'section' => 'interior_designs_blog_post'
    ));

    $wp_customize->add_setting('interior_designs_comment_hide',array(
       'default' => 'false',
       'sanitize_callback'	=> 'interior_designs_sanitize_checkbox'
    ));
    $wp_customize->add_control('interior_designs_comment_hide',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Post Comments','interior-designs'),
       'section' => 'interior_designs_blog_post'
    ));

    $wp_customize->add_setting('interior_designs_time_hide',array(
       'default' => false,
       'sanitize_callback'	=> 'interior_designs_sanitize_checkbox'
    ));
    $wp_customize->add_control('interior_designs_time_hide',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Post Time','interior-designs'),
       'section' => 'interior_designs_blog_post'
    ));

    $wp_customize->add_setting('interior_designs_feature_image_hide',array(
       'default' => true,
       'sanitize_callback'	=> 'interior_designs_sanitize_checkbox'
    ));
    $wp_customize->add_control('interior_designs_feature_image_hide',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Featured Image','interior-designs'),
       'section' => 'interior_designs_blog_post'
    ));

    $wp_customize->add_setting( 'interior_designs_featured_image_border_radius', array(
		'default' => 0,
		'sanitize_callback'	=> 'interior_designs_sanitize_float'
	) );
	$wp_customize->add_control( 'interior_designs_featured_image_border_radius', array(
		'label' => __( 'Featured image border radius','interior-designs' ),
		'section' => 'interior_designs_blog_post',
		'type'  => 'number',
		'input_attrs' => array(
			'step' => 1,
			'min'  => 0,
			'max'  => 50,
		),
	) );

    $wp_customize->add_setting( 'interior_designs_featured_image_box_shadow', array(
		'default' => 0,
		'sanitize_callback'	=> 'interior_designs_sanitize_float'
	) );
	$wp_customize->add_control( 'interior_designs_featured_image_box_shadow', array(
		'label' => __( 'Featured image box shadow','interior-designs' ),
		'section' => 'interior_designs_blog_post',
		'type'  => 'number',
		'input_attrs' => array(
			'step' => 1,
			'min'  => 0,
			'max'  => 50,
		),
	) );

    $wp_customize->add_setting('interior_designs_post_content',array(
    	'default' => 'Excerpt Content',
        'sanitize_callback' => 'interior_designs_sanitize_choices'
	));
	$wp_customize->add_control('interior_designs_post_content',array(
        'type' => 'radio',
        'label' => __('Post Content Type','interior-designs'),
        'section' => 'interior_designs_blog_post',
        'choices' => array(
            'No Content' => __('No Content','interior-designs'),
            'Full Content' => __('Full Content','interior-designs'),
            'Excerpt Content' => __('Excerpt Content','interior-designs'),
        ),
	) );

    $wp_customize->add_setting( 'interior_designs_post_excerpt_length', array(
		'default'              => 20,
		'sanitize_callback'	=> 'interior_designs_sanitize_float'
	) );
	$wp_customize->add_control( 'interior_designs_post_excerpt_length', array(
		'label' => esc_html__( 'Post Excerpt Length','interior-designs' ),
		'section'  => 'interior_designs_blog_post',
		'type'  => 'number',
		'settings' => 'interior_designs_post_excerpt_length',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 0,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting( 'interior_designs_button_excerpt_suffix', array(
		'default'   => '[...]',
		'sanitize_callback'	=> 'sanitize_text_field'
	) );
	$wp_customize->add_control( 'interior_designs_button_excerpt_suffix', array(
		'label'       => esc_html__( 'Excerpt Suffix','interior-designs' ),
		'section'     => 'interior_designs_blog_post',
		'type'        => 'text',
		'settings' => 'interior_designs_button_excerpt_suffix'
	) );

	$wp_customize->add_setting( 'interior_designs_post_button_text', array(
		'default'   => __('Read More','interior-designs' ),
		'sanitize_callback'	=> 'sanitize_text_field'
	) );
	$wp_customize->add_control( 'interior_designs_post_button_text', array(
		'label' => esc_html__('Post Button Text','interior-designs' ),
		'section'     => 'interior_designs_blog_post',
		'type'        => 'text',
		'settings'    => 'interior_designs_post_button_text'
	) );

	$wp_customize->add_setting('interior_designs_top_button_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'interior_designs_sanitize_float'
	));
	$wp_customize->add_control('interior_designs_top_button_padding',array(
		'label'	=> __('Top Bottom Button Padding','interior-designs'),
		'input_attrs' => array(
            'step' => 1,
			'min'  => 0,
			'max'  => 50,
        ),
		'section'=> 'interior_designs_blog_post',
		'type'=> 'number',
	));

	$wp_customize->add_setting('interior_designs_left_button_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'interior_designs_sanitize_float'
	));
	$wp_customize->add_control('interior_designs_left_button_padding',array(
		'label'	=> __('Left Right Button Padding','interior-designs'),
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 50,
        ),
		'section'=> 'interior_designs_blog_post',
		'type'=> 'number',
	));

	$wp_customize->add_setting( 'interior_designs_button_border_radius', array(
		'default'=> '0',
		'sanitize_callback'	=> 'interior_designs_sanitize_float'
	) );
	$wp_customize->add_control('interior_designs_button_border_radius', array(
        'label'  => __('Button Border Radius','interior-designs'),
        'type'=> 'number',
        'section'  => 'interior_designs_blog_post',
        'input_attrs' => array(
        	'step' => 1,
            'min' => 0,
            'max' => 50,
        ),
    ));

	$wp_customize->add_setting( 'interior_designs_post_blocks', array(
        'default'			=> 'Within box',
        'sanitize_callback'	=> 'interior_designs_sanitize_choices'
    ));
    $wp_customize->add_control( 'interior_designs_post_blocks', array(
        'section' => 'interior_designs_blog_post',
        'type' => 'select',
        'label' => __( 'Post blocks', 'interior-designs' ),
        'choices' => array(
            'Within box'  => __( 'Within box', 'interior-designs' ),
            'Without box' => __( 'Without box', 'interior-designs' ),
    )));

    $wp_customize->add_setting('interior_designs_navigation_hide',array(
       'default' => true,
       'sanitize_callback'	=> 'interior_designs_sanitize_checkbox'
    ));
    $wp_customize->add_control('interior_designs_navigation_hide',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Post Navigation','interior-designs'),
       'section' => 'interior_designs_blog_post'
    ));

    $wp_customize->add_setting( 'interior_designs_post_navigation_type', array(
        'default'			=> 'numbers',
        'sanitize_callback'	=> 'interior_designs_sanitize_choices'
    ));
    $wp_customize->add_control( 'interior_designs_post_navigation_type', array(
        'section' => 'interior_designs_blog_post',
        'type' => 'select',
        'label' => __( 'Post Navigation Type', 'interior-designs' ),
        'choices'		=> array(
            'numbers'  => __( 'Number', 'interior-designs' ),
            'next-prev' => __( 'Next/Prev Button', 'interior-designs' ),
    )));

    $wp_customize->add_setting( 'interior_designs_post_navigation_position', array(
        'default'			=> 'bottom',
        'sanitize_callback'	=> 'interior_designs_sanitize_choices'
    ));
    $wp_customize->add_control( 'interior_designs_post_navigation_position', array(
        'section' => 'interior_designs_blog_post',
        'type' => 'select',
        'label' => __( 'Post Navigation Position', 'interior-designs' ),
        'choices' => array(
            'top'  => __( 'Top', 'interior-designs' ),
            'bottom' => __( 'Bottom', 'interior-designs' ),
            'both' => __( 'Both', 'interior-designs' ),
    )));

    //Single Post Settings
	$wp_customize->add_section('interior_designs_single_post',array(
		'title'	=> __('Single Post Settings','interior-designs'),
		'panel' => 'interior_designs_panel_id',
	));	

	$wp_customize->add_setting('interior_designs_feature_image',array(
       'default' => true,
       'sanitize_callback'	=> 'interior_designs_sanitize_checkbox'
    ));
    $wp_customize->add_control('interior_designs_feature_image',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Feature Image','interior-designs'),
       'section' => 'interior_designs_single_post'
    ));

    $wp_customize->add_setting('interior_designs_single_post_date',array(
       'default' => 'true',
       'sanitize_callback'	=> 'interior_designs_sanitize_checkbox'
    ));
    $wp_customize->add_control('interior_designs_single_post_date',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Single Post Date','interior-designs'),
       'section' => 'interior_designs_single_post'
    ));

    $wp_customize->add_setting('interior_designs_single_post_comment_no',array(
       'default' => 'true',
       'sanitize_callback'	=> 'interior_designs_sanitize_checkbox'
    ));
    $wp_customize->add_control('interior_designs_single_post_comment_no',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Single Post Comment Number','interior-designs'),
       'section' => 'interior_designs_single_post'
    ));

    $wp_customize->add_setting('interior_designs_single_post_time_hide',array(
       'default' => false,
       'sanitize_callback'	=> 'interior_designs_sanitize_checkbox'
    ));
    $wp_customize->add_control('interior_designs_single_post_time_hide',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Single Post Time','interior-designs'),
       'section' => 'interior_designs_single_post'
    ));

     $wp_customize->add_setting('interior_designs_single_post_author',array(
       'default' => 'true',
       'sanitize_callback'	=> 'interior_designs_sanitize_checkbox'
    ));
    $wp_customize->add_control('interior_designs_single_post_author',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Post Single Post Author','interior-designs'),
       'section' => 'interior_designs_single_post'
    ));

    $wp_customize->add_setting('interior_designs_tags',array(
       'default' => true,
       'sanitize_callback'	=> 'interior_designs_sanitize_checkbox'
    ));
    $wp_customize->add_control('interior_designs_tags',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Tags','interior-designs'),
       'section' => 'interior_designs_single_post'
    ));

    $wp_customize->add_setting('interior_designs_comment',array(
       'default' => true,
       'sanitize_callback'	=> 'interior_designs_sanitize_checkbox'
    ));
    $wp_customize->add_control('interior_designs_comment',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Comment','interior-designs'),
       'section' => 'interior_designs_single_post'
    ));
    
     $wp_customize->add_setting('interior_designs_show_hide_single_post_categories',array(
		'default' => true,
		'sanitize_callback'	=> 'interior_designs_sanitize_checkbox'
 	));
 	$wp_customize->add_control('interior_designs_show_hide_single_post_categories',array(
		'type' => 'checkbox',
		'label' => __('Single Post Categories','interior-designs'),
		'section' => 'interior_designs_single_post'
	));

	$wp_customize->add_setting( 'interior_designs_single_post_breadcrumb',array(
		'default' => true,
		'transport' => 'refresh',
      	'sanitize_callback'	=> 'interior_designs_sanitize_checkbox'
    ) );
    $wp_customize->add_control('interior_designs_single_post_breadcrumb',array(
    	'type' => 'checkbox',
        'label' => __( 'Show / Hide Single Post Breadcrumb','interior-designs' ),
        'section' => 'interior_designs_single_post'
    ));

    $wp_customize->add_setting( 'interior_designs_comment_width', array(
		'default' => 100,
		'sanitize_callback'	=> 'interior_designs_sanitize_float'
	) );
	$wp_customize->add_control( 'interior_designs_comment_width', array(
		'label' => __( 'Comment Textarea Width', 'interior-designs'),
		'section' => 'interior_designs_single_post',
		'type' => 'number',
		'settings' => 'interior_designs_comment_width',
		'input_attrs' => array(
			'step' => 1,
			'min' => 0,
			'max' => 100,
		),
	) );

    $wp_customize->add_setting('interior_designs_comment_title',array(
       'default' => __('Leave a Reply','interior-designs' ),
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('interior_designs_comment_title',array(
       'type' => 'text',
       'label' => __('Comment form Title','interior-designs'),
       'section' => 'interior_designs_single_post'
    ));

    $wp_customize->add_setting('interior_designs_comment_submit_text',array(
       'default' => __('Post Comment','interior-designs' ),
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('interior_designs_comment_submit_text',array(
       'type' => 'text',
       'label' => __('Comment Button Text','interior-designs'),
       'section' => 'interior_designs_single_post'
    ));

    $wp_customize->add_setting('interior_designs_nav_links',array(
       'default' => true,
       'sanitize_callback'	=> 'interior_designs_sanitize_checkbox'
    ));
    $wp_customize->add_control('interior_designs_nav_links',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Nav Links','interior-designs'),
       'section' => 'interior_designs_single_post'
    ));

    $wp_customize->add_setting('interior_designs_prev_text',array(
       'default' => '',
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('interior_designs_prev_text',array(
       'type' => 'text',
       'label' => __('Previous Navigation Text','interior-designs'),
       'section' => 'interior_designs_single_post'
    ));

    $wp_customize->add_setting('interior_designs_next_text',array(
       'default' => '',
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('interior_designs_next_text',array(
       'type' => 'text',
       'label' => __('Next Navigation Text','interior-designs'),
       'section' => 'interior_designs_single_post'
    ));

    $wp_customize->add_setting('interior_designs_related_posts',array(
       'default' => true,
       'sanitize_callback'	=> 'interior_designs_sanitize_checkbox'
    ));
    $wp_customize->add_control('interior_designs_related_posts',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Related Posts','interior-designs'),
       'section' => 'interior_designs_single_post'
    ));

    $wp_customize->add_setting('interior_designs_related_posts_title',array(
       'default' => '',
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('interior_designs_related_posts_title',array(
       'type' => 'text',
       'label' => __('Related Posts Title','interior-designs'),
       'section' => 'interior_designs_single_post'
    ));

    $wp_customize->add_setting( 'interior_designs_related_post_count', array(
		'default' => 3,
		'sanitize_callback'	=> 'interior_designs_sanitize_float'
	) );
	$wp_customize->add_control( 'interior_designs_related_post_count', array(
		'label' => esc_html__( 'Related Posts Count','interior-designs' ),
		'section' => 'interior_designs_single_post',
		'type' => 'number',
		'settings' => 'interior_designs_related_post_count',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 0,
			'max'              => 6,
		),
	) );

    $wp_customize->add_setting( 'interior_designs_post_order', array(
        'default' => 'categories',
        'sanitize_callback'	=> 'interior_designs_sanitize_choices'
    ));
    $wp_customize->add_control( 'interior_designs_post_order', array(
        'section' => 'interior_designs_single_post',
        'type' => 'radio',
        'label' => __( 'Related Posts Order By', 'interior-designs' ),
        'choices' => array(
            'categories'  => __('Categories', 'interior-designs'),
            'tags' => __( 'Tags', 'interior-designs' ),
    )));

    //404 page settings
	$wp_customize->add_section('interior_designs_404_page',array(
		'title'	=> __('404 & No Result Page Settings','interior-designs'),
		'priority'	=> null,
		'panel' => 'interior_designs_panel_id',
	));

	$wp_customize->add_setting('interior_designs_404_title',array(
       'default' => '',
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('interior_designs_404_title',array(
       'type' => 'text',
       'label' => __('404 Page Title','interior-designs'),
       'section' => 'interior_designs_404_page'
    ));

    $wp_customize->add_setting('interior_designs_404_text',array(
       'default' => '',
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('interior_designs_404_text',array(
       'type' => 'text',
       'label' => __('404 Page Text','interior-designs'),
       'section' => 'interior_designs_404_page'
    ));

    $wp_customize->add_setting('interior_designs_404_button_text',array(
       'default' => '',
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('interior_designs_404_button_text',array(
       'type' => 'text',
       'label' => __('404 Page Button Text','interior-designs'),
       'section' => 'interior_designs_404_page'
    ));

    $wp_customize->add_setting('interior_designs_no_result_title',array(
       'default' => '',
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('interior_designs_no_result_title',array(
       'type' => 'text',
       'label' => __('No Result Page Title','interior-designs'),
       'section' => 'interior_designs_404_page'
    ));

    $wp_customize->add_setting('interior_designs_no_result_text',array(
       'default' => '',
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('interior_designs_no_result_text',array(
       'type' => 'text',
       'label' => __('No Result Page Text','interior-designs'),
       'section' => 'interior_designs_404_page'
    ));

    $wp_customize->add_setting('interior_designs_show_search_form',array(
        'default' => true,
        'sanitize_callback'	=> 'interior_designs_sanitize_checkbox'
	));
	$wp_customize->add_control('interior_designs_show_search_form',array(
     	'type' => 'checkbox',
      	'label' => __('Show/Hide Search Form','interior-designs'),
      	'section' => 'interior_designs_404_page',
	));

	//Footer
	$wp_customize->add_section('interior_designs_footer_section',array(
		'title'	=> __('Footer Section','interior-designs'),
		'description'	=> '',
		'priority'	=> null,
		'panel' => 'interior_designs_panel_id',
	));

	$wp_customize->selective_refresh->add_partial(
		'interior_designs_show_back_to_top',
		array(
			'selector'        => '.scrollup',
			'render_callback' => 'interior_designs_customize_partial_interior_designs_show_back_to_top',
		)
	);

	$wp_customize->add_setting('interior_designs_show_back_to_top',array(
        'default' => 'true',
        'sanitize_callback'	=> 'interior_designs_sanitize_checkbox'
	));
	$wp_customize->add_control('interior_designs_show_back_to_top',array(
     	'type' => 'checkbox',
      	'label' => __('Show/Hide Back to Top Button','interior-designs'),
      	'section' => 'interior_designs_footer_section',
	));

	$wp_customize->add_setting('interior_designs_back_to_top_icon',array(
		'default'	=> 'fas fa-arrow-up',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new interior_designs_Icon_Changer(
        $wp_customize, 'interior_designs_back_to_top_icon',array(
		'label'	=> __('Back to Top Icon','interior-designs'),
		'section'	=> 'interior_designs_footer_section',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('interior_designs_back_to_top_text',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field',
	));	
	$wp_customize->add_control('interior_designs_back_to_top_text',array(
		'label'	=> __('Back to Top Button Text','interior-designs'),
		'section'	=> 'interior_designs_footer_section',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('interior_designs_back_to_top_alignment',array(
        'default' => 'Right',
        'sanitize_callback' => 'interior_designs_sanitize_choices'
	));
	$wp_customize->add_control('interior_designs_back_to_top_alignment',array(
        'type' => 'select',
        'label' => __('Back to Top Button Alignment','interior-designs'),
        'section' => 'interior_designs_footer_section',
        'choices' => array(
            'Left' => __('Left','interior-designs'),
            'Right' => __('Right','interior-designs'),
            'Center' => __('Center','interior-designs'),
        ),
	) );

	$wp_customize->add_setting('interior_designs_footer_background_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'interior_designs_footer_background_color', array(
		'label'    => __('Footer Background Color', 'interior-designs'),
		'section'  => 'interior_designs_footer_section',
	)));

	$wp_customize->add_setting('interior_designs_footer_background_img',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'interior_designs_footer_background_img',array(
        'label' => __('Footer Background Image','interior-designs'),
        'section' => 'interior_designs_footer_section'
	)));

	$wp_customize->add_setting('interior_designs_footer_widget_layout',array(
        'default'           => '4',
        'sanitize_callback' => 'interior_designs_sanitize_choices',
    ));
    $wp_customize->add_control('interior_designs_footer_widget_layout',array(
        'type'        => 'radio',
        'label'       => __('Footer widget layout', 'interior-designs'),
        'section'     => 'interior_designs_footer_section',
        'description' => __('Select the number of widget areas you want in the footer. After that, go to Appearance > Widgets and add your widgets.', 'interior-designs'),
        'choices' => array(
            '1'     => __('One', 'interior-designs'),
            '2'     => __('Two', 'interior-designs'),
            '3'     => __('Three', 'interior-designs'),
            '4'     => __('Four', 'interior-designs')
        ),
    ));

    $wp_customize->add_setting('interior_designs_copyright_alignment',array(
        'default' => 'Center',
        'sanitize_callback' => 'interior_designs_sanitize_choices'
	));
	$wp_customize->add_control('interior_designs_copyright_alignment',array(
        'type' => 'select',
        'label' => __('Copyright Alignment','interior-designs'),
        'section' => 'interior_designs_footer_section',
        'choices' => array(
            'Left' => __('Left','interior-designs'),
            'Right' => __('Right','interior-designs'),
            'Center' => __('Center','interior-designs'),
        ),
	) );

	$wp_customize->add_setting('interior_designs_copyright_fontsize',array(
		'default'	=> 16,
		'sanitize_callback'	=> 'interior_designs_sanitize_float',
	));	
	$wp_customize->add_control('interior_designs_copyright_fontsize',array(
		'label'	=> __('Copyright Font Size','interior-designs'),
		'section'	=> 'interior_designs_footer_section',
		'type'		=> 'number'
	));

	$wp_customize->add_setting('interior_designs_copyright_top_bottom_padding',array(
		'default'	=> 15,
		'sanitize_callback'	=> 'interior_designs_sanitize_float',
	));	
	$wp_customize->add_control('interior_designs_copyright_top_bottom_padding',array(
		'label'	=> __('Copyright Top Bottom Padding','interior-designs'),
		'section'	=> 'interior_designs_footer_section',
		'type'		=> 'number'
	));

    $wp_customize->selective_refresh->add_partial(
		'interior_designs_footer_copy',
		array(
			'selector'        => '#footer p',
			'render_callback' => 'interior_designs_customize_partial_interior_designs_footer_copy',
		)
	);
	
	$wp_customize->add_setting('interior_designs_footer_copy',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field',
	));	
	$wp_customize->add_control('interior_designs_footer_copy',array(
		'label'	=> __('Copyright Text','interior-designs'),
		'section'	=> 'interior_designs_footer_section',
		'type'		=> 'text'
	));
    
    $wp_customize->add_setting('interior_designs_copyright_background_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'interior_designs_copyright_background_color', array(
		'label'    => __('Copyright Background Color', 'interior-designs'),
		'section'  => 'interior_designs_footer_section',
	)));

	//Mobile Media Section
	$wp_customize->add_section( 'interior_designs_mobile_media_options' , array(
    	'title'      => __( 'Mobile Media Options', 'interior-designs' ),
		'priority'   => null,
		'panel' => 'interior_designs_panel_id'
	) );

	$wp_customize->add_setting('interior_designs_responsive_open_menu_icon',array(
		'default'	=> 'fas fa-bars',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Interior_Designs_Icon_Changer(
        $wp_customize, 'interior_designs_responsive_open_menu_icon',array(
		'label'	=> __('Open Menu Icon','interior-designs'),
		'section'	=> 'interior_designs_mobile_media_options',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('interior_designs_responsive_close_menu_icon',array(
		'default'	=> 'fas fa-times',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Interior_Designs_Icon_Changer(
        $wp_customize, 'interior_designs_responsive_close_menu_icon',array(
		'label'	=> __('Close Menu Icon','interior-designs'),
		'section'	=> 'interior_designs_mobile_media_options',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting( 'interior_designs_responsive_topbar_hide',array(
		'default' => false,
      	'sanitize_callback'	=> 'interior_designs_sanitize_checkbox'
    ) );
    $wp_customize->add_control('interior_designs_responsive_topbar_hide',array(
    	'type' => 'checkbox',
        'label' => __( 'Show / Hide Topbar','interior-designs' ),
        'section' => 'interior_designs_mobile_media_options'
    ));

    $wp_customize->add_setting('interior_designs_mobile_media_slider',array(
       'default' => false,
       'sanitize_callback'	=> 'interior_designs_sanitize_checkbox'
    ));
    $wp_customize->add_control('interior_designs_mobile_media_slider',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Slider','interior-designs'),
       'section' => 'interior_designs_mobile_media_options'
    ));

    $wp_customize->add_setting('interior_designs_responsive_show_back_to_top',array(
        'default' => true,
        'sanitize_callback'	=> 'interior_designs_sanitize_checkbox'
	));
	$wp_customize->add_control('interior_designs_responsive_show_back_to_top',array(
     	'type' => 'checkbox',
      	'label' => __('Show / Hide Back to Top Button','interior-designs'),
      	'section' => 'interior_designs_mobile_media_options',
	));

	 $wp_customize->add_setting( 'interior_designs_responsive_sticky_header',array(
		'default' => false,
      	'sanitize_callback'	=> 'interior_designs_sanitize_checkbox'
    ) );
    $wp_customize->add_control('interior_designs_responsive_sticky_header',array(
    	'type' => 'checkbox',
        'label' => __( 'Show / Hide Sticky header','interior-designs' ),
        'section' => 'interior_designs_mobile_media_options'
    ));

	//Woocommerce Section
	$wp_customize->add_section( 'interior_designs_woocommerce_options' , array(
    	'title'      => __( 'Additional WooCommerce Options', 'interior-designs' ),
		'priority'   => null,
		'panel' => 'interior_designs_panel_id'
	) );

	// Product Columns
	$wp_customize->add_setting( 'interior_designs_products_per_row' , array(
		'default'           => '3',
		'transport'         => 'refresh',
		'sanitize_callback' => 'interior_designs_sanitize_choices',
	) );

	$wp_customize->add_control('interior_designs_products_per_row', array(
		'label' => __( 'Product per row', 'interior-designs' ),
		'section'  => 'interior_designs_woocommerce_options',
		'type'     => 'select',
		'choices'  => array(
			'2' => '2',
			'3' => '3',
			'4' => '4',
		),
	) );

	$wp_customize->add_setting('interior_designs_product_per_page',array(
		'default'	=> '9',
		'sanitize_callback'	=> 'interior_designs_sanitize_float'
	));	
	$wp_customize->add_control('interior_designs_product_per_page',array(
		'label'	=> __('Product per page','interior-designs'),
		'section'	=> 'interior_designs_woocommerce_options',
		'type'		=> 'number'
	));

	$wp_customize->add_setting('interior_designs_shop_sidebar',array(
       'default' => true,
       'sanitize_callback'	=> 'interior_designs_sanitize_checkbox'
    ));
    $wp_customize->add_control('interior_designs_shop_sidebar',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Shop page sidebar','interior-designs'),
       'section' => 'interior_designs_woocommerce_options',
    ));

    // shop page sidebar alignment
    $wp_customize->add_setting('interior_designs_shop_page_layout', array(
		'default'           => 'Right Sidebar',
		'sanitize_callback' => 'interior_designs_sanitize_choices',
	));
	$wp_customize->add_control('interior_designs_shop_page_layout',array(
		'type'           => 'radio',
		'label'          => __('Shop Page layout', 'interior-designs'),
		'section'        => 'interior_designs_woocommerce_options',
		'choices'        => array(
			'Left Sidebar'  => __('Left Sidebar', 'interior-designs'),
			'Right Sidebar' => __('Right Sidebar', 'interior-designs'),
		),
	));

	$wp_customize->add_setting( 'interior_designs_wocommerce_single_page_sidebar',array(
		'default' => true,
		'sanitize_callback'	=> 'interior_designs_sanitize_checkbox'
    ) );
    $wp_customize->add_control('interior_designs_wocommerce_single_page_sidebar',array(
    	'type' => 'checkbox',
       	'label' => __('Enable / Disable Single Product Page Sidebar','interior-designs'),
		'section' => 'interior_designs_woocommerce_options'
    ));

    // single product page sidebar alignment
    $wp_customize->add_setting('interior_designs_single_product_page_layout', array(
		'default'           => 'Right Sidebar',
		'sanitize_callback' => 'interior_designs_sanitize_choices',
	));
	$wp_customize->add_control('interior_designs_single_product_page_layout',array(
		'type'           => 'radio',
		'label'          => __('Single product Page layout', 'interior-designs'),
		'section'        => 'interior_designs_woocommerce_options',
		'choices'        => array(
			'Left Sidebar'  => __('Left Sidebar', 'interior-designs'),
			'Right Sidebar' => __('Right Sidebar', 'interior-designs'),
		),
	));

	$wp_customize->add_setting('interior_designs_shop_page_pagination',array(
		'default' => true,
		'sanitize_callback'	=> 'interior_designs_sanitize_checkbox'
	 ));
	 $wp_customize->add_control('interior_designs_shop_page_pagination',array(
		'type' => 'checkbox',
		'label' => __('Enable / Disable Shop page pagination','interior-designs'),
		'section' => 'interior_designs_woocommerce_options',
	 ));

    $wp_customize->add_setting('interior_designs_product_page_sidebar',array(
       'default' => true,
       'sanitize_callback'	=> 'interior_designs_sanitize_checkbox'
    ));
    $wp_customize->add_control('interior_designs_product_page_sidebar',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Product page sidebar','interior-designs'),
       'section' => 'interior_designs_woocommerce_options',
    ));

    $wp_customize->add_setting('interior_designs_related_product',array(
       'default' => true,
       'sanitize_callback'	=> 'interior_designs_sanitize_checkbox'
    ));
    $wp_customize->add_control('interior_designs_related_product',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Related product','interior-designs'),
       'section' => 'interior_designs_woocommerce_options',
    ));

	$wp_customize->add_setting( 'interior_designs_woocommerce_button_padding_top',array(
		'default' => 10,
		'sanitize_callback' => 'interior_designs_sanitize_float'
	));
	$wp_customize->add_control( 'interior_designs_woocommerce_button_padding_top',	array(
		'label' => esc_html__( 'Button Top Bottom Padding','interior-designs' ),
		'type' => 'number',
		'section' => 'interior_designs_woocommerce_options',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	));

	$wp_customize->add_setting( 'interior_designs_woocommerce_button_padding_right',array(
	 	'default' => 20,
	 	'sanitize_callback' => 'interior_designs_sanitize_float'
	));
	$wp_customize->add_control('interior_designs_woocommerce_button_padding_right',	array(
	 	'label' => esc_html__( 'Button Right Left Padding','interior-designs' ),
		'type' => 'number',
		'section' => 'interior_designs_woocommerce_options',
	 	'input_attrs' => array(
			'min' => 0,
			'max' => 50,
	 		'step' => 1,
		),
	));

	$wp_customize->add_setting( 'interior_designs_woocommerce_button_border_radius',array(
		'default' => 0,
		'sanitize_callback' => 'interior_designs_sanitize_float'
	));
	$wp_customize->add_control('interior_designs_woocommerce_button_border_radius',array(
		'label' => esc_html__( 'Button Border Radius','interior-designs' ),
		'type' => 'number',
		'section' => 'interior_designs_woocommerce_options',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	));

    $wp_customize->add_setting('interior_designs_woocommerce_product_border',array(
       'default' => true,
       'sanitize_callback'	=> 'interior_designs_sanitize_checkbox'
    ));
    $wp_customize->add_control('interior_designs_woocommerce_product_border',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable product border','interior-designs'),
       'section' => 'interior_designs_woocommerce_options',
    ));

	$wp_customize->add_setting( 'interior_designs_woocommerce_product_padding_top',array(
		'default' => 10,
		'sanitize_callback' => 'interior_designs_sanitize_float'
	));
	$wp_customize->add_control('interior_designs_woocommerce_product_padding_top', array(
		'label' => esc_html__( 'Product Top Bottom Padding','interior-designs' ),
		'type' => 'number',
		'section' => 'interior_designs_woocommerce_options',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	));

	$wp_customize->add_setting( 'interior_designs_woocommerce_product_padding_right',array(
		'default' => 10,
		'sanitize_callback' => 'interior_designs_sanitize_float'
	));
	$wp_customize->add_control('interior_designs_woocommerce_product_padding_right', array(
		'label' => esc_html__( 'Product Right Left Padding','interior-designs' ),
		'type' => 'number',
		'section' => 'interior_designs_woocommerce_options',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	));

	$wp_customize->add_setting( 'interior_designs_woocommerce_product_border_radius',array(
		'default' => 0,
		'sanitize_callback' => 'interior_designs_sanitize_float'
	));
	$wp_customize->add_control('interior_designs_woocommerce_product_border_radius',array(
		'label' => esc_html__( 'Product Border Radius','interior-designs' ),
		'type' => 'number',
		'section' => 'interior_designs_woocommerce_options',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	));

	$wp_customize->add_setting( 'interior_designs_woocommerce_product_box_shadow',array(
		'default' => 0,
		'sanitize_callback' => 'interior_designs_sanitize_float'
	));
	$wp_customize->add_control( 'interior_designs_woocommerce_product_box_shadow',array(
		'label' => esc_html__( 'Product Box Shadow','interior-designs' ),
		'type' => 'number',
		'section' => 'interior_designs_woocommerce_options',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	));

	$wp_customize->add_setting('interior_designs_sale_position',array(
        'default' => 'right',
        'sanitize_callback' => 'interior_designs_sanitize_choices'
	));
	$wp_customize->add_control('interior_designs_sale_position',array(
        'type' => 'select',
        'label' => __('Sale badge Position','interior-designs'),
        'section' => 'interior_designs_woocommerce_options',
        'choices' => array(
            'left' => __('Left','interior-designs'),
            'right' => __('Right','interior-designs'),
        ),
	) );

	$wp_customize->add_setting( 'interior_designs_woocommerce_sale_top_padding',array(
		'default' => 0,
		'sanitize_callback' => 'interior_designs_sanitize_float'
	));
	$wp_customize->add_control( 'interior_designs_woocommerce_sale_top_padding',	array(
		'label' => esc_html__( 'Sale Top Bottom Padding','interior-designs' ),
		'type' => 'number',
		'section' => 'interior_designs_woocommerce_options',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	));

	$wp_customize->add_setting( 'interior_designs_woocommerce_sale_left_padding',array(
	 	'default' => 0,
	 	'sanitize_callback' => 'interior_designs_sanitize_float'
	));
	$wp_customize->add_control('interior_designs_woocommerce_sale_left_padding',	array(
	 	'label' => esc_html__( 'Sale Right Left Padding','interior-designs' ),
		'type' => 'number',
		'section' => 'interior_designs_woocommerce_options',
	 	'input_attrs' => array(
			'min' => 0,
			'max' => 50,
	 		'step' => 1,
		),
	));

	$wp_customize->add_setting( 'interior_designs_woocommerce_sale_border_radius',array(
		'default' => 50,
		'sanitize_callback' => 'interior_designs_sanitize_float'
	));
	$wp_customize->add_control('interior_designs_woocommerce_sale_border_radius',array(
		'label' => esc_html__( 'Sale Border Radius','interior-designs' ),
		'type' => 'number',
		'section' => 'interior_designs_woocommerce_options',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	));

	$wp_customize->add_setting( 'interior_designs_product_sale_font_size',array(
		'default' => 15,
		'sanitize_callback' => 'interior_designs_sanitize_float'
	));
	$wp_customize->add_control('interior_designs_product_sale_font_size',array(
		'label' => esc_html__( 'Sale Font Size','interior-designs' ),
		'type' => 'number',
		'section' => 'interior_designs_woocommerce_options',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	));
}
add_action( 'customize_register', 'interior_designs_customize_register' );

// logo resize
load_template( trailingslashit( get_template_directory() ) . '/inc/logo/logo-width.php' );


/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Interior_Designs_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . '/inc/section-pro.php' );
		
		// Register custom section types.
		$manager->register_section_type( 'Interior_Designs_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new Interior_Designs_Customize_Section_Pro(
				$manager,
				'interior_designs_example_1',
				array(
					'priority'   => 9,
					'title'    => esc_html__( 'Interior Pro Theme', 'interior-designs' ),
					'pro_text' => esc_html__( 'Go Pro', 'interior-designs' ),
					'pro_url'  => esc_url( 'https://www.themescaliber.com/themes/interior-design-wordpress-theme/' ),
				)
			)
		);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'interior-designs-customize-controls', trailingslashit( esc_url(get_template_directory_uri()) ) . '/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'interior-designs-customize-controls', trailingslashit( esc_url(get_template_directory_uri()) ) . '/css/customize-controls.css' );
	}
}

// Doing this customizer thang!
Interior_Designs_Customize::get_instance();