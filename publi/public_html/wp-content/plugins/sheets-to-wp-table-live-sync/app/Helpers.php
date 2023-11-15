<?php
/**
 * Responsible for managing helper methods.
 *
 * @since 2.12.15
 * @package SWPTLS
 */

namespace SWPTLS;

use WP_Error;

// If direct access than exit the file.
defined( 'ABSPATH' ) || exit;

/**
 * Manages notices.
 *
 * @since 2.12.15
 */
class Helpers {

	/**
	 * Check if the pro plugin exists.
	 *
	 * @return boolean
	 */
	public function checkProPluginExists(): bool {
		return file_exists( WP_PLUGIN_DIR . '/sheets-to-wp-table-live-sync-pro/sheets-to-wp-table-live-sync-pro.php' );
	}

	/**
	 * Check if pro plugin is active or not
	 *
	 * @return boolean
	 */
	public function isProActive():bool {
		$license = function_exists( 'swptlspro' ) ? swptlspro()->license_status : false;

		return in_array( 'sheets-to-wp-table-live-sync-pro/sheets-to-wp-table-live-sync-pro.php', get_option( 'active_plugins', [] ), true ) && $license;
	}

	/**
	 * Checks for php versions.
	 *
	 * @return bool
	 */
	public function version_check(): bool {
		return version_compare( PHP_VERSION, '5.4' ) < 0;
	}

	/**
	 * Get nonce field.
	 *
	 * @param string $nonce_action The nonce action.
	 * @param string $nonce_name   The nonce input name.
	 */
	public function nonceField( $nonce_action, $nonce_name ) {
		wp_nonce_field( $nonce_action, $nonce_name );
	}

	/**
	 * Extract google sheet id.
	 *
	 * @param string $url The sheet url.
	 * @return string|false
	 */
	public function getSheetID( string $url ) {
		$parts = wp_parse_url( $url );

		if ( ! $parts ) {
			return false;
		}

		if ( isset( $parts['query'] ) ) {
			parse_str( $parts['query'], $query );

			if ( isset( $query['id'] ) ) {
				return $query['id'];
			}
		}

		$path = explode( '/', $parts['path'] );
		return ! empty( $path[3] ) ? sanitize_text_field( $path[3] ) : false;
	}

	/**
	 * Get grid id.
	 *
	 * @param string $url The sheet url.
	 * @return mixed
	 */
	public function getGridID( string $url ) {
		$gid = 0;
		$pattern = '/gid=(\w+)/i';

		if ( ! $this->isProActive() ) {
			return $gid;
		}

		if ( preg_match_all( $pattern, $url, $matches ) ) {
			$matchedID = $matches[1][0];
			if ( $matchedID || '0' === $matchedID ) {
				$gid = '' . $matchedID . '';
			}
		}

		return $gid;
	}

	/**
	 * Retrieves the table type.
	 *
	 * @param  string $type The table type.
	 * @return string
	 */
	public function get_table_type( string $type ): string {
		switch ( $type ) {
			case 'spreadsheet':
				return 'Spreadsheet';
			case 'csv':
				return 'CSV';
			default:
				return 'No type';
		}
	}

	/**
	 * Sheet url constructor.
	 *
	 * @param  string $sheet_id The sheet ID.
	 * @param  int    $gid     The sheet tab id.
	 * @return string
	 */
	public function prepare_export_url( string $sheet_id, int $gid ): string {
		apply_filters( 'swptls_export_url', $gid );

		if ( $gid && $this->isProActive() ) {
			return sprintf( 'https://docs.google.com/spreadsheets/d/%1$s/export?format=csv&id=%1$s&gid=%2$s', $sheet_id, $gid );
		}

		return sprintf( 'https://docs.google.com/spreadsheets/d/%1$s/export?format=csv&id=%1$s', $sheet_id );
	}

	/**
	 * Get csv data.
	 *
	 * @param  string $url     The sheet url.
	 * @param  string $sheet_id The sheet ID.
	 * @param  int    $gid     The sheet tab id.
	 * @return string|WP_Error
	 */
	public function get_csv_data( string $url, string $sheet_id, int $gid ) {
		$url      = $this->prepare_export_url( $sheet_id, $gid );
		$response = wp_remote_get( $url );
		$code     = wp_remote_retrieve_response_code( $response );

		if ( 400 === $code ) {
			return new WP_Error( 'private_sheet', __( 'The Sheet is not public or shared or not shared properly.', 'sheetstowptable' ) );
		}

		if ( is_wp_error( $response ) ) {
			return new WP_Error( 'private_sheet', __( 'You are offline.', 'sheetstowptable' ) );
		}

		$headers = $response['headers'];

		if ( isset( $headers['X-Frame-Options'] ) && 'DENY' === $headers['X-Frame-Options'] ) {
			return new WP_Error( 'private_sheet', __( 'The Sheet is not public or shared', 'sheetstowptable' ) );
		}

		return wp_remote_retrieve_body( $response );
	}

	/**
	 * Generate the table.
	 *
	 * @param string $response   The retrieved sheet string data.
	 * @param array  $settings   The table settings.
	 * @param string $name       The table name.
	 * @param bool   $from_block The request context.
	 *
	 * @return array
	 */
	public function generate_html( $response, $settings, $name, $from_block ) {
		$table = '';

		if ( ( isset( $settings['table_title'] ) ? wp_validate_boolean( $settings['table_title'] ) : false ) && ! $from_block ) {
			$table .= sprintf( '<h3 class="swptls-table-title">%s</h3>', $name );
		}

		$table .= '<table id="create_tables" class="ui celled display table gswpts_tables" style="width:100%">';
		$tbody = str_getcsv( $response, "\n" );
		$head  = array_shift( $tbody );
		$thead = str_getcsv( $head, ',' );

		$table .= '<thead><tr>';
		$thead_count = count( $thead );
		for ( $k = 0; $k < $thead_count; $k++ ) {
			$table .= '<th>';
				$table .= $thead[ $k ];
			$table .= '</th>';
		}
		$table .= '</tr></thead>';

		$table .= '<tbody>';
		$tbody_count = count( $tbody );
		$tbody_count = $tbody_count > SWPTLS::TBODY_MAX ? SWPTLS::TBODY_MAX : $tbody_count;

		for ( $i = 0; $i < $tbody_count; $i++ ) {
			$row_data  = str_getcsv( $tbody[ $i ], ',' );
			$row_count = count( $row_data );
			$row_index = ( $i + 1 );

			$table .= sprintf( '<tr class="gswpts_rows row_%1$d" data-index="%1$d">', $row_index );
			for ( $j = 0; $j < $row_count; $j++ ) {
				$cell_index = ( $j + 1 );
				$table .= sprintf(
					'<td data-index="%1$s" data-content="%2$s" class="cell_index_%3$s">',
					"[$cell_index,$row_index]",
					"$thead[$j]: &nbsp;",
					( $cell_index ) . '-' . $row_index
				);
					$table .= '<div class="cell_div">';
						$table .= $row_data[ $j ];
					$table .= '</div>';
				$table .= '</td>';
			}
			$table .= '</tr>';
		}

		$table .= '</tbody>';
		$table .= '</table>';

		return [
			'output'       => $table,
			'table'        => $table,
			'count'        => $i,
			'tableColumns' => $thead,
			'type'         => 'success'
		];
	}
}