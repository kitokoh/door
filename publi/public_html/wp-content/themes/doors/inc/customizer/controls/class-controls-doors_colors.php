<?php

class Doors_Customizer_Controls_Colors extends Doors_Customizer_Controls {

	public $controls = array();

	public function __construct() {
		$this->section = 'doors_colors';
		//  $this->priority = new Doors_Customizer_Priority(0, 1);

		parent::__construct();

		add_action( 'customize_register', array( $this, 'add_controls' ), 30 );
		add_action( 'customize_register', array( $this, 'set_controls' ), 35 );
	}

	public function add_controls( $wp_customize ) {
		$this->controls = array(
			'doors_options_array[primary_color]'              => array(
				'label'       => __( 'Primary Color', 'doors' ),
				'type'        => 'WP_Customize_Color_Control',
				'default'     => doors_get_option( 'primary_color' ),
				'description' => 'Doors primary color control'
			),
			'doors_options_array[secondary_color]'            => array(
				'label'       => __( 'Secondary Color', 'doors' ),
				'type'        => 'WP_Customize_Color_Control',
				'default'     => doors_get_option( 'secondary_color' ),
				'description' => 'Doors secondary color control'
			),
			'doors_options_array[adress_bar_bgcolor]'         => array(
				'label'       => __( 'Address Bar Background Color', 'doors' ),
				'type'        => 'WP_Customize_Color_Control',
				'default'     => doors_get_option( 'adress_bar_bgcolor' ),
				'description' => 'Address bar background color control'
			),
			'doors_options_array[adress_bar_color]'           => array(
				'label'       => __( 'Address Bar Color', 'doors' ),
				'type'        => 'WP_Customize_Color_Control',
				'default'     => doors_get_option( 'adress_bar_color' ),
				'description' => 'Address bar color control'
			),
			'doors_options_array[container_bg]'               => array(
				'label'       => __( 'Container Background Color', 'doors' ),
				'type'        => 'WP_Customize_Color_Control',
				'default'     => doors_get_option( 'container_bg' ),
				'description' => 'Container background color control'
			),
			'doors_options_array[header_bg]'                  => array(
				'label'       => __( 'Header Background Color', 'doors' ),
				'type'        => 'WP_Customize_Color_Control',
				'default'     => doors_get_option( 'header_bg' ),
				'description' => 'Header background color control'
			),
			'doors_options_array[navigation_text_color]'      => array(
				'label'       => __( 'Navigation Text Color', 'doors' ),
				'type'        => 'WP_Customize_Color_Control',
				'default'     => doors_get_option( 'navigation_text_color' ),
				'description' => 'Navigation text color control'
			),
			'doors_options_array[navigation_bg_color_sticky]' => array(
				'label'       => __( 'Navigation (Sticky) Background Color', 'doors' ),
				'type'        => 'WP_Customize_Color_Control',
				'default'     => doors_get_option( 'navigation_bg_color_sticky' ),
				'description' => 'Navigation (sticky) background color control'
			),
			'doors_options_array[footer_bg_color]'            => array(
				'label'       => __( 'Footer Background Color', 'doors' ),
				'type'        => 'WP_Customize_Color_Control',
				'default'     => doors_get_option( 'footer_bg_color' ),
				'description' => 'Footer background color control'
			),
			'doors_options_array[footer_text_color]'          => array(
				'label'       => __( 'Footer Text Color', 'doors' ),
				'type'        => 'WP_Customize_Color_Control',
				'default'     => doors_get_option( 'footer_text_color' ),
				'description' => 'Footer text color control'
			),
			'doors_options_array[copyright_bg]'               => array(
				'label'       => __( 'Copyright Background Color', 'doors' ),
				'type'        => 'WP_Customize_Color_Control',
				'default'     => doors_get_option( 'copyright_bg' ),
				'description' => 'Copyright background color control'
			),
			'doors_options_array[copyright_text_color]'       => array(
				'label'       => __( 'Copyright Bar Text Color', 'doors' ),
				'type'        => 'WP_Customize_Color_Control',
				'default'     => doors_get_option( 'copyright_text_color' ),
				'description' => 'Copyright bar text color control'
			)
		);

		return $this->controls;
	}

}

new Doors_Customizer_Controls_Colors();
