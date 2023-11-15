<?php
/**
 * Responsible for managing ajax endpoints.
 *
 * @since 2.12.15
 * @package SWPTLS
 */

namespace SWPTLS\Ajax;

// If direct access than exit the file.
defined( 'ABSPATH' ) || exit;

/**
 * Responsible for managing ajax endpoints.
 *
 * @since 2.12.15
 * @package SWPTLS
 */
class UdTables {

	/**
	 * Class constructor.
	 *
	 * @since 2.12.15
	 */
	public function __construct() {
		add_action( 'wp_ajax_gswpts_ud_table', [ $this, 'run_action' ] );
		add_action( 'wp_ajax_gswpts_ud_tab', [ $this, 'run_action' ] );
	}

	/**
	 * Performs delete/update operations for tables.
	 *
	 * @return void
	 */
	public function run_action() {
		if ( ! wp_verify_nonce( $_POST['nonce'], 'tables_related_nonce_action' ) && ! wp_verify_nonce( $_POST['nonce'], 'swptls_tabs_nonce' ) ) {
			wp_send_json_error([
				'type'   => 'invalid_action',
				'output' => __( 'Action is invalid', 'sheetstowptable' )
			]);
		}

		$request_type = ! empty( $_POST['data']['reqType'] ) ? sanitize_text_field( $_POST['data']['reqType'] ) : 'invalid';
		$context      = sanitize_text_field( $_POST['action'] );

		if ( 'deleteAll' !== $request_type ) {
			$id = absint( $_POST['data']['id'] );
		}

		if ( 'gswpts_ud_table' !== $context && 'gswpts_ud_tab' !== $context ) {
			wp_send_json_error([
				'type'   => 'invalid_action',
				'output' => __( 'Action is invalid', 'sheetstowptable' )
			]);
		}

		switch ( $request_type ) {
			case 'update':
				$name = sanitize_text_field( $_POST['data']['name'] );
				$this->update( $context, $name, $id );
				break;
			case 'delete':
				$this->delete( $context, $id );
				break;
			case 'deleteAll':
				$ids = array_map( 'absint', $_POST['data']['ids'] );
				$this->delete_all( $context, $ids );
				break;
		}

		wp_send_json_error([
			'type'   => 'invalid_request',
			'output' => __( 'Request is invalid', 'sheetstowptable' )
		]);
	}

	/**
	 * Performs updates on tables and tabs.
	 *
	 * @param string $context The context to perform update.
	 * @param string $name    The name to update.
	 * @param int    $id      The id where to update.
	 */
	public function update( $context, $name, $id ) {
		global $wpdb;

		if ( 'gswpts_ud_table' === $context ) {
			$table  = $wpdb->prefix . 'gswpts_tables';
			$data   = [ 'table_name' => $name ];
			$output = __( 'Table name updated successfully', 'sheetstowptable' );
		}

		if ( 'gswpts_ud_tab' === $context ) {
			$table  = $wpdb->prefix . 'gswpts_tabs';
			$data   = [ 'tab_name' => $name ];
			$output = __( 'Tab name updated successfully', 'sheetstowptable' );
		}

		$response = $wpdb->update(
			$table,
			$data,
			[ 'id' => $id ],
			[ '%s' ],
			[ '%d' ]
		);

		if ( $response ) {
			wp_send_json_success([
				'output' => $output,
				'type'   => 'updated'
			]);
		} else {
			wp_send_json_success([
				'output' => __( 'Could not update the data.', 'sheetstowptable' ),
				'type'   => 'invalid_action'
			]);
		}
	}

	/**
	 * Delete table data from the DB.
	 *
	 * @param string $context The context to pick for performing delete.
	 * @param int    $id      The id to delete.
	 * @return void
	 */
	public function delete( $context, $id ) {
		if ( 'gswpts_ud_table' === $context ) {
			$response = $this->delete_table( $id );
		}

		if ( 'gswpts_ud_tab' === $context ) {
			$response = $this->delete_tabs( $id );
		}

		if ( $response ) {
			if ( 'gswpts_ud_table' === $context ) {
				wp_send_json_success([
					'output' => __( 'Table deleted successfully', 'sheetstowptable' ),
					'type'   => 'deleted'
				]);
			}

			if ( 'gswpts_ud_tab' === $context ) {
				wp_send_json_success([
					'output' => __( 'Tab deleted successfully', 'sheetstowptable' ),
					'type'   => 'deleted'
				]);
			}
		} else {
			if ( 'gswpts_ud_table' === $context ) {
				wp_send_json_error([
					'output' => __( 'Unable to delete table.', 'sheetstowptable' ),
					'type'   => 'invalid_action'
				]);
			}

			if ( 'gswpts_ud_tab' === $context ) {
				wp_send_json_error([
					'output' => __( 'Unable to delete tab.', 'sheetstowptable' ),
					'type'   => 'invalid_action'
				]);
			}
		}
	}

	/**
	 * Performs delete operations on given ids.
	 *
	 * @param string $context The context to perform deletion.
	 * @param int[]  $ids     The given int ids.
	 */
	public function delete_all( $context, $ids ) {
		foreach ( $ids as $id ) {
			if ( 'gswpts_ud_table' === $context ) {
				$response = $this->delete_table( $id );
			}

			if ( 'gswpts_ud_tab' === $context ) {
				$response = $this->delete_tabs( $id );
			}

			if ( ! $response ) {
				wp_send_json_error([
					'type'   => 'invalid_request',
					'output' => __( 'Request is invalid', 'sheetstowptable' )
				]);

				break;
			}
		}

		if ( 'gswpts_ud_table' === $context ) {
			wp_send_json_success([
				'type'           => 'deleted_All',
				'dataActionType' => $context,
				'output'         => __( 'Selected tables deleted successfully', 'sheetstowptable' )
			]);
		}

		if ( 'gswpts_ud_tab' === $context ) {
			wp_send_json_success([
				'type'           => 'deleted_All',
				'dataActionType' => $context,
				'output'         => __( 'Selected tabs deleted successfully', 'sheetstowptable' )
			]);
		}
	}

	/**
	 * Delete table by id.
	 *
	 * @param  int $id The table ID.
	 * @return int|false
	 */
	private function delete_table( int $id ) {
		global $wpdb;

		$table    = $wpdb->prefix . 'gswpts_tables';
		$response = swptls()->database->delete( $table, $id );

		if ( $response ) {
			// Delete caching related transient of this table.
			delete_transient( 'gswpts_sheet_data_' . $id . '' );
			delete_transient( 'gswpts_sheet_styles_' . $id . '' );
			delete_transient( 'gswpts_sheet_images_' . $id . '' );
			delete_option( 'gswpts_sheet_updated_time_' . $id . '' );
		}

		return $response;
	}

	/**
	 * Delete tab by id.
	 *
	 * @param int $id The tab ID.
	 * @return int|false
	 */
	private function delete_tabs( int $id ) {
		global $wpdb;

		$table    = $wpdb->prefix . 'gswpts_tabs';
		$response = swptls()->database->delete( $table, $id );

		return $response;
	}
}