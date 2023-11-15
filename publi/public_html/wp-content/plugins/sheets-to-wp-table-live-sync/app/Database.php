<?php
/**
 * Managing database operations for the plugin.
 *
 * @since 2.12.15
 * @package SWPTLS
 */

namespace SWPTLS;

// If direct access than exit the file.
defined( 'ABSPATH' ) || exit;

/**
 * Manages plugin database operations.
 *
 * @since 2.12.15
 */
final class Database {

	/**
	 * Checks for sheet duplication.
	 *
	 * @param string $url The sheet url.
	 * @return boolean
	 */
	public function check_for_duplicate_sheet( string $url ): bool {
		global $wpdb;

		$result = $wpdb->get_row(
			$wpdb->prepare( "SELECT * from {$wpdb->prefix}gswpts_tables WHERE `source_url` LIKE %s", $url )
		);

		return ! is_null( $result );
	}

	/**
	 * Insert table into the db.
	 *
	 * @param array $data The data to save.
	 * @return int|false
	 */
	public function insert( array $data ) {
		global $wpdb;

		$table  = $wpdb->prefix . 'gswpts_tables';
		$format = [ '%s', '%s', '%s', '%s', '%s' ];

		$wpdb->insert( $table, $data, $format );
		return $wpdb->insert_id;
	}

	/**
	 * Create plugins required database table for tables.
	 *
	 * @since 2.12.15
	 */
	public function create_tables() {
		global $wpdb;

		$collate = $wpdb->get_charset_collate();
		$table   = $wpdb->prefix . 'gswpts_tables';

		$sql = 'CREATE TABLE IF NOT EXISTS ' . $table . ' (
            `id` INT(255) NOT NULL AUTO_INCREMENT,
            `table_name` VARCHAR(255) DEFAULT NULL,
            `source_url` LONGTEXT,
            `source_type` VARCHAR(255),
            `table_settings` LONGTEXT,
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB ' . $collate . '';

		include_once ABSPATH . 'wp-admin/includes/upgrade.php';
		dbDelta( $sql );
	}

	/**
	 * Create plugins required database table for tabs.
	 *
	 * @since 2.12.15
	 */
	public function create_tabs() {
		global $wpdb;
		$collate = $wpdb->get_charset_collate();
		$table   = $wpdb->prefix . 'gswpts_tabs';

		$sql = 'CREATE TABLE IF NOT EXISTS ' . $table . ' (
            `id` INT(255) NOT NULL AUTO_INCREMENT,
            `tab_name` VARCHAR(255) NOT NULL,
            `show_name` BOOLEAN,
            `reverse_mode` BOOLEAN,
            `tab_settings` LONGTEXT NOT NULL,
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB ' . $collate . '';

		include_once ABSPATH . 'wp-admin/includes/upgrade.php';
		dbDelta( $sql );
	}

	/**
	 * Create plugins required database table for tables.
	 *
	 * @param int $network_wide The network wide site id.
	 * @since 2.12.15
	 */
	public function activation( $network_wide ) {
		global $wpdb;
		if ( is_multisite() && $network_wide ) {
			$blog_ids = $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs" );
			foreach ( $blog_ids as $blog_id ) {
				switch_to_blog( $blog_id );
				$this->create_tables();
				$this->create_tabs();
				restore_current_blog();
			}
		} else {
			$this->create_tables();
			$this->create_tabs();
		}
	}

	/**
	 * Fetch all the saved tables
	 *
	 * @return mixed
	 */
	public function fetchTables() {
		global $wpdb;

		$table  = $wpdb->prefix . 'gswpts_tables';
		$query  = "SELECT * FROM $table";
		$result = $wpdb->get_results( $query ); // phpcs:ignore

		return $result;
	}

	/**
	 * Get the tab by its id value.
	 *
	 * @param  int $id The tab ID.
	 * @return mixed
	 */
	public function getTab( $id ) {
		global $wpdb;
		$table  = $wpdb->prefix . 'gswpts_tabs';
		$result = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $table WHERE id=%d", absint( $id ) ) ); // phpcs:ignore

		return $result;
	}

	/**
	 * Fetch table with specific ID.
	 *
	 * @param  int $id The table id.
	 * @return mixed
	 */
	public function fetch_table_by_id( int $id ) {
		global $wpdb;
		$table = $wpdb->prefix . 'gswpts_tables';

		$result = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $table WHERE id=%d", absint( $id ) ) ); // phpcs:ignore

		return ! is_null( $result ) ? $result : null;
	}

	/**
	 * Update table with specific ID.
	 *
	 * @param int   $id The table id.
	 * @param array $data The data to update.
	 */
	public function update( int $id, array $data ) {
		global $wpdb;
		$table = $wpdb->prefix . 'gswpts_tables';

		return $wpdb->query( $wpdb->prepare( "UPDATE $table SET `table_settings` = %s WHERE id = %d;", wp_json_encode( $data ), $id ) ); // phpcs:ignore
	}

	/**
	 * Delete table data from the DB.
	 *
	 * @param string $table The table name.
	 * @param int    $id    The table id to delete.
	 * @return int|false
	 */
	public function delete( string $table, int $id ) {
		global $wpdb;

		return $wpdb->delete( $table, [ 'id' => $id ], [ '%d' ] );
	}

	/**
	 * Responsible for handling table data.
	 *
	 * @return mixed
	 */
	public function tabTableData() {
		global $wpdb;
		$table = $wpdb->prefix . 'gswpts_tabs';

		return $wpdb->get_results( "SELECT * FROM $table" ); //phpcs:ignore
	}

	/**
	 * Saves tab changes by given data.
	 *
	 * @param string $data The data to insert.
	 * @since 2.12.15
	 */
	public function save_tab_changes( $data ) {
		global $wpdb;

		$table  = $wpdb->prefix . 'gswpts_tabs';
		$format = [ '%s', '%s', '%s', '%s' ];

		return $wpdb->insert(
			$table,
			[
				'tab_name'     => sanitize_text_field( $data['tabName'] ),
				'show_name'    => 'false',
				'reverse_mode' => wp_validate_boolean( $data['reverseMode'] ),
				'tab_settings' => wp_json_encode( $data['tabSettings'] )
			],
			$format
		);
	}

	/**
	 * Updates tab changes by given data.
	 *
	 * @param array $data The data to insert.
	 * @return int|false
	 */
	public function update_tab_changes( $data ) {
		global $wpdb;
		$table = $wpdb->prefix . 'gswpts_tabs';

		$response = $wpdb->update(
			$table,
			[
				'tab_settings' => wp_json_encode( $data[0]['tabSettings'] ),
				'reverse_mode' => 'true' === $data[0]['reverseMode'] ? true : false,
			],
			[
				'id' => intval( $data[0]['tabID'] ),
			],
			[
				'%s',
				'%d',
			],
			[
				'%d',
			]
		);

		return $response;
	}

	/**
	 * Update tab name.
	 *
	 * @param  int    $id The tab id.
	 * @param  string $name The tab name.
	 * @return int|false
	 */
	public function update_tab_name_toggle( $id, $name ) {
		global $wpdb;
		$table = $wpdb->prefix . 'gswpts_tabs';

		$response = $wpdb->update(
			$table,
			[
				'show_name' => $name
			],
			[
				'id' => $id
			],
			[
				'%d'
			],
			[
				'%d'
			]
		);

		return $response;
	}
}