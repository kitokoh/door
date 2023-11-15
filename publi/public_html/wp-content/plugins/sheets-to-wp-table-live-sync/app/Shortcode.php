<?php
/**
 * Registering WordPress shortcode for the plugin.
 *
 * @since 2.12.15
 * @package SWPTLS
 */

namespace SWPTLS;

// If direct access than exit the file.
defined( 'ABSPATH' ) || exit;

/**
 * Responsible for registering shortcode.
 *
 * @since 2.12.15
 * @package SWPTLS
 */
class Shortcode {

	/**
	 * Class constructor.
	 *
	 * @since 2.12.15
	 */
	public function __construct() {
		add_shortcode( 'gswpts_table', [ $this, 'shortcode' ] );
	}

	/**
	 * Generate table html asynchronously.
	 *
	 * @param  array $atts The shortcode attributes data.
	 * @return HTML
	 */
	public function shortcode( $atts ) {
		return ( defined( 'ELEMENTOR_VERSION' ) && \Elementor\Plugin::$instance->editor->is_edit_mode() ) || 'on' !== get_option( 'asynchronous_loading' ) ? $this->plain_shortcode( $atts ) : $this->asynchronous_shortcode( $atts );
	}

	/**
	 * Generate table html via ajax.
	 *
	 * @param  array $atts The shortcode attributes.
	 * @return HTML
	 */
	private function asynchronous_shortcode( $atts ) {
		$output = '<h5><b>' . __( 'Table maybe deleted or can\'t be loaded.', 'sheetstowptable' ) . '</b></h5> <br>';

		$output = '<div class="gswpts_tables_container gswpts_table_' . absint( $atts['id'] ) . '" id="' . absint( $atts['id'] ) . '" data-nonce="' . esc_attr( wp_create_nonce( 'gswpts_sheet_nonce_action' ) ) . '">';
		$output .= '<div class="gswpts_tables_content">';

		$output .= '
			<div class="ui segment gswpts_table_loader">
					<div class="ui active inverted dimmer">
						<div class="ui large text loader">' . __( 'Loading', 'sheetstowptable' ) . '</div>
					</div>
					<p></p>
					<p></p>
					<p></p>
			</div>
		';

		$output .= '</div>';
		$output .= $this->editTableLink( absint( $atts['id'] ) );
		$output .= '</div>';
		$output .= '<br><br>';

		return $output;
	}

	/**
	 * Generate table html straight.
	 *
	 * @param  array $atts The shortcode attributes.
	 * @return HTML
	 */
	private function plain_shortcode( $atts ) {
		$output = '<h5><b>' . __( 'Table maybe deleted or can\'t be loaded.', 'sheetstowptable' ) . '</b></h5><br>';
		$table = swptls()->database->fetch_table_by_id( absint( $atts['id'] ) );

		if ( ! $table ) {
			return $output;
		}

		$settings = null !== json_decode( $table->table_settings ) ? json_decode( $table->table_settings, true ) : unserialize( $table->table_settings );

		$name     = esc_html( $table->table_name );
		$url      = esc_url( $table->source_url );
		$sheet_id = swptls()->helpers->getSheetID( $url );
		$gid      = swptls()->helpers->getGridID( $url );
		$response = swptls()->helpers->get_csv_data( $url, $sheet_id, $gid );

		if ( ! $response ) {
			return $output;
		}

		if ( swptls()->helpers->isProActive() ) {
			$with_style = wp_validate_boolean( $settings['importStyles'] ?? false );
			$response      = swptlspro()->helpers->loadDataByCondition( $table, $settings );
			$styles        = swptlspro()->helpers->loadStylesByCondition( $table, $settings );
			$images_data   = json_decode( swptlspro()->helpers->get_images_data( $sheet_id, $gid ), true );
			$hidden_fields = [
				'hide_column' => ! empty( $settings['hide_column'] ) ? $settings['hide_column'] : [],
				'hide_rows'   => ! empty( $settings['hide_rows'] ) ? $settings['hide_rows'] : [],
				'hide_cell'   => ! empty( $settings['hide_cell'] ) ? $settings['hide_cell'] : [],
			];

			$response    = swptlspro()->helpers->generate_html( $response, $styles, $hidden_fields, $name, $images_data );
			$table_style = $with_style ? 'default-style' : ( ! empty( $settings['table_style'] ) ? 'gswpts_' . $settings['table_style'] : '' );
		} else {
			$response    = swptls()->helpers->generate_html( $response, $settings, $name );
			$table_style = 'default-style';
		}

		$table      = $response['table'];
		$responsive = isset( $settings['responsive_style'] ) && $settings['responsive_style'] ? $settings['responsive_style'] : null;

		$output = sprintf(
			'<div class="gswpts_tables_container gswpts_table_%1$d %2$s %3$s" id="%1$d" data-table_name="%4$s" data-table_settings=\'%5$s\' data-url="%6$s">',
			absint( $atts['id'] ),
			esc_attr( $responsive ),
			esc_attr( $table_style ),
			esc_attr( $name ),
			wp_json_encode( $settings ),
			esc_attr( $url )
		);
		$output .= '<div class="gswpts_tables_content">';
			$output .= $table;
		$output .= '</div>';
		$output .= '<br/>';
		$output .= $this->editTableLink( absint( $atts['id'] ) );
		$output .= '</div>';
		$output .= '<br><br>';

		return $output;
	}

	/**
	 * Generate table edit link.
	 *
	 * @param int $tableID The table ID.
	 * @return null|HTML
	 */
	public function editTableLink( int $tableID ) {
		if ( current_user_can( 'manage_options' ) ) {
			return '<a class="table_customizer_link" style="position: relative; top: 20px;" href="' . esc_url( admin_url( 'admin.php?page=gswpts-dashboard&subpage=create-table&id=' . $tableID . '' ) ) . '" target="_blank">Customize Table</a>';
		}

		return null;
	}
}