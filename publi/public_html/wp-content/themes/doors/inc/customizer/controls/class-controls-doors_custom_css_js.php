<?php

class Doors_Customizer_Controls_Custom_CSS_JS extends Doors_Customizer_Controls {

	public $controls = array();

	public function __construct() {
		$this->section  = 'doors_custom_css_js';
		$this->priority = new Doors_Customizer_Priority( 49, 1 );

		parent::__construct();

		add_action( 'customize_register', array( $this, 'add_controls' ), 30 );
		add_action( 'customize_register', array( $this, 'set_controls' ), 35 );
	}

	public function add_controls( $wp_customize ) {
		$this->controls = array(
			'doors_options_array[doors_theme_custom_css]' => array(
				'label'       => __( 'Custom CSS', 'doors' ),
				'type'        => 'textarea',
				'default'     => doors_get_option( 'doors_theme_custom_css' ),
				'description' => 'Custom CSS',
				'input_attrs' => array(
					'placeholder' => esc_html__( 'Put your style here', 'doors' )
				)
			),
			'doors_options_array[doors_theme_custom_js]'  => array(
				'label'       => __( 'Custom JavaScript', 'doors' ),
				'type'        => 'textarea',
				'default'     => doors_get_option( 'doors_theme_custom_js' ),
				'description' => 'Custom JavaScript',
				'input_attrs' => array(
					'placeholder' => esc_html__( 'Put your JavaScript here', 'doors' )
				)
			),
		);

		return $this->controls;
	}

}

new Doors_Customizer_Controls_Custom_CSS_JS();
