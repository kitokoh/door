<?php

class Doors_Customizer_Controls {

	public $section;

	public function __construct() {
		if ( ! isset( $this->priority ) ) {
			$this->priority = new Doors_Customizer_Priority();
		}
	}

	public function set_controls( $wp_customize ) {
		foreach ( $this->controls as $key => $control ) {
			$defaults = array(
				'priority' => $this->priority->next(),
				'type'     => 'option',
				'section'  => $this->section
			);

			$control                       = wp_parse_args( $control, $defaults );
			$controls                      = $control;
			$controls['type']              = 'option';
			$controls['sanitize_callback'] = 'esc_attr';
			//$wp_customize->add_setting( $key, $controls );

			if ( class_exists( $control['type'] ) ) {
				$type = $control['type'];

				unset( $control['type'] );

				$wp_customize->add_control( new $type(
					$wp_customize,
					$key,
					$control
				) );
			} else {
				$wp_customize->add_control( $key, $control );
			}
		}
	}
}
