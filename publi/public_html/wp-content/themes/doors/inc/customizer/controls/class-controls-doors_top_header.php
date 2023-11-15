<?php

class Doors_Customizer_Controls_Top_Header extends Doors_Customizer_Controls {

	public $controls = array();

	public function __construct() {
		$this->section = 'doors_top_header';
		//   $this->priority = new Doors_Customizer_Priority(0, 1);

		parent::__construct();

		add_action( 'customize_register', array( $this, 'add_controls' ), 30 );
		add_action( 'customize_register', array( $this, 'set_controls' ), 35 );
	}

	public function add_controls( $wp_customize ) {
		$this->controls = array(
			'doors_options_array[phone]'                => array(
				'label'       => __( 'Phone', 'doors' ),
				'type'        => 'text',
				'default'     => doors_get_option( 'phone' ),
				'description' => 'Phone',
				'input_attrs' => array(
					'placeholder' => esc_html__( 'Your Phone number', 'doors' )
				)
			),
			'doors_options_array[adress]'               => array(
				'label'       => __( 'Address', 'doors' ),
				'type'        => 'text',
				'default'     => doors_get_option( 'adress' ),
				'description' => 'Address',
				'input_attrs' => array(
					'placeholder' => esc_html__( 'Your first Address', 'doors' )
				)
			),
			'doors_options_array[button]'               => array(
				'label'       => __( 'Header Button', 'doors' ),
				'type'        => 'text',
				'default'     => doors_get_option( 'button' ),
				'description' => 'Header Button',
				'input_attrs' => array(
					'placeholder' => esc_html__( 'Button text', 'doors' )
				)
			),
			'doors_options_array[work]'                 => array(
				'label'       => __( 'Work Time', 'doors' ),
				'type'        => 'text',
				'default'     => doors_get_option( 'work' ),
				'description' => 'Work Time',
				'input_attrs' => array(
					'placeholder' => esc_html__( 'from - to', 'doors' )
				)
			)
		);

		return $this->controls;
	}

}

new Doors_Customizer_Controls_Top_Header();
