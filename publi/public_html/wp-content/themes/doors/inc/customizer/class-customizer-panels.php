<?php

class Doors_Customizer_Panels {

	public function __construct() {
		$this->priority = new Doors_Customizer_Priority( 0, 10 );

		add_action( 'customize_register', array( $this, 'register_panels' ), 9 );
		//  add_action( 'customize_register', array( $this, 'organize_appearance' ), 11 );
	}

	public function panel_list() {
		$this->panels = array();


		$this->panels['doors_options'] = array(
			'title'    => __( 'Doors options', 'doors' ),
			'sections' => array(
				'doors_general'       => array(
					'title' => __( 'General Settings', 'doors' ),
				),
				'doors_top_header'    => array(
					'title' => __( 'Top Header Settings', 'doors' ),
				),
				'doors_colors'        => array(
					'title' => __( 'Colors Settings', 'doors' ),
				),
				'doors_custom_css_js' => array(
					'title' => __( 'Custom CSS & JS', 'doors' ),
				),
				'doors_footer'        => array(
					'title' => __( 'Footer Settings', 'doors' ),
				)
			)
		);


		return $this->panels;
	}

	public function register_panels( $wp_customize ) {
		$panels = $this->panel_list();

		foreach ( $panels as $key => $panel ) {
			$defaults = array(
				'priority' => $this->priority->next()
			);

			$panel = wp_parse_args( $defaults, $panel );

			$wp_customize->add_panel( $key, $panel );

			$sections = isset( $panel['sections'] ) ? $panel['sections'] : false;

			if ( $sections ) {
				$this->add_sections( $key, $sections, $wp_customize );
			}
		}
	}

	public function add_sections( $panel, $sections, $wp_customize ) {
		foreach ( $sections as $key => $section ) {
			$wp_customize->add_section( $key, array(
				'title'       => $section['title'],
				'panel'       => $panel,
				'priority'    => isset( $section['priority'] ) ? $section['priority'] : $this->priority->next(),
				'description' => isset( $section['description'] ) ? $section['description'] : ''
			) );

			include_once( get_template_directory() . 'inc/customizer/controls/class-controls-' . $key . '.php' );
		}
	}

	public function organize_appearance( $wp_customize ) {
		$wp_customize->get_section( 'doors_general' )->panel       = 'doors_options';
		$wp_customize->get_section( 'doors_top_header' )->panel    = 'doors_options';
		$wp_customize->get_section( 'doors_colors' )->panel        = 'doors_options';
		$wp_customize->get_section( 'doors_custom_css_js' )->panel = 'doors_options';
		$wp_customize->get_section( 'doors_footer' )->panel        = 'doors_options';

		return $wp_customize;
	}

}
