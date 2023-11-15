<?php
/**
 * Plugin Name:       Sheets To WP Table Live Sync
 * Plugin URI:        https://wppool.dev/sheets-to-wp-table-live-sync/
 * Description:       Display Google Spreadsheet data to WordPress table in just a few clicks and keep the data always synced. Organize and display all your spreadsheet data in your WordPress quickly and effortlessly.
 * Version:           2.14.0
 * Requires at least: 5.0
 * Requires PHP:      5.4
 * Author:            WPPOOL
 * Author URI:        https://wppool.dev/
 * Text Domain:       sheetstowptable
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 *
 * @package SWPTLS
 */

// if direct access than exit the file.
defined( 'ABSPATH' ) || exit;

define( 'SWPTLS_VERSION', '2.14.0' );
define( 'SWPTLS_BASE_PATH', plugin_dir_path( __FILE__ ) );
define( 'SWPTLS_BASE_URL', plugin_dir_url( __FILE__ ) );
define( 'SWPTLS_PLUGIN_FILE', __FILE__ );
define( 'SWPTLS_PLUGIN_NAME', 'Sheets To WP Table Live Sync' );

// Define the class and the function.
require_once dirname( __FILE__ ) . '/app/SWPTLS.php';
swptls();