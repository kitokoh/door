<?php
/**
 * Customize API: WP_Customize_WD class
 *
 * @package WordPress
 * @subpackage Customize
 * @since 4.4.0
 */

/**
 * Customize Control class.
 *
 * @since 3.4.0
 *
 * @see WP_Customize_Control
 */
if ( class_exists( 'WP_Customize_Control' ) ) {

	class WP_Customize_WD extends WP_Customize_Control {
		/**
		 * Type.
		 *
		 * @access public
		 * @var string
		 */
		public $type = 'text';

		/**
		 * Statuses.
		 *
		 * @access public
		 * @var array
		 */
		public $statuses;

		/**
		 * Mode.
		 *
		 * @since 4.7.0
		 * @access public
		 * @var string
		 */
		public $mode = 'full';

		/**
		 * Constructor.
		 *
		 * @param WP_Customize_Manager $manager Customizer bootstrap instance.
		 * @param string $id Control ID.
		 * @param array $args Optional. Arguments to override class property defaults.
		 *
		 * @uses WP_Customize_Control::__construct()
		 *
		 * @since 3.4.0
		 */
		public function __construct( $manager, $id, $args = array() ) {
			$this->statuses = array( '' => __( 'Default', 'doors' ) );
			parent::__construct( $manager, $id, $args );
		}

		/**
		 * Enqueue scripts/styles for the color picker.
		 *
		 * @since 3.4.0
		 */
		public function enqueue() {
			wp_enqueue_script( 'wp-color-picker' );
			wp_enqueue_style( 'wp-color-picker' );
		}

		/**
		 * Refresh the parameters passed to the JavaScript via JSON.
		 *
		 * @since 3.4.0
		 * @uses WP_Customize_Control::to_json()
		 */
		public function to_json() {
			parent::to_json();
			$this->json['statuses']     = $this->statuses;
			$this->json['defaultValue'] = $this->setting->default;
			$this->json['mode']         = $this->mode;
		}

		/**
		 * Don't render the control content from PHP, as it's rendered via JS on load.
		 *
		 * @since 3.4.0
		 */
		public function render_content() {
		}

		/**
		 * Render a JS template for the content of the color picker control.
		 *
		 * @since 4.1.0
		 */
		public function content_template() {
			?>
      <# var setupName = data.defaultValue;
      #>
      <label>
        <# if ( data.label ) { #>
        <span class="customize-control-title">{{{ data.label }}}</span>
        <# } #>
        <# if ( data.description ) { #>
        <span class="description customize-control-description">{{{ data.description }}}</span>
        <# } #>
        <input type="checkbox" value="1" class="cmn-toggle cmn-toggle-round" name="{{ setupName }}"
               id="{{ setupName }}"/>
        <label for="{{ setupName }}"></label>
        <!--       </div> -->
      </label>
			<?php
		}
	}

	$managers = new WP_Customize_Manager();
	$managers->register_control_type( 'WP_Customize_WD' );
}