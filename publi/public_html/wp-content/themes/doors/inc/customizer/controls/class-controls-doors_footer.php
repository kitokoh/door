<?php

class Doors_Customizer_Controls_Footer extends doors_Customizer_Controls {

	public $controls = array();

	public function __construct() {
		$this->section  = 'doors_footer';
		$this->priority = new doors_Customizer_Priority( 49, 1 );

		parent::__construct();

		add_action( 'customize_register', array( $this, 'add_controls' ), 30 );
		add_action( 'customize_register', array( $this, 'set_controls' ), 35 );
	}

	public function add_controls( $wp_customize ) {
		$this->controls = array(
			'doors_options_array[doors_footer_columns]'  => array(
				'label'             => __( 'Footer columns', 'doors' ),
				'type'              => 'radio',
				'default'           => doors_get_option( 'doors_footer_columns' ),
				'choices'           => array(
					'one_columns'   => __( '1 Column', 'doors' ),
					'tow_a_columns' => __( '2 columns (1/3 + 2/3)', 'doors' ),
					'tow_b_columns' => __( '2 columns (2/3 + 1/3)', 'doors' ),
					'tow_c_columns' => __( '2 columns (1/2 + 1/2)', 'doors' ),
					'three_columns' => __( '3 columns', 'doors' ),
					'four_columns'  => __( '4 columns', 'doors' ),
				),
				'sanitize_callback' => 'esc_attr',
				'description'       => __( 'Footer columns', 'doors' )
			),
			'doors_options_array[doors_footer_bg_image]' => array(
				'label'       => __( 'Footer Background Image', 'doors' ),
				'type'        => 'WP_Customize_Image_Control',
				'default'     => doors_get_option( 'doors_footer_bg_image' ),
				'description' => 'Footer background image',
				'settings'    => 'doors_options_array[doors_footer_bg_image]'
			),
			'doors_options_array[doors_copyright]'       => array(
				'label'       => __( 'Footer Copyright Text', 'doors' ),
				'type'        => 'text',
				'default'     => doors_get_option( 'doors_copyright' ),
				'description' => 'Footer copyright text',
				'input_attrs' => array(
					'placeholder' => esc_html__( 'Footer copyright text', 'doors' )
				)
			),
			'doors_options_array[doors_poweredby]'       => array(
				'label'       => __( 'Powered By Text', 'doors' ),
				'type'        => 'text',
				'default'     => doors_get_option( 'doors_poweredby' ),
				'description' => 'Powered by text',
				'input_attrs' => array(
					'placeholder' => esc_html__( 'Powered by', 'doors' )
				)
			),
		);

		return $this->controls;
	}

}

new Doors_Customizer_Controls_Footer();
